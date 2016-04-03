<?
// ====================================\
  @include("_dir.php");

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  if (is_array($prdID)) $prdID=call('intval',$prdID);
  else $prdID=array();

  if (is_array($in_object)) $in_object=call('intval',$in_object);
  else $in_object=array();

  if ($catID=(int)$catID) {
    if ($CAN_ADMIN_CATS) {
      $out_object=array_diff($prdID,$in_object);
      if ($in_object) {
	$tmp=array();
	foreach ($in_object as $val) $tmp[]="($catID,$val)";
	db_query("replace into sc_category_prod (catID,prdID)
		  values ".implode(',',$tmp));
	}
      foreach ($out_object as $val) {
	db_query("delete from sc_category_prod where prdID=$val and catID=$catID");
	if (!@$sql_num_rows(db_query("select 1 from sc_category_prod
					where prdID=$val limit 1")))
	  db_query("replace into sc_category_prod (catID,prdID) values (1,$val)");
	}
      }
    }
  elseif ($lstID=(int)$lstID) {
    $tmp=array_filter(call('intval',@explode(':',@$sql_result(db_query(
		"select products from sc_list where lstID=$lstID"),0,0))));
    $tmp=array_merge(array_diff($tmp,$prdID),$in_object);
    $tmp=':'.implode(':',$tmp).':';
    db_query("update sc_list set products='$tmp' where lstID=$lstID");
    }
  else {
    $priority=call('intval',$priority);
    foreach ($priority as $id=>$pr) {
      $id=(int)$id;
      $act=$active[$id] ? 1 : 0;
      if ($id) {
	db_query("update sc_product set active=$act,priority=$pr where prdID=$id");
	db_query("insert IGNORE into sc_product_newval (prdID) values ($id)");
	db_query("update sc_product_newval set active=$act,priority=$pr where prdID=$id");
	}
      }
    }


//-----------------------------------------------\
sc_category_stat();
if ($SAVE_CATEGORY_TREE_TO_FILE) {
  @include("$ROOT_PATH/modules/categ_items.php");
  }
//-----------------------------------------------/

//-----------------------------------\
  $end_url=trim($end_url);
//-----------------------------------/
  redirect("./?OK=1&$end_url");

?>
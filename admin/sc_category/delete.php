<?
// ====================================\
  @include("_dir.php");

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");


  $ID=(int)$ID;

  if ($CAN_ADMIN_CATS && $ID>1 && ($Par=@$sql_fetch_row(db_query(
			"select parID from sc_category where catID=$ID")))) {
     $ParID=(int)$Par[0];
     $ParIDnew=$ParID ? $ParID : 1;

     db_query("delete from sc_category where catID=$ID");
     db_query("update sc_category set parID=$ParIDnew where parID=$ID");
     db_query("delete from sc_category_prod where catID=$ID");

     $res=db_query("select DISTINCT p.prdID
		from sc_product as p
			left join sc_category_prod as cp on p.prdID=cp.prdID
		where ISNULL(cp.prdID) group by 1");
     $tmp=array();
     while (list($id)=@$sql_fetch_row($res)) $tmp[]="(1,$id)";
     if ($tmp)
	db_query("insert into sc_category_prod (catID,prdID)
		values ".implode(',',$tmp));

//-----------------------------------------------\
sc_category_stat();
if ($SAVE_CATEGORY_TREE_TO_FILE) {
  @include("$ROOT_PATH/modules/categ_items.php");
  }
//-----------------------------------------------/
     }

  redirect("./?ID=$ParID&OK=1");
?>
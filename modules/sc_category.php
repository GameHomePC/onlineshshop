<?void();
// ------------------------------------\
  if ($CategStructCalled) return;
// ------------------------------------/


// ============================================================================\

// ------------------------------------\
function makeCategItemOption($row,$skipTop=0) {
  list($id,$item)=$row;
  if ($skipTop && $id<1) return array();
  $l=$item['level']-($skipTop ? 1 : 0);
  if ($l<0) $l=0;
  return array(
	0 => $id,
	1 => str_repeat(' ',$l*5).($l ? '— ' : '').$item['name']
	);
  }
// ------------------------------------/

// ------------------------------------\
function makeCategItemOption2($row) {
  return makeCategItemOption($row,1);
  }
// ------------------------------------/

// ------------------------------------\
function makeCategItemOption3($row) {
  list($id,$item)=$row;
  if (!$id || !$item['n_prod']) return array();
  $l=$item['level']-1;
  if ($l<0) $l=0;
  return array($id,str_repeat(' ',$l*5).($l ? '- ' : '')."$item[name] ($item[n_prod_orig])");
  }
// ------------------------------------/

// ------------------------------------\
function getCategPath($id) {
    global $CategItems;
  $res=array();
  while ($id) {
    $tmp=$res[$id]=$CategItems[$id];
    $id=$tmp['parID'];
    }
  return array_reverse($res,TRUE);
  }
// ------------------------------------/

// ------------------------------------\
function getCategPathStr($id,$full=0,$linkClass='',$delim=' : ',$show_last=1,$num_prd=1) {
    global $SITE_ROOT;
  $res='';
  $tmp=getCategPath($id);
  $l=sizeof($tmp);
  $class=($linkClass!='') ? "class='$linkClass'" : '';
  for ($i=$l-1; $i>=0; $i--) {
    list($id,$item)=each($tmp);
    list($name,$comm)=call('to_html',$item['name'],$item['comment']);
    if ($show_last || $i)
      $res.=($i || $full) ?
	"<a title='$comm' $class
		href='$SITE_ROOT/$item[href]'>$name</a>".
		($i ? $delim : ($num_prd ? "&nbsp;($item[n_prod])" : '')) : 
	$name;
    }
  return $res;
  }
// ------------------------------------/

// ============================================================================/


//-----------------------------------------------\
if ($SAVE_CATEGORY_TREE_TO_FILE) {
  @include("$ROOT_PATH/CACHE/_categ_items.php");
//  @extract(@unserialize(file_get_contents("$ROOT_PATH/CACHE/_categ_items.ini")));
  }
if (!is_array($CategItems) || sizeof($CategItems)<2) {
  @include("$ROOT_PATH/modules/categ_items.php");
  }
if ($ActiveCatsOnly) $CategItems=$CategItemsA;
//-----------------------------------------------/


// ------------------------------------\
  $CategStructCalled=1;
// ------------------------------------/
?>
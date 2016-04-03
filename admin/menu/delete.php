<?
// ====================================\
  @include("_dir.php");

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  $ID=(int)$ID;
  $newID=(int)$newID;

  $list=implode(',',call('intval',($grp ? $list_id : $ID)));
  $res=db_query("select menuID from site_menu
		where menuID in ($list) and static=0
		order by 1");
  for ($list=$t=''; $row=@$sql_fetch_row($res); $t=',') $list.="$t$row[0]";

  if ($list=='') {
//    $error_g='Choose as minimum one item';
//    include('index.php');
//    exit;
    }


  if ($list!='') {
// ------------------------------------\
  $list1=$list;
  do {
    $list1t=$list1;
    $res=db_query("select menuID from site_menu
			where menuID in ($list1) or parID in ($list1)
			order by 1");
    for ($list1=$t=''; $row=@$sql_fetch_row($res); $t=',') $list1.="$t$row[0]";
    }
  while (strlen($list1)>strlen($list1t));

  if (!$grp || $list_del)
    db_query("delete from site_menu where menuID in ($list1)");
  elseif (strpos("-,$list1,",",$newID,")) {
    $error_g='You can not move items to submenu of one of them';
    include('index.php');
    exit;
    }
  else
    db_query("update site_menu set parID=$newID where menuID in ($list)");
// ------------------------------------/
    }

// ------------------------------------\
  $list_priority=call("intval",$list_priority);
  foreach ($list_priority as $id=>$pr)
    if ($id=(int)$id) db_query("update site_menu set priority=$pr where menuID=$id");
// ------------------------------------/

  redirect("./?".($grp ? "ID=$ID&" : "")."OK=1");
?>
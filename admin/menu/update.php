<?
// ====================================\
  @include("_dir.php");

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  call('intval',array(&$ID,&$add,&$parID,&$pageID));
  call('trim',array(&$priority,&$title,&$url));
  $newwin=$newwin ? 1 : 0;

  $list1="$ID";
  do {
    $list1t=$list1;
    $res=db_query("select menuID from site_menu
			where menuID in ($list1) or parID in ($list1)
			order by 1");
    for ($list1=$t=''; $row=@$sql_fetch_row($res); $t=',') $list1.="$t$row[0]";
    }
  while (strlen($list1)>strlen($list1t));

  if ($ID<0 || !($ID || $add))
    $error='Invalid input data';
  elseif (!$add && strpos("-,$list1,",",$parID,"))
    $error='You can not move item to its submenu ;-)';
  elseif ($priority!='' && !is_int(check_int($priority)))
    $error='Wrong value for order';
  elseif (!$pageID && $title=='')
    $error='Enter item name';
  elseif (0&&!($pageID || $url!=''))
    $error='Choose page or enter direct link';

  if (isset($error)) {
    include("index.php");
    exit;
    }


  $priority=(int)$priority;
  if ($pageID) $url='';
  call('to_sql',array(&$title,&$url));

  if ($add)
    db_query("insert into site_menu (parID,static,priority,title,pageID,url,newwin)
		values ($parID,0,$priority,'$title',$pageID,'$url',$newwin)");
  else
    db_query("update site_menu set parID=IF(static,parID,$parID),priority=$priority,
			title='$title',pageID=$pageID,url='$url',newwin=$newwin
		where menuID=$ID");

  redirect("./?ID=$ID&add=$add&OK=1");
?>
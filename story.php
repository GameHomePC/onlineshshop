<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

// ------------------------------------\
  $strID=(int)$args[0];
// ------------------------------------/

// ----------------------------------------------------------\
  @extract($tmp=@$sql_fetch_assoc(db_query(
	"select priority,title,content from stories
	where strID=$strID and (active or $view_inactive)")));
// ----------------------------------------------------------/
  if (!$tmp) $RedirectUrl="$SITE_ROOT/stories.html";

  $Meta['title']=$title;

  include_once("$ROOT_PATH/common/all_head.php");
?>



<?
// ----------------------------------------------------------------------------\
  $prevID=$nextID=0;
  if (isset($priority)) {
    $prevID=@$sql_result(db_query("select strID from stories where active and (priority<$priority or (priority=$priority and strID<$strID)) order by priority DESC,strID DESC limit 1"),0,0);
    $nextID=@$sql_result(db_query("select strID from stories where active and (priority>$priority or (priority=$priority and strID>$strID)) order by priority,strID limit 1"),0,0);
    }

  $time=@get_date_str($time);
  $title=to_html($title);
  $content=str_replace('<%BASE%>',$SITE_ROOT,$content);
  if ($source!='')
    $source="<a href='#' target=_blank onMouseOver='this.href=\"$source\"'
		onFocus='this.onmouseover();window.status=this.href'
		onBlur='window.status=window.defaultStatus'>Source</a>";
// ----------------------------------------------------------------------------/
?>

<table border=0 cellspacing=10 cellpadding=0>
<tr><td colspan=2 class=head><?= $time ?></td></tr>
<tr><td rowspan=3 width=15></td><td><h1 class=headH style='margin:0'><?= $title ?></h1></td></tr>
<tr><td><p><?= $content ?></p></td></tr>
<tr><td><?= $source ?></td></tr>
</table>


<br>
<table border=0 cellspacing=0 cellpadding=2 width=100%>
<tr>
  <td width=50% align=right class=txtB>
<?
  if ($prevID) echo "<a href='story_$prevID.html'>&lt;&lt;Previous</a>";
?>
  </td>
  <td width=0>|</td>
  <td width=0 class=txtB nowrap><a href='stories.html'>Stories Index</a></td>
  <td width=0>|</td>
  <td width=50% align=left class=txtB>
<?
  if ($nextID) echo "<a href='story_$nextID.html'>Next&gt;&gt;</a>";
?>
</td>
</tr>
</table>



<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>

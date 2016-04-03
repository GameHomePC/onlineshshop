<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

  include_once("$ROOT_PATH/common/all_head.php");
?>



<table border=0 cellspacing=0 cellpadding=0>
<?
  $res=db_query("select lnkID,l.name as name,url,url_js,content,
			IF(u.uplID,u.uplID,0) as uplID,
			CONCAT(path,'/',u.name) as fname
		from links as l left join uploads as u on l.uplID=u.uplID
		where active order by priority,lnkID DESC");
  while ($row=@$sql_fetch_assoc($res)) {
    @extract($row);
    $name=to_html($name);
    if ($uplID) {
      $attrs=get_elem(@getimagesize("$SERVER_ROOT/$fname"),3);
      $name="<img src='$SITE_ROOT/$fname' $attrs border=0 hspace=5 vspace=3 
		align=left alt=''>$name";
      }
    $url=to_html($url);
    if ($url!='')
      $name=$url_js ?
	"<a href='#' target=_blank onMouseOver='this.href=\"$url\"'
		onFocus='this.onmouseover();window.status=this.href'
		onBlur='window.status=window.defaultStatus'>$name</a>" : 
	"<a href='$url' target=_blank>$name</a>";
    $content=str_replace('<%BASE%>',$SITE_ROOT,$content);
    echo "<p clear=all>$img<div class=txtB>$name</div>
	<img src='$SITE_ROOT/img/1x1.gif' width=1 height=5 alt=''><br>
	$content</p>";
    }
?>
</table>



<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>

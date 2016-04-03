<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="Page Management";
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_head.php");
?>



<?
// ============================================================================\

  $Pages=array(
	0 => array(),
	1 => array(),
	2 => array()
	);

  $res=db_query("select pageID,type,static_page,active,in_map,priority,title,
			IF(url_name!='',url_name,pageID) as url_name
		from site_pages order by type,priority,pageID");
  while ($row=@$sql_fetch_assoc($res)) {
    $pageID=$row['pageID'];
    $type=$row['type'];
    $row['href']=make_url($row['static_page'],$row['url_name'],$type).'?view_inactive=1';
    $Pages[$type][$pageID]=$row;
    }

// ============================================================================/
?>


<?
// ------------------------------------\
  report_ok($OK);
// ------------------------------------/
?>


<script language=javascript><!--
function checkUpdateG(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  var els=f.elements
  var l=els.length
  for (var i=0; i<l; i++) {
    var el=els[i]
    if (el.name.indexOf('priority')==0 && el.value.length && checkInt(el.value)==null) {
      alert('Wrong value for order')
      el.focus()
      el.select()
      return false
      }
    }
  }
//-->
</script>

<?
  foreach ($Pages as $type=>$pages) {
    $Is_art=($type==2);
// ============================================================================\
?>
<div class=head>&#149; <?= $PAGE_TYPE[$type] ?></div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<table border=0 cellspacing=0 cellpadding=1>
<tr><td class="border">
<table border=0 cellspacing=1 cellpadding=2>

<form action='update_group.php' method=post
  onSubmit='return formSubmitOnce(this,checkUpdateG(this))'>

<tr valign=baseline class="bgH">
  <td class="txtB" width=25 align=center nowrap>#</td>
  <td class="txtB" align=center>Active</td>

<? if ($Is_art) { ?>
  <td class="txtB" align=center>Order<br>
	<div style='font-weight:normal'>(0-255)</div></td>
<? } else { ?>
  <td class="txtB" align=center nowrap title='Page present in Site Map'>In Map</td>
<? } ?>

  <td class="txtB" width=300 nowrap>Page</td>
  <td class="txtB" width=160><a href='view.php?type=<?= $type ?>'>Add</a></td>
</tr>

<?
  $i=0;
  foreach ($pages as $id=>$page) {
    $i++;
    @extract($page);
    $title=to_html($title);
    $checked='checked';
    if (!$active) {
      $checked='';
      $title="<span class=inactive>$title</span>";
      }
    $checked1=$in_map ? 'checked' : '';

    echo "<tr valign=middle class=bg>
	<td align=right class=txtB>$i&nbsp;</td>
	<td class=bgH align=center><input type=checkbox name='active[$id]' value='1' $checked></td>";

    if ($Is_art)
      echo "<td class=bgH align=center><input type=text name='priority[$id]' size=3 maxlength=5 value='$priority'></td>";
    else
      echo "<td class=bgH align=center>
		<input type=checkbox name='in_map[$id]' value='1' $checked1>
		<input type=hidden name='priority[$id]' value=0></td>";

    echo "<td class=txtB><a href='$href' target=_blank>$title</a></td>
	<td class=txtB>
		<a href='view.php?ID=$id'>Edit</a> /
		<a href='delete.php?ID=$id'
		onClick='return makeSure()'>Delete</a></td>
	</tr>";
    }
?>

<? if ($i) { ?>
<tr class="bg">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td colspan=2 class="bgH"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=7 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>
<tr class="bg">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
  <td colspan=2 class="bgH"><input class=buttonH type=submit value="Submit >>"></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
</tr>
</form>
<? } ?>

</table>
</td></tr>
</table>
<br>
<?
// ============================================================================/
    }
?>



<?
  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_tail.php");
?>

<?void();
/* ==================== Create menu script using $MenuItems struct ==================== */

if (!$MenuPrintCalled) {
// ----------------\
// ------------------------------------\
function write_items($list) {
    global $MenuItems;
  $t='';
  foreach ($list as $id) {
    $item=$MenuItems[$id];
    $title=to_js($item['html']);
    echo "$t Item('$title','$item[href]',$item[target],0,0,0,0,$item[linkClass],$item[linkAttrs]";
    if ($item['items']) {
      echo ",0,0, SubMenu(null,null,null,0,0,0,0,0,0,0,0,0,0,0,[";
      write_items($item['items']);
      echo "])";
      }
    echo ")";
    $t=',';
    }
  }
// ------------------------------------/
// ----------------/
}
?>

<script>
<?= $MenuName ?>=DropDownMenu('<?= $MenuName ?>',0,500,
	'','','','-4', 200,
	0,'','','</td><td class=siteMenuText>|</td><td>',
	0,0,
		'<table border=0 cellspacing=0 cellpadding=1 width=100%>\
		<tr></tr><tr></tr><tr><td width=100% class=siteSubMenuBorder>\
		<table border=0 cellspacing=0 cellpadding=2 width=100% class=siteSubMenuBg>\
		<tr><td width=100%>',
		'</td></tr>\
		</table>\
		</td></tr>\
		</table>',
		'</td></tr><tr><td width=100%>',
	'','','','siteMenuHItem','',
	'','','','siteMenuItem','',
	0,[
	<? write_items($MenuItems[0]['items']); ?>])
</script>


<?
// ------------------------------------\
  $MenuPrintCalled=1;
// ------------------------------------/
?>
<?
// ====================================\
  @include("_dir.php");
  $TITLE="Menu Management";
// ====================================/

  include("$ROOT_PATH/$ADMIN_DIR/common/logged_head.php");
?>



<?
// ------------------------------------\
  report_ok($OK);
// ------------------------------------/
?>


<?
// ------------------------------------\
  $EditMenu=1;
  $MenuName='site_menu';
  include("$ROOT_PATH/modules/menu_struct.php");
  include("$ROOT_PATH/modules/menu_print.php");
// ------------------------------------/
?>
<div class=head>Choose menu item for working:</div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>
<a href='./' class=txtB>&#149; <?= to_html($MenuItems[0]['menu_title']) ?></a><br>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=3 alt=''><br>
<?
// ------------------------------------\
  include("$ROOT_PATH/modules/menu_block.php");
// ------------------------------------/
?>


<?
  $ID=(int)$ID;
  if ($ID<0) $ID=0;
//  if (!$ID) $ID=$add=1;
  $add=($add || !$ID) ? 1 : 0;

//  if ($ID) {
// ============================================================================\
// ============================================================================\
?>
<script language=javascript><!--
var treeInfo={
<?
  $t='';
  foreach ($MenuItems as $id=>$item)
    if (is_int($id)) {
      echo "$t '$id':'$item[tree_info]'";
      $t=',';
      }
?>
	}
//-->
</script>


<a name="edit"></a>

<br>
<table border=0 cellspacing=0 cellpadding=0>
<tr valign=baseline>
  <td class='headH' nowrap>
  &#149; Choosed item: <span class='warnH'>"<?= to_html($MenuItems[$ID]['menu_title']) ?>"</span> 
  </td>
  <td width=50></td>
  <td class='txtB'>
<?
  $item=$MenuItems[$ID];
  $href=$item['url_name'] ? make_url($item['static_page'],$item['url_name'],$item['type'],$item['url']).'?view_inactive=1' : '';
?>
<? if ($ID && $add) { ?>
  <a href='./?ID=<?= $ID ?>'>- Edit this item</a><br>
<? } ?>
<? if ($href!='') { ?>
  <a href='<?= $href ?>' target=_blank'>- See linked page</a><br>
<? } ?>
<? if ($item['pageID']) { ?>
  <a href='<?= "$ADMIN_ROOT/page/view.php?ID=$item[pageID]" ?>'>- Edit linked page</a><br>
<? } ?>
<? if (!$item['static']) { ?>
  <a href='delete.php?ID=<?= $ID ?>' onClick='return makeSure()'>- Delete this item</a><br>
<? } ?>
  </td>
</tr>
</table>
<hr size=1 color=#000000 noshade>

<table border=0 cellspacing=0 cellpadding=0>
<tr valign=top>
  <td>
<?
// ============================================================================\
?>
<?
// ----------------------------------------------------------------------------\
  if (!$add) @extract($MenuItems[$ID],EXTR_SKIP);

  call('intval',array(&$parID,&$static,&$pageID,&$newwin));
  call('to_html',call('chop',array(&$priority,&$title,&$url)));
// ----------------------------------------------------------------------------/
?>

<script language=javascript><!--
function checkUpdate(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  var ti=f.parID ? treeInfo[f.parID.options[f.parID.selectedIndex].value] : ''
  if (!<?= $add ?> && ti.indexOf(treeInfo[<?= $ID ?>])==0) {
    alert('You can not move item to its submenu ;-)')
    f.parID.focus()
    return false
    }
  if (f.priority.value.length && checkInt(f.priority.value)==null) {
    alert('Wrong value for order')
    f.priority.focus()
    f.priority.select()
    return false
    }
  var si=f.pageID.selectedIndex
  if (!(si || f.title.value.length)) {
    alert('Enter item name')
    f.title.focus()
    return false
    }
  if (0&&!(si || f.url.value.length)) {
    alert('Choose page or enter direct link')
    f.pageID.focus()
    return false
    }
  }
//-->
</script>

<form name="update" action="update.php?ID=<?= $ID ?>&add=<?= $add ?>#edit" method=post
	onSubmit="return formSubmitOnce(this,checkUpdate(this))">

<?
// ------------------------------------\
  report_error($error);
// ------------------------------------/
?>

<div class=head>&nbsp; <?= $add ? 'Add Item in Submenu' : 'Edit Menu Item' ?></div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<?
  $star='<span class=star>*</span>';
?>
- Fields marked by <?= $star ?> are required.<br>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<table border=0 cellspacing=0 cellpadding=1 class="border">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2>

<? if ($add || !$static) { ?>
<tr valign=baseline class="bgH">
  <td class="txt">Submenu of Item:</td>
  <td class="bg"><?= get_elem(create_select('parID',$MenuItems,($add ? $ID : $parID),0,'makeItemOption')) ?></td>
</tr>
<? } ?>

<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Order (0-255):</td>
  <td class="bg"><input type=text name="priority" size=2 maxlength=5 value="<?= $priority ?>"></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txtB"><?= $star ?> Name:<br>
	<div class=f1 style='font-weight:normal'>(required only if page not choosed)</div></td>
  <td class="bg"><input type=text name="title" size=32 maxlength=100 value="<?= $title ?>"></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txt">Page...:</td>
  <td class="bg"><?= get_elem(create_select('pageID',
			"select pageID,title from site_pages order by type,priority,pageID",
			$pageID,0,0,0,0,1,'',
			"<option value=0 selected></option>")) ?></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt">... or Direct Link:</td>
  <td class="bg"><input type=text name="url" size=32 maxlength=255 value="<?= $url ?>"></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txt">Open in New Window:</td>
  <td class="bg"><input type=checkbox name="newwin" value=1 <?= $newwin ? 'checked' : '' ?>></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr class="bgH">
  <td><input class=button type=reset value="Reset"></td>
  <td><input class=buttonH type=submit value="Submit >>"></td>
</tr>

</table>
</td></tr>
</table>
</form>
<?
// ============================================================================/
?>
  </td>
  <td width=20>&nbsp;&nbsp;&nbsp;</td>
  <td width=1 bgcolor=black><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
  <td width=20>&nbsp;&nbsp;&nbsp;</td>
  <td>
<?
// ============================================================================\
?>
<script language=javascript><!--
function checkUpdateG(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
// ----------------\
  var els=f.elements
  var l=els.length
  for (var i=0; i<l; i++) {
    var el=els[i]
    if (el.name.indexOf('list_priority')==0 && el.value.length && checkInt(el.value)==null) {
      alert('Wrong value for order')
      el.focus()
      el.select()
      return false
      }
    }
// ----------------/
  var ids=[]
  var els=f.elements['list_id[]']
  var l=els.length
  if (!l && els.checked) ids[ids.length]=els.value
  for (var i=0; i<l; i++) if (els[i].checked) ids[ids.length]=els[i].value;
  if (!ids.length) {
//    alert('Choose as minimum one item')
//    return false
    }
  if (f.list_del[0].checked) {
    var ti=treeInfo[f.newID.options[f.newID.selectedIndex].value]
    for (var i in ids) {
      var id=ids[i]
      if (ti.indexOf(treeInfo[id])==0) {
        alert('You can not move items to submenu of one of them')
        return false
        }
      }
    }
  else if (ids.length) return makeSure()
  }
//-->
</script>

<form name="updateG" action="delete.php?ID=<?= $ID ?>&grp=1#edit" method=post
	onSubmit="return formSubmitOnce(this,checkUpdateG(this))">

<?
// ------------------------------------\
  report_error($error_g);
// ------------------------------------/
?>

<div class=head>&nbsp; Submenu:</div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<a href='./?ID=<?= $ID ?>&add=1' class=txtB>- Add item in submenu</a><br>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<table border=0 cellspacing=0 cellpadding=1 class="border">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2 width=250>

<tr valign=baseline class="bgH">
  <td class=txtB>&nbsp;</td>
  <td class=txtB align=center nowrap>Order<br>
	<div style='font-weight:normal'>(0-255)</div></td>
  <td class=txtB>Name</td>
</tr>

<?
  $b=0;
  foreach ($MenuItems[$ID]['items'] as $id)
    if (intval($id)) {
      $item=$MenuItems[$id];
      $checked=$list_id[$id] ? 'checked' : '';
      $priority=isset($list_priority[$id]) ? (int)$list_priority[$id] : $item['priority'];
      echo "<tr class=bg>
	<td class=bgH width=0><input type=checkbox name='list_id[]' value='$id' $checked></td>
	<td align=center class=bgH width=0><input type=text name='list_priority[$id]' size=2 maxlength=5 value='$priority'></td>
	<td class=txtB width=100% nowrap><a href='./?ID=$id'>$item[html]</a></td>
	</tr>";
      $b=1;
      }
?>

<?
  if ($b) {
// ------------------------------------\
?>
<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>
<tr valign=baseline class="bgH">
  <td colspan=3 class="txt">
<?/*?>
<center><input class=buttonH type=submit value="Delete Selected"></center>
<?*/?>
<div class='hl'>Action on Selected Items:</div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>
<input type=radio name='list_del' value="0" <?= ($list_del==0) ? 'checked' : '' ?>>
Move to submenu of<br>&nbsp;&nbsp;&nbsp;&nbsp;
<?= get_elem(create_select('newID',$MenuItems,($newID ? $newID : $ID),0,'makeItemOption')) ?><br>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>
<input type=radio name='list_del' value="1" <?= ($list_del==1) ? 'checked' : '' ?>>
Delete &nbsp;
<input class=buttonH type=submit value="Submit >>">
  </td>
</tr>
<?
// ------------------------------------/
    }
  else {
// ------------------------------------\
?>
<tr valign=baseline class="bg" nowrap>
  <td colspan=3 class="warn">No items in submenu...</td>
</tr>
<?
// ------------------------------------/
    }
?>

</table>
</td></tr>
</table>
</form>
<?
// ============================================================================/
?>
  </td>
</tr>
</table>
<?
// ============================================================================/
// ============================================================================/
//    }
?>



<?
  include("$ROOT_PATH/$ADMIN_DIR/common/logged_tail.php");
?>

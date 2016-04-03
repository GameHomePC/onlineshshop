<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="Page Management";
// ====================================/

  $HTMLEditorUsed=1;

  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_head.php");
?>


<?
// ============================================================================\

  $ID=(int)$ID;
  if ($ID<0) $ID=0;

  $Repeat=isset($error);
  $DBdata=($ID && !$Repeat);
  if ($DBdata) {
    @extract(@$sql_fetch_assoc(db_query(
		"select type,static_page,active,priority,in_map,url_name,
			meta_title,meta_keywords,meta_description,meta_author,
			title,content1,content2,bottom_links,
			uplID,pageID1,pageID2,pageID3,pageID4,pageID5
		from site_pages where pageID=$ID")));
    $bottom_links=@explode(':',$bottom_links);
    // ------------\
    $res=db_query("select menuID from site_menu where pageID=$ID");
    $menuID=array();
    while ($row=@$sql_fetch_row($res)) $menuID[]=$row[0];
    // ------------/
    }
  elseif (!$Repeat) {
    $active=1;
    }

  call("intval",array(&$type,&$active,&$in_map,&$uplID,
		&$pageID1,&$pageID2,&$pageID3,&$pageID4,&$pageID5));
  call("to_html",call("chop",array(&$static_page,&$priority,&$url_name,
		&$meta_title,&$meta_keywords,&$meta_description,&$meta_author,
		&$title,&$content1,&$content2)));
  $bottom_links=call('intval',$bottom_links);

  if (!isset($PAGE_TYPE[$type])) $type=0;
// ============================================================================/
?>


<b class=headerH><?= to_html($PAGE_TYPE[$type]) ?></b><br><br>
<table border=0 cellspacing=0 cellpadding=0>
<tr valign=baseline>
  <td class=txtB>
  <a href='./'>- Return to page list</a><br>
  <a href='view.php?type=<?= $type ?>'>- Add another page</a><br>
  </td>
<? if ($ID) { ?>
  <td width=50></td>
  <td class=txtB>
  <a href='<?= make_url($static_page,(($url_name!='') ? $url_name : $ID),$type) ?>?view_inactive=1' target=_blank>- See this page</a><br>
  <a href='delete.php?ID=<?= $ID ?>' onClick="return makeSure()">- Delete this page</a><br>
  </td>
<? } ?>
</tr>
</table>


<?
// ------------------------------------\
  report_ok($OK);
// ------------------------------------/
?>


<?
// ============================================================================\
?>
<a name="edit"></a>

<script language=javascript><!--
function checkUpdate(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  if (!f.title.value.length) {
    alert('Enter title')
    f.title.focus()
    f.title.select()
    return false
    }
//  if (f.type.selectedIndex==0 && !f.static_page.value.length) {
  if (f.type.value==0 && !f.static_page.value.length) {
    alert('Enter file with script')
    f.static_page.focus()
    return false
    }
//  if (f.type.selectedIndex==2 && 
  if (f.type.value==2 && 
	f.priority.value.length && checkInt(f.priority.value)==null) {
    alert('Wrong value for order')
    f.priority.focus()
    f.priority.select()
    return false
    }
  if (f.type.value!=0 && !checkUrlName(f.url_name.value)) {
    alert('There are unallowable symbols in Url Name or / in begin or end of it or Url Name is integer')
    f.url_name.focus()
    return false
    }
  }
//-->
</script>

<form name="update" action="update.php?ID=<?= $ID ?>#edit" 
	method=post enctype=multipart/form-data
	onSubmit="return formSubmitOnce(this,checkUpdate(this))">
<input type=hidden name='for_no_bag1' value=1>
<input type=hidden name='type' value=<?= $type ?>>

<div class=head>&nbsp; <?= (!$ID) ? 'Add New Page' : 'Edit Page' ?></div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<?
// ------------------------------------\
  report_error($error);
// ------------------------------------/
?>

<?
  $star='<span class=star>*</span>';
?>
- Fields marked by <?= $star ?> are required.<br>
<? /*
- Image (banner) may be JPEG, GIF or PNG
  <?= $MAX_UPLOAD_FILESIZE ? " and up to $MAX_UPLOAD_FILESIZE KB" : "" ?>.<br>
*/ ?>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<table border=0 cellspacing=0 cellpadding=1 class="border">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2 width=500>

<tr valign=baseline class="bgH">
  <td class="txtB" nowrap><?= $star ?> Title:</td>
  <td class="bg"><input type=text name="title" size=32 maxlength=100 value="<?= $title ?>"></td>
</tr>

<? if (!$type) { ?>
<tr valign=baseline class="bgH">
  <td class="txtB" nowrap><?= $star ?> Script File:</td>
  <td class="bg"><input type=text name="static_page" size=32 maxlength=100 value="<?= $static_page ?>"></td>
</tr>
<? } ?>

<tr valign=baseline class="bgH">
  <td class="txtB">Active:</td>
  <td class="bg"><input type=checkbox name="active" value="1" <?= $active ? 'checked' : '' ?>></td>
</tr>

<? if ($type==2) { ?>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Order (0-255):</td>
  <td class="bg"><input type=text name="priority" size=5 maxlength=5 value="<?= $priority ?>"></td>
</tr>
<? } ?>

<? if ($type==1 || $type==2) { ?>
<tr valign=baseline class="bgH">
  <td class="txtB">Url Name:<div class=f1>(for Apachee ModeRewrite)</div></td>
  <td class="bg"><input type=text name="url_name" size=32 maxlength=255 value="<?= $url_name ?>"></td>
</tr>
<? } ?>

<? if ($type<2) { ?>
<tr valign=baseline class="bgH">
  <td class="txt">Visible in Site Map:</td>
  <td class="bg"><input type=checkbox name="in_map" value="1" <?= $in_map ? 'checked' : '' ?>></td>
</tr>
<? } ?>

<?
/*
//======================================================================\
<?
  $EditMenu=0;
  include("$ROOT_PATH/modules/menu_struct.php");
?>
<tr valign=top class="bgH">
  <td class="txtB">Linked to Menu Item(s):<br>
	<div class=f1 style='font-weight:normal'>(use Ctrl and Shift keys for multiple selection)</div></td>
  <td class="bg"><?= get_elem(create_select('menuID[]',$MenuItems,$menuID,0,'makeItemOption2',0,0,5)) ?></td>
</tr>

<tr valign=middle class="bgH">
  <td class="txt">Page Banner:<br>
	<div class=f1>(100 x 100 max)</div></td>
  <td class="bg">
    <input type=hidden name="uplID" value="<?= $uplID ?>">
    <? if ($uplID) { ?>
    <?= file_image($uplID,'hspace=5 vspace=5') ?><br>
    <input type=checkbox class='bg' name='deleteold' value="1" <?= $deleteold ? " checked" : "" ?>
	title='Delete old banner if new is not choosed'>
    <? } ?><input type=file name="upl">
  </td>
</tr>
//======================================================================/
*/
?>


<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td colspan=2 class="hl">Meta-data
	<div class=note>(if undefined, default parameters will be used)</div></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt">Title:<br>
	<div class=f1>(if undefined, page title will be used)</div></td>
  <td class="bg"><input type=text name="meta_title" size=32 maxlength=1024 value="<?= $meta_title ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt">Keywords:</td>
  <td class="bg"><input type=text name="meta_keywords" size=52 value="<?= $meta_keywords ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt">Description:</td>
  <td class="bg"><input type=text name="meta_description" size=52 value="<?= $meta_description ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt">Author:</td>
  <td class="bg"><input type=text name="meta_author" size=32 maxlength=100 value="<?= $meta_author ?>"></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td colspan=2 class="hl">Content
	<div class=note>(any HTML-code is allowed)</div></td>
</tr>
<tr valign=baseline class="bgH">
  <td colspan=2 class="txtB">Main Text (in the top of page)</td>
</tr>
<tr valign=baseline class="bgH">
  <td colspan=2 class="bg">
<?
//----------------------------------------------------\
$ModuleData=array(
	'textarea' => 'content1',
	'cols' => '100',
	'rows' => '7'
	);
include("$ROOT_PATH/$ADMIN_DIR/modules/textarea.php");
//----------------------------------------------------/
?>
  </td>
</tr>

<?
  if (!$type) {
//===========================================================\
?>
<tr valign=baseline class="bgH">
  <td colspan=2 class="txtB">Bottom Text
	<div class=f1 style='font-weight:normal'>(makes sense only for static pages)</div></td>
</tr>
<tr valign=baseline class="bgH">
  <td colspan=2 class="bg">
<?
//----------------------------------------------------\
$ModuleData=array(
	'textarea' => 'content2',
	'cols' => '100',
	'rows' => '5'
	);
include("$ROOT_PATH/$ADMIN_DIR/modules/textarea.php");
//----------------------------------------------------/
?>
  </td>
</tr>
<?
//===========================================================/
  }
?>

<?
/*
//======================================================================\

<tr valign=top class="bgH">
  <td class="txt">Links to Pages:<br>
	<div class=f1>(use Ctrl and Shift keys for multiple selection)</div></td>
  <td class="bg"><?= get_elem(create_select("bottom_links[]",
				"select pageID,title from site_pages order by type,priority,pageID",
				$bottom_links,0,0,0,0,5)) ?></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td colspan=2 class="hl">Right-side Banners</td>
</tr>
<?
  $res=db_query("select pageID,title from site_pages
		where pageID!=$ID and uplID!=0 order by type,priority,pageID");
  $BanPages=array(0=>'---------- no ----------');
  while ($row=@$sql_fetch_row($res)) $BanPages[$row[0]]=$row[1];

  for ($i=1; $i<6; $i++) {
    $pageIDnm="pageID$i";
// ------------------------------------\
?>
<tr valign=baseline class="bgH">
  <td class="txt">Banner <?= $i ?>:</td>
  <td class="bg"><?= get_elem(create_select($pageIDnm,$BanPages,$$pageIDnm)) ?></td>
</tr>
<?
// ------------------------------------/
    }
?>

//======================================================================/
*/
?>


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
<input type=hidden name='for_no_bag2' value=1>
</form>
<?
// ============================================================================/
?>



<?
  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_tail.php");
?>

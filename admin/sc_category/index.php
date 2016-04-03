<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="Product Categories";
// ====================================/

  $HTMLEditorUsed=1;

  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_head.php");
?>


<?
// ------------------------------------\
  report_ok($OK);
// ------------------------------------/
?>

<?
// -------------------------------------------------\
  include_once("$ROOT_PATH/modules/sc_category.php");
// -------------------------------------------------/

// --------------------------------------------\
  if ($ID<2 || !isset($CategItems[$ID])) $ID=0;
  if (!$CAN_ADMIN_CATS || $ID==1) $add=0;
  elseif ($CAN_ADMIN_CATS && !$ID) $add=1;
  $edit=(!$add && $ID>1);
// --------------------------------------------/
?>


<table border=0 cellspacing=0 cellpadding=0>
<tr valign=top>
  <td>
<?
// ============================================================================\
?>
<div class=headH>&#149; Choose category:</div>
<div class=f1 
 style='width:220; height:450; overflow: scroll; border: 1px solid black; padding: 3px;'>
<nobr>
<?
  foreach ($CategItems as $id=>$item) {
    $nm=to_html($item['name']);
    if (!$item['active']) $nm="<span class=inactive title='Invisible'>$nm</span>";

    if ($ID==$id) $nm="<b class=bg style='padding:0 5 0 5;margin:2 0 2 0;border:1 #223344 dotted;'>$nm</b>";
    if ($id>1 && ($ID!=$id || $add)) $nm="<a href='./?ID=$id'>$nm</a>";

    $l=$item['level'];
    $n_all=$item['n_prod_all_orig'];
    $n_act=$item['n_prod_orig'];
    $n_pas=$n_all-$n_act;

    $tmp=$CAN_ADMIN_CATS ? 'catID' : 's_SF=1&s_catID';
    $n_all=($n_all || $CAN_ADMIN_CATS) ?
	"<a title='$n products total'
		href='$ADMIN_ROOT/sc_product/?$tmp=$id'><b>$n_all</b></a>" :
	"<span title='0 products total'><b>0</b></span>";
    $n_act=$n_act ?
	"<a title='$n_act active products'
		href='$ADMIN_ROOT/sc_product/?$tmp=$id&s_active=1'>$n_act</a>" :
	"<span title='0 active products'>0</span>";
    $n_pas=$n_pas ?
	"<a title='$n_pas inactive products' style='color:#444444'
		href='$ADMIN_ROOT/sc_product/?$tmp=$id&s_active=2'>$n_pas</a>" :
	"<span title='0 inactive products' class=inactive>0</span>";

    $tmp_add=$tmp_del='';
    if ($CAN_ADMIN_CATS && $id!=1) {
      $tmp_add="<a class='create' title='Add Subcategory' href='./?ID=$id&add=1'>[+]</a>";
      if ($id) $tmp_del="<a class='delete' title='Delete This Category' href='delete.php?ID=$id'
		onClick='return makeSure()'>[-]</a>";
      }

    $fn='';
    if ($item['file_name']) $fn=$item['img_not_loaded'] ? $item['file_name'] : "$SITE_ROOT/$item[file_name]";
    echo str_repeat('&nbsp;',$l*3),($l ? '&#151; ' : '&#149; '),
	($fn ? "<a href='$fn' target=_blank>
		<img src='$SITE_ROOT/img/img.gif' width=16 height=16 border=0 
		align=absmiddle alt='Click to enlarge'></a>&nbsp;" : ''),
	"<span class=txtB>$nm</span>&nbsp;",
	(($id<1) ? '' : "($n_act/$n_pas/$n_all)"),
	"$tmp_add$tmp_del<br>";
  }
?>
</nobr>
</div>
<?
// ============================================================================/
?>
  </td>
  <td width=10><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=10 height=1 alt=''></td>
  <td width=1 bgcolor=black><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
  <td width=10><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=10 height=1 alt=''></td>
  <td>
<?
  if ($edit || $add) {
// ============================================================================\
?>

<?
 if ($CAN_ADMIN_CATS) {
//-----------------------------\
?>
<script language=javascript><!--
var treeInfo={
<?
  $t='';
  foreach ($CategItems as $id=>$item)
    if (is_int($id)) {
      echo "$t '$id':'$item[tree_info]'";
      $t=',';
      }
?>
	}
function calcLength(el) {
  D.getElementById('id_'+el.name).innerHTML=el.value.length
  }
//-->
</script>
<?
//-----------------------------/
  }
?>

<a name="edit"></a>

<br>
<table border=0 cellspacing=0 cellpadding=0>
<tr valign=baseline>
  <td class='head' nowrap>
  <div class=bg style='padding:3'>
  &#149; Choosed category: <span class='warn'>"<?= to_html($CategItems[$ID]['name']) ?>"</span> 
  </div>
  </td>
  <td width=20></td>
  <td class='txtB'>
<? if ($ID>1 && $add) { ?>
  <a href='./?ID=<?= $ID ?>'>- Edit this category</a><br>
<? } ?>
<? if ($ID && $CAN_ADMIN_CATS) { ?>
  <a href='<?= $ADMIN_ROOT ?>/sc_product/?catID=<?= $ID ?>'>- Moderate products in this category</a><br>
<? } elseif ($ID) { ?>
  <a href='<?= $ADMIN_ROOT ?>/sc_product/?s_catID=<?= $ID ?>&s_SF=1'>- Browse products in this category</a><br>
<? } ?>
<? if ($ID>1) { ?>
  <a href='delete.php?ID=<?= $ID ?>' onClick='return makeSure()'>- Delete this category</a><br>
<? } ?>
  </td>
</tr>
</table>
<hr size=1 color=#000000 noshade>


<?
// ----------------------------------------------------------------------------\
  $Cat=$ID ? @$sql_fetch_row(db_query("select parID,name,comment,meta_title,meta_keywords,
			meta_description,title,description,active,priority,url_name
			from sc_category where catID=$ID")) : array();
  if ($CAN_ADMIN_CATS) {
    if (!isset($error))
      if (!$add) 
        list($parID,$name,$comment,$meta_title,$meta_keywords,$meta_description,
	  $title,$description,$active,$priority,$url_name)=$Cat;
      else $active=1;
    }
  else {
    list($parID,$name1,$comment1,$meta_title1,$meta_keywords1,$meta_description1,
	$title1,$description1,$active1,$priority1,$url_name1)=$Cat;
    if (!isset($error)) {
      $Cat1=$ID ? @$sql_fetch_row(db_query("select catID,name,comment,meta_title,
				meta_keywords,meta_description,title,description
			from sc_category_newval where catID=$ID")) : array();
      list($catID,$name,$comment,$meta_title,$meta_keywords,$meta_description,
	  $title,$description)=$Cat1;
      $active=$active1;
      $priority=$priority1;
      $url_name=$url_name1;
      }
    }

  call('to_html',call('chop',array(
		&$name,&$comment,&$meta_title,&$meta_keywords,
		&$meta_description,&$title,&$description,&$priority,&$url_name,
		&$name1,&$comment1,&$meta_title1,&$meta_keywords1,
		&$meta_description1,&$title1,&$description1)));
// ----------------------------------------------------------------------------/
?>

<script language=javascript><!--
function checkUpdate(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  if (f.priority.value.length && checkInt(f.priority.value)==null) {
    alert('Wrong value for order')
    f.priority.focus()
    f.priority.select()
    return false
    }
<? if ($CAN_ADMIN_CATS && !$add) { ?>
  var ti=f.parID ? treeInfo[f.parID.options[f.parID.selectedIndex].value] : ''
  if (ti.indexOf(treeInfo[<?= $ID ?>])==0) {
    alert('You can not move category to its subcategory ;-)')
    f.parID.focus()
    return false
    }
  if (!f.name.value.length) {
    alert('Enter a category name')
    f.name.focus()
    return false
    }
<? } ?>
  if (!checkUrlName(f.url_name.value)) {
    alert('There are unallowable symbols in Url Name New or / in begin or end of it or Url Name is integer')
    f.url_name.focus()
    return false
    }
  }
//-->
</script>

<form name="update" action="update.php?ID=<?= $ID ?><?= $CAN_ADMIN_CATS ? "&add=$add" : '' ?>#edit" method=post
	style='margin:0'
	onSubmit="return formSubmitOnce(this,checkUpdate(this))">

<?
// ------------------------------------\
  report_error($error);
// ------------------------------------/
?>

<div class=head>&nbsp; <?= $add ? 'Add SubCategory' : 'Edit Category' ?></div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<?
  $star='<span class=star>*</span>';
?>
- Fields marked by <?= $star ?> are required.<br>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<table border=0 cellspacing=0 cellpadding=1 class="border">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2>

<? if ($CAN_ADMIN_CATS) { ?>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Subcategory of:</td>
  <td class="bg"><?= get_elem(create_select('parID',$CategItems,($add ? $ID : $parID),0,'makeCategItemOption')) ?></td>
</tr>
<? } ?>

<tr valign=baseline class="bgH">
  <td class="txt">Active:</td>
  <td class="bg"><input type=checkbox name="active" value=1 <?= $active ? 'checked' : '' ?>></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Order (0-255):</td>
  <td class="bg"><input type=text name="priority" size=2 maxlength=3 value="<?= $priority ?>"></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<? if (!$CAN_ADMIN_CATS) { ?>
<tr valign=baseline class="bgH">
  <td class="txt">Short Name Inherited:</td>
  <td class="bg"><input type=text name="name1" size=38 maxlength=100 value="<?= $name1 ?>" disabled onFocus='blur()'></td>
</tr>
<? } ?>
<tr valign=baseline class="bgH">
  <td class="txtB"><?= $CAN_ADMIN_CATS ? "$star " : '' ?>Short Name:</td>
  <td class="bg"><input type=text name="name" size=38 maxlength=100 value="<?= $name ?>"></td>
</tr>

<? if (!$CAN_ADMIN_CATS) { ?>
<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>
<? } ?>

<? if (!$CAN_ADMIN_CATS) { ?>
<tr valign=baseline class="bgH">
  <td class="txt">Title Inherited:</td>
  <td class="bg"><input type=text name="title1" size=38 maxlength=100 value="<?= $title1 ?>" disabled onFocus='blur()'></td>
</tr>
<? } ?>
<tr valign=baseline class="bgH">
  <td class="txtB">Title:</td>
  <td class="bg"><input type=text name="title" size=38 maxlength=100 value="<?= $title ?>"></td>
</tr>

<? if (!$CAN_ADMIN_CATS) { ?>
<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>
<? } ?>

<? if (!$CAN_ADMIN_CATS) { ?>
<tr valign=baseline class="bgH">
  <td class="txt">Short Description Inherited:</td>
  <td class="bg"><input type=text name="comment1" size=59 maxlength=255 value="<?= $comment1 ?>" disabled onFocus='blur()'></td>
</tr>
<? } ?>
<tr valign=baseline class="bgH">
  <td class="txtB">Short Description:</td>
  <td class="bg"><input type=text name="comment" size=59 maxlength=255 value="<?= $comment ?>"></td>
</tr>

<? if (!$CAN_ADMIN_CATS) { ?>
<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>
<? } ?>

<? if (!$CAN_ADMIN_CATS) { ?>
<tr valign=baseline class="bgH">
  <td colspan=2 class="txt">Description Inherited</td>
</tr>
<tr valign=baseline class="bgH">
  <td colspan=2 class="bg">
  <textarea name='description1' cols=80 rows=5 wrap=virtual disabled onFocus='blur()'><?= $description1 ?></textarea><br>
  </td>
</tr>
<? } ?>
<tr valign=baseline class="bgH">
  <td colspan=2 class="txtB">Description
	<div class=note>(Any HTML-code is allowed)</div></td>
</tr>
<tr valign=baseline class="bgH">
  <td colspan=2 class="bg">
<?
//----------------------------------------------------\
$ModuleData=array(
	'textarea' => 'description',
	'cols' => '80',
	'rows' => '5'
	);
include("$ROOT_PATH/$ADMIN_DIR/modules/textarea.php");
//----------------------------------------------------/
?>
  </td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txtB">Url Name:<div class=f1>(for Apachee ModeRewrite)</div></td>
  <td class="bg"><input type=text name="url_name" size=60 maxlength=255 value="<?= $url_name ?>"></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td colspan=2 class="hl">Meta-data</td>
</tr>

<? if (!$CAN_ADMIN_CATS) { ?>
<tr valign=baseline class="bgH">
  <td class="txt">Title Inherited:</td>
  <td class="bg"><input type=text name="meta_title1" size=50 maxlength=1024 value="<?= $meta_title1 ?>" disabled onFocus='blur()'></td>
</tr>
<? } ?>
<tr valign=baseline class="bgH">
  <td class="txtB">Title:</td>
  <td class="bg"><input type=text name="meta_title" size=50 maxlength=1024 value="<?= $meta_title ?>"></td>
</tr>

<? if (!$CAN_ADMIN_CATS) { ?>
<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>
<? } ?>

<? if (!$CAN_ADMIN_CATS) { ?>
<tr valign=baseline class="bgH">
  <td class="txt">Keywords Inherited:</td>
  <td class="bg"><input type=text name="meta_keywords1" size=60 value="<?= $meta_keywords1 ?>" disabled onFocus='blur()'></td>
</tr>
<? } ?>
<tr valign=baseline class="bgH">
  <td class="txtB">Keywords:</td>
  <td class="bg"><input type=text name="meta_keywords" size=60 value="<?= $meta_keywords ?>"></td>
</tr>

<? if (!$CAN_ADMIN_CATS) { ?>
<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>
<? } ?>

<? if (!$CAN_ADMIN_CATS) { ?>
<tr valign=baseline class="bgH">
  <td class="txt">Description Inherited:</td>
  <td class="bg"><input type=text name="meta_description1" size=60 value="<?= $meta_description1 ?>" disabled onFocus='blur()'></td>
</tr>
<? } ?>
<tr valign=baseline class="bgH">
  <td class="txtB">Description:</td>
  <td class="bg"><input type=text name="meta_description" size=60 value="<?= $meta_description ?>"></td>
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
  }
?>
  </td>
</tr>
</table>



<?
  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_tail.php");
?>

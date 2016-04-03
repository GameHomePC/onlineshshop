<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="Product";
// ====================================/

  $HTMLEditorUsed=1;

//------------------------------------------\
$end_url_url=to_url($end_url=trim($end_url));
//------------------------------------------/

  $ID=(int)$ID;
  if ($ID<1) {
    redirect("./?$end_url");
    exit;
    }

  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_head.php");
?>


<table border=0 cellspacing=0 cellpadding=0>
<tr valign=baseline>
  <td class=txtB>
  <a href='./?<?= $end_url ?>'>- Return to product list</a><br>
  </td>
</tr>
</table>
<hr size=1 color=#000000 noshade>


<?
// ------------------------------------\
  report_ok($OK);
// ------------------------------------/
?>


<?
// ----------------------------------------------------------------------------\
  @extract(@$sql_fetch_assoc(db_query(
	"select p.name as name1,comment as comment1,meta_title as meta_title1,
		meta_keywords as meta_keywords1,meta_description as meta_description1,
		description as description1,active as active1,priority as priority1,

		IF(u1.uplID,u1.uplID,0) as uplID1,
		IF(u2.uplID,u2.uplID,0) as uplID2,
		IF(u3.uplID,u3.uplID,0) as uplID3,
		IF(u1.img_not_loaded,u1.name,CONCAT(u1.path,'/',u1.name)) as fname1,
		IF(u2.img_not_loaded,u2.name,CONCAT(u2.path,'/',u2.name)) as fname2,
		IF(u3.img_not_loaded,u3.name,CONCAT(u3.path,'/',u3.name)) as fname3,
		u1.width as width1,u1.height as height1,
		u2.width as width2,u2.height as height2,
		u3.width as width3,u3.height as height3,
		u1.img_not_loaded as img_not_loaded1,
		u2.img_not_loaded as img_not_loaded2,
		u3.img_not_loaded as img_not_loaded3
	from sc_product as p
	  left join uploads1 as u1 on p.uplID1=u1.uplID
	  left join uploads1 as u2 on p.uplID2=u2.uplID
	  left join uploads1 as u3 on p.uplID3=u3.uplID
	where prdID=$ID")));

  $image='';
  if ($uplID2) {
	$image=$img_not_loaded2 ? $fname2 : "$SITE_ROOT/$fname2";
	$width=$width2;
	$height=$height2;
	}
  elseif ($uplID1) {
	$image=$img_not_loaded1 ? $fname1 : "$SITE_ROOT/$fname1";
	$width=$width1;
	$height=$height1;
	}
  if ($image) {
    $alt=$uplID3 ? 'Enlarge' : 'Image';
    $bc=$uplID3 ? '#0033DD' : '#333333';
    $image="<img src='$image' width=$width height=$height alt='$alt' style='border:1 $bc solid;'>";
    if ($uplID3) {
      $img_url=($img_not_loaded3 ? '' : "$SITE_ROOT/").$fname3;
      $image="<a href='$img_url' target=_blank onClick=\"makePullDown('$img_url','img$uplID3',$width3+20,$height3+20,1);return false\">$image</a>";
      }
    }



  if (!isset($error)) {
    $prdID=0;
    @extract(@$sql_fetch_assoc(db_query("select prdID,name,comment,price_type,
					meta_title,meta_keywords,meta_description,
					url_name,description
				from sc_product_newval where prdID=$ID")));
    $active=$active1;
    $priority=$priority1;
    }

  call('to_html',call('chop',array(
		&$name,&$comment,&$meta_title,&$meta_keywords,
		&$meta_description,&$description,&$priority,&$url_name,
		&$name1,&$comment1,&$meta_title1,&$meta_keywords1,
		&$meta_description1,&$description1)));
  $price_type=(int)$price_type;
// ----------------------------------------------------------------------------/
?>

<script language=javascript><!--
function checkUpdate(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  if (f.priority.value.length && checkInt(f.priority.value)==null) {
    alert('Wrong value for New Order')
    f.priority.focus()
    f.priority.select()
    return false
    }
  if (!checkUrlName(f.url_name.value)) {
    alert('There are unallowable symbols in Url Name New or / in begin or end of it or Url Name is integer')
    f.url_name.focus()
    return false
    }
  }
//-->
</script>

<form name="update" action="update.php?ID=<?= $ID ?>#edit" method=post
	onSubmit="return formSubmitOnce(this,checkUpdate(this))">
<input type=hidden name='for_no_bag1' value=1>
<input type=hidden name='end_url' value="<?= $end_url ?>">

<?
// ------------------------------------\
  report_error($error);
// ------------------------------------/
?>

<div class=head>&nbsp; Edit Product's New Values</div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<?
  $star='<span class=star>*</span>';
?>
<? /*
- Fields marked by <?= $star ?> are required.<br>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>
*/ ?>

<table border=0 cellspacing=0 cellpadding=1 class="border">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2>

<? if ($image) { ?>
<tr valign=top class="bgH">
  <td class="txt">Image:</td>
  <td class="bg"><?= $image ?></td>
</tr>
<? } ?>

<tr valign=baseline class="bgH">
  <td class="txt">Active:</td>
  <td class="bg"><input type=checkbox name="active" value="1" <?= $active ? 'checked' : '' ?>></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Order (0-255):</td>
  <td class="bg"><input type=text name="priority" size=2 maxlength=3 value="<?= $priority ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB" nowrap>Redefine Price Type:</td>
  <td class="bg"><?= get_elem(create_select('price_type',$PRICE_TYPE,$price_type)) ?></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txt">Name Inherited:</td>
  <td class="bg"><input type=text name="name1" size=38 maxlength=100 value="<?= $name1 ?>" disabled onFocus='blur()'></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB">Name:</td>
  <td class="bg"><input type=text name="name" size=38 maxlength=100 value="<?= $name ?>"></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txt">Short Description Inherited:</td>
  <td class="bg"><input type=text name="comment1" size=38 maxlength=255 value="<?= $comment1 ?>" disabled onFocus='blur()'></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB">Short Description New:</td>
  <td class="bg"><input type=text name="comment" size=38 maxlength=255 value="<?= $comment ?>"></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td colspan=2 class="txt">Description Inherited</td>
</tr>
<tr valign=baseline class="bgH">
  <td colspan=2 class="bg">
  <textarea name='description1' cols=90 rows=5 wrap=virtual disabled onFocus='blur()'><?= $description1 ?></textarea><br>
  </td>
</tr>
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
	'cols' => '90',
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
  <td class="bg"><input type=text name="url_name" size=32 maxlength=255 value="<?= $url_name ?>"></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td colspan=2 class="hl">Meta-data</td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt">Title Inherited:</td>
  <td class="bg"><input type=text name="meta_title1" size=60 maxlength=1024 value="<?= $meta_title1 ?>" disabled onFocus='blur()'></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB">Title:</td>
  <td class="bg"><input type=text name="meta_title" size=60 maxlength=1024 value="<?= $meta_title ?>"></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txt">Keywords Inherited:</td>
  <td class="bg"><input type=text name="meta_keywords1" size=70 value="<?= $meta_keywords1 ?>" disabled onFocus='blur()'></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB">Keywords:</td>
  <td class="bg"><input type=text name="meta_keywords" size=70 value="<?= $meta_keywords ?>"></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txt">Description Inherited:</td>
  <td class="bg"><input type=text name="meta_description1" size=70 value="<?= $meta_description1 ?>" disabled onFocus='blur()'></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB">Description:</td>
  <td class="bg"><input type=text name="meta_description" size=70 value="<?= $meta_description ?>"></td>
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
<input type=hidden name='for_no_bag2' value=1>
</table>
</form>


<?
  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_tail.php");
?>

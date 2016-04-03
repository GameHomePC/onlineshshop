<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="Administration Center - Settings";
// ====================================/

  $HTMLEditorUsed=1;

  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_head.php");
?>



<script language=javascript><!--
//autoRefresh()
//-->
</script>


<?
// ============================================================================\

  $Repeat=isset($error);
  $DBdata=(!$Repeat);
  if ($DBdata) {
      @extract($Config);
      if (!$auto_update_period) $auto_update_period='';
      if (!$num_news_feat) $num_news_feat='';
      if (!$export_portion) $export_portion='';
      if (!$descr_preview_num) $descr_preview_num='';
      }

  call('intval',array(&$cat_link_style,&$prd_link_style,
			&$first_page_prods,&$left_menu_style));
  call('to_html',call('chop',array(
	&$meta_title,&$meta_keywords,&$meta_description,&$meta_author,&$signature,
	&$shop_id,&$num_products_feat,&$num_articles,
	&$num_stories,&$num_news,&$num_news_feat,&$auto_update_period,
	&$site_name,&$contact_email,&$img_cat_cols,&$img_cat_rows,
	&$http_site_folder,&$https_site_folder,&$export_portion,&$image_logo,
	&$order_email,&$descr_preview_num)));

// ============================================================================/
?>


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
  if (!f.site_name.value.length) {
    alert('Enter a site name')
    f.site_name.focus()
    f.site_name.select()
    return false
    }
  if (!checkEmail(f.contact_email.value)) {
    alert('Wrong contact email')
    f.contact_email.focus()
    f.contact_email.select()
    return false
    }
  if (!checkInt(f.shop_id.value)) {
    alert('Wrong value in field "Shop ID"')
    f.shop_id.focus()
    f.shop_id.select()
    return false
    }
  if (f.auto_update_period.value.length && checkInt(f.auto_update_period.value)===null) {
    alert('Wrong value auto update base period"')
    f.auto_update_period.focus()
    f.auto_update_period.select()
    return false
    }
  if (f.export_portion.value.length && checkInt(f.export_portion.value)===null) {
    alert('Wrong value exporting portion')
    f.export_portion.focus()
    f.export_portion.select()
    return false
    }
  if (f.order_email.value.length && !checkEmail(f.order_email.value)) {
    alert('Wrong email for orders')
    f.order_email.focus()
    f.order_email.select()
    return false
    }
  if (!(tmp=checkInt(f.img_cat_cols.value)) || tmp>255) {
    alert('Wrong number of products per column')
    f.img_cat_cols.focus()
    f.img_cat_cols.select()
    return false
    }
  if (!(tmp=checkInt(f.img_cat_rows.value)) || tmp>255) {
    alert('Wrong number of products per row')
    f.img_cat_rows.focus()
    f.img_cat_rows.select()
    return false
    }
  if (f.descr_preview_num.value.length && checkInt(f.descr_preview_num.value)===null) {
    alert("Wrong number of previewed description's chars")
    f.descr_preview_num.focus()
    f.descr_preview_num.select()
    return false
    }
  if (!checkInt(f.num_products_feat.value)) {
    alert('Wrong value in field "Products per block"')
    f.num_products_feat.focus()
    f.num_products_feat.select()
    return false
    }
  if (!checkInt(f.num_news.value)) {
    alert('Wrong value for num news per page')
    f.num_news.focus()
    f.num_news.select()
    return false
    }
  if (f.num_news_feat.value.length && checkInt(f.num_news_feat.value)==null) {
    alert('Wrong value for num news jn Home page')
    f.num_news_feat.focus()
    f.num_news_feat.select()
    return false
    }
  if (!checkInt(f.num_articles.value)) {
    alert('Wrong value for num articles per page')
    f.num_arlicles.focus()
    f.num_articles.select()
    return false
    }
  if (!checkInt(f.num_stories.value)) {
    alert('Wrong value for num live stories per page')
    f.num_stories.focus()
    f.num_stories.select()
    return false
    }
  }
//-->

function setPathesStatus(f) {
  var dis=(f.img_not_load.checked || !f.use_https.checked)
  f.http_site_folder.disabled=f.https_site_folder.disabled=dis
  f.http_site_folder.style.background=
	f.https_site_folder.style.background=
		dis ? '#CCCCCC' : '#FFFFFF'
  f.image_logo.disabled=f.img_not_load.checked
  f.image_logo.style.background=f.img_not_load.checked ? '#CCCCCC' : '#FFFFFF'
  }

</script>

<form name="update" action="update.php#edit" method=post
	onSubmit="return formSubmitOnce(this,checkUpdate(this))">
<input type=hidden name='for_no_bag1' value=1>

<?
// ------------------------------------\
  report_error($error);
// ------------------------------------/
?>

<?
  $star='<span class=star>*</span>';
?>
- Fields marked by <?= $star ?> are required.<br>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<table border=0 cellspacing=0 cellpadding=1 class="border">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2 width=500>

<tr valign=baseline class="bgH">
  <td class="txtB" nowrap><?= $star ?> Site Name:</td>
  <td class="bg"><input type=text name="site_name" size=32 maxlength=100 value="<?= $site_name ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB" nowrap><?= $star ?> Contact Email:</td>
  <td class="bg"><input type=text name="contact_email" size=32 maxlength=100 value="<?= $contact_email ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Use WYSIWYG html-editor in admin area:</td>
  <td class="bg"><input type=checkbox name="use_wysiwyg" value=1 <?= $use_wysiwyg ? 'checked' : '' ?>></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td colspan=2 class="hl">Partner Program Settings</td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB" nowrap><?= $star ?> Shop ID:</td>
  <td class="bg"><input type=text name="shop_id" size=5 maxlength=7 value="<?= $shop_id ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB" nowrap>Do not use External Interfaces:</td>
  <td class="bg"><input type=checkbox name="no_external" value=1 <?= $no_external ? 'checked' : '' ?>></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Auto update base period:
	<div class=f1><span class=note1>(in hours)</span></div></td>
  <td class="bg"><input type=text name="auto_update_period" size=5 maxlength=7 value="<?= $auto_update_period ?>">
	<span class=note1><i class=f1>leave empty for no auto-updating</i></span></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Get XML-base in UTF-8:</td>
  <td class="bg"><input type=checkbox name="get_utf8" value=1 <?= $get_utf8 ? 'checked' : '' ?>></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Export Base by Portions [<a href='javascript:alert("If base is big and there is not enough memory to export it by categories")'>?</a>]:</td>
  <td class="bg"><input type=text name="export_portion" size=5 maxlength=7 value="<?= $export_portion ?>">
	<span class=note1><i class=f1>leave empty for export by categories</i></span></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB" nowrap>Use Own Categories Structure [<a href='javascript:alert("Categories will be exported from ShopXML only first time and after that will not be exported")'>?</a>]:</td>
  <td class="bg"><input type=checkbox name="not_export_cats" value=1 <?= $not_export_cats ? 'checked' : '' ?>></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Do not load images to this site:</td>
  <td class="bg"><input type=checkbox name="img_not_load" value=1 <?= $img_not_load ? 'checked' : '' ?>
			onClick='setPathesStatus(form)'></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Add logo text to images:</td>
  <td class="bg"><input type=text name="image_logo" size=32 maxlength=50 value="<?= $image_logo ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB" nowrap>Mail notices about orders to Email:</td>
  <td class="bg"><input type=text name="order_email" size=32 maxlength=100 value="<?= $order_email ?>"></td>
</tr>


<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td colspan=2 class="hl">Secure Settings</td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Use HTTPS:</td>
  <td class="bg"><input type=checkbox name="use_https" value=1 <?= $use_https ? 'checked' : '' ?>
			onClick='setPathesStatus(form)'></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>
<tr valign=baseline class="bgH">
  <td colspan=2 class="hl">System Pathes
	<div class=note1><b class=f1>setup only if image loading enabled and HTTPS using enabled and HTTPS site root is different from HTTP site root</b></div></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>System Path to HTTP Site Root:
	<div class=note1><span class=f1>probably <i><?= $SERVER_ROOT ?></i></span></div></td>
  <td class="bg"><input type=text name="http_site_folder" size=32 maxlength=255 value="<?= $http_site_folder ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>System Path to HTTPS Site Root:
	<div class=note1><span class=f1>probably <i><?= str_replace('http','https',$SERVER_ROOT) ?></i></span></div></td>
  <td class="bg"><input type=text name="https_site_folder" size=32 maxlength=255 value="<?= $https_site_folder ?>"></td>
</tr>


<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td colspan=2 class="hl">ModRewrite Settings</td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Categories Link Style:</td>
  <td class="bg"><?= get_elem(create_select('cat_link_style',$CAT_LINK_STYLE,$cat_link_style)) ?></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Products Link Style:</td>
  <td class="bg">
	<?= get_elem(create_select('prd_link_style',$PRD_LINK_STYLE,$prd_link_style)) ?>
	<div class=note1><i class=f1>There are may be several url for same product
		if CatUrlNameOrID present in link style (if product present in several categories)</i></div>
  </td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Use Categories' Names in URL:</td>
  <td class="bg"><input type=checkbox name="cat_name_to_url" value=1 <?= $cat_name_to_url ? 'checked' : '' ?>></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Use Products' Names in URL:</td>
  <td class="bg"><input type=checkbox name="prd_name_to_url" value=1 <?= $prd_name_to_url ? 'checked' : '' ?>></td>
</tr>


<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td colspan=2 class="hl">Design settings</td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Categories Left Menu Style:</td>
  <td class="bg"><?= get_elem(create_select('left_menu_style',$LEFT_MENU_STYLE,$left_menu_style)) ?></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Show Products Count in Menu:</td>
  <td class="bg"><input type=checkbox name="menu_prd_count" value=1 <?= $menu_prd_count ? 'checked' : '' ?>></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Show Empty Categories:</td>
  <td class="bg"><input type=checkbox name="show_empty_cats" value=1 <?= $show_empty_cats ? 'checked' : '' ?>></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB" nowrap><?= $star ?> Products' Columns (1-255):</td>
  <td class="bg"><input type=text name="img_cat_cols" size=5 maxlength=5 value="<?= $img_cat_cols ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB" nowrap><?= $star ?> Products' Rows (1-255):</td>
  <td class="bg"><input type=text name="img_cat_rows" size=5 maxlength=5 value="<?= $img_cat_rows ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Previewed description's chars:</td>
  <td class="bg"><input type=text name="descr_preview_num" size=5 maxlength=5 value="<?= $descr_preview_num ?>">
	<span class=note1><i class=f1>leave empty for no preview</i></span></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB" nowrap><?= $star ?> Products per block:
	<div class=f1 style='font-weight:normal'><span class=note1>(in left / right products blocks)</span></div></td>
  <td class="bg"><input type=text name="num_products_feat" size=5 maxlength=5 value="<?= $num_products_feat ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Show Add To Cart button in blocks:
	<div class=f1 style='font-weight:normal'><span class=note1>(in left / right products blocks)</span></div></td>
  <td class="bg"><input type=checkbox name="show_add_but" value=1 <?= $show_add_but ? 'checked' : '' ?>></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Show Products on Home Page:</td>
  <td class="bg"><?= get_elem(create_select('first_page_prods',$FIRST_PAGE_PRODS,$first_page_prods)) ?></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Middle Images on Category Page:</td>
  <td class="bg"><input type=checkbox name="img_cat_mid" value=1 <?= $img_cat_mid ? 'checked' : '' ?>></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Big Images on Product Page:</td>
  <td class="bg"><input type=checkbox name="img_prd_big" value=1 <?= $img_prd_big ? 'checked' : '' ?>></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>
	Show Navigation Line:<br>
	<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=2 alt=''><br>
	&nbsp; &nbsp;Show Current Page in It:
  </td>
  <td class="bg">
	<input type=checkbox name="show_nav_line" value=1 <?= $show_nav_line ? 'checked' : '' ?>><br>
 	<input type=checkbox name="show_nav_line_last" value=1 <?= $show_nav_line_last ? 'checked' : '' ?>>
  </td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>
	Show Featured Product on Category Page:<br>
	<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=2 alt=''><br>
	Show Special Product on Category Page:
  </td>
  <td class="bg">
	<input type=checkbox name="cat_show_feat" value=1 <?= $cat_show_feat ? 'checked' : '' ?>><br>
	<input type=checkbox name="cat_show_spec" value=1 <?= $cat_show_spec ? 'checked' : '' ?>>
  </td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Show Related Products on Product Page:</td>
  <td class="bg"><input type=checkbox name="show_related_prds" value=1 <?= $show_related_prds ? 'checked' : '' ?>></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txtB" nowrap><?= $star ?> News per page:</td>
  <td class="bg"><input type=text name="num_news" size=5 maxlength=5 value="<?= $num_news ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>News on Home page:</td>
  <td class="bg">
    <input type=text name="num_news_feat" size=5 maxlength=5 value="<?= $num_news_feat ?>">
    <span class=note1><i class=f1>empty or 0 - no show</i></span>
  </td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB" nowrap><?= $star ?> Articles per page:</td>
  <td class="bg"><input type=text name="num_articles" size=5 maxlength=5 value="<?= $num_articles ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB" nowrap><?= $star ?> Live Stories per page:</td>
  <td class="bg"><input type=text name="num_stories" size=5 maxlength=5 value="<?= $num_stories ?>"></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txtB" nowrap>Add Percent to My Specials Products:</td>
  <td class="bg"><?= get_elem(create_select('additional_percent',range(0,100),$additional_percent,0,0,1)) ?><b>%</b></td>
</tr>


<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td colspan=2 class="hl">Default Meta-data
	<div class=note>(will be used on pages that have these parameters undefined)</div></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt">Title:</td>
  <td class="bg"><input type=text name="meta_title" size=32 maxlength=100 value="<?= $meta_title ?>"></td>
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
  <td colspan=2 class="hl">Signature in the botom of all pages
	<div class=note>(Any HTML-code is allowed)</div></td>
</tr>
<tr valign=baseline class="bgH">
  <td colspan=2 class="bg">
<?
//----------------------------------------------------\
$ModuleData=array(
	'textarea' => 'signature',
	'cols' => '90',
	'rows' => '4'
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

<tr class="bgH">
  <td><input class=button type=reset value="Reset"></td>
  <td><input class=buttonH type=submit value="Submit >>"></td>
</tr>

</table>
</td></tr>
</table>
<input type=hidden name='for_no_bag2' value=1>
</form>

<script language=javascript><!--
setPathesStatus(D.update)
//-->
</script>

<?
// ============================================================================/
?>



<?
  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_tail.php");
?>

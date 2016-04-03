<?void();
// ------------------------------------------------\
//  $EditMenu=0;
//  $MenuName='site_menu';
//  include("$ROOT_PATH/modules/menu_struct.php");
//  include("$ROOT_PATH/modules/menu_print.php");
// ------------------------------------------------/
?>

<table width=100% border=0 cellpadding=0 cellspacing=0 class=pageHeader>
<tr>
  <td background="<?= $SITE_ROOT ?>/img/logo_pas.gif">
    <table cellpadding=0 cellspacing=0 border=0 width=100% height=65>
    <tr valign=top>
      <td rowspan=2><a href="<?= $SITE_ROOT ?>/"><img src="<?= $SITE_ROOT ?>/img/logo.jpg" width=200 height=60 border=0 alt="<?= to_html($Config['site_name']) ?> - Home &#10;&#13;(<?= to_html($Config['meta_title']) ?>)"></a></td>
      <td align=right>
<?
//------------------------------------------------------------------------------\
if ($CUSTOMER_ID) {
?>
  <a href="<?= $SITE_ROOT ?>/logout.html?toploginform_url=<?= to_url($REQUEST_URI) ?>" rel='nofollow' class="toplogin"><u><b>Logout</b></u></a> &nbsp;
<?
  }
elseif (!$NO_EXTERNAL) { 
?>

<script language=javascript><!--
function checkTopLogin(f) {
  if (!f.email.value.length) {
	alert("Enter Username")
	f.email.select()
	f.email.focus()
	return false
	}
  if (!checkEmail(f.email.value)) {
	alert("Incorrect Username. Username is your Email!")
	f.email.select()
	f.email.focus()
	return false
	}
  if (!f.password.value.length) {
	alert("Enter Password")
	f.password.select()
	f.password.focus()
	return false
	}
  f.dologin.value=1
  }

function topForgotPassword() {
  f=document.toploginform
  if (!f.email.value.length || f.email.value=='Username') {
	alert("Enter Username")
	f.email.select()
	f.email.focus()
	return false
	}
  if (!checkEmail(f.email.value)) {
	alert("Incorrect Username. Username is your Email!")
	f.email.select()
	f.email.focus()
	return false
	}
  f.dologin.value=0
  f.submit()
  }
//-->
</script>

<table cellspacing=0 cellpadding=2 border=0 class=toplogin style='margin-right:5'>
<form name=toploginform action='<?= $SITE_ROOT ?>/login.html' method=post
	onSubmit="return checkTopLogin(this)" rel='nofollow'>
<input type=hidden name='dologin' value=1>
<input type=hidden name='toploginform_url' value='<?= to_html($REQUEST_URI) ?>'>
<tr>
  <td class=toplogin>L:<input type=text name="email" maxlength=20 size=10
	value="<?= to_html(($_POST['email']!='') ? $_POST['email'] : $SavedEmail) ?>"
	class=toplogin></td>
  <td class=toplogin>P:<input type="password" name="password" maxlength=20 size=10
	value="<?= to_html($_POST['password']) ?>"
	class=toplogin></td>
  <td><input type="submit" value='Login' class=toplogin
	style='border:1 #CCCCCC solid;background-color:#7495E8;color:#FFFFFF;font-weight:bold;'></td>
  <td>
    <a href="javascript: void(0)" class="toplogin" rel="nofollow"
	onClick="topForgotPassword(); return false">Forgot Password?</a><br>
    <a href="<?= $SITE_ROOT ?>/register_form.html" class="toplogin" rel="nofollow">Register Now</a>
  </td>
</tr>
</form>
</table>
<?
//------------------------------------------------------------------------------/
  }
?>
      </td>
    </tr>
    <tr>
      <td valign=bottom align=right style='color:#FFFFFF;padding:3 10 3 0' nowrap>
	<a href="<?= $SITE_ROOT ?>/"><img border=0 src="<?= $SITE_ROOT ?>/img/01-_01.gif" width=20 height=14 alt='Home'></a><a href='mailto:<?= $Config['contact_email'] ?>'><img border=0 src="<?= $SITE_ROOT ?>/img/01-_02.gif" width=26 height=14 alt='Mail Us'></a><a href="<?= $SITE_ROOT ?>/map.html"><img border=0 src="<?= $SITE_ROOT ?>/img/01-_03.gif" width=19 height=14 alt='Site Map'></a>
      </td>
    </tr>
    </table>
  </td>
</tr>
<tr class=menuLine>
  <td background="<?= $SITE_ROOT ?>/img/menu_pas.gif" height=31>

<?
// ----------------------------------------------\
//  include("$ROOT_PATH/modules/menu_block.php");
// ----------------------------------------------/
?>

<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr>
  <td nowrap style='padding:0 25 0 7'>
    <a class=menu href="<?= $SITE_ROOT ?>/">Home</a>
    <a class=menu href="<?= $SITE_ROOT ?>/news.html">News</a>
    <a class=menu href="<?= $SITE_ROOT ?>/contact_us.html">Contact Us</a>
    <a class=menu href="<?= $SITE_ROOT ?>/search.html" rel='nofollow'>Site Search</a>

<?
if ($NO_EXTERNAL) {
//------------------------------------------------\
?>
    <a class=menu href="<?= $SC_SITE_URL ?>/sc/sc.php?shop=<?= $SHOP_ID ?>" rel='nofollow'>My&nbsp;Cart</a>
    <a class=menu href="<?= $SC_SITE_URL ?>/sc/login.php?shop=<?= $SHOP_ID ?>" rel='nofollow'>Checkout</a>
<?
//------------------------------------------------/
  }
else {
//------------------------------------------------\
?>
<? if ($CUSTOMER_ID) { ?>
    <a class=menu href="<?= $SECURE_URL_HEADER ?>/account.html" rel='nofollow'>My&nbsp;account</a>
<? } else { ?>
    <a class=menu href="<?= $SECURE_URL_HEADER ?>/login_form.html" rel='nofollow'>Login</a>
    <a class=menu href="<?= $SECURE_URL_HEADER ?>/register_form.html" rel='nofollow'>Register</a>
<? } ?>

<? if ($SC_QUANTITY) { ?>
    <a class=menu href="<?= $SITE_ROOT ?>/sc.html" rel='nofollow'>My&nbsp;Cart</a>
    <a class=menu href="<?= $SECURE_URL_HEADER ?>/<?= $CUSTOMER_ID ? 'addresses.html' : 'choice.html' ?>" rel='nofollow'>Checkout</a>
<? } ?>

<? if ($CUSTOMER_ID) { ?>
    <a class=menu href="<?= $SITE_ROOT ?>/logout.html" rel='nofollow'>Logout</a>
<? } ?>
<?
//------------------------------------------------/
  }
?>
  </td>
  <td align=right nowrap width=100%>

<form action="<?= $SITE_ROOT ?>/search_prod.html" onSubmit='return formSubmitOnce(this,checkFilled(this.search_text,"Enter text for the search"))' style='margin:0'>
&nbsp;<b style='color:#EEEEEE'>Search product:</b>
<input type=text name='search_text' size=10 style='height:18;font-size:12' maxlength=100 value="<?= to_html($search_text) ?>">
<input type=image src="<?= $SITE_ROOT ?>/img/buttons/search.gif" width=16 height=16 border=0 style='border:0;background-color:#7F939D;' align=absmiddle alt="Search product"> &nbsp;
</form>

  </td>
</tr>
</table>

  </td>
</tr>
</table>


<table border=0 width=100% cellpadding=0 cellspacing=0 style='margin-top:4;margin-bottom:15;'>
<tr valign=top>
<td width=0 style='padding-left:1'>
  <img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=160 height=1 alt=''><br>
<?
//-------------------------------------------------------------------------------\
?>
<table border=0 width=100% cellspacing=0 cellpadding=0 background="<?= $SITE_ROOT ?>/img/left_vmenu.gif" class='infoBoxHead'>
<tr>
  <td width=18><img src="<?= $SITE_ROOT ?>/img/left_vmenu1.gif" alt="" width=18 height=22></td>
  <td width=100% nowrap class=infoBoxHead>Categories</td>
</tr>
</table>
<table border=0 width=100% cellspacing=0 cellpadding=1 class=border>
<tr><td>
<table border=0 width=100% cellspacing=0 cellpadding=0 class=bg>
<tr>
  <td align=left>
<?
//=========================================================================\
if (!$Config['left_menu_style']) {
  include("$ROOT_PATH/modules/menu_categories.php");
  }
else {
  echo '<div class=tree_usual>';
  $TreeInfo=$CategItems[$CatID]['tree_info'];
  foreach ($CategItems as $id => $item) {
//--------------------------------------------------------\
//  if ($id<2 || !$item['active_info']) continue;
  if ($id<2) continue;
  $lev=$item['level'];
  if ($lev!=1 && !strpos($TreeInfo,'_'.str_pad($item['parID'],6,'0', STR_PAD_LEFT).'_'))
	continue;
  list($name_,$comm_)=call('to_html',$item['name'],$item['comment']);
  if ($Config['menu_prd_count']) $name_.="<nobr>&nbsp;($item[n_prod])</nobr>";

//  if ($CatID!=$id || $PrdID)
//    $name_="<a href='$SITE_ROOT/$item[href]' title='$comm_'>$name_</a>";
  $tmp=($CatID==$id) ? 'class="active"' : '';
  $name_="<a href='$SITE_ROOT/$item[href]' title='$comm_' $tmp>$name_</a>";

  echo 	"<div style='padding-left:",(($lev-1)*10),"'>$name_</div>";
//--------------------------------------------------------/
    }
  echo '</div>';
  }
//=========================================================================/
?>

    <div style='margin: 0 5 5 5;padding:2 0 0 5;border-top:1 #8E9AD6 solid; color:#5464B3'>
    <li><a href='<?= $SITE_ROOT ?>/prod_special.html'>Specials</a><br>
    <li><a href='<?= $SITE_ROOT ?>/prod_new.html'>New Products</a><br>
    <li><a href='<?= $SITE_ROOT ?>/prod_featured.html'>Featured Products</a><br>
    <li><a href='<?= $SITE_ROOT ?>/prod_bestseller.html'>Bestsellers</a><br>
    </div>
    <div style='margin: 0 5 5 5;padding:2 0 0 5;border-top:1 #8E9AD6 solid; color:#5464B3'>
    <a href='<?= $SITE_ROOT ?>/search_prod.html' rel='nofollow'>extended search</a><br>
    </div>
  </td>
</tr>
</table>
</td></tr>
</table>

<?
//-------------------------------------------------------------------------------<
?>

<?
  if ($IsHomePage && $Config['num_news_feat'] &&
	@$sql_num_rows($res=db_query("select nwsID,time,title,content
		from news where archive=0 
		order by time DESC
		limit $Config[num_news_feat]"))) {
//-----------------------------------------------\
?>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=4 alt=''><br>
<table border=0 width=100% cellspacing=0 cellpadding=0 background="<?= $SITE_ROOT ?>/img/left_vmenu.gif" class='infoBoxHead'>
<tr>
  <td width=18><img src="<?= $SITE_ROOT ?>/img/left_vmenu1.gif" alt="" width=18 height=22></td>
  <td width=100% nowrap class=infoBoxHead>Last News</td>
</tr>
</table>
<table border=0 width=100% cellspacing=0 cellpadding=1 class=border>
<tr><td>
<table border=0 width=100% cellspacing=0 cellpadding=3 class=bg>
<tr>
  <td align=left style='padding:7;padding-bottom:3;'>
<?
//  $ml=80;
  while ($row=@$sql_fetch_assoc($res)) {
      $row['time']=get_date_str($row['time']);
    $title=to_html($title);
/*
//    $row['content']=strip_tags(str_replace('<%BASE%>',$SITE_ROOT,$row['content']));
//    if (strlen($row['content'])>$ml) $row['content']=substr($row['content'],0,$ml).'...';
//    echo "<div class=newsText><a href='news_view_$row[nwsID].html'>
//	<div class=newsHead>[$row[time]] $row[title]</div></a>
//	$row[content]</div>";
*/
        echo "<div style='padding-bottom:5'><a href='news_view_$row[nwsID].html'>$row[title]</a></div>";
    }
?>
  </td>
</tr>
</table>
</td></tr>
</table>
<?
//-----------------------------------------------/
    }
?>

<?
//-------------------------------------------------------------------------------<
?>

<?
 if (@$sql_result(db_query("select count(*) from sc_manufacturer"),0,0)) {
//--------------------------------------------------\
?>

<script language=javascript><!--
function check_search_mnf(f) {
  var el=f.url_name
  D.location.href='<?= $SITE_ROOT ?>/manufacturer_'+el.options[el.selectedIndex].value+'.html';
  return false
  }
//-->
</script>

<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=4 alt=''><br>

<table border=0 width=100% cellspacing=0 cellpadding=0 background="<?= $SITE_ROOT ?>/img/left_vmenu.gif" class='infoBoxHead'>
<tr>
  <td width=18><img src="<?= $SITE_ROOT ?>/img/left_vmenu1.gif" alt="" width=18 height=22></td>
  <td width=100% nowrap class=infoBoxHead>Manufaturers</td>
</tr>
</table>
<table border=0 width=100% cellspacing=0 cellpadding=1 class=border>
<tr><td>
<table border=0 width=100% cellspacing=0 cellpadding=3 class=bg>
<form name='search_mnf' action='<?= $SITE_ROOT ?>manufacturer.html' rel='nofollow'
	onSubmit="return formSubmitOnce(this,check_search_mnf(this))">
<tr>
  <td align=center style='padding-top:10;padding-bottom:10;' nowrap>
<?=
get_elem(create_select('url_name',"select
			IF(mn.url_name!='',mn.url_name,m.mnfID),
			IF(mn.name!='',mn.name,m.name)
		from sc_manufacturer as m
		     left join sc_manufacturer_newval as mn on mn.mnfID=m.mnfID
		order by 2",$MnfID))
?><input type=submit class=buttonH value=">">
  </td>
</tr>
</form>
</table>
</td></tr>
</table>

<script language=javascript><!--
document.forms.search_mnf.url_name.style.width=140
//-->
</script>

<?
//--------------------------------------------------/
  }
?>

<?
//-------------------------------------------------------------------------------<
?>

<?
//-----------------------------------------------\
$ModuleData=array(
	'header' => 'New Products',
	'condition' => 'p.is_new',
	'order' => 'priority,rand()',
	'block_head' => "<img src='$SITE_ROOT/img/1x1.gif' width=1 height=4 alt=''><br>"
	);
include("$ROOT_PATH/modules/products_block.php");
//-----------------------------------------------/
?>

<?
//------------------ Lists ---------------------------------\
$tmp=$CatID ? "categories like '%:$CatID:%'" : 0;
$res=db_query("select name,products from sc_list
		where active and col=0 and length(products)>2 and
			(all_pages or $tmp)");
while ($lst=@$sql_fetch_assoc($res))
  if ($prds=array_filter(call('intval',explode(':',$lst['products'])))) {
//-----------------------------------------------\
$ModuleData=array(
	'header' => $lst['name'],
	'condition' => 'p.prdID in ('.implode(',',$prds).')',
	'order' => 'priority,rand()',
	'block_head' => "<img src='$SITE_ROOT/img/1x1.gif' width=1 height=4 alt=''><br>"
	);
include("$ROOT_PATH/modules/products_block.php");
//-----------------------------------------------/
    }
//----------------------------------------------------------/
?>


<?
//-------------------------------------------------------------------------------/
?>
  </td>

  <td width=100% style='padding-left:8;padding-right:8;text-align:justify;'>
    <img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=430 height=1 alt=''><br>

<?
if ($Config['show_nav_line'] && !$IsHomePage) {
//-----------------------------------------------------\
  if ($CatID)
    if ($PrdID)
      $NavLine=getCategPathStr($CatID,1,'navline',' / ',1,0).' / '.
	($Config['show_nav_line_last'] ? to_html($Product['name']) : '');
    else
      $NavLine=getCategPathStr($CatID,0,'navline',' / ',$Config['show_nav_line_last'],0);
  else
    $NavLine=(($PageData['type']==2) ? "<a href='$SITE_ROOT/articles.html'>Articles</a> /" : '').
		(($Config['show_nav_line_last'] || $IsHomePage) ? " $NavLineTitle" : '')
?>

<div class=navline>
<? if (!$IsHomePage) { ?>
<a href='<?= $SITE_ROOT ?>/'>Home</a> /
<? } ?>
<?= $NavLine ?>
</div>
<br>

<? 
//-----------------------------------------------------/
  }
?>

<?
//---------------------------------\
if ($PageTitle) {
  if ($PageData['type']==2) $PageTitle="<a href='$SITE_ROOT/articles.html'>Articles</a> &gt; $PageTitle";
  echo "<h1>$PageTitle</h1><br>";
  }
//---------------------------------/
?>
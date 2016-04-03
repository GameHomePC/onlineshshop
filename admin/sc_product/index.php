<?
// ====================================\
  @include("_dir.php");
  $TITLE="Products";
// ====================================/

// --------------------------------------------------\
  include_once("$ROOT_PATH/modules/sc_category.php");
// --------------------------------------------------/

  $catID=(int)$catID;
  if (!$CategItems[$catID] || !$CAN_ADMIN_CATS) $catID=0;

  $lstID=(int)$lstID;
  if ($lstID<0) $lstID=0;

  if ($catID) {
// ----------------------------------------------------------------------------\
  $SCCat=$CategItems[$catID]['name'];
  $Products=array();
  $res=db_query("select prdID from sc_category_prod where catID=$catID");
  while (list($tmp)=@$sql_fetch_row($res)) $Products[]=$tmp;
  $TITLE='Products in category "'.to_html($SCCat).'" ('.sizeof($Products).'):';
// ----------------------------------------------------------------------------/
    }

  elseif ($lstID) {
// ----------------------------------------------------------------------------\
  list($lstID,$SCList,$Products)=@$sql_fetch_row(db_query("select lstID,name,products
						from sc_list where lstID=$lstID"));
  $Products=array_filter(call('intval',explode(':',$Products)));
  if ($lstID) $TITLE='Products in list "'.to_html($SCList).'" ('.sizeof($Products).'):';
// ----------------------------------------------------------------------------/
    }

  include("$ROOT_PATH/$ADMIN_DIR/common/logged_head.php");
?>


<?
// ------------------------------------\
  report_ok($OK);
// ------------------------------------/
?>


<?
//---------------------------------------------------------------------\
$s_SF=$s_SF ? 1 : 0;

if (!isset($s_cat)) $s_cat=$catID;
elseif (!isset($CategItems[$s_cat])) $s_cat=0;

$s_subcat=$s_subcat ? 1 : 0;

if (!isset($s_list)) $s_list=$lstID;
list($sel_list,$s_list)=create_select('s_list',"select lstID,name from sc_list order by 2",$s_list,0,0,
				0,0,1,"","<option value='0' selected>---------- Any ----------</option>");
$s_list=(int)$s_list;

$s_thumb=$s_thumb ? 1 : 0;

$PORTION=array(
	0 => '- All -',
	25 => '25',
	50 => '50',
	100 => '100',
	200 => '200'
	);
if (!isset($s_portion) || !$PORTION[($s_portion=(int)$s_portion)]) $s_portion=50;

$ORDER_TYPE[0]='Name';
$ORDER_TYPE[1]='Model';
$ORDER_TYPE[2]='ID';
$ORDER_TYPE[3]='Price';
if ($catID || $lstID) {
  $ORDER_TYPE[4]='In '.($catID ? 'Category' : 'List');
  }
else {
  $ORDER_TYPE[5]='Priority';
  $ORDER_TYPE[6]='Active';
  }
$ORDER_TYPE[10]='Name desc';
$ORDER_TYPE[11]='Model desc';
$ORDER_TYPE[12]='ID desc';
$ORDER_TYPE[13]='Price desc';
if ($catID || $lstID) {
  $ORDER_TYPE[14]='In '.($catID ? 'Category' : 'List').' desc';
  }
else {
  $ORDER_TYPE[15]='Priority desc';
  $ORDER_TYPE[16]='Active desc';
  }

$ORDER_VAL=array(
	0 => 'p.name,priority',
	1 => 'p.model,p.name',
	2 => 'p.prdID',
	3 => 'p.price,p.name',
	4 => ($Products ? 'p.prdID not in ('.implode(',',$Products).'),' : '').'p.name',
	5 => 'priority,p.name',
	6 => 'active desc,p.name',
	10 => 'p.name desc,priority',
	11 => 'p.model desc,p.name',
	12 => 'p.prdID desc',
	13 => 'p.price desc,p.name',
	14 => ($Products ? 'p.prdID in ('.implode(',',$Products).'),' : '').'p.name',
	15 => 'priority desc,p.name',
	16 => 'active,p.name'
	);

$s_order=(int)$s_order;
if (!$ORDER_VAL[$s_order]) $s_order=0;
//---------------------------------------------------------------------/
?>

<table border=0 cellspacing=0 cellpadding=0>
<tr valign=top>
  <td>
<?
// ============================================================================\
?>

<div class=headH>&#149; Choose category:</div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' height=5 alt=''><br>
<div class=f1 style='width:200; height:490; overflow: scroll; border: 1px solid black; padding: 3px;'>
<nobr>
<?
  foreach ($CategItems as $id=>$item) {
    $eu="catID=$catID&lstID=$lstID&s_cat=$id&s_subcat=$s_subcat&s_list=$s_list&s_portion=$s_portion&s_thumb=$s_thumb&s_order=$s_order&s_SF=$s_SF";

    if (!$id) {
	echo "<div class=bg style='padding:2'>&nbsp;<a href='./?$eu'><b class=txtB><u>ALL CATEGORIES</u></b></a></div>";
	continue;
	}

    $n=$item['n_prod_all_orig'];
    $n_act=$item['n_prod_orig'];
    $n_pas=$n-$n_act;

    $eu="catID=$catID&lstID=$lstID&s_cat=$id&s_subcat=$s_subcat&s_list=$s_list&s_portion=$s_portion&s_thumb=$s_thumb&s_order=$s_order&s_SF=$s_SF";
    $n_all=$n ?
	"<a title='$n products total' href='./?$eu'><b>$n</b></a>" :
	"<span title='0 products total'><b>0</b></span>";
    $n_act=$n_act ?
	"<a title='$n_act active products' href='./?$eu&s_active=1'>$n_act</a>" :
	"<span title='0 active products'>0</span>";
    $n_pas=$n_pas ?
	"<a title='$n_pas inactive products' style='color:#444444' href='./?$eu&s_active=2'>$n_pas</a>" :
	"<span title='0 inactive products' class=inactive>0</span>";

    $nm=to_html($item['name']);
    if (!$item['active']) $nm="<span class=inactive title='Invisible'>$nm</span>";
    if ($n) $nm="<a href='./?$eu'>$nm</a>";
    if ($s_cat==$id) $nm="<b class=bg style='padding:0 5 0 5;margin:2 0 2 0;border:1 #223344 dotted;'>$nm</b>";

    $l=$item['level']-1;
    $fn=$item['file_name'];
    echo str_repeat('&nbsp;',$l*3),($l ? '&#151; ' : '&#149; '),
	"<span class=txtB>$nm</span>&nbsp;($n_act/$n_pas/$n_all)<br>";
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
// ============================================================================\
?>
<?
// ----------------------------------------------------------------------------\

$page=(int)$page;
if (!isset($Bool[$s_new])) $s_new=0;
if (!isset($Bool[$s_attr])) $s_attr=0;
if (!isset($Bool[$s_active])) $s_active=0;
if (!isset($Bool[$s_stock])) $s_stock=0;
if (!isset($Bool[$s_im])) $s_im=0;
if (!isset($PRICE_TYPE[$s_price_type])) $s_price_type=0;

$s_keyword=trim($s_keyword);
$s_first=$s_first ? 1 : 0;
$s_in_name=$s_in_name ? 1 : 0;
$s_in_desc=$s_in_desc ? 1 : 0;
$s_in_mod=$s_in_mod ? 1 : 0;
$s_in_comm=$s_in_comm ? 1 : 0;
if ($s_keyword!=='' && !$s_in_desc && !$s_in_mod && !$s_in_comm) $s_in_name=1;

$s_keyword1=trim($s_keyword1);
$s_first1=$s_first1 ? 1 : 0;
$s_in_name1=$s_in_name1 ? 1 : 0;
$s_in_desc1=$s_in_desc1 ? 1 : 0;
$s_in_mod1=$s_in_mod1 ? 1 : 0;
$s_in_comm1=$s_in_comm1 ? 1 : 0;
if ($s_keyword1!=='' && !$s_in_desc1 && !$s_in_mod1 && !$s_in_comm1) $s_in_name1=1;

$s_price1=(double)$s_price1;
if ($s_price1<=0) $s_price1='';
$s_price2=(double)$s_price2;
if ($s_price2<=0) $s_price2='';
elseif ($s_price2<$s_price1) $s_price2=$s_price1;

$s_ID=(int)$s_ID;
if ($s_ID<1) $s_ID='';

// $s_portion setuped above
// $s_thumb setupped above
// $s_order setupped above

$end_url_wo_page="catID=$catID&lstID=$lstID&s_ID=$s_ID&s_cat=$s_cat&s_subcat=$s_subcat&s_list=$s_list&s_new=$s_new&s_attr=$s_attr&s_active=$s_active&s_stock=$s_stock&s_im=$s_im&s_price_type=$s_price_type&s_keyword=".to_url($s_keyword)."&s_first=$s_first&s_in_name=$s_in_name&s_in_desc=$s_in_desc&s_in_mod=$s_in_mod&s_in_comm=$s_in_comm&s_keyword1=".to_url($s_keyword1)."&s_first1=$s_first1&s_in_name1=$s_in_name1&s_in_desc1=$s_in_desc1&s_in_mod1=$s_in_mod1&s_in_comm1=$s_in_comm1&s_price1=$s_price1&s_price2=$s_price2&s_thumb=$s_thumb&s_order=$s_order&s_portion=$s_portion";
$end_url="$end_url_wo_page&page=$page";

//----------------------------\
$end_url_url=to_url($end_url);
//----------------------------/

$cond=array();

$cond[]="p.prdID=c.prdID";

if ($s_ID) $cond[]="p.prdID=$s_ID";
else {
//--------------------------------------\
if ($s_cat) {
  if ($s_subcat) {
    $tmp=array();
    $s_cat_tmp='_'.str_pad($s_cat,6,'0',STR_PAD_LEFT).'_';
    foreach ($CategItems as $id => $item)
      if (strpos($item['tree_info'],$s_cat_tmp)!==false) $tmp[]=$id;
    $cond[]='c.catID in ('.implode(',',$tmp).')';
    }
  else $cond[]="c.catID=$s_cat";
  }

if ($s_list) {
  $tmp=array(0)+
	@array_filter(call('intval',@explode(':',@$sql_result(db_query(
		"select products from sc_list where lstID=$s_list"),0,0))));
  $cond[]="p.prdID in (".implode(',',$tmp).")";
  }

if ($s_new==1) $cond[]="p.is_new";
elseif ($s_new==2) $cond[]="not p.is_new";

if ($s_attr==1) $cond[]="p.attributes!=''";
elseif ($s_attr==2) $cond[]="p.attributes=''";

if ($s_active==1) $cond[]="p.active";
elseif ($s_active==2) $cond[]="not p.active";

if ($s_stock==1) $cond[]="p.in_stock";
elseif ($s_stock==2) $cond[]="not p.in_stock";

if ($s_im==1) $cond[]="p.uplID1";
elseif ($s_im==2) $cond[]="!p.uplID1";

if ($s_price_type) $cond[]="(p.price_type=$s_price_type or pn.price_type=$s_price_type)";

if ($s_keyword!='') {
/*
  $s=str_replace(array('*','?'),array('%','_'),to_sql_search($s_keyword));
  $tmp=$s_first ?
	"(<%FIELD%> like '% $s%' or <%FIELD%> like '$s%' or
	  <%FIELD%> like '%\\n$s%' or <%FIELD%> like '%\\r$s%' or
	  <%FIELD%> like '%\\t$s%')" :
	"<%FIELD%> like '%$s%'";
*/
  if ($tmp=make_search_condition($s_keyword,'<%FIELD%>',2,$s_first,1,1)) {
    $tmp1=array();
    if ($s_in_name) {
	$tmp1[]=str_replace('<%FIELD%>','p.name',$tmp);
	$tmp1[]=str_replace('<%FIELD%>','pn.name',$tmp);
	}
    if ($s_in_desc) {
	$tmp1[]=str_replace('<%FIELD%>','p.description',$tmp);
	$tmp1[]=str_replace('<%FIELD%>','pn.description',$tmp);
	}
    if ($s_in_mod) $tmp1[]=str_replace('<%FIELD%>','p.model',$tmp);
    if ($s_in_comm) {
	$tmp1[]=str_replace('<%FIELD%>','p.comment',$tmp);
	$tmp1[]=str_replace('<%FIELD%>','pn.comment',$tmp);
	}
    $cond[]=$tmp1 ? '('.implode(' or ',$tmp1).')' : 0;
    }
  }

if ($s_keyword1!='') {
/*
  $s=str_replace(array('*','?'),array('%','_'),to_sql_search($s_keyword1));
  $tmp=$s_first1 ?
	"(<%FIELD%> like '% $s%' or <%FIELD%> like '$s%' or
	  <%FIELD%> like '%\\n$s%' or <%FIELD%> like '%\\r$s%' or
	  <%FIELD%> like '%\\t$s%')" :
	"<%FIELD%> like '%$s%'";
*/
  if ($tmp=make_search_condition($s_keyword1,'<%FIELD%>',2,$s_first1,1,1)) {
    $tmp1=array();
    if ($s_in_name1) {
	$tmp1[]=str_replace('<%FIELD%>','p.name',$tmp);
	$tmp1[]=str_replace('<%FIELD%>','pn.name',$tmp);
	}
    if ($s_in_desc1) {
	$tmp1[]=str_replace('<%FIELD%>','p.description',$tmp);
	$tmp1[]=str_replace('<%FIELD%>','pn.description',$tmp);
	}
    if ($s_in_mod1) $tmp1[]=str_replace('<%FIELD%>','p.model',$tmp);
    if ($s_in_comm1) {
	$tmp1[]=str_replace('<%FIELD%>','p.comment',$tmp);
	$tmp1[]=str_replace('<%FIELD%>','pn.comment',$tmp);
	}
    $cond[]=$tmp1 ? '('.implode(' or ',$tmp1).')' : 0;
    }
  }

if ($s_price1) $cond[]="p.price>=$s_price1";
if ($s_price2) $cond[]="p.price<=$s_price2";
//--------------------------------------/
  }

if ($cond=implode(' and ',$cond)) $cond="where $cond";
// ----------------------------------------------------------------------------/
?>


<script language=javascript><!--
dispSF=<?= $s_SF ? 1 : 0 ?>

function displaySF() {
  dispSF=!dispSF
  D.getElementById('id_sf').style.display=dispSF ? 'block' : 'none'
  D.getElementById('id_sf_txt').innerHTML=dispSF ? 'HIDE' : 'SHOW'
  }
//-->
</script>
<div style='border:2 #4080A0 solid;font-weight:bold;' class=bg>
&nbsp;<a href='javascript:displaySF()' style='color:206080'><span id='id_sf_txt'><?= $s_SF ? 'HIDE' : 'SHOW' ?></span> SEARCH FORM</a>&nbsp;
</div>
<div id='id_sf' style='margin-top:4;display:<?= $s_SF ? 'block' : 'none' ?>'>

<table border=0 cellspacing=0 cellpadding=1 class=border>
<form name='search_form' action='./'>
<input type=hidden name='s_SF' value="1">
<input type=hidden name='StID' value="<?= $StID ?>">
<input type=hidden name='catID' value="<?= $catID ?>">
<input type=hidden name='lstID' value="<?= $lstID ?>">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2>
<tr class=bgH>
  <td class=txtB rowspan=2 valign=baseline>Category:</td>
  <td class=bg rowspan=2>
    <?=	get_elem(create_select('s_cat',$CategItems,$s_cat,0,'makeCategItemOption3',0,0,1,"",
				"<option value='0'". (!$s_cat ? 'selected' : '').">---------- Any ----------</option>")) ?><br>
    <input type=checkbox name='s_subcat' id='s_subcat' value=1 <?= $s_subcat ? 'checked' : '' ?>><label for='s_subcat'>Include subcategories</label>

  </td>
  <td class=txtB>&nbsp;Active:</td>
  <td class=bg><?= get_elem(create_select('s_active',$Bool,$s_active)) ?></td>
  <td class=txtB nowrap>&nbsp;Have Image:</td>
  <td class=bg><?= get_elem(create_select('s_im',$Bool,$s_im)) ?></td>
</tr>
<tr class=bgH>
  <td class=txtB nowrap>&nbsp;In stock:</td>
  <td class=bg><?= get_elem(create_select('s_stock',$Bool,$s_stock)) ?></td>
  <td class=txtB nowrap>&nbsp;Have Attributes:</td>
  <td class=bg><?= get_elem(create_select('s_attr',$Bool,$s_attr)) ?></td>
</tr>
<tr class=bgH>
  <td class=txtB>List:</td>
  <td class=bg><?= $sel_list ?></td>
  <td class=txtB>&nbsp;New:</td>
  <td class=bg><?= get_elem(create_select('s_new',$Bool,$s_new)) ?></td>
  <td class=txtB nowrap>&nbsp;Spec Type:</td>
  <td class=bg><?= get_elem(create_select('s_price_type',$PRICE_TYPE,$s_price_type)) ?></td>
</tr>
<tr class=bgH>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
  <td class=bg colspan=5><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
</tr>
<tr class=bgH>
  <td class=txtB valign=baseline>Keyword 1:</td>
  <td>
	<input type=text name='s_keyword' size=28 maxlength=50 value="<?= to_html($s_keyword) ?>">
	[<a href='javascript:alert("You can use * and ? for mask")'><b>?</b></a>]<br>
	<input type=checkbox name='s_first' id='s_first' value=1 <?= $s_first ? 'checked' : '' ?>><label for='s_first'>only in start of word</label>
  </td>
  <td colspan=4 class=txt nowrap>
	<span style='width:100'><input type=checkbox name='s_in_name' id='s_in_name' value=1 <?= $s_in_name ? 'checked' : '' ?>><label for='s_in_name'>In name</label></span>
	<span style='width:100'><input type=checkbox name='s_in_desc' id='s_in_desc' value=1 <?= $s_in_desc ? 'checked' : '' ?>><label for='s_in_desc'>In description</label></span><br>
	<span style='width:100'><input type=checkbox name='s_in_mod' id='s_in_mod' value=1 <?= $s_in_mod ? 'checked' : '' ?>><label for='s_in_mod'>In model</label></span>
	<span style='width:100'><input type=checkbox name='s_in_comm' id='s_in_comm' value=1 <?= $s_in_comm ? 'checked' : '' ?>><label for='s_in_comm'>In comment</label></span>
  </td>
</tr>
<tr class=bgH>
  <td class=txtB valign=baseline>Keyword 2:</td>
  <td>
	<input type=text name='s_keyword1' size=28 maxlength=50 value="<?= to_html($s_keyword1) ?>">
	[<a href='javascript:alert("You can use * and ? for mask")'><b>?</b></a>]<br>
	<input type=checkbox name='s_first1' id='s_first1' value=1 <?= $s_first1 ? 'checked' : '' ?>><label for='s_first1'>only in start of word</label>
  </td>
  <td colspan=4 class=txt nowrap>
	<span style='width:100'><input type=checkbox name='s_in_name1' id='s_in_name1' value=1 <?= $s_in_name1 ? 'checked' : '' ?>><label for='s_in_name1'>In name</label></span>
	<span style='width:100'><input type=checkbox name='s_in_desc1' id='s_in_desc1' value=1 <?= $s_in_desc1 ? 'checked' : '' ?>><label for='s_in_desc1'>In description</label></span><br>
	<span style='width:100'><input type=checkbox name='s_in_mod1' id='s_in_mod1' value=1 <?= $s_in_mod1 ? 'checked' : '' ?>><label for='s_in_mod1'>In model</label></span>
	<span style='width:100'><input type=checkbox name='s_in_comm1' id='s_in_comm1' value=1 <?= $s_in_comm1 ? 'checked' : '' ?>><label for='s_in_comm1'>In comment</label></span>
  </td>
</tr>
<tr class=bgH>
  <td class=txtB>Price:</td>
  <td class=bg colspan=5>
	from <input type=text name='s_price1' size=5 maxlength=10 value="<?= $s_price1 ?>">
	&nbsp;
	to <input type=text name='s_price2' size=5 maxlength=10 value="<?= $s_price2 ?>">
  </td>
</tr>
<tr class=bgH>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
  <td class=bg colspan=5><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
</tr>
<tr class=bgH>
  <td class=txtB style='color:#700000'>ID:</td>
  <td class=bg colspan=5>
	<input type=text name='s_ID' size=5 maxlength=10 value="<?= $s_ID ?>">
	<i class=note1>if defined then parameters above will be ignored</i>
  </td>
</tr>
<tr class=bgH>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
  <td class=bg colspan=5><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
</tr>
<tr class=bgH>
  <td class=txtB>Per&nbsp;page:</td>
  <td class=bg><?= get_elem(create_select('s_portion',$PORTION,$s_portion)) ?></td>
  <td class=txtB><label for='s_thumb'>&nbsp;Show&nbsp;Image</label>:</td>
  <td class=bg><input type=checkbox name='s_thumb' id='s_thumb' value=1 <?= $s_thumb ? 'checked' : '' ?>></td>
  <td class=txtB>&nbsp;Order&nbsp;by:</td>
  <td class=bg><?= get_elem(create_select('s_order',$ORDER_TYPE,$s_order)) ?></td>
</tr>
<tr class=bgH>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class=bg colspan=5><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>
<tr class=bgH>
  <td>&nbsp;<input type=reset class=button value="Reset"></td>
  <td colspan=5>&nbsp;<input type=submit class=buttonH value="Search >>"></td>
</tr>
</table>
</td></tr>
</form>
</table>

</div>

<hr size=1 color=#000000>


<?
// ----------------------------------------------------------------------------\
  $query=(1 || $s_cat) ?
	"select count(DISTINCT p.prdID)
	from (sc_product as p,sc_category_prod as c)
        	left join sc_product_newval as pn on p.prdID=pn.prdID
		$cond" :
	"select count(1) from sc_product as p $cond" ;
  $num_rows=@$sql_result(db_query($query),0,0);

  $portion=$s_portion ? $s_portion : $num_rows;
  list($hbar,$lbar,$page)=make_page_bar("./?StID=$StID&$end_url_wo_page&page=",$num_rows,$page,1,0,$portion,20);

  $start=$page*$portion;
  $res=db_query("select DISTINCT p.prdID as prdID,p.name as name,
			IF(pn.prdID,pn.name,'') as new_name,
			model,
			!ISNULL(pn.prdID) as newval,
			p.active as active,p.priority as priority,
			p.price_type as price_type,p.price as price,
			p.spec_price as spec_price,
			pn.price_type as price_type_new".
			($s_thumb ?
				",p.uplID1 as uplID1,p.uplID3 as uplID3,
				CONCAT(u1.path,'/',u1.name) as image1,
				CONCAT(u2.path,'/',u2.name) as image2,
				u1.img_not_loaded as img_not_loaded1,
				u2.img_not_loaded as img_not_loaded2" : '').
		' from (sc_product as p,sc_category_prod as c)'.
		($s_thumb ? ' left join uploads1 as u1 on p.uplID1=u1.uplID left join uploads1 as u2 on p.uplID3=u2.uplID' : '').
		" left join sc_product_newval as pn on pn.prdID=p.prdID
		$cond order by {$ORDER_VAL[$s_order]}".
		($s_portion ? " limit $start,$portion" : '') );
// ----------------------------------------------------------------------------/
?>

<script language=javascript><!--
function checkUpdateG(f) {
    if (! self.allLoaded) return errorNotAllLoaded()

<? if (!$lstID && !$catID) { ?>
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
<? } ?>

  }
//-->
</script>

<div class=head>&nbsp; Products (<?= $num_rows ?>):</div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<?= $hbar ?>
<div class='txt'><?= $lbar ?></div>

<table border=0 cellspacing=0 cellpadding=1>
<tr><td class="border">
<table border=0 cellspacing=1 cellpadding=1>

<script language=javascript><!--
function selectAll(checked) {
<? if ($catID || $lstID) { ?>
  var els=D.update_group['in_object[]']
  if ('checked' in els) els.checked=checked
  else
    for (var i=0; i<els.length; i++) els[i].checked=checked
<? } else { ?>
  var els=D.update_group.elements
  var l=els.length
  for (var i=0; i<l; i++) {
    var el=els[i]
    if (el.name.indexOf('active')==0) el.checked=checked
    }
<? } ?>
  }
//-->
</script>

<form name='update_group' action='update_group.php?StID=<?= $StID ?>&catID=<?= $catID ?>&lstID=<?= $lstID ?>' method=post
	onSubmit='return formSubmitOnce(this,checkUpdateG(this))'>
<input type=hidden name='end_url' value="<?= $end_url ?>">

<tr valign=baseline class="bgH">
  <td class="txtB" align=center>N</td>
  <td class="txtB" align=center>ID</td>

<? if ($catID || $lstID) { ?>
  <td class="txtB" align=center colspan=2 nowrap>
    In <?= $catID ? 'Category' : 'List' ?>
    <div class=f1><a href='javascript:selectAll(true)'>Y</a> | <a href='javascript:selectAll(false)'>N</a> | <a href='javascript:D.update_group.reset()'>def</a></div>
  </td>
<? } else { ?>
  <td class="txtB" align=center nowrap>
    Active
    <div class=f1><a href='javascript:selectAll(true)'>Y</a> | <a href='javascript:selectAll(false)'>N</a></div>
  </td>
  <td class=txtB align=center nowrap>Order<br>
	<div class=f1 style='font-weight:normal'>(0-255)</div></td>
<? } ?>

<? if ($s_thumb) { ?>
  <td class="txtB">Image</td>
<? }?>

  <td class="txtB">Name</td>
  <td class="txtB">Model</td>
  <td class="txtB" align=center>Price</td>
  <td class="txtB" nowrap>New Values</td>
</tr>

<?
  for ($i=$start+1; $row=@$sql_fetch_array($res); $i++) {
    @extract($row);
    call('to_html',array(&$name,&$new_name,&$model));

    $price=(double)$price;
    $spec_price=(double)$spec_price;

    $spec=$price_type ? " <sup class=note1>($PRICE_TYPE[$price_type])</sup>" : '';
    $price=($price_type && $spec_price!=$price && $spec_price) ? 
	'<s>&nbsp;$'.number_format($price,2,'.',' ').'&nbsp;</s> $'.number_format($spec_price,2,'.',' ') :
	'$'.number_format($price,2,'.',' ');
    if ($price_type_new) $price.="<div class=note1><span class=f1>local type: <b>$PRICE_TYPE[$price_type_new]</b></span></div>";

    $checked='checked';
    if (!$active) {
      $checked='';
      $name="<span class=inactive>$name</span>";
      }

    if ($s_thumb) {
      $image='&nbsp;';
      if ($uplID1) {
	$image1=$img_not_loaded1 ? $image1 : "$SITE_ROOT/$image1";
	$image="<img src='$image1' width=60 height=60".
		($uplID3 ? ' style="border:1 #00BBBB solid"' : '').'>';
	}
      if ($uplID3) {
	$image2=$img_not_loaded2 ? $image2 : "$SITE_ROOT/$image2";
	$image="<a href='$image2' title=Enlarge target=_blank>$image</a>";
	}
      }
    $act=$newval ? 'Edit My Values' : 'Setup';
    echo "<tr valign=top class=bg>
	<td class=txt align=right>$i&nbsp;</td>
	<td class=txtB align=right>$prdID</td>",
	(($catID || $lstID) ?
		"<td class=bgH align=center colspan=2><input type=hidden name='prdID[]' value='$prdID'>
			<input type=checkbox name='in_object[]' value='$prdID' ".(in_array($prdID,$Products) ? 'checked' : '')."></td>" : 
		"<td class=bgH align=center><input type=checkbox name='active[$prdID]' value='1' $checked></td>
		<td class=bgH align=center><input type=text name='priority[$prdID]' size=2 maxlength=5 value='$priority'></td>"),
	($s_thumb ? "<td align=center>$image</td>" : ''),
	"<td class=txtB><a href='view.php?ID=$prdID&end_url=$end_url_url'>$name</a>$spec",
		($new_name ? "<div class=f1>Redefined: <b class=hl>$new_name</b></div>" : ''),
	"</td>
	<td class=txt align=center>$model</td>
	<td class=txt align=right nowrap>$price</td>
	<td class=txtB nowrap>&nbsp;<a href='view.php?ID=$prdID&end_url=$end_url_url'>$act</a>&nbsp;</td>
	</tr>";
    }
?>

<? if ($num_rows) { ?>
<tr class="bg">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bgH" colspan=2><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=7 alt=''></td>

<? if ($s_thumb) { ?>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
<? } ?>

  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>
<tr class="bgH">
  <td colspan=<?= $s_thumb ? 9 : 8 ?> align=left>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class=buttonH type=submit value="Submit >>"></td>
</tr>
<? } ?>

</form>

</table>
</td></tr>
</table>


<div class='txt'><?= $lbar ?></div>
<?= $hbar ?>
<?
// ============================================================================/
?>

  </td>
</tr>
</table>



<?
  include("$ROOT_PATH/$ADMIN_DIR/common/logged_tail.php");
?>

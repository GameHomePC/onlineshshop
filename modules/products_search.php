<?void();
//--------------------\
// INPUT:
// $ModuleData[
//	"page"
//	"pages_url"	 (<page> - template)
//	"head_title"
//	"catID"
//	"mnfID"
//	"condition"
//	"order"
//	"search_text"
//	"any_word"
//	"cols"
//	"rows"
//	"rand"
//	"show_desc"
//	]
//--------------------------------------/
  $need_pagebar=($ModuleData['pages_url']!='');

  $show_desc_num=$ModuleData['show_desc'] ? $Config['descr_preview_num'] : 0;

  $tmp=($ModuleData['catID'] || $view_inactive) ?
	'' : "cp.catID in ($CategItemsActKeys) and";
  $condition="p.active and $tmp
	time_available<=$TIME and cp.prdID=p.prdID".
	($ModuleData['condition'] ? " and $ModuleData[condition]" : '');

  if ($ModuleData['catID'])
    if ($CategItems[$ModuleData['catID']]['items']) {
	$tmp=array();
	$s_cat_tmp='_'.str_pad($ModuleData['catID'],6,'0',STR_PAD_LEFT).'_';
	foreach ($CategItems as $id => $item)
	  if (strpos($item['tree_info'],$s_cat_tmp)!==false) $tmp[]=$id;
	if ($tmp) $condition.=' and cp.catID in ('.implode(',',$tmp).')';
	}
    else $condition.=" and cp.catID=$ModuleData[catID]";

  if ($ModuleData['mnfID']) $condition.=" and p.mnfID=$ModuleData[mnfID]";

 //--------------------------------------------------\
  if ($text=trim($ModuleData['search_text'])) {
    $condition.=($tmp=make_search_condition($text,"IF(pn.name!='',pn.name,p.name)",($ModuleData['any_word'] ? 0 : 2))) ? " and $tmp" : ' and 0';
    // спорный вопрос надо ли автоматом добавлять поисковый текст, или делать это там, где формируется урл для страниц, но пусть пока будет
    if ($need_pagebar)
      $ModuleData['pages_url'].=((strpos($ModuleData['pages_url'],'?')===false) ? '?' : '&').'search_text='.to_url($text);
    }
 //--------------------------------------------------/

  if ($need_pagebar) {
    $num_rows=@$sql_result(db_query("select count(DISTINCT p.prdID)
			from (sc_product as p, sc_category_prod as cp)
				left join sc_product_newval as pn on p.prdID=pn.prdID
			where $condition"),0,0);
    if (!$num_rows) return;
    }

//===================================================================================\
  $Cols=$ModuleData['cols'];
  $Rows=$ModuleData['rows'];
  if (!$Cols) $Cols=$Config['img_cat_cols'] ? $Config['img_cat_cols'] : 3;
  if (!$Rows) $Rows=$Config['img_cat_rows'] ? $Config['img_cat_rows'] : 3;
  $portion=$Cols*$Rows;

  if ($need_pagebar) {
    $pages=ceil($num_rows/$portion);
    if ($ModuleData['page']<0) $ModuleData['page']=0;
    if ($ModuleData['page']>($pages-1)) $ModuleData['page']=$pages-1;
    $start=$ModuleData['page']*$portion;
    }
  else {
    $start=0;
    }
//--------------------------------------------------------\
  $group=($ModuleData['catID'] && !$CategItems[$ModuleData['catID']]['items']) ?
								'' : 'group by p.prdID';
  $tmp=$show_desc_num ?
	"IF(pn.description!='',pn.description,p.description) as description," : '';
  $res=db_query("select p.prdID as prdID,in_stock,quantity,url_name,
		price,p.price_type as price_type,spec_price,spec_time1,spec_time2,
		pn.price_type as price_type_new,
		cp.catID as catID,p.priority as priority,
		attributes,

		IF(pn.name!='',pn.name,p.name) as name,
#		IF(pn.comment!='',pn.comment,p.comment) as comment,
		$tmp

		IF(u1.uplID,u1.uplID,0) as uplID1,
		IF(u2.uplID,u2.uplID,0) as uplID2,
#		IF(u3.uplID,u3.uplID,0) as uplID3,
		IF(u1.img_not_loaded,u1.name,CONCAT(u1.path,'/',u1.name)) as fname1,
		IF(u2.img_not_loaded,u2.name,CONCAT(u2.path,'/',u2.name)) as fname2,
#		IF(u3.img_not_loaded,u3.name,CONCAT(u3.path,'/',u3.name)) as fname3,
		u1.width as width1,u1.height as height1,
		u2.width as width2,u2.height as height2,
#		u3.width as width3,u3.height as height3,
		u1.img_not_loaded as img_not_loaded1,
		u2.img_not_loaded as img_not_loaded2
#		u3.img_not_loaded as img_not_loaded3
	from (sc_product as p,sc_category_prod as cp)
	  left join sc_product_newval as pn on pn.prdID=p.prdID
	  left join uploads1 as u1 on uplID1=u1.uplID
	  left join uploads1 as u2 on uplID2=u2.uplID
#	  left join uploads1 as u3 on uplID3=u3.uplID
	where $condition 
	$group
	order by ".($ModuleData['order'] ? "$ModuleData[order]," : '').
		"p.price_type_new DESC,priority,is_new DESC".
		($ModuleData['rand'] ? ',rand()' : ',name').
	" limit $start,$portion");
  if (!$need_pagebar) {
    $num_rows=@$sql_num_rows($res);
    if (!$num_rows) return;
    }
//--------------------------------------------------------/

//------------------\
if ($need_pagebar) {
  $prv_p=($ModuleData['page'] ?
	"<a href='".str_replace('<page>',($ModuleData['page']-1),$ModuleData['pages_url'])."' class=pagebar>&lt;&lt;Previous&nbsp;Page</a>" :
	"<img src='$SITE_ROOT/img/1x1.gif' width=105 height=1 alt=''>");
  $nxt_p=($ModuleData['page']<($pages-1) ?
	"<a href='".str_replace('<page>',($ModuleData['page']+1),$ModuleData['pages_url'])."' class=pagebar>Next&nbsp;Page&gt;&gt;</a>" :
	"<img src='$SITE_ROOT/img/1x1.gif' width=82 height=1 alt=''>");
  }

$tmp=$need_pagebar ? ": $num_rows items" : '';
$pagebar_top="
<table border=0 width=100% cellspacing=0 cellpadding=0 background='$SITE_ROOT/img/left_vmenu.gif' class=pagebar>
<tr valign=middle>
<td width=0><img src='$SITE_ROOT/img/left_vmenu1.gif' alt='' width=18 height=22></td>
<td width=0 nowrap class=pagebar><nobr>$ModuleData[head_title]$tmp</nobr></td>".
((!$need_pagebar) ? '<td width=100%></td>' :
"<td align=right nowrap class=pagebar width=100%>
<form name=pagebar action='javascript:void(0)' style='margin:0'>&nbsp;
&nbsp; $prv_p &nbsp; <b>Page ".
(($pages>1) ? get_elem(create_select('page',range(1,$pages),$ModuleData['page'])) : 1).
" / $pages</b> &nbsp; $nxt_p &nbsp; &nbsp;</form></td>").
'</tr>
</table>';

if ($need_pagebar) {
//----------\
$max_pages=15;
$p=$ModuleData['page']+1;
$p1=0;
$p2=$pages+1;
if ($pages>$max_pages) {
  $p1=$p-intval(($max_pages-1)/2);
  if ($p1<1) $p1=1;
  $p2=$p1+$max_pages-1;
  if ($p2>$pages) {
    $p2=$pages;
    $p1=$p2-$max_pages+1;
    }
  $p1++;
  $p2--;
  if ($p1<3) $p1=0;
  if ($p2>($pages-2)) $p2=$pages+1;
  }

$tmp=array();
for ($i=1; $i<=$pages; $i++) {
  if ($i!=1 && $i!=$pages)
    if ($i<$p1) {
	$i=$p1-1;
	continue;
	}
    elseif($i>$p2) {
	$i=$pages-1;
	continue;
	}
  if ($i==$p1 || $i==$p2) {
    $tmp[]='<b class=pagebar>...<b>';
    continue;
    }
  $tmp[]=($i==$p) ? 
	"<b class=pagebar style='background-color:#CCDDFF;padding:0 3 1 3;'>$p</b>" :
	"<a class=pagebar href='".str_replace('<page>',($i-1),$ModuleData['pages_url'])."'><u>$i</u></a>";
  }
$tmp=implode('&nbsp; ',$tmp);

$pagebar_bottom="
<table border=0 width=100% height=22 cellspacing=0 cellpadding=0 background='$SITE_ROOT/img/left_vmenu.gif' class=pagebar>
<tr valign=middle>
<td width=0 align=left nowrap>&nbsp; $prv_p &nbsp; &nbsp;</td>
<td width=100% align=center nowrap>$tmp</td>
<td width=0 align=right nowrap>&nbsp; &nbsp; $nxt_p &nbsp;</td>
</tr>
</table>";

$pagebar_top=str_replace(array('_0.','_page0'),array('.',''),$pagebar_top);
$pagebar_bottom=str_replace(array('_0.','_page0'),array('.',''),$pagebar_bottom);
//----------/
  }
//------------------/
?>

<?= $pagebar_top ?>

<table border=0 width=100% cellspacing=0 cellpadding=1 class=border>
<tr><td>
<table border=0 width=100% cellspacing=0 cellpadding=3 class=bg>
<tr>
  <td align=left style='padding-top:10;padding-bottom:10;'>

<table border=0 cellspacing=0 cellpadding=10 width=100%>

<?
  $WidthPer=(int)(100/$Cols);
  $N=$start;
  while ($Arr=@$sql_fetch_assoc($res)) {
//---------------------------------------------------------------\
    $N++;
    extract($Arr);
    $fname1=$Arr['fname1']; $fname2=$Arr['fname2'];
    $width1=$Arr['width1']; $width2=$Arr['width2'];
    $height1=$Arr['height1']; $height2=$Arr['height2'];
    $img_not_loaded1=$Arr['img_not_loaded1']; $img_not_loaded2=$Arr['img_not_loaded2'];
//    $name=to_html($name);

    $href="$SITE_ROOT/".make_prd_url($Arr['catID'],$Arr['prdID'],$Arr['url_name'],$Arr['name']);

    list($spec,$price_str,$old_price_str)=
	make_prd_price($price,$price_type,$spec_price,$spec_time1,$spec_time2,$price_type_new);

    $price_str=($old_price_str ? '<s class=warn>$'.$old_price_str.'</s> ' : '').
		'$'.$price_str;

    $description=$show_desc_num ?
	'<div class=desc_preview>'.content_cut($description,$show_desc_num).'</div>' : '';
//-----------------------------|

    $W=300;
    $H=300;
    $width=$height=0;

    $image='';
    if ($uplID2 && ($Config['img_cat_mid'] || !$uplID1)) {
	$image=$img_not_loaded2 ? $fname2 : "$SITE_ROOT/$fname2";
	$width=$width2;
	$height=$height2;
	}
    elseif ($uplID1) {
	$image=$img_not_loaded1 ? $fname1 : "$SITE_ROOT/$fname1";
	$width=$width1;
	$height=$height1;
	}
//    else $image="$SITE_ROOT/img/1x1w.gif";

    if ($width>$W) { $height=(int)($height*$W/$width); $width=$W;}
    if ($height>$H) { $width=(int)($width*$H/$height); $height=$H;}
    if (($uplID1 || $uplID2) && (!$width || !$height)) { $width=110; $height=110; }

    if ($image) $image="<img src='$image' width=$width height=$height alt='$name' style='border:1px #0000FF solid'>";
//    if ($uplID3) $image="<a href='$SITE_ROOT/$fname3' target=_blank title='Click to Enlarge'>$image</a>";
//    $image="<a href='$href' title='".to_html($name)."'>$image</a>";

    $href1=$attributes ? $href : make_buy_url($prdID,$ModuleData['catID']);
?>

<? if (($N%$Cols)==1 || $Cols==1) echo '<tr valign=top align=center>'; ?>
<td width=<?= $WidthPer ?>%>
 <a href='<?= $href ?>'><?= $image ?><br>
 <img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=7 alt=''><br>
 <strong><?= $name ?></strong></a><br>
 <img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>
 <?= $price_str ?><br>
 <img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>
<? if ($in_stock && $quantity) { ?>
<a href="<?= $href1 ?>" rel='nofollow'><img src="<?= $SITE_ROOT ?>/img/buttons/buynow.gif" width=87 height=29 border=0 alt="Buy Now!"></a>
<? } else { ?>
<b class=warn>OUT&nbsp;</b>
<? } ?>
<br><?= $description ?><br>
</td>

<?
if (!($tmp=$N%$Cols) || $N==$num_rows) {
  if ($tmp) echo str_repeat("<td width=$WidthPer%></td>",$Cols-$tmp);
  echo '</tr>';
  }
?>

<?
//---------------------------------------------------------------/
    }
?>

</table>

  </td>
</tr>
</table>
</td></tr>
</table>


<?= $need_pagebar ? $pagebar_bottom : '' ?>

<?
  if ($need_pagebar && $pages>1) {
//---------------------------------------------------\
?>
<script language=javascript><!--
pages_url='<?= to_js($ModuleData['pages_url']) ?>'

function changePage() {
  var a=pages_url.replace('<page>',this.selectedIndex)
  a=a.replace('_0.','.')
  a=a.replace('_page0','')
  document.location.href=a
  }

if (document.forms.pagebar) {
  f=document.forms.pagebar
  if (f.pagebar)
    for (i=0; i<f.length; i++)
      el=f[i].page.onchange=changePage
  else
    f.page.onchange=changePage
  }
//-->
</script>
<?
//---------------------------------------------------/
    }

//===================================================================================/
?>

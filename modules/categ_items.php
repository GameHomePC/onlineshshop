<?void();
/* =============== Create $CategItems struct =============== */

// ------------------------------------\
  $CategItems=array(
		0 => array(
			'active' => 1,
			'name' => 'Top Level',
			'title' => 'Top Level',
			'items' => array()
			)
		);
  $CategUrlToID=array();
// ------------------------------------/

  if ($CAN_ADMIN_CATS)
    $query="select c.catID as catID,parID,
		active,priority,url_name,
		c.name as name,comment,title,c.uplID as uplID,
		n_prod,n_prod_all,last_time,has_new,
		IF(u.img_not_loaded,u.name,CONCAT(u.path,'/',u.name)) as file_name,
		u.img_not_loaded
	from sc_category as c
		left join sc_category_stat as cs on c.catID=cs.catID
		left join uploads1 as u on c.uplID=u.uplID
	order by parID,priority,c.catID";
  else
    $query="select c.catID as catID,parID,
		c.active as active,c.priority as priority,c.url_name as url_name,
		IF(cn.name!='',cn.name,c.name) as name,
		IF(cn.comment!='',cn.comment,c.comment) as comment,
		IF(cn.title!='',cn.title,c.title) as title,
		c.uplID as uplID,
		n_prod,n_prod_all,last_time,has_new,
		IF(u.img_not_loaded,u.name,CONCAT(u.path,'/',u.name)) as file_name,
		u.img_not_loaded
	from sc_category as c
		left join sc_category_stat as cs on c.catID=cs.catID
		left join uploads1 as u on c.uplID=u.uplID
		left join sc_category_newval as cn on cn.catID=c.catID
	order by parID,priority,c.catID";
  $res=db_query($query);
  while ($row=@$sql_fetch_assoc($res)) {
//    if ($ActiveCatsOnly && (!$row['active'] || !$CategItems[$row['parID']])) continue;
    $row['catID']=(int)$row['catID'];

    if ($row['url_name']=='')
      $row['url_name']=$Config['cat_name_to_url'] ? "$row[name]-c$row[catID]" : $row['catID'];
    $row['url_name']=name_to_url($row['url_name']);

    if ($row['title']=='') $row['title']=$row['name'];
    $row['items']=array();
    $row['n_prod_orig']=$row['n_prod']=(int)$row['n_prod'];
    $row['n_prod_all_orig']=$row['n_prod_all']=(int)$row['n_prod_all'];
    $row['last_time']=(int)$row['last_time'];
    $row['href']=str_replace('<Cat>',$row['url_name'],$CAT_LINK_TEMPLATE[$Config['cat_link_style']]);
    $CategItems[$row['catID']]=$row;
    $CategUrlToID[$row['url_name']]=$row['catID'];
    }
  foreach ($CategItems as $id=>$item)
    if ($id) $CategItems[$item['parID']]['items'][]=$id;



if (!function_exists('setupCategItem')) {
// ------------------------------------\
// ----------------\
function setupCategItem($id=0,$prefix='_',$active=1,$level=0) {
    global $CategItems;
  $item=&$CategItems[$id];
  if ($level) $prefix.=sprintf('%03d_%06d_',$item['priority'],$id);
  $item['tree_info']=$prefix;
  $item['active_info']=$active=($active && $item['active']) ? 1 : 0;
  $item['level']=$level;
  $n=$item['n_prod'];
  $n_all=$item['n_prod_all'];
  $t=$item['last_time'];
  $h=$item['has_new'];
  foreach ($item['items'] as $id) {
    $tmp=setupCategItem($id,$prefix,$active,$level+1);
    $n+=$tmp[0];
    $n_all+=$tmp[1];
    $t=max($t,$tmp[2]);
    $h=max($h,$tmp[3]);
    }
  return array($item['n_prod']=$n,$item['n_prod_all']=$n_all,$item['last_time']=$t,$item['has_new']=$h);
  }
// ----------------|
function categItemsCmp($a,$b) {
  $at=$a['tree_info'];
  $bt=$b['tree_info'];
  if ($at==$bt) return 0;
  return ($at>$bt) ? 1 : -1;
  }
// ----------------/
// ------------------------------------/
  }

setupCategItem();
uasort($CategItems,'categItemsCmp');

$CategItemsA=$CategItems;
$tmp=array();
foreach ($CategItemsA as $id => $item) {
  if ($id && (!$item['active_info'] || $id==1 ||
      (!$Config['show_empty_cats'] && !$item['n_prod'])))
	unset($CategItemsA[$id]);
  else {
	$tmp1=array();
	foreach ($item['items'] as $id1)
	  if ( $CategItems[$id1]['active_info'] &&
		($Config['show_empty_cats'] ||
		 $CategItems[$id1]['n_prod']) ) $tmp1[]=$id1;
	$CategItemsA[$id]['items']=$tmp1;
	if ($id) $tmp[]=$id;
	}
  }
$CategItemsActKeys=$tmp ? implode(',',$tmp) : '0';


if ($SAVE_CATEGORY_TREE_TO_FILE &&
    $f=@fopen("$ROOT_PATH/CACHE/_categ_items.php",'w')) {
  $tmp1=var_export($CategItems,1);
  $tmp2=var_export($CategItemsA,1);
  $tmp3=var_export($CategUrlToID,1);
  $tmp4=var_export($CategItemsActKeys,1);
  @fwrite($f,"<?\n\$CategItems=$tmp1;\n\n\$CategItemsA=$tmp2;\n\n\$CategUrlToID=$tmp3;\n\n\$CategItemsActKeys=$tmp4;\n?>");
//  @fwrite($f,@serialize(@compact('CategItems','CategItemsA','CategUrlToID','CategItemsActKeys')));
  @fclose($f);
  @chmod("$ROOT_PATH/CACHE/_categ_items.php",0666);
  }

?>
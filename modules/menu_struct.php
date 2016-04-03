<?void();
/* =============== Create $MenuItems struct using $EditMenu parameter =============== */

// ------------------------------------\
  $TopItems=array(
	0 => array(
		0 => '',
//		1 => "<img src='$SITE_ROOT/img/des/m0.gif' width=67 height=23 border=0 alt=''>",
//		2 => "<img src='$SITE_ROOT/img/des/m1.gif' width=138 height=23 border=0 alt=''>"
		),
	1 => array(
		0 => '',
//		1 => "<img src='$SITE_ROOT/img/des/m0a.gif' width=67 height=23 border=0 alt=''>",
//		2 => "<img src='$SITE_ROOT/img/des/m1a.gif' width=138 height=23 border=0 alt=''>"
		)
	);
// ------------------------------------/

// ------------------------------------\
  $MenuItems=array(
		0 => array(
			'static' => 1,
			'title' => '',
			'menu_title' => 'Top Level',
			'items' => array()
			)
		);
// ------------------------------------/

  $res=db_query("select menuID,parID,static,
			m.priority as priority,m.title as title,
			m.pageID as pageID,url,newwin,
			p.type as type,static_page,
			IF(url_name!='',url_name,p.pageID) as url_name,
			IF(m.title='',p.title,m.title) as menu_title,
			(p.pageID and p.active) as page_active
		from site_menu as m
			left join site_pages as p on m.pageID=p.pageID
		order by parID,priority");
  while ($row=@$sql_fetch_assoc($res)) {
    $row['items']=array();
    $MenuItems[(int)$row['menuID']]=$row;
    }

  while (list($id,$item)=each($MenuItems)) {
    if (!$id) continue;
    $pID=$item['parID'];
    $MenuItems[$pID]['items'][]=$id;
    $item['html']='&nbsp;'.to_html($item['menu_title']).'&nbsp;';
    if (!$pID) $item['html']="<nobr>$item[html]</nobr>";

    if ($EditMenu) $item['href']="$ADMIN_ROOT/menu/?ID=$id";
    else
      $item['href']=($item['url_name'] && !$item['page_active']) ?
		make_url() :
		make_url($item['static_page'],$item['url_name'],$item['type'],$item['url']);

    $item['target']=($item['newwin'] && !$EditMenu) ? "'_blank'" : "0";
    $item['linkClass']=$item['linkAttrs']="0";
    $MenuItems[$id]=$item;
    }
  reset($MenuItems);

// ------------------------------------\
if (!$MenuStructCalled) {
// ----------------\
function setupMenuItem($id=0,$prefix='_',$level=0) {
    global $MenuItems,$TopItems,$REQUEST_URI;
  $item=&$MenuItems[$id];
  if ($level) $prefix.=sprintf('%03d_%06d_',$item['priority'],$id);
  $item['tree_info']=$prefix;
  $item['level']=$level;
  $href=$item['href'];
  $b=($REQUEST_URI==$href ||
	@strpos($REQUEST_URI,"$href?")===0 ||
	@strpos($REQUEST_URI,"$href&")===0) ? 1 : 0;
  foreach ($item['items'] as $id) $b=(setupMenuItem($id,$prefix,$level+1) || $b);
  $tmp=$TopItems[$b][$item['menuID']];
  if (!$item['parID'] && $tmp) $item['html']=$tmp;
  return $b;
  }
// ----------------|
function menuItemsCmp($a,$b) {
  $at=$a['tree_info'];
  $bt=$b['tree_info'];
  if ($at==$bt) return 0;
  return ($at>$bt) ? 1 : -1;
  }
// ----------------/
}
setupMenuItem();
uasort($MenuItems,'menuItemsCmp');
// ------------------------------------/

  if ($EditMenu) {
    $MenuItems['delim']=array(
		'html' => "<div class='siteSubMenuBorder'><img src='$SITE_ROOT/img/1x1.gif' width=1 height=1 alt=''></div>",
		'href' => "",
		'target' => "0",
		'linkClass' => "0",
		'linkAttrs' => "0"
		);
    foreach ($MenuItems as $id=>$item)
      if ($item['menuID']) {
        $MenuItems["add$id"]=array(
		'html' => "&nbsp;Add Item in Submenu&nbsp;",
		'href' => "$ADMIN_ROOT/menu/?ID=$id&add=1",
		'target' => "0",
		'linkClass' => "'siteMenuItemAdd'",
		'linkAttrs' => "0"
		);
        $item['items'][]='delim';
        $item['items'][]="add$id";
        if (!$item['static']) {
          $MenuItems["del$id"]=array(
		'html' => "&nbsp;Delete This Item&nbsp;",
		'href' => "$ADMIN_ROOT/menu/delete.php?ID=$id",
		'target' => "0",
		'linkClass' => "'siteMenuItemDel'",
		'linkAttrs' => "'onClick=\"return makeSure()\"'"
		);
          $item['items'][]='delim';
          $item['items'][]="del$id";
          }
        $MenuItems[$id]=$item;
        }
    }


// ============================================================================\

if (!$MenuStructCalled) {
// ----------------\
// ------------------------------------\
function makeItemOption($row,$skipTop=0) {
//  $skipTop=1;
  list($id,$item)=$row;
  if (!is_int($id) || ($skipTop && !$id)) return array();
  $l=$item['level']-($skipTop ? 1 : 0);
//  $l=$item['level']-1;
  if ($l<0) $l=0;
  return array(
	0 => $id,
	1 => str_repeat(' ',$l*5).($l ? '— ' : '').$item['menu_title']
	);
  }
// ------------------------------------/

// ------------------------------------\
function makeItemOption2($row) {
  $res=makeItemOption($row,1);
  if ($row[1]['pageID'] || $row[1]['url']!='') $res[1].=' [taked]';
  return $res;
  }
// ------------------------------------/
// ----------------/
}

// ============================================================================/


// ------------------------------------\
  $MenuStructCalled=1;
// ------------------------------------/
?>

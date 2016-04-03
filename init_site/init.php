<?void();
/* ---!!! NO ANY SYMBOLS ("CR","SPACE",...) BEFORE "<?" OR AFTER "?>" !!!--- */


// ----------\
// Constants
// ----------------------------------------------------------------------------\
$CookieExp=0x7FFFFFFF;

$NA='no data';
$NA_STR='---------- n/a ----------';

$BOOL=array(
	'name' => array($NA,'yes','no'),
	'abbr' => array('n/a','+','-')
	);

$Bool=array(
	0 => ' ',
	1 => 'Yes',
	2 => 'No'
	);

list($Year,$Month,$Day,$Hour)=$Date=call('intval',explode('-',site_date('Y-m-d-G')));

$YEAR=array();
for ($i=2000; $i<=$Year+5; $i++) $YEAR[$i]=$i;

$MONTH=array(
	'num' => array(1=>'01',2=>'02',3=>'03',4=>'04',5=>'05',6=>'06',
			7=>'07',8=>'08',9=>'09',10=>'10',11=>'11',12=>'12'),
	'name' => array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',
			7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December'),
	'abbr' => array(1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',
			7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec'),
	'size' => array(1=>31,2=>28,3=>31,4=>30,5=>31,6=>30,
			7=>31,8=>31,9=>30,10=>31,11=>30,12=>31)
	);

$WEEKDAY=array(
	'name' => array(1=>'Monday',2=>'Tuesday',3=>'Wednesday',4=>'Thursday',5=>'Friday',6=>'Saturday',0=>'Sunday'),
	'abbr' => array(1=>'Mon',2=>'Tue',3=>'Wed',4=>'Thu',5=>'Fri',6=>'Sat',0=>'Sun')
	);

$DAY=range(0,31);
  unset($DAY[0]);


$IMG_EXT_LIST=array('.gif','.jpg','.jpeg','.jpe','.png');
// ----------------------------------------------------------------------------/


// ===============\
// User constants
// ============================================================================\

$PAGE_TYPE=array(
	0 => 'Static (functional) pages',
	1 => 'Dynamic (information) pages',
	2 => 'Article'
	);

$CHARSET=array(
	'w' => 'Windows-1251',
	'k' => 'KOI8-R',
	'i' => 'ISO8859-5',
	'm' => 'Mac',
	'd' => 'DOS'
	);

// ============================================================================/

/*
$ATTRIBUTE_TYPE=array(
	0 => "Required",
	1 => "Optional",
	2 => "Multiple"
	);
$DISCOUNT_TYPE=array(
	0 => '%',
	1 => '$'
	);
*/

$PRICE_TYPE=array(
	0 => ' ',
	1 => 'Specials',
	2 => 'Featured'
	);

$CAT_LINK_STYLE=array(
	0 => '/<CatUrlNameOrID>',
	1 => '/<CatUrlNameOrID>/',
	2 => '/<CatUrlNameOrID>.html',
	3 => '/<CatUrlNameOrID>/index.html',
	4 => '/category_<CatUrlNameOrID>',
	5 => '/category_<CatUrlNameOrID>/',
	6 => '/category_<CatUrlNameOrID>.html',
	7 => '/category_<CatUrlNameOrID>/index.html',
	8 => '/categories/<CatUrlNameOrID>',
	9 => '/categories/<CatUrlNameOrID>/',
	10 => '/categories/<CatUrlNameOrID>.html',
	11 => '/categories/<CatUrlNameOrID>/index.html'
	);

$CAT_LINK_TEMPLATE=array(
	0 => '<Cat>',
	1 => '<Cat>/',
	2 => '<Cat>.html',
	3 => '<Cat>/index.html',
	4 => 'category_<Cat>',
	5 => 'category_<Cat>/',
	6 => 'category_<Cat>.html',
	7 => 'category_<Cat>/index.html',
	8 => 'categories/<Cat>',
	9 => 'categories/<Cat>/',
	10 => 'categories/<Cat>.html',
	11 => 'categories/<Cat>/index.html'
	);

$PRD_LINK_STYLE=array(
	0 => '/product_<PrdUrlNameOrID>.html',
	1 => '/products/<PrdUrlNameOrID>.html',
	2 => '/<CatUrlNameOrID>/<PrdUrlNameOrID>.html',
	3 => '/category_<CatUrlNameOrID>/<PrdUrlNameOrID>.html',
	4 => '/categories/<CatUrlNameOrID>/<PrdUrlNameOrID>.html'
	);

$PRD_LINK_TEMPLATE=array(
	0 => 'product_<Prd>.html',
	1 => 'products/<Prd>.html',
	2 => '<Cat>/<Prd>.html',
	3 => 'category_<Cat>/<Prd>.html',
	4 => 'categories/<Cat>/<Prd>.html'
	);

$FIRST_PAGE_PRODS=array(
	0 => ' ',
	1 => 'Specials Products',
	2 => 'Featured Products',
	3 => 'Bestsellers',
	4 => 'New Products'
	);
$FIRST_PAGE_PRODS_INIT=array(
	1 => array(
		'title' => 'Specials Products',
		'condition' => "((p.price_type=1 and spec_time1<=$TIME and
				(!spec_time2 or spec_time2>=$TIME)) or pn.price_type=1)",
		'order' => '',
		'rand' => 0
		),
	2 => array(
		'title' => 'Featured Products',
		'condition' => "((p.price_type=2 and spec_time1<=$TIME and
				(!spec_time2 or spec_time2>=$TIME)) or pn.price_type=2)",
		'order' => '',
		'rand' => 0
		),
	3 => array(
		'title' => 'Bestsellers',
		'condition' => '',
		'order' => 'p.num_choosed desc',
		'rand' => 0
		),
	4 => array(
		'title' => 'New Products',
		'condition' => 'is_new',
		'order' => '',
		'rand' => 0
		)
	);

$LEFT_MENU_STYLE=array(
	0 => 'DHTML Menu',
	1 => 'Usual Menu'
	);

$LIST_COLUMN=array(
	0 => 'Left',
	1 => 'Right'
	);

?>
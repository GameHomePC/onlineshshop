<?void();
/* -----!!! NO SYMBOLS ("CR","SPACE", ...) BEFORE "<?" OR AFTER "?>" !!!----- */

function session_register1() {
	session_start();
	foreach (func_get_args() as $name) {
		if (isset($_SESSION[$name])) $GLOBALS[$name]=&$_SESSION[$name];
		else $_SESSION[$name]=&$GLOBALS[$name];
		}
	}

//----------------------------------------------------------------------\
$CAN_ADMIN_CATS=(int)$Config['not_export_cats'];
$SC_SITE_URL=str_replace('https://','http://',trim($PARENT_URL,'/'));
if (!strpos($SC_SITE_URL,'://')) $SC_SITE_URL="http://$SC_SITE_URL";
$SC_SITE_SECURE_URL=str_replace('http://','https://',$SC_SITE_URL);
if ($HTTPS) $SC_SITE_URL=$SC_SITE_SECURE_URL;
$SHOP_ID=(int)$Config['shop_id'];
$NO_EXTERNAL=(int)$Config['no_external'];
$SAVE_CATEGORY_TREE_TO_FILE=($Config['https_site_folder']=='') ?
	$SAVE_CATEGORY_TREE_TO_FILE : 0;
//----------------------------------------------------------------------/


include_once("$ROOT_PATH/init_site/init.php");
include_once("$ROOT_PATH/init_site/attributed_form.php");
include_once("$ROOT_PATH/init_site/external.php");


//-----------------------------------------------------------\
if (!$SESSION_START_DISABLE && $_REQUEST[session_name()])
  session_start();

/*
$SHOPXML_SESSION=$_SESSION['SHOPXML_SESSION'];
$SHOPXML_SESSION_COPY=$_SESSION['SHOPXML_SESSION_COPY'];
$CUSTOMER_ID=$SHOPXML_SESSION ? $_SESSION['CUSTOMER_ID'] : 0;
$SC_QUANTITY=$SHOPXML_SESSION ? $_SESSION['SC_QUANTITY'] : 0;
$DISCOUNT_ID=$SHOPXML_SESSION ? $_SESSION['DISCOUNT_ID'] : '';
*/

if (!$_SESSION['SHOPXML_SESSION']) {
  $_SESSION['SHOPXML_SESSION']=$_SESSION['SHOPXML_SESSION_COPY']='';
  $_SESSION['CUSTOMER_ID']=$_SESSION['SC_QUANTITY']=$_SESSION['SC_PRICE']=0;
  $_SESSION['DISCOUNT_ID']='';
  }
$SHOPXML_SESSION=&$_SESSION['SHOPXML_SESSION'];
$SHOPXML_SESSION_COPY=&$_SESSION['SHOPXML_SESSION_COPY'];
$CUSTOMER_ID=&$_SESSION['CUSTOMER_ID'];
$SC_QUANTITY=&$_SESSION['SC_QUANTITY'];
$SC_PRICE=&$_SESSION['SC_PRICE'];
$DISCOUNT_ID=&$_SESSION['DISCOUNT_ID'];
//-----------------------------------------------------------/

//------------------------------------\
unset($RedirectUrl);
$CheckPageExisting=1;
$view_inactive=$view_inactive ? 1 : 0;
//------------------------------------/


//=====================================================================================\
//       Functions        /
//=======================/

// ------------------------------------\
function win2koi($str) {
  return $str;//convert_cyr_string($str,'w','k');
  }
function header_encode($str,$charset='iso-8859-1') {
  $str=trim($str);
  return ($str=='') ? '' : "=?$charset?b?".base64_encode($str).'?=';
  }
// ------------------------------------/


function make_buy_url($prdID,$continueCat=0) {
  global $URL_HEADER,$SITE_ROOT,$SC_SITE_URL,$SHOP_ID,$NO_EXTERNAL,$CategItems;

  if ($NO_EXTERNAL)
    return "$SC_SITE_URL/sc/order.php?shop=$SHOP_ID&product=$prdID".
	($continueCat ? "&return_url=".to_url("$URL_HEADER/{$CategItems[$continueCat][href]}") : '');
  else
    return "$SITE_ROOT/buy.html?product=$prdID".
	($continueCat ? "&continueCat=$continueCat" : "");
  }


function make_url($static_page='',$pageID=0,$type=0,$url='',$url_header='') {
  global $SITE_ROOT,$ADMIN_ROOT;

  if ($url_header=='') $url_header=$SITE_ROOT;

  if ($pageID)
    $ret_url="$url_header/".($type ? "page_$pageID.html" : str_replace(array('.php','.phtml'),'.html',$static_page));
  elseif ($url!='')
    $ret_url=(strpos($url,'://')) ? $url : "$url_header/".ltrim(str_replace(array('.php','.phtml'),'.html',$url),'/');
  else
    $ret_url='javascript:void(0)';

  return $ret_url;
  }


function sc_category_stat() {
  db_query("delete from sc_category_stat");
  db_query("insert into sc_category_stat (catID,n_prod,n_prod_all,last_time,has_new)
		select cp.catID,sum(active),count(1),max(time_available),max(p.is_new)
		from sc_category_prod as cp
			inner join sc_product as p on cp.prdID=p.prdID
		group by catID");
  }


function make_prd_price($price,$price_type=0,$spec_price=0,$spec_time1=0,$spec_time2=0,$price_type_new=0) {
  global $TIME,$Config;

  $price=(double)$price;
  $spec_price=(double)$spec_price;

  $spec=($price_type && $spec_time1<=$TIME && (!$spec_time2 || $spec_time2>=$TIME));
  $old_price_str='';

  $price_str=number_format($price,2,'.',' ');
  if ($spec && $spec_price) {
    if ($price>$spec_price) $old_price_str=$price_str;
    $price_str=number_format($spec_price,2,'.',' ');
    }
  elseif ($price_type_new==1) {
    $perc=$Config['additional_percent'];
    if ($perc<1) $perc=1;
    $old_price_str=number_format($price*(100+$perc)/100,2,'.',' ');
    }
  $price_str=str_replace(' ','&nbsp;',$price_str);
  $old_price_str=str_replace(' ','&nbsp;',$old_price_str);

  return array(($spec ? $price_type : 0),$price_str,$old_price_str);
  }


function check_url_name($str,$undAllowed=0,$slashAllowed=0,$psetAllowed=0) {
  if (check_int($str)!==false || to_lower($str)=='index') return false;
  $l=strlen($str);
  if ($l>0 && ($str[0]=='/' || $str[$l-1]=='/')) return false;
  for ($i=0; $i<$l; $i++) {
    $ch=$str[$i];
    if (($ch<'0' || $ch>'9') && ($ch<'A' || $ch>'Z') &&
	($ch<'a' || $ch>'z') && ($ch!='-') && 
	!($ch=='/' && $slashAllowed) && !($ch=='_' && $undAllowed) &&
	!($ch=='.' && $psetAllowed)) return false;
    }
  return true;
  }


function name_to_url($name) {
  return to_lower(trim(preg_replace("/([^\w\d]|_)+/",'-',$name),'-'));
  }


function make_prd_url($catID,$prdID,$prd_url_name='',$name='') {
  global $Config,$PRD_LINK_TEMPLATE,$CategItems;

  $cat=$CategItems[$catID]['url_name'];

  if ($prd_url_name=='')
    $prd=($Config['prd_name_to_url'] && $name!='') ? "$name-p$prdID" : $prdID;
  else $prd=$prd_url_name;
  $prd=name_to_url($prd);

  return str_replace(array('<Cat>','<Prd>'),array($cat,$prd),
		$PRD_LINK_TEMPLATE[$Config['prd_link_style']]);
  }


function content_cut($str,$maxlen=0,$suffix='...') {
    global $SITE_ROOT;
  $str=preg_replace('/\s+/',' ',
		trim(strip_tags(str_replace(
			array('{BASE}','&nbsp;'),
			array($SITE_ROOT,' '),
			$str))));
  if ($maxlen && strlen($str)>$maxlen) {
    $str=substr($str,0,$maxlen+1);
    if ($i=strrpos($str,' ')) $str=substr($str,0,$i);
    $str=rtrim($str,'.,;:!?').$suffix;
    }
  return $str;
  }


//-----------------------------------------------------------------------------------\
// what = 0 - любое слово
//        1 - все слова (учитывать порядок)
//        2 - все слова (не учитывать порядок)
//        3 - точную фразу
//-----------------------------------------------------------------------------------|
// http://www.abcteach.com/abclists/prepositions.htm

function make_search_condition($text,$fields,
		$what=2,$start_word=1,$strip_end_s=1,$min_length=2) {
  static $PREPOSITIONS=array('a','an','the','and','at','by','for','in',
		'from','to','into','of','off','on','onto','with');

  if (($text=trim($text))=='') return '';
  if (is_string($fields)) $fields=array($fields);
  if (($what=(int)$what)<0 || $what>3) $what=0;
  if (($min_length=(int)$min_length)<1) $min_length=3;
  $max_length=$min_length-1;

  $text=' '.preg_replace('/\s+/','        ',$text).' ';
  if ($what!=3) {
    if ($strip_end_s) $text=preg_replace('/\s(\S{3,})s\s/','\1',$text);
    if ($max_length) $text=preg_replace('/\s\S{1,'.$max_length.'}\s/',' ',$text);
    }
  if (($text=trim($text))=='') return '';  

  $Regs=explode(' ',preg_quote(preg_replace('/\s+/',' ',$text)));
/*
  $text=preg_quote(preg_replace('/\s+/',' ',$text));
  $l=strlen($text);
  $tmp='';
  for ($i=0; $i<$l; $i++)
    $tmp.=(($text[$i]>='a' && $text[$i]<='z') || ($text[$i]>='A' && $text[$i]<='Z')) ?
		'['.to_lower($text[$i]).to_upper($text[$i]).']' : $text[$i];
  $Regs=explode(' ',$tmp);
//-------------------------<
  $Regs=explode(' ',preg_quote(preg_replace('/\s+/',' ',
	($what==3 || !$max_length) ? $text :
		trim(preg_replace('/\s\S{1,'.$max_length.'}\s/',' '," $text ")) )));
*/

  if ($what!=3)
    foreach ($Regs as $k => $v)
      if (@in_array(to_lower($v),$PREPOSITIONS)) unset($Regs[$k]);

  $regs=array();
  $ld='[[:<:]]';
  $rd=($start_word ? '[[:alnum:]]*' : '').'[[:>:]]';
  if ($what==0) $regs[]="$ld(".implode('|',$Regs).")$rd";
  elseif ($what==1) $regs[]=$ld.implode("$rd.*$ld",$Regs).$rd;
  elseif ($what==3) $regs[]=$ld.implode("$rd([[:space:]]|[[:punct:]])*$ld",$Regs).$rd;
  else // if ($what==2)
    foreach ($Regs as $tmp) $regs[]="$ld$tmp$rd";

  $ld="<%FIELD%> rlike '"; $rd="'";
  $tmp="($ld".implode("$rd and $ld",call('to_sql',$regs))."$rd)";

  foreach ($fields as $i => $field)
    $fields[$i]=str_replace('<%FIELD%>',$field,$tmp);

  return '('.implode(' or ',$fields).')';
  }
//-----------------------------------------------------------------------------------/

//=====================================================================================/
?>
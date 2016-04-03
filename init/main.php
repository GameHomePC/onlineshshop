<?
/* -----!!! NO SYMBOLS ("CR","SPACE", ...) BEFORE "<?" OR AFTER "?>" !!!----- */

// ============================================================================\
if ($ALREADY_INCLUDED) return;
$ALREADY_INCLUDED=1;
// ============================================================================/

if (isset($_REQUEST['ROOT_PATH']) || !isset($ROOT_PATH)) exit;
function void() {};

// ============================================================================\
ignore_user_abort(1);
//set_time_limit(180);

error_reporting(0
	+ E_ERROR
	+ E_WARNING
	+ E_PARSE
//	+ E_NOTICE
	+ E_CORE_ERROR
	+ E_CORE_WARNING
	);

$GPC_MAGIC_AUTO_STRIP=1;
// ============================================================================/




include_once("$ROOT_PATH/init/init.php");

include_once("$ROOT_PATH/init/data.php");
include_once("$ROOT_PATH/init/http.php");
include_once("$ROOT_PATH/init/db.php");
include_once("$ROOT_PATH/init/upload.php");
include_once("$ROOT_PATH/init/special.php");
include_once("$ROOT_PATH/init/report.php");

if ($SESSION_DB) { include_once("$ROOT_PATH/init/session.php"); }



$tmp=ini_get('register_globals');
if ($tmp===false || $tmp==='') $tmp=get_cfg_var('register_globals');
if ($tmp==='0' || $tmp=='off' || $tmp=='false' || $tmp=='') {
//===========================================\
  if (is_array($_GET)) extract($_GET);
  if (is_array($_POST)) extract($_POST);
  if (is_array($_COOKIE)) extract($_COOKIE);
  if (is_array($_SESSION)) extract($_SESSION);
  if (is_array($_SERVER)) extract($_SERVER);
  if (is_array($_ENV)) extract($_ENV);

  if (is_array($_FILES))
    foreach($_FILES as $var => $val) {
	${$var.'_name'}=$val['name'];
	${$var.'_type'}=$val['type'];
	${$var.'_error'}=$val['error'];
	${$var.'_size'}=$val['size'];
	$$var=$val['tmp_name'];
	}
//===========================================/
  }


// ----------------------------------------------------------------------------\
  db_connect();
  $Config=@$sql_fetch_assoc(@$sql_query("select * from config limit 1"));
  $SERVER_MAIL_FROM='"'.$Config['site_name'].'" <mailrobot'.strrchr($Config['contact_email'],'@').'>';
// ----------------------------------------------------------------------------/


// ======================\
// Some needed variables
// ============================================================================\

$SECURE_PROTOCOL=$Config['use_https'] ? 'https:' : $USUAL_PROTOCOL;

$REFERER=&$HTTP_REFERER;
$QUERY=&$QUERY_STRING;

$CLIENT_IP=get_client_ip();
$CLIENT_HOST=@gethostbyaddr($CLIENT_IP);


// ------------------------------------\
$DATE_FORMATS=array("d.m.Y","m.d.Y");
$TIME_FORMATS=array("d.m.Y - H:i","m.d.Y - H:i");

$DATE_FMT=$DATE_FORMATS[$DATE_FORMAT];
$TIME_FMT=$TIME_FORMATS[$DATE_FORMAT];
// ------------------------------------/


// -------------------------\
// WEB-server configuration
// ------------------------------------\
$SECURE_ACCESS=($HTTPS=="on");

if (!$MAIN_DOMAIN) $MAIN_DOMAIN=$HTTP_HOST; //$SERVER_NAME;

$CURRENT_PROTOCOL=$SECURE_ACCESS ? $SECURE_PROTOCOL : $USUAL_PROTOCOL;

if (!$USUAL_SERVER_NAME) $USUAL_SERVER_NAME=$HTTP_HOST; //$SERVER_NAME;
if (!$SECURE_SERVER_NAME) $SECURE_SERVER_NAME=$HTTP_HOST; //$SERVER_NAME;

$CURRENT_PORT=$SECURE_ACCESS ? $SECURE_PORT : $USUAL_PORT;

$SITE_ROOT=$SECURE_ACCESS ? $SECURE_SITE_ROOT : $USUAL_SITE_ROOT;

$ADMIN_ROOT="$SITE_ROOT/$ADMIN_DIR";
$USER_ROOT="$SITE_ROOT/$USER_DIR";

$USUAL_URL_HEADER="$USUAL_PROTOCOL//$USUAL_SERVER_NAME$USUAL_PORT$USUAL_SITE_ROOT";
$SECURE_URL_HEADER="$SECURE_PROTOCOL//$SECURE_SERVER_NAME$SECURE_PORT$SECURE_SITE_ROOT";
//$URL_HEADER="$CURRENT_PROTOCOL//$SERVER_NAME$CURRENT_PORT$SITE_ROOT";
$URL_HEADER="$CURRENT_PROTOCOL//$HTTP_HOST$CURRENT_PORT$SITE_ROOT";
// ------------------------------------/

// ------------------------------------\
if ($CHECK_WWW_SUBDOMAIN) {
  $Host=to_lower($HTTP_HOST);
  $is_www=(strpos($Host,'www.')===0);
  $host='';
  if ($CHECK_WWW_SUBDOMAIN==1 && !$is_www) $host="www.$Host";
  elseif ($CHECK_WWW_SUBDOMAIN==2 && $is_www) $host=substr($Host,4);
  if ($host!='') {
    header("Location: $CURRENT_PROTOCOL//$host$REQUEST_URI");
    header("HTTP/1.0 301 Moved Permanently");
    exit;
    }
  }
// ------------------------------------/

// ------------------------------------\
$tmp=$PATH_TRANSLATED ? str_replace("\\","/",$PATH_TRANSLATED) : $SCRIPT_FILENAME;

$PATH=dirname($tmp);
$SERVER_ROOT=substr($tmp,0,-strlen($PHP_SELF)).$SITE_ROOT;
// ------------------------------------/


// ------------------------------------\
$TIME=time()+$SERVER_TIME_CORRECTION;

$SERVER_GMT=(int)date("Z",86400);
if (is_string($GMT)) $GMT=$SERVER_GMT;
$GMT_DIFF=$GMT-$SERVER_GMT;

$tmp=call('intval',explode('-',site_date('d-m-Y')));
$TODAY=mktime(0,0,0,$tmp[1],$tmp[0],$tmp[2])-$GMT_DIFF;
// ------------------------------------/


// -------------------\
// For Russion Apache
// ------------------------------------\
$CHARSET_SYMBOL=array(
	"windows-1251"	=> "w",
	"koi8-r"	=> "k",
	"koi8-u"	=> "k",
	"ibm866"	=> "a",
	"ISO-8859-5"	=> "i",
	"x-mac-cyrillic"=> "m"
	);
$CLIENT_CHARSET=$CHARSET_SYMBOL[$CHARSET];
$NEED_RECODE=($SERVER_CAN_RECODE &&
	      $CLIENT_CHARSET!="" &&
	      $CLIENT_CHARSET!=$SERVER_CHARSET);
// ------------------------------------/

// ============================================================================/




// ==========\
// Functions
// ============================================================================\

// --------------\
// Get microtime
// ----------------------------------------------------------------------------\
function get_microtime() { 
  list($mcs,$sec)=explode(' ',microtime()); 
  return ((float)$mcs+(float)($sec+$GLOBALS['SERVER_TIME_CORRECTION']));
  } 
// ----------------------------------------------------------------------------/

// ----------\
// Make seed
// ----------------------------------------------------------------------------\
function make_seed() { 
  list($mcs,$sec)=explode(' ',microtime()); 
  return ((float)$mcs*1000000+(float)$sec);
  } 
// ----------------------------------------------------------------------------/


// ----------------------------------------------------------\
// Strip (if needed) all added by PHP slashes in global vars
// ----------------------------------------------------------------------------\
$GPC_MAGIC_STRIPPED=0;

function gpc_magic_strip() {
    global $GPC_MAGIC_STRIPPED,$VARS_ORDER;
  if (!get_magic_quotes_gpc() || $GPC_MAGIC_STRIPPED) return;
  $GPC_MAGIC_STRIPPED=1;

  $tmp=get_cfg_var("variables_order");
  $tmp=$tmp ? $tmp : get_cfg_var("gpc_order");
  $VARS_ORDER=strtoupper($tmp ? $tmp.'S' : "GPCS");

  $vars=array(
	"E" => &$_ENV,
	"G" => &$_GET,
	"P" => &$_POST,
	"C" => &$_COOKIE,
	"S" => &$_SERVER
	);
  $http_vars="GPC";
  $HTTP_VARS=array();

  $l=strlen($VARS_ORDER);
  for ($i=0; $i<$l; $i++) {
    $ch=$VARS_ORDER[$i];
    $var=&$vars[$ch];
    if (is_int(strpos($http_vars,$ch)))
      while (list($k,$v)=each($var))
	if (is_array($v)) {
	  $HTTP_VARS[$k]=array();
	  while (list($k1,$v1)=each($v))
	      if (is_array($v1)) {
		$HTTP_VARS[$k][$k1]=array();
		while (list($k2,$v2)=each($v1))
		    if (is_array($v2)) $HTTP_VARS[$k][$k1][$k2]=call("stripslashes",$v2);
		    else $HTTP_VARS[$k][$k1][$k2]=stripslashes($v2);
	  	}
	      else $HTTP_VARS[$k][$k1]=stripslashes($v1);
	  }
	else $HTTP_VARS[$k]=stripslashes($v);
    else
      while (list($k)=each($var)) unset($HTTP_VARS[$k]);
    }
  while (list($k,$v)=each($HTTP_VARS)) $GLOBALS[$k]=$v;
  }
// ----------------------------------------------------------------------------/

//=============================================================================/


// ============================================================================\
if ($GPC_MAGIC_AUTO_STRIP) gpc_magic_strip();

session_set_cookie_params(0,"$SITE_ROOT/");

$tmp=make_seed();
srand($tmp);
mt_srand($tmp);
// ============================================================================/


// =============================================\
  $PHP_SELF=preg_replace('#/+#','/',$PHP_SELF);
  $args=explode('_',$args);
  array_shift($args);
// =============================================/


include_once("$ROOT_PATH/init_site/main.php");


// ------------------------------------\
if ($Site_modules)
  while (list(,$src)=each($Site_modules))
    if ($src) { include_once($src); }
// ------------------------------------/

?>
<?void();
/* -----!!! NO SYMBOLS ("CR","SPACE", ...) BEFORE "<?" OR AFTER "?>" !!!----- */
/*
// ============================================================================\

Date format:
	format=0 - dd.mm.yyyy
	format=1 - mm.dd.yyyy

Functions:
	call()		// (<function>,<parameters>)
	get_elem($arr,$num=0)
	to_html($str)
	to_js($str)
	to_sql($str)
	to_sql_search($str)
	to_url($str)
	to_upper($str)
	to_lower($str)
	check_int($str)
	check_hex_int($str)
	check_float($str)
	check_zip($str)
	check_email($str)
	get_date($str,$format=-1)
	get_time($str)
	cmp_date($str1,$str2,$format=-1)
	cmp_time($str1,$str2)
	site_date($format_str,$timestamp=-1)
	get_date_str($timestamp=-1,$format=-1)
	get_time_str($timestamp=-1)

// ============================================================================/
*/


// ================\
// Data converting
// ============================================================================\

// --------------------------------------\
// Apply specified function to arguments
//   if 2'nd argument is an array, its elements replace arguments
//   it's a way to apply function to arguments by their references
//   (See also "allow_call_time_pass_reference" in php.ini)
// Examples:
//   list($c1)=call("intval",$a1);
//   list($c2,$c3)=call("htmlspecialchars",$b2,$b3);
//   call("htmlspecialchars",array(&$b2,&$b3));
// ------------------------------------\
function call() {
  if (func_num_args()<2) return false;
  $argv=func_get_args();
  $func=array_shift($argv);
  if (is_array($argv[0])) $argv=$argv[0];
  reset($argv);
  while (list($k,$v)=each($argv)) $argv[$k]=$func($v);
  reset($argv);
  return $argv;
  }
// ------------------------------------/


// -----------------------\
// Get element from array
// ------------------------------------\
function get_elem($arr,$num=0) {
  return $arr[$num];
  }
// ------------------------------------/


// ----------------------------------------------\
// Escape special chars to export string to HTML
// ------------------------------------\
function to_html($str) {
  return htmlspecialchars($str,ENT_QUOTES);
  }
// ------------------------------------/


// --------------------------------------------\
// Escape special chars to export string to JS
// ------------------------------------\
function to_js($str) {
  return addcslashes(addslashes($str),"\n\r");
  }
// ------------------------------------/


// -----------------------------------------\
// Escape special chars for working with DB
// ------------------------------------\
function to_sql($str) {
  return ($GLOBALS["SQL_PREFIX"]=="mssql") ?
	str_replace("\0","'+CHAR(0)+'",str_replace("'","'+CHAR(39)+'",$str)) :
	addslashes($str);
  }
// ------------------------------------/


// -----------------------------------------\
// Escape special chars for searching in DB
// (For MSSQL "escape '\'" must be present right afrer "like '...'"
// ------------------------------------\
function to_sql_search($str) {
    global $SQL_PREFIX;
  return ($SQL_PREFIX=="mssql") ?
	addcslashes(to_sql($str),"%_[]\\") :
	addcslashes(to_sql($str),"%_");
  }
// ------------------------------------/


// --------------------------------------------\
// Escape special symbols for working with URL
// ------------------------------------\
function to_url($str) {
    global $NEED_RECODE,$SERVER_CHARSET,$CLIENT_CHARSET;
  if ($NEED_RECODE) $str=convert_cyr_string($str,$SERVER_CHARSET,$CLIENT_CHARSET);
  return rawurlencode($str);
  }
// ------------------------------------/


// ----------------------\
// Convert to upper case
// ------------------------------------\
function to_upper($str) {
  return strtoupper($str);
  }
// ------------------------------------/


// ------------------------\
// Convert to lower case
// ------------------------------------\
function to_lower($str) {
  return strtolower($str);
  }
// ------------------------------------/

// ============================================================================/




// ==============\
// Data checking
// ============================================================================\

// --------------------\
// Check integer value
// ------------------------------------\
function check_int($str) {
  $l=strlen($str);
  if (!$l) return false;
  for ($i=0; $i<$l; $i++) {
    $ch=$str[$i];
    if ($ch<'0' || $ch>'9') return false;
    }
  return (int)$str;
  }
// ------------------------------------/


// --------------------------------\
// Check hexadecimal integer value
// ------------------------------------\
function check_hex_int($str) {
  $l=strlen($str);
  if (!$l) return false;
  for ($i=0; $i<$l; $i++) {
    $ch=$str[$i];
    if (($ch<'0' || $ch>'9') && ($ch<'A' || $ch>'F') && ($ch<'a' || $ch>'f')) return false;
    }
  return hexdec($str);
  }
// ------------------------------------/


// ------------------\
// Check float value
// ------------------------------------\
function check_float($str) {
  $l=strlen($str);
  if (!$l) return false;
  $point=0;
  for ($i=0; $i<$l; $i++) {
    $ch=$str[$i];
    if ($ch=='.')
      if ($point) return false;
      else $point=1;
    else 
      if ($ch<'0' || $ch>'9') return false;
    }
  return (double)$str;
  }
// ------------------------------------/


// ----------------\
// Check ZIP value
// ------------------------------------\
function check_zip($str) {
  return (strlen($str)==5 && check_int($str));
  }
// ------------------------------------/


// -------------------\
// Check E-mail value
// ------------------------------------\
function check_email($str) {
  $l=strlen($str);
  if (!$l) return false;
  $ata=$point=0;
  $cch='';
  for ($i=0; $i<$l; $i++) {
    $ch=$str[$i];
    if ($ch=='@')
      if ($ata==1 || $i==0 || $cch=='.') return false;
      else $ata=1;
    elseif ($ch=='.')
      if ($cch=='.' || $cch=='@' || $i==$l-1 || $i==0) return false;
      else $point=$ata;
    elseif (($ch<'A' || $ch>'Z') && ($ch<'a' || $ch>'z') &&
	    ($ch<'0' || $ch>'9') && ($ch!='_') && ($ch!='-')) return false;
    $cch=$ch;
    }
  return ($ata && $point);
  }
// ------------------------------------/
 

// -----------------------------\
// Check date and get its parts
// ------------------------------------\
function get_date($str,$format=-1) {
  if ($format==-1) $format=$GLOBALS["DATE_FORMAT"];
  $l=strlen($str);
  $dd=substr($str,0,2);
  $mm=substr($str,3,2);
  $yy=substr($str,6,4);
  if ($format) { $tmp=$dd; $dd=$mm; $mm=$tmp; }
  return
    ($l==10 && $str[2]=="." && $str[5]=="." &&
    check_int($dd) && check_int($mm) && check_int($yy) &&
    checkdate($mm,$dd,$yy)) ?
	array($yy,$mm,$dd) : false;
  }
// ------------------------------------/


// -------------------------------------\
// Check time (hh:mm) and get its parts
// ------------------------------------\
function get_time($str) {
  $l=strlen($str);
  $h=check_int($hh=substr($str,0,2));
  $m=check_int($mm=substr($str,3,2));
  return
    ($l==5 && $str[2]==":" && is_int($h) && $h<24 && is_int($m) && $m<60) ?
	array($hh,$mm) : false;
  }
// ------------------------------------/


// --------------\
// Compare dates
// ------------------------------------\
function cmp_date($str1,$str2,$format=-1) {
  if (! ($date1=get_date($str1,$format))) return -1;
  if (! ($date2=get_date($str2,$format))) return -2;
  $date1=(int)implode("",$date1);
  $date2=(int)implode("",$date2);
  if ($date1>$date2) return 1;
  elseif ($date2>$date1) return 2;
  else return 0;
  }
// ------------------------------------/


// --------------\
// Compare times
// ------------------------------------\
function cmp_time($str1,$str2) {
  if (! ($time1=get_time($str1))) return -1;
  if (! ($time2=get_time($str2))) return -2;
  $time1=(int)implode("",$time1);
  $time2=(int)implode("",$time2);
  if ($time1>$time2) return 1;
  elseif ($time2>$time1) return 2;
  else return 0;
  }
// ------------------------------------/


// ----------------------------------------\
// date() with correction for current site
// ------------------------------------\
function site_date($format_str,$timestamp=-1) {
    global $TIME,$GMT_DIFF;
  if ($timestamp==-1) $timestamp=$TIME;
  return date($format_str,$timestamp+$GMT_DIFF);
  }
// ------------------------------------/


// ---------------------------------\
// Get dd.mm.yyyy/mm.dd.yyyy string
// ------------------------------------\
function get_date_str($timestamp=-1,$format=-1) {
    global $TIME,$DATE_FORMAT,$DATE_FORMATS;
  if ($timestamp==-1) $timestamp=$TIME;
  if ($format==-1) $format=$DATE_FORMAT;
  return site_date($DATE_FORMATS[$format],$timestamp);
  }
// ------------------------------------/


// ----------------------\
// Get hh:mm string
// ------------------------------------\
function get_time_str($timestamp=-1) {
    global $TIME;
  if ($timestamp==-1) $timestamp=$TIME;
  return site_date("H:i",$timestamp);
  }
// ------------------------------------/

// ============================================================================/


?>
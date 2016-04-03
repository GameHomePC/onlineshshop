<?void();
/* -----!!! NO SYMBOLS ("CR","SPACE", ...) BEFORE "<?" OR AFTER "?>" !!!----- */
/*
// ============================================================================\

Functions:
	disable_caching()
	set_cache_time($min=60)
	set_content_type($ct="text/html")
	redirect($url,$savecookie=0)
	get_client_ip($look_proxy=1)

// ============================================================================/
*/


// ----------------\
// Disable caching
// ------------------------------------\
function disable_caching() {
    global $TIME;
  header('Expires: Mon, 01 Jan 2001 00:00:00 GMT');
//  header("Expires: ".gmdate("D, d M Y H:i:s",10800)." GMT");
  header("Last-Modified: ".gmdate("D, d M Y H:i:s",$TIME)." GMT");
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  }
// ------------------------------------/


// ------------------------\
// Set timeout for caching
// ------------------------------------\
function set_cache_time($min=60) {
    global $TIME;
  $sec=$min*60;
  header("Expires: ".gmdate("D, d M Y H:i:s",$TIME+$sec)." GMT");
  header("Cache-Control: private, max-age=$sec");
  }
// ------------------------------------/


// ----------------------\
// Set http content type
// ------------------------------------\
function set_content_type($ct="text/html") {
  header("Content-type: $ct");
  }
// ------------------------------------/


// --------------\
// Page redirect
// ------------------------------------\
function redirect($url,$savecookie=0) {
    global $CURRENT_PROTOCOL;
  if ($savecookie) {
    header("Refresh: 0; URL=$url");
    echo "<script>setTimeout('location.replace(\"$url\")',1100)</script>";
    }
  else {
    if ($url[0]=="/" && php_sapi_name()=="cgi") $url="$CURRENT_PROTOCOL$url";
    header("HTTP/1.0 302 Object Moved");
    header("Location: $url");
    }
  }
// ------------------------------------/


// --------------\
// Get client IP
// ------------------------------------\
function get_client_ip($look_proxy=1) {
  $ip=$GLOBALS['HTTP_X_FORWARDED_FOR'];
  return trim(current(explode(',',(($look_proxy && $ip) ? $ip : $GLOBALS['REMOTE_ADDR']))));
  }
// ------------------------------------/


?>
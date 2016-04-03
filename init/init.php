<?void();
/* -----!!! NO SYMBOLS ("CR","SPACE", ...) BEFORE "<?" OR AFTER "?>" !!!----- */


// -------------------\
// Interface settings
// ----------------------------------------------------------------------------\
$AUTO_REFRESH_TIME=0;		// Time interval for auto refreshing of main window, sec.
				// (set to 0 to disable autorefreshing)
$AUTO_ONLINE_TIME=120;		// Time interval for auto setting that current user is online, sec.
				// (set to 0 to disable)
$CONTROL_USER_ACTIVITY=0;	// If 1 then all the auto functions will be disabled
				// if user is not working with either page of the system
$ONLINE_TIMEOUT=300;		// Timeout for setting that user is offline, sec.
$RELOGIN_TIMEOUT=0;		// Timeout for user activity after that he must relogin, sec.
				// (set to 0 to disable)
$RELOGIN_CHANGE_IP=1;		// If 1 then user must relogin if his IP has been changed

$SECURE_LOGIN_ONLY=0;		// 1/0 - defines using of "secure" parameter for cookies
				// and if only secure login is possible on the login page


$DATE_FORMAT=1;			// 0 - dd.mm.yyyy (Rus)
				// 1 - mm.dd.yyyy (Amer)
$DATE_FORMAT_NOTE="mm.dd.yyyy";	// Note for user about date format


$DEF_PORTION=20;		// Default portion of records on the page
$MIN_PORTION=1;			// Min. portion of records on the page
$MAX_PORTION=1000;		// Max. portion of records on the page
$DEF_PAGE_PORTION=15;		// Default portion of pages in the bar
// ----------------------------------------------------------------------------/


// -------------------------\
// WEB-server configuration
// ----------------------------------------------------------------------------\
$MAIN_DOMAIN="";		// Main domain for the site (for setting in cookies, etc.)
				// Use empty string ("") if current

$USUAL_PROTOCOL="http:";	// Settings for HTTP protocol
// DO NOT USED MORE $SECURE_PROTOCOL="https:";	// Settings for secure protocol

$USUAL_SERVER_NAME="";		// Use empty strings if they are equal,
$SECURE_SERVER_NAME="";		// and current name will be used

$USUAL_PORT="";			// Use if they are not standart,
$SECURE_PORT="";		// For example, ":8000"

$USUAL_SITE_ROOT="";		// The directory where site is placed, with head "/"
$SECURE_SITE_ROOT="";		// Use empty string ("") if it is the root directory 
				// on the www-server.

$ADMIN_DIR="admin";		// 
$USER_DIR="user";		// 

// ------------------------------------\
$SERVER_CAN_RECODE=0;		// For Russian Apache
$SERVER_CHARSET="k";		// w,k,a,i,m = win,koi,alt,iso,mac
$SERVER_RECODE_PORT=array(
	"koi" => "8100",
	"win" => "8101",
	"alt" => "8102",
	"iso" => "8103",
	"mac" => "8104"
	);
// ------------------------------------/
// ----------------------------------------------------------------------------/


// -------\
// System
// ----------------------------------------------------------------------------\
/*
 $RAR_PATH="/usr/bin/rar";		// Pathes to external programs
 $MYSQL_PATH="/usr/local/bin/mysql";
*/
// ----------------------------------------------------------------------------/


// --------------\
// Ini-constants
// ----------------------------------------------------------------------------\
$PARENT_URL='http://shopxml.com';	// Do not change!

$USE_GOOGLE_SITEMAPS=0;			// if you do not have
					// a google sitemaps account or
					// you are testing this script on
					// a local computer, then you can
					// set this variable to 0

$CHECK_WWW_SUBDOMAIN=2;			// 0 - no check
					// 1 - with www only
					// 2 - without www only

$GMT=-5*3600;	 			// GMT offset, sec. ([-12..+12]*3600 or "system")
					// (for example, -8*3600 for California,USA)

$SERVER_TIME_CORRECTION=0;		// Time for correction of server system time, sec.
					// (useful if system time is wrong)

$DATABASE=array(
	"type" => "mysql",		// DB type: mysql, mssql (to be continued...)
	"host" => "localhost",		// DB host[:port] (server name for MSSQL)
	"username" => "root",		// Username for connecting to DB
	"userpassword" => "",		// Password for connecting to DB
	"persistent" => 0,		// Usage of persistent connections to DB
	"name" => "onlines3__dump"			// DB name
	);


$SESSION_DB=0;				// If 1, save sesions in database

$MAX_UPLOAD_FILESIZE=500;		// Max. filesize to upload in Kb, or 0 if no limits
$DEF_UPLOAD_DIR="uploads";		// Default dir. for file upload

$SITE_CHARSET='iso-8859-1';		// Charset windows-1251 iso-8859-1

$INCLUDE_PRODUCT_FORM_FROM_SHOPXML=0;	// Don't modify :)
$DISABLE_KEYS_WHILE_EXPORT=0;		// Can set 1 if MySQL version is 4+ and
					// all base can be exported in one session
$SAVE_CATEGORY_TREE_TO_FILE=1;		// Caching
// ----------------------------------------------------------------------------/
?>
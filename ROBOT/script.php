#!/usr/local/bin/php -q

<?
// ====================================\
  $ROOT_PATH="..";

  $ROOT_PATH=realpath(dirname(__FILE__)."/$ROOT_PATH");
  $SESSION_START_DISABLE=1;
  include_once("$ROOT_PATH/init/main.php");
// ====================================/



// ------------------------------------\
  @set_time_limit(0);
  @ignore_user_abort(1);
  error_reporting(E_ALL-E_NOTICE);
// ------------------------------------/



// Do something...


//============ GET NEW BASES =================\
 @include("$ROOT_PATH/modules/get_bases.php");
//============================================/


?>
<br>OK

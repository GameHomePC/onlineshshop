<?void();
/* -----!!! NO SYMBOLS ("CR","SPACE", ...) BEFORE "<?" OR AFTER "?>" !!!----- */
/*
// ============================================================================\

Saving sessions in the DB.

// ============================================================================/
*/


$SESSION_MAXLIFETIME=(int)get_cfg_var("session.gc_maxlifetime");


// ------------------------------------\
//function db_session_open($save_path,$session_name) {
function db_session_open() {
  db_connect();
  return true;
  }
// ------------------------------------/


// ------------------------------------\
function db_session_close() {
  return true;
  }
// ------------------------------------/


// ------------------------------------\
function db_session_read($ID) {
    global $TIME,$SESSION_MAXLIFETIME,$SQL_LINK,$sql_query,$sql_fetch_row;
  $time=$TIME-$SESSION_MAXLIFETIME;
  $res=@$sql_query("select data from session where ID='$ID' and time>$time",$SQL_LINK);
  if ($res && (list($data)=@$sql_fetch_row($res))) return $data;
  else return false;
  }
// ------------------------------------/


// ------------------------------------\
function db_session_write($ID,$data) {
    global $TIME,$SESSION_MAXLIFETIME,$SQL_LINK,$sql_query;
  $time=$TIME-$SESSION_MAXLIFETIME;
  $data=to_sql($data);
  $res=@$sql_query("insert into session (ID,time,data)
			values ('$ID',$TIME,'$data')",$SQL_LINK);
  if (!$res) $res=@$sql_query("update session set time=$TIME,data='$data'
					where ID='$ID' and time>$time",$SQL_LINK);
  return $res;
  }
// ------------------------------------/


// ------------------------------------\
function db_session_destroy($ID) {
    global $SQL_LINK,$sql_query;
  return @$sql_query("delete from session where ID='$ID'",$SQL_LINK);
  }
// ------------------------------------/


// ------------------------------------\
function db_session_gc($maxlifetime) {
    global $TIME,$SQL_LINK,$sql_query;
  $time=$TIME-$maxlifetime;
  $res=@$sql_query("delete from session where time<$time",$SQL_LINK);
  return @$sql_affected_rows($SQL_LINK);
  }
// ------------------------------------/


session_set_save_handler(
	"db_session_open",
	"db_session_close",
	"db_session_read",
	"db_session_write",
	"db_session_destroy",
	"db_session_gc");


?>
<?void();
/* -----!!! NO SYMBOLS ("CR","SPACE", ...) BEFORE "<?" OR AFTER "?>" !!!----- */
/*
// ============================================================================\

Functions:
	db_error($message="")
	db_connect()
	db_query($query)
	get_new_id($table,$column,$cond=0,$start=1)
	get_new_id_fast($table,$column,$cond=0,$start=1)

// ============================================================================/
*/


// ==========\
// Variables
// ============================================================================\

// ----------------------------------------------------------------------------\
$SQL_LINK = 0;
$DB_ERROR_HANDLER="db_error";
$AUTO_SELECT_DB=($AUTO_SELECT_DB===0) ? 0 : 1;

$SQL_PREFIX=$DATABASE["type"];

$sql_connect		= "{$SQL_PREFIX}_connect";
$sql_pconnect		= "{$SQL_PREFIX}_pconnect";
$sql_close		= "{$SQL_PREFIX}_close";
                                      
$sql_select_db		= "{$SQL_PREFIX}_select_db";
$sql_query		= "{$SQL_PREFIX}_query";
$sql_free_result	= "{$SQL_PREFIX}_free_result";
                                      
$sql_field_name		= "{$SQL_PREFIX}_field_name";
                                      
$sql_num_fields		= "{$SQL_PREFIX}_num_fields";
$sql_num_rows		= "{$SQL_PREFIX}_num_rows";
                                      
$sql_data_seek		= "{$SQL_PREFIX}_data_seek";
$sql_fetch_row		= "{$SQL_PREFIX}_fetch_row";
$sql_fetch_array	= "{$SQL_PREFIX}_fetch_array";
$sql_fetch_assoc	= "{$SQL_PREFIX}_fetch_assoc";
$sql_fetch_object	= "{$SQL_PREFIX}_fetch_object";
$sql_result		= "{$SQL_PREFIX}_result";

$sql_insert_id		= "{$SQL_PREFIX}_insert_id";
$sql_affected_rows	= "{$SQL_PREFIX}_affected_rows";

$sql_error = ($SQL_PREFIX=="mssql") ? "mssql_get_last_message" : "{$SQL_PREFIX}_error";
// ----------------------------------------------------------------------------/


// ---------------------------\
// Messages and ini-variables
// ----------------------------------------------------------------------------\
$MESS_DB_ERROR="Database working error";
$PRE_ERR_STRING="";
$POST_ERR_STRING="</table></table></table></table></table>";
$FRAME_RETURN="";		// With tail point (for example, "top.")
$BUTTON_RETURN=1;
// ----------------------------------------------------------------------------/


// ------------------\
// !!! IMPORTANT !!!
// Usage: eval($GLOBALS["GLOBAL__DB_VARS"]);
// ----------------------------------------------------------------------------\
$GLOBAL_DB_VARS='global
	$DATABASE,$SQL_LINK,$AUTO_SELECT_DB,$DB_ERROR_HANDLER,
	$MESS_DB_ERROR,$PRE_ERR_STRING,$POST_ERR_STRING,
	$FRAME_RETURN,$BUTTON_RETURN,
	$SQL_PREFIX,
	$sql_connect,$sql_pconnect,$sql_close,$sql_select_db,$sql_query,
	$sql_free_result,$sql_field_name,$sql_num_fields,$sql_num_rows,
	$sql_data_seek,$sql_fetch_row,$sql_fetch_array,$sql_fetch_object,
	$sql_result,$sql_insert_id,$sql_affected_rows,$sql_error;';
// ----------------------------------------------------------------------------/

// ============================================================================/




// ==========\
// Functions
// ============================================================================\

// ------------\
// Report about DB working error and exit
// ------------------------------------\
function db_error($message="") {
    eval($GLOBALS["GLOBAL_DB_VARS"]);
  echo "$PRE_ERR_STRING<br><center><b>$MESS_DB_ERROR</b><br>",
	$message ?
	$message : "<b>Server Message:</b> ".@$sql_error($SQL_LINK),
	"<form><table border=0 cellspacing=5 cellpadding=0>
	<tr><td><input type=button value='Repeat'
	onClick='{$FRAME_RETURN}location.reload()'></td>",
	$BUTTON_RETURN ?
	"<td width=30></td><td><input type=button value='Return'
		onClick='{$FRAME_RETURN}history.go(-1)'></td>" :
	"",
	"</tr></table></form></center>$POST_ERR_STRING</body></html>";
  exit;
  }


// ------------------------------------------\
// Connect to DB and report in case of error
// ------------------------------------\
function db_connect() {
    eval($GLOBALS["GLOBAL_DB_VARS"]);
  $SQL_LINK=0;
  if ($DATABASE["persistent"])
    $SQL_LINK=@$sql_pconnect($DATABASE["host"],
		$DATABASE["username"],$DATABASE["userpassword"]);
  if (!$SQL_LINK)
    $SQL_LINK=@$sql_connect($DATABASE["host"],
		$DATABASE["username"],$DATABASE["userpassword"]);
  if (!$SQL_LINK)
    return $DB_ERROR_HANDLER ? $DB_ERROR_HANDLER("Can't connect to SQL server") : false;

  return ($AUTO_SELECT_DB && !@$sql_select_db($DATABASE["name"],$SQL_LINK)) ?
	($DB_ERROR_HANDLER ? $DB_ERROR_HANDLER() : false) :
	$SQL_LINK;
  }
// ------------------------------------/


// ------------------------------------------\
// Run SQL-query and report in case of error
// ------------------------------------\
function db_query($query) {
    global $SQL_LINK,$DB_ERROR_HANDLER,$sql_query;
  if (!$SQL_LINK) db_connect();
  $res=@$sql_query($query,$SQL_LINK);
  return (!$res && $DB_ERROR_HANDLER) ? $DB_ERROR_HANDLER() : $res;
  }
// ------------------------------------/


// ------------------------------------------\
// Find new unique index for column in table
// ------------------------------------\
function get_new_id($table,$column,$cond=0,$start=1) {
    global $sql_fetch_row,$sql_free_result;
  $res=db_query("select DISTINCT $column from $table
		where $column_name>=$start".($cond ? " and $cond" : "")." order by 1");
  for ($i=$start; list($id)=@$sql_fetch_row($res); $i++)  if ($i!=$id) break;
  @$sql_free_result($res);
  return $i;
  }
// ------------------------------------/


// ------------------------------------------------\
// Find new (max) unique index for column in table
// ------------------------------------\
function get_new_id_fast($table,$column,$cond=0,$start=1) {
    global $sql_result,$sql_free_result;
  $res=db_query("select max($column)+1 from $table".($cond ? " where $cond" : ""));
  $id=@$sql_result($res,0,0);
  @$sql_free_result($res);
  return ($id>$start) ? $id : $start;
  }
// ------------------------------------/

// ============================================================================/


?>
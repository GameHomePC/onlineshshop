<?void();
/* -----!!! NO SYMBOLS ("CR","SPACE", ...) BEFORE "<?" OR AFTER "?>" !!!----- */
/*
// ============================================================================\

Functions:
	report_error($error)
	report_ok($OK,$message="...")

// ============================================================================/
*/


// -------------------------------------\
// Report about error if it has occured
// ------------------------------------\
function report_error($error) {
  if ($error) echo "<div align=center style='padding:2;background-color:#FFE0E0' class='warnH'>Error: $error</div><br>";
  }
// ------------------------------------/


// ---------------------------------------\
// Report about successful data operation
// ------------------------------------\
function report_ok($OK,$message="Data has been successfully saved.") {
  if ($OK) echo "<div align=center style='padding:2;background-color:#EEFCEE' class='okH'>$message</div><br>";
  }
// ------------------------------------/


?>
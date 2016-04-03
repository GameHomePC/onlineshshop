<?void();
// ====================================\
  $ROOT_PATH="../..";

  include_once("$ROOT_PATH/init/main.php");
// ====================================/



// ----------------------------------------------------------------------------\
  if (check_hex_str($SessID)) {
    $DB_ERROR_HANDLER=0;
    $cond='';
    if ($RELOGIN_TIMEOUT) $cond.=" and time>".($TIME-$RELOGIN_TIMEOUT);
    if ($RELOGIN_CHANGE_IP) $cond.=" and IP='$CLIENT_IP'";
    db_query("update admin set time=$TIME where sessID=0x$SessID $cond");
    }
// ----------------------------------------------------------------------------/

  disable_caching();
  set_content_type("image/gif");
  header("Content-Length: 43");
  echo "\x47\x49\x46\x38\x39\x61\x01\x00\x01\x00\x80\xFF\x00\xC0\xC0\xC0\x00\x00\x00\x21\xF9\x04\x01\x00\x00\x00\x00\x2C\x00\x00\x00\x00\x01\x00\x01\x00\x00\x02\x02\x44\x01\x00\x3B";
  exit;
?>
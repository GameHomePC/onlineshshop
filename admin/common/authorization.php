<?void();
/* ---!!! NO ANY SYMBOLS ("CR","SPACE",...) BEFORE "<?" OR AFTER "?>" !!!--- */

  db_connect();

  $cond='';
  if ($RELOGIN_TIMEOUT) $cond.=" and time>".($TIME-$RELOGIN_TIMEOUT);
  if ($RELOGIN_CHANGE_IP) $cond.=" and IP='$CLIENT_IP'";

  if (check_hex_str($SessID))
    list($AdmID,$Type,$Login,$Email)=@$sql_fetch_row(@$sql_query(
	"select admID,type,login,email from admin where sessID=0x$SessID $cond",$SQL_LINK));
  else $AdmID=0;

  $AdmID=(int)$AdmID;
  $Type=(int)$Type;

  if (!$AdmID) {
    redirect("$ADMIN_ROOT/?url=".to_url($REQUEST_URI),1);  // 1 - for IE's bug with "Back" button
    exit;
    }
  elseif ($ACCESS_ADMIN_TYPE && !in_array($Type,$ACCESS_ADMIN_TYPE)) {
    redirect("$ADMIN_ROOT/forbidden.php");
    exit;
    }
  else
    db_query("update admin set time=$TIME where sessID=0x$SessID");
  
  list($Login_html,$Email_html)=call("to_html",$Login,$Email);
  $Admin_type=$ADMIN_TYPE[$Type];
  $Is_root=($Type<1);
  $Is_admin=($Type<2);
  $Is_guest=($Type==10);

  $UsrID=0;
?>

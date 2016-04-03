<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

  if ($toploginform_url!='') $URL=$toploginform_url;
  else $URL=$choice ? 'addresses.html' : 'account.html';

  $SCRIPT=$choice ? 'choice.php' : 'login_form.php';

//--------------------------------\
  if ($choice && !$SC_QUANTITY) {
    redirect('sc.html');
    exit;
    }
  if ($CUSTOMER_ID) {
    redirect($URL);
    exit;
    }
//--------------------------------/

//--------------------------------------------------\
include_once("$ROOT_PATH/modules/open_session.php");
//--------------------------------------------------/

$Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/login.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&get_customer_id=1".translate_to_url());
if ($error=get_error($Res)) {	
	$CheckPageExisting=0;
	include($SCRIPT);
	exit;
	}

$tmp=explode('|',$Res);


if ($dologin) {
  if ($tmp[0]) {
	setcookie('SavedEmail',$email,0x7FFFFFFF,"$SITE_ROOT/");

	$CUSTOMER_ID=(int)$tmp[0];
        session_register1('CUSTOMER_ID');

	redirect($URL);
	exit;
	}
  }
else {
  $mailbody="
Your login: $email
Your password: $tmp[1]
";

  mail($email,"Your password for $Config[site_name]",$mailbody,"Content-type:text/plain\nFrom:$SERVER_MAIL_FROM");
  $message='Your password was sent to your email';
  redirect("$SCRIPT?message=".to_url($message).'&email='.to_url($email));
  }

?>
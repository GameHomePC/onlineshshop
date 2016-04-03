<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

//---------------------------\
  if ($CUSTOMER_ID) {
    redirect('account.html');
    exit;
    }
//---------------------------/

//--------------------------------------------------\
include_once("$ROOT_PATH/modules/open_session.php");
//--------------------------------------------------/


$Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/register.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&get_customer_id=1".translate_to_url());
if ($error=get_error($Res)) {	
	$CheckPageExisting=0;
	include('register_form.php');
	exit;
	}

$tmp=explode('|',$Res);

//------------------------------------------------------\
$customer_id=(int)$tmp[0];
include_once("$ROOT_PATH/modules/customer_register.php");
//------------------------------------------------------/

redirect('account.html?message='.to_url('You have successfully registered in our shop'));
?>
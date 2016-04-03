<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

//------------------------------\
  if (!$CUSTOMER_ID) {
    redirect('login_form.html');
    exit;
    }
//------------------------------/


$Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/password.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION".translate_to_url(),'POST');
if ($error=get_error($Res)) {	
	$CheckPageExisting=0;
	include('account.php');
	exit;
	}


redirect('account.html?message='.to_url('You password has been changed'));
?>
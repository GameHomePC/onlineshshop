<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

//--------------------------------------------------------------------------------\
if (!$CUSTOMER_ID) {
  redirect('login_form.html?message='.to_url('You have successfully logged out'));
  exit;
  }
//--------------------------------------------------------------------------------/

$Res=_LOAD_DATA("$SC_SITE_URL/EXTERNAL/logout.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION");
if ($Error=get_error($Res)) {	
	$CheckPageExisting=0;
	include_once("$ROOT_PATH/common/all_head.php");
	report_error($Error);
	include_once("$ROOT_PATH/common/all_tail.php");
	exit;
	}

$CUSTOMER_ID=0;

$url=($toploginform_url!='') ?
	$toploginform_url :
	'login_form.html?message='.to_url('You have successfully logged out');
redirect($url);
?>
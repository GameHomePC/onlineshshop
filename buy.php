<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

//--------------------------------------------------\
include_once("$ROOT_PATH/modules/open_session.php");
//--------------------------------------------------/

$continueCat=(int)$continueCat;

$product=(int)$product;
if ($new_name=@$sql_result(db_query("select name from sc_product_newval where prdID=$product"),0,0))
  $_GET['new_name']=$new_name;

$Res=_LOAD_DATA("$SC_SITE_URL/EXTERNAL/add_to_cart.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&get_quantity=1".translate_to_url());
if ($Error=get_error($Res,'PUT THIS PRODUCT TO CART AGAIN')) {
	// не будем выдавать ошибку, усли продукт уже лежит в карточке
	if (get_elem(explode('|',$Res),1)==25) {
	  redirect("sc.html?continueCat=$continueCat");
	  exit;
	  }
	$CheckPageExisting=0;
	include_once("$ROOT_PATH/common/all_head.php");
	report_error($Error);
	include_once("$ROOT_PATH/common/all_tail.php");
	exit;
	}

$SC_QUANTITY=(int)get_elem(explode('|',$Res),1);
session_register1('SC_QUANTITY');

redirect("sc.html?continueCat=$continueCat");

?>

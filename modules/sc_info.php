<?void();

  $FromDisc=(int)$FromDisc;
  $ResScInfo=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/cart_info.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&no_discount=0&new_discount_url=".to_url("discount.html?from=$FromDisc").'&new_cancel_discount_url='.to_url("discount.html?from=$FromDisc&delete=1").'&discount_code='.to_url($_POST['discount_code']),'POST');
  $ErrorScInfo=get_error($ResScInfo);
?>

<?
//-------------------------------------------\
if ($ErrorScInfo) report_error($ErrorScInfo);
else echo $ResScInfo;
//-------------------------------------------/
?>
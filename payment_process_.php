<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

//--------------------------\
  if (!$SC_QUANTITY) {
    redirect('sc.html');
    exit;
    }
  if (!$CUSTOMER_ID) {
    redirect('choice.html');
    exit;
    }
//--------------------------/

$Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/payment_process.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&get_detailed_info=1&customer_ip=".to_url(get_client_ip(1)).translate_to_url(),'POST');
if ($error=get_error($Res)) {	
	$CheckPageExisting=0;
	include('payment.php');
	exit;
	}


if ($Config['order_email']) {
  list($ID,$product_num,$price,$price_products,$price_tax,$price_shipping,$discount,
	$discount_products,$discount_tax,$discount_shipping)=explode('|',$Res);

  $Body="
<big><u><b>Order Details:</b></u></big>
<div style='padding:10 20 0 20'>

<b>Order ID: $ID</b><br>
<b>Number of Items: $product_num</b><br>

<b><u>Price: <b>$ ".number_format($price,2,'.',' ')."</b></u></b><br>
<div style='padding-left:20;'>
Products: $ ".number_format($price_products,2,'.',' ')."<br>
Tax: $ ".number_format($price_tax,2,'.',' ')."<br>
Shipping: $ ".number_format($price_shipping,2,'.',' ')."<br>
</div>";

  if ($discount)
    $Body.="<b>Discount was: $ ".number_format($discount,2,'.',' ')."</b> (full price was $ ".number_format($price+$discount,2,'.',' ').")<br>
<div style='padding-left:20;'>
On Products: $ ".number_format($discount_products,2,'.',' ')."<br>
On Tax: $ ".number_format($discount_tax,2,'.',' ')."<br>
On Shipping: $ ".number_format($discount_shipping,2,'.',' ')."<br>
</div>";

  $Body.="</div>";

  @mail($Config['order_email'],
	header_encode("New order on $Config[site_name]",$SITE_CHARSET),
	$Body,
	"From: $SERVER_MAIL_FROM\nContent-type: text/html; charset=$SITE_CHARSET");
  }
else list($ID)=explode('|',$Res);


//-------------------------------\
$SC_QUANTITY=0;
$DISCOUNT_ID='';
//-------------------------------/

redirect("OK_$ID.html?result=".to_url($Res));
?>
<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

//------------------------------\
  if (!$CUSTOMER_ID) {
    redirect('login_form.html');
    exit;
    }

//  $ID=(int)$ID;
//  if ($ID<1) {
//    redirect('account.html');
//    exit;
//    }
//------------------------------/

  $orders=explode('&',$result);
  $Res=$Error=array();
  foreach ($orders as $ord) {
//---------------------------------------------------------------------------------------------------------------\
  list($ID,$product_num,$price,$price_products,$price_tax,$price_shipping,$discount,
	$discount_products,$discount_tax,$discount_shipping)=explode('|',$ord);

  $Res[$ID]=_LOAD_DATA("$SC_SITE_URL/EXTERNAL/order_details.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&ID=$ID");
  $Error[$ID]=get_error($Res[$ID]);
//---------------------------------------------------------------------------------------------------------------/
	}

  include_once("$ROOT_PATH/common/all_head.php");
?>



<? if (sizeof($Res)>1) { ?>
<b class=hl>Orders details:</b><br>
In technical purposes your order has been separated in several different orders.<br><br><br><br><br>
<? } else { ?>
<b class=hl>Order details:</b><br>
<? } ?>


<style>
div.order {
	border: 1px #8E9AD6 solid;
	background-color: #EFF3FF;
	width:100%;
	padding:5;
	}
div.order BIG {
	font-size:14px;
	}
</style>


<?
foreach ($Res as $id=>$res)
//-------------------------------\
if ($Error[$id]) report_error($error[$id]);
else {
  echo "<div class=order>$res</div><br><br><br><br><br>";
  }
//-------------------------------/
?>



<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>
<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

//------------------------------\
  if (!$CUSTOMER_ID) {
    redirect('login_form.html');
    exit;
    }

  $ID=(int)$ID;
  if ($ID<1) {
    redirect('account.html');
    exit;
    }
//------------------------------/

  $Res=_LOAD_DATA("$SC_SITE_URL/EXTERNAL/order_details.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&ID=$ID");
  $Error=get_error($Res);

  include_once("$ROOT_PATH/common/all_head.php");
?>


<b class=hl>Order details:</b><br>


<?
//-------------------------------\
if ($Error) report_error($Error);
else {
//-------------\
?>

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

<div class=order>
<?= $Res ?>
</div>

<?
//-------------/
  }
//-------------------------------/
?>



<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>
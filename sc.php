<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

  if ($SC_QUANTITY) {
    $Res=_LOAD_DATA("$SC_SITE_URL/EXTERNAL/cart.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&new_update_url=".to_url('cart_update.html').'&new_edit_item_url='.to_url('item_edit.html').'&new_cancel_discount_url='.to_url('discount.html?delete=1'));
    $Error=get_error($Res);

    if (!$Error && !$DISCOUNT_ID) {
      $Res_d=_LOAD_DATA("$SC_SITE_URL/EXTERNAL/discount_form.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&discount_code=".to_url($discount_code).'&new_discount_url='.to_url('discount.html'));
      $Error=get_error($Res_d);
      }
    }

  $continueCat=(int)$continueCat;
  if ($continueCat<2) $continueCat=-1;

  include_once("$ROOT_PATH/common/all_head.php");
?>

<center>

<?
//----------------------------------\
if ($message) report_ok(1,$message);
report_error($error);
//----------------------------------/
?>

<?
//-------------------------------------------------------\
if ($Error) report_error($Error);
elseif (!$SC_QUANTITY) echo "<div style='font weight:bold;text-align:center;font-size:14'>Your cart is empty</div>";
else echo $Res;
//-------------------------------------------------------/
?>

<br>
<table border=0 cellspacing=0 cellpadding=0 width=95%>
<tr>
  <td width=0 nowrap class=button1>
    <nobr><a href='<?= $SITE_ROOT,'/',$CategItems[$continueCat]['href'] ?>' rel=nofollow>&nbsp; CONTINUE SHOPPING &nbsp;</a></nobr>
  </td>
  <td width=100%></td>
<? if ($SC_QUANTITY) { ?>
  <td width=0 nowrap class=button2>
    <nobr><a href='<?= $SECURE_URL_HEADER ?>/<?= $CUSTOMER_ID ? 'addresses.html' : 'choice.html' ?>' rel=nofollow
	onClick='if (sc_form.form_changed.value!="0") { sc_form.form_changed.value=2; sc_form.submit(); return false }'>&nbsp; CHECKOUT &gt;&gt; &nbsp;</a></nobr>
  </td>
<? } ?>
</tr>
</table>


<?
  if (!$Error && !$DISCOUNT_ID) {
//-------------------------------------------------------------\
?>
<br><br>
<table border=0 cellspacing=0 cellpadding=0 width=95%>
<tr><td>
<?= $Res_d ?>
</td></tr>
</table>
<?
//-------------------------------------------------------------/
    }
?>

</center>


<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>
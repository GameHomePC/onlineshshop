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


/* debug $Res */
$htmlCart = '
<table border="0" cellspacing="0" cellpadding="0" width="95%" class="border" style="margin-top:5">
<tbody><tr><td>

<table border="0" cellspacing="1" cellpadding="2" width="100%">
<tbody>
<tr align="center" class="bgH">
  <td width="0" class="sc_warn"><b>Delete</b></td>
  <td width="0"><b>Quantity</b></td>
  <td width="100%"><b>Item</b></td>
  <td width="0"><b>Unit&nbsp;Price</b></td>
  <td width="0"><b>Extended</b></td>
</tr>

<form name="sc_form" action="cart_update.html" method="post" onsubmit="return formSubmitOnce(this,checkUpdate(this))"></form>
    <input type="hidden" name="form_changed" value="0">


    <tr valign="baseline" class="bg">
        <td align="center"><input class="bgi" type="checkbox" name="del_prod[1883]" value="1" onchange="form.form_changed.value=1"></td>
        <td align="center"><input type="text" name="prod[1883]" size="5" maxlength="9" value="1" onchange="form.form_changed.value=1"></td>
        <td><b>9 Panel Drug Urine Test</b></td>
        <td align="center" nowrap="">$6.80 </td>
        <td align="right" nowrap=""><b>$6.80</b></td>
	</tr>

	<tr valign="baseline" class="bg">
        <td align="center"><input class="bgi" type="checkbox" name="del_prod[1883]" value="1" onchange="form.form_changed.value=1"></td>
        <td align="center"><input type="text" name="prod[1883]" size="5" maxlength="9" value="1" onchange="form.form_changed.value=1"></td>
        <td><b>9 Panel Drug Urine Test</b></td>
        <td align="center" nowrap="">$6.80 </td>
        <td align="right" nowrap=""><b>$6.80</b></td>
	</tr>

	<tr valign="baseline" class="bg">
        <td align="center"><input class="bgi" type="checkbox" name="del_prod[1883]" value="1" onchange="form.form_changed.value=1"></td>
        <td align="center"><input type="text" name="prod[1883]" size="5" maxlength="9" value="1" onchange="form.form_changed.value=1"></td>
        <td><b>9 Panel Drug Urine Test</b></td>
        <td align="center" nowrap="">$6.80 </td>
        <td align="right" nowrap=""><b>$6.80</b></td>
	</tr>

    <tr align="center" class="bgHl">
      <td colspan="2"><input class="button" type="submit" value="Update Cart"></td>
      <td colspan="4" align="right">
        Subtotal: <b>$6.80</b>
      </td>
    </tr>


    </tbody>
</table>

</td></tr>
</tbody></table>
';
/* end debug */
?>


<div class="cart">


    <?php
        if ($message) report_ok(1,$message);
        report_error($error);
    ?>

    <?php
        if ($Error) report_error($Error);
        elseif ($SC_QUANTITY) echo "<div style='font weight:bold;text-align:center;font-size:14'>Your cart is empty</div>";
        else echo $htmlCart;
    ?>

    <table class="cart__BoxButton" width=95%>
        <tr>
            <td width=0 nowrap class="button1">
                <nobr><a class="btn btn__green" href='<?= $SITE_ROOT,'/',$CategItems[$continueCat]['href'] ?>' rel=nofollow>CONTINUE SHOPPING</a></nobr>
            </td>
            <td width=100%></td>

            <?php if (!$SC_QUANTITY) : ?>
                <td width=0 nowrap class=button2>
                    <nobr><a class="btn btn__green" href='<?= $SECURE_URL_HEADER ?>/<?= $CUSTOMER_ID ? 'addresses.html' : 'choice.html' ?>' rel=nofollow
                             onClick='if (sc_form.form_changed.value!="0") { sc_form.form_changed.value=2; sc_form.submit(); return false }'><span>Proceed to checkout</span></a></nobr>
                </td>
            <?php endif; ?>
        </tr>
    </table>

    <?php if (!$Error && !$DISCOUNT_ID): ?>
        <?php echo $Res_d; ?>
    <?php endif; ?>


</div>

<?php
    include_once("$ROOT_PATH/common/all_tail.php");
?>
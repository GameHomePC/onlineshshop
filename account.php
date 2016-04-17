<?php
@include_once('_dir.php');

if (!$CUSTOMER_ID) {
    redirect('login_form.html');
    exit;
}

$Res = _LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/password_form.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&new_password_url=" . to_url('account_a.html') . "&password=" . to_url($password) . "&new_password=" . to_url($new_password) . "&new_password1=" . to_url($new_password1), 'POST');
$Error = get_error($Res);

if (!$Error) {
    $Res_ord = _LOAD_DATA("$SC_SITE_URL/EXTERNAL/orders.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&new_order_view_url=" . to_url('order_view.html'));
    $Error = get_error($Res_d);
}


include_once("$ROOT_PATH/common/all_head.php");
?>


<?php
if ($message) report_ok(1, $message);
report_error($error);
?>

<script>
    function checkChange(f,remind) {
        if (!f.password.value.length) {
            alert('Please enter the current password');
            f.password.focus();
            return false
        }
        if (!f.new_password.value.length) {
            alert('Please enter a new password');
            f.new_password.focus();
            return false
        }
        if (f.new_password.value!=f.new_password1.value) {
            alert('New password is not confirmed');
            f.new_password1.focus();
            f.new_password1.select();
            return false;
        }
        return true;
    }
</script>

<?php
$htmlChange = '
    <form name="register" action="/account_a.html" method="post" onsubmit="return formSubmitOnce(this,checkChange(this));">
        <div class="form__title">Change Password</div>

        <fieldset class="fieldset">
            <label class="fieldset__title">* Current Password</label>
            <input type="password" class="input-text" name="password">
        </fieldset>

        <fieldset class="fieldset">
            <label class="fieldset__title">* Choose New Password</label>
            <input type="password" class="input-text" name="new_password">
        </fieldset>

        <fieldset class="fieldset">
            <label class="fieldset__title">* Confirm New Password</label>
            <input type="password" name="new_password1" class="input-text">
        </fieldset>

        <fieldset class="fieldset fieldset__wrapSubmit">
            <button class="btn btn__green"><span>Change</span></button>
        </fieldset>

        <fieldset class="fieldset">
            <div class="form__linkBox">
                <p>
                    &#149; If you want change your password, enter your current password and a new password
                    you wish to use and click the "<b>Change</b>" button.
                </p>
            </div>
        </fieldset>
    </form>';
?>

<?php
if ($Error) report_error($Error);
else echo '<div class="form">', $htmlChange, '</div>',
'<div class="order">
    <div class="order__title">Your orders:</div>'
    . $Res_ord .
'</div>';
?>

<?php
include_once("$ROOT_PATH/common/all_tail.php");
?>
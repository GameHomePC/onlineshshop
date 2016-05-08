<?php
@include_once('_dir.php');

if (!$SC_QUANTITY) {
    redirect('sc.html');
    exit;
}

if ($CUSTOMER_ID) {
    redirect('addresses.html');
    exit;
}

if (!$email) $_GET['email'] = $SavedEmail;
//  $Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/login_form.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&new_login_url=".to_url('login.html?choice=1').translate_to_url());
$Res = _LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/login_form.php?GET_XML=0&new_login_url=" . to_url('login.html?choice=1') . translate_to_url(), 'POST');
$Error = get_error($Res);

include_once("$ROOT_PATH/common/all_head.php");
?>


    <script language="javascript">
        <!--


        function formSubmitOnce(f, formCorrect, period) {
            if (formCorrect === false) return false;

            if (period < 1) period = 5;
            if (!f.SubmittedFormID) f.SubmittedFormID = Math.round(Math.random() * 1000000);
            var a = 'Submitted' + f.SubmittedFormID;

            if (document[a]) {
                alert('Form is already submitted. If you are still on this page, wait about ' + period + ' sec and try again.');
                return false
            }

            document[a] = 1;
            setTimeout('document["' + a + '"]=0', period * 1000);
            return true
        }


        function checkEmail(str) {
            var l = str.length;
            if (!l) return false;
            var ata = 0;
            var point = 0;
            var cch = '';
            for (var i = 0; i < l; i++) {
                var ch = str.charAt(i);
                if (ch == '@')
                    if (ata == 1 || i == 0 || cch == '.') return false
                    else ata = 1;
                else if (ch == '.')
                    if (cch == '.' || cch == '@' || i == l - 1 || i == 0) return false
                    else point = ata;
                else if ((ch < 'A' || ch > 'Z') && (ch < 'a' || ch > 'z') &&
                    (ch < '0' || ch > '9') && (ch != '_') && (ch != '-')) return false
                cch = ch
            }
            return (ata && point)
        }


        function checkLogin(f, remind) {
            if (remind == 2 && f.doreset.value == '1') {
                alert('Please, wait 5 sec. and click this button again');
                return false
            }
            if (!checkEmail(f.email.value)) {
                alert('Please enter valid email!');
                f.email.focus();
                f.email.select();
                return false
            }
            if (!(remind || f.password.value.length)) {
                alert('Please enter the password');
                f.password.focus();;
                return false
            }
            if (remind == 2)
                if (confirm('Are you sure?')) {
                    f.doreset.value = '1';
                    setTimeout('document.login.doreset.value="0"', 5000);
                    return true;
                }
                else
                    return false;

            return true;
        }
        //-->
    </script>

<?php
$customBlock = '
        <div class="form">
            <form name="login" action="login.html?choice=1" method="post" onsubmit="return formSubmitOnce(this,checkLogin(this))">
                <input type="hidden" name="doreset" value="0">

                <fieldset class="fieldset">
                    <div class="fieldset__item">
                        <label class="fieldset__title">Email Address</label>
                        <input type="email" class="input-text" name="email" value="' . to_html($email) . '">
                    </div>

                    <div class="fieldset__item">
                        <input type="button" class="button" value="Remind Password" onclick="if (formSubmitOnce(form,checkLogin(form,1))) form.submit()">
                    </div>
                </fieldset>

                <fieldset class="fieldset">
                    <div class="fieldset__item">
                        <label class="fieldset__title">Password</label>
                        <input type="email" class="input-text" name="email" value="' . to_html($email) . '">
                        <input type="password" name="password" value="' . to_html($password) . '">
                    </div>

                    <div class="fieldset__item">
                        <input type="button" class="button" value="Reset Password" onclick="if (formSubmitOnce(form,checkLogin(form,2))) form.submit()">
                    </div>
                </fieldset>

                <fieldset class="fieldset fieldset__wrapSubmit">
                    <button type="submit" name="dologin" class="btn btn__green"><span>Login</span></button>
                </fieldset>
            </form>
        </div>
    ';
?>

<?php
if ($message) report_ok(1, $message);
report_error($error);
?>

<div class="choice">
    <div class="choice__item">
        <div class="choice__newCustomer"><a href="addresses.html">NEW CUSTOMER</a></div>
    </div>

    <div class="choice__item">
        <?php
            if ($Error) report_error($Error);
            else echo $customBlock;
        ?>
    </div>
</div>

<script>
    <!--
    if (document.login) document.login.email.focus();
    //-->
</script>

<?php
include_once("$ROOT_PATH/common/all_tail.php");
?>
<?php
@include_once('_dir.php');

if ($CUSTOMER_ID) {
    redirect('account.html');
    exit;
}

if (!$email) $_GET['email'] = $SavedEmail;

//  $Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/login_form.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&new_login_url=".to_url('login.html').translate_to_url());
$Res = _LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/login_form.php?GET_XML=0&new_login_url=" . to_url('login.html') . translate_to_url());
$Error = get_error($Res);

include_once("$ROOT_PATH/common/all_head.php");
?>

<div class="page__title">Login</div>

<?php
    $html = '
    <form name="toploginform" action="/login.html" method="post" onsubmit="return formSubmitOnce(this,checkLogin(this));">
        <input type="hidden" name="dologin" value="1">

        <div class="form__title">Sign in</div>

        <fieldset class="fieldset">
            <label class="fieldset__title">Email</label>
            <input type="email" class="input-text" name="email" value="' . to_html(($_POST['email'] != '') ? $_POST['email'] : $SavedEmail) . '">
        </fieldset>

        <fieldset class="fieldset">
            <label class="fieldset__title">Password</label>
            <input type="password" name="password" class="input-text" value="' . to_html($_POST['password']) . '">
        </fieldset>

        <fieldset class="fieldset fieldset__wrapSubmit">
            <button class="btn btn__green"><span>Sign in</span></button>
        </fieldset>

        <fieldset class="fieldset">
            <div class="form__linkBox">
                <a class="big" href="javascript:void(0)" onclick="topForgotPassword(); return false;">Forgot your password?</a>
            </div>

            <div class="form__linkBox">
                <p>
                    By signing in you are agreeing to our
                    <a href="#">Terms and Conditions</a>
                    and our
                    <a href="#">Privacy Notice.</a>
                </p>
            </div>
        </fieldset>
    </form>
';
?>

    <div class="form">
        <?php
            if ($message) report_ok(1, $message);
            report_error($error);
        ?>

        <?php
            if ($Error) report_error($Error);
            else echo $html;
        ?>
    </div>

    <script>
        <!--
        if (document.login) document.login.email.focus();
        //-->
    </script>

<?php
    include_once("$ROOT_PATH/common/all_tail.php");
?>
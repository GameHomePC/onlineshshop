<?php
// ====================================\
@include_once('_dir.php');
// ====================================/

//---------------------------\
if ($CUSTOMER_ID) {
    redirect('account.html');
    exit;
}
//---------------------------/

//  $Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/register_form.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&new_register_url=".to_url('register.html').translate_to_url());
$Res = _LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/register_form.php?GET_XML=0&new_register_url=" . to_url('register.html') . translate_to_url());
$Error = get_error($Res);

include_once("$ROOT_PATH/common/all_head.php");
?>

<?php
$html = '
    <form name="register" action="/register.html" method="post" onsubmit="return formSubmitOnce(this,checkRegister(this));">
        <input type="hidden" name="dologin" value="1">

        <div class="form__title">Create account</div>

        <fieldset class="fieldset">
            <label class="fieldset__title">First Name</label>
            <input type="text" class="input-text" name="first_name">
        </fieldset>

        <fieldset class="fieldset">
            <label class="fieldset__title">Last Name</label>
            <input type="text" class="input-text" name="last_name">
        </fieldset>

        <fieldset class="fieldset">
            <label class="fieldset__title">Email</label>
            <input type="email" name="email" class="input-text">
        </fieldset>

        <fieldset class="fieldset">
            <label class="fieldset__title">Password</label>
            <input type="password" name="password" class="input-text">
        </fieldset>

        <fieldset class="fieldset">
            <label class="fieldset__title">Password again</label>
            <input type="password" name="password1" class="input-text">
        </fieldset>

        <fieldset class="fieldset fieldset__wrapSubmit">
            <button class="btn btn__green"><span>Create your account</span></button>
        </fieldset>

        <fieldset class="fieldset">
            <div class="form__linkBox">
                <p>
                    By signing in you are agreeing to our
                    <a href="#">Terms and Conditions</a>
                    and our
                    <a href="#">Privacy Notice.</a>
                </p>
            </div>
        </fieldset>
    </form>';
?>

    <div class="form">

        <?php
            report_error($error);
        ?>

        <?php
            if ($Error) report_error($Error);
            else echo $html;
        ?>

    </div>

    <script>
        <!--
        if (document.register) document.register.email.focus();
        //-->
    </script>

<?php
    include_once("$ROOT_PATH/common/all_tail.php");
?>
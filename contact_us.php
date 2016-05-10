<?php
@include_once('_dir.php');

if (!$CUSTOMER_ID) {
    include_once("$ROOT_PATH/CAPTCHA/_init.php");
}


call('trim', array(&$name, &$email, &$subject, &$question));

if ($action == 1)
    if (!check_email($email)) $Message = '<div class=warn>Error: enter valid Email</div>';
    elseif ($question == '') $Message = '<div class=warn>Error: enter message</div>';
    elseif (!$CUSTOMER_ID && !captchaCheck()) $Message = '<div class=warn>Error: incorrect validation code</div>';
    elseif (@mail($Config['contact_email'],
        header_encode("Contact from $Config[site_name] (from $email)", $SITE_CHARSET),
        "Name: $name\nE-mail: $email\nSubject: $subject\nMessage: $question",
        "From: $SERVER_MAIL_FROM\nContent-type: text/plain; charset=$SITE_CHARSET\nReply-to:$email")
    ) {
        redirect('contact_us.html?action=2');
        exit;
    } else $Message = '<div class=warn>Internal Error</div>';
elseif ($action == 2) $Message = '<div class=ok>Your message has been sent to administration</div>';

include_once("$ROOT_PATH/common/all_head.php");
?>

<?php echo $Message; ?>

<h1 class="page__title">Contact Us</h1>

<div class="form">
    <form action="contact_us.html" method="POST" onSubmit="if (!checkEmail(this.email.value)) { alert('Enter valid Email!'); return false; } if (this.question.value=='') { alert('Enter message!'); return false; } return captchaCheck(this);">
        <input type="hidden" name="action" value="1">

        <div class="form__title">Contact Us</div>

        <fieldset class="fieldset">
            <label class="fieldset__title">Email</label>
            <input type="email" name="email" value="<?php echo to_html($email); ?>" class="input-text" />
        </fieldset>

        <fieldset class="fieldset">
            <label class="fieldset__title">Name</label>
            <input name="name" value='<?php echo to_html($name); ?>' class="input-text">
        </fieldset>

        <fieldset class="fieldset">
            <label class="fieldset__title">Subject</label>
            <input type="text" name="subject" value="<?php echo to_html($subject); ?>" class="input-text" />
        </fieldset>

        <fieldset class="fieldset">
            <label class="fieldset__title">Message</label>
            <textarea name="question" class="input-textarea" value="<?php echo to_html($question); ?>"></textarea>
        </fieldset>

        <?php if (!$CUSTOMER_ID) : ?>
            <fieldset class="fieldset fs0">
                <?php echo include("$ROOT_PATH/CAPTCHA/code.php"); ?>
            </fieldset>
        <?php endif; ?>

        <fieldset class="fieldset fieldset__wrapSubmit">
            <button type="submit" class="btn btn__green"><span>Send</span></button>
        </fieldset>

    </form>
</div>

<?
include_once("$ROOT_PATH/common/all_tail.php");
?>

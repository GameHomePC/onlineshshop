<?
// ====================================\
  @include_once('_dir.php');
// ====================================/


  if (!$CUSTOMER_ID) {
	include_once("$ROOT_PATH/CAPTCHA/_init.php");
	}


  call('trim',array(&$name,&$email,&$subject,&$question));
  if ($action==1)
    if (!check_email($email)) $Message='<div class=warn>Error: enter valid Email</div>';
    elseif ($question=='') $Message='<div class=warn>Error: enter message</div>';
	elseif (!$CUSTOMER_ID && !captchaCheck()) $Message='<div class=warn>Error: incorrect validation code</div>';
    elseif (@mail($Config['contact_email'],
				header_encode("Contact from $Config[site_name] (from $email)",$SITE_CHARSET),
				"Name: $name\nE-mail: $email\nSubject: $subject\nMessage: $question",
				"From: $SERVER_MAIL_FROM\nContent-type: text/plain; charset=$SITE_CHARSET\nReply-to:$email")) {
      redirect('contact_us.html?action=2');
      exit;
      }
    else $Message='<div class=warn>Internal Error</div>';
  elseif ($action==2) $Message='<div class=ok>Your message has been sent to administration</div>';

  include_once("$ROOT_PATH/common/all_head.php");
?>


<?= $Message ?>

<table border=0 cellspacing=0 cellpadding=2 align=center>

<form action='contact_us.html' method=POST
	onSubmit="if (!checkEmail(this.email.value)) { alert('Enter valid Email!'); return false; }
			if (this.question.value=='') { alert('Enter message!'); return false; }
			return captchaCheck(this);">
<input type=hidden name='action' value=1>

<tr>
  <td><b>Email: <font color=red>*</font></b></td>
  <td><input type=text name='email' value='<?= to_html($email) ?>' size=30 align=absmiddle class=text style="width:260"></td>
</tr>
<tr>
  <td>Name:</td>
  <td><input type=text name='name' value='<?= to_html($name) ?>' size=30 align=absmiddle class=text style="width:260"></td>
</tr>
<tr>
  <td>Subject:</td>
  <td><input type=text name='subject' value='<?= to_html($subject) ?>' size=30 align=absmiddle class=text style="width:260"></td>
</tr>
<tr>
  <td colspan=2>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>
<b>Message: <font color=red>*</font></b><br>
<textarea name='question' cols=40 rows=10 wrap=virtual class=text style="width:350"><?= to_html($question) ?></textarea><br>
  </td>
</tr>

<? if (!$CUSTOMER_ID) { ?>
<tr>
  <td colspan=2><? include("$ROOT_PATH/CAPTCHA/code.php") ?></td>
</tr>
<? } ?>

<tr>
  <td colspan=2><input type=submit class=button value='Send'></td>
</tr>

</form>

</table>




<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>

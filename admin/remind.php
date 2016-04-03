<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="Remind Password";
// ====================================/

  disable_caching();

// ----------------------------------------------------------------------------\
  $login=trim($login);
  $login_sql=to_sql($login);
  $login_url=to_url($login);

  if ($login!="" &&
	(list($password,$email,$db_answer)=@$sql_fetch_row(db_query(
		"select password,email,answer from admin where login='$login_sql'"))))
    if (isset($answer))
      if ($answer!="" && $answer==$db_answer)
	$message="Your password for username \"<span class='hl'>".to_html($login).
		"</span>\" is \"<span class='hl'>".to_html($password)."</span>\"";
      else
	$error="Wrong answer";
    elseif (mail($email,"Your password",
		"Your password for username \"$login\" is \"$password\".",
		"From: $SERVER_MAIL_FROM"))
      $message="Your password was sent to your Email 
		(<span class='hl'>".to_html($email)."</span>)";
    else
      $error="Internal error while sending email";
  else
    $error="Nonexistent username";

  if ($error) {
    include("login.php");
    exit;
    }
// ----------------------------------------------------------------------------/
  $url_url=to_url($url=trim($url));

  include_once("$ROOT_PATH/$ADMIN_DIR/common/all_head.php");
?>



<br>
<blockquote>
<div class="headerH">Remind Password</div>
<br>
<div class="txt"><?= $message ?></div>
<br>
<div class="txtB"><a href="./?login=<?= $login_url ?>&url=<?= $url_url ?>">&lt;&lt; Return to the login page</a></div>
</blockquote>



<?
  include_once("$ROOT_PATH/$ADMIN_DIR/common/all_tail.php");
?>
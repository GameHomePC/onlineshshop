<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  call("trim",array(&$email,&$question,&$answer));
  $ql=strlen($question);
  $al=strlen($answer);
  $password_sql=to_sql($password);

  if (!check_email($email))
    $error="Wrong E-Mail";
  elseif ($newpassword!=$newpassword1)
    $error="New password is repeated wrong";
  elseif ($ql && !$al)
    $error="If question filled then answer must be filled either";
  elseif (!$ql && $al)
    $error="If answer filled then question must be filled either";
  elseif (! @$sql_num_rows(db_query(
	"select 1 from admin where admID=$AdmID and password='$password_sql'")))
    $error="Wrong password";

  if (isset($error)) {
    include("index.php");
    exit;
    }


  if ($newpassword!="") $password=$newpassword;
  call("to_sql",array(&$password,&$email,&$question,&$answer));

  db_query("update admin set password='$password',email='$email',
		question='$question',answer='$answer' where admID=$AdmID");

  redirect("./?OK=1");
?>
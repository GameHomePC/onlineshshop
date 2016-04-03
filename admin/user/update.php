<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  call("intval",array(&$ID,&$type));
  call("trim",array(&$login,&$email,&$question,&$answer));
  $login_sql=to_sql($login);
  $ql=strlen($question);
  $al=strlen($answer);

  if (!($ID>=0 && $ID!=1 && $type>$Type && $ADMIN_TYPE[$type]))
    $error='Invalid input data';
  elseif ($login=="")
    $error="Enter username";
  elseif (@$sql_num_rows(db_query(
	"select 1 from admin where login='$login_sql' and admID!=$ID")))
    $error="User with this username already exists";
  elseif ($password=="")
    $error="Enter password";
  elseif (!check_email($email))
    $error="Wrong E-Mail";
  elseif ($ql && !$al)
    $error="If question filled then answer must be filled either";
  elseif (!$ql && $al)
    $error="If answer filled then question must be filled either";

  if (isset($error)) {
    include("index.php");
    exit;
    }


  call("to_sql",array(&$password,&$email,&$question,&$answer));

  if (!$ID)
    db_query("insert into admin (type,login,password,email,question,answer)
		values ($type,'$login_sql','$password','$email','$question','$answer')");
  else
    db_query("update admin set type=$type,login='$login_sql',password='$password',
		email='$email',question='$question',answer='$answer'
		where admID=$ID and type>$Type");

  redirect("./?OK=1");
?>
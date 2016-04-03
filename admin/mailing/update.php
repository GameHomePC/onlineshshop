<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  call("intval",array(&$ID));
  call("trim",array(&$email,&$name));
  $active=$active ? 1 : 0;
  $unsubscribed=$unsubscribed ? 1 : 0;

  $email_sql=to_sql($email);

  if ($ID<0)
    $error='Invalid input data';
  elseif (!check_email($email))
    $error='Wrong Email';
  elseif (@$sql_num_rows(db_query(
	"select 1 from mailing_emails where email='$email_sql' and emlID!=$ID")))
    $error='This Email already exists in the mailing list';

  if (isset($error)) {
    include("view.php");
    exit;
    }


  call('to_sql',array(&$name));

  if (!$ID) {
    $code=rand(10000,10000000);
    db_query("insert into mailing_emails (time,active,unsubscribed,email,name,code)
		values ($TIME,$active,$unsubscribed,'$email_sql','$name',$code)");
//    $ID=@$sql_insert_id();
    }
  else
    db_query("update mailing_emails set active=$active,unsubscribed=$unsubscribed,
			email='$email_sql',name='$name'
		where emlID=$ID");

  redirect("./?ShowEmails=1&OK=1&$url_data");
?>
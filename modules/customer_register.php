<?void();

$CUSTOMER_ID=$customer_id;
session_register1('CUSTOMER_ID');

if ($email) {
  setcookie('SavedEmail',$email,0x7FFFFFFF,"$SITE_ROOT/");
  $email_sql=to_sql($email);

  $tmp=array();
  if ($first_name!='') $tmp[]=$first_name;
  if ($last_name!='') $tmp[]=$last_name;
  $name_sql=to_sql(implode(' ',$tmp));

//  db_query("insert into customer (cstID,time,email,name)
//		values ($CUSTOMER_ID,$TIME,'$email_sql','$name_sql')");

  $code=rand(10000,10000000);
  db_query("insert IGNORE into mailing_emails (time,active,unsubscribed,email,name,code)
		values ($TIME,1,0,'$email_sql','$name_sql',$code)");
  }

?>
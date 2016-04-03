<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");


//-------------------------\
 $PORTION=250;
 $PORTION_SLEEP=50;
 $SLEEP_TIME=1;
//-------------------------/


  $key=(int)$key;
  $logfile="$ROOT_PATH/CACHE/mailing_log_$key";

  if (!@is_file($logfile)) exit;

  @extract($Mailing=@unserialize(@file_get_contents($logfile)));

  $sended=(int)$sended;
  if ($sended<0) $sended=0;


  $res=db_query("select emlID,email,name,code from mailing_emails $condition
		order by emlID limit $sended,$PORTION");
  $N=0;
  while (list($id,$e,$n,$c)=@$sql_fetch_row($res)) {
//    $mail_to=win2koi("\"$n\" <$e>");
    if ($Html) call('to_html',array(&$n));
    @mail($e,//$mail_to,
	$mail_subject,
	str_replace(
		array('<%BASE%>','<%NAME%>','<%LINK%>'),
		array($USUAL_URL_HEADER,$n,"$USUAL_URL_HEADER/unsubscribe_{$id}_{$c}.html"),
		$Body),
	$mail_headers
	);
    $N++;
    echo $sended+$N," \n ";
    flush();
    if ($PORTION_SLEEP && $SLEEP_TIME && !($N%$PORTION_SLEEP)) sleep($SLEEP_TIME);
    }

  $sended+=$N;

  if ($N<$PORTION) {
    @unlink($logfile);
    $url="./?$url_data&sendOK=$sended";
    }
  else {
    $Mailing['sended']=$sended;
    $f=@fopen($logfile,'wb');
    @fwrite($f,serialize($Mailing));
    @fclose($f);
    $url="sending.php?key=$key&rand=".rand(1,1000000);
    }
?>

<script language=javascript><!--
location.replace('<?= to_js($url) ?>')
//-->
</script>


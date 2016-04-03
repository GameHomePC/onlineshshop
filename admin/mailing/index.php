<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="Mailing";
// ====================================/

// ============================================================================\

// ------------------------------------\
  $ShowEmails=$ShowEmails ? 1 : 0;
  $Send=($Send && isset($Body)) ? 1 : 0;
// ------------------------------------/

  call("intval",array(&$ld1,&$lm1,&$ly1,&$ld2,&$lm2,&$ly2));
  if (!($ld1 && $lm1 && $ly1)) $ld1=$lm1=$ly1=0;
  if (!($ld2 && $lm2 && $ly2)) $ld2=$lm2=$ly2=0;
  $empty_val=array(0=>' ');
  $DA=$empty_val+$DAY;
  $MA=$empty_val+$MONTH['name'];
  $YA=$empty_val+$YEAR;
  list($sd1,$ld1)=create_select('ld1',$DA,$ld1);
  list($sm1,$lm1)=create_select('lm1',$MA,$lm1);
  list($sy1,$ly1)=create_select('ly1',$YA,$ly1);
  list($sd2,$ld2)=create_select('ld2',$DA,$ld2);
  list($sm2,$lm2)=create_select('lm2',$MA,$lm2);
  list($sy2,$ly2)=create_select('ly2',$YA,$ly2);

  call('trim',array(&$le,&$ln));
  list($le_h,$ln_h)=call('to_html',$le,$ln);
  list($le_u,$ln_u)=call('to_url',$le,$ln);

  if (!isset($la)) $la=-1;
  call('intval',array(&$la,&$lact,&$tplID));
  $tmp=array(0=>' ',1=>'Yes',-1=>'No');
  list($sa,$la)=create_select('la',$tmp,$la);
  if ($ShowEmails)
    list($sact,$lact)=create_select('lact',$tmp,$lact);
  else
    list($stpl,$tplID)=create_select('tplID',"select tplID,CONCAT(IF(html,'[html] ','[text] '),name) 
					from mailing_templates order by name",$tplID,0,0,
				0,0,1,'','<option value="0"></option>');

  $url_data="tplID=$tplID&ld1=$ld1&lm1=$lm1&ly1=$ly1&ld2=$ld2&lm2=$lm2&ly2=$ly2&".
		"le=$le_u&ln=$ln_u&la=$la&lact=$lact";
  $url_data_url=to_url($url_data);

// ----------------------------------------------------------------------------\
function to_sql_spec($str) {
  return str_replace('*','%',to_sql_search($str));
  }

  $cond=array();
  if ($ld1) $cond[]="time>".(mktime(0,0,0,$lm1,$ld1,$ly1)-$GMT_DIFF-1);
  if ($ld2) $cond[]="time<".(mktime(0,0,0,$lm2,$ld2+1,$ly2)-$GMT_DIFF);
  if ($le!='') $cond[]="email like '".to_sql_spec($le)."'";
  if ($ln!='') $cond[]="name like '".to_sql_spec($ln)."'";
  if ($la) $cond[]="unsubscribed=".(($la>0) ? 1 : 0);
  if ($ShowEmails) {
    if ($lact) $cond[]="active=".(($lact>0) ? 1 : 0);
    }
  elseif ($le=='' || is_int(strpos($le,'*'))) $cond[]="active=1";

  $condition=$cond ? 'where '.implode(' and ',$cond) : '';
// ----------------------------------------------------------------------------/

// ============================================================================/


  if ($Send) {
// ============================================================================\

//  if ($From=='') $From=$Config['email_from']; // @$sql_result(db_query("select email_from from config limit 1"),0,0);
  if ($From=='') $From=$SERVER_MAIL_FROM;
  $Ct=$Html ? 'text/html' : 'text/plain';
  $mail_headers="From: $From\nContent-type: $Ct; charset=$SITE_CHARSET";
  $mail_subject=header_encode($Subject,$SITE_CHARSET);
  if ($Body_nl2br) $Body=nl2br($Body);

/*
//---------------- OLD ----------------------------------------------\
  $res=db_query("select emlID,email,name,code from mailing_emails $condition");
  for ($N=0; list($id,$e,$n,$c)=@$sql_fetch_row($res); $N++) {
//    $mail_to=win2koi("\"$n\" <$e>");
    if ($Html) call('to_html',array(&$n));
    @mail($e,//$mail_to,
	$mail_subject,
	str_replace(
		array('<%BASE%>','<%NAME%>','<%LINK%>'),
		array($URL_HEADER,$n,"$URL_HEADER/unsubscribe_{$id}_{$c}.html"),
		$Body),
	$mail_headers
	);
    }

  redirect("./?$url_data&sendOK=$N");
  exit;
//------------------------------------------------------------------/
*/

//---------------- NEW ---------------------------------------------\
  do {
    $key=rand(1,1000000);
    } while (@is_file("$ROOT_PATH/CACHE/mailing_log_$key"));

  $Mailing=array(
	'url_data' => $url_data,
	'condition' => $condition,
	'sended' => 0,
	'mail_subject' => $mail_subject,
	'Body' => $Body,
	'Html' => $Html,
	'mail_headers' => $mail_headers
	);
  if ($f=@fopen("$ROOT_PATH/CACHE/mailing_log_$key",'wb')) {
    @fwrite($f,serialize($Mailing));
    @fclose($f);
    redirect("sending.php?key=$key&rand=$key");
    }
  else "!!! ERROR: There is not an access to folder CACHE !!!";
  exit;
//------------------------------------------------------------------/

// ============================================================================/
    }

  $HTMLEditorUsed=1;

  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_head.php");
?>


<div class=txtB>
<?
  $txt1='Mailing';
  $txt2='Mailing List';
  if ($ShowEmails) echo "<a href='./?$url_data'>$txt1</a> | $txt2";
  else echo "$txt1 | <a href='./?$url_data&ShowEmails=1'>$txt2</a>";
?>
 | <a href='templates/'>Mail Templates</a>
</div><br>


<?
// ------------------------------------\
  report_ok($OK);
// ------------------------------------/

// ------------------------------------\
  if (isset($sendOK))
    echo "<div class=ok>Email was successfully sent to $sendOK email addresses.</div><br>"
// ------------------------------------/
?>


<?
// ============================================================================\
?>
<script language=javascript><!--
function checkFilter(f) {
  var ld1=f.ld1.selectedIndex
  var lm1=f.lm1.selectedIndex
  var ly1=f.ly1.selectedIndex
  var ld2=f.ld2.selectedIndex
  var lm2=f.lm2.selectedIndex
  var ly2=f.ly2.selectedIndex
  if ((ld1+lm1+ly1) && !(ld1 && lm1 && ly1)) {
    alert('Enter full date or leave all fields empty')
    f.ld1.focus()
    return false
    }
  if ((ld2+lm2+ly2) && !(ld2 && lm2 && ly2)) {
    alert('Enter full date or leave all fields empty')
    f.ld2.focus()
    return false
    }
  if (ld1 && ld2 && (ly1>ly2 || (ly1==ly2 && (lm1>lm2 || (lm1==lm2 && ld1>ld2))))) {
    alert('Invalid range of dates')
    f.ld2.focus()
    return false
    }
  }


<?
if (!$ShowEmails) {
//-----------------------------------------------------------\
?>

function changeTemplate(f) {
  if (!f.tplID.selectedIndex) {
    alert('Template is not choosed')
    f.tplID.focus()
    return false
    }
  f.Send.value=0
  f.submit()
  }

<?
//-----------------------------------------------------------/
  }
?>

//-->
</script>

<table border=0 cellspacing=0 cellpadding=1>
<tr><td class="border">
<table border=0 cellspacing=1 cellpadding=2 width=600>

<form name='filter' action='./' method=<?= $ShowEmails ? 'get' : 'post' ?>
	onSubmit='return checkFilter(this)'>
<input type=hidden name='for_no_bag1' value=1>

<input type=hidden name='ShowEmails' value='<?= $ShowEmails ?>'>

<tr valign=baseline class="bgH">
  <td class="hl" colspan=4>Filter for addresses<br>
	<div class=note>- Use char '<span class=note1>*</span>' 
	in text fields for indication of any character sequences,<br>
	for example, Email: '<span class=note1>*@mail.com</span>'</div></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB" nowrap>Added Date:</td>
  <td class="bg" colspan=3 nowrap><?= "from $sd1$sm1$sy1 to $sd2$sm2$sy2" ?></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB">Name:</td>
  <td class="bg"><input type=text name="ln" size=12 maxlength=50 value="<?= $ln_h ?>"></td>
  <td class="txtB">&nbsp;Email:</td>
  <td class="bg"><input type=text name="le" size=32 maxlength=100 value="<?= $le_h ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB">Unsubscribed:</td>
  <td class="bg" colspan=<?= $ShowEmails ? '1' : '3' ?>><?= $sa ?></td>
<? if ($ShowEmails) { ?>
  <td class="txtB">&nbsp;Active:</td>
  <td class="bg"><?= $sact ?></td>
<? } ?>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td colspan=3 class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<?
  if ($ShowEmails) {
// ----------------------------------------------------------------------------\
?>
<tr class="bgH">
  <td><input class=button type=reset value="Reset"></td>
  <td colspan=3><input class=buttonH type=submit value="Submit >>"></td>
</tr>
<?
// ----------------------------------------------------------------------------/
    }
  else {
// ----------------------------------------------------------------------------\
?>
<tr valign=baseline class="bgH">
  <td class="hl">Mail Template:</td>
  <td class="bg" colspan=3><?= $stpl ?>
	<input type=button class=button value="Change" onClick="changeTemplate(this.form)">
  </td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=10 alt=''></td>
  <td colspan=3 class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=10 alt=''></td>
</tr>

<?
// ------------------------------------\
  list($Html,$Subject,$Body)=
	call('to_html',
		$tplID ?
		@$sql_fetch_row(db_query(
			"select html,subject,template from mailing_templates
			where tplID=$tplID")) : 
		array(0,'','')
		);
// ------------------------------------/
?>
<tr valign=baseline class="bgH">
  <td colspan=4 class="headH">Mail</td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB" nowrap>HTML-format:</td>
  <td class="bg" colspan=3><input type=checkbox name='Html' value="1" <?= $Html ? 'checked' : '' ?>></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB">From address:</td>
  <td class="bg" colspan=3 nowrap><input type=text name="From" size=32 maxlength=100 value="<?= $Email_html ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="hl">Subject:</td>
  <td class="bg" colspan=3 nowrap><input type=text name="Subject" size=67 maxlength=100 value="<?= $Subject ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td colspan=4 class="hl">Mail Body
	<div class=note1>
	Following aliases are possible:<br>
	<span class=note2><b>&lt;%NAME%&gt;</b></span> - Name<br>
	<span class=note2><b>&lt;%LINK%&gt;</b></span> - Link URL to unsubscribe<br>
	</div></td>
</tr>
<tr valign=baseline class="bgH">
  <td colspan=4 class="bg">
<?
//----------------------------------------------------\
$ModuleData=array(
	'textarea' => 'Body',
	'cols' => '85',
	'rows' => '7'
	);
include("$ROOT_PATH/$ADMIN_DIR/modules/textarea.php");
//----------------------------------------------------/
?>
  </td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td colspan=3 class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr class="bgH">
  <td><input class=button type=reset value="Reset"></td>
  <td colspan=3>
	<input type=hidden name='Send' value="1">
	<input class=buttonH type=submit value="Send >>">
  </td>
</tr>
<?
// ----------------------------------------------------------------------------/
    }
?>

<input type=hidden name='for_no_bag2' value=1>
</form>

</table>
</td></tr>
</table>
<?
// ============================================================================/
?>


<?
  if ($ShowEmails) {
// ============================================================================\
?>
<?
// ----------------------------------------------------------------------------\
  $url_data.="&ShowEmails=1&page=$page";

  $portion=100;
  $num_rows=@$sql_result(db_query("select count(*) from mailing_emails $condition"),0,0);
  $page=(int)$page;
  list($hbar,$lbar,$page)=make_page_bar("./?$url_data&ShowEmails=1&page=",$num_rows,$page,1,0,$portion);

  $start=$page*$portion;
  $res=db_query("select emlID,time,active,unsubscribed,email,name
		from mailing_emails $condition
		order by time DESC limit $start,$portion");
// ----------------------------------------------------------------------------/
?>
<script language=javascript><!--
function checkUpdateG(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  }
//-->
</script>

<hr size=1 color=#000000 noshade>
<br>

<div class=head>&nbsp; <?= $num_rows ?>  addresses found:</div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<?= $hbar ?>
<div class='txt'><?= $lbar ?></div>

<table border=0 cellspacing=0 cellpadding=1>
<tr><td class="border">
<table border=0 cellspacing=1 cellpadding=2>

<form action='update_group.php?<?= $url_data ?>' method=post 
	onSubmit='return formSubmitOnce(this,checkUpdateG(this))'>

<tr valign=baseline class="bgH">
  <td class="txtB" align=center>#</td>
  <td class="txtB" align=center>Active</td>
  <td class="txtB" align=center>Date</td>
  <td class="txtB" nowrap>Email</td>
  <td class="txtB" nowrap>Name</td>
  <td class="txtB" align=center nowrap>Unsubscribed</td>
  <td class="txtB"><a href='view.php?url_data=<?= $url_data_url ?>'>Add</a></td>
</tr>

<?
  for ($i=$start+1; $row=@$sql_fetch_assoc($res); $i++) {
    @extract($row);
    $time=get_date_str($time);
    call('to_html',array(&$email,&$name));
    $eml=$email;
    $checked='checked';
    if (!$active) {
      $checked='';
      $time="<span class=inactive>$time</span>";
      $email="<span class=inactive>$email</span>";
      $name="<span class=inactive>$name</span>";
      }
    $unsubscribed=$unsubscribed ? '<font color=##AA0000>Yes</font>' : '';
    echo "<tr valign=baseline class=bg>
	<td class=bgH align=right><b>&nbsp;$i&nbsp;</b></td>
	<td class=bgH align=center>
		<input type=hidden name='active_old[$emlID]' value='$active'>
		<input type=checkbox name='active[$emlID]' value='1' $checked></td>
	<td align=center>$time</td>
	<td class=txtB><a href='./?le=$eml'>$email</a></td>
	<td class=txt>$name</td>
	<td class=txt align=center>$unsubscribed</td>
	<td class=txtB>
		<a href='view.php?ID=$emlID&url_data=$url_data_url'>Edit</a> /
		<a href='delete.php?ID=$emlID&url_data=$url_data_url'
		onClick='return makeSure()'>Delete</a></td>
	</tr>";
    }
?>

<? if ($num_rows) { ?>
<tr class="bg">
  <td class="bgH"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bgH"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=7 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>
<tr class="bg">
  <td class="bgH"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
  <td colspan=2 align=center class="bgH"><input class=buttonH type=submit value="Submit >>"></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>
<? } ?>

</form>

</table>
</td></tr>
</table>

<div class='txt'><?= $lbar ?></div>
<?= $hbar ?>
<?
// ============================================================================/
    }
?>



<?
  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_tail.php");
?>

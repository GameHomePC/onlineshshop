<?
// ----------------------------------------------------------------------------\
  $captchaLength=3;

  $captchaDefaultInputName='Captcha';
  $captchaDefaultInputNameID='CaptchaID';
  $captchaCookieName='CaptchaKey';

  $captchaSecureKey='Fkljdlfkjtg9fs7907567dfh';

  $captchaForceUseIframe=0;
// ----------------------------------------------------------------------------/

function captchaCrypt($code,$id=0) {
  $res=md5(crypt(crypt($code,$GLOBALS['captchaSecureKey']),md5($id)));
//echo "($code,$id)=$res<br>";
  return $res;
  }

function captchaCheck($code='',$id='') {
  if (!$code) $code=$_REQUEST[$GLOBALS['captchaDefaultInputName']];
  if (!$id) $id=$_REQUEST[$GLOBALS['captchaDefaultInputNameID']];
  $code=strtoupper($code);
  $tmp=$GLOBALS['captchaCookieName'];
  setcookie("{$tmp}[$id]",'',0,'/');
  $res=captchaCrypt($code,$id);
//echo "($code,$id)=$res<br>--->{$_COOKIE[$tmp][$id]}<br>";
  return ($res==$_COOKIE[$tmp][$id]);
  }
?>
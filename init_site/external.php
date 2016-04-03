<?void();

function translate_to_url() {
  $P=array_merge($_GET,$_POST);
  $str='';
  foreach ($P as $k=>$v) {
    if (!is_array($v)) { $str.="&$k=".to_url($v); continue; }
    foreach ($v as $k1=>$v1) {
      if (!is_array($v1)) { $str.="&{$k}[$k1]=".to_url($v1); continue; }
      foreach ($v1 as $k2=>$v2)
          if (!is_array($v2)) $str.="&{$k}[$k1][$k2]=".to_url($v2);
      }
    }
  return $str;
  }


function get_error($str,$link='') {
  global $SHOPXML_SESSION,$SC_QUANTITY,$CUSTOMER_ID,$DISCOUNT_ID;

  if (strpos($str,'error|')===0) {
    $tmp=explode('|',$str);
    $err_num=$tmp[1];

    if ($err_num==10) {
	$SHOPXML_SESSION=$SC_QUANTITY=$CUSTOMER_ID=0;
	$DISCOUNT_ID='';
	//session_destroy(); // для надежности :)
	}
    elseif ($err_num==81) { redirect('sc.html'); exit; }
    elseif ($err_num==82) { redirect('choice.html'); exit; }
    elseif ($err_num==83) { redirect('addresses.html'); exit; }
    elseif ($err_num==84) { redirect('shipping.html'); exit; }

    return $tmp[2].($tmp[3] ? "<br><small>$tmp[3]</small>" : '').
	 (($err_num==10) ?
		'<br><small style="color: #222244">Sorry, but your Shopping Cart has been lost.<br>If you were logged in, you need to login again.</small>'.
		(($link!='') ? "<br><small style='color: #555555'>[ <a href='javascript:location.reload()'>$link</a> ]</small>" : '')
		: '');
    }
  return false;
  }



function chunked_decode($str) {
  $res='';
  while (($str=ltrim($str))!='') {
    $i=strpos($str,"\n")+1;
    $l=hexdec(chop(substr($str,0,$i)));
    $res.=substr($str,$i,$l);
    $str=substr($str,$i+$l);
    }
  return $res;
  }

function _LOAD_DATA($fname,$method='GET',$flag=0) {
  $GET=($method=='GET');
  $POST=!$GET;
  @extract(parse_url($fname));
  $secure=($scheme=='https');

  if ($GET) {
    if (!is_string($Result=@file_get_contents($fname)))
	$error="error|10000|Failed opening file: '$php_errormsg'";
    }
  else $error=1;

  if ($error) {
//=================================================================================\
$error='';
$Curl=0;

if (function_exists('curl_init') &&
    $cid=curl_init($POST ? "$scheme://$host$path" : $fname)) {
  if ($POST) {
    curl_setopt($cid,CURLOPT_POST,1);
    curl_setopt($cid,CURLOPT_POSTFIELDS,$query);
    }
  if ($secure) {
    curl_setopt($cid,CURLOPT_SSL_VERIFYHOST,0);
    curl_setopt($cid,CURLOPT_SSL_VERIFYPEER,0);
    }
  curl_setopt($cid,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($cid,CURLOPT_TIMEOUT,20);
  curl_setopt($cid,CURLOPT_HEADER,1);
  $Result=curl_exec($cid);
  if ($Result===true) $error='error|10001|unknown CURL error';
  elseif (curl_errno($cid)) $error='error|10001|'.curl_error($cid);
  else $Curl=1;
  curl_close($cid);
  }
else $error=1;

if ($error) {
  $error='';
//----------------- Sockets ---------------------------------------------\
if ($f=@fsockopen(($secure ? 'ssl://' : '').$host,($secure ? 443 : 80),
			$errno,$errstr,20)) {
  $uri=$path.($GET ? "?$query" : '');
  $PostData=$GET ? '' : $query;
  $PostDataLen=strlen($PostData);
  $Method=$GET ? 'GET' : 'POST';
// ---------------------------------------------\
@fputs($f,
"$Method $uri HTTP/1.1
Content-Type: application/x-www-form-urlencoded
Host: $host
Content-Length: $PostDataLen
Connection: Close

$PostData");
// ---------------------------------------------/
  $Result='';
  while (!@feof($f)) $Result.=@fread($f,5000);
  @fclose ($f);
  }
else $error='error|10003|No way to make queries to Server';
//-----------------------------------------------------------------------/
  }

if (!$error) {
//-----------------------------------------------------------------------\
preg_match('/^(?:HTTP\/\d\.\d \d{3}.*?(?:\n\n|\r\n\r\n|\n\r\n\r))+/is',$Result,$tmp);
$Headers=call('trim',explode("\n",end(preg_split('/(\n\n|\r\n\r\n|\n\r\n\r)/',trim($tmp[0])))));
$Result=substr($Result,strlen($tmp[0]));

/*
$l1=strpos($Result,"\n\n");
$l2=strpos($Result,"\r\n\r\n");
if (!$l=min($l1,$l2)) $l=max($l1,$l2);
$Headers=call('rtrim',explode("\n",substr($Result,0,$l)));
$Result=substr($Result,$l+($l==$l1 ? 2 : 4));
*/

foreach ($Headers as $h) {
  $tmp=to_lower($h);
//  if (substr($tmp,0,9)=='location:') header($h);
  if (strpos($tmp,' 404 ')) {
    $Result='';
    break;
    }
  if (!$Curl && is_int($i=strpos($tmp,'transfer-encoding:'))) {
    $tmp=trim(substr($tmp,$i+18));
    if ($tmp=='chunked') $Result=chunked_decode($Result);
    elseif ($tmp=='base64') $Result=base64_decode($Result);
    elseif ($tmp=='quoted-printable') $Result=quoted_printable_decode($Result);
    elseif ($tmp!='binary') { /* ... */ }
    $Curl=1;
    break;
    }
  }
if ($Result=='') $error='error|10001|Unknown Error';
else $error='';
//-----------------------------------------------------------------------/
  }
//=================================================================================/
    }

  if ($error) return $flag ? false : $error;
  return $Result;
  }

?>
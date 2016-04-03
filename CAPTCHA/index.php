<?
  $CurrentDir=dirname(__FILE__);
  include_once("$CurrentDir/_init.php");

// ----------------------------------------------------------------------------\
  $fontFile="$CurrentDir/font.gif";
  $fontLines=2;
  $lW=$lH=30;

  $chars=array_merge(range('0','9'),range('A','Z'));
  unset($chars[0]);
  $nCh=sizeof($chars);


  $dW=$dH=$dX=$dY=3;
  $compress=10;
  $border=0;
  $noice=6;
  $maxAngle=0;//20;
// ----------------------------------------------------------------------------/
//  $tmp=explode(' ',microtime());
//  mt_srand((float)$tmp[1]+(float)$tmp[0]*100000);


  $ID=max(0,(int)strtok(trim($_SERVER['QUERY_STRING']),'-'));

if (!$ID) {
  header('HTTP/1.0 400 Bad Request');
  die('Please specify Id');
  }


  $Code='';
  $CodeNums=array();
  for ($i=0; $i<$captchaLength; $i++) {
    $tmp=mt_rand(1,$nCh);
    $Code.=$chars[$tmp];
    $CodeNums[$i]=$tmp;
    }


  header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
  header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
  header('Cache-Control: no-store, no-cache, must-revalidate');
  header('Cache-Control: post-check=0, pre-check=0',false);
  header('Pragma: no-cache');

  foreach (array_slice(array_keys((array)$_COOKIE[$captchaCookieName]),0,sizeof($_COOKIE)+5) as $tmp)
    setcookie("{$captchaCookieName}[$tmp]");
  setcookie("{$captchaCookieName}[$ID]",captchaCrypt($Code,$ID),0,'/');


  if ($captchaForceUseIframe || !function_exists('imagecreate'))
    die("<table style='width:100%;height:100%;'>
	<tr><td style='font-size:22px;' align=center><b>$Code</b></td></tr>
	</table>");


  $W=2*($border+$dX)+($captchaLength*$lW+$dW)-($captchaLength-1)*$compress;
  $H=2*($border+$dY)+($lH+$dH);
  $im=@imagecreate($W,$H);
  $colorWhite=@imagecolorallocate($im,255,255,255);
  $colorBlack=@imagecolorallocate($im,0,0,0);

  $im1=@imagecreatefromgif($fontFile);

  $it=mt_rand(0,$captchaLength-1);
  foreach ($CodeNums as $i=>$n) {
    $x1=$n*$lW;
    $y1=mt_rand(intval($i==$it),$fontLines-1)*$lH;

    $w=mt_rand($lW-$dW,$lW+$dW);
    $h=mt_rand($lH-$dH,$lH+$dH);
    $x=floor($border+$dX+$dW/2+$i*$lW+($lW-$w)/2-$i*$compress)+mt_rand(-$dX,$dX);
    $y=floor($border+$dY+$dH/2+($lH-$h)/2)+mt_rand(-$dY,$dY);

    @imagecopyresampled($im,$im1,$x,$y,$x1,$y1,$w,$h,$lW,$lH);
    }

  for ($i=0; $i<$noice; $i++) {
    $tmp=mt_rand(1,2);
    imagesetthickness($im,$tmp);
    $tmp_c=mt_rand(0,1) ? $colorBlack : $colorWhite;
    if ($tmp>1 || mt_rand(0,1)) imageline($im,mt_rand(0,$W-1),mt_rand(0,$H-1),mt_rand(0,$W-1),mt_rand(0,$H-1),$tmp_c);
    else imagearc($im,mt_rand(0,$W-1),mt_rand(0,$H-1),mt_rand(0,$W-1),mt_rand(0,$H-1),mt_rand(0,360),mt_rand(0,360),$tmp_c);
    }

  if ($maxAngle && function_exists('imagerotate'))
	$im=imagerotate($im,mt_rand(-$maxAngle,$maxAngle),$colorWhite);
//  imagestring($im,1,0,0,$Code,$colorBlack);


  header('Content-Type: image/png');
  imagepng($im);
  exit;
?>
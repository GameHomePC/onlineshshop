<?
  $tmp=dirname(__FILE__);
  include_once("$tmp/_init.php");

  $tmp_id=mt_rand(100000,999999);
  $tmp_url="$SITE_ROOT/CAPTCHA/?$tmp_id";
?>

<style>
.CAPTCHA,
.CAPTCHA TD {
	margin: 0px;
	border: none;
	border-collapse: collapse;
	padding: 0px;
	background: transparent;
	text-align: left;
font-size: 11px;
	}
.CAPTCHA IMG,
.CAPTCHA IFRAME {
	margin-right: 10px;
	}
.CAPTCHA INPUT {
	width: <?= $captchaLength*12 ?>px;
	}
</style>

<script>
function captchaCheck(f,fieldName) {
  var tmp=fieldName || '<?= $captchaDefaultInputName ?>'
  tmp=f.elements[tmp]
  if (tmp && tmp.value.length!=<?= $captchaLength ?>) {
    alert('Enter full confirmation code please')
    tmp.focus()
    return false
    }
  return true
  }

function captchaReload(id) {
  var el=document.getElementById(id)
  var tmp
  if (el && (tmp=el.src)) el.src=tmp+'-'
  return false;
  }
</script>

<table class="CAPTCHA">
<tr>
  <td>
<? if (!$captchaForceUseIframe && function_exists('imagecreate')) { ?>
<image src="<?= $tmp_url ?>" ID="CAPTCHA" _align=left>
<? } else { ?>
<iframe src="<?= $tmp_url ?>" ID="CAPTCHA" 
	width=<?= $captchaLength*30 ?> height=50 _align=left
	leftmargin=0 topmargin=0 marginwidth=0 marginheight=0 bgColor=#FFFFFF
	frameborder=0 scrolling=no style='background-color:#FFFFFF;'></iframe>
<? } ?>
  </td>
  <td>
Enter confirmation code:
<input type=hidden name='<?= $captchaDefaultInputNameID ?>' value="<?= $tmp_id ?>">
<input type=text name='<?= $captchaDefaultInputName ?>' size=<?= $captchaLength ?> maxlength=<?= $captchaLength ?>><br>
(if you can not reed it, click <a href='#' onClick="return captchaReload('CAPTCHA')"><b>here</b></a>)
  </td>
</tr>
</table>

<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

  $TITLE="Error 404";

  include_once("$ROOT_PATH/common/all_head.php");
?>

<?
if ($RedirectUrl) echo"
<script language=javascript><!--
document.location.replace('",to_js($RedirectUrl),"')
//-->
</script>";
?>

<br>
<div align=center class=txtH><span class=warnH>Error 404:</span> Page not found</div>

<p>Requested page <i><?= "$USUAL_URL_HEADER$REQUEST_URI" ?></i> is not found. 
Maybe, it have never existed or it might be moved or renamed. 
You may try to find it using our 
<a class=txtB href='<?= $SITE_ROOT ?>/map.html'>site map</a>.</p>




<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>

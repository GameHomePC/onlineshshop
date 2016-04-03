<?void();
/* ---!!! NO ANY SYMBOLS ("CR","SPACE",...) BEFORE "<?" !!!--- */

// ----------------------------------------------------------------------------\
  $site_styles=$site_styles_nn=$site_scripts="";

  if ($Site_styles)
    while (list(,$src)=each($Site_styles))
      if ($src) $site_styles.="<link rel=stylesheet type=text/css href='$src'>";

  if ($Site_styles_nn)
    while (list(,$src)=each($Site_styles_nn))
      if ($src) $site_styles_nn.="<link rel=stylesheet type=text/css href='$src'>";

  if ($Site_scripts)
    while (list(,$src)=each($Site_scripts))
      if ($src) $site_scripts.="<script language=javascript src='$src'></script>";
// ----------------------------------------------------------------------------/
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>

<head>
<title><?= $TITLE ?></title>
<meta http-equiv="Content-script-type" content="text/javascript">
<meta http-equiv="Content-Type" content="text/html; charset=<?= $SITE_CHARSET ?>">
<meta http-equiv="Content-Language" content="en">

<?= $Site_head_tags ?>

<?
// ------------------------------------\
  $no_js_url="$SITE_ROOT/error_js.html";
  if (is_array($ADMIN_TYPE) && $PHP_SELF!=$no_js_url)
    echo "<noscript><meta http-equiv='Refresh' content='0;URL=$no_js_url'></noscript>";
// ------------------------------------/
?>

<script language=javascript><!--
var NN=(navigator.appName=='Netscape')
//-->
</script>

<link rel=stylesheet type=text/css href="<?= $SITE_ROOT ?>/init/css/main.css">

<script language=javascript><!--
if (NN) document.write("<link rel=stylesheet type=text/css href='<?= $SITE_ROOT ?>/init/css/main_nn.css'>")
//-->
</script>

<?= $site_styles ?> 

<script language=javascript><!--
if (NN) document.write("<?= $site_styles_nn ?>")
//-->
</script>

<script language=javascript src="<?= $SITE_ROOT ?>/init/js/_init.js.html"></script>

<?= $site_scripts ?>

<? /* <!--link rel="shortcut icon" href="<?= $SITE_ROOT ?>/img/site.ico"--> */ ?>
</head>

<script language=javascript><!--
if (NN4) {
  origWidth=W.innerWidth
  origHeight=W.innerHeight
  W.onresize=function () {
    if (W.innerWidth!=origWidth || W.innerHeight!=origHeight) history.go(0)
    }
  }
//-->
</script>


<?void();
/* ---!!! NO ANY SYMBOLS ("CR","SPACE",...) BEFORE "<?" !!!--- */

// ------------------------------------------------\
  include_once("$ROOT_PATH/common/_head_init.php");
// ------------------------------------------------/

  include_once("$ROOT_PATH/common/all.php");
?>

<script language=javascript><!--
if (T.frames.length) T.location.href=W.location.href
//-->
</script>

<body leftmargin=0 topmargin=0 marginwidth=0 marginheight=0
 bgcolor=#FFFFFF>
<a name="h"></a>

<?
// -------------------------------------------\
  include_once("$ROOT_PATH/common/_head.php");
// -------------------------------------------/
?>

<?
//=============================================================\
if ((!$PageID && $CheckPageExisting) || isset($RedirectUrl)) {
  include("$ROOT_PATH/error404.php");
  exit;
  }
//=============================================================/
?>

<?
  if ($PageData['content1']!='')
    echo str_replace('<%BASE%>',$SITE_ROOT,$PageData['content1']),
	'<p clear=all style="margin:0"></p>';
?>
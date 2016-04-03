<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="Edit robots.txt";
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_head.php");
?>



<?
// ------------------------------------\
  report_ok($OK,'File was successfully saved');
// ------------------------------------/
?>


<?
// ============================================================================\
?>
<a name="edit"></a>

<form name="update" action="update.php#edit" method=POST
	onSubmit='return formSubmitOnce(this)'>
<table border=0 cellspacing=0 cellpadding=1 class="border">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2 width=500>

<tr valign=baseline class="bgH">
  <td colspan=2 class="txtB">File Content</div></td>
</tr>
<tr valign=baseline class="bgH">
  <td colspan=2 class="bg"><textarea name='content' cols=80 rows=15 wrap=virtual><?= to_html(implode('',@file("$ROOT_PATH/robots.txt"))) ?></textarea></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr class="bgH">
  <td><input class=button type=reset value="Reset"></td>
  <td><input class=buttonH type=submit value="Submit >>"></td>
</tr>

</table>
</td></tr>
</table>
</form>
<?
// ============================================================================/
?>



<?
  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_tail.php");
?>

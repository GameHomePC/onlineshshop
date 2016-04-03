<?void();
// ====================================\
// Input data:
// $ModuleData=array(
//	'textarea' - name of textarea
//	'cols'
//	'rows'
//	)
// ====================================/

if ($ModuleData['cols']<1) $ModuleData['cols']=75;
if ($ModuleData['rows']<1) $ModuleData['cols']=7;
?>


<?
  if (!$Config['use_wysiwyg']) {
    $textarea=$ModuleData['textarea'];
    include("$ROOT_PATH/$ADMIN_DIR/modules/edit_text.php");
    }
?>

  <textarea name='<?= $ModuleData['textarea'] ?>' cols=<?= $ModuleData['cols'] ?> rows=<?= $ModuleData['rows'] ?> wrap=virtual><?= ${$ModuleData['textarea']} ?></textarea><br>

<? if ($Config['use_wysiwyg']) { ?>
  <script language="javascript1.2">
    htmlareaConfig.width = "<?= intval($ModuleData['cols']*7.2) ?>px";
    htmlareaConfig.height = "<?= $ModuleData['rows']*18 ?>px";
    editor_generate('<?= $ModuleData['textarea'] ?>',htmlareaConfig)
  </script>
<? } ?>

<?
  if (!$Config['use_wysiwyg']) {
    include("$ROOT_PATH/$ADMIN_DIR/modules/edit_text_btm.php");
    }
?>

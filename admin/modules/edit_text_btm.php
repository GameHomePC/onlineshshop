<?void();
// ====================================\
// Input data:
// $textarea - name of textarea
// ====================================/
?>



<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=2 alt=''><br>

<?
  $tmp=$textarea.'_nl2br';
?>
<input ID='<?= $tmp ?>' type=checkbox name='<?= $tmp ?>' value=1
	<?= ($$tmp || !(isset($$tmp) || strlen($$textarea))) ? 'checked' : '' ?>>
<label class='note1' for='<?= $tmp ?>'>Convert new lines to '&lt;br&gt;' automatically</label><br>

<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=3 alt=''><br>

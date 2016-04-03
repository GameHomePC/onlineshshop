<?void();
// ====================================\
// Input data:
// $textarea - name of textarea
// ====================================/
?>



<?
  if (!isset($GalleryImgOptions)) {
// ----------------------------------------------------------------------------\
?>
<?
  $GalleryImgOptions='';
  $res=db_query("select comment,alt,width,height,path,name
		from site_gallery as g,uploads as u where g.uplID=u.uplID
		order by time DESC");
  while ($row=@$sql_fetch_assoc($res)) {
    $w=$row['width'];
    $h=$row['height'];
    $altt=to_html($row['alt']);
    $key=to_html("<img src='<%BASE%>/$row[path]/$row[name]' width=$w height=$h border=0 alt='$altt'>");
    $txt=to_html(($row['comment']!='') ? $row['comment'] : $row[name])." [$w x $h]";
    $GalleryImgOptions.="<option value=\"$key\">$txt</option>";
    }
?>

<script language=javascript><!--
function modifyTextEl(textEl,prefix,suffix,insertURL) {
  if (prefix==null) prefix=''
  if (suffix==null) suffix=''
  var url=''
  if (insertURL) {
    if ((url=prompt('Enter link URL',''))==null) return
    prefix='<a href="'+url+'">';
    suffix='</a>';
    }
  textEl.focus()
  var txt=textEl.value
  var selection=document.selection
  var i1=textEl.selectionStart
  var i2=textEl.selectionEnd
  if (selection && selection.createRange) {
    selection=selection.createRange()
    txt=selection.text
    }
  else if (i1 || i1=="0") {
    prefix=txt.substr(0,i1)+prefix
    suffix=suffix+txt.substr(i2)
    txt=txt.substr(i1,i2-i1)
    }
  else {
    prefix=txt+prefix
    txt=''
    }
  if (txt=='' && insertURL && (txt=prompt('Enter link text',url))==null) return
  txt=prefix+txt+suffix
  if (selection) selection.text=txt
  else textEl.value=txt
  textEl.focus()
  return false
  }
function modifyTextElColor(textEl,selEl) {
  var color=selEl.options[selEl.selectedIndex].value
  return modifyTextEl(textEl,'<font color='+color+'>','</font>')
  }
function modifyTextElImg(textEl,selEl) {
//  var base=textEl.fullPathImg ? URL_HEADER : SITE_ROOT
  var ind=selEl.selectedIndex
  var img=(ind<0) ? '' : selEl.options[ind].value	//.replace('<%BASE%>',base)
  return modifyTextEl(textEl,'',img)
  }
//-->
</script>
<?
// ----------------------------------------------------------------------------/
    }
?>

<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=2 alt=''><br>

Font Color:
<select style='background:#CCCCCC'
	onChange="modifyTextElColor(this.form.<?= $textarea ?>,this)">
<option style='color:#001F34' value="#001F34">Default</option>
<option style='color:darkred' value="darkred">Dark-red</option>
<option style='color:red' value="red">Red</option>
<option style='color:orange' value="orange">Orange</option>
<option style='color:brown' value="brown">Brown</option>
<option style='color:yellow' value="yellow">Yellow</option>
<option style='color:green' value="green">Green</option>
<option style='color:olive' value="olive">Olive</option>
<option style='color:cyan' value="cyan">Light-blue</option>
<option style='color:blue' value="blue">Blue</option>
<option style='color:darkblue' value="darkblue">Dark-blue</option>
<option style='color:indigo' value="indigo">Indigo</option>
<option style='color:violet' value="violet">Violet</option>
<option style='color:white' value="white">White</option>
<option style='color:black' value="black">Black</option>
</select>
&nbsp;
<input type=button value=' B ' style='width:30;font-weight:bold'
	title='Bold text (<b>text</b>)'
	onClick="modifyTextEl(this.form.<?= $textarea ?>,'<b>','</b>')">
<input type=button value=' I ' style='width:30;font-style:italic'
	title='Italic text (<i>text</i>)'
	onClick="modifyTextEl(this.form.<?= $textarea ?>,'<i>','</i>')">
<input type=button value=' U ' style='width:30;text-decoration:underline'
	title='Underlined text (<u>text</u>)'
	onClick="modifyTextEl(this.form.<?= $textarea ?>,'<u>','</u>')">
&nbsp;
<input type=button value=' Center ' style=''
	title='Centered text (<center>text</center>)'
	onClick="modifyTextEl(this.form.<?= $textarea ?>,'<center>','</center>')">
&nbsp;
<input type=button value=' URL ' style='text-decoration:underline'
	title='Create link (<a href="...">text</a>)'
	onClick="modifyTextEl(this.form.<?= $textarea ?>,'','',1)">

<br>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=3 alt=''><br>

<?
  if (!$GalleryImgDisable) {
// ------------------------------------\
?>
Image from Gallery:
<select style='' name='img_select_for_<?= $textarea ?>'>
<?= $GalleryImgOptions ?>
</select>
<input type=button value=' Insert ' style=''
	title='Insert image from gallery'
	onClick="modifyTextElImg(this.form.<?= $textarea ?>,this.form.img_select_for_<?= $textarea ?>)">
&nbsp;
<input type=button value=' CR ' style=''
	title='New line (<br>)'
	onClick="modifyTextEl(this.form.<?= $textarea ?>,'','<br>')">

<br>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=3 alt=''><br>
<?
// ------------------------------------/
    }
?>

Special alias for site base address:
<input type=button value='<%BASE%>' class='hl'
	style='margin:0;border:0;padding:0;background:transparent;vertical-align:top;cursor:hand'
	title='Alias for site base address'
	onClick="modifyTextEl(this.form.<?= $textarea ?>,'','<%BASE%>')">

<br>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=2 alt=''><br>

<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="Manufacturers";
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_head.php");
?>


<?
// ============================================================================\

  $ID=(int)$ID;
  if ($ID<0) $ID=0;

// ============================================================================/
?>

<a name="edit"></a>

<?
// ------------------------------------\
  report_ok($OK);
  report_error($error);
// ------------------------------------/
?>

<table border=0 cellspacing=0 cellpadding=0>
<tr valign=top>
  <td>
<?
// ============================================================================\
?>

<div class=head>&nbsp; Existing Manufacturers:</div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<table border=0 cellspacing=0 cellpadding=1>
<tr><td class="border">
<table border=0 cellspacing=1 cellpadding=2>

<tr valign=baseline class="bgH">
  <td class="txtB" align=center nowrap>Image</td>
  <td class="txtB" nowrap>Name</td>
  <td class="txtB" nowrap>New Values</td>
</tr>

<?
  $res=db_query("select m.mnfID as mnfID,m.uplID as uplID,m.name as name,m.url as url,
			if (mn.content!='',mn.content,m.content) as content,
			mn.mnfID as n_mnfID,mn.name as new_name,
			IF(u.img_not_loaded,u.name,CONCAT(u.path,'/',u.name)) as fname,
			u.width as width,u.height as height,			
			u.img_not_loaded as img_not_loaded
		from sc_manufacturer as m
			left join uploads1 as u on m.uplID=u.uplID
			left join sc_manufacturer_newval as mn on m.mnfID=mn.mnfID
		order by name");
  while ($row=@$sql_fetch_assoc($res)) {
    $img='&nbsp;';
    if ($row['uplID']) {
      if ($row['img_not_loaded'])
	$attrs="width=$row[width] height=$row[height]";
      else {
	$attrs=get_elem(@getimagesize("$SERVER_ROOT/$row[fname]"),3);
	$row['fname']="$SITE_ROOT/$row[fname]";
	}
      $img=($row['url']!='' ? "<a href='$row[url]' target=_blank>" : '').
	   "<img src='$row[fname]' $attrs border=0 align=top alt=''>".
	   ($row['url']!='' ? '</a>' : '');
      }
    call('to_html',array(&$row['name'],&$row['url'],&$row['new_name']));
    if ($row['url']!='') $row['name']="<a href='$row[url]' target=_blank>$row[name]</a>";
    if ($row['new_name']!='') $row['name'].="<br><b class=f1>Redefined: </b><b class=hl>$row[new_name]</b>";
    $row['content']=substr(strip_tags(str_replace('<%BASE%>',$SITE_ROOT,$row['content'])),0,200);

    $tmp=$row['n_mnfID'] ? 'Edit My Values' : 'Setup';
    $class=($ID==$row['mnfID']) ? 'bgHl' : 'bg';
    echo "<tr valign=top class=$class>
	<td align=center valign=top>$img</td>
	<td class=txt><div class=txtB>$row[name]</div>
		<img src='$SITE_ROOT/img/1x1.gif' width=1 height=5 alt=''><br>
		$row[content]</td>
	<td class=txtB><a href='./?ID=$row[mnfID]'>$tmp</a></td>
	</tr>";
    }
?>


</table>
</td></tr>
</table>


<?
// ============================================================================/
?>
  </td>
  <td width=20>&nbsp;&nbsp;&nbsp;</td>
  <td width=1 bgcolor=black><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
  <td width=20>&nbsp;&nbsp;&nbsp;</td>
  <td>
<?
if ($ID) {
// ============================================================================\
?>

<?
// ----------------------------------------------------------------------------\
  @extract(@$sql_fetch_assoc(db_query(
	"select name as name1,content as content1,meta_title as meta_title1,
		meta_keywords as meta_keywords1,meta_description as meta_description1
	from sc_manufacturer where mnfID=$ID")));
	
  if (!isset($error))
    @extract(@$sql_fetch_assoc(db_query("select name,url_name,content,
					meta_title,meta_keywords,meta_description					
				from sc_manufacturer_newval where mnfID=$ID")));

  call('to_html',call('chop',array(
		&$name,&$content,&$meta_title,&$meta_keywords,
		&$meta_description,&$url_name,
		&$name1,&$content1,&$meta_title1,&$meta_keywords1,
		&$meta_description1)));
// ----------------------------------------------------------------------------/
?>

<script language=javascript><!--
function checkUpdate(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  if (!checkUrlName(f.url_name.value)) {
    alert('There are unallowable symbols in Url Name New or / in begin or end of it or Url Name is integer')
    f.url_name.focus()
    return false
    }
  }
//-->
</script>

<form name="update" action="update.php?ID=<?= $ID ?>#edit" method=post
	onSubmit="return formSubmitOnce(this,checkUpdate(this))">
<input type=hidden name='for_no_bag1' value=1>


<div class=head>&nbsp; Edit Product's New Values</div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<?
  $star='<span class=star>*</span>';
?>
<? /*
- Fields marked by <?= $star ?> are required.<br>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>
*/ ?>

<table border=0 cellspacing=0 cellpadding=1 class="border">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2>

<tr valign=baseline class="bgH">
  <td class="txt">Name Inherited:</td>
  <td class="bg"><input type=text name="name1" size=38 maxlength=100 value="<?= $name1 ?>" disabled onFocus='blur()'></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB">Name:</td>
  <td class="bg"><input type=text name="name" size=38 maxlength=100 value="<?= $name ?>"></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td colspan=2 class="txt">Description Inherited</td>
</tr>
<tr valign=baseline class="bgH">
  <td colspan=2 class="bg">
  <textarea name='content1' cols=60 rows=5 wrap=virtual disabled onFocus='blur()'><?= $content1 ?></textarea><br>
  </td>
</tr>
<tr valign=baseline class="bgH">
  <td colspan=2 class="txtB">Description
	<div class=note>(Any HTML-code is allowed)</div></td>
</tr>
<tr valign=baseline class="bgH">
  <td colspan=2 class="bg">
<?
//----------------------------------------------------\
$ModuleData=array(
	'textarea' => 'content',
	'cols' => '60',
	'rows' => '5'
	);
include("$ROOT_PATH/$ADMIN_DIR/modules/textarea.php");
//----------------------------------------------------/
?>
  </td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txtB">Url Name:<div class=f1>(for Apachee ModeRewrite)</div></td>
  <td class="bg"><input type=text name="url_name" size=32 maxlength=255 value="<?= $url_name ?>"></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td colspan=2 class="hl">Meta-data</td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt">Title Inherited:</td>
  <td class="bg"><input type=text name="meta_title1" size=32 maxlength=1024 value="<?= $meta_title1 ?>" disabled onFocus='blur()'></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB">Title:</td>
  <td class="bg"><input type=text name="meta_title" size=32 maxlength=1024 value="<?= $meta_title ?>"></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txt">Keywords Inherited:</td>
  <td class="bg"><input type=text name="meta_keywords1" size=38 value="<?= $meta_keywords1 ?>" disabled onFocus='blur()'></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB">Keywords:</td>
  <td class="bg"><input type=text name="meta_keywords" size=38 value="<?= $meta_keywords ?>"></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txt">Description Inherited:</td>
  <td class="bg"><input type=text name="meta_description1" size=38 value="<?= $meta_description1 ?>" disabled onFocus='blur()'></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB">Description:</td>
  <td class="bg"><input type=text name="meta_description" size=38 value="<?= $meta_description ?>"></td>
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
<input type=hidden name='for_no_bag2' value=1>
</table>
</form>

<?
// ============================================================================/
  }
?>
  </td>
</tr>
</table>

<?
  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_tail.php");
?>

<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="Additional Product Lists";
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_head.php");

// --------------------------------------------------\
  include_once("$ROOT_PATH/modules/sc_category.php");
// --------------------------------------------------/
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

<script language=javascript><!--
function checkUpdateG(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  }
//-->
</script>

<div class=head>&nbsp; Existing Product Lists:</div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<table border=0 cellspacing=0 cellpadding=1>
<tr><td class="border">
<table border=0 cellspacing=1 cellpadding=2>

<form action='update_group.php' method=post
  onSubmit='return formSubmitOnce(this,checkUpdateG(this))'>

<tr valign=baseline class="bgH">
  <td class="txtB" nowrap>Active</td>
  <td class="txtB" nowrap>Column</td>
  <td class="txtB" nowrap>All Pages</td>
  <td class="txtB" nowrap>List Name</td>
  <td class="txtB" nowrap>Products</td>
  <td class="txtB"><a href='./'>Add</a></td>
</tr>

<?
  $res=db_query("select lstID,name,products,active,col,all_pages
		from sc_list order by name");
  $num_rows=@$sql_num_rows($res);
  while ($row=@$sql_fetch_assoc($res)) {
    $id=$row['lstID'];
    call('to_html',array(&$row['name']));
    $n=substr_count($row['products'],':')-1;
    if ($n<0) $n=0;

    $checked='checked';
    if (!$row['active']) {
      $checked='';
      $row['name']="<span class=inactive>$row[name]</span>";
      }
    $checked_p=$row['all_pages'] ? 'checked' : '';
    $col=get_elem(create_select("col[$id]",$LIST_COLUMN,$row['col']));

    $class=($ID==$row['lstID']) ? 'bgHl' : 'bg';
    echo "<tr valign=baseline class=$class>
	<td class=bgH align=center><input type=checkbox name='active[$id]' value='1' $checked></td>
	<td class=bgH align=center>$col</td>
	<td class=bgH align=center><input type=checkbox name='all_pages[$id]' value='1' $checked_p></td>
	<td class=txtB>$row[name]</td>
	<td class=txtB align=center><a href='$ADMIN_ROOT/sc_product/?lstID=$row[lstID]&s_SF=1'>$n</a></td>
	<td class=txtB>
		<a href='./?ID=$row[lstID]'>Edit</a> /
		<a href='delete.php?ID=$row[lstID]'
		onClick='return makeSure()'>Delete</a>
	</td>
	</tr>";
    }
?>

<? if ($num_rows) { ?>
<tr class="bg">
  <td colspan=3 class="bgH"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=7 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>
<tr class="bg">
  <td colspan=3 align=center class="bgH"><input class=buttonH type=submit value="Submit >>"></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>
<? } ?>

</form>

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
// ============================================================================\
?>


<?
// ----------------------------------------------------------------------------\
  $Repeat=isset($error);
  $DBdata=($ID && !$Repeat);
  if ($DBdata) {
	@extract(@$sql_fetch_assoc(db_query(
			"select * from sc_list where lstID=$ID")));
	$categories=explode(':',$categories);
	}
  elseif (!$Repeat) {
	$active=1;
	$all_pages=1;
	}
  if (!is_array($categories)) $categories=array();

  call("to_html",call("chop",array(&$name)));
  $categories=array_filter(call('intval',$categories));
// ----------------------------------------------------------------------------/
?>


<script language=javascript><!--
function checkUpdate(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  if (!f.name.value.length) {
    alert('Enter list name')
    f.name.focus()
    return false
    }
  }
//-->
</script>

<form name="update" action="update.php?ID=<?= $ID ?>#edit" 
	method=post onSubmit="return formSubmitOnce(this,checkUpdate(this))">

<div class=head>&nbsp; <?= (!$ID) ? 'Add New Product List' : 'Edit Product List' ?></div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>
<?
  $star='<span class=star>*</span>';
?>
- Fields marked by <?= $star ?> are required.<br>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<table border=0 cellspacing=0 cellpadding=1 class="border">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2>

<tr valign=baseline class="bgH">
  <td class="txt">Active:</td>
  <td class="bg"><input type=checkbox name="active" value="1" <?= $active ? 'checked' : '' ?>></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txtB"><?= $star ?> Name:</td>
  <td class="bg"><input type=text name="name" size=33 maxlength=100 value="<?= $name ?>"></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Site Column:</td>
  <td class="bg"><?= get_elem(create_select('col',$LIST_COLUMN,$col)) ?></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txt">Show on All Pages:</td>
  <td class="bg"><input type=checkbox name="all_pages" value="1" <?= $all_pages ? 'checked' : '' ?>></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Or in categories:</td>
  <td class="bg"><?= get_elem(create_select('categories[]',$CategItems,$categories,0,'makeCategItemOption2',0,0,7)) ?></td>
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
  </td>
</tr>
</table>


<?
  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_tail.php");
?>
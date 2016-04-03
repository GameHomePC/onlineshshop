<? void(); ?>

  </td>
  <td width=0>
    <img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=145 height=1 alt=''><br>
<?
//------------------------------------------------------------------------------------\
?>

<table border=0 width=100% cellspacing=0 cellpadding=0 background="<?= $SITE_ROOT ?>/img/left_vmenu.gif" class='infoBoxHead'>
<tr>
  <td width=18><img src="<?= $SITE_ROOT ?>/img/left_vmenu1.gif" alt="" width=18 height=22></td>
  <td width=100% nowrap class=infoBoxHead>Shopping Cart</td>
<? if ($SC_QUANTITY) { ?>
  <td style='padding-right:8'><a href="<?= $SITE_ROOT ?>/sc.html" rel='nofollow'><img src='<?= $SITE_ROOT ?>/img/buttons/viewcart.gif' width=16 height=16 alt='View Cart'></a></td>
<? } ?>
</tr>
</table>
<table border=0 width=100% cellspacing=0 cellpadding=1 class=border>
<tr><td>
<table border=0 width=100% cellspacing=0 cellpadding=3 class=bg>
<tr>
  <td align=left style='padding-top:10;padding-bottom:10;'>

<?
 if ($NO_EXTERNAL) {
//----------------------------------------------------\
?>
<a href='<?= $SC_SITE_URL ?>/sc/sc.php?shop=<?= $SHOP_ID ?>' rel='nofollow' title='View Cart'><script language=javascript src='<?= $SC_SITE_URL ?>/EXPORT/quantity.php?shop=<?= $SHOP_ID ?>'></script> item(s)</a>
<hr size=1 color=#8E9AD6 width=98%>
<a href='<?= $SC_SITE_URL ?>/sc/sc.php?shop=<?= $SHOP_ID ?>' rel='nofollow' title='View Cart'>View Cart</a><br>
<a href='<?= $SC_SITE_URL ?>/sc/login.php?shop=<?= $SHOP_ID ?>' rel='nofollow' title='Checkout'>Check Out</a><br>
<?
//----------------------------------------------------/
   }
 elseif ($SC_QUANTITY) {
//----------------------------------------------------\
?>
<a href='<?= $SITE_ROOT ?>/sc.html' rel='nofollow' title='View Cart'><?= $SC_QUANTITY ?> item(s)</a>
<hr size=1 color=#8E9AD6 width=98%>
<a href='<?= $SITE_ROOT ?>/sc.html' rel='nofollow' title='View Cart'>View Cart</a><br>
<a href='<?= $SECURE_URL_HEADER ?>/<?= $CUSTOMER_ID ? 'addresses.html' : 'choice.html' ?>' rel='nofollow' title='Checkout'>Check Out</a><br>
<?
//----------------------------------------------------/
   }
 else echo '<center style="color:#900000">Empty</center>';
?>

  </td>
</tr>
</table>
</td></tr>
</table>

<?
//------------------------------------------------------------------------------------<
?>

<?
//-----------------------------------------------\
$ModuleData=array(
	'header' => 'Bestsellers',
	'condition' => '',
	'order' => 'p.num_choosed desc,priority,rand()',
	'block_head' => "<img src='$SITE_ROOT/img/1x1.gif' width=1 height=4 alt=''><br>"
	);
include("$ROOT_PATH/modules/products_block.php");
//-----------------------------------------------/
?>

<?
//------------------ Lists ---------------------------------\
$tmp=$CatID ? "categories like '%:$CatID:%'" : 0;
$res=db_query("select name,products from sc_list
		where active and col=1 and length(products)>2 and
			(all_pages or $tmp)");
while ($lst=@$sql_fetch_assoc($res))
  if ($prds=array_filter(call('intval',explode(':',$lst['products'])))) {
//-----------------------------------------------\
$ModuleData=array(
	'header' => $lst['name'],
	'condition' => 'p.prdID in ('.implode(',',$prds).')',
	'order' => 'priority,rand()',
	'block_head' => "<img src='$SITE_ROOT/img/1x1.gif' width=1 height=4 alt=''><br>"
	);
include("$ROOT_PATH/modules/products_block.php");
//-----------------------------------------------/
    }
//----------------------------------------------------------/
?>

<?
//------------------------------------------------------------------------------------/
?>
  </td>
</tr>
</table>

<br>
<table border=0 width=100% cellspacing=0 cellpadding=10 style='background-color:#8E9AD6'>
<tr>
  <td align=center><b style='color:#FFFFFF;'>Copyright &copy; 2003 <?= $Config['site_name'] ?></b></td>
</tr>
</table>

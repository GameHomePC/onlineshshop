<?void();
/* -----!!! NO SYMBOLS ("CR","SPACE", ...) BEFORE "<?" OR AFTER "?>" !!!----- */
/*
// ============================================================================\

Functions:
	make_option($name,$price,$text=0)
	make_form($Product,$index=0,$quantity=1,$max_quantity=1000000,
		continueCat=0,$attr=0,$quest=0)

// ============================================================================/
*/


// ------------------------\
// Settings
// ----------------------------------------------------------------------------\
//  $popup_param="location=no,toolbar=no,directories=no,menubar=no,status=no,scrollbars=yes,resizable=yes,dependent=no,width=500,height=500,left=50,top=50,screenX=50,screenY=50";

  $FORM=array(
        "first_option" => array(
			0 => "----- Choose One -----",
			1 => "---------- None ----------" ),
	"action" => array(
			0 => $NO_EXTERNAL ? "$SC_SITE_URL/sc/order.php" : "$SITE_ROOT/buy.html",
			1 => "$SITE_ROOT/item_update.html" ),
	"help_link" => "
		<a href='#' onClick='alert(\"<%HELP_JS%>\"); return false'><img
		src='$SITE_ROOT/img/q.gif'
		width=13 height=13 border=0 alt='<%HELP%>'></a>",
//	"help_link" => "
//		<a href='<%HELP_URL%>' target=_blank
//		 onClick=\"window.open('<%HELP_URL%>','','$popup_param');return false\"><img
//			src='$SITE_ROOT/img/q.gif'
//			width=13 height=13 border=0 alt='Click to get help'></a>",
	// ----------|
        "button_text" => array(
			0 => 'Add to Cart',
			1 => 'Submit Changes >>' ),
	"head" => "
		<table border=0 cellspacing=4 cellpadding=0>
		<form action='<%ACTION%>' method=POST
			onSubmit='return formSubmitOnce(this,calcOrderForm(this,1))'>
		<tr><td colspan=2><img src='$SITE_ROOT/img/1x1b.gif' width=100% height=1 alt=''></td></tr>",
	"line" => "
		<tr valign=baseline>
		<td align=right nowrap><%HELP_LINK%>
		<b><%NAME%>:</b></td>
		<td nowrap><%OPTIONS%></td></tr>",
	"tail" => "
		<tr><td colspan=2><img src='$SITE_ROOT/img/1x1b.gif' width=100% height=1 alt=''></td></tr>
		<tr valign=baseline>
		<td align=right><b><u>Quantity:</u></b></td>
		<td nowrap>
		  <input type=text name='quantity' size=7 maxlength=7 value='<%QUANTITY%>'
			onKeyUp='if (this.value.length) return calcOrderForm(this.form)'
			onChange='calcOrderForm(this.form)'>
		</tr>
		<tr valign=baseline>
		<td align=right nowrap><b><u>Total Price:</u> \$</b></td>
		<td nowrap>
		  <input type=text name='total' size=7 value='<%TOTAL%>' disabled onFocus='blur()'>
		  <input type=button class=button value='Recalculate' onClick='calcOrderForm(this.form,1)'></td>
		</tr>
		<tr><td colspan=2><img src='$SITE_ROOT/img/1x1b.gif' width=100% height=1 alt=''></td></tr>
		<tr>
	          <td align=right>&nbsp;&nbsp;&nbsp;<input class=button type=reset value='Reset'>&nbsp;</td>
		  <td>&nbsp;&nbsp;&nbsp;<input class=buttonH type=submit value='<%BUTTON_TEXT%>'></td>
		</tr>
		</form>
		</table>"
	);
// ----------------------------------------------------------------------------/


// -----------------\
// Make option line
// ------------------------------------\
function make_option($name,$price,$text=0) {
  return ($text ? $name : to_html($name)).
	((double)$price ? " (".((double)$price>0 ? '+' : '-').'$'.abs($price).')' : "");
  }
// ------------------------------------/


// -----------------------------\
// Make order form with options
// code is index into SC if it's editig of item
// ------------------------------------\
function make_form($Product,$index=0,$quantity=1,$max_quantity=1000000,
		$continueCat=0,$attr=0,$quest=0) {
  global $FORM,$URL_HEADER,$SHOP_ID,$NO_EXTERNAL,$CategItems;

  $product=$Product['prdID'];
  $attributes=$Product['attributes'];
  $price=$Product['Price'];
  $total=$price;

  $index=max((int)$index,0);
  $quantity=max((int)$quantity,1);
  $max_quantity=(int)$max_quantity;
  if ($max_quantity<0) $max_quantity=1000000;
  $continueCat=(int)$continueCat;
  if ($continueCat<2) $continueCat=0;

  @extract($FORM);

  $tmp="<input type=hidden name='product' value='$product'>
	<input type=hidden name='index' value='$index'>
	<input type=hidden name='price' value='$price'>
	<input type=hidden name='max_quantity' value='$max_quantity'>";
  if ($NO_EXTERNAL) {
    $tmp.="<input type=hidden name='shop' value='$SHOP_ID'>";
    if ($continueCat)
	$tmp.="<input type=hidden name='return_url' value='$URL_HEADER/{$CategItems[$continueCat][href]}'>";
    }
  else
    $tmp.="<input type=hidden name='continueCat' value='$continueCat'>";
	
  $tmp_js=array();  
  foreach ($attributes as $i=>$f) {
    $ft=$attr ? $attr[$i] : -1;
    $t=(int)$f['type'];
    $options=$blocks='';
    $options_js=array();
    foreach ($f['options'] as $j=>$o) {
      $id="el-$product-$i-$j";
      $pr=$o['price'];
      $text=make_option($o['name'],$pr);
      $curr=(($t<2) ? ($ft==$j) : $ft[$j]) ? 1 : 0;
      if ($curr) $total+=$pr;
      $block=(($q=$o['question'])=='') ? '' : 
		"<script>writeBlock('".to_js("$id-block")."','".
			to_js("- ".to_html($q).
				"<br><textarea name='quest[$i][$j]' cols=20 rows=2 wrap=virtual>".to_html($quest[$i][$j])."</textarea>").
			"',$curr)</script>";
      if ($t<2) {
        $state=$curr ? 'selected' : '';
        $options.="<option ID='$id' value='$j' $state>$text</option>";
        $blocks.=$block;
        }
      else {
        $state=$curr ? 'checked' : '';
        $options.="<nobr><input ID='$id' type=checkbox name='attr[$i][$j]' value='1' $state
			onClick='calcOrderForm(this.form)'><label for='$id'>$text</label></nobr><br>$block";
        }
      $options_js[]="$j,$pr";
      }
    if ($t<2) {
      $state=($ft<0) ? 'selected' : '';
      $options="<select name='attr[$i]' onChange='calcOrderForm(this.form)'>
		<option value='-1' $state>$first_option[$t]</option>$options
		</select><br>$blocks";
      }
    $help_lnk=($f['description']=='') ? '' :
		str_replace(array('<%HELP%>','<%HELP_JS%>'),
			array(to_html($f['description']),to_js($f['description'])),
			$help_link);
    $tmp.=str_replace(
		array("<%NAME%>","<%OPTIONS%>","<%HELP_LINK%>"),
		array(to_html($f["name"]),$options,$help_lnk),
		$line
		);
    $tmp_js[]="$i,AssocArray('type',$t,'options',AssocArray(".implode(",",$options_js)."))";
    }
  $attributes_js="AssocArray(".implode(",",$tmp_js).")";
  $pricing_js='';
  foreach ($Product['Pricing'] as $opt => $price)
    $pricing_js.="PRICING['$product'][$opt]=$price;";
  $ind=$attr ? 1 : 0;
  return
	"<script language=javascript type='text/javascript'>
	ATTRIBUTES['$product']=$attributes_js
	PRICING['$product']=Array(); $pricing_js
	</script>\n".
	str_replace("<%ACTION%>",$action[$ind],$head).
	$tmp.
	str_replace(
		array("<%TOTAL%>","<%QUANTITY%>","<%BUTTON_TEXT%>"),
		array(sprintf('%.2f',$total*$quantity),$quantity,$button_text[$ind]),
		$tail);
  }
// ------------------------------------------/
?>
<?
// ====================================\
@include_once('_dir.php');
// ====================================/

if ($SC_QUANTITY) {
    $Res=_LOAD_DATA("$SC_SITE_URL/EXTERNAL/cart.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&new_update_url=".to_url('cart_update.html').'&new_edit_item_url='.to_url('item_edit.html').'&new_cancel_discount_url='.to_url('discount.html?delete=1'));
    $Error=get_error($Res);

    if (!$Error && !$DISCOUNT_ID) {
        $Res_d=_LOAD_DATA("$SC_SITE_URL/EXTERNAL/discount_form.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&discount_code=".to_url($discount_code).'&new_discount_url='.to_url('discount.html'));
        $Error=get_error($Res_d);
    }
}

$continueCat=(int)$continueCat;
if ($continueCat<2) $continueCat=-1;

include_once("$ROOT_PATH/common/all_head.php");


/* debug $Res */
$htmlCart = '
<div class="checkout">


<table border="0" cellspacing="0" cellpadding="0" class="border" width="95%">
<tbody><tr><td>
<table border="0" cellspacing="1" cellpadding="4" width="100%">
<tbody><tr class="bgH">
  <td colspan="2">
<b>Cart Info:</b>  </td>
</tr>
<tr class="bg">
  <td>There are 1 items in your shopping cart for total price</td>
  <td align="right"><b>$5.50</b></td>
</tr>





<tr class="bgH">
  <td><b>TOTAL:</b></td>
  <td align="right"><b>$5.50</b></td>
</tr>


<tr class="bg">
  <td colspan="2" align="left">

<form action="discount.html?from=1" method="post" onsubmit="return formSubmitOnce(this,checkFilled(this.discount_code,'Enter Code'))">
<input type="hidden" name="SHOPXML_SESSION" value="2b95f840d0f8c6e517bac2f355e6feba">	&nbsp; Get Discount (enter coupon/voucher code)
	<input type="text" name="discount_code" size="10" maxlength="50" value="">
	<input type="submit" class="button" value="Apply >>" style="margin-bottom:-1;">
</form>

  </td>
</tr>


</tbody></table>
</td></tr>
</tbody></table>
<br>


<form action="addresses_process.html" style="margin:0" method="POST" name="update" onsubmit="return formSubmitOnce(this,checkInfo(this))" onreset="setTimeout('changeCountry1();changeCountry2();',10)">

<table border="0" cellspacing="0" cellpadding="0" class="border" width="95%">
<tbody><tr><td>
<table border="0" cellspacing="1" cellpadding="2" width="100%">
<tbody><tr>
  <td class="bgH" width="30%"><b>&nbsp;Ship-To Address:</b></td>
  <td class="bgH" width="70%"><select name="sel_addr2" size="1"><option value="0" selected="">----- Entered Below -----</option></select></td>
</tr>
</tbody></table>
</td></tr>
</tbody></table>

<div id="addr2" style="display:block">
<table border="0" cellspacing="0" cellpadding="0" class="border" width="95%">
<tbody><tr><td>
<table border="0" cellspacing="1" cellpadding="2" width="100%">
<tbody><tr class="bg">
  <td align="right" width="30%"><b><span class="sc_warn">*</span> First Name:&nbsp;</b></td>
  <td class="bg" width="70%"><input type="text" name="first_name2" size="30" maxlength="50" value="ffsdfsdf"></td>
</tr>
<tr class="bg">
  <td align="right"><b><span class="sc_warn">*</span> Last Name:&nbsp;</b></td>
  <td><input type="text" name="last_name2" size="30" maxlength="50" value="sdfsdfsdf"></td>
</tr>
<tr class="bg">
  <td align="right"><b>Company Name:&nbsp;</b></td>
  <td><input type="text" name="company2" size="30" maxlength="50" value=""></td>
</tr>
<tr class="bg">
  <td align="right"><b><span class="sc_warn">*</span> Address:&nbsp;</b></td>
  <td><input type="text" name="address21" size="30" maxlength="100" value=""></td>
</tr>
<tr class="bg">
  <td align="right"><b>Address Continued:&nbsp;</b></td>
  <td><input type="text" name="address22" size="30" maxlength="100" value=""></td>
</tr>
<tr class="bg">
  <td align="right"><b><span class="sc_warn">*</span> City:&nbsp;</b></td>
  <td><input type="text" name="city2" size="30" maxlength="50" value=""></td>
</tr>
<tr class="bg">
  <td align="right"><b><span class="sc_warn">*</span> State/Province:&nbsp;</b></td>
  <td><select name="state2" size="1"><option value="1">Alabama</option><option value="2">Alaska</option><option value="3">American Samoa</option><option value="4">Arizona</option><option value="5">Arkansas</option><option value="6">Armed Forces Africa</option><option value="7">Armed Forces Americas</option><option value="8">Armed Forces Canada</option><option value="9">Armed Forces Europe</option><option value="10">Armed Forces Middle East</option><option value="11">Armed Forces Pacific</option><option value="12">California</option><option value="13">Colorado</option><option value="14">Connecticut</option><option value="15">Delaware</option><option value="16">District of Columbia</option><option value="17">Federated States Of Micronesia</option><option value="18">Florida</option><option value="19">Georgia</option><option value="20">Guam</option><option value="21">Hawaii</option><option value="22">Idaho</option><option value="23">Illinois</option><option value="24">Indiana</option><option value="25">Iowa</option><option value="26">Kansas</option><option value="27">Kentucky</option><option value="28">Louisiana</option><option value="29">Maine</option><option value="30">Marshall Islands</option><option value="31">Maryland</option><option value="32">Massachusetts</option><option value="33">Michigan</option><option value="34">Minnesota</option><option value="35">Mississippi</option><option value="36">Missouri</option><option value="37">Montana</option><option value="38">Nebraska</option><option value="39">Nevada</option><option value="40">New Hampshire</option><option value="41">New Jersey</option><option value="42">New Mexico</option><option value="43">New York</option><option value="44">North Carolina</option><option value="45">North Dakota</option><option value="46">Northern Mariana Islands</option><option value="47">Ohio</option><option value="48">Oklahoma</option><option value="49">Oregon</option><option value="50">Palau</option><option value="51">Pennsylvania</option><option value="52">Puerto Rico</option><option value="53">Rhode Island</option><option value="54">South Carolina</option><option value="55">South Dakota</option><option value="56">Tennessee</option><option value="57">Texas</option><option value="58">Utah</option><option value="59">Vermont</option><option value="60">Virgin Islands</option><option value="61">Virginia</option><option value="62">Washington</option><option value="63">West Virginia</option><option value="64">Wisconsin</option><option value="65">Wyoming</option></select></td>
</tr>
<tr class="bg">
  <td align="right"><b><span class="sc_warn">*</span> Zip/Postal Code:&nbsp;</b></td>
  <td><input type="text" name="zip2" size="10" maxlength="10" value=""></td>
</tr>

<tr class="bg">
  <td align="right"><b><span class="sc_warn">*</span> Country:&nbsp;</b></td>
  <td><select name="country2" size="1"><option value="223" selected="">United States</option><option value="38">Canada</option><option value="13">Australia</option><option value="14">Austria</option><option value="16">Bahamas</option><option value="21">Belgium</option><option value="24">Bermuda</option><option value="30">Brazil</option><option value="50">Cook Islands</option><option value="51">Costa Rica</option><option value="53">Croatia</option><option value="55">Cyprus</option><option value="56">Czech Republic</option><option value="57">Denmark</option><option value="59">Dominica</option><option value="60">Dominican Republic</option><option value="62">Ecuador</option><option value="64">El Salvador</option><option value="67">Estonia</option><option value="69">Falkland Islands (Malvinas)</option><option value="70">Faroe Islands</option><option value="71">Fiji</option><option value="72">Finland</option><option value="73">France</option><option value="76">French Polynesia</option><option value="81">Germany</option><option value="83">Gibraltar</option><option value="84">Greece</option><option value="85">Greenland</option><option value="93">Haiti</option><option value="94">Heard and Mc Donald Islands</option><option value="96">Hong Kong</option><option value="97">Hungary</option><option value="98">Iceland</option><option value="102">Iraq</option><option value="103">Ireland</option><option value="104">Israel</option><option value="105">Italy</option><option value="107">Japan</option><option value="113">Korea, Republic of</option><option value="114">Kuwait</option><option value="117">Latvia</option><option value="122">Liechtenstein</option><option value="123">Lithuania</option><option value="124">Luxembourg</option><option value="125">Macau</option><option value="126">Macedonia, The Former Yugoslav Republic of</option><option value="127">Madagascar</option><option value="130">Maldives</option><option value="132">Malta</option><option value="133">Marshall Islands</option><option value="134">Martinique</option><option value="138">Mexico</option><option value="139">Micronesia, Federated States of</option><option value="141">Monaco</option><option value="143">Montserrat</option><option value="144">Morocco</option><option value="149">Nepal</option><option value="150">Netherlands</option><option value="151">Netherlands Antilles</option><option value="152">New Caledonia</option><option value="153">New Zealand</option><option value="158">Norfolk Island</option><option value="159">Northern Mariana Islands</option><option value="160">Norway</option><option value="163">Palau</option><option value="164">Panama</option><option value="167">Peru</option><option value="170">Poland</option><option value="171">Portugal</option><option value="172">Puerto Rico</option><option value="175">Romania</option><option value="178">Saint Kitts and Nevis</option><option value="179">Saint Lucia</option><option value="180">Saint Vincent and the Grenadines</option><option value="181">Samoa</option><option value="182">San Marino</option><option value="183">Sao Tome and Principe</option><option value="184">Saudi Arabia</option><option value="186">Seychelles</option><option value="187">Sierra Leone</option><option value="188">Singapore</option><option value="189">Slovakia (Slovak Republic)</option><option value="190">Slovenia</option><option value="191">Solomon Islands</option><option value="194">South Georgia and the South Sandwich Islands</option><option value="195">Spain</option><option value="196">Sri Lanka</option><option value="197">St. Helena</option><option value="198">St. Pierre and Miquelon</option><option value="201">Svalbard and Jan Mayen Islands</option><option value="202">Swaziland</option><option value="203">Sweden</option><option value="204">Switzerland</option><option value="206">Taiwan</option><option value="209">Thailand</option><option value="215">Turkey</option><option value="217">Turks and Caicos Islands</option><option value="218">Tuvalu</option><option value="221">United Arab Emirates</option><option value="222">United Kingdom</option><option value="227">Vanuatu</option><option value="228">Vatican City State (Holy See)</option><option value="229">Venezuela</option><option value="231">Virgin Islands (British)</option><option value="232">Virgin Islands (U.S.)</option><option value="233">Wallis and Futuna Islands</option><option value="236">Yugoslavia</option></select></td>
</tr>

<tr class="bg">
  <td align="right"><b><span class="sc_warn">*</span> Telephone:&nbsp;</b></td>
  <td><input type="text" name="tel2" size="30" maxlength="50" value=""></td>
</tr>
</tbody></table>
</td></tr>
</tbody></table>
</div>

<table border="0" cellspacing="0" cellpadding="0" class="border" width="95%">
<tbody><tr><td>
<table border="0" cellspacing="1" cellpadding="2" width="100%">
<tbody><tr valign="top" class="bg">
  <td align="right" width="30%"><b><br>Comments:&nbsp;</b></td>
  <td width="70%"><textarea name="comment" cols="30" rows="3" wrap="virtual"></textarea></td>
</tr>
</tbody></table>
</td></tr>
</tbody></table>

<table border="0" cellspacing="0" cellpadding="0" class="border" width="95%">
<tbody><tr><td>
<table border="0" cellspacing="1" cellpadding="2" width="100%">
<tbody><tr>
  <td class="bgH" width="30%"><b>&nbsp;Bill-To Address:</b></td>
  <td class="bgH" width="70%"><select name="sel_addr1" size="1"><option value="0" selected="">----- Entered Below -----</option>
	<option value="-1">--- Same as Ship-To Address ---</option>
	</select></td>
</tr>
</tbody></table>
</td></tr>
</tbody></table>

<div id="addr1" style="display:block">
<table border="0" cellspacing="0" cellpadding="0" class="border" width="95%">
<tbody><tr><td>
<table border="0" cellspacing="1" cellpadding="2" width="100%">
<tbody><tr class="bg">
  <td align="right" width="30%"><b><span class="sc_warn">*</span> First Name:&nbsp;</b></td>
  <td class="bg" width="70%"><input type="text" name="first_name1" size="30" maxlength="50" value="ffsdfsdf"></td>
</tr>
<tr class="bg">
  <td align="right"><b><span class="sc_warn">*</span> Last Name:&nbsp;</b></td>
  <td><input type="text" name="last_name1" size="30" maxlength="50" value="sdfsdfsdf"></td>
</tr>
<tr class="bg">
  <td align="right"><b>Company Name:&nbsp;</b></td>
  <td><input type="text" name="company1" size="30" maxlength="50" value=""></td>
</tr>
<tr class="bg">
  <td align="right"><b><span class="sc_warn">*</span> Address:&nbsp;</b></td>
  <td><input type="text" name="address11" size="30" maxlength="100" value=""></td>
</tr>
<tr class="bg">
  <td align="right"><b>Address Continued:&nbsp;</b></td>
  <td><input type="text" name="address12" size="30" maxlength="100" value=""></td>
</tr>
<tr class="bg">
  <td align="right"><b><span class="sc_warn">*</span> City:&nbsp;</b></td>
  <td><input type="text" name="city1" size="30" maxlength="50" value=""></td>
</tr>
<tr class="bg">
  <td align="right"><b><span class="sc_warn">*</span> State/Province:&nbsp;</b></td>
  <td><select name="state1" size="1"><option value="1">Alabama</option><option value="2">Alaska</option><option value="3">American Samoa</option><option value="4">Arizona</option><option value="5">Arkansas</option><option value="6">Armed Forces Africa</option><option value="7">Armed Forces Americas</option><option value="8">Armed Forces Canada</option><option value="9">Armed Forces Europe</option><option value="10">Armed Forces Middle East</option><option value="11">Armed Forces Pacific</option><option value="12">California</option><option value="13">Colorado</option><option value="14">Connecticut</option><option value="15">Delaware</option><option value="16">District of Columbia</option><option value="17">Federated States Of Micronesia</option><option value="18">Florida</option><option value="19">Georgia</option><option value="20">Guam</option><option value="21">Hawaii</option><option value="22">Idaho</option><option value="23">Illinois</option><option value="24">Indiana</option><option value="25">Iowa</option><option value="26">Kansas</option><option value="27">Kentucky</option><option value="28">Louisiana</option><option value="29">Maine</option><option value="30">Marshall Islands</option><option value="31">Maryland</option><option value="32">Massachusetts</option><option value="33">Michigan</option><option value="34">Minnesota</option><option value="35">Mississippi</option><option value="36">Missouri</option><option value="37">Montana</option><option value="38">Nebraska</option><option value="39">Nevada</option><option value="40">New Hampshire</option><option value="41">New Jersey</option><option value="42">New Mexico</option><option value="43">New York</option><option value="44">North Carolina</option><option value="45">North Dakota</option><option value="46">Northern Mariana Islands</option><option value="47">Ohio</option><option value="48">Oklahoma</option><option value="49">Oregon</option><option value="50">Palau</option><option value="51">Pennsylvania</option><option value="52">Puerto Rico</option><option value="53">Rhode Island</option><option value="54">South Carolina</option><option value="55">South Dakota</option><option value="56">Tennessee</option><option value="57">Texas</option><option value="58">Utah</option><option value="59">Vermont</option><option value="60">Virgin Islands</option><option value="61">Virginia</option><option value="62">Washington</option><option value="63">West Virginia</option><option value="64">Wisconsin</option><option value="65">Wyoming</option></select></td>
</tr>
<tr class="bg">
  <td align="right"><b><span class="sc_warn">*</span> Zip/Postal Code:&nbsp;</b></td>
  <td><input type="text" name="zip1" size="10" maxlength="10" value=""></td>
</tr>

<tr class="bg">
  <td align="right"><b><span class="sc_warn">*</span> Country:&nbsp;</b></td>
  <td><select name="country1" size="1"><option value="223" selected="">United States</option><option value="38">Canada</option><option value="13">Australia</option><option value="14">Austria</option><option value="16">Bahamas</option><option value="21">Belgium</option><option value="24">Bermuda</option><option value="30">Brazil</option><option value="50">Cook Islands</option><option value="51">Costa Rica</option><option value="53">Croatia</option><option value="55">Cyprus</option><option value="56">Czech Republic</option><option value="57">Denmark</option><option value="59">Dominica</option><option value="60">Dominican Republic</option><option value="62">Ecuador</option><option value="64">El Salvador</option><option value="67">Estonia</option><option value="69">Falkland Islands (Malvinas)</option><option value="70">Faroe Islands</option><option value="71">Fiji</option><option value="72">Finland</option><option value="73">France</option><option value="76">French Polynesia</option><option value="81">Germany</option><option value="83">Gibraltar</option><option value="84">Greece</option><option value="85">Greenland</option><option value="93">Haiti</option><option value="94">Heard and Mc Donald Islands</option><option value="96">Hong Kong</option><option value="97">Hungary</option><option value="98">Iceland</option><option value="102">Iraq</option><option value="103">Ireland</option><option value="104">Israel</option><option value="105">Italy</option><option value="107">Japan</option><option value="113">Korea, Republic of</option><option value="114">Kuwait</option><option value="117">Latvia</option><option value="122">Liechtenstein</option><option value="123">Lithuania</option><option value="124">Luxembourg</option><option value="125">Macau</option><option value="126">Macedonia, The Former Yugoslav Republic of</option><option value="127">Madagascar</option><option value="130">Maldives</option><option value="132">Malta</option><option value="133">Marshall Islands</option><option value="134">Martinique</option><option value="138">Mexico</option><option value="139">Micronesia, Federated States of</option><option value="141">Monaco</option><option value="143">Montserrat</option><option value="144">Morocco</option><option value="149">Nepal</option><option value="150">Netherlands</option><option value="151">Netherlands Antilles</option><option value="152">New Caledonia</option><option value="153">New Zealand</option><option value="158">Norfolk Island</option><option value="159">Northern Mariana Islands</option><option value="160">Norway</option><option value="163">Palau</option><option value="164">Panama</option><option value="167">Peru</option><option value="170">Poland</option><option value="171">Portugal</option><option value="172">Puerto Rico</option><option value="175">Romania</option><option value="178">Saint Kitts and Nevis</option><option value="179">Saint Lucia</option><option value="180">Saint Vincent and the Grenadines</option><option value="181">Samoa</option><option value="182">San Marino</option><option value="183">Sao Tome and Principe</option><option value="184">Saudi Arabia</option><option value="186">Seychelles</option><option value="187">Sierra Leone</option><option value="188">Singapore</option><option value="189">Slovakia (Slovak Republic)</option><option value="190">Slovenia</option><option value="191">Solomon Islands</option><option value="194">South Georgia and the South Sandwich Islands</option><option value="195">Spain</option><option value="196">Sri Lanka</option><option value="197">St. Helena</option><option value="198">St. Pierre and Miquelon</option><option value="201">Svalbard and Jan Mayen Islands</option><option value="202">Swaziland</option><option value="203">Sweden</option><option value="204">Switzerland</option><option value="206">Taiwan</option><option value="209">Thailand</option><option value="215">Turkey</option><option value="217">Turks and Caicos Islands</option><option value="218">Tuvalu</option><option value="221">United Arab Emirates</option><option value="222">United Kingdom</option><option value="227">Vanuatu</option><option value="228">Vatican City State (Holy See)</option><option value="229">Venezuela</option><option value="231">Virgin Islands (British)</option><option value="232">Virgin Islands (U.S.)</option><option value="233">Wallis and Futuna Islands</option><option value="236">Yugoslavia</option></select></td>
</tr>

<tr class="bg">
  <td align="right"><b><span class="sc_warn">*</span> Telephone:&nbsp;</b></td>
  <td><input type="text" name="tel1" size="30" maxlength="50" value=""></td>
</tr>


</tbody></table>
</td></tr>
</tbody></table>
</div>


<table border="0" cellspacing="0" cellpadding="0" class="border" width="95%">
<tbody><tr><td>
<table border="0" cellspacing="1" cellpadding="2" width="100%">


<tbody><tr class="bgH">
  <td width="30%" align="center"><input type="reset" class="button" value=" Reset "></td>
  <td width="70%"><input type="submit" class="buttonH" value="       Submit >>      "></td>
</tr>
</tbody></table>
</td></tr>
</tbody></table>
</form>



    </div>';
/* end debug */
?>


<div class="cart">


    <?php
        if ($message) report_ok(1,$message);
        report_error($error);
    ?>

    <?php
        if ($Error) report_error($Error);
        elseif (!$SC_QUANTITY) echo "<div style='font weight:bold;text-align:center;font-size:14'>Your cart is empty</div>";
        else echo '<div class="cartTop">' . $htmlCart . '</div>';
    ?>




    <?php

        $htmlCode = '
            <table border="0" cellspacing="0" cellpadding="0" width="95%">
        <tbody>
        <tr>
            <td>

                <table border="0" cellspacing="0" cellpadding="0" style="margin-top:20">
                    <tbody>
                    <tr>
                        <td>

                            <form action="discount.html" method="post" onsubmit="">
                                <table border="0" cellspacing="0" cellpadding="0" class="border">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <table border="0" cellspacing="1" cellpadding="4">
                                                <tbody>
                                                <tr class="bgH">
                                                    <td>&nbsp; <b>Get Discount</b>

                                                        <div class="sc_text">(Enter valid discount coupon or gift
                                                            voucher code)
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bg">
                                                    <td align="left">
                                                        Code:
                                                        <input type="text" name="discount_code" size="20" maxlength="50"
                                                               value="">
                                                        <input type="submit" class="button" value="Apply >>"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>

        ';
    ?>





</div>

<?php
    include_once("$ROOT_PATH/common/all_tail.php");
?>
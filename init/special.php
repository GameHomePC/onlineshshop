<?void();
/* -----!!! NO SYMBOLS ("CR","SPACE", ...) BEFORE "<?" OR AFTER "?>" !!!----- */
/*
// ============================================================================\

Functions:
	create_select($name,$source,$default=0,$def_is_num=0,$row_parser=0,
			$start=0,$length=0,$size=1,events="",$head="",$tail="")
	make_page_bar($page_url,$num_rows,$page,$show_pages=0,
			$portion_header=0,$portion=0,$page_portion=0)
	line_explode(&$str,$unique=1)
	word_explode(&$str,$unique=0)
	rand_hex_str($bytes=4)
	check_hex_str($str,$bytes=4)

// ============================================================================/
*/


// ---------------------------------------------------------\
// Create select element or radio/checkbox bar
// (if $size>0 - select else radio/checkbox bar)
// (if $name ends on "[]" - multiple select else checkbox bar)
// ------------------------------------\
function create_select($name,$source,$default=0,$def_is_num=0,$row_parser=0,
			$start=0,$length=0,$size=1,$events="",$head="",$tail="") {
    global $sql_data_seek,$sql_fetch_row,$sql_num_rows;
  $db=is_string($source);
  $mult=(substr($name,-2)=="[]");
  $sel=($size>0);
// ----------------|
  if ($db) {
  $source=db_query($source);
    if ($start) $sql_data_seek($source,$start);
    $func=$sql_fetch_row;
    $l=@$sql_num_rows($source);
    }
  else {
    reset($source);
    for ($i=0; $i<$start; $i++) each($source);
    $func="each";
    $l=sizeof($source);
    }
  $l-=$start;
  $length=$length ? min($length,$l) : $l;
// ----------------|
  if ($mult) {
    $type="checkbox";
    $sel_key=$sel_val=$sel_ind=array();
    }
  else {
    $type="radio";
    $sel_key=$sel_val=$sel_ind=false;
    $default=(string)$default;
    }
// ----------------|
  if ($sel) {
    $mark="selected";
    $str="<select name='$name' size=$size $events".($mult ? " multiple>" : ">").$head;
    }
  else {
    $mark="checked";
    $str="";
    }
// ----------------|
  $return_first=(!$mult && $size<2 && ($head=="" || !$sel));
  $select_first=($return_first &&
		!($def_is_num ? $default<$length :
		 ($db ? ($sel && $default>"") : isset($source[$default]))));
// ----------------\
  for ($ind=0; $row=$func($source),$ind<$length; $ind++) {
    list($key,$val)=$row_parser ? $row_parser($row) : $row;
    list($k,$v,$i)=call("strval",$key,$val,$ind);
    if ($v=="") continue;
    $current=$def_is_num ? $i : $k;
    if ($mult) {
      $marked=($default && in_array($current,$default));
      if ($marked) {
	$sel_key[]=$key;
	$sel_val[]=$val;
	$sel_ind[]=$ind;
	}
      }
    else {
      $is_curr=($default==$current);
      $marked=($is_curr || ($select_first && !$ind));
      if ($is_curr || ($return_first && !$ind)) {
	$sel_key=$key;
	$sel_val=$val;
	$sel_ind=$ind;
	}
      }
    if (!$sel) $html_id="{$name}_{$ind}_".rand();
    $str.=
	($sel ? "<option" : "$head<input type=$type name='$name' id='$html_id' $events").
	" value='$key'".
	($marked ? " $mark>" : ">").
	($sel ? "" : " <label for='$html_id'>").
	to_html($val).
	($sel ? "</option>" : "</label>$tail");
    }
// ----------------/
  if ($sel) $str.="$tail</select>";
  return array($str,$sel_key,$sel_val,$sel_ind);
  }
// ------------------------------------------/


// --------------\
// Make page bar
// (The $page_url must end on "&page=")
// ------------------------------------\
function make_page_bar($page_url,$num_rows,$page,$show_pages=0,
			$portion_header=0,$portion=0,$page_portion=0) {
    global $DEF_PORTION,$MIN_PORTION,$MAX_PORTION,$DEF_PAGE_PORTION;
  if ($portion_header===0) $portion_header=$show_pages ? "&nbsp;Pages:" : "&nbsp;Portions:";
  if ($portion<1) $portion=$DEF_PORTION;
  elseif ($portion<$MIN_PORTION) $portion=$MIN_PORTION;
  elseif ($portion>$MAX_PORTION) $portion=$MAX_PORTION;
  if ($page_portion<1) $page_portion=$DEF_PAGE_PORTION;

  $num_pages=ceil($num_rows/$portion);
// ----------------\
  $curr_portion=$portion;
  if (!$num_pages) $page=$curr_portion=0;
  elseif ($page>=($num_pages-1)) {
    $page=$num_pages-1;
    if ($tmp=$num_rows%$portion) $curr_portion=$tmp;
    }
  elseif ($page<0) $page=0;
// ----------------/
  $big_page=floor($page/$page_portion);
  $big_num_pages=ceil($num_pages/$page_portion);
  $big_portion=$portion*$page_portion;

  $page_bar=array("","", $page,$curr_portion,$num_pages,$portion);

  if ($big_num_pages>1) {
    $tmp_bar="";
    for ($i=$start_page=$start_num=0; $i<$big_num_pages; $i++) {
      if ($selected=($i==$big_page)) $ind=$i;
      $tmp_bar.="<option value='$start_page'".($selected ? " selected>" : ">");
      $opt_page=($start_page+1)." - ".((($start_page+=$page_portion)>$num_pages) ? $num_pages : $start_page);
      $opt_port=($start_num+1)." - ".((($start_num+=$big_portion)>$num_rows) ? $num_rows : $start_num);
      $tmp_bar.=$show_pages ? $opt_page : $opt_port;
      }
    $page_bar[0]=
	"<table border=0 cellspacing=0 cellpadding=3>
	<form name='portion'>
	<input type=hidden name='pageURL' value='$page_url'>
	<input type=hidden name='oldIndex' value='$ind'>
	<tr valign=middle><td class='head'>$portion_header</td>
	<td><small><select name='page' onChange='changePortion(this)'>$tmp_bar</select></small></td>
	</tr></form></table>";
    }

  if ($num_pages>1) {
    $page_bar[1].=$page ?
		"<a href='{$page_url}0'>|&lt;&lt;</a>&nbsp;
		<a href='$page_url".($page-1)."'>&lt;&lt;</a>&nbsp; " :
		"|&lt;&lt;&nbsp; &lt;&lt;&nbsp; ";
    $start_num=$big_page*$big_portion;
    $n1=$big_page*$page_portion;
    $n2=$n1+$page_portion;
    if ($n2>$num_pages) $n2=$num_pages;
    for ($i=$n1; $i<$n2; $i++) {
      $tmp_bar=($show_pages ? $i : $start_num)+1;
      $start_num+=$portion;
      if ($start_num>$num_rows) $start_num=$num_rows;
      if (!$show_pages && $portion>1) $tmp_bar.="-$start_num";
      $page_bar[1].=($i==$page) ?
		"<b>$tmp_bar</b>&nbsp; " :
		"<a href='$page_url$i'>$tmp_bar</a>&nbsp; ";
      }
    $page_bar[1].=((++$page)<$num_pages) ?
		"<a href='$page_url$page'>&gt;&gt;</a>&nbsp;
		<a href='$page_url".($num_pages-1)."'>&gt;&gt;|</a>" :
		"&gt;&gt;&nbsp; &gt;&gt;|";
    }

  return $page_bar;
  }
// ------------------------------------/


// -------------------------------------------------------------\
// Explode string to array by separator "\n" (with or w/o "\r")
// delete head and tail spaces and replace multiple spaces to one space
// ------------------------------------\
function line_explode(&$str,$unique=1) {
  $result=array();
  $l=strlen($str);
  $line="";
  $new_line=1;
  $ch1="";
  for ($i=0; $i<$l; $i++)
    switch ($ch=$str[$i]) {
      case "\r":
	continue;
      case "\n":
	if (! $new_line) {
	  if (! ($unique && in_array($line,$result))) $result[]=$line;
	  $new_line=1;
	  $line=$ch1="";
	  }
	continue;
      case " ":
	if (! $new_line) $ch1=" ";
	continue;
      default:
	$new_line=0;
	$line.="$ch1$ch";
	$ch1="";
      }
  if (! ($new_line || ($unique && in_array($line,$result)))) $result[]=$line;
  return $result;
  }
// ------------------------------------/


// ---------------------------------------------------------------\
// Explode string(line) to array of words by separators " ", "\n"
// ------------------------------------\
function word_explode(&$str,$unique=0) {
  $tmp=explode(" ",str_replace("\n"," ",str_replace("\r","",$str)));
  $result=array();
  while (list(,$word)=each($tmp)) 
    if ($word!="" && !($unique && in_array($word,$result))) $result[]=$word;
  return $result;
  }
// ------------------------------------/


// ---------------------------------------------------\
// Generate string containing random unsigned integer
// in hexadecimal format
// ------------------------------------\
function rand_hex_str($bytes=4) {
  $str='';
  for ($i=0; $i<$bytes; $i++) $str.=sprintf('%02x',rand(0,0xFF));
  return to_upper($str);
  }
// ------------------------------------/


// -----------------------------------------\
// Check if string contain unsigned integer
// in hexadecimal format (with head "0x" chars)
// ------------------------------------\
function check_hex_str($str,$bytes=4) {
  return (strlen($str)==($bytes*2) && check_hex_int($str));
  }
// ------------------------------------/


?>
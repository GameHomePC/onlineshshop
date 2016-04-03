<?void();
//======================================================================\
// input GET:
// $continue
//======================================================================/


//======================================================================\
function getting_base_error($str) {
  global $AUTO_UPDATING;
  if (!$AUTO_UPDATING)
    echo "<center style='color:red;font-size:25;font-weight:bold;'>!!! $str !!!</center>";
  }
//======================================================================/


$XML_LIB_EXISTS=function_exists('xml_parse_into_struct');
$DOMXML_LIB_EXISTS=function_exists('domxml_xmltree');

//----------------------------------------------------\
if (!$XML_LIB_EXISTS && !$DOMXML_LIB_EXISTS) {
  getting_base_error('Main XML-parser library or DOMXML php-library required');
  return;
  }
//----------------------------------------------------/
	

if (!$ROOT_PATH) {
// ====================================\
  $ROOT_PATH="..";

  include_once("$ROOT_PATH/init/main.php");
  include_once("$ROOT_PATH/$ADMIN_DIR/init/main.php");
// ====================================/
    }


//===============================================\
$URL_LEN=strlen($SC_SITE_URL)+1;
$GET_UTF8=$Config['get_utf8'];
// XXX:
$PORTION=min(max(0,(int)$Config['export_portion']),50);
$USE_HTTPS=$Config['use_https'];
$IMG_NOT_LOAD=$Config['img_not_load'] ? 1 : 0;
$IMG_LOGO_ADD=($Config['image_logo']!='');
$IMG_LOGO_REPLACE=($Config['image_logo_old']!=$Config['image_logo']);
$COPY_BY_LINK=function_exists('link');

$EXPORT_CATS=(!$CAN_ADMIN_CATS || !@$sql_num_rows(db_query(
		"select 1 from sc_category where catID=1")));

/*
$SPEC_TYPE=array(
	'Specials' => 1,
	'Featured' => 2
	);
*/

//------------------------------\
@set_time_limit(0);
@ini_set('output_buffering','0');
@ignore_user_abort(1);
@ini_set('allow_url_fopen','On');
//------------------------------/
//===============================================/


//----------------------------------------------------\
if ($GET_UTF8 && !function_exists('utf8_decode')) {
  getting_base_error('For getting base in UTF-8 the php-function utf8_decode() is required');
  return;
  }
//----------------------------------------------------/

//----------------------------------------------------\
if ($IMG_LOGO_ADD && !function_exists('imagecreatefromjpeg')) {
  getting_base_error('Can not add logo to images - function imagecreatefromjpeg() is unavailable');
  return;
  }
//----------------------------------------------------/


if (!$IMG_NOT_LOAD) {
//--------------------------------------------------------------------\
  $tfn='test.writing.possibility';

  $sf=$Config['http_site_folder'];
  $sfs=$Config['https_site_folder'];
  $sf_dif=($sf!=$sfs);

//-------------------------------------\
  if ($USE_HTTPS && $HTTPS && $sf_dif)
    if ($sf=='') {
	getting_base_error("System Path to HTTP Site Root is not setted");
	return;
	}
    else $SITE_ROOT_USUAL=$sf;
  else $SITE_ROOT_USUAL=$SERVER_ROOT;

  $fold="$SITE_ROOT_USUAL/uploads1";
  if (!is_dir($fold)) {
    getting_base_error("HTTP image folder ($fold) does not exists on server");
    return;
    }
  if (!($f=@fopen($fn="$fold/$tfn",'w'))) {
    getting_base_error("NOT ABLE WRITE TO FOLDER $fold");
    return;
    }
  @fclose($f);
  @unlink($fn);
//-------------------------------------/

  $SITE_ROOT_SECURE='';
  if ($USE_HTTPS) {
//-------------------------------------\
  if (!$HTTPS && $sf_dif)
    if ($sfs=='') {
	getting_base_error("System Path to HTTPS Site Root is not setted");
	return;
	}
    else $SITE_ROOT_SECURE=$sfs;
  else $SITE_ROOT_SECURE=$SERVER_ROOT;

  if ($SITE_ROOT_SECURE==$SITE_ROOT_USUAL) $SITE_ROOT_SECURE='';
  else {
//------------------------------\
  $folds="$SITE_ROOT_SECURE/uploads1";
  $l=($COPY_BY_LINK && @is_link($folds));
  if (!is_dir($folds) && !$l) {
    getting_base_error("HTTPS image folder or link ($folds) does not exists on server");
    return;
    }

  if ($l) {
    if (readlink($l)!=$folds) {
      getting_base_error("HTTPS image link ($folds) does not point to main image folder ($fold)");
      return;
      }
    $SITE_ROOT_SECURE='';
    }
  else {
    if (!($f=@fopen($fn="$folds/$tfn",'w'))) {
      getting_base_error("NOT ABLE WRITE TO FOLDER $folds");
      return;
      }
    @fclose($f);
    @unlink($fn);
    }
//------------------------------/
    }
//-------------------------------------/
    }
//--------------------------------------------------------------------/
  }



if (($tmp=$Config['last_time_updating']+30-$TIME)>0) {
  getting_base_error("You must wait about $tmp sec to repeat this operation");
  return;
  }


//====================================================================\
function set_last_time_updating() {
  global $Config;

  $t=time();
  if ($t>$Config['last_time_updating']) {
    $Config['last_time_updating']=$t;
    db_query("update config set last_time_updating=$t");
    }
  }
//====================================================================/
set_last_time_updating();



//====================================================================\

if ($XML_LIB_EXISTS) {
//=============================================================\

$AttrRepl=array('id'=>'ID','categoryid'=>'categoryID','parentid'=>'parentID');

function xml_get_objects($Arr,$Tagname,$start=0) {
  global $AttrRepl,$GET_UTF8;

  $Level=$Arr[$start]['level'];
  $N=sizeof($Arr);
  $Res=array();
  $Tagname=to_lower($Tagname);
  $level=0;
  $n=-1;

  for ($i=$start; $i<$N; $i++) {
    $lev=$Arr[$i]['level'];
    if ($lev<$Level) break;

    $type=$Arr[$i]['type'];
    $tagname=to_lower($Arr[$i]['tag']);
    $value=$Arr[$i]['value'];

    if ($tagname==$Tagname)
      if ($type=='close') {
	$level=0;
	$Pointer=array();
	}
      elseif ($level) {
	list($tmp,$i)=xml_get_objects($Arr,$Tagname,$i);
	$Res=array_merge($Res,$tmp);
	unset($tmp);
	$n=sizeof($Res)-1;
	}
      else {
	$n++;
	if ($Arr[$i]['attributes'])
	  foreach ($Arr[$i]['attributes'] as $k => $v)
	    $Res[$n][$AttrRepl[$k=to_lower($k)] ? $AttrRepl[$k] : $k]=$v;
	if ($type=='open') {
	  $level=$lev;
	  $Pointer[$lev]=&$Res[$n];
	  }
	else {
	  $level=0;
	  $Pointer=array();
	  }
	}
    elseif ($type!='close') {
      unset($Pointer[$lev]);
      if ($value!='') $Pointer[$lev-1][$tagname]=$GET_UTF8? utf8_decode($value) : $value;
      else {
	$Pointer[$lev-1][$tagname]=array();
	$Pointer[$lev]=&$Pointer[$lev-1][$tagname];
	if ($Arr[$i]['attributes'])
	  foreach ($Arr[$i]['attributes'] as $k => $v)
	    $Pointer[$lev][$AttrRepl[$k=to_lower($k)] ? $AttrRepl[$k] : $k]=$v;
	}
      }
    }

  return $start ? array($Res,$i) : $Res;
  }

//=============================================================/
  }
elseif ($DOMXML_LIB_EXISTS) {
//=============================================================\

function dom_create_object($Obj,$Tagnames) {
  global $GET_UTF8;

  $n=@sizeof($Obj->children);

  if ($n==1 && ($Obj->children[0]->type==3 || $Obj->children[0]->type==4))
    return trim(($GET_UTF8||1) ? // ||1 - таракан какой-то в домхмл-либе
	utf8_decode($Obj->children[0]->content) :
	$Obj->children[0]->content);

  $Arr=array();

  for ($i=0; $i<$n; $i++)
    if ($Obj->children[$i]->type==1 && !$Tagnames[$Obj->children[$i]->tagname])
	$Arr[$Obj->children[$i]->tagname]=dom_create_object($Obj->children[$i],$Tagnames);

  $n=@sizeof($Obj->attributes);
  for ($i=0; $i<$n; $i++)
    $Arr[$Obj->attributes[$i]->name]=$Obj->attributes[$i]->value;

  return $Arr;
  }

//-------------------------------------------------------------|

function dom_get_objects($Obj,$Tagname) {
  $Arr=array();

  $n=@sizeof($Obj->children);
  for ($i=0; $i<$n; $i++)
    if ($Obj->children[$i]->type==1) {
	if ($Obj->children[$i]->tagname==$Tagname)
	  $Arr[]=dom_create_object($Obj->children[$i],array($Tagname=>1));
	$Arr=array_merge($Arr,dom_get_objects($Obj->children[$i],$Tagname));
	}

  return $Arr;
  }

//=============================================================/
  }


//--------------------------------------------------------------------|

// XXX:
function get_objects($Script,$Params,$Tagname,$method='GET') {
  global $SC_SITE_URL,$SHOP_ID,$GET_UTF8,
	$DOMXML_LIB_EXISTS,$XML_LIB_EXISTS;

  $url="$SC_SITE_URL/EXPORT/$Script?shop=$SHOP_ID&GET_UTF8=$GET_UTF8&$Params";
// XXX:
  if ($method!='GET' || !is_string($str_full=@file_get_contents($url)))
    $str_full=_LOAD_DATA($url,$method);

  if ($XML_LIB_EXISTS) {
    $vals=$index=array();
    $prs=xml_parser_create($GET_UTF8 ? 'UTF-8' : 'ISO-8859-1');
    xml_parse_into_struct($prs,$str_full,$vals,$index);
    xml_parser_free($prs);
    unset($str_full);
    return xml_get_objects($vals,$Tagname);
    }
  elseif ($DOMXML_LIB_EXISTS)
    return dom_get_objects(domxml_xmltree($str_full),$Tagname);

  return false;
  }

//--------------------------------------------------------------------|

function write_logo($file,$text,$size=3,$mrg=3) {
  if ($text=='') return;
  list($W,$H,$T)=@getimagesize($file);
  if (!$W || !$H) return;

  if ($T==1) $IM=@imagecreatefromgif($file);
  elseif ($T==2) $IM=@imagecreatefromjpeg($file);
  elseif ($T==3) $IM=@imagecreatefrompng($file);
  else return;
  if (!$IM) return;

  $w=@imagefontwidth($size)*strlen($text);
  $h=@imagefontheight($size);
  $x1=(($W-2*$mrg)<$w) ? $mrg : $W-$w-$mrg;
  $y1=(($H-2*$mrg)<$h) ? $mrg : $H-$h-$mrg;
  $tmp=@imagecolorat($IM,$x1,$y1);
  $R=$tmp>>16;
  $G=$tmp>>8&255;
  $B=$tmp&255;
  $c=(($R+$G+$B)>(127*3)) ? 55 : 200;
  @imagestring($IM,$size,$x1,$y1,$text,@imagecolorallocate($IM,0,0,150));

  if ($T==1) @imagegif($IM,$file);
  elseif ($T==2) @imagejpeg($IM,$file,90);
  elseif ($T==3) @imagepng($IM,$file);
  @imagedestroy($IM);
  }

//--------------------------------------------------------------------|

function _upload_file($src='',$filesize,
			$objID=0,$obj_type=0,$num=0,$width=0,$height=0) {
  global $Config,$SC_SITE_URL,$URL_LEN,$sql_insert_id,$sql_result,$sql_query,
	$SITE_ROOT_USUAL,$SITE_ROOT_SECURE,
	$IMG_NOT_LOAD,$IMG_LOGO_ADD,$IMG_LOGO_REPLACE,$COPY_BY_LINK;

  $src=trim($src);
  call('intval',array(&$filesize,&$width,&$height,&$objID,&$obj_type,&$num));
  if ($src=='' || $filesize<1 || $width<0 || $height<0 ||
	$objID<0 || $obj_type<0 || $num<0) return 0;

  if ($IMG_NOT_LOAD) {
    $name=$src;
    $path='';
    }
  else {
//--------------------------------------------------------\
  $arr=explode('/',substr($src,$URL_LEN));
  $src=$SC_SITE_URL.'/'.@implode('/',@call('to_url',$arr));

  $n=sizeof($arr)-1;
  if ($n<0) return 0;
  $name=$arr[$n];
  unset($arr[$n]);
  $path=implode('/',$arr);

  if (strpos($path,'uploads/')===0) $path=str_replace('uploads/','uploads1/',$path);
  elseif (strpos($path,'uploads1/')!==0) $path='uploads1'.($path=='' ? '' : "/$path");

  $newfile="$SITE_ROOT_USUAL/$path/$name";
  $newfile1="$SITE_ROOT_SECURE/$path/$name";

  $filesize_old=($objID && $Config['image_logo_old']!='') ?
	@$sql_result($sql_query("select size from file_size
		where obj_type=$obj_type and objID=$objID and num=$num"),0,0) :
	@filesize($newfile);
  $size_changed=($filesize!=$filesize_old);

  if (($objID && $IMG_LOGO_REPLACE) || $size_changed) {
//----------------------------------------------\
  $tmp=explode('/',$path);
  $l=sizeof($tmp);
  $dir=$SITE_ROOT_USUAL;
  $dir1=$SITE_ROOT_SECURE;
  for ($i=0; $i<$l; $i++) {
    $dir.="/$tmp[$i]";
    $dir1.="/$tmp[$i]";
    if (!@is_dir($dir)) {
	@mkdir($dir,0777);
	@chmod($dir,0777);
	}
    if ($SITE_ROOT_SECURE!='' && !@is_dir($dir1)) {
	@mkdir($dir1,0777);
	@chmod($dir1,0777);
	}
    }

//  if (!@is_file($newfile))
  if (@copy($src,$newfile)) @chmod($newfile,0666);
  elseif ( (is_string($str=@file_get_contents($src)) ||
	    is_string($str=_LOAD_DATA($src,'GET',1))) &&
	    ($f=@fopen($newfile,'wb')) ) {
	  @fwrite($f,$str);
	  @fclose($f);
	  @chmod($newfile,0666);
	  }
  else return 0;

  if ($objID) {
    if ($size_changed && $IMG_LOGO_ADD)
      @$sql_query("replace into file_size (obj_type,objID,num,size)
		values ($obj_type,$objID,$num,$filesize)");
    if ($IMG_LOGO_ADD) write_logo($newfile,$Config['image_logo']);
    }

//  if ($SITE_ROOT_SECURE!='' &&
//      !(@is_file($newfile1) || ($COPY_BY_LINK && @is_link($newfile1))))
  if ($SITE_ROOT_SECURE!='' && !($COPY_BY_LINK && @is_link($newfile1)))
    if (!($COPY_BY_LINK && @symlink($newfile,$newfile1))) {
	@copy($newfile,$newfile1);
	@chmod($newfile1,0666);
	}
//----------------------------------------------/
    }
//--------------------------------------------------------/
    }

  $name=to_sql($name);
  $path=to_sql($path);

  db_query("insert into uploads1 (path,name,width,height,img_not_loaded)
	values ('$path','$name',$width,$height,$IMG_NOT_LOAD)");

  return @$sql_insert_id();
  }

//--------------------------------------------------------------------|

function save_log() {
  global $ROOT_PATH,$Log;

  if ($f=@fopen("$ROOT_PATH/CACHE/get_bases.log",'wb')) {
    @fwrite($f,serialize($Log));
    @fclose($f);
    @chmod("$ROOT_PATH/CACHE/get_bases.log",0666);
    }
  }

//====================================================================/



//====================================================================\
if ($continue)
  $Log=@unserialize(@implode('',@file("$ROOT_PATH/CACHE/get_bases.log")));
if (!is_array($Log)) $Log=array();
//====================================================================/



//----------------------------------------------------------\
if ($DISABLE_KEYS_WHILE_EXPORT) {
  @$sql_query("alter table uploads1 DISABLE KEYS");
  @$sql_query("alter table sc_category DISABLE KEYS");
  @$sql_query("alter table sc_product DISABLE KEYS");
  @$sql_query("alter table sc_category_prod DISABLE KEYS");
  }
//----------------------------------------------------------/



if (!$continue || !$Log['upl_deleted']) {
//--------------------------------------------------------------\
db_query("delete from uploads1");
@$sql_query("repair table uploads1 QUICK");
//----------------\
$Log['upl_deleted']=1;
save_log();
//----------------/
//--------------------------------------------------------------/
  }



if (!$continue || !$Log['mnf_deleted']) {
//--------------------------------------------------------------\
db_query("delete from sc_manufacturer");
@$sql_query("REPAIR TABLE sc_manufacturer QUICK");
@$sql_query("OPTIMIZE TABLE sc_manufacturer");
//----------------\
$Log['mnf_deleted']=1;
save_log();
//----------------/
//--------------------------------------------------------------/
  }

if (!$continue || !$Log['mnf_done']) {
//--------------------------------------------------------------\
if ($PORTION && !is_array($Log['Mnfs'])) {
  $Arr=get_objects('xml_manufacturers.php',
	'exc_field%5B%5D=name&exc_field%5B%5D=description&exc_field%5B%5D=image',
	'manufacturer');
  $N=sizeof($Arr);
  $Log['Mnfs']=array();
  for ($i=0; $i<$N; $i++) $Log['Mnfs'][$Arr[$i]['ID']]=$Arr[$i]['ID'];
  }

$Log['mnf_done']=($PORTION && !$Log['Mnfs']);

save_log();
set_last_time_updating();

while (!$Log['mnf_done']) {
//----------------------------------------------------\
if ($PORTION)
  $str='ID%5B%5D='.implode('&ID%5B%5D=',array_slice($Log['Mnfs'],0,$PORTION));
else $str='';

$Arr=get_objects('xml_manufacturers.php',$str,'manufacturer');
$N=sizeof($Arr);

for ($i=0; $i<$N; $i++) {
//--------------------------------------\
$ID=$Arr[$i]['ID'];
if ($Log['loaded_mnfs'][$ID]) continue;

unset($description);
$uplID=_upload_file($Arr[$i]['image']['src'],$Arr[$i]['image']['size'],
	$ID,0,1,$Arr[$i]['image']['width'],$Arr[$i]['image']['height']);

@extract(call('to_sql',$Arr[$i]));
db_query("insert IGNORE into sc_manufacturer (mnfID,uplID,name,url,content)
	values ($ID,$uplID,'$name','$url','$description')");
$Log['loaded_mnfs'][$ID]=1;
//--------------------------------------/
  echo $AUTO_UPDATING ? ' ' : "M($ID) \n";
  flush();

  if ($PORTION) unset($Log['Mnfs'][$ID]);

  save_log();
  set_last_time_updating();
  }

unset($Arr);

//----------------\
$Log['mnf_done']=(!$PORTION || !$Log['Mnfs']);
if ($Log['mnf_done']) unset($Log['Mnfs'],$Log['loaded_mnfs']);

save_log();
set_last_time_updating();
//----------------/
//----------------------------------------------------/
  }
//--------------------------------------------------------------/
  }




if ($EXPORT_CATS && (!$continue || !$Log['cat_deleted'])) {
//--------------------------------------------------------------\
db_query("delete from sc_category");
@$sql_query("REPAIR TABLE sc_category QUICK");
@$sql_query("OPTIMIZE TABLE sc_category");
//----------------\
$Log['cat_deleted']=1;
save_log();
//----------------/
//--------------------------------------------------------------/
  }

if ($CAN_ADMIN_CATS)
  db_query("insert IGNORE into sc_category
		(catID,parID,active,priority,name,comment,title)
		values (1,0,0,0,'__TEMP__','System temporary category','__TEMP__')");

// XXX:
function get_categories_list() {
  $tmp=array();
  $Arr=get_objects('xml_categories.php',
	"no_products=1&exc_field%5B%5D=title&exc_field%5B%5D=comment&exc_field%5B%5D=desctiption&exc_field%5B%5D=name&exc_field%5B%5D=image&exc_field%5B%5D=meta_title&exc_field%5B%5D=meta_keywords&exc_field%5B%5D=meta_description",
	'category');
  $N=sizeof($Arr);
// XXX:
  for ($i=0; $i<$N; $i++) $tmp[$Arr[$i]['ID']]=$Arr[$i]['ID'];
  unset($Arr);
  return $tmp;
  }

if ($EXPORT_CATS && (!$continue || !$Log['cat_done'])) {
//--------------------------------------------------------------\
// XXX:
if (!$PORTION || !is_string($Log['Categories']))
  $Log['Categories']='';

if ($PORTION && !is_array($Log['Cats']))
  $Log['Cats']=get_categories_list();

$Log['cat_done']=($PORTION && !$Log['Cats']);

save_log();
set_last_time_updating();

while (!$Log['cat_done']) {
//----------------------------------------------------\
if ($PORTION && ($Log['Categories'] || 
		sizeof($Log['Cats'])>$PORTION) ) {
// XXX:
  $IDcats=array_slice($Log['Cats'],0,$PORTION);  
  $str="&no_subcats=1&ID%5B%5D=".implode('&ID%5B%5D=',$IDcats);
  }
else $str='';

// XXX:
$Arr=get_objects('xml_categories.php',"no_products=1$str",'category',(($PORTION>50) ? 'POST' : 'GET'));
$N=sizeof($Arr);

for ($i=0; $i<$N; $i++) {
//--------------------------------------\
$ID=$Arr[$i]['ID'];
if ($Log['loaded_cats'][$ID]) continue;

unset($comment,$description,$meta_title,$meta_keywords,$meta_description);
$uplID=_upload_file($Arr[$i]['image']['src'],$Arr[$i]['image']['size'],
	$ID,1,1,$Arr[$i]['image']['width'],$Arr[$i]['image']['height']);

@extract(call('to_sql',$Arr[$i]));

if ($tmp=@$sql_fetch_assoc(db_query("select active,priority,url_name
			from sc_category_newval where catID=$ID"))) {
  @extract($tmp);
  $order=$priority;
  $url_name=to_sql($url_name);
  }
else {
  $active=1;
  $url_name='';
  }

db_query("insert IGNORE into sc_category (catID,parID,active,priority,url_name,
	name,comment,meta_title,meta_keywords,meta_description,uplID,
	title,description) values ($ID,$parentID,$active,$order,'$url_name',
	'$name','$comment','$meta_title','$meta_keywords','$meta_description',$uplID,
	'$title','$description')");
$Log['loaded_cats'][$ID]=1;
//--------------------------------------/
  echo $AUTO_UPDATING ? ' ' : "C($ID) \n";
  flush();

  unset($Log['Cats'][$ID]);
// XXX:
  $Log['Categories'].=($Log['Categories'] ? ',' : '').$ID;

  save_log();
  set_last_time_updating();
  }

// XXX:
unset($Arr);

//----------------\
$Log['cat_done']=(!$PORTION || !$Log['Cats']);
if ($Log['cat_done']) unset($Log['Cats'],$Log['loaded_cats']);

save_log();
set_last_time_updating();
//----------------/
//----------------------------------------------------/
  }
//--------------------------------------------------------------/
  }
// XXX:
elseif (!is_string($Log['Categories'])) {
  $Log['Categories']=implode(',',get_categories_list());
  save_log();
  set_last_time_updating();
  }




// XXX:
if (!$continue || !$Log['prd_disabled']) {
//--------------------------------------------------------------\
@$sql_query("REPAIR TABLE sc_product QUICK");
@$sql_query("REPAIR TABLE sc_category_prod QUICK");
//@$sql_query("OPTIMIZE TABLE sc_product");
@$sql_query("ALTER TABLE sc_product add product_updated tinyint not null");
@$sql_query("update sc_product set product_updated=0");
//----------------\
$Log['prd_disabled']=1;
save_log();
//----------------/
//--------------------------------------------------------------/
  }


// XXX:
if ($Log['Categories']) {
  if ($Log['min_prdID']<1) $Log['min_prdID']=1;
  $Portion=$PORTION ? $PORTION : 1000;
  $PrdUrl="GET_ATTRIBUTES=1&portion=$Portion&category=".to_url($Log['Categories']);
  do {
//--------------------------------------------------------------\
$Arr=get_objects('xml_products.php',"$PrdUrl&min_prdID=$Log[min_prdID]",'product','POST');
$N=sizeof($Arr);

$TMP_PRD=$TMP_CAT_PRD=array();
for ($i=0; $i<$N; $i++) {
//--------------------------------------\
$ID=$Arr[$i]['ID'];

unset($comment,$description,$measure,$dimensions,$attributes,
	$meta_title,$meta_keywords,$meta_description,$model,
	$spec_type,$spec_time1,$spec_time2,$price_type,
	$spec_price,$spec_price1,$spec_price2,$categories);
$uplID1=_upload_file($Arr[$i]['image1']['src'],$Arr[$i]['image1']['size'],
	$ID,2,1,$Arr[$i]['image1']['width'],$Arr[$i]['image1']['height']);
$uplID2=_upload_file($Arr[$i]['image2']['src'],$Arr[$i]['image2']['size'],
	$ID,2,2,$Arr[$i]['image2']['width'],$Arr[$i]['image2']['height']);
$uplID3=_upload_file($Arr[$i]['image3']['src'],$Arr[$i]['image3']['size'],
	$ID,2,3,$Arr[$i]['image3']['width'],$Arr[$i]['image3']['height']);
$uplID4=_upload_file($Arr[$i]['image4']['src'],$Arr[$i]['image4']['size'],
	$ID,2,4,$Arr[$i]['image4']['width'],$Arr[$i]['image4']['height']);
$uplID5=_upload_file($Arr[$i]['image5']['src'],$Arr[$i]['image5']['size'],
	$ID,2,5,$Arr[$i]['image5']['width'],$Arr[$i]['image5']['height']);
$uplID6=_upload_file($Arr[$i]['image6']['src'],$Arr[$i]['image6']['size'],
	$ID,2,6,$Arr[$i]['image6']['width'],$Arr[$i]['image6']['height']);

$doc1=to_sql($Arr[$i]['document1']['name']);
$docID1=_upload_file($Arr[$i]['document1']['src'],$Arr[$i]['document1']['size']);
$doc2=to_sql($Arr[$i]['document2']['name']);
$docID2=_upload_file($Arr[$i]['document2']['src'],$Arr[$i]['document2']['size']);
$doc3=to_sql($Arr[$i]['document3']['name']);
$docID3=_upload_file($Arr[$i]['document3']['src'],$Arr[$i]['document3']['size']);

if ($attributes=trim($Arr[$i]['attributes'])){}
  $Arr[$i]['attributes']=str_replace(array('[%CR%]','[%NL%]'),array("\r","\n"),$attributes);

@extract(call('to_sql',$Arr[$i]));

//$price_type=(int)$SPEC_TYPE[$spec_type];
$price_type=(int)$price_type;
$last_modified=(int)$last_modified;

$spec_time1=(int)$spec_time1;
$spec_time2=(int)$spec_time2;
$spec_price=floatval($spec_price);
$spec_price1=floatval($spec_price1);
$spec_price2=floatval($spec_price2);

if ($tmp=@$sql_fetch_assoc(db_query("select active,priority,price_type as price_type_new
			from sc_product_newval where prdID=$ID"))) {
  @extract($tmp);
  $order=$priority;
  $price_type_new=$price_type ? $price_type : $price_type_new;
  }
else {
  $active=1;
  $price_type_new=$price_type;
  }

if (@$sql_num_rows(db_query("select 1 from sc_product where prdID=$ID"))) {
  $op='u';
  db_query("update sc_product set active=$active,priority=$order,
		price_type_new=$price_type_new,time_available=$time_available,
		in_stock=$in_stock,is_new=$is_new,mnfID=$manufacturer,
		model='$model',url='$url',price_type=$price_type,
		spec_time1=$spec_time1,spec_time2=$spec_time2,
		price=$price,spec_price=$spec_price,
		opt1=$opt1,price1=$price1,spec_price1=$spec_price1,
		opt2=$opt2,price2=$price2,spec_price2=$spec_price2,
		measure='$measure',dimensions='$dimensions',weight=$weight,
		meta_title='$meta_title',meta_keywords='$meta_keywords',
		meta_description='$meta_description',
		uplID1=$uplID1,uplID2=$uplID2,uplID3=$uplID3,
		uplID4=$uplID4,uplID5=$uplID5,uplID6=$uplID6,
		doc1='$doc1',docID1=$docID1,doc2='$doc2',docID2=$docID2,
		doc3='$doc3',docID3=$docID3,
		name='$name',comment='$comment',description='$description',
		attributes='$attributes',quantity=$quantity,num_choosed=$num_choosed,
		last_modified=$last_modified,product_updated=1
	where prdID=$ID");
  }
else {
  $op='i';
  db_query("insert IGNORE into sc_product (prdID,active,priority,price_type_new,
		time_available,in_stock,is_new,mnfID,
		model,url,price_type,spec_time1,spec_time2,price,spec_price,
		opt1,price1,spec_price1,opt2,price2,spec_price2,
		measure,dimensions,weight,
		meta_title,meta_keywords,meta_description,
		uplID1,uplID2,uplID3,uplID4,uplID5,uplID6,
		doc1,docID1,doc2,docID2,doc3,docID3,
		name,comment,description,attributes,
		quantity,num_choosed,last_modified,product_updated)
	values ($ID,$active,$order,$price_type_new,
		$time_available,$in_stock,$is_new,$manufacturer,
		'$model','$url',$price_type,$spec_time1,$spec_time2,$price,$spec_price,
		$opt1,$price1,$spec_price1,$opt2,$price2,$spec_price2,
		'$measure','$dimensions',$weight,
		'$meta_title','$meta_keywords','$meta_description',
		$uplID1,$uplID2,$uplID3,$uplID4,$uplID5,$uplID6,
		'$doc1',$docID1,'$doc2',$docID2,'$doc3',$docID3,
		'$name','$comment','$description','$attributes',
		$quantity,$num_choosed,$last_modified,1)");
  }
//--------------------------------------/
  echo $AUTO_UPDATING ? ' ' : "P$op($ID) \n";
  flush();

  if ($EXPORT_CATS && $categories) {
    $TMP_PRD[]=$ID;
    foreach (array_filter(call('intval',explode(',',$categories))) as $cid)
      $TMP_CAT_PRD[]="($ID,$cid)";
    }

  $Log['min_prdID']=$ID+1;
  if (($i%20)==19 || $i==($N-1)) {
    if ($EXPORT_CATS) {
      if ($tmp=implode(',',$TMP_PRD))
        db_query("delete from sc_category_prod where prdID in ($tmp)");
      if ($tmp=implode(',',$TMP_CAT_PRD))
        db_query("insert IGNORE into sc_category_prod (prdID,catID) values $tmp");
      $TMP_PRD=$TMP_CAT_PRD=array();
      }
    save_log();
    set_last_time_updating();
    }
  }

unset($Arr);
//--------------------------------------------------------------/
    }
  while ($N==$Portion);
  }


// XXX:
//--------------------------------------------------------------\
@$sql_query("delete from sc_product where !product_updated");

$res=db_query("select DISTINCT cp.prdID
		from sc_category_prod as cp
			left join sc_product as p on p.prdID=cp.prdID
		where ISNULL(p.prdID) group by 1");
$tmp=array();
while (list($id)=@$sql_fetch_row($res)) $tmp[]=$id;
if ($tmp)
  db_query("delete from sc_category_prod
	where prdID in (".implode(',',$tmp).")");
set_last_time_updating();
//--------------------------------------------------------------/

// XXX:
if (!$EXPORT_CATS) {
//--------------------------------------------------------------\
$tmp=array();
$res=db_query("select DISTINCT p.prdID
		from sc_product as p
			left join sc_category_prod as cp on p.prdID=cp.prdID
		where ISNULL(cp.prdID) group by 1");
while (list($id)=@$sql_fetch_row($res)) $tmp[]="(1,$id)";
if ($tmp)
  db_query("insert IGNORE into sc_category_prod (catID,prdID)
	values ".implode(',',$tmp));
set_last_time_updating();
//--------------------------------------------------------------/
  }


//---------------------------------------------------------\
if ($DISABLE_KEYS_WHILE_EXPORT) {
  @$sql_query("alter table uploads1 ENABLE KEYS");
  @$sql_query("alter table sc_category ENABLE KEYS");
  @$sql_query("alter table sc_product ENABLE KEYS");
  @$sql_query("alter table sc_category_prod ENABLE KEYS");
  }
//---------------------------------------------------------/


//-----------------\
$Log=array();
save_log();
//-----------------------------------------------\
sc_category_stat();
if (!$CAN_ADMIN_CATS) {   // удаление пустых
  @include("$ROOT_PATH/modules/categ_items.php");
  $tmp=array();
  foreach ($CategItems as $id => $item)
    if (!$item['n_prod_all']) $tmp[]=$id;
  if ($tmp)
    db_query("delete from sc_category where catID in (".implode(',',$tmp).")");
  }
if ($SAVE_CATEGORY_TREE_TO_FILE) {
  @include("$ROOT_PATH/modules/categ_items.php");
  }
//-----------------------------------------------/
//----------------/


//---------------------------------------------------------------------------\
$t=time();
db_query("update config set last_time_updated=$t,image_logo_old=image_logo");
//---------------------------------------------------------------------------/


//============= SITEMAP ====================\
 include("$ROOT_PATH/modules/sitemap.php");
//==========================================/

?>
<?void();
/* -----!!! NO SYMBOLS ("CR","SPACE", ...) BEFORE "<?" OR AFTER "?>" !!!----- */
/*
// ============================================================================\

Functions:
	file_upload($uplID,$var_name="",$ext_list=0,$prefix="",$upload_dir=0,$save_name=0)
	file_name($uplID)
	file_link($uplID,$text="",$attrs="")
	file_image($uplID,$attrs="")

// ============================================================================/
*/


// ------------\
// Upload file
// ------------------------------------\
function file_upload($uplID,$var_name="",$ext_list=0,$prefix="",$upload_dir=0,$save_name=0) {
    global $TIME,$SERVER_ROOT,$DEF_UPLOAD_DIR,$MAX_UPLOAD_FILESIZE,$sql_fetch_row;

// ----------------\
  if ($var_name=="") {
    if (!sizeof($uplID)) return -1;
    $cond=is_array($uplID) ? "uplID in (".implode(",",$uplID).")" : "uplID=".(int)$uplID;
    $res=db_query("select path,name,save_name from uploads where $cond");
    while (list($path,$name,$sname)=@$sql_fetch_row($res)) {
      @unlink("$SERVER_ROOT/$path/$name");
      if ($sname) @rmdir("$SERVER_ROOT/$path");
      }
    db_query("delete from uploads where $cond");
    return 0;
    }
// ----------------/

  $uplID=(int)$uplID;
  $file=$GLOBALS[$var_name];
  $file_name=$GLOBALS["{$var_name}_name"];
  if ($file_name=="") return 0;
  $ext=strtolower(strrchr($file_name,"."));
  $file_size=(int)@filesize($file);
  $new_path=$upload_dir ? $upload_dir : $DEF_UPLOAD_DIR;

  if ($file_size &&
	(!$MAX_UPLOAD_FILESIZE || $file_size<=($MAX_UPLOAD_FILESIZE*1024)) &&
	(!$ext_list || in_array($ext,$ext_list))) {
    if ($uplID) {
      list($path,$name,$sname)=@$sql_fetch_row(db_query(
			"select path,name,save_name from uploads where uplID=$uplID"));
      @unlink("$SERVER_ROOT/$path/$name");
      if ($sname) @rmdir("$SERVER_ROOT/$path");
      $query="update uploads set path='\$new_path',name='\$new_name',save_name=$save_name
		where uplID=$uplID";
      }
    else {
      $uplID=get_new_id_fast("uploads","uplID");
      $query="insert into uploads (uplID,path,name,save_name)
		values ($uplID,'\$new_path','\$new_name',$save_name)";
      }
    $new_name="$prefix{$uplID}_$TIME";
    if ($save_name) {
      $new_path.="/$new_name";
      if (! @mkdir("$SERVER_ROOT/$new_path",0777)) return -1;
      $new_name=$file_name;
      }
    else
      $new_name.=$ext;
    eval("db_query(\"$query\");");
    $tmp="$SERVER_ROOT/$new_path/$new_name";
    if (@copy($file,$tmp) || @move_uploaded_file($file,$tmp)) {
      @chmod($tmp,0666);
      return $uplID;
      }
    else db_query("delete from uploads where uplID=$uplID");
    }
  return -1;
  }
// ------------------------------------/


// --------------------------\
// Get name of uploaded file
// ------------------------------------\
function file_name($uplID) {
    global $sql_fetch_assoc;
  $uplID=(int)$uplID;
  return $uplID ?
	@$sql_fetch_assoc(db_query(
		"select CONCAT(path,'/',name) as full_name,path,name,save_name
		from uploads where uplID=$uplID")) :
	0;
  }
// ------------------------------------/


// --------------------------------\
// Get HTML-link for uploaded file
// ------------------------------------\
function file_link($uplID,$text="",$attrs="") {
    global $SITE_ROOT;
  $res="";
  if ($fname=file_name($uplID)) {
    if ($text=="") $text=$fname["name"];
    $res="<a href='$SITE_ROOT/$fname[full_name]' $attrs>$text</a>";
    }
  return $res;
  }
// ------------------------------------/


// -----------------------------------\
// Get HTML-string for uploaded image
// ------------------------------------\
function file_image($uplID,$attrs="") {
    global $SERVER_ROOT,$SITE_ROOT;
  $res="";
  if ($fname=file_name($uplID)) {
    $full_name=$fname["full_name"];
    $res="<img src='$SITE_ROOT/$full_name' $attrs ".
	get_elem(@getimagesize("$SERVER_ROOT/$full_name"),3)." alt=''>";
    }
  return $res;
  }
// ------------------------------------/


?>
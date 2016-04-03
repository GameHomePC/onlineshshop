<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  $ID=(int)$ID;

  if ($ID>0) {
    file_upload((int)@$sql_result(db_query("select uplID from site_pages where pageID=$ID"),0,0));
    db_query("delete from site_pages where pageID=$ID");
    db_query("update site_menu set pageID=0 where pageID=$ID");
    db_query("update site_pages set bottom_links=REPLACE(bottom_links,':$ID:',':'),
			pageID1=IF(pageID1=$ID,0,pageID1),
			pageID2=IF(pageID2=$ID,0,pageID2),
			pageID3=IF(pageID3=$ID,0,pageID3),
			pageID4=IF(pageID4=$ID,0,pageID4),
			pageID5=IF(pageID5=$ID,0,pageID5)");
    }

  redirect("./?OK=1");
?>
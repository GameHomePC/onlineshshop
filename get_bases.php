<?
// ====================================\
  @include_once('_dir.php');
// ====================================/


//=============== GET NEW BASES ====================\
 if ($Hour>=0 && $Hour<=6 && $Config['auto_update_period'] &&
     ((int)$Config['last_time_updated']+$Config['auto_update_period']*3600)<$TIME) {
   @ini_set('output_buffering','0');
   echo ' ';
   flush();
   $AUTO_UPDATING=1;
   $continue=1;
   include("$ROOT_PATH/modules/get_bases.php");
   }
//==================================================/

?>
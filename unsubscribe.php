<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

// ------------------------------------\
  list($ID,$code,$conf)=$args;
  $ID=(int)$ID;
  $code=(int)$code;
  $conf=$conf ? 1 : 0;
// ------------------------------------/

  include_once("$ROOT_PATH/common/all_head.php");
?>



<center>
<?
  if ($ID<1 || $code<1 || !@$sql_num_rows(db_query("select 1 from mailing_emails where emlID=$ID and code=$code")))
    echo "<div class=warn>Error: there is no this Email address in the mailing list</div>";
  elseif ($conf) {
    db_query("update mailing_emails set unsubscribed=1 where emlID=$ID");
//    db_query("delete from mailing_emails where emlID=$ID");
    echo "<div class=ok>You Email address has been successfully removed from our mailing list</div>";
    }
  else
    echo "<div class=txtB>Are you sure want to unsubscribe? 
	<a href='unsubscribe_{$ID}_{$code}_1.html'>CLICK HERE</a> to confirm.</div>";
?>
</center>



<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>

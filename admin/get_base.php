<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1,2);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");


  @ini_set('output_buffering','0');


  echo "<center>--------------- !!! DO NOT CLOSE THIS WINDOW !!! ---------------</center> \n ",
	str_repeat('          ',120);
  flush();

//============ GET NEW BASES =================\
 include("$ROOT_PATH/modules/get_bases.php");
//============================================/

  echo '<center>
	--------------- <b>DONE (YOU MAY CLOSE THIS WINDOW)</b> ---------------<br><br>
	<input type=button value="CLOSE" onClick="window.close()"><br>
	</center>';
?>
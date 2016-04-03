<?void();

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");

  include_once("$ROOT_PATH/$ADMIN_DIR/common/all_head.php");

// -----------------------------------------------------------\
  if ($HTMLEditorUsed && $Config['use_wysiwyg']) {
    include_once("$ROOT_PATH/$ADMIN_DIR/modules/htmlarea.php");
    }
// -----------------------------------------------------------/
?>



<script language=javascript><!--
//SET_USER_ONLINE_IMG="<?= $ADMIN_ROOT ?>/common/set_user_online.php?"
//setUserOnline()
//autoRefresh()
//-->
</script>


<script src="<?= $ADMIN_ROOT ?>/init/js/menu.js"></script>


<table border=0 cellspacing=0 cellpadding=2 width=100%>
<tr>
  <td class=bgH nowrap>
    <span class=head>&nbsp; User: <span class=warn><?= $Login_html ?></span></span>
    (<?= $Admin_type ?>) &nbsp;
  </td>
  <td>&nbsp;&nbsp;&nbsp;</td>
  <td align=right nowrap class=head width=100%>
<? if ($Type<=$MAX_TYPE_CAN_ADMIN) { ?>
    <a href="<?= $ADMIN_ROOT ?>/user/">User Management</a> |
<? } ?>
    <a href="<?= $ADMIN_ROOT ?>/userdata/">My Profile</a> |
    <a href='<?= $ADMIN_ROOT ?>/?logout=1'>Logout</a>
  </td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr></tr><tr></tr><tr></tr>
<tr><td bgcolor=#000000><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td></tr>
</table>
<table border=0 cellspacing=0 cellpadding=2 width=100% class=menuBg>
<tr>
  <!--td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td-->
  <td class=menu><script>m1.create()</script></td>
</tr>
</table>
<table border=0 cellspacing=0 cellpadding=0 width=100% class=menuBorder>
<tr><td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td></tr>
</table>


<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=3 alt=''><br>
<div style='height:22;' class=bg>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=2 alt=''><br>
&nbsp;&nbsp;<span align=left class="headH">&#149; <?= $TITLE ?></span>
</div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<blockquote style='margin:5'>


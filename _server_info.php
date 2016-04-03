
<? $t=time(); ?>

<hr size=1 noshade>
<b>Server Date &amp; Time:</b> <font color=blue><?= date("d.m.Y - H:i",$t) ?></font><br>
<b>Server Timestamp:</b> <font color=blue><?= $t ?></font><br>
<b>Server GMT Offset:</b> <font color=blue><?= date("Z") ?> sec.</font><br>
<hr size=1 noshade>
<br>

<? phpinfo() ?>
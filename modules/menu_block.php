<? void(); ?>

<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr valign=bottom class=siteMenuBg>
  <td width=100% class=siteMenuBg>
<table border=0 cellspacing=2 cellpadding=0>
<tr><td><script><?= $MenuName ?>.create()</script></td></tr>
</table>
<? if (!$EditMenu) { ?>
<noscript>
<table border=0 cellspacing=0 cellpadding=10>
<tr valign=top><td>
<?
  foreach ($MenuItems as $id=>$item)
    if ($id) {
      $l=$item['level']-1;
      if ($l<0) $l=0;
      $tmp="<a href='$item[href]'>$item[html]</a>";
      echo $l ? str_repeat('&nbsp;',$l*4)."-$tmp<br>" : "</td><td><b>$tmp</b><br>";
      }
?>
</td></tr>
</table>
</noscript>
<? } ?>
  </td>
</tr>
</table>

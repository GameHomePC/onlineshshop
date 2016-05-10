<?
// ====================================\
@include_once('_dir.php');
// ====================================/

// ------------------------------------\
$nwsID = (int)$args[0];
// ------------------------------------/

// ------------------------------------\
@extract($tmp = @$sql_fetch_assoc(db_query(
    "select time,title,content,source from news where nwsID=$nwsID")));
// ------------------------------------/
if (!$tmp) $RedirectUrl = "$SITE_ROOT/news.html";

$Meta['title'] = $title;

include_once("$ROOT_PATH/common/all_head.php");
?>



<?
// ----------------------------------------------------------------------------\
$prevID = $nextID = 0;
if ($time) {
    $prevID = @$sql_result(db_query("select nwsID from news where time<$time or (time=$time and nwsID<$nwsID) order by time DESC,nwsID DESC limit 1"), 0, 0);
    $nextID = @$sql_result(db_query("select nwsID from news where time>$time or (time=$time and nwsID>$nwsID) order by time,nwsID limit 1"), 0, 0);
}

$time = @get_date_str($time);
$title = to_html($title);
$content = str_replace('<%BASE%>', $SITE_ROOT, $content);
if ($source != '')
    $source = "<a href='#' target=_blank onMouseOver='this.href=\"$source\"'
		onFocus='this.onmouseover();window.status=this.href'
		onBlur='window.status=window.defaultStatus'>Source</a>";
// ----------------------------------------------------------------------------/
?>

<div class="newsLong">
    <div class="newsLong__title"><?php echo $title; ?></div>
    <div class="newsLong__date"><?php echo $time; ?></div>

    <div class="newsLong__content"><?php echo $content; ?></div>
    <div class="newsLong__source"><?php echo $source; ?></div>
</div>

<?php /* ?>
<div class="newsLongNav">
    <?php
        if ($prevID) echo "<a href='news_view_$prevID.html'>&lt;&lt;Previous</a>";
    ?>
    <td width=0>|</td>
    <td width=0 class=txtB nowrap><a href='news.html'>News Index</a></td>
    <td width=0>|</td>
    <td width=50% align=left class=txtB>
        <?php
        if ($nextID) echo "<a href='news_view_$nextID.html'>Next&gt;&gt;</a>";
        ?>
    </td>
</div>
<?php */ ?>

<?php
    include_once("$ROOT_PATH/common/all_tail.php");
?>

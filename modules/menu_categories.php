<? void();

$tmp = "$SITE_ROOT/img/tree";
$TreeCornerImgClosed = "$tmp/cc.gif";
$TreeCornerImgOpen = "$tmp/co.gif";
$TreeCornerImgNone = "$tmp/cn.gif";

function writeCategItems($id, $write = 0)
{
    global $Config, $CategItems, $REQUEST_URI, $ADMIN_ROOT, $SITE_ROOT, $CatID, $PrdID,
           $TreeCornerImgOpen, $TreeCornerImgClosed, $TreeCornerImgNone;
    if ($id == 1) return array('', 0);
    $Html = '';
    $Active = 0;
    $items = $CategItems[$id]['items'];
    $N = sizeof($items) - 1;

    foreach ($items as $i => $sid) {
        if ($sid < 2) continue;
        $item = $CategItems[$sid];
        if (!$item) continue;
        $href = "$SITE_ROOT/$item[href]";
        $n_prod = $item['n_prod'];
        $is_current = $sid == $CatID;
        $is_last = ($i == $N) ? 1 : 0;
        $has_child = $item['items'] ? 1 : 0;
        // --------------------------------\

        list($html, $active) = $has_child ? writeCategItems($sid) : array('', 0);
        $active = $active || $is_current;
        $tmp = $active ? "style='display:block'" : '';
        if ($html) $html = "<div ID='n{$sid}b' class=block $tmp>$html</div>";
        // --------------------------------/

        $tmp = $active ? $TreeCornerImgOpen : $TreeCornerImgClosed;
        $corner = $has_child ?
            "<img class=corner NAME='n$sid' src='$tmp' onClick='switchCorner(this)'>" :
            "<img src='$TreeCornerImgNone'>";

        // ------------|
        $tmp = $is_last ? "class=last" : '';
        $tmp1 = $is_current ? "class=active" : '';
        $tmp2 = $Config['menu_prd_count'] ? "<nobr>&nbsp;($n_prod)</nobr>" : '';
        $Html .= "<li $tmp><a $tmp1 href='$href'>$item[name]$tmp2</a>$html</li>";
        $Active = $Active || $active;
    }

    if ($write) {
        echo $Html;
        return true;
    } else
        return array($Html, $Active);
}

?>

<script>
    var TreeCornerImgClosed = '<?= to_js($TreeCornerImgClosed) ?>';
    var TreeCornerImgOpen = '<?= to_js($TreeCornerImgOpen) ?>';
    var TMP1 = new Image;
    var TMP2 = new Image;
    TMP1.src = TreeCornerImgClosed;
    TMP2.src = TreeCornerImgOpen;

    /**
     * switchCorner
     * @param el
     * @returns {boolean}
     */
    function switchCorner(el) {
        var name = el.id || el.name;
        var block, bs;
        if (!((block = D.getElementById(name + 'b')) && (bs = block.style))) return;
        var off = (bs.display == 'block');
        D.images[name].src = off ? TreeCornerImgClosed : TreeCornerImgOpen;
        bs.display = off ? 'none' : 'block';
        return false;
    }
</script>

<?php writeCategItems(0, 1); ?>

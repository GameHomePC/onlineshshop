<?php
@include_once('_dir.php');

include_once("$ROOT_PATH/common/all_head.php");
?>


<h1 class="page__title pb">About Us</h1>

<div class="page">
    <div class="page__content">
        <?php
        if ($PageData['content2'] != '') {
            echo str_replace('<%BASE%>', $SITE_ROOT, $PageData['content2']);
        }
        ?>
    </div>
</div>

<?php
include_once("$ROOT_PATH/common/all_tail.php");
?>

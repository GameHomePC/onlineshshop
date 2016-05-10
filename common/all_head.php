<?php
void();

include_once("$ROOT_PATH/common/_head_init.php");
include_once("$ROOT_PATH/common/all.php");
?>

<body>
    <div class="window">
        <?php
            include_once("$ROOT_PATH/common/_head.php");
        ?>

        <?php
            if ((!$PageID && $CheckPageExisting) || isset($RedirectUrl)) {
                include("$ROOT_PATH/error404.php");
                exit;
            }
        ?>
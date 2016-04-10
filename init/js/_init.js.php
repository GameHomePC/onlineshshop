<?php
    $ROOT_PATH="../..";

    include_once("$ROOT_PATH/init/main.php");

    set_content_type("text/javascript");
    set_cache_time(60 * 24 * 30);
?>

    var URL_HEADER='<?php echo to_js($URL_HEADER) ?>';
    var SITE_ROOT='<?php echo to_js($SITE_ROOT) ?>';
    var ADMIN_ROOT='<?php echo to_js($ADMIN_ROOT) ?>';

    var AUTO_REFRESH_TIME=<?= $AUTO_REFRESH_TIME*1000 ?>;
    var AUTO_ONLINE_TIME=<?= $AUTO_ONLINE_TIME*1000 ?>;
    var CONTROL_USER_ACTIVITY=<?= $CONTROL_USER_ACTIVITY ?>;

    var DATE_FORMAT=<?= $DATE_FORMAT ?>;

<?php
    $tmp=$WEEKDAY["name"];
    ksort($tmp);
?>

var WEEKDAY=Array('<?php echo implode("','",$tmp) ?>');
var MONTH=Array('<?php echo implode("','",$MONTH["name"]) ?>');

<?php
    readfile('lib/jquery-1.12.3.js');
    readfile('lib/slick.js');
    readfile('main.js');
    readfile('data.js');
    readfile('dhtml.js');
    readfile('special.js');
    readfile('admin.js');
    readfile("$ROOT_PATH/init_site/js/main.js");
?>

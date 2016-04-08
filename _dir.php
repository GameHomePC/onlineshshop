<?
function _fix_time($str = '', $write = 0)
{
    static $start, $prev, $TIME_ARRAY;

    list($usec, $sec) = explode(' ', microtime());
    $tm = (float)$usec + (float)$sec;

    if (!$start) $start = $tm;
    if ($str != '') $TIME_ARRAY[$str] = array($tm - $prev, $tm - $start, ($write ? '<div class=bgH>' : '<div class=bg>'));
    $prev = $tm;

    if ($write)
        foreach ($TIME_ARRAY as $k => $v)
            echo $v[2], number_format($v[0], 4), ' - ', number_format($v[1], 4), " - $k</div>";
}

_fix_time();

// ====================================\
$ROOT_PATH = ".";

include_once("$ROOT_PATH/init/main.php");
// ====================================/

?>
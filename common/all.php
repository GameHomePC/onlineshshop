<?php
    void();

    $site_styles = $site_styles_nn = $site_scripts = "";

    if ($Site_styles)
        while (list(, $src) = each($Site_styles))
            if ($src) $site_styles .= "<link rel='stylesheet' href='$src'>";

    if ($Site_styles_nn)
        while (list(, $src) = each($Site_styles_nn))
            if ($src) $site_styles_nn .= "<link rel='stylesheet' href='$src'>";

    if ($Site_scripts)
        while (list(, $src) = each($Site_scripts))
            if ($src) $site_scripts .= "<script src='$src'></script>";
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $TITLE; ?></title>
    <meta http-equiv="Content-script-type" content="text/javascript" />
    <meta charset="<?php echo $SITE_CHARSET; ?>" />
    <meta http-equiv="Content-Language" content="en" />

    <?php echo $Site_head_tags; ?>

    <?php
      $no_js_url="$SITE_ROOT/error_js.html";

      if (is_array($ADMIN_TYPE) && $PHP_SELF!=$no_js_url) {
          echo "<noscript><meta http-equiv='Refresh' content='0;URL=$no_js_url'></noscript>";
      }
    ?>

    <script>
    <!--
        var NN = (navigator.appName == 'Netscape');
    //-->
    </script>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic&subset=latin,cyrillic-ext,cyrillic">
    <link rel="stylesheet" href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic&subset=latin,cyrillic-ext,cyrillic'>
    <link rel="stylesheet" href="<?php echo $SITE_ROOT ?>/init/css/main.css">

    <script>
    <!--
        if (NN) document.write("<link rel='stylesheet' href='<?= $SITE_ROOT ?>/init/css/main_nn.css'>");
    //-->
    </script>

    <?php echo $site_styles; ?>

    <script>
    <!--
        if (NN) document.write("<?php echo $site_styles_nn ?>");
    //-->
    </script>

    <script src="<?= $SITE_ROOT ?>/init/js/_init.js.php"></script>

    <?php echo $site_scripts; ?>

    <script>
    <!--
    if (NN4) {
        origWidth = W.innerWidth;
        origHeight = W.innerHeight;
        W.onresize = function () {
            if (W.innerWidth != origWidth || W.innerHeight != origHeight) history.go(0);
        }
    }
    //-->
    </script>

    <script>
        <!--
        if (T.frames.length) T.location.href = W.location.href;
        //-->
    </script>
</head>
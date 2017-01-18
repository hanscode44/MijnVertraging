<?php

require('php/config/conf.default.php');
require('php/config/conf.NSApiConfig.php');

if (isset($_POST["StationActueleVertrekTijden"])) {
    PostCookie::getInstance()->setPostCookieValue("StationActueleVertrekTijden", $_POST["StationActueleVertrekTijden"]);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <!--Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>MijnVertraging</title>

</head>
<body>
<header>
    <nav role="navigation">
        <a href="index.php" class="siteTitle">
            <div>MijnVertraging</div>
        </a>

        <div class="headerAlignRight">
            <?php ViewController::getInstance()->renderAutoComplete(); ?>
        </div>

    </nav>
</header>

<div class="container">
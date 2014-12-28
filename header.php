<?php
require('php/config/conf.default.php');
require('php/config/conf.NSApiConfig.php');
if(isset($_POST["StationActueleVertrekTijden"]))   {
    PostCookie::getInstance()->setPostCookieValue("StationActueleVertrekTijden",$_POST["StationActueleVertrekTijden"]);
}
?>
<!DOCTYPE html>
<html>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/documentready.js"></script>
    <title>MijnVertraging</title>
    <meta charset="utf-8">
</head>
<body>
<header>
<nav role="navigation">
    <a href="index.php" class="siteTitle">
        <div >MijnVertraging</div>
    </a>


    <div class="headerAlignRight">
        <?php ViewController::getInstance()->renderAutoComplete(); ?>
    </div>

</nav>
</header>

<div class="container">
<?php

include_once("header.php");

ViewController::getInstance()->renderHomepage();

CacheHandler::getInstance()->deleteCache();

include_once("footer.php");

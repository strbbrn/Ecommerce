<?php

ob_start();
session_start();
//session_destroy();

defined("DS") ? null : define("DS",DIRECTORY_SEPARATOR);

defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT",__DIR__. DS . "templates/frontend");

defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK",__DIR__. DS . "templates/backend");

defined("UPLOAD_DIR") ? null : define("UPLOAD_DIR",__DIR__. DS . "uploads");

defined("DB_HOST") ? null : define("DB_HOST","localhost");

defined("DB_USER") ? null : define("DB_USER","root");

defined("DB_PASS") ? null : define("DB_PASS","");

defined("DB_NAME") ? null : define("DB_NAME","ecom_db");

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
require_once("cart.php");
require_once("functions.php");






?>
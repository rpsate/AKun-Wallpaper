<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/5/12
 * Time: 12:23
 */
header("content-type:text/html;charset=utf-8");

session_start();

//include all file
define("ROOT",dirname(__FILE__));
set_include_path(".".PATH_SEPARATOR.ROOT.DIRECTORY_SEPARATOR."lib".PATH_SEPARATOR.ROOT.DIRECTORY_SEPARATOR."core".PATH_SEPARATOR.ROOT.DIRECTORY_SEPARATOR."configs".PATH_SEPARATOR.get_include_path());

require_once "core.php";
require_once "common.func.php";
require_once "image.func.php";
require_once "mysql.func.php";
require_once "string.func.php";
require_once "config.php";
require_once "common.func.php";
require_once "lib/page.func.php";
?>

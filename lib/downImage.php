<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/6/26
 * Time: 20:01
 */
$filename = $_GET['filename'];
header('Content-Disposition:attachment;filename='.basename($filename));
header('Content-Length:'.filesize($filename));
readfile($filename);
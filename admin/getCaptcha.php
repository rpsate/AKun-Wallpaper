<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/5/12
 * Time: 11:48
 */
require_once "../include.php";

$captcha = buildRandomString();
$_SESSION['captcha'] = $captcha;
$captcha_image = createCaptchaImage($captcha);
header("content-type:image/png");
imagepng($captcha_image);
imagedestroy($captcha_image);
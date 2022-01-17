<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/5/12
 * Time: 13:23
 */
require_once "../include.php";
$get_username = $_POST['username'];
$get_username = addslashes($get_username);
$get_password = md5($_POST['password']);
$get_captcha = $_POST['captcha'];
if (isset($_POST['autoLogin'])) {
    $auto_login = $_POST['autoLogin'];
}else {
    $auto_login = 0;
}

$captcha = $_SESSION['captcha'];

if (strtolower($captcha) == strtolower($get_captcha)) {
    mysqlConnect(MYSQL_HOST_NAME,MYSQL_USER,MYSQL_PASSWORD,"searchimages");
    $row = fetch_row("SELECT id,password FROM admin_root WHERE username='{$get_username}'",MYSQL_NUM);
    $id = $row[0];
    $password = $row[1];
    if ($password == $get_password) {
        if ($auto_login == "1") {
            setcookie("adminId",$id,time()+7*24*3600);
            setcookie("adminUser",$get_username,time()+7*24*3600);
        }
        $_SESSION['adminId'] = $id;
        $_SESSION['adminUser'] = $get_username;
        alert("登陆成功","index.php");
    }else {
        alert("用户名或密码错误","login.html");
    }
}else {
    alert("验证码错误！","login.html");
}
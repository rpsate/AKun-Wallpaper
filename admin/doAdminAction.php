<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/5/12
 * Time: 16:22
 */
require_once "../include.php";
checkLogin();
if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
    if ($action == "logout") {
        logout();
    }elseif ($action == "addAdmin") {
        $message = addAdmin();
        echo $message;
    }elseif ($action == "editAdmin") {
        $id = $_POST['id'];
        $message = updateAdmin($id);
        echo $message;
    }elseif ($action == "delete") {
        $id = $_GET['id'];
        $message = deleteAdmin($id);
        alert($message,"listAdmin.php");
    }
}else {
    alert_back("没有收到action数据");
}

<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/5/12
 * Time: 10:01
 */
function alert($message,$redirect) {
    echo "<script>alert('$message');location.href='{$redirect}'</script>";
    exit();
}

function alert_back($message) {
    echo "<script>alert('$message');window.history.back()</script>";
    exit();
}
?>
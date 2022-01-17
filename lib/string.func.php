<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/5/12
 * Time: 10:00
 */
function buildRandomString($length=4,$type=3) {
    if ($type==1) {
        $data = join(range("0","9"));
    } elseif ($type==2) {
        $data = join(array_merge(range("a","z"),range("A","Z")));
    } elseif ($type == 3) {
        $data = join(array_merge(range("0","9"),range("a","z"),range("A","Z")));
    }

    if ($length > strlen($data)) {
        exit("最大长度不能超过10");
    }

    $data = str_shuffle($data);
    return substr($data,0,$length);
}
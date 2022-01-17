<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/5/12
 * Time: 10:00
 */
require_once dirname(dirname(__FILE__))."/include.php";

//connect mysql
function mysqlConnect($host_name,$username,$password,$database) {
    $mysql = mysql_connect($host_name,$username,$password) or die("连接数据库失败！");
    mysql_query("set names utf8");
    mysql_select_db($database) or die("连接数据库失败");
    return $mysql;
}


//mysql insert function
function insert($table,$data) {
    $key = join(",",array_keys($data));
    $value = "'".join("','",array_values($data))."'";
    $sql = "INSERT INTO {$table}({$key}) VALUES({$value})";
    mysql_query($sql);
    return mysql_insert_id();
}


//mysql update function
function update($table,$data,$where = null) {
    $string = "";
    foreach ($data as $key=>$value) {
        if ($string == "") {
            $step = "";
        }else {
            $step = ',';
        }
        $string .= "{$step}{$key}='{$value}'";
    }
    $sql = "UPDATE {$table} SET {$string} ".($where == null?null:"WHERE {$where}");
    mysql_query($sql);
    return mysql_affected_rows();
}


//mysql delete function
function delete($table,$where) {
    $where == null?null:$where;
    $sql = "DELETE FROM {$table} WHERE {$where}";
    mysql_query($sql);
    return mysql_affected_rows();
}


function fetch_row($sql,$result_type = MYSQL_ASSOC) {
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result,$result_type);
    if (isset($row)) {
        return $row;
    }else {
        return false;
    }
}


function fetch_all($sql,$result_type = MYSQL_ASSOC) {
    $result = mysql_query($sql);
    while (@$row = mysql_fetch_array($result,$result_type)) {
        $rows[]=$row;
    }
    if (isset($rows)) {
        return $rows;
    }else {
        return false;
    }
 }



function getResultNum($sql) {
    $result = mysql_query($sql);
    return mysql_num_rows($result);
}
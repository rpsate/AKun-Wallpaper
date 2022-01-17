<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/5/12
 * Time: 16:13
 */
require_once dirname(dirname(__FILE__))."/include.php";


//检查是否登陆
function checkLogin() {
    if ((!isset($_SESSION['adminId'])  || $_SESSION['adminId'] == "")  && (!isset($_COOKIE['adminId']) || $_COOKIE['adminId'] == "")) {
        alert("请先登陆！","login.html");
    }
}

//添加管理员
function addAdmin() {
    $admin_user = $_POST;

    if (strlen(trim($admin_user['password']))<6) {
        alert_back("密码长度不能少于6！");
    }else if(strlen(trim($admin_user['username']))<3){
        alert_back("管理员名称长度不用少于3！");
    }

    $admin_user['password'] = md5($admin_user['password']);
    $mysql = mysqlConnect(MYSQL_HOST_NAME,MYSQL_USER,MYSQL_PASSWORD,"searchimages");
    if (insert('admin_root',$admin_user)) {
        $info = "添加成功！<br><a href='addAdmin.php?action=addAdmin'>继续添加</a>";
    }else {
        $info = "添加失败，可能该管理员名称已存在！<br><a href='addAdmin.php?action=addAdmin'>重新添加</a>";
    }
    mysql_close($mysql);
    return $info;
}

//修改管理员信息
function updateAdmin($id) {
    $admin_user = $_POST;
    $admin_user['password'] = md5($admin_user['password']);
    $mysql = mysqlConnect(MYSQL_HOST_NAME,MYSQL_USER,MYSQL_PASSWORD,"searchimages");
    if (update("admin_root",$admin_user,"id={$id}")) {
        $info = "修改成功！<br><a href='listAdmin.php'>返回列表</a>";
    }else {
        $info = "修改失败！<br><a href='editAdmin.php?action=editAdmin&id={$id}'>再次修改</a>";
    }
    mysql_close($mysql);
    return $info;
}

//删除管理员
function deleteAdmin($id) {
    $mysql = mysqlConnect(MYSQL_HOST_NAME,MYSQL_USER,MYSQL_PASSWORD,"searchimages");
    if (delete("admin_root","id={$id}")) {
        $info = "删除成功！";
    }else {
        $info = "删除失败!";
    }
    mysql_close($mysql);
    return $info;
}

//获取所有管理员
function getAllAdmin() {
    $mysql = mysqlConnect(MYSQL_HOST_NAME,MYSQL_USER,MYSQL_PASSWORD,"searchimages");
    $rows = fetch_all("SELECT id,username,email FROM admin_root",MYSQL_NUM);
    mysql_close($mysql);
    if ($rows == array()) {
        alert("没有管理员，请添加管理员","addAdmin.php?action=addAdmin");
    }
    return $rows;
}

//注销管理员
function logout() {
    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(),"",time()-1);
    }
    if (isset($_COOKIE['adminId'])) {
        setcookie("adminId","",time()-1);
    }
    if (isset($_COOKIE['adminUser'])) {
        setcookie("adminUser","",time()-1);
    }
    header("location:login.html");
}

function putImage($imageDate){
    $mysql = mysqlConnect(MYSQL_HOST_NAME,MYSQL_USER,MYSQL_PASSWORD,"searchimages");
    if (insert('images',$imageDate)) {
        $info = "添加成功！<br><a href='updateImages.php'>继续添加</a>";
    }else {
        $info = "添加失败！<br><a href='updateImages.php'>重新添加</a>";
    }
    mysql_close($mysql);
    return $info;
}

function isImageExist($imageName) {
    $mysql = mysqlConnect(MYSQL_HOST_NAME,MYSQL_USER,MYSQL_PASSWORD,"searchimages");
    $sql = "SELECT imageName FROM images WHERE imageName='{$imageName}'";
    $image_name = fetch_row($sql,MYSQL_NUM);
    mysql_close($mysql);
    if ($image_name[0] == $imageName) {
        return true;
    }else {
        return false;
    }
}

function getAllImage(){
    $mysql = mysqlConnect(MYSQL_HOST_NAME,MYSQL_USER,MYSQL_PASSWORD,"searchimages");
    $sql = "SELECT * FROM images";
    $rows = fetch_all($sql,MYSQL_NUM);
    mysql_close($mysql);
    return $rows;
}


function getSearchImage($searchContent,$offset=0,$pageSize=99999){
    $mysql = mysqlConnect(MYSQL_HOST_NAME,MYSQL_USER,MYSQL_PASSWORD,"searchimages");
    $limit = "limit {$offset},{$pageSize}";
    $sql = "SELECT * FROM images WHERE imageName LIKE '{$searchContent}' {$limit}";
    $rows = fetch_all($sql,MYSQL_NUM);
    mysql_close($mysql);
    return $rows;
}

function delImage($id) {
    $mysql = mysqlConnect(MYSQL_HOST_NAME,MYSQL_USER,MYSQL_PASSWORD,"searchimages");
    if (delete("images","id='{$id}'")) {
        $info = "删除成功！";
    }else {
        $info = "删除失败!";
    }
    mysql_close($mysql);
    return $info;
}

function updateImage($id) {
    $imageDate = $_POST;
    $mysql = mysqlConnect(MYSQL_HOST_NAME,MYSQL_USER,MYSQL_PASSWORD,"searchimages");
    if (update("images",$imageDate,"id={$id}")) {
        $info = true;
    }else {
        $info = false;
    }
    mysql_close($mysql);
    return $info;
}

function getPageImageInfo($searchContent="",$pageSize=5) {
    if (isset($_GET['page'])) {
        $page = ceil($_GET['page']);
    }else {
        $page = 1;
    }

    $mysql = mysqlConnect(MYSQL_HOST_NAME,MYSQL_USER,MYSQL_PASSWORD,"searchimages");
    $sql = "SELECT id FROM images WHERE imageName LIKE '{$searchContent}'";
    $totalPage = getResultNum($sql);
    $pageNum = ceil($totalPage / $pageSize);
    if ($page<=1) {
        $page = 1;
    }elseif ($page>=$pageNum) {
        $page = $pageNum;
    }
    $offset = ($page-1)*$pageSize;

    $pageInfo['page'] = $page;
    $pageInfo['totalPage']=$totalPage;
    $pageInfo['pageNum'] = $pageNum;
    $pageInfo['offset'] = $offset;
    $pageInfo['pageSize'] = $pageSize;
    return $pageInfo;
}

function isMobile(){
    $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';
    function CheckSubstrs($substrs,$text){
        foreach($substrs as $substr)
            if(false!==strpos($text,$substr)){
                return true;
            }
        return false;
    }
    $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
    $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');

    $found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) ||
        CheckSubstrs($mobile_token_list,$useragent);

    if ($found_mobile){
        return true;
    }else{
        return false;
    }
}
<?php
require_once "../include.php";
checkLogin();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $mysql = mysqlConnect(MYSQL_HOST_NAME,MYSQL_USER,MYSQL_PASSWORD,"searchImages");
    $row = fetch_row("SELECT imageName,imagePath FROM images WHERE id={$id}",MYSQL_NUM);
    mysql_close($mysql);

    $imageName = $row[0];
    $imagePath = $row[1];

    $searchContent = $_GET['searchContent'];
    $page = $_GET['page'];
}else {
    alert_back("请传入id！");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>修改图片信息</title>
</head>
<body>
<h3>修改图片信息</h3>
<form action="doImageAction.php?action=editImage&searchContent=<?php echo $searchContent?>&page=<?php echo $page?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id?>">
    <table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
        <tr>
            <td align="right">图片</td>
            <td><img width="300px" id="image" src="<?php echo LIST_IMAGES.'/'.$imagePath?>"></td>
        </tr>
        <tr>
            <td align="right">图片名</td>
            <td><input type="text" name="imageName" value="<?php echo $imageName?>"/></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit"  value="修改图片名"/></td>
        </tr>
    </table>
</form>
</body>
</html>
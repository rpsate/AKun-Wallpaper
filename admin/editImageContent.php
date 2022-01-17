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
    <title>修改壁纸信息</title>
</head>
<body>
<h3>修改壁纸信息</h3>
<form id="form" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id?>">
    <table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
        <tr>
            <td align="right">壁纸</td>
            <td><img width="300px" id="image" src="<?php echo LIST_IMAGES.'/'.$imagePath?>"></td>
        </tr>
        <tr>
            <td align="right">壁纸地址</td>
            <td><input type="file" name="path" id="fileload" onchange="previewImage()"/></td>
        </tr>
        <tr>
            <td align="right">壁纸名</td>
            <td><input type="text" name="imageName" value="<?php echo $imageName?>"/>
            </td>
        </tr>
        <tr>
            <input id="filePath" type="hidden" name="fileName" value="<?php echo LIST_IMAGES.'/'.$imagePath?>">
            <td colspan="2"><button onclick="check();return false;">修改壁纸</button></td>
        </tr>
    </table>
</form>
<script>
    var file = document.getElementById("fileload").files[0];
    previewImage();

    function check() {
        var file = document.getElementById("fileload").files[0];
        var form = document.getElementById('form');
        if(file === undefined || file === null) {
            var filePath = document.getElementById("filePath");
            filePath.disabled = true;
            form.action = "doImageAction.php?action=editImage&searchContent=<?php echo $searchContent?>&page=<?php echo $page?>";
            form.submit();
        }else  {
            form.action = "doImageAction.php?action=editImageContent&searchContent=<?php echo $searchContent?>&page=<?php echo $page?>";
            form.submit();
        }
    }

    function previewImage() {
        var file = document.getElementById("fileload").files[0];
        if (file !== undefined && file !== null) {
            var img = document.getElementById("image");
            img.style.display = "block";
            //建一条文件流来读取壁纸
            var reader = new FileReader();
            //根据url将文件添加的流中
            reader.readAsDataURL(file);
            //实现onload接口
            reader.onload = function() {
                //获取文件在流中url
                url = reader.result;
                //将url赋值给img的src属性
                img.src = url;
            }
        }
    }
</script>
</body>
</html>
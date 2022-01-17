<?php
require_once "../include.php";
checkLogin();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>上传壁纸</title>
</head>
<body>
<h3>上传壁纸</h3>
<form action="doupdateImages.php" method="post" enctype="multipart/form-data">
    <table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
        <tr>
            <td align="right">壁纸</td>
            <td><img src="#" id="image" width="300"style="display: none;" ></td>
        </tr>
        <tr>
            <td align="right">壁纸地址</td>
            <td><input type="file" name="path" id="fileload" onchange="previewImage()"/></td>
        </tr>
        <tr>
            <td align="right">壁纸名称</td>
            <td><input type="text" name="name" /></td>
        </tr>

        <tr>
            <td colspan="2"><input type="submit"  value="上传壁纸"/></td>
        </tr>

    </table>
</form>
<script>
    var file = document.getElementById("fileload").files[0];
    previewImage();

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
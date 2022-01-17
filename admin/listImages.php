<?php
require_once "../include.php";
checkLogin();

$search_content = "%%";
$search_content_text = "";

if (isset($_GET['searchContent'])) {
    $search_content = $_GET['searchContent'];
    $search_content = addslashes($search_content);
    $search_content = "%".$search_content."%";
    $search_content = trim($search_content);
    $search_content_text = substr($search_content,1,strlen($search_content)-2);
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>listAdmin</title>
    <link rel="stylesheet" href="style/backstage.css">
</head>
<body>
<div class="details">
    <div class="details_operation clearfix">
        <div class="bui_select">
            <input type="button" value="添&nbsp;&nbsp;加" class="add" style="cursor:pointer;" onclick="addImage()">
        </div>
        <div class="fr">
            <div class="bui_select" style="margin-right: 10px;">
                <input type="button" value="全选" class="add" style="cursor:pointer;padding: auto 12px;" onclick="checkAll()">
            </div>
            <div class="bui_select" style="margin-right: 10px;">
                <input type="button" value="删除所选壁纸" class="add" style="cursor:pointer;width: 110px;" onclick="delAllImages('<?php echo $search_content_text?>')">
            </div>
            <div class="bui_select">
                <input type="button" value="&nbsp;&nbsp;显示全部壁纸&nbsp;&nbsp;" class="add" style="cursor:pointer; width: 110px;" onclick="showAllImages()">
            </div>
            <div class="text">
                <form method="get" action="listImages.php">
                    <input type="text" name="searchContent" value="<?php echo substr($search_content,1,strlen($search_content)-2)?>" class="search">
                        <input type="submit" value="搜索" style="cursor:pointer;">
                </form>
            </div>
        </div>
    </div>

    <!--表格-->
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th width="6%">选择</th>
            <th width="15%">壁纸</th>
            <th width="35%">壁纸名称名称</th>
            <th width="20%">上传时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($search_content == "%%") {
            $pageInfo = getPageImageInfo($search_content_text,10);
            $rows = false;
        } else {
            $pageInfo = getPageImageInfo($search_content,10);
            $rows = getSearchImage($search_content,$pageInfo['offset'],$pageInfo['pageSize']);
        }
        if ($rows) {
            foreach ($rows as $row) {
                ?>

                <!--这里的id和for里面的c1 需要循环出来-->
                <tr>
                    <td style="text-align: center">
                        <input type="checkbox" name="checkbox" value="<?php echo $row[0]?>:<?php echo LIST_IMAGES.'/'.$row[2] ?>">
                    </td>
                    <td>
                        <label for="c1" class="label">
                            <img width="60px" src="<?php echo LIST_IMAGES.'/'.$row[2] ?>">
                        </label>
                    </td>
                    <td>
                        <?php echo $row[1] ?>
                    </td>
                    <td>
                        <?php echo date("Y-m-d h:i:s", filectime(LIST_IMAGES."/".$row[2])); ?>
                    </td>
                    <td align="center">
                        <!--<input type="button" value="修改名称" class="btn" onclick="editImageName(<?php /*echo "{$row[0]},'{$search_content_text}','{$pageInfo['page']}'" */?>)">-->
                        <input type="button" value="修改壁纸" class="btn" onclick="editImage(<?php echo "{$row[0]},'{$search_content_text}','{$pageInfo['page']}'" ?>)">
                        <input type="button" value="删除" class="btn"
                               onclick="deleteImage(<?php echo "{$row[0]},'{$row[1]}','".LIST_IMAGES.'/'."{$row[2]}','{$search_content_text}','{$pageInfo['page']}'"?>)">
                    </td>
                </tr>

                <?php
            }
        }
        ?>
        </tbody>
    </table>
    <?php

        $whereContent = "searchContent={$search_content_text}&limit={$pageInfo['offset']},{$pageInfo['pageSize']}";
    $pageStr = showPage($pageInfo['page'],$pageInfo['totalPage'],$pageInfo['pageSize'],$whereContent);
    ?>
    <div style="width: 100%;text-align: center;margin: 5px auto;">
        <?php echo $pageStr;?>
    </div>
</div>
<script>
    flag = false;
    function addImage() {
        window.location.href="updateImages.php";
    }
    function editImageName(id,searchContent,page) {
        window.location.href="editImage.php?id="+id+"&searchContent="+searchContent+"&page="+page;
    }
    function editImage(id,searchContent,page) {
        window.location.href="editImageContent.php?id="+id+"&searchContent="+searchContent+"&page="+page;
    }
    function checkAll() {
        var checkbox = document.getElementsByName("checkbox");
        var length = checkbox.length;
        flag = !flag;
        if (flag) {
            for (var i=0;i<length;i++) {
                checkbox[i].checked = 1;
            }
        }else {
            for (var i=0;i<length;i++) {
                checkbox[i].checked = 0;
            }
        }
    }
    function deleteImage(id,name,path,searchContent,page) {
        if (confirm("你确定要删除"+name+"吗?") == true) {
            window.location.href="doImageAction.php?action=delImage&id="+id+"&fileName="+path+"&searchContent="+searchContent+"&page="+page;
        }
    }
    function showAllImages() {
        window.location.href="listImages.php?searchContent=%"
    }
    function delAllImages(searchContent) {
        var checkbox = document.getElementsByName("checkbox");
        var length = checkbox.length;
        var info = [];
        for (var i=0;i<length;i++) {
            if (checkbox[i].checked) {
                if(checkbox[i] == "[object HTMLInputElement]") {
                    info.push(checkbox[i].value);
                }
            }
        }
        var info = info.toString();
        if (info == "") {
            alert("未选中壁纸！");
        }else {
            if (confirm("你确定要删除所选壁纸吗？")==true) {
                window.location.href="doImageAction.php?action=delAllImage&info="+info+"&searchContent="+searchContent;
            }
        }
    }
</script>
</body>
</html>


<?php
require_once "../include.php";
checkLogin();
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
            <input type="button" value="添&nbsp;&nbsp;加" class="add" style="cursor:pointer;" onclick="addAdmin()">
        </div>
        <div class="fr">
            <div class="text">
            </div>
        </div>
    </div>

    <!--表格-->
<table class="table" cellspacing="0" cellpadding="0">
    <thead>
    <tr>
        <th width="15%">id</th>
        <th width="25%">管理员名称</th>
        <th width="35%">邮箱</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $rows = getAllAdmin();
    foreach ($rows as $row) {
        ?>

        <!--这里的id和for里面的c1 需要循环出来-->
        <tr>
            <td>
                <label for="c1" class="label">
                    <?php echo $row[0]?>
                </label>
            </td>
            <td><?php echo $row[1]?></td>
            <td><?php echo $row[2]?></td>
            <td align="center">
                <input type="button" value="修改" class="btn" onclick="editAdmin('<?php echo $row[0]?>')">
                <input type="button" value="删除" class="btn" onclick="deleteAdmin('<?php echo $row[0]."','".$row[1]?>')">
            </td>
        </tr>

        <?php
    }
    ?>
    </tbody>
</table>
</div>
<script>
    function addAdmin() {
        window.location.href="addAdmin.php";
    }
    function editAdmin(id) {
        window.location.href="editAdmin.php?id="+id;
    }
    function deleteAdmin(id,name) {
        if (confirm("你确定要删除"+name+"吗?") == true) {
            window.location.href="doAdminAction.php?action=delete&id="+id;
        }
    }
</script>
</body>
</html>
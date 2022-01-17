<?php
require_once "../include.php";
checkLogin();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $mysql = mysqlConnect(MYSQL_HOST_NAME,MYSQL_USER,MYSQL_PASSWORD,"searchImages");
    $row = fetch_row("SELECT username,email FROM admin_root WHERE id={$id}",MYSQL_NUM);
    mysql_close($mysql);

    $username = $row[0];
    $email = $row[1];
}else {
    alert_back("请传入id！");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Insert title here</title>
</head>
<body>
<h3>修改管理员信息</h3>
<form action="doAdminAction.php?action=editAdmin" method="post">
    <input type="hidden" name="id" value="<?php echo $id?>">
    <table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
        <tr>
            <td align="right">管理员名称</td>
            <td><input type="text" name="username" value="<?php echo $username?>"/></td>
        </tr>
        <tr>
            <td align="right">管理员密码</td>
            <td><input type="password" name="password" /></td>
        </tr>
        <tr>
            <td align="right">管理员邮箱</td>
            <td><input type="text" name="email" value="<?php echo $email?>"/></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit"  value="修改管理员"/></td>
        </tr>

    </table>
</form>
</body>
</html>
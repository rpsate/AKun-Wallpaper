<?php
require_once "../include.php";
checkLogin();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>基于智能搜索的高清壁纸平台</title>
<link rel="stylesheet" href="style/backstage.css">
</head>

<body>
    <div class="head">
            <h3 class="head_text">基于智能搜索的高清壁纸平台</h3>
    </div>
    <div class="operation_user clearfix">
        <?php

        $counter_file = "../counter/".date("Ymd",time()).".dat";
        $counter_file_today = "../counter/".(intval(date("Ymd",time()))-1).".dat";
        if (file_exists($counter_file)) {
            $counter = intval(file_get_contents($counter_file));
        }else {
            $counter = 0;
        }
        if (file_exists($counter_file_today)) {
            $counter_today = intval(file_get_contents($counter_file_today));
        }else {
            $counter_today = 0;
        }
        ?>
        <div class="link fl"><span style="font: 12px/2.5 '微软雅黑';">昨日访问量：<?php echo $counter_today?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;今天已有访问数为：<?php echo $counter?></span href="#"></div>
        <div class="link fr">
            <label href="#">你好
                <?php
                if (isset($_SESSION['adminUser'])) {
                    echo $_SESSION['adminUser'];
                }elseif (isset($_COOKIE['adminUser'])) {
                    echo $_COOKIE['adminUser'];
                }
                ?>
            </label>
            <span></span><a href="../index.html" class="icon icon_i">首页</a><span></span><a href="index.php" class="icon icon_n">刷新</a><span></span><a href="doAdminAction.php?action=logout" class="icon icon_e">退出</a>
        </div>
    </div>
    <div class="content clearfix">
        <div class="main">
            <!--右侧内容-->
            <div class="cont">
                <div class="title">后台管理</div>
                <!-- 嵌套网页开始 -->
                <iframe src="listImages.php?searchContent=%"  frameborder="0" name="mainFrame" id="mainFrame" width="100%" height="522"></iframe>
                <!-- 嵌套网页结束 -->
            </div>
        </div>
        <!--左侧列表-->
        <div class="menu">
            <div class="cont">
                <div class="title">菜单</div>
                <ul class="mList">
                    <li>
                        <h3><span style="cursor:pointer" onclick="show('menu5','change5')" id="change5">+</span>管理员管理</h3>
                        <dl id="menu5" style="display:none;">
                            <dd><a href="addAdmin.php" target="mainFrame">添加管理员</a></dd>
                            <dd><a href="listAdmin.php" target="mainFrame">管理员列表</a></dd>
                        </dl>
                    </li>

                    <li>
                        <h3><span style="cursor:pointer" onclick="show('menu6','change6')" id="change6">+</span>壁纸管理</h3>
                        <dl id="menu6" style="display:none;">
                            <dd><a href="listImages.php?searchContent=%" target="mainFrame">壁纸列表</a></dd>
                            <dd><a href="updateImages.php" target="mainFrame">上传壁纸</a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <script type="text/javascript">
        show('menu6','change6')
        function show(num,change){
            var menu=document.getElementById(num);
            var change=document.getElementById(change);
            if(change.innerHTML=="+"){
                change.innerHTML="-";
            }else{
                change.innerHTML="+";
            }
            if(menu.style.display=='none'){
                menu.style.display='';
            }else{
                menu.style.display='none';
            }
        }
    </script>
</body>
</html>
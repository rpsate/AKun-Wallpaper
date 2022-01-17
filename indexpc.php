<?php
require_once "core/core.php";

$search_content = "";
$search_content_text = "";
//获取搜索关键词
if (isset($_GET['searchContent'])) {
    $search_content = $_GET['searchContent'];
    $search_content = addslashes($search_content);
    $search_content = "%".$search_content."%";
    $search_content = trim($search_content);
    $search_content_text = substr($search_content,1,strlen($search_content)-2);
}

//counter 统计访问次数
$counter_file = "counter/".date("Ymd",time()).".dat";
if (!file_exists($counter_file)) {
    $myfile = fopen($counter_file, "w");
    fwrite($myfile, "0");
    fclose($myfile);
}

$counter = intval(file_get_contents($counter_file));  //创建一个dat数据文件
if(!isset($_COOKIE['counter'])) {
    //计算此时到0点的时间间隔
    $time = strtotime(date('Ymd')) + 60*60*24;
    $timeInterval = $time - time();

    setcookie("counter",true,time()+$timeInterval);
    $_COOKIE['counter'] = true;
    $counter++;  //刷新一次+1
    $fp = fopen($counter_file,"w");  //以写入的方式，打开文件，并赋值给变量fp
    fwrite($fp, $counter);   //将变量fp的值+1
    fclose($fp);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>基于智能搜索的高清壁纸平台</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/bootstrap.css">
    <base target="_blank">
</head>
<body>
<div class="container-fluid gallery-container">

        <div class="row">
            <div class="top-content">
                <img src="images/logo.png" class="top-logo">
                <form method="get" action="indexpc.php">
                    <div class="top-search-box">
                        <input type="text" class="top-search-input" name="searchContent" value="<?php echo $search_content_text?>" placeholder="请输入要搜索的壁纸">
                        <input type="submit" class="top-search-btn" value="搜索">
                    </div>
                </form>
            </div>
        </div>

        <div class="row">

            <?php
            if ($search_content == "%%") {
            $pageInfo = getPageImageInfo($search_content_text,20);
            $rows = false;
            } else {
            $pageInfo = getPageImageInfo($search_content,20);
            $rows = getSearchImage($search_content,$pageInfo['offset'],$pageInfo['pageSize']);
            }
            if ($rows) {
            foreach ($rows as $row) {
            ?>

            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="thumbnail">
                    <a class="lightbox" target="_blank" href="<?php echo basename(LIST_IMAGES).'/'.$row[2]?>">
                        <img src="<?php echo basename(LIST_IMAGES).'/'.$row[2]?>" alt="Park">
                    </a>
                    <div class="caption">
                        <p><?php echo $row[1]?></p>
                    </div>
                </div>
            </div>

            <?php
                }
            }
            ?>

        </div>

    <?php
    $whereContent = "searchContent={$search_content_text}&limit={$pageInfo['offset']},{$pageInfo['pageSize']}";
    $pageStr = showPage($pageInfo['page'],$pageInfo['totalPage'],$pageInfo['pageSize'],$whereContent);
    ?>
    <div style="width: 100%;text-align: center;margin: 5px auto;">
        <?php echo $pageStr;?>
    </div>
</div>

</body>
</html>

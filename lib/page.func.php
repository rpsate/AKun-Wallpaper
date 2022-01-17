<?php
function showPage($page=1,$totalPage=1,$pageSize=5,$where=NULL,$sep="&nbsp;") {
    $url = $_SERVER['PHP_SELF'];
    $pageNum = ceil($totalPage / $pageSize);

    if ($where == NULL) {
        $where = NULL;
    }else {
        $where .= "&".$where;
    }

    if ($page<=1){
        $prev = "<span>上一页</span>";
    }else {
        $prev = "<a href='{$url}?page=".($page-1).$where."'>上一页</a>";
    }

    if ($page>=$pageNum){
        $next = "<span>下一页</span>";
    }else {
        $next = "<a href='{$url}?page=".($page+1).$where."'>下一页</a>";
    }

    $pageStr = "";
    for ($i=1;$i<=$pageNum;$i++) {
        if ($page == $i) {
            $pageStr .= "<span>{$i}</span>".$sep;
        } else {
            $pageStr .= "<a href='{$url}?page={$i}{$where}'>{$i}</a>".$sep;
        }
    }
    if ($pageNum<=1) {
        $string = "";
    } else {
        $string = $prev.$sep.$pageStr.$next;
    }
    return $string;
}


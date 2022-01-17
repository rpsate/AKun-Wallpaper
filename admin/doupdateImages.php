<?php
require_once "../include.php";
checkLogin();

//extension
$file_path = LIST_IMAGES;
$allow_extension = array("jpg","png","jpeg","gif");

/*init*/
header('content-type:text/html;charset=utf-8');
$max_size = MAX_SIZE * 1024.00 * 1024.00;
/*content*/
$image_name = $_POST['name'];
$file_info = $_FILES['path'];
$file_name = $file_info['name'];
$file_size = $file_info['size'];
$file_tmp_name = $file_info['tmp_name'];
$file_error = $file_info['error'];
$image_name = trim($image_name);

if ($image_name == "") {
    alert_back("文件名为空");
    exit();
}

if (isImageExist($image_name)) {
    alert_back("文件名已经存在，请重新输入文件名");
}

if($file_error == 0){

    //判断文件大小
    if($file_size > $max_size){
        exit("上传文件过大");
    }


    //判断文件是否为psot方式上传
    if(!is_uploaded_file($file_tmp_name)){
        exit("非法上传方式");
    }

    //判断是否是非法文件
    $extension = pathinfo($file_name,PATHINFO_EXTENSION);
    $extension = strtolower($extension);
    if(!in_array($extension,$allow_extension)){
        exit("文件名非法");
    }

    //判断文件夹是否存在
    if(!file_exists($file_path)){
        mkdir($file_path,0666,true);
        chmod($file_path,0666);
    }

    //进一步判读是否是壁纸文件
    @$file_rb = @fopen($file_tmp_name,"rb");
    if($file_rb == FALSE){
        echo "文件打开失败";
    }
    $bin = fread($file_rb,2);
    fclose($file_rb);
    $bin = @unpack("C2char",$bin);
    $bin = intval($bin['char1'].$bin['char2']);

    //设置独一无二的文件名
    $uni_name = $file_path.'/'.md5(uniqid(microtime(true),true)).".".$extension;

    if(@move_uploaded_file($file_tmp_name,$uni_name)){
        $imageDate['imageName'] = $image_name;
        $imageDate['imagePath'] = basename($uni_name);
        echo putImage($imageDate);
    }else{
        echo "上传失败";
    }
}else{
    switch ($file_error){
        case 1:
            $error_text = "上传文件过大";
            break;
        case 2:
            $error_text = "上传文件过大";
            break;
        case 3:
            $error_text = "文件部分被上传";
            break;
        case 4:
            $error_text = "没有选择文件";
            break;
        case 6:
            $error_text = "没有找到临时文件";
            break;
        case 7:
            $error_text = "文件写入失败";
            break;
        case 8:
            $error_text = "文件上传被中断";
    }
    exit($error_text.",请重新上传。");
}
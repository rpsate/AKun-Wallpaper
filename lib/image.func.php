<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/5/12
 * Time: 9:59
 */
function createCaptchaImage($captcha_content,$width=80,$height=30,$captcha_length=4,$is_pixel=true,$pixel_count=200,$is_line=true,$line_count=8) {

//create the image for captcha
    $captcha_image = imagecreatetruecolor($width,$height);
    $background_color = imagecolorallocate($captcha_image,255,255,255);
    imagefill($captcha_image,0,0,$background_color);

//write captcha to the image
    $font_data = array("arial.ttf","Cambriaz.ttf","cambriaz.ttf","consolai.ttf");
    for ($i=0;$i<$captcha_length;$i++) {
        $font_size = mt_rand($height/2,$height/2+5);
        $font_color = imagecolorallocate($captcha_image,mt_rand(50,120),mt_rand(80,200),mt_rand(50,160));
        $font_content = substr($captcha_content,$i,1);
        $font_file = "../fonts/".$font_data[mt_rand(0,count($font_data)-1)];

        $x = $i* $font_size + mt_rand(3,5);
        $y = mt_rand($height/2+3,$height-3);
        $angle = mt_rand(-15,15);

        imagettftext($captcha_image,$font_size,$angle,$x,$y,$font_color,$font_file,$font_content);
    }

    if ($is_pixel) {
        $count = 30;
        for ($i=0;$i<$pixel_count;$i++) {
            if ($count++ == 30) {
                $count = 0;
                $pixel_color = imagecolorallocate($captcha_image,mt_rand(150,220),mt_rand(150,250),mt_rand(180,240));
            }
            imagesetpixel($captcha_image,mt_rand(0,$width),mt_rand(0,$height),$pixel_color);
        }
    }

    if ($is_line) {
        for ($i=0;$i<$line_count;$i++) {
            $line_color =imagecolorallocate($captcha_image,mt_rand(120,160),mt_rand(120,150),mt_rand(120,200));
            imageline($captcha_image,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),$line_color);
        }
    }

    return $captcha_image;
}
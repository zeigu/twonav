<?php

    /*
    * 验证码
    */
    error_reporting(0);
    session_start();
    $charset = '1234567890'; //随机因子
    $length = 4;     //验证码长度
    $width = 130;     //宽度
    $height = 50;     //高度
    $fontSize = 20;    //指定字体大小
    $font = '../assets/font/elephant.ttf';
    $captcha = '';

    $img = imagecreatetruecolor($width, $height);
    $color = imagecolorallocate($img, mt_rand(157, 255), mt_rand(157, 255), mt_rand(157, 255));
    imagefilledrectangle($img, 0, $height, $width, 0, $color);

    for($i = 0; $i < $length; $i++) {
        $captcha .= $charset[mt_rand(0, strlen($charset) - 1)];
    }

    for($i = 0; $i < 6; $i++) {
        $color = imagecolorallocate($img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
        imageline($img, mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, $width), mt_rand(0, $height), $color);
    }
    for($i = 0; $i < 100; $i++) {
        $color = imagecolorallocate($img, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
        imagestring($img, mt_rand(1, 5), mt_rand(0, $width), mt_rand(0, $height), '*', $color);
    }

    $x = $width / $length;
    for($i = 0; $i < $length; $i++) {
        $fontColor = imagecolorallocate($img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
        imagettftext($img, $fontSize, mt_rand(-30, 30), $x * $i + mt_rand(1, 5), $height / 1.4, $fontColor, $font, $captcha[$i]);
    }

    $_SESSION['captcha'] = $captcha;
    header('Content-type:image/png');
    imagepng($img);
    imagedestroy($img);
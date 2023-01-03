<?php

include("baglan.php");
ob_start();
session_start();
if (!isset($_SESSION["userkullanici"]) && !isset($_SESSION["usersifre"])) {

    Header("Location:index.php");
} else {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Headers: X-Requested-Witch');
    header('Access-Control-Headers: Content-Type');

    $kullanici = $_SESSION["userkullanici"];

    $company = $db->query("SELECT COMPANY_ID FROM users 
    where USER_CODE='{$kullanici}'")->fetchAll(PDO::FETCH_ASSOC);
    $company;

    foreach ($company as $result) {
        foreach ($result as $key => $value) {
            $company=$value ;
        }
    }



    $diziler = $db->query("SELECT * from video v left join video_type vt on vt.ID=v.VIDEOTYPE_ID
    left join users u on u.ID=vt.USER_ID WHERE v.ACTIVE=1 and u.COMPANY_ID='{$company}' GROUP BY v.VIDEO_NAME")->fetchAll(PDO::FETCH_ASSOC);


    @$info   =    $_POST["info"];
    @$AddImage  =    $_POST["AddImage"];
    @$links  =    $_POST["Links"];
    @$AddImage1  =    $_POST["AddImage1"];
    @$AddImage3  =    $_POST["AddImage3"];
    @$flexRadioDefault2  =    $_POST["flexRadioDefault2"];
    @$fillR  =    $_POST["fillR"];
    @$fillG  =    $_POST["fillG"];
    @$fillB  =    $_POST["fillB"];
    @$borderR  =    $_POST["borderR"];
    @$borderG  =    $_POST["borderG"];
    @$borderB  =    $_POST["borderB"];
    @$backR  =    $_POST["backR"];
    @$backG  =    $_POST["backG"];
    @$backB  =    $_POST["backB"];
    @$slidebarinput  =    $_POST["slidebarinput"];
    @$textR  =    $_POST["textR"];
    @$textG  =    $_POST["textG"];
    @$textB  =    $_POST["textB"];
    @$jsonobj =  $_POST["phppointerList"];
    @$imageinnerhtml = $_POST["imageinnerhtml"];
    @$infocardinnerhtml = $_POST["infocardinnerhtml"];
    @$guid = $_POST["guid"];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />

    <title>Tagmount</title>
    <link rel="shortcut icon" href="#" type="image/x-icon" />

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/canvas.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style(rgb).css">
    <link href="assets/bootstrap/css/component.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.17.0/video-js.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-duration-format/1.3.0/moment-duration-format.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//player2.h-cdn.com/hola_player.js?customer=demo"></script>
    <script src="https://your-site-or-cdn.com/fontawesome/v5.15.4/js/all.js" data-auto-a11y="true" ></script>
    <style>

    </style>
</head>
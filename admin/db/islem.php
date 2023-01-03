<?php
ob_start();
session_start();

include_once '../../vendor/baglan.php';


if (isset($_POST['videokaydet'])) {

    $bolum_id = $_POST["bolum_id"];
    $bolum_link = $_POST["bolum_link"];
    $bolum_adi = $_POST["bolum_adi"];
    $bolum_dizi = $_POST["bolum_dizi"];
  

    $company_id=$db->prepare("SELECT VIDEO_KEY FROM video 
    where VIDEO_NAME='$bolum_dizi'");
    $company_id->execute();
    $res=$company_id->fetchAll(PDO::FETCH_OBJ);
    $company;
    foreach($res as $result){
        //loop over each $result (row), setting $key to the column name and $value to the value in the column.
        foreach($result as $key=>$value){
            //echo the key and value.
            $company = $value;
        }
    }
    $videotype=$db->prepare("SELECT VIDEOTYPE_ID FROM video 
    where VIDEO_NAME='$bolum_dizi'");
    $videotype->execute();
    $video_type=$videotype->fetchAll(PDO::FETCH_OBJ);
    $videotype_id;
    foreach($video_type as $result){
        //loop over each $result (row), setting $key to the column name and $value to the value in the column.
        foreach($result as $key=>$value){
            //echo the key and value.
            $videotype_id = $value;
        }
    }
    if(($company==NULL)){
    $query = $db->exec("UPDATE video SET
    VIDEO_KEY = '$bolum_id',
    VIDEO_LINK = '$bolum_link',
    EPISODE = '$bolum_adi',
    ACTIVE=1 where VIDEO_NAME='$bolum_dizi'
    
    ");
}else{
    $query = $db->exec("INSERT INTO video SET
    VIDEOTYPE_ID='$videotype_id',
    VIDEO_NAME='$bolum_dizi',    
    VIDEO_LINK = '$bolum_link',
    EPISODE = '$bolum_adi',
    VIDEO_KEY = '$bolum_id',
    ACTIVE=1 ");
}

    if ($query) {
        Header("Location:../video.php?durum=ok");
    } else {

        Header("Location:../video.php?durum=no");
        
    }
}

if (isset($_POST['bolumguncelle'])) {

    $id = $_POST['id'];
    $bolum_link = $_POST['bolum_link'];
    $bolum_adi = $_POST['bolum_adi'];

    if ($id != "") {


        $query = $db->exec("UPDATE video SET 
        VIDEO_LINK = '$bolum_link',
        EPISODE = '$bolum_adi'
        WHERE ID='$id'
    ");

        Header("Location:../video.php?durum=ok");
        echo "basarılı.";
    } else {

        Header("Location:../video.php?durum=no");
        echo "basarısız.";
    }
}
if (isset($_POST['usersupdate'])) {

    $id = $_POST['id'];
    $company_name = $_POST['company_name'];
    $name_surname = $_POST['name_surname'];
    $user_email = $_POST['user_email'];
    $phone_number = $_POST['phone_number'];

    if ($id != "") {


        $query = $db->exec("UPDATE users SET 
        NAME_SURNAME = '$name_surname',
        USER_EMAIL = '$user_email',
        PHONE_NUMBER = '$phone_number'
        WHERE COMPANY_ID='$id'
    ");
      $query = $db->exec("UPDATE company SET 
      NAME = '$company_name',
      WHERE ID='$id'
  ");

        Header("Location:../users.php?durum=ok");
        echo "basarılı.";
    } else {

        Header("Location:../users.php?durum=no");
        echo "basarısız.";
    }
}
if (isset($_POST['diziguncelle'])) {

    $id = $_POST['id'];
    $dizi_adi = $_POST['dizi_adi'];


    if ($id != "") {
        $query = $db->exec("UPDATE video SET       
        VIDEO_NAME = '$dizi_adi'
        WHERE VIDEOTYPE_ID='$id'
    ");

        Header("Location:../dizi.php?durum=ok");
        echo "basarılı.";
    } else {

        Header("Location:../dizi.php?durum=no");
        echo "basarısız.";
    }
}

if (isset($_POST['dizikaydet'])) {

    $video_dizi = $_POST["video_dizi"];

    $kullanici = $_SESSION["userkullanici"];

    $company_id = $db->query("SELECT COMPANY_ID FROM users 
    where USER_CODE='{$kullanici}'")->fetchAll(PDO::FETCH_ASSOC);
    $company;
    foreach ($company_id as $result) {
        foreach ($result as $key => $value) {
            $company = $value;
        }
    }
    $user_id = $db->query("SELECT ID FROM users 
    where USER_CODE='{$kullanici}'")->fetchAll(PDO::FETCH_ASSOC);
    $user;
    foreach ($user_id as $result) {
        foreach ($result as $key => $value) {
            $user = $value;
        }
    }
    $query1 = $db->prepare("INSERT INTO video_type SET
    COMPANY_ID='{$company}',
    USER_ID='{$user}'

    ");
    $insert1 = $query1->execute(array());
    if ($insert1) {
        $queryLastId = $db->query("SELECT LAST_INSERT_ID()");
        $lastId = $queryLastId->fetchColumn();
        $query = $db->prepare("INSERT INTO video SET
            VIDEOTYPE_ID =:videotype_id,
            VIDEO_NAME = :video_dizi
            ");
                $insert = $query->execute(array(
                    "videotype_id" => $lastId,
                    "video_dizi" => $video_dizi,

                ));
        Header("Location:../dizi.php?durum=ok");
    } else {

        Header("Location:../dizi.php?durum=no");
    }  
}

if ($_GET['iceriksil'] == 'ok') {
    $iceriksil = $db->prepare("UPDATE video SET ACTIVE =0 where ID=:ID");
    $iceriksil->execute(array(
        'ID' => $_GET['ID']
    ));
    if ($iceriksil) {
        Header("Location:../video.php?durum=ok");
    } else {

        Header("Location:../video.php?durum=no");
    }
}
if ($_GET['icerikdizisil'] == 'ok') {
    $iceriksil = $db->prepare("UPDATE video SET ACTIVE =0 where VIDEOTYPE_ID=:ID");
    $iceriksil->execute(array(
        'ID' => $_GET['ID']
    ));
    if ($iceriksil) {
        Header("Location:../dizi.php?durum=ok");
    } else {

        Header("Location:../dizi.php?durum=no");
    }
    $iceriksil = $db->prepare("UPDATE video_type SET ACTIVE =0 where ID=:ID");
    $iceriksil->execute(array(
        'ID' => $_GET['ID']
    ));
    if ($iceriksil) {
        Header("Location:../dizi.php?durum=ok");
    } else {

        Header("Location:../dizi.php?durum=no");
    }
}
if (isset($_POST['usersave'])) {

    $usersName = $_POST["usersName"];
    $usersEmail = $_POST["usersEmail"];
    $usersNumber = $_POST["usersNumber"];
    $usersUrl = $_POST["usersUrl"];
    $usersCompany = $_POST["usersCompany"];
    $usersUid = $_POST["usersUid"];
    $usersPwd = $_POST["usersPwd"];
    $query = $db->prepare("INSERT INTO company SET
    NAME = :usersCompany");
    $insert = $query->execute(array(
        "usersCompany" => $usersCompany,
        
    ));

    $queryLastId = $db->query("SELECT LAST_INSERT_ID()");
    $lastId = $queryLastId->fetchColumn();

    $query = $db->prepare("INSERT INTO users SET
    NAME_SURNAME = :usersName,
    COMPANY_ID = :usersCompany,
    USER_EMAIL = :usersEmail,
    PHONE_NUMBER = :usersNumber,
    DATAURL = :usersUrl,
    USER_CODE = :usersUid,
    USER_PASSWORD = :usersPwd");
    $insert = $query->execute(array(
        "usersName" => $usersName,
        "usersCompany" => $lastId,
        "usersEmail" => $usersEmail,
        "usersNumber" => $usersNumber,
        "usersUrl" => $usersUrl,
        "usersUid" => $usersUid,
        "usersPwd" => $usersPwd,
        
    ));

if ($insert) {
    Header("Location:../users.php?durum=ok");
} else {

    Header("Location:../users.php?durum=no");
}
}
if(isset($_GET['adsActive']) || isset($_GET['videoID'])){

    $getVideoID=$_GET['videoID'];
$updateAds = $db->prepare("UPDATE showsclicks SET ACTIVE =1 where POINTER_ID=:adsActive");
$updateAds->execute(array(
  'adsActive' => $_GET['adsActive']
));
if ($updateAds) {

    Header("Location:../shows.php?ID={$getVideoID}&durum=ok");
} else{
    Header("Location:../shows.php?ID={$getVideoID}&durum=no");
}
}
if(isset($_GET['adsPassive']) || isset($_GET['videoID'])){

    $getpasVideoID=$_GET['videoID'];
$updatepas = $db->prepare("UPDATE showsclicks SET ACTIVE =0 where POINTER_ID=:adsPassive");
$updatepas->execute(array(
  'adsPassive' => $_GET['adsPassive']
));
if ($updatepas) {

    Header("Location:../shows.php?ID={$getpasVideoID}&durum=ok");
} 
else{
    Header("Location:../shows.php?ID={$getpasVideoID}&durum=no");
}
}


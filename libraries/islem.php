<?php
ob_start();
session_start();

require_once '../vendor/baglan.php';



if(isset($_POST['login'])){

    if(empty($_POST['USER_CODE']) or empty($_POST['USER_PASSWORD'])) {


        $data['status']="error";
        $data['message']="Kullanıcı Adı yada şifre boş olamaz";
        echo json_encode($data);
        exit;
        
    } ;

    $kullanicisor=$db->prepare("SELECT * FROM users WHERE BINARY USER_CODE=:user and USER_PASSWORD=:pwd");

    $kullanicisor->execute(array(        
        'user' => $_POST['USER_CODE'],
        'pwd' =>$_POST['USER_PASSWORD'],
    ));

    $say=$kullanicisor->rowCount();
        if($say>0) {
            $_SESSION['userkullanici']=$_POST['USER_CODE'];
            $_SESSION['usersifre']=$_POST['USER_PASSWORD'];

            if(isset($_POST['beni_hatirla'])) {
                
                setcookie("userkullanici","user",strtotime("+1 day"));
                setcookie("usersifre","pwd",strtotime("+1 day"));
            } else
            {
                setcookie("userkullanici","user",strtotime("-1 day"));
                setcookie("usersifre","pwd",strtotime("-1 day")); 
            }

            

            $data['status']="success";
            $data['message']="";
            echo json_encode($data);
        }else{
            $data['status']="error";
            $data['message']="Kullanıcı Adı veya Şifre Yanlış";
            echo json_encode($data);

        }

 


}




if (isset($_POST['diziadi'])){

    $diziadi = $_POST['diziadi'];

   
    $sorgu = $db->prepare('SELECT * FROM video WHERE ACTIVE=1 AND VIDEO_NAME = ?');
    $sorgu->execute([$diziadi]);
    $bolumler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    echo ($diziadi);
    $html = '<option>- Bölüm Seçin -</option>';
    foreach ($bolumler as $bolum){
        $html .= '<option value="' . $bolum['ID'] . '">' . $bolum['EPISODE'] . '</option>';
    }

    echo $html;
    echo ($diziadi);
}

if (isset($_POST['haberkaydet'])) {

    $file_name = $_FILES['bolum_link']['name'];
    $file_temp = $_FILES['bolum_link']['tmp_name'];
    $file_size = $_FILES['bolum_link']['size'];
    

    if($file_size < 50000000){
        $file = explode('.', $file_name);
        $end = end($file);
        $allowed_ext = array('avi', 'flv', 'wmv', 'mov', 'mp4');
        if(in_array($end, $allowed_ext)){
            $name = date("Ymd").time();
            $location = 'video/'.$name.".".$end;
            if(move_uploaded_file($file_temp, $location)){
                $kaydet=$db->prepare("INSERT INTO bolum SET
    bolum_link=:link,
    bolum_adi=:ad,
    bolum_dizi=:dizi");
    
    $insert=$kaydet->execute(array(
        'link' => $_POST['bolum_link'],
        'ad' => $_POST['bolum_adi'],
        'dizi' => $_POST['bolum_dizi'],

        
    ));
    echo "hastagya_deneme başarılı";
                echo "<script>alert('Video Uploaded')</script>";
                echo "<script>window.location = 'index.php'</script>";
            }
        }else{
            echo "<script>alert('Wrong video format')</script>";
            echo "<script>window.location = 'index.php'</script>";
        }
    }else{
        echo "<script>alert('File too large to upload')</script>";
        echo "<script>window.location = 'index.php'</script>";
    }
}
    
    

if(isset($_POST['admin'])){
    if(empty($_POST['USER_CODE']) or empty($_POST['USER_PASSWORD'])) {


        $data['status']="error";
        $data['message']="Kullanıcı Adı yada şifre boş olamaz";
        echo json_encode($data);
        exit;
        
    } ;

    $kullanicisor=$db->prepare("SELECT * FROM users WHERE USER_CODE=:user and USER_PASSWORD=:pwd");

    $kullanicisor->execute(array(

        'user' => $_POST['USER_CODE'],
        'pwd' => ($_POST['USER_PASSWORD']),
    ));

    $say=$kullanicisor->rowCount();
        if($say>0) {

            $data['status']="success";
            echo json_encode($data);
        }else{
            $data['status']="error";
            $data['message']="Kullanıcı Yok";
            echo json_encode($data);

        }


}


if(isset($_POST['userLogin'])){

    if(empty($_POST['USER_CODE']) or empty($_POST['USER_PASSWORD'])) {


        $data['status']="error";
        $data['message']="Kullanıcı Adı yada şifre boş olamaz";
        echo json_encode($data);
        exit;
        
    } ;

    $kullanicisor=$db->prepare("SELECT * FROM users WHERE USER_CODE=:user and USER_PASSWORD=:pwd");

    $kullanicisor->execute(array(        
        'user' => $_POST['USER_CODE'],
        'pwd' =>$_POST['USER_PASSWORD'],
    ));

    $say=$kullanicisor->rowCount();
        if($say>0) {
            $_SESSION['userkullanici']=$_POST['USER_CODE'];
            $data['status']="success";
            $data['message']="Giriş Başarılı";
            echo json_encode($data);
        }else{
            $data['status']="error";
            $data['message']="Kullanıcı Yok";
            echo json_encode($data);

        }

 


}


?>

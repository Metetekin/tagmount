<?php
error_reporting(0);
$data = $_POST['veri']; //post edilen dosya verisi
if (isset($data)){
    $dir = 'file/'; //dosyalarin kaydedileceği klasor yolu
    $size_limit = 546660; //dosya boyutu en fazla kac KB boyutunda olmali
    $extension = explode('/',explode(';',$data)[0])[1]; //dosya uzantisi
    $image = file_get_contents($data);
    if (strlen($image) < $size_limit){ //dosya boyutu uygunsa  
        if ($extension == 'jpeg' || $extension == 'png' || $extension == 'gif'){ //dosya uzantisi jped, png veya gif olmalı
             //veriyi oku
            $result = 'success';
        }else{
            $result = 'Dosya uzantısı uygun değil';
        }
    }
    else{
        $result = 'Dosya boyutu 0.5 MB\'dan küçük olmalı';
    }
}else{
    $result = 'POST sırasında bir hata meydana geldi';
}
echo json_encode($result); //json formatında veriyi geri gönder
?>


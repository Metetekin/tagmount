<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Headers: X-Requested-Witch');
header('Access-Control-Headers: Content-Type');

    include_once("vendor/baglan.php");
    $shows = 0;
    $clicks = 0;
    $query = $db->query("SELECT * FROM showsclicks");//T端m verileri getir
    $query->execute();
    $liste=$query->fetchAll(PDO::FETCH_OBJ);
    $id=$_POST['id'];
    $deviceType=$_POST['deviceType'];
    if(isset($_POST['id'])){
        $id=$_POST['id'];
        $sorgu = $db->prepare("SELECT * FROM showsclicks where POINTER_ID=:id");
        $sorgu ->execute(array(":id"=>$id));
        $idliste=$sorgu->fetch(PDO::FETCH_ASSOC);
    
      $shows = $idliste["SHOWS"];
      $clicks = $idliste["CLICKS"];
      $campaing_name=$idliste["CAMPAING_NAME"];
      $db->query("SET time_zone = '+03:00'");
      
    }
  
    if(isset($_POST['clicks']))
    {
      $clicks=$clicks+1;
      $ayarkaydet=$db->prepare("UPDATE showsclicks SET
      CLICKS=:clicks
      WHERE POINTER_ID=:id");
      $update=$ayarkaydet ->execute(array(
      'id' => $_POST['id'],
      'clicks' => $clicks
      ));
    }
    if(isset($_POST['shows']))
    {
      $shows=$shows+1;
     $ayarkaydet=$db->prepare("UPDATE showsclicks SET
      SHOWS=:shows
      WHERE POINTER_ID=:id");
      $update=$ayarkaydet ->execute(array(
      'id' => $_POST['id'],
      'shows' => $shows
      ));
      $data = $db->query("SELECT POINTER_ID,SHOWS,TOTAL_IMPRESSION FROM showsclicks where POINTER_ID='{$id}' ");

      $showsVal;
      $total_imp_Val;
      while ($row = $data->fetch()) {
          
          $showsVal=$row['SHOWS'];
          $total_imp_Val=$row['TOTAL_IMPRESSION'];
      }
      if ($showsVal ==  $total_imp_Val) { 
        $query = $db->exec("UPDATE showsclicks SET 
        ACTIVE = 0
        WHERE POINTER_ID='{$id}'");

      }
      
    }
    $query = $db->exec("INSERT INTO adsettings SET
      POINTER_ID='$id',
      CAMPAING_NAME='$campaing_name',
      DEVICETYPE = '$deviceType', 
      SHOWS = '$shows',
      CLICKS = '$clicks'
      ");
  echo json_encode($idliste);
?>
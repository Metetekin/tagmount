<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Headers: X-Requested-Witch');
header('Access-Control-Headers: Content-Type');
    include_once("vendor/baglan.php");
    
    $query = $db->query("SELECT * FROM showsclicks");//T端m verileri getir
    $query->execute();
    $liste=$query->fetchAll(PDO::FETCH_OBJ);
    if(isset($_POST['id'])){
        $id=$_POST['id'];
        $sorgu = $db->prepare("SELECT * FROM showsclicks where POINTER_ID=:id");
        $sorgu ->execute(array(":id"=>$id));
        $idliste=$sorgu->fetch(PDO::FETCH_ASSOC);

  
    }
  
   
  echo json_encode($idliste);
?>


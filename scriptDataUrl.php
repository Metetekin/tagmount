<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Headers: X-Requested-Witch');
header('Access-Control-Headers: Content-Type');

include_once("vendor/baglan.php");
$scriptUrl = $_POST['scriptUrl'];
$scriptUrl = $_POST['scriptData'];
if (isset($_POST['scriptUrl'])) {
    $scriptUrlVal = $_POST['scriptUrl'];
    $scriptDataKey = $_POST['scriptData'];
    $query = $db->prepare("SELECT * FROM users where DATAURL=:scriptUrlVal AND DATAKEY=:scriptDataKey "); //Tüm verileri getir
    $query->execute(array(":scriptUrlVal" => $scriptUrlVal,":scriptDataKey" => $scriptDataKey));
    $scriptUrlValue = $query->fetchAll(PDO::FETCH_OBJ);
  }
  echo json_encode($scriptUrlValue);
?>
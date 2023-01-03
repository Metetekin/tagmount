<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Headers: X-Requested-Witch');
header('Access-Control-Headers: Content-Type');
date_default_timezone_set('Europe/Istanbul');
include_once("vendor/baglan.php");
// $shows = 0;
// $clicks = 0;
$scriptData = $_POST['scriptData'];
$scriptUrl = $_POST['scriptUrl'];


$data = $db->query("SELECT * FROM users where DATAKEY='{$scriptData}' and DATAURL='{$scriptUrl}' ");

$datakey;
$dataurl;
while ($row = $data->fetch()) {
    
    $datakey=$row['DATAKEY'];
    $dataurl=$row['DATAURL'];
}

if (($scriptData==$datakey) && ($scriptUrl==$dataurl)) {
if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $query = $db->prepare("SELECT * FROM pointer WHERE ID=:id"); //Tüm verileri getir
  $query->execute(array(":id" => $id));
  $liste = $query->fetchAll(PDO::FETCH_OBJ);
}
if (isset($_POST['video_id'])) {
  $video_id = $_POST['video_id'];
  $query = $db->prepare("SELECT p.*,v.VIDEO_KEY,sc.ACTIVE FROM pointer p left join showsclicks sc on sc.POINTER_ID=p.ID left join video v ON v.ID=p.VIDEO_ID WHERE  v.VIDEO_KEY=:video_id AND p.ACTIVE=1  AND sc.ACTIVE=1 order by p.ID "); //Tüm verileri getir
  $query->execute(array(":video_id" => $video_id));
  $liste = $query->fetchAll(PDO::FETCH_OBJ);
}
if (isset($_POST['video_link'])) {
  $video_link = $_POST['video_link'];
  $query = $db->prepare("SELECT VIDEO_LINK FROM video WHERE  ID=:video_link"); //Tüm verileri getir
  $query->execute(array(":video_link" => $video_link));
  $liste = $query->fetch(PDO::FETCH_ASSOC);
}
if (isset($_POST['showsPointerid'])) {
  $showsPointerid = $_POST['showsPointerid'];
  $query = $db->prepare("SELECT * FROM showsclicks WHERE POINTER_ID=:showsPointerid"); //Tüm verileri getir
  $query->execute(array(":showsPointerid" => $showsPointerid));
  $liste = $query->fetchAll(PDO::FETCH_OBJ);
}
 /*IF(ISSET($_POST['CLICKS']))
 {
   $AYARKAYDET=$db->PREPARE("UPDATE deneme SET
   CLICKS=:CLICKS
   WHERE ID=:ID");
   $UPDATE=$AYARKAYDET ->EXECUTE(ARRAY(
   'ID' => $_POST['ID'],
  'CLICKS' => $clicks
   ));
 }
 ELSE
 {
  $AYARKAYDET=$db->PREPARE("UPDATE deneme SET
   SHOWS=:SHOWS
   WHERE ID=:ID");
   $UPDATE=$AYARKAYDET ->EXECUTE(ARRAY(
   'ID' => $_POST['id'],
   'SHOWS' => $shows
   ));
 }*/
echo json_encode($liste);
}
?>
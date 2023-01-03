<?php 
$host='185.153.222.184';
$vtadi='tagmount';// veritabanı adı
$kullanici='root';//varsayılan olarak kullanıcı ismi
$sifre='keka.tagmount.2022';
try {
  $db = new PDO("mysql:host=$host;dbname=$vtadi;charset=utf8", "$kullanici", "$sifre");
} catch ( PDOException $e ){
     print $e->getMessage();
}
function GetIP(){
  if(getenv("HTTP_CLIENT_IP")) {
    $ip = getenv("HTTP_CLIENT_IP");
  } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
    $ip = getenv("HTTP_X_FORWARDED_FOR");
    if (strstr($ip, ',')) {
      $tmp = explode (',', $ip);
      $ip = trim($tmp[0]);
    }
  } else {
    $ip = getenv("REMOTE_ADDR");
  }
  return $ip;
}
?>
<?php

include 'header.php';
include_once '../vendor/baglan.php';


if (isset($_POST['arama'])) {
  $aranan = $_POST['aranan'];


 

  $iceriksor = $db->prepare("select * from bolum where video LIKE '%$aranan%' order by
        id ASC limit 25");
  $iceriksor->execute();
  $say = $iceriksor->rowCount();
} else {

  $kullanici = $_SESSION["userkullanici"];

  $company_id= $db->query("SELECT COMPANY_ID FROM users 
  where USER_CODE='{$kullanici}'")->fetchAll(PDO::FETCH_ASSOC);
  $company;
  foreach ($company_id as $result) {
      foreach ($result as $key => $value) {
          $company=$value ;
      }
  }
  $iceriksor = $db->prepare("SELECT vt.ID ,v.VIDEOTYPE_ID VIDEOTYPE_ID , v.VIDEO_NAME,COUNT(v.ID) VIDEO_ID 
  from video v left join video_type vt on vt.ID=v.VIDEOTYPE_ID
  left join users u on u.ID=vt.USER_ID WHERE v.ACTIVE=1 and   u.COMPANY_ID='{$company}' GROUP BY v.VIDEO_NAME ");
  $iceriksor->execute();
  $say = $iceriksor->rowCount();
}

$pointerSayi = $db->query("SELECT COUNT(P.ID) POINTER_ID FROM pointer P left join video V on P.VIDEO_ID=V.ID LEFT JOIN video_type VT ON VT.ID=V.VIDEOTYPE_ID WHERE  P.ACTIVE=1 AND VT.COMPANY_ID=$company")->fetch();

?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
      
      </div>

     
    </div>


    <div class="clearfix"></div>



    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <div align="left" class="col-md-6">
                <h2>Diziler<small>
                    <?php
                    echo $say . "Kayıt Listelendi.";
                    if (isset($_GET['durum']) && $_GET['durum'] == 'ok') { ?>

                      <b style="color:green;"> İşlem Başarılı...</b>

                    <?php  } elseif (isset($_GET['durum']) && $_GET['durum'] == 'no') { ?>
                      <b style="color:red;"> İşlem Başarısız...</b>

                    <?php } ?>
                  </small></h2><br>
              </div>
              <div align="right" class="col-md-6">
                <a href="diziekle.php"><button class="btn btn-danger"><i class="fa fa-plus" aria-hidden="true"></i>Dizi Ekle</button></a>
              </div>


              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th width="80" class="column-title text-center">#</th> 
                      <th class="column-title text-center">Dizi Adı</th>
                      <th class="column-title text-center">Bölüm Sayısı</th>
                      <th width="80" class="column-title"></th>
                      <th width="80" class="column-title"></th>

                    </tr>
                  </thead>
                  <tbody>

                    <?php


                    while ($icerikcek = $iceriksor->fetch(PDO::FETCH_ASSOC)) {

                    ?>
                      <tr>
                        <td class="text-center"><a href="video.php?ID=<?php echo $icerikcek['ID']; ?>"><i class="fa fa-bars"></i></button></a> </td>
                        <td class="text-center"><a href="video.php?ID=<?php echo $icerikcek['ID']; ?>"><?php echo $icerikcek['VIDEO_NAME']; ?></td><?php ?>
                        <td class="text-center"><?php echo $icerikcek['VIDEO_ID']; ?></td>
                        <td class="text-center"></td>
                        <td class="text-center"><a href="diziduzenle.php?ID=<?php echo $icerikcek['VIDEOTYPE_ID']; ?>"><button style="width:80px;" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Düzenle</button></a> </td>

                      <?php }
                      ?>





              </div>

            </div>
          </div>
        </div>
      </div>















      <?php include 'footer.php'; ?>
      <!-- /page content -->
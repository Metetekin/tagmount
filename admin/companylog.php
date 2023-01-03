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
  $iceriksor = $db->prepare("SELECT v.ID ,v.VIDEOTYPE_ID VIDEOTYPE_ID , v.VIDEO_NAME 
  from video v left join video_type vt on vt.ID=v.VIDEOTYPE_ID
  left join users u on u.ID=vt.USER_ID WHERE v.ACTIVE=1  and u.COMPANY_ID='{$company}' GROUP BY v.VIDEO_NAME ");
  $iceriksor->execute(array(
    'ID' => $_GET['ID']
  ));
  $say = $iceriksor->rowCount();
}


?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
      </div>

      <div class="title_right">
        
      </div>
    </div>


    <div class="clearfix"></div>



    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <div align="left" class="col-md-6">
                <h2>Pointer Log<small>
                    <?php
                    echo $say . "Kayıt Listelendi.";
                    if (isset($_GET['durum']) && $_GET['durum'] == 'ok') { ?>

                      <b style="color:green;"> İşlem Başarılı...</b>

                    <?php  } elseif (isset($_GET['durum']) && $_GET['durum'] == 'no') { ?>
                      <b style="color:red;"> İşlem Başarısız...</b>

                    <?php } ?>
                  </small></h2><br>
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
                     

                    </tr>
                  </thead>
                  <tbody>

                    <?php


                    while ($icerikcek = $iceriksor->fetch(PDO::FETCH_ASSOC)) {

                    ?>
                      <tr>
                        <td class="text-center"><a href="shows.php?ID=<?php echo $icerikcek['VIDEOTYPE_ID']; ?>"><i class="fa fa-bars"></i></button></a> </td>
                        <td class="text-center"><a href="shows.php?ID=<?php echo $icerikcek['VIDEOTYPE_ID']; ?>"><?php echo $icerikcek['VIDEO_NAME']; ?></td><?php ?>
       
                      <?php }
                      ?>





              </div>

            </div>
          </div>
        </div>
      </div>















      <?php include 'footer.php'; ?>
      <!-- /page content -->
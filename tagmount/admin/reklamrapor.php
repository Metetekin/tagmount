<?php 

include 'header.php'; 
include_once '../vendor/baglan.php';


if(isset($_POST['arama'])) {
    $aranan=$_POST['aranan'];

    $iceriksor=$db->prepare("select * from deneme d left join bolum b on d.BOLUM_ID=b.bolum_id  where d.BOLUM_ID LIKE '%$aranan%' order by
        b.bolum_id");
    $iceriksor->execute();
    $say=$iceriksor->rowCount();

} else {
    $iceriksor=$db->prepare("SELECT V.VIDEO_KEY,V.EPISODE,P.INFO_TEXT,P.VIDEO_ID,SC.SHOWS,SC.CLICKS,SC.CAMPAING_NAME,(SC.CPM_PRICE*SC.SHOWS) GELIR FROM pointer P 
    left join video V on P.VIDEO_ID=V.ID 
    LEFT JOIN video_type VT ON VT.ID=V.VIDEOTYPE_ID
    LEFT JOIN showsclicks SC on P.ID=SC.POINTER_ID
    WHERE  P.ACTIVE=1");
    $iceriksor->execute(array(
      'ID' => $_GET['ID']
    ));
    $say=$iceriksor->rowCount();
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
            

            <div class="clearfix"></div>

            <input type="hidden" name="id" value="<?php if(isset($_GET["id"])) {echo $_GET["id"];} ?>">

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <div align="left" class="col-md-6">
                    <h2>Log Kayıtları<small>
                    <?php
                    echo $say."Kayıt Listelendi."; 
                if (isset($_GET['durum']) && $_GET['durum']=='ok' ){?>

                  <b style="color:green;" > İşlem Başarılı...</b>

                  <?php  } elseif (isset($_GET['durum']) && $_GET['durum']=='no') {?>
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

                                  <th width="125" class="column-title">Kampanya Adı</th>
                                  <th class="column-title text-center">Gösterim</th>
                                  <th class="column-title text-center">Tıklanma</th>
                                  <th class="column-title text-center">Gelir</th>
                        
                                  
                                  
                  </tr>
                  </thead>
                  <tbody>

                  <?php


                  while($icerikcek=$iceriksor->fetch(PDO::FETCH_ASSOC)){

                    ?>
                      <tr>                     
                      <td class="text-center"><?php echo $icerikcek['CAMPAING_NAME']; ?></td>                       
                      <td class="text-center"><?php echo $icerikcek['SHOWS']; ?></td>
                      <td class="text-center"><?php echo $icerikcek['CLICKS']; ?>
                      <td class="text-center"><?php echo $icerikcek['GELIR']; ?></td>
                      <?php

                  

                      
                 
                    ?></td>

                
                    <?php }
                    ?>

                

                                  
                
                    </div>
                
                  </div>
                </div>
              </div>
            </div>
            


            

            

            
          

          
    

        

        <?php include 'footer.php'; ?>
        <!-- /page content -->

        
        


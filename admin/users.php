<?php 

include 'header.php'; 
include_once '../vendor/baglan.php';


if(isset($_POST['arama'])) {
    $aranan=$_POST['aranan'];

    $iceriksor=$db->prepare("select * from bolum where video LIKE '%$aranan%' order by
        id ASC limit 25");
    $iceriksor->execute();
    $say=$iceriksor->rowCount();

} else {
    $iceriksor=$db->prepare("select * from video order by video_dizi DESC limit 25");
    $iceriksor->execute();
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
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                 
                </div>
              </div>
            </div>
            

            
            <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <div align="left" class="col-md-6">
                <h2>Kullanıcı Ekle<small>
                    
                  </small></h2><br>
              </div>
             
              <div align="right" class="col-md-6">
                <a href="users.php"><button class="btn btn-danger"><i class="fa fa-list" aria-hidden="true"></i> Kullanıcı Listesi</button></a>
              </div>

              <div class="clearfix"></div>
            </div>

            
            
<form action="db/islem.php" method="POST" autocomplete="false" enctype="multipart/form-data" id="demo-form2"class="form-horizontal form-label-left" novalidate>
</p>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Adı Soyadı <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="name" class="form-control col-md-7 col-xs-12"  data-validate-length-range="6" data-validate-words="2" name="usersName" placeholder="" required="required" type="text">
  </div>
</div>

<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="email" id="email" name="usersEmail" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"> Telefon <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="number" id="number" name="usersNumber" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Websitesi<span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="url" id="website" name="usersUrl" required="required" placeholder="www.website.com" class="form-control col-md-7 col-xs-12">
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Şirket Adı <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="occupation" type="text" name="usersCompany" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12">
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kullanıcı Adı <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="usersUid" placeholder="" required="required" type="text">
  </div>
</div>
<div class="item form-group">
  <label for="password" class="control-label col-md-3">Parola<span class="required">*</span> </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="password" type="password" name="usersPwd" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
  </div>
</div>
<div class="ln_solid"></div>
<div class="form-group">

  <div class="col-md-3 col-md-offset-8">
    <button id="send" type="submit" name="usersave" class="btn btn-success">Kaydet</button>
  
  </div>
</div>
</form>
            


            

            

            
          

          
    

        

        <?php include 'footer.php'; ?>
        <!-- /page content -->

        
        


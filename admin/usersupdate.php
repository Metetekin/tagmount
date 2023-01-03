<?php

include 'header.php';
include_once '../vendor/baglan.php';


$iceriksor = $db->prepare("SELECT * FROM company c left join users u on c.ID=u.COMPANY_ID where u.COMPANY_ID=:ID");
$iceriksor->execute(array(
  'ID' => $_GET['ID']

));
$icerikcek = $iceriksor->fetch(PDO::FETCH_ASSOC);


?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
      </div>

     


    <div class="clearfix"></div>



    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kullanıcı Düzenle<small>
            

            </h2>
            <ul class="nav navbar-right panel_toolbox">

            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="db/islem.php" autocomplete="off" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              <input type="hidden" name="id" value="<?php if (isset($_GET["ID"])) {
                                                      echo $_GET["ID"];
                                                    } ?>">
              <div class="form-group">
                <label class="control-label col-md-3  col-sm-3 col-xs-12" for="first-name">Şirket adı<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" required="required" name="company_name" value="<?php echo $icerikcek['NAME']; ?>" class="form-control col-md-7 col-xs-12" >
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3  col-sm-3 col-xs-12" for="first-name">Adı Soyadı<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" required="required" name="name_surname" value="<?php echo $icerikcek['NAME_SURNAME']; ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3  col-sm-3 col-xs-12" for="first-name">Mail Adres<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" required="required" name="user_email" value="<?php echo $icerikcek['USER_EMAIL']; ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3  col-sm-3 col-xs-12" for="first-name">Telefon No<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" required="required" name="phone_number" value="<?php echo $icerikcek['PHONE_NUMBER']; ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div aling="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="usersupdate" class="btn btn-primary">Güncelle</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- /page content -->




<?php include 'footer.php'; ?>
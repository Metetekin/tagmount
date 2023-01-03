<?php

include 'header.php';
include_once '../vendor/baglan.php';


$iceriksor = $db->prepare("SELECT * FROM video where ID=:ID");
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
        <h3>Genel Ayarlar</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Anahtar Kelimeniz...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Ara!</button>
            </span>
          </div>
        </div>
      </div>
    </div>


    <div class="clearfix"></div>



    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Sosyal Medya Ayarları <small>
                <?php
                if (isset($_GET['durum']) && $_GET['durum'] == 'ok') { ?>

                  <b style="color:green;"> İşlem Başarılı...</b>

                <?php  } elseif (isset($_GET['durum']) && $_GET['durum'] == 'no') { ?>
                  <b style="color:red;"> İşlem Başarısız...</b>

                <?php } ?></small></h2>

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
                <label class="control-label col-md-3  col-sm-3 col-xs-12" for="first-name">Bölüm Kodu<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" required="required" name="bolum_id" value="<?php echo $icerikcek['VIDEO_KEY']; ?>" class="form-control col-md-7 col-xs-12" disabled>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3  col-sm-3 col-xs-12" for="first-name">Bölüm Adı<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" required="required" name="bolum_adi" value="<?php echo $icerikcek['EPISODE']; ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3  col-sm-3 col-xs-12" for="first-name">Bölüm Link<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" required="required" name="bolum_link" value="<?php echo $icerikcek['VIDEO_LINK']; ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div aling="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="bolumguncelle" class="btn btn-primary">Güncelle</button>
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
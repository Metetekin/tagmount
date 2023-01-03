<?php

include 'header.php';
include_once '../vendor/baglan.php';

?>

<head>
  <script src="//cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
</head>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Dizi Ekle</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <form action="" method="POST">
            <div class="input-group">
              <input type="text" class="form-control" name="aranan" placeholder="Anahtar Kelimeniz...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit" name="arama">Ara!</button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>


    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Dizi Ekle <small>
              </small></h2>

            </h2>
            <ul class="nav navbar-right panel_toolbox">

            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="db/islem.php" method="POST" autocomplete="off" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


              <div class="form-group">
                <label class="control-label col-md-2  col-sm-2 col-xs-12" for="first-name">Dizi Adı<span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="first-name" required="required" name="video_dizi" placeholder="Dizi Adını giriniz..." class="form-control col-md-7 col-xs-12">
                </div>
              </div>
          </div>






          <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
            <input type="submit" name="dizikaydet" value="Kaydet" class="btn btn-primary">
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
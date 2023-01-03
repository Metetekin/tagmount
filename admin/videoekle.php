<?php

include 'header.php';
include_once '../vendor/baglan.php';

$kullanici = $_SESSION["userkullanici"];

$company_id= $db->query("SELECT COMPANY_ID FROM users 
where USER_CODE='{$kullanici}'")->fetchAll(PDO::FETCH_ASSOC);
$company;
foreach ($company_id as $result) {
    foreach ($result as $key => $value) {
        $company=$value ;
    }
}
$diziler = $db->query("SELECT v.ID ID,v.VIDEO_KEY VIDEO_KEY , v.VIDEO_NAME VIDEO_NAME,v.EPISODE EPISODE, v.VIDEO_LINK VIDEO_LINK from video v left join video_type vt on vt.ID=v.VIDEOTYPE_ID
left join users u on u.ID=vt.USER_ID WHERE v.ACTIVE=1 and   u.COMPANY_ID='{$company}' GROUP BY v.VIDEO_NAME")->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
  <script src="//cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
</head>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
     
      </div>

      <div class="title_right">
       
    </div>


    <div class="clearfix"></div>



    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Bölüm Ekle <small>
              </small></h2>

            </h2>
            <ul class="nav navbar-right panel_toolbox">

            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="db/islem.php" autocomplete="off" method="POST"  id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


              <div class="form-group">
                <label class="control-label col-md-2  col-sm-2 col-xs-12" for="first-name">Bölüm Kodu<span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-10">
                  <input type="text" id="bolum_guid"  name="bolum_id" required="required" placeholder="Bölüm Kodunu giriniz..." class="form-control" readonly>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-1">
                  <button type="button" onclick="generateGUID();" class="btn btn-primary">Kod Oluştur</button>
                </div>
              </div>
                
   <div class="form-group">
                        <label class="control-label col-md-2  col-sm-2 col-xs-12">Dizi Seçin</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select name="bolum_dizi" class="form-control">
                          <option value="">Dizi Seçin </option>
                    <?php foreach($diziler as $dizi): ?>
                        <option  value="<?=$dizi['VIDEO_NAME']?>"><?=$dizi['VIDEO_NAME']?></option>
                        <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
              <div class="form-group">
                <label class="control-label col-md-2  col-sm-2 col-xs-12" for="first-name">Bölüm Adı<span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="first-name" required="required" name="bolum_adi" placeholder="Bölüm Adını giriniz..." class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
              <label class="control-label col-md-2  col-sm-2 col-xs-12" for="first-name">Bölüm Linki<span class="required">*</span></label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="first-name" required="required" name="bolum_link" placeholder="Bölüm Linkini giriniz..." class="form-control col-md-7 col-xs-12">
              </div>

           





              <!-- <div class="form-group">
                             <label class="control-label col-md-2  col-sm-2 col-xs-12" for="first-name">İçerik Durum <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select id="heard" class="form-control" name="icerik_durum" required>
                                    <option value="1">Aktif</option>
                                    <option valur="0">Pasif</option>
                                </select>
                              </div>
                            </div> -->


           
          </div>


          



          <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
            <input type="submit" name="videokaydet" value="Kaydet" class="btn btn-primary">
          </div>
          </form>
        </div>

      </div>
   
  </div>
</div>
</div>
</div>
<!-- /page content -->

<script>
    function generateGUID() {
    var d = new Date().getTime();
    var uuid = 'yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
    var r = (d + Math.random()*16)%16 | 0;
    d = Math.floor(d/16);
    return (c=='x' ? r : (r&0x3|0x8)).toString(16);
});
 
$('#bolum_guid').val(uuid);

 
}; 
</script>




<?php include 'footer.php'; ?>
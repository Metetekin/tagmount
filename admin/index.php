<?php

include 'header.php';
include_once '../vendor/baglan.php';

$kullanici = $_SESSION["userkullanici"];

$company_id = $db->query("SELECT COMPANY_ID FROM users 
    where USER_CODE='{$kullanici}'")->fetchAll(PDO::FETCH_ASSOC);
$company;
foreach ($company_id as $result) {
  foreach ($result as $key => $value) {
    $company = $value;
  }
}

$diziSayi = $db->query("SELECT COUNT(ID) VIDEOTYPE_ID FROM video_type WHERE ACTIVE=1 AND COMPANY_ID=$company")->fetch();
$bolumSayi = $db->query("SELECT COUNT(v.ID) VIDEO_ID FROM video v left join video_type vt on vt.ID=v.VIDEOTYPE_ID WHERE  V.ACTIVE=1 AND VT.COMPANY_ID=$company")->fetch();
$pointerSayi = $db->query("SELECT COUNT(P.ID) POINTER_ID FROM pointer P left join video V on P.VIDEO_ID=V.ID LEFT JOIN video_type VT ON VT.ID=V.VIDEOTYPE_ID WHERE  P.ACTIVE=1 AND VT.COMPANY_ID=$company")->fetch();




?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="row tile_count">
    <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Toplam Dizi</span>
      <div class="count"><?php echo $diziSayi['VIDEOTYPE_ID']; ?></div>

    </div>
    <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-clock-o"></i> Toplam Bölüm</span>
      <div class="count"><?php echo $bolumSayi['VIDEO_ID']; ?></div>

    </div>
    <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Toplam Reklam</span>
      <div class="count"><?php echo $pointerSayi['POINTER_ID']; ?></div>

    </div>

  </div>

           <div class="col-md-12 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Yapılması Gerekenler <small></small></h2>
                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <ul class="list-unstyled timeline">
                    <li>
                      <div class="block">
                        <div class="tags">
                          <class="tag">
                            <span>Dizi Ekle</span>
                          </a>
                        </div>
                        <div class="block_content">
                          <h2 class="title">
                                          <a>Dizi Eklemek için Yapılması Gerekenler?</a>
                                      </h2>
                          <div class="byline">
                            
                          </div>
                          <p class="excerpt">Dizi eklemek için sol tarafta bulunan Video Ayarları kısmından "Dizi Ekle" kısmına gidilir. "Yeni Ekle" butonuna tıklanarak, dizinin adı girilir ve "Kaydet" butonuna tıklanarak dizi kaydetme işlemi tamamlanmış olur.
                          </p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="block">
                        <div class="tags">
                          <class="tag">
                            <span>Bölüm Ekle</span>
                          </a>
                        </div>
                        <div class="block_content">
                          <h2 class="title">
                                          <a>Bölüm Eklenmesi için Yapılması Gerekenler?</a>
                                      </h2>
                          <div class="byline">
                            
                          </div>
                          <p class="excerpt">Dizi Ekleme işlemi tamamlandıktan sonra veya daha önce eklenen bir diziye bölüm eklemek için sol tarafta bulunan Video Ayarları kısmından "Diziler" sayfasına gidilir, bölümün ekleneceği dizi seçilerek "Bölüm Ekle" butonuna tıklanır.
                          </p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="block">
                        <div class="tags">
                          <class="tag">
                            <span>Entegre</span>
                          </a>
                        </div>
                        <div class="block_content">
                          <h2 class="title">
                                          <a>Eklenen Bölüm Nasıl Entegre Edilir?</a>
                                      </h2>
                          <div class="byline">
                         
                          </div>
                          <p class="excerpt">Tarafınıza verilen script ve kod bloğu Pointer'ın gözükmesi gereken sayfaya eklenir ve  Bölüm Ekle kısmında oluşturulan "Bölüm Kodunu" "videoKey" kısmına girmeniz gerekmektedir. Video html etiketinin id'sini "videoJs" kısmına girmeniz gerekmektedir.Video html etiketinin dışında bulunan div etiketi id'sini  ise "#videodiv" kısmına girmeniz gerekmektedir. 
                          </p>
                        </div>
                      </div>
                    </li>
                  </ul>

                </div>
                <div class="col-md-4 col-sm-4 col-xs-6"></div>
              </div>
              
            </div>
           
</div>

        <div class="clearfix"></div>

        <div class="clearfix"></div>

        

        















            <?php include 'footer.php'; ?>
            
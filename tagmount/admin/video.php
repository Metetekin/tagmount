<?php

include 'header.php';
include_once '../vendor/baglan.php';


if (isset($_POST['arama'])) {
    $aranan = $_POST['aranan'];

    $iceriksor = $db->prepare("SELECT * FROM users u
    left join video_type vt on u.ID=vt.USER_ID
    left join video v on vt.ID=V.VIDEOTYPE_ID
    where v.VIDEO_NAME LIKE '%$aranan%' order by
        V.ID ASC limit 25");
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
    $iceriksor = $db->prepare("SELECT v.ID ID,v.VIDEO_KEY VIDEO_KEY , v.VIDEO_NAME VIDEO_NAME,v.EPISODE EPISODE, v.VIDEO_LINK VIDEO_LINK from video v left join video_type vt on vt.ID=v.VIDEOTYPE_ID
    left join users u on u.ID=vt.USER_ID WHERE v.ACTIVE=1 and   u.COMPANY_ID='{$company}'   AND vt.ID=:ID");
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

            
        </div>


        <div class="clearfix"></div>

        <input type="hidden" name="id" value="<?php if (isset($_GET["id"])) {
                                                    echo $_GET["id"];
                                                } ?>">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div align="left" class="col-md-6">
                                <h2>Bölüm<small>
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
                                <a href="videoekle.php"><button class="btn btn-danger"><i class="fa fa-plus" aria-hidden="true"></i>Bölüm Ekle</button></a>
                            </div>


                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">

                                            <th width="125" class="column-title">Bölüm Kodu</th>
                                            <th class="column-title text-center">Bölüm Adı</th>
                                            <th class="column-title text-center">Bölüm Linki</th>
                                            <th width="80" class="column-title"></th>
                                            <th width="80" class="column-title"></th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php


                                        while ($icerikcek = $iceriksor->fetch(PDO::FETCH_ASSOC)) {

                                        ?>
                                            <tr>


                                                <td class="text-center"><?php echo $icerikcek['VIDEO_KEY']; ?></td>
                                                <td class="text-center"><?php echo $icerikcek['EPISODE']; ?>
                                                <td class="text-center"><?php echo $icerikcek['VIDEO_LINK']; ?></td><?php
                                                ?></td>

                                                <td class="text-center"><a href="videoduzenle.php?ID=<?php echo $icerikcek['ID']; ?>"><button style="width:80px;" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Düzenle</button></a> </td>
                                                <td class="text-center"><a href="db/islem.php?iceriksil=ok&ID=<?php echo $icerikcek['ID']; ?>"><button style="width:80px;" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Sil</button></a>
                                            </tr>


                                        <?php }
                                        ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <?php include 'footer.php'; ?>
            <!-- /page content -->
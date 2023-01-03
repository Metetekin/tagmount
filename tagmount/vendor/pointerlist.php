<div class="div-position-1">
    <span><b>Pointer List</b></span>
</div>
<hr class="hr-1">
<div class="d-flex justify-content-between flex-div-3" style="height: 240px; overflow: auto">
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Campaign Name </th>
                <th scope="col"></th>
                <th scope="col">Time Rate</th>
                <th scope="col"> Links</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <?php

        include_once("baglan.php");
        if (isset($_GET["guid"])) {
            $id = $_GET["guid"];
            $query = $db->query("SELECT P.ID POINTER_ID , P.INFO_TEXT INFO, P.POINTER_LIST POINTERLIST,P.LINK LINK ,P.VIDEO_ID VIDEO_ID , V.VIDEO_KEY VIDEOKEY ,SC.CAMPAING_NAME CAMPAINGNAME FROM POINTER P  LEFT JOIN VIDEO V  ON V.ID=P.VIDEO_ID LEFT JOIN showsclicks SC ON SC.POINTER_ID=P.ID WHERE P.ACTIVE=1 AND P.VIDEO_ID ='{$id}'"); //Tüm verileri getir
            //$query->execute();
            $query->execute(array(":id" => $id));
            $liste = $query->fetchAll(PDO::FETCH_OBJ);
        }
        foreach ($liste as $list) { ?>
            <tbody>

                <tr>
                    <td><?= $list->CAMPAINGNAME ?></td>
                    <td><img src="assets/img/right-arrow.png" class="img-style-1" alt=""></td>
                    <td><?php $jsonstr = $list->POINTERLIST;
                        $json = json_decode($jsonstr, true);
                        if ($json != null) {
                            $len = count($json);
                            if ($len > 0) {
                                $bas = number_format($json[0][0]["time"], 3, '.', '');
                                $lendrw = count($json[$len-1]);
                                $bit = number_format($json[$len-1][$lendrw - 1]["time"], 3, '.', '');
                                echo $bas . "-" . $bit;
                            }
                        }
                        ?></td>
                    <td><?= $list->LINK ?></td>
                    <td rowspan="4">
                        <div class="btn-group">
                            <img src="assets/img/forward-arrow.png" onclick="onShowPointerList('<?= $list->POINTER_ID ?>')" class="img-style-1" alt="">

                        </div>
                        <img src="assets/img/trash.png" silid="<?= $list->POINTER_ID ?>" class="img-style-1 sil" alt=""> </a>
                    </td>
                    </td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
</div>
<div class="row">
    <hr class="hr">
    <div class="btn ">
        <?php
        if (isset($list->VIDEOKEY)) { ?>
            <input class="button" type="button" onclick="onShowPointer('<?= $list->VIDEOKEY ?>')" value="Show All Pointer" >
            <!-- onclick="addlinkf()"> -->
        <?php } ?>
    </div>
</div>
<script>
    // $(document).ready(function() {
    //     $(".sil").click(function() {
    //         var silinecekid = $(this).attr('silid');
    //         var silinecektablo = $(this).parents('tr');
    //         $.post("sil.php", {
    //             id: silinecekid
    //         }, function(gelencevap) {
    //             if (gelencevap == "sildim") {
    //                 silinecektablo.hide(400);
    //             } else {

    //             }
    //         })
    //     })
    // })

    $(document).on('click', '.sil', function() {
        swal({
                title: "Tagmount",
                text: "Pointerı silmek istediğinize emin misiniz?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var silinecekid = $(this).attr('silid');
                    var silinecektablo = $(this).parents('tr');
                    $.post("sil.php", {
                        id: silinecekid
                    }, function(gelencevap) {
                        if (gelencevap == "sildim") {
                            silinecektablo.hide(400);
                        } else {

                        }
                    })
                    swal("Silme işlemi başarıyla gerçekleşti.", {
                        icon: "success",
                    });
                } else {
                    swal("Silme işlemi iptal edildi.", {
                        icon: "error",
                    });
                }
            });

    });
</script>
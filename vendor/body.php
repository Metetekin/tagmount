<body class="html_class">

        
    <div class="row">
        <div class="col-xs-11 col-md-11 col-lg-11 col-xl-11 "  style="margin-top:10px;margin-bottom:10px;" >
            <img width='108' height='50' style="margin-left:4%;" src="assets/img/logo.png" alt="">
        </div>
        <div class="col-xs-1 col-md-1 col-lg-1 col-xl-1"  style="margin-top:10px;margin-bottom:10px;">
            <div class="dropdown">
                <button class="dropbtn"> <img src="assets/img/outline_menu_open_black_24dp.png" alt=""></button>
                <div class="dropdown-content">
                    <a href="admin/login.php"><img src="assets/img/logout.png" alt="">&nbsp; Admin Panel</a>
                    <a href="logout.php"><img src="assets/img/power.png" alt="">&nbsp;Logout</a>
                </div>
            </div>

        </div>

    </div>

    <section class="container-fluid overflow-hidden fluid-position-1">

        <script type="text/javascript">
            function kayitekle() {

                var deger = $("#kayit").serialize();

                $.ajax({
                    type: "POST",
                    data: deger,
                    url: "veriekle.php",
                    success: function(sonuc) {
                        if ($.trim(sonuc) == "infoRequired") {
                            dangerMode: true,
                            sweetAlert('Tagmount', 'Lütfen Info Text giriniz!', 'warning');
                        }
                        else if ($.trim(sonuc) == "linkRequired") {
                            sweetAlert('Tagmount', 'Lütfen Link giriniz!', 'error');
                        } else if ($.trim(sonuc) == "drawRequired") {
                            sweetAlert('Tagmount', 'Lütfen Çizim yapınız! ', 'error');
                        } else if ($.trim(sonuc) == "sizeRequired") {
                            sweetAlert('Tagmount', 'Lütfen Pointer Size seçiniz! ', 'error');
                        }  else if ($.trim(sonuc) == "tagmountError") {
                            sweetAlert('Tagmount', 'Bilgileri eksiksiz doldurunuz', 'error');
                        } else if ($.trim(sonuc) == "ok") {
                            sweetAlert('Tagmount', 'Pointer Kaydedildi', 'success')
                                .then((value) => {
                                    window.location.href = "home.php";
                                })
                        } else if ($.trim(sonuc) == "bolumRequired") {
                            sweetAlert('Tagmount', 'Lütfen Bölümü Seçiniz.', 'info');
                        } else if ($.trim(sonuc) == "CampaignRequired") {
                            sweetAlert('Tagmount', 'Lütfen Kampanya Adını Giriniz.', 'info');
                        } else if ($.trim(sonuc) == "DailyRequired") {
                            sweetAlert('Tagmount', 'Lütfen Günlük Limiti Giriniz.', 'info');
                        } else if ($.trim(sonuc) == "PriceRequired") {
                            sweetAlert('Tagmount', 'Lütfen Birim Fiyat Giriniz.', 'info');
                        } else if ($.trim(sonuc) == "ThirdRequired") {
                            sweetAlert('Tagmount', 'Lütfen Third Party Pixel Url Giriniz.', 'info');
                        } else if ($.trim(sonuc) == "sizeRequired") {
            sweetAlert('Tagmount', 'Lütfen Pointer Size giriniz.', 'info');
        }
                    }
                });
            }

            function kayitupdate() {

var deger = $("#kayit").serialize();

$.ajax({
    type: "POST",
    data: deger,
    url: "veriupdate.php",
    success: function(sonuc) {
        if ($.trim(sonuc) == "infoRequired") {
            dangerMode: true,
            sweetAlert('Tagmount', 'Lütfen Info Text giriniz!', 'warning');
        }
        else if ($.trim(sonuc) == "linkRequired") {
            sweetAlert('Tagmount', 'Lütfen Link giriniz!', 'error');
        } else if ($.trim(sonuc) == "drawRequired") {
            sweetAlert('Tagmount', 'Lütfen Çizim yapınız! ', 'error');
        } else if ($.trim(sonuc) == "tagmountError") {
            sweetAlert('Tagmount', 'Bilgileri eksiksiz doldurunuz', 'error');
        } else if ($.trim(sonuc) == "ok") {
            sweetAlert('Tagmount', 'Pointer Güncellendi', 'success')
                .then((value) => {
                    window.location.href = "home.php";
                })
        } else if ($.trim(sonuc) == "bolumRequired") {
            sweetAlert('Tagmount', 'Lütfen Bölümü Seçiniz.', 'info');
        }
        
    }
});
}
        </script>
        
        <form action="" id="kayit" method="POST" onsubmit="return false;" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" id="phppointerList" name="phppointerList" value="">

            <?php include 'videoplayer.php' ?>
            <!---video Settings -->
            <hr class="hr">
            <div class="d-flex">
                <?php include 'videosetting.php' ?>
            </div>
            <!---info -->
            <hr class="hr">
            <div style="margin-left:5px; margin-right:0px;">
                <?php include 'info.php' ?>
            </div>
            <!---ad setting -->
            <hr class="hr">
            <div style="margin-left:5px; margin-right:0px;">
                <?php include 'adsettings.php' ?>
            </div>
            <!---pointer Settings -->
            <hr class="hr-3" style="margin-bottom:15px;">
            <?php include 'pointer.php' ?>
            <!---info Card Settings -->
            <hr class="hr-3" style="margin-bottom:15px;">
            <?php include 'infocardsetting.php' ?>
            </div>

            <div class="col-xs-6 col-md-6 col-lg-6 col-xl-6" style="padding-right:50px;">
                <?php include 'movieselection.php' ?>
                <div id="divpointer"> </div>
                <?php //include 'pointerlist.php' 
                ?>
                <div id="infoDivCard" style="padding:20px;">
                    <?php include 'infocard.php' ?>
                </div>

                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <hr class="hr">
                        <div class="btn " id="kayitekleDiv">
                            <input class="button" type="submit" onclick="kayitekle();" value="Save Pointer ">
                            <!-- onclick="addlinkf()"> -->
                        </div>
                        <div class="btn " id="kayitupdateDiv" style="display:none;">
                            <input class="button" type="submit" onclick="kayitupdate();" value="Update Pointer ">
                            <!-- onclick="addlinkf()"> -->
                        </div>
                    </div>
                </div>
                <input type="hidden" id="tagmountId" name="tagmountId" value="">
                <input type="hidden" id="guid" name="guid" value="">
                <input type="hidden" id="videoDrawWidth" name="videoDrawWidth" value="">
                <input type="hidden" id="videoDrawHeight" name="videoDrawHeight" value="">

        </form>
    </section>
    <!-- <div id="pointerInfoCardParentDiv" style="display:table;">
        <div id="pointer" style="display: none; position:absolute;  border-radius:300vw; background:red; height:20; width:+20; border:1px solid; border-color:blue; z-index:10" ></div>
        <div id="infoCardDiv"></div>
    </div> -->
    <script src="assets/bootstrap/js/bootstrap.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-youtube/2.6.1/Youtube.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-markers/0.7.0/videojs-markers.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
    <script src="assets/VIDEO-JS/canvas.js"></script>
    <script src="assets/VIDEO-JS/pointer.js"></script>
    <script src="assets/VIDEO-JS/videoPlayer.js"></script>
    <script src="assets/VIDEO-JS/draw.js"></script>
    <script src="assets/VIDEO-JS/pointerPlay.js"></script>
    <script src="assets/VIDEO-JS/onShowPointerList.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- <script src="assets/VIDEO-JS/videoTimer.js"></script> -->
    <script src="assets/VIDEO-JS/initData.js"></script>
    <script src="assets/UI-JS/videoSpeed.js"></script>
    <script src="assets/UI-JS/guid.js"></script>
    <script src="assets/UI-JS/info.js"></script>
    <script src="assets/UI-JS/adsettings.js"></script>
    <script src="assets/UI-JS/pointerSettings.js"></script>
    <script src="assets/UI-JS/infoCardSettings.js"></script>
    <script src="assets/bootstrap/js/movieselect.js"></script>
    <script src="assets/UI-JS/drawingMode.js"></script>

    <script>
        $(document).ready(function() {

            videoWidthHeight();
            canvas.init('#videoDiv', '#my_video');
            pointer.init('#my_video');
            // videoTimer.init("my_video");
            videoPlayer.init('my_video');
            draw.init();
            //getdata.init("8b87a7f4-6e87-4d74-b6ac-669c09660a6c");
            pointerPlay.init('#my_video');
            guid();


        });
        $(window).resize(function(event) {
            videoWidthHeight();
            canvas.canvasResize('#my_video');
            timeSliderSize();
        });
        (function() {
            window.hola_player();
        })();
        
    </script>
<!-- 
 <script>
		$("#AddImageLogo1").change(function(){ //dosya seçildiğinde
			var file_button = $(this); //butonu al
			var my_files = document.getElementById("AddImageLogo1"); //file_upload id li elemanı al, file input
			if (my_files.files && my_files.files[0] && my_files.files[0].type.match('image.*')){ //dosya var ve resim türünde ise
				var reader = new FileReader(); //FileReader class kur
				reader.onload = function() { //veriyi yükle
					var file_data = reader.result; //dosya verisi
					$.ajax({ //dosya data sını ajax.php ye postala
						url: "libraries/upload.php", 
						type: "POST",             
						data: {"veri":file_data},
						dataType: "json",
						success: function(data) {
							if (data == "success"){
								alert("Dosya başarıyla yüklendi");
                                
							}else{
								alert(data); 
                                deleteLogo();
                                //hata mesajini goster
							}
						}
					});
				}
				reader.readAsDataURL(my_files.files[0]); //oku
			}
		});
	</script>  -->





</body>

</html>
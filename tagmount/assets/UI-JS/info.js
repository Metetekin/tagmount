
//Slider hide Show
var infoSettingsButtonControl = false;
$('#infoSettingsCheckbox').click(function () {
    if (infoSettingsButtonControl == true) {
        $('#infoSettingsDiv').slideUp("fast");
        infoSettingsButtonControl = false;
    }
    else {
        $('#infoSettingsDiv').slideDown("fast");
        infoSettingsButtonControl = true;
    }
});
/* info card sol image ekle ve değiştir*/
$("#infoImage").click(function () {
    if (($('#AddImageInfo').val() == "")) {
        $('#AddImageInfo').trigger('click');
        $("#AddImageInfo").on('change', function () {
            if ((!($('#AddImageInfo').val() == ""))) {
                var addimage = $('#AddImageInfo').val();
                //Do calculation and change value of other span2,span3 here
                $('#infoImage').text(addimage);
            }
        });
    } else {
        $('#AddImageInfo').trigger('click');
        $('#AddImageInfo').val() == "";
        if (($('#AddImageInfo').val() == "")) {
            $('#infoImage').text("Add Object");
        } else {
            $('#infoImage').text("Add Object");
        }
    }
});
/* info card üst logo image ekle ve değiştir*/
$("#logoImage").click(function () {
    if (($('#AddImageLogo1').val() == "")) {
        $('#AddImageLogo1').trigger('click');
        $("#AddImageLogo1").on('change', function () {
            if ((!($('#AddImageLogo1').val() == ""))) {
                var addimage = $('#AddImageLogo1').val();
                //Do calculation and change value of other span2,span3 here
                $('#logoImage').text(addimage);
            }
        });
    } else {
        $('#AddImageLogo1').trigger('click');
        $('#AddImageLogo1').val() == "";
        if (($('#AddImageLogo1').val() == "")) {
            $('#logoImage').text("Add Logo");
        } else {
            $('#logoImage').text("Add Logo");
        }
    }
});
/* info card sol image sil*/


/* info card üst logo image sil*/
$("#logoImageDel").click(function () {
    if (!($('#AddImageLogo1').val() == "")) {
        deleteLogo();

    }
});
function deleteLogo(){
    $('#AddImageLogo1').val() == "";
        $('#logoImage').text("Add Logo");
        $("#logo2").attr("src", "assets/img/noimage86x25.jpeg");
}

// infoCard Div

// $("#text2").change(function () {

//     infoCardHtml = $(".infoCardPosition1").html();
//     $("#infocardinnerhtml").val(infoCardHtml);
//     initDrawingHtml();

// });

$(".infoCartP").on('DOMSubtreeModified',function(){
    infocardChanged();
});


//info card text change  
$("#info").change(function () {
    var text = $("#info").val();
    $(".infoCartP").text(text);
    //infocardChanged();
});
//info card image chane

$("#AddImageLogo1").change(function () {
    var oFReader = new FileReader();
    oFReader.readAsDataURL($('#AddImageLogo1').get(0).files[0]);
    oFReader.onload = function (oFREvent) {
       
					var file_data = oFREvent.target.result; //dosya verisi
					$.ajax({ //dosya data sını ajax.php ye postala
						url: "libraries/upload.php", 
						type: "POST",             
						data: {"veri":file_data},
						dataType: "json",
						success: function(data) {
							if (data == "success"){
                                $("#AddImageLogo").val(file_data);
                                 $(".logo2").attr("src",file_data);
                                 sweetAlert('Tagmount', 'Dosya başarıyla yüklendi.', 'success');
                                
                                
							}else{
								sweetAlert('Tagmount', data, 'error'); 
                                deleteLogo();
                                //hata mesajini goster
							}
						}
					});
    };
});

$("#Links").change(function () {
    pointerOpenURL = $("#Links").val();

});
$("#delete").click(function () {
    clearDraw();
});
function infocardChanged(){
    infoCardHtml = $(".infoCardPosition1").html();   
    $("#infocardinnerhtml").val(infoCardHtml);
    initDrawingHtml();
}


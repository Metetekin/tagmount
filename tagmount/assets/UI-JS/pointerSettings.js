//Slider hide Show
var pointerSettingsButtonControl = false;
$('#pointerSettingsCheckbox').click(function () {
  if (pointerSettingsButtonControl == true) {
    $('#pointerSettingsDiv').slideUp("fast");
    pointerSettingsButtonControl = false;
  }
  else {
    $('#pointerSettingsDiv').slideDown("fast");
    pointerSettingsButtonControl = true;
  }
});


/* Pointer Logo  image ekle ve değiştir*/
$("#pointerIconImage").click(function () {
  if (($('#addPointerIconImage').val() == "")) {
    $('#addPointerIconImage').trigger('click');
    $("#addPointerIconImage").on('change', function () {
      if ((!($('#addPointerIconImage').val() == ""))) {
        var addimage = $('#addPointerIconImage').val();
        //Do calculation and change value of other span2,span3 here
        $('#pointerIconImage').text(addimage);
      }
    });
  } else {
    $('#addPointerIconImage').trigger('click');
    $('#addPointerIconImage').val() == "";
    if (($('#addPointerIconImage').val() == "")) {
      $('#pointerIconImage').text("Add Icon Image");
    } else {
      $('#pointerIconImage').text("Add Icon Image");
    }
  }
});
/* Pointer Logo  image sil*/
function detData() {
  if (!($('#addPointerIconImage').val() == "")) {
    pointerHtml = "";
    $('#pointerIconImage').val("");
    $('#pointerIconImage').text("Add Icon Image");
    $("#pointerIcon").attr("style", "display:none;");
    $("#fillAndColor").attr("style", "display:inline !important; position:absolute; background:" + pointerBgColor + "; height:" + pointerSize + "px; width:" + pointerSize + "px;  border-radius:300vw;  border:1px solid; border-color:" + pointerBrColor + "");
    $("#addPointerIconImage").val();
    initDrawingHtml();
  }
  else {
  }
}
$("#imageDiv").click(function () {
  detData();
});

/* dosya yolu ile pointer logo image ekleme*/
$("#addPointerIconImage").change(function () {

  var oFReader = new FileReader();
  oFReader.readAsDataURL($('#addPointerIconImage').get(0).files[0]);
  oFReader.onload = function (oFREvent) {
    $("#pointerIcon").attr("src", oFREvent.target.result);
    $("#imageIconData").val(oFREvent.target.result);
    var divPosition = Number(pointerSize) + Number(40);
    $(".div-position-2").css("height", divPosition);
    $(".div-position-2").css("width", divPosition);
    $("#pointerIcon").attr("style", "width:" + pointerSize + "px; height:" + pointerSize + "px; display:inline !important; border-radius: 60%;");
    $("#fillAndColor").attr("style", "display:none;");
    pointerHtml = $(".div-position-2").html();
    $("#imageinnerhtml").val(pointerHtml);
    initDrawingHtml();
  };

});

/* pointerSize */
$("input[type='radio'][name='pointerSize']").click(function () {
  pointerSize = this.value;
  var divPosition = Number(pointerSize) + Number(40);
  if (($(" fillAndColor ").css("display") == "none")) {
    $("#pointerIcon").attr("style", "width:" + pointerSize + "px; height:" + pointerSize + "px; border-radius: 60%;");
  } else {
    $(".img-box-1").width(pointerSize);
    $(".img-box-1").height(pointerSize);
    $(".div-position-2").css("height", divPosition);
    $(".div-position-2").css("width", divPosition);
  }
  pointerHtml = $(".div-position-2").html();
  $("#imageinnerhtml").val(pointerHtml);
  initDrawingHtml();
});
/*pointerinnerhtml */


/*fill change */
var pointerBgColor = "red";
var pointerBrColor = "blue";
var pointerSize = 60;
$("#fillR").change(function () {
  detData();
  var fillR = $('#fillR').val();
  var fillG = $('#fillG').val();
  var fillB = $('#fillB').val();
  var fillRGB = ('rgb(' + fillR + ',' + fillG + ',' + fillB + ')')
  $(".span-R").css("background-color", "rgb(" + fillR + "," + fillG + "," + fillB + ")");
  $(".span-G").css("background-color", "rgb(" + fillR + "," + fillG + "," + fillB + ")");
  $(".span-B").css("background-color", "rgb(" + fillR + "," + fillG + "," + fillB + ")");
  pointerBgColor = "rgb(" + fillR + "," + fillG + "," + fillB + ")";
  $("#fillColor").val(fillRGB);
  $("#pointerIcon").attr("style", "display:none;");
  $("#fillAndColor").attr("style", "display:inline !important; position:absolute; background:" + pointerBgColor + "; height:" + pointerSize + "px; width:" + pointerSize + "px;  border-radius:300vw;  border:1px solid; border-color:" + pointerBrColor + "");

  initDrawingHtml();
});

$("#fillG").change(function () {
  detData();
  var fillR = $('#fillR').val();
  var fillG = $('#fillG').val();
  var fillB = $('#fillB').val();
  var fillRGB = ('rgb(' + fillR + ',' + fillG + ',' + fillB + ')')
  $(".span-R").css("background-color", "rgb(" + fillR + "," + fillG + "," + fillB + ")");
  $(".span-G").css("background-color", "rgb(" + fillR + "," + fillG + "," + fillB + ")");
  $(".span-B").css("background-color", "rgb(" + fillR + "," + fillG + "," + fillB + ")");
  pointerBgColor = "rgb(" + fillR + "," + fillG + "," + fillB + ")";
  $("#fillColor").val(fillRGB);
  $("#pointerIcon").attr("style", "display:none;");
  $("#fillAndColor").attr("style", "display:inline !important; position:absolute; background:" + pointerBgColor + "; height:" + pointerSize + "px; width:" + pointerSize + "px;  border-radius:300vw;  border:1px solid; border-color:" + pointerBrColor + "");

  initDrawingHtml();
});
$("#fillB").change(function () {
  detData();
  var fillR = $('#fillR').val();
  var fillG = $('#fillG').val();
  var fillB = $('#fillB').val();
  var fillRGB = ('rgb(' + fillR + ',' + fillG + ',' + fillB + ')')
  $(".span-R").css("background-color", "rgb(" + fillR + "," + fillG + "," + fillB + ")");
  $(".span-G").css("background-color", "rgb(" + fillR + "," + fillG + "," + fillB + ")");
  $(".span-B").css("background-color", "rgb(" + fillR + "," + fillG + "," + fillB + ")");
  pointerBgColor = "rgb(" + fillR + "," + fillG + "," + fillB + ")";
  $("#fillColor").val(fillRGB);
  $("#pointerIcon").attr("style", "display:none;");
  $("#fillAndColor").attr("style", "display:inline !important; position:absolute; background:" + pointerBgColor + "; height:" + pointerSize + "px; width:" + pointerSize + "px;  border-radius:300vw;  border:1px solid; border-color:" + pointerBrColor + "");

  initDrawingHtml();
});

/*Border change */
$("#borderR").change(function () {
  detData();
  var borderR = $('#borderR').val();
  var borderG = $('#borderG').val();
  var borderB = $('#borderB').val();
  var borderRGB = ('rgb(' + borderR + ',' + borderG + ',' + borderB + ')')
  $(".span-br-R").css("background-color", "rgb(" + borderR + "," + borderG + "," + borderB + ")");
  $(".span-br-G").css("background-color", "rgb(" + borderR + "," + borderG + "," + borderB + ")");
  $(".span-br-B").css("background-color", "rgb(" + borderR + "," + borderG + "," + borderB + ")");
  pointerBrColor = "rgb(" + borderR + "," + borderG + "," + borderB + ")";
  $(".img-box-1").css("border-color", "rgb(" + borderR + "," + borderG + "," + borderB + ")");
  $("#borderColor").val(borderRGB);
  $("#pointerIcon").attr("style", "display:none;");
  $("#fillAndColor").attr("style", "display:inline !important; position:absolute; background:" + pointerBgColor + "; height:" + pointerSize + "px; width:" + pointerSize + "px;  border-radius:300vw;  border:1px solid; border-color:" + pointerBrColor + "");

  initDrawingHtml();
});
$("#borderG").change(function () {
  detData();
  var borderR = $('#borderR').val();
  var borderG = $('#borderG').val();
  var borderB = $('#borderB').val();
  var borderRGB = ('rgb(' + borderR + ',' + borderG + ',' + borderB + ')')
  $(".span-br-R").css("background-color", "rgb(" + borderR + "," + borderG + "," + borderB + ")");
  $(".span-br-G").css("background-color", "rgb(" + borderR + "," + borderG + "," + borderB + ")");
  $(".span-br-B").css("background-color", "rgb(" + borderR + "," + borderG + "," + borderB + ")");
  pointerBrColor = "rgb(" + borderR + "," + borderG + "," + borderB + ")";
  $(".img-box-1").css("border-color", "rgb(" + borderR + "," + borderG + "," + borderB + ")");
  $("#borderColor").val(borderRGB);
  $("#pointerIcon").attr("style", "display:none;");
  $("#fillAndColor").attr("style", "display:inline !important; position:absolute; background:" + pointerBgColor + "; height:" + pointerSize + "px; width:" + pointerSize + "px;  border-radius:300vw;  border:1px solid; border-color:" + pointerBrColor + "");

  initDrawingHtml();
});
$("#borderB").change(function () {
  detData();  
  var borderR = $('#borderR').val();
  var borderG = $('#borderG').val();
  var borderB = $('#borderB').val();
  var borderRGB = ('rgb(' + borderR + ',' + borderG + ',' + borderB + ')')
  $(".span-br-R").css("background-color", "rgb(" + borderR + "," + borderG + "," + borderB + ")");
  $(".span-br-G").css("background-color", "rgb(" + borderR + "," + borderG + "," + borderB + ")");
  $(".span-br-B").css("background-color", "rgb(" + borderR + "," + borderG + "," + borderB + ")");
  pointerBrColor = "rgb(" + borderR + "," + borderG + "," + borderB + ")";
  $(".img-box-1").css("border-color", "rgb(" + borderR + "," + borderG + "," + borderB + ")");
  $("#borderColor").val(borderRGB);
  $("#pointerIcon").attr("style", "display:none;");
  $("#fillAndColor").attr("style", "display:inline !important; position:absolute; background:" + pointerBgColor + "; height:" + pointerSize + "px; width:" + pointerSize + "px;  border-radius:300vw;  border:1px solid; border-color:" + pointerBrColor + "");

  initDrawingHtml();
});
var setpointerentry;
function initDrawingHtml() {
if (!setpointerentry){
  videoHtmlLst = [];
  videoHtmlLst.push({
    id: -1,
    infoCardInnerHtml: infoCardHtml,
    pointerInnerHtml: pointerHtml,
    pointerOpenURL: pointerOpenURL,
    pointerBackgroundColor: pointerBgColor,
    pointerBorderColor: pointerBrColor,
    ballSize: pointerSize
  });
  variableInitialize(-1);
}
}


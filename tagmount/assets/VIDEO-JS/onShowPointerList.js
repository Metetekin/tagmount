var getdata = function () {

    return {
        init: function (videoGuid) {

            onShowPointerList(videoGuid);
        }
    };
}();

var videoHtmlLst = [];
var videoDrawList = [];
function onShowPointerList(guid) {

    $.ajax({
        type: "POST",
        url: "https://tagmount.info/pointerListDetail.php",
        data: "id=" + guid,
        success: function (x) {
            $("#showModeSettingsCheckbox").prop('checked', true);
            showModeButtonControl = false;
            showAndDrawMode();
            setPointerInfo(x, guid);
            mediaPlayer.currentTime(videoDrawList[0]["time"]);
            stopPlayerTime = videoDrawList[videoDrawList.length - 1]["time"];
            mediaPlay();
        }
    });

}

function onShowPointer(tagmountId) {

    $.ajax({
        type: "POST",
        url: "https://tagmount.info/pointerListDetail.php",
        data: "video_id=" + tagmountId,
        success: function (x) {

            $("#showModeSettingsCheckbox").prop('checked', true);
            showModeButtonControl = false;
            showAndDrawMode();
            setPointerInfoAll(x);
            mediaPlayer.currentTime(videoDrawList[0]["time"]);
            stopPlayerTime = videoDrawList[videoDrawList.length - 1]["time"];
            mediaPlay();

        }
    });

}
function setPointerInfoAll(x) {
    videoDrawList = [];
    videoHtmlLst = [];
    pointerList = [];
    const value = x.replace(/[\u200B-\u200D\uFEFF]/g, '');
    const obj = JSON.parse(value);
    obj.forEach(element => {

        JSON.parse(element["POINTER_LIST"]).forEach(lst => {
            pointerList.push(lst);
        });
        JSON.parse(element["POINTER_LIST"]).forEach(lst => {
            lst.forEach(e => {
                videoDrawList.push({
                    id: element["ID"],
                    time: e.time,
                    positionx: e.positionx,
                    positiony: e.positiony
                });
            });
        });
        videoHtmlLst.push({
            id: element["ID"],
            infoCardInnerHtml: element["INFOCARD"],
            pointerInnerHtml: element["POINTER_LOGO"],
            pointerOpenURL: element["LINK"],
            pointerBackgroundColor: element["FILL_RGB"],
            pointerBorderColor: element["BORDER_RGB"],
            ballSize: element["POINTER_SIZE"]

        });
    });
    setpointerentry = true;
}

function setPointerInfo(x, guid) {
    videoDrawList = [];
    videoHtmlLst = [];
    pointerList = [];
    const value = x.replace(/[\u200B-\u200D\uFEFF]/g, '');
    const obj = JSON.parse(value);
    obj.forEach(element => {

        JSON.parse(element["POINTER_LIST"]).forEach(lst => {
            pointerList.push(lst);
        });
        JSON.parse(element["POINTER_LIST"]).forEach(lst => {
            lst.forEach(e => {
                videoDrawList.push({
                    id: element["ID"],
                    time: e.time,
                    positionx: e.positionx,
                    positiony: e.positiony
                });
            });
        });
        videoHtmlLst.push({
            id: element["ID"],
            infoCardInnerHtml: element["INFOCARD"],
            pointerInnerHtml: element["POINTER_LOGO"],
            pointerOpenURL: element["LINK"],
            pointerBackgroundColor: element["FILL_RGB"],
            pointerBorderColor: element["BORDER_RGB"],
            ballSize: element["POINTER_SIZE"]

        });
    });
    setpointerentry = true;
    
    var fillstr = obj[0]["FILL_RGB"];
    var fillSub = fillstr.substring(4, (fillstr.length) - 1);
    var fillsplit = fillSub.split(",");

    var borderstr = obj[0]["BORDER_RGB"];
    var borderSub = borderstr.substring(4, (borderstr.length) - 1);
    var bordersplit = borderSub.split(",");

    var backstr = obj[0]["BACKGROUNDCOLOR_RGB"];
    var backSub = backstr.substring(4, (backstr.length) - 1);
    var backsplit = backSub.split(",");

    var textstr = obj[0]["TEXTCOLOR_RGB"];
    var textSub = textstr.substring(4, (textstr.length) - 1);
    var textsplit = textSub.split(",");


    $("#info").val(obj[0]["INFO_TEXT"]);
    $("#Links").val(obj[0]["LINK"]);

    $("#fillR").val(fillsplit[0]);
    $("#fillG").val(fillsplit[1]);
    $("#fillB").val(fillsplit[2]);
    $(".span-R").css("background-color", obj[0]["FILL_RGB"]);
    $(".span-G").css("background-color", obj[0]["FILL_RGB"]);
    $(".span-B").css("background-color", obj[0]["FILL_RGB"]);

    $("#borderR").val(bordersplit[0]);
    $("#borderG").val(bordersplit[1]);
    $("#borderB").val(bordersplit[2]);
    $(".span-br-R").css("background-color", obj[0]["BORDER_RGB"]);
    $(".span-br-G").css("background-color", obj[0]["BORDER_RGB"]);
    $(".span-br-B").css("background-color", obj[0]["BORDER_RGB"]);



    $("input[name='pointerSize'][value=" + obj[0]['POINTER_SIZE'] + "]").attr('checked', 'checked');
    var divPosition = Number(obj[0]['POINTER_SIZE']) + Number(40);
    $(".img-box-1").width(obj[0]['POINTER_SIZE']);
    $(".img-box-1").height(obj[0]['POINTER_SIZE']);
    $(".div-position-2").css("height", divPosition);
    $(".div-position-2").css("width", divPosition);

    $("#backR").val(backsplit[0]);
    $("#backG").val(backsplit[1]);
    $("#backB").val(backsplit[2]);
    $(".span-bg-R").css("background-color", obj[0]["BACKGROUNDCOLOR_RGB"]);
    $(".span-bg-G").css("background-color", obj[0]["BACKGROUNDCOLOR_RGB"]);
    $(".span-bg-B").css("background-color", obj[0]["BACKGROUNDCOLOR_RGB"]);
    $(".span-bg-B").css("background-color", obj[0]["BACKGROUNDCOLOR_RGB"]);
    $("#backgroundColor").val(obj[0]["BACKGROUNDCOLOR_RGB"]);
    $(".infoCartP").css("background-color", obj[0]["BACKGROUNDCOLOR_RGB"]);
    $(".infoCartP").css("color", obj[0]["TEXTCOLOR_RGB"]);

    $("#slidebar").html(obj[0]["BACKGROUND_OPACITY"] * 100 + "%");
    $("#slidebarinput").val(obj[0]["BACKGROUND_OPACITY"] * 100);
    $("#backgroundOpacity").val(obj[0]["BACKGROUND_OPACITY"]);
    $(".infoCartP").css("opacity", obj[0]["BACKGROUND_OPACITY"]);


    $("#textR").val(textsplit[0]);
    $("#textG").val(textsplit[1]);
    $("#textB").val(textsplit[2]);
    $(".span-tx-R").css("background-color", obj[0]["TEXTCOLOR_RGB"]);
    $(".span-tx-G").css("background-color", obj[0]["TEXTCOLOR_RGB"]);
    $(".span-tx-B").css("background-color", obj[0]["TEXTCOLOR_RGB"]);
    $("#textColor").val(obj[0]["TEXTCOLOR_RGB"]);
    $(".infoCartP").text(obj[0]["INFO_TEXT"]);


    $("#image1").attr("src", obj[0]["OBJECT_SRC"]);
    $("#image3").attr("src", obj[0]["OBJECT_SRC"]);
    $("#logo2").attr("src", obj[0]["LOGO_SRC"]);
    $("#logo1").attr("src", obj[0]["LOGO_SRC"]);
    $("#pointerIcon").attr("src", obj[0]["ICON_SRC"]);

    $("#kayitekleDiv").css("display", "none");
    $("#kayitupdateDiv").css("display", "block");
    $("#imageinnerhtml").val(obj[0]["POINTER_LOGO"]);
    $("#infocardinnerhtml").val(obj[0]["INFOCARD"]);
    $("#imageHiddenData").val(obj[0]["OBJECT_SRC"]);
    $("#AddImageLogo").val(obj[0]["LOGO_SRC"]);
    $("#imageIconData").val(obj[0]["ICON_SRC"]);
    $("#tagmountId").val(obj[0]["ID"]);
    infoBackColor=obj[0]["BACKGROUNDCOLOR_RGB"];
    infotextColor=obj[0]["TEXTCOLOR_RGB"];
    BackOpacity=obj[0]["BACKGROUND_OPACITY"];
    $.ajax({
        type: "POST",
        url: "thirdparty.php",
        data: "id=" + guid,
        success: function (x) {
            const value1 = x.replace(/[\u200B-\u200D\uFEFF]/g, '');
            const shows = JSON.parse(value1);
            

            $("#campaign").val(shows["CAMPAING_NAME"]);
            $("#price").val(shows["CPM_PRICE"]);
            $("#daily").val(shows["TOTAL_IMPRESSION"]);
            $("#third").val(shows["THIRD_PARTY_PIXEL"]);
            $("#third2").val(shows["THIRD_PARTY_PIXEL2"]);
        }
    });

    setpointerentry = false;

     videoDrawWidth = obj[0]["VIDEOWIDTH"];//885;
     videoDrawHeight = obj[0]["VIDEOHEIGHT"];//614;
    
    // console.log("DRAWLST",drawList);
    // console.log("htmlLst",htmlLst);

    //console.log(id);
}


var pointerPlay = function () {

    return {
        init: function (videoDivPar, videoDrawWidthPar, videoDrawHeightPar) {
            videoDiv = videoDivPar;
            if (videoDrawWidthPar != undefined && videoDrawWidthPar > 0)
                videoDrawWidth = videoDrawWidthPar;
            if (videoDrawHeightPar != undefined && videoDrawHeightPar > 0)
                videoDrawHeight = videoDrawHeightPar;

            addPointerEvents();
        }

    };
}();




var lasttime = 0;//TODO sonrasında silinecek.
var drawBallTime = function (selectedTime) {
    var display = false;
    for (let index = 0; index < pointerList.length; index++) {
        const element = pointerList[index];
        var bas = element[0].time;
        var bit = element[element.length - 1].time;
        if (bas <= selectedTime && selectedTime <= bit) {
            display = true;
            break; // Behaves like `break`
        }
    }
    if (display) {
        var drawPositions = videoDrawList.filter(t => parseFloat(t.time) >= parseFloat(lasttime) && parseFloat(t.time) <= parseFloat(selectedTime));
        if (drawPositions != undefined) {
            drawPositions.forEach(element => {
                drawBall(element.positionx, element.positiony, element.id);
            });
        }

    }
    else {
        $(pointerObj).attr("style", "display: none ;");
        $(infoCardObj).attr("style", "display: none ;");
    }
    lasttime = selectedTime;
}
var GLOBALtagmountId = 0;
var oldLeft = 0;
var oldTop = 0;
var infoCardOldLeft;
var infoCardOoldTop;
var infoCardLeft;
var infoCardTop;
var oldTagmountId = 0;
var videoDivWidth;
var videodDivHeight;
var infoCardTextWidth;
var infoCardTextHeight;
var infoCardLogoWidth;
var infoCardLogoHeight;
var logoSizeWidth;
var logoSizeHeight;
var infoBackColor;
var infotextColor;
var BackOpacity;

function drawBall(coorX, coorY, tagmountId) {
    var scaleWidth = 1;
    var scaleHeight = 1;
    if (videoDrawWidth > 0) {
        scaleWidth = $(videoDiv).width() / videoDrawWidth;
    }
    if (videoDrawHeight > 0) {
        scaleHeight = $(videoDiv).outerHeight() / videoDrawHeight;
    }

    coorX = coorX * scaleWidth;
    coorY = coorY * scaleHeight;

    pointerLeft = coorX - 5;//canvasborder
    pointerTop = coorY - 5;//canvasborder
    if (tagmountId != oldTagmountId) {
        variableInitialize(tagmountId);
        oldTagmountId = tagmountId;
    }
    scalewidthBallSize = ballSize * scaleWidth;
    scaleHeightBallSize = ballSize * scaleHeight;
    if ($(pointerObj).html() != '') {
        $(pointerObj).attr("style", "display: inline !important; position:absolute; left:" + oldLeft + "px; top:" + oldTop + "px; z-index:2147483647");



    } else {
        // // koordinatta objenin merkezi yer alması için.
        //   pointerLeft = pointerLeft - ($(pointerObj).width() / 2);
        //   pointerTop = pointerTop - ($(pointerObj).height() / 2);
        //$(pointerObj).attr("style", "display: inline !important; position:absolute;  border-radius:300vw; background:" + pointerBackgroundColor + "; height:" + ballSize + "px; width:" + ballSize + "px; border:1px solid; border-color:" + pointerBorderColor + "; left:" + oldLeft + "px; top:" + oldTop + "px; z-index:2147483647");
        $(pointerObj).attr("style", "display: inline !important; position:absolute;  border-radius:300vw; background:" + pointerBackgroundColor + "; height:" + scaleHeightBallSize + "px; width:" + scalewidthBallSize + "px; border:1px solid; border-color:" + pointerBorderColor + "; z-index:2147483647");



    }

    $(pointerObj).animate({ "left": pointerLeft + "px", "top": pointerTop + "px" },

        { duration: 1 });
    oldLeft = pointerLeft;
    oldTop = pointerTop;

    if ($(infoCardObj).html() != '') {
        infoCardAutoPosition(scaleWidth, scaleHeight);
        $(infoCardObj).animate({ "left": infoCardLeft + "px", "top": infoCardTop + "px" },
            { duration: 1 });
        infoCardOldLeft = infoCardLeft;
        infoCardOoldTop = infoCardTop;
    }


}
function infoCardAutoPosition(scaleWidth, scaleHeight) {



    videoDivWidth = parseInt($(videoDiv).outerWidth());
    videodDivHeight = parseInt($(videoDiv).outerHeight());
    infoCardTextWidth = parseInt($("#infoCartP").outerWidth());
    infoCardTextHeight = parseInt($("#infoCartP").outerHeight());
    infoCardLogoWidth = parseInt($("#logo2").outerWidth());
    infoCardLogoHeight = parseInt($("#logo2").outerHeight());
    pointerAutoSize(scaleWidth,scaleHeight);
   

    /*

 $(infoCardObj).attr("style", "width:auto; height:auto; border-radius:5px;  display:inline-block; position:absolute; z-index:2147483647");
        infoCardLeft = $(pointerObj).position().left + ($(pointerObj).width() / 2) - ($(infoCardObj).width() / 2);
        infoCardTop = $(pointerObj).position().top - ($(infoCardObj).height());
        $(infoCardObj).attr("style", "left:" + infoCardOldLeft + "px; top:" + infoCardOoldTop + "px; position:absolute; z-index:2147483647");
   */

    var pointerWidth = $(pointerObj).width();
    var infoCardWidth = $(infoCardObj).width();

    var pointerHeight = $(pointerObj).height();
    var infoCardHeight = $(infoCardObj).height();

    $(infoCardObj).attr("style", "width:auto; height:auto; border-radius:5px;  display:inline-block; position:absolute; z-index:2147483647");

    infoCardLeft = pointerLeft + (pointerWidth / 2) - (infoCardWidth / 2) + 3;
    infoCardTop = pointerTop - infoCardTextHeight - infoCardLogoHeight;
    if (infoCardTop <= 0) {
        infoCardLeft = pointerLeft + (pointerWidth / 2) - (infoCardWidth / 2);
        infoCardTop = pointerTop - infoCardTextHeight - infoCardLogoHeight + infoCardTextHeight + infoCardLogoHeight + pointerHeight - 2;
        // $(infoCardObj).attr("style", "left:" + infoCardOldLeft + "px; top:" + infoCardOoldTop + "px; position:absolute; z-index:2147483647");
    }
    if (infoCardLeft <= 0) {
        infoCardLeft = pointerLeft + (pointerWidth) - ((infoCardWidth - (infoCardTextWidth)) / 2) + 3;
        infoCardTop = pointerTop + (pointerHeight / 2) - ((infoCardTextHeight + infoCardLogoHeight) / 2);
        //$(infoCardObj).attr("style", "left:" + infoCardOldLeft + "px; top:" + infoCardOoldTop + "px; position:absolute; z-index:2147483647");
    }

    var infoCardRightPosition = (infoCardLeft + ((infoCardWidth - (infoCardTextWidth)) / 2)) + infoCardTextWidth;
    var videoDivRight = parseInt($(videoDiv).width());

    if ((infoCardRightPosition > videoDivRight)) {
        infoCardLeft = pointerLeft - infoCardWidth + ((infoCardWidth - (infoCardTextWidth)) / 2) - 3;
        infoCardTop = pointerTop + (pointerHeight / 2) - ((infoCardTextHeight + infoCardLogoHeight) / 2);
        // $(infoCardObj).attr("style", "left:" + infoCardOldLeft + "px; top:" + infoCardOoldTop + "px; position:absolute; z-index:2147483647");
    }
    $(infoCardObj).attr("style", "left:" + infoCardOldLeft + "px; top:" + infoCardOoldTop + "px; position:absolute; z-index:2147483647");

}
function pointerAutoSize(scaleWidth,scaleHeight){
    infoBackColor = $("#backgroundColor").val();
    infotextColor = $("#textColor").val();
    $("#bubbleDiv2").attr("style", "background-color:transparent; border-radius:5px; width:" + 243 * scaleWidth + "px; height:" + 95 * scaleHeight + "px; margin:auto;");
    $("#infoCartP").attr("style", "line-height: " + (scaleHeight * 20) + "px; font-size:" + (scaleWidth * 14) + "px;  border-radius:5px;padding:"+3*scaleHeight+"px;-webkit-box-decoration-break: clone;background-color:" + infoBackColor + ";box-decoration-break: clone; color :" + infotextColor + ";max-width: 223px; max-height:60px; word-break: break-word; overflow-y:hidden;opacity:"+BackOpacity+";display: inline;z-index:2147483647");
    $("#logo2").attr("style", "border-radius:5px;  display:block; margin:auto; margin-top:5px; max-height:30px; z-index:2147483647");
    logoSizeWidth=($("#logo2").width())*scaleWidth;
    logoSizeHeight=($("#logo2").height())*scaleHeight;
    $("#logo2").width(logoSizeWidth);
    $("#logo2").height(logoSizeHeight);

    //$("#logo2").height(infoCardLogoHeight);
}
function variableInitialize(tagmountId) {

    GLOBALtagmountId = tagmountId;
    var varLst = videoHtmlLst.find(v => v.id == tagmountId);
    //console.log(varLst);
    if (varLst != undefined && varLst.length != 0) {
        infoCardHtml = varLst["infoCardInnerHtml"];
        pointerOpenURL = varLst["pointerOpenURL"];
        pointerBackgroundColor = varLst["pointerBackgroundColor"];
        pointerBorderColor = varLst["pointerBorderColor"];
        ballSize = varLst["ballSize"];
        pointerHtml = varLst["pointerInnerHtml"];


    } else {
        infoCardHtml = "";
        pointerOpenURL = "";
        pointerBackgroundColor = "red";
        pointerBorderColor = "blue";
        ballSize = 20;
        pointerHtml = "";
    }
    $(pointerObj).html(pointerHtml);
    $(infoCardObj).html(infoCardHtml);
    if(showModeButtonControl == true) { 
                $.ajax({
        type: "POST",
        url: "showClicks.php",
        data: "id=" + tagmountId,
        success: function (x) {
            
        }
    });
    }
}

function addPointerEvents() {
    // $(pointerObj).mouseover(function () {
    //     infoCardShow();
    // });
    // $(pointerObj).mouseout(function () {
    //     $(infoCardObj).attr("style", "display:none;");
    // });
    $(pointerObj).click(function () {
        openLink();

    });
    $(infoCardObj).click(function () {
        openLink();

    });
}

function infoCardShow() {
    //$(infoCardObj).html(infoCardHtml);
    $(infoCardObj).attr("style", "width:auto; height:auto; border-radius:5px;  display:inline-block; position:absolute; z-index:2147483647");
    infoCardLeft = pointerLeft + ($(pointerObj).width() / 2) - ($(infoCardObj).width() / 2);
    infoCardTop = pointerTop - ($(infoCardObj).height());
    $(infoCardObj).attr("style", "left:" + infoCardLeft + "px; top:" + infoCardTop + "px; position:absolute; z-index:2147483647");

}
function openLink(tagmountId = GLOBALtagmountId) {
    if (pointerOpenURL.indexOf('http') == -1)
        pointerOpenURL = "http://" + pointerOpenURL;
    window.open(pointerOpenURL, '_blank');
    /*  $.ajax({
            type: "POST",
            url: "showClicks.php",
            data: {id: tagmountId,clicks:true},
            success: function (x) {            
            }
        });*/
}


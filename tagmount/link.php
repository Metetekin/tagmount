<?php
    // some php stuff
?>
<script type="text/javascript">
  var pointerId = "pointer";
var pointerObj = "#" + pointerId;
var infoCardId = "infoCard";
var infoCardObj = "#" + infoCardId;
var pointer = function () {
    var handlePointer = function (videoDiv) {
        createPointer(videoDiv);
    }
    return {
        init: function (videoDiv) {
            handlePointer(videoDiv);
        }
    };
}();
var createPointer = function (videoDiv) {
    $(videoDiv).append(
        $('<div>').prop({
            id: 'pointerInfoCardParentDiv',
        })
    );
    $("#pointerInfoCardParentDiv").append(
        $('<div>').prop({
            id: pointerId,
            className: 'pointerClass'
        })
    );
    $("#pointerInfoCardParentDiv").append(
        $('<div>').prop({
            id: infoCardId,
            className: 'infocardClass'
        })
    );
    $(".infocardClass").css({ "display": "none", "height": "20", "width": "20" });
    $(".pointerClass").css({ "display": "none", "position": "absolute", "border-radius": "300vw", "background": "red", "height": "20", "width": "20", "border": "1px solid", "border-color": "blue", "z-index": "2147483647" });
}

var videoDiv;
var videoDrawWidth=875;
var videoDrawHeight = 604;
var infoCardHtml = "";
var pointerHtml = "";
var pointerOpenURL = "";
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

var selectedTime = 0;
var lasttime = 0;//TODO sonrasında silinecek.
var drawBallTime = function (selectedTime) {
    var display = false;
    for (let index = 0; index < pointerList.length; index++) {
        const element = pointerList[index];
        var bas = element[0].time;
        var bit = element[element.length - 1].time;
        if (bas <= selectedTime && selectedTime <= bit) {
            display = true;
            break;
        }
    }
    if (display) {
        var drawPositions = videoDrawList.filter(t => parseFloat(t.time) >= parseFloat(lasttime) && parseFloat(t.time) <= parseFloat(selectedTime));
        lasttime = selectedTime;
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
}

var GLOBALtagmountId = 0;
var oldLeft = 0;
var oldTop = 0;
var infoCardOldLeft;
var infoCardOoldTop;
var infoCardLeft;
var infoCardTop;
var oldTagmountId = 0;
function drawBall(coorX, coorY, tagmountId) {
    var scaleWidth = 1;
    var scaleHeigth = 1;
    if (videoDrawWidth > 0) {
        scaleWidth = $(videoDiv).width() / videoDrawWidth;
    }
    if (videoDrawHeight > 0) {
        scaleHeigth = $(videoDiv).outerHeight() / videoDrawHeight;
    }
    coorX = coorX * scaleWidth;
    coorY = coorY * scaleHeigth;
    pointerLeft = coorX - 5;//canvasborder
    pointerTop = coorY - 5;//canvasborder
    if (tagmountId != oldTagmountId) {
        variableInitialize(tagmountId);
        oldTagmountId = tagmountId;
    }
    if ($(pointerObj).html() != '') {
        $(pointerObj).attr("style", "display: inline !important; position:absolute; left:" + oldLeft + "px; top:" + oldTop + "px; z-index:2147483647");
        $(infoCardObj).attr("style", "width:auto; height:auto; border-radius:5px;  display:inline-block; position:absolute; z-index:2147483647");
        infoCardLeft = $(pointerObj).position().left + ($(pointerObj).width() / 2) - ($(infoCardObj).width() / 2);
        infoCardTop = $(pointerObj).position().top - ($(infoCardObj).height());
        $(infoCardObj).attr("style", "left:" + infoCardOldLeft + "px; top:" + infoCardOoldTop + "px; position:absolute; z-index:2147483647");
    } else {
        $(pointerObj).attr("style", "display: inline !important; position:absolute;  border-radius:300vw; background:" + pointerBackgroundColor + "; height:" + ballSize + "px; width:" + ballSize + "px; border:1px solid; border-color:" + pointerBorderColor + "; left:" + oldLeft + "px; top:" + oldTop + "px; z-index:2147483647");
        $(infoCardObj).attr("style", "width:auto; height:auto; border-radius:5px;  display:inline-block; position:absolute; z-index:2147483647");
        infoCardLeft = $(pointerObj).position().left + ($(pointerObj).width() / 2) - ($(infoCardObj).width() / 2);
        infoCardTop = $(pointerObj).position().top - ($(infoCardObj).height());
        $(infoCardObj).attr("style", "left:" + infoCardOldLeft + "px; top:" + infoCardOoldTop + "px; position:absolute; z-index:2147483647");
    }
    $(pointerObj).animate({ "left": pointerLeft + "px", "top": pointerTop + "px" }, { duration: 1 });
    oldLeft = pointerLeft;
    oldTop = pointerTop;
    $(infoCardObj).animate({ "left": infoCardOldLeft + "px", "top": infoCardOoldTop + "px" }, { duration: 1 });
    infoCardOldLeft = infoCardLeft;
    infoCardOoldTop = infoCardTop;
}

function variableInitialize(tagmountId) {
    GLOBALtagmountId = tagmountId;
    var varLst = videoHtmlLst.find(v => v.id == tagmountId);
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
}

function addPointerEvents() {
    $(pointerObj).click(function () {
        openLink();
    });
    $(infoCardObj).click(function () {
        openLink();
    });
}

function infoCardShow() {
    $(infoCardObj).attr("style", "width:auto; height:auto; border-radius:5px;  display:inline-block; position:absolute; z-index:2147483647");
    infoCardLeft = $(pointerObj).position().left + ($(pointerObj).width() / 2) - ($(infoCardObj).width() / 2);
    infoCardTop = $(pointerObj).position().top - ($(infoCardObj).height());
    $(infoCardObj).attr("style", "left:" + infoCardLeft + "px; top:" + infoCardTop + "px; position:absolute; z-index:2147483647");
}
let scriptData = document.currentScript.getAttribute('data');
var scriptUrl   = window.location.origin;
function openLink(tagmountId = GLOBALtagmountId) {
    if (pointerOpenURL.indexOf('http') == -1)
        pointerOpenURL = "http://" + pointerOpenURL;
    window.open(pointerOpenURL, '_blank');
}
var getdata = function () {
    return {
        init: function (videoGuid) {
            onShowPointer(videoGuid);
        }
    };
}();

var videoHtmlLst = [];
var videoDrawList = [];
function onShowPointer(tagmountId) {
    $.ajax({
        type: "POST",
        url: "https://tagmount.info/pointerListDetail.php",
        data:{ scriptData : scriptData,scriptUrl : scriptUrl, video_id : tagmountId},
        success: function (x) {
            setPointerInfo(x);
        }
    });
}

function setPointerInfo(x) {
    videoDrawList = [];
    videoHtmlLst = [];
    pointerList = [];
    const value =x.replace(/[\u200B-\u200D\uFEFF]/g, '');
    const obj = JSON.parse(value);
    obj.forEach(element => {
        JSON.parse(element["POINTER_LIST"]).forEach(lst=> {
            pointerList.push(lst);
         });
         JSON.parse(element["POINTER_LIST"]).forEach(lst=> {
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
             pointerOpenURL:element["LINK"],
             pointerBackgroundColor:element["FILL_RGB"],
             pointerBorderColor:element["BORDER_RGB"],
             ballSize:element["POINTER_SIZE"]
 
         });

    });
     videoDrawWidth = obj[0]["VIDEOWIDTH"];
     videoDrawHeight = obj[0]["VIDEOHEIGHT"];
}
function getDataFunction(videodiv,videoJs,videoKey) {
    pointer.init(videodiv);
    var mediaPlayer = videojs(videoJs);
    mediaPlayer.on('timeupdate', () => {
        mseconds = mediaPlayer.currentTime();
        drawBallTime(mseconds);
    });
    getdata.init(videoKey);
    pointerPlay.init(videodiv);
}

var tagmountData = function () {
    return {
        init: function (videodiv,videoJs,videoKey) {

            getDataFunction(videodiv,videoJs,videoKey);
        }
    };
}();
var data = function () {
    return {
        init: function (videodiv,videoJs,videoKey) {

            getDataFunction(videodiv,videoJs,videoKey);
        }
    };
}();
</script>
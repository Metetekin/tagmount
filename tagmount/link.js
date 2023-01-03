var pointerId="pointer";
var pointerObj="#"+pointerId;
var infoCardId="infoCard";
var infoCardObj="#"+infoCardId;
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
var createPointer= function (videoDiv) {
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
    $(".infocardClass").css({"display": "none", "height":"20" , "width":"20" });
    $(".pointerClass").css({"display": "none", "position":"absolute", "border-radius":"300vw", "background":"red",  "height":"20" , "width":"20" ,"border":"1px solid", "border-color":"blue", "z-index":"2147483647"});
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
   
    scalewidthBallSize = ballSize * scaleHeight;
    scaleHeightBallSize = ballSize * scaleHeight;
    if ($(pointerObj).html() != '') {
        $(pointerObj).attr("style", "display: inline !important; position:absolute; left:" + oldLeft + "px; top:" + oldTop + "px; z-index:2147483647");
	$("#pointerIcon").attr("style", "width:"+scalewidthBallSize +"px; height:"+scaleHeightBallSize +"px; display:inline !important; border-radius: 60%;");



    } else {
        // // koordinatta objenin merkezi yer alması için.
        //   pointerLeft = pointerLeft - ($(pointerObj).width() / 2);
        //   pointerTop = pointerTop - ($(pointerObj).height() / 2);
        //$(pointerObj).attr("style", "display: inline !important; position:absolute;  border-radius:300vw; background:" + pointerBackgroundColor + "; height:" + ballSize + "px; width:" + ballSize + "px; border:1px solid; border-color:" + pointerBorderColor + "; left:" + oldLeft + "px; top:" + oldTop + "px; z-index:2147483647");
        $(pointerObj).attr("style", "display: inline !important; position:absolute;  border-radius:300vw; background:" + pointerBackgroundColor + "; height:" + scaleHeightBallSize + "px; width:" + scalewidthBallSize + "px; border:1px solid; border-color:" + pointerBorderColor + "; z-index:2147483647");
	$("#pointerIcon").attr("style", "width:"+scalewidthBallSize +"px; height:"+scaleHeightBallSize +"px; display:inline !important; border-radius: 60%;");



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

    infoCardLeft = pointerLeft + (pointerWidth / 2) - (infoCardWidth / 2);
    infoCardTop = pointerTop - infoCardTextHeight - infoCardLogoHeight;
    if (infoCardTop <= 0) {
        infoCardLeft = pointerLeft + (pointerWidth / 2) - (infoCardWidth / 2);
        infoCardTop = pointerTop - infoCardTextHeight - infoCardLogoHeight + infoCardTextHeight + infoCardLogoHeight + pointerHeight ;
        // $(infoCardObj).attr("style", "left:" + infoCardOldLeft + "px; top:" + infoCardOoldTop + "px; position:absolute; z-index:2147483647");
    }
    if (infoCardLeft <= 0) {
        infoCardLeft = pointerLeft + (pointerWidth) - ((infoCardWidth - (infoCardTextWidth)) / 2) ;
        infoCardTop = pointerTop + (pointerHeight / 2) - ((infoCardTextHeight + infoCardLogoHeight) / 2);
        //$(infoCardObj).attr("style", "left:" + infoCardOldLeft + "px; top:" + infoCardOoldTop + "px; position:absolute; z-index:2147483647");
    }

    var infoCardRightPosition = (infoCardLeft + ((infoCardWidth - (infoCardTextWidth)) / 2)) + infoCardTextWidth;
    var videoDivRight = parseInt($(videoDiv).width());

    if ((infoCardRightPosition > videoDivRight)) {
        infoCardLeft = pointerLeft - infoCardWidth + ((infoCardWidth - (infoCardTextWidth)) / 2) ;
        infoCardTop = pointerTop + (pointerHeight / 2) - ((infoCardTextHeight + infoCardLogoHeight) / 2)-5;
        // $(infoCardObj).attr("style", "left:" + infoCardOldLeft + "px; top:" + infoCardOoldTop + "px; position:absolute; z-index:2147483647");
    }
    $(infoCardObj).attr("style", "left:" + infoCardOldLeft + "px; top:" + infoCardOoldTop + "px; position:absolute; z-index:2147483647");

}
function pointerAutoSize(scaleWidth,scaleHeight){

    $("#bubbleDiv2").attr("style", "background-color:transparent; border-radius:5px; width:" + 243 * scaleWidth + "px; height:" + 95 * scaleHeight + "px; margin:auto;");
    $("#infoCartP").attr("style", "line-height: " + (scaleHeight * 20) + "px; font-size:" + (scaleWidth * 14) + "px;  border-radius:5px;padding:"+3*scaleHeight + "px;-webkit-box-decoration-break: clone;background-color:"+infoBackColor+";box-decoration-break: clone; color :"+infotextColor+";max-width:"+(scaleWidth*223)+"px; max-height:60px; word-break: break-word; overflow-y:hidden;opacity:"+BackOpacity+";display: inline;z-index:2147483647");
    $("#logo2").attr("style", "border-radius:5px;  display:block; margin:0px auto 0px; margin-bottom:3px; max-height:30px; z-index:2147483647");
    logoSizeWidth=($("#logo2").width())*scaleWidth;
    logoSizeHeight=($("#logo2").height())*scaleHeight;
    $("#logo2").width(logoSizeWidth);
    $("#logo2").height(logoSizeHeight);

    //$("#logo2").height(infoCardLogoHeight);
}
var isMobile=false;
var deviceType;
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| ||a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
    isMobile = true;
    if(isMobile==true){
        deviceType=1;
    }
    
}else{
 isMobile = false;
    if(isMobile==false){
        deviceType=0;
    }
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
        infoBackColor=varLst["infoBackColor"];
        infotextColor=varLst["infotextColor"];
        BackOpacity=varLst["BackOpacity"];

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


   
    $.ajax({
        type: "POST",
        url: "https://tagmount.info/showClicks.php",
        data:{ id: tagmountId, shows: true ,deviceType:deviceType},
        success: function (x) {
        }
    });
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
var scriptData = document.currentScript.getAttribute('data');
var scriptUrl   = window.location.origin;
var scriptHref   = window.location.href;

function openLink(tagmountId = GLOBALtagmountId) {
    if (pointerOpenURL.indexOf('http') == -1)
        pointerOpenURL = "http://" + pointerOpenURL;
    window.open(pointerOpenURL, '_blank');
    $.ajax({
        type: "POST",
        url: "https://tagmount.info/showClicks.php",
        data: { id: tagmountId, clicks: true ,deviceType:deviceType},
        success: function (x) {
        }
    });
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
             ballSize:element["POINTER_SIZE"],
             infoBackColor:element["BACKGROUNDCOLOR_RGB"],
             infotextColor:element["TEXTCOLOR_RGB"],
             BackOpacity:element["BACKGROUND_OPACITY"]
 
         });
         $.ajax({
            type: "POST",
            url: "https://tagmount.info/pointerListDetail.php",
            data:"showsPointerid="+element["ID"],
            success: function (x) {
                const showsPointer =x.replace(/[\u200B-\u200D\uFEFF]/g, '');
                const showsPointerVal = JSON.parse(showsPointer);
              
                $.get(scriptHref, function(){
                    try {
                        $('<img />', {
                            src: showsPointerVal[0]["THIRD_PARTY_PIXEL"],
                            width: '1px',
                            height: '1px'
                        }).appendTo("body");
                      
                    } catch (t) {
                        console.log("error :"+t);
                    }
                    
                  });
            }
        });
    });
    videoDrawWidth = obj[0]["VIDEOWIDTH"];
    videoDrawHeight = obj[0]["VIDEOHEIGHT"];
}
function getDataFunction(videodiv,videoJs,videoKey) {
    $.ajax({
        type: "POST",
        url: "https://tagmount.info/scriptDataUrl.php",
        data: {
            scriptData: scriptData,
            scriptUrl: scriptUrl
        },
        success: function(x) {
            const companyVal = x.replace(/[\u200B-\u200D\uFEFF]/g, '');
            const companyValue = JSON.parse(companyVal);
            if (companyValue[0]["COMPANY_ID"] == 1) {
                var vidJsObj = window.HPlayer.vjs.options().id;
                var vidJs = "#" + vidJsObj;
                pointer.init(vidJs);
                window.HPlayer.vjs.on('timeupdate', function () {
                    var mseconds = window.HPlayer.vjs.currentTime();                            
                    drawBallTime(mseconds);
                    
                    });
                getdata.init(videoKey);
                pointerPlay.init(vidJs);
            } else{
                pointer.init(videodiv);
                var mediaPlayer = videojs(videoJs);
                mediaPlayer.on('timeupdate', () => {
                    mseconds = mediaPlayer.currentTime();
                    drawBallTime(mseconds);
                });
                getdata.init(videoKey);
                pointerPlay.init(videodiv);
            }
        }
    });
   
    
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
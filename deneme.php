<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="#" type="image/x-icon" />

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="tagmountTest/assets/css/canvas.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style(rgb).css">
    <link href="assets/bootstrap/css/component.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.17.0/video-js.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-duration-format/1.3.0/moment-duration-format.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//player2.h-cdn.com/hola_player.js?customer=demo"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    
            <script>
function tagMount() {

$(document).ready(function () {

console.log("tagmount 26.04.2022 14:55");

data.init("#videoDiv","#my_video","8b93-d3d403436134");

});

}

    </script>
    <script src="https://tagmount.info/tagmountTest/link.js"  data="123"></script>
</head>

<body>

    <div class="row">
        <div class="col-xs-6 col-md-6 col-lg-6 col-xl-6">
            <!---video -->
            <div id="component">
                <div id="allTopComponent">
                    <div id="videoDiv" style="display:flex ;">
                        <!-- <video id="my_video" width="718" height="416" class="video-js my_video" data-setup='{ "controls": true, "autoplay": false, "preload": "auto" }'>
                                        <source src="https://www.youtube.com/watch?v=6WmbTTeIQNg" type="video/youtube" />
                                    </video> -->
                        <video id="my_video" class="video-js vjs-default-skin" width="875" height="604" controls>
                            <source src="https://tagmount.info/video/144.mp4" type="video/mp4">
                        </video>
                        <!-- <div id="canvasContainer" class="my_video-dimensions">
                                        <canvas id="canvasVideo" class="my_video-dimensions"></canvas>
                                        <canvas id="canvasDraw" class="my_video-dimensions"></canvas>
                                    </div> -->
                    </div>
                </div>
                <div id="allBottomComponent" style="margin-left:0px;">
                    <div class="row">
                        <div id="playOrPause" class="col-xs-3 col-md-3 col-lg-3 col-xl-3" style="width:165px;">
                            <button type="button" id="mediaPlay" class="video-play-button _play"> </button>
                            <button type="button" id="mediaPause" class="video-play-button _pause"></button>
                            <button type="button" id="backward" class="video-play-button _backward" style="padding-top:2px;"> </button>
                            <button type="button" id="forward" class="video-play-button _forward" style="padding-top:2px;"></button>


                        </div>

                        <div id="timeSliderDiv" class="col-xs-6 col-md-6 col-lg-6 col-xl-6" style=" margin-top:20px;">
                            <div class="row">
                                <div id="timePickerDiv" class="col-xs-2 col-md-2 col-lg-2 col-xl-2" style="margin-top:-2px;">
                                    <time id="timePicker"><b>00:00:00</b></time>
                                </div>
                                <div class="col-xs-10 col-md-10 col-lg-10 col-xl-10" style="margin-top:0px;">
                                    <input id="timeSlider" type="range" min="0" max="100" value="0"></input>
                                </div>
                            </div>

                            <?php echo "GELEN VERİ => ".$_POST["gonderilen"]; ?>
                        </div>

                    </div>
                </div>
                <hr class="hr-3" style="margin-bottom:15px;">
                <div class="col-xs-3 col-md-3 col-lg-3 col-xl-3">
                    <a>
                        <div style="margin-bottom:10px;"><span><b>Show Mode </b></span> </div>
                        <label class="switch">
                            <input id="showModeSettingsCheckbox" type="checkbox">
                            <span class="slider round"></span>
                    </a>
                </div>
            </div>
            <script src="assets/bootstrap/js/bootstrap.js"></script>
            <script src="assets/bootstrap/js/bootstrap.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>


       
    
</body>

</html>
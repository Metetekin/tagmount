$(function () {

    $(document.body).on('change', '#dizi', function () {
        var diziadi = $(this).val();
        if (diziadi) {
            $.post('libraries/islem.php', { 'diziadi': diziadi }, function (response) {
                $('#bolum').html(response).removeAttr('disabled');
                $('#divpointer').css("display","inline");
            });
        } else {
            
            $('#bolum').html('<option> Bölüm Seçin </option>').attr('disabled', 'disabled');
            $('#divpointer').css("display","none");
        }
    });

});
function pointerchance(guid) {    
    $("#divpointer").load("vendor/pointerlist.php?guid=" + guid);
    var bolum = $('#bolum').val();
    $('#bolumid').val(bolum);
}
function videoChange(id) {
    var videoSrc;
    $.ajax({
        type: "POST",
        url: "pointerListDetail.php",
        data: "video_link=" + id,
        success: function (x) {
            const deger =x.replace(/[\u200B-\u200D\uFEFF]/g, '');
            const obj1 = JSON.parse(deger);
            videoSrc = obj1.VIDEO_LINK;
            mediaPlayer.src({
                type: "video/mp4",
                src: videoSrc
            });
            mediaPlayer.load();
            getVideoDuration();
        }
    });
}
$("#bolum").change(function () {
    videoChange(this.value);
});
<?php
require_once 'vendor/baglan.php';
if (!(isset($_POST["bolum"]))) {
    echo  "bolumRequired";
} else {
    if (
        isset($_POST["info"])
        && isset($_POST["Link"])
        && isset($_POST["backgroundColor"]) && isset($_POST["backgroundOpacity"]) && isset($_POST["textColor"])
        && isset($_POST["borderColor"]) && isset($_POST["fillColor"])
        && isset($_POST["imageinnerhtml"]) && isset($_POST["infocardinnerhtml"])
        && isset($_POST["videoDrawHeight"]) && isset($_POST["videoDrawWidth"]) && isset($_POST["bolum"])
        && isset($_POST["campaign"]) && isset($_POST["daily"]) && isset($_POST["price"]) && isset($_POST["third"])  && isset($_POST["third2"])
    ) {

        $info   =    $_POST["info"];
        $Link  =    $_POST["Link"];
        $AddImageLogo  =    $_POST["AddImageLogo"];
        $imageIconData  =    $_POST["imageIconData"];
        $pointerSize  = $_POST["pointerSize"];
        $fillColor  =    $_POST["fillColor"];
        $borderColor  =    $_POST["borderColor"];
        $backgroundColor  =    $_POST["backgroundColor"];
        $textColor  =    $_POST["textColor"];
        $backgroundOpacity  =    $_POST["backgroundOpacity"];
        $imageinnerhtml = $_POST["imageinnerhtml"];
        $infocardinnerhtml = $_POST["infocardinnerhtml"];
        $videoDrawHeight = $_POST["videoDrawHeight"];
        $videoDrawWidth = $_POST["videoDrawWidth"];
        $bolum = $_POST["bolum"];
        $tagmountId = $_POST["tagmountId"];
        $campaign = $_POST["campaign"];
        $daily = $_POST["daily"];
        $price = $_POST["price"];
        $third = $_POST["third"];
        $third2 = $_POST["third2"];



        if (!$info) {
            echo "infoRequired";
        } else if (!$Link) {
            echo "linkRequired";
        
        } else {
            $query = $db->prepare("UPDATE  pointer SET
                VIDEOHEIGHT= :videoDrawHeight,
                VIDEOWIDTH= :videoDrawWidth,
                INFOCARD = :infocardinnerhtml,
                POINTER_LOGO= :imageinnerhtml,
                LOGO_SRC= :AddImageLogo,
                ICON_SRC= :imageIconData,
                INFO_TEXT = :info,
                LINK = :Link,                
                POINTER_SIZE = :pointerSize,
                FILL_RGB= :fillColor,
                BORDER_RGB= :borderColor,
                BACKGROUNDCOLOR_RGB= :backgroundColor,
                BACKGROUND_OPACITY= :backgroundOpacity,
                TEXTCOLOR_RGB= :textColor,
                VIDEO_ID= :bolum
                WHERE ID= :tagmountId
                ");
            $insert = $query->execute(array(
                "videoDrawHeight" => $videoDrawHeight,
                "videoDrawWidth" => $videoDrawWidth,
                "infocardinnerhtml" => $infocardinnerhtml,
                "imageinnerhtml" => $imageinnerhtml,
                "AddImageLogo" => $AddImageLogo,
                "imageIconData" => $imageIconData,
                "info" => $info,
                "Link" => $Link,
                "pointerSize" => $pointerSize,
                "fillColor" => $fillColor,
                "borderColor" => $borderColor,
                "backgroundColor" => $backgroundColor,
                "backgroundOpacity" => $backgroundOpacity,
                "textColor" => $textColor,
                "bolum" => $bolum,
                "tagmountId" => $tagmountId,
            ));
            $showsc = $db->prepare("UPDATE  showsclicks SET
            
            CAMPAING_NAME= :campaign,
            TOTAL_IMPRESSION= :daily,
            CPM_PRICE= :price,
            THIRD_PARTY_PIXEL= :third,
            THIRD_PARTY_PIXEL2= :third2
            WHERE POINTER_ID= :tagmountId
            
            ");
        $insert1 = $showsc->execute(array(
            "tagmountId" => $tagmountId,
            "campaign" => $campaign,
            "daily" => $daily,
            "price" => $price,
            "third" => $third,
            "third2" => $third2,
            
        ));

            if ($insert1) {
                echo  "ok";
               

            } else {
                echo "tagmountError";
            }
        }
    }
}

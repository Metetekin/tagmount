var adSettingsButtonControl = false;
$('#adSettingsCheckbox').click(function () {
    if (adSettingsButtonControl == true) {
        $('#adSettingsDiv').slideUp("fast");
        adSettingsButtonControl = false;
    }
    else {
        $('#adSettingsDiv').slideDown("fast");
        adSettingsButtonControl = true;
    }
});
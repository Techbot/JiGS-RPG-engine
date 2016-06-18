
jQuery( document ).ready(function() {
    getData();
    getData2();
});

function getData() {
    jQuery.getJSON("example.json", function(messagesObj) {
        messageToPrint = messagesObj.messages[0].message1;
        console.log(messageToPrint);
    });
}

function uiOverlay() {
    console.log("uiOverlay");
    jQuery("#startScreen").append("<div class='message'>" +messageToPrint+ "</div>");
}

/*
function getData2() {
    jQuery.getJSON("exampleObj.json", function(messagesObj2) {
        messageToPrint2 = messagesObj2.messages[0];
        console.log(messageToPrint2);
    });
}
*/

function getData2() {
    jQuery.ajax({
        url: "/index.php?option=com_battle&task=action&action=get_free_seed&format=raw",
        success: function (result) {
            // Lisa - using .replace method to remove double quotes from php message string
            console.log(result.replace(/\"/g, ""));
            messageToPrint2 = result.replace(/\"/g, "");
        }
    });
}

function uiOverlay2(messageToPrint2) {
    console.log("uiOverlay2");
    jQuery("#ui-overlay").append("<div class='message'>" +messageToPrint2+ "</div>");
}

function removeOverlay() {
    jQuery("#startScreen").hide();
}
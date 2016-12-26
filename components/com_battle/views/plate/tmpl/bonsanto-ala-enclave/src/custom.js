jQuery( document ).ready(function() {
    getData();
    getData2();
    //getChapter();
    getConspiracy();
});


function getChapter() {
    // round down to nearest integer and range is 3, as we only have 3 paragraphs
    var x = Math.floor((Math.random() * 2));
    console.log(x);
    jQuery.getJSON("chapterOne.json", function (chapterObj) {
        chapterToPrint = chapterObj.paragraphs[0]['paragraph'+x];
    });
}


function getConspiracy() {
    // round down to nearest integer and range is 3, as we only have 3 paragraphs
    //var x = Math.floor((Math.random() * 2));
    //console.log(x);
    jQuery.getJSON("http://emcradio.com/api/paragraph/conspiracy?_format=api_json", function (conspiracyObj) {
        conspiracyToPrint = conspiracyObj.data[0].attributes.field_conspiracy[0].value;
        //console.dir(conspiracyObj);
    });
}


//function chapterText() {
//    console.log("chapterText");
//    jQuery("#ui-chapter").html("<div class='chapter'>" +chapterToPrint+ "</div>");
//    console.log(chapterToPrint);
//}

function conspiracyText() {
    console.log("conspiracyText");
    jQuery("#ui-chapter").html("<div class='chapter'>" +conspiracyToPrint+ "</div>");
    console.log(conspiracyToPrint);
}


function getData() {
    jQuery.getJSON("example.json", function(messagesObj) {
        messageToPrint = messagesObj.messages[0].message1;
        console.log(messageToPrint);
    });
}


function uiOverlay() {
    console.log("uiOverlay");
    jQuery("#ui-overlay").html("<div class='message'>" +messageToPrint+ "</div>");
}


/*function getData2() {
    jQuery.getJSON("exampleObj.json", function(messagesObj2) {
        messageToPrint2 = messagesObj2.messages[0];
        console.log(messageToPrint2);
    });
}*/

function getData2() {
    jQuery.ajax({
        url: "/index.php?option=com_battle&task=seed_action&action=get_free_seed&format=raw",
        success: function (result) {
            // Lisa - using .replace method to remove double quotes from php message string
            console.log(result.replace(/\"/g, ""));
            messageToPrint2 = result.replace(/\"/g, "");
        }
    });
}

function uiOverlay2() {
    console.log("uiOverlay2");
    jQuery("#ui-overlay").html("<div class='message'>" +messageToPrint2+ "</div>");
}


function removeOverlay() {
    jQuery(".message").hide();
}


function removeChapter() {
    jQuery(".chapter").hide();
}
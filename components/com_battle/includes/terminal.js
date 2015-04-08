/**
 * Created by techbot on 26/03/15.
 */

var command_pre='';
var txt ='';
var location1 = 1;
var position = 0;

//http://liquidslider.com/documentation/
jQuery(function() {

    $( "#enter" ).click(function() {
        var id =1;
        var command = document.getElementById('commandLine').value;
        var command_post = jQuery.trim(command.replace(command_pre, ''));

        jQuery.ajax({
            url: "/index.php?option=com_battle&format=raw&task=terminal_action&action=" + command_pre + "&id=" + command_post,
            context: document.body,
            dataType: "json"
        }).done(function(result) {
            txt =[];
            for (var k in result){
                txt[txt.length] =k + " : " + result[k];
                //console.log(txt);
             }
            txt.forEach(function (item){
                scroll(0,item);

            });
        });
        location1 = 1;
    });
});

function enter(txt){
    document.getElementById('commandLine').value = txt;
    command_pre = txt;

}

// Original: Pun Man Kit mkpunnl@netvigator.com
function scroll(position,text) {

    var out = '';
    var sc = document.getElementById('scroller'+location1);
    for (var i=0; i < position; i++){
        out += text.charAt(i);
    }
    out += text.charAt(position);
    sc.innerHTML = out;
    position++;
    if (position != text.length) {
        window.setTimeout(function() { scroll(position,text); }, 50);
    }
    else
    {
        out = '';
        location1++;
        position = 0;
    }
}

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
            url: "/index.php?option=com_battle&format=raw&task=terminalAction&action=" + command_pre + "&id=" + command_post,
            context: document.body,
            dataType: "json"
        }).done(function(result) {
            /*
             for (var k in result){
             txt[txt.length] =k + " : " + result[k];
             //console.log(txt);
             }
             */
            content = ['|---------------------------------------------------------|',
                '|---------- Id : ' + result["id"] + ' Grid : ' + result["grid"] + '     ---|',
                '|---Open Port  : ' + result["open_port"] + ' Closed Port : ' + result["closed_port"] + '     ---|',
                '|---  Comment  : ' + result["comment"] + ' ---------|',
            ];

            line = '';
            index = 0;
            console.log(content);
            nextLine();
            $i = 0;
            for(line in  content){
            var summary = game.add.bitmapText(100, 300,
            {
                font: "18pt Courier",
                fill: "#19cb65",
                stroke: "#119f4e",
                strokeThickness: 2
            },
            content[$i++],
            64)
            ;

            summary.anchor.x = 0.5;
            summary.anchor.y = 0.5;
        }

          //  txt.forEach(function (item){
       //         scroll(0,item);
      //      });
        });

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

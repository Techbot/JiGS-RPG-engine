//http://liquidslider.com/documentation/
jQuery(function() {
  loadUp();
});

function success2(){

    buy_building();
    window.id1                      = [];
    window.metal_name_1             = [];
    window.metal_name_2             = [];
    window.current_object_quantity  = [];
    window.mystock1                 = 0;
    window.mystock2                 = 0;
    window.q_1                      = [];
    window.q_2                      = [];
    window.metals                   = [];
    var refTab                      = document.getElementById("stats");
    var row                         = refTab.rows[0];
    var col                         = row.cells[1];
    // alert(col.firstChild.nodeValue);
    // var  col =   refTab.rows[1].cells[1];
    // alert(col.firstChild.nodeValue);
    building_id                     = col.firstChild.nodeValue;
    var row                         = refTab.rows[3];
    var col                         = row.cells[1];
    //alert(col.firstChild.nodeValue);
    //var  col =   refTab.rows[1].cells[1];
    //alert(col.firstChild.nodeValue);
    window.building_type            = col.firstChild.nodeValue;

    request_batteries_cp();
    //request_batteries.periodical(50085);
    control_panel_system();
    set_type();
    setup_hobbits();
}

//////////////////////////////////////////////////////////////////////////
function changeDisplayImage()
{
    //var id1   = new Array();
    //var metal_name_1  = new Array();
    //var metal_name_2  = new Array();
    var object_quantity = new Array();
    //var mystock1 = 0;
    //var mystock2 = 0;
    var q_1 = new Array();
    var q_2 = new Array();
    var i   = 0;
    index                           = window.id1[document.adminForm.blueprints.value];

    // console.log(document.adminForm.blueprints.value);

    Array.each(metals, function( )
    {
        if (window.metals[i].name == window.metal_name_1[index])
        {
            //window.mystock1 = window.metals[i].quantity;
        window.mystock = object_quantity[index];
        }
        if (window.metals[i].name == window.metal_name_2[index])
        {
            window.mystock2 = window.metals[i].quantity;
        }
        i++;
    });
    if (document.adminForm.blueprints.value !='')
    {
        index                           = id1[document.adminForm.blueprints.value];
        document.adminForm.id1.value    = window.id1[index];
        document.adminForm.q1.value     = window.q_1[index];
        document.adminForm.n1.value     = window.metal_name_1[index];
        document.adminForm.q2.value     = window.q_2[index];
        document.adminForm.n2.value     = window.window.metal_name_2[index]  ;
        //document.adminForm.stock.value  = object_quantity[index];
        //document.adminForm.stock.value  = 7;
        i                               = 0;
        Array.each(metals, function( )
        {
            if (window.metals[i].name == window.metal_name_1[index])
            {
                // window.mystock = metals[i].quantity;
                // window.mystock = object_quantity[index];
                document.adminForm.stock.value = window.current_object_quantity[index];
                console.log (window.current_object_quantity[index]);
            }
            if (window.metals[i].name == window.metal_name_2[index])
            {
                window.mystock2 = metals[i].quantity;
            }
            i++;
        });
            // document.adminForm.stock2.value = mystock2;

        if (window.building_type=="factory")
        {
            check_stock_control();
        }
        else if(window.building_type=="reprocessor")
        {
            check_inventory();
        }
    }
    else
    {
            document.adminForm.imagelib.src='images/blank.png';
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////
function change()
{
    i=0;
    index           = window.id1[document.adminForm.blueprints.value];
    Array.each(window.metals, function( )
    {
        if (window.metals[i].name == window.metal_name_1[index])
        {
            window.mystock1 = window.metals[i].quantity;
        }
        if (window.metals[i].name == window.metal_name_2[index])
        {
            window.mystock2 = window.metals[i].quantity;
        }
        i++;
    });

    if (document.adminForm.blueprints.value !='')
    {
        index   = window.id1[document.adminForm.blueprints.value];

        //document.adminForm.id1.value  = window.id1[index];
            document.adminForm.id1.value    = window.id1[index];
            //document.adminForm.id1.value  = 2;
            document.adminForm.q1.value     = window.q_1[index];
            document.adminForm.n1.value     = window.metal_name_1[index];
            document.adminForm.q2.value     = window.q_2[index];
            document.adminForm.n2.value     = window.metal_name_2[index]  ;
        i = 0;
        Array.each(metals, function( )
        {
            if (metals[i].name == metal_name_1[index]) {
                window.mystock1 = metals[i].quantity;
                }
            if (metals[i].name == metal_name_2[index]) {
                window.mystock2 = metals[i].quantity;
                }
            i++;
        });
        document.adminForm.stock.value = window.mystock1;
        document.adminForm.stock2.value = window.mystock2;
        check_stock_control();
    }
    else
    {
        document.adminForm.imagelib.src='images/blank.png';
    }
}

function buy_building()
{
    $$('.buy').addEvent('click', function()
    {
        var a = new Request.JSON({
            url: "index.php?option=com_battle&format=raw&task=action&action=buy&buy=building&building_id="
            + building_id ,
                onSuccess: function()
                {
                    document.id('building_id').setStyle('visibility','hidden');
                }
        }).get();
    });
} 

function set_type()
{
    if (window.building_type=="papier")
    {
        get_shop_papers();
        get_papers();
    }
    
    if (window.building_type=="mine")
    {
        dig();
        check_mine();
        check_mine.periodical(15000);
    }
    if (window.building_type=="blueprints")
    {
        get_my_blueprints();
        get_shop_blueprints();
    }
    if (window.building_type=="apartment")
    {
        $$('.work_flat').addEvent('click', function(){
        var itemID = this.get('id');
        work_flat(itemID);
        });
    }
    if (window.building_type=="farm")
    {
        document.id('1').addEvent('click',function()
        {
            var itemID = this.get('id');
            work_field(itemID);

        });
        collectEmpties();
        check_farm.periodical(15000);

    }

    if (window.building_type=="reprocessor")
    {
        request_metals();
        prepare();
        prepare2();
        work_reprocessor();
        get_blueprints()
        check_reprocessor();

        if ( $('reprocessor').css('display') != 'none' ){

            check_reprocessor.periodical(5000);   // element is hidden

        }


        request_metals();
        //change();
    }

    if (window.building_type=="factory")
    {
        prepare();
        prepare2();
        work_conveyer();
        get_blueprints();
        check_factory();
        check_factory.periodical(15000);
        request_metals();
    }

    if (window.building_type=="scrapyard")
    {
        request_shop_metals();
        // request_metals2();
        // request_metals2.periodical(10000);
        request_get_metals_to_sell();
       // request_get_metals_to_sell();
    }

    if (window.building_type=="food")
    {
        document.id('sell_crops').addEvent('click', function()
        {
         // var itemID = this.get('id');
          sell_crops();
        });
       // get_papers.periodical(1000);
       // get_shop_papers.periodical(1000);
    }

    if (window.building_type=="stand")
    {
        request_shop_inventory();
        request_inventory();
    }

    if (window.building_type=="generator")
    {
        request_batteries();
       // request_batteries.periodical(5085);
        request_battery_slots();
     //   request_battery_slots.periodical(5000);
    }
    
    if (window.building_type=="batteryshop")
    {
        request_batteries();
     //   request_batteries.periodical(5085);
        request_battery_slots();
    //    request_battery_slots.periodical(5000);
    }
 
    if (window.building_type=="bank")
    {
        deposit();
        withdraw();
        get_account_list();

    }
 
    if (window.building_type=="bullet")
    {
       
        buy_bullets();
    } 
 
     if (window.building_type=="diner")
    {
        //SAMPLE 4 (walk to item)
        /*var nS4 = new noobSlide({
            box: document.id('box4'),
            items: $$('#box4 div'),
            size: 640,
            handles: $$('#handles4 span'),
            onWalk: function(currentItem,currentHandle){
                // $('info4').set('html',currentItem.getFirst().innerHTML);
                this.handles.removeClass('active');
                currentHandle.addClass('active');
            }
        });*/

        document.id('eat_burger').addEvent('click', function()
        {
            var itemID = this.get('id');
            eat(itemID);
        });
 
    }
    
    if (window.building_type=="weapons")
    {   
            request_shop_weapons();
            //request_weapons2()
            request_weapons();	
            
    }
}

/////////////////////////////////////////////////////////////////////////////////////////////
function control_panel_system()
{
    $$('.b_button').addEvent('click', function()
    {
        var itemID = this.get('id');
        switch(itemID)
        {
            case 'primary':
                $$('.panel').set('styles',{visibility:'hidden'});
                document.id('first_panel').set('styles',{visibility:'visible'});
                $$('.b_button').set('class','b_button inactive');
                document.id('primary').set('class', 'b_button active');
                break;
            case 'defence':
                $$('.panel').set('styles',{visibility: 'hidden'});
                document.id('second_panel').set('styles',{visibility: 'visible'});
                $$('.b_button').set('class','b_button inactive');
                document.id('defence').set('class', 'b_button active');
                break;
            case 'distr':
                $$('.panel').set('styles',{visibility:'hidden'});
                document.id('third_panel').set('styles',{visibility:'visible'});
                $$('.b_button').set('class','b_button inactive');
                document.id('distr').set('class','b_button active');
                break;
            case 'hr':
                $$('.panel').set('styles',{visibility:'hidden'});
                document.id('fourth_panel').set('styles',{visibility:'visible'});
                $$('.b_button').set('class', 'b_button inactive');
                document.id('hr').set('class', 'b_button active');
                break;
             case 'energy':
                $$('.panel').set('styles',{visibility:'hidden'});
                document.id('fifth_panel').set('styles',{visibility:'visible'});
                $$('.b_button').set('class','b_button inactive');
                document.id('energy').set('class','b_button active');
                break;
            default:
                $$('panel').set('styles',{visibility:'hidden'});
                $$('.b_button').set('class','b_button inactive');
        }
    });
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////	 

function prepare()
    {

    var foo = document.id('quantity_box_button_up'); 

    // if it returns an Element object, it will be truthy.
    if (foo) {

        document.id('quantity_box_button_up').addEvent('click', function(){
            increment();
            });
        }
}

function prepare2()
{
    var foo = document.id('quantity_box_button_up'); 
    if (foo) {
    document.id('quantity_box_button_down').addEvent('click', function(){
        decrement();
        });
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function increment()
{
    var qty_el                      = document.getElementById('quantity_adjust');
    var qty                         = qty_el.value;
    if( !isNaN( qty )) qty_el.value++;

    var cost_el	                    = document.getElementById('q1');
    var cost                        = cost_el.value;
    var cost_el_2                   = document.getElementById('q2');
    var cost_2                      = cost_el_2.value;
    var time                        = 1;
    document.adminForm.q1t.value    = (cost * (parseInt(qty) + 1));
    document.adminForm.q2t.value    = (cost_2 * (parseInt(qty) + 1));
    document.adminForm.time.value   = (time * (parseInt(qty) + 1));
    if (window.building_type=="factory")
    {
   
        check_stock_control();
   }
   else if(window.building_type=="reprocessor"){
        check_inventory();
  }

    return false;
}

function decrement()
{
    var qty_el                          = document.getElementById('quantity_adjust');
    var qty                             = qty_el.value ;
    if( !isNaN( qty ) && qty > 0 ) qty_el.value--;
    var cost_el                         = document.getElementById('q1');
    var cost                            = cost_el.value;
    var cost_el_2                       = document.getElementById('q2');
    var cost_2                          = cost_el_2.value;
    var time                            = 1;
    document.adminForm.q1t.value        = cost * (qty-1);
    document.adminForm.q2t.value        = cost_2 * (qty-1);
    document.adminForm.time.value       = (time * (parseInt(qty) - 1));
    if (window.building_type=="factory")
    {
        check_stock_control();
    }
    else if(window.building_type=="reprocessor")
    {
        check_inventory();
    }

    return false;
}

function work_reprocessor()
{
    var foo = document.id('submit_c'); 
    if (foo)
    {
        document.id('submit_c').addEvent('click', function()
        {
            reprocess();
        });
    }
}

function get_account_list(){
    jQuery.ajax({
        url: "/index.php?option=com_battle&format=json&task=bankAction&action=get_account_list&bank_id=" +building_id,
        context: document.body,
        dataType: "json"
    }).done(function(result) {
        var text ;
        text  = "<table id ='accountList'>";
        text += " <tr><th>Name</th><th>Sec Level</th><th>Action</th></tr>";
        for (var i = 0; i<result.length; i++){
          text += "<tr><td>" + result[i].name + "</td><td>" + result[i].bank_sec_level
          + "</td><td><span id= '" + result[i].id + "' class='remove button btn btn-danger hack'>H</span><span id='" + result[i].id + "' class='assign button btn btn-success assist'>A</span>"
          + "</td></tr>";
       }
        text += "</table>";
        document.getElementById("account_list").innerHTML = text;

        add_hack_links();
        add_assist_links();
    });
}

function add_hack_links(){
    jQuery( ".hack" ).click(function(){

       var itemId= jQuery(this).attr('id');

        jQuery.ajax({
            url: "/index.php?option=com_battle&format=json&task=bankAction&action=hack_player_account&bank_id=" + building_id + "&playerid=" + itemId,
            context: document.body,
            dataType: "json"
        }).done(function(result) {
            var text ;
            text  = "<table id ='accountList'>";
            text += " <tr><td>Name</td><td>Sec Level</td><td>Action</span></td></tr>";
            for (var i = 0; i<result.length; i++){
                text += "<tr><td>" + result[i].name + "</td><td>" + result[i].bank_sec_level
                + "</td><td><span id= '" + result[i].id + "' class='remove button btn btn-danger hack'>H</span><span id= '" + result[i].id + "' class='assign button btn btn-success assist'>A</span>"
                + "</td></tr>";
            }
            text += "</table>";
            document.getElementById("account_list").innerHTML = text;
            add_hack_links();
            add_assist_links();
        });
    } );
}

function add_assist_links(){
    jQuery( ".assist" ).click(function(){

        var itemId= jQuery(this).attr('id');

        jQuery.ajax({
            url: "/index.php?option=com_battle&format=json&task=bankAction&action=assist_player_account&bank_id=" + building_id + "&playerid=" + itemId,
            context: document.body,
            dataType: "json"
        }).done(function(result) {
            var text ;
            text  = "<table id ='accountList'>";
            text += " <tr><td>Name</td><td>Sec Level</td><td>Action</span></td></tr>";
            for (var i = 0; i<result.length; i++){
                text += "<tr><td>" + result[i].name + "</td><td>" + result[i].bank_sec_level
                + "</td><td><span id= '" + result[i].id + "' class='remove button btn btn-danger hack'>H</span><span id= '" + result[i].id + "' class='assign button btn btn-success assist'>A</span>"
                + "</td></tr>";
            }
            text += "</table>";
            document.getElementById("account_list").innerHTML = text;
            add_hack_links();
            add_assist_links();
        });
    } );
}

function reprocess(){
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=buildingAction&action=work_reprocessor&quantity="
        + document.adminForm.time.value
        + "&building_id=" + building_id + "&line=1&type=" + document.adminForm.id1.value  ,
        onSuccess: function(result)
        {
            if(result['success']==1)
            {
                alert (result['message']);
                document.id('adminForm').setStyle('display','none');
                document.id('conveyor_progress').setStyle('display','block');
                document.id('conveyor_progress').setStyle('visibility','visible');
            }
            else
            {
                alert (result['message']);
            }
        }
    }).get();
}

function check_reprocessor()
{
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=buildingAction&action=check_reprocessor&line=1&building="
        + building_id ,
        onSuccess: function(result)
        {
            document.getElementById('since').innerHTML      = result['since'];
            document.getElementById('now').innerHTML        = result['now'];
            document.getElementById('elapsed').innerHTML    = result['elapsed'];
            document.getElementById('remaining').innerHTML  = result['remaining'];
            if (result['remaining'] <= 0)
            {
                    document.id('adminForm').setStyle('display','block');
                document.id('conveyor_progress').setStyle('display','none');
            }
         }
    }).get();
}

function buy_weapon(itemID)
{
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=action&action=buy&buy=weapon&building_id=" 
        + building_id + "&item=" + itemID, 
        onSuccess: function(result)
        {
            request_shop_weapons();
            request_weapons();
          //  request_weapons.periodical(1000);

        }
    }).get();
}

function sell_weapon(itemID)
{
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=action&action=sell&sell=weapon&building_id=" 
        + building_id 
        + "&item=" 
        + itemID, 
        onSuccess: function(result)
        {
            request_shop_weapons();
            request_weapons();
          //  request_weapons.periodical(1000);	
        }
    }).get();
}
  
function request_shop_weapons()
{
    var all = '';
    var details = this.details;
    // var id = $('image').get('number');
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=action&action=get_shop_weapons&building_id=" 
        + building_id , 
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
                var row = "<div class='row'><span>" 
                + (i+1) + ": " 
                + result[i].name 
                + ":</span><span class='price'>$" 
                + result[i].sell_price 
                + "</span><a href='#' class='buy' id='" 
                + result[i].item_id 
                + "'>BUY</a></div>";
                all= all + row;  
            }
            id=0;
            all= all + '';
            document.id('building_inventory_table').innerHTML = all;
            $$('.buy').addEvent('click', function()
            {
                var itemID = this.get('id');
                buy_weapon(itemID);
             });
        }	
    }).get();
}

function request_weapons()
{
    var price = 0 ;
    var all = '';
    var details = this.details;
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=action&action=get_weapons&building_id=" 
        + building_id , 
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
                price = result[i].sell_price / 2 ;
                var row = "<div class='row'><span>" 
                +result[i].name
                + "</span><span class='price'>COST:" 
                +  price 
                + "</span><a href='#' class= 'sell' id='"
                + result[i].item_id
                + "'>SELL</a></div>";
                all= all + row;
            }
            all= all + '';
            document.id('my_inventory').innerHTML = all;
            $$('.sell').addEvent('click', function()
            {
                var itemID = this.get('id');
                sell_weapon(itemID);
            });
        }
    }).get();
}

function request_weapons2()
{
    var all = '<table class="shade-table"><tbody>';
    var details = this.details;
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=action&action=get_weapons2&building_id="
        + building_id, 
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
                var row = "<tr class=\"d" 
                + (i & 1) + "\"><td>" 
                +result[i].name 
                + " </td></tr>";
                all= all + row;
            }
            all= all + '</tbody></table>';
            document.id('my_inventory2').innerHTML = all;
        }
    }).get();
}

function insert(id)
{
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&building_id=" 
        + building_id + "&task=action&action=swap_battery&id="
        +id, 
        onSuccess: function(result)
        {
            request_batteries_cp();

            document.id('t_energy').innerHTML = result;

        }	

    }).get();
}

function collectEmpties()
{
    document.id('collect_empties').addEvent('click',function()
    {
       var itemID = this.get('id');
       
       var a = new Request.JSON(
        {
            url: "index.php?option=com_battle&format=raw&task=buildingAction&action=collect_empties&building_id="
            + building_id , 
            onSuccess: function(result)
            {
               request_batteries_cp();
            }
        }).get();
    });
}

function request_batteries_cp()
{
    var all = '';
//	var details = this.details;
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=action&action=get_batteries", 
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
                var row = "<span class=\"label\">Battery " + (i+1) + ":</span>"
                + result[i][1]  + " : " + result[i][2]
                + "<a href='#' onclick='insert(" 
                + result[i][0] +")'> [insert] </a> ";
            
                all= all + row + "<br/>";  
            }
            document.id('batteries').innerHTML = all;
        }
    }).get();
}

function request_buildings_batteries_cp()
{
    var all = '';
//	var details = this.details;
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=action&action=get_building_batteries&building=" + building_id , 
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
                var row = "<span class=\"label\">Battery " + (i+1) + ":</span>"
                + result[i][1]  + " : " + result[i][2]
                + "<a href='#' onclick='insert(" 
                + result[i][0] +")'> [insert] </a> ";
            
                all= all + row + "<br/>";  
            }
            document.id('batteries').innerHTML = all;
        }
    }).get();
}
///////////////////////////////////////////////////////////////
function request_shop_metals()
{
    var all     = '';
    var details = this.details;
    //	var id = $('image').get('number');
    var a       = new Request.JSON({
        url: "index.php?option=com_battle&format=raw&task=action&action=get_shop_metals&building_id="
        + building_id ,
    onSuccess: function(result){

    for (i = 0; i < result.length; ++ i)
    {

        var row = "<div class='row'><span>" 
        + (i+1) + ": " 
        + result[i].name
        + ":</span><span class='price'>$"
        + result[i].sell_price 
        + "</span><a href='#' class='buy' id='"
        + result[i].item_id 
        + "'>BUY</a></div>";
        all= all + row;
        }
        id=0;
        all= all + '';
        document.id('building_inventory_table').innerHTML = all;
        $$('.buy').addEvent('click', function(){
            var itemID = this.get('id');
            buy_metal(itemID);
            });
        }
    }).get();
}

function request_get_metals_to_sell(){
    var all = '';
    var details = this.details;
    var a = new Request.JSON({
        url: "index.php?option=com_battle&format=raw&task=action&action=get_metals_to_sell&building_id="
        + building_id ,
        onSuccess: function(result){
            for (var i = 0; i < result.length; ++ i)
            {
                var row = "<div class='row'><span>"
                +result[i].name
                + "</span><span class='price'>COST:"
                + result[i].buy_price 
                + "</span><a href='#' class= 'sell' id='" + result[i].item_id
                + "' >SELL</a></div>"; 
                all= all + row;
                }
                all= all + '';
                document.id('my_inventory').innerHTML = all;
                $$('.sell').addEvent('click', function(){
                    var itemID = this.get('id');
                    sell_metal(itemID);
                    });
                }
    }).get();
    }

function request_metals2()
{
    var total_metals    = parseInt(0);
    var all             = '';
    //var all = '<table class="shade-table"><tbody>';
    var details         = this.details;
    var a               = new Request.JSON(
    {
        url: 'index.php?option=com_battle&format=raw&task=action&action=get_metals2&building_id='
        + building_id ,
        onSuccess: function(result)
        {
             for (i = 0; i < result.length; ++i)
             {
                 var row = '<br/>Metal ' + (i+1) + ':' + result[i].name  + ' : ' + result[i].quantity;
                 all= all + row;
                 total_metals = parseInt(total_metals) + parseInt(result[i].quantity);
             }
             all = all + '<br/>Total Metals: ' + total_metals;
             document.id('my_inventory2').innerHTML = all;
        }
      }).get();
}

function buy_metal(itemID){
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=buy&buy=metal&building_id=" 
    + building_id + "&metal=" + itemID, 
    onSuccess: function(result){
        }
    }).get();
}

function sell_metal(itemID){
 
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=sell&sell=metal&building_id=" 
    + building_id + "&item=" + itemID, 
    onSuccess: function(result){
        }
    }).get();
}

function eat(itemID)
{
    var a = new Request.JSON({
        url: "index.php?option=com_battle&format=raw&task=action&action=eat",
        onSuccess: function(result){
            if (result=="success"){
                    alert("You gained 10 health points which cost you 10 credits");
                    document.id('eat_burger').setStyle('display','none');
                    }
            if (result=="broke"){
                    alert("You don't have enough money. Get out of here! Go get a job you waster!");
                    document.id('eat_burger').setStyle('display','none');
                    }
        }
    }).get();
}

function display_alert_deposit()
{
  alert("Thank you for the deposit.\nYour money is safe with us.");
}
  
function display_alert_withdraw()
{
  alert("Thank you for your valued custom.\nWe hope to see you again soon.");
}

function deposit()
{

    $$('#deposit').addEvent('click', function(){

        var qty_el = document.getElementById('quantity_adjust');
        var qty = qty_el.value;
        var a = new Request.JSON({
                url: "index.php?option=com_battle&format=raw&task=action&action=deposit&building_id="
                + building_id + "&amount=" + qty  ,
                onSuccess: function(result){
               // $(result[0]).innerHTML = result[1];
               // $(result[2]).innerHTML = result[3];
              //  $(deposit).setStyle('visibility','hidden');
                    }
                }).get();
        });
}

function withdraw()
{

    $$('#withdraw').addEvent('click', function()
    {
            var qty_el = document.getElementById('quantity_adjust2');
            var qty = qty_el.value;
            var a = new Request.JSON({
                    url: "index.php?option=com_battle&format=raw&task=action&action=withdraw&building_id="
                    + building_id
                    + "&amount="
                    + qty  ,
                    onSuccess: function(result){

                   // $(result[0]).innerHTML = result[1];
                   // $(result[2]).innerHTML = result[3];
                  //  $(deposit).setStyle('visibility','hidden');

                        }
                    }).get();
      });	
}	




function buy_bullets()
{

    $$('#buy_bullets').addEvent('click', function()
    {
            var qty_el = document.getElementById('quantity_adjust');
            var qty = qty_el.value;
            var a = new Request.JSON({
                    url: "index.php?option=com_battle&format=raw&task=action&action=buy&buy=bullets&building_id="
                    + building_id
                    + "&amount="
                    + qty  ,
                    onSuccess: function(result){
                   // $(result[0]).innerHTML = result[1];
                   // $(result[2]).innerHTML = result[3];
                  //  $(deposit).setStyle('visibility','hidden');
                        }
                    }).get();
      });	
}

function request_batteries()
{
     var all = '';
    //	var details = this.details;
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=action&action=get_batteries", 
        onSuccess: function(result)
        {

            for (i = 0; i < result.length; ++ i)
            {
                var row = "<div class='put' id='" 
                + result[i][0] + "'><span class='label'>Battery " 
                + (i+1) + ":</span>" 
                + result[i][1]  + " : " 
                + result[i][2]+ "</div>";
          
                all= all + row;  
            }
            document.id('generator').innerHTML = all;	

            $$('.put').addEvent('click', function()
            {
                    var itemID = this.get('id');
                    put_battery(itemID);
            });
        }	
    }).get();
}

function request_battery_slots()
{
    var all = '';
    //	var details = this.details;
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=buildingAction&action=get_battery_slots&building_id="
        + building_id , 
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
                var row = "<div class='get' id='"
                + result[i]['id'] + "'><span class=\"label\">Battery "
                + (i+1)
                + ":</span>"
                + result[i]['id']  + " : "
                + result[i]['units'] +"</div>";
                all= all + row ;
        }
        document.id('batteries_inv').innerHTML = all;

    $$('.get').addEvent('click', function(){
            var itemID = this.get('id');
            get_battery(itemID);
            });
    }	
    }).get();
}

function get_battery(itemID){
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=buildingAction&action=get_battery&building_id="
    + building_id + "&item=" + itemID, 
    onSuccess: function(result){
    
            request_battery_slots();
            request_batteries();
        }

    }).get();
 
}

function put_battery(itemID){
 
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=buildingAction&action=put_battery&building_id="
    + building_id + "&item=" + itemID, 
    onSuccess: function(result){
   
                request_batteries();
                request_battery_slots();
        }
    }).get();
 
}

///////////////////////////////////////////////////////////////////////////////
//                                                                           //
//      itemID='assign_defense' or 'assign_primary' or 'assign_dist'         //
//                                                                           //
//                                                                           //
///////////////////////////////////////////////////////////////////////////////
function setup_hobbits(){

    $$('.assign').addEvent('click', function(){
        var itemID = this.get('id');
        put_hobbit(itemID);
    });

    $$('.remove').addEvent('click', function(){
        var itemID = this.get('id');
        get_hobbit(itemID);
    });
};

function get_hobbit(itemID){
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=buildingAction&action=get_hobbit&building_id="
    + building_id + "&itemid=" + itemID, 
    onSuccess: function(result){


    if (itemID=="remove_primary"){
        itemID="assign_primary"
    }
    if (itemID=="remove_defence"){
        itemID="assign_defence"
    }
    if (itemID=="remove_distribution"){
        itemID="assign_distribution"
    }
        document.id(itemID +'_cp').innerHTML = result;
        document.id(itemID+'_data').innerHTML = result;
        }
    }).get();
}

function put_hobbit(itemID){
 
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=buildingAction&action=put_hobbit&building_id="
    + building_id + "&itemid=" + itemID, 
    onSuccess: function(result){


        document.id(itemID +'_cp').innerHTML = result;
        document.id(itemID+'_data').innerHTML = result;
}
    }).get();
}
///////////////////////////////////////////////////////////////////////////////

function get_shop_papers(){

    var all = '';
    var details = this.details;
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=buildingAction&action=get_shop_papers&building_id="
        + building_id,
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
                var row = "<div class='row'><span>"
                + (i+1)
                + ": "
                + result[i].name
                + ":</span><span class='price'>$"
                + result[i].sell_price
                + "</span><a href='#' class='buy' id='"
                + result[i].item_id
                + "'>BUY</a></div>";
                all= all + row;
            }
            all= all + '';
            document.id('building_papers_table').innerHTML = all;
            $$('.buy').addEvent('click', function()
            {
                var itemID = this.get('id');
                buy_papers(itemID);
            });
        }
   }).get();
}

function get_papers(){
    var all      = '';
    var details  = this.details;
    var a        = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=buildingAction&action=get_papers",
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
                var row = "<div class='row'><span>"
                + (i+1) + ":"
                + result[i].name
                + "</span><span class='price'>COST:"
                + result[i].buy_price
                + "</span><a href='#' class= 'sell' id='"
                + result[i].item_id
                + "' >SELL</a></div>";
                all= all + row;
            }
            all = all + '';
            document.id('my_papers').innerHTML = all;
            $$('.sell').addEvent('click', function()
            {
                var itemID = this.get('id');
                sell_papers(itemID);
            });
        }
   }).get();
}

function buy_papers(itemID)
{
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=action&action=buy_papers&building_id="
        + building_id + "&item=" + itemID,
        onSuccess: function(result)
        {

        }
    }).get();
 
}

function sell_papers(itemID){
 
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=sell&sell=papers&building_id=" 
    + building_id + "&item=" + itemID, 
    onSuccess: function(result){

        }
    }).get();
 
}

function sell_crops(){
 
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=sell&sell=crops", 
    onSuccess: function(result){
        document.id('sell_crops').setStyle('display','none');
        }
    }).get();
 
}

function work_field(itemID)
{	 	
      //Magic_index                = document.adminForm.Magic_Index.value;
      Crop_index               = document.adminForm.crops.value;
      //Skill_index                 = document.adminForm.Skill_Index.value;
      hobbits_index                   = document.adminForm.hobbits_total.value ; 
    
    //alert (hobbits_index);
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=buildingAction&action=work_field&building_id="
    + building_id + "&crop=" + Crop_index + "&field=" + itemID +"&wf=" + hobbits_index ,
    onSuccess: function(result){
        //new tmp element that contains the new div
        var tmpDiv = new Element('div',
        {
            html:'<div id="' + itemID + '" class="work_field" style="text-align:center;"> <img src ="components/com_battle/images/5.gif"/></div>'
        }
        );
        //new div (first child of my tmp div) replaces the old 'myDiv' (that can be grabbed from the DOM by $)
        tmpDiv.getFirst().replaces(document.id(itemID));
        document.id('farm_progress_'+itemID).setStyle('display','block');
        document.id('farm_controls_'+itemID).setStyle('display','none');
        }
    }).get();
    
}

 
function check_farm(){
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=buildingAction&action=check_farm&field=1&building="
    + building_id ,
    onSuccess: function(result){
     
        itemID = result['field'];
        status = result['status'];
        document.getElementById('since').innerHTML = result['since'];
        document.getElementById('now').innerHTML = result['now'];
        document.getElementById('elapsed').innerHTML = result['elapsed'];
        document.getElementById('remaining').innerHTML = result['remaining'];
        document.getElementById('message_text_'+itemID).innerHTML = result['status_message'];
       
        text = '<img src = "components/com_battle/images/' + result["status"] + '.gif">';
        document.getElementById(itemID).innerHTML = text;

        if (result['remaining'] <= 0 )
        {
                   // $('adminForm').setStyle('visibility','visible');
 
                    document.id('farm_progress_'+ itemID).setStyle('display','none');
                    document.id('farm_controls_'+ itemID).setStyle('display','block');
      
                   // string_text = 'status_message_'+ itemID;
    
                    //document.id(string_text).setStyle('visibility','visible');

                 /*
                 
                    var tmpDiv = new Element('div',
                    {html:'<div>', '<div ="' + itemID + '" class= ="work_field"><img src ="components/com_battle/images/'
                    +result['status'] +'.gif" /></div>'});
                    tmpDiv.getFirst().replaces(document.id(itemID));
                    */

                    $$('.work_field').removeEvent('click', test);

                    $$('.work_field').addEvent('click',function(){
                    
                    work_field(itemID);
                    });
             }
             else{
            
                    document.id('farm_progress_'+ itemID).setStyle('display','block');
                    document.id('farm_controls_'+ itemID).setStyle('display','none');
             }
         }
    }).get();
}

function work_flat(itemID){	 	
    var a = new Request.JSON({
        url: "index.php?option=com_battle&format=raw&task=buildingAction&action=work_flat&building_id="
        + building_id + "&flat=" + itemID  ,
        onSuccess: function(result){
    
        if (result[0]=="broke"){
    
        alert(result[0] + '.You need 1000 credits IN THE BANK to rent an apartment. Then you will be safe from attack! 1000 Credits will be withdrawn from your account every week.')
    
        }
        else {
                 alert(result[3]);
                document.id(result[0]).innerHTML = result[1];
                document.id(result[2]).innerHTML = result[3];
                document.id(result[4]).innerHTML = result[5];
                document.id(result[6]).innerHTML = result[7];
        }
    }
    }).get();
}

function get_shop_blueprints(id)
{
    var all		= '<table class="shade-table"><tbody>';
    var details = this.details;
    var a		= new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=action&action=get_shop_blueprints&building_id="
        + building_id,
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
                var row = "<tr class=\"d"
                + (i & 1)
                + "\"><td> Blueprint for "
                + (i+1)
                + ": "
                + result[i].name + ":</td><td>$"
                + result[i].sell_price
                + "<a href='#' class='buy' id='"
                + result[i].object
                + "'>[BUY]</a></td></tr>";
                all = all + row;
            }
            all = all + '</tbody></table>';
            document.id('building_papers_table').innerHTML = all;
            $$('.buy').addEvent('click', function()
            {
                var itemID = this.get('id');
                buy_blueprint(itemID);
            });
        }
    }).get();
}

function get_my_blueprints(){
    var all = '<table class="shade-table"><tbody>';
    //var details = this.details;
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=buildingAction&action=get_my_blueprints_list",
    onSuccess: function(result){
        for (i = 0; i < result.length; ++ i)
        {
            var row = "<tr class=\"d"
            + (i & 1)
            + "\"><td> Blueprint for "
            + result[i].name
            + "</td></tr>";
            all= all + row;
        }
        all                         = all + '</tbody></table>';
        document.id('my_papers').innerHTML    = all;
    }
    }).get();

}

function buy_blueprint(itemID){
 
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=buy&buy=blueprints&building_id=" 
    + building_id + "&item=" 
    + itemID, 
    onSuccess: function(result){

        }
    }).get();
 
}


function get_blueprints()
{

    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=buildingAction&action=get_blueprints&blueprints="
        + document.adminForm.id1.value,
        onSuccess: function(result)
        {
            for(var i=0;i<result.length;i++)
            {
                var row = result[i];
                console.log(row);
                for(var key in row)
                {
                    var attrName						= key;
                    var attrValue						= row[key];
                    var x								= row.id;
                    //console.log(x);
                    //window.id1[x]						= row.id;
                    window.id1[x]						= x ;
                    window.q_1[x]						= row.quantity_1;
                    window.q_2[x]						= row.quantity_2;
                    window.current_object_quantity[x]	= row.current_object_quantity;
                    window.metal_name_1[x]				= row.metal_1_name;
                    window.metal_name_2[x]				= row.metal_2_name;
                }
            }
        }
    }).get();
}

///////////////////////////////

function changeCrops()
{
    i = 0;
    index							= document.adminForm.crops.value;
    

    var h_total_ = parseInt(document.getElementById('wfTotal').innerHTML);
    console.log(h_total_ == ''); // true
    console.log(h_total_ == null); // false

//	var building_id = document.getElementById("building_id").value;




        var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=buildingAction&action=get_crop_index&crop="
        + index,
        onSuccess: function(result)
        {
            document.adminForm.Crop_Index.value = result[0];
            
            Magic_index						= document.adminForm.Magic_Index.value;
            Crop_index						= document.adminForm.Crop_Index.value;
            Skill_index						= document.adminForm.Skill_Index.value; 
            hobbits                         = document.adminForm.hobbits_total.value;
            hobbits_index                   = hobbits * .1;
            
            alert(hobbits_index);
            
            if (hobbits > h_total_){
                document.id('hobbits_total').setStyle('background','red');
            
            }
            else{
            
             document.id('hobbits_total').setStyle('background','black');
            }
            document.adminForm.ETA.value = Magic_index * Crop_index * Skill_index * 50 * (1 - hobbits_index);

        }
    }).get();
}


function work_conveyer()
{
    var foo = document.id('submit_c'); 
    if (foo) 
    {
    document.id('submit_c').addEvent('click', function()
    {
        work();
    });

    }
}

function test_rob()
{
    alert();
}

function work(){
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=buildingAction&action=work_conveyer&quantity="
        + document.adminForm.time.value
        + "&building_id=" + building_id + "&line=1&type=" + document.adminForm.id1.value  ,
        onSuccess: function(result){

            document.id('adminForm').setStyle('display','none');
            document.id('conveyor_progress').setStyle('display','block');

            }
    }).get();
}

function check_factory()
{
        var a = new Request.JSON({
        url: "index.php?option=com_battle&format=raw&task=buildingAction&action=check_factory&line=1&building="
        + building_id ,
        onSuccess: function(result)
        {
            document.getElementById('since').innerHTML      = result['since'];
            document.getElementById('now').innerHTML        = result['now'];
            document.getElementById('elapsed').innerHTML    = result['elapsed'];
            document.getElementById('remaining').innerHTML  = result['remaining'];
            if (result['remaining'] <= 0){
                document.id('adminForm').setStyle('display','block');
                document.id('conveyor_progress').setStyle('display','none');
                }
            }
        }).get();
}


function request_metals(){


    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_metals2", 
    onSuccess: function(result)
    {
        window.metals = result;
    }
    }).get();
}




function check_stock_control(){
//	if whats in stock is less than required total hide submit button and change background to red
//  else change to green and show submit
    var stck = document.getElementById('stock');
    var ct1 = parseInt(stck.value);
    var stck2 = document.getElementById('stock2');
    var ct2 = parseInt(stck2.value);
    var qy1 = document.getElementById('q1t');
    var q_y1 = parseInt(qy1.value);
    var qy2 = document.getElementById('q2t');
    var q_y2 = parseInt(qy2.value);
    if ((ct1 < q_y1) || (ct2 < q_y2))
    {
        document.id('q1t').setStyle('background','red');
        document.id('q2t').setStyle('background','red');
        document.id('submit_c').setStyle('visibility','hidden');
    }
    if((ct1 > q_y1)  && (ct2 > q_y2))
    {
        document.id('q1t').setStyle('background','black');
        document.id('q2t').setStyle('background','black');
        document.id('submit_c').setStyle('visibility','visible');
    }
}


function check_inventory(){
//	if whats in stock is less than required total hide submit button and change background to red
//  else change to green and show submit


        var stck = document.getElementById('stock');
    var ct1 = parseInt(stck.value);



    var stck2 = document.getElementById('quantity_adjust');
    var ct2 = parseInt(stck2.value);


    //var qy1 = document.getElementById('q1t');
    //var q_y1 = parseInt(qy1.value);
    //var qy2 = document.getElementById('q2t');
    //var q_y2 = parseInt(qy2.value);
    if ((ct1 < ct2 ))
    {
        document.id('stock').setStyle('background','red');
        //document.id('q2t').setStyle('background','red');
        document.id('submit_c').setStyle('visibility','hidden');
    }
    if((ct1  >= ct2 ))
    {
        document.id('stock').setStyle('background','black');
        //document.id('q2t').setStyle('background','black');
        document.id('submit_c').setStyle('visibility','visible');
    }
}




function check_mine(){
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=buildingAction&action=check_mine&building_id="
        + building_id ,
    onSuccess: function(result)
        {

            document.getElementById('since').innerHTML = result['since'];
            document.getElementById('now').innerHTML = result['now'];
            document.getElementById('elapsed').innerHTML = result['elapsed'];
            document.getElementById('remaining').innerHTML = result['remaining'];

            if(result['remaining']<=0)
            {
                $$('#mine_board1').setStyle('display','block');
                $$('#mine_progress1').setStyle('display','none');
            }
          
        }
    }).get();
}

function dig() {
    $$('.mine').addEvent('click', function(){
        var type = this.get('type');
        mine(type);
        // alert (type);
        });
    }

function mine(type)
{
    var a = new Request.JSON({
        url: "index.php?option=com_battle&format=raw&task=buildingAction&action=work_mine&building_id="
        + building_id + "&type=" + type,
    onSuccess: function(result){

        $$('#mine_board1').setStyle('display','none');
        $$('#mine_progress1').setStyle('display','block');  	    
        }
    }).get();
}

function request_shop_inventory()
{
    var all = '';
    var details = this.details;
    //	var id = $('image').get('number');
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=action&action=get_shop_inventory&building_id="
        + building_id,
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
                var row = "<div class='object'><a href='#' title='" 
                + result[i].name + "' class='buy' id='" 
                + result[i].item_id + "'><img src='/components/com_battle/images/objects/" 
                + result[i].name + ".png' height='32' width='32' /></a><span class='price'>$" 
                + result[i].sell_price + "</span></div>"; 
                all= all + row;
            }
            id      = 0;
            all     = all + '';
            document.id('building_inventory_table').innerHTML = all;
            $$('.buy').addEvent('click', function()
            {
                var itemID = this.get('id');
                buy1(itemID);
            });
        }
    }).get();
}

function request_inventory()
{
    var all = '';
    var details = this.details;
    var a = new Request.JSON({
        url: "index.php?option=com_battle&format=raw&task=action&action=get_inventory_to_sell&building_id="
        + building_id,
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
                var row = "<div class='object'><a href='#' title='" 
                + result[i].name + "' class='sell' id='" 
                + result[i].item_id 
                + "'><img src='/components/com_battle/images/objects/" 
                + result[i].name + ".png' height='32' width='32' /></a><span class='price'>$" 
                + result[i].buy_price 
                + "</span></div>"; 
                all= all + row;
            }
            all= all + '';
            document.id('my_inventory').innerHTML = all;
            $$('.sell').addEvent('click', function()
            {
                var itemID = this.get('id');
                sell1(itemID);
            });
        }
    }).get();
}

function buy1(itemID){
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=buy&buy=objects&building_id=" 
    + building_id 
    +"&item=" 
    + itemID, 
    onSuccess: function(result){
            request_inventory();
        }
    }).get();
 
}

function sell1(itemID)
{
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=action&action=sell&sell=objects&building_id=" 
        + building_id + "&item=" 
        + itemID, 
        onSuccess: function(result)
        {
           request_inventory();
        }
    }).get();
}

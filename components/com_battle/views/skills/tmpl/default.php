<!-- <script type="text/javascript" src="/JIGS/plugins/system/mtupgrade/mootools.js"></script>
 <SCRIPT type="text/javascript" src="clientcide.2.2.0.js"></script> -->
<?php defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.methods' );
?>

<div class="name">Primary Skills</div>
<section id = "master_skills_table" class="shade-table">

</section>


<section id = "primary_upgrade_table" class="shade-table clearfix">
</section>

<div class="name">Secondary Skills</div>
<section id = "skills_table" class="shade-table">
No Primary Skill Selected

</section>

<section id = "secondary_upgrade_table" class="shade-table">
</section>




<script type='text/javascript'>


    var a = new Request.JSON(
        {
            url: "index.php?option=com_battle&format=raw&task=skills_action&action=get_available_skills&parent=1",
            onSuccess: function(result)
            {
                print_result(result['player_skill_list'],1);
                print_upgrades(result['available_skill_list'],1)
                add_open();
            }
        }).get();

    function add_open()
    {
        $$('.open').removeEvents('click');
        $$('.open').addEvent('click', function()
        {
            var parent = this.get('id');
            open(parent);
            add_highlight();
        });
    }

    function open(parent){
        var a = new Request.JSON({
            url: "index.php?option=com_battle&format=raw&task=skills_action&action=get_available_skills&parent=" + parent,
            onSuccess: function(result){

                print_result(result['player_skill_list'],parent)
                print_upgrades(result['available_skill_list'],parent)

            }
        }).get();
    }
    function print_result(result,parent)
    {
        var result_text = "";
        for (var i = 0; i < result.length; i++) {

            result_text += "<div>";
            result_text += "<h3> <span id = '" + result[i]['skill_id'] + "' class='open'>" + result[i]['name'] + "</span> <span>" + result[i]['level'] + " </span></h3>";
            result_text += "<span id = 'upgrade_" + result[i]['skill_id'] + "' class='assign btn-sm btn-primary '>Upgrade</span>";
            result_text += "<span>Cost: " +  result[i]['cost_price'] + "</span>";
            result_text += "<span>Time: " +  result[i]['upgrade_time'] + " mins</span>";
            result_text += "</div>";
        }
        if (parent == 1)
        {
            document.id('master_skills_table').innerHTML = result_text;
        }else{
            if (result_text) {
                document.id('skills_table').innerHTML = result_text;
            }else{
                document.id('skills_table').innerHTML = "No Secondary Skills trained ";
            }
        }
        add_open();
    }


    function print_upgrades(result,parent)
    {
        var result_text = "";
        for (var i = 0; i < result.length; i++) {

            result_text += "<div>";
            result_text += "<h3><span id = '" + result[i]['id'] + "' class='open'>" + result[i]['name'] + "</span> <span>"+ result[i]['level'] + " </span></h3>";
            result_text += "<span id = 'skill_" + result[i]['id'] + "' class='assign btn-sm btn-warning '>Inject</span>";
            result_text += "<span>Cost: " +  result[i]['cost_price'] + "</span>";
            result_text += "<span>Time: " +  result[i]['upgrade_time'] + " mins</span>";
            result_text += "</div>";
        }
        if (parent == 1)
        {
            document.id('primary_upgrade_table').innerHTML = result_text;
        }else{

            if (result_text) {

                document.id('secondary_upgrade_table').innerHTML = result_text;
            }else{

                document.id('secondary_upgrade_table').innerHTML = "<tr><td>No Secondary Skills trained  </td></tr>";

            }

        }
        add_open();
    }
    /* Add class "selected" to current primary skill */
    /*$( "body" ).append( "<div class='overlay'><div class='loader'>Loading...</div></div>" );*/

   function add_highlight() {

       //setTimeout(function() {
       //      $(".overlay").remove();
       //}, 400);
       jQuery("#master_skills_table div, #primary_upgrade_table div").on("click", function () {

/* Add class "selected" to current primary skill */

/*jQuery( "body" ).append( "<div class='overlay'><div class='loader'>Loading...</div></div>" );*/

jQuery( document ).ready(function() {

	//setTimeout(function() {
	//      jQuery(".overlay").remove();
	//}, 400);


	jQuery("#master_skills_table, #primary_upgrade_table" ).on( "click", "div", function() {
		//alert('works');
		/* this adds class to selected div, and removes class from any other in the same section */
		jQuery( this ).addClass("selected").siblings().removeClass();
		/* this adds removes class from any other in the other section */
		jQuery( this ).parent().siblings().children().removeClass();
	});

});

           /* this adds class to selected div,and removes class from any other in the same section */
           jQuery(this).toggleClass("selected").siblings().removeClass();
           /* this adds removes class from any other in the other section */
           jQuery(this).parent().siblings().children().removeClass();
       });
   }
</script>

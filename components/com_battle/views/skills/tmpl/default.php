<!-- <script type="text/javascript" src="/JIGS/plugins/system/mtupgrade/mootools.js"></script>
 <SCRIPT type="text/javascript" src="clientcide.2.2.0.js"></script> -->
<?php defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.methods' );
?>

<div class="name">Primary</div>
<section id = "master_skills_table" class="shade-table">

</section>


<section id = "primary_upgrade_table" class="shade-table">
</section>






<h2>Secondary</h2>
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
            result_text += "<span id = 'upgrade_" + result[i]['skill_id'] + "' class='assign button btn btn-success '>Upgrade</span>";
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
            result_text += "<span id = 'skill_" + result[i]['id'] + "' class='assign button btn btn-danger '>Inject</span>";
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






</script>
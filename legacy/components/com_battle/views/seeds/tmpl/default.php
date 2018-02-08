<div id="collect">

    <span id = "seeds">Click to collect your seeds</span>

</div>

<script>
    jQuery('#seeds').click(function(){

        jQuery.ajax({
            url: "/index.php?option=com_battle&format=json&task=action&action=get_free_seeds",
            context: document.body,
            dataType: "json"
             }).done(function() {

                var text = "The Very Best in Non reproducible super flu resistant  genetically modified MonsterOh Seeds FREE Sample";

                document.getElementById('collect').innerHTML=text;
        });
    });
</script>
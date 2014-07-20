<?php defined( '_JEXEC' ) or die( 'Restricted access' );?>

<div class="board_panel clr">
	

	<div class='panel' id="first_panel" style="visibility:visible;">
	<?php  echo $this->loadTemplate ('board_primary'); ?>

	</div>
	<div class='panel' id="second_panel" style="visibility:hidden;">
	
	<?php  echo $this->loadTemplate ('board_defence'); ?>
	</div>
	<div class='panel' id="third_panel" style="visibility:hidden;">
	
	<?php  echo $this->loadTemplate ('board_distr'); ?>
	</div>
	<div class='panel' id="fourth_panel" style="visibility:hidden;">
	
	<?php  echo $this->loadTemplate ('board_hr'); ?>
	</div>
	<div class='panel' id="fifth_panel" style="visibility:hidden;">
	
	<?php  echo $this->loadTemplate ('board_energy'); ?>
	</div>
</div>

<div class="board_buttons">
	<div class='b_button' id="primary" title="Primary Systems CP"></div>
	<div class='b_button' id="distr" title="Distribution Systems CP"></div>
	<div class='b_button' id="defence" title="Defence Systems CP"></div>
	<div class='b_button' id="hr" title="Hobbit Resource Systems CP"></div>
	<div class='b_button' id="energy" title="Energy Systems CP"></div>
</div>

<script type='text/javascript'>






    	   	$$('.b_button').addEvent('click', function(){
	
		var itemID = this.get('id');
 		
 		switch(itemID)
 		{
 		
 	case 'primary':
 		$$('.panel').set('styles',{visibility:'hidden'});
 		$('first_panel').set('styles',{visibility:'visible'});
  		$$('.b_button').set('class','b_button inactive');
		$('primary').set('class', 'b_button active');
 		break;
 	case 'defence':
 		$$('.panel').set('styles',{visibility: 'hidden'});
 		$('second_panel').set('styles',{visibility: 'visible'});
  		$$('.b_button').set('class','b_button inactive');
		$('defence').set('class', 'b_button active');
 		break;	
   	case 'distr':
 		$$('.panel').set('styles',{visibility:'hidden'});
 		$('third_panel').set('styles',{visibility:'visible'});
 		$$('.b_button').set('class','b_button inactive');
		$('distr').set('class','b_button active');		
 		break;		
    	case 'hr':
 		$$('.panel').set('styles',{visibility:'hidden'});
 		$('fourth_panel').set('styles',{visibility:'visible'});
		$$('.b_button').set('class', 'b_button inactive');
		$('hr').set('class', 'b_button active');		
 		break;			
     case 'energy':
 		$$('.panel').set('styles',{visibility:'hidden'});
 		$('fifth_panel').set('styles',{visibility:'visible'});
 		$$('.b_button').set('class','b_button inactive');
		$('energy').set('class','b_button active');		
  		break;
 	default:
 		$$('panel').set('styles',{visibility:'hidden'});
 		$$('.b_button').set('class','b_button inactive');
  		}
    		 });
</script>

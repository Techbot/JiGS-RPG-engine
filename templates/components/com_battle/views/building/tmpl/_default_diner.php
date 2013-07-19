 <?php defined( '_JEXEC' ) or die( 'Restricted access' );  ?>
 
 <div>

<div id= 'eat_burger' style="visibility:visible;"> Increase your health by 10pts with a SuperSized <br />
 Mc Guffin Burger<br /> I'm lovin it</div>

<script type='text/javascript'>


	   	 $('eat_burger').addEvent('click', function(){
		  var itemID = this.get('id');
 		  eat(itemID);
  		 });
  		 
function eat(itemID){
 	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=eat", 
    onSuccess: function(result){
   	   	$('eat_burger').setStyle('visibility','hidden'); 
    	}
    }).get();
 
}
</script>
 </div>
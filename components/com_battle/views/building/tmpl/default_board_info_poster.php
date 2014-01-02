<?php defined( '_JEXEC' ) or die( 'Restricted access' );

$imagesDir = 'images/posters/';

$images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

//print_r($images);


$randomImage = $images[array_rand($images)];

print_r($randomImage);

?>

<style type="text/css">

.board_panel {
	position: relative;
	width: 233px;
	padding: 0 5px;
	height: 310px;
	background-image:url('<?php echo $randomImage;?>');
	background-position:50% 50%;
	background-size:cover;
}

.board_panel .name {
	margin: 0 -5px 5px;
}



.panel {
	position: absolute;
	left: 0px;
	top: 0px;
	visibility: hidden;
	text-align:left;
	padding:0 5px 5px;
	width:233px;
}
.panel p {
	margin:0 0 5px;
}


</style>



<div class="board_panel clr">


</div>



<script type='text/javascript'>


</script>

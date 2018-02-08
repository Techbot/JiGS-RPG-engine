<?php defined( '_JEXEC' ) or die( 'Restricted access' );

$imagesDir = 'images/assets/building_posters/';

$images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

//print_r($images);


$randomImage = $images[array_rand($images)];

//print_r($randomImage);

?>

<style type="text/css">

.board_panel {
	background-image:url('<?php echo $randomImage;?>');
}

</style>



<div class="board_panel clr">


</div>



<script type='text/javascript'>


</script>

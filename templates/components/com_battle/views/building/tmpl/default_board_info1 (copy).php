<?php defined( '_JEXEC' ) or die( 'Restricted access' );?>

<!-- SAMPLE 5 -->
<div id="building_noob" class="sample">
	<div class="mask2">
		<div id="box5">
			<span><img src="<?php echo $this->baseurl ?>/img1.jpg" alt="Photo" /></span>
			<span><img src="<?php echo $this->baseurl ?>/img2.jpg" alt="Photo" /></span>
			<span><img src="<?php echo $this->baseurl ?>/img3.jpg" alt="Photo" /></span>
			<span><img src="<?php echo $this->baseurl ?>/img4.jpg" alt="Photo" /></span>
			<span><img src="<?php echo $this->baseurl ?>/img5.jpg" alt="Photo" /></span>
			<span><img src="<?php echo $this->baseurl ?>/img6.jpg" alt="Photo" /></span>
			<span><img src="<?php echo $this->baseurl ?>/img7.jpg" alt="Photo" /></span>
			<span><img src="<?php echo $this->baseurl ?>/img8.jpg" alt="Photo" /></span>
		</div>
		<div id="info5" class="info"></div>

	</div>

</div> 


<script type='text/javascript'>


//SAMPLE 5 (mode: vertical, using "onWalk" )
var info5 = $('info5').set('opacity',0.5);
var sampleObjectItems =[
{


	
	title:'<?php echo $this->board_info_1[0] ?>', link:'http://www.link1.com'},
	{
		title:'<?php echo $this->board_info_1[1] ?>',autor:'Ipsum', date:'6 Dic 2007', link:'http://www.link2.com'},
		{
			title:'<?php echo $this->board_info_1[2] ?>', autor:'Dolor', date:'9 Feb 2007', link:'http://www.link3.com'},
			{
				title:'<?php echo $this->board_info_1[3] ?>', autor:'Sit', date:'22 Jul 2007', link:'http://www.link4.com'},
				{
					title:'<?php echo $this->board_info_1[4] ?>', autor:'Amet', date:'30 Set 2007', link:'http://www.link5.com'},
					{
						title:'<?php echo $this->board_info_1[5] ?>', autor:'Consecteur', date:'5 Nov 2007', link:'http://www.link6.com'},
						{
							title:'<?php echo $this->board_info_1[6] ?>', autor:'Adipsim', date:'12 Mar 2007', link:'http://www.link7.com'},
							{
								title:'<?php echo $this->board_info_1[7] ?>', autor:'Colom', date:'10 Abr 2007', link:'http://www.link8.com'}
								];
								var nS5 = new noobSlide({
									mode: 'vertical',
									box: $('box5'),
									size: 180,
									autoPlay: false,
									items: sampleObjectItems,
								
									onWalk: function(currentItem){
										info5.empty();
										new Element('h4').set('html','<a href="'+currentItem.link+'">link</a>'+currentItem.title).inject(info5);
										// new Element('p').set('html','<b>Autor</b>: '+currentItem.autor+' &nbsp; &nbsp; <b>Date</b>: '+currentItem.date).inject(info5);
									}
								});


								</script>

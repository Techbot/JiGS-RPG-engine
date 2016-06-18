<html>
	<head>
		<!-- Phaser -->
        <script src="/components/com_battle/views/phaser/tmpl/_site/js/phaser.js"></script>
		<style>
			body {
				margin: 0;
				position: relative;
			}
			
			.toolbar {
				position: absolute;
				bottom: 0;
				left: 0;
				padding: 10px;
			}
			
			.toolbar > a {
				display: block;
				float: left;
				width: 48px;
				height: 48px;
				color: white;
			}
			
			.toolbar .fa {
				font-size: 48px;
				cursor: pointer;
				display: block;
			}
			
			.toolbar .pyramidCity {
			  background: url("http://eclecticmeme.com/components/com_battle/images/Pyramid_48.png") no-repeat 0 0 transparent;
			  padding-left: 35px;
			}
						
		</style>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		
	</head>
    <body>

		<a href="http://eclecticmeme.com/index.php?option=com_content&view=article&id=4:chapter-two&catid=9:2007&Itemid=348" title="The Chronicles">
			<div id="world">
			</div>
		</a>
		
		<div class="toolbar">
			<a class="pyramidCity"></a>
			<a class="chronicles"></a>
		</div>

		<script src='http://eclecticmeme.com/components/com_battle/views/plate/tmpl/019_wolfman_vampire/script.js'></script>
		
		<script>
		$(document).ready(function() {
			$( ".pyramidCity" ).click(function() {
			  //$("#plates").hide();
			  //$("#world").show();
			  alert("This should lead to the map");
			});
		});
		</script>

    </body>
</html>



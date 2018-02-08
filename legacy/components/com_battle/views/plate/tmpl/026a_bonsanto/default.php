<html>
	<head>
		<script src="/components/com_battle/includes/jquery-2.0.3.min.js"></script>
		<!-- Phaser -->
        <script src="/components/com_battle/includes/phaser.js"></script>
        <script src="custom.js"></script>

    <style>
      body {
        margin: 0;
      }

      #world {
        position: relative;
      }

      #startScreen > *,
      #ui-overlay > * {
        position: absolute;
        box-sizing: border-box;
      }

      .message {
        top: 360px;
        left: 0;
        width: 100%;
        height: 140px;
        background-color: #03442E;
        padding: 10px;
        font-family: Arial, sans-serif;
        font-size: 24px;
        text-align: left;
        color: #8CE04C;
      }

    </style>
	</head>
	
	<body>
			
		<div id="world">
		</div>

    <div id="startScreen">
    </div>

    <div id="ui-overlay">
    </div>

    <script src='state001.js'></script>
    <script src='state002.js'></script>
    <script src='state003.js'></script>
    <script src='script.js'></script>



	</body>
</html>



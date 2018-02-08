<html>
    <head>
        <meta charset="utf-8">
        <title>sdcAdventure</title>
        <link rel="stylesheet" type="text/css" href="./css/sdcAdventure.css">
        <script>
            var pa_args = <?php print $gameUI->dynamicJSArgs();?>;
        </script>
        <script src="./libs/jquery-1.8.2.min.js"></script>
        <script src="./libs/jquery.spritely-0.6.js"></script>
        <script src="./libs/jquery.supremation.min.js"></script>
        <script src="./js/sdcAdventure.js"></script>
    </head>
    <body>
        <div class='gamePanel' id='gamespace'><?php print $gameUI->gamePanel();?></div>
        <div class='gamePanel' id='controlpanel'><?php print $gameUI->controlPanel();?></div>
        <div class='gamePanel' id='infopanel'><?php print $gameUI->infoPanel();?></div>
    </body>
</html>
   <?php ?>
   <!--link href="/components/com_battle/views/phaser/tmpl/_site/css/phaser-examples.css" media="screen" rel="stylesheet" type="text/css"-->
        <!-- Phaser -->
        <script src="/components/com_battle/views/phaser/tmpl/_site/js/jquery-2.0.3.min.js"></script>
        <script src="/components/com_battle/views/phaser/tmpl/_site/js/phaser.js"></script>
        <!--script src="/components/com_battle/includes/blip.min.js"></script>
        <!-- Main Game File -->
        <script>
            var playState = new Array();
            var grid;
            var number;
            var tile_names = new Array();
            var monsters = new Array();
            var monsters_list = new Array();
            var halflings = new Array();
            var halfling_list = new Array();
            var assets_name_x = new Array();
            var assets_name_y = new Array();
            var building = new Array();
            var buildings = new Array();
            var posx = new Array();
            var posy = new Array();
            var portal = new Array();
            var add_building = new Array();
            var add_assets = new Array();
            var players = new Array();
            var players_list = new Array();
            var add_plates = new Array();
            var add_pages = new Array();
            var add_twines = new Array();
            var boundsX1 = new Array();
            var boundsY1 = new Array();
            var boundsX2 = new Array();
            var boundsY2 = new Array();
            var new_x;
            var new_y;
            var portal_sourceX1 = new Array();
            var portal_sourceY1 = new Array();
            var portal_sourceX2 = [];
            var portal_sourceY2 = [];
            var portal_sourceX3 = [];
            var portal_sourceY3 =[];
            var portal_dest_1 = [];
            var portal_dest_2 = [];
            var portal_dest_3 = [];
            var npc = [];
            var npc_list = [];
            var terminals = [];
            var terminals_list = [];
            var twines_list = [];
            var plates_list = [];
            var content =[];
            var send = 1;
            var map;
            var layer;
            var layer3;
            var layer4;
            var layer2;
            var x;
            var y;
            var rhythmic;
            var melody;
            var bass;
            var phaser;
            var sprite;
            var sprite2;
            var grid;
            var cursors;
            var avatar;
            var cacheKey;
            var group;

        </script>
        <script src="http://autobahn.s3.amazonaws.com/js/autobahn.min.js"></script>
        <script src="/components/com_battle/views/phaser/tmpl/phaser-tiled.js"></script>
        <script src="/components/com_battle/views/phaser/tmpl/playstate00.js"></script>
        <script src="/components/com_battle/views/phaser/tmpl/playstate01.js"></script>
        <script src="/components/com_battle/views/phaser/tmpl/playstate02.js"></script>
        <script src="/components/com_battle/views/phaser/tmpl/loadstate.js"></script>
        <script src="/components/com_battle/views/phaser/tmpl/map_info.js"></script>
        <script src="/components/com_battle/views/phaser/tmpl/script.js"></script>
        <div id ="world"></div>
        <div id ="building"></div>
        <div id ="npc"></div>
        <div id ="player"></div>
        <div id ="terminal" style = "margin: -194px 0 0 0; z-index:9999;    position: absolute;
    left: 0px;
    top: 540px;"></div>
        <div id ="twines"></div>
        <div id ="plates"></div>

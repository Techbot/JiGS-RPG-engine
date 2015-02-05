
        <!--link href="/components/com_battle/views/phaser/tmpl/_site/css/phaser-examples.css" media="screen" rel="stylesheet" type="text/css"-->
        <!-- Phaser -->
        <script src="/components/com_battle/views/phaser/tmpl/_site/js/jquery-2.0.3.min.js"></script>
        <script src="/components/com_battle/views/phaser/tmpl/_site/js/phaser.js"></script>
        <script src="/components/com_battle/includes/blip.min.js"></script>
        <!-- Main Game File -->
        <script>
            var playState = new Array();
            var grid;
            var number;
            var tile_names = new Array();
            var assets_name = new Array();
            var assets_name_x = new Array();
            var assets_name_y = new Array();
            var building = new Array();
            var buildings = new Array();
            var posx = new Array();
            var posy = new Array();

            var portal = new Array();
            var add_building = new Array();
            var add_assets = new Array();
            var add_npc = new Array();
            var add_players = new Array();

            var boundsX1 = new Array();
            var boundsY1 = new Array();
            var boundsX2 = new Array();
            var boundsY2 = new Array();
            var new_x;
            var new_y;
            var portal_sourceX1 = new Array();
            var portal_sourceY1 = new Array();

            var portal_sourceX2 = new Array();
            var portal_sourceY2 = new Array();

            var portal_sourceX3 = new Array();
            var portal_sourceY3 = new Array();
            var portal_dest_1 = new Array();
            var portal_dest_2 = new Array();
            var portal_dest_3 = new Array();
            var npc_list = new Array();
            var send = 1;
        </script>
        <script src="/components/com_battle/views/phaser/tmpl/phaser-tiled.js"></script>
        <script src="/components/com_battle/views/phaser/tmpl/playstate01.js"></script>
        <script src="/components/com_battle/views/phaser/tmpl/loadstate.js"></script>
        <script src="/components/com_battle/views/phaser/tmpl/map_info.js"></script>
        <script src="/components/com_battle/views/phaser/tmpl/tile.js"></script>
        <div id ="world"></div>
<html>
    <head>
        <meta charset="utf-8">
        <title>sdcAdventure Designer</title>
        <link rel="stylesheet" type="text/css" href="../css/designer.css">
        <link rel="stylesheet" type="text/css" href="../libs/jquery-ui/css/smoothness/jquery-ui-1.9.1.custom.min.css">
        <link rel="stylesheet" type="text/css" href="../libs/tablesorter/css/theme.blue.css">
        <script>
            var pa_args = <?php print $designerUI->dynamicJSArgs();?>;
        </script>
        <script src="../libs/jquery-1.8.2.min.js"></script>
        <script src="../libs/jquery.spritely-0.6.js"></script>
        <script src="../libs/jquery.supremation.min.js"></script>
        <script src="../libs/jquery.contextmenu.js"></script>
        <script src="../libs/jquery.form.js"></script>
        <script src="../libs/jquery-ui/js/jquery-ui-1.9.1.custom.min.js"></script>
        <script src="../libs/tablesorter/jquery.tablesorter.min.js"></script>
        <script src="../libs/raphael-min.js"></script>
        <script src="../js/designer.js"></script>
    </head>
    <body>
        <div class='designPanel' id='controlpanel'><?php print $designerUI->controlPanel();?></div>
        <div class='designPanel' id='designspace'><?php print $designerUI->gamePanel();?></div>
        <div class='designPanel' id='infopanel'><?php print $designerUI->infoPanel();?></div>

<div id='gd_general_dialog'><form></form></div>
<ul id="gd_contextmenu_point_Walkable" class="gd_contextmenu">
    <li><a name="addPoint" href="#addPoint">Add New Point</a></li>
    <li><a name="delPoint" href="#delPoint">Delete This Point</a></li>
</ul>
<ul id="gd_contextmenu_point_Exits" class="gd_contextmenu">
    <li><a name="addPoint" href="#addPoint">Add New Point</a></li>
    <li><a name="delPoint" href="#delPoint">Delete This Point</a></li>
    <li><a name="exitDest" href="#exitDest">Set Exit Dest</a></li>
    <li><a name="delShape" href="#delShape">Delete Shape</a></li>
</ul>
<ul id="gd_contextmenu_image" class="gd_contextmenu">
    <li><a name="addShape" href="#addPoint">Add Shape</a></li>
</ul>

    </body>
</html>
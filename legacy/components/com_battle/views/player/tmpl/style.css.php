
   <style TYPE="text/css"> 


div#stats table {
color: #fff;}

div#stats table td.label {
width:100px;
color: #999;
text-transform: uppercase;
font-size: 85%;}

div#stats p {
margin: 1em 0 0 !important;
}


/* Stats/Person tmpl - to be moved into separate CSS eventually */

div#stats table div.gauge {
-moz-border-radius: 25px;
border-radius: 25px;
border:1px solid #333;
background:#0F0F0F;
color: #000;
width:100%;
}

div#stats table span {
padding-left:15px;
}

div#stats table div#xp {
-moz-border-radius: 25px 0 0 25px;
border-radius: 25px 0 0 25px;
padding: 0 0 0 15px;
background:#0F0;/*green*/
width: <?php echo $this->people->xp - 5 ; ?>%;
}



div#stats table div#intel {
-moz-border-radius: 25px 0 0 25px;
border-radius: 25px 0 0 25px;
padding: 0 0 0 15px;
background:#FF0;/*yellow*/
width: <?php echo $this->people->intelligence - 5 ; ?>%;
}

div#stats table div#strength {
-moz-border-radius: 25px 0 0 25px;
border-radius: 25px 0 0 25px;
padding: 0 0 0 15px;
background:#00F;/*blue*/
width: <?php echo $this->people->strenght - 15 ; ?>%;
}

div#stats table div#health {
-moz-border-radius: 25px 0 0 25px;
border-radius: 25px 0 0 25px;
padding: 0 0 0 15px;
background:#F00;/*red*/
width: <?php echo $this->people->health - 15 ; ?>%;
}
   </style> 

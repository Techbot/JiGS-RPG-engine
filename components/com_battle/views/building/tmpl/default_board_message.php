<?php defined( '_JEXEC' ) or die( 'Restricted access' );?>

<style type="text/css">


/* CONTENT SLIDER */
#content-slider {
	width:100%;
	height:125px;
	margin:0 auto;
}


/* SLIDER STRUCTURE */

#slider {
   background: #000;
   border: 0px solid #eaeaea;
   box-shadow: 0px 0px 5px rgba(0,0,0,0.7);
	height:125px;
	width:385px;
   margin: 0 auto;
   overflow: visible;
   position: relative;
}

/* HIDE ALL OUTSIDE OF THE SLIDER */

#mask {
   overflow: hidden;
   height: 125px;
}

/* IMAGE LIST */

#slider ul {
   margin: 0;
   padding: 0;
   position: relative;
}

#slider li {
   width: 385px;  /* Width Image */
   height: 125px; /* Height Image */
   position: absolute;
   top: -125px;	/* Original Position - Outside of the Slider */
   list-style: none;
   margin: 0;
   padding: 0;}


/* For the -moz-animation

1.  Define the total number of images to use in the slider
    5
	
2.  Define the length of -moz-animation for each image
    5 seconds
	
3.  Define the total duration of the -moz-animation
    Multiply the total number of images by the duration of each image:
    5 images � 5 seconds = 25 seconds
	
4.  Calculate how many keyframes equals one second
    Divide the total number of keyframes by the total duration of the -moz-animation.
    100 keyframes / 25 seconds = 4 keyframes
    4 keyframes = 1 second
	
*/

#slider li.firstanimation {
   -moz-animation: cycle 25s linear infinite;
   -webkit-animation: cycle 25s linear infinite;
}

#slider li.secondanimation {
   -moz-animation: cycletwo 25s linear infinite;
   -webkit-animation: cycletwo 25s linear infinite;
}

#slider li.thirdanimation {
   -moz-animation: cyclethree 25s linear infinite;
   -webkit-animation: cyclethree 25s linear infinite;
}

#slider li.fourthanimation {
   -moz-animation: cyclefour 25s linear infinite;
   -webkit-animation: cyclefour 25s linear infinite;
}

#slider li.fifthanimation {
   -moz-animation: cyclefive 25s linear infinite;
   -webkit-animation: cyclefive 25s linear infinite;
}

/* -moz-animation */

@-moz-keyframes cycle {
   0%  { top: 0px; } /* When you start the slide, the first image is already visible */
   4%  { top: 0px; } /* Original Position */
   16% { top: 0px; opacity:1; z-index:0; } /* From 4% to 16 % = for 3 seconds the image is visible */
   20% { top: 125px; opacity: 0; z-index: 0; } /* From 16% to 20% = for 1 second exit image */
   21% { top: -125px; opacity: 0; z-index: -1; } /* Return to Original Position */
   92% { top: -125px; opacity: 0; z-index: 0; }
   96% { top: -125px; opacity: 0; } /* From 96% to 100% = for 1 second enter image*/
   100%{ top: 0px; opacity: 1; }
}

@-moz-keyframes cycletwo {
   0%  { top: -125px; opacity: 0; } /* Original Position */
   16% { top: -125px; opacity: 0; }/* Starts moving after 16% to this position */
   20% { top: 0px; opacity: 1; }
   24% { top: 0px; opacity: 1; }  /* From 20% to 24% = for 1 second enter image*/
   36% { top: 0px; opacity: 1; z-index: 0; }   /* From 24% to 36 % = for 3 seconds the image is visible */
   40% { top: 125px; opacity: 0; z-index: 0; } /* From 36% to 40% = for 1 second exit image */
   41% { top: -125px; opacity: 0; z-index: -1; }   /* Return to Original Position */
   100%{ top: -125px; opacity: 0; z-index: -1; }
}

@-moz-keyframes cyclethree {
   0%  { top: -125px; opacity: 0; }
   36% { top: -125px; opacity: 0; }
   40% { top: 0px; opacity: 1; }
   44% { top: 0px; opacity: 1; }
   56% { top: 0px; opacity: 1; }
   60% { top: 125px; opacity: 0; z-index: 0; }
   61% { top: -125px; opacity: 0; z-index: -1; }
   100%{ top: -125px; opacity: 0; z-index: -1; }
}

@-moz-keyframes cyclefour {
   0%  { top: -125px; opacity: 0; }
   56% { top: -125px; opacity: 0; }
   60% { top: 0px; opacity: 1; }
   64% { top: 0px; opacity: 1; }
   76% { top: 0px; opacity: 1; z-index: 0; }
   80% { top: 125px; opacity: 0; z-index: 0; }
   81% { top: -125px; opacity: 0; z-index: -1; }
   100%{ top: -125px; opacity: 0; z-index: -1; }
}
@-moz-keyframes cyclefive {
   0%  { top: -125px; opacity: 0; }
   76% { top: -125px; opacity: 0; }
   80% { top: 0px; opacity: 1; }
   84% { top: 0px; opacity: 1; }
   96% { top: 0px; opacity: 1; z-index: 0; }
   100%{ top: 125px; opacity: 0; z-index: 0; }
}


/* -webkit-animation */

@-webkit-keyframes cycle {
   0%  { top: 0px; } /* When you start the slide, the first image is already visible */
   4%  { top: 0px; } /* Original Position */
   16% { top: 0px; opacity:1; z-index:0; } /* From 4% to 16 % = for 3 seconds the image is visible */
   20% { top: 125px; opacity: 0; z-index: 0; } /* From 16% to 20% = for 1 second exit image */
   21% { top: -125px; opacity: 0; z-index: -1; } /* Return to Original Position */
   92% { top: -125px; opacity: 0; z-index: 0; }
   96% { top: -125px; opacity: 0; } /* From 96% to 100% = for 1 second enter image*/
   100%{ top: 0px; opacity: 1; }
}

@-webkit-keyframes cycletwo {
   0%  { top: -125px; opacity: 0; } /* Original Position */
   16% { top: -125px; opacity: 0; }/* Starts moving after 16% to this position */
   20% { top: 0px; opacity: 1; }
   24% { top: 0px; opacity: 1; }  /* From 20% to 24% = for 1 second enter image*/
   36% { top: 0px; opacity: 1; z-index: 0; }   /* From 24% to 36 % = for 3 seconds the image is visible */
   40% { top: 125px; opacity: 0; z-index: 0; } /* From 36% to 40% = for 1 second exit image */
   41% { top: -125px; opacity: 0; z-index: -1; }   /* Return to Original Position */
   100%{ top: -125px; opacity: 0; z-index: -1; }
}

@-webkit-keyframes cyclethree {
   0%  { top: -125px; opacity: 0; }
   36% { top: -125px; opacity: 0; }
   40% { top: 0px; opacity: 1; }
   44% { top: 0px; opacity: 1; }
   56% { top: 0px; opacity: 1; }
   60% { top: 125px; opacity: 0; z-index: 0; }
   61% { top: -125px; opacity: 0; z-index: -1; }
   100%{ top: -125px; opacity: 0; z-index: -1; }
}

@-webkit-keyframes cyclefour {
   0%  { top: -125px; opacity: 0; }
   56% { top: -125px; opacity: 0; }
   60% { top: 0px; opacity: 1; }
   64% { top: 0px; opacity: 1; }
   76% { top: 0px; opacity: 1; z-index: 0; }
   80% { top: 125px; opacity: 0; z-index: 0; }
   81% { top: -125px; opacity: 0; z-index: -1; }
   100%{ top: -125px; opacity: 0; z-index: -1; }
}
@-webkit-keyframes cyclefive {
   0%  { top: -125px; opacity: 0; }
   76% { top: -125px; opacity: 0; }
   80% { top: 0px; opacity: 1; }
   84% { top: 0px; opacity: 1; }
   96% { top: 0px; opacity: 1; z-index: 0; }
   100%{ top: 125px; opacity: 0; z-index: 0; }
}



/* PROGRESS BAR */

.progress-bar {
   position: relative;
   top: -5px;
   width: 385px;
   height: 5px;
   background: #000;
   -moz-animation: fullexpand 25s ease-out infinite;
   -webkit-animation: fullexpand 25s ease-out infinite;
}


/* -moz-animation BAR */

@-moz-keyframes fullexpand {
   /* In these keyframes, the progress-bar is stationary */
   0%, 20%, 40%, 60%, 80%, 100% { width: 0%; opacity: 0; }

   /* In these keyframes, the progress-bar starts to come alive */
   4%, 24%, 44%, 64%, 84% { width: 0%; opacity: 0.3; }

   /* In these keyframes, the progress-bar moves forward for 3 seconds */
   16%, 36%, 56%, 76%, 96% { width: 100%; opacity: 0.7; }

   /* In these keyframes, the progress-bar has finished his path */
   17%, 37%, 57%, 77%, 97% { width: 100%; opacity: 0.3; }

   /* In these keyframes, the progress-bar will disappear and then resume the cycle */
   18%, 38%, 58%, 78%, 98% { width: 100%; opacity: 0; }
}   


#slider .tooltip {
   background: rgba(0,0,0,0.7);
   width: 385px;
   max-width:385px;
   position: relative;
   bottom: 60px;
   left: -320px;
   border:0px solid #000;
   left: 0px;}

#slider .tooltip h3 {
   color: #fff;
   font-weight: 300;
   padding: 0 10px;
   margin:0;
   text-align:left;
}

#slider .tooltip {
   -moz-transition: all 0.3s ease-in-out;
   -webkit-transition: all 0.3s ease-in-out;
}

#slider li#first:hover .tooltip,
#slider li#second:hover .tooltip,
#slider li#third:hover .tooltip,
#slider li#fourth:hover .tooltip,
#slider li#fifth:hover .tooltip {
   left: 0px;
}

#slider:hover li,
#slider:hover .progress-bar {
   -moz-animation-play-state: paused;
   -webkit-animation-play-state: paused;
}





</style>



	<div id="content-slider">
    	<div id="slider">
        	<div id="mask">
            <ul>
           	<li id="first" class="firstanimation">
            <a href="#">
            <img src="components/com_battle/images/slide01.jpg" alt="Slide1"/>
            </a>
            <div class="tooltip">
            <h3><?php echo $this->board_info_1[0]; ?></h3>
            </div>
            </li>

            <li id="second" class="secondanimation">
            <a href="#">
            <img src="components/com_battle/images/slide02.jpg" alt="Slide2"/>
            </a>
            <div class="tooltip">
			<h3><?php echo $this->board_info_1[1]; ?></h3>
            </div>
            </li>
            
            <li id="third" class="thirdanimation">
            <a href="#">
            <img src="components/com_battle/images/slide03.jpg" alt="Slide3"/>
            </a>
            <div class="tooltip">
			<h3><?php echo $this->board_info_1[2]; ?></h3>
            </div>
            </li>
                        
            <li id="fourth" class="fourthanimation">
            <a href="#">
            <img src="components/com_battle/images/slide04.jpg" alt="Slide4"/>
            </a>
            <div class="tooltip">
			<h3><?php echo $this->board_info_1[3]; ?></h3>
			</div>
            </li>
                        
            <li id="fifth" class="fifthanimation">
            <a href="#">
            <img src="components/com_battle/images/slide05.jpg" alt="Slide5"/>
            </a>
            <div class="tooltip">
			<h3><?php echo $this->board_info_1[4]; ?></h3>
			</div>
            </li>
            </ul>
            </div>
            <div class="progress-bar"></div>
        </div>        
	</div>

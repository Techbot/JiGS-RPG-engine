 <?php defined( '_JEXEC' ) or die( 'Restricted access' );  ?>
 

<div id="carousel-diner" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-diner" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-diner" data-slide-to="1"></li>
        <li data-target="#carousel-diner" data-slide-to="2"></li>
        <li data-target="#carousel-diner" data-slide-to="3"></li>
        <li data-target="#carousel-diner" data-slide-to="4"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

        <div class="item active">
            <div id="eat_burger" style="visibility:visible;">
            <img style="margin:10px 0 0 30px;"
            src="<?php echo $this->baseurl ?>/components/com_battle/images/burger.png" alt="McGuffin Burger" />
            <h4 style="margin:10px 0 0 30px;">Increase your health by 10pts with<br />
            a SuperSized  McGuffin Burger</h4>
            <p style="margin:10px 0 0 30px;">I'm lovin it</p>
            </div>
            <?php if($this->cropper->level>=9)
            { ?>
                <div id="eat_burger" style="visibility:visible;">
                <img style="margin:10px 0 0 30px;"
                src="<?php echo $this->baseurl ?>/components/com_battle/images/burger.png" alt="McGuffin Burger" />
                <h4 style="margin:10px 0 0 30px;">Increase your health by 10pts with<br />
                a SuperSized McGuffin Burger</h4>
                <p style="margin:10px 0 0 30px;">I'm lovin it</p>
                </div>

            <?php } else { ?>

                <div id="eat_burger" style="visibility:visible;">

                <h4 style="margin:10px 0 0 30px;">You're only a <?php print_r( $this->cropper->level); ?></h4>
                </div>
            <?php } ?>

        </div>

        <!--div>
        <img class="none"  src="<?php //echo $this->baseurl ?>/images/stories/mcdicks001.jpg" alt="McGuffin Burger" width="640px" />
        </div-->

        <div class="item">
            <img class="none" src="<?php echo $this->baseurl ?>/images/stories/mcdicks002.jpg" alt="McDonald Ad Busters"/>
        </div>

        <div class="item">
            <img class="none" src="<?php echo $this->baseurl ?>/images/stories/mcdicks003.jpg" alt="McDonald Ad Busters"/>
        </div>

        <div class="item">
            <img class="none" src="<?php echo $this->baseurl ?>/images/stories/mcdicks004.jpg" alt="McDonald Ad Busters"/>
        </div>

        <div class="item">
            <a href="http://eclecticmeme.com/index.php?option=com_content&id=7%3Achapter-four&catid=2%3A2007&Itemid=13#KingRonald" title="Meet King Ronald III"><img class="none" src="<?php echo $this->baseurl ?>/images/stories/mcdicks005.jpg" alt="McDonald Ad Busters"/></a>
        </div>

    </div>

</div>





<?php defined( '_JEXEC' ) or die( 'Restricted access' );
    $blueprints				= $this->blueprints;
    $x						= count($this->blueprints);
    $index					= $x + 1;
    $now					= time();
    $javascript				= 'onchange="changeDisplayImage();"';
    $directory				= '/images/banners';
    $lists['blueprints']	=  JHTML::_('select.genericlist', $this->blueprints , 'blueprints',$javascript, 'id', 'name' );

?>

<div id="factory_noob" class="sample">
    <div class="mask3">
        <div id="box4">
            <div>


    <!-- ///////////////////////////////////////////////////conveyor_progress ////////////////////////////////////////////////-->
                <div id = 'conveyor_progress' style='visibility: hidden;'>
                    <p>
                        <label title="when manufacturing began">Started: </label><span id="since"></span>
                    </p>
                    <p>
                        <label>Current Time: </label><span id="now"><?php echo date('l jS \of F Y h:i:s A',$now) ; ?></span>
                    </p>
                    <div id="time_elapsed" class='wrapper sec'>
                        <label title="since manufacturing began">Time Elapsed: </label> <span id="elapsed"> </span> secs
                    </div>

                    <div id="time_remaining" class='wrapper sec'>
                        <label title="until manufacturing is complete">Time Remaining: </label>
                        <span id="remaining"> </span>secs
                    </div>

                </div>
    <!-- ///////////////////////////////////////////////////end of conveyor_progress ////////////////////////////////////////////////-->
                    <h3>Conveyor 1</h3>
                    <?php
                    // print_r ($x);
                    ?>
                    <form class="conveyor" action="index.php" method="get" name="adminForm" id="adminForm">

                    <fieldset class="object2">

                    <legend>Object</legend>

                    <input type="text" title="Object ID" name="id1" id="id1" value = "<?php echo $blueprints[0]->id ;?>" size="2" style="width: 10px;" maxlength="2"
                    readonly="readonly" />


                    <?php echo '' .  $lists['blueprints'] . '';?>


                    <label title="Quantity of Objects Required" for="quantity_adjust">qty:</label>

                    <input type="text" id="quantity_adjust" name="quantity_adjust" value="0" style="width:20px;" size="2" onchange="alterQuantity(this.form)" />

                    <input title="Increase Quantity" type="button" id="quantity_box_button_up" value="+" size="4" />

                    <input title="Decrease Quantity" type="button" id="quantity_box_button_down" value="-" size="4" />

                    <label title="Time To Manufacture Required" >Time:</label>
                    <input type="text" id="time" name="time" readonly='readonly' value="<?php echo $blueprints[0]->man_time ;?>" style="width:20px;" size="2" onchange="alterQuantity(this.form)" />

                    <span title="Start Reprocessing" id='submit_c'>Submit</span>

                     <label title="In Stock" for="stock">In Stock:</label>
                    <input class="inputbox" type="text" size="4" maxlength="4" value="<?php echo $blueprints[0]->object_total ;?>" name="stock" id="stock"  style="width: 20px;" />


                    </fieldset>

                    <fieldset class="metal2">

                                            <legend title="What the object is made from">Material</legend>

                        <fieldset>
                        <label title="Type of Metal required" for="n1">Metal:</label>
                        <input class="inputbox" type="text" size="4" maxlength="6" name="n1" id="n1" style="width: 70px;" value="<?php echo $blueprints[0]->metal_1_name ;?>" />

                        <label title="Units per Object" for="q1">units:</label>
                        <input class="inputbox" type="text" size="1" maxlength="2" name="q1" id="q1" style="width: 20px;" value="<?php echo $blueprints[0]->quantity_1 ;?>" />

                        <label title="Total Units" for="q1t">total:</label>
                         <input class="inputbox" type="text" size="1" maxlength="2"  name="q1t" id="q1t" style="width: 20px;" />


                         </fieldset>

                                <fieldset>
                                <label title="Type of Metal required" for="n2">Metal:</label>
                                <input class="inputbox" type="text" size="4" maxlength="6" name="n2" id="n2" style="width: 70px;" value="<?php echo $blueprints[0]->metal_2_name ;?>" />


                                 <label title="Units per Object" for="q2" >units:</label>
                                  <input class="inputbox" type="text" size="1" maxlength="1" name="q2" id="q2" style="width: 20px;" value="<?php echo $blueprints[0]->quantity_2 ;?>" />


                                  <label title="Total Units" for="qt2" >total:</label>
                                <input class="inputbox" type="text" size="1" maxlength="2"  name="q2t" id="q2t" style="width: 20px;"  />
                                </fieldset>

                                        </fieldset>
                                        <input type="hidden" name="c" value="banner" />
                                        <input type="hidden" name="id" value="" />
                                        <input type="hidden"name="name" value="" />
                                        <input type="hidden" name="task" value="" />
                        </form>
                <?php echo $this->loadTemplate ("hobbit_workforce"); ?>

                <?php echo $this->loadTemplate ("timebar"); ?>

                <ul class="inline">
                    <li>Number of Employees: 7</li>
                    <li>Employees Morale: 70%</li>
                    <li>Employee Efficiency: 95%</li>
                </ul>


                <div id = 'hobbit_names' style="float:right;width:20%;" >
                    <?php
                    $i= 1;
                    foreach ($this->building_hobbit_stats->hobbitList as $hobbit)
                    {
                        if ($hobbit->status == 2)
                        {
                            //print_r($hobbit);
                            echo ($hobbit->name . " [remove]<br/>");
                        }
                        //$i++;
                    }
                    ?>


                </div>








                    </div>

                </div>
        </div>

</div>


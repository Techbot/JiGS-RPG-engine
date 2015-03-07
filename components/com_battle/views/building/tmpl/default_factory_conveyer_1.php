                <?php
                // print_r ($x);

                ?>
                <form class="conveyor" action="index.php" method="get" name="adminForm" id="adminForm"><fieldset class="object">

                <legend>Object</legend>

                <input type="text" title="Object ID" name="id1" id="id1" value = "1" size="2" style="width: 10px;" maxlength="2" 
                readonly="readonly" />


                <?php echo '' .  $this->lists['blueprints'] . '';?>


                <label title="Quantity of Objects Required" for="quantity_adjust">qty:</label>

                <input type="text" id="quantity_adjust" name = "quantity_adjust" value = "0" style = "width:20px;" size="2" onchange = "alterQuantity(this.form)" /> 

                <input title="Increase Quantity" type="button" id="quantity_box_button_up" value="+" size="4" /> 

                <input title="Decrease Quantity" type="button" id="quantity_box_button_down" value="-" size="4" /> 

				<br>	
				
                <label title="Time To Manufacture Required" >Time:</label>
                <input type="text" id="time" name="time" readonly='readonly' value="<?php echo $this->blueprints[0]->man_time ;?>" style="width:20px;" size="2" onchange="alterQuantity(this.form)" /> 

                <span title="Start Manufacturing" id='submit_c'>Submit</span>
                </fieldset>

                <fieldset class="metal">

						                <legend title="What the object is made from">Material</legend>

                <fieldset>
                <label title="Type of Metal required" for="n1">Metal:</label> 
                <input class="inputbox" type="text" size="4" maxlength="6" name="n1" id="n1" style="width: 70px;" value="<?php echo $this->blueprints[0]->metal_1_name ;?>" /> 

                <label title="Units per Object" for="q1">units:</label> 
                <input class="inputbox" type="text" size="1" maxlength="2" name="q1" id="q1" style="width: 20px;" value="<?php echo $this->blueprints[0]->quantity_1 ;?>" /> 

                <label title="Total Units" for="q1t">total:</label>
                 <input class="inputbox" type="text" size="1" maxlength="2"  name="q1t" id="q1t" style="width: 20px;" /> 

                 <label title="In Stock" for="stock">In Stock:</label>
                <input class="inputbox" type="text" size="1" maxlength="2" value="<?php echo $this->blueprints[0]->metal_1_stock ;?>" name="stock" id="stock"  style="width: 20px;" />
                 </fieldset>

                <fieldset>
                <label title="Type of Metal required" for="n2">Metal:</label>
                <input class="inputbox" type="text" size="4" maxlength="6" name="n2" id="n2" style="width: 70px;" value="<?php echo $this->blueprints[0]->metal_2_name ;?>" /> 
                 
                 
                 <label title="Units per Object" for="q2" >units:</label>
                  <input class="inputbox" type="text" size="1" maxlength="1" name="q2" id="q2" style="width: 20px;" value="<?php echo $this->blueprints[0]->quantity_2 ;?>" /> 

                  
                  <label title="Total Units" for="qt2" >total:</label>
                <input class="inputbox" type="text" size="1" maxlength="2"  name="q2t" id="q2t" style="width: 20px;"  />


                <label title="In Stock" for="stock2">In Stock:</label> 
                <input class="inputbox" type="text" size="1" maxlength="2" name="stock2" id="stock2"  style="width: 20px;" value="<?php echo $this->blueprints[0]->metal_2_stock ;?>" />

                </fieldset>

                </fieldset>
                <input type="hidden" name="c" value="banner" />
                <input type="hidden" name="id" value="" />
                <input type="hidden" name="name" value="" /> 
                <input type="hidden" name="task" value="" />
               
                
                
                
                				
				
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
        </form>
				
                
        <script>
		//	prepare();
		//	prepare2();
		//	work_conveyer();
		//	check_factory.periodical(5000);
		</script>         
                

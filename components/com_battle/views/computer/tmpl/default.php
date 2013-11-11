<?php


	$user =& JFactory::getUser();	

?>

<form action= 'index.php' id = 'adminform'>




<?php
echo " <p> Hello " . $user->username . " <br />welcome to the Land of Ones and Zero's. <br />";
echo " <br />";
echo " <br />";
echo " <br /><pre>";
echo "=======================================================================<br />";
echo "=                                     Please enter unlock code        =<br />";
echo "=======================================================================<br /></pre>";

?>   
<input class='text_area' type='text' name='digit1' id='digit1' size='2' maxlength='2' value=''>  ==       
<input class='text_area' type='text' name='digit2' id='digit2' size='2' maxlength='2' value='' > ==        
<input class='text_area' type='text' name='digit3' id='digit3' size='2' maxlength='2' value='' > ==       
<input class='text_area' type='text' name='digit4' id='digit4' size='2' maxlength='2' value='' > == <br />

<?php
echo "<pre>==                                                                    =<br />";
echo "=======================================================================<br />";
echo " <br /></pre>";
 ?>
 
<input type="hidden" name="option" value="com_battle" />
<input type="hidden" name="action" value="unlock" />
<input type="hidden" name="view" value="computer" />
<input type ='submit'>
</form>

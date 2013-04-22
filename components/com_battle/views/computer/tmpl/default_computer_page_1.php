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
echo "=                              Code Correct                           =<br />";
echo "=======================================================================</pre><br />";
?>

 =                        = Click " . <a href="index.php?option=com_battle&view=computer">here></a>< to continue                     =<br />"
 
 
 
 <?php                                                                   
echo "<pre>=======================================================================<br />";
echo " <br /></pre>";
 ?>
 
<input type="hidden" name="option" value="com_battle" />
<input type="hidden" name="action" value="unlock" />
<input type="hidden" name="view" value="computer" />
<input type ='submit'>
</form>

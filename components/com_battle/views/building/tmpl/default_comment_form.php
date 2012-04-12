<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<form action="index.php" method="post"> 
<div><strong>Name:</strong></div>
<div><input class="text_area" type="text" name="full_name" id="full_name" value="<?php echo $this->name; ?>" /></div>
<div><strong>Comment:</strong></div>
<div><textarea class="text_area" cols="40" rows="4" name="comment_text" id="comment_text"></textarea></div>
<input type="hidden" name="review_id" value="<?php  echo $this->review->id; ?>" /> 
<input type="hidden" name="task" value="comment" /> 
<input type="hidden" name="option" value="<?php echo $option; ?>" /> 
<input type="submit" class="button" id="button" value="Submit" /> 
</form>
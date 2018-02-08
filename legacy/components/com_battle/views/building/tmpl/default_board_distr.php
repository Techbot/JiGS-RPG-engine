<div class="name">Distribution Systems Control</div>

<form class="primary_0" action="index.php" method="get" name="adminForm_0" id= "adminForm_0">

	<h2>: <span id = 'assign_distribution_cp'><?php echo $this->building_hobbit_stats->distribution; ?></span>:</h2>
	<span id= "assign_distribution" class="assign btn btn-success">Assign Hobbit</span>
	<span id= "remove_distribution" class="remove btn btn-danger">Remove Hobbit</span>
</form>
<br />

<div id = "crops">
<table width = 100%>

<?php
	echo '<tr>';
	echo '<td> name </td>';
	echo '<td> amount </td>';
	echo '</tr>';

	foreach ($this->crop_stats as $thing)
	{
		echo '<tr>';
		echo '<td> ' . $thing->name . ' : </td>';
		echo '<td> ' . $thing->amount . '  </td>';
		echo '</tr>';
	}
?>

</table>

</div>

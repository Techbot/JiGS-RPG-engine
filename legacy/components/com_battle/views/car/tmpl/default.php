<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport( 'joomla.methods' );?>


<Table >
<tr ><td width='25%'>id</td><td><?php echo $this->cars->id ; ?></td><tr>
<tr ><td width='25%'>reservoir</td><td><?php echo $this->cars->reservoir ; ?></td><tr>
<tr ><td width='25%'>temps</td><td><?php echo $this->cars->temps ; ?></td><tr>	
<tr ><td width='25%'>name</td><td><?php echo $this->cars->name ; ?></td><tr>
<tr ><td width='25%'>commentaire</td><td><?php echo $this->cars->commentaire ; ?></td><tr>
<tr ><td width='25%'>defense </td><td><?php echo $this->cars->defense ; ?></td><tr>
<tr ><td width='25%'>consommation</td><td><?php echo $this->cars->consommation ; ?></td><tr>	
<tr ><td width='25%'>tenue_route</td><td><?php echo $this->cars->tenue_route ; ?></td><tr>
<tr ><td width='25%'>puissance </td><td><?php echo $this->cars->puissance ; ?></td><tr>
<tr ><td width='25%'>prix_plein</td><td><?php echo $this->cars->prix_plein ; ?></td><tr>
<tr ><td width='25%'>prix_achat</td><td><?php echo $this->cars->prix_achat ; ?></td><tr>
<tr ><td width='25%'>rapidite</td><td><?php echo $this->cars->rapidite ; ?></td><tr>
<tr ><td width='25%'>idmagasin </td><td><?php echo $this->cars->idmagasin ; ?></td><tr>
<tr ><td width='25%'>nombre</td><td><?php echo $this->cars->nombre ; ?></td><tr>
<tr ><td width='25%'>xp</td><td><?php echo $this->cars->xp  ; ?></td><tr>
<tr ><td width='25%'>special</td><td><?php echo $this->cars->special ; ?></td><tr>

</Table >
<a href="<?php echo htmlspecialchars($this->backlink); ?>">&lt; return to cars</a>



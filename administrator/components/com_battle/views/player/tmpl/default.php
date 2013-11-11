<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.calendar');
$editor =& JFactory::getEditor();
if ($this->row->id)
{
	JToolBarHelper::title( JText::_( 'Edit Player Profile' ), 'addedit.png' );
}
else
{
	JToolBarHelper::title( JText::_( 'Add Player Profile' ), 'addedit.png' );
}
JToolBarHelper::save();
JToolBarHelper::apply();
if ($this->row->id)
{
	JToolBarHelper::cancel( 'cancel', 'Close' );
}
else
{
	JToolBarHelper::cancel();
}
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
  <fieldset class="adminform">
    <legend>Details</legend>
    <table class="admintable">
    <tr>
      <td width="100" align="right" class="key">
        Name:
      </td>
      <td>
        <input class="text_area" type="text" name="username" id="username" size="50" maxlength="250" value="<?php echo $this->row->username;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
       Latitude:
      </td>
      <td>
        <input class="text_area" type="text" name="posx" id="posx" size="50" maxlength="250" value="<?php echo $this->row->posx;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
       Longitude:
      </td>
      <td>
         <input class="text_area" type="text" name="posy" id="posy" size="50" maxlength="250" value="<?php echo $this->row->posy;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        Health:
      </td>
      <td>
          <input class="text_area" type="text" name="health" id="health" size="50" maxlength="250" value="<?php echo $this->row->health;?>" />
      </td>
    </tr>
        <tr>
      <td width="100" align="right" class="key">
         $image 
      </td>
      <td>
            <input class="text_area" type="text" name="image" id="image" size="50" maxlength="250" value="<?php echo $this->row->image ;?>" />
      </td>
    </tr>
        <!--tr>
      <td width="100" align="right" class="key">
       coffre :
      </td>
      <td>
            <input class="text_area" type="text" name="coffre" id="coffre" size="50" maxlength="250" value="< ?php echo $this->row->coffre ;?>" />
      </td>
    </tr>
	        <tr>
      <td width="100" align="right" class="key">
      option :
      </td>
      <td>
            <input class="text_area" type="text" name="option" id="option" size="50" maxlength="250" value="< ?php echo $this->row->option ;?>" />
      </td>
    </tr-->	
		        <tr>
      <td width="100" align="right" class="key">
      attaque :
      </td>
      <td>
            <input class="text_area" type="text" name="attack" id="attack" size="50" maxlength="250" value="<?php echo $this->row->attack ;?>" />
      </td>
    </tr>		        <tr>
      <td width="100" align="right" class="key">
      defense :
      </td>
      <td>
            <input class="text_area" type="text" name="defence" id="defence" size="50" maxlength="250" value="<?php echo $this->row->defence ;?>" />
      </td>
    </tr>	
			        <!--tr>
      <td width="100" align="right" class="key">
      discretoion :
      </td>
      <td>
            <input class="text_area" type="text" name="discretion" id="discretion" size="50" maxlength="250" value="< ?php echo $this->row->discretion ;?>" />
      </td>
    </tr>		        <tr>
      <td width="100" align="right" class="key">
      rapidte:
      </td>
      <td>
            <input class="text_area" type="text" name="rapidte" id="rapidte" size="50" maxlength="250" value="< ?php echo $this->row->rapidte ;?>" />
      </td>
    </tr>	
				        <tr>
      <td width="100" align="right" class="key">
      visibilite :
      </td>
      <td>
            <input class="text_area" type="text" name="visibilite" id="visibilite" size="50" maxlength="250" value="< ?php echo $this->row->visibilite ;?>" />
      </td>
    </tr-->		        <tr>
      <td width="100" align="right" class="key">
      puissance:
      </td>
      <td>
            <input class="text_area" type="text" name="puissance" id="puissance" size="50" maxlength="250" value="<?php echo $this->row->puissance ;?>" />
      </td>
    </tr>
				        <tr>
      <td width="100" align="right" class="key">
      intelligence :
      </td>
      <td>
            <input class="text_area" type="text" name="intelligence" id="intelligence" size="50" maxlength="250" value="<?php echo $this->row->intelligence ;?>" />
      </td>
    </tr>		        <!--tr>
      <td width="100" align="right" class="key">
      equipe :
      </td>
      <td>
            <input class="text_area" type="text" name="equipe" id="equipe" size="50" maxlength="250" value="< ?php echo $this->row->equipe  ;?>" />
      </td>
    </tr-->
				        <tr>
      <td width="100" align="right" class="key">
      argent  :
      </td>
      <td>
            <input class="text_area" type="text" name="money" id="money" size="50" maxlength="250" value="<?php echo $this->row->money  ;?>" />
      </td>
    </tr>		        <tr>
      <td width="100" align="right" class="key">
     xp :
      </td>
      <td>
            <input class="text_area" type="text" name="xp" id="xp" size="50" maxlength="250" value="<?php echo $this->row->xp  ;?>" />
      </td>
    </tr>
					        <!--tr>
      <td width="100" align="right" class="key">
     idvoiture  :
      </td>
      <td>
            <input class="text_area" type="text" name="idvoiture" id="idvoiture" size="50" maxlength="250" value="< ?php echo $this->row->idvoiture  ;?>" />
      </td>
    </tr-->		        <tr>
      <td width="100" align="right" class="key">
   reservoir :
      </td>
      <td>
            <input class="text_area" type="text" name="reservoir" id="reservoir" size="50" maxlength="250" value="<?php echo $this->row->reservoir ;?>" />
      </td>
    </tr>
					        <tr>
      <td width="100" align="right" class="key">
    idarme :
      </td>
      <td>
            <input class="text_area" type="text" name="idarme" id="idarme" size="50" maxlength="250" value="<?php echo $this->row->idarme  ;?>" />
      </td>
    </tr>		        <!--tr>
      <td width="100" align="right" class="key">
   munition :
      </td>
      <td>
            <input class="text_area" type="text" name="munition" id="munition" size="50" maxlength="250" value="< ?php echo $this->row->munition;?>" />
      </td>
    </tr>
					        <tr>
      <td width="100" align="right" class="key">
    actif :
      </td>
      <td>
            <input class="text_area" type="text" name="actif" id="actif" size="50" maxlength="250" value="< ?php echo $this->row->actif  ;?>" />
      </td>
    </tr-->		        <tr>
      <td width="100" align="right" class="key">
  tempsplanque:
      </td>
      <td>
            <input class="text_area" type="text" name="tempsplanque" id="tempsplanque" size="50" maxlength="250" value="<?php echo $this->row->tempsplanque;?>" />
      </td>
    </tr>
					        <!--tr>
      <td width="100" align="right" class="key">
    banque :
      </td>
      <td>
            <input class="text_area" type="text" name="banque" id="banque" size="50" maxlength="250" value="< ?php echo $this->row->banque ;?>" />
      </td>
    </tr-->		        <tr>
      <td width="100" align="right" class="key">
  tempsmove:
      </td>
      <td>
            <input class="text_area" type="text" name="tempsmove" id="tempsmove" size="50" maxlength="250" value="<?php echo $this->row->tempsmove;?>" />
      </td>
    </tr>	
	<tr>
      <td width="100" align="right" class="key">
  ip :
      </td>
      <td>
            <input class="text_area" type="text" name="ip" id="ip" size="50" maxlength="250" value="<?php echo $this->row->ip ;?>" />
      </td>
    </tr>		        <tr>
      <td width="100" align="right" class="key">
  commentaire:
      </td>
      <td>
            <input class="text_area" type="text" name="commentaire" id="commentaire" size="50" maxlength="250" value="<?php echo $this->row->commentaire;?>" />
      </td>
    </tr>
				        <!--tr>
      <td width="100" align="right" class="key">
  casier :
      </td>
      <td>
            <input class="text_area" type="text" name="casier" id="casier" size="50" maxlength="250" value="< ?php echo $this->row->casier;?>" />
      </td>
    </tr>		        <tr>
      <td width="100" align="right" class="key">
  mort :
      </td>
      <td>
            <input class="text_area" type="text" name="mort" id="mort" size="50" maxlength="250" value="< ?php echo $this->row->mort ;?>" />
      </td>
    </tr-->
					        <tr>
      <td width="100" align="right" class="key">
  parrainage  :
      </td>
      <td>
            <input class="text_area" type="text" name="parrainage" id="parrainage" size="50" maxlength="250" value="<?php echo $this->row->parrainage ;?>" />
      </td>
    </tr>		        <tr>
      <td width="100" align="right" class="key">
 stupefiant :
      </td>
      <td>
            <input class="text_area" type="text" name="stupefiant" id="stupefiant" size="50" maxlength="250" value="<?php echo $this->row->stupefiant ;?>" />
      </td>
    </tr>
				        <tr>
      <td width="100" align="right" class="key">
  volevoiture  :
      </td>
      <td>
            <input class="text_area" type="text" name="volevoiture" id="volevoiture" size="50" maxlength="250" value="<?php echo $this->row->volevoiture ;?>" />
      </td>
    </tr>		        <tr>
      <td width="100" align="right" class="key">
 volearme  :
      </td>
      <td>
            <input class="text_area" type="text" name="volearme" id="volearme" size="50" maxlength="250" value="<?php echo $this->row->volearme  ;?>" />
      </td>
    </tr>				        <tr>
      <td width="100" align="right" class="key">
  voleargent  :
      </td>
      <td>
            <input class="text_area" type="text" name="voleargent" id="voleargent" size="50" maxlength="250" value="<?php echo $this->row->voleargent ;?>" />
      </td>
    </tr>		        <tr>
      <td width="100" align="right" class="key">
 nbrattaque :
      </td>
      <td>
            <input class="text_area" type="text" name="nbrattaque" id="nbrattaque" size="50" maxlength="250" value="<?php echo $this->row->nbrattaque ;?>" />
      </td>
    </tr>
    </table>
  </fieldset>
 <?php echo JHTML::_( 'form.token' ); ?>
  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />	
  <input type="hidden" name="option" value="com_battle" />
  <input type="hidden" name="controller" value="players" />
  <input type="hidden" name="task" value="" />
</form>

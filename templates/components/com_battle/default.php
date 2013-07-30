<?php
/**
 * @version		: default.php 2013-04-27 04:10:57$
 * @author		EMC23.com
 * @package		Saasmarkets
 * @copyright	Copyright (C) 2013- . 
 * @license		GNU/GPL
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
require_once(JPATH_COMPONENT.DS.'models'.DS.'portalhomepage.php');

JHTML::_('behavior.tooltip');


$model				= new SaasmarketsModelPortalhomepage;

$app				=& JFactory::getApplication();
$partner_portal_id	= $app->getCfg('partner_portal_id'); // from config
require_once(JPATH_COMPONENT.DS.'models'.DS.'design.php');

$modelDesign		= new SaasmarketsModelDesign;
$sTask				= JRequest::getVar("task");
$categoryid			= JRequest::getVar("categoryid");
$prodid				= JRequest::getVar("prodid");
$menu				= JRequest::getVar("menu");

$sItemId="115";

if ($sTask=="loadComparation"){
		$iAdd = JRequest::getVar("idAppl","");
		$iPortal = JRequest::getVar("iPortal");
		$iTotalForCompare = count($_SESSION['compare_'.$iPortal]);
		$act = JRequest::getVar("act","");	
	
	//adauga
	//check to see if this prod id exist
	$bDoesExist = false;
	if (isset($_SESSION['compare_'.$iPortal])){
		foreach ($_SESSION['compare_'.$iPortal] as $oneProd1){
			if ($oneProd1==$iAdd){
				$bDoesExist=true;
			}
		}
	}
	if ($iAdd!="" && $iTotalForCompare<4 && $act=="" && $bDoesExist==false){	$_SESSION['compare_'.$iPortal][]=$iAdd;}
	
	
	//sterge
	if ($iAdd!="" && $iTotalForCompare>0 && $act=="del"){
		foreach ($_SESSION['compare_'.$iPortal] as $key=>$oneProdForDel){
			if ($oneProdForDel==$iAdd){ unset($_SESSION['compare_'.$iPortal][$key]);}
		}
	}
	
	$iTotalForCompare = count($_SESSION['compare_'.$iPortal]);
	//@todo verify to be for this portal id
	if ($iTotalForCompare!=0){
		
		foreach ($_SESSION['compare_'.$iPortal] as $idAppl){
			$oneAppldetails = $model->getOneApplicationDetails($idAppl);

		?>
			<div class="compare_product_contaniner">
                        <div class="compare_product"><?php echo $oneAppldetails->app_name;?></div>
                        <div class="compare_remove"><a href="javascript:void(0);" onClick="removeFromComparation(<?php echo $oneAppldetails->id_appl;?>)">X</a></div>
                        <br clear="all">
                    </div>
		<?php }?>
		
<!--		<a rel="shadowbox[compare];width=650;height=530;" href="<?php echo "index.php?option=com_saasmarkets&view=portalhomepage&task=showComparationWindow&Itemid=106";?>" class="btn_compare"><strong>Compare</strong></a>-->
<!--			<a  href="javascript:void(0);" onClick="openCompareWindow()" class="btn_compare"><strong>Compare</strong></a>-->
			<a  href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$iPortal."&menu=compare&Itemid=".$sItemId);?>" class="btn_compare"><strong>Compare</strong></a>
        
           
         <?php 

         //load the comparation modal window

    $sHtmlForModalWindow = '<link type="text/css" href="'.JURI::root().'components/com_saasmarkets/assets/css/generalwhitelabel.css" rel="stylesheet">';
    //if portal have loaded another css then load it
    //get the portal file name
    $arrPortalDetails = $model->getOnePortalDetails($iPortal);
	$sCssDir = JURI::root()."images/users/u_".$arrPortalDetails->id_joomlauser."/".$arrPortalDetails->portal_css;
	//$document->addStyleSheet( $sCssDir );
	$sHtmlForModalWindow = '<link type="text/css" href="'.$sCssDir.'" rel="stylesheet">';

	$sHtmlForModalWindow .= '
	<style>
	/***************************************************************************** 
COMPARE PAGE 
*****************************************************************************/

.compare_container{ background-color:#ffffff; color:#808080; width:623px; min-height:455px; font-size:10px; padding:30px 7px 45px 15px;}
	.compare_container h1{ font-size:16px; padding:6px 0 6px 0;}

	.compare_box{ background-color:#FFFFFF; width:135px; float:left; margin:0 8px 5px 0; min-height:400px; border:#d6d6d6 solid 1px; padding:20px 5px 20px 5px;border-radius: 6px 6px 6px 6px;box-shadow: 0 -1px 0 #ACACAC inset;}
		
		.compare_logo{ width:135px; height:61px; overflow:hidden; margin:0 0 10px 0;}
	</style>
	';



	$sHtmlForModalWindow .= '<h1>Compare applications</h1>';
	
	
	if (count($_SESSION['compare_'.$iPortal])!=0){
		
		foreach ($_SESSION['compare_'.$iPortal] as $idAppl){
			$oneAppldetails = $model->getOneApplicationDetails($idAppl);

			// also pull application price options
			$oneApplPriceOptions = $model->getOneApplicationPriceOptions($idAppl);			
			
			$sHtmlForModalWindow .= '<div class="compare_box"><!-- start compare_box -->
    	
							        <div class="compare_logo">
							        	<img src="'.JURI::root().'images/marketmaker/appl/'.$oneAppldetails->id_appl.'/logo.jpg" alt="no logo" />
							        </div>
							        
							        <strong>'.$oneAppldetails->app_name.'</strong><br><br>
							        
							        '.$oneAppldetails->app_key_diff1.'
							        <br><br> 
							        
							        '.$oneAppldetails->app_key_diff2.'
							        <br><br> 
							        
							        '.$oneAppldetails->app_key_diff3.'
							        <br><br> 
							        
							        '.$oneAppldetails->app_key_diff4.'
							        <br><br>'; 
							        
							        foreach($oneApplPriceOptions as $priceOption){
							        	
							        	$sHtmlForModalWindow .= '<div class="portal_com_option_name">'.$priceOption->app_price_option_name.'</div>';

							        	$sHtmlForModalWindow .= '<div class="portal_com_price_blk">';
							        	$sHtmlForModalWindow .= '<span class="portal_com_price_num">';

										$arrCur = $model->getAppCurrencyName($priceOption->id_currency);

						        		if($arrCur->symbol_left){
						        			$sHtmlForModalWindow .= $arrCur->symbol_left;
						        		}else{
						        			$sHtmlForModalWindow .= $arrCur->symbol_right;
						        		}

							        	$sHtmlForModalWindow .= $priceOption->app_price.'</span>';

										$sHtmlForModalWindow .= '<span class="portal_com_price_uit">';	
										$arrFre = 	$model->getAppFrequencyName($priceOption->id_frequency);
								        $sHtmlForModalWindow .= $arrFre->frequency_name;
								        
								        $sHtmlForModalWindow .= '</span></div><br><br>';

							        	$sHtmlForModalWindow .= $priceOption->app_what_included;

							        }
							        
				$sHtmlForModalWindow .= '</div>';
			
		 }
		
		 }?>
		
		
        
        <div id="compare_container1" style="display:none;">
        	<div class="compare_container">
        	<?php echo $sHtmlForModalWindow;?>
        </div>
           
            	
	<?php }else{?>
		<div class="compare_empty">
			<h2>Select and compare</h2> 
			<img src="<?php echo JURI::root()?>components/com_saasmarkets/assets/images/portal/compare_img.png" /><br />
			<p>Choose up to 4 apps by clicking on the compare button to the left.</p>
		</div>
	<?php }
	exit;
}









if ($sTask=="ajaxSaveVote"){
	echo json_encode($model->ajaxSaveVote($_REQUEST));
	exit;
}



if ($sTask=="viewVideo"){
	echo $model->getVideoEmbed(JRequest::getVar("videoid"));
	exit;
}

$sPortalView = JRequest::getVar("portal"); //portal id redeclarat aici si mai jos
if (!isset($_SESSION['basket_'.$sPortalView])) $_SESSION['basket_'.$sPortalView]=array();


if ($sTask=="memoClick"){
	echo json_encode($model->memoClick(JRequest::getVar("idPortal"),JRequest::getVar("field"),JRequest::getVar("sUrlToGo"), JRequest::getVar("idAppl")));
	exit;
}

if ($sTask=="addToBasket"){
	echo json_encode($model->addToBasket(JRequest::getVar("idResource"),JRequest::getVar('iPortalId')));
	exit;
}

if ($sTask=="updateCartQuantity"){
	echo json_encode($model->updateCartQuantity($_REQUEST));
	exit;
}

if ($sTask=="removeFromBasket"){
	$model->removeFromBasket(JRequest::getVar("idResource"),JRequest::getVar("portal"));
	echo json_encode(array("url"=>JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".JRequest::getVar("portal")."&menu=basket&Itemid=".$sItemId)));
	exit;
}

if ($sTask=="saveConUser"){

session_start();
	echo $model->saveConUser($_REQUEST);
	exit;
}

if ($sTask=="redirectAfterLogin"){

session_start();
	
	if (isset($_SESSION['paymentdetails'])){
		echo json_encode(array("url"=>JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".JRequest::getVar("portal")."&menu=basket&subtask=basket2&Itemid=".$sItemId)));
	}else{
	}
	
	exit;
}

 if ($sTask=="activateuser"){
	$arrResponse = $model->activateUser(JRequest::getVar("token"));
	$iUserId = $arrResponse['userid'];
	//find iuserid
	$user =& JFactory::getUser($iUserId);
	$sUserName = $user->get("name");
//	$sSaasLogo = "<img src='".JURI::root()."templates/saastemplate/images/saas_logo.png' alt='Saasmarkets.com'/>";

	
	
	
	$idPortal = $model->getIdPortalByConsumerJU($iUserId);

	
	
//find id portal from user id
	$arrPortalDetails = $model->getOnePortalDetails($idPortal);
	$sFolderPath = $sUploadsDir = JURI::root()."/images/users/u_".$arrPortalDetails->id_joomlauser."/";

//	$sSaasLogo = "<img src='".JURI::root()."templates/saastemplate/images/saas_logo.png' alt='Saasmarkets.com'/>";
	$sSaasLogo = "<img src='".$sFolderPath.$arrPortalDetails->portal_logo."' alt='".$arrPortalDetails->portal_name."'/>";
	
	
	$sToBody = JText::sprintf(
				'COM_SAAS_EMAIL_ADMIN_NEWSSM_REGISTER',
				$sSaasLogo,
				$sUserName
			);
	
	$modelDesign->sendEmailToSM($sToBody);
	
	
	if ($arrResponse['affectedRows']==1){
		 //login automat
		  //redirecteaza catre pagina de profile
		 $model->automatLoginUser($iUserId,JRequest::getVar("portal"));
		
	}else{
		//inseamna ca e activat => redirecteza catre pagina de login
		header("location: ".JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".JRequest::getVar("portal")."&Itemid=".$sItemId));
	}
}


$sMenu = JRequest::getVar("menu","home");


$sPortalView = JRequest::getVar("portal"); //portal id

$arrPortalDetails = $model->getOnePortalDetails($sPortalView);

$sFolderPath = $sUploadsDir = JURI::root()."images/users/u_".$arrPortalDetails->id_joomlauser."/";



$document = &JFactory::getDocument();
// $document->addScript( JURI::root().'components/com_saasmarkets/assets/js/jquery.hint.js' );
$document->addScript( JURI::root().'components/com_saasmarkets/assets/js/generalwhitelabel.js' );
$document->addStyleSheet( JURI::root().'components/com_saasmarkets/assets/css/generalwhitelabel.css' );

if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7') !== false) {

	$document->addStyleSheet( JURI::root().'components/com_saasmarkets/assets/css/generalwhitelabel_ie.css' );
}


// add password retrieval css and javascript
$document->addStyleSheet( JURI::root().'components/com_saasmarkets/assets/portal/css/portal.main.css' );
$document->addScript( JURI::root().'components/com_saasmarkets/assets/portal/js/portal.main.js' );

//load here the css file for this portal
//get the portal file name
$sCssDir = JURI::root()."images/users/u_".$arrPortalDetails->id_joomlauser."/".$arrPortalDetails->portal_css;
$document->addStyleSheet( $sCssDir );


/*****************************start CHANGE title************************************************/
$sTitle = $arrPortalDetails->portal_name;
//if ($sMenu=="home"){$bShowTopMenu=false;}else{$bShowTopMenu=true;}
$bShowTopMenu=true;
switch ($sMenu) {
			case "home":
				$sTitle .= " - Home";
				$bShowTopMenu=false;
				break;
			case "browseproducts":
				$sTitle .= " - Browse products";
				break;
			case "productdetails":
				$sTitle .= " - Product details";
				break;
			case "resources":
				$sTitle .= " - Resources";
				break;
			case "basket":
				$sTitle .= " - Basket";
				$bShowTopMenu=false;
				break;
			case "consumerlogin":
				$sTitle .= " - Login";
				$bShowTopMenu=false;
				break;
			case "consumerregister":
				$bShowTopMenu=false;
				$sTitle .= " - Register";
				break;
			case "consumeraccount":
				$sTitle .= " - Your account";
				$bShowTopMenu=false;
				break;
			case "democenter":
				$sTitle .= " - Demo center";
				break;
			case "appuniversity":
				$sTitle .= " - App University";
				break;
			case "productscreenshots":
				$sTitle .= " - Screenshots and demos";
				break;
			case "privacystatement":
				$sTitle .= " - Privacy Statement";
				$bShowTopMenu=false;
				break;
			default:
				$sTitle .= " - Home";
				
			break;
		}
		
/*****************************end CHANGE title************************************************/
//change meta title for the portal
$document->setTitle($sTitle);


if ($_SESSION['basket_'.$sPortalView]=="") $_SESSION['basket_'.$sPortalView]=array();


$user =& JFactory::getUser();
$iLoggedConsumerId = $user->get("id");





//if the user is logged in AND is NOT  a consumer for this portal logout him
if ($iLoggedConsumerId!=0){
	if (!$model->bIsConForPortalById($sPortalView,$iLoggedConsumerId)){
		
		//logout the user
	
	//	header("location: ".JURI::root()."index.php?option=com_users&task=user.logout&".JUtility::getToken()."=1&return=".base64_encode("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$sPortalView."&Itemid=115"));
	}
}


$doc      = JFactory::getDocument();
$renderer = $doc->loadRenderer( 'modules' );
$raw      = array( 'style' => 'raw' );
echo "<div style='display:none;'>".$renderer->render('hiddenmenuposition', $raw, null)."</div>";




?>


<div class="content_narrow"><!-- start content_narrow -->

  

</div><!-- end content_narrow -->

<div class="content_wide"><!-- start wrapper_wide -->
	<div class="content_wide_nav_holder"><!-- start content_wide_nav_holder -->
	
    <div id="main_nav_container"><!-- start main_nav_container -->
    	<div class="main_nav_home">
			<a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$sPortalView."&Itemid=".$sItemId);?>">Home</a>
		</div>
        
           <!-- 
           <div id="navlist_container">
            <ul id="navlist" style="margin-top: 0px;">
              <li class="<?php if ($sMenu=="home"){?>active<?php }?>"><a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$sPortalView."&Itemid=".$sItemId);?>">Home</a></li>
                <li id="spacer">&nbsp;</li>
               
                <li class="<?php if ($sMenu=="browseproducts"){?>active<?php }?>"><a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$sPortalView."&menu=browseproducts&Itemid=".$sItemId);?>">Browse Products</a></li>
                <li id="spacer">&nbsp;</li>
                
                 
                <li class="<?php if ($sMenu=="democenter"){?>active<?php }?>"><a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$sPortalView."&menu=democenter&Itemid=".$sItemId);?>">Demo Center</a></li>
                <li id="spacer">&nbsp;</li>
                <li class="<?php if ($sMenu=="appuniversity"){?>active<?php }?>"><a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$sPortalView."&menu=appuniversity&Itemid=".$sItemId);?>">App University</a></li>
                <li id="spacer">&nbsp;</li>
                <li class="<?php if ($sMenu=="resources"){?>active<?php }?>"><a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$sPortalView."&menu=resources&Itemid=".$sItemId);?>">Resources</a></li>
                
            </ul>
             </div>
            -->
       
          <?php if ($prodid || $menu == "democenter" || $menu == "appuniversity" || $menu = "resources"){?>   
            <?php if ($bShowTopMenu):?>
            <div id="navlist_container">
            
                <ul id="navlist">
                    <li class="<?php if ($sMenu=="democenter"){?>active<?php }?>"><a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$sPortalView."&menu=democenter&Itemid=".$sItemId);?>">Demo Centre</a></li>
	                <li class="<?php if ($sMenu=="appuniversity"){?>active<?php }?>"><a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$sPortalView."&menu=appuniversity&Itemid=".$sItemId);?>">App University</a></li>
    	            <li class="<?php if ($sMenu=="resources"){?>active<?php }?>"><a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$sPortalView."&menu=resources&Itemid=".$sItemId);?>">Resources</a></li>
                </ul>
                
            </div>
            
            <?php endif;?>
              <?php } ?>
         
        
        
    </div><!-- end main_nav_container -->
     </div><!-- end content_wide_nav_holder -->
    
    <div id="content_container"><!-- start content_container -->
    <?php if ($sMenu=="compare"):
		require_once(JPATH_COMPONENT.DS.'views'.DS.'portalhomepage'.DS.'tmpl'.DS.'middlecontent'.DS.'compare.php');
    else:
    ?>
    	
        <div id="left_nav_container"><!-- start left_nav_container -->

  <?php	// exit(); ?> 
        
        <?php 
			
    //        $sApQuery="&ap=1";
       
    //        if ($sMenu=="productdetails" || $sMenu=="home" || $sMenu=="basket" || $sMenu=="productscreenshots" || $sMenu=="privacystatement"){
    //        $sMenuForMenu = "browseproducts";}else{$sMenuForMenu=$sMenu;
    //        }
            
            $sMenuForMenu = "browseproducts";
          
   //        if ($sMenu=="home" || $sMenu=="basket" || $sMenu=="consumerlogin" || $sMenu=="consumerregister" || $sMenu=="consumeraccount" || $sMenu=="privacystatement")
   //        {
           	$iCategoryId=1;
    //       }
   //         else{
	//             //set category id

	          $iCategoryId = JRequest::getVar("categoryid",$_SESSION['activesaasmenu']);
	        if (  $iCategoryId<1){    
	        	$iCategoryId=1;
	        
	        }
	          
	          
	       session_start(); 
	             //set the category id on session and use it, in case this session is different from 1 to be that one
	           	$_SESSION['activesaasmenu'] = $iCategoryId;
   //         }
   


 
           $iTopCategoryId = $model->getTopCategoryId($sPortalView, $iCategoryId);
 
     
            ?>




                    
        <div id="left_nav_top">
                <h2>Start your search here.</h2>
                
                <div id="left_nav_top_link_container">
                	
                    <div class="left">
                        Filter by:
                    </div>
                    
                	<ul id="lef_nav_top_links">
                		<li class="<?php if ($iTopCategoryId==1) echo "active";?>"><a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&menu=".$sMenuForMenu."&portal=".$sPortalView.$sApQuery."&categoryid=1&Itemid=".$sItemId);?>" class="hasTip" title="By Function::">Function</a></li>
                        <li class="spacer">&nbsp;</li>
						<li class="<?php if ($iTopCategoryId==2) echo "active";?>"><a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&menu=".$sMenuForMenu."&portal=".$sPortalView.$sApQuery."&categoryid=2&Itemid=".$sItemId);?>" class="hasTip" title="By Industry::">Industry</a></li>
                    </ul>
                
                </div>
                
            </div>
            
            
            
  
        
        
        
        
        <!-- 
        	<h4>App Categories</h4>
            
            <form action="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&menu=browseproducts&portal=".$sPortalView.$sApQuery."&Itemid=".$sItemId);?>" method="post" style="display: block; position: absolute;">
            	<input class="app_search_box" name="app_search" type="text" title="Search for Apps..." value="" />
                <button class="btn_app_search" type="submit" value="Submit"/><span class="hidden">Search</span></button>
            </form>
            
             -->
            
            <br clear="all" />
            
        	
           
            <ul id="left_nav">
            
            <?php 
            
           
            
            
            $arrResult = array($iCategoryId);
//			$arrAllParentCateg = $model->getCategoryAllParents($iCategoryId,$arrResult);


//echo $sPortalView;
//echo $iCategoryId;
//echo $arrResult;




			$arrAllParentCateg = $model->getCategoryAllParents($sPortalView, $iCategoryId,$arrResult);
			$arrAllParentCateg = array_reverse($arrAllParentCateg);
			
			
			
      
 
  /*    echo '<pre>' ;
	echo " pre id:" . $iCategoryId . "<br />";
	echo " sPortalview:" . $sPortalView . "<br />";	
	echo " iTopCategoryId:" . $iTopCategoryId . "<br />";		
	echo " sMenuForMenu:" . $sMenuForMenu . "<br />";		
		
	echo " sApQuery:" . $sApQuery . "<br />";		
	echo " sItemId:" . $sItemId . "<br />";		
	
	print_r($arrAllParentCateg);	
	
	echo '</pre>';         
            
    */        
           $model->display_children($sMenuForMenu, $sPortalView,$sApQuery, $sItemId, 0,0,$iCategoryId,$arrAllParentCateg, count($arrAllParentCateg));
       
     
			?>
            
            
            </ul>            
            
            
        </div><!-- end left_nav_container -->
        
        
        
        
        
        
        
        
        
        <?php 
		switch ($sMenu) {
			case "home":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'portalhomepage'.DS.'tmpl'.DS.'middlecontent'.DS.'home.php');
				break;
			case "browseproducts":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'portalhomepage'.DS.'tmpl'.DS.'middlecontent'.DS.'browseproducts.php');
				break;
			case "productdetails":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'portalhomepage'.DS.'tmpl'.DS.'middlecontent'.DS.'productdetails.php');
				break;
			case "resources":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'portalhomepage'.DS.'tmpl'.DS.'middlecontent'.DS.'resources.php');
				break;
			case "basket":
				if (JRequest::getVar("subtask","")=="basket2"){
					require_once(JPATH_COMPONENT.DS.'views'.DS.'portalhomepage'.DS.'tmpl'.DS.'middlecontent'.DS.'basket2.php');
				}else if (JRequest::getVar("subtask","")=="basket3"){
					require_once(JPATH_COMPONENT.DS.'views'.DS.'portalhomepage'.DS.'tmpl'.DS.'middlecontent'.DS.'basket3.php');
				}else{
					require_once(JPATH_COMPONENT.DS.'views'.DS.'portalhomepage'.DS.'tmpl'.DS.'middlecontent'.DS.'basket.php');
				}
				
				break;
			case "consumerlogin":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'portalhomepage'.DS.'tmpl'.DS.'middlecontent'.DS.'consumerlogin.php');
				break;
			case "consumerregister":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'portalhomepage'.DS.'tmpl'.DS.'middlecontent'.DS.'consumerregister.php');
				break;
			case "consumeraccount":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'portalhomepage'.DS.'tmpl'.DS.'middlecontent'.DS.'consumeraccount.php');
				break;
			case "democenter":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'portalhomepage'.DS.'tmpl'.DS.'middlecontent'.DS.'democenter.php');
				break;
			case "appuniversity":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'portalhomepage'.DS.'tmpl'.DS.'middlecontent'.DS.'appuniversity.php');
				break;
			case "productscreenshots":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'portalhomepage'.DS.'tmpl'.DS.'middlecontent'.DS.'productscreenshots.php');
				break;
			case "googlesearch":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'portalhomepage'.DS.'tmpl'.DS.'middlecontent'.DS.'googlesearch.php');
				break;
			case "privacystatement":
				require_once(JPATH_COMPONENT.DS.'views'.DS.'portalhomepage'.DS.'tmpl'.DS.'middlecontent'.DS.'privacystatement.php');
				break;
			default:
				require_once(JPATH_COMPONENT.DS.'views'.DS.'portalhomepage'.DS.'tmpl'.DS.'middlecontent'.DS.'home.php');
			break;
		}
        
        ?>
       
        
        
        <div class="content_right">
        	<br clear="all"> 
        	 
        	
        	<?php if ($categoryid!=406){?>
        	
            <h4>See also</h4>
        	
            <div class="content_150"><!-- start content_150 -->
            
            
            	<div class="top"></div>
            	
            
                <div class="middle">
                	<form action="#" method="post" id="compareform" height="157">
                        <div class="compare_empty" height="157px" width="150px"> 
                            <!-- load by ajax -->
                        </div>
            	</form>
                </div>
                <div class="bottom"></div> 
             

            
            </div><!-- end content_150 -->
     
            <br />
    <?php }


else{

?>
         
            
            <div class="ad_container">
            	
  	
<ul>

<li>
<a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1445&categoryid=406&Itemid=115">Broadband</a>
</li>

<li><a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1466&categoryid=406&Itemid=115">Card Processing</a></li>

<li><a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1444&categoryid=406&Itemid=115"><span>Documentation</span></a></li>

<li><a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1457&categoryid=406&Itemid=115"><span>Dynamic Currency Conversion</span></a></li>

<li><a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1467&categoryid=406&Itemid=115"><span>eStatements</span></a></li>

<li><a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1450&categoryid=406&Itemid=115"><span>Global Access @dvantage</span></a></li>

<li><a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1442&categoryid=406&Itemid=115"><span>Global Iris</span></a></li>

<li><a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1459&categoryid=406&Itemid=115"><span>International Acquiring</span></a></li>

<li><a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1460&categoryid=406&Itemid=115"><span>Packaged Product</span></a></li>

<li><a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1462&categoryid=406&Itemid=115"><span>Stationery</span></a></li>

<li><a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1448&categoryid=406&Itemid=115"><span>Summary Tax</span></a></li>

<li><a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1449&categoryid=406&Itemid=115"><span>Tax Free Shopping</span></a></li>

<li><a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1455&categoryid=406&Itemid=115"><span>Terminals</span></a>
<ul>
<li><a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1455&categoryid=406&Itemid=115"><span>Contactless</span></a></li>
<li><a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1447&categoryid=406&Itemid=115"><span>Desktop</span></a></li>
<li><a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1456&categoryid=406&Itemid=115"><span>Global POS Link</span></a></li>
<li><a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1454&categoryid=406&Itemid=115"><span>Mobile</span></a></li>
<li><a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1453&categoryid=406&Itemid=115"><span>Portable</span></a></li>
</ul>
</li>

<li><a href="index.php?option=com_saasmarkets&view=portalhomepage&portal=13&menu=productdetails&prodid=1451&categoryid=406&Itemid=115"><span>UnionPay</span></a></li>

</ul>
            	
            	
   	
            	
              <?php 





                    //find if there is something set for AD container
                    if ($arrPortalDetails->portal_display_ads!=""){
               //     	echo $arrPortalDetails->portal_display_ads;
                    }
              ?>
                    <?php 
        
        
   
	//	   echo  $partner_portal_id;
		    
		       

                
                
               if($partner_portal_id==68){?>  
                
                

                
                
                
       <a href= "http://gateway.elavon.com/security/index.aspx" ><img src ="http://www.saasmarkets.com/images/security-brand-2.jpg"></a> 
     
        
     <?php   }   ?>
            
            </div>
  
     <?php }

endif; //if ($sMenu=="compare")?>  
            
        </div>
        

   		
        
        <br clear="all" /><br /><br />
        
     
        
      
        
        
        
        
        
    </div><!-- start content_container -->
    
	
	
    
</div><!-- end wrapper_wide -->

 <div class="content_narrow"><!-- start content_narrow -->

    <div id="footer1"><!-- start footer -->
    	
        <div class="left">
        
            <ul id="footer_nav">
            
                <li><a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$sPortalView."&Itemid=".$sItemId)?>">Home</a></li>
<!--                <li><a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$sPortalView."&menu=browseproducts&Itemid=".$sItemId)?>">Browse Store</a></li>-->
                <li><a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$sPortalView."&menu=democenter&Itemid=".$sItemId);?>">Demo Centre</a></li>
                <li><a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$sPortalView."&menu=appuniversity&Itemid=".$sItemId);?>">App University</a></li>
                <li><a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$sPortalView."&menu=resources&Itemid=".$sItemId);?>">Resources</a></li>
            </ul>
    		
            <br /><br />
            &copy;2012 &nbsp;|&nbsp; 
            <a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$sPortalView."&menu=privacystatement&Itemid=".$sItemId);?>">Trademark &amp; Copyright</a>  &nbsp;|&nbsp;  
            <a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$sPortalView."&menu=privacystatement&Itemid=".$sItemId);?>">Privacy Statement</a>  &nbsp;|&nbsp;  
            <a href="<?php echo JRoute::_("index.php?option=com_saasmarkets&view=portalhomepage&portal=".$sPortalView."&menu=privacystatement&Itemid=".$sItemId);?>">Legal Notice</a>
            
        </div>
        
        <div class="right">
        	<a href="http://www.saasmarkets.com" target="_blank"><img src="<?php JURI::root()?>components/com_saasmarkets/assets/images/portal/powered_by_saas_markets.png" width="124" height="39" /></a>
        </div>
        
        <br clear="all" />
        
    </div><!-- end footer -->
    
</div><!-- end content_narrow -->
<input type="hidden" value="<?php echo $sPortalView;?>" id="iPortalViewForJs"/>
 <br clear="all" />
 
 <!-- forgot password box --> 
<div id="fp-container">
	<div id="fp-overlay"></div>
	<div id="fp-wrapper">

		<form name="user-registration" id="user-registration" method="POST">
			<div id="fp-system-error" class="fp-system-error"></div>
			<div class="text-label">Please enter the email address for your account. A verification code will be sent to you. Once you have received the verification code, you will be able to choose a new password for your account.
			</div>
			<div class="email-label retrieve-label">Email address*</div>
			<div class="email-input retrieve-input">
				<input type="text" class="inputBox borderR5" name="jform[email]" id="fp-email-input" autocomplete="off">
				<input type="hidden" name="jform[portal]" id="fp-email-portal" value="<?php echo $sPortalView;?>">
			</div>
			<div class="submit-bttn">
				<input type="button" onclick="requestPW();" value="Submit" class="smbttn borderR5 smBlueBG noShadow">
			</div>
			
			<?php echo JHtml::_('form.token'); ?>

		</form>

	</div>
	<div id="fp-nav">
		<a id="fp-nav-close" onclick="closeRetrieve(<?php echo $sPortalView;?>, '<?php echo JUtility::getToken();?>')" title="Close"></a>
	</div>

</div>
<!-- end forgot password box -->



 <div id="leavingMessageDiv" style="display:none;">
    <img src="" id="leavelogosrc"/><br />

   <!-- <h1>You are now leaving the <span id="leavestorename"></span> App Store.</h1>
    You are now being directed to the website of your chosen application.
    <br /><br />
    
    <span>
    By clicking on 'I agree' below you are accepting that you will be bound by the terms and conditions of that website, and 
    that <span id="leavestorename"></span> has no responsibility for transactions or activities undertaken by you on that site.
	</span>
    <br /><br />
    
    Please select 'I agree' if you wish to progress to the site or 'I do not agree' if you do not wish to proceed. 
    <br /><br />
    
    
    
    -->
    
   You are now leaving the Global Payments Merchant Centre. </br>
 </br>
You are now being directed to the website of your chosen application.  </br>
 </br>
By clicking on 'I agree' below you are accepting that you are leaving the Global Payments website, and that Global Payments has no responsibility for transactions or activities undertaken by you on that site.” </br>
    
   </br> </br>    
    
    
    
   	
    <div class="left_10_pad">
   		<a class="link_balck_med" href="javascript:void(0);" id="btniagree">I Agree</a>
    </div>
    
    <div class="left">
        <a class="link_balck_med" href="javascript:void(0);" onClick="jQuery('#leavingMessageDiv').dialog('close');" >I Do Not Agree</a>
    </div>
</div>

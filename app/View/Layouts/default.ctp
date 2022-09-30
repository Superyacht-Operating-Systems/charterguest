<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$session = $this->Session->read();
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
        //echo "<pre>"; print_r($session); exit;
?>
<!DOCTYPE html>
<html>
<head>
    <?php //$logoData  = $this -> requestAction(array('controller' => 'settings','action' => 'getlogodata'));
                   //if($logoData =="No Logo"){
                        $logoLink = "Superyacht Operating Systems";
                        // $logoimage = "logo/thumb/1412662088_SOS logo.PNG";
                        $logoimage = "logo/thumb/charter_guest_logo.png";
//                    }else{
//                        $logoLink = $logoData['Company']['name'];
//                        $logoimage = "logo/thumb/".$logoData['Company']['logo'];
//                    }

$actual_link_defaultctp = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
       
        //echo $actual_link."<br>"; 
        $parts_defaultctp = parse_url($actual_link_defaultctp);
        //echo $parts['path'];
        $explodepath_defaultctp = explode('/',$parts_defaultctp['path']);
        $programpageCharter =  $explodepath_defaultctp[2];
        $programpagePrograms =  $explodepath_defaultctp[3];
        $pageUrlName = $explodepath_defaultctp[count($explodepath_defaultctp)-2];
        // echo $pageUrlName;
            ?>
            <?php echo $this->Html->charset('UTF-8'); ?>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
            
        <title>Superyacht Operating Systems - Charter Guest</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');
                echo $this->Html->css('admin/bootstrap'); 
                echo $this->Html->css('admin/sb-admin');
                echo $this->Html->css('admin/login');     
                echo $this->Html->css('admin/font/css/font-awesome.min');
                echo $this->Html->css('admin/custom_admin');
                echo $this->Html->css('jquery-ui');
                echo $this->Html->css('jquery-ui.theme');
                echo $this->Html->css('jquery-ui.structure');
                echo $this->Html->css('jquery.timepicker');
                echo $this->Html->css('jquery.rangerover');
                echo $this->Html->css('fastselect.min.css');
                echo $this->Html->css('jquery.dataTables');
                echo $this->Html->css('typeahead');
//                echo $this->Html->script('jquery-1.7.2.min');
                echo $this->Html->script('jquery-3.2.1.min');
                echo $this->Html->script('jquery.validate');
                echo $this->Html->script('jquery.ui.core');
                echo $this->Html->script('jquery.ui.datepicker');
                echo $this->Html->script('jquery.timepicker');
                echo $this->Html->script('bootstrap.min');
                echo $this->Html->script('jquery.rangerover');
	 	echo $this->Html->script('fastselect.standalone');
                echo $this->Html->script('jquery.dataTables.min');
                echo $this->Html->script('typeahead');
                
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
?>
    <link href="//vjs.zencdn.net/7.10.2/video-js.min.css" rel="stylesheet">
<script src="//vjs.zencdn.net/7.10.2/video.min.js"></script>

<style type="text/css">
.modalmsg-container .modal-dialog{
padding-left: 0px;
}
.modalmsg-container .modal-body{
  margin: 0px;
}


				@media only screen and (max-width:1200px){
				.login-panel{margin-top:50%;}
				}
/*                                .logoutDiv {
                                    line-height: 95px;
                                    font-weight: bold;
                                    color: white;
                                    float: right;
                                    margin-right: 80px;
                                    font-size: 20px;
                                }*/
		.navbar-nav.navbar-user > li > .dropdown-menu {
    background: none transparent;
			right: 30px;}

      .col-ng-3{width: 12%;}
.modal-content.mc-bord{
	border-radius:0;
	border:1px solid #000;
	}
.modalmsg-container .modal-content{
width: max-content;
    max-width: 491px;
    min-width: 300px;
}

@media (min-width: 768px){
.modal-dialog {
    width: 400px;
    margin: 30px auto;
}
}

/*	.iter-pref{
		width: 32%;
	}*/
  /* Ramesh 10/08/2018 */
  @media only screen 
  and (min-device-width : 768px) 
  and (max-device-width : 1024px) 
  and (orientation : portrait) { 
   /* .row.ipadport-comments .col-md-8 {
        margin-left: -12px;
    }*/
    span.ipadport-break {
        display: block;
    }
    .ipadport-ml15{
      margin-left: 15px;
    }

  }

  @media only screen and (max-device-width : 768px) {
.ipadport-can-you-block{
  margin-left: -8px;
}
.modalmsg-container .modal-content{
  width: 100%;
}
.modalmsg-container .modal-open .modal{
  padding-right: 0px;
}
.chr-block{
  display: block;
  text-align: center;
      padding-top: 5px;
}
.modalmsg-container .modal-content{
width: max-content;
    max-width: 100%;
    min-width:100%;
}
}

.ui-datepicker-title select {
        color: black;
    }


    /* @media screen 
  and (min-device-width: 700px) 
  and (max-device-width: 1600px) 
  { 

    .videomodalcontent{
      width: 482px !important;
    }

    .videoclass{
      width: 450px !important;
    }

} */

@media only screen and (max-device-width : 700px) {
  .videomodalcontent{
      width: 482px !important;
    }

    .videoclass{
      width: 450px !important;
      height : 250px !important;
    }
}

@media screen 
  and (max-device-width: 1000px) 
  { 

    .videomodalcontent{
      width: 482px !important;
    }

    .videoclass{
      width: 450px !important;
      height : 250px !important;
    }

}

@media screen 
  and (max-device-width: 900px) 
  { 

    .videomodalcontent{
      width: 482px !important;
      
    }

    .videoclass{
      width: 450px !important;
      height : 250px !important;
    }

}

@media screen 
  and (max-device-width: 1600px) 
  { 

    .videomodalcontent{
      width: 482px !important;
      
    }

    .videoclass{
      width: 450px !important;
      height : 250px !important;
    }

}

@media only screen and (device-width: 768px) {
  /* For general iPad layouts */
  .videomodalcontent{
      width: 482px !important;
      
    }

    .videoclass{
      width: 450px !important;
      height : 250px !important;
    }
}

@media only screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait) {
  /* For portrait layouts only */
  .videomodalcontent{
      width: 482px !important;
      
    }

    .videoclass{
      width: 450px !important;
      height : 250px !important;
    }
}

@media only screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape) {
  /* For landscape layouts only */
  .videomodalcontent{
      width: 482px !important;
      
    }

    .videoclass{
      width: 450px !important;
      height : 250px !important;
    }
}

			</style>              
</head>
<body>
    <div style="position:fixed;height:100%;width:100%;left:0;top:0;z-index:9999;opacity:0.5;display:none;" id="hideloader">
		<div style="text-align:center;vertical-align:center;font-weight:bold;font-size:45px;margin-top:305px;color:#000000"><?php echo $this->Html->image("admin/loader.gif"); ?></div></div>         
	 <section class="">
            <div class="row">
              <?php if($pageUrlName == 'privacytermsofuse'){ ?>
                <div class="navbar-header ">             
                  <div class="logoimg"> <?php echo $this->Html->image($logoimage);?></div> 
                    <?php 
                      echo $this->Html->link($logoLink,'http://www.superyachtos.com/',array('target'=>'blank','class' => 'navbar-brand logotxt brand-logo','title' => $logoLink, 'style'=>"color: white;"));
                    ?>
                </div>
                <div class="headerRightText">Charter Guest</div>
              <?php } else if (isset($session["login_username"]) && !empty($session["login_username"])) { ?>
                <nav role="navigation" class="navbar navbar-inverse navbar-absalute-top">            
                    <div class="navbar-header ">    
                        <?php if (isset($session["fleetLogoUrl"]) && !empty($session["fleetLogoUrl"]) && $programpageCharter == "charters" && $programpagePrograms != "programs") { ?>
                            <div class="logoimg"> 
                                <img src="<?php echo $session["fleetLogoUrl"]; ?>" alt="">
                            </div>
                            <p class="navbar-brand logotxt brand-logo"><?php echo !empty($session["fleetCompanyName"]) ? $session["fleetCompanyName"] : ""; ?></p>
                        <?php } elseif($programpageCharter == "charters" && $programpagePrograms == "programs"){ ?>
                          <div class="logoimg"> <?php echo $this->Html->image($logoimage);?></div> 
                            <?php 
                            echo $this->Html->link($logoLink,'http://www.superyachtos.com/',array('target'=>'blank','class' => 'navbar-brand logotxt brand-logo','title' => $logoLink));
                            ?>

                       <?php } ?>  

                       <!-- Background image -->
                       <?php if (isset($session["cgBackgroundImage"]) && !empty($session["cgBackgroundImage"]) && $programpageCharter == "charters" && $programpagePrograms != "programs") { ?>
                        <script>
                          document.body.style.backgroundImage = "url('<?php echo $session["cgBackgroundImage"]; ?>')";
                        </script>
                        <?php } elseif($programpageCharter == "charters" && $programpagePrograms == "programs"){ ?>
                          <script>
                          document.body.style.backgroundImage = "url('https://totalsuperyacht.com:8080/charterguest/css/admin/images/full-charter.png')";
                        </script>
                       <?php } ?>  
                            
                    </div>

                    <div class="label-bold-head mydemolabel">
                      <?php if($programpageCharter == "charters" && $programpagePrograms != "programs" && $programpagePrograms == "preference"){ ?>
                        <?php if (isset($session["yachFullName"]) && !empty($session["yachFullName"])) { echo $session['login_username']; } ?>
                      <?php } else if($programpageCharter == "charters" && $programpagePrograms != "programs"){ ?>
                        <?php if (isset($session["yachFullName"]) && !empty($session["yachFullName"])) { echo $session['yachFullName']; } ?>
                      <?php } ?>  
                    </div>
                    <div class="yachtHeaderName">Charter Guest
                    <!-- <span class="label-md-header"> <?php //echo isset($companyData['Fleetcompany']['management_company_name']) ? $companyData['Fleetcompany']['management_company_name'] : ""; ?></span>   --></div>                          <div class=""> 
                                 <div class="userhead-name ch-mob-hd">
                                 <?php if($programpageCharter == "charters" && $programpagePrograms == "programs"){ ?>
                                  <span class="user-hname"><?php if (isset($session["login_username"]) && !empty($session["login_username"])) { echo $session['login_username']; } ?></span>
                                  <?php } ?>
                                  <br><?php if($this->Session->read('commentcounttotal') > 0){ ?><span class="acti-countnav fa fa-bell-o "><small><?php echo $this->Session->read('commentcounttotal'); ?></small></span><?php } ?>
                                 	
                                 </div>
                                    <div class="list-logout-row">
                                        <?php echo $this->Html->link($this->Html->image("admin/table.png", array("alt" => "Logout","title" => "Logout")).'  Logout','/',array('escape' =>false,'title' => 'Logout'));?>
                        </div>
                    </div>
                    
                        </nav>
                <?php  } ?>
              </div></section>
   <section class="container wrapper">
            <div class="row">
                <div class="container-row-all">
                    
                            <?php  echo $this->fetch('content'); ?>
                   
                </div>


<div id="selectcart" class="modal fade" role="dialog" style="margin-top: 55px;">
  <div class="modal-dialog charter-mod">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h3 class="modal-title text-center"><?php echo isset($session['charter_info']['CharterGuest']['yacht_name']) ? $session['charter_info']['CharterGuest']['yacht_name'] : ""; ?></h3>          
        <h4 class="modal-title text-center"><?php echo isset($session['charter_info']['CharterGuest']['charter_name']) ? $session['charter_info']['CharterGuest']['charter_name'] : ""; ?></h4>
      </div>
      <div class="modal-body">
            <div id="selectedWineListDiv">
                <?php if (isset($selectionCartData) && !empty($selectionCartData)) { ?>
                    <!-- Selected Wine list table -->
                    <?php echo $this->element('selected_wine_list_table'); ?>
                <?php } else { ?>
                    <p class="text-center">No selected wines available.</p>
                <?php } ?>    
            </div>
      </div>
    </div>
  </div>
</div>
<div id="productSelectionCart" class="modal fade" role="dialog" style="margin-top: 55px;">
  <div class="modal-dialog charter-mod">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title text-center"><?php echo isset($session['charter_info']['CharterGuest']['yacht_name']) ? $session['charter_info']['CharterGuest']['yacht_name'] : ""; ?></h3>          
        <h4 class="modal-title text-center"><?php echo isset($session['charter_info']['CharterGuest']['charter_name']) ? $session['charter_info']['CharterGuest']['charter_name'] : ""; ?></h4>
      </div>
      <div class="modal-body">
            <div id="selectedProductListDiv">
                <?php if (isset($productSelectionCartData) && !empty($productSelectionCartData)) { ?>
                    <!-- Selected Wine list table -->
                    <?php echo $this->element('selected_product_list_table'); ?>
                <?php } else { ?>
                    <p class="text-center">No selected products available.</p>
                <?php } ?>    
            </div>
      </div>
     
    </div>

  </div>
</div>

<div id="winePreference-modal" class="modal fade dont-modal-container" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Product</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Product Name <span style="color:red;"> * </span></label>
            <input type="text" name="product name" id="wine_product_name" class="form-control wlinput">
            <span id="span_wine_product_name" style="color:red;"> </span>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9 md-space-12">
        <div class="form-group">
            <label>Product Color <span style="color:red;"> * </span></label>
            <!--
            <select class="form-control">
            <option>Reposado Tequila</option>
            <option>Silver Tequila</option>
            <option>Gingers Irish Whiskey</option>
            </select>
            -->
            <?php echo $this->Form->input("wine_color_list",array("id" => "wine_color_list", "label"=>false,'options' => $colorList,'class'=>'form-control wlinput','empty'=>'Select')); ?>
            <span id="span_wine_color_list" style="color:red;"> </span>
        </div>
         <div class="form-group">
            <label>Vintage <span style="color:red;"> * </span></label>
            <!--
            <select class="form-control ">
            <option>Red Raspberry</option>
            <option>Sorrento Lemon</option>
            <option>O'Clock Gin</option>
            </select>
            -->
            <input type="number" name="Vintage" id="wine_vintage" class="form-control wlinput">
            <span id="span_wine_vintage" style="color:red;"> </span>
        </div>
    </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" class="wlinput" id="CGID" name="CGID" value="<?php echo $session['charter_info']['CharterGuest']['id']; ?>">
        <!-- <button id="wlinputsave" type="button" class="btn btn-save">Save</button> -->
        <button id="wlinputsave" type="button" class="btn btn-save" style="display:none">Save</button>
        <button type="button" class="btn btn-save" onClick="fwlinputsavesubmit()">Save</button>
      </div>
    </div>

  </div>
</div>


<div id="previousSelectionModal" class="modal fade" role="dialog" style="margin-top: 55px;">
  <div class="modal-dialog charter-mod">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h3 class="modal-title text-center">Charter Programs List</h3>          
        <!-- <h4 class="modal-title text-center"><?php //echo isset($session['charter_info']['CharterGuest']['charter_name']) ? $session['charter_info']['CharterGuest']['charter_name'] : ""; ?></h4> -->
      </div>
      <div class="modal-body">
            <div id="previousSelectionListDiv">
                <?php //if (isset($selectionCartData) && !empty($selectionCartData)) { ?>
                    <!-- Selected Wine list table -->
                    <?php echo $this->element('previous_charter_program_list'); ?>
                <?php //} else { ?>
                    <!-- <p class="text-center">No selected wines available.</p> -->
                <?php //} ?>    
            </div>
      </div>
    </div>
  </div>
</div>


<div id="previousBeerSelectionCart" class="modal fade" role="dialog" style="margin-top: 55px;">
  <div class="modal-dialog charter-mod">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close previousBeerSelectionCartclose">&times;</button>
        <h4 class="modal-title text-center"> Previous Beer and Spirit Selection</h4>          
        <h4 class="modal-title text-center" id="prevchartername"></h4>
      </div>
      <div class="modal-body">
            <div id="selectedPreBeerListDiv">
                <?php if (isset($productSelectionCartData) && !empty($productSelectionCartData)) { ?>
                    <!-- Selected Wine list table -->
                    <?php echo $this->element('selected_product_list_table'); ?>
                <?php } else { ?>
                    <p class="text-center">No selected products available.</p>
                <?php } ?>    
            </div>
      </div>
     
    </div>

  </div>
</div>


<div id="previousWineSelectionCart" class="modal fade" role="dialog" style="margin-top: 55px;">
  <div class="modal-dialog charter-mod">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close previousWineSelectionCartclose">&times;</button>
        <h4 class="modal-title text-center"> Previous Wine Selection</h4>          
        <h4 class="modal-title text-center" id="prevwinechartername"></h4>
      </div>
      <div class="modal-body">
            <div id="selectedPreWineListDiv">
                <?php if (isset($productSelectionCartData) && !empty($productSelectionCartData)) { ?>
                    <!-- Selected Wine list table -->
                    <?php echo $this->element('selected_product_list_table'); ?>
                <?php } else { ?>
                    <p class="text-center">No selected products available.</p>
                <?php } ?>    
            </div>
      </div>
     
    </div>

  </div>
</div>


<div id="PreferenceAlreadyExist" class="modal modalmsg-container" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" style="margin-top: 55px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content mc-bord">
<!--      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>-->
        <div class="modal-body">
          <div class="modalmsg"> 
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            <p>Preferences already exist for : <b><span id="guestFullName" class="chr-block"></span></b></p>
            <p>Click USE EXISTING to update preferences before submitting</p>
            <p>Click CREATE NEW to delete the old and create new preferences</p>
          </div>
            <!-- <div class="text-center">
                <?php if (isset($sessionData["fleetLogoUrl"]) && !empty($sessionData["fleetLogoUrl"])) { ?>
                    <img src="<?php echo $sessionData["fleetLogoUrl"]; ?>" alt="">
                <?php } ?> 
                    <h3><?php echo !empty($sessionData["fleetCompanyName"]) ? $sessionData["fleetCompanyName"] : ""; ?></h3>
            </div>     -->
        </div>
        <div class="modal-footer">
            <input class="btn btn-success" type="button" name="use_existing" id="use_existing" data-preferenceExistGuestID="" data-preferenceexistUUID="" data-gtype="" value="USE EXISTING" />
          <input class="btn btn-success"  type="button" name="create_new" data-guestuuid="" data-assid="" id="create_new" value="CREATE NEW" />
        </div>
    </div>
  </div>
</div>

<div id="PreferenceBirthday" class="modal modalmsg-container" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" style="margin-top: 55px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content mc-bord">
<!--      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>-->
        <div class="modal-body">
          <div class="modalmsg" style="margin: auto;text-align: center;"> 
            <p>Enter your birthday to confirm your identity.</p>
          </div>
            <div class="text-center">
            <?php //echo $this->Form->input("dob",array("label"=>false,'class'=>'form-control dobDatePicker nonEditable','type' => 'text')); ?>
            <input type="text" name="checkdob" id="checkdob" style="width: 50%;text-align: center;margin: auto;" class="form-control dobDatePickerexisting existingnonEditable" />
            <p id="confirmpreferencesuccess" style="color:green;">Confirmed - Loading your preference now</p>
            <p id="confirmpreferencefail" style="color:red;">Wrong DOB - Please try again or create new</p>
            <input class="btn btn-success" style="margin: 10px auto;" type="button" name="confirm" id="confirmPreference" data-assid=""  data-chkuuid ="" data-gtype="" value="CONFIRM" />
               
           
            </div>    
        </div>
        <div class="modal-footer">
          <button class="btn btn-success closedobmodal" style="float:left;" >Close</button>
        <input class="btn btn-success"  type="button" name="create_new" data-guuid ="" data-assid ="" id="dob_create_new" value="CREATE NEW" />
        </div>
    </div>
  </div>
</div>


<div id="howtovideo" class="modal modalmsg-container" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" style="margin-top: 55px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content mc-bord  videomodalcontent">
     <div class="modal-header">
        <h5 class="modal-title">How To Video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        
        <video
    id="preferencesheetvideo"
    class="video-js videoclass"
    controls
    preload="auto"
    poster=""
    data-setup='{"controls": true, "autoplay": false, "preload": "auto"}'>
  <source src="<?php echo  $this->request->base; ?>/app/webroot/Guest_how_to_video.mp4" type="video/mp4"></source>
  <!-- <source src="//vjs.zencdn.net/v/oceans.webm" type="video/webm"></source>
  <source src="//vjs.zencdn.net/v/oceans.ogv" type="video/ogg"></source> -->
  <p class="vjs-no-js">
    To view this video please enable JavaScript, and consider upgrading to a
    web browser that
    <a href="https://videojs.com/html5-video-support/" target="_blank">
      supports HTML5 video
    </a>
  </p>
</video>
        <!-- <video width="100%" height="100%" class="video videoclass" playsinline autoplay muted loop controls="true"  preload="metadata" id="preferencesheetvideo">
        <source src="<?php echo  $this->request->base; ?>/app/webroot/Guest_how_to_video.mp4" type="video/mp4">
        </video> -->
                            
        </div>
        <div class="modal-footer">
            
        </div>
    </div>
  </div>
</div>

<div id="howtovideocharterhead" class="modal modalmsg-container" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" style="margin-top: 55px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content mc-bord  videomodalcontent">
     <div class="modal-header">
        <h5 class="modal-title">How To Video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <video
    id="charterheadvideo"
    class="video-js videoclass"
    controls
    preload="auto"
    poster=""
    data-setup='{"controls": true, "autoplay": false, "preload": "auto"}'>
  <source src="<?php echo  $this->request->base; ?>/app/webroot/Head_Charterer_how_to_video.mp4" type="video/mp4"></source>
  <!-- <source src="//vjs.zencdn.net/v/oceans.webm" type="video/webm"></source>
  <source src="//vjs.zencdn.net/v/oceans.ogv" type="video/ogg"></source> -->
  <p class="vjs-no-js">
    To view this video please enable JavaScript, and consider upgrading to a
    web browser that
    <a href="https://videojs.com/html5-video-support/" target="_blank">
      supports HTML5 video
    </a>
  </p>
</video>
        <!-- <video width="100%" height="100%" class="video videoclass" playsinline autoplay muted loop controls="true"  preload="metadata" id="charterheadvideo">
        <source src="<?php echo  $this->request->base; ?>/app/webroot/Head_Charterer_how_to_video.mp4" type="video/mp4">
        </video> -->
                            
        </div>
        <div class="modal-footer">
            
        </div>
    </div>
  </div>
</div>

<!-- The Modal -->
<!-- Modal -->
<div id="dont-click-modal" class="modal fade dont-modal-container" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Product</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Product Name <span style="color:red;"> * </span></label>
            <input type="text" name="product name" id="product_name" class="form-control bsinput">
            <span id="span_product_name" style="color:red;"> </span>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9 md-space-12">
        <div class="form-group">
            <label>Product Type <span style="color:red;"> * </span></label>
            <!--
            <select class="form-control">
            <option>Reposado Tequila</option>
            <option>Silver Tequila</option>
            <option>Gingers Irish Whiskey</option>
            </select>
            -->
            <?php echo $this->Form->input("product_type",array("id" => "product_type", "label"=>false,'options' => $typeList,'class'=>'form-control bsinput','empty'=>'Select')); ?>
            <span id="span_product_type" style="color:red;"> </span>
        </div>
         <div class="form-group">
            <label>Product Category <span style="color:red;"> * </span></label>
            <!--<select class="form-control ">
            <option>Red Raspberry</option>
            <option>Sorrento Lemon</option>
            <option>O'Clock Gin</option>
            </select>
            -->
            <?php echo $this->Form->input("category_list",array("id" => "category_list", "label"=>false,'options' => $categoryList,'class'=>'form-control bsinput','empty'=>'Select')); ?>
            <span id="span_category_list" style="color:red;"> </span>
        </div>
    </div>
      </div>
      <div class="modal-footer">
          <input type="hidden" class="bsinput" id="CGID" name="CGID" value="<?php echo $session['charter_info']['CharterGuest']['id']; ?>">
        <!-- <button id="save_bs_product" type="button" class="btn btn-save" onClick="fbsproductsubmit()">Save</button> -->
        <button id="save_bs_product" type="button" class="btn btn-save" style="display:none">Save</button>
        <button type="button" class="btn btn-save" onClick="fbsproductsubmit()">Save</button>
      </div>
    </div>

  </div>
</div>
                
            </div>        </section>
            <div class="push"></div>

            <?php echo $this->element('footer'); ?>  

<?php 
    $baseFolder = $this->request->base;
?>    

<script>
    var BASE_FOLDER = "<?php echo $baseFolder; ?>";
</script> 
<script type="text/javascript">
/// existing preference
var dateToday = new Date();
var dobYearRange = "1900:" + dateToday.getFullYear();
// DOB
$(".dobDatePickerexisting").datepicker({
    dateFormat: 'd M yy',
    changeYear: true,
    changeMonth:true,
    yearRange: dobYearRange
}).attr('readonly','readonly');

// Make Non-editable fields
$(document).on("keypress", ".existingnonEditable", function(e) {
    if (e.which != 8) { // Except the Backspace key
        return false;
    }
});
    
$(document).on("click",".existingCheckFunction",function(e){
    var classObj = $(this);
    var associd = classObj.data('associd');
    var guestType = classObj.data('guestype');

    var datasend = {"associd":associd,"guestType":guestType};
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: BASE_FOLDER+'/charters/existingCheckFunction',
            dataType: 'JSON',
            data: datasend,
            success:function(result) {
                
                //console.log(result); return false;
                if (result.status == 'success') {
                    $("#guestFullName").text(result.preferenceExistFirstName+' '+result.preferenceExistLastName);
                    $("#use_existing").attr('data-preferenceexistUUID',result.preferenceExistGuestUUID);
                    $("#create_new").attr('data-guestuuid',result.preferenceExistGuestUUID);
                    $("#create_new").attr('data-assid',result.preferenceExistGuestID);
                    $("#use_existing").attr('data-preferenceExistGuestID',result.preferenceExistGuestID);
                    $("#use_existing").attr('data-gtype',result.guestType);
                    $("#hideloader").hide();
                    $("#PreferenceAlreadyExist").modal("show");
                }else if(result.status == 'fail'){
                    $("#hideloader").hide();
                    window.location.href = BASE_FOLDER+result.redirectUrl;
                }   
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    
     
 });

  $(document).on("click", "#use_existing", function(e) { 
    
    $("#checkdob").val('');
    var chkuuid = $("#use_existing").attr('data-preferenceexistUUID');
    var assid = $("#use_existing").attr('data-preferenceExistGuestID');
    var gtype = $("#use_existing").attr('data-gtype');
    $("#confirmpreferencesuccess").hide();
    $("#confirmpreferencefail").hide();
    $("#dob_create_new").attr("data-guuid",chkuuid);
    $("#dob_create_new").attr("data-assid",assid);
    $("#confirmPreference").attr("data-chkuuid",chkuuid);
    $("#confirmPreference").attr("data-assid",assid);
    $("#confirmPreference").attr("data-gtype",gtype);
    $("#PreferenceAlreadyExist").modal("hide");
    $("#PreferenceBirthday").modal("show");
    
});

$(document).on("click", ".closedobmodal", function(e) { 
    
    $("#checkdob").val('');
    var chkuuid = $("#use_existing").attr('data-preferenceexistUUID',"");
    var assid = $("#use_existing").attr('data-preferenceExistGuestID',"");
    var gtype = $("#use_existing").attr('data-gtype',"");
    $("#confirmpreferencesuccess").hide();
    $("#confirmpreferencefail").hide();
    $("#dob_create_new").attr("data-guuid","");
    $("#dob_create_new").attr("data-assid","");
    $("#confirmPreference").attr("data-chkuuid","");
    $("#confirmPreference").attr("data-assid","");
    $("#confirmPreference").attr("data-gtype","");
    $("#PreferenceAlreadyExist").modal("hide");
    $("#PreferenceBirthday").modal("hide");
    
});


  $(document).on("click", "#confirmPreference", function(e) { 
    var classObj = $(this);
    var dob = $("#checkdob").val();
    
    var chkuuid = classObj.data('chkuuid');
    var associateid = classObj.data('assid');
    var gtype = classObj.data('gtype');
    if(dob){
    var data = {

      "dob":dob,
      "guest_list":chkuuid,
      "associd":associateid,
      "gtype":gtype

    }
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: BASE_FOLDER+'/charters/checkPersonalDetails',
            dataType: 'json',
            data: data,
            success:function(result) {
                
                if (result.status == 'success') {
                    ///location.reload();
                    $("#confirmpreferencesuccess").show();
                    setTimeout(function () {
                        $("#PreferenceBirthday").modal("hide");
                        window.location.href = BASE_FOLDER+result.redirectUrl;
                    }, 1000);
                   
                    $("#hideloader").hide();
                } else {
                  $("#hideloader").hide();
                  $("#confirmpreferencefail").show();
                   // return false;
                }   
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });

    }else{
      alert("Please select the date of birth");
      return false;
    }
    
});

$(document).on("click", "#create_new", function(e) { 
    var classObj = $(this);
    var guestuuid = classObj.data('guestuuid');
    var assid = classObj.data('assid');
   createNew(guestuuid,assid);

});


$(document).on("click", "#dob_create_new", function(e) { 
   //alert();
  //$("#PreferenceAlreadyExist").modal("hide");
  var classObj = $(this);
  var guuid = classObj.data('guuid');
  var assid = classObj.data('assid');
  createNew(guuid,assid);
  $("#PreferenceBirthday").modal("hide");

});

function createNew(guuid,assid){

   
    var data = {
        "guest_list":guuid,
        "assid":assid,
    }
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: BASE_FOLDER+'/charters/createNewPreference',
            dataType: 'json',
            data: data,
            success:function(result) {
                
                if (result.status == 'success') {
                    
                    
                    $("#PreferenceBirthday").modal("hide");
                    window.location.href = BASE_FOLDER+result.redirectUrl;
                    //$("#hideloader").hide();
                } 
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });

    
}

$(document).on("click", "#MenuHowToVideo", function(e) { 
  $("#howtovideo").modal("show");
  
       $("#sidebar-btn").click();
            
           // $('#content').off();
        //toggleMenu();
    

});

$(document).on("click", "#MenuHowToVideoCharterHead", function(e) { 
  $("#howtovideocharterhead").modal("show");
  
       $("#sidebar-btn").click();
            
           // $('#content').off();
        //toggleMenu();
    

});

// var vid = document.getElementById("preferencesheetvideo");
// alert("Start: " + vid.buffered.start(0)
// + " End: " + vid.buffered.end(0));

// $('#howtovideo').on('shown.bs.modal', function () {
//   $('#preferencesheetvideo')[0].play();
// })


// $('#howtovideocharterhead').on('shown.bs.modal', function () {
//   $('#charterheadvideo')[0].play();
// })
// $('#howtovideocharterhead').on('hidden.bs.modal', function () {
//   $('#charterheadvideo')[0].pause();
// })

var options = {};

var player = videojs('preferencesheetvideo', options, function onPlayerReady() {
  //videojs.log('Your player is ready!');

  // In this context, `this` is the player that was created by Video.js.
  //this.play();

  // How about an event listener?
  // this.on('ended', function() {
  //   videojs.log('Awww...over so soon?!');
  // });
});
player.responsive(true);
$('#howtovideo').on('hidden.bs.modal', function () {
  //$('#preferencesheetvideo')[0].pause();
  
  player.pause();  

})

var headoptions = {};

var headplayer = videojs('charterheadvideo', headoptions, function onPlayerReady() {
  //videojs.log('Your player is ready!');

  // In this context, `this` is the player that was created by Video.js.
  //this.play();

  // // How about an event listener?
  // this.on('ended', function() {
  //   videojs.log('Awww...over so soon?!');
  // });
});
headplayer.responsive(true);
$('#howtovideocharterhead').on('hidden.bs.modal', function () {
  //$('#charterheadvideo')[0].pause();
  headplayer.pause();  
})

$(document).on("click", ".previousSelectionButton", function(e) { 

  var classObj = $(this);
  var typeofspirit = classObj.data('type');

        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: BASE_FOLDER+'/charters/getPreviousCharterProgramSelections',
            dataType: 'json',
            data: {"type":typeofspirit},
            success:function(result) {
              
                  $('#previousSelectionListDiv').html(result.view);
                  $("#hideloader").hide();
                  $("#previousSelectionModal").modal("show");
                  
              
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });

    
     
});



$(document).on("click", ".selectpreviousprogram", function(e) { 

var classObj = $(this);
var typeofspirit = classObj.data('type');
var programuuid = classObj.data('programuuid');


      $("#hideloader").show();
      $.ajax({
          type: "POST",
          url: BASE_FOLDER+'/charters/getPreviousSelectedBeerWine',
          dataType: 'json',
          data: {"type":typeofspirit,"programuuid":programuuid},
          success:function(result) {
            $("#hideloader").hide();
            if (result.status == 'success') {
              $("#previousSelectionModal").modal('hide');
              if(result.type == "spirit"){ 
                  if (result.cartRecordCount != 0 || result.preferenceRecordCount != 0) {
                      $("#selectedPreBeerListDiv").html(result.view);
                      
                  } else {
                      $("#selectedPreBeerListDiv").html('<p class="text-center">No previous selection available.</p>');
                  }  
                  $("#prevchartername").text(result.chartername);
                  $("#previousBeerSelectionCart").modal('show');
              }else if(result.type == "wine"){
                if (result.cartRecordCount != 0 || result.preferenceRecordCount != 0) {
                      $("#selectedPreWineListDiv").html(result.view);
                      
                  } else {
                      $("#selectedPreWineListDiv").html('<p class="text-center">No previous selection available.</p>');
                  }  
                  $("#prevwinechartername").text(result.chartername);
                  $("#previousWineSelectionCart").modal('show');
              }
               
            }  
                
          },
          error: function(jqxhr) { 
              $("#hideloader").hide();
          }
      });

  
   
});

$(document).on("click", ".previousBeerSelectionCartclose", function(e) { 
  $("#previousBeerSelectionCart").modal('hide');
  
});

$(document).on("click", ".previousWineSelectionCartclose", function(e) { 
  $("#previousWineSelectionCart").modal('hide');
  
});


// Since confModal is essentially a nested modal it's enforceFocus method
// must be no-op'd or the following error results 
// "Uncaught RangeError: Maximum call stack size exceeded"
// But then when the nested modal is hidden we reset modal.enforceFocus
var enforceModalFocusFn = $.fn.modal.Constructor.prototype.enforceFocus;

$.fn.modal.Constructor.prototype.enforceFocus = function() {};

$confModal.on('hidden', function() {
    $.fn.modal.Constructor.prototype.enforceFocus = enforceModalFocusFn;
});

$confModal.modal({ backdrop : false });
/// existing preference

  function fbsproductsubmit(){
    if(validate() == true){
      $("#save_bs_product").trigger("click");
    }
  }

  function validate()
  {	
    var isError = 0;
    if($("#product_name").val()=='')
    {
      errorSpanText('product_name','Product name cannot be null');
      isError = 1;
    }else{
      errorSpanText('product_name','');
    }

    if($("#product_type").val()=='')
    {
      errorSpanText('product_type','Product type cannot be null');
      isError = 1;
    }else{
      errorSpanText('product_type','');
    }

    if($("#category_list").val()=='')
    {
      errorSpanText('category_list','Product category cannot be null');
      isError = 1;
    }else{
      errorSpanText('category_list','');
    }

    if(isError == 0){
      return true;
    }
    return false;
  }

  function errorSpanText(id,text)
  {
    $("#span_"+id).html(text);
  }

  function fwlinputsavesubmit(){
    if(validateWlinput() == true){
      $("#wlinputsave").trigger("click");
    }
  }

  function validateWlinput()
  {	
    var isError = 0;
    if($("#wine_product_name").val()=='')
    {
      errorSpanText('wine_product_name','Product name cannot be null');
      isError = 1;
    }else{
      errorSpanText('wine_product_name','');
    }

    if($("#wine_color_list").val()=='')
    {
      errorSpanText('wine_color_list','Product color cannot be null');
      isError = 1;
    }else{
      errorSpanText('wine_color_list','');
    }

    if($("#wine_vintage").val()=='')
    {
      errorSpanText('wine_vintage','Vintage cannot be null');
      isError = 1;
    }else{
      errorSpanText('wine_vintage','');
    }

    if(isError == 0){
      return true;
    }
    return false;
  }
</script>
</body>
</html>

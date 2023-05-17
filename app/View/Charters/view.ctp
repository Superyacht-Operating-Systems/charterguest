<?php
    $baseFolder = $this->request->base;
    $cloudUrl = Configure::read('cloudUrl');
    $session = $this->Session->read('charter_info.CharterGuest');
    $sessionData = $this->Session->read();
    $sessionCharterGuest = $this->Session->read('charter_info.CharterGuest');
    $salutationList = array(
        "" => "",
        "Mr." => "Mr.",
        "Ms." => "Ms.",
        "Mrs." => "Mrs.",
        "Miss" => "Miss",
        "Dr." => "Dr.",
        "Prof." => "Prof.",
        "Rev." => "Rev.",
        "Lady" => "Lady",
        "Sir" => "Sir",
        "The Hon. Mr" => "The Hon. Mr",
        "The Hon. Mrs" => "The Hon. Mrs",
        "Dame" => "Dame",
        "Monsieur" => "Monsieur",
        "Madame" => "Madame",
        "Judge" => "Judge",
        "Lord" => "Lord",
    );
?>
<style>
    .gry-btn, .yes-btn {
  font-size: 12px;
    }
    @media only screen and (min-width:1024px){
    body .mydemolabel {
  font-size: 36px !important;
}
    }
@media only screen and (min-width:771px) and (max-width:1024px){

.yachtHeaderName {
    margin-top: 4px!important;
}
body .mydemolabel {
    top: 70px!important;
  font-size: 30px !important;
}


}
    .md-row-h-8 button{
        text-transform: uppercase;
    }
    @media only screen and (max-width: 360px) {
.rowm-md-mob-resize {
  margin: 27px 0px 10px 0px !important;
    margin-top: 65px;
}
.md-row-h-8 {
    left: 0px!important;
  width: 40% !important;
  float: right;
  position: absolute;
  top: 275px;
}

.md-row-h-18 {
  right: 0px!important;
  max-width: 156px !important;
  width: 156px !important;
  margin-right: 0px !important;
  float: right !important;
}
.md-row-h-18 button {
  width: 75px !important;
  font-size: 11px !important;
}

.btn-open, .btn-open1, .btn-eml-send{
margin-right: 0px!important;
}
}
@media only screen and (min-width: 360px) and (max-width: 600px) {
    .md-row-h-18 {
  right: 6px;
  width: 180px !important;
}
}
@media only screen and (min-width: 360px) and (max-width: 990px) {
.md-row-h-18 {
  width: 175px !important;
  float: right !important;
  position: relative;
  right: 9px;
}
.md-row-h-8 {
  width: 50% !important;
  left: 15%;
  float: right;
  position: absolute;
  top: 275px;
}
}

    @media only screen and (min-width: 1000px) and (max-width: 1200px) {
    .header-row {
		width: 940px!important;
	}
    .p-prefrenace-name {
		width: 17% !important;
	}
}
@media only screen and (min-width: 990px) and (max-width: 1000px){
    .header-row {
  width: 895px;
}
}

@media (min-width: 990px){
    .container {
		width: 970px;
	}
}
@media only screen and (min-width: 768px) and (max-width: 771px){
    .container {
  width: 100%!important;
}
}
.emailSentClass::after {
content: "SENT";
}
.emailSentClass:hover::after {
 content: "RESEND";
 color: #fff;
}

.emailSentClass:hover {
    background: #1AB200 !important;
}

.footer-mob-row {
    /* width: 26%; */
    width: 81px;
    float: none!important;
    margin: 0 auto;
}



.info-modal-pop .modal-body{
    padding: 20px!important;
    margin-left: 0px!important;
}
.info-modal-pop .modal-content{
    border-radius: 0px;
    width: auto;
}

.info-modal-pop .modal-dialog{
    padding-left: 0px;
    width: 370px;
}
#renewModal .modal-body > a span.icon {
    display: block;
    height: 64px;
    background-position: center;
    background-repeat: no-repeat;
    margin-bottom: 15px;
        position: relative;
        padding: 24px;
        margin-left: 25px;
        
}
.modal-body {
    position: relative;
    padding: 24px;
    margin-left: 25px;
}
.modal-content {
    width: 371px;
}
.modal-dialog{
        padding-left: 94px;
}

.yachtHeaderName{font-weight: bold;font-size: 36px;}
.container-row-column .row{margin-bottom: 7px;}

    table.table tbody tr {
        background: none !important;
    }
    .label-bold {
        font-weight: bold;
        margin-bottom:5px;
        display:inline-block;
        font-size:22px;
        width: 100%;
    }
    .inputError { 
        border:  1px solid red !important; 
    }
    .displayNone {
        display: none;
    }
    .table.table-condensed.no-border td {
        border: 0;
    }
    .pSheetClass {
        width:80px;
        height: 29px;
        background: #fefefe;
        display: flex;
        border: 1px solid #c5c5c5;
    }
    .pSheetClass img {
        margin: auto;
    }
    .ds-flex{
        display:flex;
        }
        .ds-flex .flex-tb-items{
            flex-wrap:wrap;
            }
    .table-condensed > thead > tr > th{
        padding:5px;
        }
.owl-nav.disabled{display: none!important}
#saveBtn{
border-radius: 0px;}

.center-img{margin-left: 15px;
    width: 100%;
    text-align: center;}
.center-img p{
    margin-bottom:5px;
font-weight: bold;
    font-size: 14px;color: #000;
}
.center-img p a{color: #000;    text-decoration: underline;}
.flexrow {
        width: 100%;
    display: inline-block;
    padding: 10px 0px 0px 0px;
}

.flexrow .one {
    float: left;
        margin-top: 101px;
}

.flexrow .two {
    width: 100%;
    align-items: center;
    display: flex;
    justify-content: center;

}

.table-condensed>tbody>tr>td.td-cnt{text-align: left;}

.flexrow .three {
    float: right;
    margin-top: 15px;
}

.round-logo {
    margin: auto;    position: relative;
}
.round-logo p{color: #000;font-weight: bold;font-size: 14px;    margin: 0px;}
.round-logo p a{color: #000;font-weight: bold;font-size: 14px;text-decoration: underline;text-align: center;}

.round-logo i {
    font-size: 102px;
    color: #03a9f4;
}
.round-logo .map-row:after{
    content: "";
    background: #fff;
    height: 82px;
    width: 81px;
    display: inline-block;
    left: 2px;
    position: absolute;
    z-index: -1;
    border-radius: 100%;
    top: 10px;

}
.round-logo a {
    display: block;
    text-align: center;
}
                
.info-win{
    float: right;
    /*position: relative;*/
    bottom: 27px;
    color:#428bca;
    left: 15px;
    height: 0px;
    font-size: 14px;
}                



.header-row div{
    float: left;
    color: #000;
    font-size: 14px;
    text-align: center;
    float: left;
    font-weight: bold;
    margin: 0px 0.4%;
    text-transform: uppercase;
    top:10px;position: relative;
}
.btn-open{
    font-size: 13px;
    border: none;
    float: initial;
    font-weight: bold;
    opacity: 40!important;
    padding: 6px 8px;
    border-radius: 0px;
     height: 30px!important;
}

.btn-open1{
    font-size: 13px;
    /*background: rgba(10, 230, 87, 0.58); */
    border: none;
    float: initial;
    color: #fff;
    font-weight: bold;
    opacity: 40;
    /* padding: 6px 20px; */
        width: 78px;
    border-radius: 0px;
     height: 30px!important;
}
.newGuestAssoc{display: none;}

/*.btn-primary{display: none!important;} */
.menu__item{
    cursor: pointer;
}
.menu > li{
  display: inline-block;
  margin-right: 10px;
  position: relative;
  cursor: pointer;
}
.menu .menu__item a {
  text-decoration: none;
  padding: 10px 20px;
  color: #000;
  transition: 0.5s;
}
.menu .menu__item {
  list-style: none;
}
.nav-side-menu-full-container .nav-side-menu .sidebar.show{
    overflow-y: inherit;
}

.menu .submenu .menu__item{
    display: block;
        width: 100%;
}
.menu .submenu .menu__item a{
    display: inline-block;
}
.menu .submenu .menu__item a:hover{
    color:#fff !important;
    background: #149be9 !important;
}
.md-left-text{    text-align: left!important;
    padding: -3px;
    margin-left: -5px;
    position: relative;
    top:-10px!important;


}
.md-left-text .info-box{
       position: absolute;
    top: -2px;
    font-size: 12px;
    right: 10px;
        background: rgba(82, 130, 240, 0.48);
        height: 18px;
    width: 18px;
    color: #fff;
    cursor: pointer;
    border-radius: 100%; 
        text-align: center;
    display: flex;
    justify-content: center;
}
.md-left-text .fa{
    position: relative;
    top: 3px;
}
.form-control{border-radius: 0px;border: none;
  border-top: solid 1.5px rgba(2, 2, 2, 0.40);
  border-left: solid 1.5px rgba(2, 2, 2, 0.40);
    background: rgba(241, 235, 235, 0.76);
    border-bottom: solid 1.5px #fff;
    border-right: solid 1.5px #fff;
    padding: 6px 7px;


}

.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control{

    background: rgba(255, 255, 255, 0.83); 
    border-top: solid 1.5px rgba(2, 2, 2, 0.40);
    border-left: solid 1.5px rgba(2, 2, 2, 0.40);
    border-bottom: solid 1.5px #fff;
    border-right: solid 1.5px #fff;

}

.btn-eml-send1{font-size: 13px;
    border: none;
    float: left;
    font-weight: bold;
    opacity: 40!important;
    padding: 6px 5px;
    border-radius: 0px;margin:0% 0.3%;
    height: 30px;

}
.container-row-column .row>section>div{
    float: left;    margin: 0px 0.4%;
}
.owl-carousel label{width:100%;display: none;}
.container-row-column{margin: 0px 13px;}
.bigitem{float: left;
    flex: none!important;}
.md-row-h-10{width:15%;}
.md-row-h-8{width:8%;}
.md-row-h-18{width:16%;}
.md-row-h-12{width:11%;}
.md-row-h-30{width:30%;}
.md-row-h-20{width:15%;}

.md-row-hd-10{width:15%;}
.md-row-hd-18{width:18%;}



.header-row {
    display: inline-block;}
.container-row-column .row>div {
    float: left;
    margin: 0px 0.4%;

}
.btn-eml-send{width:78px; color: #000}
.btn-eml-send1{width:78px;}
.btn-open{width:78px;}



@media screen and (max-width: 771px){
.md-row-h-8 {
  top: 237px !important;
}
}

@media screen and (max-width: 1200px) {

.md-row-h-10{width:14%;}
.md-row-h-18{width:18%;}
.md-row-h-12{width:11%;}
.md-row-h-30{width:28%;}
.md-row-hd-18{width:18%;}
#saveBtn{border-radius: 0px;}
.header-row div{}
}

.owl-nav{display: none;}
@media screen and (max-width: 990px) {
.nav-side-menu {
    display: block;
}
  .label-bold {
        font-size:16px;
    }

.btn-open,
.btn-eml-send
{font-size: 12px;}
.list-logout-row img{display:none; }

.md-row-space{margin-bottom:0px!important;}
    .owl-carousel label {
    width: 100%;
        display: inline-block;
    overflow: hidden;
    color: #fff;
}
.footer-mob-row .btn-success {
    width: 140px;
}


.container-row-column {
    margin: 55px 13px 0px 13px;
}
.md-row-h-18 {
 display: block!important;
}
.md-row-h-12{width:30%;}
.md-row-h-10 {width:33.555%;}
/* .md-row-h-8{
    width: 50%!important;
    left: 15%;
    float: right;
    position: absolute;
    top: 275px;
} */
.rowm-md-mob-resize{
       display: inline-block;
    width: 100%;


}
.md-row-h-30{display: inline-block;width:100%!important;}
/* .md-row-h-18 {
        width: 175px!important;
    float: right!important;
    position: relative;
    right: 9px;
} */
.bigitem{width:100%;display: inline-block;}
.map-row{display: none!important;}
.flexrow .two {
    float: left;
    width: 100%;
}
.flexrow .one{
        float: left;
    width: 50%;
    margin-top: -45px;
}
.flexrow {
    width: 100%;
    display: inline-block;
    padding: 0px;
}
.flexrow .three {
        margin-top:0px;
        width: 50%;
    text-align: center;
}
.header-row {
    width: 100%;
    display: none;
}
.btn-eml-send{float: left;width:55px;}
.btn-open,
.btn-open1
{    float: none;
    min-width: 65px;
    text-align: center;
    width: auto;
        padding: 6px 6px!important;

}


.none-mob-ctrl{display: none;}

.label-preference{margin-top: 10px; text-align: left;}
.btn-warning-bg{
    padding: 0px;
    width: 55px;
}
.btn-eml-send1{
    padding: 0px;
    width: 55px;
}

.gry-btn,
.yes-btn,
.no-btn
{
    width:48px;

}

}
.nav-justified > li > a{
    color: #000!important;
    transition: 0.3s;
        border-radius: 0px;cursor: pointer;
}
.nav-justified > li {
    display: block;
    width: 100%;
}
.nav-justified > li{
    margin-left: 0px!important;
    margin-bottom: 5px;
    text-align: center;
}
.list-logout-row{display: none;}
.row-hide-btn{display: block!important;}
@media only screen and (max-width:1024px){

.container-row-column {
    margin: 0px 0px 0px 13px;
}

}





/*.mobile-owl-view{display: none;}
.desk-owl-view{display: block;}*/
.desk-owl-view label{display: none;}
@media only screen and (max-width:1000px){
/*.mobile-owl-view{display: block;}
.desk-owl-view{display: none;}*/
}

@media only screen and (max-width:600px){
/* .md-row-h-18{
    right: 6px;
    width: 180px!important;
  } */
.md-row-h-8{left: 15px;}
.label-lunch{
    width: 100%;
}
}
@media screen and (min-device-width: 1000px) and (max-device-width:1030px) {
.owl-stage{
   /*transform: inherit!important;*/
    width: 100%!important;
    transform: translate3d(0px, 0px, 0px)!important;
    transition: none!important;
}
.list-page-container .table{
    overflow: hidden!important;
    width: 955px;
    max-width: 955px;
    margin-bottom: 20px;
    padding-top: 17px;
    margin-top: -13px;
    min-width: 955px;
    
}
}
@media screen and (min-width: 990px){
.container-row-column .row .form-control {
  height: 30px !important;
}
}
@media only screen and (max-width:990px){
.footer-mob-row {
    width: 100%;
}
.rowm-md-mob-resize .select {
  width: 102%!important;
}
.owl-carousel .md-row-h-30 label, .owl-carousel .md-row-h-10 label, .owl-carousel .md-row-h-12 label {
  padding-top: 7px;
}
}


@media only screen and (max-width:768px){

.info-modal-pop .modal-dialog {
    padding-left: 0px;
    width: auto;
        top: 20%;
}
.footer-mob-row {
    width: 100%;
}
}
@media screen and (max-width:771px) {
.info-box img{width: 14px;}
.md-row-h-8{left: 15px;}
}



.btn-warning-bg:hover,
.btn-warning-bg:active:hover
{background: rgb(240, 249, 0);
color: #000;
}
.btn-warning:active:hover, .btn-warning.active:hover, .open > .dropdown-toggle.btn-warning:hover, .btn-warning:active:focus, .btn-warning.active:focus, .open > .dropdown-toggle.btn-warning:focus, .btn-warning:active.focus, .btn-warning.active.focus, .open > .dropdown-toggle.btn-warning.focus{
{ background: rgb(240, 249, 0)!important;
color: #000;
} 
}
.btn-primary:active:hover, .btn-primary.active:hover, .open > .dropdown-toggle.btn-primary:hover, .btn-primary:active:focus, .btn-primary.active:focus, .open > .dropdown-toggle.btn-primary:focus, .btn-primary:active.focus, .btn-primary.active.focus, .open > .dropdown-toggle.btn-primary.focus{
        background: #4CAF50!important;
        color: #fff;
}
@media screen and (max-width: 771px) {
.label-preference , .md-row-h-8 label{
  font-size: 11px !important;
  }
  .md-row-h-18 button {
  font-size: 11px !important;
}
.md-row-h-8 button{
font-size: 11px;
    }

}
@media screen and (max-width: 360px) {
/* .md-row-h-18 {
    right: -30px;
}
.md-row-h-18 button {
    width: 70px!important;
} */
}

.menu .submenu{
    right:-162px !important;
}

/* .menu .submenu .menu__item {
    width: 50% !important;
} */

.menu .submenu .menu__item a {
    width: 160px !important;
    
}
@media only screen and (max-width: 767px){
    .nav-side-menu-full-container .nav-side-menu .sidebar {
  width: 120px;
    }
    .nav-side-menu-full-container .nav-side-menu .show {
  width: 180px;
    }
}
.disableBeforesave:hover,
.disableBeforesave {
        background:#0c0a0af2 !important;
        color:#fff;
}
</style>
  <div class="modal fade info-modal-pop" id="info-modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="border: none;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>If Yes is selected then you will be able to complete the preference sheets for the guest which is ideal for children or spouse.
          </p>
          <p> If No is selected then you will be able to send an email invitation to the guest so they can complete their own preference sheets.</p>
        </div>
      </div>
    </div>
  </div>


<?php 
    echo $this->Html->css('charter/style');
?>    
<script>
    var BASE_FOLDER = "<?php echo $baseFolder; ?>";
</script> 

<div class="flexrow flexrow-full-container">
<div class="nav-side-menu-full-container">
<div class="nav-side-menu">
<div class="base-margin">
<button id="sidebar-btn" class="sidebar-btn">
    <div class="menu-stripes"></div>
    <div class="menu-stripes"></div>
    <div class="menu-stripes"></div>
</button>
<section id="sidebar" class="sidebar">
<nav> 
        <ul class="menu menu-level1 no-style nav nav-pills nav-justified">
            <?php if(isset($sessionCharterGuest) && !empty($sessionCharterGuest)){?>
        <li> <a href="<?php echo $baseFolder."/charters/programs/".$sessionCharterGuest['users_UUID']; ?>">Charter Programs</a>
        <li class="menu__item"> <a href="#">Charter Contracts</a>
            <?php if(isset($programFiles)){ ?>
                <ul class="submenu">
                    <?php foreach($programFiles as $startdate => $filepath){ ?>
                    <li class="menu__item"><a href="#" data-href="<?php echo $filepath; ?>" class="download"><?php echo $startdate; ?></a></li>
                    <?php
                            
                        } ?>
                </ul>
            <?php } ?>
    
        </li>    
        <?php if(empty($mapdetails)){ 
                $title  = "Not published";
        }else if(!empty($mapdetails)){
                $title  = "";
        } ?>
        <li class="menu__item"> <a href="#" title="<?php echo $title; ?>">Cruising Map</a>
            <?php if(isset($mapdetails)){ ?>
                <ul class="submenu">
                    <?php foreach($mapdetails as $startdate => $data){ ?>
                        <!-- <li class="menu__item"><a href="<?php echo $baseFolder."/charters/charter_program_map/".$data['programid'].'/'.$data['dbname'].'/owner'; ?>" target="_blank"><?php echo $startdate; ?></a></li> -->
                        <li class="menu__item"><a href="<?php echo $baseFolder."/charters/charter_program_map/".$data['programid'].'/'.$data['dbname'].'/owner'; ?>"><?php echo $startdate; ?></a></li>
                    <?php
                            
                        } ?>
                </ul>
            <?php } ?>
    
        </li>    
        <li class="menu__item" ><a href="#">How To Video</a>
           <ul class="submenu">
                   <li class="menu__item" id="MenuHowToVideo"><a href="#">Preference Sheets</a></li>
                   <li class="menu__item" id="MenuHowToVideoCharterHead"><a href="#">Head Charterer</a></li>
                </ul>
            </li>
        <li> <a href="<?php echo $baseFolder."/charters/privacytermsofuse/1" ?>" target="blank">Terms of Use</a></li>
        <li> <a href="<?php echo $baseFolder."/charters/privacytermsofuse/2" ?>" target="blank">Privacy Policy</a></li>
        <?php } ?>
         <!-- <li class="guest-list"> <a href="#">Guest List</a></li>
           <li><a href="charter_program_map">Cruising Map</a></li>
           <li><a>How To Video</a></li> -->
         <li class="list-logout-row row-hide-btn"><?php echo $this->Html->link('Logout','/',array('escape' =>false,'title' => 'Logout'));?></li>
        </ul>
    </nav>
</section>
</div>
</div>
</div>
<h1 class="position-mobile-head rowgustlist-p">Guest List</h1>

            

<span class="label-bold md-block ychat-hd-row" style="font-size: 35px;color: #fff;"> <?php echo isset($companyData['Fleetcompany']['management_company_name']) ? $companyData['Fleetcompany']['management_company_name'] : ""; ?></span>
<div id="content" class="list-page-container">
    <div class="two viewcontainer-hd view-mainrow">
        <div class="bigitem md-row-space">

<span class="label-bold sp-leftalign"><?php echo date_format(date_create($charterData['CharterGuest']['charter_from_date']), 'd M Y')." to ".date_format(date_create($charterData['CharterGuest']['charter_to_date']), 'd M Y'); ?></span>
           <!--  <span class="label-bold top-align-md-class sp-centeralign"> <?php echo $session['yacht_name']; ?></span> -->

            <span class="label-bold yacht-centerlabel"><?php echo $charterData['CharterGuest']['embarkation']; ?> to <?php echo $charterData['CharterGuest']['debarkation']; ?></span>


            <span class="label-bold md-bold sp-rightalign"><?php echo $charterData['CharterGuest']['charter_name']; ?></span>
            
           <!--  <span>Enter the name and email of the guest and press the button to send them their preference forms.</span> -->
        </div>

   <div class="three none-mob-ctrl">
    <div class="round-logo">
        <!-- <a href="charter_program_map" class="map-row"><i class="fa fa-globe fa-fnt fa-pos" aria-hidden="true"></i></a>
        <p>Cruising Map</p>
        <p><a>Click to View</a></p> -->
    </div>

</div>
    </div>
    <div class="one none-mob-ctrl">
        <div class="center-img">
            <!-- <p>New to Charter Guest?</p>
            <p><a>Click Here To Learn</a></p>
            <?php if (isset($sessionData["fleetLogoUrl"]) && !empty($sessionData["fleetLogoUrl"])) { ?>
                <img src="<?php //echo $sessionData["fleetLogoUrl"]; ?>" alt="">
            <?php } ?>  -->
        </div>
    </div>

<div  class="container-fluid">
  <div class="charterer-viewcontainer">  
        <!-- Head charterer id -->
        <input type="hidden" id="headChartererId" value="<?php echo $charterData['CharterGuest']['id']; ?>">
        <!-- Charter program id -->
        <input type="hidden" id="charterProgramId" value="<?php echo $charterData['CharterGuest']['charter_program_id']; ?>">
        <!-- Yacht id -->
        <input type="hidden" id="yachtId" value="<?php echo $charterData['CharterGuest']['yacht_id']; ?>">
        <!-- company id -->
        <input type="hidden" id="charter_company_id" value="<?php echo $charter_company_id; ?>">
        <!-- Charter head salutation -->
        <input type="hidden" id="existSalutation" value="<?php echo $charterData['CharterGuest']['salutation']; ?>">

<div class="table table-condensed no-border" id="guestDetailsTable">
<div class="header-row">
    <div class="tcont-center md-row-h-8 md-left-text">HEAD CHARTERER
     <div class="info-box" data-toggle="modal" data-target="#info-modal"><img src="../../../../img/info-icon.jpg"></div>       
    </div>
<div class="tcont-center md-row-hd-12 md-hdtilt">Title</div>
<div class="tcont-center md-row-hd-20 p-first-name">First Name</div>
<div class="tcont-center md-row-hd-20 p-last-name">Last Name</div>
<div class="tcont-center emailFieldClass md-row-hd-30 p-email-name">Email</div>
<div class="tcont-center md-row-hd-20 p-prefrenace-name md-row-hd-20-10">Preference Sheets</div>
<!--    <th class="tcont-center" colspan="2">Submitted P-Sheets</th> -->
</div>
<div id="charterguest">
<?php if(isset($ismobile) && $ismobile == 1){ ?>
<div class="mobile-owl-view">
<?php include 'view-min.php';?>       
</div>
<?php }else{ ?>
<div class="mobile-owl-view">
  <?php include 'view-min.php';?>   
</div>
<?php } ?>
</div></div>
<div class="col-md-12">
            <div class="pull-right footer-mob-row">
                <button class="btn btn-success" id="saveBtn">Save</button>
            </div>
        </div> 
</div>
</div></div></div>

<!-- <script>
    $(document).ready(function() {
  //initializing tooltip
  $('[data-toggle="tooltip"]').tooltip();
});
</script> -->
   <!-- New Help Section modal choooser -->
<div class="modal helpModal" tabindex="-1" role="dialog" id="renewModal" style="overflow:auto;">
  <div class="modal-dialog">
    <div class="modal-content" style="border:none;">
      
      <div class="modal-body clearfix">
         
          Click Yes to resend the invitation email with login credentials.
          <br>
          <br>
          <center>
              <input type="hidden" value="" id="resend_val" name="resend_val">
            <input type="button" value="Yes" id="resend_confirm" class="btn btn-default"> &nbsp;&nbsp;
            <input type="button" value="No" id="resend_cancel" class="btn btn-default">
          </center>
       </div>
         
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  <!---- Send Mail modal --------->  

  <div class="modal helpModal" tabindex="-1" role="dialog" id="completeMsgModal" style="overflow:auto;">
  <div class="modal-dialog">
    <div class="modal-content" style="border:none;">
      
      <div class="modal-body clearfix">
         
            Sorry you are unable to change this after preferences are complete.
          <br>
          <br>
          <center>
            <input type="button" value="Close" id="completeMsgModalClose" class="btn btn-default">
          </center>
       </div>
         
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script> 
    
// Submit Guests with mail sending
jQuery(document).on("click",".sendMailClass",function(e){
//$(".sendMailClass").on("click", function(e) {
    console.log('kkk');
    var classObj = $(this);
    var rowObj = $(this).closest('div .row');
    var error = 0;
    $(".inputError").removeClass('inputError');
    rowObj.find('input:not([name^=is_head_charterer]),select').not("input[type='hidden']").each(function(e) {
        if ($(this).val().trim() == "") {
            $(this).addClass("inputError").blur();
            error++;
        } else {
            $(this).removeClass("inputError");
            
        }
    });
    
    if(rowObj.find('.isHeadChartererChecked').val() == ""){
                rowObj.find('.gry-btn').addClass("inputError").blur();
                error++;
    }else{

        rowObj.find('.gry-btn').removeClass("inputError");
    }
    
    var yachtId = $("#yachtId").val();
    var charterProgramId = $("#charterProgramId").val();
    var charter_company_id = $("#charter_company_id").val();
    var existCharterHeadId = classObj.data('charterheadid');
    var charterAssocId = classObj.data('charterassocid');
    var headChartererId = $("#headChartererId").val();
    var isHeadCharterer = 0;
    /*if (rowObj.find("input[name='is_head_charterer']").is(':checked')) {
        isHeadCharterer = 1;
    }*/
    var isHeadCharterer = rowObj.find(".isHeadChartererChecked").val();
    //console.log(isHeadCharterer);
    var salutation = rowObj.find("select[name='salutation[]']").val();
    var firstName = rowObj.find("input[name='first_name[]']").val();
    var lastName = rowObj.find("input[name='last_name[]']").val();
    var email = rowObj.find("input[name='email[]']").val();

    //var rowindexNo = classObj.data('rowindex');
    
    //at the time of clicking email if any other rows filled we need to insert that also to tables and also send email only to clicked row.
    // as existing code fetching all the rows and passing to the function
    var Otherrowdata = $("#guestDetailsTable div").find(".rowInput").serialize();

    
    
    var data = {
        "yachtId": yachtId,
        "charterProgramId": charterProgramId,
        "existCharterHeadId": existCharterHeadId,
        "headChartererId": headChartererId,
        "charterAssocId": charterAssocId,
        "isHeadCharterer": isHeadCharterer,
        "charter_company_id": charter_company_id,
        "salutation": salutation,
        "firstName": firstName,
        "lastName": lastName,
        "email": email,
        "resend":0, // not sending email again
        "Otherrowdata":Otherrowdata
    };
    //console.log(error);
    if (!error) {
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: BASE_FOLDER+'/charters/saveAndSendMail',
            dataType: 'json',
            data: data,
            success:function(result) {
                
                //console.log(result); return false;
                if (result.status == 'success') {
                    
                    /*classObj.addClass("displayNone");
                    classObj.siblings('.emailSentClass').removeClass("displayNone");
                    if (isHeadCharterer == 1 && result.assocIdLink != undefined && result.assocIdLink != "") {
                        //alert();
                        rowObj.find('.newGuestAssoc').attr("href", result.assocIdLink);
                        rowObj.find(".newGuestAssoc").show();
                        rowObj.find(".newGuestAssoc").removeAttr("disabled");
                        rowObj.find(".newGuestAssoc").attr("disabled", false);
                        rowObj.find('.newGuestAssoc').removeClass("btn-default").addClass("btn-primary");
                        //rowObj.find(".btn-open").attr("href", result.assocIdLink);
                        //window.location.href = result.assocIdLink;
                    }
                    
                    // Including the inserted Charter assoc id
                    if (result.newGuestAssocId != undefined && result.newGuestAssocId != "") {
                        rowObj.find('.newGuestAssocId').val(result.newGuestAssocId);
                    }*/
                    $("#hideloader").hide();
                    location.reload();
                    
                } else if(result.status == 'invalid_email') {
                    $("#hideloader").hide();
                    rowObj.find("input[name='email[]']").addClass('inputError').blur();
                } else {
                    $("#hideloader").hide();
                    alert(result.message);
                }   
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    } else {
        return false;
    }
    
});

$(".btn-eml-send1").on("click", function(e){
    //alert();
    
    var classObj = $(this);
    var rowObj = $(this).closest('div .row');
    var error = 0;
    $(".inputError").removeClass('inputError');
    rowObj.find('input:not([name^=is_head_charterer]),select').not("input[type='hidden']").each(function(e) {
        if ($(this).val().trim() == "") {
            $(this).addClass("inputError").blur();
            error++;
        } else {
            $(this).removeClass("inputError");
        }
    });
    
    var yachtId = $("#yachtId").val();
    var charterProgramId = $("#charterProgramId").val();
    var existCharterHeadId = classObj.data('charterheadid');
    var charterAssocId = classObj.data('charterassocid');
    var headChartererId = $("#headChartererId").val();
    var isHeadCharterer = 0;
    /*if (rowObj.find("input[name='is_head_charterer']").is(':checked')) {
        isHeadCharterer = 1;
    }*/
    var isHeadCharterer = rowObj.find(".isHeadChartererChecked").val();
    //console.log(isHeadCharterer);
    var salutation = rowObj.find("select[name='salutation[]']").val();
    var firstName = rowObj.find("input[name='first_name[]']").val();
    var lastName = rowObj.find("input[name='last_name[]']").val();
    var email = rowObj.find("input[name='email[]']").val();
    
    var resend_email = {
        "yachtId": yachtId,
        "charterProgramId": charterProgramId,
        "existCharterHeadId": existCharterHeadId,
        "headChartererId": headChartererId,
        "charterAssocId": charterAssocId,
        "isHeadCharterer": isHeadCharterer,
        "salutation": salutation,
        "firstName": firstName,
        "lastName": lastName,
        "email": email,
        "resend":1 //  sending email again
    };
    console.log(resend_email);
    jQuery("#resend_val").val(JSON.stringify(resend_email));
    jQuery('#renewModal').fadeIn();
});
 jQuery(document).on("click","#resend_cancel",function(e){
        
        jQuery('#renewModal').fadeOut();
    
 });
 jQuery(document).on("click","#resend_confirm",function(e){
     
     var value = $('#resend_val').val(); //retrieve array
     value = JSON.parse(value);
     
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: BASE_FOLDER+'/charters/saveAndSendMail',
            dataType: 'json',
            data: value,
            success:function(result) {
                $("#hideloader").hide();
                //console.log(result); return false;
                if (result.status == 'success') {
                    jQuery('#renewModal').fadeOut();
                } else if(result.status == 'invalid_email') {
                    //rowObj.find("input[name='email[]']").addClass('inputError').blur();
                    alert('invalid email');
                } else {
                    alert(result.message);
                }   
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    
     
 });
// Head charterer checkbox onchange
// Submit Guests with mail sending
/*$(".isHeadCharterer").on("click", function(e) {
    if ($(this).is(":checked")) {
        $(this).closest("tr").find(".isHeadChartererChecked").val(1);
        $(this).closest("tr").find(".sendMailClass").attr("disabled", true);
        $(this).closest("tr").find(".newGuestAssoc").attr("disabled", false);
        $(this).closest("tr").find(".newGuestAssoc").removeClass("btn-default").addClass("btn-primary");
        $(this).closest("tr").find(".inputError").removeClass("inputError");
    } else {
        $(this).closest("tr").find(".isHeadChartererChecked").val(0);
        $(this).closest("tr").find(".sendMailClass").attr("disabled", false);
        $(this).closest("tr").find(".newGuestAssoc").attr("disabled", true);
        $(this).closest("tr").find(".newGuestAssoc").removeClass("btn-primary").addClass("btn-default");
    }
}); */
$(".isHeadChartererYes").on("click",function(e){
    if($(this).attr('data-psheetsubmitornot') == 1){
        
            jQuery('#completeMsgModal').fadeIn();
            return true;
    }else{
        $(this).closest("div").find(".isHeadChartererChecked").val(2);
        $(this).removeClass("gry-btn").addClass("yes-btn");
        $(this).closest("div").find(".isHeadChartererNo").removeClass("no-btn").addClass("gry-btn");
        $(this).closest("div .row").find(".sendMailClass").removeClass("displayNone").addClass("disableBeforesave");
        $(this).closest("div .row").find(".sendMailClass").attr("disabled", true);

        var datasaved = $(this).attr('data-saved');
        if(datasaved == 1){
            var dataemailsentornot = $(this).attr('data-emailsentornot');
            var datapsheetsubmitornot = $(this).attr('data-psheetsubmitornot');   
            // console.log(datasaved);
            // console.log(dataemailsentornot);
            // console.log(datapsheetsubmitornot);
            if(datapsheetsubmitornot == ""){ //console.log('lll')
                $(this).closest("div .row").find(".sendMailClass").text('OPEN');
                $(this).closest("div .row").find(".sendMailClass").attr("disabled", false);
                $(this).closest("div .row").find(".sendMailClass").removeClass("sendMailClass").removeClass("existingCheckFunction").addClass("existingCheckFunction");

                $(this).closest("div .row").find(".hideshow ").removeClass("disableBeforesave").removeClass("btn-warning").addClass("ch-waiting-btn").text('WAITING').show();
                $(this).closest("div .row").find(".hideshow").css('display','block');
                $(this).closest("div .row").find(".hideshow").attr("disabled", false);
                $(this).closest("div .row").find(".hideshow").css({"opacity": "","pointer-events": "","cursor":"pointer"});
                $(this).closest("div .row").find(".hideshow ").removeClass("existingCheckFunction").addClass("existingCheckFunction");
                
                //var txtopen =$(this).closest("div .row").find(".sendMailClass").text();
                // if(txtopen == "OPEN"){
                //     $(this).closest("div .row").find(".hideshow").css({"opacity": "0"});
                // }
            }

            if(dataemailsentornot == 1){
                $(this).closest("div .row").find(".emailSentClass").hide();
                $(this).closest("div .row").find(".sendMailClass").show();
                $(this).closest("div .row").find(".existingCheckFunction").css('display','block');
            }
            
        }else{
            $(this).closest("div .row").find(".sendMailClass").text('OPEN');
        }


        //$(this).closest("div .row").find(".newGuestAssoc").show();
        //$(this).closest("div .row").find(".newGuestAssoc").attr("disabled", false);
        //$(this).closest("div .row").find(".newGuestAssoc").removeClass("btn-default").addClass("btn-primary");
        $(this).closest("div .row").find(".inputError").removeClass("inputError");
        //$(this).closest("div .row").find(".hideshow ").removeClass("ch-waiting-btn").addClass("btn-warning").text('OPEN').show();
    }
});


$(".isHeadChartererNo").on("click",function(e){ 

    if($(this).attr('data-psheetsubmitornot') == 1){
            jQuery('#completeMsgModal').fadeIn();
            return true;
    }else{

        $(this).closest("div").find(".isHeadChartererChecked").val(1);
        $(this).removeClass("gry-btn").addClass("no-btn");
        $(this).closest("div").find(".isHeadChartererYes").removeClass("yes-btn").addClass("gry-btn");
        $(this).closest("div .row").find(".sendMailClass").removeClass("displayNone").removeClass("disableBeforesave");
        $(this).closest("div .row").find(".sendMailClass").attr("disabled", false);
        var datasaved = $(this).attr('data-saved');
        if(datasaved == 1){
            var dataemailsentornot = $(this).attr('data-emailsentornot');
            var datapsheetsubmitornot = $(this).attr('data-psheetsubmitornot');   
            // console.log(datasaved);
            // console.log(dataemailsentornot);
            // console.log(datapsheetsubmitornot);
            if(dataemailsentornot == ""){
                $(this).closest("div .row").find(".existingCheckFunction").text('EMAIL');
                $(this).closest("div .row").find(".existingCheckFunction").removeClass("disableBeforesave").addClass("sendMailClass").removeClass("existingCheckFunction");
                $(this).closest("div .row").find(".hideshow").css('display','block');
                $(this).closest("div .row").find(".hideshow").css({"opacity": "0","pointer-events": "none"});
                $(this).closest("div .row").find(".hideshow").removeClass("disableBeforesave");
            }

            if(dataemailsentornot == 1){
                $(this).closest("div .row").find(".sendMailClass").hide();
                $(this).closest("div .row").find(".disableBeforesave").hide();
                $(this).closest("div .row").find(".emailSentClass").show();
                $(this).closest("div .row").find(".hideshow").removeClass("ch-waiting-btn").removeClass("existingCheckFunction");
                $(this).closest("div .row").find(".hideshow").css({"display": "inline-block","padding":"0","cursor": "not-allowed"});
                
            }
        }else{
            $(this).closest("div .row").find(".sendMailClass").text('EMAIL');
        }
       // $(this).closest("div .row").find(".newGuestAssoc").show();
        //$(this).closest("div .row").find(".newGuestAssoc").attr("disabled", true);
       
        //$(this).closest("div .row").find(".hideshow ").removeClass("btn-warning").addClass("ch-waiting-btn").text('WAITING').show();
        
       
       // $(this).closest("div .row").find(".newGuestAssoc").removeClass("btn-primary").addClass("btn-default");
    }
});
// Submit and Redirect to the Preference pages when OPEN button clicked(If Head charterer is checked)

$("#completeMsgModalClose").on("click",function(e){
    jQuery('#completeMsgModal').fadeOut();
});


$(".newGuestAssoc").on("click", function(e) {
    
    var classObj = $(this);
    var rowObj = $(this).closest('tr');
    var error = 0;
    $(".inputError").removeClass('inputError');
    rowObj.find('input:not([name^=is_head_charterer]),select').each(function(e) {
        if ($(this).val().trim() == "") {
            $(this).addClass("inputError").blur();
            error++;
        } else {
            $(this).removeClass("inputError");
        }
    });
    
    var yachtId = $("#yachtId").val();
    var charterProgramId = $("#charterProgramId").val();
    var existCharterHeadId = classObj.data('charterheadid');
    var charterAssocId = classObj.data('charterassocid');
    var headChartererId = $("#headChartererId").val();
    var isHeadCharterer = 0;
    if (rowObj.find("input[name='is_head_charterer']").is(':checked')) {
        isHeadCharterer = 1;
    }
    var salutation = rowObj.find("select[name='salutation[]']").val();
    var firstName = rowObj.find("input[name='first_name[]']").val();
    var lastName = rowObj.find("input[name='last_name[]']").val();
    var email = rowObj.find("input[name='email[]']").val();
    
    var data = {
        "yachtId": yachtId,
        "charterProgramId": charterProgramId,
        "existCharterHeadId": existCharterHeadId,
        "headChartererId": headChartererId,
        "charterAssocId": charterAssocId,
        "isHeadCharterer": isHeadCharterer,
        "salutation": salutation,
        "firstName": firstName,
        "lastName": lastName,
        "email": email,
        "mailSending": "no"
    };
    
    if (!error) {
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: BASE_FOLDER+'/charters/saveAndSendMail',
            dataType: 'json',
            data: data,
            success:function(result) {
                $("#hideloader").hide();
                //console.log(result); console.log(isHeadCharterer); return false;
                if (result.status == 'success') {
                    //alert();
                    if (isHeadCharterer == 1 && result.assocIdLink != undefined && result.assocIdLink != "") {
                        classObj.attr("href", result.assocIdLink);
                        window.location.href = result.assocIdLink;
                    }
                    //window.location.reload();
                } else if(result.status == 'invalid_email') {
                    rowObj.find("input[name='email']").addClass('inputError').blur();
                } else {
                    alert(result.message);
                }   
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    } else {
        return false;
    }
    
});

// Saving the newly entered Associates details
$("#saveBtn").on("click", function(e) {
    //$("#saveBtn").attr("disabled", true);
    // Validation
    var error = 0;
    $(".inputError").removeClass('inputError');
    $("#guestDetailsTable div").each(function (e) {
       // console.log(e);
        var empty = 0;
        var divobj = $(this);
        divobj.find('.charterRow').each(function () {
            var validateMessage = $(this).find(".validateMessage");
                $(validateMessage).css({ display: "none" });
                $(this).find(".validateInput").each(function () {
                    //console.log($(this).val());
                    if ($(this).val().trim() == "") {
                        $(this).addClass("inputError").blur();
                        empty++;
                        error = 1;
                        $(validateMessage).css({ display: "block" });
                    } else {
                        $(this).removeClass("inputError");
                    }
                });
                if($(this).find('.isHeadChartererChecked').val() == ""){
                    $(this).find('.gry-btn').addClass("inputError").blur();
                    error = 1;
                }else{

                    $(this).find('.gry-btn').removeClass("inputError");
                }

                if (empty == 4) {
                    $(this).find(".validateInput").removeClass("inputError");
                    $(this).find('.gry-btn').removeClass("inputError");
                    error = 0;
                } else if (empty > 0) {
                    return true; // Break the loop
                }
        }); 
    });
    
    console.log(error);
    //console.log(empty);
    //return false;
    if (!error) {
        var data = $("#guestDetailsTable div").find(".rowInput").serialize();
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: BASE_FOLDER+'/charters/saveGuests',
            dataType: 'json',
            data: data,
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    location.reload();
                } else {
                    
                    alert('Please select if guest is Head Charterer or not.');
                    $("#saveBtn").attr("disabled", false);
                    return false;
                }   
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    } else {
        return false;
    }
    
});

</script>

<?php //print_r($buttoncls); ?>

<script>
var sidebar = (function() {
    "use strict";
    var $contnet         = $('#content'),
        $sidebar         = $('#sidebar'),
        $sidebarBtn      = $('#sidebar-btn'),
        $toggleCol       = $('body').add($contnet).add($sidebarBtn),
        sidebarIsVisible = false;
    $sidebarBtn.on('click', function() {
        if (!sidebarIsVisible) {
            bindContent();
        } else {
            unbindContent();
        }
        toggleMenu();
    });
    function bindContent() {

        $contnet.on('click', function() {
            toggleMenu();
            unbindContent();
        });
    }
    function unbindContent() {
        $contnet.off();
    }
    function toggleMenu() {
        $toggleCol.toggleClass('sidebar-show');
        $sidebar.toggleClass('show');

        if (!sidebarIsVisible) {
            sidebarIsVisible = true;
        } else {
            sidebarIsVisible = false;
        }
    }
})();


$('.menu > .menu__item').hover(function(){
  $(this).children('.submenu').show();
  
}, function() {
  $(this).children('.submenu').hide();
  
});

</script> 

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
.info-modal-pop .modal-body{
    padding: 20px!important;
    margin-left: 0px!important;
}
.rowm-md-mob-resize label{
    display: none;
}
.container-row-column .row .form-control {
    margin-bottom: 12px;
}
.info-modal-pop .modal-content{
    border-radius: 0px;
    width: auto;
}
.charterer-viewcontainer{
    width: 600px;
    display: block;
    margin: 0 auto;
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

.yachtHeaderName{font-weight: bold;font-size: 46px;}
.container-row-column .row{margin-bottom: 7px;margin: 0px;}
.container-row-column .row .form-control{
    height: 30px!important;
}
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
    .emailFieldClass {
        width: 30%;
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
#saveBtn{margin-right: 110px;border-radius: 0px;}

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
    padding: 6px 20px;
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
    opacity: 40!important;
    padding: 6px 20px;
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
    background: rgb(229 224 224 / 70%)!important;  color: #000;
  transition: 0.5s;
  border: 2px solid transparent;
}
.menu .menu__item {
  list-style: none;
  font-size: 1.5rem;
}
.nav-side-menu-full-container .nav-side-menu .sidebar.show{
    overflow-y: inherit;
}
.menu .submenu {
    position: absolute;
    right: -205px;
    padding-left: 0;
    top: 0px;
  display: none;
}
.menu .submenu .menu__item{
    display: block;
        width: 100%;
}
.menu .submenu .menu__item a{
        margin-bottom: 1px;
    display: inline-block;
    width: 200px;
    border: solid 1px #356173;
}
.menu .submenu .menu__item a:hover{
    color:#fff !important;
    background: #149be9 !important;
}
.menu .submenu .menu__item a:hover, .menu .submenu .menu__item a:focus {
    color: #fffefe!important;
    background-color: rgba(16, 16, 16, 0.51)!important;
    transition: 0.5s;
}

.md-left-text{    text-align: left!important;
    padding: -3px;
    margin-left: -5px;
    position: relative;
    left: -13px;
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
.md-row-h-10{width:37%;}
.md-row-h-8{width:8%;}
.md-row-h-18{width:18%;}
.md-row-h-12{width:20%;}
.md-row-h-30{width:28%;}
.md-row-h-20{width:15%;}

.md-row-hd-10{width:15%;}
.md-row-hd-18{width:18%;}
.md-row-hd-12{width:20%;}
.md-row-hd-30{width:28%;}
.md-row-hd-20{width:37%;}



.header-row {width:100%;display: inline-block;margin: 0px 13px;}
.container-row-column .row>div {
    float: left;
    margin: 0px 0.4%;

}
.btn-eml-send{width:78px; color: #000}
.btn-eml-send1{width:78px;}
.btn-open{width:78px;}





@media screen and (max-width: 1200px) {

.md-row-h-10{width:37%;}
.md-row-h-8{width:10%;}
.md-row-h-18{width:20%;}
.md-row-h-12{width:20%;}
.md-row-h-30{width:24%;}
.md-row-hd-18{width:18%;}
.md-row-hd-12{width:20%;    margin: 0px 0.4%!important;}
.md-row-hd-30{width:26%;margin: 0px 0.4%!important;}
.md-row-hd-20{width:37%;margin: 0px 0.4%!important;}
#saveBtn{margin-right:83px;border-radius: 0px;}
.header-row div{font-size:12px;margin: 0px;}
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
    display: block!important;
    color: #fff;
}
.footer-mob-row .btn-success {
    width: 140px;
}


.container-row-column {
    margin: 55px 13px 0px 13px;
}

.md-row-h-12{width:20%;}
.md-row-h-10 {width:37%;}
.md-row-h-8{
    width: 50%;
    left: 15%;
    float: right;
    position: absolute;
    top: 200px;
}
.rowm-md-mob-resize{
       display: inline-block;
    width: 100%;


}
.md-row-h-30{display: inline-block;margin:5px 2px!important;width:98.9%;}
.md-row-h-18 {
        width: 197px!important;
    float: right!important;
    position: relative;
    right: 6%;
}
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
    display: inline-block;
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
#saveBtn {
    margin-right: 110px;
}
}
/*.mobile-owl-view{display: none;}
.desk-owl-view{display: block;}*/
.desk-owl-view label{display: none;}
@media only screen and (max-width:1000px){
/*.mobile-owl-view{display: block;}
.desk-owl-view{display: none;}*/
}
@media screen and (max-width: 990px){
    .md-row-h-30, .md-row-h-10, .md-row-h-12{
        display: inline-block!important;
        margin-bottom: 0px!important;
    }
.rowm-md-mob-resize {
    margin: 0px 0px !important;

}
.nav-side-menu-full-container .nav-side-menu .sidebar-btn {
    top: 53px;
}
.charterRow, .mobile-owl-view {
    width: auto;
    margin: 0 auto;
}
.md-row-h-30{
    width: 37%!important;
}
.md-row-h-10{
    width: 37%!important;
} 
.md-row-h-12{
        width: 20%!important;
}


}
@media only screen and (max-width:600px){
.md-row-h-18{
    right: 6px;
    width: 135px!important;
  }
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
}

@media only screen and (max-width:990px){
.container {
    width: 100%;
}
.bigitem {
    padding-bottom:0px;
}
}


@media only screen and (max-width:768px){

.info-modal-pop .modal-dialog {
    padding-left: 0px;
    width: auto;
        top: 20%;
}

}
@media screen and (max-width:768px) {
.info-box img{width: 14px;}

}
@media screen and (max-width:767px) {
.md-row-h-12,
.md-hdtilt{
    display: none!important;
}
.position-mobile-head{
top:75px!important;
}
.sp-leftalign{
margin-top: 26px!important;
}
.bigitem{
text-align: left!important;
}
.charterer-viewcontainer {
    width:100%;
    display: block;
    margin: 0 auto;
    display: inline-block;
}
.md-row-h-10,
.md-row-hd-20{
width: 47%!important;
}
.container-row-column .row .form-control {
    margin-bottom: -6px;
}
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

@media screen and (max-width: 360px) {
.md-row-h-18 {
    right: 0px;
    width: 143px!important;
}
}

.header-row {
    margin: 12px 0px;
}

.menu .submenu{
    right:-162px !important;
}

/* .menu .submenu .menu__item {
    width: 50% !important;
} */

.menu .submenu .menu__item a {
    width: 168px !important;
    
}
</style>
  

<?php 
    echo $this->Html->css('charter/style');

    $charter_assoc_info = $this->Session->read('charter_assoc_info');

?>    
<script>
    var BASE_FOLDER = "<?php echo $baseFolder; ?>";
</script> 
                            
                    </div>


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
            <?php //if(isset($charter_assoc_info) && !empty($charter_assoc_info)){?>
        <li> <a href="<?php echo $baseFolder."/charters/programs/".$sessionData['guestListUUID'];  ?>">Charter Programs</a>
        
        <li class="menu__item" ><a>How To Video</a>
           <ul class="submenu">
                   <li class="menu__item" id="MenuHowToVideo"><a href="#">Preference Sheets</a></li>
                   <li class="menu__item" id="MenuHowToVideoCharterHead"><a href="#">Head Charterer</a></li>
                </ul>
            </li>
        <li> <a href="<?php echo $baseFolder."/charters/privacytermsofuse/1" ?>" target="blank">Terms of Use</a></li>
        <li> <a href="<?php echo $baseFolder."/charters/privacytermsofuse/2" ?>" target="blank">Privacy Policy</a></li>
        <?php //} ?>
         <!-- <li class="guest-list"> <a href="#">Guest List</a></li>
           <li><a href="charter_program_map">Cruising Map</a></li>
           <li><a>How To Video</a></li> -->
         <li class="list-logout-row row-hide-btn"><?php echo $this->Html->link($this->Html->image("admin/table.png", array("alt" => "","title" => "Logout")).'Logout','/',array('escape' =>false,'title' => 'Logout'));?></li>
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

          <!--   <span class="label-bold top-align-md-class"> <?php echo $session['yacht_name']; ?></span> -->
            <span class="label-bold sp-rightalign"><?php echo $charterData['CharterGuest']['charter_name']; ?></span>
            <span class="label-bold sp-leftalign"><?php echo date_format(date_create($charterData['CharterGuest']['charter_from_date']), 'dS F Y')." to ".date_format(date_create($charterData['CharterGuest']['charter_to_date']), 'dS F Y'); ?></span>
            <span class="label-bold username-p yacht-centerlabel">Antiqua to Anguilla</span>
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
     
<div class="table table-condensed no-border" id="guestDetailsTable">
<div class="header-row">
    <!-- <div class="tcont-center md-row-h-8 md-left-text">HEAD CHARTERER
     <div class="info-box" data-toggle="modal" data-target="#info-modal"><img src="../../../../img/info-icon.jpg"></div>       
    </div> -->
<div class="tcont-center md-row-hd-12 md-hdtilt">Title</div>
<div class="tcont-center md-row-hd-20">First Name</div>
<div class="tcont-center md-row-hd-20">Last Name</div>
<!-- <div class="tcont-center emailFieldClass md-row-hd-30">Email</div> -->
<!-- <div class="tcont-center md-row-hd-20 md-row-hd-20-10">Preference Sheets</div> -->
<!--    <th class="tcont-center" colspan="2">Submitted P-Sheets</th> -->
</div>
<div id="charterguest">
<?php if(isset($ismobile) && $ismobile == 1){ ?>
<div class="mobile-owl-view">
<?php include 'view-min-guest.php';?>       
</div>
<?php }else{ ?>
<div class="desk-owl-view">
  <?php include 'view-min-guest.php';?>   
</div>
<?php } ?>
</div></div>
<div class="col-md-12">
            <div class="pull-right footer-mob-row">
               
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





<script type="text/javascript">
    $(document).ready(function() {
  $('.owl-carousel').owlCarousel({
    stagePadding:0,/*the little visible images at the end of the carousel*/
     
    loop:false,
    rtl: false,
    lazyLoad:true,
    margin:0,
    dots:true,
    singleItem:true,
    responsiveClass:true,
    nav:false,
    items : 1, 
      responsive : {
            480 : { items : 1  }, // from zero to 480 screen width 4 items
            768 : { items : 1,
                    touchDrag:true,
                    mouseDrag:false,
             }, // from 480 screen widthto 768 6 items
        },
        900:{
            items:0,
            mouseDrag:false,
            touchDrag:false,
            nav:false,
        },
    // responsive:{
    //     0:{
    //         items:1,
    //          mouseDrag:true,
    //         touchDrag:true
    //     },
    //     1024:{
    //         items:0,
    //         mouseDrag:false,
    //         touchDrag:false
    //     },
    // }
})


 
});

</script>


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
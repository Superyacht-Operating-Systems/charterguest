<?php 

echo $this->Html->css('admin/font/fontawesomePro/css/fontawesome.css');
echo $this->Html->css('admin/font/fontawesomePro/css/brands.css');
echo $this->Html->css('admin/font/fontawesomePro/css/solid.css');
echo $this->Html->css('admin/font/fontawesomePro/css/light.css');
echo $this->Html->css('admin/font/fontawesomePro/css/v5-font-face.css');	

$isFleetUser = $this->Session->read('loggedUserInfo.is_fleet');
$userType = $this->Session->read('loggedUserInfo.user_type');
$basefolder = $this->request->base; 
$sessionCharterGuest = $this->Session->read('charter_info.CharterGuest');

$charter_assoc_info = $this->Session->read('charter_assoc_info');

$options = "";
for ($i = 0; $i < $diffDays; $i++) {
    $j = $i + 1;
    $options .= '<option value="'.$j.'">Day '.$j.'</option>';
}

$schedulePeriod = "";
$charterName = "";
$scheduleLocation = "";
if (isset($charterProgData) && !empty($charterProgData)) {
    $schedulePeriod = date_format(date_create($charterProgData['CharterProgram']['charter_from_date']), "d M Y")." - ".date_format(date_create($charterProgData['CharterProgram']['charter_to_date']), "d M Y");
    $charterName = $charterProgData['CharterProgram']['charter_name'];
    $scheduleLocation = $charterProgData['CharterProgram']['embarkation']." to ".$charterProgData['CharterProgram']['debarkation'];
}

if(empty($scheduleData)){
    $no_of_days_loc_options = "";
    $no_of_days_loc_options .= '<option value="current" title="Location to visit in current Day">Current</option>';
    for ($s = 0; $s < $diffDays; $s++) {
        $p = $s + 1;
        $no_of_days_loc_options .= '<option value="'.$p.'">'.$p.' Days</option>';
    }
}else{
    $day_num_arr = array();
    foreach($scheduleData as $val){
              $day_num_arr[] = $val['CharterProgramSchedule']['day_num'];
    }
    if(count($day_num_arr)){
        $days_num_count = array_unique($day_num_arr); 
    }
    $schcount = count($days_num_count);
    $no_of_days_loc_options = "";
    $z = 0;
    $no_of_days_loc_options .= '<option value="current" title="Location to visit in current Day">Current</option>';
    for ($s = $schcount; $s < $diffDays; $s++) {
        $z++;
        $p = $s + 1;
        $no_of_days_loc_options .= '<option value="'.$p.'">'.$z.' Days</option>';
    }

}
// echo $charterGuestDatayacht_id;
// echo "<pre>";print_r($yfullName);
$topyname = $yfullName[$charterGuestDatayacht_id]; 
?>
<script>
//$ = jQuery.noConflict();</script>
<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>
<?php //echo $this->Html->script('libBoot.js'); ?>
<script src="https://api.windy.com/assets/map-forecast/libBoot.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
<style>
    .day1numbermarkernodisplay{
        display:none !important;
    }
.sm-cruisingmsgmyModal .mx-box {
    max-height: 400px;
    min-height: 400px;
    overflow-y: scroll;
}

body .sm-cruisingmsgmyModal  .inbox-item-text{
    margin-left:5px!important;
}
 .mx-box .col-md-12:first-child{
    font-weight:bold;
 }
    .myIconClass{
    margin-left: -12px !important;
    margin-top: -41px !important;
}
    #windy #embed-zoom {
        position: fixed;
    }
    #windy #mobile-ovr-select {
  position: fixed;
    }
  
    .language_dropdown{
font-size: 18px;
width: 28px;
outline: none;
webkit-aperiance: none;
webkit-appearance: none;
moz-appearance: none;
appearance: none;
border: 0px;
background: transparent;
padding: 1px 14px;
margin-left: -25px;
position: absolute;
z-index: 99999;
top: 6px;
cursor: pointer;
}

    /* .custom-popup .leaflet-popup-content {
    overflow-y: auto;
    border-bottom: 1px solid #ddd;
    border-top: 1px solid #ddd;
    overflow-x: hidden;
    min-height: 250px;
    max-height: 500px;
    width: auto !important;
} */



@media only screen and (min-width:1024px){
    body .mydemolabel {
  /* font-size: 36px !important; */
  top: 56px !important;
}
.yachtHeaderName {
  font-size: 36px;
}
    }
@media only screen and (min-width:771px) and (max-width:1024px){
/* 
.yachtHeaderName {
    margin-top: 4px!important;
} */
body .mydemolabel {
    top: 70px!important;
  /* font-size: 30px !important; */
}


}

@media only screen and (min-width: 768px) and (max-width: 771px){
    .container {
  width: 100%!important;
}
}

.loc_desc_div .form-control:focus {
 box-shadow: none !important;
}

.marker_desc_div .form-control:focus, .m_loc_desc_div .form-control:focus {
 box-shadow: none !important;
}
.form-control:focus {
  background: transparent !important;
  color: #4d4d4d !important;
  border: solid 0px rgba(243, 243, 243, 0.7) !important;
}
.auto_resize::selection {
  color: none;
  background: transparent;
}
.CS_modal .modal-header {
  padding: 15px 15px 15px 15px;
}
/* .leaflet-container .leaflet-marker-pane img{
z-index: 1 !important;
} */
.map_bottom_attr{
color: #00a8f3;
display: flex;
font-size: 16px;
margin: 6px auto 2px auto;
width: fit-content;
}
.mark_map_div{
border-radius: 10px;
padding: 0px 10px 10px 10px;
}
.m_loc_desc_div {
  width: 450px;
  margin-right: 10px;
}
.m_loc_img_div{
width: 150px;
}	
.marksup_header{
    padding-bottom:5px;
}
.subloc_name {
  color: #000;
  font-size: 15px;
  border: solid 1px #ffffff;
  width: 100%;
  margin: 0px;
  padding: 8px 5px;
  font-weight: 600;
  background-color: #ffffff;
  font-family: 'monsterrat';
}
.marksub-div {
  /* display: flex; */
  background-color: #fff;
  padding: 18px;
border-radius: 10px;
margin: 15px 5px 20px 5px;
}
.Marker_container_div{
    display: flex;
padding: 18px;
background-color: #fff;
border-radius: 10px;
margin: 15px 5px 20px 5px;
}
.marker_desc_div{
    width: 450px;
margin-right: 10px;
}
.marker_img_div{
width: 150px;
}

.inputContainer_div{
display: flex;
padding: 18px;
background-color: #fff;
border-radius: 10px;
margin: 15px 5px 20px 5px;
}	
.loc_name{
    color: #000;
    font-size: 15px;
    border: solid 1px #ffffff;
    width:68%;
    margin: 0px;
    padding: 8px 5px;
    font-weight: 600;
    background-color: #ffffff;
    font-family: 'monsterrat';
}
.loc_desc_div{
width: 450px;
margin-right: 20px;
}
.loc_desc_field{
    padding: 15px 15px 15px 6px;
    background: #ffffff !important;
    color: #4d4d4d!important;
    border: solid 0px rgb(243 243 243 / 70%)!important;
    box-shadow: none;
    font-family: 'Open Sans';
    text-align: justify;
white-space: normal;
}
.loc_img_div{
width: 150px;
}	
.loc_map_div{
    float: left;
border: solid 1px #ccc;
width: 100%;
overflow: hidden;
height: 150px;
margin-bottom: 10px;
border-radius: 10px;
}
.mLoc-img_prev{
    border: solid 1px #ccc;
    width: 150px;
    overflow: hidden;
    height: 150px;
    border-radius: 10px;
}
.loc_img_prev{
    float: left;
    border: solid 1px #ccc;
    width: 150px;
    overflow: hidden;
    height: 150px;
    border-radius: 10px;
}
.icons_fields{
    padding: 10px 5px 5px 5px;
    border-bottom: 2px solid #eee;
    margin-bottom: 10px;
    font-size: 13px;
}
.icon_label{
    color: #000;
    padding: 0px 10px 0px 5px;
    font-family: 'Open Sans';
}
.l_count_icon{
    width:20px;
    margin-top:5px;
}
.l_count{
    position: relative;
    left: -14px;
top: -2px;
color: #fff;
}
.CS_modal .modal-title{
    font-family: 'monsterrat';
}

.CS_modal,.Mark_modal{
    background-color: #eeeeee;
}
.location_container,.sp-divrow{
    background-color: #ffffff;
}
.iti_time{
    filter: blur(0);
   text-align: center;
   background-color: #00a8f3;
   border-radius: 6px;
   color: #000;
   -webkit-text-fill-color: #000;
  -webkit-opacity: 1;
   font-size: 15px;
   border: solid 1px #ccc;
   width:22% !important;
   margin: 0px;
   padding: 8px 5px;
   font-weight: 600;
}
.mLoc-img_prev {
    z-index: 9999;
position: relative;
}
.loc_img_prev{
    z-index: 9999;
position: relative;
}
.img_count_div{
    width: 100%;
display: flex;
position: relative;
top: -90px;
color: #000;
justify-content: center;
}
.img_count{
    background-color: rgba(255, 255, 255, 0.5);
border-radius: 10px;
min-width: 40px;
display: flex;
text-align: center;
justify-content: center;
z-index: 9999;
cursor: pointer;
padding-top: 1px;
font-size: 14px;
font-weight: bold;
}
@media only screen and (max-width: 766px){
    .img_count_div{
        width: 100%;
display: flex;
position: relative;
top: -90px;
color: #000;
justify-content: center;
}

    .m_loc_desc_div{
        width: 100%;
margin-right: 10px;
    }
    .m_loc_img_div {
  width: 100px;
}
    .marksup_header{
        margin-top: 10px;
}
.subloc_name{
    margin-top: 10px;
}
    .iti_time{
        width:50px !important;
        padding: 2px 0px;
    }
    .lg_tarea{
        display:none;
    }
  
    .sp-upload-img{
    width: 100px!important;
    height: 100px!important;
}
    #modalmap{
        height: 300px;
width: 100%;
border: none !important;
border-radius: 10px !important;
-webkit-border-radius: 10px !important;
-moz-border-radius: 10px !important;
overflow: hidden;
    }
    #modalmapcruisingsch{
        height: 600px;
width: 100%;
border: none !important;
border-radius: 10px!important;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
margin-top:10px;
overflow: hidden;
    }
    .CS_modal, .Mark_modal{
    width:100% !important;
}
.inputContainer_div{
    padding: 18px 8px 18px 8px;
display: grid;
}
.marksub-div {
    padding: 18px 8px 18px 8px;
}
.Marker_container_div{
    display: grid;
    padding: 18px 8px 18px 8px;
}
.loc_img_div{
width: 100%;
}	
.loc_desc_div{
    margin-right: 0px;
width: 100%;
}
.loc_desc_field {
  padding: 15px 5px 15px 5px;
}

.certificat-modal-container .modal-dialog {
    width: 95%!important;
margin: 0 auto;
margin-top: 15px;
}
.loc_map_div{
    width: 49% !important;
margin-left: 1%;
float: right;
margin-bottom: 0px;
}
.loc_img_prev{
    width: 49% !important;
margin-right: 1%;
float: left;
}
.mLoc-img_prev{
    width: 50% !important;
    margin: 15px auto;
}
/* marker popup style */
.marker_desc_div{
    margin-right: 0px;
width: 100%;
}
.marker_img_div{
width: 100%;
}	
}

@media only screen and (min-width: 766px){
    .sm_tarea{
        display:none;
    }
    .CS_modal, .Mark_modal{
    width:650px!important;
}
#modalmap{
        height: 300px;
width: 455px;
margin:0 auto;
border: none !important;
border-radius: 10px;

    }
    #modalmapcruisingsch{
        height: 300px;
width: 580px;
margin:10px auto;
border: none !important;
border-radius: 10px;

    }
}

.auto_resize {
        resize: none!important;
        overflow: hidden!important;
        /* border: 1px solid black; */
      }
::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    color:gray!important;
    opacity: 1!important;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
   color:gray!important;
     opacity: 1!important;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
   color:gray!important;
     opacity: 1!important;
}
:-ms-input-placeholder { /* Internet Explorer 10-11 */
   color:gray!important;
     opacity: 1!important;
}
::-ms-input-placeholder { /* Microsoft Edge */
   color:gray!important;
     opacity: 1!important;
}

::placeholder { /* Most modern browsers support this now. */
    color:gray!important;
}

    .wt-st{
        width: 225px;
        margin: 5px 0px;
    }
    .leaflet-popup-scrolled {
  overflow-y: auto;
  border-bottom: 1px solid #ddd;
  border-top: 1px solid #ddd;
  overflow-x: hidden;
}
    .leaflet-popup-content {
  margin: 13px 10px!important;
  line-height: 1.4;
}

/* sub menu */
.menu__item{
    cursor: pointer;
}
.menu > li{
  /* display: inline-block; */
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
  list-style: none;}
.nav-side-menu-full-container .nav-side-menu .sidebar.show{
    overflow-y: inherit;
}
.menu .submenu {
    position: absolute;
    margin-left:182px;
    padding-left: 0;
    top: 0px;
  display: none;
}
.menu .submenu .menu__item{
    display: inline-block;
        width: 100%;
}
.menu .submenu .menu__item a{
    display: inline-block;
        word-break: break-all;
}
.menu .submenu .menu__item a:hover{
    color:#fff !important;
    background: #149be9 !important;
}
@media screen and (max-width: 520px){
    .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
  padding-right: 15px;
  padding-left: 15px;
}
}
@media only screen and (min-width: 771px){
    .map_heightC{
        /* height: calc(100vh - 170px); */
        height: calc(100vh - 121px);
    }
}
@media only screen and (max-width: 771px){
    .map_heightC{
        /* height: calc(100vh - 140px); */
        height: calc(100vh - 121px);
    }
    .nav-side-menu-full-container .nav-side-menu .sidebar {
  width: 120px;
    }
    .nav-side-menu-full-container .nav-side-menu .show {
  width: 180px;
    }
    .sp-close-modal, .mapnotemodalclose, .leaflet-container a.leaflet-popup-close-button {
  right: -4px!important;
  top: -5px!important;
    }
    .leaflet-popup {
  left: -180px !important;
}

.nav-side-menu .sidebar.show {
  transform: translate(0);
  overflow-y: inherit;
}
body .menu .submenu .menu__item a {
  padding: 8px 8px;
  border: none;
}
.menu .submenu .menu__item:hover{
    color:#fff;
}
}
.menu .submenu{
    right:-169px !important;
}
.menu .submenu .menu__item a {
    width: 168px !important;
    
}
/* end submenu */
    .modal {
  z-index: 99999;
    }
    .uplaod-modal .modal-dialog{
   
    width: inherit;
} 
@media only screen and (min-width: 769px){
.uplaod-modal .modal-dialog{
        width: 420px;
} 
}

.map-userlabelp{
position: absolute;
    left: 73px;
    top: 9px;
}

.frmclass {
    /* background: #000!important; */
    color: #000!important;
    border: solid 1px rgb(243 243 243 / 70%)!important;
}
    /* ----------- iPhone 6, 6S, 7 and 8 ----------- */

/* Portrait and Landscape */
@media only screen 
  and (min-device-width: 375px) 
  and (max-device-width: 667px) 
  and (-webkit-min-device-pixel-ratio: 2) { 
   
    .form-control {
    background: none !important;
    color: #000 !important;
    border: solid 1px rgb(243 243 243 / 70%)!important;
    overflow-wrap: break-word;
    }
    .sp-upload-img {
        margin-top:5px;
    }
}

/* Portrait */
@media only screen 
  and (min-device-width: 375px) 
  and (max-device-width: 667px) 
  and (-webkit-min-device-pixel-ratio: 2)
  and (orientation: portrait) { 
    .form-control {
    background: none !important;
    color: #000 !important;
    border: solid 1px rgb(243 243 243 / 70%)!important;
    overflow-wrap: break-word;
    }
    .sp-upload-img {
        margin-top:5px;
    }
}

/* Landscape */
@media only screen 
  and (min-device-width: 375px) 
  and (max-device-width: 667px) 
  and (-webkit-min-device-pixel-ratio: 2)
  and (orientation: landscape) { 
    .form-control {
    background: none !important;
    color: #000 !important;
    border: solid 1px rgb(243 243 243 / 70%)!important;
    overflow-wrap: break-word;
    }
    .sp-upload-img {
        margin-top:5px;
    }
}

/* ----------- iPhone 6+, 7+ and 8+ ----------- */

/* Portrait and Landscape */
@media only screen 
  and (min-device-width: 414px) 
  and (max-device-width: 736px) 
  and (-webkit-min-device-pixel-ratio: 3) { 
    .form-control {
    background: none !important;
    color: #000 !important;
    border: solid 1px rgb(243 243 243 / 70%)!important;
    overflow-wrap: break-word;
    }
    .sp-upload-img {
        margin-top:5px;
    }
}

/* Portrait */
@media only screen 
  and (min-device-width: 414px) 
  and (max-device-width: 736px) 
  and (-webkit-min-device-pixel-ratio: 3)
  and (orientation: portrait) { 

    .form-control {
    background: none !important;
    color: #000 !important;
    border: solid 1px rgb(243 243 243 / 70%)!important;
    overflow-wrap: break-word;
    }
    .sp-upload-img {
        margin-top:5px;
    }
}

/* Landscape */
@media only screen 
  and (min-device-width: 414px) 
  and (max-device-width: 736px) 
  and (-webkit-min-device-pixel-ratio: 3)
  and (orientation: landscape) { 

    .form-control {
    background: none !important;
    color: #000 !important;
    border: solid 1px rgb(243 243 243 / 70%)!important;
    overflow-wrap: break-word;
    }
    .sp-upload-img {
        margin-top:5px;
    }
}

/* ----------- iPhone X ----------- */

/* Portrait and Landscape */
@media only screen 
  and (min-device-width: 375px) 
  and (max-device-width: 812px) 
  and (-webkit-min-device-pixel-ratio: 3) { 

    .form-control {
    background: none !important;
    color: #000 !important;
    border: solid 1px rgb(243 243 243 / 70%)!important;
    overflow-wrap: break-word;
    }
    .sp-upload-img {
        margin-top:5px;
    }
}

/* Portrait */
@media only screen 
  and (min-device-width: 375px) 
  and (max-device-width: 812px) 
  and (-webkit-min-device-pixel-ratio: 3)
  and (orientation: portrait) { 

    .form-control {
    background: none !important;
    color: #000 !important;
    border: solid 1px rgb(243 243 243 / 70%)!important;
    overflow-wrap: break-word;
    }
    .sp-upload-img {
        margin-top:5px;
    }

}

/* Landscape */
@media only screen 
  and (min-device-width: 375px) 
  and (max-device-width: 812px) 
  and (-webkit-min-device-pixel-ratio: 3)
  and (orientation: landscape) { 


    
.form-control {
    background: none !important;
    color: #000 !important;
    border: solid 1px rgb(243 243 243 / 70%)!important;
    overflow-wrap: break-word;
}

.sp-upload-img {
        margin-top:5px;
    }

}
#fancybox-thumbs{
    z-index: 9999999 !important;
}
    </style>

<?php
//echo $this->Html->script('leaflet/leaflet'); 
echo $this->Html->css('leaflet/dist/leaflet');

echo $this->Html->script('leaflet/route'); 
 
 echo $this->Html->script('leaflet/leaflet-geoman.min'); 
 echo $this->Html->css('leaflet/leaflet-geoman');

 echo $this->Html->css('leaflet/leaflet.draw.css');
 echo $this->Html->script('leaflet/leaflet.draw.js'); 

 echo $this->Html->script('leaflet/L.Polyline.SnakeAnim.js'); 

 echo $this->Html->script('leaflet/leaflet.boatmarker.min.js'); 
 
 echo $this->Html->script('leaflet/turf.min.js'); 
 echo $this->Html->script('leaflet/rotatedMarker');

?>
<!-- <script src="https://api.tiles.mapbox.com/mapbox.js/plugins/turf/v2.0.0/turf.min.js"></script> -->
<style>
.wrapper{overflow: hidden;}
.footer{height: 0px;line-height: 0;padding: 0px;}
.common-form-row{
    margin-top:-15px;margin-bottom: 2px;font-weight: bold!important;}
/*.back-btn button {
    float: right;
    margin-right: 20px;
}*/

/*.back-btn {
    position: relative;
    width: 100%;
    margin-top: 73px;
    display: inline-block;
}
*/
.sp-mrg-let{
  position: relative;
  left:240px;
}
.bt-darck{
  background: #6a5d5d!important;
  color: #fff!important;
}
.sp-mp-detailsrow h2{
color: #000;
    font-size: 18px;
    font-weight: 600;
}
.sp-modal-footer{
width: 100%;
    display: inline-block;
    margin: 10px 0px 0px 0px;
    border-top: solid 1px #d1d1d1;
    padding: 10px 0px;
}
.sp-modal-footer .btn{
  margin-right: 30px;
}
.sp-modal-600{
  width: 620px;
}
.sp-mp-detailsrow .sp-modal-hd {
width: 100%;
    border-bottom: solid 1px #cdcdcd;
    margin-bottom: 15px;
}
.sphdseracrh-row{
  display: inline-block;
    width: 100%;
    margin-bottom: 9px;
}

.sp-divrow>div{
float: left;
}
.sp-60-w{
  width: 430px!important;
}
.sp-40-w{
    width:176px!important;
        margin-left: 10px;
}
/* .sp-upload-img img{
    margin-left: -150%;
    margin-top: -60%;
} */
.sp-upload-img{
    float: left;
    border: solid 1px #ccc;
    width: 150px;
    overflow: hidden;
    height: 150px;
    border-radius: 10px;
}
.sp-40-w .action-icon{
display: block;
    width: 26px;
    left: 1px;
    height: auto;
}
.sp-40-w .action-icon li{
  padding: 5px 0px;
}
.sp-40-w .sp-gallary img{
  width: 19px;
    margin: 0 auto;
}
 .sp-60-w h3{   color: #000;
    font-size: 15px;
   border: solid 1px #ccc;
    margin: 0px;
    padding: 8px 5px;
    font-weight: 600;}
.sp-60-w h1{
  border:solid 1px #ccc;
  margin: 0px;
    padding: 5px;
}
.sp-divrow{
  overflow: hidden;
  width: 100%;
  display: inline-block;
  margin-top: 5px;
}
.sp-divrow .sp-60-w textarea.form-control{
  margin-top: 5px;
      /* height: 111px; */
}
.p-mt-3{
  margin-top: 3rem;
  padding-right: 0px;
}
.sp-mp-detailsrow h1 {
    color: #000;
    font-size: 15px;
    font-weight: 600;
}
.custom-popup .leaflet-popup-content-wrapper {
    background: #fff;
    color: #fff;
    font-size: 16px;
    line-height: 24px;
    width: auto;
    border-radius: 0px;
}

.custom-popup .leaflet-popup-content-wrapper a {
    color: rgba(255, 255, 255, 0.5);
}

.custom-popup .leaflet-popup-tip-container {
    width: 30px;
    height: 15px;
}
.action-icon .gallery img{
    width: 19px;
}

.custom-popup .leaflet-popup-tip {
    border-right: 15px solid transparent;
    border-top: 15px solid #2c3e50;
}

.custom-popup .leaflet-popup-content h4 {
    color: #2d2b2b;
}

.custom-popup .leaflet-popup-content {
    width: auto !important;
}

.custom-popup .leaflet-popup-content input {
    margin-bottom: 10px;
}


.custom-popup .actionClass {
    overflow: auto;
}

.custom-popup .actionClass span {
    color: #4cae4c;
    font-size: 22px;
    float: left;
    position: relative;
    top: 5px;
}

[class^="fleetAdminIcon-"], [class*="fleetAdminIcon-"] {
    background-image: url("<?php echo $this->webroot; ?>img/admin/fleetspriteicons.png");
    background-repeat: no-repeat;
    display: inline-block;
    height: 24px;
    line-height: 24px;
    width: 24px;
}
.fleetAdminIcon-note {
    width: 17px;
    height: 17px;
    background-position: -55px -14px;
    cursor: pointer;
    /* margin-right: -23px; */
    float: right;
    margin-left: 8px;
    margin-right: 8px;
}
.fleetAdminIcon-note.crusingmapnotegreen{
		background-position:-55px -50px;
}

.custom-popup .actionClass button {
    float: right;
}
.custom-popup .actionClass span.textDark {
    color: gray;
    position: relative;
    left: 10px;
    top: 5px;
    font-size: 14px;
}
.custom-popup .addRow {
    cursor: pointer;
}
.custom-popup .deleteScheduleClass {
    float: left;
    color: gray;
    font-size: 14px;
    margin-left: 20px;
    vertical-align: middle;
    margin-top: 4px;
}
.custom-popup .deleteScheduleClass #deleteSchedule {
    width: 10px;
    height: 10px;
    margin: 0;
    position: relative;
    top: 3px;
}

.sp-left{
    float: left;
    width: 395px;
    max-width: 350px;
}

.custom-popup .deleteScheduleClass label {
    margin: 0;
    margin-left: 0px;
    margin-left: 3px;
}

.custom-popup .col-lg-4 .col-lg-8 .col-lg-12 {
    padding-left: 0px !important;
    padding-right: 0px !important;
}

.custom-popup .titleFieldClass {
    float: right;
    width: 65%;
}

.custom-popup .dayFieldClass {
    width: 30%;
    float: right;
    margin-right: 5%;
}
.nav-side-menu{display: none;}
@media screen and (max-width: 771px) {
.md-text-center{text-align: center!important;}
.common-form-row {
    margin: 45px 0px 0px 0px;

}
.personal-row-container {
  margin-top: 0px;
}
.fixed-row-container{margin-top:0px!important;padding: 0px;}
.custom-popup .leaflet-popup-content-wrapper {
   width:360px;
}
.leaflet-popup {
  max-height: 450px;
  overflow-y: scroll;
  overflow-x: hidden;
}
/*.back-btn {background: rgba(66, 117, 230, 0.39);
    padding: 10px 0px;
    position: fixed!important;
    z-index: 9999;
    margin-top: 35px!important;
}*/
.nav-side-menu{display: block;}
.common-form-row .mob-none{display: none;}
.nav-side-menu-full-container .nav-side-menu .sidebar{
    top: 143px;

}

/* .leaflet-marker-icon:hover{
    z-index: 99999999;
} */



}

.flex-row{
    display: flex;
}
.custom-popup .expandField {
    margin-bottom: 10px;
}
.sp-close-modal,
.mapnotemodalclose,
.leaflet-container a.leaflet-popup-close-button {
    position: absolute;
    top: 0;
    right: 0;
    padding:0px 0px 0 0;
    border: none;
    text-align: center;
    width: 26px;
    background: #428bca!important;
    height: 26px;
    top: -14px;
    justify-content: center;
    align-items: center;
    display: flex;
    border-radius: 50%;
    font: 16px/14px Tahoma, Verdana, sans-serif;
    color: #ffffff;
    text-decoration: none;
    font-weight: bold;
    background: transparent;
}
.inputContainer{
    padding: 8px;
}
.action-icon li{
    float: left;
    font-size: 20px;
    text-align: center;
    width: 33px;
    color: #000;
    list-style: none;
    line-height: 0px;
}
.action-icon{
float: right;
    padding: 0px;
    /* height: 32px; */
    margin: 0px;
    /* width:55px; */
    display: flex;
    align-items: center;
    /* justify-content: center; */
}
.modal-backdrop {
    background-color: rgb(0 0 0 / 16%);
}

.uplaod-modal .pr-0{
    padding-right: 0px;
}
.uplaod-modal .d-flex{
    display: flex;
    align-items: baseline;
}
.sp-img-use{
    color: #1077cf;
    font-size: 11px;
}
.crew_comment_cruisingmap {
    cursor: pointer !important;
}

.crew_comment_cruisingmaptitle {
    cursor: pointer !important;
    color: #00a8f3;
}

.publish-modal .modal-dialog {
    width: 400px;
}

/* .acti-count {
    background: #f00;
    width: 21px;
    font-size: 11px;
    line-height: initial;
    height: 20px;
    border-radius: 10px;
    color: #fff;
    margin-top: -15px;
    position: absolute;
    margin-left: 120px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
} */

.acti-count {
    background: #f00;
    width: 21px;
    font-size: 11px;
    line-height: initial;
    height: 20px;
    border-radius: 10px;
    color: #fff;
    /* margin-top: -67px; */
    position: absolute;
    /* margin-left: 130px; */
    display: inline-flex;
    align-items: center;
    justify-content: center;
    right: -4px;
    top: -10px;
    /* left: 0; */
    float: right;
    /* right: -131px; */
    /* left: 0; */
    /* text-align: right; */
}

.acti-count-onmarker {
    background: #f00;
    width: 18px;
    font-size: 11px;
    line-height: initial;
    height: 18px;
    border-radius: 10px;
    color: #fff;
    /* margin-top: -67px; */
    position: absolute;
    /* margin-left: 130px; */
    display: inline-flex;
    align-items: center;
    justify-content: center;
    right: 12px;
    top: -10px;
    /* left: 0; */
    float: right;
    /* right: -131px; */
    /* left: 0; */
    /* text-align: right; */
}

.Tooltip {
    width: 160px;
    display: none;
    font-size: 12px;
    /* top : -30px; */
}

.Tooltipmodalmap {
    width: 160px;
    display: block;
    font-size: 12px;
}

.tooltip-inner {
    /* white-space:pre-wrap;
    white-space:nowrap;
    max-width:none; */
    /* white-space: pre-line;  */
    white-space: pre-wrap; 
    max-width: 100% !important;
}
.tooltip .tooltiptext {
  visibility: hidden;
  width: 320px;
}

.leaflet-control-attribution, .leaflet-control-scale-line{
    padding:0;
}

.leaflet-control-attribution {

/* height: 42px; */
width: 260px;


}

.leaflet-container .leaflet-control-attribution {
background: transparent;
margin: 10px;
}
.leaflet-container .leaflet-control-attribution table{
    border-collapse: separate;
border-spacing: 10px 5px;
}

.my-control {
    background: #fff;
    padding: 5px;
    cursor: pointer;
    width: 35px;
    height: 30px;
}

.tooltip-hidden {
    display: none;
}

.Distance {

    display: block;
    font-size: 12px;
    width: 160px !important;
    color: #000;
}

/* .custom-popup .leaflet-popup-content-wrapper {
    background: #fff;
    color: #000;
    font-size: 16px;
    line-height: 24px;
    width: 150px;
    word-break: break-all;
} */

.modalmapclose {

    position: absolute;
    top: 0;
    right: -5px;
    padding: 0px 0px 0 0;
    border: none;
    text-align: center;
    width: 26px;
    background: #428bca !important;
    height: 26px;
    top: -14px;
    justify-content: center;
    align-items: center;
    display: flex;
    border-radius: 50%;
    font: 16px/14px Tahoma, Verdana, sans-serif;
    color: #ffffff;
    text-decoration: none;
    font-weight: bold;
    outline: none;
}

/*********Leaflet draw route line tooltip hide */
.leaflet-tooltip-bottom {
    display: none;
}
.btn-warning, .btn-default, .btn-warning-bg{
    background-color: #f0ad4e;
    border-color: #eea236;
}
hr {
    margin-top: 6px;
    margin-bottom: 6px;

    border-top-color: #000;
    border-top: 1px solid #000;
}
.certificat-modal-container .modal-body{
margin: 0px;padding: 0px;
}
.certificat-modal-container .modal-dialog{
    margin: 30px auto;
  padding-left: 0px;
  width: 600px;
}
.certificat-modal-container .inbox-widget .inbox-item {
    border-bottom: 1px solid #d6d4d4;
}
.inbox-widget .inbox-item .inbox-item-text {
    color: #000000!important;
    padding-left:5px;
}
@media only screen and (max-width:1024px){
.common-form-row {
    margin-top: 38px;
}




}
@media only screen and (max-width:771px){

body .mydemolabel {
    top: 44px!important;
}
body span.sp-leftalign {
    font-size: 15px!important;
}

.map-container{
    margin-top: 40px!important;
}
.map-header{
    margin-top: 17px;
}

.nav-side-menu-full-container .nav-side-menu .sidebar {
top: 115px;
}
.certificat-modal-container .modal-dialog{
    width: 600px;
margin: 30px auto;
/* width: 95%;
    margin: 0 auto;
    margin-top: 15px; */
}
.chat-send button{
    margin-top: 0px !important;
width: 126px;
    margin-right: 10px;
}
.chat-send {
    width: 100%;
    display: flex;
    justify-content: center;
}
.chat-inputbar textarea{
    width: 100%;
    height: 93px;
}
.chat-inputbar{
    width: 100%;
padding-left: 15px!important;
    padding-right: 15px;
}
.sp-modal-600 {
    width: 100%;
}
}
#showmenu {
    position: absolute !important;
    top: 16px;
    right: 15px!important;
    width: 144px;
    /* padding: 10px; */
    border: 1px solid transparent;
    border-radius: 10px;
    color: #000;
    z-index: 400;
    /* font-weight: bold; */
    font-size: 12px;
    font-weight: bold;
    z-index: 999;
    background: #fff !important;
    display:none;
}
#CruisingButton:hover , #HideDetails:hover, #HelpfulTips:hover{
background: #fff !important;
}
#CruisingButton {
    background: #fff !important;
    position: absolute!important;
    top: 55px!important;
    right: 13px!important;
  padding: 5px;
  height: 32px;
  color:#000;
  z-index: 9999;
  font-weight:bold;
  width: 145px;
  border-radius: 10px;
  font-size: 12px;
}

#closeWeatherMap {
    background: #fff !important;
    position: absolute!important;
    top: 40px!important;
    right: 13px!important;
    padding: 5px;
    height: 32px;
    color: #000;
    z-index: 9999;
    font-weight: bold;
    width: 55px;
    border-radius: 10px;
    font-size: 12px;
    left: 0;
    margin-left: 5px;
}

#HideDetails {
    background: #fff !important;
    position: absolute!important;
    top: 93px!important;
    right: 13px!important;
  padding: 5px;
  height: 32px;
  color:#000;
  z-index: 9999;
  font-weight:bold;
  min-width: 145px;
  border-radius: 10px;
  font-size: 12px;
}

#HelpfulTips {
    background: #fff !important;
    position: absolute!important;
    top: 131px!important;
    right: 13px!important;
  padding: 5px;
  height: 32px;
  color:#000;
  z-index: 9999;
  font-weight:bold;
  min-width: 145px;
  border-radius: 10px;
  font-size: 12px;
}
#WeatherMap {
    background: #fff !important;
    position: absolute!important;
    top: 170px!important;
    right: 13px!important;
  padding: 5px;
  height: 32px;
  color:#000;
  z-index: 9999;
  font-weight:bold;
  min-width: 145px;
  border-radius: 10px;
  font-size: 12px;
}
#GuestNews {
    background: #fff !important;
    position: absolute!important;
    top: 210px!important;
    right: 13px!important;
  padding: 5px;
  height: 32px;
  color:#000;
  z-index: 9999;
  font-weight:bold;
  min-width: 145px;
  border-radius: 10px;
  font-size: 12px;
}

@media screen and (max-width: 768px){
    #showmenu{
        width: 113px;
    height: 24px;
    padding: 0px!important;
    font-size: 11px!important;
    min-width: inherit;
    }
.collapse {
    /* display: block !important; */
    position: absolute;
    left: 0px;
    top: 38px;
    width: 100%;
    float: left;
}
}

@media only screen and (min-width: 771px) and (max-width: 1092px){

    #showmenu{
        width:135px;
    }
    #CruisingButton {
  width: 138px !important;
  font-size: 12px;
  height: 32px;
  padding: 5px !important;
  top: 18px !important;
  padding: 5px !important;
    top: 56px !important;
}
#HideDetails,
 #HelpfulTips,
#WeatherMap, 
#GuestNews{
    min-width: 138px;
    font-size: 12px;
    height: 32px;
    padding: 5px!important;
}
}


@media (max-width:771px){
    #WeatherMap {
    top: 103.5px!important;
}
#GuestNews {
    top: 132px!important;
}


#HideDetails,
 #HelpfulTips,
 #WeatherMap, 
#GuestNews,
 #HelpfulTips
 {
 
    width: 113px;
    height: 24px;
    padding: 0px!important;
    font-size: 11px!important;
    min-width: inherit;
}
#CruisingButton {
    height: 24px;
    width: 113px!important;
  top: 18px !important;
  padding: 0px!important;
    font-size: 11px!important;
}

#HideDetails {
    top: 47px!important;
}
#HelpfulTips {
    top: 76px!important;
}
}

.fancybox-overlay {
    z-index: 99999 !important;
}
.certificat-modal-container {
  z-index: 99999;
}
.fancybox-mobile {
  z-index: 999999 !important;
}
.fancybox-opened {
    z-index: 999999!important;
    opacity: 1 !important;
}
.fancybox-wrap {
  z-index: 99999;
  opacity: 0.1;
  /* opacity: 1 !important; */
}

#fancybox-thumbs {
  left: 45px !important;
  }
#fancybox-thumbs ul {
  left: auto!important;
  margin: 0 auto!important;
}
span.sp-leftalign {
    width: 300px;
    text-align: left;
    font-size: 18px!important;
    position: relative;
    padding-left: 15px;
}
.yacht-centerlabel {
    position: absolute;
    left: 0px;
    font-size: 18px!important;
    right: 0;
    font-weight: bold;
    text-align: center;
}
span.sp-rightalign {
    float: right;
    padding-right: 15px;
    width: 20%;
    text-align: right;
    overflow: hidden;
    font-size: 18px!important;
    position: relative;
}
/* textarea.form-control {
    resize: vertical!important;
    overflow: auto!important;
} */
.modal_load,.markmodal_load{
    margin:0px 10px 5px 8px;
}
#closeSchedule{
        margin-left: 6px;
    }
@media screen and (min-width: 990px) {
.location_Modal_body{
    /* max-height: 580px; */
    height: 85vh;
    overflow-y: scroll;
    overflow-x: hidden;
}
}
@media screen and (max-width: 990px) {
  
    .markmodalbody{
        max-height: 91vh;
    overflow-y: scroll;
    overflow-x: hidden;
   
    }
    .markmodal_load{
        margin: 5px 0px 5px 8px;
    padding: 0px 10px 100px 0px;
    }
    .modal_load{
        max-height: 88vh;
    overflow-y: scroll;
    overflow-x: hidden;
    margin: 5px 0px 5px 8px;
    padding: 0px 10px 100px 0px;
    }
    .cruising-location-Modal .modal-content{
       height: 96vh!important;
    }
.common-form-row.map-form-rwo {
    margin-top: 38px;
    margin-bottom: 2px;
}
.certificat-modal-container{
    background-color: #000!important;
  }
  .certificat-modal-container .mx-box {
    max-height: 400px;
    min-height: 400px;
}
.card-box {
    margin-bottom: 0px;
    border: 0px solid rgba(54, 64, 74, 0.05);
}
.certificat-modal-container .chat-inputbar textarea {
    width: 100%;
    height: 90px;
}
  /* .certificat-modal-container .modal-body{
      min-height: 88vh!important;
	  max-height: 88vh!important;
  } */
  
  .sm-cruisingmsgmyModal{
  height: 100vh;
  }
    .modal-header .close::before {
  content: "";
  display: block;
  position: absolute;
  top: -10px;
  bottom: -10px;
  left: -10px;
  right: -10px;
}
.modal-header .close {
  transform: scale(1.1);
}

}
@media only screen and (max-width: 771px){
    .sp-rightalign{
    display: none;
}


.sp-40-w{
    margin-top: 10px;
    margin-left: 0px;
}


.sp-divrow {
    padding-bottom: 15px;
    margin-bottom: 10px;
    padding: 2px 2px;
    border-bottom: solid 1px #eee;
}
span.sp-leftalign {
    width: 100%;
    padding-left: 15px;
    margin-top: 29px;
    display: block;
    padding-left: 80px;
}
.position-mobile-head{
        left: 80px;
}
.map-container {
    margin-top: 2px!important;
}
}

.leaflet-tooltip{
    pointer-events: inherit !important;
}

.textareacontmarker{
   
   overflow:scroll !important;
} 

@media only screen and (max-width:400px){
   .sp-60-w input{
    width: 70%!important;
    margin-bottom: 8px!important;
   }
   .sp-60-w {
  width: 100% !important;
}
}

.no_of_days_loc{
    width:30%;
    float:right;
}

.label_days{
    color:#555;
    font-size:12px;
    padding: 10px;
}

@media only screen and (min-width: 320px) and (max-width: 771px){
body .sp-60-w {
    width: 100%!important;
}
body .sp-60-w input {
     width: 74%!important;
    margin-bottom: 8px!important;
}
.sp-60-w select{
    width: 21%!important;
    padding: 8px 0px!important;
}
.certificat-modal-container .modal-content{
    height: 85vh;
}



.leaflet-popup {
    padding-bottom: 100px;
    max-height: 650px;
}
.leaflet-container a.leaflet-popup-close-button {
    right: 4px!important;
    top: 4px!important;
}


}


.text-below-marker {
    font-size: 11px;
    font-weight: 1px solid;
    margin-top: -35px !important;
    margin-left: -6px !important;
color: #000;
background-color: #fff;
border-radius: 4px;
}
.text-below-marker-90deg {
    font-size: 11px;
    font-weight: 1px solid;
    margin-top: -7px !important;
    margin-left: 21px !important;
    color: #000;
    background-color: #fff;
border-radius: 4px;
z-index:999 !important;
}
.text-below-marker-180deg{
    font-size: 11px;
    font-weight: 1px solid;
    margin-top: 20px !important;
    margin-left: -7px !important;
    color: #000;
    background-color: #fff;
border-radius: 4px;
z-index:999 !important;
}
.text-below-marker-270deg{
    font-size: 11px;
    font-weight: 1px solid;
    margin-top: -8px !important;
    margin-left: -34px !important;
    color: #000;
    background-color: #fff;
border-radius: 4px;
z-index:999 !important;
}
.text-below-marker-modalmap {
    font-size: 11px;
    font-weight: 1px solid;
    margin-top: -35px !important;
    /* margin-left: -3px !important; */
color: #000;
background-color: #fff;
border-radius: 10px;
}

.text-below-marker-locsch {
    font-size: 11px;
    font-weight: 1px solid;
    margin-top: -35px !important;
    /* margin-left: -3px !important; */
color: #000;
/* background-color: #fff;
border-radius: 4px; */
}
.CSMPTooltip{
    opacity: 0 !important;
    height: 165px;
    width: 165px;
    margin-left: -90px;
    margin-top: -48px;
    cursor:pointer;
}

.stationarydays{
    cursor:pointer;
}

#windy #plugin-menu {
    z-index: 999999;
    position: fixed;
    top: 0;
}
</style>  

<?php    echo $this->Html->script('jquery-1.7.2.min');
        echo $this->Html->script('fancybox/jquery.fancybox');
        echo $this->Html->css('fancybox/jquery.fancybox');
        echo $this->Html->script('fancybox/jquery.fancybox-thumbs');
        echo $this->Html->css('fancybox/jquery.fancybox-thumbs');
    ?> 
    <!-- <link rel="stylesheet" 
  href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
<script type="text/javascript" 
  src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/helpers/jquery.fancybox-thumbs.js"></script> -->
    
<!--    <div class="back-btn">
        <a href="<?php echo $basefolder."/charters/view"; ?>"><button type="button" class="btn btn-warning" title="Back" data-placement="bottom">
            <span class="back-btn-go"><< Back</span><span class="go-back-btn">
        </button></a>
    </div>
 -->
<br>
<?php //if(isset($sessionCharterGuest) && !empty($sessionCharterGuest)){?>
 <div class="nav-side-menu-full-container">
<div class="nav-side-menu">
<div class="base-margin">
<button id="sidebar-btn" class="sidebar-btn">
    <div class="menu-stripes"></div>
    <div class="menu-stripes"></div>
    <div class="menu-stripes"></div>
</button>
<section id="sidebar" class="sidebar">
    <nav class="menu"> 
        <ul class="menu menu-level1 no-style nav nav-pills nav-justified">
        
        <li> <a href="<?php echo $basefolder."/charters/programs/".$this->Session->read('guestListUUID');?>">Charter Programs</a> 
        <?php //echo "<pre>"; print_r($guestListData); exit; ?>
            <!-- only show guest type not email recipient -->
            <?php if($cp_guesttype != 'email_recipient'){ ?>
      
        <li class="menu__item"> <a href="#">Charter Contracts</a>
            <?php if(isset($guesttype) && $guesttype == "owner"){ if(isset($programFiles)){ ?>
                <ul class="submenu">
                    <?php  foreach($programFiles as $startdate => $filepath){ ?>
                    <li class="menu__item"><a href="#" data-href="<?php echo $filepath; ?>" class="downloadmappagefile"><?php echo $startdate; ?></a></li>
                    <?php
                            
                        } ?>
                </ul>
            <?php } } ?>
    
        </li>    
        
        <li class="menu__item"> <a href="<?php echo $basefolder.$guestlink; ?>">Guest List</a></li>
        <?php } ?>
        
        <?php if($cp_guesttype != 'email_recipient'){ ?>
            <li class="menu__item" ><a>How To Video</a>
           <ul class="submenu">
                   <li class="menu__item" id="MenuHowToVideo"><a href="#">Preference Sheets</a></li>
                   <li class="menu__item" id="MenuHowToVideoCharterHead"><a href="#">Head Charterer</a></li>
                </ul>
                </li>
                <?php }else{ ?>
            <li class="menu__item" ><a target="_blank" href="https://youtu.be/iDa3RiR2m5w">How To Video</a></li>
            <?php   } ?>
            

            
            <li> <a href="<?php echo $basefolder."/charters/privacytermsofuse/1" ?>" target="blank">Terms of Use</a></li>
        <li> <a href="<?php echo $basefolder."/charters/privacytermsofuse/2" ?>" target="blank">Privacy Policy</a></li>
         <li class="list-logout-row row-hide-btn"><?php echo $this->Html->link('Logout','/',array('escape' =>false,'title' => 'Logout'));?></li>
        </ul>
    </nav>
</section>
</div>
</div>
</div>
<?php //} ?>
<!--modal start here-->
<div id="mapnotemodal" class="modal uplaod-modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close mapnotemodalclose">&times;</button>
        <h4 class="modal-title">More Information</h4>
      </div>
      <form action=""  name="" id="mapnoteform" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-group">
          <textarea name="mapmessage" readonly id="mapmessage" class="form-control" rows="5" cols="10"></textarea>
      </div>
      </div>
      <div class="modal-footer">
       
      </div>
    </div>
</form>
  </div>
</div>
<!--modal end here--> 

<!--help modal start here-->
<div id="mapquestionmodal" class="modal uplaod-modal" role="dialog" style="margin-top: 65px;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Help Tips</h4>
      </div>
      
      <div class="modal-body">
        <div class="form-group">
        1. Tap location marker to show day’s activities.
        </div>
        <div class="form-group">
        2. Tap the image to enlarge it.
        </div>
        <div class="form-group">
        3. Tap or pinch the Map to enlarge it. 
        </div>
        <div class="form-group">
        4. The Cruising Schedule lists all the locations.
        </div>
        <div class="form-group">
        5. Tap Show Details button for more information.
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="mapquestionmodalclose btn btn-success ">Close</button>
      </div>
    </div>

  </div>
</div>
<!--help modal end here--> 

<!-- sample modal content -->
<div id="cruisinglocationModal" class="modal certificat-modal-container cruising-location-Modal"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content CS_modal">
            <div class="modal-header">
                <!-- <div style="position: absolute;margin-top: 4px;"> -->
                     <!-- client asked to hide language for now @jun12 2023
                    <div id="flag2" class="flag-icon flag-icon-us" style="font-size:18px;"></div>
                    <select id="language-select2" onchange="changeLanguage2()" class="language_dropdown" style="font-size:18px;top: 10px;">
                    <option value="Arabic">Arabic</option>
                    <option value="MandarinChinese">Chinese</option>
                    <option value="English" selected>English</option>
                    <option value="French">French</option>
                    <option value="German">German</option>
                    <option value="Greek">Greek</option>
                    <option value="Italian">Italian</option>
                    <option value="Japanese">Japanese</option>
                    <option value="Russian">Russian</option>
                    <option value="Spanish">Spanish</option>
                    </select> 
                    -->
                <!-- </div> -->
                <button type="button" class="close" id="cruisinglocationModalclose" aria-hidden="true" style="margin-right: 5px;">×</button>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;font-weight: bold;"><?php echo $scheduleLocation ?></h4>
            </div>
            <div class="modal-body location_Modal_body csmp_body">
                <div id="cruisinglocationModal_load" class="modal_load">
                <div class="mapPopup sp-mp-detailsrow" data-schuuid="">
                <?php 
                $markerimage = BASE_URL.'/charterguest/app/webroot/css/leaflet/dist/images/marker-icon-itinerary.png';
                $crusemap = 1;
                $crusemaparray = array();
                
                // $RD = array();
                // //$RouteData = array_unique($RouteData);
                // foreach ($temploc as $key => $v) { 
                //     //$vs = explode("-",$v['CharterProgramScheduleRoute']['start_location']);
                //     //$ve = explode("-",$v['CharterProgramScheduleRoute']['end_location']);
                //     $RD[] = $key;
                //     //$RD[] = $v['CharterProgramScheduleRoute']['end_location'];
                // }
                //echo "<pre>";print_r(($RD));
                //echo "<pre>";print_r($scheduleData);exit;
                if(!empty($scheduleData)) {
                    $newscheduleData = $scheduleData;
                    unset($newscheduleData[count($newscheduleData)-1]);
                    if($newscheduleData[0]['CharterProgramSchedule']['stationary'] == 1){
                        unset($newscheduleData[1]);
                    }
                }
                $firststat = 0;
                $chkF = 0; 
                $fleetlocationimages= array();
            foreach ($newscheduleData as $key => $schedule) { 
                $schedule['CharterProgramSchedule']['title'] = trim($schedule['CharterProgramSchedule']['title']);
                $schedule['CharterProgramSchedule']['title'] = str_replace('"', "", $schedule['CharterProgramSchedule']['title']);
                $schedule['CharterProgramSchedule']['title'] = str_replace("'", "", $schedule['CharterProgramSchedule']['title']);
                $schedule['CharterProgramSchedule']['to_location'] = trim($schedule['CharterProgramSchedule']['to_location']);
                $schedule['CharterProgramSchedule']['to_location'] = str_replace('"', "", $schedule['CharterProgramSchedule']['to_location']);
                $schedule['CharterProgramSchedule']['to_location'] = str_replace("'", "", $schedule['CharterProgramSchedule']['to_location']);
                //if(isset($samelocations[$schedule['CharterProgramSchedule']['lattitude']]) && !empty($samelocations[$schedule['CharterProgramSchedule']['lattitude']])){
                $counttitle = count($samelocations[$schedule['CharterProgramSchedule']['lattitude']]);
                    $SumDaytitle = "";
                    foreach($samelocations[$schedule['CharterProgramSchedule']['lattitude']] as $val){
                        $SumDaytitle.= $val.'<br>';
                    }


                $schuuid = $schedule['CharterProgramSchedule']['UUID'];
                if($samemarkercommentcount[$schedule['CharterProgramSchedule']['lattitude']] == 0){
                    $marker_msg_count = "style='display:none;'";
                    $samemkrcount = "";
                }else if($samemarkercommentcount[$schedule['CharterProgramSchedule']['lattitude']] != 0){
                    $marker_msg_count = "";
                    $samemkrcount = $samemarkercommentcount[$schedule['CharterProgramSchedule']['lattitude']];
                    if(isset($guesttype) && !empty($guesttype)){ //echo $guesttype; exit;
                        if($guesttype == "guest"){
                                $marker_msg_count = "style='display:none;'";
                        }else{
                                $marker_msg_count = "";
                        }
                    }
                    
                }
                if($key > 1){
                    $df = $schedule['CharterProgramSchedule']['title'];
                    if($schedule['CharterProgramSchedule']['stationary'] == 0 && ($schedule['CharterProgramSchedule']['serial_no'] < 2)){
                        $dnum = $schedule['CharterProgramSchedule']['day_num'] - 1;
                    }else{
                        $dnum = $schedule['CharterProgramSchedule']['day_num'];
                    }
                }else{
                    if($key == 0 && $schedule['CharterProgramSchedule']['stationary'] == 1){
                        $firststat = 1;
                       
                    }
                    $dnum = $schedule['CharterProgramSchedule']['day_num'];
                    if($key == 1 && $firststat == 0){
                        $df =  $embarkation_chprg;
                    }else if($key == 1 && $firststat == 1){
                        $df =  $embarkation_chprg;
                        $dnum = $schedule['CharterProgramSchedule']['day_num'] - 1;
                    }
                }

                if (!empty($markertotal[$df . ' - Day ' . $dnum]['duration'])) {
                    $scheduleData[$key]['CharterProgramSchedule']['duration'] = $markertotal[$df. ' - Day ' . $dnum]['duration'];
                } else {
                    $scheduleData[$key]['CharterProgramSchedule']['duration'] = "";
                }

                if (!empty($markertotal[$df. ' - Day ' . $dnum]['distance'])) {
                    $scheduleData[$key]['CharterProgramSchedule']['distance'] = $markertotal[$df. ' - Day ' . $dnum]['distance'];
                } else { 
                    $scheduleData[$key]['CharterProgramSchedule']['distance'] = "";
                }
            
                $daynumber = $schedule['CharterProgramSchedule']['day_num']; 
                
                //$to_location = $schedule['CharterProgramSchedule']['title'];
                $attachment = $schedule['CharterProgramSchedule']['attachment'];
                $last = 0;
                if($key == 0){ //echo $to_location."=========".$debarkation_chprg;
                    $attachment = $schedule['CharterProgramSchedule']['attachment'];
                    $last = 0;
                }else if($key == 1){ //echo $to_location."0000000".$debarkation_chprg;
                    $attachment = $schedule['CharterProgramSchedule']['debarkation_attachment'];
                    $last = 1;
                }

                        if(isset($attachment) && !empty($attachment)){
                             
                            if(isset($domain_name) && $domain_name == "charterguest"){
                                $update_BASE_URL = "https://charterguest.net/";
                                $File_dir_path = "/var/www/cg-vhost/";
                            }else{
                                $update_BASE_URL = "https://totalsuperyacht.com:8080/";
                                $File_dir_path = "/var/www/vhosts/wamp/www/";
                            }
                            // if($yname == "yacht"){
                            //     $targetFullPath = BASE_URL.'/SOS/app/webroot/betayacht/app/webroot/img/charter_program_files/itinerary_photos/'.$attachment;
                            // }else{
                                $targetFullPath = $update_BASE_URL.'/'.$yachtname.'/app/webroot/img/location_contents/'.$attachment;
                                $targetFullGalleryPath = $update_BASE_URL.'/'.$yachtname.'/app/webroot/img/location_contents/';
                                $targetFile_dir_path = $File_dir_path.$yachtname.'/app/webroot/img/location_contents/';
                                
                                if (!empty($fleetname)) { // IF yacht is under any Fleet
                                    $targetFullPath = $update_BASE_URL.'/'.$fleetname."/app/webroot/".$yachtname.'/app/webroot/img/location_contents/'.$attachment;
                                    $targetFullGalleryPath = $update_BASE_URL.'/'.$fleetname."/app/webroot/".$yachtname.'/app/webroot/img/location_contents/';
                                    $targetFile_dir_path = $File_dir_path.$fleetname."/app/webroot/".$yachtname.'/app/webroot/img/location_contents/';
                                }
                            //}
                            if(BASE_URL == "http://localhost"){
                                $targetFullPath = BASE_URL."/superyacht/app/webroot/img/location_contents/".$attachment;
                                $targetFullGalleryPath = BASE_URL."/superyacht/app/webroot/img/location_contents/";
                                $targetFile_dir_path = "/opt/lampp/htdocs/superyacht/app/webroot/img/location_contents/";
                                }

                            $titleimage = $targetFullPath;
                            $titleimagehref = $targetFullPath;
                            $fancybox = "fancybox";
                            $targetFullGalleryPathhref = $targetFullGalleryPath;
                            $targetFile_dir_path_href = $targetFile_dir_path;
                        }else{
                            $noteimg = "style='display:none;'";
                            $titleimage = BASE_URL.'/charterguest/app/webroot/img/noimage.png';
                            $titleimagehref = "#";
                            $fancybox = "";
                            $targetFullGalleryPathhref = "";
                            $targetFile_dir_path_href = "";
                        }
                        
                        $crusemaparray[$crusemap] =  "crusingschedulemap".$crusemap;
                        //$fleetlocationimages= array();
                        if($last == 0){
                            $fleetlocationimages = $locationimages[$schedule['CharterProgramSchedule']['id']];
                        }else if($last == 1){
                            $fleetlocationimages = $myLastElement_locationimages['last'];
                            $last = 0;
                        }

                        if(!empty($attachment) && !empty($attachment)){
                            foreach ($fleetlocationimages as $key1 => $name) {
                                if($name == $attachment){
                                    unset($fleetlocationimages[$key1]);
                                }
                            }
                        }
                        //echo "<pre>"; print_r($fleetlocationimages);
                        $locationCommentsdata = $locationComment[$schedule['CharterProgramSchedule']['id']];

                        //echo $locationCommentsdata['programScheduleUUID'];
                        if(isset($guesttype) && $guesttype == "guest"){
                            //echo $cp_guesttype;echo $allow_comments;
                            if(isset($cp_guesttype) && $cp_guesttype == 'email_recipient'){
                                if(isset($allow_comments) && $allow_comments == 1){
                                    $displaynone = "display:block;";
                                }
                            }else{
                                $displaynone = "display:none;";
                            }
                                
                        }else{
                                $displaynone = "display:block;";
                        }

                        if($key == 0){
                            $heading =   $schedule['CharterProgramSchedule']['title']; 
                            //$chkF = 1;
                          }else{
                              $heading =   $schedule['CharterProgramSchedule']['to_location'];  
                          }
                        ?>
                       
                       <div class="inputContainer_div">
                            <div class="loc_desc_div">
                                <div>
                                <span style="display: inline-block;position: relative;"><img src="<?php echo $markerimage; ?>" style="object-fit: cover; height: 35px;" alt="" ><span style="position: absolute;color:#000;top: 6px;right: 0px;left: -1px;text-align: center;font-size: 12px;"><?php echo $daynumber; ?></span></span>
                                <input type="text" name="title" value="<?php echo htmlspecialchars($heading); ?>" placeholder="Enter the Title" class="loc_name" readonly/>
                                    <ul class="action-icon"><li><i class="<?php echo $locationCommentsdata['facomment']; ?> fa-comments sch_comment_<?php echo $schedule['CharterProgramSchedule']['UUID']  ?> crew_comment_cruisingmaptitle" data-rel="<?php echo $locationCommentsdata['programScheduleUUID']; ?>" data-yachtid="<?php echo $locationCommentsdata['yacht_id']; ?>" data-tempname="<?php echo htmlspecialchars($locationCommentsdata['title']); ?>" style="<?php echo $locationCommentsdata['colorcodetitle']; ?><?php echo $displaynone; ?>float: right;"><input type="hidden" name=commentstitle value="" class="messagecommentstitle" /></i></li></ul>
                                </div>
                            <div class="icons_fields">
                            <i style="color: #00a8f3;" class="fa fa-solid fa-calendar"><span class="icon_label" ><?php echo $schedule['CharterProgramSchedule']['week_days']; ?></span></i>
                                <?php if($schedule['CharterProgramSchedule']['stationary'] == 0){?>
                                <i style="color: #00a8f3;" class="fa fa-solid fa-clock-o "><span class="icon_label"><?php echo $markertotal[$df.' - Day '.$dnum]['duration'];  ?></span></i>
                                <i style="color: #00a8f3;" class="fa fa-solid fa-ship" aria-hidden="true"><span class="icon_label" style="padding: 0px 0px 0px 5px;"><?php echo $markertotal[$df.' - Day '.$dnum]['distance']; ?></span></i>
                                <?php }else if($schedule['CharterProgramSchedule']['stationary'] == 1){ ?>
                                    <i style="color: #00a8f3;" class="fa fa-solid fa-clock-o "><span class="icon_label"></span></i>
                                <i style="color: #00a8f3;" class="fa fa-solid fa-ship" aria-hidden="true"><span class="icon_label" style="padding: 0px 0px 0px 5px;"></span></i>
                                    <?php } ?>
                                </div>
                                <div>
                                    <textarea class="form-control auto_resize loc_desc_field" name="messagestitle" rows="1" cols="50" readonly><?php echo $schedule['CharterProgramSchedule']['notes']; ?></textarea>
                                </div>
                            </div>
                            <div class="loc_img_div">
                                <div class="loc_map_div" id="crusingschedulemap<?php echo $crusemap; ?>" data-mindex="mylocsh<?php echo $crusemap; ?>">
                                
                                </div>
                                <div class="loc_img_prev">
                                <a href="<?php echo $titleimagehref; ?>" rel="galleryloc<?php echo $crusemap; ?>" data-thumbnail="<?php echo $titleimagehref; ?>" class="<?php echo $fancybox; ?>"><img src="<?php echo $titleimage; ?>" style="object-fit: cover; width: 100%;height: 150px;" alt="" ></a>
                               <?php 
                               if(isset($fleetlocationimages) && !empty($fleetlocationimages)){ 
                                    $fleetlocationimages =  array_unique($fleetlocationimages);
                                    foreach($fleetlocationimages as $name){
                                        if(!empty($name)){ 
                                            $name = ltrim($name);
                                            $fname = $targetFile_dir_path_href.$name;
                                            if(file_exists($fname)) {
                                            ?>
                                            <a href="<?php echo $targetFullGalleryPathhref; ?><?php echo $name; ?>" data-thumbnail="<?php echo $targetFullGalleryPathhref; ?><?php echo $name; ?>" rel="galleryloc<?php echo $crusemap ?>" class="<?php echo $fancybox; ?>"><img src="<?php echo $name; ?>" style="object-fit: cover;width: 100%; height: 150px;display:none;" alt="" ></a>
                                            <?php } 
                                        }
                                    }
                                } ?>
                                </div>
                                <span class="img_count_div">
                                
                               <?php  if(isset($fleetlocationimages) && !empty($fleetlocationimages)){ 
                                    $fleetimagecount = count($fleetlocationimages)+1;
                                    if($fleetimagecount > 1){
                                        ?>
                                        <span class="img_count">                    
                                        + <?php echo $fleetimagecount; ?>
                                        </span>
                                           
                                        <?php
                                    }
                                //     if($fleetimagecount > 1){
                                //          for($k=0; $k<$fleetimagecount; $k++){ ?>
                                                    <!-- <i class="fa fa-dot-circle-o" aria-hidden="true" style="
                                            font-size: 8px;
                                             color: darkslategray;"></i>&nbsp; -->
                                 <?php   //    }
                                //     }
                                    }?>
                                    </span>
                            </div>
                       </div>
                       <input type="hidden" id="charterprogramuuid" value="<?php echo $schedule['CharterProgramSchedule']['charter_program_id']; ?>">
                    <?php  //} 
                   
                $crusemap++;
                } //exit; ?>
                </div>
                    </div>
            </div>
        </div>
    </div>
</div><!-- /.modal-content -->


<div id="markerModal" class="modal certificat-modal-container cruising-location-Modal"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content Mark_modal" id="markerModal_id">
            <div class="modal-header" style="border-bottom: 0px solid #e5e5e5;padding-bottom: 5px;">
             <!-- client asked to hide language for now @jun12 2023
            <div id="flag" class="flag-icon flag-icon-us" style="font-size:18px"></div>
            <select id="language-select" onchange="changeLanguage()" class="language_dropdown" style="font-size:18px">
            <option value="Arabic">Arabic</option>
            <option value="MandarinChinese">Chinese</option>
            <option value="English" selected>English</option>
            <option value="French">French</option>
            <option value="German">German</option>
            <option value="Greek">Greek</option>
            <option value="Italian">Italian</option>
            <option value="Japanese">Japanese</option>
            <option value="Russian">Russian</option>
            <option value="Spanish">Spanish</option>
            </select>
            -->
                <button type="button" class="close" data-schuuid="" id="markerModalclose" aria-hidden="true" style="margin-right: 5px;">×</button>
                <h4 class="modal-title" id="markerModalLabel" style="text-align: center;font-weight: bold;"></h4>
            </div>
            <div class="modal-body location_Modal_body markmodalbody">
            <div class="mark_map_div">
            <!-- <div class="sp-modal-hd">
                <div class="row">
                    <div class="col-md-8">
                        <select name="noofdayscard" class="form-control noofdayscard wt-st" style="font-size: 17px !important;font-weight: bold;background:none !important;color:#000 !important;border:solid 1px #ddd !important;"></select>
                    </div>
                </div>
            </div> -->
                <div style="color: #000;font-size: 15px;text-align:center;width:100%!important;margin: 0px 0px 5px 0px;padding:3px 5px 8px 5px;font-weight: 600;"><span id="embarkation"></span>  <span id="debarkation"></span> </div>
                <div class="icons_fields" style="text-align:center;">
                <i style="color: #00a8f3;" class="fa fa-solid fa-calendar"><span class="icon_label charter_from_date_conv" ></span></i>
                <i style="color: #00a8f3;" class="fa fa-solid fa-clock-o "><span class="icon_label markerduration"></span></i>
                <i style="color: #00a8f3;" class="fa fa-solid fa-ship" aria-hidden="true"><span class="icon_label markerdistance" style="padding: 0px 0px 0px 5px;"></span></i>
                </div>
                <select name="markersnames" style="display:none;" class="form-control markersnamesmodalmap"></select>
                <div id="modalmap" style="border: solid 1px #ccc;">
               
                </div>
                </div>
                <div id="markerModal_load" class="markmodal_load">

                </div>

            </div>
        </div>
    </div>
</div><!-- /.modal-content -->


<div id="markerModalcruisingsch" class="modal certificat-modal-container"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" id="markerModal_id">
            <div class="modal-header" style="padding:5px;border-bottom: 0px solid #e5e5e5;">
                <button type="button" class="close" data-schuuid="" id="markerModalclosecruisingsch" aria-hidden="true" style="margin-right: 5px;">×</button>
            </div>
            <div class="modal-body markmodalbodycruisingsch">
            
            <div style="color: #000;font-size: 15px;text-align:center;width:100%!important;margin: 0px 0px 5px 0px;padding: 8px 5px;font-weight: 600;"><span id="embarkation_sch"></span>  <span id="debarkation_sch"></span> </div>
            <div class="icons_fields" style="text-align:center;border-bottom: none;margin-bottom: 0px;padding-bottom: 0px;">
                                <i style="color: #00a8f3;" class="fa fa-solid fa-calendar"><span class="icon_label charter_from_date_conv_CSMP" ></span></i>
                                <i style="color: #00a8f3;" class="fa fa-solid fa-clock-o "><span class="icon_label markerdurationCSMP"></span></i>
                                <i style="color: #00a8f3;" class="fa fa-solid fa-ship" aria-hidden="true"><span class="icon_label markerdistanceCSMP" style="padding: 0px 0px 0px 5px;"></span></i>
                                </div>    
            <select name="markersnamescruisingsch" style="display:none;" class="form-control markersnamesmodalmapcruisingsch"></select>
                <div id="modalmapcruisingsch" style="border: solid 1px #ccc;">
               
                </div>
               
               

            </div>
        </div>
    </div>
</div><!-- /.modal-content -->

<!-- sample modal content -->
<div id="cruisingmsgmyModal" class="modal certificat-modal-container sm-cruisingmsgmyModal"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="commentsmodal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Comments Log</h4>
            </div>
            <div class="modal-body">
                <div id="crew_commentscruisingmsg">

                </div>

            </div>
        </div>
    </div>
</div><!-- /.modal-content -->

<!-- sample modal content -->
<div id="guestNewsModal" class="modal certificat-modal-container sm-cruisingmsgmyModal"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="newsmodal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel" style="text-align:center;">Guest News</h4>
            </div>
            <div class="modal-body">
                <div id="charterguestnews">
                <?php echo $this->element('charter_program_news', array('comments' => $comments)); ?>
                </div>

            </div>
        </div>
    </div>
</div><!-- /.modal-content -->

<div class="row common-form-row map-form-rwo view-mainrow">
        <span class="sp-leftalign"><?php echo $schedulePeriod; ?></span>
                <span class="yacht-centerlabel" ><?php echo $scheduleLocation; ?>
 </span>
        <span class="label-bold md-bold sp-rightalign"><?php echo $charterName; ?></span>
<!--         <a>
            <span style="margin-left: 10%;" class="mob-none">   
                <?php echo $this->Html->link('Back','view',array('id' => 'charterProgramView', 'class' => 'btn btn-warning','title' => '<< Back'));?> 
            </span><span class="go-back-btn"><i class="fa fa-long-arrow-left"></i></span></a> -->
       
</div> 
<div class="personal-row-container">
<h1 class="position-mobile-head map-header">Cruising Map
</h1>
<div class="fixed-row-container map-container">  
 <div class="form-group base-margin">
<div class="custom-popup map_heightC" id="map"></div>
<div class="custom-popup map_heightC" id="windy"></div>
<div class="panel panel-default">
            <div class="panel-heading"  data-toggle="collapse" href="#mapbuttons">
            <button id="showmenu" class="btn">Open Menu</button>
            </div>
            <div id="mapbuttons" class="panel-collapse collapse">
<button id="CruisingButton">Cruising Schedule</button>
<button id="HideDetails">Show Details</button>
<button id="HelpfulTips">Helpful Tips</button>
<button id="WeatherMap">Weather Map</button>
<button id="GuestNews">Guest News</button>
<button id="closeWeatherMap">Close</button>
            </div></div>
</div></div>
</div>
<input type="hidden" id="topyname" value="<?php echo $topyname; ?>">
<input type="hidden" id="yachtId" value="<?php echo $yacht_id_fromyachtDB; ?>">
<input type="hidden" id="charterProgramId" value="<?php echo $charterProgramId; ?>">
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
            // In phone view the left menu should not overflow with map right side buttons
            var screenwidth = $(window).width();
            if(screenwidth <490){
                            $("#CruisingButton").hide();
                            $("#HideDetails").hide();
                            $("#HelpfulTips").hide();
                            $("#WeatherMap").hide();
                            $("#GuestNews").hide();
                            
            }
            // In phone view the left menu should not overflow with map right side buttons
        } else {
            sidebarIsVisible = false;
            // In phone view the left menu should not overflow with map right side buttons
                    $("#CruisingButton").show();
                    $("#HideDetails").show();
                    $("#HelpfulTips").show();
                    $("#WeatherMap").show();
                    $("#GuestNews").show();
                    // In phone view the left menu should not overflow with map right side buttons
        }
    }
})();

$('.menu > .menu__item').hover(function(){
  $(this).children('.submenu').show();
  
}, function() {
  $(this).children('.submenu').hide();
  
});

$(document).on("click", "#showmenu" ,function() { 
  var text= $('#mapbuttons').attr('aria-expanded');
  //console.log(text);
  if(text == "false"){
    $(this).html('Open Menu');
  } else{
    $(this).text('Close Menu');
 }
});

</script>


<script>
    var guesttype = '<?php echo $guesttype;?>';
    var allow_comments = '<?php echo $allow_comments;?>';
    var Wmarker= '<?php echo BASE_URL.'/charterguest/app/webroot/css/leaflet/dist/images/marker-icon.png'; ?>';
var basefolder = '<?php echo $basefolder;?>';
var vessel = new L.LayerGroup();
var markerArray = [];
var markerCount = 0;

var embark_lat = "<?php echo $embark_lat; ?>";
var embark_long =  "<?php echo $embark_long; ?>";

var startloc =  "<?php echo $startloc; ?>";
     
var mbAttr = '<table width=100%><thead><tr style="font-size:12px;font-weight:bold;text-align:center;"><td style="width:33%;border-radius: 12px;overflow: hidden;background: #fff;"><i class="fa fa-solid fa-ship map_bottom_attr" aria-hidden="true"></i>Distance<span style="color:#00a8f3;"><br><?php echo $RouteDatadisplaydistancevalue; ?></span></td><td style="width:33%;border-radius: 12px;overflow: hidden;background: #fff;"><i class="fa fa-solid fa-clock-o map_bottom_attr" aria-hidden="true"></i>Duration<span style="color:#00a8f3;"><br><?php echo $RouteDatadisplayduration; ?></span></td><td style="width:34%;border-radius: 12px;overflow: hidden;background: #fff;"><i class="fas fa-gas-pump fa-solid map_bottom_attr" aria-hidden="true"></i>Fuel<span style="color:#00a8f3;"><br><?php echo $RouteDatatotalconsumption; ?></span></td></tr></thead><tbody><tr style="font-size:12px;color:#00a8f3;font-weight:bold;text-align:center;"><td></td><td></td><td></td></tr></tbody></table>';
mbUrl = 'https://api.mapbox.com/styles/v1/superyachtos/{id}/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic3VwZXJ5YWNodG9zIiwiYSI6ImNpdW54eHV5bjAxNmMzMG1sMGpkamVma2cifQ.Y9kj-j0RGCFSE6khFVPyOw';
var satellite   =   L.tileLayer(mbUrl, {
    id: 'ciurvui5100uz2iqqe929nrlr', 
    unloadInvisibleTiles : false,
    reuseTiles : true,
    updateWhenIdle : false,
    continousWorld : true,
    noWrap: false,
    attribution: mbAttr,
    minZoom: 3, maxZoom: 18
});

var map = L.map('map', {
    //center: [39.73, -104.99],
    'zoom': 6,
    'measureControl': true,
    'worldCopyJump': false,
    'layers': [satellite],
    'inertiaDecelartion' : 3000,
    'inertiaMaxSpeed'    : 1500,
    'inertiaThershold'   : 32,
    //'crs': L.CRS.Simple,
});

var modalmapcruisingschsatellite = L.tileLayer(mbUrl, {
    id: 'ciurvui5100uz2iqqe929nrlr',
    unloadInvisibleTiles: false,
    reuseTiles: true,
    updateWhenIdle: false,
    continousWorld: true,
    noWrap: false,
    minZoom: 3, maxZoom: 18
});

var modalmapcruisingsch = L.map('modalmapcruisingsch', {
    //center: [39.73, -104.99],
    'zoom': 5,
    'measureControl': true,
    'worldCopyJump': false,
    'layers': [modalmapcruisingschsatellite],
    'inertiaDecelartion': 3000,
    'inertiaMaxSpeed': 1500,
    'inertiaThershold': 32,
    //'crs': L.CRS.Simple,
});

function ReloadModalMaplayerCSMP(){
    var modalmapcruisingschsatellite = L.tileLayer(mbUrl, {
                                            id: 'ciurvui5100uz2iqqe929nrlr',
                                            unloadInvisibleTiles: false,
                                            reuseTiles: true,
                                            updateWhenIdle: false,
                                            continousWorld: true,
                                            noWrap: false,
                                            minZoom: 3, maxZoom: 18
                                    });
                                    modalmapcruisingsch.addLayer(modalmapcruisingschsatellite);
    }


///////////////////////////Cruising schedule modal map//////////////////////////////////////////////
var CSMPmarkerArray = [];
var CSMPmarkerCount = 0;
<?php //echo "<pre>";print_r($crusemaparray);exit;
if(isset($crusemaparray) && !empty($crusemaparray)){
    $loop= 1;
    $firststat = 0;
foreach($newscheduleData as $key => $schedule){ 
    $schedule['CharterProgramSchedule']['title'] = trim($schedule['CharterProgramSchedule']['title']);
    $schedule['CharterProgramSchedule']['title'] = str_replace('"', "", $schedule['CharterProgramSchedule']['title']);
    $schedule['CharterProgramSchedule']['title'] = str_replace("'", "", $schedule['CharterProgramSchedule']['title']);
    $schedule['CharterProgramSchedule']['to_location'] = trim($schedule['CharterProgramSchedule']['to_location']);
    $schedule['CharterProgramSchedule']['to_location'] = str_replace('"', "", $schedule['CharterProgramSchedule']['to_location']);
    $schedule['CharterProgramSchedule']['to_location'] = str_replace("'", "", $schedule['CharterProgramSchedule']['to_location']);
    if($key == 0){
        $schedule['CharterProgramSchedule']['lattitude'] = $embark_lat;
        $schedule['CharterProgramSchedule']['longitude'] = $embark_long;
    }
    if($key > 1){
        $schedule['CharterProgramSchedule']['to_location'] = $schedule['CharterProgramSchedule']['to_location'];
    }else{
        if($key == 0 && $schedule['CharterProgramSchedule']['stationary'] == 1){
            $firststat = 1;
           
        }
       
        if($key == 1 && $firststat == 0){
            $schedule['CharterProgramSchedule']['to_location'] =  $schedule['CharterProgramSchedule']['org_title'];
        }else if($key == 1 && $firststat == 1){
            $schedule['CharterProgramSchedule']['to_location'] =  $schedule['CharterProgramSchedule']['to_location'];
        }
    }
    ?>

var locsatellite = "schloc"+"<?php echo $key; ?>";


locsatellite = L.tileLayer(mbUrl, {
    id: 'ciurvui5100uz2iqqe929nrlr',
    unloadInvisibleTiles: false,
    reuseTiles: true,
    updateWhenIdle: false,
    continousWorld: true,
    noWrap: false,
    minZoom: 3, maxZoom: 18
});

var idlocmap = "<?php echo "crusingschedulemap".$loop; ?>";
    idlocmap = L.map('<?php echo "crusingschedulemap".$loop; ?>', {
    center: ["<?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>", "<?php echo $schedule['CharterProgramSchedule']['longitude']; ?>"],
    'scrollWheelZoom': false,
    'zoom': 8,
    'measureControl': true,
    'worldCopyJump': false,
    'layers': [locsatellite],
    'inertiaDecelartion': 3000,
    'inertiaMaxSpeed': 1500,
    'inertiaThershold': 32,
    
    //'crs': L.CRS.Simple,
});
idlocmap.touchZoom.disable();
idlocmap.doubleClickZoom.disable();
idlocmap.scrollWheelZoom.disable();
idlocmap.boxZoom.disable();
idlocmap.keyboard.disable();
idlocmap.dragging.disable();
 //console.log(idlocmap);
// console.log(locsatellite);
var markerschloc = L.marker(["<?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>", "<?php echo $schedule['CharterProgramSchedule']['longitude']; ?>"],{pmIgnore: true}).bindTooltip("<?php echo "<span class='CSMPown' id='".$loop."'></span>"?>", 
                    {
                        permanent: true, 
                        offset: [0,0],
                        //sticky:true,
                        direction: 'right',
                        className: "CSMPTooltip",
                        noWrap: true,
                    }).on("click", markerOnClickCSMP);

                markerschloc.addTo(idlocmap);

                if(<?php echo $schedule['CharterProgramSchedule']['day_num']; ?> < 10 ){
                        newdaycount="<span>&nbsp;"+"<?php echo $schedule['CharterProgramSchedule']['day_num']; ?>"+"</span>";
                    }
                    else{
                        newdaycount="<span>"+"<?php echo $schedule['CharterProgramSchedule']['day_num']; ?>"+"</span>";
                    }
            
var textMarkerschloc = L.marker(["<?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>", "<?php echo $schedule['CharterProgramSchedule']['longitude']; ?>"], {
  icon: L.divIcon({
    html:newdaycount,
    //   html: "<?php // echo $schedule['CharterProgramSchedule']['day_num']; ?>",
      className: 'text-below-marker-locsch',
    })
});
textMarkerschloc.addTo(idlocmap);

markerschloc.scheduleId = "<?php echo $schedule['CharterProgramSchedule']['charter_program_id']; ?>";
        markerschloc.tablepId = "<?php echo $schedule['CharterProgramSchedule']['id']; ?>";
        markerschloc.scheduleUUId = "<?php echo $schedule['CharterProgramSchedule']['UUID']; ?>";
        markerschloc.daytitle = "<?php echo $schedule['CharterProgramSchedule']['title']; ?>";
        markerschloc.day_to_location = "<?php echo $schedule['CharterProgramSchedule']['to_location']; ?>";
        markerschloc.day_dates = "<?php echo $schedule['CharterProgramSchedule']['day_dates']; ?>";
        markerschloc.week_days = "<?php echo $schedule['CharterProgramSchedule']['week_days']; ?>";
        markerschloc.marker_msg_count = "<?php echo $schedule['CharterProgramSchedule']['marker_msg_count']; ?>";
        markerschloc.distancetotal = "<?php echo $markertotal[$schedule['CharterProgramSchedule']['to_location'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['distance']; ?>";
        markerschloc.durationtotal = "<?php echo $markertotal[$schedule['CharterProgramSchedule']['to_location'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['duration'];  ?>";
        markerschloc.consumptiontotal = "<?php echo $markertotal[$schedule['CharterProgramSchedule']['to_location'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['consumption']; ?>";
        markerschloc.endplace = "<?php echo $markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['endplace']; ?>";
        markerschloc.counttitle = "<?php echo $counttitle; ?>";
        markerschloc.scheduleSameLocationUUID = "<?php echo implode(',',$samelocationsScheduleUUID[$schedule['CharterProgramSchedule']['title']]); ?>";
        markerschloc.samelocationsDates = "<?php echo implode(',',$samelocationsDates[$schedule['CharterProgramSchedule']['title']]); ?>";
        markerschloc.day_num = "<?php echo $schedule['CharterProgramSchedule']['day_num']; ?>";
        markerschloc.serial_no = "<?php echo $schedule['CharterProgramSchedule']['serial_no']; ?>";
        markerschloc.stationary = "<?php echo $schedule['CharterProgramSchedule']['stationary']; ?>";

        markerschloc.row_from_lat = "<?php echo $schedule['CharterProgramSchedule']['row_from_lat']; ?>";
        markerschloc.row_from_long = "<?php echo $schedule['CharterProgramSchedule']['row_from_long']; ?>";
        markerschloc.row_from_distance = "<?php echo $schedule['CharterProgramSchedule']['row_from_distance']; ?>";
        markerschloc.row_from_duration = "<?php echo $schedule['CharterProgramSchedule']['row_from_duration']; ?>";

        markerschloc.markerNum = CSMPmarkerCount; 
        <?php 
            if($key == 0){  
            ?>
            markerschloc.from_flag = "from"; 
        <?php } ?>
        <?php 
            if($key == 0 && $schedule['CharterProgramSchedule']['stationary'] == 1){
            $firststat = 1;
            ?>
            markerschloc.from_flag = "from"; 
        <?php } ?>

        <?php if($key == 1 && $firststat == 0){ ?>
            markerschloc.to_flag = "to"; 
            markerschloc.start_loc =startloc;
            markerschloc.embark_lat =embark_lat;
            markerschloc.embark_long =embark_long;
            markerschloc.distancetotal = "<?php echo $markertotal[$embarkation_chprg.' - Day '.$schedule['CharterProgramSchedule']['day_num']]['distance']; ?>";
            markerschloc.durationtotal = "<?php echo $markertotal[$embarkation_chprg.' - Day '.$schedule['CharterProgramSchedule']['day_num']]['duration'];  ?>";
        <?php }else if($key == 1 && $firststat == 1){ ?>   
            markerschloc.daytitle = "<?php echo $schedule['CharterProgramSchedule']['to_location']; ?>";
        <?php } ?>
        CSMPmarkerArray.push(markerschloc);
        CSMPmarkerCount++;

// removed control zoom in and out from modal
$("#<?php echo "crusingschedulemap".$loop; ?> .leaflet-control-container").hide();

//ReloadModalMaplayerCSMP();
<?php 
$loop++; 

}
}
?>




//////////////////////////////Cruising schedule modal map////////////////////////////////////////////
  
//modalmap
var modalmapsatellite = L.tileLayer(mbUrl, {
    id: 'ciurvui5100uz2iqqe929nrlr',
    unloadInvisibleTiles: false,
    reuseTiles: true,
    updateWhenIdle: false,
    continousWorld: true,
    noWrap: false,
    minZoom: 3, maxZoom: 18
});

//modalmap
var modalmap = L.map('modalmap', {
    //center: [39.73, -104.99],
    'zoom': 5,
    'measureControl': true,
    'worldCopyJump': false,
    'layers': [modalmapsatellite],
    'inertiaDecelartion': 3000,
    'inertiaMaxSpeed': 1500,
    'inertiaThershold': 32,
    //'crs': L.CRS.Simple,
});
//L.control.ruler().addTo(modalmap);


// Removed the layer on close the route modal to clear any changes done and not saved.
// On Opening the modal calling this function to load the layer
function ReloadModalMaplayer(){
    var modalmapsatellite = L.tileLayer(mbUrl, {
                                            id: 'ciurvui5100uz2iqqe929nrlr',
                                            unloadInvisibleTiles: false,
                                            reuseTiles: true,
                                            updateWhenIdle: false,
                                            continousWorld: true,
                                            noWrap: false,
                                            minZoom: 3, maxZoom: 18
                                    });
        modalmap.addLayer(modalmapsatellite);
    }

var centerLat = 40.58058466412764;
var centerLng = -35.85937500000001;
var centerLatDay1 = 40.58058466412764;
var centerLngDay1 = -35.85937500000001;
var zoom = 4;
var day1 = 0;
var latlngs = [];
var globaldropdownvarAddOption = "";
var clickedstationary;
// Generating the markers for existing records
<?php 
if(!empty($scheduleData)){
    $myLastElement = array_pop($scheduleData);  
    //echo "<pre>";print_r($myLastElement);exit;
    $startingloc = $scheduleData[0];
}
$fromLocFlag = 0;
$degcount = 0;
$donotOpenitinearymodalmorethanoneday = 0;
foreach ($scheduleData as $key => $schedule) { 

if(isset($samelocations[$schedule['CharterProgramSchedule']['lattitude']]) && !empty($samelocations[$schedule['CharterProgramSchedule']['lattitude']])){
    $counttitle = count($samelocations[$schedule['CharterProgramSchedule']['lattitude']]);
        $SumDaytitle = "";
        foreach($samelocations[$schedule['CharterProgramSchedule']['lattitude']] as $val){
            $SumDaytitle.= $val.'<br>';
        }

        $WeekDaytitle = "";
        if(count($stationarylocations)>1){
            foreach($stationarylocations[$schedule['CharterProgramSchedule']['lattitude']] as $val){
                $WeekDaytitle.= $val.'<br><br>';
            }
        }

        if((count($stationarylocations[$schedule['CharterProgramSchedule']['lattitude']])>1) && $schedule['CharterProgramSchedule']['day_num'] != 1){
            $donotOpenitinearymodalmorethanoneday = 1;
        }else{
            $donotOpenitinearymodalmorethanoneday = 0;
        }


    $schuuid = $schedule['CharterProgramSchedule']['UUID'];
    $schedule['CharterProgramSchedule']['title'] = trim($schedule['CharterProgramSchedule']['title']);
    $title_loc_temp = str_replace('"', "", $schedule['CharterProgramSchedule']['title']);
    $title_loc_temp2 = str_replace("'", "", $title_loc_temp);
    $schedule['CharterProgramSchedule']['title'] = $title_loc_temp2;
    $schedule['CharterProgramSchedule']['to_location'] = trim($schedule['CharterProgramSchedule']['to_location']);
    $title_loc_tempto_location = str_replace('"', "", $schedule['CharterProgramSchedule']['to_location']);
    $title_loc_temp2to_location = str_replace("'", "", $title_loc_tempto_location);
    $schedule['CharterProgramSchedule']['to_location'] = $title_loc_temp2to_location;
    if($samemarkercommentcount[$schedule['CharterProgramSchedule']['lattitude']] == 0){
        $marker_msg_count = "style='display:none;'";
        $samemkrcount = "";
    }else if($samemarkercommentcount[$schedule['CharterProgramSchedule']['lattitude']] != 0){
        $marker_msg_count = "";
        $samemkrcount = $samemarkercommentcount[$schedule['CharterProgramSchedule']['lattitude']];
        if(isset($guesttype) && !empty($guesttype)){ //echo $guesttype; exit;
            if($guesttype == "guest"){
                    $marker_msg_count = "style='display:none;'";
            }else{
                    $marker_msg_count = "";
            }
        }
        
    }
    if(isset($markertotal[$schedule['CharterProgramSchedule']['to_location'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['endplace']) && !empty($markertotal[$schedule['CharterProgramSchedule']['to_location'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['endplace'])){
            $endplace = $markertotal[$schedule['CharterProgramSchedule']['to_location'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['endplace'];
            $bar = " / ";
    }else{
        $endplace = "";
        $bar = "";
    }
    if(isset($markertotal[$schedule['CharterProgramSchedule']['to_location'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['distance']) && !empty($markertotal[$schedule['CharterProgramSchedule']['to_location'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['distance'])){
        $distance = $markertotal[$schedule['CharterProgramSchedule']['to_location'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['distance'];
        
    }else{
        $distance = "";
    
    }
    if(isset($markertotal[$schedule['CharterProgramSchedule']['to_location'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['duration']) && !empty($markertotal[$schedule['CharterProgramSchedule']['to_location'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['duration'])){
        $duration = $markertotal[$schedule['CharterProgramSchedule']['to_location'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['duration'];
        
    }else{
    $duration = "";
    
    }
    if(isset($markertotal[$schedule['CharterProgramSchedule']['to_location'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['consumption']) && !empty($markertotal[$schedule['CharterProgramSchedule']['to_location'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['consumption'])){
        $consumption = $markertotal[$schedule['CharterProgramSchedule']['to_location'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['consumption'];
        
    }else{
    $consumption = "";
    
    }

    if($key == 0 && $schedule['CharterProgramSchedule']['stationary'] == 1){
        $fromLocFlag = 1;
    }


    if($schedule['CharterProgramSchedule']['stationary'] == 1 && $schedule['CharterProgramSchedule']['day_num'] != 1){
        $degcount = $degcount+1;
        $stclass = "style='position:absolute;top:-40px !important;'";
        //$scheduleData[$key+1]['CharterProgramSchedule']['stationary'] = 1;
        if($degcount == 1){
            $rotationAngle = 90;
        }else if($degcount == 2){
            $rotationAngle = 180;
        }else if($degcount == 3){
            $rotationAngle = 270;
        }
     }else{
         $stclass = "";
         $rotationAngle = 0;
         $degcount = 0;
     }

    $daynumber = $schedule['CharterProgramSchedule']['day_num'];
    $kn = $key+1;
    $tooltipclass = "stationarytooltip".$kn;

        if ($schedule['CharterProgramSchedule']['day_num'] == 1) {
        ?>
            day1 = 1;
            centerLatDay1 = <?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>;
            centerLngDay1 = <?php echo $schedule['CharterProgramSchedule']['longitude']; ?>;
        <?php } ?> 
            
        centerLat = <?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>;
        centerLng = <?php echo $schedule['CharterProgramSchedule']['longitude']; ?>;
        zoom = 7;
        
        var marker = L.marker(["<?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>", "<?php echo $schedule['CharterProgramSchedule']['longitude']; ?>"],{pmIgnore: true,riseOnHover:true,rotationAngle:"<?php echo $rotationAngle; ?>"})
        .bindTooltip("<?php echo "<span class='owntooltip' id=".$key.">".$SumDaytitle."<span id='".$schuuid."'   class='acti-count' ".$marker_msg_count." >".$samemkrcount."</span><b style='font-size: 10px;'>".$schedule['CharterProgramSchedule']['to_location']."<hr>".$endplace."</b><br><b style='font-size: 10px;'>".$distance.$bar.$duration."</b></span><span class='stationary' ".$stclass." >".$WeekDaytitle."</span>"?>", 
                    {
                        permanent: true, 
                        offset: [0,0],
                        //sticky:true,
                        direction: 'right',
                        className: "Tooltip <?php echo $tooltipclass; ?>",
                        noWrap: true,
                    })
                .on("click", markerOnClick);
                //console.log(marker);
                latlngs.push(new L.LatLng(<?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>, <?php echo $schedule['CharterProgramSchedule']['longitude']; ?>));

        marker.scheduleId = "<?php echo $schedule['CharterProgramSchedule']['charter_program_id']; ?>";
        marker.tablepId = "<?php echo $schedule['CharterProgramSchedule']['id']; ?>";
        marker.scheduleUUId = "<?php echo $schedule['CharterProgramSchedule']['UUID']; ?>";
        marker.daytitle = "<?php echo $schedule['CharterProgramSchedule']['title']; ?>";
        marker.day_to_location = "<?php echo htmlspecialchars($schedule['CharterProgramSchedule']['to_location']); ?>";
        marker.day_dates = "<?php echo $schedule['CharterProgramSchedule']['day_dates']; ?>";
        marker.marker_msg_count = "<?php echo $schedule['CharterProgramSchedule']['marker_msg_count']; ?>";
        marker.distancetotal = "<?php echo $markertotal[$schedule['CharterProgramSchedule']['to_location'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['distance']; ?>";
        marker.durationtotal = "<?php echo $markertotal[$schedule['CharterProgramSchedule']['to_location'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['duration'];  ?>";
        marker.consumptiontotal = "<?php echo $markertotal[$schedule['CharterProgramSchedule']['to_location'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['consumption']; ?>";
        marker.endplace = "<?php echo $markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['endplace']; ?>";
        marker.counttitle = "<?php echo $counttitle; ?>";
        marker.scheduleSameLocationUUID = "<?php echo implode(',',$samelocationsScheduleUUID[$schedule['CharterProgramSchedule']['title']]); ?>";
        marker.samelocationsDates = "<?php echo implode(',',$samelocationsDates[$schedule['CharterProgramSchedule']['title']]); ?>";
        marker.labeldayanddate = "<?php echo $SumDaytitle; ?>";
        marker.day_num = "<?php echo $schedule['CharterProgramSchedule']['day_num']; ?>";
        marker.markerNum = markerCount; 
        <?php if (!empty($samlatlong[$schedule['CharterProgramSchedule']['title']]) && in_array($schedule['CharterProgramSchedule']['lattitude'], $samlatlong[$schedule['CharterProgramSchedule']['title']])) { ?>
            marker.stationary = 1;
        <?php }else{?>
            marker.stationary = "<?php echo $schedule['CharterProgramSchedule']['stationary']; ?>";
        <?php } ?>
        <?php if($key == 1 && $fromLocFlag == 0){ ?>
            marker.firstdaytoloc = "to";
            marker.distancetotal = "<?php echo $markertotal[$embarkation_chprg.' - Day '.$schedule['CharterProgramSchedule']['day_num']]['distance']; ?>";
            marker.durationtotal = "<?php echo $markertotal[$embarkation_chprg.' - Day '.$schedule['CharterProgramSchedule']['day_num']]['duration'];  ?>";
            marker.consumptiontotal = "<?php echo $markertotal[$embarkation_chprg.' - Day '.$schedule['CharterProgramSchedule']['day_num']]['consumption']; ?>";
            marker.fromstartloc = "<?php echo $embarkation_chprg; ?>";
        <?php } ?>
        marker.stationarytooltipnum = "<?php echo $kn; ?>";
        marker.serial_no = "<?php echo $schedule['CharterProgramSchedule']['serial_no']; ?>";
        marker.donotOpenitinearymodalmorethanoneday = "<?php echo $donotOpenitinearymodalmorethanoneday; ?>";
        marker.row_from_lat = "<?php echo $schedule['CharterProgramSchedule']['row_from_lat']; ?>";
        marker.row_from_long = "<?php echo $schedule['CharterProgramSchedule']['row_from_long']; ?>";
        marker.row_from_distance = "<?php echo $schedule['CharterProgramSchedule']['row_from_distance']; ?>";
        marker.row_from_duration = "<?php echo $schedule['CharterProgramSchedule']['row_from_duration']; ?>";
        marker.endmarker = "no";
        markerArray.push(marker);
        marker.addTo(map);
        markerCount++;


<?php } } ?>

<?php
/********************************end place last marker ************ */
if(!empty($startingloc)){
            $SumDaytitle =$startingloc['CharterProgramSchedule']['title']; 
            $counttitle_endmarker = count($samelocations[$startingloc['CharterProgramSchedule']['lattitude']]);

            $SumDaytitle = "";
foreach($samelocations[$startingloc['CharterProgramSchedule']['lattitude']] as $val){
    $SumDaytitle.= $val.'<br>';
}
    
    if(isset($markertotal[$startingloc['CharterProgramSchedule']['title'].' - Day '.$startingloc['CharterProgramSchedule']['day_num']]['endplace']) && !empty($markertotal[$startingloc['CharterProgramSchedule']['title'].' - Day '.$startingloc['CharterProgramSchedule']['day_num']]['endplace'])){
        $bar = " / ";
       
}else{
    $bar = "";
}
            ?>
            
    var end = L.marker(["<?php echo $embark_lat; ?>", "<?php echo $embark_long; ?>"], {draggable: false,pmIgnore: true})
    .bindTooltip("<?php echo "<span class='owntooltip daytooltip_".$startingloc['CharterProgramSchedule']['UUID']."' >".$SumDaytitle."<b style='font-size: 10px;'>".htmlspecialchars($startingloc['CharterProgramSchedule']['title'])."<hr>".$markertotal[$startingloc['CharterProgramSchedule']['title'].' - Day '.$startingloc['CharterProgramSchedule']['day_num']]['endplace']."</b><br><b style='font-size: 10px;'>".$markertotal[$startingloc['CharterProgramSchedule']['title'].' - Day '.$startingloc['CharterProgramSchedule']['day_num']]['distance'].$bar.$markertotal[$startingloc['CharterProgramSchedule']['title'].' - Day '.$startingloc['CharterProgramSchedule']['day_num']]['duration'].$bar.$markertotal[$startingloc['CharterProgramSchedule']['title'].' - Day '.$startingloc['CharterProgramSchedule']['day_num']]['consumption']."</b></span>"?>",
                    {
                        permanent: true, 
                        offset: [0,0],
                        direction: 'right',
                        className: "Tooltip",
                        noWrap: false,
                    }).on("click", markerOnClick);

                    latlngs.push(new L.LatLng(<?php echo $embark_lat; ?>, <?php echo $embark_long; ?>));

                    end.scheduleId = "<?php echo $startingloc['CharterProgramSchedule']['charter_program_id']; ?>";
                    end.tablepId = "<?php echo $startingloc['CharterProgramSchedule']['id']; ?>";
                    end.scheduleUUId = "<?php echo $startingloc['CharterProgramSchedule']['UUID']; ?>";
                    end.daytitle = "<?php echo $startingloc['CharterProgramSchedule']['title']; ?>";
                    end.day_to_location = "<?php echo htmlspecialchars($startingloc['CharterProgramSchedule']['to_location']); ?>";
                    end.day_num = "<?php echo $startingloc['CharterProgramSchedule']['day_num']; ?>";
                    end.markerNum = "<?php echo $startingloc['CharterProgramSchedule']['day_num']; ?>";
                    end.day_dates = "<?php echo $startingloc['CharterProgramSchedule']['day_dates']; ?>";
                    end._latlng.lat = "<?php echo $embark_lat; ?>";
                     end._latlng.lng = "<?php echo $embark_long; ?>";
                     end.distancetotal = "<?php echo $markertotal[$startingloc['CharterProgramSchedule']['title'].' - Day '.$startingloc['CharterProgramSchedule']['day_num']]['distance']; ?>";
                    end.durationtotal = "<?php echo $markertotal[$startingloc['CharterProgramSchedule']['title'].' - Day '.$startingloc['CharterProgramSchedule']['day_num']]['duration'];  ?>";
                    end.consumptiontotal = "<?php echo $markertotal[$startingloc['CharterProgramSchedule']['title'].' - Day '.$startingloc['CharterProgramSchedule']['day_num']]['consumption']; ?>";
                    end.endmarker = "yes";
                    markerArray.push(end);
                    end.addTo(map);


 <?php  } /********************************end place last marker ************ */
 ?>

<?php
$degMarkerCount = 0;
foreach ($scheduleData as $key => $schedule) { 
    if(isset($samelocations[$schedule['CharterProgramSchedule']['lattitude']]) && !empty($samelocations[$schedule['CharterProgramSchedule']['lattitude']])){

        $schuuid = $schedule['CharterProgramSchedule']['UUID'];
    if($samemarkercommentcount[$schedule['CharterProgramSchedule']['lattitude']] == 0){
        $marker_msg_count = "style='display:none;'";
        $samemkrcount = "";
    }else if($samemarkercommentcount[$schedule['CharterProgramSchedule']['lattitude']] != 0){
        $marker_msg_count = "";
        $samemkrcount = $samemarkercommentcount[$schedule['CharterProgramSchedule']['lattitude']];
        if(isset($guesttype) && !empty($guesttype)){ //echo $guesttype; exit;
            if($guesttype == "guest"){
                if($cp_guesttype == 'email_recipient'){
                    if($allow_comments == '1'){
                        $marker_msg_count = "";
                    }else{
                        $marker_msg_count = "style='display:none;'";
                    }

                }else{                    
                    $marker_msg_count = "style='display:none;'";
                }
                    
            }else{
                    $marker_msg_count = "";
            }
        }
        
    }

    // if(isset($samelocations_daynumdisplay[$schedule['CharterProgramSchedule']['lattitude']][0])){
    //     $markernumberDisplay = $samelocations_daynumdisplay[$schedule['CharterProgramSchedule']['lattitude']][0];
        
    // }else{
        if($schedule['CharterProgramSchedule']['stationary'] == 0){
        $markernumberDisplay = $schedule['CharterProgramSchedule']['day_num'];
        $rotationAngle = 0;
        $degMarkerCount = 0;
        }
        $textbelowmarkerdeg = "text-below-marker day1numbermarkernodisplay";
       
        if($schedule['CharterProgramSchedule']['stationary'] == 1 && $schedule['CharterProgramSchedule']['day_num'] != 1){
            $degMarkerCount = $degMarkerCount+1;
            $markernumberDisplay = $schedule['CharterProgramSchedule']['day_num'];
            if($degMarkerCount == 1){
                $rotationAngle = 0;
                $textbelowmarkerdeg = "text-below-marker text-below-marker-90deg";
            }else if($degMarkerCount == 2){
                $rotationAngle = 0;
                $textbelowmarkerdeg = "text-below-marker text-below-marker-180deg";
            }else if($degMarkerCount == 3){
                $rotationAngle = 0;
                $textbelowmarkerdeg = "text-below-marker text-below-marker-270deg";
            }
            
         }
    //}
    ?>
 var textbelowmarkerdeg = "<?php echo $textbelowmarkerdeg; ?>"
    var textMarker = L.marker(["<?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>", "<?php echo $schedule['CharterProgramSchedule']['longitude']; ?>"], {
        <?php if($schedule['CharterProgramSchedule']['stationary'] == 0){ ?>
  icon: L.divIcon({
    html: "<?php if($markernumberDisplay < 10 ){ ?>    <span>&nbsp;<?php echo $markernumberDisplay; ?></span> <?php } else { ?><span><?php echo $markernumberDisplay; ?></span><?php } ?><span id='<?php echo $schuuid ?>'   class='acti-count-onmarker' <?php echo $marker_msg_count ?> ><?php echo $samemkrcount ?></span>",
    className: 'text-below-marker',
    }),
    rotationAngle: 0
    <?php } ?>
    <?php if($schedule['CharterProgramSchedule']['stationary'] == 1){ ?>
        icon: L.divIcon({
    html: "<?php if($markernumberDisplay < 10 ){ ?>    <span>&nbsp;<?php echo $markernumberDisplay; ?></span> <?php } else { ?><span><?php echo $markernumberDisplay; ?></span><?php } ?><span id='<?php echo $schuuid ?>'   class='acti-count-onmarker' <?php echo $marker_msg_count ?> ><?php echo $samemkrcount ?></span>",
    className: textbelowmarkerdeg,
    }),
    rotationAngle: "<?php echo $rotationAngle; ?>"
    <?php } ?>
}).addTo(map);
 <?php } 
}?>


/********************************Assigning day number to last marker ************ */
<?php 
if(isset($startingloc['CharterProgramSchedule']['lattitude'])){

$schuuid = $startingloc['CharterProgramSchedule']['UUID'];
$primary_id = $startingloc['CharterProgramSchedule']['id'];
if($samemarkercommentcount[$startingloc['CharterProgramSchedule']['UUID']] == 0){
$marker_msg_count = "style='display:none;'";
$samemkrcount = "";
}else if($samemarkercommentcount[$startingloc['CharterProgramSchedule']['UUID']] != 0){
$marker_msg_count = "";
$samemkrcount = $samemarkercommentcount[$startingloc['CharterProgramSchedule']['UUID']];
if(isset($guesttype) && !empty($guesttype)){ //echo $guesttype; exit;
    if($guesttype == "guest"){
            $marker_msg_count = "style='display:none;'";
    }else{
            $marker_msg_count = "";
    }
}

}
//if(isset($samelocations_daynumdisplay[$startingloc['CharterProgramSchedule']['lattitude']][0])){
//$markernumberDisplay = $samelocations_daynumdisplay[$startingloc['CharterProgramSchedule']['lattitude']][0];

//}else{
$markernumberDisplay = $startingloc['CharterProgramSchedule']['day_num'];
//}


    // if($schedule['CharterProgramSchedule']['lattitude'] == $scheduleData[$key+1]['CharterProgramSchedule']['lattitude'] ){ 
    //     //$schedule[$key+1]['CharterProgramSchedule']['day_num'] = "";
    //     $markernumberDisplay = "";
    // }
    
     
?>
        

var textMarker = L.marker(["<?php echo $embark_lat; ?>", "<?php echo $embark_long; ?>"], {
icon: L.divIcon({
html: "<?php if($markernumberDisplay < 10 ){ ?><span>&nbsp;<?php echo $markernumberDisplay; ?></span> <?php } else { ?><span><?php echo $markernumberDisplay; ?></span><?php } ?>",
className: 'text-below-marker',
tooltipAnchor: [ 0, 0 ]
})
}).addTo(map);

        
        //marker._icon.classList.add('lidebarkMarker'+newString+dm_num);
        
        //L.DomUtil.addClass(textMarker._icon, 'lidebarkMarker'+newString+dm_num);

<?php }  ?>
 /********************************Assigning day number to last marker ************ */ 

 $(document).on("mouseover", "#map .leaflet-marker-icon", function(e) {
    if(!this.classList.contains('text-below-marker')){
        this.style.zIndex = this.style.zIndex-250;
    }  
 });
map.on('click', function(e) {
    $('.Tooltip').css('top','');
    if(clickedstationary){
    $(".stationarytooltip"+clickedstationary).hide();
    }
    //$(".Tooltip").hide();
});
// script to show the tooltip next to marker on show/hide and also zoomin and zoomout
map.on('zoomstart', function () {

        var zoomLevel = map.getZoom();
            //alert(zoomLevel);
            //console.log(zoomLevel);
            //alert(zoomLevel);
            $('.Tooltip').css('top','');
            var tooltipdisplay = $('.Tooltip').css('display');
            if(tooltipdisplay == "block"){ 
                $('.Tooltip').css('top','');
            }
            if(tooltipdisplay == "none"){ 
                $('.Tooltip').css('top','');
            }
            //alert(zoomLevel);
            // console.log("zoomLevel");
            // console.log(tooltipdisplay);

});

// Making the Centre point
if (day1) {
    map.setView(new L.LatLng(centerLatDay1, centerLngDay1), zoom);
    if(latlngs.length > 0){
        map.fitBounds(latlngs);
    }
} else {
    map.setView(new L.LatLng(centerLat, centerLng), zoom);
    if(latlngs.length > 0){
        map.fitBounds(latlngs);
    }
}
map.pm.addControls({
    position: 'topleft',
    drawCircle: false,
    drawMarker: false,
    drawCircleMarker: false,
    drawRectangle: false,
    drawPolygon: false,
    rotateMode: false,
    dragMode: false,
    cutPolygon: false,
    removalMode: false,
    editMode: false,
    drawPolyline: false
});

var polylineDB = [];
var polylineTooltipDuration = [];
var polylineTooltipConsumption = [];
var polylineTooltipDistance = [];
//var modalrouteline = new Array();
<?php  if(isset($RouteData) && !empty($RouteData)){ 
    foreach($RouteData as $key => $value){
    ?>


polylineDB.push(new L.LatLng(<?php echo $value['CharterProgramScheduleRoute']['longitude']; ?>,
    <?php echo $value['CharterProgramScheduleRoute']['lattitude']; ?>));


// var latlongv = new L.LatLng(<?php echo $value['CharterProgramScheduleRoute']['longitude']; ?>,
//     <?php echo $value['CharterProgramScheduleRoute']['lattitude']; ?>);
// modalrouteline.push({
//     name: '<?php echo $value['CharterProgramScheduleRoute']['start_location']; ?>',
//     index: latlongv,
//     end_loc: '<?php echo $value['CharterProgramScheduleRoute']['end_location']; ?>'
// });



<?php 
    }
} ?>

<?php /*if(isset($RouteData) && !empty($RouteData)){ ?>
var drawnItems = new L.FeatureGroup();
map.addLayer(drawnItems);
var polyLayers = [];

var polygon2 = L.polyline(polylineDB);
polyLayers.push(polygon2)
//console.log(polyLayers);
// Add the layers to the drawnItems feature group 
//console.log('gggg');
for (let layer of polyLayers) { //console.log(layer);



    drawnItems.addLayer(layer);


}
<?php 
   
} */?>

function roundPathCorners(rings, radius) {
  function moveTowardsFractional(movingPoint, targetPoint, fraction) {
    return {
      x: movingPoint.x + (targetPoint.x - movingPoint.x) * fraction,
      y: movingPoint.y + (targetPoint.y - movingPoint.y) * fraction
    };
  }

  function pointForCommand(cmd) {
    return {
      x: parseFloat(cmd[cmd.length - 2]),
      y: parseFloat(cmd[cmd.length - 1])
    };
  }

  var resultCommands = [];
  if (+radius) {
  // negative numbers create artifacts
    radius = Math.abs(radius);
  } else {
    radius = 0.15;
    //radius = 0.3;
  }

  for (i = 0, len = rings.length; i < len; i++) {
    commands = rings[i];
  	// start point    
    resultCommands.push(["M", commands[0].x, commands[0].y]);
    
    for (var cmdIndex = 1; cmdIndex < commands.length; cmdIndex++) {
      var prevCmd = resultCommands[resultCommands.length - 1];
      var curCmd = commands[cmdIndex];
      var nextCmd = commands[cmdIndex + 1];
  
      if (nextCmd && prevCmd) {
        // Calc the points we're dealing with
        var prevPoint = pointForCommand(prevCmd); // convert to Object
        var curPoint = curCmd;
        var nextPoint = nextCmd;
        
        // The start and end of the cuve are just our point moved towards the previous and next points, respectivly
        var curveStart, curveEnd;
        
        curveStart = moveTowardsFractional(
          curPoint,
          prevCmd.origPoint || prevPoint,
          radius
        );
        curveEnd = moveTowardsFractional(
          curPoint,
          nextCmd.origPoint || nextPoint,
          radius
        );
        
        // Adjust the current command and add it
        curCmd = Object.values(curveStart);
        
        curCmd.origPoint = curPoint;
        curCmd.unshift("L");
        resultCommands.push(curCmd);
        
        // The curve control points are halfway between the start/end of the curve and
        // calculate curve, if radius is different than 0
        if (radius) {
          var startControl = moveTowardsFractional(curveStart, curPoint, 0.5);
          var endControl = moveTowardsFractional(curPoint, curveEnd, 0.5);
          // Create the curve
          var curveCmd = [
            "C",
            startControl.x,
            startControl.y,
            endControl.x,
            endControl.y,
            curveEnd.x,
            curveEnd.y
          ];
          // Save the original point for fractional calculations
          curveCmd.origPoint = curPoint;
          resultCommands.push(curveCmd);
        }
      } else {
        // Pass through commands that don't qualify
        var el = Object.values(curCmd);
        el.unshift("L");
        resultCommands.push(el);
      }
    }
  }

  return (
    resultCommands.reduce(function(str, c) {
      return str + c.join(" ") + " ";
    }, "") || "M0 0"
  );
};

/* corner smooth radius, keep value in range 0 - 0.5 to avoid artifacts */
//const radius = -0.15 

const radius = 0.3

const SmoothPoly = L.Polyline.extend({
 // override default method to use custom points-to-path method 
  _updatePath: function() {
    const path = roundPathCorners(this._parts, radius)
    this._renderer._setPath(this, path);
  }
})

var modalrouteline = new Array();
<?php if(isset($temploc) && !empty($temploc)){ 
    
    foreach($temploc as $title => $latlongs){   
          $templlocnames = explode('_',$title);
          $startlocnameexplode = $templlocnames[0];
          $endlocnameexplode = $templlocnames[1];
        ?>

var latlongstemp = [];


        

<?php    foreach($latlongs as $v){ ?>

            var latlongs0 = <?php echo $v ?>;
            latlongstemp.push(latlongs0);

            var latlongv = <?php echo $v ?>;

            modalrouteline.push({
            name: '<?php echo $startlocnameexplode; ?>',
            index: latlongv,
            end_loc: '<?php echo $endlocnameexplode; ?>',
        });

<?php } ?>
// middle line
var polyline0 = new SmoothPoly(latlongstemp, {stroke:true,weight:2.5,dashArray: [5,5],color:'#fff',lineCap: "round",lineJoin: "round",smoothFactor: 5}).addTo(map);
//map.fitBounds(latlngs);
// drawnItems.on('pm:edit', function (e) {

//     e.layer.setStyle({ pmIgnore: false });
//     L.PM.reInitLayer(e.layer);
//     var layer = e.layer;
//     setPupup(layer);
//     //alert('jjj');
//     layer.on('pm:update', function(e) { 
//         setPupup(e.layer);
//     });
// });
<?php //}

}
} ?>
//console.log(modalrouteline);


// L.Control.MarkerControl = L.Control.extend({
//     onAdd: function(map) {
//         var el = L.DomUtil.create('div', 'leaflet-pm-toolbar leaflet-pm-draw leaflet-bar my-control');

//         el.innerHTML =
//             '<div class="button-container" title="Hide / Show Location Cards" style="text-align: center;margin-top: -6px;font-size: 20px;color:#3388ff;"><i class="fa fa-info"></i></div>';

//         el.onclick = function() {
//             mapClickEvent = false; // this is for condition to disable the map click function

//             var disp = $(".Tooltip").css("display");
//             if (disp == "block") {
//                 $(".Tooltip").css("display", "none");
//                 el.innerHTML =
//                     '<div class="button-container" title="Hide / Show Location Cards" style="text-align: center;margin-top: -6px;font-size: 20px;color:#000;"><i class="fa fa-info"></i></div>';

//             } else {
//                 $(".Tooltip").css("display", "block");
//                 el.innerHTML =
//                     '<div class="button-container" title="Hide / Show Location Cards" style="text-align: center;margin-top: -6px;font-size: 20px;color:#3388ff;"><i class="fa fa-info"></i></div>';

//             }
//         }

//         return el;
//     },

//     onRemove: function(map) {
//         // Nothing to do here
//     }
// });

// L.control.markerControl = function(opts) {
//     return new L.Control.MarkerControl(opts);
// }

// L.control.markerControl({
//     position: 'topleft'
// }).addTo(map);


// /***********************************************Help icon************/
// L.Control.MarkerControl = L.Control.extend({
//     onAdd: function(map) {
//         var el = L.DomUtil.create('div', 'leaflet-pm-toolbar leaflet-pm-draw leaflet-bar my-control');

//         el.innerHTML =
//             '<div class="button-container" title="Hide / Show Location Cards" style="text-align: center;margin-top: -6px;font-size: 20px;color:#3388ff;"><i class="fa fa-question-circle"></i></div>';

//         el.onclick = function() {
//             mapClickEvent = false; // this is for condition to disable the map click function

//             openhelpmodal();
            
//         }

//         return el;
//     },

//     onRemove: function(map) {
//         // Nothing to do here
//     }
// });

// L.control.markerControl = function(opts) {
//     return new L.Control.MarkerControl(opts);
// }

// L.control.markerControl({
//     position: 'topleft'
// }).addTo(map);
// $(document).on("mouseover", "#HideDetails,#CruisingButton", function(e) {
//     mapClickEvent = false; // this is for condition to disable the map click function
//     //stuff to do on mouseover
// });
$(document).on("click", "#HideDetails", function(e) {
    mapClickEvent = false; // this is for condition to disable the map click function
    //var disp = $(".Tooltip").css("display");
    // if (disp == "block") {
    //     $(".Tooltip").css("display", "none");  
    //     $("#HideDetails").text("Show Details");
    // } else {
    //     $(".Tooltip").css("display", "block");
    //     $("#HideDetails").text("Hide Details");

    // }
    // $(".action-finishMode").click();
    // $(".button-container").removeClass('active');
    // $(".leaflet-control").removeClass('activeChild');
    var btntext = $("#HideDetails").text();
    if(btntext == "Show Details"){
        $(".Tooltip").css("top","20px");
        $(".Tooltip").css("width","170px");
        $(".smalltooltip").hide();
         $(".Tooltip").show();
        $(".owntooltip").show();
        $(".stationary").hide();
        $("#HideDetails").text("Hide Details");
        // $('.text-below-marker').each(function(i, obj) {
        //     var t = $(this).find('.acti-count-onmarker').text();
        //     //console.log(t);
        //     if(t != "" && t > 0){
           //     $(".acti-count-onmarker").hide();
        //     }
        
        // });
        // $(".leaflet-tooltip").css("opacity", "0");  
        // setTimeout(function(){
        //         $(".leaflet-tooltip").css("opacity", "1");  
                
        // },1000);
        //map.setView(new L.LatLng(centerLat, centerLng), zoom);
                // if(latlngs.length > 0){
                //     map.fitBounds(latlngs);
                // }

                map.eachLayer(function (marker) {
             var tooltip = marker.getTooltip();
                marker.unbindTooltip();
                //tooltip.options.permanent = false;
                //marker.bindTooltip(tooltip);
                //$(".stationary").hide();
        //modalmap.removeLayer(layer);
        if(marker.stationary != "undefined" || marker.stationary == 0 || marker.stationary == 1){
                marker.bindTooltip(tooltip);
            }else{
                marker.unbindTooltip();
            }
         });
         $(".stationary").hide();
    }else if(btntext == "Hide Details"){
        $(".Tooltip").css("top","20px");
        //$(".Tooltip").css("margin-top","35px");
        $(".Tooltip").css("width","170px");
        $(".smalltooltip").hide();
         $(".Tooltip").hide();
        $(".owntooltip").hide();
        $(".stationary").hide();
        $("#HideDetails").text("Show Details");
        $(".acti-count-onmarker").hide();
        $('#map .text-below-marker').each(function(i, obj) {
            var t = $(this).find('.acti-count-onmarker').text();
            //console.log(t);
            if(t > 0){
                $(this).find('.acti-count-onmarker').show();
            }else{
                $(this).find('.acti-count-onmarker').hide();
            }
        
        });

        map.eachLayer(function (marker) {
            var tooltip = marker.getTooltip();
            marker.unbindTooltip();
            //tooltip.options.permanent = true;
            
            //console.log(marker.stationary);
            if(marker.stationary != "undefined" || marker.stationary == 0 || marker.stationary == 1){
                marker.bindTooltip(tooltip);
            }else{
                marker.unbindTooltip();
            }
            //$(".stationary").hide();
        //modalmap.removeLayer(layer);
        });

        $(".stationary").hide();
        // $(".leaflet-tooltip").css("opacity", "0");  
        // setTimeout(function(){
        //         $(".leaflet-tooltip").css("opacity", "1");  
                
        // },1000);

        // map.setView(new L.LatLng(centerLat, centerLng), zoom);
        //         if(latlngs.length > 0){
        //             map.fitBounds(latlngs);
        //         }

    }
    
    
});

$(document).on("click", "#HelpfulTips", function(e) {
    mapClickEvent = false; // this is for condition to disable the map click function

            openhelpmodal();
});

function openhelpmodal(e){
    $('#mapquestionmodal').show();
}

$(document).on("click", ".mapquestionmodalclose", function(e) {
    $('#mapquestionmodal').hide();
});


/***********************************************Help icon************/

/***********************************On clicking marker tooltip open modal of that specific marker */
// added the custom classname to marker and id to tooltip and then onclicking the tooltip found that id and matches with marker classname.
// then opened the modal using same markerclick function
if(markerCount > 0){
$('#map .leaflet-marker-icon').each(function(i, obj) {
   
    if(!$(this).hasClass('text-below-marker')){
        $(this).addClass('myownmarker'+i);
    }
    
});

// created the day numbers as separated marker label and assign the row id only to markers 
// For numbers added the attr, on clicking the number on marker icon calling the same marker click function attr id.
var z = 0
$('#map .leaflet-marker-icon').each(function(i, obj) {
   
   if($(this).hasClass('text-below-marker')){
       $(this).attr('data-markerid', z);
       z++;
   }
   
});

/******************************************* */
<?php 
if(isset($crusemaparray) && !empty($crusemaparray)){
    foreach($crusemaparray as $key => $val){ ?>

    $('#<?php echo $val; ?> .leaflet-marker-icon').each(function(i, obj) {
    
    if(!$(this).hasClass('text-below-marker-locsch')){
        $(this).addClass('mylocsh'+"<?php echo $key; ?>");
    }
    
    });

<?php } } ?>

/****************************************** */
}
$(document).on("click", ".Tooltip", function(e) {
    var myowntooltip = $(this).find('.owntooltip').attr('id');
    $(".myownmarker"+myowntooltip).click();
    
});

$(document).on("click", "#map .text-below-marker", function(e) {
    var myowntooltip = $(this).attr('data-markerid');
    $(".myownmarker"+myowntooltip).click();
    
});

$(document).on("click", ".CSMPTooltip", function(e) {
    var myowntooltip = $(this).find('.CSMPown').attr('id');
    $(".mylocsh"+myowntooltip).click();
    
});


/***********************************On clicking marker tooltip open modal of that specific marker */
var mapmarkerglobalObj = null;
var fitzoommap = [];
var globallocationInSamedayCount = 0;

var routeexists;
var ModalMapsinglemarkerlat;
var ModalMapsinglemarkerlong;
var ActivityData = '';
var ScheduleDataResult = '';
var resizeflagiti = true;
function markerOnClick(e) {
    mapmarkerglobalObj = e;
    console.log(e);
    var scheduleUUId = e.target.scheduleUUId;
    var scheduleId = e.target.scheduleId;
    var markerNum = e.target.markerNum;
    var lattitude = e.latlng.lat;
    var longitude = e.latlng.lng;
    var consumptiontotal = e.target.consumptiontotal;
    var distancetotal = e.target.distancetotal;
    var durationtotal = e.target.durationtotal;
    // console.log(lattitude);
    // console.log(longitude);
    var day_dates = e.target.day_dates;
    var tablepId = e.target.tablepId;

    var counttitle = e.target.counttitle;
    var daytitle = e.target.day_to_location;
    var scheduleSameLocationUUID = e.target.scheduleSameLocationUUID;
    var samelocationsDates = e.target.samelocationsDates;
    var stationary = e.target.stationary;
    var stationarytooltipnum = e.target.stationarytooltipnum;

    var endmarkerOrnot = e.target.endmarker;
if(e.target.firstdaytoloc){
    var firstdaytoloc = e.target.firstdaytoloc;
    var fromstartloc = e.target.fromstartloc;
}

    var serial_no = e.target.serial_no;
    var stationary_val = e.target.stationary;

    var row_from_distance = e.target.row_from_distance;
    var row_from_duration = e.target.row_from_duration;
    var row_from_lat = e.target.row_from_lat;
    var row_from_long = e.target.row_from_long;
    lattitude = row_from_lat;
    longitude = row_from_long;
    distancetotal = row_from_distance;
    durationtotal = row_from_duration;
    var donotOpenitinearymodalFlag = e.target.donotOpenitinearymodalmorethanoneday;
    
     //console.log(day_dates);

     //console.log(stationarytooltipnum);

    //$(".Tooltip").hide();
    $('.Tooltip').css('top','');
    if(stationary == 0 && donotOpenitinearymodalFlag == 1){
        stationary = 1;
        stationarytooltipnum = parseFloat(stationarytooltipnum) + 1;
        //console.log(stationarytooltipnum);
    }
    if(stationary == 1){
        $('.Tooltip').css('top','');
        // var szoom = map.getZoom();
        // //alert(szoom+1);
        // szoom = szoom+1;
        // map.setView(new L.LatLng(lattitude, longitude), szoom);
        // if(latlngs.length > 0){
        //     map.fitBounds(latlngs);
        // }
        var css_property =
        {
            "position": "absolute",
            "top": "-40px",
            "background-color": "#fff",
            "border": "1px solid #fff",
            "border-radius": "3px",
            "padding": "6px",
            "width": "170px",
            "left": "0px",
        }

        $(".stationary").css(css_property);
        clickedstationary = stationarytooltipnum;
        
        $(".owntooltip").hide();
        $(".smalltooltip").hide();
        $(".Tooltip").hide();
        $(".stationarytooltip"+stationarytooltipnum).show();
        $(".stationarytooltip"+stationarytooltipnum).find(".stationary").show();
        return false;
    }
    if (scheduleId != "") {
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: basefolder+"/"+"charters/editCharterProgramSchedules",
            dataType: 'json',
            data: { "programId": scheduleId,"scheduleId":scheduleUUId,"tablepId":tablepId ,"diffDays": <?php echo $diffDays; ?>, "markerNum": markerNum, "lattitude": lattitude, "longitude": longitude,"guesttype":guesttype,"counttitle":counttitle, "daytitle":daytitle, "scheduleSameLocationUUID":scheduleSameLocationUUID, "samelocationsDates":samelocationsDates, "from":'locationcard',"firstdaytoloc":firstdaytoloc,"allow_comments":allow_comments },
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    var width = $(window).width();
                    $(".leaflet-control-attribution").hide();
                    $("#CruisingButton").hide();
                    $("#HideDetails").hide();
                    $("#HelpfulTips").hide();
                    $("#WeatherMap").hide();
                    $("#GuestNews").hide();
                     $("#map .leaflet-control-container").hide();
                    // open popup center to map
                    //map.setView(e.latlng);
                    //modalmap.setView(e.latlng);
                    //fitzoommap = [];
                    var popLocation= e.latlng;
                    ActivityData = result.activityData;
                    ScheduleDataResult = result.scheduleData;
                //setTimeout(function() {
                    // var popup = L.popup({
                    //     autoPan: true
                    //     // closeOnClick: false,
                    //     // autoClose: false
                    //     })
                    // .setLatLng(popLocation)
                    // .setContent(result.popupHtml)
                    // .openOn(map)
                    //     .on("remove", function () {
                    //         msgcount(scheduleSameLocationUUID);
                    //         $(".leaflet-control-attribution").show();
                    //         $("#CruisingButton").show();
                    //         $("#HideDetails").show();
                    //         $("#HelpfulTips").show();
                    //         $(".leaflet-control-container").show();

                    //         //for screenview <990 on opening the itinerary modal blacked out the map region
                    //         // on close modal removed the blacked out css
                    //         customMediaQueryRemove();
                            
                            
                    //     }); 
                        $("#markerModal_load").html(result.popupHtml);
                        
                        $("#markerModalclose").attr("data-schuuid",scheduleSameLocationUUID);
                        $("#markerModal").show();
                        $(".markmodalbody").scrollTop(0);
                       // update_mapContainer();

                              // get all the text area elements
                        var textareas = document.querySelectorAll(".auto_resize");

                        // function to adjust the height of a text area based on its contents
                        function adjustTextareaHeight(textarea) {
                        textarea.style.minHeight = textarea.style.height;
                        textarea.style.height = "auto";
                        textarea.style.height = textarea.scrollHeight + "px";
                        }

                        // loop over all the text areas and call the adjustTextareaHeight function for each one
                        for (var i = 0; i < textareas.length; i++) {
                        var textarea = textareas[i];
                        adjustTextareaHeight(textarea);
                        textarea.addEventListener("input", function() {
                            adjustTextareaHeight(textarea);
                        });
                        }

                        // Display the map tiles fully loaded in map containers on each row
                        console.log(resizeflagiti);

                    //if(resizeflagiti){  
                            setTimeout(function () {
                            window.dispatchEvent(new Event("resize"));
                            //resizeflagiti=false;  
                            }, 100);
                        //}
                        
                    // display popup from top
                    window.scrollTo(0, 0);
                    //$('.day_dates').text(day_dates);
                    $('.noofdayscard').html(result.no_of_days_options);
                    
                    if(result.modaldisplayDate){
                        var dateformarker = result.modaldisplayDate;
                        $(".charter_from_date_conv").text(dateformarker);
                    }

                    lattitude = result.row_from_lattitude;
                    longitude = result.row_from_longitude;
                    //alert(width);
                    //for screenview <990 on opening the itinerary modal blacked out the map region
                    // on close modal removed the blacked out css
                    if(width<990){
                        customMediaQueryAdd();
                        
                    }else if(width>990){
                        customMediaQueryRemove();
                    }
                //}, 1000);
                    $(".leaflet-popup-close-button").addClass('updateCommentscount');
                   // alert(day_dates);
                    
                     // to get reduce msgcount
                     /* $(popup._closeButton).one('click', function(e){
                        msgcount();
                    }); */

                    

                    /////////////////////////////itineray modal map///////////////////////////////////////////////////

                                ReloadModalMaplayer();
                                //var popLocation = e.latlng;
                                var tooltipcontent = e.target._tooltip._content;
                                var selectedmarkertitle = e.target.daytitle;
                                var selectedmarkerday_num = e.target.day_num;
                                //console.log(popLocation);
                                fitzoommap.push(popLocation);
                                if (markerArray.length > 0) {
                                        $('.markersnamesmodalmap').find('option').remove();
                                        $('.markersnamesmodalmap').append($("<option></option>")
                                            .attr("value", "")
                                            .text("Select")
                                        );
                                        var temptitle = [];                        
                                                    $.each(markerArray, function(key, value) {   
                                                        
                                                        //if(jQuery.inArray(value.daytitle, temptitle) !== -1){
                                                            
                                                        //}else{

                                                            if(value.day_to_location){
                                                                    var vvd = value.day_to_location.trim();
                                                                    var valTitle = vvd.replaceAll('"', '').replaceAll("'", '');
                                                            }else{
                                                                var valTitle = "";
                                                            }

                                                                $('.markersnamesmodalmap')
                                                                    .append($("<option></option>")
                                                                        .attr("id", "marker_" + value.scheduleId)
                                                                        .attr("data-lat", value._latlng.lat)
                                                                        .attr("data-long", value._latlng.lng)
                                                                        .attr("data-schid", value.scheduleId)
                                                                        .attr("data-daynum", value.day_num)
                                                                        .attr("value", valTitle +' - Day '+value.day_num)
                                                                        .text(valTitle +' - Day '+value.day_num)
                                                                    );
                                                                    //temptitle.push(value.daytitle);
                                                        //}

                                        });
                                    }

                                // $("#frommarker").val(selectedmarkertitle +' - Day '+selectedmarkerday_num);
                                // $("#frommarkerlat").val(lattitude);
                                // $("#frommarkerlong").val(longitude);
                                if(endmarkerOrnot == "yes"){
                                    distancetotal = "";
                                    durationtotal = "";
                                }
                                if(firstdaytoloc){
                                    selectedmarkertitle = fromstartloc;
                                    lattitude = embark_lat;
                                    longitude = embark_long;
                                }

                                $(".markerdistance").text(distancetotal);
                                $(".markerduration").text(durationtotal);
                                
                                //$(".markerconsumption").text(consumptiontotal);
                                if(serial_no < 2 && stationary_val == 0 && selectedmarkerday_num != 1){
                                    selectedmarkerday_num = selectedmarkerday_num - 1;
                                }
                                var selectedmarkertitleV = selectedmarkertitle;
                                ModalMapsinglemarkerlat = lattitude;
                                ModalMapsinglemarkerlong = longitude;
                                var vvs = selectedmarkertitleV.trim();
                                var selectedmarkertitleV = vvs.replaceAll('"', '').replaceAll("'", '');
                                if(stationary_val == 1){
                                    selectedmarkertitleV = '';
                                }
                                var frommarker = selectedmarkertitleV +' - Day '+selectedmarkerday_num; //alert('llll')
                                $("#embarkation").text(selectedmarkertitle); 
                                routeexists = 1;
                                if(endmarkerOrnot == "yes"){
                                    frommarker = "";
                                }
                                drawrouteinmodal(frommarker);
                              
                                // console.log(selectedmarkertitle);
                                //modalmap.fitBounds(fitzoommap);
                                //modalmap.setView(new L.LatLng(lattitude,longitude), 7);
                                //modalmap.panBy([0,0]);
                                // console.log(lattitude);  
                                // console.log(longitude);  
                                setTimeout(() => {
                                    modalmap.invalidateSize();
                                }, 0);
                                $("#modalmap").find('.leaflet-control-attribution').hide();
                                var myIcon = L.icon({
                                iconUrl: Wmarker,
                                iconSize: [25, 41],
                                className:'myIconClass',
                            });
                                var routemodalmarker = L.marker([lattitude, longitude], {
                                    draggable: false,
                                    pmIgnore: true,
                                    icon:myIcon
                                }).bindTooltip(tooltipcontent, {
                                    permanent: true,
                                    direction: 'right',
                                    className: "Tooltipmodalmap",
                                    noWrap: false,
                                });
                                routemodalmarker.addTo(modalmap);
                                if(selectedmarkerday_num < 10 ){
                                    newdaycount="<span>&nbsp;"+selectedmarkerday_num+"</span>";
                                }
                                else{
                                     newdaycount="<span>"+selectedmarkerday_num+"</span>";
                                }
                                var textMarkermodalmap = L.marker([lattitude,longitude], {
                                icon: L.divIcon({
                                    html: newdaycount,
                                    className: 'text-below-marker-modalmap',
                                    })
                                }).addTo(modalmap);

                                 $(".Tooltipmodalmap").hide();
                    ////////////////////////////////////////////////////////////////////////////////
                    
                    
                }
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    }
        
}
       

$(document).on("change", ".markersnamesmodalmap", function(e) {
    var routemodalmarkerselected = {};
        var textMarkermodalmap = {};
        var selectedlat = "";
        var selectedlong = "";
        var fmlong;
        var fmlat;
        var modalmapdaynumber = "";
        var defaultline = {};
        var selectedmarkertooltipcontent = "";
        
    selectedTitle = $(this).val();
    //alert(selectedTitle);
    //console.log(selectedTitle);
    if (selectedTitle != "") {
        selectedlat = $(".markersnamesmodalmap option:selected").attr("data-lat");
        selectedlong = $(".markersnamesmodalmap option:selected").attr("data-long");
        var schid = $(".markersnamesmodalmap option:selected").attr("data-schid");
        var modalmapdaynumber = $(".markersnamesmodalmap option:selected").attr("data-daynum");
        
        //console.log(markerArray);  //return false;
        
        const selectedTitleFrom = selectedTitle.split("-");
        //console.log(selectedTitleFrom);
        let selectedTitleFromWord = $.trim(selectedTitleFrom[0]);
        $.each(markerArray, function(i, val) {
            // console.log("val.daytitle ==="+val.daytitle);
            // console.log("selectedTitleFromWord ==="+selectedTitleFromWord);
            //console.log(val);
            // if ((val.daytitle == selectedTitleFromWord) ) {
            //     //console.log('kkk');
            //     //selectedmarkertooltipcontent = val._tooltip._content;
            //     selectedlat = val._latlng.lat;
            //     selectedlong = val._latlng.lng;
            //     modalmapdaynumber = val.day_num;
            //     fitzoommap.push(val._latlng);
            //     //return false;
            // }

            if (val.scheduleId == schid) {
                selectedmarkertooltipcontent = val._tooltip._content;
                fitzoommap.push(val._latlng);
            }

        });

        // console.log(routemodalmarkerselected); 
        //  console.log(selectedlat);  
        //  console.log(selectedlong);  
        if (routemodalmarkerselected != "") { //alert();
            modalmap.removeLayer(routemodalmarkerselected);
        }
        if (textMarkermodalmap != "") { //alert();
            modalmap.removeLayer(textMarkermodalmap);
        }
        var myIcon = L.icon({
                                iconUrl: Wmarker,
                                iconSize: [25, 41],
                                className:'myIconClass',
                            });
        routemodalmarkerselected = L.marker([selectedlat,selectedlong], {
            draggable: false,
            pmIgnore: true,
            icon:myIcon
        });
        // .bindTooltip(selectedmarkertooltipcontent, {
        //     permanent: true,
        //     direction: 'right',
        //     className: "Tooltipmodalmap",
        //     noWrap: false,
        // });
        routemodalmarkerselected.addTo(modalmap);
        // adding day number to marker
        if(modalmapdaynumber < 10 ){
                        newdaycount="<span>&nbsp;"+modalmapdaynumber+"</span>";
                    }
                    else{
                        newdaycount="<span>"+modalmapdaynumber+"</span>";
                    }
        textMarkermodalmap = L.marker([selectedlat,selectedlong], {
        icon: L.divIcon({
            html: newdaycount,
            className: 'text-below-marker-modalmap',
            })
        });
        textMarkermodalmap.addTo(modalmap);
        
        // by default selecting the to location display the route line
        // if(routeexists == 0){
        //     if (defaultline != "") { //alert();
        //         modalmap.removeLayer(defaultline);
        //     }
        //         fmlat =  $("#frommarkerlat").val();
        //         fmlong = $("#frommarkerlong").val();

        //     var origin = new L.LatLng(fmlat, fmlong);
        //     var dest = new L.LatLng(selectedlat, selectedlong);
        //     defaultline = L.polyline([origin, dest]);
        //     defaultline.addTo(modalmap);
        // }

        //modalmap.fitBounds(fitzoommap);
        //modalmap.setView(new L.LatLng(selectedlat,selectedlong), 4);

        // setTimeout(() => {
        //     modalmap.invalidateSize();
        // }, 0);

        //$(".Tooltipmodalmap").hide();
    }

    
});





// Closing the popup
$(document).on("click", "#markerModalclose", function(e) {
   
   var schuuid =  $(this).attr("data-schuuid");
   markerModalclose(schuuid);
});

function markerModalclose(scheduleSameLocationUUID){
    msgcount(scheduleSameLocationUUID);
                            $("#markerModal").hide();
                            $("#map .leaflet-control-attribution").show();
                            $("#CruisingButton").show();
                            $("#HideDetails").show();
                            $("#HelpfulTips").show();
                            $("#WeatherMap").show();
                            $("#GuestNews").show();
                            $("#map .leaflet-control-container").show();

                            //for screenview <990 on opening the itinerary modal blacked out the map region
                            // on close modal removed the blacked out css
                            customMediaQueryRemove();

                            // Removed the layer on close the route modal to clear any changes done and not saved.
                            modalmap.eachLayer(function (layer) {
                                modalmap.removeLayer(layer);
                            });
}

$(document).on("click", ".stationarydays", function(e) {
    var scheduleUUId = mapmarkerglobalObj.target.scheduleUUId;
    var scheduleId = mapmarkerglobalObj.target.scheduleId;
    var tablepId = mapmarkerglobalObj.target.tablepId;
    var counttitle = mapmarkerglobalObj.target.counttitle;
    var daytitle = mapmarkerglobalObj.target.daytitle;
    var scheduleSameLocationUUID = mapmarkerglobalObj.target.scheduleSameLocationUUID;
    var samelocationsDates = mapmarkerglobalObj.target.samelocationsDates;

    var markerNum = mapmarkerglobalObj.target.markerNum;
    var lattitude = mapmarkerglobalObj.latlng.lat;
    var longitude = mapmarkerglobalObj.latlng.lng;
    var consumptiontotal = mapmarkerglobalObj.target.consumptiontotal;
    var distancetotal = mapmarkerglobalObj.target.distancetotal;
    var durationtotal = mapmarkerglobalObj.target.durationtotal;

   var selectedschuuid = $(this).attr('id');
   var selecteddaynumstationary = $(this).attr('data-num');
   var datastationaryOrnot = $(this).attr('data-stat');
   var datastatdate = $(this).text();

   var splitdaydate = datastatdate.split('Day '+selecteddaynumstationary)
   var daydisplayno = splitdaydate[1];
   var serial_no = mapmarkerglobalObj.target.serial_no;
    var stationary_val = mapmarkerglobalObj.target.stationary;

    var row_from_distance = mapmarkerglobalObj.target.row_from_distance;
    var row_from_duration = mapmarkerglobalObj.target.row_from_duration;
    var row_from_lat = mapmarkerglobalObj.target.row_from_lat;
    var row_from_long = mapmarkerglobalObj.target.row_from_long;
    //console.log(row_from_lat);
    lattitude = row_from_lat;
    longitude = row_from_long;
    distancetotal = row_from_distance;
    durationtotal = row_from_duration;

   //var selecteddatetext = $(".noofdayscard option:selected").text();
   var yachtId = $("#yachtId").val();

   var endmarkerOrnot = mapmarkerglobalObj.target.endmarker;

   $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: basefolder+"/"+"charters/editCharterProgramSchedules",
            dataType: 'json',
            data: {"programId":scheduleId,"tablepId":tablepId ,"scheduleId": selectedschuuid, "diffDays": <?php echo $diffDays; ?>, "yachtId": yachtId,"counttitle":counttitle, "daytitle":daytitle, "scheduleSameLocationUUID":scheduleSameLocationUUID, "samelocationsDates":samelocationsDates, "from":'daysselection','selecteddatetext':"" },
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    var width = $(window).width();

                    $(".leaflet-control-attribution").hide();
                    $("#CruisingButton").hide();
                    $("#HideDetails").hide();
                    $("#HelpfulTips").hide();
                    $("#WeatherMap").hide();
                    $("#GuestNews").hide();
                     $("#map .leaflet-control-container").hide();
                    // open popup center to map
                    //console.log(mapmarkerglobalObj);
                    //map.setView(mapmarkerglobalObj.latlng);
                    var popLocation= mapmarkerglobalObj.latlng;
                    //setTimeout(function() {
                    // var popup = L.popup({
                    //     autoPan: true
                    //     })
                    // .setLatLng(popLocation)
                    // .setContent(result.popupHtml)
                    // .openOn(map)
                    // .on("remove", function () {
                    //         msgcount(scheduleSameLocationUUID);
                    //         //for screenview <990 on opening the itinerary modal blacked out the map region
                    //         // on close modal removed the blacked out css
                    //         customMediaQueryRemove();
                    //     });

                        $("#markerModal_load").html(result.popupHtml);
                        
                        $("#markerModalclose").attr("data-schuuid",scheduleSameLocationUUID);
                        $("#markerModal").show();
                        $(".markmodalbody").scrollTop(0);

                         // get all the text area elements
                         var textareas = document.querySelectorAll(".auto_resize");

                        // function to adjust the height of a text area based on its contents
                        function adjustTextareaHeight(textarea) {
                        textarea.style.minHeight = textarea.style.height;
                        textarea.style.height = "auto";
                        textarea.style.height = textarea.scrollHeight + "px";
                        }

                        // loop over all the text areas and call the adjustTextareaHeight function for each one
                        for (var i = 0; i < textareas.length; i++) {
                        var textarea = textareas[i];
                        adjustTextareaHeight(textarea);
                        textarea.addEventListener("input", function() {
                            adjustTextareaHeight(textarea);
                        });
                        }

                        setTimeout(function () {
                        window.dispatchEvent(new Event("resize"));
                        //resizeflag=false;  
                        }, 100);

                        window.scrollTo(0, 0);
                        //$('.day_dates').text(day_dates);
                        $('.noofdayscard').html(result.no_of_days_options);

                       if(result.modaldisplayDate){
                            var dateformarker = result.modaldisplayDate;
                            $(".charter_from_date_conv").text(dateformarker);
                        }else{
                            $(".charter_from_date_conv").text(daydisplayno);
                        }

                        //alert(width);
                        //for screenview <990 on opening the itinerary modal blacked out the map region
                        // on close modal removed the blacked out css
                        if(width<990){
                            customMediaQueryAdd();
                            
                        }else if(width>990){
                            customMediaQueryRemove();
                        }
                    //}, 1000);
                    $(".leaflet-popup-close-button").addClass('updateCommentscount');

                    /////////////////////////////itineray modal map///////////////////////////////////////////////////

                    ReloadModalMaplayer();
                                //var popLocation = e.latlng;
                                var tooltipcontent = mapmarkerglobalObj.target._tooltip._content;
                                var selectedmarkertitle = mapmarkerglobalObj.target.daytitle;
                                var selectedmarkerday_num = mapmarkerglobalObj.target.day_num;
                                //console.log(popLocation);
                                console.log(selectedmarkertitle);
                                fitzoommap.push(popLocation);
                                if (markerArray.length > 0) {
                                        $('.markersnamesmodalmap').find('option').remove();
                                        $('.markersnamesmodalmap').append($("<option></option>")
                                            .attr("value", "")
                                            .text("Select")
                                        );
                                        var temptitle = [];                        
                                                    $.each(markerArray, function(key, value) {   
                                                        
                                                        
                                                            if(datastationaryOrnot == 1 && selecteddaynumstationary == value.day_num){
                                                                selectedmarkertitle = value.daytitle;
                                                                selectedmarkerday_num = value.day_num;
                                                                lattitude = value._latlng.lat;
                                                                longitude = value._latlng.lng;
                                                                scheduleId = value.scheduleId;
                                                                distancetotal = value.distancetotal;
                                                                durationtotal = value.durationtotal;
                                                            } 
                                                        

                                                                $('.markersnamesmodalmap')
                                                                    .append($("<option></option>")
                                                                        .attr("id", "marker_" + value.scheduleId)
                                                                        .attr("data-lat", value._latlng.lat)
                                                                        .attr("data-long", value._latlng.lng)
                                                                        .attr("data-schid", value.scheduleId)
                                                                        .attr("data-daynum", value.day_num)
                                                                        .attr("value", value.day_to_location +' - Day '+value.day_num)
                                                                        .text(value.day_to_location +' - Day '+value.day_num)
                                                                    );
                                                                    //temptitle.push(value.daytitle);
                                                        //}

                                        });
                                    }

                                // $("#frommarker").val(selectedmarkertitle +' - Day '+selectedmarkerday_num);
                                // $("#frommarkerlat").val(lattitude);
                                // $("#frommarkerlong").val(longitude);

                                selectedmarkertitle = result.row_from_title;
                                //var row_from_to_location = result.row_from_to_location;
                                stationary_val = result.row_from_stationary;
                                serial_no = result.row_from_serial_no;
                                //stationary_val = result.row_from_stationary;
                                lattitude = result.row_from_lattitude;
                                longitude = result.row_from_longitude;

                                //console.log(lattitude);
                                //console.log(longitude);

                                distancetotal = result.row_from_dis;
                                durationtotal = result.row_from_dur;
                                if(stationary_val == 1){
                                    distancetotal = "";
                                    durationtotal = "";
                                }


                                $(".markerdistance").text(distancetotal);
                                $(".markerduration").text(durationtotal);
                                  //selectedmarkerday_num = selecteddaynumstationary;
                                if(serial_no < 2 && stationary_val == 0 && selecteddaynumstationary != 1){
                                    selecteddaynumstationary = selecteddaynumstationary - 1;
                                }

                                //$(".markerconsumption").text(consumptiontotal);
                                ModalMapsinglemarkerlat = lattitude;
                                ModalMapsinglemarkerlong = longitude;
                                var vvs = selectedmarkertitle.trim();
                                var valTitle = vvs.replaceAll('"', '').replaceAll("'", '');
                                var frommarker = valTitle +' - Day '+selecteddaynumstationary; //alert('llll')
                                console.log(frommarker);
                                $("#embarkation").text(valTitle); 
                                routeexists = 1;
                                if(stationary_val == 1){
                                    frommarker = "";
                                }
                                drawrouteinmodal(frommarker);
                              
                                // console.log(selectedmarkertitle);
                                //modalmap.fitBounds(fitzoommap);
                                //modalmap.setView(new L.LatLng(lattitude,longitude), 7);
                                //modalmap.panBy([0,0]);
                                // console.log(lattitude);  
                                // console.log(longitude);  
                                // setTimeout(() => {
                                //     modalmap.invalidateSize();
                                // }, 0);
                                $("#modalmap").find('.leaflet-control-attribution').hide();
                                var myIcon = L.icon({
                                iconUrl: Wmarker,
                                iconSize: [25, 41],
                                className:'myIconClass',
                            });
                                var routemodalmarker = L.marker([lattitude, longitude], {
                                    draggable: false,
                                    pmIgnore: true,
                                    icon:myIcon
                                }).bindTooltip(tooltipcontent, {
                                    permanent: true,
                                    direction: 'right',
                                    className: "Tooltipmodalmap",
                                    noWrap: false,
                                });
                                routemodalmarker.addTo(modalmap);
                                if(selecteddaynumstationary < 10 ){
                                    newdaycount="<span>&nbsp;"+selecteddaynumstationary+"</span>";
                                }
                                else{
                                     newdaycount="<span>"+selecteddaynumstationary+"</span>";
                                }
                                var textMarkermodalmap = L.marker([lattitude,longitude], {
                                icon: L.divIcon({
                                    html: newdaycount,
                                    className: 'text-below-marker-modalmap',
                                    })
                                }).addTo(modalmap);

                                 $(".Tooltipmodalmap").hide();
                    ////////////////////////////////////////////////////////////////////////////////
                   
                    
                    //$('.expandField').autoResize();
                     
                }
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });

});

function drawrouteinmodal(frommarker) { //alert();
    console.log(frommarker);
modalmap.setView(new L.LatLng(ModalMapsinglemarkerlat, ModalMapsinglemarkerlong));

$("#debarkation").text('');

//console.log(modalrouteline);
var drawrouteline = [];
//var tempendloc = [];
var nextmarkername;
var toloc =  $(".markersnamesmodalmap").val();
routeexists = 0;
$.each(modalrouteline, function(name, value) {
        if (value.name == frommarker) {
            drawrouteline.push(value.index);
            //tempendloc.push(value.end_loc);
            nextmarkername = value.end_loc; 
            routeexists = 1;
        } 
});
console.log(nextmarkername);
//return false;
//console.log(drawrouteline);
if (nextmarkername != "undefined" && nextmarkername != "" && nextmarkername != null) { //alert();
    $(".markersnamesmodalmap").val(nextmarkername).trigger('change');
  // var returnvalue =  markersnamesmodalmap(nextmarkername);
   //if(returnvalue == 1){
    var tempdrawrouteline = [];
    
    $.each(modalrouteline, function(name, value) {
        //console.log(name);
        //console.log(value.end_loc);
        //console.log('kkkk')
            if (value.name == frommarker && value.end_loc == nextmarkername) {
                tempdrawrouteline.push(value.index);
                routeexists = 1;
            }
    });
    const myArrayFrom = frommarker.split("- Day");
    let fromword = myArrayFrom[0];
    const myArrayTo = nextmarkername.split("- Day");
    let toword = myArrayTo[0];
    $("#embarkation").text(fromword+' to '); 
    $("#debarkation").text(toword);
    var specificline = "";
        specificline = tempdrawrouteline;
    var drawnItemsModalMap = new L.FeatureGroup();
    var polyLayersModalMap = [];
    var polyline2 = new SmoothPoly(specificline, {stroke:true,snakingSpeed: 200,weight:2.5,dashArray: [5,5],color:'#fff',lineCap: "round",lineJoin: "round",smoothFactor: 5});

    polyLayersModalMap.push(polyline2)

    // Add the layers to the drawnItemsModalMap feature group 

    for (let layer of polyLayersModalMap) { //console.log(layer);
        drawnItemsModalMap.addLayer(layer);
    }
    
//onsole.log(drawnItemsModalMap);
setTimeout(() => {
    modalmap.fitBounds(drawnItemsModalMap.getBounds());
 
    modalmap.addLayer(drawnItemsModalMap);

    drawnItemsModalMap.snakeIn();
}, 100);
   
    setTimeout(() => {
        modalmap.invalidateSize();
    }, 0);
    
//}
    
}

}

$(document).on("change", ".noofdayscardFreezeCode", function(e) {
    var scheduleUUId = mapmarkerglobalObj.target.scheduleUUId;
    var scheduleId = mapmarkerglobalObj.target.scheduleId;
    var tablepId = mapmarkerglobalObj.target.tablepId;
    var counttitle = mapmarkerglobalObj.target.counttitle;
    var daytitle = mapmarkerglobalObj.target.daytitle;
    var scheduleSameLocationUUID = mapmarkerglobalObj.target.scheduleSameLocationUUID;
    var samelocationsDates = mapmarkerglobalObj.target.samelocationsDates;
   var selectedschuuid = $(this).val();
   var selecteddatetext = $(".noofdayscard option:selected").text();
   var yachtId = $("#yachtId").val();
   $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: basefolder+"/"+"charters/editCharterProgramSchedules",
            dataType: 'json',
            data: {"programId":scheduleId,"tablepId":tablepId ,"scheduleId": selectedschuuid, "diffDays": <?php echo $diffDays; ?>, "yachtId": yachtId,"counttitle":counttitle, "daytitle":daytitle, "scheduleSameLocationUUID":scheduleSameLocationUUID, "samelocationsDates":samelocationsDates, "from":'daysselection','selecteddatetext':selecteddatetext },
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    var width = $(window).width();
                    //console.log(mapmarkerglobalObj);
                    //map.setView(mapmarkerglobalObj.latlng);
                    var popLocation= mapmarkerglobalObj.latlng;
                    //setTimeout(function() {
                    // var popup = L.popup({
                    //     autoPan: true
                    //     })
                    // .setLatLng(popLocation)
                    // .setContent(result.popupHtml)
                    // .openOn(map)
                    // .on("remove", function () {
                    //         msgcount(scheduleSameLocationUUID);
                    //         //for screenview <990 on opening the itinerary modal blacked out the map region
                    //         // on close modal removed the blacked out css
                    //         customMediaQueryRemove();
                    //     });

                        $("#markerModal_load").html(result.popupHtml);
                        
                        $("#markerModalclose").attr("data-schuuid",scheduleSameLocationUUID);
                        $("#markerModal").show();
                        $(".markmodalbody").scrollTop(0);
                        window.scrollTo(0, 0);
                        //$('.day_dates').text(day_dates);
                        $('.noofdayscard').html(result.no_of_days_options);
                        //alert(width);
                        //for screenview <990 on opening the itinerary modal blacked out the map region
                        // on close modal removed the blacked out css
                        if(width<990){
                            customMediaQueryAdd();
                            
                        }else if(width>990){
                            customMediaQueryRemove();
                        }
                    //}, 1000);
                    $(".leaflet-popup-close-button").addClass('updateCommentscount');
                   
                    
                    $('.expandField').autoResize();
                     
                }
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });

});





// Closing the popup
$(document).on("click", "#closeSchedule", function(e) {
    //$(".leaflet-popup-close-button")[0].click();
    $("#markerModal").hide();
    $(".leaflet-control-attribution").show();
    $("#CruisingButton").show();
    $("#HideDetails").show();
    $("#HelpfulTips").show();
    $("#WeatherMap").show();
    $("#GuestNews").show();
    $("#map .leaflet-control-container").show();

    var schuuid =  $("#markerModalclose").attr("data-schuuid");
   markerModalclose(schuuid);

    //for screenview <990 on opening the itinerary modal blacked out the map region
    // on close modal removed the blacked out css
    var width = $(window).width();
    //alert(width);
        if(width<990){
            customMediaQueryRemove();
    }

});


var rowObj = null;
var titlerow = null;
$(document).on("click", ".notesmap", function(e) {
    rowObj = $(this);
    var notesval = $(this).attr('data-notes');
    //alert(notesval);
    $("#mapmessage").val(notesval);
    titlerow = 0;
    $('#mapnotemodal').show();
});


$(document).on("click", ".notesmaptitle", function(e) {
    rowObj = $(this);
    var notesval = rowObj.attr('data-notestitle');
    $("#mapmessage").val(notesval);
     titlerow = 1;
    $('#mapnotemodal').show();
});

$(document).on("click", ".mapnotemodalclose", function(e) {
    $('#mapnotemodal').hide();
    //mapNoteformclear();
});


$(document).ready(function() { //alert();
    //$ = jQuery.noConflict();
            $('.fancybox').fancybox({
                //maxWidth	: 400,
                //maxHeight	: 600,
                fitToView	: true,
                width		: '100%',
                height		: '100%',
                autoSize	: true,
                closeClick	: false,
                autoScale   : true,
                transitionIn : 'fade',
                transitionOut: 'fade',
                helpers: {
                        thumbs: {
                        width: 100,
                        height: 75,
                        source: function(image) {
                            return $(image.element).data("thumbnail");
                        }
                        }
                    },
                type : "image"
            });

            var topyname = $("#topyname").val();
            //setTimeout(function() {
                    $(".mappageProgramYname").text(topyname);
            //}, 100);

            //$('.fancybox').fancybox();

                $(".Tooltip").css("width","170px");
                $(".smalltooltip").hide();
                 $(".Tooltip").hide();
                $(".owntooltip").hide();
            //When page opens do not display location cards until 2 seconds after page loads. 
            //$(".leaflet-tooltip").css("opacity", "0");  
            //$('.fancybox').fancybox();

            // setTimeout(function(){
            //     $(".leaflet-tooltip").css("opacity", "1");  
                
            // },2000);

            //When page opens do not display location cards until 2 seconds after page loads. 

    $(".leaflet-control-attribution ").html(function(i, html) {
        return html.replace("|", "");
    });
    $('.leaflet-control-attribution ').find('a').remove();

     
    $("#windy").css("visibility","hidden");
    $("#closeWeatherMap").css("display","none");
    $("#showmenu").css("display","block");
   
    });

    var thisObj = null;
    var commenttitlecheck = null;
    $(document).on("click", ".crew_comment_cruisingmap" ,function() {
        //alert('jjj');
        thisObj = $(this);
        var activityId = thisObj.attr('data-rel');
        var activity_name = thisObj.attr('data-tempname');
        var yachtid = thisObj.attr('data-yachtid');
        //alert(activity_name);
        commenttitlecheck = 0;
        $.ajax({
                type: "POST",
                url: basefolder+"/"+"charters/getComments",
                dataType: 'json',
                data: {'activityId': activityId,'activity_name' : activity_name,'yachtid':yachtid,'type':'activity'},
                success:function(data) {
                    //console.log(data);
                    $('#crew_commentscruisingmsg').html(data.view);
                    $('.CruisingCommentSave').attr('data-id',data.activityId);
                    $('.CruisingCommentSave').attr('data-activity_name',data.activity_name);
                    $('.CruisingCommentSave').attr('data-UserType',data.UserType);
                    $('.CruisingCommentSave').attr('data-UserName',data.UserName);
                    $('.CruisingCommentSave').attr('data-type',data.type);
                    $('.CruisingCommentSave').attr('data-yachtid',yachtid);
                    
                   
                    $('#cruisingmsgmyModal').show();
                    $('#Cruising_crew_comment').val('');
                    $('.CruisingCommentMarkUnread').attr('data-id1',data.activityId);
                    $('.CruisingCommentMarkUnread').attr('data-tempname1',data.activity_name);
                    $('.CruisingCommentMarkUnread').attr('data-type1',data.UserType);
                    $('.CruisingCommentMarkUnread').attr('data-name1',data.UserName); 
                    $('.CruisingCommentMarkUnread').attr('data-chartertype1',data.type);
                    $('.CruisingCommentMarkUnread').attr('data-yachtid', yachtid);
                    //alert(data.isfleet);
                    $("#hideloader").hide();
                    //thisObj.css("color","green");
                    // var color = thisObj.css("color");
                    //     //alert(color);
                    //     var colorgreen = hexc(color);
                        
                    //     if(colorgreen == "#ff0000"){
                    //         thisObj.css("color","green");
                    //     }

                    //alert($('#CrewCommentSave').data('id'));
                     //$('#msgcountchange').html(data.msgcount[0]);
                }
       });
    });

    $(document).on("click", ".crew_comment_cruisingmaptitle", function() {
    //alert('jjj');
    thisObj = $(this);
    var activityId = thisObj.attr('data-rel');
    var activity_name = thisObj.attr('data-tempname');
    var yachtid = thisObj.attr('data-yachtid');
    //alert(activity_name);
    var charprogid = $('#charterprogramuuid').val();
    commenttitlecheck = 1;
    $.ajax({
        type: "POST",
        url: basefolder+"/"+"charters/getComments",
        dataType: 'json',
        data: {
            'activityId': activityId,
            'activity_name': activity_name,
            'charprogid': charprogid,
            'yachtid':yachtid,
            'type': 'schedule'
        },
        success: function(data) {
            //console.log(data);
            $('#crew_commentscruisingmsg').html(data.view);
            $('.CruisingCommentSave').attr('data-id', data.activityId);
            $('.CruisingCommentSave').attr('data-activity_name', data.activity_name);
            $('.CruisingCommentSave').attr('data-UserType', data.UserType);
            $('.CruisingCommentSave').attr('data-UserName', data.UserName);
            $('.CruisingCommentSave').attr('data-type', data.type);
            $('.CruisingCommentSave').attr('data-yachtid', yachtid);



            $('#cruisingmsgmyModal').show();
            $('#Cruising_crew_comment').val('');
            $('.CruisingCommentMarkUnread').attr('data-id1', data.activityId);
            $('.CruisingCommentMarkUnread').attr('data-tempname1', data.activity_name);
            $('.CruisingCommentMarkUnread').attr('data-type1', data.UserType);
            $('.CruisingCommentMarkUnread').attr('data-name1', data.UserName);
            $('.CruisingCommentMarkUnread').attr('data-chartertype1', data.type);
            $('.CruisingCommentMarkUnread').attr('data-yachtid', yachtid);
            //alert(data.isfleet);
            $("#hideloader").hide();
            //thisObj.css("color","green");
            // var color = thisObj.css("color");
            // //alert(color);
            // var colorgreen = hexc(color);
            // //alert(colorgreen);
            // if (colorgreen == "#ff0000") {
            //     thisObj.css("color", "green");
            // }
            //alert($('#CrewCommentSave').data('id'));
            //$('#msgcountchange').html(data.msgcount[0]);
        }
    });
});

$(document).on("click", "#CruisingCommentSave" ,function() {
        var saveobj = $(this);
        var activityId = saveobj.data('id');
        var activity_name = saveobj.data('activity_name');
        //alert(checklistName);
        var user_type = saveobj.data('UserType');
        var user_name = saveobj.data('UserName');
        var type = saveobj.data('type');
        var yachtid = saveobj.data('yachtid');

        var comments = $('#Cruising_crew_comment').val();

        //var new_activity = thisObj.find('.newactivityfield').val();
        //alert(new_activity); return false;
        $.ajax({
                type: "POST",
                dataType: 'json',
                url: basefolder+"/"+"charters/saveComments",
                data: {'activityId': activityId,'activity_name': activity_name,'user_type':user_type,'user_name':user_name, 'type':type,'comments':comments,'yachtid':yachtid},
                success:function(data) {
                    if(data.success == 'success'){
	                    $('#cruisingmsgmyModal').hide();
                        //saveobj.css("color","green");
                        thisObj.removeClass('fa-light');
                        thisObj.removeClass('fa');
                        if(data.facomment){
                            thisObj.addClass(data.facomment);
                        }
                        if(data.colorcode){
                            thisObj.css("color",data.colorcode);
                        }
                    }
                }
       }); 

    if(commenttitlecheck == 1){
        thisObj.find(".messagecommentstitle").val(comments);
    }else{
        thisObj.find(".messagecomments").val(comments);
    }
    $('#cruisingmsgmyModal').hide();

    });

    $(document).on("click", "#commentsmodal" ,function() {
        $('#cruisingmsgmyModal').hide();
    });

    
    //$( '.clickcommentdiv' ).on( 'click', function () {
$(document).on("click", ".clickcommentdiv", function() { 
    //alert('kkk');
    var clickcommentObj = $(this);
    var color = $(this).css("background-color");
            //alert(color);
    var yachtId = $("#yachtId").val();
    var selectedcomment = hexc(color);
    //console.log(selectedcomment);
    if (selectedcomment == "#e5f6fc") { //console.log('ll');
        $(this).css("background-color","#ffffff");
        $(this).removeClass('selectedcomment');
        var id = $(this).attr('id');
        var read = "read";
    }else{ console.log('gg');
        $(this).css("background-color","#e5f6fc");
        $(this).addClass('selectedcomment');
        var id = $(this).attr('id');
        var read = "unread";
    }

    //return false;
    var activityId = $(".CruisingCommentMarkUnread").data('id1');
    var activity_name = $(".CruisingCommentMarkUnread").data('tempname1');
    //alert(checklistName);
    var user_type = $(".CruisingCommentMarkUnread").data('type1');
    var user_name = $(".CruisingCommentMarkUnread").data('name1');
    var comments = $('#Cruising_crew_comment').val();
    var comm_id = $(".CruisingCommentMarkUnread").data('commentid');
    var chartertype1 = $(".CruisingCommentMarkUnread").data('chartertype1');


    $.ajax({
        type: "POST",
        dataType: 'json',
        url: basefolder+"/"+"charters/markSingleCommentUnread",
        data: {
            'primaryid': id,
            'read': read,
            'activityId': activityId,
            'userType': user_type,
            'user_name': user_name,
            'activity_name': activity_name,
            'comments': comments,
            'comment_id': comm_id,
            'chartertype1': chartertype1,
            'yachtId':yachtId
        },
        success: function(data) {
            if (data.success == 'success') {
                
                //comments icon color change in itinerary modal
                var primaryidscheck = [];
                $(".selectedcomment").each(function(){
                    primaryidscheck.push($(this).attr('id'));
                //alert($(this).attr('id'));
                });
                // thisObj.css("color","#000;");
                // var color = thisObj.css("color");
                // //alert(color);
                // var colorgreen = hexc(color);

                // if (colorgreen == "#ff0000") {
                //     thisObj.css("color", "#000;");
                // }
                if(primaryidscheck.length >= 1){
                    thisObj.css("color", "red");
                }else{
                    if(data.colorcode){
                        thisObj.css("color", data.colorcode);
                    }
                }
            }
        }
    });


});




function hexc(colorval) {
    var parts = colorval.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    delete(parts[0]);
    for (var i = 1; i <= 3; ++i) {
        parts[i] = parseInt(parts[i]).toString(16);
        if (parts[i].length == 1) parts[i] = '0' + parts[i];
    }
    color = '#' + parts.join('');

    return color;
}

    function msgcount(scheduleSameLocationUUID){
    //console.log(e);
    //var charterpgid = $(".mapPopup").attr('data-schuuid'); 
    var charterpgid = scheduleSameLocationUUID; 
    //alert(charterpgid);
    var yachtId = $("#yachtId").val();
    if(charterpgid){ //alert();
                    $("#hideloader").show();
                    var data = { "charterpgid": charterpgid,'yachtId':yachtId,'scheduleSameLocationUUID':scheduleSameLocationUUID};
                    $.ajax({
                    type: "POST",
                    url: basefolder+"/"+"charters/getIndividualmsgcountMarer",
                    dataType: 'json',
                    data: data,
                    success:function(result) {
                        $("#hideloader").hide();
                        var mcount = result.status;
                        console.log(mcount);
                        var schuuidtoupdateintooltip = result.schuuidtoupdateintooltip;
                        //console.log($("#"+schuuidtoupdateintooltip));
                        $("#"+schuuidtoupdateintooltip).text(mcount);
                        $("#"+schuuidtoupdateintooltip).css('display','inline-flex');
                        //$("#msgcountnotify").text(mcount);
                        if(mcount == 0){
                            $("#msgcountnotify").css('display','none');
                            $("#"+schuuidtoupdateintooltip).css('display','none');
                        }
                        $(".leaflet-popup-close-button").removeClass('updateCommentscount');
                    },
                    error: function(jqxhr) { 
                        $("#hideloader").hide();
                    }
                
                    }); 
                }
}
    
$(document).on("click", ".CruisingCommentMarkUnread" ,function() {
        var markunread = $(this);
        var activityId = markunread.data('id1');
        var activity_name = markunread.data('tempname1');
        //alert(checklistName);
        var user_type = markunread.data('type1');
        var user_name = markunread.data('name1');
        var comments = $('#Cruising_crew_comment').val();
        var comm_id = markunread.data('commentid');
        var chartertype1 = markunread.data('chartertype1');

        var yachtId = $("#yachtId").val();
        var primaryids = [];
$(".selectedcomment").each(function(){
    primaryids.push($(this).attr('id'));
   //alert($(this).attr('id'));
});
        //alert(templatechecklistId);
if(primaryids.length >= 1){ 
        $.ajax({
                type: "POST",
                dataType: 'json',
                url: basefolder+"/"+"charters/markCommentUnread",
                data: {'activityId': activityId,'userType': user_type,'user_name':user_name,'activity_name':activity_name, 'comments':comments,'comment_id':comm_id,'chartertype1':chartertype1,'yachtId':yachtId,'ids':primaryids},
                success:function(data) {
                    if(data.success == 'success'){
	                    $('#cruisingmsgmyModal').hide();
                        if(data.colorcode){
                            thisObj.css("color",data.colorcode);
                        }
                    
                    }
                }
       }); 
}else{
    alert("Please select the messages to mark unread.");
    return false;
}
    });

    var resizeflag = true;

    $(document).on("click", "#CruisingButton", function(e) {

var scheduleId = $("#charterProgramId").val();

$(".action-finishMode").click();
    $(".button-container").removeClass('active');
    $(".leaflet-control").removeClass('activeChild');

// $("#hideloader").show();
//     $.ajax({
//         type: "POST",
//         url: basefolder+"/"+"charters/getIpadViewCharterProgramSchedules_map",
//         dataType: 'json',
//         data: { "scheduleId": scheduleId},
//         success:function(result) {
//             $("#hideloader").hide();
//             if (result.status == 'success') {

//                 $("#cruisinglocationModal_load").html(result.popupHtml);
                $("#cruisinglocationModal").show();
                
                $(".csmp_body").scrollTop(0);
            
                      // get all the text area elements
var textareas = document.querySelectorAll(".auto_resize");

// function to adjust the height of a text area based on its contents
function adjustTextareaHeight(textarea) {
  textarea.style.minHeight = textarea.style.height;
  textarea.style.height = "auto";
  textarea.style.height = textarea.scrollHeight + "px";
}

// loop over all the text areas and call the adjustTextareaHeight function for each one
for (var i = 0; i < textareas.length; i++) {
  var textarea = textareas[i];
  adjustTextareaHeight(textarea);
  textarea.addEventListener("input", function() {
    adjustTextareaHeight(textarea);
  });
}

      // Display the map tiles fully loaded in crusing schedule modal small map containers on each row
      //if(resizeflag){  
            setTimeout(function () {
            window.dispatchEvent(new Event("resize"));
            //resizeflag=false;  
            }, 100);
        //}
   
                
                $(".leaflet-control-attribution").hide();
                $("#map .leaflet-control-container").hide();
                //$(".leaflet-popup-close-button").addClass('updateCommentscount');
                //$('.day_dates').text(day_dates);

                $("#closeSchedule").remove();
               // $(".crew_comment_cruisingmaptitle").remove();
                $(".crew_comment_cruisingmap").remove();
                $(".leaflet-popup-close-button").remove();
                 
    //         }
    //     },
    //     error: function(jqxhr) { 
    //         $("#hideloader").hide();
    //     }
    // });
  // move scroll to top
    $(".modal_load").scrollTop(0);

    var charterpgid = $("#charterProgramId").val();
    //alert(charterpgid);
    var yachtId = $("#yachtId").val();

    $("#hideloader").show();
$.ajax({
    type: "POST",
    url: basefolder+"/"+"charters/cruising_schedule_locations",
    dataType: 'json',
    data: { "programId": charterpgid,"yachtId":yachtId},
    success:function(result) {
        $("#hideloader").hide();
        //console.log(result);
        if (result.status == 'success') {
            var res = result.commentbadge;
            $.each(res, function(key, value) {
                    //console.log($(".sch_comment_"+key));
                    $(".sch_comment_"+key).removeClass('fa');
                    $(".sch_comment_"+key).removeClass('fa-light');
                    $(".sch_comment_"+key).addClass(value.facomment);
                    $(".sch_comment_"+key).css("color",value.colorcodetitle);

            });
            //alert(guesttype); alert(allow_comments);
            if(guesttype == "guest"){
                if(allow_comments != '' && allow_comments == 1){
                    $(".crew_comment_cruisingmaptitle").show();
                }else{
                    $(".crew_comment_cruisingmaptitle").hide();
                }
            }
           
        }
    }
});

});

$(document).on("click", "#cruisinglocationModalclose" ,function() {
  

        $('#cruisinglocationModal').hide();
        $("#map .leaflet-control-attribution").show();
        $("#map .leaflet-control-container").show();

        getmsgcountonclosecruisingschedulemodal();

        
    });

    function getmsgcountonclosecruisingschedulemodal(){
    //console.log(e);
    
    var charterpgid = $("#charterProgramId").val();
    //alert(charterpgid);
    var yachtId = $("#yachtId").val();
    if(charterpgid){
                    $("#hideloader").show();
                    var data = { "charterpgid": charterpgid,'yachtId':yachtId};
                    $.ajax({
                    type: "POST",
                    url: basefolder+"/"+"charters/getmsgcountonclosecruisingschedulemodal",
                    dataType: 'json',
                    data: data,
                    success:function(result) {
                        $("#hideloader").hide();
                        var mcount = result.count;
                        $.each(mcount, function(key, value) {

                            $("#"+key).text(value);
                            if (value == 0) {
                                $("#"+key).css('display', 'none');
                            }else{
                                $("#"+key).css('display', 'inline-flex');
                            }

                            });
                    },
                    error: function(jqxhr) { 
                        $("#hideloader").hide();
                    }
                
                    }); 
                }
}

    // $(document).on("focus", ".textareacont" ,function() {
     
    //     $(this).animate({
    //              height: "14em"
    //             }, 500);

    //             $(this).css({
    //                 overflow:"scroll"
    //             });
                
    // });

    // $(document).on("blur", ".textareacont" ,function() {
    //     $(this).animate({
    //              height: "7em"
    //             }, 500);

    //             $(this).css({
    //                 overflow:"scroll"
    //             });
    // });
    
        $(document).on("click", ".textareacontmarker" ,function() {
        
            var valuetxt = $(this).val();

            if(valuetxt != ""){
                    //console.log("webopen");
                    $(this).animate({
                            height: "14em"
                            }, 500);

                            $(this).css({
                                overflow:"scroll"
                            });
                }
                    
        });
   
    
        // $(document).on("mouseleave", ".textareacontmarker" ,function() {
        //     var valuetxt = $(this).val();

        //     if(valuetxt != ""){
        //             //console.log("llllllllllll");
        //             $(this).animate({
        //                     height: "7em"
        //             }, 500);

        //             $(this).css({
        //                 overflow:"scroll"
        //             });
        //     }
        // });

        $(document).on("click", function(event){
        if(!$(event.target).closest(".textareacontmarker").length){
            $(".textareacontmarker").animate({
                            height: "7em"
                    }, 500);

                    // $(".textareacontmarker").css({
                    //     overflow:"scroll"
                    // });
            
            
        }
    });
    
    $(document).on("click", "#MenuHowToVideo", function(e) {   
  $("#howtovideo").show();
  
       $("#sidebar-btn").click();
           
           // $('#content').off();
        //toggleMenu();
    

});

$(document).on("click", "#MenuHowToVideoCharterHead", function(e) { 
  $("#howtovideocharterhead").show();
  
       $("#sidebar-btn").click();
            
           // $('#content').off();
        //toggleMenu();
    

});
$(document).on("click", ".close", function(e) { 
    $("#howtovideo").hide();
    $("#howtovideocharterhead").hide();
});

function customMediaQueryRemove(){
        $("#map .leaflet-tile-pane").css({
                "display":""
        });
        $("#map .leaflet-overlay-pane").css({
            "display":""
        });
        $("#map .leaflet-marker-pane").css({
                "display":""
        });
        $("#map .leaflet-tooltip-pane").css({
                "display":""
        });
        $("#map .leaflet-container").css({
                "background-color":""
        });
    }
function customMediaQueryAdd(){
    $("#map .leaflet-tile-pane").css({
            "display":"none"
    });
    $("#map .leaflet-overlay-pane").css({
            "display":"none"
    });
    $("#map .leaflet-marker-pane").css({
            "display":"none"
    });
    $("#map .leaflet-tooltip-pane").css({
            "display":"none"
    });
    $("#map .leaflet-container").css({
            "background-color":"#000"
    });
}


$(document).on("click", ".downloadmappagefile", function(e) { //alert()
      var downloadcontractfile = $(this).attr("data-href");
      var fileName = downloadcontractfile.split('/').pop();
       //Set the File URL.
       var url = downloadcontractfile;

       var data = {
        "downloadcontractfile":downloadcontractfile,
        "fileName":fileName,
        }
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: BASE_FOLDER+'/charters/downloadcontractfile',
            dataType: 'json',
            data: data,
            success:function(result) {
              $("#hideloader").hide();
                if (result.status == 'success') {
                 
                    downloadmappagefile(result.link,result.file);
                    //window.location.href = result.link
                   
                }else{
                  alert('Sorry!! Unable to download file');
                  return false;
                } 
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
  });


  function downloadmappagefile(link,fileName) {
            //Set the File URL.
            //var url = fileName;
            var url = link + fileName;
            $.ajax({
                url: url,
                cache: false,
                xhr: function () {
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 2) {
                            if (xhr.status == 200) {
                                xhr.responseType = "blob";
                            } else {
                                xhr.responseType = "text";
                            }
                        }
                    };
                    return xhr;
                },
                success: function (data) {
                    //Convert the Byte Data to BLOB object.
                    var blob = new Blob([data], { type: "application/octetstream" });
 
                    //Check the Browser type and download the File.
                    var isIE = false || !!document.documentMode;
                    if (isIE) {
                        window.navigator.msSaveBlob(blob, fileName);
                    } else {
                        var url = window.URL || window.webkitURL;
                        link = url.createObjectURL(blob);
                        var a = $("<a />");
                        a.attr("download", fileName);
                        a.attr("href", link);
                        $("body").append(a);
                        a[0].click();
                        $("body").remove(a);
                    }
                }
            });
        }

//         window.addEventListener("resize", update_mapContainer);
// function update_mapContainer() {
//  let modelWidth = document.getElementById("markerModal_id").clientWidth;
//  let heigth=modelWidth * .75;
//  let width=modelWidth * .95;
//  document.getElementById('modalmap').style.height= `${heigth}px`;
//  document.getElementById('modalmap').style.width= `${width}px`;
// }

///////////////////////////////Cruising schedule modal locations polyline display///////////////////////////////////
var csmpsinglemarkerlat;
var csmpsinglemarkerlong;
function markerOnClickCSMP(e) {
    console.log(e);
    var scheduleUUId = e.target.scheduleUUId;
    var scheduleId = e.target.scheduleId;
    var markerNum = e.target.markerNum;
    var lattitude = e.latlng.lat;
    var longitude = e.latlng.lng;
    var consumptiontotal = e.target.consumptiontotal;
    var distancetotal = e.target.distancetotal;
    var durationtotal = e.target.durationtotal;
    //console.log(durationtotal);
    // console.log(lattitude);
    // console.log(longitude);
    var day_dates = e.target.day_dates;
    var week_days = e.target.week_days;
    var tablepId = e.target.tablepId;
    var counttitle = e.target.counttitle;
    var daytitle = e.target.daytitle;
    var scheduleSameLocationUUID = e.target.scheduleSameLocationUUID;
    var samelocationsDates = e.target.samelocationsDates;
    $("#modalmapcruisingsch .leaflet-control-container").show();
    var popLocation= e.latlng;
    ReloadModalMaplayerCSMP();
    //var popLocation = e.latlng;
    var selectedmarkertitle = e.target.daytitle;
    var selectedmarkerday_num = e.target.day_num;

    var from_flag = e.target.from_flag;
    var to_flag = e.target.to_flag;
    var serial_no = e.target.serial_no;
    var stationary_val = e.target.stationary;

    var row_from_distance = e.target.row_from_distance;
    var row_from_duration = e.target.row_from_duration;
    var row_from_lat = e.target.row_from_lat;
    var row_from_long = e.target.row_from_long;
    console.log(selectedmarkertitle);

    lattitude = row_from_lat;
    longitude = row_from_long;
    distancetotal = row_from_distance;
    durationtotal = row_from_duration;
    //console.log(to_flag);
    if(from_flag){
        selectedmarkertitle = daytitle;
        distancetotal = "";
        durationtotal = "";
    }

    if(to_flag){
        var start_loc = e.target.start_loc;
        //console.log(start_loc);
        selectedmarkertitle = start_loc;
             lattitude = embark_lat;
         longitude = embark_long;
       
    }

    $("#markerModalcruisingsch").show();

    setTimeout(function () {
                            window.dispatchEvent(new Event("resize"));
                            
                            }, 100);

    if (markerArray.length > 0) {
            $('.markersnamesmodalmapcruisingsch').find('option').remove();
            $('.markersnamesmodalmapcruisingsch').append($("<option></option>")
                .attr("value", "")
                .text("Select")
            );    
            $.each(markerArray, function(key, value) {   

                            if(value.day_to_location){
                                var vvd = value.day_to_location.trim();
                                var valTitle = vvd.replaceAll('"', '').replaceAll("'", '');
                            }else{
                                var valTitle = "";
                            }
                        
                $('.markersnamesmodalmapcruisingsch')
                    .append($("<option></option>")
                        .attr("id", "marker_" + value.scheduleId)
                        .attr("data-lat", value._latlng.lat)
                        .attr("data-long", value._latlng.lng)
                        .attr("data-schid", value.scheduleId)
                        .attr("data-daynum", value.day_num)
                        .attr("value", valTitle +' - Day '+value.day_num)
                        .text(valTitle +' - Day '+value.day_num)
                    );
        });
    }
 
    csmpsinglemarkerlat = lattitude;
        csmpsinglemarkerlong = longitude;

        if(serial_no < 2 && stationary_val == 0 && selectedmarkerday_num != 1){
                                    selectedmarkerday_num = selectedmarkerday_num - 1;
                                }
//console.log(selectedmarkertitle);
        var vvs = selectedmarkertitle.trim();
        var selectedmarkertitleV = vvs.replaceAll('"', '').replaceAll("'", '');
        if(stationary_val == 1){
            selectedmarkertitleV = '';
        }
        var frommarker = selectedmarkertitleV +' - Day '+selectedmarkerday_num; //alert('llll')
        $("#embarkation_sch").text(selectedmarkertitle); 
        if(from_flag){
            frommarker = "";
        }
        drawrouteinmodalCSMP(frommarker);

        setTimeout(() => {
            modalmapcruisingsch.invalidateSize();
        }, 0);
        //$("#modalmap").find('.leaflet-control-attribution').hide();
        var myIcon = L.icon({
                                iconUrl: Wmarker,
                                iconSize: [25, 41],
                                className:'myIconClass',
                            });
        var routemodalmarkerCSMP = L.marker([lattitude, longitude], {
            draggable: false,
            pmIgnore: true,
            icon:myIcon
        });
        routemodalmarkerCSMP.addTo(modalmapcruisingsch);

        if(selectedmarkerday_num < 10 ){
                        newdaycount="<span>&nbsp;"+selectedmarkerday_num+"</span>";
                    }
                    else{
                        newdaycount="<span>"+selectedmarkerday_num+"</span>";
                    }

        var textMarkermodalmapCSMP = L.marker([lattitude,longitude], {
        icon: L.divIcon({
            html: newdaycount,
            // html: selectedmarkerday_num,
            className: 'text-below-marker-locsch',
            })
        }).addTo(modalmapcruisingsch);  
        
                                $(".charter_from_date_conv_CSMP").text(week_days);
                                $(".markerdistanceCSMP").text(distancetotal);
                                $(".markerdurationCSMP").text(durationtotal);

       
}

$(document).on("change", ".markersnamesmodalmapcruisingsch", function(e) {

        var routemodalmarkerselected = {};
        var textMarkermodalmap = {};
        var selectedlat = "";
        var selectedlong = "";
        var fmlong;
        var fmlat;
        var modalmapdaynumber = "";
        var defaultline = {};
        var selectedmarkertooltipcontent = "";
    //selectedTitle = $(this).val();
    //alert(selectedTitle);
    //console.log(selectedTitle);
    //if (selectedTitle != "") {
        selectedlat = $(".markersnamesmodalmapcruisingsch option:selected").attr("data-lat");
        selectedlong = $(".markersnamesmodalmapcruisingsch option:selected").attr("data-long");
        var schid = $(".markersnamesmodalmapcruisingsch option:selected").attr("data-schid");
        var modalmapdaynumber = $(".markersnamesmodalmapcruisingsch option:selected").attr("data-daynum");
        
        //console.log(markerArray);  //return false;
        
        // const selectedTitleFrom = selectedTitle.split("-");
        // //console.log(selectedTitleFrom);
        // let selectedTitleFromWord = $.trim(selectedTitleFrom[0]);

        // console.log(routemodalmarkerselected); 
        //   console.log(selectedlat);  
        //   console.log(selectedlong);  
        if (routemodalmarkerselected != "") { //alert();
            modalmapcruisingsch.removeLayer(routemodalmarkerselected);
        }
        if (textMarkermodalmap != "") { //alert();
            modalmapcruisingsch.removeLayer(textMarkermodalmap);
        }
        var myIcon = L.icon({
                                iconUrl: Wmarker,
                                iconSize: [25, 41],
                                className:'myIconClass',
                            });
        routemodalmarkerselected = L.marker([selectedlat,selectedlong], {
            draggable: false,
            pmIgnore: true,
            icon:myIcon
        });
        routemodalmarkerselected.addTo(modalmapcruisingsch);
        if(modalmapdaynumber < 10 ){
                        newdaycount="<span>&nbsp;"+modalmapdaynumber+"</span>";
                    }
                    else{
                        newdaycount="<span>"+modalmapdaynumber+"</span>";
                    }
					
        // adding day number to marker
        textMarkermodalmap = L.marker([selectedlat,selectedlong], {
        icon: L.divIcon({
            html: newdaycount,
            // html: modalmapdaynumber,
            className: 'text-below-marker-locsch',
            })
        });
        textMarkermodalmap.addTo(modalmapcruisingsch);
    
});

function drawrouteinmodalCSMP(frommarker) { //alert();
     //console.log(modalrouteline);
     console.log(frommarker);
    modalmapcruisingsch.setView(new L.LatLng(csmpsinglemarkerlat, csmpsinglemarkerlong));
    
    $("#debarkation_sch").text('');
    var drawrouteline = [];
    //var tempendloc = [];
    var nextmarkername;
    var toloc =  $(".markersnamesmodalmapcruisingsch").val();
   
    $.each(modalrouteline, function(name, value) {
        //console.log(value.name);
            if (value.name == frommarker) {
                drawrouteline.push(value.index);
                //tempendloc.push(value.end_loc);
                nextmarkername = value.end_loc; 
                
            } 
    });
    console.log(nextmarkername);
    if (nextmarkername != "undefined" && nextmarkername != "" && nextmarkername != null) { //alert();
        $(".markersnamesmodalmapcruisingsch").val(nextmarkername).trigger('change');
      // var returnvalue =  markersnamesmodalmap(nextmarkername);
       //if(returnvalue == 1){
        var tempdrawrouteline = [];
        
        $.each(modalrouteline, function(name, value) {
            // console.log(name);
            // console.log(value.end_loc);
            // console.log('kkkk')
                if (value.name == frommarker && value.end_loc == nextmarkername) {
                    tempdrawrouteline.push(value.index);
                    
                }
        });
        const myArrayFrom = frommarker.split("- Day");
        let fromword = myArrayFrom[0];
        const myArrayTo = nextmarkername.split("- Day");
        let toword = myArrayTo[0];
        $("#embarkation_sch").text(fromword+' to '); 
        $("#debarkation_sch").text(toword);
        var specificline = "";
            specificline = tempdrawrouteline;
        var drawnItemsModalMapCSMP = new L.FeatureGroup();
        var polyLayersModalMap = [];
        var polyline2 = new SmoothPoly(specificline, {stroke:true,snakingSpeed: 200,weight:2.5,dashArray: [5,5],color:'#fff',lineCap: "round",lineJoin: "round",smoothFactor: 5});

        polyLayersModalMap.push(polyline2)

        // Add the layers to the drawnItemsModalMap feature group 

        for (let layer of polyLayersModalMap) { //console.log(layer);
            drawnItemsModalMapCSMP.addLayer(layer);
        }
        
//onsole.log(drawnItemsModalMapCSMP);
setTimeout(() => {
        modalmapcruisingsch.fitBounds(drawnItemsModalMapCSMP.getBounds());
     
        modalmapcruisingsch.addLayer(drawnItemsModalMapCSMP);

        drawnItemsModalMapCSMP.snakeIn();
    }, 100);
    
        setTimeout(() => {
            modalmapcruisingsch.invalidateSize();
        }, 10);
        
    //}
    
        
    }

}

$(document).on("click", "#markerModalclosecruisingsch", function(e) {
   
   $("#markerModalcruisingsch").hide();

    // Removed the layer on close the route modal to clear any changes done and not saved.
    modalmapcruisingsch.eachLayer(function (layer) {
       modalmapcruisingsch.removeLayer(layer);
                           });
});

///////////////////////////////Cruising schedule modal locations polyline display///////////////////////////////

var langauges_list = {
	English: "gb",
	MandarinChinese: "cn",
	Spanish: "es",
	French: "fr",
	German: "de",
	Greek: "gr",
	Italian: "it",
	Arabic: "sa",
	Russian: "ru",
	Japanese: "jp"
}
    $( document ).ready(function() {
        var select = document.getElementById("language-select");
      var selectedCountry = "English"; // Set your desired default value here

      var div = document.getElementById("flag");
      if(div){
        div.className = 'flag-icon flag-icon-' +langauges_list[selectedCountry]+'';
      }
      

      var select2 = document.getElementById("language-select2");
      var selectedCountry2 = "English"; // Set your desired default value here

      var divflag = document.getElementById("flag2");
      if(divflag){
        divflag.className = 'flag-icon flag-icon-' +langauges_list[selectedCountry2]+'';
      }
      
});
function changeLanguage() {
      var selectedCountry = document.getElementById("language-select").value;
      
               //alert(langauges_list[selectedCountry]);
      console.log("Selected language: " + langauges_list[selectedCountry]);
      //alert(selectedCountry);
      console.log(ScheduleDataResult);
      $.each( ScheduleDataResult[0]['CharterProgramSchedule'], function( key, value ) {
        //alert( key + ": " + value );
        if ($("#title_"+value) != "undefined") {
            if(ScheduleDataResult[0]['CharterProgramSchedule']['title_'+selectedCountry] !='' && ScheduleDataResult[0]['CharterProgramSchedule']['title_'+selectedCountry]!=null){
                $("#title_"+value).val(ScheduleDataResult[0]['CharterProgramSchedule']['title_'+selectedCountry]);
            }
            
        }
        if ($("#notes_"+value) != "undefined") {
            $("#notes_"+value).val(ScheduleDataResult[0]['CharterProgramSchedule']['notes_'+selectedCountry]);
        }
        });

        $.each( ActivityData, function( key, value ) {
        //alert( key + ": " + value );
        console.log(value);
        if ($("#title_"+value['CharterProgramScheduleActivity']['id']) != "undefined") {
            //console.log(value['CharterProgramScheduleActivity']['activity_name_'+selectedCountry]);
           // console.log(value['CharterProgramScheduleActivity']['id']);
            $("#title_"+value['CharterProgramScheduleActivity']['id']).text(value['CharterProgramScheduleActivity']['activity_name_'+selectedCountry]);
        }
        if ($("#notes_"+value['CharterProgramScheduleActivity']['id']) != "undefined") {
            //console.log(value['CharterProgramScheduleActivity']['activity_name_'+selectedCountry]);
           // console.log(value['CharterProgramScheduleActivity']['id']);
            $("#notes_"+value['CharterProgramScheduleActivity']['id']).text(value['CharterProgramScheduleActivity']['notes_'+selectedCountry]);
        }
        });
      
      var div = document.getElementById("flag");
      if(div){
        div.className = 'flag-icon flag-icon-' +langauges_list[selectedCountry]+'';
      }
      
      // Add your code to handle the language change here
}
function changeLanguage2() {
      var selectedCountry2 = document.getElementById("language-select2").value;
      
               //alert(langauges_list[selectedCountry]);
      console.log("Selected language: " + langauges_list[selectedCountry2]);
      
      var divflag = document.getElementById("flag2");
      if(divflag){
        divflag.className = 'flag-icon flag-icon-' +langauges_list[selectedCountry2]+'';
      }
      
      // Add your code to handle the language change here
}

var DBHeading = "<?php echo $AisPosition['COG']; ?>";
var DBTrueHeading = "<?php echo $AisPosition['TrueHeading']; ?>";
var DBLongitude = "<?php echo $AisPosition['Longitude']; ?>";
var DBLatitude = "<?php echo $AisPosition['Latitude']; ?>";
var boatMarker = L.boatMarker([DBLatitude,DBLongitude], {
			    color: "#00a7f2"
			}).addTo(map);

			boatMarker.setHeading(DBHeading);
            boatMarker.setSpeed(DBTrueHeading);

			function getRandomArbitrary(min, max) {
			    return Math.random() * (max - min) + min;
			}

			var heading = DBHeading;

			// start simulation
			// window.setInterval(function() {

			// 	var speed = getRandomArbitrary(8.0, 16.0);
			// 	var direction = getRandomArbitrary((heading - 50) % 360, (heading - 40) % 360);

			// 	if(heading > 30)
			// 		heading -= 0.5;

			 	//boatMarker.setHeadingWind(heading, speed, direction);

			// 	var destination = turf.destination(boatMarker.toGeoJSON(), 0.02, 60, "kilometers");
			// 	boatMarker.setLatLng(destination.geometry.coordinates.reverse());

			// }, 488);


const optionsWind = {
    // Required: API key
    key: '1cDk7fz9oF31QBPeqDjg6LwhBw6Z5wJ9', // REPLACE WITH YOUR KEY !!!

    // Changing Windy parameters at start-up time
    // (recommended for faster start-up)
    // Put additional console output
    verbose: true,

    // Optional: Initial state of the map
    // lat: centerLat,
    // lon: centerLng,
    // zoom: 7,
};
var windyflag = 0;
function initializewindy(){

if(windyflag == 0){    
// Initialize Windy API
windyInit(optionsWind, windyAPI => {
    const { map } = windyAPI;
    // .map is instance of Leaflet map
    if(latlngs.length > 0){
        map.fitBounds(latlngs);
    }

        var WindboatMarker = L.boatMarker([DBLatitude,DBLongitude], {
			    color: "#00a7f2"
			}).addTo(map);

			WindboatMarker.setHeading(DBHeading);
            WindboatMarker.setSpeed(DBTrueHeading);

            windyflag = 1;
});
}

}


$(document).on("click", "#WeatherMap", function(e) {
   
   $("#map").hide();
    $("#windy").css("visibility","unset");
    $("#windy").css("display","block");
    $("#CruisingButton").hide();
    $("#HideDetails").hide();
    $("#HelpfulTips").hide();
    $("#WeatherMap").hide();
    $("#GuestNews").hide();
    $("#closeWeatherMap").css("display","block");
    //windy.invalidateSize();
    initializewindy();
});

$(document).on("click", "#closeWeatherMap", function(e) {
   
   $("#map").show();
    $("#windy").css("display","none");
    $("#CruisingButton").show();
    $("#HideDetails").show();
    $("#HelpfulTips").show();
    $("#WeatherMap").show();
    $("#GuestNews").show();
    $("#closeWeatherMap").css("display","none");
    //windy.invalidateSize();
});

   
    $(document).on("click", "#GuestNews" ,function() {
        //alert('jjj');
       
        
        //var yachtId = $("#yachtId").val();
        //var charprogid = $("#charterProgramId").val();
        //alert(activity_name);
        //commenttitlecheck = 0;
        // $.ajax({
        //         type: "POST",
        //         url: basefolder+"/"+"charters/getGuestNews",
        //         dataType: 'json',
        //         data: { 'charprogid': charprogid,
        //                 'yachtId':yachtId
        //             },
        //         success:function(data) {
        //             //console.log(data);
        //             $('#charterguestnews').html(data.view);
                   
                    $('#guestNewsModal').show();
                   
                    
    //                 //alert(data.isfleet);
    //                 $("#hideloader").hide();
                    
    //             }
    //    });
    });

$(document).on("click", ".clicknewsdiv", function() { 
    //alert('kkk');
    var clickcommentObj = $(this);
    var color = $(this).css("background-color");
            //alert(color);
    var yachtId = $("#yachtId").val();
    var selectedcomment = hexc(color);
    //console.log(selectedcomment);
    if (selectedcomment == "#e5f6fc") { //console.log('ll');
        $(this).css("background-color","#ffffff");
        $(this).removeClass('selectedcomment');
        var id = $(this).attr('id');
        var read = "read";
    }else{ console.log('gg');
        $(this).css("background-color","#e5f6fc");
        $(this).addClass('selectedcomment');
        var id = $(this).attr('id');
        var read = "unread";
    }

    //return false;


    $.ajax({
        type: "POST",
        dataType: 'json',
        url: basefolder+"/"+"charters/markGuestNewsUnread",
        data: {
            'primaryid': id,
            'read': read,
            'yachtId':yachtId
        },
        success: function(data) {
            if (data.success == 'success') {
                
                //comments icon color change in itinerary modal
                var primaryidscheck = [];
                $(".selectedcomment").each(function(){
                    primaryidscheck.push($(this).attr('id'));
                //alert($(this).attr('id'));
                });
            
            }
        }
    });


});

$(document).on("click", "#newsmodal" ,function() {
        $('#guestNewsModal').hide();
    });

</script>
  
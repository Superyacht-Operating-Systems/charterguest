<?php 
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
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    /* .custom-popup .leaflet-popup-content {
    overflow-y: auto;
    border-bottom: 1px solid #ddd;
    border-top: 1px solid #ddd;
    overflow-x: hidden;
    min-height: 250px;
    max-height: 500px;
    width: auto !important;
} */

.inputContainerdiv{
display: flex;
padding: 10px;
background-color: #fff;
border-radius: 10px;
margin: 15px 5px;
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
margin-right: 10px;
}
.loc_desc_field{
    padding: 6px 6px;
    background: #ffffff !important;
    color: #4d4d4d!important;
    border: solid 0px rgb(243 243 243 / 70%)!important;
    box-shadow: none;
    font-family: 'Open Sans';
}
.loc_img_div{
width: 150px;
}	
.loc_map_div{
    float: left;
border: solid 1px #ccc;
width: 150px;
overflow: hidden;
height: 150px;
margin-bottom: 10px;
border-radius: 10px;
}
.icons_fields{
    padding: 10px 5px 5px 5px;
    border-bottom: 2px solid #eee;
}
.icon_label{
    color: #000;
    padding: 0px 20px 0px 5px;
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

.CS_modal{
    background-color: #eeeeee;
}
.location_container,.sp-divrow{
    background-color: #ffffff;
}
@media only screen and (max-width: 771px){
    .CS_modal{
    width:100% !important;
}
.inputContainerdiv{
display: grid;
}
.loc_img_div{
width: 100%;
}	
.loc_desc_div{
width: 100%;
}

.certificat-modal-container .modal-dialog {
    width: 95%!important;
margin: 0 auto;
margin-top: 15px;
}

.loc_img_div{
width: 100%;
}	

.loc_map_div{
    width: 40%!important;
margin-right: 10px;
}
.sp-upload-img{
    width: 40%!important;
}
}

@media only screen and (min-width: 771px){
    .CS_modal{
    width:650px;
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

@media only screen and (max-width: 767px){
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

    </style>

<?php
echo $this->Html->script('leaflet/leaflet'); 
echo $this->Html->css('leaflet/dist/leaflet');

echo $this->Html->script('leaflet/route'); 
 
 echo $this->Html->script('leaflet/leaflet-geoman.min'); 
 echo $this->Html->css('leaflet/leaflet-geoman');

 echo $this->Html->css('leaflet/leaflet.draw.css');
 echo $this->Html->script('leaflet/leaflet.draw.js'); 

?>
<style>
.wrapper{overflow: hidden;}
.footer{height: 0px;line-height: 0;padding: 0px;}
.common-form-row{
    margin-top:10px;margin-bottom: 10px;font-weight: bold!important;}
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
@media screen and (max-width: 767px) {
.md-text-center{text-align: center!important;}
.common-form-row {
    margin: 45px 0px 0px 0px;

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

.leaflet-marker-icon:hover{
    z-index: 99999999;
}



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
    height: 32px;
    margin: 0px;
    width:55px;
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
background: #fff;
margin: 10px;
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
  padding-left: 0px;
  width: 600px;
}
.certificat-modal-container .inbox-widget .inbox-item {
    border-bottom: 1px solid #d6d4d4;
}
.inbox-widget .inbox-item .inbox-item-text {
    color: #000000!important;
}
@media only screen and (max-width:1024px){
.common-form-row {
    margin-top: 50px;
}
.yachtHeaderName {
    margin-top: 4px!important;
}
body .mydemolabel {
    top: 57px!important;
}


}
@media only screen and (max-width:767px){

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
width: 95%;
    margin: 0 auto;
    margin-top: 15px;
}
.chat-send button{
width: 126px;
    margin-right: 10px;
}
.chat-send {
    display: flex;
    justify-content: center;
}
.chat-inputbar textarea{
    width: 100%;
    height: 93px;
}
.chat-inputbar{
padding-left: 15px!important;
    padding-right: 15px;
}
.sp-modal-600 {
    width: 100%;
}
}

#CruisingButton {
    position: absolute!important;
    top: 18px!important;
    right: 13px!important;
  padding: 5px;
  height: 32px;
  color:#000;
  z-index: 9999;
  font-weight:bold;
  width: 145px;
}

#HideDetails {
    position: absolute!important;
    top: 56px!important;
    right: 13px!important;
  padding: 5px;
  height: 32px;
  color:#000;
  z-index: 9999;
  font-weight:bold;
  min-width: 145px;
}

#HelpfulTips {
    position: absolute!important;
    top: 93.5px!important;
    right: 13px!important;
  padding: 5px;
  height: 32px;
  color:#000;
  z-index: 9999;
  font-weight:bold;
  min-width: 145px;
}
@media only screen and (min-width: 768px) and (max-width: 1092px){
    #CruisingButton {
  width: 138px !important;
  font-size: 14px;
  height: 32px;
  padding: 5px !important;
  top: 18px !important;
}
#HideDetails, #HelpfulTips {
    min-width: 138px;
    font-size: 14px;
    height: 32px;
    padding: 5px!important;
}
}


@media (max-width: 767px){
#HideDetails, #HelpfulTips {

    width: 113px;
    height: 24px;
    padding: 0px!important;
    font-size: 11px!important;
    min-width: inherit;
}
#CruisingButton {
    height: 24px;
    width: 113px;
  top: 18px !important;
}

#HideDetails {
    top: 47px!important;
}
#HelpfulTips {
    top: 76px!important;
}
}

.fancybox-overlay {
    z-index: 99999999 !important;
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
.modal_load{
    margin:5px 10px 5px 8px;
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
    .modal_load{
        max-height: 86vh;
    overflow-y: scroll;
    overflow-x: hidden;
    margin: 5px 0px 5px 8px;
    padding: 0px 10px 100px 0px;
    }
    .cruising-location-Modal .modal-content{
       height: 96vh!important;
    }
.common-form-row.map-form-rwo {
    margin-top: 50px;
    margin-bottom: 20px;
}
.certificat-modal-container{
    background-color: #000!important;
  }
  .certificat-modal-container .mx-box {
    max-height: 46vh;
    min-height: 46vh;
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

@media only screen and (max-width:767px){
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
    padding-left: 78px;
}
.position-mobile-head{
        left: 80px;
}
.map-container {
    margin-top: 18px!important;
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

@media only screen and (min-width: 320px) and (max-width: 767px){
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
    font-weight: bolder;
    margin-top: -36px !important;
    margin-left: -3px !important;
}


</style>  

<?php    echo $this->Html->script('jquery-1.7.2.min');
        echo $this->Html->script('fancybox/jquery.fancybox');
        echo $this->Html->css('fancybox/jquery.fancybox');
        
    ?> 
    
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
        <li class="menu__item" ><a>How To Video</a>
           <ul class="submenu">
                   <li class="menu__item" id="MenuHowToVideo"><a href="#">Preference Sheets</a></li>
                   <li class="menu__item" id="MenuHowToVideoCharterHead"><a href="#">Head Charterer</a></li>
                </ul>
            </li>
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
          1. Tap the location marker to display the days activities.
        </div>
        <div class="form-group">
          2. Tap the activities text to expand the field.
        </div>
        <div class="form-group">
          3. Tap the image to enlarge it.
        </div>
        <div class="form-group">
          4. The Cruising Schedule button lists all the locations.
        </div>
        <div class="form-group">
        5. Tap the Hide Details button to hide the location cards.
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
                <button type="button" class="close" id="cruisinglocationModalclose" aria-hidden="true" style="margin-right: 5px;">×</button>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;font-weight: bold;"><?php echo $startloc; ?> to <?php echo $endloc; ?></h4>
            </div>
            <div class="modal-body location_Modal_body">
                <div id="cruisinglocationModal_load" class="modal_load">

                </div>

            </div>
        </div>
    </div>
</div><!-- /.modal-content -->


<div id="markerModal" class="modal certificat-modal-container cruising-location-Modal"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="width:650px;" id="markerModal_id">
            <div class="modal-header">
                <button type="button" class="close" data-schuuid="" id="markerModalclose" aria-hidden="true" style="margin-right: 5px;">×</button>
                <h4 class="modal-title" id="markerModalLabel" style="text-align: center;font-weight: bold;"></h4>
            </div>
            <div class="modal-body location_Modal_body">
                <div id="markerModal_load" class="modal_load">

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
<div class="custom-popup " id="map" style="height: calc(100vh - 100px);"></div>
<button id="CruisingButton">Cruising Schedule</button>
<button id="HideDetails">Show Details</button>
<button id="HelpfulTips">Helpful Tips</button>
</div></div>
</div>
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
            }
            // In phone view the left menu should not overflow with map right side buttons
        } else {
            sidebarIsVisible = false;
            // In phone view the left menu should not overflow with map right side buttons
                    $("#CruisingButton").show();
                    $("#HideDetails").show();
                    $("#HelpfulTips").show();
                    // In phone view the left menu should not overflow with map right side buttons
        }
    }
})();

$('.menu > .menu__item').hover(function(){
  $(this).children('.submenu').show();
  
}, function() {
  $(this).children('.submenu').hide();
  
});
</script>


<script>
    var guesttype = '<?php echo $guesttype;?>';

var basefolder = '<?php echo $basefolder;?>';
var vessel = new L.LayerGroup();
var markerArray = [];
var markerCount = 0;
     
var mbAttr = '<table width=100%><thead><tr style="font-size:12px;font-weight:bold;text-align:center;"><td style="width:33%;border-right: 8px solid #000;">Distance</td><td style="width:33%;border-right: 8px solid #000;">Duration</td><td style="width:34%;border-right: 8px solid #000;">Fuel</td></tr></thead><tbody><tr style="font-size:12px;color:#3388ff;font-weight:bold;text-align:center;"><td style="border-right: 8px solid #000;"><?php echo $RouteDatadisplaydistancevalue; ?></td><td style="border-right: 8px solid #000;"><?php echo $RouteDatadisplayduration; ?></td><td style="border-right: 8px solid #000;"><?php echo $RouteDatatotalconsumption; ?></td></tr></tbody></table>';
mbUrl = 'https://api.mapbox.com/styles/v1/superyachtos/{id}/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic3VwZXJ5YWNodG9zIiwiYSI6ImNpdW54eHV5bjAxNmMzMG1sMGpkamVma2cifQ.Y9kj-j0RGCFSE6khFVPyOw';
var satellite   =   L.tileLayer(mbUrl, {
    id: 'ciurvui5100uz2iqqe929nrlr', 
    unloadInvisibleTiles : false,
    reuseTiles : true,
    updateWhenIdle : false,
    continousWorld : true,
    noWrap: false,
    attribution: mbAttr
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
  

var centerLat = 40.58058466412764;
var centerLng = -35.85937500000001;
var centerLatDay1 = 40.58058466412764;
var centerLngDay1 = -35.85937500000001;
var zoom = 4;
var day1 = 0;
var latlngs = [];
var globaldropdownvarAddOption = "";
// Generating the markers for existing records
<?php foreach ($scheduleData as $key => $schedule) { 

if(isset($samelocations[$schedule['CharterProgramSchedule']['lattitude']]) && !empty($samelocations[$schedule['CharterProgramSchedule']['lattitude']])){
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
    if(isset($markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['endplace']) && !empty($markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['endplace'])){
            $endplace = $markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['endplace'];
            $bar = " / ";
    }else{
        $endplace = "";
        $bar = "";
    }
    if(isset($markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['distance']) && !empty($markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['distance'])){
        $distance = $markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['distance'];
        
    }else{
        $distance = "";
    
    }
    if(isset($markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['duration']) && !empty($markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['duration'])){
        $duration = $markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['duration'];
        
    }else{
    $duration = "";
    
    }
    if(isset($markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['consumption']) && !empty($markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['consumption'])){
        $consumption = $markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['consumption'];
        
    }else{
    $consumption = "";
    
    }
    $daynumber = $schedule['CharterProgramSchedule']['day_num'];
        if ($schedule['CharterProgramSchedule']['day_num'] == 1) {
        ?>
            day1 = 1;
            centerLatDay1 = <?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>;
            centerLngDay1 = <?php echo $schedule['CharterProgramSchedule']['longitude']; ?>;
        <?php } ?> 
            
        centerLat = <?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>;
        centerLng = <?php echo $schedule['CharterProgramSchedule']['longitude']; ?>;
        zoom = 7;
        
        var marker = L.marker(["<?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>", "<?php echo $schedule['CharterProgramSchedule']['longitude']; ?>"],{pmIgnore: true,riseOnHover:true})
        .bindTooltip("<?php echo "<span class='smalltooltip' ".$marker_msg_count.">".$samemkrcount."</span><span class='owntooltip' id=".$key.">".$SumDaytitle."<span id='".$schuuid."'   class='acti-count' ".$marker_msg_count." >".$samemkrcount."</span><b style='font-size: 10px;'>".$schedule['CharterProgramSchedule']['title']."<hr>".$endplace."</b><br><b style='font-size: 10px;'>".$distance.$bar.$duration."</b></span>"?>", 
                    {
                        permanent: true, 
                        offset: [0,-40],
                        //sticky:true,
                        direction: 'right',
                        className: "Tooltip",
                        noWrap: true,
                    })
                .on("click", markerOnClick);
                //console.log(marker);
                latlngs.push(new L.LatLng(<?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>, <?php echo $schedule['CharterProgramSchedule']['longitude']; ?>));

        marker.scheduleId = "<?php echo $schedule['CharterProgramSchedule']['charter_program_id']; ?>";
        marker.tablepId = "<?php echo $schedule['CharterProgramSchedule']['id']; ?>";
        marker.scheduleUUId = "<?php echo $schedule['CharterProgramSchedule']['UUID']; ?>";
        marker.daytitle = "<?php echo $schedule['CharterProgramSchedule']['title']; ?>";
        marker.day_dates = "<?php echo $schedule['CharterProgramSchedule']['day_dates']; ?>";
        marker.marker_msg_count = "<?php echo $schedule['CharterProgramSchedule']['marker_msg_count']; ?>";
        marker.counttitle = "<?php echo $counttitle; ?>";
        marker.scheduleSameLocationUUID = "<?php echo implode(',',$samelocationsScheduleUUID[$schedule['CharterProgramSchedule']['title']]); ?>";
        marker.samelocationsDates = "<?php echo implode(',',$samelocationsDates[$schedule['CharterProgramSchedule']['title']]); ?>";
        marker.labeldayanddate = "<?php echo $SumDaytitle; ?>";
        marker.day_num = "<?php echo $schedule['CharterProgramSchedule']['day_num']; ?>";
        marker.markerNum = markerCount; 
        markerArray.push(marker);
        marker.addTo(map);
        markerCount++;


<?php } } ?>

<?php foreach ($scheduleData as $key => $schedule) { 
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
                    $marker_msg_count = "style='display:none;'";
            }else{
                    $marker_msg_count = "";
            }
        }
        
    }

    $markernumberDisplay = $schedule['CharterProgramSchedule']['day_num'];
    ?>

    var textMarker = L.marker(["<?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>", "<?php echo $schedule['CharterProgramSchedule']['longitude']; ?>"], {
  icon: L.divIcon({
      html: "<?php echo $markernumberDisplay; ?><span id='<?php echo $schuuid ?>'   class='acti-count-onmarker' <?php echo $marker_msg_count ?> ><?php echo $samemkrcount ?></span>",
      className: 'text-below-marker',
    })
}).addTo(map);

 <?php } 
}?>


// script to show the tooltip next to marker on show/hide and also zoomin and zoomout
map.on('zoomstart', function () {

        var zoomLevel = map.getZoom();
            //alert(zoomLevel);
            //console.log(zoomLevel);
            //alert(zoomLevel);
            $('.Tooltip').css('top','');
            var tooltipdisplay = $('.Tooltip').css('display');
            if(tooltipdisplay == "block"){ 
                $('.Tooltip').css('top','45px');
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
var polyline0 = new L.Polyline(latlongstemp, {stroke:true,weight:4,dashArray: [10,10],lineCap: "round",lineJoin: "round",smoothFactor: 3}).addTo(map);
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
    var btntext = $("#HideDetails").text();
    if(btntext == "Show Details"){
        //$(".Tooltip").css("margin-top","");
        $(".Tooltip").css("width","160px");
        $(".smalltooltip").hide();
         $(".Tooltip").show();
        $(".owntooltip").show();
        
        $("#HideDetails").text("Hide Details");
        // $('.text-below-marker').each(function(i, obj) {
        //     var t = $(this).find('.acti-count-onmarker').text();
        //     //console.log(t);
        //     if(t != "" && t > 0){
                $(".acti-count-onmarker").hide();
        //     }
        
        // });
        // $(".leaflet-tooltip").css("opacity", "0");  
        // setTimeout(function(){
        //         $(".leaflet-tooltip").css("opacity", "1");  
                
        // },1000);
    }else if(btntext == "Hide Details"){
        //$(".Tooltip").css("margin-top","35px");
        $(".Tooltip").css("width","50px");
        $(".smalltooltip").hide();
         $(".Tooltip").hide();
        $(".owntooltip").hide();
        $("#HideDetails").text("Show Details");
        $(".acti-count-onmarker").hide();
        $('.text-below-marker').each(function(i, obj) {
            var t = $(this).find('.acti-count-onmarker').text();
            //console.log(t);
            if(t > 0){
                $(this).find('.acti-count-onmarker').show();
            }else{
                $(this).find('.acti-count-onmarker').hide();
            }
        
        });
        // $(".leaflet-tooltip").css("opacity", "0");  
        // setTimeout(function(){
        //         $(".leaflet-tooltip").css("opacity", "1");  
                
        // },1000);
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
$('.leaflet-marker-icon').each(function(i, obj) {
   
    if(!$(this).hasClass('text-below-marker')){
        $(this).addClass('myownmarker'+i);
    }
    
});

// created the day numbers as separated marker label and assign the row id only to markers 
// For numbers added the attr, on clicking the number on marker icon calling the same marker click function attr id.
var z = 0
$('.leaflet-marker-icon').each(function(i, obj) {
   
   if($(this).hasClass('text-below-marker')){
       $(this).attr('data-markerid', z);
       z++;
   }
   
});
}
$(document).on("click", ".Tooltip", function(e) {
    var myowntooltip = $(this).find('.owntooltip').attr('id');
    $(".myownmarker"+myowntooltip).click();
    
});

$(document).on("click", ".text-below-marker", function(e) {
    var myowntooltip = $(this).attr('data-markerid');
    $(".myownmarker"+myowntooltip).click();
    
});
/***********************************On clicking marker tooltip open modal of that specific marker */

var mapmarkerglobalObj = null;
var fitzoommap = [];
function markerOnClick(e) {
    mapmarkerglobalObj = e;
    var scheduleUUId = e.target.scheduleUUId;
    var scheduleId = e.target.scheduleId;
    var markerNum = e.target.markerNum;
    var lattitude = e.latlng.lat;
    var longitude = e.latlng.lng;
    var consumptiontotal = e.target.consumptiontotal;
    var distancetotal = e.target.distancetotal;
    var durationtotal = e.target.durationtotal;
    //console.log(consumptiontotal);
    var day_dates = e.target.day_dates;
    var tablepId = e.target.tablepId;

    var counttitle = e.target.counttitle;
    var daytitle = e.target.daytitle;
    var scheduleSameLocationUUID = e.target.scheduleSameLocationUUID;
    var samelocationsDates = e.target.samelocationsDates;

    if (scheduleId != "") {
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: basefolder+"/"+"charters/editCharterProgramSchedules",
            dataType: 'json',
            data: { "programId": scheduleId,"scheduleId":scheduleUUId,"tablepId":tablepId ,"diffDays": <?php echo $diffDays; ?>, "markerNum": markerNum, "lattitude": lattitude, "longitude": longitude,"guesttype":guesttype,"counttitle":counttitle, "daytitle":daytitle, "scheduleSameLocationUUID":scheduleSameLocationUUID, "samelocationsDates":samelocationsDates, "from":'locationcard' },
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    var width = $(window).width();
                    $(".leaflet-control-attribution").hide();
                    $("#CruisingButton").hide();
                    $("#HideDetails").hide();
                    $("#HelpfulTips").hide();
                     $(".leaflet-control-container").hide();
                    // open popup center to map
                    map.setView(e.latlng);

                    var popLocation= e.latlng;
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
                        update_mapContainer();

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
                        
                    // display popup from top
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
                   // alert(day_dates);
                    
                     // to get reduce msgcount
                     /* $(popup._closeButton).one('click', function(e){
                        msgcount();
                    }); */
                    
                    
                }
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    }
        
}



// Closing the popup
$(document).on("click", "#markerModalclose", function(e) {
   
   var schuuid =  $(this).attr("data-schuuid");
   markerModalclose(schuuid);
});

function markerModalclose(scheduleSameLocationUUID){
    msgcount(scheduleSameLocationUUID);
                            $("#markerModal").hide();
                            $(".leaflet-control-attribution").show();
                            $("#CruisingButton").show();
                            $("#HideDetails").show();
                            $("#HelpfulTips").show();
                            $(".leaflet-control-container").show();

                            //for screenview <990 on opening the itinerary modal blacked out the map region
                            // on close modal removed the blacked out css
                            customMediaQueryRemove();
}

$(document).on("change", ".noofdayscard", function(e) {
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
                    map.setView(mapmarkerglobalObj.latlng);
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
    $(".leaflet-control-container").show();

    

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
                type : "image"
            });

            //$('.fancybox').fancybox();

                $(".Tooltip").css("width","50px");
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
                        saveobj.css("color","green");
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
                thisObj.css("color","green");
                var color = thisObj.css("color");
                //alert(color);
                var colorgreen = hexc(color);

                if (colorgreen == "#ff0000") {
                    thisObj.css("color", "green");
                }
                if(primaryidscheck.length >= 1){
                    thisObj.css("color", "red");
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
    var charterpgid = $(".mapPopup").attr('data-schuuid'); 
    //alert(charterpgid);
    var yachtId = $("#yachtId").val();
    if(charterpgid){
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
                        var schuuidtoupdateintooltip = result.schuuidtoupdateintooltip;
                        $("#"+schuuidtoupdateintooltip).text(mcount);
                        $("#msgcountnotify").text(mcount);
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
                        thisObj.css("color","red");
                    
                    }
                }
       }); 
}else{
    alert("Please select the messages to mark unread.");
    return false;
}
    });

    $(document).on("click", "#CruisingButton", function(e) {

var scheduleId = $("#charterProgramId").val();
$("#hideloader").show();
    $.ajax({
        type: "POST",
        url: basefolder+"/"+"charters/getIpadViewCharterProgramSchedules",
        dataType: 'json',
        data: { "scheduleId": scheduleId},
        success:function(result) {
            $("#hideloader").hide();
            if (result.status == 'success') {

                $("#cruisinglocationModal_load").html(result.popupHtml);
                $("#cruisinglocationModal").show();

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

                
                $(".leaflet-control-attribution").hide();
                $(".leaflet-control-container").hide();
                //$(".leaflet-popup-close-button").addClass('updateCommentscount');
                //$('.day_dates').text(day_dates);

                $("#closeSchedule").remove();
                $(".crew_comment_cruisingmaptitle").remove();
                $(".crew_comment_cruisingmap").remove();
                $(".leaflet-popup-close-button").remove();
                 
            }
        },
        error: function(jqxhr) { 
            $("#hideloader").hide();
        }
    });

});

$(document).on("click", "#cruisinglocationModalclose" ,function() {
        $('#cruisinglocationModal').hide();
        $(".leaflet-control-attribution").show();
        $(".leaflet-control-container").show();
    });

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
        $(".leaflet-tile-pane").css({
                "display":""
        });
        $(".leaflet-overlay-pane").css({
            "display":""
        });
        $(".leaflet-marker-pane").css({
                "display":""
        });
        $(".leaflet-tooltip-pane").css({
                "display":""
        });
        $(".leaflet-container").css({
                "background-color":""
        });
    }
function customMediaQueryAdd(){
    $(".leaflet-tile-pane").css({
            "display":"none"
    });
    $(".leaflet-overlay-pane").css({
            "display":"none"
    });
    $(".leaflet-marker-pane").css({
            "display":"none"
    });
    $(".leaflet-tooltip-pane").css({
            "display":"none"
    });
    $(".leaflet-container").css({
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

        window.addEventListener("resize", update_mapContainer);
function update_mapContainer() {
 let modelWidth = document.getElementById("markerModal_id").clientWidth;
 let heigth=modelWidth * .75;
 let width=modelWidth * .95;
 document.getElementById('Img_container').style.height= `${heigth}px`;
 document.getElementById('Img_container').style.width= `${width}px`;
}
</script>
  
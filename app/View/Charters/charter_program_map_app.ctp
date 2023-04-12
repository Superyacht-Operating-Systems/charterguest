<?php 
$isFleetUser = $this->Session->read('loggedUserInfo.is_fleet');
$userType = $this->Session->read('loggedUserInfo.user_type');
$basefolder = $this->request->base; 
$sessionCharterGuest = $this->Session->read('charter_info.CharterGuest');

$options = "";
for ($i = 0; $i < $diffDays; $i++) {
    $j = $i + 1;
    $options .= '<option value="'.$j.'">Day '.$j.'</option>';
}

// echo "<pre>"; print_r($temploc); exit;

$schedulePeriod = "";
$schedulePeriodWithOutYear = "";
$charterName = "";
$scheduleLocation = "";
if (isset($charterProgData) && !empty($charterProgData)) {
    $schedulePeriodWithOutYear = date_format(date_create($charterProgData['CharterProgram']['charter_from_date']), "d M")." - ".date_format(date_create($charterProgData['CharterProgram']['charter_to_date']), "d M");
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

if(isset($ipadurlDB)){
$ipadappdb = $ipadurlDB;
}
?>

<?php
echo $this->Html->script('leaflet/leaflet'); 
echo $this->Html->css('leaflet/dist/leaflet');

echo $this->Html->script('leaflet/route'); 
 
 echo $this->Html->script('leaflet/leaflet-geoman.min'); 
 echo $this->Html->css('leaflet/leaflet-geoman');

 echo $this->Html->css('leaflet/leaflet.draw.css');
 echo $this->Html->script('leaflet/leaflet.draw.js'); 
 echo $this->Html->script('leaflet/L.Polyline.SnakeAnim.js'); 
?>
<style>
      @media only screen and (min-width: 767px) and (max-width: 1020px){
#CruisingButton { 
 min-width: 137px;
}
}
    .navbar-absalute-top{
        display:none;
    }
    .form-control:focus {
  background: transparent !important;
  color: #4d4d4d !important;
  border: solid 0px rgba(243, 243, 243, 0.7) !important;
}
    .navbar {
  margin-bottom: 0px;
 }
    .auto_resize::selection {
  color: none;
  background: transparent;
}
    .CS_modal .modal-header {
  padding: 25px 15px 5px 15px;
}
    .leaflet-container .leaflet-marker-pane img{
z-index: 1 !important;
}
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
width: 150px;
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

@media only screen and (max-width: 766px){
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
border: 0px solid rgb(204, 204, 204) !important;
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
margin:10px auto;
border: 0px solid rgb(204, 204, 204) !important;
border-radius: 10px!important;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
overflow: hidden;

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
    html, body {
        height: 100vh !important;
  background: #000!important;
}
.map-userlabelp{
position: absolute;
    left: 73px;
    top: 9px;
}
.fancybox-overlay{
background: none!important;
}
.certificat-modal-container {
  z-index: 99999;
}
.fancybox-opened {
    z-index: 999999!important;
}
.fancybox-wrap {
  z-index: 99999;
  opacity: 1 !important;
}
#fancybox-thumbs ul {
  left: auto!important;
  margin: 0 auto!important;
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
@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : portrait) {
    #modalmap{
        height: 300px;
width: 100%;
border: 3px solid rgb(204, 204, 204) !important;
border-radius: 10px!important;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
-khtml-border-radius: 10px;
margin-top:10px;
overflow: hidden;
    }
    .navbar {
  margin-bottom: 0px;
  min-height: 45px;
}
p {
  margin: 0 0 0px;
}
.yachtHeaderName {
  margin-top: 0px !important;
}

    .custom-popup{
    height: 98vh!important;
}
.leaflet-bottom {
    bottom: 40px;
}
}


@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : landscape) {
    #modalmap{
        height: 300px;
width: 100%;
border: 3px solid rgb(204, 204, 204) !important;
border-radius: 10px!important;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
-khtml-border-radius: 10px;
margin-top:10px;
overflow: hidden;
    }

    .custom-popup{
    width: 100%!important;
}
.custom-popup{
    height: 100vh!important;
}
.leaflet-bottom {
    bottom: 40px;
}
}

@media only screen 
and (min-device-width : 810px) 
and (max-device-width : 1080px) 
and (orientation : portrait) {

    .custom-popup{
    height: 98vh!important;
}
.leaflet-bottom {
    bottom: 40px;
}
}
@media only screen 
and (min-device-width : 810px) 
and (max-device-width : 1080px) 
and (orientation : landscape) {

    .custom-popup{
    width: 100%!important;
}
.custom-popup{
    height: 100vh!important;
}
.leaflet-bottom {
    bottom: 40px;
}
}

/* @media only screen and (min-width: 500px) and (max-width: 768px){
.custom-popup{
    height: 100vh!important;
}
.leaflet-bottom {
    bottom: 40px;
}
} */

@media only screen and (min-width: 768px) and (max-width: 800px){
.leaflet-bottom {
  bottom: 15px;
}
}
/* @media only screen and (min-width: 375px) and (max-width: 768px){
    .leaflet-bottom {
    bottom: 20px;
}
} */
    </style>

<?php
// echo $this->Html->script('leaflet/leaflet'); 
// echo $this->Html->css('leaflet/dist/leaflet');

// echo $this->Html->script('leaflet/route'); 
 
//  echo $this->Html->script('leaflet/leaflet-geoman.min'); 
//  echo $this->Html->css('leaflet/leaflet-geoman');

//  echo $this->Html->css('leaflet/leaflet.draw.css');
//  echo $this->Html->script('leaflet/leaflet.draw.js'); 

?>
<style>
.wrapper{overflow: hidden;}
.footer{height: 0px;line-height: 0;padding: 0px;}
.common-form-row{
    margin-top:0px;margin-bottom: 10px;font-weight: bold!important;}
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
      height: 111px;
}
.p-mt-3{
  margin-top: 3rem;
  padding-right: 0px;
}
.sp-mp-detailsrow h1 {
    color: #000;
    font-size: 20px;
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
   width:300px;
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
.uplaod-modal .modal-dialog{
    width: 420px;
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

.acti-count {
    background: #f00;
    width: 21px;
    font-size: 11px;
    line-height: initial;
    height: 20px;
    border-radius: 10px;
    color: #fff;
    margin-top: -15px;
    position: absolute;
    margin-left: 20px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.acti-count-onmarker {
    background: #f00;
    width: 18px;
    font-size: 11px;
    line-height: initial;
    height: 20px;
    border-radius: 10px;
    color: #fff;
    margin-top: -10px;
    position: absolute;
    margin-left: 20px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.Tooltip {
    width: 160px;
    display: none;
    font-size: 12px;
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
  padding-left: 0px;
  width: 600px;
  margin: 30px auto;
}
.certificat-modal-container .inbox-widget .inbox-item {
    border-bottom: 1px solid #d6d4d4;
}
@media only screen and (max-width:1024px){
.common-form-row {
    margin-top:0px;
        padding: 0px 15px;
}
.container {
    width: 100%;
}
/* .yachtHeaderName {
    margin-top: 4px!important;
} */
body .mydemolabel {
    top: 46px!important;
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
    width: 600px;
margin: 30px auto;
/* width: 90%;
    margin: 0 auto;
    margin-top: 15px; */
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

#CruisingButton:hover , #HideDetails:hover, #HelpfulTips:hover{
background: #fff !important;
}
#CruisingButton {
    background: #fff !important;
    position: absolute!important;
    top: 18px!important;
    right: 13px!important;
  padding: 6px;
  color:#000;
  z-index: 9999;
  font-weight:bold;
  border-radius: 20px;
  font-size: 12px;
}

#HideDetails {
    background: #fff !important;
    position: absolute!important;
    top: 56px!important;
    right: 13px!important;
  padding: 6px;
  color:#000;
  z-index: 9999;
  font-weight:bold;
  min-width: 121px;
  border-radius: 20px;
  font-size: 12px;
}

#HelpfulTips {
    background: #fff !important;
    position: absolute!important;
    top: 94px!important;
    right: 13px!important;
  padding: 6px;
  color:#000;
  z-index: 9999;
  font-weight:bold;
  min-width: 121px;
  border-radius: 20px;
}
@media(max-width: 1092px){
#HideDetails, #HelpfulTips {
    width: 137px;
    font-size: 12px;
    height: 32px;
    padding: 0px!important;
}
}
@media (max-width: 767px){
#HideDetails, #HelpfulTips {

    width: 108px;
    height: 25px;
    padding: 0px!important;
    font-size: 11px!important;
    min-width: inherit!important;
}
#HideDetails {
    top: 46px!important;
}
#HelpfulTips {
    top: 74px!important;
}

}
.fancybox-overlay {
    z-index: 99999 !important;
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

@media only screen and (max-width: 1030px){
.common-form-row.map-form-rwo {
    margin-top: 50px;
    margin-bottom: 20px;
}
.w-33{ 
    width: 50%;
}
.w-20 {
position: absolute;
    left: 0;
    margin-top: 0px;
    right: 0;
    width: 100%;
    white-space: nowrap;
    overflow: hidden;
}

#HideDetails {
    top: 110px;
    right: 13px;
    min-width: 137px;
}

#HelpfulTips {
    top: 150px;
    right: 13px;
    min-width: 137px;
}

}
/* textarea.form-control {
    resize: vertical!important;
    overflow: auto!important;
} */
.modal_load,.markmodal_load{
    margin:5px 10px 5px 8px;
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
@media only screen and (max-width: 771px){
    .sp-rightalign{
    display: none;
}
}
@media only screen and (max-width:767px){

.sp-40-w{
    margin-top: 10px;
    margin-left: 0px;
}


.sp-divrow {
    padding-bottom: 15px;
    margin-bottom: 10px;
    padding: 10px 11px;
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
   .sp-60-w  input{
    width: 100%!important;
    margin-bottom: 8px!important;
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
@media only screen and (max-width:900px){
.mddev{
    display:block;
}
.lgdev{
    display:none;
}
}
@media only screen and (min-width: 900px) and (max-width: 3000px){
    .lgdev{
        display:block;
    }
    .mddev{
    display:none;
}
}

.text-below-marker {
    font-size: 11px;
    font-weight: 1px solid;
    margin-top: -35px !important;
    margin-left: -3px !important;
    color: #000;
}

.text-below-marker-modalmap {
    font-size: 11px;
    font-weight: 1px solid;
    margin-top: -35px !important;
    margin-left: -3px !important;
    color: #000;
    z-index:9999 !important;
}

#fancybox-thumbs{
    z-index: 9999999 !important;
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
<!-- <br> -->

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

<!--help modal start here-->
<div id="mapquestionmodal" class="modal uplaod-modal" role="dialog">
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
                <button type="button" class="close" id="cruisinglocationModalclose" aria-hidden="true" style="margin-right: 5px;">×</button>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;font-weight: bold;"><?php echo $startloc; ?> to <?php echo $endloc; ?></h4>
            </div>
            <div class="modal-body location_Modal_body">
                <div id="cruisinglocationModal_load" class="modal_load">
                <div class="mapPopup sp-mp-detailsrow" data-schuuid="">
                <?php 
                $markerimage = BASE_URL.'/charterguest/app/webroot/css/leaflet/dist/images/marker-icon-itinerary.png';
                $crusemap = 1;
                $crusemaparray = array();
            foreach ($scheduleData as $key => $schedule) { 

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
            
                $daynumber = $schedule['CharterProgramSchedule']['day_num']; 
                
                $attachment = $schedule['CharterProgramSchedule']['attachment'];

                        if(isset($attachment) && !empty($attachment)){
                             
                            if(isset($domain_name) && $domain_name == "charterguest"){
                                $update_BASE_URL = "https://charterguest.net/";
                            }else{
                                $update_BASE_URL = "https://totalsuperyacht.com:8080/";
                            }
                            // if($yname == "yacht"){
                            //     $targetFullPath = BASE_URL.'/SOS/app/webroot/betayacht/app/webroot/img/charter_program_files/itinerary_photos/'.$attachment;
                            // }else{
                                $targetFullPath = $update_BASE_URL.'/'.$yachtname.'/app/webroot/img/charter_program_files/itinerary_photos/'.$attachment;
                                $targetFullGalleryPath = $update_BASE_URL.'/'.$yachtname.'/app/webroot/img/charter_program_files/itinerary_photos/';
                                
                                if (!empty($fleetname)) { // IF yacht is under any Fleet
                                    $targetFullPath = $update_BASE_URL.'/'.$fleetname."/app/webroot/".$yachtname.'/app/webroot/img/charter_program_files/itinerary_photos/'.$attachment;
                                    $targetFullGalleryPath = $update_BASE_URL.'/'.$fleetname."/app/webroot/".$yachtname.'/app/webroot/img/charter_program_files/itinerary_photos/';
                                }
                            //}
                            if(BASE_URL == "http://localhost"){
                                $targetFullPath = BASE_URL."/superyacht/app/webroot/img/charter_program_files/itinerary_photos/".$attachment;
                                $targetFullGalleryPath = BASE_URL."/superyacht/app/webroot/img/charter_program_files/itinerary_photos/";
                                }

                            $titleimage = $targetFullPath;
                            $titleimagehref = $targetFullPath;
                            $fancybox = "fancybox";
                            $targetFullGalleryPathhref = $targetFullGalleryPath;
                        }else{
                            $noteimg = "style='display:none;'";
                            $titleimage = BASE_URL.'/charterguest/app/webroot/img/noimage.png';
                            $titleimagehref = "#";
                            $fancybox = "";
                            $targetFullGalleryPathhref = "";
                        }
                        
                        $crusemaparray[$crusemap] =  "crusingschedulemap".$crusemap;

                        $fleetlocationimages = $locationimages[$schedule['CharterProgramSchedule']['id']];

                        ?>
                       
                       <div class="inputContainer_div">
                            <div class="loc_desc_div">
                                <div>
                                <span style="display: inline-block;position: relative;"><img src="<?php echo $markerimage; ?>" style="object-fit: fill; height: 35px;" alt="" ><span style="position: absolute;color:#000;top: 4px;right: 10px;"><?php echo $daynumber; ?></span></span>
                                <input type="text" name="title" value="<?php echo htmlspecialchars($schedule['CharterProgramSchedule']['title']); ?>" placeholder="Enter the Title" class="loc_name" readonly/>
                                   
                                </div>
                            <div class="icons_fields">
                                <i style="color: #00a8f3;" class="fa fa-solid fa-calendar"><span class="icon_label" ><?php echo $schedule['CharterProgramSchedule']['day_dates']; ?></span></i>
                                <i style="color: #00a8f3;" class="fa fa-solid fa-clock-o "><span class="icon_label"><?php echo $markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['duration'];  ?></span></i>
                                <i style="color: #00a8f3;" class="fa fa-solid fa-ship" aria-hidden="true"><span class="icon_label" style="padding: 0px 0px 0px 5px;"><?php echo $markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['distance']; ?></span></i>
                                </div>
                                <div>
                                    <textarea class="form-control auto_resize loc_desc_field" name="messagestitle" rows="1" cols="50"><?php echo $schedule['CharterProgramSchedule']['notes']; ?></textarea>
                                </div>
                            </div>
                            <div class="loc_img_div">
                                <div class="loc_map_div fancyboxmap" id="crusingschedulemap<?php echo $crusemap; ?>">
                                
                                </div>
                                <div class="loc_img_prev">
                                <a href="<?php echo $titleimagehref; ?>" rel="galleryloc<?php echo $crusemap; ?>" data-thumbnail="<?php echo $titleimagehref; ?>" class="<?php echo $fancybox; ?>"><img src="<?php echo $titleimage; ?>" style="object-fit: fill; width: 100%;height: 150px;" alt="" ></a>
                               <?php if(isset($fleetlocationimages) && !empty($fleetlocationimages)){ 
                                    $fleetlocationimages =  array_unique($fleetlocationimages);
                                    foreach($fleetlocationimages as $name){
                                        if(!empty($name)){ ?>
                                            <a href="<?php echo $targetFullGalleryPathhref; ?><?php echo $name ?>" data-thumbnail="<?php echo $targetFullGalleryPathhref; ?><?php echo $name ?>"  rel="galleryloc<?php echo $crusemap ?>" class="<?php echo $fancybox; ?>"><img src="<?php echo $name; ?>" style="object-fit: fill;width: 100%; height: 150px;display:none;" alt="" ></a>
                                            <?php  }
                                    }
                                } ?>
                                </div><span style="margin: 5px auto;width: fit-content;display: flow-root;">
                               <?php if(isset($fleetlocationimages) && !empty($fleetlocationimages)){ 
                                    $fleetimagecount = count($fleetlocationimages)+1;
                                    if($fleetimagecount > 1){
                                         for($k=0; $k<$fleetimagecount; $k++){ ?>
                                                    <i class="fa fa-dot-circle-o" aria-hidden="true" style="
                                            font-size: 8px;
                                            color: darkslategray;"></i>&nbsp;
                                <?php       }
                                    }
                                    }?></span>
                            </div>
                       </div>
                       <input type="hidden" id="charterprogramuuid" value="<?php echo $schedule['CharterProgramSchedule']['charter_program_id']; ?>">
                    <?php  } 
                   
                $crusemap++;
                } ?>
                </div>
                    </div>
            </div>
        </div>
    </div>
</div><!-- /.modal-content -->


<div id="markerModal" class="modal certificat-modal-container cruising-location-Modal"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content Mark_modal" id="markerModal_id">
            <div class="modal-header" style="border-bottom: 0px solid #e5e5e5;">
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
                <div style="color: #000;font-size: 15px;text-align:center;width:100%!important;margin: 0px 0px 5px 0px;padding: 8px 5px;font-weight: 600;"><span id="embarkation"></span> to <span id="debarkation"></span> </div>
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


<div class="row common-form-row">
    <div class="w-33 col-lg-4 col-md-4 col-sm-4 mob-none">  
        <span class="lgdev" style="font-size: 18px;color:#fff;"><?php echo $schedulePeriod; ?></span>
        <span class="mddev" style="font-size: 18px;color:#fff;"><?php echo $schedulePeriodWithOutYear; ?></span>
        
    </div>
    <div class="w-20 col-lg-4 col-md-4 col-sm-4 text-center mob-none">  
    <span style="font-size: 18px;color:#fff;"><?php echo $scheduleLocation; ?>
        
    </div>
    <div class="w-33 col-lg-4 col-md-4 col-sm-4">
        <span style="font-size: 18px;color:#fff;float:right;"><?php echo $charterName; ?></span>
        <?php if(empty($charterName)){ ?>
        <span style="font-size: 16px;color:#fff;float:right;"><?php echo $no_cruising_select; ?></span>
        <?php } ?>
<!--         <a>
            <span style="margin-left: 10%;" class="mob-none">   
                <?php echo $this->Html->link('Back','view',array('id' => 'charterProgramView', 'class' => 'btn btn-warning','title' => '<< Back'));?> 
            </span><span class="go-back-btn"><i class="fa fa-long-arrow-left"></i></span></a> -->
        </span>
    </div>
</div> 

<div class="custom-popup" id="map" style="height: 600px;position:relative;outline:none;">
    <button id="CruisingButton">Cruising Schedule</button>
    <button id="HideDetails">Show Details</button>
    <button id="HelpfulTips">Helpful Tips</button>
</div>
<?php if(empty($no_cruising_select)){?>
<?php } ?>

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
        } else {
            sidebarIsVisible = false;
        }
    }
})();

</script>


<script>
/* orientationchange start */
document.addEventListener('orientationchange', () => {
  document.documentElement.style.height = `initial`;
  setTimeout(() => {
    document.documentElement.style.height = `100%`;
      setTimeout(() => {
        // this line prevents the content
        // from hiding behind the address bar
        window.scrollTo(0, 1);
      }, 500);
  }, 500);
});
/* orientationchange end */

 var guesttype = '<?php echo $guesttype;?>';
var basefolder = '<?php echo $basefolder;?>';
var vessel = new L.LayerGroup();
var markerArray = [];
var markerCount = 0;
     
var mbAttr = '<table width=100%><thead><tr style="font-size:12px;font-weight:bold;text-align:center;"><td style="width:33%;border-radius: 12px;overflow: hidden;background: #fff;"><i class="fa fa-solid fa-ship map_bottom_attr" aria-hidden="true"></i>Distance<span style="color:#00a8f3;"><br><?php echo $RouteDatadisplaydistancevalue; ?></span></td><td style="width:33%;border-radius: 12px;overflow: hidden;background: #fff;"><i class="fa fa-solid fa-clock-o map_bottom_attr" aria-hidden="true"></i>Duration<span style="color:#00a8f3;"><br><?php echo $RouteDatadisplayduration; ?></span></td><td style="width:34%;border-radius: 12px;overflow: hidden;background: #fff;"><i class="fas fa-gas-pump fa-solid map_bottom_attr" aria-hidden="true"></i>Fuel<span style="color:#00a8f3;"><br><?php echo $RouteDatatotalconsumption; ?></span></td></tr></thead><tbody><tr style="font-size:12px;color:#00a8f3;font-weight:bold;text-align:center;"><td></td><td></td><td></td></tr></tbody></table>';
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

satellite.on('loading', function (event) {
  console.log('start loading tiles');
});
satellite.on('load', function (event) {
  console.log('all tiles loaded');
});
var map = L.map('map', {
    //center: [39.73, -104.99],
    'zoom': 6,
    'measureControl': true,
    'worldCopyJump': false,
    'layers': [satellite],
    'inertia' : '*',
    'inertiaDecelartion' : 3000,
    'inertiaMaxSpeed'    : 'Infinity',
    'inertiaThershold'   : 32,
    //'crs': L.CRS.Simple,
});
<?php 
if(isset($crusemaparray) && !empty($crusemaparray)){
foreach($crusemaparray as $key => $val){ ?>

var locsatellite = "schloc"+"<?php echo $key; ?>";


locsatellite = L.tileLayer(mbUrl, {
    id: 'ciurvui5100uz2iqqe929nrlr',
    unloadInvisibleTiles: false,
    reuseTiles: true,
    updateWhenIdle: false,
    continousWorld: true,
    noWrap: false,
});

var idlocmap = "<?php echo $val ?>";
    idlocmap = L.map('<?php echo $val ?>', {
    center: [39.73, -104.99],
    'zoom': 5,
    'measureControl': true,
    'worldCopyJump': false,
    'layers': [locsatellite],
    'inertiaDecelartion': 3000,
    'inertiaMaxSpeed': 1500,
    'inertiaThershold': 32,
    //'crs': L.CRS.Simple,
});

setTimeout(() => {
    idlocmap.invalidateSize();
}, 0);

// removed control zoom in and out from modal
$("#<?php echo $val; ?> .leaflet-control-container").hide();
<?php }
}
?>
//modalmap
var modalmapsatellite = L.tileLayer(mbUrl, {
    id: 'ciurvui5100uz2iqqe929nrlr',
    unloadInvisibleTiles: false,
    reuseTiles: true,
    updateWhenIdle: false,
    continousWorld: true,
    noWrap: false,
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
                                    });
        modalmap.addLayer(modalmapsatellite);
    }

var centerLat = 40.58058466412764;
var centerLng = -35.85937500000001;
var centerLatDay1 = 40.58058466412764;
var centerLngDay1 = -35.85937500000001;
var zoom = 3;
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
    if($schedule['CharterProgramSchedule']['marker_msg_count'] == 0){
        $marker_msg_count = "style='display:none;'";
    }else if($schedule['CharterProgramSchedule']['marker_msg_count'] != 0){
        $marker_msg_count = "";
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
        
        var marker = L.marker(["<?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>", "<?php echo $schedule['CharterProgramSchedule']['longitude']; ?>"],{pmIgnore: true})
        .bindTooltip("<?php echo "<span class='smalltooltip'>Day ".$daynumber."</span><span class='owntooltip' id=".$key."><b style='font-size: 12px;'>".$SumDaytitle."</b><b style='font-size: 12px;'>".$schedule['CharterProgramSchedule']['title']."<hr>".$endplace."</b><br><b style='font-size: 12px;'>".$distance.$bar.$duration."</b></span>"?>", 
                    {
                        permanent: true, 
                        offset: [0,-40],
                        direction: 'right',
                        className: "Tooltip",
                        noWrap: false,
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
        marker.distancetotal = "<?php echo $markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['distance']; ?>";
        marker.durationtotal = "<?php echo $markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['duration'];  ?>";
        marker.consumptiontotal = "<?php echo $markertotal[$schedule['CharterProgramSchedule']['title'].' - Day '.$schedule['CharterProgramSchedule']['day_num']]['consumption']; ?>";
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

    $markernumberDisplay = $schedule['CharterProgramSchedule']['day_num'];
    ?>

    var textMarker = L.marker(["<?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>", "<?php echo $schedule['CharterProgramSchedule']['longitude']; ?>"], {
  icon: L.divIcon({
      html: "<?php echo $markernumberDisplay; ?>",
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
var modalrouteline = new Array();
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
var polyline0 = new L.Polyline(latlongstemp, {stroke:true,weight:2.5,dashArray: [5,5],color:'#fff',lineCap: "round",lineJoin: "round",smoothFactor: 3}).addTo(map);
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
console.log(modalrouteline);

setTimeout(() => {
        map.invalidateSize();
    }, 0);
    
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


/***********************************************Help icon************/
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
    // var disp = $(".Tooltip").css("display");
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
        // $(".leaflet-tooltip").css("opacity", "0");  
        // setTimeout(function(){
        //         $(".leaflet-tooltip").css("opacity", "1");  
        $(".acti-count-onmarker").hide();
        // },1000);
    }else if(btntext == "Hide Details"){
        //$(".Tooltip").css("margin-top","35px");
        $(".Tooltip").css("width","50px");
        $(".smalltooltip").show();
        $(".Tooltip").hide();
        $(".owntooltip").hide();
        $("#HideDetails").text("Show Details");
        $(".acti-count-onmarker").hide();
        $('.text-below-marker').each(function(i, obj) {
            var t = $(this).find('.acti-count-onmarker').text();
            //console.log(t);
            if(t > 0){
                $(this).find('.acti-count-onmarker').hide();
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
<?php if(isset($scheduleData)){ ?>
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
            data: { "programId": scheduleId,"scheduleId":scheduleUUId,"tablepId":tablepId ,"diffDays": <?php echo $diffDays; ?>, "markerNum": markerNum, "lattitude": lattitude, "longitude": longitude,"guesttype":guesttype,"counttitle":counttitle, "daytitle":daytitle, "scheduleSameLocationUUID":scheduleSameLocationUUID, "samelocationsDates":samelocationsDates, "from":'locationcard','ipaddb':'<?php echo $ipadappdb; ?>'},
            success:function(result) {
                
                if (result.status == 'success') {
                    var width = $(window).width();
                    $("#hideloader").hide();
                    map.setView(e.latlng);
                    $(".leaflet-control-attribution").hide();
                    $("#CruisingButton").hide();
                    $("#HideDetails").hide();
                    $("#HelpfulTips").hide();
                    $(".leaflet-control-container").hide();
                    fitzoommap = [];
                    var popLocation= e.latlng;
                    // var popup = L.popup({keepInView:true,maxHeight:500})
                    // .setLatLng(popLocation)
                    // .setContent(result.popupHtml)
                    // .openOn(map)
                    // .on("remove", function () {
                    //         //msgcount();
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

                    window.scrollTo(0, 0);
                    $(".leaflet-control-attribution").hide();
                    $(".leaflet-popup-close-button").addClass('updateCommentscount');
                   // $('.day_dates').text(day_dates);
                   $('.noofdayscard').html(result.no_of_days_options);
                    $("#closeSchedule").remove();
                    $(".crew_comment_cruisingmaptitle").remove();
                    $(".crew_comment_cruisingmap").remove();
                    $(".leaflet-popup-close-button").remove();
                     // to get reduce msgcount
                    //  $(popup._closeButton).one('click', function(e){
                    //     //msgcount();
                    //     $("#CruisingButton").show();
                    //     $("#HideDetails").show();
                    //     $("#HelpfulTips").show();
                    //     $(".leaflet-control-attribution").show();
                    //     $(".leaflet-control-container").show();
                    // });
                    if(result.modaldisplayDate){
                        var dateformarker = result.modaldisplayDate;
                        $(".charter_from_date_conv").text(dateformarker);
                    }
                    //alert(width);
                    //for screenview <990 on opening the itinerary modal blacked out the map region
                    // on close modal removed the blacked out css
                    if(width<990){
                        customMediaQueryAdd();
                        
                    }else if(width>990){
                        customMediaQueryRemove();
                    }

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

                                                                $('.markersnamesmodalmap')
                                                                    .append($("<option></option>")
                                                                        .attr("id", "marker_" + value.scheduleId)
                                                                        .attr("data-lat", value._latlng.lat)
                                                                        .attr("data-long", value._latlng.lng)
                                                                        .attr("data-schid", value.scheduleId)
                                                                        .attr("data-daynum", value.day_num)
                                                                        .attr("value", value.daytitle +' - Day '+value.day_num)
                                                                        .text(value.daytitle +' - Day '+value.day_num)
                                                                    );
                                                                    //temptitle.push(value.daytitle);
                                                        //}

                                        });
                                    }

                                // $("#frommarker").val(selectedmarkertitle +' - Day '+selectedmarkerday_num);
                                // $("#frommarkerlat").val(lattitude);
                                // $("#frommarkerlong").val(longitude);

                                $(".markerdistance").text(distancetotal);
                                $(".markerduration").text(durationtotal);
                                
                                //$(".markerconsumption").text(consumptiontotal);


                                var frommarker = selectedmarkertitle +' - Day '+selectedmarkerday_num; //alert('llll')
                                routeexists = 1;
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
                                var routemodalmarker = L.marker([lattitude, longitude], {
                                    draggable: false,
                                    pmIgnore: true
                                }).bindTooltip(tooltipcontent, {
                                    permanent: true,
                                    direction: 'right',
                                    className: "Tooltipmodalmap",
                                    noWrap: false,
                                });
                                routemodalmarker.addTo(modalmap);

                                var textMarkermodalmap = L.marker([lattitude,longitude], {
                                icon: L.divIcon({
                                    html: selectedmarkerday_num,
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
<?php } ?>

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
routemodalmarkerselected = L.marker([selectedlat,selectedlong], {
    draggable: false,
    pmIgnore: true
});
// .bindTooltip(selectedmarkertooltipcontent, {
//     permanent: true,
//     direction: 'right',
//     className: "Tooltipmodalmap",
//     noWrap: false,
// });
routemodalmarkerselected.addTo(modalmap);
// adding day number to marker
textMarkermodalmap = L.marker([selectedlat,selectedlong], {
icon: L.divIcon({
    html: modalmapdaynumber,
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


function drawrouteinmodal(frommarker) { //alert();
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
    //console.log(nextmarkername);
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
        const myArrayFrom = frommarker.split("-");
        let fromword = myArrayFrom[0];
        const myArrayTo = nextmarkername.split("-");
        let toword = myArrayTo[0];
        $("#embarkation").text(fromword);
        $("#debarkation").text(toword);
        var specificline = "";
            specificline = tempdrawrouteline;
        var drawnItemsModalMap = new L.FeatureGroup();
        
        var polyLayersModalMap = [];
        var   polyline2 = new L.polyline(specificline, {stroke:true,snakingSpeed: 200,weight:2.5,dashArray: [5,5],color:'#fff',lineCap: "round",lineJoin: "round",smoothFactor: 1});

        polyLayersModalMap.push(polyline2)

        // Add the layers to the drawnItemsModalMap feature group 
 
        for (let layer of polyLayersModalMap) { //console.log(layer);
            drawnItemsModalMap.addLayer(layer);
        }
       
        modalmap.fitBounds(drawnItemsModalMap.getBounds());
        modalmap.addLayer(drawnItemsModalMap);
        
        drawnItemsModalMap.snakeIn();

        // setTimeout(() => {
        //     modalmap.fitBounds(polyline2.getBounds());
        // }, 100);
        setTimeout(() => {
            modalmap.invalidateSize();
        }, 0);

        
    //}
        
    }

}

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

                             // Removed the layer on close the route modal to clear any changes done and not saved.
                             modalmap.eachLayer(function (layer) {
                                modalmap.removeLayer(layer);
                            });
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
  //alert('gg')
  
   $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: basefolder+"/"+"charters/editCharterProgramSchedules",
            dataType: 'json',
            data: {"programId":scheduleId,"tablepId":tablepId ,"scheduleId": selectedschuuid, "diffDays": <?php echo $diffDays; ?>, "yachtId": yachtId,"counttitle":counttitle, "daytitle":daytitle, "guesttype":"guest","scheduleSameLocationUUID":scheduleSameLocationUUID, "samelocationsDates":samelocationsDates, "from":'daysselection','selecteddatetext':selecteddatetext,'ipaddb':'<?php echo $ipadappdb; ?>' },
            success:function(result) {
               
                if (result.status == 'success') {
                    var width = $(window).width();
                    $("#hideloader").hide();
                    //console.log(mapmarkerglobalObj);
                    map.setView(mapmarkerglobalObj.latlng);
                    
                    var popLocation= mapmarkerglobalObj.latlng;
                   
                    $(".leaflet-control-attribution").hide();
                    $("#CruisingButton").hide();
                    $("#HideDetails").hide();
                    $("#HelpfulTips").hide();
                    $(".leaflet-control-container").hide();
                    setTimeout(function() {
                        
                    // var popup = L.popup({
                    //     autoPan: true
                    //     })
                    // .setLatLng(popLocation)
                    // .setContent(result.popupHtml)
                    // .openOn(map)
                    // .on("remove", function () {
                    //         //msgcount(scheduleSameLocationUUID);
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


                        window.scrollTo(0, 0);
                        //$('.day_dates').text(day_dates);
                        $(".leaflet-control-attribution").hide();
                    $(".leaflet-popup-close-button").addClass('updateCommentscount');
                   // $('.day_dates').text(day_dates);
                   $('.noofdayscard').html(result.no_of_days_options);
                    $("#closeSchedule").remove();
                    $(".crew_comment_cruisingmaptitle").remove();
                    $(".crew_comment_cruisingmap").remove();
                    $(".leaflet-popup-close-button").remove();
                     // to get reduce msgcount
                     $(popup._closeButton).one('click', function(e){
                        
                        $("#CruisingButton").show();
                        $("#HideDetails").show();
                        $("#HelpfulTips").show();
                        $(".leaflet-control-attribution").show();
                        $(".leaflet-control-container").show();
                    });

                        //alert(width);
                        //for screenview <990 on opening the itinerary modal blacked out the map region
                        // on close modal removed the blacked out css
                        if(width<990){
                            customMediaQueryAdd();
                            
                        }else if(width>990){
                            customMediaQueryRemove();
                        }
                    }, 1000);
                     
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

$(document).on("click", "#CruisingButton", function(e) {

    var scheduleId = $("#charterProgramId").val();
    // $("#hideloader").show();
    //     $.ajax({
    //         type: "POST",
    //         url: basefolder+"/"+"charters/getIpadViewCharterProgramSchedules",
    //         dataType: 'json',
    //         data: { "scheduleId": scheduleId},
    //         success:function(result) {
    //             $("#hideloader").hide();
    //             if (result.status == 'success') {

    //                 $("#cruisinglocationModal_load").html(result.popupHtml);
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
                    //$(".crew_comment_cruisingmaptitle").remove();
                    $(".crew_comment_cruisingmap").remove();
                    $(".leaflet-popup-close-button").remove();
                     
        //         }
        //     },
        //     error: function(jqxhr) { 
        //         $("#hideloader").hide();
        //     }
        // });

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
                transitionIn: 'none',
                transitionOut: 'none',
                openEffect: 'none',
                closeEffect: 'none',
                // transitionIn : 'fade',
                // transitionOut: 'fade',
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
            $('.fancyboxmap').fancybox({
            //maxWidth	: 400,
                //maxHeight	: 600,
                fitToView	: true,
                width		: '100%',
                height		: '100%',
                autoSize	: true,
                closeClick	: false,
                autoScale   : true,
                transitionIn : 'none',
                transitionOut: 'none',
        });
            $(".Tooltip").css("width","50px");
                $(".smalltooltip").hide();
                $(".Tooltip").hide();
                $(".owntooltip").hide();
            //When page opens do not display location cards until 2 seconds after page loads. 
            // $(".leaflet-tooltip").css("opacity", "0");  
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
                    ('.CruisingCommentMarkUnread').attr('data-yachtid', yachtid);
                    //alert(data.isfleet);
                    $("#hideloader").hide();
                    //thisObj.css("color","green");
                    var color = thisObj.css("color");
                        //alert(color);
                        var colorgreen = hexc(color);
                        
                        if(colorgreen == "#ff0000"){
                            thisObj.css("color","green");
                        }

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
            var color = thisObj.css("color");
            //alert(color);
            var colorgreen = hexc(color);
            //alert(colorgreen);
            if (colorgreen == "#ff0000") {
                thisObj.css("color", "green");
            }
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
	                    $('#cruisingmsgmyModal').modal('hide');
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

    $(document).on("click", "#cruisinglocationModalclose" ,function() {
        $('#cruisinglocationModal').hide();
        $(".leaflet-control-attribution").show();
        $(".leaflet-control-container").show();
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


    function msgcount(){
    //console.log(e);
    var charterpgid = $(".mapPopup").attr('data-schuuid'); 
    //alert(charterpgid);
    var yachtId = $("#yachtId").val();
    if(charterpgid){
                    $("#hideloader").show();
                    var data = { "charterpgid": charterpgid,'yachtId':yachtId};
                    $.ajax({
                    type: "POST",
                    url: basefolder+"/"+"charters/getIndividualmsgcountMarer",
                    dataType: 'json',
                    data: data,
                    success:function(result) {
                        $("#hideloader").hide();
                        var mcount = result.status;
                        $("#"+charterpgid).text(mcount);
                        if(mcount == 0){
                            $("#"+charterpgid).css('display','none');
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

        //alert(templatechecklistId);
        $.ajax({
                type: "POST",
                dataType: 'json',
                url: basefolder+"/"+"charters/markCommentUnread",
                data: {'activityId': activityId,'userType': user_type,'user_name':user_name,'activity_name':activity_name, 'comments':comments,'comment_id':comm_id,'chartertype1':chartertype1,'yachtId':yachtId},
                success:function(data) {
                    if(data.success == 'success'){
	                    $('#cruisingmsgmyModal').hide();
                        thisObj.css("color","red");
                    
                    }
                }
       }); 
    });

    $(document).on("focus", ".textareacont" ,function() {
        //console.log('testse');
        $(this).animate({
                 height: "14em"
                }, 500);

                $(this).css({
                    overflow:"scroll"
                });
                
    });

    $(document).on("blur", ".textareacont" ,function() {
        //console.log('sss');
        $(this).animate({
                 height: "7em"
                }, 500);

                $(this).css({
                    overflow:"scroll"
                });
    });

    

    $(document).on("click", ".textareacontmarker" ,function() {
        
        var valuetxt = $(this).val();

        if(valuetxt != ""){
                //console.log("webopen");
                $(this).animate({
                        height: "14em"
                        }, 500);

                        // $(this).css({
                        //     overflow:"scroll"
                        // });
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
        
    
</script>
  
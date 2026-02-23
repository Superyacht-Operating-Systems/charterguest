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
<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>
<script src="https://api.windy.com/assets/map-forecast/libBoot.js"></script>
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

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
<style>

#windy #embed-zoom {
        position: fixed;
    }
    #windy #mobile-ovr-select {
  position: fixed;
    }

    #windy #plugin-menu {
    z-index: 999999;
    position: fixed;
    top: 0;
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

    .loc_desc_div .form-control:focus {
 box-shadow: none !important;
}

.marker_desc_div .form-control:focus, .m_loc_desc_div .form-control:focus {
 box-shadow: none !important;
}
    button.close {
  padding: 0px 0px 3px 0px;
}
    .container-row-all{
        margin-top: 0px!important;
    }
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
/* border: solid 1px #ccc; */
width: 150px;
overflow: hidden;
height: 150px;
margin-bottom: 10px;
border-top-left-radius: 10px;
border-top-right-radius: 10px;
border-bottom-left-radius: 10px;
border-bottom-right-radius: 10px;
/* border-radius: 10px;
-webkit-border-radius: 10px !important;
-moz-border-radius: 10px !important;
-khtml-border-radius: 10px !important;
display:flex; */
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
border: 0px solid rgb(204, 204, 204) !important;
border-radius: 10px !important;
-webkit-border-radius: 10px !important;
-moz-border-radius: 10px !important;
-webkit-appearance: none;
overflow: hidden;
    }

    #modalmapcruisingsch{
        height: 500px;
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
margin:0 auto;
border: 1px solid rgb(204, 204, 204) !important;
border-radius: 10px !important;
-webkit-border-radius: 10px !important;
-moz-border-radius: 10px !important;
overflow: hidden;

    }

    #modalmapcruisingsch{
        height: 500px;
width: 100%;
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
background: rgba(0,0,0,0.8) !important;
}
.certificat-modal-container {
  background-color: #000 !important;
  z-index: 99999;
}
.markercs-modal-container{
    z-index: 99999;
    background-color: #000 !important;
}
.markercs-modal-container .modal-dialog{
    margin: 10px auto;
}
.fancybox-opened {
    z-index: 999999!important;
    opacity: 1 !important;
}
.fancybox-mobile, .fancybox-desktop {
  z-index: 999999 !important;
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
border: 1px solid rgb(204, 204, 204) !important;
border-radius: 10px !important;
-webkit-border-radius: 10px !important;
-moz-border-radius: 10px !important;
-khtml-border-radius: 10px !important;
-webkit-appearance: none;
overflow: hidden;
    }
    #modalmapcruisingsch{
        height: 500px;
width: 100%;
border: 3px solid rgb(204, 204, 204) !important;
border-radius: 10px !important;
-webkit-border-radius: 10px !important;
-moz-border-radius: 10px !important;
-khtml-border-radius: 10px !important;
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
border: 1px solid rgb(204, 204, 204) !important;
border-radius: 10px !important;
-webkit-border-radius: 10px !important;
-moz-border-radius: 10px !important;
-khtml-border-radius: 10px !important;
-webkit-appearance: none;
overflow: hidden;
    }
    #modalmapcruisingsch{
        height: 500px;
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
  width: 650px;
  margin: 10px auto;
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
    margin-left: 95px;
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
  border-radius: 10px;
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
  border-radius: 10px;
}
#WeatherMap {
    background: #fff !important;
    position: absolute!important;
    top: 131.5px!important;
    right: 13px!important;
  padding: 5px;
  /* height: 32px; */
  color:#000;
  z-index: 9999;
  font-weight:bold;
  min-width: 121px;
  border-radius: 10px;
  /* font-size: 12px; */
}
#GuestNews {
    background: #fff !important;
    position: absolute!important;
    top: 170px!important;
    right: 13px!important;
  padding: 5px;
  /* height: 32px; */
  color:#000;
  z-index: 9999;
  font-weight:bold;
  min-width: 121px;
  border-radius: 10px;
  /* font-size: 12px; */
}

@media(max-width: 1092px){
#HideDetails, #HelpfulTips,#WeatherMap,#GuestNews {
    width: 137px;
    font-size: 12px;
    height: 32px;
    padding: 0px!important;
}
#closeWeatherMap {
    margin-left: 5px;
}
}
@media (max-width: 767px){
#HideDetails, #HelpfulTips,#WeatherMap,#GuestNews {

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
#closeWeatherMap {
    margin-left: 5px;
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
    margin:0px 10px 5px 8px;
}
#closeSchedule{
        margin-left: 6px;
    }
@media screen and (min-width: 990px) {
.location_Modal_body{
    /* max-height: 580px; */
    height: 90vh;
    overflow-y: scroll;
    overflow-x: hidden;
}
}
@media screen and (max-width: 990px) {
  
    .markmodalbody{
        max-height: 94vh;
    overflow-y: scroll;
    overflow-x: hidden;
   
    }
    .markmodal_load{
        margin: 5px 0px 5px 8px;
    padding: 0px 10px 100px 0px;
    }
    .modal_load{
        max-height: 91vh;
    overflow-y: scroll;
    overflow-x: hidden;
    margin: 0px 0px 5px 8px;
    padding: 0px 10px 100px 0px;
    }
    .cruising-location-Modal .modal-content{
       height: 98vh!important;
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

.text-below-marker-locsch {
    font-size: 11px;
    font-weight: 1px solid;
    /* z-index:9999 !important; */
    margin-top: -35px !important;
    /* margin-left: -3px !important; */
color: #000;
/* background-color: #fff;
border-radius: 4px; */
    
}

.text-below-marker {
    font-size: 11px;
    font-weight: 1px solid;
    /* z-index:9999 !important; */
    margin-top: -35px !important;
    margin-left: -6px !important;
color: #000;
background-color: #fff;
border-radius: 4px;
   
    
}

.text-below-marker-modalmap {
    font-size: 11px;
    font-weight: 1px solid;
    margin-top: -35px !important;
    /* margin-left: -3px !important; */
color: #000;
background-color: #fff;
border-radius: 10px;
    /* z-index:9999 !important; */
}

#fancybox-thumbs{
    z-index: 9999999 !important;
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

body.modal-open {
    overflow: hidden;
    overflow-y: hidden;
}

.modal-open .modal{
    overflow: hidden;
    overflow-y: hidden;
}

</style>  

<?php    echo $this->Html->script('jquery-1.7.2.min');
        // echo $this->Html->script('fancybox/jquery.fancybox');
        // echo $this->Html->css('fancybox/jquery.fancybox');
        // echo $this->Html->script('fancybox/jquery.fancybox-thumbs');
        // echo $this->Html->css('fancybox/jquery.fancybox-thumbs');
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





<!--help modal start here-->


<!-- sample modal content -->






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

        </span>
    </div>
</div> 

<div class="custom-popup" id="windy" style="height: 600px;position:relative;outline:none;">
</div>
<div class="custom-popup" id="map" style="height: 100px;position:relative;outline:none;">
</div>

<!-- <button id="closeWeatherMap">Close</button> -->

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
    var latlngs = [];
<?php 
if(!empty($scheduleData)){
   foreach ($scheduleData as $key => $schedule) {  ?>

    latlngs.push(new L.LatLng(<?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>, <?php echo $schedule['CharterProgramSchedule']['longitude']; ?>));

    <?php } }?>
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

 
 /********************************Assigning day number to last marker ************ */ 
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

satellite.on('loading', function (event) {
  //console.log('start loading tiles');
});
satellite.on('load', function (event) {
  //console.log('all tiles loaded');
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

    

$(document).ready(function() { //alert();

    $("#map").css("visibility","hidden");
    //$("#closeWeatherMap").css("display","none");
   
    });
    //var latlngs = [];

var DBHeading = "<?php echo $AisPosition['COG']; ?>";
var DBTrueHeading = "<?php echo $AisPosition['TrueHeading']; ?>";
var DBLongitude = "<?php echo $AisPosition['Longitude']; ?>";
var DBLatitude = "<?php echo $AisPosition['Latitude']; ?>";
// var DBLongitude = "<?php echo $testlong; ?>";
// var DBLatitude = "<?php echo $testlat; ?>";
var boatMarker = L.boatMarker([DBLatitude,DBLongitude], {
			    color: "#00a7f2"
			}).addTo(map);

			boatMarker.setHeading(DBHeading);
            boatMarker.setSpeed(DBTrueHeading);

			var heading = DBHeading;

const optionsWind = {
    // Required: API key
    key: '1cDk7fz9oF31QBPeqDjg6LwhBw6Z5wJ9', // REPLACE WITH YOUR KEY !!!

    // Changing Windy parameters at start-up time
    // (recommended for faster start-up)
    // Put additional console output
    verbose: true,

    // Optional: Initial state of the map
    //  lat: DBLatitude,
    //  lon: DBLongitude,
    //  zoom: 6,
};

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
});









</script>
  
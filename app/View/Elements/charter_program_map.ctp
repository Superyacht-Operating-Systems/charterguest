<?php 
$isFleetUser = $this->Session->read('loggedUserInfo.is_fleet');
$userType = $this->Session->read('loggedUserInfo.user_type');
$basefolder = $this->request->base; 

$options = "";
for ($i = 0; $i < $diffDays; $i++) {
    $j = $i + 1;
    $options .= '<option value="'.$j.'">Day '.$j.'</option>';
}

$schedulePeriod = "";
$charterName = "";
$scheduleLocation = "";
if (isset($charterProgData) && !empty($charterProgData)) {
    $schedulePeriod = date_format(date_create($charterProgData['CharterProgram']['charter_from_date']), "M dS Y")." - ".date_format(date_create($charterProgData['CharterProgram']['charter_to_date']), "M dS Y");
    $charterName = $charterProgData['CharterProgram']['charter_name'];
    $scheduleLocation = $charterProgData['CharterProgram']['embarkation']." to ".$charterProgData['CharterProgram']['debarkation'];
}

?>
<?php
echo $this->Html->script('leaflet/leaflet'); 
echo $this->Html->css('leaflet/dist/leaflet');
?>
<style>
.common-form-row{margin-top: 55px;margin-bottom: 10px;}


.custom-popup .leaflet-popup-content-wrapper {
  background:#fff;
  color:#fff;
  font-size:16px;
  line-height:24px;
   width: 400px;
}
.custom-popup .leaflet-popup-content-wrapper a {
  color:rgba(255,255,255,0.5);
}
.custom-popup .leaflet-popup-tip-container {
  width:30px;
  height:15px;
}
.custom-popup .leaflet-popup-tip {
  border-left:15px solid transparent;
  border-right:15px solid transparent;
  border-top:15px solid #2c3e50;
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
.custom-popup .leaflet-popup-content select {
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
@media screen and (max-width: 767px) {
.custom-popup .leaflet-popup-content-wrapper {
   width:300px;
}
.location-tag{text-align: center!important;width: 100%;}
.back-btn {background: rgba(66, 117, 230, 0.39);
    padding: 10px 0px;
    position: fixed!important;
    z-index: 9999;
    margin-top: 20px!important;
}
.nav-side-menu{display: block;}
.common-form-row .mob-none{display: none;}
.common-form-row{margin-top: 30px;margin-bottom:0px;}
}


</style>  

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
        <ul class="menu-level1 no-style nav nav-pills nav-justified">
          <li><a href="<?php echo $baseFolder."/charters/view"; ?>">Guest List</a></li>
           <li><?php echo $this->Html->link('Cruising Map','view',array('id' => 'charterProgramView', 'title' => 'Cruising Map '));?></li>
           <li><a>How To Video</a></li>
         <li class="list-logout-row"><?php echo $this->Html->link($this->Html->image("admin/table.png", array("alt" => "Logout","title" => "Logout")).'  Logout','/',array('escape' =>false,'title' => 'Logout'));?></li>
        </ul>
    </nav>
</section>
</div>
</div>
</div>


<div class="row common-form-row">
    <div class="col-lg-4 col-md-4 col-sm-4 mob-none">  
        <span style="font-size: 18px;"><?php echo $schedulePeriod; ?></span>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 text-center mob-none">  
        <span style="font-size: 18px;"><?php echo $charterName; ?></span>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 text-right location-tag"> 
        <span style="font-size: 18px;"><?php echo $scheduleLocation; ?>
            <span style="margin-left: 10%;" class="mob-none">   
                <?php echo $this->Html->link('Back','view',array('id' => 'charterProgramView', 'class' => 'btn btn-warning','title' => '<< Back'));?> 
            </span>
            <span class="go-back-btn"><i class="fa fa-long-arrow-left"></i></span>
        </span>
    </div>
</div> 
<div class="personal-row-container">
    <h1 class="position-mobile-head">Cruising Map
</h1>
<div class="fixed-row-container">  
 <div class="form-group base-margin">
<div class="custom-popup" id="map" style="height:750px;"></div>
</div></div>

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

var basefolder = '<?php echo $basefolder;?>';
var vessel = new L.LayerGroup();
var markerArray = [];
var markerCount = 0;
     
var mbAttr = 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> ';
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
    'zoom': 5,
    'measureControl': true,
    'worldCopyJump': false,
    'layers': [satellite],
    'inertiaDecelartion' : 3000,
    'inertiaMaxSpeed'    : 1500,
    'inertiaThershold'   : 32,
    //'crs': L.CRS.Simple,
});
  

var centerLat = 31.548905;
var centerLng = 40.342777;
var centerLatDay1 = 31.548905;
var centerLngDay1 = 40.342777;
var zoom = 3;
var day1 = 0;
// Generating the markers for existing records
<?php foreach ($scheduleData as $schedule) { 
        if ($schedule['CharterProgramSchedule']['day_num'] == 1) {
        ?>
            day1 = 1;
            centerLatDay1 = <?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>;
            centerLngDay1 = <?php echo $schedule['CharterProgramSchedule']['longitude']; ?>;
        <?php } ?> 
            
        centerLat = <?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>;
        centerLng = <?php echo $schedule['CharterProgramSchedule']['longitude']; ?>;
        zoom = 7;
        
        var marker = L.marker(["<?php echo $schedule['CharterProgramSchedule']['lattitude']; ?>", "<?php echo $schedule['CharterProgramSchedule']['longitude']; ?>"])
                .bindTooltip("<?php echo "Day ".$schedule['CharterProgramSchedule']['day_num']." <br><b>".$schedule['CharterProgramSchedule']['title']."<b>"; ?>", 
                    {
                        permanent: true, 
                        direction: 'right'
                    })
                .on("click", markerOnClick);
        marker.scheduleId = "<?php echo $schedule['CharterProgramSchedule']['id']; ?>";
        marker.markerNum = markerCount; 
        markerArray.push(marker);
        marker.addTo(map);
        markerCount++;
<?php } ?>

// Making the Centre point
if (day1) {
    map.setView(new L.LatLng(centerLatDay1, centerLngDay1), zoom);
} else {
    map.setView(new L.LatLng(centerLat, centerLng), zoom);
}


function markerOnClick(e) {

    var scheduleId = e.target.scheduleId;
    var markerNum = e.target.markerNum;
    var lattitude = e.latlng.lat;
    var longitude = e.latlng.lng;
    if (scheduleId != "") {
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: basefolder+"/"+"charters/editCharterProgramSchedules",
            dataType: 'json',
            data: { "scheduleId": scheduleId, "diffDays": <?php echo $diffDays; ?>, "markerNum": markerNum, "lattitude": lattitude, "longitude": longitude },
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    var popLocation= e.latlng;
                    var popup = L.popup()
                    .setLatLng(popLocation)
                    .setContent(result.popupHtml)
                    .openOn(map);
                }
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    }
        
}

// Closing the popup
$(document).on("click", "#closeSchedule", function(e) {
    $(".leaflet-popup-close-button")[0].click();
});

</script>
 

<?php 
$isFleetUser = $this->Session->read('loggedUserInfo.is_fleet');
$userType = $this->Session->read('loggedUserInfo.user_type');
$basefolder = $this->request->base; 
$sessionCharterGuest = $this->Session->read('charter_info.CharterGuest');

$charter_assoc_info = $this->Session->read('charter_assoc_info');
?>
<div class="mapPopup sp-mp-detailsrow" data-schuuid="">
                <?php $markerimage = BASE_URL.'/charterguest/app/webroot/css/leaflet/dist/images/marker-icon-itinerary.png';
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
                   /* if(isset($guesttype) && !empty($guesttype)){ //echo $guesttype; exit;
                        if($guesttype == "guest"){
                                $marker_msg_count = "style='display:none;'";
                        }else{
                                $marker_msg_count = "";
                        }
                    }*/
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
                        //echo "<pre>"; print_r($locationComment); exit('vvvv');
                        //$locationCommentsdata = $locationComment[$schedule['CharterProgramSchedule']['id']];
                        if($key == 0){
                           // echo $locationComment[$schedule['CharterProgramSchedule']['title'].'-'.$daynumber]['colorcodetitle'];
                            $locationCommentsdata = $locationComment[$schedule['CharterProgramSchedule']['title']];
                            $sch_color_code = $locationComment[$schedule['CharterProgramSchedule']['title'].'-'.$daynumber]['colorcodetitle'];

                        }else{
                            //echo $schedule['CharterProgramSchedule']['to_location'].'-'.$daynumber;
                            $locationCommentsdata = $locationComment[$schedule['CharterProgramSchedule']['to_location']];
                            $sch_color_code = $locationComment[$schedule['CharterProgramSchedule']['to_location'].'-'.$daynumber]['colorcodetitle'];
                        }
                        
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
                                    <ul class="action-icon"><li><i class="<?php echo $locationCommentsdata['facomment']; ?> fa-comments sch_comment_<?php echo $schedule['CharterProgramSchedule']['UUID'];  ?> crew_comment_cruisingmaptitle sch_<?php echo htmlspecialchars($heading); ?>" data-rel="<?php echo $schuuid;//echo $locationCommentsdata['programScheduleUUID']; ?>" data-yachtid="<?php echo $locationCommentsdata['yacht_id']; ?>" data-tempname="<?php echo htmlspecialchars($heading); ?>" style="<?php echo $sch_color_code;//echo $locationCommentsdata['colorcodetitle']; ?><?php echo $displaynone; ?>float: right;"><input type="hidden" name=commentstitle value="" class="messagecommentstitle" /></i></li></ul>
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
                       </div>
                       <input type="hidden" id="charterprogramuuid" value="<?php echo $schedule['CharterProgramSchedule']['charter_program_id']; ?>">
                    <?php  //} 
                   
                $crusemap++;
                } //exit; ?>
                </div>
                    </div>

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
<script>
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

$(document).on("click", ".CSMPTooltip", function(e) {
    //alert();
    var myowntooltip = $(this).find('.CSMPown').attr('id');
    $(".mylocsh"+myowntooltip).click();
    
});
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




/***********************************On clicking marker tooltip open modal of that specific marker */
</script>
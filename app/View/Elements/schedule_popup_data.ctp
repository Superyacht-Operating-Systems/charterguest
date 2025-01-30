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
                        //echo "<pre>"; print_r($fleetlocationimages);
                        //$locationCommentsdata = $locationComment[$schedule['CharterProgramSchedule']['id']];
                        if($key == 0){
                            $locationCommentsdata = $locationComment[$schedule['CharterProgramSchedule']['title']];

                        }else{
                            $locationCommentsdata = $locationComment[$schedule['CharterProgramSchedule']['to_location']];

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
                                    <ul class="action-icon"><li><i class="<?php echo $locationCommentsdata['facomment']; ?> fa-comments sch_comment_<?php echo $schedule['CharterProgramSchedule']['UUID']  ?> crew_comment_cruisingmaptitle sch_<?php echo htmlspecialchars($heading); ?>" data-rel="<?php echo $locationCommentsdata['programScheduleUUID']; ?>" data-yachtid="<?php echo $locationCommentsdata['yacht_id']; ?>" data-tempname="<?php echo htmlspecialchars($heading); ?>" style="<?php echo $locationCommentsdata['colorcodetitle']; ?><?php echo $displaynone; ?>float: right;"><input type="hidden" name=commentstitle value="" class="messagecommentstitle" /></i></li></ul>
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

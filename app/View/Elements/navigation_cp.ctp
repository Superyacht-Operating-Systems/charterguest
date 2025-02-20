<?php 
$basefolder = $this->request->base; 

$date1 = date("Y-m-d", strtotime($cp_to_date));
$date2 = date('Y-m-d');

$dateTimestamp1 = strtotime($date1); 
$dateTimestamp2 = strtotime($date2);

?>
<nav class="menu"> 
        <ul class="menu menu-level1 no-style nav nav-pills nav-justified">
        
        <li> <a href="<?php echo $basefolder."/charters/programs/".$this->Session->read('guestListUUID');?>">Charter Programs</a> 
        <?php //echo "<pre>"; print_r($guestListData); exit; ?>
            <!-- only show guest type not email recipient -->
            <?php if($cp_guesttype != 'email_recipient'){ ?>
                <?php if(isset($guesttype) && $guesttype == "owner"){ if(isset($programFiles)){ ?>
        <li class="menu__item"> <a href="#">Charter Contracts</a>
            
                <ul class="submenu">
                    <?php  foreach($programFiles as $startdate => $filepath){ ?>
                    <li class="menu__item"><a href="#" data-href="<?php echo $filepath; ?>" class="downloadmappagefile"><?php echo $startdate; ?></a></li>
                    <?php
                            
                        } ?>
                </ul>
          
    
        </li>    
        <?php } } ?>
        <?php } ?>
        <li><a href="<?php echo $website; ?>" target="_blank" style="text-decoration:none;">Yachts Website</a></li>

         <?php if($map_url == 'link'){ ?>

            <?php //echo $guesttype; 
            if(isset($guesttype) && $guesttype == 'guest'){ ?>
                <li><a href="<?php echo $basefolder."/charters/charter_program_map/".$charter_program_id.'/'.$yachtdb.'/'.$guesttype.'/'.$allow_comments.''; ?>" title="Map is Published">Cruising Map</a></li>
            <?php }else{ ?>
                <li><a href="<?php echo $basefolder."/charters/charter_program_map/".$charter_program_id.'/'.$yachtdb.'/'.$guesttype.''; ?>" title="Map is Published">Cruising Map</a></li>
                
            <?php } ?>
            

        <?php }else{ ?>
            <li class="btnNoLink" data-value="<?php echo $id; ?>"><span datahover="Map is Not Published" title="Map is Not Published" role="button" title="Map is Not Published" aria-current="mapnolink">Cruising Map</span></li>
      
        <?php } ?>
        <li><a href="<?php echo $basefolder."/charters/crew_list/".$id."/".$charter_program_id."/".$fleetcompany_id.'/'.$guesttype.'/'.$allow_comments; ?>"><span class="" >Crew List</span></a></li>
              
        <?php //echo $is_head_charter; 
        if(isset($cp_guesttype) && !empty($cp_guesttype)){ 
            $guestTypes = explode(",", $cp_guesttype); // Convert string to array
            // Check if 'email_recipient' is NOT in the array
            //if (!in_array("email_recipient", $guestTypes)) {
            if($is_head_charter == 1 ){
        ?>
        <li class="menu__item"> <a href="<?php echo $basefolder.$guestlink; ?>">Guest List</a></li>
            <?php if ($dateTimestamp1 >= $dateTimestamp2){ ?>
            <li><a href="#"><span class="existingCheckFunction" data-guestype="guest" data-associd ="<?php echo $associd; ?>">Preference Sheets</span></a></li>
            <?php }else{ ?>
                <li><a href="<?php echo $basefolder."/charters/presentations/".$charter_program_id; ?>" target="_blank"><span class="" >Memories</span></a></li> 
            <?php } ?> 
        <?php } ?>
        <?php }else{ ?>
            <li class="menu__item"> <a href="<?php echo $basefolder.$guestlink; ?>">Guest List</a></li>
            <?php if ($dateTimestamp1 >= $dateTimestamp2){ ?>
            <li><a href="#"><span class="existingCheckFunction" data-guestype="owner" data-associd ="<?php echo $id; ?>">Preference Sheets</span></a></li>
            <?php }else{ ?>
                <li><a href="<?php echo $basefolder."/charters/presentations/".$charter_program_id; ?>" target="_blank"><span class="" >Memories</span></a></li> 
            <?php } ?> 
          
          
        <?php } ?>
        
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
   
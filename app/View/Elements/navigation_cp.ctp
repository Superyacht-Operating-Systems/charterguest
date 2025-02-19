<?php 
$basefolder = $this->request->base; 

?>
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
            <?php } } } ?>
    
        </li>    
        <li><a href="<?php echo $website; ?>" target="_blank" style="text-decoration:none;">Yachts Website</a></li>
        <li class="btnNoLink" data-value="<?php echo $id; ?>"><span datahover="Map is Not Published" title="Map is Not Published"><a   role="button" title="Map is Not Published" aria-current="mapnolink">Cruising Map</a></span></li>
        <li><a href="<?php echo $basefolder."/charters/crew_list/".$id."/".$charter_program_id."/".$fleetcompany_id; ?>"><span class="" >Crew List</span></a></li>
        <li class="menu__item"> <a href="<?php echo $basefolder.$guestlink; ?>">Guest List</a></li>
        <a href="#"><span class="existingCheckFunction" data-guestype="guest" data-associd ="<?php echo $associd; ?>">Preference Sheets</span></a>
        <?php //} ?>
        
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
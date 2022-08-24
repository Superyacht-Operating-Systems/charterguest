<div class="owl-carousel owl-theme">
<!-- Head Charterer info -->
                                <div class="charterRow">
                                   <div class="container-row-column">
                                    <div class="row">
                                    <!-- Head charterer id -->
                                    <input type="hidden" class="rowInput" name="charter_guest_id" value="<?php echo $charterData['CharterGuest']['id']; ?>">
                                    <!-- Charter program id -->
                                    <input type="hidden" class="rowInput" name="charter_program_id" value="<?php echo $charterData['CharterGuest']['charter_program_id']; ?>">
                                    <!-- Yacht id -->
                                    <input type="hidden" class="rowInput" name="yacht_id" value="<?php echo $charterData['CharterGuest']['yacht_id']; ?>">
                                    <!-- company id -->
                                    <input type="hidden" class="rowInput" name="charter_company_id" value="<?php echo $charter_company_id; ?>">
                                    <!-- Empty assoc id -->
                                    <input type="hidden" class="rowInput newGuestAssocId" name="charter_assoc_id[]" value="">
 
                                    <div class="md-row-h-8">
                                        <label>Head Charterer
                                            <span class="tooltip-mob">
                                                 <div class="info-box" data-toggle="modal" data-target="#info-modal"><img src="../../../../img/info-icon.jpg"></div> 
                                            </span>
                                        </label>
                                        <?php 
                                        //echo $charterData['CharterGuest']['is_head_charterer'];
                                        if(isset($charterData['CharterGuest']['is_head_charterer']) && $charterData['CharterGuest']['is_head_charterer'] == 2){
                                            $yesClass = "yes-btn";
                                            $noClass = "gry-btn";
                                        }else if($charterData['CharterGuest']['is_head_charterer'] == 1){
                                            
                                            $yesClass = "gry-btn";
                                            $noClass = "no-btn";
                                        }else{
                                            $yesClass = "gry-btn";
                                            $noClass = "gry-btn";
                                        }
                                        ?>
                                       <button class="<?php echo $yesClass; ?>  isHeadChartererYes">Yes</button>
                                        <button class="<?php echo $noClass; ?> isHeadChartererNo">No</button>
                                        <input type="hidden" class="isHeadChartererChecked rowInput" name="is_head_charterer_checked[]" value="<?php echo $charterData['CharterGuest']['is_head_charterer']; ?>">
                                    </div>
                                  
                                      <section class="rowm-md-mob-resize">

                                        <div class="md-row-h-12"> 
                                        <label>Title</label> 
                                            <?php echo $this->Form->input("salutation",array("id" => "headCharterSalutation", "label"=>false,'name' => 'salutation[]','options' => $salutationList,'class'=>'form-control form-two tinput rowInput validateInput','default' => $charterData['CharterGuest']['salutation'])); ?>
                                        </div>




                                         <div class="md-row-h-10"> 
                                            <label>First Name</label>  
                                            <input type="text" class="form-control tinput rowInput" name="first_name[]" value="<?php echo $charterData['CharterGuest']['first_name']; ?>" readonly="true"></div>
                                        <div class="md-row-h-10"> 
                                            <label>Last Name</label> 
                                            <input type="text" class="form-control tinput rowInput" name="last_name[]" value="<?php echo $charterData['CharterGuest']['last_name']; ?>" readonly="true" ></div>
                                    

                                           <div class="md-row-h-30"> 
                                           <label>Email</label>  
                                                            <input type="text" class="form-control tinput rowInput form-mob-ctrl" name="email[]"  value="<?php echo $charterData['CharterGuest']['email']; ?>" readonly="true">
                                                
                                        </div>   </section>
                                        <div class="md-row-h-18">
                                             <label class="label-preference">Preference Sheets</label>  
                                             <?php 
                                                 $openButtonLink = "/charters/preference?CharterGuestId=". base64_encode($charterData['CharterGuest']['id']);

                                                // as per the client showing the btn in warning color @07 Aug 2020
                                                $owldotclass = "btn-open1";
                                                $adminopenbutColor = "btn-open1 btn-warning btn-warning-bg";
                                                if (isset($charterData['CharterGuest']['is_psheets_done']) && $charterData['CharterGuest']['is_psheets_done'] == 1) {
                                                    $adminopenbutColor = "btn-open";
                                                    $textPreferenceSheet = "OPEN";
                                                    $style = "";
                                                    $waitingclass = "";
                                                    $owldotclass = "btn-open";
                                                }else{
                                                    $textPreferenceSheet = "WAITING";
                                                    $style = "style='padding:0;'";
                                                    $waitingclass = "ch-waiting-btn";
                                                   
                                                }
                                                ?>
                                                <button type="button" data-charterHeadId="<?php echo $charterData['CharterGuest']['id']; ?>" data-charterAssocId="" class="btn  btn-eml-send sendMailClass <?php echo ($charterData['CharterGuest']['is_email_sent']) ? "displayNone" : ""; ?>" disabled="true">EMAIL</button>
                                                                
                                                 <button type="button" data-charterHeadId="<?php echo $charterData['CharterGuest']['id']; ?>" data-charterAssocId="" class="btn btn-eml-send1 sent-btnr emailSentClass <?php echo ($charterData['CharterGuest']['is_email_sent']) ? "" : "displayNone"; ?>"><a></a></button>
                                          <a href="#">
                                             
                                              <button type="button" <?php echo $style; ?> class="owlbtnflag btn <?php echo $waitingclass; ?> <?php echo $adminopenbutColor; ?> existingCheckFunction" data-guestype="owner" data-owldotclass="<?php echo $owldotclass; ?>" data-associd ="<?php echo $charterData['CharterGuest']['id']; ?>"><?php echo $textPreferenceSheet; ?></button>
                                          </a>
                                          
         
                                           
                                </div>
                                </div></div>                                        </div>
                            <?php 
                            $i = 2;
                            //echo "<pre>"; print_r($charterAssocData); exit;
                            $buttonclassarray = array();
                            foreach ($charterAssocData as $charterAssoc) { ?>  
                                <!-- Existing Guest associates -->
                                <div class="charterRow">
                                <div class="container-row-column">
                                <div class="row">
                                    
                                        <!-- Exist Charter assoc id -->
                                        <input type="hidden" class="rowInput newGuestAssocId" name="charter_assoc_id[]" value="<?php echo $charterAssoc['CharterGuestAssociate']['id']; ?>">


                                         <div class="md-row-h-8">
                                         <label>Head Charterer</label>  
                                        <?php 
                                        //existingCheckFunction class used to open the preference sheet based on condition
                                        if(isset($charterAssoc['CharterGuestAssociate']['is_head_charterer']) && $charterAssoc['CharterGuestAssociate']['is_head_charterer'] == 2){
                                            $yesClass = "yes-btn";
                                            $noClass = "gry-btn";
                                            $displayOpen = "display:inline-block;";
                                            $textPreferenceSheet = "OPEN";
                                            $style = "";
                                            $waitingclass = "";
                                            $openPreferenceSheetClass = "existingCheckFunction";
                                            $owlbtnflag = "owlbtnflag";
                                            $buttoncls = "#1eabfc";
                                        }else if($charterAssoc['CharterGuestAssociate']['is_head_charterer'] == 1){
                                            
                                            $yesClass = "gry-btn";
                                            $noClass = "no-btn";
                                            $displayOpen = "display:inline-block;";
                                            if (isset($charterAssoc['CharterGuestAssociate']['is_psheets_done']) && $charterAssoc['CharterGuestAssociate']['is_psheets_done'] == 0) {
                                                $textPreferenceSheet = "WAITING";
                                                $openPreferenceSheetClass = "";
                                                
                                            }else{
                                                $textPreferenceSheet = "COMPLETE";
                                                $openPreferenceSheetClass = "existingCheckFunction";
                                            }
                                            $owlbtnflag = "owlbtnflag";
                                            $style = "padding:0;";
                                            $waitingclass = "ch-waiting-btn";
                                            $buttoncls = "#ffaf0f";
                                        }else{
                                            $yesClass = "gry-btn";
                                            $noClass = "gry-btn";
                                            $displayOpen = "display:none;";
                                        }
                                        ?>
                                        <button class="<?php echo $yesClass; ?>  isHeadChartererYes">Yes</button>
                                        <button class="<?php echo $noClass; ?> isHeadChartererNo">No</button>
                                        <input type="hidden" class="isHeadChartererChecked rowInput" name="is_head_charterer_checked[]" value="<?php echo $charterAssoc['CharterGuestAssociate']['is_head_charterer']; ?>">
                                    </div>
                                    
                                        <!-- <div class="td-cnt"><?php echo $i; ?></div> -->
                                        <!-- <td class="td-cnt td-check"><input class="cbox-sz isHeadCharterer" type="checkbox" name="is_head_charterer" <?php //echo ($charterAssoc['CharterGuestAssociate']['is_head_charterer']) ? "checked" : ""; ?>></td> -->
                                         <section class="rowm-md-mob-resize">
                                       <div class="md-row-h-12">
                                        <label>Title</label>
                                        
                                  
                                            <?php echo $this->Form->input("salutation",array("label"=>false,'name' => 'salutation[]','options' => $salutationList,'class'=>'form-control tinput rowInput validateInput','default' => $charterAssoc['CharterGuestAssociate']['salutation'])); ?>
                                        </div>
                                        <div class="md-row-h-10">
                                            <label>First Name</label>
                                            <input type="text" class="form-control tinput rowInput validateInput" name="first_name[]" value="<?php echo $charterAssoc['CharterGuestAssociate']['first_name']; ?>"></div>
                                        <div class="md-row-h-10">
                                          <label>Last Name</label>
                                            <input type="text" class="form-control tinput rowInput validateInput" name="last_name[]" value="<?php echo $charterAssoc['CharterGuestAssociate']['last_name']; ?>"></div>
                                  
                                        <div class="md-row-h-30">
                                                   <label>Email</label>
                                                    <input type="text" class="form-control tinput rowInput validateInput"  name="email[]" value="<?php echo $charterAssoc['CharterGuestAssociate']['email']; ?>">

                                           

                                 
                                            <?php 
                                                $sendMailBtnDisable = "";
                                                // Disabling the SEND MAIL button if head charterer is checked
                                                //if ($charterAssoc['CharterGuestAssociate']['is_head_charterer']) {
                                                if (isset($charterAssoc['CharterGuestAssociate']['is_head_charterer']) && $charterAssoc['CharterGuestAssociate']['is_head_charterer'] !=1) {
                                                    $sendMailBtnDisable = "disabled";
                                                }
                                            ?>         </div>  </section>
                                               <div class="md-row-h-18">
                                               <label class="label-preference">Preference Sheets</label>
                                                 <?php
                                                $openButtonLink = "javascript:void(0);";
                                                // as per client btn color shoud be yellow when it created new user. 
                                               // $openBtnColor = " btn-open btn-default";
                                                $openBtnColor = "btn-open1 btn-warning hideshow";
                                                $openBtnDisable = "disabled";
                                                
                                               //echo $charterAssoc['CharterGuestAssociate']['is_psheets_done'];
                                                // Enabling the button and will be editable pages If Head Charterer is checked
                                                if (isset($charterAssoc['CharterGuestAssociate']['is_head_charterer']) && $charterAssoc['CharterGuestAssociate']['is_head_charterer'] !=1) {
                                                    $openButtonLink = "/charters/preference?assocId=". base64_encode($charterAssoc['CharterGuestAssociate']['id']);
                                                    //$openBtnColor = "btn-open btn-primary";
                                                    // as per client btn color shoud be yellow when it created new user. 
                                                    $openBtnColor = "btn-open1 btn-warning hideshow";
                                                    $openBtnDisable = "";
                                                    
                                                }
                                                if (isset($charterAssoc['CharterGuestAssociate']['is_email_sent']) && $charterAssoc['CharterGuestAssociate']['is_email_sent'] ==1) {
                                                    $openButtonLink = "/charters/preference?assocId=". base64_encode($charterAssoc['CharterGuestAssociate']['id']);
                                                    $openBtnDisable = "";
                                                    $openBtnColor = "btn-open1 btn-warning hideshow";
                                                    
                                                }
                                                 // Enabling the button and will be read-only pages If P-sheets done
                                                if (isset($charterAssoc['CharterGuestAssociate']['is_psheets_done']) && $charterAssoc['CharterGuestAssociate']['is_psheets_done'] == 1) {
                                                    $openButtonLink = "/charters/preference?id=". base64_encode($charterAssoc['CharterGuestAssociate']['id']);
                                                    $openBtnColor = "btn-open btn-primary hideshow";
                                                    $openBtnDisable = "";
                                                    
                                                    
                                                }else{
                                                    
                                                }

                                                $buttonclassarray[] = $buttoncls;
                                                
                                            ?>
                                            <?php //echo $baseFolder.$openButtonLink; ?>
                                            <button type="button" data-charterHeadId=""  data-charterAssocId="<?php echo $charterAssoc['CharterGuestAssociate']['id']; ?>" class="btn btn-danger btn-eml-send sendMailClass <?php echo ($charterAssoc['CharterGuestAssociate']['is_email_sent']) ? "displayNone" : ""; ?>" <?php echo $sendMailBtnDisable; ?>>EMAIL</button>
                                                                <button type="button" data-charterHeadId=""  data-charterAssocId="<?php echo $charterAssoc['CharterGuestAssociate']['id']; ?>"  class="btn btn-success btn-eml-send1 sent-btnr emailSentClass <?php echo ($charterAssoc['CharterGuestAssociate']['is_email_sent']) ? "" : "displayNone"; ?>"></button>

                                            <a href="#"><button type="button" class="<?php echo $owlbtnflag; ?> btn <?php echo $waitingclass; ?> <?php echo $openBtnColor; ?> <?php echo $openPreferenceSheetClass; ?>" data-guestype="guest" data-owldotclass="<?php echo $buttoncls; ?>" data-associd ="<?php echo $charterAssoc['CharterGuestAssociate']['id']; ?>" style="<?php echo $displayOpen; ?><?php echo $style; ?>" <?php echo $openBtnDisable; ?>><?php echo $textPreferenceSheet; ?></button></a>



                                                               
                                       
                                           
                                      </div>
                                </div> </div> </div>
                            <?php 
                                $i++;
                            } 
                            ?>
                             
                            <?php for ($j = $i; $j <= $charterData['CharterGuest']['no_of_guests']; $j++) { ?> 
                                <!-- New Associates -->
                                <div class="charterRow newGuestAssocRow">
                                <div class="container-row-column">
                                    <div class="row">
                                    <div class="md-row-h-8">
                                        <label>Head Charterer</label>
                                    <button class="gry-btn isHeadChartererYes">Yes</button>
                                    <button class="gry-btn isHeadChartererNo">No</button>
                                    <input type="hidden" class="isHeadChartererChecked rowInput" name="is_head_charterer_checked[]" value="">
                                    </div>
                                              <section class="rowm-md-mob-resize">
                                       <div class="md-row-h-12">  
                                        <label>Title</label>
                                        
                                            <?php echo $this->Form->input("salutation",array("label"=>false,'name' => 'salutation[]','options' => $salutationList,'class'=>'form-control tinput rowInput validateInput')); ?>
                                        </div>
                                        <div class="md-row-h-10">
                                             <label>First Name</label>
                                            <input type="text" class="form-control tinput rowInput validateInput" name="first_name[]" value="">
                                        </div>
                                        <div class="md-row-h-10">
                                             <label>Last Name</label>
                                            <input type="text" class="form-control tinput rowInput validateInput" name="last_name[]" value="">
                                        </div>
                               
                                        <div class="md-row-h-30">
                                             <label>Email</label>
                                                                <input type="text" class="form-control tinput rowInput validateInput"  name="email[]" value="">
    
                                        </div>
         </section>
                                         <div class="md-row-h-18">
                                            <label class="label-preference">Preference Sheets</label>
                                             <a href="javascript:void(0);" data-charterHeadId=""  data-charterAssocId=""  class="btn btn-default btn-open newGuestAssoc">OPEN</a> 
                                           <button type="button" data-charterHeadId=""  data-charterAssocId="" class="btn btn-danger btn-eml-send sendMailClass">EMAIL</button>
                                        <button type="button" data-charterHeadId=""  data-charterAssocId="" class="sent-btnr btn btn-success btn-eml-send emailSentClass displayNone"></button>

                                         <button type="button" data-charterHeadId=""  data-charterAssocId="" class="sent-btnr btn btn-success complete-btn" style="opacity:0;pointer-events:none;">COMPLETE</button>
                                                 
                                              

                                               </div>
                                </div>                     </div>                </div>
                            <?php } ?>     
   

</div>
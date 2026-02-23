<div class="owl-theme owl-dotsrow">
<div class="owl-dots ">
</div>
</div>
<div class="owl-mobilecontainer">
<div class="owl-carousel owl-theme ">
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
 
                                    <div class="md-row-h-8 ddddsdd">
                                        <label>Head Charterer
                                            <span class="tooltip-mob">
                                                 <div class="info-box" data-toggle="modal" data-target="#info-modal"><img src="../../../../img/info-icon.jpg"></div> 
                                            </span>
                                        </label>
                                        <?php  //$charterData['CharterGuest']['is_psheets_done'] = 0;
                                        //echo $charterData['CharterGuest']['is_head_charterer'];
                                        $disableBeforesaveHC = "disableBeforesave";
                                        if(isset($charterData['CharterGuest']['is_head_charterer']) && $charterData['CharterGuest']['is_head_charterer'] == 2){
                                            $yesClass = "yes-btn";
                                            $noClass = "gry-btn";
                                        }else if($charterData['CharterGuest']['is_head_charterer'] == 1){
                                            $disableBeforesaveHC = "";
                                            $yesClass = "gry-btn";
                                            $noClass = "no-btn";
                                        }else{
                                            $yesClass = "gry-btn";
                                            $noClass = "gry-btn";
                                        }
                                        ?>
                                       <button class="<?php echo $yesClass; ?>  isHeadChartererYes"  data-saved="1" data-emailsentornot = "<?php echo $charterData['CharterGuest']['is_email_sent']; ?>" data-psheetsubmitornot="<?php echo $charterData['CharterGuest']['is_psheets_done'] ?>">Yes</button>
                                        <button class="<?php echo $noClass; ?> isHeadChartererNo"  data-saved="1" data-emailsentornot = "<?php echo $charterData['CharterGuest']['is_email_sent']; ?>" data-psheetsubmitornot="<?php echo $charterData['CharterGuest']['is_psheets_done'] ?>">No</button>
                                        <input type="hidden" class="isHeadChartererChecked rowInput" name="is_head_charterer_checked[]" value="<?php echo $charterData['CharterGuest']['is_head_charterer']; ?>">
                                    </div>
                                  
                                      <section class="rowm-md-mob-resize">

                                        <div class="md-row-h-12"> 
                                        <label>Title</label> 
                                            <?php echo $this->Form->input("salutation",array("id" => "headCharterSalutation", "label"=>false,'name' => 'salutation[]','options' => $salutationList,'class'=>'form-control form-two tinput rowInput validateInput','default' => $charterData['CharterGuest']['salutation'])); ?>
                                            <span class="error validateMessage" style="display: none;">Enter Title</span>
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
                                        <?php 
                                                $sendMailClassHC = "sendMailClass";
                                                $sendMailBtnDisable = "";
                                                // Disabling the SEND MAIL button if head charterer is checked
                                                //if ($charterAssoc['CharterGuest']['is_head_charterer']) {
                                                if (isset($charterData['CharterGuest']['is_head_charterer']) && $charterData['CharterGuest']['is_head_charterer'] !=1) {
                                                    $sendMailBtnDisable = "";
                                                    $sendMailClassHC = "existingCheckFunction";
                                                }
                                            ?>

                                        <div class="md-row-h-18">
                                             <label class="label-preference">Preference Sheets</label>  
                                             <?php 
                                                 $openButtonLink = "/charters/preference?CharterGuestId=". base64_encode($charterData['CharterGuest']['id']);

                                                // as per the client showing the btn in warning color @07 Aug 2020
                                                $owldotclass = "btn-open1";
                                                $adminopenbutColor = "btn-open1 btn-warning btn-warning-bg hideshow";
                                                //$headcharterRowText = "OPEN";
                                                $textPreferenceSheetCharterGuest = "OPEN";
                                                $displayopacityheadc = "";
                                                if (isset($charterData['CharterGuest']['is_psheets_done']) && $charterData['CharterGuest']['is_psheets_done'] == 1) {
                                                    $adminopenbutColor = "btn-open hideshow";
                                                    $textPreferenceSheetCharterGuest = "COMPLETE";
                                                    $style = "";
                                                    $waitingclass = "";
                                                    $owldotclass = "#1eabfc";
                                                }else{
                                                    $textPreferenceSheetCharterGuest = "WAITING";
                                                    $style = "style='padding:0;'";
                                                    $waitingclass = "ch-waiting-btn hideshow";
                                                   
                                                }
                                                // if(isset($charterData['CharterGuest']['is_email_sent']) && $charterData['CharterGuest']['is_email_sent'] == 1){
                                                //     $textOpen = "SENT";
    
                                                // }else{
                                                //     $textOpen = "EMAIL";
                                                //     if (isset($charterData['CharterGuest']['is_psheets_done']) && $charterData['CharterGuest']['is_psheets_done'] == 0) {
                                                //         $displayopacityheadc = "opacity:0;";
                                                //     }
                                                // }
                                                ?>
                                                <button type="button" data-charterHeadId="<?php echo $charterData['CharterGuest']['id']; ?>" data-charterAssocId="" data-guestype="owner" data-associd ="<?php echo $charterData['CharterGuest']['id']; ?>" class="btn  btn-eml-send <?php echo $sendMailClassHC; ?> <?php echo $disableBeforesaveHC; ?>  <?php echo ($charterData['CharterGuest']['is_email_sent']) ? "displayNone" : ""; ?>">OPEN</button>
                                                                
                                                 <button type="button" data-charterHeadId="<?php echo $charterData['CharterGuest']['id']; ?>" data-charterAssocId="" class="btn btn-eml-send1 sent-btnr  emailSentClass <?php echo ($charterData['CharterGuest']['is_email_sent']) ? "" : "displayNone"; ?>"><a></a></button>
                                          <a href="#">
                                             
                                              <button type="button" <?php echo $style; ?> style="<?php echo $displayopacityheadc; ?>" class="owlbtnflag btn <?php echo $waitingclass; ?> <?php echo $adminopenbutColor; ?> existingCheckFunction" data-guestype="owner" data-owldotclass="<?php echo $owldotclass; ?>" data-associd ="<?php echo $charterData['CharterGuest']['id']; ?>"><?php echo $textPreferenceSheetCharterGuest; ?></button>
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
                                         <label>Head Charterer
                                          <span class="tooltip-mob">
                                                 <div class="info-box" data-toggle="modal" data-target="#info-modal"><img src="../../../../img/info-icon.jpg"></div> 
                                            </span>
                                         
                                         </label>  
                                        <?php 
                                        $textOpen = "OPEN";
                                        $disableBeforesave = "disableBeforesave";
                                        $displayopacity = "";
                                        //existingCheckFunction class used to open the preference sheet based on condition
                                        if(isset($charterAssoc['CharterGuestAssociate']['is_head_charterer']) && $charterAssoc['CharterGuestAssociate']['is_head_charterer'] == 2){
                                            $yesClass = "yes-btn";
                                            $noClass = "gry-btn";
                                            $displayOpen = "display:inline-block;";
                                            $textPreferenceSheet = "OPEN";
                                            if (isset($charterAssoc['CharterGuestAssociate']['is_psheets_done']) && $charterAssoc['CharterGuestAssociate']['is_psheets_done'] == 0) {
                                                $textPreferenceSheet = "WAITING";
                                                $buttoncls = "#ffaf0f";
                                                $waitingclass = "ch-waiting-btn";
                                            }else{
                                                $textPreferenceSheet = "COMPLETE";
                                                $buttoncls = "#1eabfc";
                                                $waitingclass = "";
                                            }
                                            $style = "";
                                            
                                            $openPreferenceSheetClass = "existingCheckFunction";
                                            $owlbtnflag = "owlbtnflag";
                                            
                                        }else if($charterAssoc['CharterGuestAssociate']['is_head_charterer'] == 1){
                                            
                                            $yesClass = "gry-btn";
                                            $noClass = "no-btn";
                                            $displayOpen = "display:inline-block;";
                                            
                                            if (isset($charterAssoc['CharterGuestAssociate']['is_psheets_done']) && $charterAssoc['CharterGuestAssociate']['is_psheets_done'] == 0) {
                                                $textPreferenceSheet = "WAITING";
                                                $openPreferenceSheetClass = "";
                                                $buttoncls = "#ffaf0f";
                                                $waitingclass = "ch-waiting-btn-no";
                                                
                                            }else{
                                                $textPreferenceSheet = "COMPLETE";
                                                $openPreferenceSheetClass = "";
                                                $buttoncls = "#1eabfc";
                                                $waitingclass = "";
                                            }
                                            $disableBeforesave = "";
                                            if(isset($charterAssoc['CharterGuestAssociate']['is_email_sent']) && $charterAssoc['CharterGuestAssociate']['is_email_sent'] == 1){
                                                $textOpen = "SENT";

                                            }else{
                                                $textOpen = "EMAIL";
                                                if (isset($charterAssoc['CharterGuestAssociate']['is_psheets_done']) && $charterAssoc['CharterGuestAssociate']['is_psheets_done'] == 0) {
                                                    $displayopacity = "opacity:0;";
                                                }
                                            }
                                            $owlbtnflag = "owlbtnflag";
                                            $style = "padding:0;cursor:not-allowed;";
                                            
                                            
                                        }else{
                                            $yesClass = "gry-btn";
                                            $noClass = "gry-btn";
                                            $displayOpen = "display:none;";
                                        }
                                        ?>
                                        <button class="<?php echo $yesClass; ?>  isHeadChartererYes" data-saved="1" data-emailsentornot = "<?php echo $charterAssoc['CharterGuestAssociate']['is_email_sent']; ?>" data-psheetsubmitornot="<?php echo $charterAssoc['CharterGuestAssociate']['is_psheets_done'] ?>">Yes</button>
                                        <button class="<?php echo $noClass; ?> isHeadChartererNo" data-saved="1" data-emailsentornot = "<?php echo $charterAssoc['CharterGuestAssociate']['is_email_sent']; ?>" data-psheetsubmitornot="<?php echo $charterAssoc['CharterGuestAssociate']['is_psheets_done'] ?>">No</button>
                                        <input type="hidden" class="isHeadChartererChecked rowInput"   name="is_head_charterer_checked[]" value="<?php echo $charterAssoc['CharterGuestAssociate']['is_head_charterer']; ?>">
                                    </div>
                                    
                                        <!-- <div class="td-cnt"><?php echo $i; ?></div> -->
                                        <!-- <td class="td-cnt td-check"><input class="cbox-sz isHeadCharterer" type="checkbox" name="is_head_charterer" <?php //echo ($charterAssoc['CharterGuestAssociate']['is_head_charterer']) ? "checked" : ""; ?>></td> -->
                                         <section class="rowm-md-mob-resize">
                                       <div class="md-row-h-12">
                                        <label>Title</label>
                                        
                                  
                                            <?php echo $this->Form->input("salutation",array("label"=>false,'name' => 'salutation[]','options' => $salutationList,'class'=>'form-control tinput rowInput validateInput','default' => $charterAssoc['CharterGuestAssociate']['salutation'])); ?>
                                            <span class="error validateMessage" style="display: none;">Enter Title</span>
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
                                                $sendMailClass = "sendMailClass";
                                                $sendMailBtnDisable = "";
                                                // Disabling the SEND MAIL button if head charterer is checked
                                                //if ($charterAssoc['CharterGuestAssociate']['is_head_charterer']) {
                                                if (isset($charterAssoc['CharterGuestAssociate']['is_head_charterer']) && $charterAssoc['CharterGuestAssociate']['is_head_charterer'] !=1) {
                                                    $sendMailBtnDisable = "";
                                                    $sendMailClass = "existingCheckFunction";
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
                                            <button type="button" data-charterHeadId=""  data-charterAssocId="<?php echo $charterAssoc['CharterGuestAssociate']['id']; ?>" data-guestype="guest" data-associd ="<?php echo $charterAssoc['CharterGuestAssociate']['id']; ?>" class="btn btn-danger btn-eml-send <?php echo $sendMailClass; ?> <?php echo $disableBeforesave; ?> <?php echo ($charterAssoc['CharterGuestAssociate']['is_email_sent']) ? "displayNone" : ""; ?>" <?php echo $sendMailBtnDisable; ?>><?php echo $textOpen; ?></button>
                                                                <button type="button" data-charterHeadId=""  data-charterAssocId="<?php echo $charterAssoc['CharterGuestAssociate']['id']; ?>"  class="btn btn-success btn-eml-send1 sent-btnr emailSentClass <?php echo ($charterAssoc['CharterGuestAssociate']['is_email_sent']) ? "" : "displayNone"; ?>"></button>

                                            <a href="#"><button type="button" class="<?php echo $owlbtnflag; ?> btn <?php echo $waitingclass; ?> <?php echo $openBtnColor; ?> <?php echo $openPreferenceSheetClass; ?>" data-guestype="guest" data-owldotclass="<?php echo $buttoncls; ?>" data-associd ="<?php echo $charterAssoc['CharterGuestAssociate']['id']; ?>" style="<?php echo $displayOpen; ?><?php echo $style; ?><?php echo $displayopacity; ?>" <?php echo $openBtnDisable; ?>><?php echo $textPreferenceSheet; ?></button></a>



                                                               
                                       
                                           
                                      </div>
                                </div> </div> </div>
                            <?php 
                                $i++;
                            } 
                            ?>
                             
                            <?php for ($j = $i; $j <= ($charterData['CharterGuest']['no_of_guests'] - (isset($unselectedCount) ? $unselectedCount : 0)); $j++) { ?>
                                <!-- New Associates -->
                                <div class="charterRow newGuestAssocRow">
                                <div class="container-row-column">
                                    <div class="row">
                                    <div class="md-row-h-8">
                                        <label>Head Charterer
                                         <span class="tooltip-mob">
                                                 <div class="info-box" data-toggle="modal" data-target="#info-modal"><img src="../../../../img/info-icon.jpg"></div> 
                                            </span>
                                        </label>
                                    <button class="gry-btn isHeadChartererYes" data-saved="0">Yes</button>
                                    <button class="gry-btn isHeadChartererNo" data-saved="0">No</button>
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
                                           <button type="button" data-charterHeadId=""  data-charterAssocId="" class="btn btn-danger btn-eml-send sendMailClass displayNone">OPEN</button>
                                        <button type="button" data-charterHeadId=""  data-charterAssocId="" class="sent-btnr btn btn-success btn-eml-send emailSentClass displayNone"></button>

                                         <button type="button" data-charterHeadId=""  data-charterAssocId="" class="sent-btnr btn btn-success complete-btn" style="opacity:0;pointer-events:none;">COMPLETE</button>
                                                 
                                              

                                               </div>
                                </div>                     </div>                </div>
                            <?php } ?>     
   

</div></div>
<script type="text/javascript">
    $(document).ready(function() {
  $('.owl-carousel').owlCarousel({
    stagePadding:0,/*the little visible images at the end of the carousel*/
     
    loop:false,
    rtl: false,
    lazyLoad:true,
    margin:0,
    dots:true,
      dotsContainer: '.owl-dots',
    singleItem:true,
    responsiveClass:true,
    nav:false,
    items : 1, 
      responsive : {
            480 : { items : 1  }, // from zero to 480 screen width 4 items
            768 : { items : 1,
                    touchDrag:true,
                    mouseDrag:false,
             }, // from 480 screen widthto 768 6 items
        },
        900:{
            items:0,
            mouseDrag:false,
            touchDrag:false,
            nav:false,
        },
    // responsive:{
    //     0:{
    //         items:1,
    //          mouseDrag:true,
    //         touchDrag:true
    //     },
    //     1024:{
    //         items:0,
    //         mouseDrag:false,
    //         touchDrag:false
    //     },
    // }
});


// $(".owl-dots:nth-child(6)").addClass("myactive"); 
// //$('.owl-carousel').trigger('to.owl.carousel', 6 );


var dotclassarr = [];
        $('.owl-carousel .owl-stage .owl-item').each(function(index){
            //console.log(index);
            var dotclass = $(this).find('.owlbtnflag').attr('data-owldotclass');
            
            dotclassarr.push(dotclass);
            
        });

       // console.log(dotclassarr);
checkClasses();
$('.owl-theme').on('translated.owl.carousel', function(event) {
        checkClasses();
    });

    function checkClasses(){
        var total = $('.owl-theme .owl-dots .owl-dot').length;
        $('.owl-theme .owl-dots .owl-dot').each(function(index){
            //console.log(index);
           
            if(dotclassarr[index] != "undefined"){
                $(this).css({"background": dotclassarr[index]});
            }
            
        });
    }





 });

</script>

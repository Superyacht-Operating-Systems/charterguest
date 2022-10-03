<?php
$base = $this->request->base;
$sessionData = $this->Session->read();
//echo "<pre>";print_r($sessionData); exit;
// Itineraries
    $itineraryList = array(
        1 => 'Swimming',
        2 => 'Water Skiing',
        3 => 'Sightseeing',
        4 => 'Inland excursions',
        5 => 'Music/dancing',
        6 => 'Trail blazing',
        7 => 'Night life/Clubs',
        8 => 'Helicopter rides',
        9 => 'Fly fishing',
        10 => 'Hiking',
        11 => 'Mountain biking',
        12 => 'Snorkeling/Scuba',
        13 => 'Wakeboarding',
        14 => 'Rlexing Hot Springs',
        15 => 'Leaving the world behind',
        16 => 'Land tours/Shopping',
        17 => 'Small boat exeditions',
        18 => 'Golfing',
        19 => 'Relaxing',
        20 => 'Parasailing/gliding',
        21 => 'Water toys',
        22 => 'Rock climbing',
        23 => 'Beachcombing/beach activities',
        24 => 'Wave runners/jet skis',
        25 => 'Active cruising',
        26 => 'Sailing/surfing',
        27 => 'Tennis',
        28 => 'Sea kayaking',
        29 => 'Dining ashore',
        30 => 'Deep sea fishing',
        31 => 'Crab & prawn fishing',
        32 => 'Wildlife watching',
        33 => "Other"
    );
    $itineraryListChecked = array();
    // Generate the empty assoc array - 34 items
    for ($i = 1; $i <= 33; $i++) {
        $itineraryListChecked[$i] = '';
    }
    
    // Dive licenses
    $diveLicense = array(
        1 => 'Not Licenced',
        2 => 'Rescue Diver',
        3 => 'Open Water',
        4 => 'Instructor'
    );
    $diveLicenseChecked = array(
        1 => '',
        2 => '',
        3 => '',
        4 => ''
    );

    $itineraryPreferenceRowId = '';
    if (isset($itineraryPreferences) && !empty($itineraryPreferences)) {
        // Existing row id
        if (!empty($itineraryPreferences['CharterGuestItineraryPreference']['id'])) {
            $itineraryPreferenceRowId = $itineraryPreferences['CharterGuestItineraryPreference']['id'];
        }
        // Itineraries
        if (!empty($itineraryPreferences['CharterGuestItineraryPreference']['itinerary'])) {
            $existItinerary = explode(",", $itineraryPreferences['CharterGuestItineraryPreference']['itinerary']);
            foreach ($existItinerary as $item) {
                $itineraryListChecked[$item] = "checked";
            }
        }
        // Dive liceses
        if (!empty($itineraryPreferences['CharterGuestItineraryPreference']['dive_license'])) {
            $existDiveLicense = explode(",", $itineraryPreferences['CharterGuestItineraryPreference']['dive_license']);
            foreach ($existDiveLicense as $item) {
                $diveLicenseChecked[$item] = "checked";
            }
        }
    }
    $baseFolder = $this->request->base;
?>
<style>
.col-ng-3{width: 12%;}
.modal-content.mc-bord{
	border-radius:0;
	border:1px solid #000;
	}
@media (min-width: 768px){
.modal-dialog {
    width: 400px;
    margin: 30px auto;
}
}
 .modalmsg{
	padding:20px;
	}
/*	.iter-pref{
		width: 32%;
	}*/
  /* Ramesh 10/08/2018 */
  @media only screen 
  and (min-device-width : 768px) 
  and (max-device-width : 1024px) 
  and (orientation : portrait) { 
   /* .row.ipadport-comments .col-md-8 {
        margin-left: -12px;
    }*/
    span.ipadport-break {
        display: block;
    }
    .ipadport-ml15{
      margin-left: 15px;
    }

  }

  @media only screen and (max-device-width : 768px) {

.ipadport-can-you-block{
  margin-left: -8px;
}

}

 /* .modal-open .modal {
    background-color: #999;
} */
</style>
<!-- itinerary Preference -->
<div id="itinerary" class="tab-pane fade <?php echo $itineraryPreferenceTab; ?>">
    <?php echo $this->Form->create('CharterGuestItineraryPreference', array('url' => array('controller' => 'charters','action' => 'preference'),'id'=>'itineraryPreferenceForm'));     
           echo $this->Form->hidden("CharterGuestItineraryPreference.id", array('value' => $itineraryPreferenceRowId));
           
           // When main Head charterer opens other guest(if Head charterer checked) and Update the Preference sheets
           if (isset($charterAssocIdByHeaderEdit)) {
               echo $this->Form->hidden("charterAssocIdByHeaderEdit", array('value' => $charterAssocIdByHeaderEdit));
           }
        ?>

<div class="personal-row-container beverage-menu-row">
<h1 class="position-mobile-head">Itinerary</h1>
<div class="fixed-row-container itinerary-row">
  <div class="col-md-12">
      <div class="form-group frmgrp-mar">
          <div class="col-md-12">
           <!--  <label class="min-hd-label">Itinerary</label>   -->
          </div>
          <div class="iter-pref">
            <div class="be-col-6">
            <div class="checkbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="1" <?php echo $itineraryListChecked[1]; ?>>
                <label class="pdd-none"><span class="sp-lab">Swimming</span></label>
            </div></div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="2" <?php echo $itineraryListChecked[2]; ?>>
              <label class="pdd-none"><span class="sp-lab">Water Skiing</span></label>
            </div>
            </div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="3" <?php echo $itineraryListChecked[3]; ?>>
              <label class="pdd-none"><span class="sp-lab">Sightseeing</span></label>
            </div>
             </div>
             <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="4" <?php echo $itineraryListChecked[4]; ?>>
              <label class="pdd-none"><span class="sp-lab">Inland excursions</span></label>
            </div>
            </div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="5" <?php echo $itineraryListChecked[5]; ?>>
              <label class="pdd-none"><span class="sp-lab">Music/dancing</span></label>
            </div>
            </div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="6" <?php echo $itineraryListChecked[6]; ?>>
              <label class="pdd-none"><span class="sp-lab">Trail blazing</span></label>
            </div>
            </div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="7" <?php echo $itineraryListChecked[7]; ?>>
              <label class="pdd-none"><span class="sp-lab">Night life/Clubs</span></label>
            </div>
            </div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="8" <?php echo $itineraryListChecked[8]; ?>>
              <label class="pdd-none"><span class="sp-lab">Helicopter rides</span></label>
            </div>
             </div>
             <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="9" <?php echo $itineraryListChecked[9]; ?>>
              <label class="pdd-none"><span class="sp-lab">Fly fishing</span></label>
            </div>
            </div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="10" <?php echo $itineraryListChecked[10]; ?>>
              <label class="pdd-none"><span class="sp-lab">Hiking</span></label>
            </div></div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="11" <?php echo $itineraryListChecked[11]; ?>>
              <label class="pdd-none"><span class="sp-lab">Mountain biking</span></label>
            </div></div>
             <div class="be-col-6">
             <div class="checkbox">
              <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="12" <?php echo $itineraryListChecked[12]; ?>>
              <label class="pdd-none"><span class="sp-lab">Snorkeling</span></label>
            </div></div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="13" <?php echo $itineraryListChecked[13]; ?>>
              <label class="pdd-none"><span class="sp-lab">Wakeboarding</span></label>
            </div></div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="14" <?php echo $itineraryListChecked[14]; ?>>
              <label class="pdd-none"><span class="sp-lab">Hot Springs</span></label>
            </div></div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="15" <?php echo $itineraryListChecked[15]; ?>>
              <label class="pdd-none"><span class="sp-lab">Kite Surfing</span></label>
            </div></div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="16" <?php echo $itineraryListChecked[16]; ?>>
              <label class="pdd-none"><span class="sp-lab">Surfing</span></label>
            </div></div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="17" <?php echo $itineraryListChecked[17]; ?>>
              <label class="pdd-none"><span class="sp-lab">Shopping</span></label>
            </div></div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="18" <?php echo $itineraryListChecked[18]; ?>>
              <label class="pdd-none"><span class="sp-lab">Golfing</span></label>
              </div>
            </div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="19" <?php echo $itineraryListChecked[19]; ?>>
              <label class="pdd-none"><span class="sp-lab">Relaxing</span></label>
            </div></div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="20" <?php echo $itineraryListChecked[20]; ?>>
              <label class="pdd-none"><span class="sp-lab">Parasailing</span></label>
            </div></div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="21" <?php echo $itineraryListChecked[21]; ?>>
              <label class="pdd-none"><span class="sp-lab">Water toys</span></label>
            </div></div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="22" <?php echo $itineraryListChecked[22]; ?>>
              <label class="pdd-none"><span class="sp-lab">Rock climbing</span></label>
            </div></div>
            <div class="be-col-6">
             <div class="checkbox">
             <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="23" <?php echo $itineraryListChecked[23]; ?>>
              <label class="pdd-none"><span class="sp-lab">Beach activities</span></label>
            </div></div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="24" <?php echo $itineraryListChecked[24]; ?>>
              <label class="pdd-none"><span class="sp-lab">Wave runners</span></label>
            </div></div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="25" <?php echo $itineraryListChecked[25]; ?>>
              <label class="pdd-none"><span class="sp-lab">Active cruising</span></label>
            </div></div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="26" <?php echo $itineraryListChecked[26]; ?>>
              <label class="pdd-none"><span class="sp-lab">Sailing</span></label>
            </div></div>
             <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="27" <?php echo $itineraryListChecked[27]; ?>>
              <label class="pdd-none"><span class="sp-lab">Tennis</span></label>
            </div></div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="28" <?php echo $itineraryListChecked[28]; ?>>
              <label class="pdd-none"><span class="sp-lab">Sea kayaking</span></label>
            </div></div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="29" <?php echo $itineraryListChecked[29]; ?>>
              <label class="pdd-none"><span class="sp-lab">Dining ashore</span></label>
            </div></div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="30" <?php echo $itineraryListChecked[30]; ?>>
              <label class="pdd-none"><span class="sp-lab">Deep sea fishing</span></label>
            </div></div>
            <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="31" <?php echo $itineraryListChecked[31]; ?>>
              <label class="pdd-none"><span class="sp-lab">Scuba diving</span></label>
            </div></div>

             <div class="be-col-6">
            <div class="checkbox bev-chbox">
            <input type="checkbox" class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="32" <?php echo $itineraryListChecked[32]; ?>>
              <label class="pdd-none"><span class="sp-lab">Wildlife watching</span></label>
            </div></div>
          </div>
          <input type="hidden" name="data[CharterGuestItineraryPreference][itinerary_hidden][]" id="itinerary_hidden" value="" />
          <div class="clearfix"></div><br>
            <div class="row ipadport-comments">
              <div class="col-md-1 col-sm-2">
            <div class="">
            <!--<input type="checkbox"  class="itinerary" name="data[CharterGuestItineraryPreference][itinerary][]" value="34" <?php //echo $itineraryListChecked[34]; ?>>-->
              <label class="pdd-none label-comments-space">Comments</label>
            </div>
          </div>
          <div class="col-md-8 col-sm-8">
            <!--<input type="text" class="form-control">-->
            <?php echo $this->Form->input("itinerary_comments",array("label"=>false,'class'=>'form-control','type' => 'text')); ?>
          </div>
            </div>
           <div class="clearfix"></div>
          <hr class="divider divmar">
          
           <div class="ipadport-can-you-block">
             <div class="col-md-3 col-sm-3 ch-mt-3 label-ng-space col-ng-3">
               <label>Can you swim?</label>
             </div>
             <div class="col-md-7 col-sm-7 ipadport-ml15 mrg-btm-row">
              <div class="be-col-2 col-md-1 col-sm-2">
                <div class="radio my-none" style="margin:0;">
                <input type="radio" name="data[CharterGuestItineraryPreference][is_swim]" value="1" <?php echo (isset($itineraryPreferences['CharterGuestItineraryPreference']['is_swim']) && $itineraryPreferences['CharterGuestItineraryPreference']['is_swim'] == 1) ? 'checked' : ''; ?>>
                  <label class="pdd-none">
                      <span>Yes</span>
                  </label>
                </div>
              </div>
              <div class="be-col-2 col-md-1 col-sm-2">
                <div class="radio my-none" style="margin:0;">
                 <input type="radio" name="data[CharterGuestItineraryPreference][is_swim]" value="0" <?php echo (isset($itineraryPreferences['CharterGuestItineraryPreference']['is_swim']) && $itineraryPreferences['CharterGuestItineraryPreference']['is_swim'] == 0) ? 'checked' : ''; ?>>
                 <label class="pdd-none">         
                    <span>No</span>
                 </label>
               </div>
              </div>
             </div>
             <div class="clearfix"></div>
             <br>
             <div class="col-md-3 col-sm-3 label-ng-space col-ng-6 ch-mt-3">
               <label>Do you have a PWC (Jet Ski) licence?</label>
             </div>
             <div class="col-md-7 col-sm-7 ipadport-ml15 mrg-btm-row">
              <div class="be-col-2 col-md-1 col-sm-2">
                <div class="radio my-none" style="margin:0;">
                <input type="radio" name="data[CharterGuestItineraryPreference][is_dive_licence]" value="1" <?php echo (isset($itineraryPreferences['CharterGuestItineraryPreference']['is_dive_licence']) && $itineraryPreferences['CharterGuestItineraryPreference']['is_dive_licence'] == 1) ? 'checked' : ''; ?>>
                  <label class="pdd-none">
                      <span>Yes</span>
                  </label>
                </div>
              </div>
              <div class="be-col-2 col-md-1 col-sm-2">
                <div class="radio my-none" style="margin:0;">
                 <input type="radio" name="data[CharterGuestItineraryPreference][is_dive_licence]" value="0" <?php echo (isset($itineraryPreferences['CharterGuestItineraryPreference']['is_dive_licence']) && $itineraryPreferences['CharterGuestItineraryPreference']['is_dive_licence'] == 0) ? 'checked' : ''; ?>>
                 <label class="pdd-none">         
                    <span>No</span>
                 </label>
               </div>
              </div>
             </div>
             <div class="clearfix"></div>
           <div class="space-20-h"></div>
            <br>

             <div class="col-md-12 col-sm-12 ch-mt-3">
               <label class="no-sp-lb ">What level of dive licence do you have?</label>
             </div>
             <div class="col-md-12 col-sm-12 mrg-btm-row">
               <div class="be-col-6 col-md-2 col-sm-3 pdd-none">
                 <div class="checkbox">
                 <input type="checkbox" class="divechk" name="data[CharterGuestItineraryPreference][dive_license][]" value="1" <?php echo $diveLicenseChecked[1]; ?>>
                   <label class="pdd-none"><span class="sp-lab">Not Licenced</span></label>
                 </div>
               </div>
              <div class="be-col-6 col-md-2 col-sm-3">
                 <div class="checkbox">
                 <input type="checkbox"class="divechk" name="data[CharterGuestItineraryPreference][dive_license][]" value="2" <?php echo $diveLicenseChecked[2]; ?>>
                   <label class="pdd-none"><span class="sp-lab">Rescue Diver</span></label>
                 </div>
               </div>
               <div class="be-col-6 col-md-2 col-sm-3 ipd-0">
                 <div class="checkbox">
                 <input type="checkbox"class="divechk" name="data[CharterGuestItineraryPreference][dive_license][]" value="3" <?php echo $diveLicenseChecked[3]; ?>>
                   <label class="pdd-none"><span class="sp-lab">Open Water</span></label>
                 </div>
               </div>
              <div class="be-col-6 col-md-2 col-sm-3 md-ins-pad">
                 <div class="checkbox">
                 <input type="checkbox"class="divechk" name="data[CharterGuestItineraryPreference][dive_license][]" value="4" <?php echo $diveLicenseChecked[4]; ?>>
                   <label class="pdd-none"><span class="sp-lab">Instructor</span></label>
                 </div>
               </div>
               <input type="hidden"  name="data[CharterGuestItineraryPreference][dive_license_hidden][]" id="dive_license_hidden" value="" />
             </div>
             <div class="clearfix"></div>
             <br>
             <div class="col-md-12 spcae-02">
               <label>Special Considerations:</label>
             </div>
             <div class="col-md-10 ">
               <p>Scuba diving may only be available when arranged in conjuction <span class="ipadport-break"></span>with a local dive operator at additional charge.</p>
               <br>
             </div>
           </div>
           <br><br>
            <div class="form-group frmgrp-mar">
                <div class="col-sm-12">
                   
                        <?php if (!isset($charterAssocIdByHeaderView)) { ?>
                            <?php echo $this->Form->submit("Submit", array('class' => 'btn btn-success lastbutton'));?>
                        <?php } ?>
                  
                    
                </div>
            </div>
      </div>
    <?php echo $this->Form->end(); ?></div></div></div>
</div>





<!-- <div id="usesubmittedpreferences" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog" role="document">
    <div class="modal-content mc-bord">
      <div class="modal-body">
      <div class="modalmsg" style="margin-left: 30px;"> 
        <p>Would you like to allow your preferences to</p>
        <p>be provided to future charter programs</p>
        <p>without you having to submit them again?</p>
      </div>
        <div class="text-center">
          <input class="btn btn-success" style="background-color: #5cb85c;
    border-color: #4cae4c;" type="button" name="yes_please" id="yes_please" value="Yes please" />
          <input class="btn btn-danger" type="button" name="no_thanks" id="no_thanks" value="No thanks" />
        </div>   
        <div class="modalmsg" style="margin-left: 30px;"> 
        <p>You can login to Charter Guest and make</p>
        <p>changes to your preferences at any time.</p>
        </div> 
      </div>
    </div>
  </div>
</div> -->




<?php  //echo $showPopup;
//echo "<pre>";print_r($this->Session->read()); exit;
$CharterGuestAssociate = $this->Session->read('charter_assoc_info.CharterGuestAssociate'); 
?>
<script>
  var BASE_FOLDER = "<?php echo $baseFolder; ?>";


  
//Itinerary checkbox selected and unselected
$(".itinerary").click(function () {
        var it=0;
        var itin=[]; 
            $(".itinerary").each(function () {
                if($(this).is(':checked')) {
                  itin[it++] = $(this).val();
              }else{
                  itin[it++] = "unchecked";
              }
            });
            //console.log(cbox);
            $("#itinerary_hidden").val(itin);
            it = 0;
               
     });
     

     //dive checkbox selected and unselected
    $(".divechk").click(function () {
        var lic=0;
        var dive=[]; 
            $(".divechk").each(function () {
                if($(this).is(':checked')) {
                  dive[lic++] = $(this).val();
              }else{
                  dive[lic++] = "unchecked";
              }
            });
            //console.log(cbox);
            $("#dive_license_hidden").val(dive);
              lic = 0;
               
     });


</script>
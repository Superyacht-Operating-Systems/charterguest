<?php
$base = $this->request->base;
$sessionData = $this->Session->read();
$ownerprefenceID = $this->Session->read('ownerprefenceID');
// Personal deatils page
    $rainJacketSizeList = array(
        '' => 'Select Size',
        1 => 'Small',
        2 => 'Medium',
        3 => 'Large',
        4 => 'Extra Large'
    );
    $footSizeList = array(
        '' => 'Select Size',
        1 => '5/35',
        2 => '6/36',
        3 => '7/37.5',
        4 => '8/38.5',
        5 => '9/40',
        6 => '10/42',
        7 => '11/43.5',
        8 => '12/44',
        9 => '13/45',
        10 => '14/46.5',
        11 => '15/48'
    );
    $pillowTypeList = array(
        '' => 'Select Type',
        1 => 'Hard',
        2 => 'Medium',
        3 => 'Soft'
    );
    
    // Static data
    $specialOccationsList = array(
        1 => 'Birthday',
        2 => 'Honeymoon',
        3 => 'Film Festival',
        4 => 'Anniversary',
        5 => 'Other',
        6 => 'Event'
    );
    $specialOccationsChecked = array(
        1 => '',
        2 => '',
        3 => '',
        4 => '',
        5 => '',
        6 => ''
    );
    $dietriesList = array(
      1 => 'Kosher',
      2 => 'Low-Carb',
      3 => 'Low Cholesterol',
      4 => 'Low Sugar',
      5 => 'Vegetarian',
      6 => 'Low Fat',
      7 => 'Low Sodium',
      8 => 'Gluten Free',
      9 => 'Vegan',
      10 => 'Diabetic',
      11 => 'Diary Free',
      12 => 'Keto'
    );
    $dietriesChecked = array(
      1 => '',
      2 => '',
      3 => '',
      4 => '',
      5 => '',
      6 => '',
      7 => '',
      8 => '',
      9 => '',
      10 => '',
      11 => '',
      12 => ''
    );
    
    $allergiesList = array(
      1 => 'Shellfish',
      2 => 'Lactose',
      3 => 'Peanuts',
      4 => 'Gluten',
      5 => 'Kiwi Fruit',
      6 => 'Tomato',
      7 => 'Egg',
      8 => 'Sesame',
      9 => 'Tree Nuts',
      10 => 'Fish',
      11 => 'Milk',
      12 => 'Soy'
    ); 
    $allergiesChecked = array(
        1 => '',
        2 => '',
        3 => '',
        4 => '',
        5 => '',
        6 => '',
        7 => '',
        8 => '',
        9 => '',
        10 => '',
        11 => '',
        12 => ''
    );
    
    
    // Load the existing values
    $personalDetailsRowId = '';
    if (isset($personalDetails) && !empty($personalDetails)) {
        // Existing row id
        if (!empty($personalDetails['CharterGuestPersonalDetail']['id'])) {
            $personalDetailsRowId = $personalDetails['CharterGuestPersonalDetail']['id'];
        }
        // Special occations
        if (!empty($personalDetails['CharterGuestPersonalDetail']['special_occations'])) {
            $existOccations = explode(",", $personalDetails['CharterGuestPersonalDetail']['special_occations']);
            foreach ($existOccations as $item) {
                $specialOccationsChecked[$item] = "checked";
            }
        }
        // Dietry requirements
        if (!empty($personalDetails['CharterGuestPersonalDetail']['dietries'])) {
            $existDietries = explode(",", $personalDetails['CharterGuestPersonalDetail']['dietries']);
            foreach ($existDietries as $item) {
                $dietriesChecked[$item] = "checked";
            }
        }
        // Allergies
        if (!empty($personalDetails['CharterGuestPersonalDetail']['allergies'])) {
            $existAllergies = explode(",", $personalDetails['CharterGuestPersonalDetail']['allergies']);
            foreach ($existAllergies as $item) {
                $allergiesChecked[$item] = "checked";
            }
        }
    }
    
    // Auto populating the First and Last name if not filled the Personal details
    //echo "<pre>";print_r($personalDetails);
    $defaultFirstName = "";
    $defaultLastName = "";
    if (empty($personalDetails)) {
        // if (isset($sessionAssoc['CharterGuestAssociate']['id'])) { //echo "dddd";
        //     $defaultFirstName = $sessionAssoc['CharterGuestAssociate']['first_name'];
        //     $defaultLastName = $sessionAssoc['CharterGuestAssociate']['last_name'];
        // } else if (isset($charterAssocIdByHeaderEdit) && !empty($guestAssocDataByHeaderEdit)) { //echo "ssss";
        //    $defaultFirstName = $guestAssocDataByHeaderEdit['CharterGuestAssociate']['first_name'];
        //     $defaultLastName = $guestAssocDataByHeaderEdit['CharterGuestAssociate']['last_name'];
        // } else { //echo "AAAAAA";
            $defaultFirstName = $setdefaultFirstName;
            $defaultLastName = $setdefaultLastName;
            $deleteddob = $deleteddob;
            $deletedpob = $deletedpob;
        //}
    }
    
?>
<style>
    @media screen and (max-width: 990px){
.base-margin-botm .occDate input {
  margin-bottom: 0px;
}
    }
  .m-flex-row label{
    padding: 0px;
  }
  .anticipate-label{
    padding-right: 0px;
  }
  .frmgrp-mar .doy-enjoy {
  width: 317px;
}
.meals-other {
      display: inline-block;
    width: 100%;
    margin: 30px 0px 0px 0px;
}
  /*.typeahead { border: 1px solid #CCCCCC;border-radius: 4px;padding: 8px 12px;width: 300px;font-size:1.5em;}*/
  .tt-menu { width:300px; }
  span.twitter-typeahead .tt-suggestion {padding: 10px 20px;  border-bottom:#CCC 1px solid;cursor:pointer;}
  span.twitter-typeahead .tt-suggestion:last-child { border-bottom:0px; }
  .bgColor {max-width: 440px;height: 200px;background-color: #c3e8cb;padding: 40px 70px;border-radius:4px;margin:20px auto;}
  .demo-label {font-size:1.5em;color: #686868;font-weight: 500;}

  /* .modal-open .modal {
    background-color: #999;
} */
  </style>
<style>
.p-0left{
  padding-left: 0px;
}

.upload-img-row-container{
    width: 100%;
    display: inline-block;
  
}
.upload-img-row{
  display: inline-block;
    position: relative;
    right: 10px;
    float: right;
    margin: 5px 0px;
}

.checkbox-label-row .checkbox label::before{display: none;
  }
.checkbox-label-row .base-margin-botm label {
      position: relative;
    display: inline-block;
    width: 100%;
    text-align: right;
}

 .checkbox-label-row  .occfild{    width: 140px;}

.checkbox-label-row .checkbox input[type="checkbox"]{right:0px;}
.checkbox-label-row .checkbox label::before {
    right:-20px;left: inherit;
}

.checkbox-label-row  .checkbox input[type="checkbox"]:checked + label::after {
    right: -14px;left: inherit;
}



.checkbox label {
    display: inline-block;
    /* padding-left: 10px; */
    position: relative;
}
.checkbox label, .radio label {
    min-height: 20px;
    padding-left: 20px;
    margin-bottom: 0;
    font-weight: 400;
}
.checkbox, .radio {
    position: relative;
    display: block;
    margin-top: 10px;
    margin-left: 22px;
    margin-bottom: 10px;
}
.checkbox input[type="checkbox"] {
    cursor: pointer;
    opacity: 0;
    z-index: 1;
    outline: none !important;
}
.checkbox label::before {
      -o-transition: 0.3s ease-in-out;
    -webkit-transition: 0.3s ease-in-out;
    border-radius: 3px;
    content: "";
    display: inline-block;
    height: 17px;
    left: -3px;
    top: 1px;
    margin-left: -20px;
    position: absolute;
    transition: 0.3s ease-in-out;
    width: 17px;
    outline: none !important;
}

.checkbox input[type="checkbox"]:focus + label::before {
    outline-offset: -2px;
    outline: none;
    outline: thin dotted;
}
.checkbox input[type="checkbox"]:checked + label::after {
    content: "\f00c";
    content: '';
    /* display: block; */
    width: 5px;
    height: 9px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
    position: absolute;
    top: 4px;
    left: -17px;
}

label.txt-cent {
    padding: 0;
}

  input[type="file"].passportImageClass{
    width: 100%;
    max-width: none !important;
  }
  .spoc-lab{
    font-weight: normal;
    margin-top:5px;
  }
  .occDate{
    width:10%;
  }
  .text-right.occfild{
    width:13%;
  }
  .diet-head{
      width: 18%;
    }
  @media(max-width:1024px){
  .text-right.occfild{
    width:15%;
  }
.checkbox-label-row .base-margin-botm .spoc-lab{
  position: relative;
    right: 6px!important;
}

    .diet-head{
      width: 18%;
    }
  }
@media only screen and (max-width: 768px){
  .text-right.occfild{
    width:19%;
  }



hr.divider {
    border-top: 1px solid rgb(255 255 255)!important;
    width: 100%;
    display: inline-block;
}


    .diet-head{
      width: 22%;
    }

.clearfix {
    display: none!important;
}
.meals-container .checkbox label::before{top:0px;}
.meals-container .checkbox input[type="checkbox"]:checked + label::after{top:3px;}



}
/*Ramesh*/
input[type="radio"], input[type="checkbox"] {
    position: relative;
    top: 4px;
}
.col-md-12.label-inline label {
    position: relative;
    top: 5px;
}
.base-margin-botm label {
    position: relative;
}
/* Ramesh 10/08/2018 */
  @media only screen 
  and (min-device-width : 768px) 
  and (max-device-width : 1024px) 
  and (orientation : portrait) { 
   
    .base-margin-botm {
        display:  flex;
        flex-direction:  row;
    }
    .tabport-othercomments label {
        width: 22%;
        position: relative;
        top: 5px;
    }
    .tabport-othercomments .two {
        padding-left:  0px;
        width: 100%;
    }
    .tabport-pl0{
      padding-left: 0px;
    }
    .tabport-mlminus9{
      position: relative;
      left: -20px;
    }
    .base-margin-botm {
        display:  flex;
        flex-direction:  row;
    }
    .base-margin-botm .col-sm-2 {
        flex: 1;
    }
    .base-margin-botm label {
        position:  relative;
        top: 5px;
        font-size: 12px;
    }
    .base-margin-botm .occDate input {
        padding: 6px 8px;
    }
    input[type="radio"], input[type="checkbox"] {
        position: relative;
/*        top: 8px !important;*/
    }
  }
  @media only screen 
  and (min-device-width : 768px) 
  and (max-device-width : 1024px) 
  and (orientation : landscape) { 
    .base-margin-botm label {
        position: relative;
        top: 2px;
    }
    .base-margin-botm .occDate input {
        padding: 6px 8px;
    }
    input[type="radio"], input[type="checkbox"] {
        position: relative;
        top: 3.2px !important;
    }
  }
  /*End Ramesh 10/08/2018 */
   @media only screen 
and (min-device-width : 375px) 
and (max-device-width : 667px) { 
/*     .txt-right{
      text-align: left !important;
     }*/

/*.upload-img-row {
    text-align: right!important;
}*/
.md-0-320{padding-left: 25px;}
    .base-margin-botm label{
  
    top: 7px !important;
    }
    input[type="checkbox"] {
    position: relative;
/*    top: 0px !important;*/
    left:0px !important;
    }
    .birthdaybox{
      
    width: 160px;
    margin-left: 135px;
    margin-top: -27px;
    margin-bottom:0px;
    }

    .form-group {
    margin-bottom: 45px;
    }
    .dietry{
    margin-left: 175px;
    margin-top: -130px;
    }
    .requirment{
      display: inline;
    }
    .allerg{
      margin-top: 0px !important;
    }
    .allergbox{
/*      margin-left: -16px !important;*/
      margin-top: 0px;
    }
    
    .otherpart{
      margin-top: -10px;
    }
    .tabport-mlminus9{
      margin-top: 25px;
    }
    .seconddivider{
      margin-top: -1px;
    }
    .rainipbox{
      width: 140px;
      margin-left: -8px;
    }
    .pillow{
      width: 140px;
      margin-left: -8px;
    }
    .foot{
      width: 140px;
      margin-left: 150px;
      margin-top: px;
    }
    .extra{
      width: 140px;
      margin-left: 150px;
    }
/*    .footsize{
      margin-left: 150px;
      margin-top: -184px;
    }*/
/*    .extrapillow{
      margin-left: 150px;
      margin-top: -25px;
    }*/
/*    .pillowtext{
      margin-top: -30px;
    }*/
    .lastbutton{
      margin-bottom: 10px;
    }
    .film{
      display: inline;
    }
    .filmcheckbox{
      margin-left: -50px !important;
    }
.personal-row-container label{
  font-size: 13px;}

.personal-row-container .checkbox, .radio {
    margin-top: 0px;
}

.md-label-size {
    padding: 0px 10px;
    display: block!important;
}


.md-padd-mob{padding-left: 7px;
    position: relative;
    display: inline-block!important;}
.form-group .base-margin-botm {
    margin-bottom: 0px;
}

.label-bold-head{
    display: block;
    color: #fff;
    position: absolute;
    z-index: 9000;
    left: 95px;
    font-size: 20px!important;

}


}

@media screen and (max-width: 520px) {
.checkbox-label-row .checkbox label::before {
    right: -21px;
}
.checkbox-label-row .checkbox input[type="checkbox"]:checked + label::after {
    right: -16px;

}
.checkbox-label-row .checkbox input[type="checkbox"]{
  margin-left: 77px!important;
}

}

@media screen and (max-width: 768px){
.tabport-mlminus9 label {
    font-size: inherit;
}
.rain-marginleft {
    margin-left:0px;
}
.p-inlineblock .mob-w-70 {
    width: 60%!important;
    padding: 0px;
}

.mob-w-30{
  width: 40%!important;
  text-align: right;
  padding-left: 0px;
}
.p-inlineblock .mob-w-70{
  width: 60%!important;
      padding: 0px;
}
.mob-w-70{
  width: 60%!important;
      padding: 0px;
}
.w-100{
  width: 100%;
  padding: 0px;
}

.p-t-2{
  padding-top: 7px!important;
}
.tabport-mlminus9 label
{
  font-weight: bold!important;
 /* font-size: 14px!important;*/
}
}
@media only screen and (max-width: 767px)
{
.tabport-mlminus9 label{
  text-align: right!important;
}
.w-100 .input.file{
  margin-top: 21px!important;
}
.p-inlineblock{
  display: inline-block;
  width: 100%;
}
.p-inlineblock .col-xs-7{
  padding: 0px!important;
      width: 59%!important;
      float: right;
}
.p-inlineblock .mob-w-70 {
    padding: 0px;
}
}

.has-error{
  border: 1px solid rgb(255 0 0)!important;
}
</style>
<!-- personal details -->

      <div id="personal_det" class="tab-pane fade <?php echo $personalDetailsTab; ?>">
          <!--<form class="form-horizontal" id="personalDetailsForm" name="CharterGuestPersonalDetail" method="post" action="preference" enctype="multipart/form-data">-->
        <?php echo $this->Form->create('CharterGuestPersonalDetail', array('type'=>'file','url' => array('controller' => 'charters','action' => 'preference'),'id'=>'personalDetailsForm', 'class' => ''));     
           echo $this->Form->hidden("CharterGuestPersonalDetail.id", array('value' => $personalDetailsRowId));
           
           // When main Head charterer opens other guest(if Head charterer checked) and Update the Preference sheets
           if (isset($charterAssocIdByHeaderEdit)) {
               echo $this->Form->hidden("charterAssocIdByHeaderEdit", array('value' => $charterAssocIdByHeaderEdit));
           }
       ?>

<div class="personal-row-container personaldetails-row">
  <!-- <h1 class="position-mobile-head">Personal</h1> -->
  <?php if(isset($ownerprefenceID)){
              ?>
        <h1 class="position-mobile-head">PREFERENCES<span style="padding-left:20px;">1 of 7</span></h1>
          <?php }  else{ ?>
            <h1 class="position-mobile-head">PREFERENCES<span style="padding-left:20px;">1 of 5</span></h1>
          <?php } ?>
<div class="fixed-row-container personaldetails-row-md">  
 <div class="form-group base-margin">
  <div class="md-unblock-container">        
  <div class="p-inlineblock">       
          <div class="col-md-12">
          <div class="col-xs-5 col-md-4 col-sm-3 mob-w-30">
            <label class="pdd-none txt-right">First Name <span class="required"> * </span></label>
          </div>
          <div class="col-xs-7 col-md-5 col-sm-7 form-group mob-w-70">
              <?php echo $this->Form->input("first_name",array("label"=>false,'class'=>'form-control','type' => 'text', 'default' => $defaultFirstName)); ?>
          </div>
      
      </div></div>
      <div class="clearfix"></div>
  <div class="p-inlineblock">   
      <div class="col-md-12 ">
        <div class="col-xs-5 col-md-4 col-sm-3 mob-w-30">
          <label class="pdd-none txt-right">Family Name <span class="required"> * </span></label>
        </div>
        <div class="col-xs-7 col-md-5 col-sm-7 form-group mob-w-70">
          <?php echo $this->Form->input("family_name",array("label"=>false,'class'=>'form-control','type' => 'text', 'default' => $defaultLastName)); ?>
        </div>
      </div>
    </div>
      <div class="clearfix"></div>
  <div class="p-inlineblock">   
      <div class="col-md-12 ">
        <div class="col-xs-5 col-md-4 col-sm-3 mob-w-30">
          <label class="pdd-none txt-right">Date of Birth <span class="required"> * </span></label>
        </div>
        <div class="col-xs-7 col-md-5 form-group col-sm-7 mob-w-70">
          <?php echo $this->Form->input("dob",array("label"=>false,'class'=>'form-control dobDatePicker nonEditable','type' => 'text','default'=>$deleteddob)); ?>
        </div>
      </div></div>
      <div class="clearfix"></div>
  <div class="p-inlineblock">   
       <div class="col-md-12 ">
        <div class="col-xs-5 col-md-4 col-sm-3 mob-w-30">
          <label class="pdd-none txt-right">Place of Birth <span class="required"> * </span></label>
        </div>
        <div class="col-xs-7 col-md-5 form-group col-sm-7 mob-w-70">
           <?php echo $this->Form->input("pob",array("label"=>false,'class'=>'form-control','type' => 'text','default'=>$deletedpob)); ?>
        </div>
      </div></div>
      <div class="clearfix"></div>
  <div class="p-inlineblock">   
      <div class="col-md-12 ">
        <div class="col-xs-5 col-md-4 col-sm-3 mob-w-30">
          <label class="pdd-none txt-right">Nationality <span class="required"> * </span></label>
        </div>
        <div class="col-xs-7 col-md-5 col-sm-7 form-group mob-w-70">
         <?php echo $this->Form->input("nationality",array("label"=>false,'class'=>'form-control typeahead','type' => 'text')); ?>
        </div>
      </div>
     </div>
      <div class="clearfix"></div>

  <div class="p-inlineblock passort-div">   
      <div class="col-md-12 ">
        <div class="col-xs-5 col-md-4 col-sm-3 mob-w-30">
          <label class="pdd-none txt-right">Passport # <span class="required"> * </span></label>
        </div>
        <div class="col-xs-7 col-md-5 col-sm-7 form-group mob-w-70">
             <?php echo $this->Form->input("passport_num",array("label"=>false,'class'=>'form-control','type' => 'text')); ?>
        </div>
      </div></div>
      <div class="clearfix"></div>
  <div class="p-inlineblock">   
      <div class="col-md-12 ">
        <div class="col-xs-5 col-md-4 col-sm-3 mob-w-30">
          <label class="pdd-none txt-right">Issue Date <span class="required"> * </span></label>
        </div>
        <div class="col-xs-7 col-md-5 col-sm-7 form-group mob-w-70">
           <?php echo $this->Form->input("issued_date",array("label"=>false,'class'=>'form-control issuedatePicker nonEditable','type' => 'text')); ?>
           <span class="error" id="IssuedDateErrorMessage" style="display: none;">Enter valid date</span>
        </div>
      </div></div>
      <div class="clearfix"></div>
  <div class="p-inlineblock">   
      <div class="col-md-12 ">
        <div class="col-xs-5 col-md-4 col-sm-3 mob-w-30">
          <label class="pdd-none txt-right">Expiry Date <span class="required"> * </span></label>
        </div>
        <div class="col-xs-7 col-md-5 col-sm-7 form-group mob-w-70">
          <?php echo $this->Form->input("expiry_date",array("label"=>false,'class'=>'form-control expirydatePicker nonEditable','type' => 'text')); ?>
           <span class="error" id="ExpiryDateErrorMessage" style="display: none;">Enter valid date</span>
        </div>
      </div></div>
      <div class="clearfix"></div>
  <div class="p-inlineblock">   
      <div class="col-md-12 upload-img-row-container">
        <div class="col-xs-5 col-md-4 col-sm-3 mob-w-30">
          <label class="pdd-none txt-right">Passport</label>
        </div>
        <div class="col-xs-12 col-md-5 col-sm-7 form-group mob-w-70">
          <div class="xs-small-divice w-100">
           <?php echo $this->Form->input("passport_image",array("type" => "file", "label"=>false,'class'=>'passportImageClass form-control','id' => 'passportImage')); ?>
          </div>
          <span class="required img-view-modal">only jpg, jpeg, png and pdf</span>
       
        <div class="upload-img-result">
            <?php //echo $this->request->base;
                $existImageName = "";
                $passportUrl = "javascript:void(0);";
                if (isset($personalDetails['CharterGuestPersonalDetail']['passport_image']) && !empty($personalDetails['CharterGuestPersonalDetail']['passport_image'])) {
                    $existImageName = $personalDetails['CharterGuestPersonalDetail']['passport_image'];
                    $passportUrl = BASE_URL.$this->request->base."/app/webroot/img/passport_images/".$personalDetails['CharterGuestPersonalDetail']['passport_image'];
                    $position = strpos($existImageName, "_");
                    if ($position == 12) {
                        $existImageName = substr($existImageName, $position+1);
                    }
                }
            ?>
            <span class="pdd-none txt-right upload-img-row"><a href="<?php echo $passportUrl; ?>" target="_blank"><?php echo $existImageName; ?></a></span>
          <?php echo $this->Form->hidden("exist_passport_image",array("type" => "text", "value"=> $existImageName)); ?>
        </div>
         </div>
      </div></div>
      <div class="clearfix"></div>
</div>
      <div class="col-md-12 md-full-container-width">
        <div class="col-xs-5 col-md-4 col-sm-3 mob-w-30">
          <label class="txt-right p-t-02">Medical Conditions</label>
        </div>
        <div class="col-xs-7 col-md-5 col-sm-7 form-group mob-w-70">
             <?php echo $this->Form->input("medical_conditions",array("type" => "textarea", "label"=>false,'class'=>'form-control textarea-height med-h')); ?>
        </div>
      </div>
      <div class="clearfix"></div>
    
      <div class="col-md-12 ">
        <div class="col-xs-5 col-md-4 col-sm-3 mob-w-30">
          <label class="txt-right p-t-02">Next of Kin <span class="required"> * </span></label>
        </div>
        <div class="col-xs-7 col-md-5 col-sm-7 form-group mob-w-70">
         <?php echo $this->Form->input("next_of_kin",array("label"=>false,'class'=>'form-control','type' => 'text')); ?>
        </div>
      </div>
      <div class="col-md-12 d-inlineblockelements">
        <div class="col-xs-5 col-md-4 col-sm-3 mob-w-30">
          <label class="txt-right p-t-02">NoK Phone <span class="required"> * </span></label>
        </div>
        <div class="col-xs-7 col-md-5 col-sm-7 form-group mob-w-70">
         <?php echo $this->Form->input("next_of_kin_phone",array("label"=>false,'class'=>'form-control','type' => 'text')); ?>
        </div>
      </div>
      <div class="clearfix"></div>
      <hr class="divider md-12-padd-15">
<div class="charte-rightalign">
      <div class="col-md-12">
         <label class="md-label-size specail-label">Special Occasions during cruise</label>
      </div>

      <div class="col-md-12 form-group checkbox-label-row checkbox-label-row-padd ch-mrgbellow-0">
             <div class="base-margin-botm">
              <div class="base-reponsive">
                  <div class="col-sm-2 occfild mob-w-30">
                    <div class="checkbox my-none">
            <input type="checkbox" name="data[CharterGuestPersonalDetail][special_occations][]" value="1" <?php echo $specialOccationsChecked[1]; ?>>
                        <label class="spoc-lab">Birthday</label>
<!--
                      <div class="checkbox">
                      <input type="checkbox" name="data[CharterGuestPersonalDetail][special_occations][]" value="1" <?php echo $specialOccationsChecked[1]; ?>>
                       <label class="txt-cent ">
                         
                               <?php // echo $this->Form->input("special_occations[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 1)); ?>
                               Birthday</label>
                      </div>                    
-->
                  </div>  </div>
                  <div class="col-sm-2 pdd-none occDate mob-w-70">
                      <?php echo $this->Form->input("birthday_date",array("label"=>false,'class'=>'form-control occationDatePicker nonEditable birthdaybox','type' => 'text')); ?>
                  </div>  </div>
                   <div class="base-reponsive">
                  <div class="col-sm-2 occfild mob-w-30">
                    <div class="checkbox my-none">
            <input type="checkbox" name="data[CharterGuestPersonalDetail][special_occations][]" value="2" <?php echo $specialOccationsChecked[2]; ?>> 
                  <label class="spoc-lab">Honeymoon</label>
<!--
                     <div class="checkbox">
                          <input type="checkbox" name="data[CharterGuestPersonalDetail][special_occations][]" value="2" <?php echo $specialOccationsChecked[2]; ?>> 
                     <label class="txt-cent ">
                     
                             <?php // echo $this->Form->input("special_occations[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 2)); ?>
                             Honeymoon
                     </label>
                   </div>
-->
                  </div>     </div>
                  <div class="col-sm-2 pdd-none occDate mob-w-70">
                     <?php echo $this->Form->input("honeymoon_date",array("label"=>false,'class'=>'form-control occationDatePicker nonEditable birthdaybox','type' => 'text')); ?>
                  </div> </div>
                   <div class="base-reponsive">
                    <div class="col-sm-2 occfild mob-w-30">
                      <div class="checkbox my-none">
          
             <input type="checkbox" name="data[CharterGuestPersonalDetail][special_occations][]" value="6" <?php echo $specialOccationsChecked[6]; ?>> 
              <label class="spoc-lab">Event</label>
<!--
                     <div class="checkbox">
                      <input type="checkbox" name="data[CharterGuestPersonalDetail][special_occations][]" value="6" <?php echo $specialOccationsChecked[6]; ?>> 
                     <label class="txt-cent ">
                        
                         Event
                     </label>
                   </div>
-->
                  </div> </div>
                  <div class="col-sm-2 pdd-none occDate mob-w-70">
                    <?php echo $this->Form->input("event_date",array("label"=>false,'class'=>'form-control occationDatePicker nonEditable birthdaybox','type' => 'text')); ?>
                  </div> </div>
                </div>
                <div class="clearfix"></div>
            <div class="base-margin-botm">
               <div class="base-reponsive">
                  <div class="col-sm-2 occfild mob-w-30 film p-0left">
                <div class="checkbox my-none">
            <input class="filmcheckbox"type="checkbox" name="data[CharterGuestPersonalDetail][special_occations][]" value="3" <?php echo $specialOccationsChecked[3]; ?>> 
             <label class="spoc-lab ">Festival</label>
<!--
                      <div class="checkbox">
                       <input type="checkbox" name="data[CharterGuestPersonalDetail][special_occations][]" value="3" <?php echo $specialOccationsChecked[3]; ?>> 
                       <label class="txt-cent ">
                        
                               <?php // echo $this->Form->input("special_occations[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 3)); ?>
                               Film Festival
                       </label>
                      </div>                    
-->
                  </div></div>
                  <div class="col-sm-2 pdd-none occDate mob-w-70">
                             <?php echo $this->Form->input("film_festival_date",array("label"=>false,'class'=>'form-control occationDatePicker nonEditable birthdaybox','type' => 'text')); ?>
                  </div></div>
                   <div class="base-reponsive">
                  <div class="col-sm-2  occfild mob-w-30">
                        <div class="checkbox my-none">
            <input type="checkbox" name="data[CharterGuestPersonalDetail][special_occations][]" value="4" <?php echo $specialOccationsChecked[4]; ?>> 
                        <label class="spoc-lab">Anniversary</label>
<!--
                     <div class="checkbox">
                       <input type="checkbox" name="data[CharterGuestPersonalDetail][special_occations][]" value="4" <?php echo $specialOccationsChecked[4]; ?>> 
                     <label class="txt-cent ">
                       
                             <?php // echo $this->Form->input("special_occations[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 4)); ?>
                             Anniversary

                     </label>
                   </div>
-->
                  </div> </div>
                  <div class="col-sm-2 pdd-none occDate mob-w-70">
                   <?php echo $this->Form->input("anniversary_date",array("label"=>false,'class'=>'form-control occationDatePicker nonEditable birthdaybox','type' => 'text')); ?>
                  </div></div>
                   <div class="base-reponsive">
                    <div class="col-sm-2 occfild mob-w-30">
                          <div class="checkbox my-none">
            <input type="checkbox" name="data[CharterGuestPersonalDetail][special_occations][]" value="5" <?php echo $specialOccationsChecked[5]; ?>> 
                        <label class="spoc-lab">Other</label>
            
<!--
                     <div class="checkbox">
                      <input type="checkbox" name="data[CharterGuestPersonalDetail][special_occations][]" value="5" <?php echo $specialOccationsChecked[5]; ?>> 
                     <label class="txt-cent ">
                       
                               <?php // echo $this->Form->input("special_occations[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 5)); ?>
                               Other
                     </label>
                   </div>
-->
                  </div> </div>
                  <div class="col-sm-2 pdd-none occDate mob-w-70">
                    <?php echo $this->Form->input("other_occation_date",array("label"=>false,'class'=>'form-control occationDatePicker nonEditable birthdaybox','type' => 'text')); ?>
                  </div>
                </div></div>

      </div>  </div>
       <div class="clearfix"></div>
       <hr class="divider md-12-padd-15"/>

<!-- Dietry requirements -->
        <div class="col-md-12 form-group dietary-requirements-row">
          <label class="txt-right col-sm-2 md-label-size no-text-padd">Dietary Requirements</label>
        <div class="col-sm-10 row-100-width">
                  <div class="col-xs-6 col-sm-2 pdd-none w-fit-200">
                      <div class="checkbox my-none">
                      <input type="checkbox" class="dietchk" name="data[CharterGuestPersonalDetail][dietries][]" value="1" <?php echo $dietriesChecked[1]; ?>>
                       <label class="pdd-none">
                          
                               <?php // echo $this->Form->input("dietries[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 1)); ?>
                               Kosher
                       </label>
                      </div>                    
                  </div>
                  <div class="col-xs-6 col-sm-2 pdd-none rit-padd w-fit-200">
                       <div class="checkbox my-none">
                        <input type="checkbox" class="dietchk" name="data[CharterGuestPersonalDetail][dietries][]" value="2" <?php echo $dietriesChecked[2]; ?>>
                       <label class="pdd-none">
                       
                               <?php // echo $this->Form->input("dietries[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 2)); ?>
                               Low Carb
                       </label>
                      </div>
                  </div>
               <div class="col-xs-6 col-sm-3 col-24 col-md-2 pdd-none w-fit-200">
                       <div class="checkbox">
                        <input type="checkbox" class="dietchk" name="data[CharterGuestPersonalDetail][dietries][]" value="3" <?php echo $dietriesChecked[3]; ?>>
                       <label class="pdd-none">
                        
                               <?php // echo $this->Form->input("dietries[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 6)); ?>
                               Low Cholesterol
                       </label>
                      </div>
                  </div>
                  <div class="col-xs-6 col-sm-2 col-md-2 pdd-none space-012 rit-padd w-fit-200">
                     <div class="checkbox my-none">
                      <input type="checkbox" class="dietchk" name="data[CharterGuestPersonalDetail][dietries][]" value="4" <?php echo $dietriesChecked[4]; ?>>
                     <label class="pdd-none">
                     
                   <?php // echo $this->Form->input("dietries[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 4)); ?>
                   Low Sugar
                     </label>
                   </div>
                  </div>
        </div>
         <div class="clearfix"></div>
                <label class="col-sm-2 mg-0-space" >
                        </label>
                      <div class="col-sm-10 row-100-width">
                  <div class="col-xs-6 col-sm-2 pdd-none w-fit-200">
                      <div class="checkbox ">
                       <input type="checkbox" class="dietchk" name="data[CharterGuestPersonalDetail][dietries][]" value="5" <?php echo $dietriesChecked[5]; ?>>
                       <label class="pdd-none">
                         
                   <?php // echo $this->Form->input("dietries[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 5)); ?>
                   Vegetarian   
                       </label>
                      </div>                    
                  </div>
                       <div class="col-xs-6 col-sm-2 col-md-2 pdd-none rit-padd w-fit-200 ">
                     <div class="checkbox my-none">
                      <input type="checkbox" class="dietchk" name="data[CharterGuestPersonalDetail][dietries][]" value="6" <?php echo $dietriesChecked[6]; ?>>
                     <label class="pdd-none">
                      
                             <?php // echo $this->Form->input("dietries[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 3)); ?>
                             Low Fat
                     </label>
                   </div>
                  </div>
            
                  <div class="col-xs-6 col-sm-3 col-md-2 col-24 pdd-none w-fit-200">
                     <div class="checkbox ">
                     <input type="checkbox" class="dietchk" name="data[CharterGuestPersonalDetail][dietries][]" value="7" <?php echo $dietriesChecked[7]; ?>>
                     <label class="pdd-none">
                   
                   <?php // echo $this->Form->input("dietries[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 7)); ?>
                   Low Sodium
                     </label>
                   </div>
                  </div>
          <div class="col-xs-6 col-sm-2 col-md-3 pdd-none rit-padd space-012 w-fit-200">
                     <div class="checkbox">
                     <input type="checkbox" class="dietchk" name="data[CharterGuestPersonalDetail][dietries][]" value="8" <?php echo $dietriesChecked[8]; ?>>
                     <label class="pdd-none">
                   
                   <?php // echo $this->Form->input("dietries[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 7)); ?>
                 Gluten Free
                     </label>
                   </div>
                  </div>
              </div>
        <div class="clearfix"></div>
                <label class="col-sm-2 mg-0-space" >
                        </label>
                      <div class="col-sm-10 row-100-width">
                  <div class="col-xs-6 col-sm-2 pdd-none w-fit-200">
                      <div class="checkbox ">
                       <input type="checkbox" class="dietchk" name="data[CharterGuestPersonalDetail][dietries][]" value="9" <?php echo $dietriesChecked[9]; ?>>
                       <label class="pdd-none">
                         
                   <?php // echo $this->Form->input("dietries[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 5)); ?>
                   Vegan   
                       </label>
                      </div>                    
                  </div>
                       <div class="col-xs-6 col-sm-2 col-md-2 pdd-none rit-padd w-fit-200">
                     <div class="checkbox my-none">
                      <input type="checkbox" class="dietchk" name="data[CharterGuestPersonalDetail][dietries][]" value="10" <?php echo $dietriesChecked[10]; ?>>
                     <label class="pdd-none">
                      
                             <?php // echo $this->Form->input("dietries[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 3)); ?>
                             Diabetic
                     </label>
                   </div>
                  </div>
            
                  <div class="col-xs-6 col-sm-3 col-md-2 col-24 pdd-none w-fit-200">
                     <div class="checkbox">
                     <input type="checkbox" class="dietchk" name="data[CharterGuestPersonalDetail][dietries][]" value="11" <?php echo $dietriesChecked[11]; ?>>
                     <label class="pdd-none">
                   
                   <?php // echo $this->Form->input("dietries[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 7)); ?>
                   Diary Free
                     </label>
                   </div>
                  </div>
          <div class="col-xs-6 col-sm-2 col-md-3 pdd-none rit-padd space-012 w-fit-200">
                     <div class="checkbox">
                     <input type="checkbox" class="dietchk" name="data[CharterGuestPersonalDetail][dietries][]" value="12" <?php echo $dietriesChecked[12]; ?>>
                     <label class="pdd-none">
                   
                   <?php // echo $this->Form->input("dietries[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 7)); ?>
                 Keto
                     </label>
                   </div>
                  </div>
              </div>
               <div class="clearfix"></div>
               <input type="hidden" name="data[CharterGuestPersonalDetail][dietries_hidden][]" id="dietries_hidden" value="" />
         <div class="form-group base-margin no-text-padd tabport-othercomments ">
          
           <label class="txt-right col-sm-2 md-padd-mob no-text-padd" >Other</label>
           <div class="col-sm-8 two ">
                 <?php echo $this->Form->input("dietry_comments",array("label"=>false,'class'=>'form-control','type' => 'text')); ?>
            </div>
          </div>
           <div class="clearfix"></div>
           <div class="base-margin">
            <div class="form-group tabport-othercomments">
          
          <label class="col-xs-12 txt-right no-text-padd col-sm-2 allerg md-padd-mob">Allergies</label>
             <div class="col-xs-12 col-sm-10 two allergbox">
            <div class="col-xs-6 col-sm-2 md-l0 w-fit-200">
                      <div class="checkbox my-none">
                       <input type="checkbox" class="allergieschk" name="data[CharterGuestPersonalDetail][allergies][]" value="1" <?php echo $allergiesChecked[1]; ?>>
                       <label class="pdd-none">
                       
                               <?php // echo $this->Form->input("allergies[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 1)); ?>
                               Shellfish
                       </label>
                      </div>                    
            </div>
                  <div class="col-xs-6 col-sm-2 md-0-320 w-fit-200">
                       <div class="checkbox my-none">
                        <input type="checkbox" class="allergieschk" name="data[CharterGuestPersonalDetail][allergies][]" value="2" <?php echo $allergiesChecked[2]; ?>>
                       <label class="pdd-none">
                        
                               <?php // echo $this->Form->input("allergies[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 2)); ?>
                               Lactose
                       </label>
                      </div>
                  </div>
                  <div class="col-xs-6 col-sm-2 pad-md-left-0 space-08 w-fit-200">
                     <div class="checkbox my-none nuts">
                      <input type="checkbox" class="allergieschk" name="data[CharterGuestPersonalDetail][allergies][]" value="3" <?php echo $allergiesChecked[3]; ?>>
                     <label class="pdd-none">
                     
                             <?php // echo $this->Form->input("allergies[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 3)); ?>
                             Peanut
                     </label>
                   </div>
                  </div>
                  <div class="col-xs-6 col-sm-2 md-0-320 space-06 w-fit-200">
                     <div class="checkbox my-none glutten">
                     <input type="checkbox" class="allergieschk" name="data[CharterGuestPersonalDetail][allergies][]" value="4" <?php echo $allergiesChecked[4]; ?>>
                     <label class="pdd-none">
                       
                             <?php // echo $this->Form->input("allergies[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 4)); ?>
                             Gluten
                     </label>
                   </div>
                  </div>
          </div>

          </div>
 <div class="form-group tabport-othercomments sp-space-column">
          
          <label class="col-xs-12 dis-label-space col-sm-2"></label>
             <div class="col-xs-12 col-sm-10 two allergbox">
            <div class="col-xs-6 col-sm-2 md-l0 w-fit-200">
                      <div class="checkbox my-none">
                       <input type="checkbox" class="allergieschk" name="data[CharterGuestPersonalDetail][allergies][]" value="5" <?php echo $allergiesChecked[5]; ?>>
                       <label class="pdd-none">
                       
                               <?php // echo $this->Form->input("allergies[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 1)); ?>
                               Kiwi Fruit
                       </label>
                      </div>                    
            </div>
                  <div class="col-xs-6 col-sm-2 md-0-320 w-fit-200">
                       <div class="checkbox my-none">
                        <input type="checkbox" class="allergieschk" name="data[CharterGuestPersonalDetail][allergies][]" value="6" <?php echo $allergiesChecked[6]; ?>>
                       <label class="pdd-none">
                        
                               <?php // echo $this->Form->input("allergies[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 2)); ?>
                               Tomato
                       </label>
                      </div>
                  </div>
                  <div class="col-xs-6 col-sm-2 pad-md-left-0 space-08 w-fit-200">
                     <div class="checkbox my-none nuts">
                      <input type="checkbox" class="allergieschk" name="data[CharterGuestPersonalDetail][allergies][]" value="7" <?php echo $allergiesChecked[7]; ?>>
                     <label class="pdd-none">
                     
                             <?php // echo $this->Form->input("allergies[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 3)); ?>
                            Egg
                     </label>
                   </div>
                  </div>
                  <div class="col-xs-6 col-sm-2 md-0-320 space-06 w-fit-200">
                     <div class="checkbox my-none glutten">
                     <input type="checkbox" class="allergieschk" name="data[CharterGuestPersonalDetail][allergies][]" value="8" <?php echo $allergiesChecked[8]; ?>>
                     <label class="pdd-none">
                       
                             <?php // echo $this->Form->input("allergies[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 4)); ?>
                             Sesame
                     </label>
                   </div>
                  </div>
          </div>

          </div>
           <div class="form-group tabport-othercomments">
          
           <label class="col-xs-12 dis-label-space col-sm-2"></label>
             <div class="col-xs-12 col-sm-10 two allergbox ">
            <div class="col-xs-6 col-sm-2 md-l0 w-fit-200">
                      <div class="checkbox my-none">
                       <input type="checkbox" class="allergieschk" name="data[CharterGuestPersonalDetail][allergies][]" value="9" <?php echo $allergiesChecked[9]; ?>>
                       <label class="pdd-none">
                       
                               <?php // echo $this->Form->input("allergies[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 1)); ?>
                               Tree Nuts
                       </label>
                      </div>                    
            </div>
                  <div class="col-xs-6 col-sm-2 md-0-320 w-fit-200">
                       <div class="checkbox my-none">
                        <input type="checkbox" class="allergieschk" name="data[CharterGuestPersonalDetail][allergies][]" value="10" <?php echo $allergiesChecked[10]; ?>>
                       <label class="pdd-none">
                        
                               <?php // echo $this->Form->input("allergies[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 2)); ?>
                               Fish
                       </label>
                      </div>
                  </div>
                  <div class="col-xs-6 col-sm-2 pad-md-left-0 space-08 w-fit-200">
                     <div class="checkbox my-none nuts">
                      <input type="checkbox" class="allergieschk" name="data[CharterGuestPersonalDetail][allergies][]" value="11" <?php echo $allergiesChecked[11]; ?>>
                     <label class="pdd-none">
                     
                             <?php // echo $this->Form->input("allergies[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 3)); ?>
                             Milk
                     </label>
                   </div>
                  </div>
                  <div class="col-xs-6 col-sm-2 md-0-320 space-06 w-fit-200">
                     <div class="checkbox my-none glutten">
                     <input type="checkbox" class="allergieschk" name="data[CharterGuestPersonalDetail][allergies][]" value="12" <?php echo $allergiesChecked[12]; ?>>
                     <label class="pdd-none">
                       
                             <?php // echo $this->Form->input("allergies[]",array("type" => "checkbox", "label"=>false,'div'=>false,'class'=>'', 'value' => 4)); ?>
                             Soy
                     </label>
                   </div>
                  </div>
          </div>

          </div>






        </div>
        <input type="hidden" name="data[CharterGuestPersonalDetail][allergies_hidden][]" id="allergies_hidden" value="" />
        <div class="clearfix"></div>
         <div class="form-group base-margin tabport-othercomments otherpart">
          
          <label class="txt-right col-sm-2 md-padd-mob no-text-padd" >Other</label>
           <div class="col-sm-8 two">
              <?php echo $this->Form->input("allergy_comments",array("label"=>false,'class'=>'form-control','type' => 'text')); ?>
            </div>
          </div>
      </div>
      <div class="clearfix"></div>
      <hr class="divider seconddivider md-12-padd-15" />

            <div class="col-md-12 label-inline tabport-mlminus9 rain-marginleft">  
      <div class="p-inlineblock col-md-5">
        <div class="rain-rwo">
      <div class="col-xs-4 col-md-4 col-sm-4 mob-w-30  p-t-2">
        <label class="pdd-none txt-right">Rain Jacket</label>
      </div>
      <div class="col-xs-8 col-md-7 col-sm-7 tabport-pl0 mob-w-70">
              <?php echo $this->Form->input("rain_jacket_size",array("label"=>false,'class'=>'form-control form-group rainipbox','options' => $rainJacketSizeList)); ?>
      </div>  
      </div>

        <div class="clearfix"></div>
        <div class="rain-rwo">
      <div class="col-xs-4 col-md-4 col-sm-4 mob-w-30 p-t-2">
        <label class="pdd-none txt-right">Foot Size</label>
      </div>
      <div class="col-xs-8 col-sm-7 col-md-7 tabport-pl0 mob-w-70">
                    <?php echo $this->Form->input("foot_size",array("label"=>false,'class'=>'form-control form-group foot','options' => $footSizeList)); ?>
    </div></div>
  </div>
  
   <!-- <div class="col-md-1 col-sm-1"></div> -->
     <div class="p-inlineblock col-md-5">
      <div class="rain-rwo">
            <div class="col-xs-4 col-md-4 col-sm-4 mob-w-30 p-t-2">
        <label class="pdd-none txt-right ">Pillow Type</label>
      </div>
      <div class="col-xs-8 col-sm-7 col-md-7 tabport-pl0 mob-w-70">
   <?php echo $this->Form->input("pillow_type",array("label"=>false,'class'=>'form-control form-group pillow','options' => $pillowTypeList)); ?>
      </div>
</div>
<div class="rain-rwo">
   <!-- <div class="col-md-1 col-sm-1"></div> -->
       <div class="col-xs-4 col-md-4 col-sm-4 mob-w-30 p-t-2">
        <label class="pdd-none txt-right">Extra Pillow</label>
      </div>
      <div class="col-xs-8 col-sm-7 col-md-7 tabport-pl0 mob-w-70">
               <?php echo $this->Form->input("extra_pillow",array("label"=>false,'class'=>'form-control form-group extra','options' => $pillowTypeList)); ?>
      </div></div></div>
      </div>
      </div>
        <div class="clearfix"></div>
          <div class="form-group base-margin">
                <div class="col-sm-12 "> 
               <div class="text-center footer-mob-row-inner">
                <div class="submit">
                   <?php if (!isset($charterAssocIdByHeaderView)) { ?>
                        <button type="button" class="btn btn-success lastbutton" id="personalDetailsSubmit">Save and Continue</button>
                        <?php echo $this->Form->submit("Save and Continue", array('class' => 'btn btn-success', 'style' => 'display:none;', 'id' => 'personalDetailsSubmitOriginal'));?>
                   <?php } ?> 
                   </div>   
                </div>
                </div>
            </div>
        <?php echo $this->Form->end(); ?>
      </div>
</div></div>

<script>
//Dietary checkbox selected and unselected
    $(".dietchk").click(function () {
        var di=0;
        var diet=[]; 
            $(".dietchk").each(function () {
                if($(this).is(':checked')) {
                  diet[di++] = $(this).val();
              }else{
                  diet[di++] = "unchecked";
              }
            });
            // console.log($(this).val());
            $("#dietries_hidden").val(diet);
              di = 0;
               
     });
     

     //allergies checkbox selected and unselected
    $(".allergieschk").click(function () {
        var all=0;
        var allergies=[]; 
            $(".allergieschk").each(function () {
                if($(this).is(':checked')) {
                  allergies[all++] = $(this).val();
              }else{
                  allergies[all++] = "unchecked";
              }
            });
            //console.log(cbox);
            $("#allergies_hidden").val(allergies);
              all = 0;
               
     });

$("#CharterGuestPersonalDetailIssuedDate").on("change", function(e) {
  var issued = $('#CharterGuestPersonalDetailIssuedDate').val();
  var expired = $('#CharterGuestPersonalDetailExpiryDate').val();
  $('#IssuedDateErrorMessage').css({ display: "none" });

   var issued1 = new Date(issued);
   var expired1 = new Date(expired);


  if(issued1 > expired1){
    $('#IssuedDateErrorMessage').css({ display: "block" });
    $('#CharterGuestPersonalDetailIssuedDate').val('');
  }
});
$("#CharterGuestPersonalDetailExpiryDate").on("change", function(e) {
  var issued = $('#CharterGuestPersonalDetailIssuedDate').val();
  var expired = $('#CharterGuestPersonalDetailExpiryDate').val();
  $('#ExpiryDateErrorMessage').css({ display: "none" });
  var issued1 = new Date(issued);
  var expired1 = new Date(expired);
  if(issued1 > expired1){
    $('#ExpiryDateErrorMessage').css({ display: "block" });
    $('#CharterGuestPersonalDetailExpiryDate').val('');
  }
});
</script>


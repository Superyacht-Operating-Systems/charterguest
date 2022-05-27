<?php

// Meal Preference page
    // brakfast likes
    $breakfastLikesList = array(
        1 => 'Egg',
        2 => 'Sausage',
        3 => 'Pancakes',
        4 => 'Hot Cereals',
        5 => 'Cold Cereals',
        6 => 'Bacon',
        7 => 'Fruits',
        8 => 'Bagels',
        9 => 'Pastries',
        10 => 'Danish',
        11 => 'Ham',
        12 => 'Omelettes',
        13 => 'Coffee/Tea',
        14 => 'Juice',
        15 => 'Milk'
    );
    $breakfastLikesListChecked = array(
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
        12 => '',
        13 => '',
        14 => '',
        15 => ''
    );
    
    // Lunch types
    $lunchTypeList = array(
        1 => 'Hot',
        2 => 'Cold',
        3 => 'Hearty',
        4 => 'Healthy'
    );
    $lunchTypeListChecked = array(
        1 => '',
        2 => '',
        3 => '',
        4 => ''
    );
    
    // Lunch styles
    $lunchStyleList = array(
        1 => 'Family style buffet',
        2 => 'Formal Plate Lunch',
        3 => 'Healthy',
        4 => 'Substantial'
    );
    $lunchStyleListChecked = array(
        1 => '',
        2 => '',
        3 => '',
        4 => ''
    );
    
    // Hors d'eovres Preferences
    $deovresList = array(
        1 => 'Caviar',
        2 => 'Canapes',
        3 => 'Crudites',
        4 => 'Sushi',
        5 => 'Cheese'
    );
    $deovresListChecked = array(
        1 => '',
        2 => '',
        3 => '',
        4 => '',
        5 => ''
    );
 
    // Load the existing values
    $mealPreferenceRowId = ''; 
    $isBreakfastYes = $isBreakfastNo = '';
    $isLunchDesertYes = $isLunchDesertNo = '';
    $isDiningAshoreYes = $isDiningAshoreNo = '';
    $isDeovresYes = $isDeovresNo = '';
    $isDinnerDesertYes = $isDinnerDesertNo = '';
            
    if (isset($mealPreferences) && !empty($mealPreferences)) {
        // Existing row id
        if (!empty($mealPreferences['CharterGuestMealPreference']['id'])) {
            $mealPreferenceRowId = $mealPreferences['CharterGuestMealPreference']['id'];
        }
        // Breakfast likes
        if (!empty($mealPreferences['CharterGuestMealPreference']['breakfast_likes'])) {
            $existLikes = explode(",", $mealPreferences['CharterGuestMealPreference']['breakfast_likes']);
            foreach ($existLikes as $item) {
                $breakfastLikesListChecked[$item] = "checked";
            }
        }
        // Lunct types
        if (!empty($mealPreferences['CharterGuestMealPreference']['lunch_type'])) {
            $existLunchTypes = explode(",", $mealPreferences['CharterGuestMealPreference']['lunch_type']);
            foreach ($existLunchTypes as $item) {
                $lunchTypeListChecked[$item] = "checked";
            }
        }
        // Lunch styles
        if (!empty($mealPreferences['CharterGuestMealPreference']['lunch_style'])) {
            $existLunchStyles = explode(",", $mealPreferences['CharterGuestMealPreference']['lunch_style']);
            foreach ($existLunchStyles as $item) {
                $lunchStyleListChecked[$item] = "checked";
            }
        }
        // Hors d'eovres Preferences
        if (!empty($mealPreferences['CharterGuestMealPreference']['deovres_preference'])) {
            $existDeovres = explode(",", $mealPreferences['CharterGuestMealPreference']['deovres_preference']);
            foreach ($existDeovres as $item) {
                $deovresListChecked[$item] = "checked";
            }
        }
        // Yes/No types
        if (in_array($mealPreferences['CharterGuestMealPreference']['is_breakfast'], array(0,1))) {
            $isBreakfastYes = ($mealPreferences['CharterGuestMealPreference']['is_breakfast'] == 1) ? 'checked' : '';
            $isBreakfastNo = ($mealPreferences['CharterGuestMealPreference']['is_breakfast'] == 0) ? 'checked' : '';
        }
        if (in_array($mealPreferences['CharterGuestMealPreference']['is_lunch_desert'], array(0,1))) {
            $isLunchDesertYes = ($mealPreferences['CharterGuestMealPreference']['is_lunch_desert'] == 1) ? 'checked' : '';
            $isLunchDesertNo = ($mealPreferences['CharterGuestMealPreference']['is_lunch_desert'] == 0) ? 'checked' : '';
        }
        if (in_array($mealPreferences['CharterGuestMealPreference']['is_dining_ashore'], array(0,1))) {
            $isDiningAshoreYes = ($mealPreferences['CharterGuestMealPreference']['is_dining_ashore'] == 1) ? 'checked' : '';
            $isDiningAshoreNo = ($mealPreferences['CharterGuestMealPreference']['is_dining_ashore'] == 0) ? 'checked' : '';
        }
        if (in_array($mealPreferences['CharterGuestMealPreference']['is_hors_deovres'], array(0,1))) {
            $isDeovresYes = ($mealPreferences['CharterGuestMealPreference']['is_hors_deovres'] == 1) ? 'checked' : '';
            $isDeovresNo = ($mealPreferences['CharterGuestMealPreference']['is_hors_deovres'] == 0) ? 'checked' : '';
        }
        if (in_array($mealPreferences['CharterGuestMealPreference']['is_dinner_desert'], array(0,1))) {
            $isDinnerDesertYes = ($mealPreferences['CharterGuestMealPreference']['is_dinner_desert'] == 1) ? 'checked' : '';
            $isDinnerDesertNo = ($mealPreferences['CharterGuestMealPreference']['is_dinner_desert'] == 0) ? 'checked' : '';
        }
    }

?>
<style>
  .label-comt-12{
  width: 341px;
}
.label-lunch{
width: 284px;
}
.anticipate-label {
  width: 375px;
}
.radio label {
    display: inline-block;
    /* padding-left: 10px; */
    position: relative;
}
input[type="radio"], input[type="checkbox"] {
    position: relative;
    top: -1px;
    left: -1px;
}
.check-box-div{top:3.9px!important;}
.radio label::before {
    -o-transition: 0.3s ease-in-out;
    -webkit-transition: 0.3s ease-in-out;
    border-radius: 50px;
    content: "";
    display: inline-block;
    height: 16px;
   left: -2px;
    top: 3px;
    margin-left: -20px;
    position: absolute;
    transition: 0.3s ease-in-out;
    width: 16px;
    outline: none !important;
}
.radio input[type="radio"] {
    cursor: pointer;
    opacity: 0;
    z-index: 1;
    outline: none !important;
}
.radio input[type="radio"]:checked + label::after {content: '';/* display: block; *//* width: 5px; *//* height: 9px; */border: 4px solid #009af4;border-radius: 50px;/* border-width: 0 2px 2px 0; */transform: rotate(45deg);position: absolute;top: 7px;left: -18px;}

.radio input[type="radio"]:focus + label::before {
    outline-offset: -2px;
    outline: none;
    outline: thin dotted;
}
.radio input[type="radio"]:checked + label::before{
background-color:#fff;
}
	.bf-head{
		width:13%;
	}
	.bf-width{
		width:12%;
	}
	.control-label.ln-lab{
		width:11%;
	}
	.hors-head{
		width: 28%;
	}
	.desrt-head{
		width:11%;
	}
.Cheese-md-row-input{width:32%; 
  margin-left: 5.5%;}

	@media(max-width:1024px){
.bf-head{
  		    width: 140px;
  	}
  		.desrt-head{
  		width:17%;
  	}
  		.hors-head{
  		    width: 315px;
  	}
    .ml40-1024{
    }
    .Cheese-md-row-input{margin-left: 0px;}
	}
@media screen and (max-width: 768px) {

.md-txt-apce{padding-right: 15px!important;}

 .md-unblock-container label{    position: relative;
    top: 10px!important;
    display: block!important;} 
.Cheese-md-row-input{width:49%;display: inline-block;}
.tabport-mlminus9label{position: relative;top:10px;} 
.label-lunch{
width: 100%;
}

.meals-container hr {
    margin-top: 6px;
    margin-bottom: 5px;
}

.meals-container label {
    margin-bottom: 5px;
    padding-left: 4px; 
    display: inline-block!important;
}
.meals-container .two{padding: 0px;}

.md-no-padd{padding-left: 0px;}

		.control-label.ln-lab{
		width:100% !important;text-align: left;    display: inline-block;
    padding-bottom: 10px;
	}
.bf-width{width:25%; float: left;}  
.bf-width .checkbox{float: left;}	
.bf-width .label{width:90%;float: left;}
.bf-head {
    width: 100%;
    display: inline-block;
}
.row-container-checkbox .pdd-none
 {
    padding-left: 0px;
}
.bf-head{padding-left: 0px;}
.row-container-checkbox .md-row-space {
    padding-left: 0px;
}
.meals-other .ml40-1024{width:80%;padding: 0px;}

.row-container-checkbox label{padding: 0px!important;}
.no-spance{position: absolute;display: none;}
label.othr-like{
  width:20%!important;
  text-align: left;
  padding-top: 8px;
	}
.form-group.meals-other {
    display:inline-box;
    width: 100%;
    margin: 16px 10px 0px 0px;
}
.form-control.ipad-input {
    width: 100%;
}
.full-row-container{width:100%;display: inline-block;}

.md-marg-div{margin-bottom: 10px;}

}

@media screen and (max-width: 580px) {
.meals-other .ml40-1024{width:100%!important;}
label.othr-like {width:100%!important;}
}

@media screen and (max-width: 480px) {
.bf-width {
    width: 50%;
    float: left;
}

.tab-md-row-container .clearfix{display: none!important;}

}


/* Ramesh 10/08/2018 */
    /*@media only screen 
    and (min-device-width : 768px) 
    and (max-device-width : 1024px) 
    and (orientation : portrait) { 

      .form-group.frmgrp-mar.meals-other.ipadportohterlink .one label.othr-like {
          width: 20%;
      }

      .form-group.frmgrp-mar.meals-other.ipadportohterlink {
          width: 100%;
      }

      .form-group.frmgrp-mar.meals-other.ipadportohterlink .two {
          width: 46%;
          margin-left: 14px;
      }

      .form-group.frmgrp-mar.meals-other.ipadportohterlink .two input {
          width: 172%;
      }

      .form-group.mar-btm.ipadpro-lunch label {
        width: 16% !important;
      }
      .form-group.mar-btm.ipadpro-lunch .two {
          margin-left: 2px;
          min-width: 70%;
      }
      .ipadport-lastblock-one label {
          width: 45%;
      }
      .ipadport-block-two label {
          width: 35%;
          margin-left: 9.2%;
      }

      .ipadport-block-two .two {
          width: 54%;
      }
      .pdd-none.desrt-head.cheese-inline {
          width: 25%;
      }
      .ipadport-block-three label {
          width: 45%;
      }

    }*/
    /*End Ramesh 10/08/2018 */

</style>
<!-- Meals Preference Tab-->

      <div id="meals" class="tab-pane fade <?php echo $mealPreferenceTab; ?>">
        <?php echo $this->Form->create('CharterGuestMealPreference', array('url' => array('controller' => 'charters','action' => 'preference'),'id'=>'mealPreferenceForm'));     
           echo $this->Form->hidden("CharterGuestMealPreference.id", array('value' => $mealPreferenceRowId));
           
           // When main Head charterer opens other guest(if Head charterer checked) and Update the Preference sheets
           if (isset($charterAssocIdByHeaderEdit)) {
               echo $this->Form->hidden("charterAssocIdByHeaderEdit", array('value' => $charterAssocIdByHeaderEdit));
           }
        ?>
<div class="personal-row-container meals-container mealsdetails-row">
<h1 class="position-mobile-head">Meal Service</h1>
<div class="fixed-row-container"> 
<div class="col-sm-12 md-columnn-mobile-size">
         <div class="form-group frmgrp-mar">
           <label class="control-label col-xs-12 col-sm-6 col-md-4 label-comt-12 " >Would you like a cooked breakfast every day?:</label>
           <div>
           <div class="col-xs-3 col-md-1 col-sm-1 md-no-padd col-md-xs-radiobox">
              <div class="radio" style="margin-top:0px">
              <input type="radio" name="data[CharterGuestMealPreference][is_breakfast]" value="1" <?php echo $isBreakfastYes; ?>>
              <label class="pdd-none"><span>Yes</span></label>               
          </div>
           </div>
           <div class="col-xs-3 col-md-1 col-sm-1 col-md-xs-radiobox">
            <div class="radio" style="margin-top:0px">
            <input type="radio" name="data[CharterGuestMealPreference][is_breakfast]" value="0" <?php echo $isBreakfastNo; ?>>
            <label class="pdd-none"><span class="no-radio-btn">No</span></label>
            </div>
           </div>
       
        </div>
        </div>
<div class="clearfix"></div>
          <div class="form-group frmgrp-mar row-container-checkbox">
			  <div class="col-xs-12 col-sm-2 bf-head">
			  <label class="control-label" >Breakfast Likes:</label>
			  </div>
                <div class="col-sm-2 md-row-space bf-width">
                      <div class="checkbox">
                      <input type="checkbox" class="breakfastchk" name="data[CharterGuestMealPreference][breakfast_likes][]" value="1" <?php echo $breakfastLikesListChecked[1]; ?>>
                       <label class="pdd-none">Egg</label>
                      </div>                    
                </div>
                  <div class="col-sm-2 pdd-none bf-width">
                       <div class="checkbox">
                       <input type="checkbox" class="breakfastchk" name="data[CharterGuestMealPreference][breakfast_likes][]" value="2" <?php echo $breakfastLikesListChecked[2]; ?>>
                       <label class="pdd-none">Sausage</label>
                      </div>
                  </div>
                  <div class="col-sm-2 pdd-none bf-width">
                     <div class="checkbox">
                     <input type="checkbox"  class="breakfastchk" name="data[CharterGuestMealPreference][breakfast_likes][]" value="3" <?php echo $breakfastLikesListChecked[3]; ?>>
                     <label class="pdd-none">Pancakes</label>
                   </div>
                  </div>
                  <div class="col-sm-2 pdd-none bf-width">
                     <div class="checkbox">
                     <input type="checkbox"  class="breakfastchk" name="data[CharterGuestMealPreference][breakfast_likes][]" value="8" <?php echo $breakfastLikesListChecked[8]; ?>>
                     <label class="pdd-none">Bagels</label>
                   </div>
                  </div>
                  
                  <div class="col-sm-2 pdd-none bf-width">
                     <div class="checkbox">
                     <input type="checkbox"  class="breakfastchk" name="data[CharterGuestMealPreference][breakfast_likes][]" value="5" <?php echo $breakfastLikesListChecked[5]; ?>>
                     <label class="pdd-none">Cold Cereals</label>
                   </div>
                  </div>
          </div>
<div class="clearfix"></div>
          <div class="form-group frmgrp-mar row-container-checkbox row-md-8">
             <div class="col-sm-2 bf-head no-spance"></div>
                <div class="col-sm-2 md-row-space bf-width">
                      <div class="checkbox">
                      <input type="checkbox"  class="breakfastchk" name="data[CharterGuestMealPreference][breakfast_likes][]" value="6" <?php echo $breakfastLikesListChecked[6]; ?>>
                       <label  class="pdd-none">Bacon</label>
                      </div>                     
                </div>
                  <div class="col-sm-2 pdd-none bf-width">
                       <div class="checkbox">
                       <input type="checkbox"  class="breakfastchk" name="data[CharterGuestMealPreference][breakfast_likes][]" value="7" <?php echo $breakfastLikesListChecked[7]; ?>>
                       <label class="pdd-none">Fruits</label>
                      </div>
                  </div>
                  <div class="col-sm-2 pdd-none bf-width">
                     <div class="checkbox">
                     <input type="checkbox"  class="breakfastchk" name="data[CharterGuestMealPreference][breakfast_likes][]" value="4" <?php echo $breakfastLikesListChecked[4]; ?>>
                     <label class="pdd-none">Hot Cereals</label>
                   </div>
                  </div>
                  <div class="col-sm-2 pdd-none bf-width">
                     <div class="checkbox">
                     <input type="checkbox"  class="breakfastchk" name="data[CharterGuestMealPreference][breakfast_likes][]" value="9" <?php echo $breakfastLikesListChecked[9]; ?>>
                     <label class="pdd-none">Pastries</label>
                   </div>
                  </div>
                  <div class="col-sm-2 pdd-none bf-width">
                     <div class="checkbox">
                     <input type="checkbox"  class="breakfastchk" name="data[CharterGuestMealPreference][breakfast_likes][]" value="10" <?php echo $breakfastLikesListChecked[10]; ?>>
                     <label class="pdd-none">Danish</label>
                   </div>
                  </div>
          </div>
   <div class="clearfix"></div>
             <div class="form-group frmgrp-mar row-container-checkbox row-md-8">
             <div class="col-sm-2 bf-head no-spance"></div>
                <div class="col-sm-2 md-row-space bf-width">
                      <div class="checkbox">
                      <input type="checkbox"  class="breakfastchk" name="data[CharterGuestMealPreference][breakfast_likes][]" value="11" <?php echo $breakfastLikesListChecked[11]; ?>>
                       <label class="pdd-none">Ham</label>
                      </div>                    
                </div>
                  <div class="col-sm-2 pdd-none bf-width">
                       <div class="checkbox">
                       <input type="checkbox"  class="breakfastchk" name="data[CharterGuestMealPreference][breakfast_likes][]" value="12" <?php echo $breakfastLikesListChecked[12]; ?>>
                       <label class="pdd-none">Omelettes</label>
                      </div>
                  </div>
                  <div class="col-sm-2 pdd-none bf-width">
                     <div class="checkbox">
                     <input type="checkbox"  class="breakfastchk" name="data[CharterGuestMealPreference][breakfast_likes][]" value="13" <?php echo $breakfastLikesListChecked[13]; ?>>
                     <label class="pdd-none">Coffee/Tea</label>
                   </div>
                  </div>
                  <div class="col-sm-2 pdd-none bf-width">
                     <div class="checkbox">
                     <input type="checkbox"  class="breakfastchk" name="data[CharterGuestMealPreference][breakfast_likes][]" value="14" <?php echo $breakfastLikesListChecked[14]; ?>>
                     <label class="pdd-none">Juice</label>
                   </div>
                  </div>
                  <div class="col-sm-2 pdd-none bf-width">
                     <div class="checkbox">
                     <input type="checkbox"  class="breakfastchk" name="data[CharterGuestMealPreference][breakfast_likes][]" value="15" <?php echo $breakfastLikesListChecked[15]; ?>>
                     <label class="pdd-none">Milk</label>
                   </div>
                  </div>
          </div>
               <input type="hidden" name="data[CharterGuestMealPreference][breakfast_likes_hidden][]" id="breakfast_likes_hidden" value="" />
<div class="clearfix"></div>
          <div class="form-group frmgrp-mar meals-other ipadportohterlink" >
			  <div class="one">
            <label class="col-xs-4 control-label label-comments-space othr-like text-right col-sm-2" style="padding-right: 15px;">Other Likes:</label>
				  </div>
                    <div class="col-xs-8 col-sm-9 col-md-7 pdd-lt-none ml40-1024 two">
						
                    <!--<input type="text" class="form-control ipad-input" name="data[CharterGuestMealPreference][other_breakfast_likes]">-->
                    <?php echo $this->Form->input("other_breakfast_likes",array("label"=>false,'class'=>'form-control ipad-input','type' => 'text')); ?>
                  </div>
                   <div class="col-sm-12"></div>
        </div>
<div class="clearfix"></div>
<hr class="divider" />
        <div class="form-group mar-btm ipadpro-lunch">
          <label class="control-label col-sm-1 mar-btm ln-lab text-right" >Lunch:</label>

          <div class="col-sm-10 two">
            <div class="col-sm-2 pdd-none bf-width">
                      <div class="checkbox">
                      <input type="checkbox" class="lunchtypechk" name="data[CharterGuestMealPreference][lunch_type][]" value="1" <?php echo $lunchTypeListChecked[1]; ?>>
                       <label class="pdd-none">Hot</label>
                      </div>                    
            </div>
                  <div class="col-sm-2 pdd-none bf-width">
                       <div class="checkbox">
                       <input type="checkbox"class="lunchtypechk" name="data[CharterGuestMealPreference][lunch_type][]" value="2" <?php echo $lunchTypeListChecked[2]; ?>>
                       <label class="pdd-none">Cold</label>
                      </div> 
                  </div>
                  <div class="col-sm-2 pdd-none bf-width">
                     <div class="checkbox">
                     <input type="checkbox"class="lunchtypechk" name="data[CharterGuestMealPreference][lunch_type][]" value="3" <?php echo $lunchTypeListChecked[3]; ?>>
                     <label class="pdd-none">Hearty</label>
                   </div>
                  </div>
                  <div class="col-sm-2 pdd-none bf-width">
                     <div class="checkbox">
                     <input type="checkbox"class="lunchtypechk" name="data[CharterGuestMealPreference][lunch_type][]" value="4" <?php echo $lunchTypeListChecked[4]; ?>>
                     <label class="pdd-none">Healthy</label>
                   </div>
                  </div>
          </div>
        </div>
        <input type="hidden" name="data[CharterGuestMealPreference][lunch_type_hidden][]" id="lunch_type_hidden" value="" />

			<div class="clearfix"></div>
			
			  <div class="form-group frmgrp-mar">
          <label class="control-label col-sm-2 mar-btm ln-lab text-right" >Lunch Style:</label>
          <div class="col-xs-12 col-sm-10 md-no-padd">
            <div class="col-xs-7 col-sm-4 col-md-3  pdd-none">
                      <div class="checkbox">
                      <input type="checkbox" class="lunchstylechk" name="data[CharterGuestMealPreference][lunch_style][]" value="1" <?php echo $lunchStyleListChecked[1]; ?>>
                       <label class="pdd-none">Family style buffet</label>
                      </div>                    
            </div>
 
                  <div class="col-xs-5 -sm-3 col-md-3 pdd-none">
                     <div class="checkbox">
                     <input type="checkbox" class="lunchstylechk" name="data[CharterGuestMealPreference][lunch_style][]" value="4" <?php echo $lunchStyleListChecked[4]; ?>>
                     <label class="pdd-none">Substantial</label>
                   </div>
                  </div>
                                   <div class="col-xs-7 col-sm-4 col-md-3 pdd-none">
                       <div class="checkbox">
                       <input type="checkbox" class="lunchstylechk" name="data[CharterGuestMealPreference][lunch_style][]" value="2" <?php echo $lunchStyleListChecked[2]; ?>>
                       <label class="pdd-none">Formal Plate Lunch</label>
                      </div>
                  </div>
			      <div class="col-xs-5 col-sm-1 col-md-3 pdd-none">
                     <div class="checkbox">
                     <input type="checkbox" class="lunchstylechk" name="data[CharterGuestMealPreference][lunch_style][]" value="3" <?php echo $lunchStyleListChecked[3]; ?>>
                     <label class="pdd-none">Light</label>
                   </div>
                  </div>
          </div>
        </div>
        <input type="hidden" name="data[CharterGuestMealPreference][lunch_style_hidden][]" id="lunch_style_hidden" value="" />
			<div class="clearfix"></div>
       <div class="form-group frmgrp-mar full-row-container">
          <div class="col-xs-12 col-sm-12  md-no-padd">
             <label class="col-xs-12 control-label col-sm-5 col-md-4 col-lg-3 mar-btm pdd-none label-lunch" >Do you enjoy desert served after lunch?</label>
             <div class="col-xs-3 col-md-1 col-sm-1  md-no-padd col-md-xs-radiobox">
             <div class="radio">
              <input type="radio" name="data[CharterGuestMealPreference][is_lunch_desert]" value="1" <?php echo $isLunchDesertYes; ?>>
                <label class="pdd-none"><span>Yes</span></label>
             </div>
             </div>
             <div class="col-xs-3 col-md-1 col-sm-1 col-md-xs-radiobox">
             <div class="radio">
             <input type="radio" name="data[CharterGuestMealPreference][is_lunch_desert]" value="0" <?php echo $isLunchDesertNo; ?>>
             <label class="pdd-none"><span class="no-radio-btn">No</span></label>
             </div>
             </div>
  
          </div>
        </div>
     <div class="clearfix"></div>	
     <hr class="divider"/>
          <div class="form-group frmgrp-mar" style="overflow: auto;">
        <label class="col-sm-4  mar-btm">Dining Ashore</label>
        <div class="col-sm-12"></div>
          <label class="col-xs-12 control-label col-sm-7 col-md-5 col-lg-4 mar-btm anticipate-label" >Do you anticipate  dining ashore during the cruise?
            <br class="br-label">(Meals ashore are not included in the charter fee)</label>
          <div class=" ">
          <div class="">
            
          </div>
            <div class=" pdd-none">
            <div class="col-xs-3 col-md-1 col-sm-1  md-no-padd col-md-xs-radiobox">
              <div class="radio">
              <input type="radio" name="data[CharterGuestMealPreference][is_dining_ashore]" value="1" <?php echo $isDiningAshoreYes; ?>>
               <label class="pdd-none"><span>Yes</span></label>
              </div>
            </div>
            <div class="col-xs-3 col-md-1 col-sm-1 col-md-xs-radiobox">
                  <div class="radio">
              <input type="radio" name="data[CharterGuestMealPreference][is_dining_ashore]" value="0" <?php echo $isDiningAshoreNo; ?>>
                  <label class="pdd-none"><span class="no-radio-btn">No</span></label>
              </div> 
            </div>
                           
            </div>
          </div>
        </div>

         <div class="form-group frmgrp-mar">
           <div class="col-sm-12 pdd-none">
          <label class="control-label br-label col-xs-12 col-sm-4 col-md-3 pdd-rt-none md-w-label-full" >Would you like lunch/dinner<br> reservations at any special<br> restaurant ashore? 
            </label>
            <div class="col-sm-12 col-md-8 pdd-none">
             <div class="col-xs-12 col-md-4 col-sm-7 pdd-none md-marg-div">
              <!--<input type="text" class="form-control" name="data[CharterGuestMealPreference][restaurant1]" placeholder="Restaurant Name and Town">-->
              <?php echo $this->Form->input("restaurant1",array("label"=>false,'class'=>'form-control','type' => 'text', 'placeholder' => 'Restaurant Name and Town')); ?>
              </div> 
                <div class="col-xs-6 col-md-3 col-sm-3 md-marg-div md-no-padd">
              <!--<input ttype="text" class="form-control datePicker" name="data[CharterGuestMealPreference][restaurant_date1]" placeholder="Select Date">-->
              <?php echo $this->Form->input("restaurant_date1",array("label"=>false,'class'=>'form-control datePicker','type' => 'text', 'placeholder' => 'Select Date')); ?>
              </div>   
               <div class="col-xs-6 col-md-2 col-sm-2 pdd-none md-marg-div md-no-padd">
              <!--<input ttype="text" class="form-control" name="data[CharterGuestMealPreference][restaurant_time1]" placeholder="Time">-->
              <?php echo $this->Form->input("restaurant_time1",array("label"=>false,'class'=>'form-control timePicker','type' => 'text', 'placeholder' => 'Time')); ?>
              </div>  <br><br>
                 <div class="col-xs-12 col-md-4 col-sm-7 pdd-none md-marg-div">
              <!--<input type="text" class="form-control" name="data[CharterGuestMealPreference][restaurant2]"  placeholder="Restaurant Name and Town">-->
              <?php echo $this->Form->input("restaurant2",array("label"=>false,'class'=>'form-control','type' => 'text', 'placeholder' => 'Restaurant Name and Town')); ?>
              </div> 
                <div class="col-xs-6 col-md-3 col-sm-3 md-marg-div md-no-padd">
              <!--<input ttype="text" class="form-control datePicker" name="data[CharterGuestMealPreference][restaurant_date2]" placeholder="Select Date">-->
              <?php echo $this->Form->input("restaurant_date2",array("label"=>false,'class'=>'form-control datePicker','type' => 'text', 'placeholder' => 'Select Date')); ?>
              </div>   
              <div class="col-xs-6 col-md-2 col-sm-2 pdd-none md-marg-div md-no-padd">
              <!--<input ttype="text" class="form-control" name="data[CharterGuestMealPreference][restaurant_time2]" placeholder="Time">-->
              <?php echo $this->Form->input("restaurant_time2",array("label"=>false,'class'=>'form-control timePicker','type' => 'text', 'placeholder' => 'Time')); ?>
              </div> <br><br>
              <div class="col-xs-12 col-md-4 col-sm-7 pdd-none md-marg-div">
              <!--<input type="text" class="form-control" name="data[CharterGuestMealPreference][restaurant3]"  placeholder="Restaurant Name and Town">-->
              <?php echo $this->Form->input("restaurant3",array("label"=>false,'class'=>'form-control','type' => 'text', 'placeholder' => 'Restaurant Name and Town')); ?>
              </div> 
                <div class="col-xs-6 col-md-3 col-sm-3 md-marg-div md-no-padd">
              <!--<input ttype="text" class="form-control datePicker" name="data[CharterGuestMealPreference][restaurant_date3]" placeholder="Select Date">-->
              <?php echo $this->Form->input("restaurant_date3",array("label"=>false,'class'=>'form-control datePicker','type' => 'text', 'placeholder' => 'Select Date')); ?>
              </div>   
              <div class="col-xs-6 col-md-2 col-sm-2 pdd-none md-marg-div md-no-padd"> 
              <!--<input ttype="text" class="form-control" name="data[CharterGuestMealPreference][restaurant_time3]" placeholder="Time">-->
              <?php echo $this->Form->input("restaurant_time3",array("label"=>false,'class'=>'form-control timePicker','type' => 'text', 'placeholder' => 'Time')); ?>
              </div> 
            </div>
           </div>
          </div>

<div class="clearfix"></div>
<hr class="divider"/>

       <div class="form-group frmgrp-mar">
                <label class="col-sm-4 col-md-3  mar-btm">Hors d'eovres</label>
        <div class="col-sm-12"></div>
          <div class="col-sm-12 ipadport-lastblock-one  md-no-padd">
             <label class="control-label col-xs-12 col-sm-5 col-md-3 mar-btm pdd-none hors-head md-txt-apce do-you-enjpy" >Do you enjoy hors d'eovres before dinner?</label>
             <div class="col-xs-3 col-md-1 col-sm-1  md-no-padd col-md-xs-radiobox xs-radio-mrg">
                   <div class="radio">
                   <input type="radio" name="data[CharterGuestMealPreference][is_hors_deovres]" value="1" <?php echo $isDeovresYes; ?>>
                  <label class="pdd-none"><span>Yes</span></label>
             
              </div>  
             </div>
             <div class="col-xs-3 col-md-1 col-sm-1 col-md-xs-radiobox xs-radio-mrg">
              <div class="radio">
              <input type="radio" name="data[CharterGuestMealPreference][is_hors_deovres]" value="0" <?php echo $isDeovresNo; ?>>
              <label class="pdd-none"><span class="no-radio-btn">No</span></label>
              </div>
             </div>
           
          </div>
        </div>


        <div class="form-group frmgrp-mar full-row-container">
          <div class="col-sm-12 ipadport-block-two  md-no-padd">

             <label class="control-label col-xs-12  col-sm-3 mar-btm pdd-none" >Please indicate your Preference:</label>

          <div class="col-xs-12 col-sm-9 two">
            <div class="col-xs-6 col-sm-3 col-md-2 pdd-none">
              <div class="checkbox">
              <input type="checkbox" class="deovreschk" name="data[CharterGuestMealPreference][deovres_preference][]" value="1" <?php echo $deovresListChecked[1]; ?>>
               <label class="pdd-none">Caviar</label>
              </div>                    
            </div>
            <div class="col-xs-6 col-sm-3 col-md-2 pdd-none">
                 <div class="checkbox">
                 <input type="checkbox" class="deovreschk" name="data[CharterGuestMealPreference][deovres_preference][]" value="2" <?php echo $deovresListChecked[2]; ?>>
                 <label class="pdd-none">Canapes</label>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-2 pdd-none">
                   <div class="checkbox">
                   <input type="checkbox" class="deovreschk" name="data[CharterGuestMealPreference][deovres_preference][]" value="3" <?php echo $deovresListChecked[3]; ?>>
                   <label class="pdd-none">Crudites</label>
                  </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-2 pdd-none">
              <div class="checkbox">
              <input type="checkbox" class="deovreschk" name="data[CharterGuestMealPreference][deovres_preference][]" value="4" <?php echo $deovresListChecked[4]; ?>>
               <label class="pdd-none">Sushi</label>
              </div>                    
            </div>
			  <div class="clearfix"></div>
        <div class="full-row-container">
            <div class=" col-xs-4 col-sm-2 pdd-none desrt-head cheese-inline">
                 <div class="checkbox">
                 <input type="checkbox" class="deovreschk" name="data[CharterGuestMealPreference][deovres_preference][]" value="5" <?php echo $deovresListChecked[5]; ?>>
                 <label class="pdd-none">Cheese</label>
                </div>
            </div>
          <div class="col-xs-8 col-sm-9 col-md-6 pdd-none Cheese-md-row-input">
                  <!--<input ttype="text" class="form-control" name="data[CharterGuestMealPreference][deovres_comments]" placeholder="Specific Brands">-->
                  <?php echo $this->Form->input("deovres_comments",array("label"=>false,'class'=>'form-control','type' => 'text', 'placeholder' => 'Specific Brands')); ?>
            </div> </div>
            <input type="hidden" name="data[CharterGuestMealPreference][deovres_preference_hidden][]" id="deovres_preference_hidden" value="" />
          </div>
          </div>
        </div>

        <div class="form-group frmgrp-mar ">
          <div class="col-xs-12 col-sm-12 ipadport-block-three  md-no-padd">
             <label class="control-label col-sm-3 mar-btm pdd-none hors-head md-txt-apce doy-enjoy" >Do you enjoy coffee and desert after dinner?</label>
          
                       <div class="col-xs-3 col-md-1 col-sm-1  md-no-padd col-md-xs-radiobox xs-radio-mrg">
                   <div class="radio">
                  <input type="radio" name="data[CharterGuestMealPreference][is_dinner_desert]" value="1" <?php echo $isDinnerDesertYes; ?>>
                  <label class="pdd-none"><span>Yes</span></label>
             
              </div>  
             </div>
             <div class="col-xs-3 col-md-1 col-sm-1 col-md-xs-radiobox xs-radio-mrg">
              <div class="radio">
             <input type="radio" name="data[CharterGuestMealPreference][is_dinner_desert]" value="0" <?php echo $isDinnerDesertNo; ?>>
              <label class="pdd-none"><span class="no-radio-btn">No</span></label>
              </div>
             </div>


         
          </div>
          </div>
         
            <div class="form-group frmgrp-mar marg-footert">    
                  <div class="space-50-h"></div>       
                    <div class="text-center  footer-mob-row-inner">
                        <?php if (!isset($charterAssocIdByHeaderView)) { ?>
                            <?php echo $this->Form->submit("Save and Continue", array('class' => 'btn btn-success'));?>
                        <?php } ?>
                    </div>
            </div>
        </div>
            <?php echo $this->Form->end(); ?>
            </div>
</div></div>


<script>
//deovres checkbox selected and unselected
    $(".deovreschk").click(function () {
        var de=0;
        var deo=[]; 
            $(".deovreschk").each(function () {
                if($(this).is(':checked')) {
                  deo[de++] = $(this).val();
              }else{
                  deo[de++] = "unchecked";
              }
            });
            //console.log(cbox);
            $("#deovres_preference_hidden").val(deo);
              de = 0;
               
     });
     

     //lunch_style checkbox selected and unselected
    $(".lunchstylechk").click(function () {
        var lus=0;
        var lunchstyle=[]; 
            $(".lunchstylechk").each(function () {
                if($(this).is(':checked')) {
                  lunchstyle[lus++] = $(this).val();
              }else{
                  lunchstyle[lus++] = "unchecked";
              }
            });
            //console.log(cbox);
            $("#lunch_style_hidden").val(lunchstyle);
              lus = 0;
               
     });

     //lunch_type checkbox selected and unselected
    $(".lunchtypechk").click(function () {
        var lutype=0;
        var lunchtypeval=[]; 
            $(".lunchtypechk").each(function () {
                if($(this).is(':checked')) {
                  lunchtypeval[lutype++] = $(this).val();
              }else{
                  lunchtypeval[lutype++] = "unchecked";
              }
            });
            //console.log(cbox);
            $("#lunch_type_hidden").val(lunchtypeval);
              lutype = 0;
               
     });

     //breakfastchk checkbox selected and unselected
    $(".breakfastchk").click(function () {
        var bf=0;
        var breakfast=[]; 
            $(".breakfastchk").each(function () {
                if($(this).is(':checked')) {
                  breakfast[bf++] = $(this).val();
              }else{
                  breakfast[bf++] = "unchecked";
              }
            });
            //console.log(cbox);
            $("#breakfast_likes_hidden").val(breakfast);
              bf = 0;
               
     });
</script>
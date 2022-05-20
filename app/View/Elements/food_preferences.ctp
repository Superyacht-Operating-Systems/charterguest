<?php

// Food Preferences
    $foodList = array(
        1 => 'Soups',
        2 => 'Beef',
        3 => 'Lamb',
        4 => 'Veal',
        5 => 'Venison',
        6 => 'Ostrich',
        7 => 'Caribou',
        8 => 'Buffalo',
        9 => 'Pork',
        10 => 'Chiken',
        11 => 'Duck',
        12 => 'Quail',
        13 => 'Pigeon',
        14 => 'Salads',
        15 => 'Vegitables',
        16 => 'Vegitarian cuisine',
        17 => 'Pasta Rice',
        18 => 'Mussels',
        19 => 'Fish:Black cod',
        20 => 'Halibut',
        21 => 'Rockfish',
        22 => 'Salmon',
        23 => 'Sole',
        24 => 'Tuna',
        25 => 'Shellfish: Crab',
        26 => 'King Crab',
        27 => 'Lobster',
        28 => 'Prawns',
        29 => 'Scallops',
        30 => 'Caviar',
        31 => 'Foie gras',
        32 => "Hors d'oevres",
        33 => 'Desserts',
        34 => "Childern's menus"
    );
    $foodOpinion = array(
        1 => 'Love',
        2 => 'Like',
        3 => 'Dislike'
    );
    $foodLove = array();
    // Generate the empty assoc array - 34 items
    for ($i = 1; $i <= 34; $i++) {
        $foodLove[$i] = '';
    }
    $foodLike = $foodDislike = $foodLove;
    
    
    // Service style
    $serviceStyle = array(
        1 => 'Plated',
        2 => 'Buffet',
        3 => 'Silver Service'
    );
    
    // Cooking preferences
    $cookPreference = array(
        1 => 'Rare',
        2 => 'Med Rare',
        3 => 'Med',
        4 => 'Med Well',
        5 => 'Well',
        //6 => 'Dislike'
    );
    
    // Dislikes list
    $dislikesList = array(
        1 => 'Capers',
        2 => 'Raw Onions',
        3 => 'Cooked Onions',
        4 => 'Beets',
        5 => 'Olives',
        6 => 'Caviar',
        7 => 'Tomato',
        8 => 'Tomato Sauce',
        9 => 'Hot Spice',
        10 => 'Peppers'
    );
    $dislikesListChecked = array();
    for ($i = 1; $i <= 10; $i++) {
        $dislikesListChecked[$i] = '';
    }
    
    // Food style
    $foodStyle = array(
        1 => 'Italian',
        2 => 'Russian',
        3 => 'Asian Fusion',
        4 => 'Gluten Free',
        5 => 'Vegitarian',
        6 => 'Greek',
        7 => 'French',
        8 => 'American',
        9 => 'Mediterranean',
        10 => 'Spanish',
        11 => 'Indian',
        12 => 'Thai'
    );
    $foodStyleChecked = array();
    for ($i = 1; $i <= 12; $i++) {
        $foodStyleChecked[$i] = '';
    }
    
     
    $foodPreferenceRowId = '';
    if (isset($foodPreferences) && !empty($foodPreferences)) {
        // Existing row id
        if (!empty($foodPreferences['CharterGuestFoodPreference']['id'])) {
            $foodPreferenceRowId = $foodPreferences['CharterGuestFoodPreference']['id'];
        }
        // Food - Love
        if (!empty($foodPreferences['CharterGuestFoodPreference']['food_love'])) {
            $existFoodLoves = explode(",", $foodPreferences['CharterGuestFoodPreference']['food_love']);
            foreach ($existFoodLoves as $item) {
                $foodLove[$item] = "checked";
            }
        }
        // Food - Like
        if (!empty($foodPreferences['CharterGuestFoodPreference']['food_like'])) {
            $existFoodLikes = explode(",", $foodPreferences['CharterGuestFoodPreference']['food_like']);
            foreach ($existFoodLikes as $item) {
                $foodLike[$item] = "checked";
            }
        }
        // Food - Dislike
        if (!empty($foodPreferences['CharterGuestFoodPreference']['food_dislike'])) {
            $existFoodDislikes = explode(",", $foodPreferences['CharterGuestFoodPreference']['food_dislike']);
            foreach ($existFoodDislikes as $item) {
                $foodDislike[$item] = "checked";
            }
        }
        // Food styles
        if (!empty($foodPreferences['CharterGuestFoodPreference']['food_style'])) {
            $existFoodStyles = explode(",", $foodPreferences['CharterGuestFoodPreference']['food_style']);
            foreach ($existFoodStyles as $item) {
                $foodStyleChecked[$item] = "checked";
            }
        }
        // Dislikes
        if (!empty($foodPreferences['CharterGuestFoodPreference']['dislikes'])) {
            $existDislikes = explode(",", $foodPreferences['CharterGuestFoodPreference']['dislikes']);
            foreach ($existDislikes as $item) {
                $dislikesListChecked[$item] = "checked";
            }
        }
    }
    

?>
<style>
.foodpreferences-container .radio input[type="radio"] {
width: 110px!important;
    margin-left: -22px;
    top: -1px;
    height: 30px!important;
}


  
.table-container-row td:first-child{ 
  width: 25%;
  text-align: right;
   margin-top: 13px;}
.table-bordered{background: #fff;}
.foodpreferences-container table.table tbody tr{border-bottom: solid 1px #eee;    width: 100%;
    display: inline-flex;}
table.table tbody th{border:none;}    
table.table tbody td{border:none;}
hr.divmar{
  margin-top:30px;
  margin-bottom:30px;
}
table.fd-table tr>td {
    padding: 4px 0px 0px 0px!important;
    border-right: none;
    border-left: 0;
}
table.fd-table tr>th {
  
    border-right: none;
    border-left: 0;
}
.radio input[type="radio"] {
    width: 15px;
    height: 15px;
    top: -2px;
}

  table td.fd-cent{
    vertical-align: middle !important;
  }
  
  
  @media (max-width: 1024px){
.comt-like-row{text-align: right;}
    .fs-wd{
      width:13.2%
    }
   .fs-wd.ipad-fs-wd{
      width:16%;
    }
    .cp-width{
      width:12.5% !important;
    }
    .Comments-1024 {
/*      margin-left: 59px;*/
      width: 70%;
    }
  }
  @media (max-width: 768px){
    .foodpreferences-row .label-comments-space{
  width: 20%;float: left;
}
.Comments-1024 {
    width: 60%;
    float: left;
}
    .fs-wd {
    width: 50%;float: left;
}
    .fs-wd.ipad-fs-wd{
      width: 50%;float: left;
    }
    .cp-width{
      width:14% !important;
    }

      .Comments-1024 {
      margin-left: 0px;
      width: 80%;
    }


  }
  @media (min-width: 992px){
.fs-wd{
    width:13.2%
  }
    .cp-head{
      width:8%
    }
    .cp-width{
      width:11.5%;
    }
  }


@media screen and (max-width: 768px) {
table.fd-table tr>td {
    padding: 4px 7px 0px!important;
}
.table-container-row td:first-child {
    text-align: left;
}
}
@media screen and (max-width: 767px) {
.comt-like-row {
    text-align: left;
}
label.txt-right {
    text-align: left;
}

      .Comments-1024 {
      margin-left: 0px;
      width: 100%;
    }
}

@media only screen and (max-width: 380px){
.radio {margin-top: 0px!important;}

}




  /*End Ramesh 10/08/2018 */
</style>
<!-- food preference -->
<div id="food" class="tab-pane fade <?php echo $foodPreferenceTab; ?>">
    <?php echo $this->Form->create('CharterGuestFoodPreference', array('url' => array('controller' => 'charters','action' => 'preference'),'id'=>'foodPreferenceForm'));     
           echo $this->Form->hidden("CharterGuestFoodPreference.id", array('value' => $foodPreferenceRowId));
           
           // When main Head charterer opens other guest(if Head charterer checked) and Update the Preference sheets
           if (isset($charterAssocIdByHeaderEdit)) {
               echo $this->Form->hidden("charterAssocIdByHeaderEdit", array('value' => $charterAssocIdByHeaderEdit));
           }
        ?>

<div class="personal-row-container foodpreferences-container">
<h1 class="position-mobile-head">Food</h1>
<div class="fixed-row-container"> 
        <div class="col-md-12 foodpreferences-row">
      <div class="form-group frmgrp-mar">
        <div class="col-md-12 md-col-nospace">
          <label>Meal Time Preferences and Service style</label>
        </div>
        <div class="col-lg-12 pdd-none full-column-marg">
          <div class="col-lg-1 col-sm-2 ipadport-middle"><label class="control-label ma-b">Breakfast</label></div>
          <div class="col-lg-1 col-sm-2 pdd-none f-timewidth" >
            
            <label class="control-label ma-b">Time</label>
          </div>
          <div class="col-lg-2 col-sm-2 ipadport-input-padding-vertical input-mobile-width">
            <!--<input type="text" class="form-control input-wid">-->
            <?php echo $this->Form->input("breakfast_time",array("label"=>false,'class'=>'form-control input-wid timePicker','type' => 'text')); ?>
          </div>
          <div class="col-lg-2 col-sm-2 md-radio-column-box">
            <div class="radio ma-t-check">
            <input type="radio" name="data[CharterGuestFoodPreference][breakfast_service_style]" value="1" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['breakfast_service_style']) && $foodPreferences['CharterGuestFoodPreference']['breakfast_service_style'] == 1) ? 'checked' : ''; ?>>
                <label class="pdd-none"><span>Plated</span></label>
            </div>
          </div>
          <div class="col-lg-2 col-sm-2 md-radio-column-box">
            <div class="radio ma-t-check">
            <input type="radio" name="data[CharterGuestFoodPreference][breakfast_service_style]" value="2" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['breakfast_service_style']) && $foodPreferences['CharterGuestFoodPreference']['breakfast_service_style'] == 2) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Buffet</span></label>
            </div>
          </div>
          <div class="col-lg-3 col-sm-3 md-radio-column-box-max">
            <div class="radio ma-t-check">
            <input type="radio" name="data[CharterGuestFoodPreference][breakfast_service_style]" value="3" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['breakfast_service_style']) && $foodPreferences['CharterGuestFoodPreference']['breakfast_service_style'] == 3) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Sliver Service</span></label>
            </div>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-lg-12 pdd-none full-column-marg">
          <div class="col-lg-1 col-sm-2 ipadport-middle"><label class="control-label ma-b">Lunch</label></div>
          <div class="col-lg-1 col-sm-2 pdd-none f-timewidth" >
            
            <label class="control-label ma-b">Time</label>
          </div>
          <div class="col-lg-2 col-sm-2 ipadport-input-padding-vertical input-mobile-width">
            <!--<input type="text" class="form-control input-wid">-->
            <?php echo $this->Form->input("lunch_time",array("label"=>false,'class'=>'form-control input-wid timePicker','type' => 'text')); ?>
          </div>
          <div class="col-lg-2 col-sm-2 md-radio-column-box">
            <div class="radio ma-t-check">
            <input type="radio" name="data[CharterGuestFoodPreference][lunch_service_style]" value="1" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['lunch_service_style']) && $foodPreferences['CharterGuestFoodPreference']['lunch_service_style'] == 1) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Plated</span></label>
            </div>
          </div>
          <div class="col-lg-2 col-sm-2 md-radio-column-box">
            <div class="radio ma-t-check">
            <input type="radio" name="data[CharterGuestFoodPreference][lunch_service_style]" value="2" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['lunch_service_style']) && $foodPreferences['CharterGuestFoodPreference']['lunch_service_style'] == 2) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Buffet</span></label>
            </div>
          </div>
          <div class="col-lg-3 col-sm-3 md-radio-column-box-max">
            <div class="radio ma-t-check">
            <input type="radio" name="data[CharterGuestFoodPreference][lunch_service_style]" value="3" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['lunch_service_style']) && $foodPreferences['CharterGuestFoodPreference']['lunch_service_style'] == 3) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Sliver Service</span></label>
            </div>
          </div>
        </div>

        <div class="clearfix"></div>

         <div class="col-lg-12 pdd-none full-column-marg">
          <div class="col-lg-1 col-sm-2 ipadport-middle"><label class="control-label ma-b">Dinner</label></div>
          <div class="col-lg-1 col-sm-2 pdd-none f-timewidth" >
            
            <label class="control-label ma-b">Time</label>
          </div>
          <div class="col-lg-2 col-sm-2 ipadport-input-padding-vertical input-mobile-width">
            <!--<input type="text" class="form-control input-wid">-->
            <?php echo $this->Form->input("dinner_time",array("label"=>false,'class'=>'form-control input-wid timePicker','type' => 'text')); ?>
          </div>
          <div class="col-lg-2 col-sm-2 md-radio-column-box">
            <div class="radio ma-t-check">
            <input type="radio" name="data[CharterGuestFoodPreference][dinner_service_style]" value="1" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['dinner_service_style']) && $foodPreferences['CharterGuestFoodPreference']['dinner_service_style'] == 1) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Plated</span></label>
            </div>
          </div>
          <div class="col-lg-2 col-sm-2 md-radio-column-box">
            <div class="radio ma-t-check">
            <input type="radio" name="data[CharterGuestFoodPreference][dinner_service_style]" value="2" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['dinner_service_style']) && $foodPreferences['CharterGuestFoodPreference']['dinner_service_style'] == 2) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Buffet</span></label>
            </div>
          </div>
          <div class="col-lg-3 col-sm-3 md-radio-column-box-max">
            <div class="radio ma-t-check">
            <input type="radio" name="data[CharterGuestFoodPreference][dinner_service_style]" value="3" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['dinner_service_style']) && $foodPreferences['CharterGuestFoodPreference']['dinner_service_style'] == 3) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Sliver Service</span></label>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>

        <div class="row ipadport-comments">
          <div class="col-md-1 col-sm-2">
          <label class="control-label label-comments-space">Comments</label>
        </div>
        <div class="col-md-8 col-sm-9 Comments-1024">
          <!--<input type="text" class="form-control">-->
          <?php echo $this->Form->input("meal_time_service_comments",array("label"=>false,'class'=>'form-control','type' => 'text')); ?>
        </div>
        </div>
      </div>
<div class="clearfix"></div>
<hr class="divider divmar">
      <!--<div class="space-50-h"></div>-->

      <div class="form-group frmgrp-mar dietary-requirements-row">
        <div class="col-md-12 md-col-nospace">
          <label>Food Style Preference</label>
        </div>
        <div class="col-lg-12 pdd-none">
          <div class="col-md-2 col-sm-2  fs-wd">
              <div class="checkbox">
              <input type="checkbox" class="foodstylechk" name="data[CharterGuestFoodPreference][food_style][]" value="1" <?php echo $foodStyleChecked[1]; ?>>
                  <label class="pdd-none" >Italian</label>
          </div>  
          </div>
          <div class="col-md-2 col-sm-2 col fs-wd">
          <div class="checkbox">
          <input type="checkbox" class="foodstylechk" name="data[CharterGuestFoodPreference][food_style][]" value="2" <?php echo $foodStyleChecked[2]; ?>>
               <label class="pdd-none">Russian</label>
          </div> 
        </div>
        <div class="col-md-2 col-sm-2 ipad-fs-wd fs-wd">
              <div class="checkbox">
              <input type="checkbox" class="foodstylechk" name="data[CharterGuestFoodPreference][food_style][]" value="3" <?php echo $foodStyleChecked[3]; ?>>
               <label class="pdd-none">Asian Fusion</label>
          </div> 
        </div>
        <div class="col-md-2 col-sm-3 ipad-fs-wd fs-wd">
               <div class="checkbox">
               <input type="checkbox" class="foodstylechk" name="data[CharterGuestFoodPreference][food_style][]" value="4" <?php echo $foodStyleChecked[4]; ?>>
               <label class="pdd-none">Gluten Free</label>
          </div> 
        </div>
        <div class="col-md-2 col-sm-2  fs-wd">
                         <div class="checkbox">
                         <input type="checkbox" class="foodstylechk" name="data[CharterGuestFoodPreference][food_style][]" value="5" <?php echo $foodStyleChecked[5]; ?>>
               <label class="pdd-none">Vegitarian</label>
          </div>
        </div>
        <div class="col-md-2 col-sm-1  fs-wd">
                      <div class="checkbox">
                      <input type="checkbox" class="foodstylechk" name="data[CharterGuestFoodPreference][food_style][]" value="6" <?php echo $foodStyleChecked[6]; ?>>
               <label class="pdd-none">Greek</label>
          </div>
        </div>
        </div>
        <div class="clearfix"></div>
                <div class="col-lg-12 pdd-none">
          <div class="col-md-2 col-sm-2  fs-wd">
              <div class="checkbox">
              <input type="checkbox" class="foodstylechk" name="data[CharterGuestFoodPreference][food_style][]" value="7" <?php echo $foodStyleChecked[7]; ?>>
               <label class="pdd-none">French</label>
          </div>  
          </div>
          <div class="col-md-2 col-sm-2  fs-wd">
          <div class="checkbox">
          <input type="checkbox" class="foodstylechk" name="data[CharterGuestFoodPreference][food_style][]" value="8" <?php echo $foodStyleChecked[8]; ?>>
               <label class="pdd-none">American</label>
          </div> 
        </div>
        <div class="col-md-2 col-sm-2 ipad-fs-wd fs-wd">
              <div class="checkbox">
              <input type="checkbox" class="foodstylechk" name="data[CharterGuestFoodPreference][food_style][]" value="9" <?php echo $foodStyleChecked[9]; ?>>
               <label class="pdd-none">Mediterranean</label>
          </div> 
        </div>
        <div class="col-md-2 col-sm-3 ipad-fs-wd fs-wd">
               <div class="checkbox">
               <input type="checkbox" class="foodstylechk" name="data[CharterGuestFoodPreference][food_style][]" value="10" <?php echo $foodStyleChecked[10]; ?>>
               <label class="pdd-none">Spanish</label>
          </div> 
        </div>
        <div class="col-md-2 col-sm-2  fs-wd">
                         <div class="checkbox">
                         <input type="checkbox" class="foodstylechk" name="data[CharterGuestFoodPreference][food_style][]" value="11" <?php echo $foodStyleChecked[11]; ?>>
               <label class="pdd-none">Indian</label>
          </div>
        </div>
        <div class="col-md-2 col-sm-1 fs-wd">
                      <div class="checkbox">
                      <input type="checkbox" class="foodstylechk" name="data[CharterGuestFoodPreference][food_style][]" value="12" <?php echo $foodStyleChecked[12]; ?>>
               <label class="pdd-none">Thai</label>
          </div>
        </div>
        </div>
        <input type="hidden" name="data[CharterGuestFoodPreference][food_style_hidden][]" id="food_style_hidden" value="" />
        <div class="clearfix"></div>
        <div class="row ipadport-comments">
          <div class="col-md-1 col-sm-2">
            <label class="control-label label-comments-space">Comments</label>
          </div>
          <div class="col-md-8 col-sm-9 Comments-1024">
            <!--<input type="text" class="form-control">-->
            <?php echo $this->Form->input("food_style_comments",array("label"=>false,'class'=>'form-control','type' => 'text')); ?>
          </div>
      </div>
      </div>
      <div class="clearfix"></div>
            <!-- <div class="space-50-h"></div>-->
    <hr class="divider divmar">
            <div class="form-group frmgrp-mar">
              <div class="radio-box-container-row">
        <div class="col-md-12 md-col-nospace">
          <label >Cooking Preference</label>
        </div>
        <!-- Beef -->
        <div class="col-md-12 pdd-none full-column-marg span-left-0px">
          <div class="col-md-1 col-sm-1 cp-head">
            <label class="control-label mar-t-10">Beef</label>
          </div>
          <div class="col-md-2 col-sm-2 md-radio-column-box">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][beaf_preference]" value="1" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['beaf_preference']) && $foodPreferences['CharterGuestFoodPreference']['beaf_preference'] == 1) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Rare</span></label>
            </div>
          </div>
          <div class="col-md-2 col-sm-2  md-radio-column-box-max">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][beaf_preference]" value="2" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['beaf_preference']) && $foodPreferences['CharterGuestFoodPreference']['beaf_preference'] == 2) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Med Rare</span></label>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 md-radio-column-box">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][beaf_preference]" value="3" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['beaf_preference']) && $foodPreferences['CharterGuestFoodPreference']['beaf_preference'] == 3) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Med</span></label>
            </div>
          </div>

          <div class="col-md-2 col-sm-2 md-radio-column-box-max">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][beaf_preference]" value="4" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['beaf_preference']) && $foodPreferences['CharterGuestFoodPreference']['beaf_preference'] == 4) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Med Well</span></label>
            </div>
          </div>

          <div class="col-md-2 col-sm-2 md-radio-column-box-max">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][beaf_preference]" value="5" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['beaf_preference']) && $foodPreferences['CharterGuestFoodPreference']['beaf_preference'] == 5) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Well Done</span></label>
            </div>
          </div>

<!--          <div class="col-md-1 col-sm-1 cp-width">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][beaf_preference]" value="6" <?php //echo (isset($foodPreferences['CharterGuestFoodPreference']['beaf_preference']) && $foodPreferences['CharterGuestFoodPreference']['beaf_preference'] == 6) ? 'checked' : ''; ?>>
              <label class="pdd-none">Dislike</label>
            </div>
          </div>-->

        </div>
        <div class="clearfix"></div>
<!-- Lamb -->
       <div class="col-md-12 pdd-none full-column-marg">
          <div class="col-md-1 col-sm-1 cp-head">
            <label class="control-label mar-t-10">Lamb</label>
          </div>
          <div class="col-md-2 col-sm-2 md-radio-column-box">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][lamb_preference]" value="1" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['lamb_preference']) && $foodPreferences['CharterGuestFoodPreference']['lamb_preference'] == 1) ? 'checked' : ''; ?>>
              <label><span>Rare</span></label>
            </div>
          </div>
          <div class="col-md-2  col-sm-2 md-radio-column-box-max">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][lamb_preference]" value="2" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['lamb_preference']) && $foodPreferences['CharterGuestFoodPreference']['lamb_preference'] == 2) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Med Rare</span></label>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 md-radio-column-box">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][lamb_preference]" value="3" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['lamb_preference']) && $foodPreferences['CharterGuestFoodPreference']['lamb_preference'] == 3) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Med</span></label>
            </div>
          </div>

          <div class="col-md-2 col-sm-2 md-radio-column-box-max">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][lamb_preference]" value="4" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['lamb_preference']) && $foodPreferences['CharterGuestFoodPreference']['lamb_preference'] == 4) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Med Well</span></label>
            </div>
          </div>

          <div class="col-md-2 col-sm-2 md-radio-column-box-max">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][lamb_preference]" value="5" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['lamb_preference']) && $foodPreferences['CharterGuestFoodPreference']['lamb_preference'] == 5) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Well Done</span></label>
            </div>
          </div>

<!--          <div class="col-md-1 col-sm-1 cp-width">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][lamb_preference]" value="6" <?php //echo (isset($foodPreferences['CharterGuestFoodPreference']['lamb_preference']) && $foodPreferences['CharterGuestFoodPreference']['lamb_preference'] == 6) ? 'checked' : ''; ?>>
              <label class="pdd-none">Dislike</label>
            </div>
          </div>-->
        </div>
<div class="clearfix"></div>
<!-- pork -->
       <div class="col-md-12 pdd-none full-column-marg">
          <div class="col-md-1 col-sm-1 cp-head">
            <label class="control-label mar-t-10">Pork</label>
          </div>
          <div class="col-md-2 col-sm-2 md-radio-column-box">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][pork_preference]" value="1" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['pork_preference']) && $foodPreferences['CharterGuestFoodPreference']['pork_preference'] == 1) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Rare</span></label>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 md-radio-column-box-max">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][pork_preference]" value="2" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['pork_preference']) && $foodPreferences['CharterGuestFoodPreference']['pork_preference'] == 2) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Med Rare</span></label>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 md-radio-column-box">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][pork_preference]" value="3" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['pork_preference']) && $foodPreferences['CharterGuestFoodPreference']['pork_preference'] == 3) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Med</span></label>
            </div>
          </div>

          <div class="col-md-2 col-sm-2 md-radio-column-box-max">
            <div class="radio">
            <input type="radio" name="data[CharterGuestFoodPreference][pork_preference]" value="4" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['pork_preference']) && $foodPreferences['CharterGuestFoodPreference']['pork_preference'] == 4) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Med Well</span></label>
            </div>
          </div>

          <div class="col-md-2 col-sm-2 md-radio-column-box-max">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][pork_preference]" value="5" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['pork_preference']) && $foodPreferences['CharterGuestFoodPreference']['pork_preference'] == 5) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Well Done</span></label>
            </div>
          </div>

<!--          <div class="col-md-1 col-sm-1 cp-width" >
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][pork_preference]" value="6" <?php //echo (isset($foodPreferences['CharterGuestFoodPreference']['pork_preference']) && $foodPreferences['CharterGuestFoodPreference']['pork_preference'] == 6) ? 'checked' : ''; ?>>
              <label class="pdd-none">Dislike</label>
            </div>
          </div>-->
        </div>
<div class="clearfix"></div>
        <!-- Duck -->
         <div class="col-md-12 pdd-none full-column-marg">
          <div class="col-md-1 col-sm-1 cp-head">
            <label class="control-label mar-t-10">Duck</label>
          </div>
          <div class="col-md-2 col-sm-2 md-radio-column-box">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][duck_preference]" value="1" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['duck_preference']) && $foodPreferences['CharterGuestFoodPreference']['duck_preference'] == 1) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Rare</span></label>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 md-radio-column-box-max">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][duck_preference]" value="2" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['duck_preference']) && $foodPreferences['CharterGuestFoodPreference']['duck_preference'] == 2) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Med Rare</span></label>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 md-radio-column-box">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][duck_preference]" value="3" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['duck_preference']) && $foodPreferences['CharterGuestFoodPreference']['duck_preference'] == 3) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Med</span></label>
            </div>
          </div>

          <div class="col-md-2 col-sm-2 md-radio-column-box-max">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][duck_preference]" value="4" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['duck_preference']) && $foodPreferences['CharterGuestFoodPreference']['duck_preference'] == 4) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Med Well</span></label>
            </div>
          </div>

          <div class="col-md-2 col-sm-2 md-radio-column-box-max">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][duck_preference]" value="5" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['duck_preference']) && $foodPreferences['CharterGuestFoodPreference']['duck_preference'] == 5) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Well Done</span></label>
            </div>
          </div>

<!--          <div class="col-md-1 col-sm-1 cp-width">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][duck_preference]" value="6" <?php //echo (isset($foodPreferences['CharterGuestFoodPreference']['duck_preference']) && $foodPreferences['CharterGuestFoodPreference']['duck_preference'] == 6) ? 'checked' : ''; ?>>
              <label class="pdd-none">Dislike</label>
            </div>
          </div>-->
        </div>
<div class="clearfix"></div>
<!-- Veal -->
       <div class="col-md-12 pdd-none full-column-marg">
          <div class="col-md-1 col-sm-1 cp-head">
            <label class="control-label mar-t-10">Veal</label>
          </div>
          <div class="col-md-2 col-sm-2 md-radio-column-box">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][veal_preference]" value="1" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['veal_preference']) && $foodPreferences['CharterGuestFoodPreference']['veal_preference'] == 1) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Rare</span></label>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 md-radio-column-box-max">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][veal_preference]" value="2" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['veal_preference']) && $foodPreferences['CharterGuestFoodPreference']['veal_preference'] == 2) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Med Rare</span></label>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 md-radio-column-box">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][veal_preference]" value="3" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['veal_preference']) && $foodPreferences['CharterGuestFoodPreference']['veal_preference'] == 3) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Med</span></label>
            </div>
          </div>

          <div class="col-md-2 col-sm-2 md-radio-column-box-max">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][veal_preference]" value="4" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['veal_preference']) && $foodPreferences['CharterGuestFoodPreference']['veal_preference'] == 4) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Med Well</span></label>
            </div>
          </div>

          <div class="col-md-2 col-sm-2 md-radio-column-box-max">
            <div class="radio ">
            <input type="radio" name="data[CharterGuestFoodPreference][veal_preference]" value="5" <?php echo (isset($foodPreferences['CharterGuestFoodPreference']['veal_preference']) && $foodPreferences['CharterGuestFoodPreference']['veal_preference'] == 5) ? 'checked' : ''; ?>>
              <label class="pdd-none"><span>Well Done</span></label>
            </div>
          </div>

<!--          <div class="col-md-1 col-sm-1 cp-width">
            <div class="radio ">
              <input type="radio" name="data[CharterGuestFoodPreference][veal_preference]" value="6" <?php //echo (isset($foodPreferences['CharterGuestFoodPreference']['veal_preference']) && $foodPreferences['CharterGuestFoodPreference']['veal_preference'] == 6) ? 'checked' : ''; ?>>  
              <label class="pdd-none">Dislike</label>
            </div>
          </div>-->
        </div> </div>
        <div class="clearfix"></div>
        <hr class="divider divmar">
<!--<div class="space-50-h"></div>-->
    <div class="col-md-6  col-sm-6 th-md-col-space">
      <table class="table table-bordered fd-table table-container-row">
        <tr>
          <th>Food Preferences  </th>
         <!--  <th style="text-align: center;">Love  </th>
          <th style="text-align: center;">Like  </th>
          <th style="text-align: center;">Dislike  </th> -->
        </tr>
       <tr>
         <td class="fd-cent" >Soups</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_1]" value="1" <?php echo $foodLove[1]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_1]" value="2" <?php echo $foodLike[1]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_1]" value="3" <?php echo $foodDislike[1]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
          <tr>
         <td class="fd-cent" >Beef</td>
                 <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_2]" value="1" <?php echo $foodLove[2]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
           </td>
           <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_2]" value="2" <?php echo $foodLike[2]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_2]" value="3" <?php echo $foodDislike[2]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
       <tr>
         <td class="fd-cent" >Lamb</td>
                  <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_3]" value="1" <?php echo $foodLove[3]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_3]" value="2" <?php echo $foodLike[3]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>

         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
               <input type="radio" name="data[CharterGuestFoodPreference][food_3]" value="3" <?php echo $foodDislike[3]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      <tr>
         <td class="fd-cent" >Veal</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_4]" value="1" <?php echo $foodLove[4]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_4]" value="2" <?php echo $foodLike[4]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_4]" value="3" <?php echo $foodDislike[4]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
       <tr>
         <td class="fd-cent" >Venison</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_5]" value="1" <?php echo $foodLove[5]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_5]" value="2" <?php echo $foodLike[5]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_5]" value="3" <?php echo $foodDislike[5]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
       <tr>
         <td class="fd-cent" >Ostrich</td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_6]" value="1" <?php echo $foodLove[6]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>  
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_6]" value="2" <?php echo $foodLike[6]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_6]" value="3" <?php echo $foodDislike[6]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>   
       </tr>
       <tr>
         <td class="fd-cent" >Caribou</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_7]" value="1" <?php echo $foodLove[7]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_7]" value="2" <?php echo $foodLike[7]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_7]" value="3" <?php echo $foodDislike[7]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
       <tr>
         <td class="fd-cent" >Buffalo</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_8]" value="1" <?php echo $foodLove[8]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_8]" value="2" <?php echo $foodLike[8]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_8]" value="3" <?php echo $foodDislike[8]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      <tr>
         <td class="fd-cent" >Pork</td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_9]" value="1" <?php echo $foodLove[9]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_9]" value="2" <?php echo $foodLike[9]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_9]" value="3" <?php echo $foodDislike[9]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
        <tr>
         <td class="fd-cent" >Chiken</td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_10]" value="1" <?php echo $foodLove[10]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_10]" value="2" <?php echo $foodLike[10]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_10]" value="3" <?php echo $foodDislike[10]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      <tr>
         <td class="fd-cent" >Duck</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_11]" value="1" <?php echo $foodLove[11]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_11]" value="2" <?php echo $foodLike[11]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_11]" value="3" <?php echo $foodDislike[11]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      <tr>
         <td class="fd-cent" >Quail</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
               <input type="radio" name="data[CharterGuestFoodPreference][food_12]" value="1" <?php echo $foodLove[12]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_12]" value="2" <?php echo $foodLike[12]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_12]" value="3" <?php echo $foodDislike[12]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      <tr>
         <td class="fd-cent" >Pigeon</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_13]" value="1" <?php echo $foodLove[13]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_13]" value="2" <?php echo $foodLike[13]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_13]" value="3" <?php echo $foodDislike[13]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      <tr>
         <td class="fd-cent" >Salads</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_14]" value="1" <?php echo $foodLove[14]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_14]" value="2" <?php echo $foodLike[14]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_14]" value="3" <?php echo $foodDislike[14]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      <tr>
         <td class="fd-cent" >Vegetables</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_15]" value="1" <?php echo $foodLove[15]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_15]" value="2" <?php echo $foodLike[15]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_15]" value="3" <?php echo $foodDislike[15]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      <tr>
         <td class="fd-cent" >Vegetarian</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_16]" value="1" <?php echo $foodLove[16]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_16]" value="2" <?php echo $foodLike[16]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_16]" value="3" <?php echo $foodDislike[16]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      <tr>
         <td class="fd-cent" >Pasta</td>
           <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_17]" value="1" <?php echo $foodLove[17]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_17]" value="2" <?php echo $foodLike[17]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_17]" value="3" <?php echo $foodDislike[17]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      </table>
    </div>
 
<!--<div class="col-md-3  col-sm-6 ">
   <table class="table checkbox-table">
    <thead>
          <tr>
          <th style="text-align: center;">Love  </th>
          <th style="text-align: center;">Like  </th>
          <th style="text-align: center;">Dislike  </th>
        </tr>
    </thead>
    <tbody>
       <tr>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_1]" value="1" <?php echo $foodLove[1]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_1]" value="2" <?php echo $foodLike[1]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_1]" value="3" <?php echo $foodDislike[1]; ?>></label>
           </div>
         </td>
       </tr>

          <tr>
          <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_2]" value="1" <?php echo $foodLove[2]; ?>></label>
           </div>
           </td>
           <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_2]" value="2" <?php echo $foodLike[2]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_2]" value="3" <?php echo $foodDislike[2]; ?>></label>
           </div>
         </td>
       
       </tr>

       <tr>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_3]" value="1" <?php echo $foodLove[3]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_3]" value="2" <?php echo $foodLike[3]; ?>></label>
           </div>
         </td>

         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_3]" value="3" <?php echo $foodDislike[3]; ?>></label>
           </div>
         </td>
       </tr>

      <tr>
        <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_4]" value="1" <?php echo $foodLove[4]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_4]" value="2" <?php echo $foodLike[4]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_4]" value="3" <?php echo $foodDislike[4]; ?>></label>
           </div>
         </td>
       </tr>

       <tr>
        <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_5]" value="1" <?php echo $foodLove[5]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_5]" value="2" <?php echo $foodLike[5]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_5]" value="3" <?php echo $foodDislike[5]; ?>></label>
           </div>
         </td>
       </tr>

       <tr>
          <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_6]" value="1" <?php echo $foodLove[6]; ?>></label>
           </div>
         </td>  
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_6]" value="2" <?php echo $foodLike[6]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_6]" value="3" <?php echo $foodDislike[6]; ?>></label>
           </div>
         </td>    
       </tr>

       <tr>
        <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_7]" value="1" <?php echo $foodLove[7]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_7]" value="2" <?php echo $foodLike[7]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_7]" value="3" <?php echo $foodDislike[7]; ?>></label>
           </div>
         </td>
       </tr>

       <tr>
          <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_8]" value="1" <?php echo $foodLove[8]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_8]" value="2" <?php echo $foodLike[8]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_8]" value="3" <?php echo $foodDislike[8]; ?>></label>
           </div>
         </td>
       </tr>

      <tr>
        <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_9]" value="1" <?php echo $foodLove[9]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_9]" value="2" <?php echo $foodLike[9]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_9]" value="3" <?php echo $foodDislike[9]; ?>></label>
           </div>
         </td>
       </tr>

        <tr>
          <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_10]" value="1" <?php echo $foodLove[10]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_10]" value="2" <?php echo $foodLike[10]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_10]" value="3" <?php echo $foodDislike[10]; ?>></label>
           </div>
         </td>
       </tr>

      <tr>
          <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_11]" value="1" <?php echo $foodLove[11]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_11]" value="2" <?php echo $foodLike[11]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_11]" value="3" <?php echo $foodDislike[11]; ?>></label>
           </div>
         </td>
       </tr>

      <tr>
        <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_12]" value="1" <?php echo $foodLove[12]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_12]" value="2" <?php echo $foodLike[12]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_12]" value="3" <?php echo $foodDislike[12]; ?>></label>
           </div>
         </td>
       </tr>

      <tr>
       <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_13]" value="1" <?php echo $foodLove[13]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_13]" value="2" <?php echo $foodLike[13]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_13]" value="3" <?php echo $foodDislike[13]; ?>></label>
           </div>
         </td>
       </tr>

      <tr>
       <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_14]" value="1" <?php echo $foodLove[14]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_14]" value="2" <?php echo $foodLike[14]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_14]" value="3" <?php echo $foodDislike[14]; ?>></label>
           </div>
         </td>
       </tr>

      <tr>
        <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_15]" value="1" <?php echo $foodLove[15]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_15]" value="2" <?php echo $foodLike[15]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_15]" value="3" <?php echo $foodDislike[15]; ?>></label>
           </div>
         </td>
       </tr>

      <tr>
          <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_16]" value="1" <?php echo $foodLove[16]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_16]" value="2" <?php echo $foodLike[16]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_16]" value="3" <?php echo $foodDislike[16]; ?>></label>
           </div>
         </td>
       </tr>

      <tr>
        <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_17]" value="1" <?php echo $foodLove[17]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_17]" value="2" <?php echo $foodLike[17]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_17]" value="3" <?php echo $foodDislike[17]; ?>></label>
           </div>
         </td>
       </tr>
       </tbody>
      </table>
</div>-->
<!--<div class="clear"></div>-->
<div class="col-md-6  col-sm-6 th-md-col-space">
   <table class="table table-bordered fd-table tabport-tabletext-middel table-container-row">
        <tr>
          <th>Food Preferences  </th>
         <!--  <th style="text-align: center;">Love  </th>
          <th style="text-align: center;">Like  </th>
          <th style="text-align: center;">Dislike  </th> -->
        </tr>
       <tr>
         <td class="fd-cent" >Mussels</td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_18]" value="1" <?php echo $foodLove[18]; ?>>
              <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_18]" value="2" <?php echo $foodLike[18]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_18]" value="3" <?php echo $foodDislike[18]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
          <tr>
         <td class="fd-cent" >Black cod</td>
                   <td align="center" class="md-radio-column-box">
           <div class="radio my-none" >
            <input type="radio" name="data[CharterGuestFoodPreference][food_19]" value="1" <?php echo $foodLove[19]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
           </td>
           <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_19]" value="2" <?php echo $foodLike[19]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_19]" value="3" <?php echo $foodDislike[19]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
       <tr>
         <td class="fd-cent" >Halibut</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_20]" value="1" <?php echo $foodLove[20]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_20]" value="2" <?php echo $foodLike[20]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>

         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio"  name="data[CharterGuestFoodPreference][food_20]" value="3" <?php echo $foodDislike[20]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      <tr>
         <td class="fd-cent" >Rockfish</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_21]" value="1" <?php echo $foodLove[21]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_21]" value="2" <?php echo $foodLike[21]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_21]" value="3" <?php echo $foodDislike[21]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
       <tr>
         <td class="fd-cent" >Salmon</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_22]" value="1" <?php echo $foodLove[22]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_22]" value="2" <?php echo $foodLike[22]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_22]" value="3" <?php echo $foodDislike[22]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
       <tr>
         <td class="fd-cent" >Sole</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_23]" value="1" <?php echo $foodLove[23]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>  
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_23]" value="2" <?php echo $foodLike[23]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
               <input type="radio" name="data[CharterGuestFoodPreference][food_23]" value="3" <?php echo $foodDislike[23]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>    
       </tr>
       <tr>
         <td class="fd-cent" >Tuna</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio"  name="data[CharterGuestFoodPreference][food_24]" value="1" <?php echo $foodLove[24]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_24]" value="2" <?php echo $foodLike[24]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_24]" value="3" <?php echo $foodDislike[24]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
       <tr>
         <td class="fd-cent" >Swordfish</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio"  name="data[CharterGuestFoodPreference][food_24]" value="1" <?php echo $foodLove[24]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_24]" value="2" <?php echo $foodLike[24]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_24]" value="3" <?php echo $foodDislike[24]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
       <tr>
         <td class="fd-cent" >Crab</td>
           <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_25]" value="1" <?php echo $foodLove[25]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_25]" value="2" <?php echo $foodLike[25]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_25]" value="3" <?php echo $foodDislike[25]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      <tr>
         <td class="fd-cent" >King Crab</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_26]" value="1" <?php echo $foodLove[26]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_26]" value="2" <?php echo $foodLike[26]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_26]" value="3" <?php echo $foodDislike[26]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
        <tr>
         <td class="fd-cent" >Lobster</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_27]" value="1" <?php echo $foodLove[27]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_27]" value="2" <?php echo $foodLike[27]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_27]" value="3" <?php echo $foodDislike[27]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      <tr>
         <td class="fd-cent" >Prawns</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_28]" value="1" <?php echo $foodLove[28]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio"  name="data[CharterGuestFoodPreference][food_28]" value="2" <?php echo $foodLike[28]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_28]" value="3" <?php echo $foodDislike[28]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      <tr>
         <td class="fd-cent">Scallops</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_29]" value="1" <?php echo $foodLove[29]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_29]" value="2" <?php echo $foodLike[29]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_29]" value="3" <?php echo $foodDislike[29]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      <tr>
         <td class="fd-cent" >Caviar</td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_30]" value="1" <?php echo $foodLove[30]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_30]" value="2" <?php echo $foodLike[30]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio"  name="data[CharterGuestFoodPreference][food_30]" value="3" <?php echo $foodDislike[30]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      <tr>
         <td class="fd-cent" >Foie gras</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_31]" value="1" <?php echo $foodLove[31]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_31]" value="2" <?php echo $foodLike[31]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio"  name="data[CharterGuestFoodPreference][food_31]" value="3" <?php echo $foodDislike[31]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      <!-- <tr>
         <td class="fd-cent">Hors d'oevres</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_32]" value="1" <?php echo $foodLove[32]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_32]" value="2" <?php echo $foodLike[32]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_32]" value="3" <?php echo $foodDislike[32]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr> -->
      <tr>
         <td class="fd-cent" >Desserts</td>
            <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_33]" value="1" <?php echo $foodLove[33]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_33]" value="2" <?php echo $foodLike[33]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_33]" value="3" <?php echo $foodDislike[33]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      <tr>
         <td class="fd-cent" >Rice</td>
          <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_34]" value="1" <?php echo $foodLove[34]; ?>>
             <label class="pdd-none"><span>Love</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_34]" value="2" <?php echo $foodLike[34]; ?>>
             <label class="pdd-none"><span>Like</span></label>
           </div>
         </td>
         <td align="center" class="md-radio-column-box">
           <div class="radio my-none">
           <input type="radio" name="data[CharterGuestFoodPreference][food_34]" value="3" <?php echo $foodDislike[34]; ?>>
             <label class="pdd-none"><span>Dislike</span></label>
           </div>
         </td>
       </tr>
      </table>
</div> 
<!--<div class="col-md-3  col-sm-6 ">
     <table class="table checkbox-table">
    <thead>
          <tr>
          <th style="text-align: center;">Love  </th>
          <th style="text-align: center;">Like  </th>
          <th style="text-align: center;">Dislike  </th>
        </tr>
    </thead>
    <tbody>
       <tr>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_18]" value="1" <?php echo $foodLove[18]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_18]" value="2" <?php echo $foodLike[18]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_18]" value="3" <?php echo $foodDislike[18]; ?>></label>
           </div>
         </td>
       </tr>

          <tr>
          <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_19]" value="1" <?php echo $foodLove[19]; ?>></label>
           </div>
           </td>
           <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_19]" value="2" <?php echo $foodLike[19]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_19]" value="3" <?php echo $foodDislike[19]; ?>></label>
           </div>
         </td>
         
       </tr>

       <tr>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_20]" value="1" <?php echo $foodLove[20]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_20]" value="2" <?php echo $foodLike[20]; ?>></label>
           </div>
         </td>

         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio"  name="data[CharterGuestFoodPreference][food_20]" value="3" <?php echo $foodDislike[20]; ?>></label>
           </div>
         </td>
       </tr>

      <tr>
        <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_21]" value="1" <?php echo $foodLove[21]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_21]" value="2" <?php echo $foodLike[21]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_21]" value="3" <?php echo $foodDislike[21]; ?>></label>
           </div>
         </td>
       </tr>

       <tr>
        <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_22]" value="1" <?php echo $foodLove[22]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_22]" value="2" <?php echo $foodLike[22]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_22]" value="3" <?php echo $foodDislike[22]; ?>></label>
           </div>
         </td>
       </tr>

       <tr>
          <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_23]" value="1" <?php echo $foodLove[23]; ?>></label>
           </div>
         </td>  
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_23]" value="2" <?php echo $foodLike[23]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_23]" value="3" <?php echo $foodDislike[23]; ?>></label>
           </div>
         </td>    
       </tr>

       <tr>
        <td align="center">
           <div class="radio my-none">
             <label ><input type="radio"  name="data[CharterGuestFoodPreference][food_24]" value="1" <?php echo $foodLove[24]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_24]" value="2" <?php echo $foodLike[24]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_24]" value="3" <?php echo $foodDislike[24]; ?>></label>
           </div>
         </td>
       </tr>

       <tr>
          <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_25]" value="1" <?php echo $foodLove[25]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_25]" value="2" <?php echo $foodLike[25]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_25]" value="3" <?php echo $foodDislike[25]; ?>></label>
           </div>
         </td>
       </tr>

      <tr>
        <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_26]" value="1" <?php echo $foodLove[26]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_26]" value="2" <?php echo $foodLike[26]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_26]" value="3" <?php echo $foodDislike[26]; ?>></label>
           </div>
         </td>
       </tr>

        <tr>
          <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_27]" value="1" <?php echo $foodLove[27]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_27]" value="2" <?php echo $foodLike[27]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_27]" value="3" <?php echo $foodDislike[27]; ?>></label>
           </div>
         </td>
       </tr>

      <tr>
          <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_28]" value="1" <?php echo $foodLove[28]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio"  name="data[CharterGuestFoodPreference][food_28]" value="2" <?php echo $foodLike[28]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_28]" value="3" <?php echo $foodDislike[28]; ?>></label>
           </div>
         </td>
       </tr>

      <tr>
        <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_29]" value="1" <?php echo $foodLove[29]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_29]" value="2" <?php echo $foodLike[29]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_29]" value="3" <?php echo $foodDislike[29]; ?>></label>
           </div>
         </td>
       </tr>

      <tr>
       <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_30]" value="1" <?php echo $foodLove[30]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_30]" value="2" <?php echo $foodLike[30]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio"  name="data[CharterGuestFoodPreference][food_30]" value="3" <?php echo $foodDislike[30]; ?>></label>
           </div>
         </td>
       </tr>

      <tr>
       <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_31]" value="1" <?php echo $foodLove[31]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_31]" value="2" <?php echo $foodLike[31]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio"  name="data[CharterGuestFoodPreference][food_31]" value="3" <?php echo $foodDislike[31]; ?>></label>
           </div>
         </td>
       </tr>

      <tr>
        <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_32]" value="1" <?php echo $foodLove[32]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_32]" value="2" <?php echo $foodLike[32]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_32]" value="3" <?php echo $foodDislike[32]; ?>></label>
           </div>
         </td>
       </tr>

      <tr>
          <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_33]" value="1" <?php echo $foodLove[33]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_33]" value="2" <?php echo $foodLike[33]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_33]" value="3" <?php echo $foodDislike[33]; ?>></label>
           </div>
         </td>
       </tr>

      <tr>
        <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_34]" value="1" <?php echo $foodLove[34]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_34]" value="2" <?php echo $foodLike[34]; ?>></label>
           </div>
         </td>
         <td align="center">
           <div class="radio my-none">
             <label ><input type="radio" name="data[CharterGuestFoodPreference][food_34]" value="3" <?php echo $foodDislike[34]; ?>></label>
           </div>
         </td>
       </tr>
       </tbody>
      </table>
</div>-->
<div class="clearfix"></div>
      <!--<div class="space-20-h"></div>-->
      <hr class="divider divmar">

      <div class="form-group frmgrp-mar dietary-requirements-row">
        <div class="col-md-12 md-col-nospace">
          <label>Dislikes</label>
        </div>
        <div class="col-lg-12 pdd-none">
          <div class="col-xs-6 col-md-2 col-sm-2 md-dislike-0">
              <div class="checkbox">
              <input type="checkbox" class="dislikeschk" name="data[CharterGuestFoodPreference][dislikes][]" value="1" <?php echo $dislikesListChecked[1]; ?>>
               <label class="pdd-none">Capers</label>
          </div>  
          </div>
          <div class="col-xs-6 col-md-2 col-sm-3 md-dislike-0">
          <div class="checkbox">
          <input type="checkbox" class="dislikeschk" name="data[CharterGuestFoodPreference][dislikes][]" value="2" <?php echo $dislikesListChecked[2]; ?>>
               <label class="pdd-none">Raw Onions</label>
          </div> 
        </div>
        <div class="col-xs-6 col-md-2 col-sm-3 pdd-none pad-0 md-dislike-0">
              <div class="checkbox">
              <input type="checkbox" class="dislikeschk" name="data[CharterGuestFoodPreference][dislikes][]" value="3" <?php echo $dislikesListChecked[3]; ?>>
               <label class="pdd-none">Cooked Onions</label>
          </div> 
        </div>
        <div class="col-xs-6 col-md-2 col-sm-2 md-dislike-0">
               <div class="checkbox">
               <input type="checkbox" class="dislikeschk" name="data[CharterGuestFoodPreference][dislikes][]" value="4" <?php echo $dislikesListChecked[4]; ?>>
               <label class="pdd-none">Beets</label>
          </div> 
        </div>
        <div class="col-xs-6 col-md-2 col-sm-2  md-dislike-0">
                         <div class="checkbox">
                         <input type="checkbox" class="dislikeschk" name="data[CharterGuestFoodPreference][dislikes][]" value="5" <?php echo $dislikesListChecked[5]; ?>>
               <label class="pdd-none">Olives</label>
          </div>
        </div>

        </div>
        <div class="clearfix"></div>
                <div class="col-lg-12 pdd-none">
          <div class="col-xs-6 col-md-2 col-sm-2 md-dislike-0">
              <div class="checkbox">
              <input type="checkbox" class="dislikeschk" name="data[CharterGuestFoodPreference][dislikes][]" value="6" <?php echo $dislikesListChecked[6]; ?>>
               <label class="pdd-none">Caviar</label>
          </div>  
          </div>
          <div class="col-xs-6 col-md-2 col-sm-3 md-dislike-0">
          <div class="checkbox">
          <input type="checkbox" class="dislikeschk" name="data[CharterGuestFoodPreference][dislikes][]" value="7" <?php echo $dislikesListChecked[7]; ?>>
               <label class="pdd-none">Tomato</label>
          </div> 
        </div>
        <div class="col-xs-6 col-md-2 col-sm-3 pdd-none pad-0 md-dislike-0">
              <div class="checkbox">
              <input type="checkbox" class="dislikeschk" name="data[CharterGuestFoodPreference][dislikes][]" value="8" <?php echo $dislikesListChecked[8]; ?>>
               <label class="pdd-none">Tomato Sauce</label>
          </div> 
        </div>
        <div class="col-xs-6 col-md-2 col-sm-2 md-dislike-0">
               <div class="checkbox">
               <input type="checkbox" class="dislikeschk" name="data[CharterGuestFoodPreference][dislikes][]" value="9" <?php echo $dislikesListChecked[9]; ?>>
               <label class="pdd-none">Hot Spice</label>
          </div> 
        </div>
        <div class="col-xs-6 col-md-2 col-sm-2 md-dislike-0">
                         <div class="checkbox">
                         <input type="checkbox" class="dislikeschk" name="data[CharterGuestFoodPreference][dislikes][]" value="10" <?php echo $dislikesListChecked[10]; ?>>
               <label class="pdd-none">Peppers</label>
          </div>
        </div>

        </div>
        <input type="hidden" name="data[CharterGuestFoodPreference][dislikes_hidden][]" value="" id="dislikes_hidden" />

        <div class="clearfix"></div>

        <div class="row ipad-port-comments">
          <div class="col-md-2 col-sm-2 md-dislike-0 comt-like-row">
          <label class="control-label label-comments-space">Comments</label>
        </div>
        <div class="col-md-7 col-sm-9 md-dislike-0">
          <!--<input type="text" class="form-control">-->
          <?php echo $this->Form->input("dislike_comments",array("label"=>false,'class'=>'form-control','type' => 'text')); ?>
        </div>
        </div>
      </div>
      <div class="space-20-h"></div>
      <br><br>
        <div class="form-group frmgrp-mar ">
            <div class="col-sm-12">
             
                <div class="text-center footer-mob-row-inner">
                    <?php if (!isset($charterAssocIdByHeaderView)) { ?>
                        <?php echo $this->Form->submit("Save and Continue", array('class' => 'btn btn-success'));?>
                    <?php } ?>
                </div>
            </div>
        </div>
      </div>
            <?php echo $this->Form->end(); ?>
</div></div></div></div>

<script>
//dislikeschk checkbox selected and unselected
    $(".dislikeschk").click(function () {
        var dil=0;
        var dislikes=[]; 
            $(".dislikeschk").each(function () {
                if($(this).is(':checked')) {
                  dislikes[dil++] = $(this).val();
              }else{
                  dislikes[dil++] = "unchecked";
              }
            });
            //console.log(cbox);
            $("#dislikes_hidden").val(dislikes);
            dil = 0;
               
     });
     

     //foodstylechk checkbox selected and unselected
    $(".foodstylechk").click(function () {
        var fs=0;
        var foodstyle=[]; 
            $(".foodstylechk").each(function () {
                if($(this).is(':checked')) {
                  foodstyle[fs++] = $(this).val();
              }else{
                  foodstyle[fs++] = "unchecked";
              }
            });
            //console.log(cbox);
            $("#food_style_hidden").val(foodstyle);
              fs = 0;
               
     });
</script>

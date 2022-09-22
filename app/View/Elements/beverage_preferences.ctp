<?php

    // Coffee items
    $coffeeItems = array(
        1 => 'Espresso',
        2 => 'Decaf',
        3 => 'Regular',
        4 => 'Cappuccino',
        5 => 'Latte',
        6 => 'Mocha'
    );
    // Tea items
    $teaItems = array(
        1 => 'Chi Latte',
        2 => 'Herbal',
        3 => 'Green',
        4 => 'peppermint',
        5 => 'White',
        6 => 'Black'
    );
    // Milk items
    $milkItems = array(
        1 => 'Whole',
        2 => '2%',
        3 => 'Skim',
        4 => 'Soy',
        5 => 'Rice',
        6 => 'Almond'
    );
    // Soda items
    $sodaItems = array(
        1 => 'Diet Coke',
        2 => 'Coke',
        3 => 'Sprite',
        4 => 'Ginger Ale',
        5 => 'Fanta',
        6 => 'Pepsi',
        7 => 'Club Soda',
        8 => 'Tonic',
        9 => 'Red Bull',
        10 => 'Root Beer',
        11 => 'Orangina',
        12 => 'Ice tea',
        13 => 'Other'
    );
    // Juice items
    $juiceItems = array(
        1 => 'Grapefruit',
        2 => 'Fanta',
        3 => 'Apple',
        4 => 'Pineapple',
        5 => 'Tomato',
        6 => 'Carrot',
        7 => 'Other'
    );
    // Water items
    $waterItems = array(
        1 => 'Mineral',
        2 => 'Sparkling',
        3 => 'Still',
        4 => 'Coconut',
        5 => 'Infused',
        6 => 'Other'
    );
    // Unit types
    $unitTypes = array(
        1 => 'Case(24)',
        2 => 'Case(12)',
        3 => 'Bottles'
    );
    
    $coffeeItemsChecked = array();
    for($i = 1; $i <= 6; $i++) { // 6 items
        $coffeeItemsChecked[$i] = '';
    }
    $teaItemsChecked = $milkItemsChecked = $coffeeItemsChecked;
    $juiceItemsChecked = $waterItemsChecked = $coffeeItemsChecked;
    $sodaItemsChecked = array();
    for($i = 1; $i <= 12; $i++) { // 12 items
        $sodaItemsChecked[$i] = '';
    }
    
    /*
    $alcoholicCommentsList = array();
    $alcoholicItemsEmptyAssoc1 = $alcoholicItemsEmptyAssoc2 = $alcoholicItemsEmptyAssoc3 = $alcoholicItemsEmptyAssoc4 = array();
    $quantityList1 = $quantityList2 = $quantityList3 = $alcoholicTypesEmptyAssoc; // Assigning the Empty beverage types array to holding the Quantities per type
     */
    $beveragePreferenceRowId = '';
    if (isset($beveragePreferences) && !empty($beveragePreferences)) {
        // Existing row id
        if (!empty($beveragePreferences['CharterGuestBeveragePreference']['id'])) {
            $beveragePreferenceRowId = $beveragePreferences['CharterGuestBeveragePreference']['id'];
        }
        // Coffee items
        if (!empty($beveragePreferences['CharterGuestBeveragePreference']['coffee_items'])) {
            $existCoffeeItems = explode(",", $beveragePreferences['CharterGuestBeveragePreference']['coffee_items']);
            foreach ($existCoffeeItems as $item) {
                $coffeeItemsChecked[$item] = "checked";
            }
        }
        // Tea items
        if (!empty($beveragePreferences['CharterGuestBeveragePreference']['tea_items'])) {
            $existTeaItems = explode(",", $beveragePreferences['CharterGuestBeveragePreference']['tea_items']);
            foreach ($existTeaItems as $item) {
                $teaItemsChecked[$item] = "checked";
            }
        }
        // Milk items
        if (!empty($beveragePreferences['CharterGuestBeveragePreference']['milk_items'])) {
            $existMilkItems = explode(",", $beveragePreferences['CharterGuestBeveragePreference']['milk_items']);
            foreach ($existMilkItems as $item) {
                $milkItemsChecked[$item] = "checked";
            }
        }
        // Soda items
        if (!empty($beveragePreferences['CharterGuestBeveragePreference']['soda_items'])) {
            $existSodaItems = explode(",", $beveragePreferences['CharterGuestBeveragePreference']['soda_items']);
            foreach ($existSodaItems as $item) {
                $sodaItemsChecked[$item] = "checked";
            }
        }
        // Juice items
        if (!empty($beveragePreferences['CharterGuestBeveragePreference']['juice_items'])) {
            $existJuiceItems = explode(",", $beveragePreferences['CharterGuestBeveragePreference']['juice_items']);
            foreach ($existJuiceItems as $item) {
                $juiceItemsChecked[$item] = "checked";
            }
        }
        // Water items
        if (!empty($beveragePreferences['CharterGuestBeveragePreference']['water_items'])) {
            $existWaterItems = explode(",", $beveragePreferences['CharterGuestBeveragePreference']['water_items']);
            foreach ($existWaterItems as $item) {
                $waterItemsChecked[$item] = "checked";
            }
        }
        
        /*
        //Alcoholic items1
        if (!empty($beveragePreferences['CharterGuestBeveragePreference']['alcoholic_items1'])) {
            $alcoholicItemsEmptyAssoc1 = explode(",", $beveragePreferences['CharterGuestBeveragePreference']['alcoholic_items1']);
        }
        //Alcoholic items2
        if (!empty($beveragePreferences['CharterGuestBeveragePreference']['alcoholic_items2'])) {
            $alcoholicItemsEmptyAssoc2 = explode(",", $beveragePreferences['CharterGuestBeveragePreference']['alcoholic_items2']);
        }
        //Alcoholic items3
        if (!empty($beveragePreferences['CharterGuestBeveragePreference']['alcoholic_items3'])) {
            $alcoholicItemsEmptyAssoc3 = explode(",", $beveragePreferences['CharterGuestBeveragePreference']['alcoholic_items3']);
        }
        //Alcoholic items4
        if (!empty($beveragePreferences['CharterGuestBeveragePreference']['alcoholic_items4'])) {
            $alcoholicItemsEmptyAssoc4 = explode(",", $beveragePreferences['CharterGuestBeveragePreference']['alcoholic_items4']);
        }
        //Alcoholic comments
        if (!empty($beveragePreferences['CharterGuestBeveragePreference']['alcoholic_comments'])) {
            $existAlcoholicComments = explode("^", $beveragePreferences['CharterGuestBeveragePreference']['alcoholic_comments']);
            $existAlcoholicTypes = explode(",", $beveragePreferences['CharterGuestBeveragePreference']['alcoholic_types']);
            foreach ($existAlcoholicComments as $key => $comment) {
                $alcoholicTypesEmptyAssoc[$existAlcoholicTypes[$key]] = $comment;
            }
        }
        
        // Quantity1
        if (!empty($beveragePreferences['CharterGuestBeveragePreference']['quantity1'])) {
            $existQuantityList1 = explode(",", $beveragePreferences['CharterGuestBeveragePreference']['quantity1']);
            $existAlcoholicTypes = explode(",", $beveragePreferences['CharterGuestBeveragePreference']['alcoholic_types']);
            foreach ($existQuantityList1 as $key => $quantity) {
                $quantityList1[$existAlcoholicTypes[$key]] = $quantity;
            }
        }
        // Quantity2
        if (!empty($beveragePreferences['CharterGuestBeveragePreference']['quantity2'])) {
            $existQuantityList2 = explode(",", $beveragePreferences['CharterGuestBeveragePreference']['quantity2']);
            $existAlcoholicTypes = explode(",", $beveragePreferences['CharterGuestBeveragePreference']['alcoholic_types']);
            foreach ($existQuantityList2 as $key => $quantity) {
                $quantityList2[$existAlcoholicTypes[$key]] = $quantity;
            }
        }
        // Quantity3
        if (!empty($beveragePreferences['CharterGuestBeveragePreference']['quantity3'])) {
            $existQuantityList3 = explode(",", $beveragePreferences['CharterGuestBeveragePreference']['quantity3']);
            $existAlcoholicTypes = explode(",", $beveragePreferences['CharterGuestBeveragePreference']['alcoholic_types']);
            foreach ($existQuantityList3 as $key => $quantity) {
                $quantityList3[$existAlcoholicTypes[$key]] = $quantity;
            }
        }
         */
    }    

?>
<style>
hr.divmar{
	margin-top:30px;
	margin-bottom:30px;
}
	.pl-none{
		padding-left: 0;
	}
	.px{
		padding-left: 5px;
		padding-right: 5px;
	}
	.pr-20{
		padding-right:9px;
	} 
	.pl-2{
		padding-left: 2px !important;
	}

@media only screen and (max-width:390px){
.beverage-menu-row .be-col-8{
  width: 34%!important;
}
.beverage-menu-row .be-col-sm-2 {
  width: 27%!important; margin-left: 15px;
}

}
  
/*	@media (max-width:768px){
		.ipad-bev{
			width:22% !important
		}
	}*/
</style>
<!-- beverage preference -->
<div id="beverage" class="tab-pane fade <?php echo $beveragePreferenceTab; ?>">
    <?php echo $this->Form->create('CharterGuestBeveragePreference', array('url' => array('controller' => 'charters','action' => 'preference'),'id'=>'beveragePreferenceForm'));     
           echo $this->Form->hidden("CharterGuestBeveragePreference.id", array('value' => $beveragePreferenceRowId));
           
           // When main Head charterer opens other guest(if Head charterer checked) and Update the Preference sheets
           if (isset($charterAssocIdByHeaderEdit)) {
               echo $this->Form->hidden("charterAssocIdByHeaderEdit", array('value' => $charterAssocIdByHeaderEdit));
           }
        ?>
<div class="personal-row-container beverage-menu-row">
<h1 class="position-mobile-head">Beverage</h1>
<div class="fixed-row-container">
  <div class="col-md-12">
          <div class="form-group frmgrp-mar">
            <div class="">
<!--               <label class="pdd-none">Beverage Preferences</label> -->
            </div>
            <div class="col-md-4 col-sm-4 pdd-none pl-2">
              <label class="pdd-none mrg-label">COFFEE</label>
              <div class="be-col-3 be-col-8">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="coffeechk" name="data[CharterGuestBeveragePreference][coffee_items][]" value="1" <?php echo $coffeeItemsChecked[1]; ?>>
                <label class="pdd-none"><span class="sp-lab">Espresso</span></label>
              </div></div>
               <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="coffeechk" name="data[CharterGuestBeveragePreference][coffee_items][]" value="2" <?php echo $coffeeItemsChecked[2]; ?>>
                <label class="pdd-none"><span class="sp-lab">Decaf</span></label>
              </div>
              </div>
              <div class="be-col-3 be-col-sm-2">
              <div class="checkbox">
              <input type="checkbox" class="coffeechk" name="data[CharterGuestBeveragePreference][coffee_items][]" value="3" <?php echo $coffeeItemsChecked[3]; ?>>
                  <label class="pdd-none"><span class="sp-lab">Regular</span></label>
              </div>
              </div>

              <div class="be-col-3 be-col-8">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="coffeechk" name="data[CharterGuestBeveragePreference][coffee_items][]" value="4" <?php echo $coffeeItemsChecked[4]; ?>>
                <label class="pdd-none"><span class="sp-lab">Cappuccino</span></label>
              </div></div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="coffeechk" name="data[CharterGuestBeveragePreference][coffee_items][]" value="5" <?php echo $coffeeItemsChecked[5]; ?>>
                <label class="pdd-none"><span class="sp-lab">Latte</span></label>
              </div></div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="coffeechk" name="data[CharterGuestBeveragePreference][coffee_items][]" value="6" <?php echo $coffeeItemsChecked[6]; ?>>
                <label class="pdd-none"><span class="sp-lab">Mocha</span></label>
              </div></div>
              <div>
              <input type="hidden" name="data[CharterGuestBeveragePreference][coffee_hidden][]" id="coffee_hidden" value="" />
                <label class="pdd-none mrg-label">Other</label>
              </div>
              <div class="col-md-12 col-sm-12 pl-none pl-2 md-input-row">
              <?php echo $this->Form->input("coffee_comments",array("label"=>false,'class'=>'form-control','type' => 'text')); ?>
            </div> 
              </div>
            <div class="col-md-4 col-sm-4 pdd-none pl-2">
              <label class="pdd-none mrg-label">TEA</label>
                <div class="be-col-3 be-col-8">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="teachk" name="data[CharterGuestBeveragePreference][tea_items][]" value="1" <?php echo $teaItemsChecked[1]; ?>>
                <label class="pdd-none"><span class="sp-lab">Chi Latte</span></label>
              </div></div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="teachk" name="data[CharterGuestBeveragePreference][tea_items][]" value="2" <?php echo $teaItemsChecked[2]; ?>>
                <label class="pdd-none"><span class="sp-lab">Herbal</span></label>
              </div></div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">  
               <input type="checkbox" class="teachk" name="data[CharterGuestBeveragePreference][tea_items][]" value="3" <?php echo $teaItemsChecked[3]; ?>>
                <label class="pdd-none"><span class="sp-lab">Green</span></label>
              </div></div>
              <div class="be-col-3 be-col-8">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="teachk" name="data[CharterGuestBeveragePreference][tea_items][]" value="4" <?php echo $teaItemsChecked[4]; ?>>
                <label class="pdd-none"><span class="sp-lab">Peppermint</span></label>
              </div></div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="teachk" name="data[CharterGuestBeveragePreference][tea_items][]" value="5" <?php echo $teaItemsChecked[5]; ?>>
                <label class="pdd-none"><span class="sp-lab">White</span></label>
              </div></div>
               <div class="be-col-3 be-col-sm-2">
              <div class="checkbox bev-chbox">
              <input type="checkbox" class="teachk" name="data[CharterGuestBeveragePreference][tea_items][]" value="6" <?php echo $teaItemsChecked[6]; ?>>
                <label class="pdd-none"><span class="sp-lab">Black</span></label>
              </div> </div>
              <div>
              <input type="hidden" name="data[CharterGuestBeveragePreference][tea_hidden][]" id="tea_hidden" value="" />
                <label class="pdd-none mrg-label">Other</label>
              </div>
            <div class="col-md-12 col-sm-12 pl-none md-input-row">
              <?php echo $this->Form->input("tea_comments",array("label"=>false,'class'=>'form-control','type' => 'text')); ?>
            </div>
            </div>
            <div class="col-md-4 col-sm-4 pdd-none pl-2">
                <label class="pdd-none mrg-label">MILK</label>
                <div class="be-col-3 be-col-8">
              <div class="checkbox bev-chbox">
              <input type="checkbox" class="milkchk" name="data[CharterGuestBeveragePreference][milk_items][]" value="1" <?php echo $milkItemsChecked[1]; ?>>
                <label class="pdd-none"><span class="sp-lab">Whole</span></label>
              </div></div>
               <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="milkchk" name="data[CharterGuestBeveragePreference][milk_items][]" value="2" <?php echo $milkItemsChecked[2]; ?>>
                <label class="pdd-none"><span class="sp-lab">2%</span></label>
              </div></div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">  
               <input type="checkbox" class="milkchk" name="data[CharterGuestBeveragePreference][milk_items][]" value="3" <?php echo $milkItemsChecked[3]; ?>>
                <label class="pdd-none"><span class="sp-lab">Skim</span></label>
              </div></div>
              <div class="be-col-3 be-col-8">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="milkchk" name="data[CharterGuestBeveragePreference][milk_items][]" value="4" <?php echo $milkItemsChecked[4]; ?>>
                <label class="pdd-none"><span class="sp-lab">Soy</span></label>
              </div>
              </div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="milkchk" name="data[CharterGuestBeveragePreference][milk_items][]" value="5" <?php echo $milkItemsChecked[5]; ?>>
                <label class="pdd-none"><span class="sp-lab">Rice</span></label>
              </div></div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="milkchk" name="data[CharterGuestBeveragePreference][milk_items][]" value="6" <?php echo $milkItemsChecked[6]; ?>>
                <label class="pdd-none"><span class="sp-lab">Almond</span></label>
              </div></div>
              <div>
              <input type="hidden" name="data[CharterGuestBeveragePreference][milk_hidden][]" id="milk_hidden" value="" />
                <label class="pdd-none mrg-label">Other</label>
              </div>
             <div class="col-md-12 col-sm-12 pl-none md-input-row">
              <?php echo $this->Form->input("milk_comments",array("label"=>false,'class'=>'form-control','type' => 'text')); ?>
            </div>
            </div>
            <div class="clearfix"></div>
           <hr class="divider divmar">
      <!--<div class="space-50-h"></div>-->
            <div class="col-sm-3 col-md-3 pdd-none ipad-bev pl-25">
              <label class="mrg-label">SODA</label>
              <div class="be-col-3 be-col-8">
              <div class="checkbox bev-chbox">
              <input type="checkbox" class="sodachk" name="data[CharterGuestBeveragePreference][soda_items][]" value="1" <?php echo $sodaItemsChecked[1]; ?>>
                <label class="pdd-none"><span class="sp-lab">Diet Coke</span></label>
              </div></div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="sodachk" name="data[CharterGuestBeveragePreference][soda_items][]" value="2" <?php echo $sodaItemsChecked[2]; ?>>
                <label class="pdd-none"><span class="sp-lab">Coke</span></label>
              </div></div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">  
               <input type="checkbox" class="sodachk" name="data[CharterGuestBeveragePreference][soda_items][]" value="3" <?php echo $sodaItemsChecked[3]; ?>>
                <label class="pdd-none"><span class="sp-lab">Sprite</span></label>
              </div></div>
              <div class="be-col-3 be-col-8">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="sodachk" name="data[CharterGuestBeveragePreference][soda_items][]" value="4" <?php echo $sodaItemsChecked[4]; ?>>
                <label class="pdd-none"><span class="sp-lab">Ginger Ale</span></label>
              </div></div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="sodachk" name="data[CharterGuestBeveragePreference][soda_items][]" value="5" <?php echo $sodaItemsChecked[5]; ?>>
                <label class="pdd-none"><span class="sp-lab">Fanta</span></label>
              </div></div>
               <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="sodachk" name="data[CharterGuestBeveragePreference][soda_items][]" value="6" <?php echo $sodaItemsChecked[6]; ?>>
                <label class="pdd-none"><span class="sp-lab">Pepsi</span></label>
              </div></div>

              <div>
                <label class="pdd-none mrg-label">Other</label>
              </div>
              <div class="col-md-12 col-sm-12 ipad-bev pl-none pl-25 md-input-row">
              <?php echo $this->Form->input("soda_comments1",array("label"=>false,'class'=>'form-control','type' => 'text')); ?>
            </div> 
            </div>
            <div class="col-md-3 col-sm-3 ipad-bev pdd-none pl-25">
               <label class="pdd-none mrg-label">SODA</label>
               <div class="be-col-3 be-col-8">
              <div class="checkbox bev-chbox">
              <input type="checkbox" class="sodachk" name="data[CharterGuestBeveragePreference][soda_items][]" value="7" <?php echo $sodaItemsChecked[7]; ?>>
                <label class="pdd-none"><span class="sp-lab">Club Soda</span></label>
              </div></div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="sodachk" name="data[CharterGuestBeveragePreference][soda_items][]" value="8" <?php echo $sodaItemsChecked[8]; ?>>
                <label class="pdd-none"><span class="sp-lab">Tonic</span></label>
              </div></div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">  
               <input type="checkbox" class="sodachk" name="data[CharterGuestBeveragePreference][soda_items][]" value="9" <?php echo $sodaItemsChecked[9]; ?>>
                <label class="pdd-none"><span class="sp-lab">Red Bull</span></label>
              </div></div>
              <div class="be-col-3 be-col-8">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="sodachk" name="data[CharterGuestBeveragePreference][soda_items][]" value="10" <?php echo $sodaItemsChecked[10]; ?>>
                <label class="pdd-none"><span class="sp-lab">Root Beer</span></label>
              </div>
              </div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="sodachk" name="data[CharterGuestBeveragePreference][soda_items][]" value="11" <?php echo $sodaItemsChecked[11]; ?>>
                <label class="pdd-none">Orangina</label>
              </div></div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="sodachk" name="data[CharterGuestBeveragePreference][soda_items][]" value="12" <?php echo $sodaItemsChecked[12]; ?>>
                <label class="pdd-none"><span class="sp-lab">Ice tea</span></label>
              </div></div>
                <div>
                <input type="hidden" name="data[CharterGuestBeveragePreference][soda_hidden][]" id="soda_hidden" value="" />
                <label class="pdd-none mrg-label">Other</label>
              </div>
                  <div class="col-md-12 col-sm-12 ipad-bev pl-none md-input-row">
              <?php echo $this->Form->input("soda_comments2",array("label"=>false,'class'=>'form-control','type' => 'text')); ?>
            </div>
            </div>
            <div class="col-md-3 col-sm-3 ipad-bev pdd-none pl-25">
                <label class="mrg-label">JUICE</label>
                <div class="be-col-3 be-col-8">
              <div class="checkbox bev-chbox">
              <input type="checkbox" class="juicechk" name="data[CharterGuestBeveragePreference][juice_items][]" value="1" <?php echo $juiceItemsChecked[1]; ?>>
                <label class="pdd-none"><span class="sp-lab">Grapefruit</span></label>
              </div></div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="juicechk" name="data[CharterGuestBeveragePreference][juice_items][]" value="2" <?php echo $juiceItemsChecked[2]; ?>>
                <label class="pdd-none"><span class="sp-lab">Fanta</span></label>
              </div></div>
                <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="juicechk" name="data[CharterGuestBeveragePreference][juice_items][]" value="3" <?php echo $juiceItemsChecked[3]; ?>>
                <label class="pdd-none"><span class="sp-lab">Apple</span></label>
              </div> </div>
              <div class="be-col-3 be-col-8">
               <div class="checkbox bev-chbox">
               <input type="checkbox"class="juicechk"  name="data[CharterGuestBeveragePreference][juice_items][]" value="4" <?php echo $juiceItemsChecked[4]; ?>>
                <label class="pdd-none"> <span class="sp-lab">Pineapple</span></label>
              </div>
              </div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">  
               <input type="checkbox" class="juicechk" name="data[CharterGuestBeveragePreference][juice_items][]" value="5" <?php echo $juiceItemsChecked[5]; ?>>
                <label class="pdd-none"><span class="sp-lab">Tomato</span></label>
              </div></div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">  
               <input type="checkbox" class="juicechk" name="data[CharterGuestBeveragePreference][juice_items][]" value="6" <?php echo $juiceItemsChecked[6]; ?>>
                <label class="pdd-none"><span class="sp-lab">Carrot</span></label>
              </div></div>
              <input type="hidden" name="data[CharterGuestBeveragePreference][juicehidden][]" id="juicehidden" value="" />
              <div>
                <label class="pdd-none mrg-label">Other</label>
              </div>
              <div class="col-md-12 col-sm-12 ipad-bev pl-none md-input-row">
              <?php echo $this->Form->input("juice_comments",array("label"=>false,'class'=>'form-control','type' => 'text')); ?>
            </div>
            </div>
            <div class="col-md-3 col-sm-3  ipad-bev pdd-none pl-25">

              <label class="pdd-none mrg-label">WATER</label>
               <div class="be-col-3 be-col-8">
              <div class="checkbox bev-chbox">
              <input type="checkbox" class="waterchk" name="data[CharterGuestBeveragePreference][water_items][]" value="1" <?php echo $waterItemsChecked[1]; ?>>
                <label class="pdd-none"><span class="sp-lab">Mineral</span></label>
              </div></div>
               <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="waterchk" name="data[CharterGuestBeveragePreference][water_items][]" value="2" <?php echo $waterItemsChecked[2]; ?>>
                <label class="pdd-none"><span class="sp-lab">Sparkling</span></label>
              </div></div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">  
               <input type="checkbox" class="waterchk" name="data[CharterGuestBeveragePreference][water_items][]" value="3" <?php echo $waterItemsChecked[3]; ?>>
                <label class="pdd-none"><span class="sp-lab">Still</span></label>
              </div></div>
               <div class="be-col-3 be-col-8">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="waterchk"  name="data[CharterGuestBeveragePreference][water_items][]" value="4" <?php echo $waterItemsChecked[4]; ?>>
                <label class="pdd-none"><span class="sp-lab">Coconut</span></label>
              </div></div>
              <div class="be-col-3 be-col-sm-2">
               <div class="checkbox bev-chbox">
               <input type="checkbox" class="waterchk" name="data[CharterGuestBeveragePreference][water_items][]" value="5" <?php echo $waterItemsChecked[5]; ?>>
                <label class="pdd-none"><span class="sp-lab">Infused</span></label>
              </div></div>
              <input type="hidden" name="data[CharterGuestBeveragePreference][water_hidden][]" id="water_hidden" value="" />
              <div>
                <div class="md-mrg-equal"></div>
                <label class="pdd-none mrg-label">Other</label>
              </div>
              <div class="col-md-12 col-sm-12 pl-none md-input-row">
              <?php echo $this->Form->input("water_comments",array("label"=>false,'class'=>'form-control','type' => 'text')); ?>
            </div>

            </div>
            <div class="clearfix"></div>
            <hr class="divider divmar">
            
        <?php 
            /*foreach ($beverageTypes as $typeId => $typeName) { 
            
                $selectedValue1 = $selectedValue2 = $selectedValue3 = $selectedValue4 = 0;
                $alcoholicComments = " ";
                $options = array();
                $optionsList1 = "<option value='0'>Select Item</option>";
                $optionsList2 = "<option value='0'>Select Item</option>";
                $optionsList3 = "<option value='0'>Select Item</option>";
                $optionsList4 = "<option value='0'>Select Item</option>";
                //$options[0] = "Select Item";
                if (!empty($beverageItems[$typeId])) {
                    foreach ($beverageItems[$typeId] as $item) {
                        //$options[$item['id']] = ucwords(strtolower(stripslashes($item['item_name'])));
                        if (in_array($item['id'], $alcoholicItemsEmptyAssoc1)) {
                            //$selectedValue1 = $item['id'];
                            $optionsList1 .= "<option value='".$item['id']."' selected>".ucwords(strtolower(stripslashes($item['item_name'])))."</option>";
                        } else {
                            $optionsList1 .= "<option value='".$item['id']."'>".ucwords(strtolower(stripslashes($item['item_name'])))."</option>";
                        }
                        if (in_array($item['id'], $alcoholicItemsEmptyAssoc2)) {
                            //$selectedValue2 = $item['id'];
                            $optionsList2 .= "<option value='".$item['id']."' selected>".ucwords(strtolower(stripslashes($item['item_name'])))."</option>";
                        } else {
                            $optionsList2 .= "<option value='".$item['id']."'>".ucwords(strtolower(stripslashes($item['item_name'])))."</option>";
                        }
                        if (in_array($item['id'], $alcoholicItemsEmptyAssoc3)) {
                            //$selectedValue3 = $item['id'];
                            $optionsList3 .= "<option value='".$item['id']."' selected>".ucwords(strtolower(stripslashes($item['item_name'])))."</option>";
                        } else {
                            $optionsList3 .= "<option value='".$item['id']."'>".ucwords(strtolower(stripslashes($item['item_name'])))."</option>";
                        }
                        if (in_array($item['id'], $alcoholicItemsEmptyAssoc4)) {
                            //$selectedValue4 = $item['id'];
                            $optionsList4 .= "<option value='".$item['id']."' selected>".ucwords(strtolower(stripslashes($item['item_name'])))."</option>";
                        } else {
                            $optionsList4 .= "<option value='".$item['id']."'>".ucwords(strtolower(stripslashes($item['item_name'])))."</option>";
                        }
                    }
                }
                
                // Unit types
                $unit = $unitTypes[3]; // Rmaining all
                if ($typeName == 'Beer') {
                    $unit = $unitTypes[1];
                } else if ($typeName == 'Cider') {
                    $unit = $unitTypes[2];
                }*/
        ?>
            
<!--      <input type="hidden" name="data[CharterGuestBeveragePreference][alcoholic_types][]" value="<?php //echo $typeId; ?>">     
        

            <div class="col-md-12 pdd-none">
              <div class="col-md-2 col-sm-2 pdd-none">
              <label><?php //echo $typeName; ?></label>
              </div>
              <div class="col-md-1 col-sm-2">Qty</div>
              <div class="col-md-1 col-sm-2">Unit</div>
              <div class="col-md-2 col-sm-2"> <label><?php //echo $typeName; ?></label></div>
			  <div class="col-md-1 col-sm-2">Qty</div>
			  <div class="col-md-1 col-sm-2">Unit</div>
              <div class="col-md-2 col-sm-2 text-center">
              <label class=" ">Other</label>
              </div>
			<div class="col-md-1 col-sm-2">Qty</div>
			<div class="col-md-1 col-sm-2">Unit</div>
            </div>
 			<div class="clearfix"></div>
			    <div class="col-md-2 col-sm-2 pdd-none">
				   <div class="form-group">
                    <select class="form-control" name="data[CharterGuestBeveragePreference][alcoholic_items1][]" value="<?php //echo $selectedValue1; ?>">
                        <?php //echo $optionsList1; ?>
                    </select>
                   </div>
			    </div>
			    <div class="col-md-1 col-sm-2 px">
					<div class="form-group " >
                                            <input type="text" class="form-control numericInput" name="data[CharterGuestBeveragePreference][quantity1][]" value="<?php //echo $quantityList1[$typeId]; ?>">	
					</div>
			    </div>
			  	<div class="col-md-1 col-sm-2 pr-20 pl-2">
					<div class="form-group">
                                            <input type="text" class="form-control units" value="<?php //echo $unit; ?>" readonly="true">	
					</div>
			    </div>
			  <div class="col-md-2 col-sm-2 pdd-none">
				   <div class="form-group">
                    <select class="form-control" name="data[CharterGuestBeveragePreference][alcoholic_items2][]" value="<?php //echo $selectedValue2; ?>">
                        <?php echo $optionsList2; ?>
                    </select>
                   </div>
			    </div>
			  <div class="col-md-1 col-sm-2 px">
				<div class="form-group " >
                                    <input type="text" class="form-control numericInput" name="data[CharterGuestBeveragePreference][quantity2][]" value="<?php //echo $quantityList2[$typeId]; ?>">	
				</div>
			  </div>
			  <div class="col-md-1 col-sm-2 pr-20 pl-2">
				<div class="form-group">
                                    <input type="text" class="form-control units" value="<?php //echo $unit; ?>" readonly="true">	
				</div>
			  </div>
			  <div class="col-md-2 col-sm-2 pdd-none">
				   <div class="form-group">
                    <input type="text" class="form-control alcoholicComments" name="data[CharterGuestBeveragePreference][alcoholic_comments][]" value="<?php //echo $alcoholicTypesEmptyAssoc[$typeId]; ?>">
                    
                   </div>
			    </div>
			  <div class="col-md-1 col-sm-2 px">
				<div class="form-group " >
                                    <input type="text" class="form-control numericInput" name="data[CharterGuestBeveragePreference][quantity3][]" value="<?php //echo $quantityList3[$typeId]; ?>">		
				</div>
			  </div>
			  <div class="col-md-1 col-sm-2 pr-20 pl-2">
				<div class="form-group">
                                    <input type="text" class="form-control" value="<?php //echo $unit; ?>" readonly="true">	
				</div>
			  </div>-->
			
            <?php //} ?>            
			  
          </div>  
          
        <div class="form-group frmgrp-mar">
            <div class="col-sm-12">
                <div class="col-sm-4"></div> 
                <div class="col-sm-4">
                    <?php if (!isset($charterAssocIdByHeaderView)) { ?>
                        <?php echo $this->Form->submit("Save and Continue", array('class' => 'btn btn-success lastbutton'));?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php echo $this->Form->end(); ?></div>   </div></div>
</div>

<script>
    $(document).on("keypress", ".alcoholicComments", function (e) {
        if (e.which == 94) { // Restricting the ^ symbol due to concatinating the comments with delimiter ^
            return false;
        }
    });
    //Juicecheckbox selected and unselected
    $(".juicechk").click(function () {
        var i=0;
        var cbox=[]; 
            $(".juicechk").each(function () {
                if($(this).is(':checked')) {
                    cbox[i++] = $(this).val();
              }else{
                    cbox[i++] = "unchecked";
              }
            });
            //console.log(cbox);
            $("#juicehidden").val(cbox);
              i = 0;
               
     });

     //Watercheckbox selected and unselected
    $(".waterchk").click(function () {
        var w=0;
        var water=[]; 
            $(".waterchk").each(function () {
                if($(this).is(':checked')) {
                  water[w++] = $(this).val();
              }else{
                  water[w++] = "unchecked";
              }
            });
            //console.log(cbox);
            $("#water_hidden").val(water);
              w = 0;
               
     });
     //coffeecheckbox selected and unselected
    $(".coffeechk").click(function () {
        var c=0;
        var coffee=[]; 
            $(".coffeechk").each(function () {
                if($(this).is(':checked')) {
                  coffee[c++] = $(this).val();
              }else{
                  coffee[c++] = "unchecked";
              }
            });
            //console.log(cbox);
            $("#coffee_hidden").val(coffee);
              c = 0;
               
     });
     //teacheckbox selected and unselected
    $(".teachk").click(function () {
        var t=0;
        var tea=[]; 
            $(".teachk").each(function () {
                if($(this).is(':checked')) {
                  tea[t++] = $(this).val();
              }else{
                  tea[t++] = "unchecked";
              }
            });
            //console.log(cbox);
            $("#tea_hidden").val(tea);
              t = 0;
               
     });
     //milkcheckbox selected and unselected
    $(".milkchk").click(function () {
        var m=0;
        var milk=[]; 
            $(".milkchk").each(function () {
                if($(this).is(':checked')) {
                  milk[m++] = $(this).val();
              }else{
                  milk[m++] = "unchecked";
              }
            });
            //console.log(cbox);
            $("#milk_hidden").val(milk);
              m = 0;
               
     });
     //sodacheckbox selected and unselected
    $(".sodachk").click(function () {
        var s=0;
        var soda=[]; 
            $(".sodachk").each(function () {
                if($(this).is(':checked')) {
                  soda[s++] = $(this).val();
              }else{
                  soda[s++] = "unchecked";
              }
            });
            //console.log(cbox);
            $("#soda_hidden").val(soda);
              s = 0;
               
     });
</script>
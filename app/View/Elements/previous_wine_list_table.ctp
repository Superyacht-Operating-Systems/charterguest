
<style>
	   .cart-table {
  height: inherit;
  color: #333;
  }
.th-md50 {
  width: 50%;
}
.th-md20 {
  width: 10%;
}
tbody tr .th-md50{
    
    text-align:left!important;
}

@media screen and (max-width: 500px) and (min-width: 375px){
    .th-md50 {
  width: 62%;
}
.th-md10 {
  width: 20%;
}
}
@media screen and (max-width: 767px) and (min-width: 499px){
    .th-md50 {
  width: 68%;
}
.th-md10 {
  width: 15%;
}
}
@media only screen and (max-width: 767px){

.th-md20 {
  width: 15%;
}
/* .th-md10 {
  width: 17%;
} */
.modal-body {
  padding-left: 5px!important;
  padding-right: 5px!important;
}

}

</style>


<div class="tenrows chart-wine-row">
    <table class="table cart-table chart-wine-row" id="selectedWineListTableId">
    <thead>
        <tr>
            <th class="text-center th-md10">Bottles</th>
            <th class="th-md50 " style="padding-left:2px">Wine</th>
            <th class="text-center th-md20 th-md-none">Type</th>
            <th class="text-center th-md20 th-md-none">Vintage</th>
            <th class="th-md20 th-md-none">Rating</th>
            <th class="th-md20"></th>
            
        </tr>
    </thead>  
    <tbody>
        <!-- Wine list from Existing preferences -->
        <?php foreach ($winePreferences as $preferenceItem) { ?>
            <tr>
                <td class="th-md10 text-center">
                    <div class="">
                        <?php
                            $colorName = "nontype";
                            if (!empty($preferenceItem['CharterGuestWinePreference']['color'])) {
                                $colorName = strtolower($preferenceItem['CharterGuestWinePreference']['color']);
                            }
                        ?>
                        <input type="hidden" name="data[CharterGuestWinePreference][wine_preference_id][]" value="<?php echo $preferenceItem['CharterGuestWinePreference']['id']; ?>">
                        <input type="hidden" name="data[CharterGuestWinePreference][wine_id][]" value="<?php echo $preferenceItem['CharterGuestWinePreference']['wine_list_id']; ?>">
                        <input type="text" name="data[CharterGuestWinePreference][wine_quantity][]" value="<?php echo $preferenceItem['CharterGuestWinePreference']['quantity']; ?>" readonly class="form-control numericInput "style="border-radius: 0px;
    border: none !important;
    border-top: solid 1.5px rgba(2, 2, 2, 0.40) !important;
    border-left: solid 1.5px rgba(2, 2, 2, 0.40) !important;
    background: rgba(241, 235, 235, 0.76) !important;
    border-bottom: solid 1.5px #fff !important;
    border-right: solid 1.5px #fff !important;color: #000 !important;
    text-align: center;" >  
                    </div>
                </td>
                <td class="text-center th-md50"><?php echo $preferenceItem['CharterGuestWinePreference']['wine']; ?></td>
                <td class="text-center th-md20 th-md-none"><?php echo $preferenceItem['CharterGuestWinePreference']['color']; ?></td>
                <td class="th-md20 text-center th-md-none"><?php echo $preferenceItem['CharterGuestWinePreference']['vintage']; ?></td>
                <td class="th-md20 text-center th-md-none"><?php echo $preferenceItem['CharterGuestWinePreference']['score']; ?></td>
                 <td class="th-md20  text-center"><button class="btn btn-primary addPreviousWineToCart" style="line-height: 0.8;border-radius: 12px;" data-winelistid="<?php echo $preferenceItem['CharterGuestWinePreference']['wine_list_id']; ?>" data-quantity="<?php echo $preferenceItem['CharterGuestWinePreference']['quantity']; ?>" title="Add to Selection Cart"> Select </button></td>
                
            </tr>
        <?php } ?>
        <!-- Wine list from Selection cart -->
        <?php /*foreach ($selectionCartData as $cartItem) { ?>
            <tr>
                 <td class="th-md-20">
                    <div class="">
                        <?php
                            $colorName = "nontype";
                            if (!empty($cartItem['WineList']['color'])) {
                                $colorName = strtolower($cartItem['WineList']['color']);
                            }
                        ?>
                        <input type="hidden" name="data[CharterGuestWinePreference][wine_preference_id][]" value="">
                        <input type="hidden" name="data[CharterGuestWinePreference][wine_id][]" value="<?php echo $cartItem['WineList']['id']; ?>">
                        <input type="text" name="data[CharterGuestWinePreference][wine_quantity][]" class="form-control numericInput ">   
                    </div>
                </td>
                <td class="text-center th-md50"><?php echo $cartItem['WineList']['wine']; ?></td>
                <td class="text-center th-md-20 th-md-none"><?php echo $cartItem['WineList']['color']; ?></td>
                <td class="text-center th-md-20 th-md-none"><?php echo $cartItem['WineList']['vintage']; ?></td>
                <td class="text-center th-md-20 th-md-none"><?php echo $cartItem['WineList']['score']; ?></td>
                <td class="th-md10"><button class="btn btn-primary addPreviousWineToCart"  style="line-height: 0.8;border-radius: 12px;" title="Add to Selection Cart"> Select </button></td>
            </tr>
        <?php } */?>    
    </tbody>
</table>
</div>
<hr style="margin-top: 0px;margin-bottom: 5px;">
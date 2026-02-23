<!--- -->
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

<div class="tenrows">
    <table class="table cart-table" id="">
    <thead>
        <tr>
            <th class="text-center th-md10">Bottles</th>
            <th class="th-md50" style="padding-left:2px">Product Name</th>
            <th class="text-center th-md20 th-md-none">Type</th>
            <th class="text-center th-md20 th-md-none">Category</th>
            <th class="th-md20"></th>
            
        </tr>
    </thead>    
    <tbody>
        <!-- Product list from Existing preferences -->
        <?php foreach ($spiritPreferences as $preferenceItem) { ?>
            <tr>
                <td class="th-md10">
                    <div class="">
                        <?php
                            $typeName = "nontype";
                            if (!empty($preferenceItem['CharterGuestSpiritPreference']['primary_category'])) {
                                $typeName = array_search($preferenceItem['CharterGuestSpiritPreference']['primary_category'], $typeList);
                            }
                        ?>
                        <input type="hidden" name="data[CharterGuestSpiritPreference][product_preference_id][]" value="<?php echo $preferenceItem['CharterGuestSpiritPreference']['id']; ?>">
                        <input type="hidden" name="data[CharterGuestSpiritPreference][product_id][]" value="<?php echo $preferenceItem['CharterGuestSpiritPreference']['product_list_id']; ?>">
                        <input type="text" name="data[CharterGuestSpiritPreference][product_quantity][]" value="<?php echo $preferenceItem['CharterGuestSpiritPreference']['quantity']; ?>" readonly  class="form-control numericInput text-center" style="border-radius: 0px;
    border: none !important;
    border-top: solid 1.5px rgba(2, 2, 2, 0.40) !important;
    border-left: solid 1.5px rgba(2, 2, 2, 0.40) !important;
    background: rgba(241, 235, 235, 0.76) !important;
    border-bottom: solid 1.5px #fff !important;
    border-right: solid 1.5px #fff !important;color: #000 !important;text-align: center;" data-typeClass="type_<?php echo $typeName; ?>"> 
                    </div>
                </td>
                <td class="th-md50"><?php echo $preferenceItem['CharterGuestSpiritPreference']['name']; ?></td>
                <td class="text-center th-md20 th-md-none"><?php echo $preferenceItem['CharterGuestSpiritPreference']['primary_category']; ?></td>
                <td class="text-center th-md20 th-md-none"><?php echo $preferenceItem['CharterGuestSpiritPreference']['secondary_category']; ?></td>
               <td class="th-md20 text-center"><button class="btn btn-primary addtocartselectedBeer" style="line-height: 0.8;border-radius: 12px;" data-productid="<?php echo $preferenceItem['CharterGuestSpiritPreference']['product_list_id']; ?>" data-quantity="<?php echo $preferenceItem['CharterGuestSpiritPreference']['quantity']; ?>"  title="Add to Selection Cart"> Select </button></td>

            </tr>
        <?php } ?>
        <!-- Wine list from Selection cart -->
        <?php /*foreach ($productSelectionCartData as $cartItem) { ?>
            <tr>
             <td class="th-md20">
                    <div class="">
                        <?php
                            $typeName = "nontype";
                            if (!empty($cartItem['ProductList']['primary_category'])) {
                                $typeName = array_search($cartItem['ProductList']['primary_category'], $typeList);
                            }
                        ?>
                        <input type="hidden" name="data[CharterGuestSpiritPreference][product_preference_id][]" value="">
                        <input type="hidden" name="data[CharterGuestSpiritPreference][product_id][]" value="<?php echo $cartItem['ProductList']['id']; ?>">
                        <input type="text" name="data[CharterGuestSpiritPreference][product_quantity][]" class="form-control numericInput productQuantity text-center type_<?php echo $typeName; ?>" data-typeClass="type_<?php echo $typeName; ?>">    
                    </div>
                </td>
                <td class="text-center th-md50"><?php echo $cartItem['ProductList']['name']; ?></td>
                <td class="text-center th-md20 th-md-none"><?php echo $cartItem['ProductList']['primary_category']; ?></td>
                <td class="text-center th-md20 th-md-none"><?php echo $cartItem['ProductList']['secondary_category']; ?></td>
                <td class="text-center th-md20"><button class="btn btn-primary " title="Add to Selection Cart" style="line-height: 0.8;border-radius: 12px;"> Select </button></td>
            </tr>
        <?php }*/ ?>    
    </tbody>
</table>
<span id="prevbeeralert" style="text-align:center;font-size:12px;color:red;"></span>
</div>
<hr style="    margin-top: 0px;margin-bottom: 5px;">
		  
<br>
<button class="btn btn-primary addpreviousselectedprogram" style="line-height: 0.8;border-radius: 12px;margin-left: 300px;"> Add </button>
<?php //echo $this->Form->end(); ?>





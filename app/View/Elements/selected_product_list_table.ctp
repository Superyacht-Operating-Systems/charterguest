<?php 
$session = $this->Session->read();
$charterAssocIdByHeaderEdit = $this->Session->read('charterAssocIdByHeaderEdit');
?>

<?php echo $this->Form->create('CharterGuestSpiritPreference', array('url' => array('controller' => 'charters','action' => 'preference'),'id'=>'spiritPreferenceForm'));     
    // When main Head charterer opens other guest(if Head charterer checked) and Update the Preference sheets
    if (isset($charterAssocIdByHeaderEdit) && !empty($charterAssocIdByHeaderEdit)) {
        echo $this->Form->hidden("charterAssocIdByHeaderEdit", array('value' => $charterAssocIdByHeaderEdit));
    }
 ?>

<div class="tenrows">
    <table class="table cart-table" id="selectedProductListTableId">
    <thead>
        <tr>
            <th class="text-center th-md-20">Bottles</th>
            <th class="th-md-50">Product Name</th>
            <th class="text-center th-md-20 th-md-none">Type</th>
            <th class="text-center th-md-20 th-md-none">Category</th>
            <th class="th-md-20"></th>
            
        </tr>
    </thead>    
    <tbody>
        <!-- Product list from Existing preferences -->
        <?php foreach ($spiritPreferences as $preferenceItem) { ?>
            <tr>
                <td class="th-md-20">
                    <div class="">
                        <?php
                            $typeName = "nontype";
                            if (!empty($preferenceItem['CharterGuestSpiritPreference']['primary_category'])) {
                                $typeName = array_search($preferenceItem['CharterGuestSpiritPreference']['primary_category'], $typeList);
                            }
                        ?>
                        <input type="hidden" name="data[CharterGuestSpiritPreference][product_preference_id][]" value="<?php echo $preferenceItem['CharterGuestSpiritPreference']['id']; ?>">
                        <input type="hidden" name="data[CharterGuestSpiritPreference][product_id][]" value="<?php echo $preferenceItem['CharterGuestSpiritPreference']['product_list_id']; ?>">
                        <input type="text" name="data[CharterGuestSpiritPreference][product_quantity][]" value="<?php echo $preferenceItem['CharterGuestSpiritPreference']['quantity']; ?>" class="form-control numericInput productQuantity text-center type_<?php echo $typeName; ?>" data-typeClass="type_<?php echo $typeName; ?>"> 
                    </div>
                </td>
                <td class="text-center th-md-50"><?php echo $preferenceItem['CharterGuestSpiritPreference']['name']; ?></td>
                <td class="text-center th-md-20 th-md-none"><?php echo $preferenceItem['CharterGuestSpiritPreference']['primary_category']; ?></td>
                <td class="text-center th-md-20 th-md-none"><?php echo $preferenceItem['CharterGuestSpiritPreference']['secondary_category']; ?></td>
               <td class="th-md-20 text-center"><?php echo $this->Html->link($this->Html->image("admin/inactive.png", array("alt" => "Delete","title" => "Delete")),"javascript:void(0);",array('escape' =>false, 'class' => 'removeProductFromPreference', 'data-productPrefId' => $preferenceItem['CharterGuestSpiritPreference']['id'])); ?></td>

            </tr>
        <?php } ?>
        <!-- Wine list from Selection cart -->
        <?php foreach ($productSelectionCartData as $cartItem) { ?>
            <tr>
             <td class="th-md-20">
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
                <td class="text-center th-md-50"><?php echo $cartItem['ProductList']['name']; ?></td>
                <td class="text-center th-md-20 th-md-none"><?php echo $cartItem['ProductList']['primary_category']; ?></td>
                <td class="text-center th-md-20 th-md-none"><?php echo $cartItem['ProductList']['secondary_category']; ?></td>
                                <td class="text-center th-md-20"><?php echo $this->Html->link($this->Html->image("admin/inactive.png", array("alt" => "Delete","title" => "Delete")),"javascript:void(0);",array('escape' =>false, 'class' => 'removeProductFromCart', 'data-productListId' => $cartItem['ProductList']['id'])); ?></td>
            </tr>
        <?php } ?>    
    </tbody>
</table>
</div>
<hr style="    margin-top: 0px;margin-bottom: 5px;">
<?php
    // Check/Uncheck the Quotation checkbox
    $checkedStatus = "";
    if (!empty($charterAssocData)) { // IF Charter associate
        $checkedStatus = ($charterAssocData['CharterGuestAssociate']['send_spirit_quotation']) ? "checked" : "";
    } else if (!empty($charterGuestData)) { // IF Charter associate
        $checkedStatus = ($charterGuestData['CharterGuest']['send_spirit_quotation']) ? "checked" : "";
    }
    
?>
         <div class="col-xs-5 col-sm-5 col-md-4 md-xs-32">
          <table class="table cart-total" id="totalProductQuantityTableId">
                        <?php foreach ($typeList as $key => $type) { ?>
                            <tr>
                                    <th>Total <?php echo !empty($type) ? $type : 'Non-type'; ?></th>  
                                    <td class="al-cent totalTypeQuantity type_<?php echo $key; ?>" data-typeClass="type_<?php echo $key; ?>">0</td>
                                    <td class="al-cent">Bottles</td>
                            </tr>
                        <?php } ?>    
            <tr>
                <th>Total Quantity</th>  
                                <td id="totalProductQuantity" class="al-cent">0</td>
                <td class="al-cent">Bottles</td>
            </tr>
             </table>
          </div>
		  <div class="col-xs-7 col-sm-7 col-md-8 md-xs-32">
		  <p class="aligh-text-center"><b>A representative from yacht will contact you if any of your selections are unavailable.</b></p>
			  <p class="aligh-text-center"><b>Tick the box if you would like a quotation</b></p>
		
			  <div class="check-column-md">
					<label class="" style="">Send Quotation</label>
                      <input type="checkbox" class="contact_input check_big check-box-div" value="1" style="zoom:1.2" name="data[CharterGuestSpiritPreference][send_spirit_quotation]" <?php echo $checkedStatus; ?>>
                  </div>
		  </div>
<!--                 <div class="col-md-3 fle-logo-img">
        <img src="<?php echo isset($session['fleetLogoUrl']) ? $session['fleetLogoUrl'] : ""; ?>" alt="">
        </div> -->

                            <div class="btn-inline">
                                    <div class="text-left"><span id="generateProductOrderPdf" class="btn btn-primary h-35" >Save order as PDF</span></div>
                    <!--<button class="btn btn-info">Submit & Confirm</button>-->
                                    <?php if (!isset($charterAssocIdByHeaderView)) { ?>
                                        <?php echo $this->Form->submit("Save and Continue", array('class' => 'btn btn-success'));?>
                                    <?php } ?>
                
            
        </div>
		  
<br>
<?php echo $this->Form->end(); ?>





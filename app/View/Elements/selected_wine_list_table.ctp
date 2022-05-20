<?php 
$session = $this->Session->read();
$charterAssocIdByHeaderEdit = $this->Session->read('charterAssocIdByHeaderEdit');
?>

<?php echo $this->Form->create('CharterGuestWinePreference', array('url' => array('controller' => 'charters','action' => 'preference'),'id'=>'winePreferenceForm'));     
    // When main Head charterer opens other guest(if Head charterer checked) and Update the Preference sheets
    if (isset($charterAssocIdByHeaderEdit) && !empty($charterAssocIdByHeaderEdit)) {
        echo $this->Form->hidden("charterAssocIdByHeaderEdit", array('value' => $charterAssocIdByHeaderEdit));
    }
 ?>
<style>


 .check-column-md{
   display: flex;
    align-items: center;
 }   
    .check-box-div {
    top: -3.1px!important;
    margin-left: 10px!important;
}
@media only screen and (max-width: 767px){
.btn-inline {
    display: flex;
    width: 270px;
}
.h-35{
    height: 35px;
}
.charter-mod #generateWineOrderPdf {
    padding: 8px 7px;
}
.submit .btn{
padding: 8px 7px;
}
.submit {
    width: inherit;
    margin: 0 auto;
}
}

</style>


<div class="tenrows chart-wine-row">
    <table class="table cart-table chart-wine-row" id="selectedWineListTableId">
    <thead>
        <tr>
            <th class="text-center th-md-20">Bottles</th>
            <th class="th-md-50 text-center">Wine</th>
            <th class="text-center th-md-20 th-md-none">Type</th>
            <th class="text-center th-md-20 th-md-none">Vintage</th>
            <th class="th-md-20 th-md-none">Rating</th>
            <th class="th-md-10"></th>
            
        </tr>
    </thead>  
    <tbody>
        <!-- Wine list from Existing preferences -->
        <?php foreach ($winePreferences as $preferenceItem) { ?>
            <tr>
                <td class="th-md-20 text-center">
                    <div class="">
                        <?php
                            $colorName = "nontype";
                            if (!empty($preferenceItem['CharterGuestWinePreference']['color'])) {
                                $colorName = strtolower($preferenceItem['CharterGuestWinePreference']['color']);
                            }
                        ?>
                        <input type="hidden" name="data[CharterGuestWinePreference][wine_preference_id][]" value="<?php echo $preferenceItem['CharterGuestWinePreference']['id']; ?>">
                        <input type="hidden" name="data[CharterGuestWinePreference][wine_id][]" value="<?php echo $preferenceItem['CharterGuestWinePreference']['wine_list_id']; ?>">
                        <input type="text" name="data[CharterGuestWinePreference][wine_quantity][]" value="<?php echo $preferenceItem['CharterGuestWinePreference']['quantity']; ?>" class="form-control numericInput wineQuantity color_<?php echo $colorName; ?>" data-colorClass="color_<?php echo $colorName; ?>">  
                    </div>
                </td>
                <td class="text-center th-md-50"><?php echo $preferenceItem['CharterGuestWinePreference']['wine']; ?></td>
                <td class="text-center th-md-20 th-md-none"><?php echo $preferenceItem['CharterGuestWinePreference']['color']; ?></td>
                <td class="th-md-20 text-center th-md-none"><?php echo $preferenceItem['CharterGuestWinePreference']['vintage']; ?></td>
                <td class="th-md-20 text-center th-md-none"><?php echo $preferenceItem['CharterGuestWinePreference']['score']; ?></td>
                 <td class="th-md-10"><?php echo $this->Html->link($this->Html->image("admin/inactive.png", array("alt" => "Delete","title" => "Delete")),"javascript:void(0);",array('escape' =>false, 'class' => 'removeWineFromPreference', 'data-winePrefId' => $preferenceItem['CharterGuestWinePreference']['id'])); ?></td>
                
            </tr>
        <?php } ?>
        <!-- Wine list from Selection cart -->
        <?php foreach ($selectionCartData as $cartItem) { ?>
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
                        <input type="text" name="data[CharterGuestWinePreference][wine_quantity][]" class="form-control numericInput wineQuantity color_<?php echo $colorName; ?>" data-colorClass="color_<?php echo $colorName; ?>">   
                    </div>
                </td>
                <td class="text-center th-md-50"><?php echo $cartItem['WineList']['wine']; ?></td>
                <td class="text-center th-md-20 th-md-none"><?php echo $cartItem['WineList']['color']; ?></td>
                <td class="text-center th-md-20 th-md-none"><?php echo $cartItem['WineList']['vintage']; ?></td>
                <td class="text-center th-md-20 th-md-none"><?php echo $cartItem['WineList']['score']; ?></td>
                <td class="th-md-10"><?php echo $this->Html->link($this->Html->image("admin/inactive.png", array("alt" => "Delete","title" => "Delete")),"javascript:void(0);",array('escape' =>false, 'class' => 'removeWineFromCart', 'data-wineListId' => $cartItem['WineList']['id'])); ?></td>
            </tr>
        <?php } ?>    
    </tbody>
</table>
</div>
<hr style="margin-top: 0px;margin-bottom: 5px;">
<?php
    // Check/Uncheck the Quotation checkbox
    $checkedStatus = "";
    if (!empty($charterAssocData)) { // IF Charter associate
        $checkedStatus = ($charterAssocData['CharterGuestAssociate']['send_wine_quotation']) ? "checked" : "";
    } else if (!empty($charterGuestData)) { // IF Charter associate
        $checkedStatus = ($charterGuestData['CharterGuest']['send_wine_quotation']) ? "checked" : "";
    }
    
?>
		   <div class="">

         <div class="col-xs-5 col-sm-5 col-md-4 md-xs-32">
          <table class="table cart-total" id="totalQuantityTableId">
                        <?php foreach ($colorList as $color) { ?>
                            <tr>
                                    <th>Total <?php echo !empty($color) ? $color : 'Non-type'; ?></th>  
                                    <td class="al-cent totalColorQuantity color_<?php echo !empty($color) ? strtolower($color) : 'nontype'; ?>" data-colorClass="color_<?php echo !empty($color) ? strtolower($color) : 'nontype'; ?>">0</td>
                                    <td class="al-cent">Bottles</td>
                            </tr>
                        <?php } ?>    
            <tr>
                <th>Total Quantity</th>  
                <td id="totalWineQuantity" class="al-cent">0</td>
                <td class="al-cent">Bottles</td>
            </tr>
             </table>
          </div>
		  <div class="col-xs-7 col-sm-7 col-md-8 md-xs-32">
		  <p class="aligh-text-center"><b>A representative from yacht will contact you if any of your selections are unavailable.</b></p>
			  <p class="aligh-text-center"><b>Tick the box if you would like a quotation</b></p>
		
			  <div class="check-column-md">
					<label class="" style="">Send Quotation</label>
                      <input type="checkbox" class="contact_input check-box-div check_big" value="1" style="zoom:1.2" name="data[CharterGuestWinePreference][send_wine_quotation]" <?php echo $checkedStatus; ?>>
				    <!--<button class="btn btn-info">Submit & Confirm</button>-->
                                    
				</div>
		  </div>
<!--         <div class="col-md-3 fle-logo-img">
        <img src="<?php echo isset($session['fleetLogoUrl']) ? $session['fleetLogoUrl'] : ""; ?>" alt="">
        </div>  -->        
<div class="btn-inline">
        <div class="text-left"><span id="generateWineOrderPdf" class="btn btn-primary general-btn h-35" >Save order as PDF</span></div>


<?php if (!isset($charterAssocIdByHeaderView)) { ?>
                                        <?php echo $this->Form->submit("Save and Continue", array('class' => 'btn btn-success'));?>
                                    <?php } ?>
</div>        
		  
      </div>
<br>
<?php echo $this->Form->end(); ?>
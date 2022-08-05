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
	   .cart-table {
  height: inherit;
  color: #333;
  }
  .cart-total{
    color: #333;
  }
.general-btn {
    color: #fff;
background-color: #1eabfc;
border-color: #1eabfc;
font-size: 15px;
padding: 8px 14px!important;
font-weight: 700;
margin: 0px;
border-radius: 0px;
}
.submit .btn {
  padding: 8px 14px;
}
.th-md10 .form-control {
  background: #ffffff !important;
  color: #0e0d0d !important;
  border: solid 1px rgb(177 177 177 / 70%) !important;
}
  .th-md-5 {
  width: 5%;
}
      .th-md10 {
  width: 10%;
}
.th-md20 {
  width: 10%;
}
.th-md-60 {
    text-align: left;
  width: 60%;
}
/* .tb_align tbody td {
  vertical-align: top!important;
} */
.btnsave_st{
    padding-left: 0;
padding-right: 0;
}
.btnsave_st .btnleft_st, .btnsave_st .btnright_st{
    margin-top:10px;
}

.btnleft_st {
    float: left;
}
.btnright_st {
    float: right;
}
input[type="checkbox"] {
  margin: 0px 0 5px;
}
 .check-column-md{
   display: flex;
    align-items: center;
 }   
    .check-box-div {
    top: 0px!important;
    margin-left: 10px!important;
}
.submit {
  width: 170px;
  margin: 0px;
}
@media screen and (max-width: 440px) and (min-width: 375px) {
    .th-md10 {
  width: 20% !important;
}
}
@media screen and (max-width: 670px) and (min-width: 441px){
    .th-md10 {
  width: 15%!important;
}
}

@media only screen and (max-width: 768px){
    .modal-body{
        padding-left: 5px;
padding-right: 5px;
    }
    .check-box-div {
    top: 0px!important;
}
    .btnsave_st{
    padding-left: 8px;
padding-right: 8px;
}
    .th-md-5 {
  width: 5%;
}
    .th-md10 {
  width: 10%;
}
.th-md-60 {
  width: 80%;
}
.btn-inline {
    display: flex;
    width: 270px;
}
.general-btn {
margin-left: 10px;
}
}

</style>


<div class=" chart-wine-row">
    <table class="table cart-table chart-wine-row tb_align" id="selectedWineListTableId">
    <thead>
        <tr>
            <th class="text-center th-md10">Bottles</th>
            <th class="th-md-60">Wine</th>
            <th class="text-center th-md20 th-md-none">Type</th>
            <th class="text-center th-md20 th-md-none">Vintage</th>
            <th class="th-md20 th-md-none">Rating</th>
            <th class="th-md-5"></th>
            
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
                        <input type="text" name="data[CharterGuestWinePreference][wine_quantity][]" value="<?php echo $preferenceItem['CharterGuestWinePreference']['quantity']; ?>" class="form-control numericInput wineQuantity color_<?php echo $colorName; ?>" data-colorClass="color_<?php echo $colorName; ?>">  
                    </div>
                </td>
                <td class="th-md-60"><?php echo $preferenceItem['CharterGuestWinePreference']['wine']; ?></td>
                <td class="text-center th-md20 th-md-none"><?php echo $preferenceItem['CharterGuestWinePreference']['color']; ?></td>
                <td class="th-md20 text-center th-md-none"><?php echo $preferenceItem['CharterGuestWinePreference']['vintage']; ?></td>
                <td class="th-md20 text-center th-md-none"><?php echo $preferenceItem['CharterGuestWinePreference']['score']; ?></td>
                 <td class="th-md-5"><?php echo $this->Html->link($this->Html->image("admin/inactive.png", array("alt" => "Delete","title" => "Delete")),"javascript:void(0);",array('escape' =>false, 'class' => 'removeWineFromPreference', 'data-winePrefId' => $preferenceItem['CharterGuestWinePreference']['id'])); ?></td>
                
            </tr>
        <?php } ?>
        <!-- Wine list from Selection cart -->
        <?php foreach ($selectionCartData as $cartItem) { ?>
            <tr>
                 <td class="th-md10">
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
                <td class="th-md-60"><?php echo $cartItem['WineList']['wine']; ?></td>
                <td class="text-center th-md20 th-md-none"><?php echo $cartItem['WineList']['color']; ?></td>
                <td class="text-center th-md20 th-md-none"><?php echo $cartItem['WineList']['vintage']; ?></td>
                <td class="text-center th-md20 th-md-none"><?php echo $cartItem['WineList']['score']; ?></td>
                <td class="th-md-5"><?php echo $this->Html->link($this->Html->image("admin/inactive.png", array("alt" => "Delete","title" => "Delete")),"javascript:void(0);",array('escape' =>false, 'class' => 'removeWineFromCart', 'data-wineListId' => $cartItem['WineList']['id'])); ?></td>
            </tr>
        <?php } ?>    
    </tbody>
</table>
</div>
<hr style="margin-top: 0px;margin-bottom: 5px;">
<?php
    // Check/Uncheck the Quotation checkbox
    if (!empty($charterGuestData)) { 
        if($charterGuestData['CharterGuest']['send_wine_quotation'] == 1){
            $checkedStatus = "checked";
        }else{
            $checkedStatus = "";
        }
    }
    
?>
		   <div class="">

         <div class="col-xs-5 col-sm-5 col-md-4 md-xs-32" style="padding-left: 0;padding-right: 0;">
          <table class="table cart-total" id="totalQuantityTableId" style="margin-bottom: 10px;">
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
		  <p class="aligh-text-center"><b>A representative from the yacht will contact you if any of your selections are unavailable.</b></p>
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
    <div class="col-md-12 col-xs-12 btnsave_st" style="display:flex;justify-content: center;margin-top: 10px;">
        <?php if (!isset($charterAssocIdByHeaderView)) { ?>
                <?php echo $this->Form->submit("Save and Continue", array('class' => 'btn btn-success'));?>
        <?php } ?>   
        <span id="generateWineOrderPdf" class="btn btn-primary general-btn" >Save order as PDF</span>
    </div>        
		  
      </div>
<br>
<?php echo $this->Form->end(); ?>
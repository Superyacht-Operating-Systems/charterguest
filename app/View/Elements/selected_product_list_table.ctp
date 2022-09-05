<?php 
$session = $this->Session->read();
$charterAssocIdByHeaderEdit = $this->Session->read('charterAssocIdByHeaderEdit');
?>

<?php echo $this->Form->create('CharterGuestSpiritPreference', array('url' => array('controller' => 'charters','action' => 'preference'),'id'=>'spiritPreferenceForm'));     
    echo $this->Form->hidden("isgenerateProductOrderPdf", array('value' => false, 'id' => 'isgenerateProductOrderPdf'));
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
.table tbody > tr > .wordbreak {
    word-break: break-all;
}

</style>
<div class="">
    <table class="table cart-table tb_align" id="selectedProductListTableId">
    <thead>
        <tr>
            <th class="text-center th-md10">Bottles</th>
            <th class="th-md-60">Product Name</th>
            <th class="text-center th-md20 th-md-none">Type</th>
            <th class="text-center th-md20 th-md-none">Category</th>
            <th class="th-md-5"></th>
            
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
                        <input type="text" name="data[CharterGuestSpiritPreference][product_quantity][]" value="<?php echo $preferenceItem['CharterGuestSpiritPreference']['quantity']; ?>" class="form-control numericInput productQuantity text-center type_<?php echo $typeName; ?>" data-typeClass="type_<?php echo $typeName; ?>" maxlength="4"> 
                    </div>
                </td>
                <td class="th-md-60"><?php echo $preferenceItem['CharterGuestSpiritPreference']['name']; ?></td>
                <td class="text-center th-md20 th-md-none"><?php echo $preferenceItem['CharterGuestSpiritPreference']['primary_category']; ?></td>
                <td class="text-center th-md20 th-md-none"><?php echo $preferenceItem['CharterGuestSpiritPreference']['secondary_category']; ?></td>
               <td class="th-md-5"><?php echo $this->Html->link($this->Html->image("admin/inactive.png", array("alt" => "Delete","title" => "Delete")),"javascript:void(0);",array('escape' =>false, 'class' => 'removeProductFromPreference', 'data-productPrefId' => $preferenceItem['CharterGuestSpiritPreference']['id'])); ?></td>

            </tr>
        <?php } ?>
        <!-- Wine list from Selection cart -->
        <?php foreach ($productSelectionCartData as $cartItem) { ?>
            <tr>
             <td class="th-md10">
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
                <td class="th-md-60"><?php echo $cartItem['ProductList']['name']; ?></td>
                <td class="text-center th-md20 th-md-none"><?php echo $cartItem['ProductList']['primary_category']; ?></td>
                <td class="text-center th-md20 th-md-none"><?php echo $cartItem['ProductList']['secondary_category']; ?></td>
                                <td class="th-md-5"><?php echo $this->Html->link($this->Html->image("admin/inactive.png", array("alt" => "Delete","title" => "Delete")),"javascript:void(0);",array('escape' =>false, 'class' => 'removeProductFromCart', 'data-productListId' => $cartItem['ProductList']['id'])); ?></td>
            </tr>
        <?php } ?>    
    </tbody>
</table>
</div>
<hr style="    margin-top: 0px;margin-bottom: 5px;">
<?php
    // Check/Uncheck the Quotation checkbox
    //echo "<pre>";print_r($charterGuestData);
   if (!empty($charterGuestData)) {  
        if($charterGuestData['CharterGuest']['send_spirit_quotation'] == 1){ 
            $checkedStatus = "checked";
        }else{ 
            $checkedStatus = "";
        }
    }
    
?>
 <div class="">
         <div class="col-xs-5 col-sm-5 col-md-4 md-xs-32" style="padding-left: 0;padding-right: 0;">
          <table class="table cart-total" id="totalProductQuantityTableId" style="margin-bottom: 10px;">
                        <?php foreach ($typeList as $key => $type) { ?>
                            <tr>
                                    <th>Total <?php echo !empty($type) ? $type : 'Non-type'; ?></th>  
                                    <td class="al-cent totalTypeQuantity wordbreak type_<?php echo $key; ?>" data-typeClass="type_<?php echo $key; ?>">0</td>
                                    <td class="al-cent">Bottles</td>
                            </tr>
                        <?php } ?>    
            <tr>
                <th>Total Quantity</th>  
                                <td id="totalProductQuantity" class="al-cent wordbreak">0</td>
                <td class="al-cent">Bottles</td>
            </tr>
             </table>
          </div>
		  <div class="col-xs-7 col-sm-7 col-md-8 md-xs-32">
		  <p class="aligh-text-center"><b>A representative from the yacht will contact you if any of your selections are unavailable.</b></p>
			  <p class="aligh-text-center"><b>Tick the box if you would like a quotation</b></p>
		
			  <div class="check-column-md">
					<label class="" style="">Send Quotation</label>
                      <input type="checkbox" class="contact_input check_big check-box-div" value="1" style="zoom:1.2" name="data[CharterGuestSpiritPreference][send_spirit_quotation]" <?php echo $checkedStatus; ?>>
                  </div>
		  </div>
<!--                 <div class="col-md-3 fle-logo-img">
        <img src="<?php echo isset($session['fleetLogoUrl']) ? $session['fleetLogoUrl'] : ""; ?>" alt="">
        </div> -->
        <div class="col-md-12 col-xs-12 btnsave_st" style="display:flex;justify-content: center;margin-top: 10px;">
        <?php if (!isset($charterAssocIdByHeaderView)) { ?>
                                        <?php echo $this->Form->submit("Save and Continue", array('class' => 'btn btn-success'));?>
                                    <?php } ?>    
                                    <span id="generateProductOrderPdf" class="btn btn-primary general-btn" >Save order as PDF</span>
    </div>  

       
    </div>    
		  
<br>
<?php echo $this->Form->end(); ?>





<style>

@media only screen and (max-width:768px)
{
	.hide-sm-st{
	display:none;
}
.th-md-30{
width:80%;
}
.th-md-10{
width:20%;
}
}
</style>

<?php 
// $session = $this->Session->read();
// $charterAssocIdByHeaderEdit = $this->Session->read('charterAssocIdByHeaderEdit');
?>

<?php 
// echo $this->Form->create('CharterGuestSpiritPreference', array('url' => array('controller' => 'charters','action' => 'preference'),'id'=>'spiritPreferenceForm'));     
//     // When main Head charterer opens other guest(if Head charterer checked) and Update the Preference sheets
//     if (isset($charterAssocIdByHeaderEdit) && !empty($charterAssocIdByHeaderEdit)) {
//         echo $this->Form->hidden("charterAssocIdByHeaderEdit", array('value' => $charterAssocIdByHeaderEdit));
//     }
 ?>

<div class="tenrows">
    <table class="table cart-table" id="">
    <thead>
        <tr>
            <th class="th-md-30">Charter Name</th>
            <th class="text-center th-md-40 hide-sm-st">Start Location</th>
            <th class="text-center th-md-20 hide-sm-st">Date</th>
            <th class="text-center th-md-10">Actions</th>
            
        </tr>
    </thead>    
    <tbody>
        <!-- Product list from Existing preferences -->
        <?php 
        if(isset($charterProgramData) && !empty($charterProgramData)){
            foreach ($charterProgramData as $data) { ?>
            <tr>
                <td class="text-center th-md-30"><?php echo $data['CharterGuest']['charter_name']; ?></td>
                <td class="text-center th-md-40 hide-sm-st"><?php echo $data['CharterGuest']['embarkation']; ?></td>
                <td class="text-center th-md-20 hide-sm-st"><?php echo date('d M Y',strtotime($data['CharterGuest']['charter_from_date'])); ?></td>
                <th class="text-center th-md-10"><button class="btn btn-primary selectpreviousprogram" data-type="<?php echo $type; ?>" data-programuuid="<?php echo $data['CharterGuest']['charter_program_id']; ?>" style="line-height: 0.8;border-radius: 12px;"> Select </button></th>
            </tr>
        <?php }
        }else{  ?>
                <tr>
                    <td class="text-center th-md-30" colspan="4">No Records found</td>
                </tr>
        <?php } ?>
         
    </tbody>
</table>
</div>
<hr style="margin-top: 0px;margin-bottom: 5px;">

<br>
<?php //echo $this->Form->end(); ?>





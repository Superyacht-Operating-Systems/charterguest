<?php

?>
<table id="viewProductListTable">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Type</th>
            <th>Category</th>
            <th>Bottles</th>
        </tr>
    </thead>  
    <tbody>
        <!-- Spirit list from Existing preferences -->
        <?php foreach ($spiritPreferences as $preferenceItem) { ?>
            <tr>
                <td><?php echo $preferenceItem['CharterGuestSpiritPreference']['name']; ?></td>
                <td><?php echo $preferenceItem['CharterGuestSpiritPreference']['primary_category']; ?></td>
                <td><?php echo $preferenceItem['CharterGuestSpiritPreference']['secondary_category']; ?></td>
                <td><?php echo $preferenceItem['CharterGuestSpiritPreference']['quantity']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<hr>
<?php if (!empty($spiritPreferences)) { ?>
    <div class="">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <table class="table cart-total">
                <?php foreach ($typeCountList as $type => $sum) { ?>
                    <tr>
                            <th>Total <?php echo !empty($type) ? $type : 'Non-type'; ?></th>  
                            <td><?php echo $sum; ?></td>
                            <td>Bottles</td>
                    </tr>
                <?php } ?>    
                <tr>
                        <th>Total Quantity</th>  
                        <td><?php echo $totalProductQuantity; ?></td>
                        <td>Bottles</td>
                </tr>
            </table>
        </div>
        <div class="col-md-4"></div>
    </div>
<?php } ?>

<script>
// Data table
$("#viewProductListTable").dataTable({
    "bLengthChange": false,
    "bFilter": false
});
</script>
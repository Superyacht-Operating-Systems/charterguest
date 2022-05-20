<?php

?>
<table id="viewWineListTable">
    <thead>
        <tr>
            <th>Wine</th>
            <th>Type</th>
            <th>Vintage</th>
            <th>Rating</th>
            <th>Bottles</th>
        </tr>
    </thead>  
    <tbody>
        <!-- Wine list from Existing preferences -->
        <?php foreach ($winePreferences as $preferenceItem) { ?>
            <tr>
                <td><?php echo $preferenceItem['CharterGuestWinePreference']['wine']; ?></td>
                <td><?php echo $preferenceItem['CharterGuestWinePreference']['color']; ?></td>
                <td><?php echo $preferenceItem['CharterGuestWinePreference']['vintage']; ?></td>
                <td><?php echo $preferenceItem['CharterGuestWinePreference']['score']; ?></td>
                <td><?php echo $preferenceItem['CharterGuestWinePreference']['quantity']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<hr>
<?php if (!empty($winePreferences)) { ?>
    <div class="">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <table class="table cart-total">
                <?php foreach ($colorCountList as $color => $sum) { ?>
                    <tr>
                            <th>Total <?php echo !empty($color) ? $color : 'Non-type'; ?></th>  
                            <td><?php echo $sum; ?></td>
                            <td>Bottles</td>
                    </tr>
                <?php } ?>    
                <tr>
                        <th>Total Quantity</th>  
                        <td><?php echo $totalQuantity; ?></td>
                        <td>Bottles</td>
                </tr>
            </table>
        </div>
        <div class="col-md-4"></div>
    </div>
<?php } ?>

<script>
// Data table
$("#viewWineListTable").dataTable({
    "bLengthChange": false,
    "bFilter": false
});
</script>
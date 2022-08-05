<?php 
$session = $this->Session->read();
?>
<style type="text/css" >
    table.full-length {
        width:  100%;
    }
    .tablewidth{
        width: 670px;
    }
    .logo img {
        width: 90px;
        height: 90px;
    }
    .first{
        border-top: 1px solid red;
    }   
</style>
<table class="full-length">
    <tbody class="header-table">
        <tr border="1">
            <td width="150" border="0">
                <div class="logo">
                    <img src="<?php echo isset($session['fleetLogoUrl']) ? str_replace(' ', '%20', $session['fleetLogoUrl']) : ""; ?>" alt="">
                </div>
            </td>
            <td width="50"></td>
            <td width="470" align="left" border="0" colspan="" rowspan="" headers="">
                <h4><?php echo isset($session['charter_info']['CharterGuest']['yacht_name']) ? $session['charter_info']['CharterGuest']['yacht_name'] : ""; ?></h4>
                <h4><?php echo isset($session['charter_info']['CharterGuest']['charter_name']) ? $session['charter_info']['CharterGuest']['charter_name'] : ""; ?></h4>
            </td>
        </tr>
    </tbody>
</table>
<table cellpadding="5" cellspacing="" class="full-length">
    <tbody class="main-table">
        <thead>
            <tr>
                <td width="430" border="0" bgcolor="#03A9F4">Wine Name</td>
                <td align="center" width="80" border="0" bgcolor="#03A9F4">Vintage</td>
                <td align="center" width="80" border="0" bgcolor="#03A9F4">Rating</td>
                <td align="center" width="80" border="0" bgcolor="#03A9F4">Bottles</td>
            </tr>
        </thead>
        <tbody>
        <!-- Wine list from Existing preferences -->
        <?php 
        $i = 1;
        foreach ($winePreferences as $preferenceItem) { 
            $rowColor = "";
            if ($i % 2 != 0) {
                $rowColor = "#dfdfdf";
            }
        ?>
            <tr>
                <td width="430" border="0" bgcolor="<?php echo $rowColor; ?>"><?php echo $preferenceItem['CharterGuestWinePreference']['wine']; ?></td>
                <td align="center" width="80"  border="0" bgcolor="<?php echo $rowColor; ?>"><?php echo $preferenceItem['CharterGuestWinePreference']['vintage']; ?></td>
                <td align="center" width="80"  border="0" bgcolor="<?php echo $rowColor; ?>"><?php echo $preferenceItem['CharterGuestWinePreference']['score']; ?></td>
                <td align="center" width="80"  border="0" bgcolor="<?php echo $rowColor; ?>"><?php echo $preferenceItem['CharterGuestWinePreference']['quantity']; ?></td>
            </tr>
        <?php 
            $i++;
            } 
        ?>    
        </tbody>
        <tfooter>
            <?php foreach ($colorCountList as $color => $sum) { ?>
                <tr>
                    <td width="430"></td>
                    <td width="150" align="right">Total <?php echo !empty($color) ? $color : 'Non-type'; ?></td>
                    <td width="100" align="right"><?php echo $sum; ?> Bottles</td>
                </tr>
            <?php } ?>
                <tr><td colspan="4"></td></tr>    
            <tr>
                <td width="430"></td>
                <td width="150" align="right">Total Quantity</td>
                <td width="100" align="right"><?php echo $totalQuantity; ?> Bottles</td>
            </tr>
        </tfooter>
    </tbody>
</table> 
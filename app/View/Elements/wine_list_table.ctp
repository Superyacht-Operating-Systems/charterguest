<?php
    $recordExits = false;            
    if(isset($wineList) && !empty($wineList)) {
       $recordExits = true;            
    }
    $this->Js->JqueryEngine->jQueryObject = 'jQuery';
    $this->Paginator->options( array('update'=>"#$paginationPanel",
                                        'evalScripts' => true,
                                        'data'=>http_build_query($filterData),
                                        'method'=>'POST',
                                        'url' => array( "controller"=>"charters","action"=> "filterWineListPagination"))
    );
    
?>
<style>

.th-md-50{text-align: left;}
.charter-mod #generateWineOrderPdf{
    padding: 8px 23px;
    border-radius: 0px;
}
.c

	.charter-mod .modal-body{
		/*max-height: 400px;*/
		overflow-y: auto;
	}
	.charter-mod .modal-footer{
		text-align: left;
	}
	.cart-table{
		height: 50%;
		overflow: auto
	}

	table.table.cart-total tbody tr{
		background-color: #e5e2e2 !important;
	}
	@media (min-width: 768px){
	   .modal-dialog.charter-mod{
            width: 700px !important;
            margin: 30px auto;
        }
    }
    .tenrows {
        max-height: 250px;
        overflow: auto;
    }
    .modal-header {
        padding: 5px 15px;
    }   
</style>
<div id="wineListPanel">
    <table id="wineTable" class="table-row-container table table-striped table-bordered" style="width:100%">
        <thead>
            <tr class="th-head-bg">
                <th class="td-10"></th>
                <th class="td-40"><?php echo !($recordExits) ? "Wine" : $this->Paginator->sort('WineList.wine', 'Wine'); ?></th>
                <th class="text-center type-hide"><?php echo !($recordExits) ? "Vintage" : $this->Paginator->sort('WineList.vintage', 'Vintage'); ?></th>
                <th class="text-center td-30"><?php echo !($recordExits) ? "Rating" : $this->Paginator->sort('WineList.score', 'Rating'); ?></th>
                <th class="text-center td-20">Action<?php //echo !($recordExits) ? "Action" : $this->Paginator->sort('TWLS.id', 'Action'); ?></th>	
            </tr>
        </thead>

        <tbody>
            <?php //print_r($selectedWineList);
            if ($recordExits) {
                $i = 1;
                foreach ($wineList as $item) { 
            ?>
                <tr>
                    <td align="center" class="td-10"><?php echo $i; ?></td>
                    <td class="td-40"><?php echo $item['WineList']['wine']; ?></td>
                    <td class="text-center type-hide"><?php echo $item['WineList']['vintage']; ?></td>
                    <td class="text-center td-30"><?php echo $item['WineList']['score']; ?></td>
                    <td align="center" class="td-20">
                        <?php
                            $addBtnDisplay = "";
                            $removeBtnDisplay = "display: none;";
                            if (isset($selectedWineList) && in_array($item['WineList']['id'], $selectedWineList)) {
                                $addBtnDisplay = "display: none;";
                                $removeBtnDisplay = "";
                            }
                        ?>
                        <button style="<?php echo $addBtnDisplay; ?>" class="btn btn-primary wine_addbtn selectWineRow" data-wineListId="<?php echo $item['WineList']['id']; ?>">Select</button>
                        <button style="<?php echo $removeBtnDisplay; ?>" class="btn btn-warning wine_addbtn removeWineRow" data-wineListId="<?php echo $item['WineList']['id']; ?>">Remove</button>
                    </td>
                </tr>
            <?php $i++;
                }
            } else {    
            ?>
                <tr class="text-center"><td colspan="5">No records found.</td></tr>
            <?php } ?>
        </tbody>
    </table>
    <?php 
    if ($recordExits) { 
        echo $this->element("pagination", array('paginationURL' => 'filterWineListPagination'));
    } 
    ?>
  <div class="footer-row">
    <button class="btn btn-primary select-btn" id="selectionCartBtn" style="margin-top:20px">Selection Cart</button>
       <button class="find-btn" data-toggle="modal" data-target="#winePreference-modal">Didn't find it? Click Here</button>
</div></div>


<?php
    $recordExits = false;            
    if(isset($productList) && !empty($productList)) {
       $recordExits = true;            
    }
    $this->Js->JqueryEngine->jQueryObject = 'jQuery';
    $this->Paginator->options( array('update'=>"#$productPaginationPanel",
                                        'evalScripts' => true,
                                        'data'=>http_build_query($productFilterData),
                                        'method'=>'POST',
                                        'url' => array( "controller"=>"charters","action"=> "filterProductListPagination"))
    );
    
?>
<style>
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
            width: 65% !important;
            margin: 30px auto;
		}
    }
    .modal-header {
        padding: 5px 15px;
    }
</style>
<div id="productListPanel">
    <table id="productTable" class="table-row-container table table-striped table-bordered" style="width:100%">
        <thead>
            <tr class="th-head-bg">
                <th class="td-10"></th>
                <th class="td-40"><?php echo !($recordExits) ? "Product Name" : $this->Paginator->sort('ProductList.name', 'Product Name'); ?></th>
                <th class="text-center type-hide"><?php echo !($recordExits) ? "Type" : $this->Paginator->sort('ProductList.primary_category', 'Type'); ?></th>
                <th class="text-center td-30"><?php echo !($recordExits) ? "Category" : $this->Paginator->sort('ProductList.secondary_category', 'Category'); ?></th>
                <th class="td-20">Action</th>	
            </tr>
        </thead>

        <tbody>
            <?php 
            if ($recordExits) {
                $i = 1;
                foreach ($productList as $item) { 
            ?>
                <tr>
                    <td align="center" class="td-10"><?php echo $i; ?></td>
                    <td class="td-40"><?php echo $item['ProductList']['name']; ?></td>
                    <td class="text-center type-hide"><?php echo $item['ProductList']['primary_category']; ?></td>
                    <td class="text-center td-30"><?php echo $item['ProductList']['secondary_category']; ?></td>
                    <td align="center" class="td-20">
                        <?php
                            $addBtnDisplay = "";
                            $removeBtnDisplay = "display: none;";
                            if (isset($selectedProductList) && in_array($item['ProductList']['id'], $selectedProductList)) {
                                $addBtnDisplay = "display: none;";
                                $removeBtnDisplay = "";
                            }
                        ?>
                        <button style="<?php echo $addBtnDisplay; ?>" class="btn btn-primary wine_addbtn selectProductRow" data-productListId="<?php echo $item['ProductList']['id']; ?>">Select</button>
                        <button style="<?php echo $removeBtnDisplay; ?>" class="btn btn-warning wine_addbtn removeProductRow" data-productListId="<?php echo $item['ProductList']['id']; ?>">Remove</button>
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
        echo $this->element("pagination", array('paginationURL' => 'filterProductListPagination'));
    } 
    ?>
    <div class="footer-row">
    <button class="btn btn-primary pull-right select-btn" id="productSelectionCartBtn">Selection Cart</button>
        <button class="find-btn" data-toggle="modal" data-target="#dont-click-modal">Didn't find it? Click Here</button>
</div>
</div>




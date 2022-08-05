
<?php
$baseFolder = $this->request->base;
$session = $this->Session->read();

?>
<style>
.card {
    display: block;
    margin-bottom: 20px;
    line-height: 1.42857143;
    background-color: #000;
    border-radius: 2px;
    border: 1px solid #dddddd8f;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
    transition: box-shadow .25s;
    color: #fff;
}

.card-content {
  padding: 15px ;
    text-align:left;
}
	.card:hover {
  box-shadow: 0 8px 17px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
}
	ul.quick-lst{
		padding-left: 0px;
		margin-top: 10px;
	}
	ul.quick-lst li{
		list-style:none;
	}
	ul.quick-lst li a{
		  color:#fff;
	}
	.progress.scope{
		height:8px;
		margin-top: 20px;
	}
	.entr-secl{
		display: inline-block;
		width:55px;
        width:auto;
	}
	.ds-progress {
  width: 100%;
  height: 10px;
  margin-top: 20px;
  cursor: pointer;
}
.ds-skate {
width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 2px solid #009adc;
    position: absolute;
    background: #fff;
    top: -5px;
    cursor: pointer;
    z-index: 2;
}
.ds-end-skate {
 width: 20px;
    height: 20px;
  border-radius: 50%;
 border: 2px solid #009adc;
  position: absolute;
  top: -5px;
  background: #fff;
  cursor: pointer;
  z-index: 2;
  right: 0;
}
	.fstChoiceItem{
		font-size: 12px;
	}
	.fstElement {
    font-size: 9px !important;
		border-radius: 4px;
}
	.fstMultipleMode .fstQueryInput {
		font-size: 14px;
	}

	.rangedrag{
	   margin: 25px auto;
	}

	.wine_addbtn{
		height: 20px;
		line-height: 0;
	}
	 .fstElement { font-size: 1.2em; }
            .fstToggleBtn { min-width: 16.5em; }

            .submitBtn { display: none; }

            .fstMultipleMode { display: block; }
            .fstMultipleMode .fstControls { width: 100%; }
            
            
     .search-right {
    display: flex;
    margin-bottom: 7px;
}
.search-right div {
    flex: 1;
}
span.ds-category-start {
    display: none;
}

span.ds-category-end {
    display: none;
}

span.ds-skate-year-mark {
    position: absolute;
    top: 18px;
    left: 0px;
}
.entr-secl {
    padding: 5px 5px;
}
.searchpos{
    text-align: right;
    position: relative;
    top: 6px;
}

.search-right div:first-child {
    flex: 3;
}
table#selectedProductListTableId tr td {
    padding: 5px !important;
}

table#selectedProductListTableId thead th {
    padding: 5px;
}

table#selectedProductListTableId tr td input {
    height: 25px;
}
@media only screen 
    and (min-device-width : 768px) 
    and (max-device-width : 1024px) 
    and (orientation : portrait) { 
        .search-right div:first-child {
            font-size: 12px;
        }
    }
    table#productTable button {
    font-size: 12px;
    width: 90%;
}
.tenrows {
    max-height: 250px;
    overflow: auto;
}
</style>



<div id="spirit" class="tab-pane fade <?php echo $spiritPreferenceTab; ?>">
    <div class="personal-row-container beverage-menu-row">
         <h1 class="position-mobile-head">BEER & SPIRITS</h1>   
 <div class="fixed-row-container">       
<div class="container-fluid no-space">
    <?php if (isset($charterAssocIdByHeaderView)) { 
        echo $this->element('view_selected_spirit_list_table'); 
    } else { 
    ?>  
<div class="filter-banel">  
<div class="close-filter-button">Close Filters</div>  
	<div class="col-sm-12 col-md-3 pdd-none no-space">
                <div class="card">
		  	<div class="card-content">
				<div class="search-right">
                                    <div class="card-title text-center" 
                                         style="text-align: left;line-height: 1.5;">
                                        TYPE
                                    </div>
                                    <div style="text-align: right;"> 
                                        <button type="button" class="btn btn-info text-right productFilter" 
                                                style="padding: 1px 5px;">
                                                <span class="fa fa-filter"></span>
                                                apply
                                        </button>
                                    </div>
                            </div>
                    <?php echo $this->Form->input('type', array('placeholder' => "Choose types", 'id' => 'type', 'type' => 'select', 'multiple' => true, 'options' => $typeList, 'selected' => array(), 'class' => "multipleSelect form-control", 'label' => false, 'div' => false)); ?>
			</div> 
		</div>
                <div class="card">
                            <div class="card-content">
                                    <div class="search-right">
                                        <div class="card-title text-center" 
                                             style="text-align: left;line-height: 1.5;">
                                            CATEGORY
                                        </div>
                                        <div style="text-align: right;"> 
                                            <button type="button" class="btn btn-info text-right productFilter" 
                                                    style="padding: 1px 5px;">
                                                    <span class="fa fa-filter"></span>
                                                    apply
                                            </button>
                                        </div>
                                </div>
                        <?php echo $this->Form->input('category', array('placeholder' => "Choose categories", 'id' => 'category', 'type' => 'select', 'multiple' => true, 'options' => $categoryList, 'selected' => array(), 'class' => "multipleSelect form-control", 'label' => false, 'div' => false)); ?>
                            </div> 
                    </div>
                <div class="card">
		  	<div class="card-content">
				<div class="search-right">
                                    <div class="card-title text-center" 
                                         style="text-align: left;line-height: 1.5;">
                                        STYLE
                                    </div>
                                    <div style="text-align: right;"> 
                                        <button type="button" class="btn btn-info text-right productFilter" 
                                                style="padding: 1px 5px;">
                                                <span class="fa fa-filter"></span>
                                                apply
                                        </button>
                                    </div>
                            </div>
                    <?php echo $this->Form->input('style', array('placeholder' => "Choose styles", 'id' => 'style', 'type' => 'select', 'multiple' => true, 'options' => $styleList, 'selected' => array(), 'class' => "multipleSelect form-control", 'label' => false, 'div' => false)); ?>
			</div> 
		</div>
		<div class="card">
		  	<div class="card-content">
                            <div class="search-right">
                                    <div class="card-title text-center" 
                                         style="text-align: left;line-height: 1.5;">
                                        COUNTRY
                                    </div>
                                    <div style="text-align: right;"> 
                                        <button type="button" class="btn btn-info text-right productFilter" 
                                                style="padding: 1px 5px;">
                                                <span class="fa fa-filter"></span>
                                                apply
                                        </button>
                                    </div>
                            </div>

                    <?php echo $this->Form->input('country', array('placeholder' => "Choose countries", 'id' => 'country', 'type' => 'select', 'multiple' => true, 'options' => $countryList, 'selected' => array(), 'class' => "multipleSelect form-control", 'label' => false, 'div' => false)); ?>
			</div> 
		</div>
	</div>
	</div>
<!--	table-->
	<div class="col-md-9 panel-full-md-row mob-right0">
		<div class="row">
<div class="filter-button">Show Filters</div>  
			<div class="col-sm-4">
				<div class="dataTables_length">
					<label>Show 
                      <select id="showProductLimit" class="form-control entr-secl">
					<option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                     </select></label>
				</div>
                        </div>
			<div class="col-sm-8 serch-filter-row">
				<div id="example_filter" class="pull-right">
				    <div class="input-group">
                        <input type="search" id="productName" class="form-control" placeholder="Search Name" aria-controls="example">
                        <span type="button" class="btn btn-info input-group-addon productFilter"><i class="fa fa-search"></i></span>
                    </div>
                                    <!-- <div class="col-md-8">
                                        
                                        <button type="button" class="btn btn-info productFilter">
                                            <span class="fa fa-search"></span>
                                        </button>
                                    </div> -->
                                </div>
                        </div>
                         <button class="btn pull-right previous-btn previousSelectionButton" data-type="spirit" >Previous Selections</button>
			</div>
	
            <div id="productListDiv">
                <?php echo $this->element('product_list_table', array('paginationURL' => 'filterWineListPagination', '')); ?>
            </div>
            
	</div>
    <?php } ?>    

</div>
	
</div>
</div>
</div>


<!-- The Modal -->
<!-- Modal -->



<script>
    $("body").on("click", ".filter-button", function () {
    $(".panel-full-md-row").stop().animate({ opacity: "hide", marginTop: 20 }, 300, function () {
        $(".filter-banel").stop().animate({ opacity: "show", marginTop: 3 }, 300,);
    });
});  
</script>
<script>
$("body").on("click", ".close-filter-button", function () {
    $(".filter-banel").stop().animate({ opacity: "hide", marginTop: 20 }, 300, function () {
        $(".panel-full-md-row").stop().animate({ opacity: "show", marginTop: -3 }, 300,);
    });
}); 

</script>
<script type="text/javascript">

// Initialize the Multi select dropdown
$('.multipleSelect').fastselect();

// Add Wine to Cart
$(document).on("click", ".selectProductRow", function(e) {
    var obj = $(this);
    var rowObj = obj.closest("tr");
    var productListId = obj.data("productlistid");
    
    if (productListId != "") {
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: '<?php echo $baseFolder; ?>/charters/addProductToCart',
            dataType: 'json',
            data: { productListId: productListId },
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    obj.css('display', 'none');
                    rowObj.find('.removeProductRow').css('display', 'block');
                }  
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    }  
	
});

// Remove selected wine from main list 
$(document).on("click", ".removeProductRow", function(e) {
    var obj = $(this);
    var rowObj = obj.closest("tr");
    var productListId = obj.data("productlistid");
    
    if (productListId != "") {
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: '<?php echo $baseFolder; ?>/charters/removeProductFromCart',
            dataType: 'json',
            data: { productListId: productListId },
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    obj.css('display', 'none');
                    rowObj.find('.selectProductRow').css('display', 'block');
                }  
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    }  
	
});

// Remove selected wine from Selection cart 
$(document).on("click", ".removeProductFromCart", function(e) {
    var obj = $(this);
    var rowObj = obj.closest("tr");
    var productListId = obj.data("productlistid");
    
    if (productListId != "") {
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: '<?php echo $baseFolder; ?>/charters/removeProductFromCart',
            dataType: 'json',
            data: { productListId: productListId },
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    rowObj.remove();
                    // Calculate the Total quantity per type
                    calculateTotalProductQuantity();
                }  
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    }  
	
});

// Remove selected wine from Preference 
$(document).on("click", ".removeProductFromPreference", function(e) {
    var obj = $(this);
    var rowObj = obj.closest("tr");
    var productPrefId = obj.data("productprefid");
    
    if (productPrefId != "") {
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: '<?php echo $baseFolder; ?>/charters/removeProductFromPreference',
            dataType: 'json',
            data: { productPrefId: productPrefId },
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    rowObj.remove();
                    // Calculate the Total quantity per type
                    calculateTotalProductQuantity();
                }  
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    }  
	
});

// Fetch Selection cart wines
$(document).on("click", "#productSelectionCartBtn", function(e) {
    
    $("#hideloader").show();
    $.ajax({
        type: "POST",
        url: '<?php echo $baseFolder; ?>/charters/getSelectedProductList',
        dataType: 'json',
        data: { },
        success:function(result) {
            $("#hideloader").hide();
            if (result.status == 'success') {
                if (result.cartRecordCount != 0 || result.preferenceRecordCount != 0) {
                    $("#selectedProductListDiv").html(result.view);
                    // Enable/Disable the PDF button
                    if (result.preferenceRecordCount != 0) {
                        $("#generateProductOrderPdf").attr('disabled', false);
                    }    
                } else {
                    $("#selectedProductListDiv").html('<p class="text-center">No selected products available.</p>');
                }  
                $("#productSelectionCart").modal('show');
                // Calculate the Total quantity per type
                calculateTotalProductQuantity();
            }  
        },
        error: function(jqxhr) { 
            $("#hideloader").hide();
        }
    });
	
});

// Multiselect filters
$(document).on("click", ".productFilter", function(e) {
    productFilterRequest();	
});

// Show limit filter
$(document).on("change", "#showProductLimit", function(e) {
    productFilterRequest();	
});

// Filter handling
function productFilterRequest() {
    var country = $("#country").val();
    var type = $("#type").val();
    var style = $("#style").val();
    var category = $("#category").val();
    var showLimit = $("#showProductLimit").val();
    var productName = $("#productName").val();
    
    $("#hideloader").show();
    $.ajax({
        type: "POST",
        url: '<?php echo $baseFolder; ?>/charters/filterProductList',
        dataType: 'json',
        data: { country: country, type: type, style: style, limit: showLimit, productName: productName, category: category },
        success:function(result) {
            $("#hideloader").hide();
            if (result.status == 'success') {
                $("#productListDiv").html(result.view);
            }  
        },
        error: function(jqxhr) { 
            $("#hideloader").hide();
        }
    });
}

// Calculate Total quantity in Selection cart
$(document).on('keyup', '.productQuantity', function (e) {
    var typeClass = $(this).data('typeclass');
    calculateTotalProductQuantityOnKeyup(typeClass);
});

// Calculating the Total quantity When Key up
function calculateTotalProductQuantityOnKeyup(typeClass) {
    var total = 0;
    var totalQuantity = 0;
    
    $("#selectedProductListTableId tr").find("."+typeClass).each(function (e) {
        var value = $(this).val().trim();
        if (value != "") {
            var quantity = parseInt(value);
            total += quantity;
            $("#totalProductQuantityTableId tr").find("."+typeClass).text(total);
        }   
    });
    
    $("#totalProductQuantityTableId tr").find(".totalTypeQuantity").each(function (e) {
        var value = $(this).text().trim();
        if (value != "") {
            var quantity = parseInt(value);
            totalQuantity += quantity;
            $("#totalProductQuantity").text(totalQuantity);
        }   
    });
    
}

// Calculating the Total quantity
function calculateTotalProductQuantity() {
    var totalQuantity = 0;
    
    $("#totalProductQuantityTableId tr").find(".totalTypeQuantity").each(function (e) {
        var typeClass = $(this).data('typeclass');
        var total = 0;
        var obj = $(this);
        $("#selectedProductListTableId tr").find("."+typeClass).each(function (e) {
            var value = $(this).val().trim();
            if (value != "") {
                var quantity = parseInt(value);
                total += quantity;
            }
        }); 
        totalQuantity += total;
        obj.text(total);
        $("#totalProductQuantityTableId #totalProductQuantity").text(totalQuantity);
    });
    
}

// Generate PDF
$(document).on("click", "#generateProductOrderPdf", function(e) {

    $("#hideloader").show();
var filepath = "<?php echo $baseFolder; ?>/charters/generateProductOrderPdf";
downloadFile(filepath);

                    setTimeout(function () {
                        $("#hideloader").hide();
                 }, 3000);
});

function downloadFile(filePath){
    var link=document.createElement('a');
    link.href = filePath;
    link.download = filePath.substr(filePath.lastIndexOf('/') + 1);
    link.click();
    
}
//BS popup save
$(document).on("click", "#save_bs_product", function(e) {
    //alert();
    var data = $("#dont-click-modal div").find(".bsinput").serialize();
    $.ajax({
            type: "POST",
            url: '<?php echo $baseFolder; ?>/charters/saveBSProduct',
            dataType: 'json',
            data: data,
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    $(".bsinput").val('');
                    $("#dont-click-modal").modal("hide");
                    //location.reload();
                } else {

                }   
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
});

//Wine list popup save
$(document).on("click", "#wlinputsave", function(e) {
    //alert(); return false;
    var data = $("#winePreference-modal div").find(".wlinput").serialize();
    $.ajax({
            type: "POST",
            url: '<?php echo $baseFolder; ?>/charters/saveWLProduct',
            dataType: 'json',
            data: data,
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    $(".wlinput").val('');
                    $("#winePreference-modal").modal("hide");
                    //location.reload();
                } else {

                }   
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
});


$(document).on("click", ".addtocartselectedBeer", function(e) {
    var obj = $(this);
    var rowObj = obj.closest("tr");
    var productid = obj.data("productid");
    var quantity = obj.data("quantity");
    
    if (productid != "") {
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: '<?php echo $baseFolder; ?>/charters/addPreviousSpiritToCart',
            dataType: 'json',
            data: { "productListId": productid,"quantity":quantity },
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    $(".selectProductRow").each(function (i,e) { 
                        if($(this).attr('data-productlistid') == productid){ 
                            $(this).css('display', 'none');
                        };   
                    });
                    $(".removeProductRow").each(function (i,e) {
                        if($(this).attr('data-productlistid') == productid){
                            $(this).css('display', 'block');
                        };   
                    });
                    $("#previousBeerSelectionCart").modal('hide');
                    $("#productSelectionCartBtn").click();
                }  
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    }  
	
});
    
                    
</script>





<?php
$baseFolder = $this->request->base;
$session = $this->Session->read();
$ownerprefenceID = $this->Session->read('ownerprefenceID');
?>
<style>
.card {
    display: block;QUICK LINKS
    margin-bottom: 20px;
    line-height: 1.42857143;
    background-color: #000;
        border: 1px solid #dddddd8fQUICK LINKS;
    border-radius: 2px;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
    transition: box-shadow .25s;
}
.check-box-div{top:3.9px!important;}
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

.search-right div:first-child {
    flex: 3;
}
table#wineTable button {
    font-size: 12px;
    width: 65px;
    padding: 0px!important;
}
table#selectedWineListTableId tr td {
    padding: 5px !important;
}

table#selectedWineListTableId thead th {
    padding: 5px;
}

table#selectedWineListTableId tr td input {
    height: 25px;
}
@media only screen and (max-width: 767px){
.rating-row{
     display: none;
}




</style>
<!-- The Modal -->
<!-- Modal -->


<div id="wine" class="tab-pane fade <?php echo $winePreferenceTab; ?>">
<div class="personal-row-container beverage-menu-row">
<!-- <h1 class="position-mobile-head">WINE LIST</h1>    -->
<?php if(isset($ownerprefenceID)){
              ?>
         <h1 class="position-mobile-head">PREFERENCES<span style="padding-left:20px;">6 of 7</span></h1>
          <?php }  else{ ?>
          
          <?php } ?> 
<div class="fixed-row-container">  
<div class="container-fluid no-space">
    
    <?php if (isset($charterAssocIdByHeaderView)) { 
        echo $this->element('view_selected_wine_list_table'); 
    } else { 
    ?>
<div class="filter-banel">  
<div class="close-filter-button">Close Filters</div>  
    <div class="col-sm-12 col-md-3 pdd-none no-space">
		<div class="card rating-row">
		  	<div class="card-content ">
                            <div class="search-right">
                                    <div class="card-title text-center" 
                                         style="text-align: left;line-height: 1.5;">
                                        GLOBAL RATING
                                    </div>
                                    <div style="text-align: right;"> 
                                        <button type="button" class="btn btn-info text-right wineFilter" 
                                                style="padding: 1px 5px;">
                                                <span class="fa fa-filter"></span>
                                                apply
                                        </button>
                                    </div>
                            </div>
                            <input type="hidden" id="startRange" value="80">
                            <input type="hidden" id="endRange" value="100">
			<div id="range" class="rangedrag"></div>

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
                                        <button type="button" class="btn btn-info text-right wineFilter" 
                                                style="padding: 1px 5px;">
                                                <span class="fa fa-filter"></span>
                                                apply
                                        </button>
                                    </div>
                            </div>

                    <?php echo $this->Form->input('country', array('placeholder' => "Choose countries", 'id' => 'wine_country', 'type' => 'select', 'multiple' => true, 'options' => $countryList, 'selected' => array(), 'class' => "multipleSelect form-control", 'label' => false, 'div' => false)); ?>
			</div> 
		</div>
		
		<div class="card">
		  	<div class="card-content">
				<div class="search-right">
                                    <div class="card-title text-center" 
                                         style="text-align: left;line-height: 1.5;">
                                        REGIONS
                                    </div>
                                    <div style="text-align: right;"> 
                                        <button type="button" class="btn btn-info text-right wineFilter" 
                                                style="padding: 1px 5px;">
                                                <span class="fa fa-filter"></span>
                                                apply
                                        </button>
                                    </div>
                            </div>
                    <?php echo $this->Form->input('region', array('placeholder' => "Choose regions", 'id' => 'region', 'type' => 'select', 'multiple' => true, 'options' => $regionList, 'selected' => array(), 'class' => "multipleSelect form-control", 'label' => false, 'div' => false)); ?>
			</div> 
		</div>
		
		<div class="card">
		  	<div class="card-content">
				<div class="search-right">
                                    <div class="card-title text-center" 
                                         style="text-align: left;line-height: 1.5;">
                                        APPELLATION
                                    </div>
                                    <div style="text-align: right;"> 
                                        <button type="button" class="btn btn-info text-right wineFilter" 
                                                style="padding: 1px 5px;">
                                                <span class="fa fa-filter"></span>
                                                apply
                                        </button>
                                    </div>
                            </div>
                    <?php echo $this->Form->input('appellation', array('placeholder' => "Choose appellations", 'id' => 'appellation', 'type' => 'select', 'multiple' => true, 'options' => $appellationList, 'selected' => array(), 'class' => "multipleSelect form-control", 'label' => false, 'div' => false)); ?>
			</div> 
		</div>
		
		<div class="card">
		  	<div class="card-content">
				<div class="search-right">
                                    <div class="card-title text-center" 
                                         style="text-align: left;line-height: 1.5;">
                                        COLOR
                                    </div>
                                    <div style="text-align: right;"> 
                                        <button type="button" class="btn btn-info text-right wineFilter" 
                                                style="padding: 1px 5px;">
                                                <span class="fa fa-filter"></span>
                                                apply
                                        </button>
                                    </div>
                            </div>
                    <?php echo $this->Form->input('color', array('placeholder' => "Choose colors", 'id' => 'color', 'type' => 'select', 'multiple' => true, 'options' => $colorList, 'selected' => array(), 'class' => "multipleSelect form-control", 'label' => false, 'div' => false)); ?>		
			</div> 
		</div>
		
		<div class="card">
		  	<div class="card-content">
				<div class="search-right">
                                    <div class="card-title text-center" 
                                         style="text-align: left;line-height: 1.5;">
                                        TYPE
                                    </div>
                                    <div style="text-align: right;"> 
                                        <button type="button" class="btn btn-info text-right wineFilter" 
                                                style="padding: 1px 5px;">
                                                <span class="fa fa-filter"></span>
                                                apply
                                        </button>
                                    </div>
                            </div>
                    <?php echo $this->Form->input('wine_type', array('placeholder' => "Choose wine types", 'id' => 'wineType', 'type' => 'select', 'multiple' => true, 'options' => $wineTypeList, 'selected' => array(), 'class' => "multipleSelect form-control", 'label' => false, 'div' => false)); ?>
			</div> 
		</div>
	</div></div>
	
<!--	table-->
    <div class="col-md-9 panel-full-md-row mob-right0">
        <div class="row">
<div class="filter-button">Show Filters</div>  
			<div class="col-sm-4">
				<div class="dataTables_length" id="example_length">
					<label>Show 
                        <select name="example_length" id="showLimit" class="form-control entr-secl">
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        </select></label>
				</div>
                        </div>
			<div class="col-sm-8 serch-filter-row">
				<div id="example_filter" class="pull-right">
			<!-- 		<label class="col-md-4 searchpos">Search:</label> -->
				    <div class="input-group">
                        <input type="search" id="wineName" class="form-control" placeholder="Search Name" aria-controls="example">
                        <span type="button" class="btn btn-info input-group-addon wineFilter"><i class="fa fa-search"></i></span>
                    </div>
				<!-- <div class="col-md-8">
                                    <input type="search" id="wineName" class="form-control" placeholder="Enter the Wine name" aria-controls="example">
                                    <button type="button" class="btn btn-info wineFilter">
                                        <span class="fa fa-search"></span>
                                    </button>
				</div> -->
			</div>
		</div>
        <button class="btn pull-right previous-btn previousSelectionButton" data-type="wine">Previous Selections</button>
			</div>
	
            <div id="wineListDiv">
                <!-- Wine list table -->
                <?php echo $this->element('wine_list_table', array('paginationURL' => 'filterWineListPagination', '')); ?>
            </div>
            
	</div>
    <?php } ?>    

</div>
	
</div></div></div>
<script type="text/javascript">

// Initialize the Multi select dropdown
$('.multipleSelect').fastselect();

// Initialize the Range rover
$(document).on("click", "#wineTab", function(e) {
    setTimeout(function(){
        $("#range").rangeRover({
            range:true,
            data:{
                start:80,
                end:100,
            },
            onChange: function(e) {
                $("#startRange").val(e.start.value);
                $("#endRange").val(e.end.value);
            }
        });
    },500);
});    


 // Fetch Top filters
$(document).on("click", ".filterTop", function(e) {
    var color = $(this).data("color");
    var region = $(this).data("region");
    var vintage = $(this).data("vintage");
    
    // Clearing other filters
//    $("#country").val("");
//    $("#region").val("");
//    $("#appellation").val("");
//    $("#color").val("");
//    $("#wineType").val("");
//    $("#vintage").val("");
    $("#showLimit").val("25");
    $("#wineName").val("");
    
    $("#hideloader").show();
    $.ajax({
        type: "POST",
        url: '<?php echo $baseFolder; ?>/charters/filterWineList',
        dataType: 'json',
        data: { color: color, region: region, vintage: vintage, order: 'score' },
        success:function(result) {
            $("#hideloader").hide();
            if (result.status == 'success') {
                $("#wineListDiv").html(result.view);
            }  
        },
        error: function(jqxhr) { 
            $("#hideloader").hide();
        }
    });
	
});

// Add Wine to Cart
$(document).on("click", ".selectWineRow", function(e) {
    var obj = $(this);
    var rowObj = obj.closest("tr");
    var wineListId = obj.data("winelistid");
    
    if (wineListId != "") {
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: '<?php echo $baseFolder; ?>/charters/addWineToCart',
            dataType: 'json',
            data: { wineListId: wineListId },
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    obj.css('display', 'none');
                    rowObj.find('.removeWineRow').css('display', 'block');
                }  
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    }  
	
});

// Remove selected wine from main list 
$(document).on("click", ".removeWineRow", function(e) {
    var obj = $(this);
    var rowObj = obj.closest("tr");
    var wineListId = obj.data("winelistid");
    
    if (wineListId != "") {
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: '<?php echo $baseFolder; ?>/charters/removeWineFromCart',
            dataType: 'json',
            data: { wineListId: wineListId },
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    obj.css('display', 'none');
                    rowObj.find('.selectWineRow').css('display', 'block');
                }  
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    }  
	
});

// Remove selected wine from Selection cart 
$(document).on("click", ".removeWineFromCart", function(e) {
    var obj = $(this);
    var rowObj = obj.closest("tr");
    var wineListId = obj.data("winelistid");
    
    if (wineListId != "") {
        if(confirm("Are you sure you wish to delete this item")==true){
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: '<?php echo $baseFolder; ?>/charters/removeWineFromCart',
            dataType: 'json',
            data: { wineListId: wineListId },
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    rowObj.remove();
                    $(".selectWineRow").each(function (i,e) { 
                        if($(this).attr('data-winelistid') == wineListId){ 
                            $(this).css('display', 'block');
                        };   
                    });
                    $(".removeWineRow").each(function (i,e) {
                        if($(this).attr('data-winelistid') == wineListId){
                            $(this).css('display', 'none');
                        };   
                    });
                    // Calculate the Total quantity per type
                    calculateTotalQuantity();
                    var count = -1;
                    $("#selectedWineListTableId").find("tr").each(function (e) {
                        console.log('count=',count++)
                    });
                    if(count==0){
                        console.log('valid count=',count)
                        // wineorderbuttondiv
                        // $("#generateWineOrderPdf").attr('disabled', true);
                        $("#wineorderbuttondiv *").prop('disabled', true);
                        $('#wineorderbuttondiv > span').addClass('disabled');
                    }
                }  
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    }
    }  
	
});

// Remove selected wine from Preference 
$(document).on("click", ".removeWineFromPreference", function(e) {
    var obj = $(this);
    var rowObj = obj.closest("tr");
    var winePrefId = obj.data("wineprefid");
    
    if (winePrefId != "") {
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: '<?php echo $baseFolder; ?>/charters/removeWineFromPreference',
            dataType: 'json',
            data: { winePrefId: winePrefId },
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    rowObj.remove();
                    // Calculate the Total quantity per type
                    calculateTotalQuantity();
                }  
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    }  
	
});

// Fetch Selection cart wines
$(document).on("click", "#selectionCartBtn", function(e) {
    
    $("#hideloader").show();
    $.ajax({
        type: "POST",
        url: '<?php echo $baseFolder; ?>/charters/getSelectedWineList',
        dataType: 'json',
        data: { },
        success:function(result) {
            $("#hideloader").hide();
            if (result.status == 'success') {
                if (result.cartRecordCount != 0 || result.preferenceRecordCount != 0) {
                    $("#selectedWineListDiv").html(result.view);
                    // Enable/Disable the PDF button
                    if (result.preferenceRecordCount != 0) {
                        $("#generateWineOrderPdf").attr('disabled', false);
                    }    
                } else {
                    $("#selectedWineListDiv").html('<p class="text-center">No selected wines available.</p>');
                }  
                $("#selectcart").modal('show');
                // Calculate the Total quantity per type
                calculateTotalQuantity();
            }  
        },
        error: function(jqxhr) { 
            $("#hideloader").hide();
        }
    });
	
});

// Multiselect filters
$(document).on("click", ".wineFilter", function(e) {
    filterRequest();	
});

// Show limit filter
$(document).on("change", "#showLimit", function(e) {
    filterRequest();	
});

// Filter handling
function filterRequest() {
    var country = $("#wine_country").val();
    var region = $("#region").val();
    var appellation = $("#appellation").val();
    var color = $("#color").val();
    var wineType = $("#wineType").val();
    //var vintage = $("#vintage").val();
    var startRange = $("#startRange").val();
    var endRange = $("#endRange").val();
    var showLimit = $("#showLimit").val();
    var wineName = $("#wineName").val();
    
    $("#hideloader").show();
    $.ajax({
        type: "POST",
        url: '<?php echo $baseFolder; ?>/charters/filterWineList',
        dataType: 'json',
        data: { country: country, region: region, appellation: appellation,color: color, region: region, wineType: wineType, startRange: startRange, endRange: endRange, limit: showLimit, wineName: wineName },
        success:function(result) {
            $("#hideloader").hide();
            if (result.status == 'success') {
                $("#wineListDiv").html(result.view);
            }  
        },
        error: function(jqxhr) { 
            $("#hideloader").hide();
        }
    });
}

// Calculate Total quantity in Selection cart
$(document).on('keyup', '.wineQuantity', function (e) {
    var colorClass = $(this).data('colorclass');
    calculateTotalQuantityOnKeyup(colorClass);
});

// Calculating the Total quantity When Key up
function calculateTotalQuantityOnKeyup(colorClass) {
    var total = 0;
    var totalQuantity = 0;
    
    $("#selectedWineListTableId tr").find("."+colorClass).each(function (e) {
        var value = $(this).val().trim();
        if (value != "") {
            var quantity = parseInt(value);
            total += quantity;
        }   
        $("#totalQuantityTableId tr").find("."+colorClass).text(total);
    });
    
    $("#totalQuantityTableId tr").find(".totalColorQuantity").each(function (e) {
        var value = $(this).text().trim();
        if (value != "") {
            var quantity = parseInt(value);
            totalQuantity += quantity;
            $("#totalWineQuantity").text(totalQuantity);
        }   
    });
    
}

// Calculating the Total quantity
function calculateTotalQuantity() {
    var totalQuantity = 0;
    
    $("#totalQuantityTableId tr").find(".totalColorQuantity").each(function (e) {
        var colorClass = $(this).data('colorclass');
        var total = 0;
        var obj = $(this);
        $("#selectedWineListTableId tr").find("."+colorClass).each(function (e) {
            var value = $(this).val().trim();
            if (value != "") {
                var quantity = parseInt(value);
                total += quantity;
            }
        }); 
        totalQuantity += total;
        obj.text(total);
        $("#totalQuantityTableId #totalWineQuantity").text(totalQuantity);
    });
    
}

// Generate PDF
$(document).on("click", "#generateWineOrderPdf", function(e) {
    $('#isgenerateWineOrderPdf').val(true)

    $("#hideloader").show();
    $("#winePreferenceForm").trigger("submit");

    // var filepath = "<?php echo $baseFolder; ?>/charters/generateWineOrderPdf";
    
    // downloadFile(filepath);

    // setTimeout(function () {
    //     $("#hideloader").hide();
    // }, 3000);
                
});


function downloadFile(filePath){
    var link=document.createElement('a');
    link.href = filePath;
    link.download = filePath.substr(filePath.lastIndexOf('/') + 1);
    link.click();
    
}


$(document).on("click", ".addPreviousWineToCart", function(e) {
    var obj = $(this);
    var rowObj = obj.closest("tr");
    var wineListId = obj.data("winelistid");
    var quantity = obj.data("quantity");
    
    if (wineListId != "") {
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: '<?php echo $baseFolder; ?>/charters/addPreviousWineToCart',
            dataType: 'json',
            data: { "wineListId": wineListId,"quantity":quantity },
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    // obj.css('display', 'none');
                    // rowObj.find('.removeWineRow').css('display', 'block');

                    $(".selectWineRow").each(function (i,e) { 
                        if($(this).attr('data-winelistid') == wineListId){ 
                            $(this).css('display', 'none');
                        };   
                    });
                    $(".removeWineRow").each(function (i,e) {
                        if($(this).attr('data-winelistid') == wineListId){
                            $(this).css('display', 'block');
                        };   
                    });
                    $("#previousWineSelectionCart").modal('hide');
                    $("#selectionCartBtn").click();
                }  
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    }  
	
});
</script>



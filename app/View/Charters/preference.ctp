<?php
    $baseFolder = $this->request->base;
    $session = $this->Session->read('charter_info.CharterGuest'); 
    $sessionAssoc = $this->Session->read('charter_assoc_info');
    $adminLogin = $this->Session->read('charter_info.CharterGuest.Adminlogin');
     $selectedCHID = $this->Session->read('selectedCHID');
     $selectedCHPRGID = $this->Session->read('selectedCHPRGID');
     $selectedCHPRGCOMID = $this->Session->read('selectedCHPRGCOMID');
    //echo "<pre>"; print_r($this->Session->read()); 
    //exit;
    if(isset($charterAssocIdisHeadChecked) && $charterAssocIdisHeadChecked!=''){
    $sessionCH = $charterAssocIdisHeadChecked;//$sessionAssoc['CharterGuestAssociate']['is_head_charterer'];
    }
    if(isset($sessionAssoc['CharterGuestAssociate']['is_head_charterer']) && $sessionAssoc['CharterGuestAssociate']['is_head_charterer']!=''){
    $sessionCH = $sessionAssoc['CharterGuestAssociate']['is_head_charterer'];
    }
    //echo $sessionCH.'llllll';exit('ddd');

    $sessionCharterGuest = $this->Session->read('charter_info.CharterGuest');

    $sessionCharterGuestAssociate = $this->Session->read('charter_info.CharterGuestAssociate');
?>

<?php 
    echo $this->Html->css('preference/style');
?>

<style>
.nav-side-menu{display: block!important;}
.yachtHeaderName{font-weight: bold;}
.form-control{
    border-radius: 0px;
    border: none;
    border-top: solid 1.5px rgba(2, 2, 2, 0.40);
    border-left: solid 1.5px rgba(2, 2, 2, 0.40);
    background: rgba(241, 235, 235, 0.76);
    border-bottom: solid 1.5px #fff;
    border-right: solid 1.5px #fff;
}
.tab-md-row-container label {
    font-weight: 600;
}

.tab-md-row-container .checkbox label, .radio label{
  font-weight: 600;
}
.checkbox-label-row .checkbox label, .radio label{margin: 0px;
    padding: 0px;}


.ui-datepicker-title select {
        color: black;
    }
    input[type="file"].passportImageClass {
    max-width: 249px;
}
    .passportImageClass {
        /*margin: 10px 0 0;
            margin-top: 10px;*/
            margin-right: 0px;
            margin-bottom: 0px;
            margin-left: 0px;
        padding: 6px 9px !important;
        border-radius: 3px;
        overflow: hidden;
        white-space: nowrap;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
    }
    .space-50-h{
        height: 50px;
    }
    .mar-t-10{
        margin-top:10px;
    }

    /*End Ramesh 10/08/2018 */
/*.back-btn{position: relative;width:100%;margin-top:50px;    display: inline-block;}*/
.back-btn button{float: right;    margin-right: 20px;}
.base-margin {margin: 5px 0px 20px 0px}




</style>
<?php if (!empty($this->request->query) || !isset($sessionAssoc['CharterGuestAssociate']['id'])) { ?>
    <div class="back-btn">
        <a href="<?php echo $baseFolder."/charters/view"; ?>"><button type="button" class="btn btn-warning" title="Back" data-placement="bottom">
            <span class="back-btn-go"><< Back</span><span class="go-back-btn"><i class="fa fa-long-arrow-left"></i></span>
        </button></a>
    </div>
<?php } ?>
<div class="nav-side-menu-full-container hidden-mob-view">
 <div class="nav-side-menu">
<div class="base-margin">
<div class="sidebar-btn">
    <div class="menu-stripes"></div>
    <div class="menu-stripes"></div>
    <div class="menu-stripes"></div>
</div>
<section class="sidebar">
    <nav class="menu"> 
        <ul class="menu-level1 no-style nav nav-pills nav-justified">
       
        <?php if(isset($adminLogin) && $adminLogin==1){ ?>
            <li class=""> <a href="<?php echo $baseFolder."/charters/programs/".$sessionCharterGuest['users_UUID']; ?>">Charter Programs</a></li>
            <!-- <li class="guest-list"> <a href="<?php //echo $baseFolder."/charters/view"; ?>">Guest List</a></li> -->

        <?php }else{ 
            if(isset($sessionCH)){ if($sessionCH == 2){ 
                ?>
          <!-- <li class="guest-list"> <a href="<?php //echo $baseFolder."/charters/view"; ?>">Guest List</a></li> -->
        <?php 
        } 
    } 
    } ?>
          
       
          <li>
              <?php if(isset($mapcharterprogramid) && isset($mapydb_name)){ ?>
              <a href="<?php echo $baseFolder."/charters/charter_program_map/".$mapcharterprogramid.'/'.$mapydb_name; ?>" target="_blank">Cruising Map</a>
              <?php } ?>
            </li>
           <li><a>How To Video</a></li>
            <li class="list-logout-row-inner"><?php echo $this->Html->link($this->Html->image("admin/table.png", array("alt" => "","title" => "Logout")).'  Logout','/',array('escape' =>false,'title' => 'Logout'));?></li>
        </ul>
    </nav>
</section>
</div>
</div>   
</div>
<div class="container-row-all-innerpages">
<div class="nav-side-menu">
<div class="base-margin">
<div id="sidebar-btn" class="sidebar-btn">
    <div class="menu-stripes"></div>
    <div class="menu-stripes"></div>
    <div class="menu-stripes"></div>
</div>
<section id="sidebar" class="sidebar">
    <nav class="menu"> 
        <ul class="menu-level1 no-style nav nav-pills nav-justified">
          <li class="<?php echo $personalDetailsTab; ?>"><a data-toggle="tab" href="#personal_det" class="nav-anch">Personal</a></li>
          <li class="<?php echo $mealPreferenceTab; ?>"><a data-toggle="tab" href="#meals" class="nav-anch">Meal Service</a></li>
          <li class="<?php echo $foodPreferenceTab; ?>"><a data-toggle="tab" href="#food" class="nav-anch">Food</a></li>
          <li class="<?php echo $beveragePreferenceTab; ?>"><a data-toggle="tab" href="#beverage" class="nav-anch">Beverage</a></li>
          <?php if(isset($sessionCH)){
              if($sessionCH == 2){ ?>
          <li class="<?php echo $spiritPreferenceTab; ?>"><a data-toggle="tab" href="#spirit" class="nav-anch">Beer & Spirit</a></li>
          <li class="<?php echo $winePreferenceTab; ?>"><a data-toggle="tab" id="wineTab" href="#wine" class="nav-anch">Wine List</a></li>
          <?php } } else{ ?>
           <li class="<?php echo $spiritPreferenceTab; ?>"><a data-toggle="tab" href="#spirit" class="nav-anch">Beer & Spirit</a></li>
           <li class="<?php echo $winePreferenceTab; ?>"><a data-toggle="tab" id="wineTab" href="#wine" class="nav-anch">Wine List</a></li>
        
          <?php } ?>
          
          <li class="<?php echo $itineraryPreferenceTab; ?>"><a data-toggle="tab" href="#itinerary" class="nav-anch">Itinerary</a></li>
          
            <?php if(isset($adminLogin) && $adminLogin==1){ ?>
                <li class="guest-list none-vew"><a href="<?php echo $baseFolder."/charters/view/".$selectedCHID."/".$selectedCHPRGID."/".$selectedCHPRGCOMID; ?>">Guest List</a></li>
            <?php }else{ if(isset($sessionCH)){ if($sessionCH == 2){ ?>
                <li class="guest-list none-vew"> <a href="<?php echo $baseFolder."/charters/view/".$selectedCHID."/".$selectedCHPRGID."/".$selectedCHPRGCOMID; ?>">Guest List</a></li>
            <?php } } } ?>
          <li class="none-vew"><a href="<?php echo $baseFolder."/charters/charter_program_map/".$mapcharterprogramid.'/'.$mapydb_name; ?>" class="nav-anch" target="_blank">Cruising Map</a></li>
           <li class="none-vew"><a class="nav-anch">How To Video</a></li>
         <li class="list-logout-row-inner none-vew"><?php echo $this->Html->link($this->Html->image("admin/table.png", array("alt" => "","title" => "Logout")).'  Logout','/',array('escape' =>false,'title' => 'Logout'));?></li>
        </ul>
    </nav>
</section>
</div>
</div>

<!-- Tab content -->
    <div class="tab-content container tab-md-row-container">    
        <!-- Personal details -->
        <?php echo $this->element('personal_details', array('session' => $session, 'sessionAssoc' => $sessionAssoc)); ?>
        
        <!-- Meal Preferences -->
        <?php echo $this->element('meal_preferences'); ?>
        
        <!-- Food Preferences -->
        <?php echo $this->element('food_preferences'); ?>
        
        <!-- Beverage Preferences -->
        <?php echo $this->element('beverage_preferences'); ?>
        <?php //if(isset($session['is_head_charterer']) && $session['is_head_charterer'] == 2){ ?>
        <!-- Beer & Spirit Preferences -->
        <?php echo $this->element('spirit_preferences'); ?>
        
        <!-- Wine Preferences -->
        <?php echo $this->element('wine_preferences'); ?>
        <?php //} ?>
        <!-- Itinerary Preferences -->
        <?php echo $this->element('itinerary_preferences'); ?>

         
    </div>


</div>
<script> 
    
// Submit Guests with mail sending
$(".sendMailClass").on("click", function(e) {
    
    var classObj = $(this);
    var rowObj = $(this).closest('tr');
    var error = 0;
    $(".inputError").removeClass('inputError');
    rowObj.find('input:not([name^=is_head_charterer])').each(function(e) {
        if ($(this).val().trim() == "") {
            $(this).addClass("inputError").blur();
            error++;
        } else {
            $(this).removeClass("inputError");
        }
    });
    
    var existCharterHeadId = classObj.data('charterheadid');
    var charterAssocId = classObj.data('charterassocid');
    var headChartererId = $("#headChartererId").val();
    var isHeadCharterer = 0;
    if (rowObj.find("input[name='is_head_charterer']").is(':checked')) {
        isHeadCharterer = 1;
    }
    var salutation = rowObj.find("input[name='salutation']").val();
    var firstName = rowObj.find("input[name='first_name']").val();
    var lastName = rowObj.find("input[name='last_name']").val();
    var email = rowObj.find("input[name='email']").val();
    
    var data = {
        "existCharterHeadId": existCharterHeadId,
        "headChartererId": headChartererId,
        "charterAssocId": charterAssocId,
        "isHeadCharterer": isHeadCharterer,
        "salutation": salutation,
        "firstName": firstName,
        "lastName": lastName,
        "email": email
    };
    
    if (!error) {
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: BASE_FOLDER+'/charters/saveAndSendMail',
            dataType: 'json',
            data: data,
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    classObj.addClass("displayNone");
                    classObj.siblings('.emailSentClass').removeClass("displayNone");
                } else if(result.status == 'invalid_email') {
                    rowObj.find("input[name='email']").addClass('inputError').blur();
                } else {
                    alert(result.message);
                }   
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    } else {
        return false;
    }
    
});

$("#personalDetailsSubmit").on("click", function(e) {
    // Validate file
    var fileName = $('#passportImage').val();
    if(fileName != ''){
       var ext = fileName.split('.').pop().toLowerCase();
        if($.inArray(ext, ['png','jpg','jpeg','pdf']) == -1) {
            alert('Please upload the valid file!');
            return false;
        }
    }    
    
    $("#personalDetailsSubmitOriginal").trigger('click'); 
});

// Datepicker
$(".datePicker").datepicker({
    dateFormat: 'd M yy',
    changeYear: true,
    changeMonth:true,
    yearRange: "-100:+100"
});
var dateToday = new Date();
var dobYearRange = "1900:" + dateToday.getFullYear();
var occationYearRange = dateToday.getFullYear() + ":" + (dateToday.getFullYear() + 5);
// DOB
$(".dobDatePicker").datepicker({
    dateFormat: 'd M yy',
    changeYear: true,
    changeMonth:true,
    yearRange: dobYearRange
});
// Special occations
$(".occationDatePicker").datepicker({
    dateFormat: 'd M yy',
    changeYear: true,
    changeMonth:true,
    yearRange: occationYearRange
});

// Timepicker
$('.timePicker').timepicker({ 
    timeFormat: 'H:i', 
    step: 15 
});

// Make Non-editable fields
$(document).on("keypress", ".nonEditable", function(e) {
    if (e.which != 8) { // Except the Backspace key
        return false;
    }
});

// Restric the paste process
$(document).on('contextmenu', '.numericInput', function (e) {
    return false;
});

// Accepts only digits
$(document).on('keypress', '.numericInput', function (e) {
    var value = $(this).val();
    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && e.which != 44 && (e.which < 48 || e.which > 57)) {

        return false;
   }
});

// Disabling all the fields in case of Header opens the Charter associate's preference sheet
<?php if (isset($charterAssocIdByHeaderView)) { ?>
    $("#personal_det input,select,textarea").attr("disabled", true);
    $("#meals input,select,textarea").attr("disabled", true);
    $("#food input,select,textarea").attr("disabled", true);
    $("#beverage input,select,textarea").attr("disabled", true);
    //$("#wine input,select,textarea").attr("disabled", true);
    $("#itinerary input,select,textarea").attr("disabled", true);
<?php } ?> 
   
// Initialize the Range rover
<?php if (!empty($winePreferenceTab)) { ?>
    $("#range").rangeRover({
        range:true,
        data:{
            start:80,
            end:100,
        }
    });
<?php } ?>    

</script>

<script>
var sidebar = (function() {
    "use strict";
    var $contnet         = $('#content'),
        $sidebar         = $('.sidebar'),
        $li              = $('li'),
        $sidebarBtn      = $('.sidebar-btn'),
        $toggleCol       = $('body').add($contnet).add($sidebarBtn).add($li),
        sidebarIsVisible = false;
    $sidebarBtn.on('click', function() {
        if (!sidebarIsVisible) {
            bindContent();
        } else {
            unbindContent();
        }
        toggleMenu();
    });

 function bindContent() {
        $li.on('click', function() {
            toggleMenu();
            unbindContent();
        });
    }
    function unbindContent() {
        $li.off();
    }
    function toggleMenu() {
        $toggleCol.toggleClass('sidebar-show');
        $sidebar.toggleClass('show');
        if (!sidebarIsVisible) {
            sidebarIsVisible = true;
        } else {
            sidebarIsVisible = false;
        }
    }
})();
$(document).ready(function(){
        //var countries = ["Afghan", "Albanian", "Bahamas", "Bahrain", "Cambodia", "Cameroon", "Denmark", "Djibouti", "East Timor", "Ecuador", "Falkland Islands (Malvinas)", "Faroe Islands", "Gabon", "Gambia", "Haiti", "Heard and Mc Donald Islands", "Iceland", "India", "Jamaica", "Japan", "Kenya", "Kiribati", "Lao People's Democratic Republic", "Latvia", "Macau", "Macedonia", "Namibia", "Nauru", "Oman", "Pakistan", "Palau", "Qatar", "Reunion", "Romania", "Saint Kitts and Nevis", "Saint Lucia", "Taiwan", "Tajikistan", "Uganda", "Ukraine", "Vanuatu", "Vatican City State", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zaire", "Zambia"];
        
                
                var countries = ["Afghan", "Albanian", "Algerian", "American", "Andorran", "Angolan", "Antiguans", "Argentinean", "Armenian", "Australian", "Austrian", "Azerbaijani", "Bahamian", "Bahraini", "Bangladeshi", "Barbadian", "Barbudans", "Batswana", "Belarusian", "Belgian", "Belizean", "Beninese", "Bhutanese", "Bolivian", "Bosnian", "Brazilian", "British", "Bruneian", "Bulgarian", "Burkinabe", "Burmese", "Burundian", "Cambodian", "Cameroonian", "Canadian", "Cape Verdean", "Central African", "Chadian", "Chilean", "Chinese", "Colombian", "Comoran", "Congolese", "Costa Rican", "Croatian", "Cuban", "Cypriot", "Czech", "Danish", "Djibouti", "Dominican", "Dutch", "East Timorese", "Ecuadorean", "Egyptian", "Emirian", "Equatorial Guinean", "Eritrean", "Estonian", "Ethiopian", "Fijian", "Filipino", "Finnish", "French", "Gabonese", "Gambian", "Georgian", "German", "Ghanaian", "Greek", "Grenadian", "Guatemalan", "Guinea-Bissauan", "Guinean", "Guyanese", "Haitian", "Herzegovinian","Honduran","Hungarian","I-Kiribati","Icelander","Indian","Indonesian","Iranian","Iraqi","Irish","Israeli","Italian","Ivorian","Jamaican","Japanese","Jordanian","Kazakhstani","Kenyan","Kittian and Nevisian","Kuwaiti","Kyrgyz","Laotian","Latvian","Lebanese","Liberian","Libyan","Liechtensteiner","Lithuanian","Luxembourger","Macedonian","Malagasy","Malawian","Malaysian","Maldivan","Malian","Maltese","Marshallese","Mauritanian","Mauritian","Mexican","Micronesian","Moldovan","Monacan","Mongolian","Moroccan","Mosotho","Motswana","Mozambican","Namibian","Nauruan","Nepalese","New Zealander","Ni-Vanuatu","Nicaraguan","Nigerian","North Korean","Northern Irish","Norwegian","Omani","Pakistani","Palauan","Panamanian","Papua New Guinean","Paraguayan","Peruvian","Polish","Portuguese","Qatari","Romanian","Russian","Rwandan","Saint Lucian","Salvadoran","Samoan","San Marinese","Sao Tomean","Saudi","Scottish","Senegalese","Serbian","Seychellois","Sierra Leonean","Singaporean","Slovakian","Slovenian","Solomon Islander","Somali","South African","South Korean","Spanish","Sri Lankan","Sudanese","Surinamer","Swazi","Swedish","Swiss","Syrian","Taiwanese","Tajik","Tanzanian","Thai","Togolese","Tongan","Trinidadian or Tobagonian","Tunisian","Turkish","Tuvaluan","Ugandan","Ukrainian","Uruguayan","Uzbekistani","Venezuelan","Vietnamese","Welsh","Yemenite","Zambian","Zimbabwean"];

        var countries_suggestion = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local: countries
        });
        
        $('.typeahead').typeahead(
            { minLength: 1 },
            { source: countries_suggestion }
        );
    });  
</script> 
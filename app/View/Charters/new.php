<?php
    $baseFolder = $this->request->base;
    $cloudUrl = Configure::read('cloudUrl');
    $session = $this->Session->read('charter_info.CharterGuest');
    $sessionData = $this->Session->read();
    
    $salutationList = array(
        "" => "",
        "Mr." => "Mr.",
        "Ms." => "Ms.",
        "Mrs." => "Mrs.",
        "Miss" => "Miss",
        "Dr." => "Dr.",
        "Prof." => "Prof.",
        "Rev." => "Rev.",
        "Lady" => "Lady",
        "Sir" => "Sir",
        "The Hon. Mr" => "The Hon. Mr",
        "The Hon. Mrs" => "The Hon. Mrs",
        "Dame" => "Dame",
        "Monsieur" => "Monsieur",
        "Madame" => "Madame",
        "Judge" => "Judge",
        "Lord" => "Lord",
    );
?>
<style>
.yachtHeaderName{font-weight: bold;font-size: 46px;}
.navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form{
border:none;
}


.tooltip{top:-20px;position: absolute!important;}

.navbar-inverse{
border:none;
 }

.container-row-column .row{margin-bottom: 10px;}
    table.table tbody tr {
        background: none !important;
    }
    .label-bold {
        font-weight: bold;
		margin-bottom:5px;
		display:inline-block;
		font-size:22px;
    }
    .inputError { 
        border:  1px solid red; 
    }
    .displayNone {
        display: none;
    }
    .emailFieldClass {
        width: 30%;
    }
    .table.table-condensed.no-border td {
        border: 0;
    }
    .pSheetClass {
		width:80px;
        height: 29px;
        background: #fefefe;
        display: flex;
        border: 1px solid #c5c5c5;
    }
    .pSheetClass img {
        margin: auto;
    }
	.ds-flex{
		display:flex;
		}
		.ds-flex .flex-tb-items{
			flex-wrap:wrap;
			}
	.table-condensed > thead > tr > th{
		padding:5px;
		}

#saveBtn{margin-right: 15px;border-radius: 0px;}

.center-img{margin-left: 15px;
    width: 100%;
    text-align: center;}
.center-img p{
    margin-bottom:5px;
font-weight: bold;
    font-size: 14px;color: #000;
}
.center-img p a{color: #000;    text-decoration: underline;}
.flexrow {
        width: 100%;
    display: inline-block;
    padding: 10px 50px 0px 0px;
}

.flexrow .one {
    float: left;
        margin-top: 101px;
}

.flexrow .two {
    float: right;
    width:65%;

}

.table-condensed>tbody>tr>td.td-cnt{text-align: left;}

.flexrow .three {
    float: right;
    margin-top: 15px;
}

.round-logo {
    margin: auto;    position: relative;
}

.navbar-nav.navbar-user > li > .dropdown-menu > li a{    background: #fff!important;
    border-radius: 0px!important;}


.round-logo p{color: #000;font-weight: bold;font-size: 14px;    margin: 0px;}
.round-logo p a{color: #000;font-weight: bold;font-size: 14px;text-decoration: underline;text-align: center;}

.round-logo i {
    font-size: 102px;
    color: #03a9f4;
}
.round-logo .map-row:after{
    content: "";
    background: #fff;
    height: 82px;
    width: 81px;
    display: inline-block;
    left: 2px;
    position: absolute;
    z-index: -1;
    border-radius: 100%;
    top: 10px;

}




.round-logo a {
    display: block;
    text-align: center;
}
                
.info-win{
    float: right;
    /*position: relative;*/
    bottom: 27px;
    color:#428bca;
    left: 15px;
    height: 0px;
    font-size: 14px;
}                
.yes-btn{    background: rgba(10, 230, 87, 0.58);
    border: none;
    color: #000;
    font-weight: bold;
    padding: 5px 10px;height: 34px;}
.no-btn{
         background: rgba(241, 28, 28, 0.52);
    border: none;
    color: #000;
    font-weight: bold;
    padding: 5px 10px;height: 34px;}

.header-row div{
    float: left;
    color: #000;
    font-size: 14px;
    text-align: center;
    float: left;
    font-weight: bold;
    margin: 0px 0.4%;
    text-transform: uppercase;
    top:10px;position: relative;
}
.btn-open{
    font-size: 13px;
    background: rgba(10, 230, 87, 0.58);
    border: none;
    float: initial;
    color: #000;
    font-weight: bold;
    opacity: 40!important;
    padding: 8px 25px;
    border-radius: 0px;
    margin: 0px 5px;
     height: 34px!important;
}
.newGuestAssoc{display: none;}

.btn-primary{display: none!important;}


.md-left-text{    text-align: left!important;
    padding: -3px;
    margin-left: -5px;
    position: relative;
    left: -13px;
    top:-10px!important;


}

.md-left-text .fa{    position: absolute;
    top: -1px;
    font-size: 16px;
    right: 3px;
    color: #0091e6;
    cursor: pointer;
    border: solid 1px #fff;
    border-radius: 100%;
}
.form-control{border-radius: 0px;border: none;
  border-top: solid 1.5px rgba(2, 2, 2, 0.40);
  border-left: solid 1.5px rgba(2, 2, 2, 0.40);
    background: rgba(241, 235, 235, 0.76);
    border-bottom: solid 1.5px #fff;
    border-right: solid 1.5px #fff;
    padding: 6px 7px;


}

.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control{

    background: rgba(255, 255, 255, 0.83); 
    border-top: solid 1.5px rgba(2, 2, 2, 0.40);
    border-left: solid 1.5px rgba(2, 2, 2, 0.40);
    border-bottom: solid 1.5px #fff;
    border-right: solid 1.5px #fff;

}
.form-two{ background: rgba(255, 255, 255, 0.83)!important;}


.btn-eml-send{font-size: 13px;
          background: rgba(241, 28, 28, 0.52);
    border: none;
    float: left;
    color: #000!important;
    font-weight: bold;
    opacity: 40!important;
    padding: 8px 5px;
    border-radius: 0px;margin:0% 0.3%;
    height: 34px;

}
.container-row-column .row>section>div{
    float: left;    margin: 0px 0.4%;
}
.owl-carousel label{width:100%;display: none;}
.container-row-column{margin: 0px 13px;}
.bigitem{float: left;
    flex: none!important;}
.md-row-h-10{width:15%;}
.md-row-h-8{width:8%;}
.md-row-h-18{width:18%;}
.md-row-h-12{width:11%;}
.md-row-h-30{width:28%;}
.md-row-h-20{width:15%;}
.header-row {width:100%;display: inline-block;margin: 0px 13px;}
.container-row-column .row>div {float: left;margin: 0px 0.4%;}


@media screen and (max-width: 1200px) {

.md-row-h-10{width:14%;}
.md-row-h-8{width:10%;}
.md-row-h-18{width:20%;}
.md-row-h-12{width:11%;}
.md-row-h-30{width:24%;}
.header-row div{font-size:12px;}
}


@media screen and (max-width: 768px) {
.footer-mob-row {    width: 100%;
    border-top: solid 3px rgba(0, 0, 0, 0.47);
    padding: 15px 0px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
}  
    .owl-carousel label {
    width: 100%;
    display: block;
}

.footer-mob-row  .btn-success {
    color: #000;
    background-color: rgba(5, 156, 226, 0.83);
    border-color: #7dc6ec;
    width: 141px;
    font-weight: bolder;
    font-size: 18px;
}

.container-row-column {
    margin: 55px 13px 0px 13px;
}
.navbar-inverse .navbar-brand {
    margin-top:40px;    line-height: normal;
    width: 100%;
    text-align: left;
    left: 88px;
    left:;
    position: absolute;
    padding: 0px!important;
}
.md-row-h-12{width:30%;}
.md-row-h-10 {width:33.555%;}
.md-row-h-8{    width: 50%;
    float: right;
    position: absolute;
    top: 192px;
}
.rowm-md-mob-resize{display: inline-block;margin: 2px 0px!important;width:100%;}
.md-row-h-30{display: inline-block;margin:5px 2px!important;width:98.9%;}
.md-row-h-18 {
        width: 197px;
    float: right!important;
}
.bigitem{width:100%;display: inline-block;}
.map-row{display: none!important;}
.flexrow .two {
    float: left;
    width: 100%;
}
.flexrow .one{
        float: left;
    width: 50%;
    margin-top: -45px;
}
.flexrow {
    width: 100%;
    display: inline-block;
    padding: 0px;
}
.flexrow .three {
        margin-top:0px;
        width: 50%;
    text-align: center;
}
.header-row {
    width: 100%;
    display: none;
}

.btn-eml-send{float: right;}
.btn-open{float: right;}

.collapse {
     display: block!important;
    position: relative;
    left: 87px;
    top: -34px;
    width: 100%;
    float: left;
}
.navbar-right{width:80%!important;max-width: 80%!important;}

.navbar-nav.navbar-user > li > .dropdown-menu > li a{
    float: right;
    background: none!important;
    margin-top: -48px;
    left: 34px;
    position: relative;
    color: #fff;
}


}


</style>
<?php 
    echo $this->Html->css('charter/style');
?>    
<script>
    var BASE_FOLDER = "<?php echo $baseFolder; ?>";
</script> 
<br><br>

<div class="flexrow flexrow-full-container">

    <div class="two">
    	<div class="bigitem">
          <!--   <span class="label-bold" style="font-size: 35px;color: #fff;"> <?php echo isset($companyData['Fleetcompany']['management_company_name']) ? $companyData['Fleetcompany']['management_company_name'] : ""; ?></span>	<br> -->
            <span class="label-bold"  style="font-size: 35px;color: #fff;"> <?php echo $session['yacht_name']; ?></span>	<br>
            <span class="label-bold" style="font-size: 35px;"><?php echo $charterData['CharterGuest']['charter_name']; ?></span><br>
            <span class="label-bold"><?php echo date_format(date_create($charterData['CharterGuest']['charter_from_date']), 'dS F Y')." to ".date_format(date_create($charterData['CharterGuest']['charter_to_date']), 'dS F Y'); ?></span><br><br>
           <!--  <span>Enter the name and email of the guest and press the button to send them their preference forms.</span> -->
        </div>

   <div class="three">
    <div class="round-logo">
        <a href="charter_program_map" class="map-row"><i class="fa fa-globe fa-fnt fa-pos" aria-hidden="true"></i></a>
        <p>Cruising Map</p>
        <p><a>Click to View</a></p>
    </div>

</div>



    </div>

    <div class="one">
        <div class="center-img">
            <p>New to Charter Guest?</p>
            <p><a>Click Here To Learn</a></p>
            <!-- <?php if (isset($sessionData["fleetLogoUrl"]) && !empty($sessionData["fleetLogoUrl"])) { ?>
                <img src="<?php echo $sessionData["fleetLogoUrl"]; ?>" alt="">
            <?php } ?>  -->
        </div>
    </div>
</div>

<div class="container-fluid">
        <!-- Head charterer id -->
        <input type="hidden" id="headChartererId" value="<?php echo $charterData['CharterGuest']['id']; ?>">
        <!-- Charter program id -->
        <input type="hidden" id="charterProgramId" value="<?php echo $charterData['CharterGuest']['charter_program_id']; ?>">
        <!-- Yacht id -->
        <input type="hidden" id="yachtId" value="<?php echo $charterData['CharterGuest']['yacht_id']; ?>">
        <!-- Charter head salutation -->
        <input type="hidden" id="existSalutation" value="<?php echo $charterData['CharterGuest']['salutation']; ?>">

<div class="table table-condensed no-border" id="guestDetailsTable">
<div class="header-row">
<div class="tcont-center md-row-h-8 md-left-text">Head Charterer<span><a href="#" data-toggle="tooltip" data-placement="top" title="Information"><i class="fa fa-info-circle"></i></a></span> </div>
<div class="tcont-center md-row-h-12">Title</div>
<div class="tcont-center md-row-h-20">First Name</div>
<div class="tcont-center md-row-h-20">Last Name</div>
<div class="tcont-center emailFieldClass md-row-h-30">Email-Address</div>
<div class="tcont-center md-row-h-20">Preference Sheets</div>
<!--    <th class="tcont-center" colspan="2">Submitted P-Sheets</th> -->
</div>
<div id="charterguest" class="owl-carousel owl-theme">
                                <!-- Head Charterer info -->
                                <div class="charterRow">
                                   <div class="container-row-column">
                                    <div class="row">
                                    <!-- Head charterer id -->
                                    <input type="hidden" class="rowInput" name="charter_guest_id" value="<?php echo $charterData['CharterGuest']['id']; ?>">
                                    <!-- Charter program id -->
                                    <input type="hidden" class="rowInput" name="charter_program_id" value="<?php echo $charterData['CharterGuest']['charter_program_id']; ?>">
                                    <!-- Yacht id -->
                                    <input type="hidden" class="rowInput" name="yacht_id" value="<?php echo $charterData['CharterGuest']['yacht_id']; ?>">
                                    <!-- Empty assoc id -->
                                    <input type="hidden" class="rowInput newGuestAssocId" name="charter_assoc_id[]" value="">
 
                                    <div class="md-row-h-8">
                                        <label>Head Charterer</label>
                                        <button class="yes-btn">Yes</button>
                                        <button class="no-btn">No</button>

                                    </div>
                                  
                                      <section class="rowm-md-mob-resize">

                                        <div class="md-row-h-12"> 
                                        <label>Title</label> 
                                            <?php echo $this->Form->input("salutation",array("id" => "headCharterSalutation", "label"=>false,'name' => 'salutation[]','options' => $salutationList,'class'=>'form-control form-two tinput rowInput validateInput','default' => $charterData['CharterGuest']['salutation'])); ?>
                                        </div>




                                         <div class="md-row-h-10"> 
                                            <label>First Name</label>  
                                            <input type="text" class="form-control tinput rowInput" name="first_name[]" value="<?php echo $charterData['CharterGuest']['first_name']; ?>" readonly="true"></div>
                                        <div class="md-row-h-10"> 
                                            <label>Last Name</label> 
                                            <input type="text" class="form-control tinput rowInput" name="last_name[]" value="<?php echo $charterData['CharterGuest']['last_name']; ?>" readonly="true" ></div>
                                       </section>

                                           <div class="md-row-h-30"> 
                                           <label>Email-Address</label>  
                                                            <input type="text" class="form-control tinput rowInput" name="email[]"  value="<?php echo $charterData['CharterGuest']['email']; ?>" readonly="true">
                                                
                                        </div>
                                        <div class="md-row-h-18">
                                             <label>Preference Sheets</label>  
                                          <a href="preference"><button type="button" class="btn btn-open">OPEN</button></a>


                                                                <button type="button" data-charterHeadId="<?php echo $charterData['CharterGuest']['id']; ?>" data-charterAssocId="" class="btn  btn-eml-send sendMailClass <?php echo ($charterData['CharterGuest']['is_email_sent']) ? "displayNone" : ""; ?>" disabled="true">SEND</button>
                                                                <button type="button" data-charterHeadId="<?php echo $charterData['CharterGuest']['id']; ?>" data-charterAssocId="" class="btn btn-eml-send emailSentClass <?php echo ($charterData['CharterGuest']['is_email_sent']) ? "" : "displayNone"; ?>">SENT</button>
         
                                           
                                </div>
                                </div></div>                                        </div>
                            <?php 
                            $i = 2;
                            foreach ($charterAssocData as $charterAssoc) { ?>  
                                <!-- Existing Guest associates -->
                                <div class="charterRow">
                                <div class="container-row-column">
                                <div class="row">
                                    
                                        <!-- Exist Charter assoc id -->
                                        <input type="hidden" class="rowInput newGuestAssocId" name="charter_assoc_id[]" value="<?php echo $charterAssoc['CharterGuestAssociate']['id']; ?>">


                                         <div class="md-row-h-8">
                                         <label>Head Charterer</label>   
                                        <button class="yes-btn">Yes</button>
                                        <button class="no-btn">No</button>

                                    </div>
                                    
                                        <!-- <div class="td-cnt"><?php echo $i; ?></div> -->
                                        <!-- <td class="td-cnt td-check"><input class="cbox-sz isHeadCharterer" type="checkbox" name="is_head_charterer" <?php echo ($charterAssoc['CharterGuestAssociate']['is_head_charterer']) ? "checked" : ""; ?>></td> -->
                                         <section class="rowm-md-mob-resize">
                                       <div class="md-row-h-12">
                                        <label>Ttile</label>
                                        <input type="hidden" class="isHeadChartererChecked rowInput" name="is_head_charterer_checked[]" value="<?php echo ($charterAssoc['CharterGuestAssociate']['is_head_charterer']) ? "1" : "0"; ?>">
                                  
                                            <?php echo $this->Form->input("salutation",array("label"=>false,'name' => 'salutation[]','options' => $salutationList,'class'=>'form-control tinput rowInput validateInput','default' => $charterAssoc['CharterGuestAssociate']['salutation'])); ?>
                                        </div>
                                        <div class="md-row-h-10">
                                            <label>First Name</label>
                                            <input type="text" class="form-control tinput rowInput validateInput" name="first_name[]" value="<?php echo $charterAssoc['CharterGuestAssociate']['first_name']; ?>"></div>
                                        <div class="md-row-h-10">
                                          <label>Last Name</label>
                                            <input type="text" class="form-control tinput rowInput validateInput" name="last_name[]" value="<?php echo $charterAssoc['CharterGuestAssociate']['last_name']; ?>"></div>
                                    </section>
                                        <div class="md-row-h-30">
                                                   <label>Email-Address</label>
                                                                <input type="text" class="form-control tinput rowInput validateInput"  name="email[]" value="<?php echo $charterAssoc['CharterGuestAssociate']['email']; ?>">

                                           

                                 
                                            <?php 
                                                $sendMailBtnDisable = "";
                                                // Disabling the SEND MAIL button if head charterer is checked
                                                if ($charterAssoc['CharterGuestAssociate']['is_head_charterer']) {
                                                    $sendMailBtnDisable = "disabled";
                                                }
                                            ?>         </div>
                                               <div class="md-row-h-18">
                                               <label>Preference Sheets</label>
                                                 <?php
                                                $openButtonLink = "javascript:void(0);";
                                                $openBtnColor = "btn-default";
                                                $openBtnDisable = "disabled";
                                                // Enabling the button and will be read-only pages If P-sheets done
                                                if ($charterAssoc['CharterGuestAssociate']['is_psheets_done']) {
                                                    $openButtonLink = "preference?id=". base64_encode($charterAssoc['CharterGuestAssociate']['id']);
                                                    $openBtnColor = "btn-primary";
                                                    $openBtnDisable = "";
                                                }
                                                // Enabling the button and will be editable pages If Head Charterer is checked
                                                if ($charterAssoc['CharterGuestAssociate']['is_head_charterer']) {
                                                    $openButtonLink = "preference?assocId=". base64_encode($charterAssoc['CharterGuestAssociate']['id']);
                                                    $openBtnColor = "btn-primary";
                                                    $openBtnDisable = "";
                                                }
                                                
                                            ?>
                                            <a href="<?php echo $openButtonLink; ?>"><button type="button" class="btn btn-open <?php echo $openBtnColor; ?>" <?php echo $openBtnDisable; ?>>OPEN</button></a>



                                                                <button type="button" data-charterHeadId=""  data-charterAssocId="<?php echo $charterAssoc['CharterGuestAssociate']['id']; ?>" class="btn btn-danger btn-eml-send sendMailClass <?php echo ($charterAssoc['CharterGuestAssociate']['is_email_sent']) ? "displayNone" : ""; ?>" <?php echo $sendMailBtnDisable; ?>>SEND</button>
                                                                <button type="button" data-charterHeadId=""  data-charterAssocId="<?php echo $charterAssoc['CharterGuestAssociate']['id']; ?>"  class="btn btn-success btn-eml-send emailSentClass <?php echo ($charterAssoc['CharterGuestAssociate']['is_email_sent']) ? "" : "displayNone"; ?>">SENT</button>
                                       
                                           
                                      </div>
                                </div> </div> </div>
                            <?php 
                                $i++;
                            } 
                            ?>
                             
                            <?php for ($j = $i; $j <= $charterData['CharterGuest']['no_of_guests']; $j++) { ?> 
                                <!-- New Associates -->
                                <div class="charterRow newGuestAssocRow">
                                <div class="container-row-column">
                                    <div class="row">
                                    <div class="md-row-h-8">
                                        <label>Head Charterer</label>
                                    <button class="yes-btn">Yes</button>
                                    <button class="no-btn">No</button>
                                    </div>
                                              <section class="rowm-md-mob-resize">
                                       <div class="md-row-h-12">  
                                        <label>Titile</label>
                                            <?php echo $this->Form->input("salutation",array("label"=>false,'name' => 'salutation[]','options' => $salutationList,'class'=>'form-control tinput rowInput validateInput')); ?>
                                        </div>
                                        <div class="md-row-h-10">
                                             <label>First Name</label>
                                            <input type="text" class="form-control tinput rowInput validateInput" name="first_name[]" value="">
                                        </div>
                                        <div class="md-row-h-10">
                                             <label>Last Name</label>
                                            <input type="text" class="form-control tinput rowInput validateInput" name="last_name[]" value="">
                                        </div>
                                    </section>
                                        <div class="md-row-h-30">
                                             <label>Email-Address</label>
                                                                <input type="text" class="form-control tinput rowInput validateInput"  name="email[]" value="">
    
                                        </div>
    
                                         <div class="md-row-h-18">
                                            <label>Preference Sheets</label>
                                             <a href="javascript:void(0);" data-charterHeadId=""  data-charterAssocId=""  class="btn btn-default btn-open newGuestAssoc" disabled>OPEN</a> 
                                           <button type="button" data-charterHeadId=""  data-charterAssocId="" class="btn btn-danger btn-eml-send sendMailClass">SEND</button>
                                        <button type="button" data-charterHeadId=""  data-charterAssocId="" class="btn btn-success btn-eml-send emailSentClass displayNone">SENT</button>
                                                 
                                              

                                               </div>
                                </div>                     </div>                </div>
                            <?php } ?>     
   



          </div></div></div>
<div class="col-md-12">
            <div class="pull-right footer-mob-row">
                <button class="btn btn-success" id="saveBtn">Save</button>
            </div>
        </div> 
</div>

<script> 
    
// Submit Guests with mail sending
$(".sendMailClass").on("click", function(e) {
    
    var classObj = $(this);
    var rowObj = $(this).closest('tr');
    var error = 0;
    $(".inputError").removeClass('inputError');
    rowObj.find('input:not([name^=is_head_charterer]),select').not("input[type='hidden']").each(function(e) {
        if ($(this).val().trim() == "") {
            $(this).addClass("inputError").blur();
            error++;
        } else {
            $(this).removeClass("inputError");
        }
    });
    
    var yachtId = $("#yachtId").val();
    var charterProgramId = $("#charterProgramId").val();
    var existCharterHeadId = classObj.data('charterheadid');
    var charterAssocId = classObj.data('charterassocid');
    var headChartererId = $("#headChartererId").val();
    var isHeadCharterer = 0;
    if (rowObj.find("input[name='is_head_charterer']").is(':checked')) {
        isHeadCharterer = 1;
    }
    var salutation = rowObj.find("select[name='salutation[]']").val();
    var firstName = rowObj.find("input[name='first_name[]']").val();
    var lastName = rowObj.find("input[name='last_name[]']").val();
    var email = rowObj.find("input[name='email[]']").val();
    
    var data = {
        "yachtId": yachtId,
        "charterProgramId": charterProgramId,
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
                    if (isHeadCharterer == 1 && result.assocIdLink != undefined && result.assocIdLink != "") {
                        rowObj.find('.newGuestAssoc').attr("href", result.assocIdLink);
                        rowObj.find('.newGuestAssoc').removeAttr("disabled");
                        rowObj.find('.newGuestAssoc').removeClass("btn-default").addClass("btn-primary");
                    }
                    // Including the inserted Charter assoc id
                    if (result.newGuestAssocId != undefined && result.newGuestAssocId != "") {
                        rowObj.find('.newGuestAssocId').val(result.newGuestAssocId);
                    }
                } else if(result.status == 'invalid_email') {
                    rowObj.find("input[name='email[]']").addClass('inputError').blur();
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

// Head charterer checkbox onchange
// Submit Guests with mail sending
$(".isHeadCharterer").on("click", function(e) {
    if ($(this).is(":checked")) {
        $(this).closest("tr").find(".isHeadChartererChecked").val(1);
        $(this).closest("tr").find(".sendMailClass").attr("disabled", true);
        $(this).closest("tr").find(".newGuestAssoc").attr("disabled", false);
        $(this).closest("tr").find(".newGuestAssoc").removeClass("btn-default").addClass("btn-primary");
        $(this).closest("tr").find(".inputError").removeClass("inputError");
    } else {
        $(this).closest("tr").find(".isHeadChartererChecked").val(0);
        $(this).closest("tr").find(".sendMailClass").attr("disabled", false);
        $(this).closest("tr").find(".newGuestAssoc").attr("disabled", true);
        $(this).closest("tr").find(".newGuestAssoc").removeClass("btn-primary").addClass("btn-default");
    }
});

// Submit and Redirect to the Preference pages when OPEN button clicked(If Head charterer is checked)
$(".newGuestAssoc").on("click", function(e) {
    
    var classObj = $(this);
    var rowObj = $(this).closest('tr');
    var error = 0;
    $(".inputError").removeClass('inputError');
    rowObj.find('input:not([name^=is_head_charterer]),select').each(function(e) {
        if ($(this).val().trim() == "") {
            $(this).addClass("inputError").blur();
            error++;
        } else {
            $(this).removeClass("inputError");
        }
    });
    
    var yachtId = $("#yachtId").val();
    var charterProgramId = $("#charterProgramId").val();
    var existCharterHeadId = classObj.data('charterheadid');
    var charterAssocId = classObj.data('charterassocid');
    var headChartererId = $("#headChartererId").val();
    var isHeadCharterer = 0;
    if (rowObj.find("input[name='is_head_charterer']").is(':checked')) {
        isHeadCharterer = 1;
    }
    var salutation = rowObj.find("select[name='salutation[]']").val();
    var firstName = rowObj.find("input[name='first_name[]']").val();
    var lastName = rowObj.find("input[name='last_name[]']").val();
    var email = rowObj.find("input[name='email[]']").val();
    
    var data = {
        "yachtId": yachtId,
        "charterProgramId": charterProgramId,
        "existCharterHeadId": existCharterHeadId,
        "headChartererId": headChartererId,
        "charterAssocId": charterAssocId,
        "isHeadCharterer": isHeadCharterer,
        "salutation": salutation,
        "firstName": firstName,
        "lastName": lastName,
        "email": email,
        "mailSending": "no"
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
                    if (isHeadCharterer == 1 && result.assocIdLink != undefined && result.assocIdLink != "") {
                        classObj.attr("href", result.assocIdLink);
                        window.location.href = result.assocIdLink;
                    }
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

// Saving the newly entered Associates details
$("#saveBtn").on("click", function(e) {
    
    // Validation
    var error = 0;
    $(".inputError").removeClass('inputError');
    $("#guestDetailsTable tr").each(function (e) {
        var empty = 0;
        $(this).find(".validateInput").each(function () {
            if ($(this).val().trim() == "") {
                $(this).addClass("inputError").blur();
                empty++;
                error++;
            } else {
                $(this).removeClass("inputError");
            }
        });
        if (empty == 4) {
            $(this).find(".validateInput").removeClass("inputError");
            error -= 4;
        } else if (empty > 0) {
            return true; // Break the loop
        }
    });
    
    if (!error) {
        var data = $("#guestDetailsTable tr").find(".rowInput").serialize();
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: BASE_FOLDER+'/charters/saveGuests',
            dataType: 'json',
            data: data,
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    location.reload();
                } else {

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

</script>

<script type="text/javascript">
    $(document).ready(function() {
  $(".owl-carousel").owlCarousel({
      navigation : true, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
       loop:true,
      singleItem:true,
      mouseDrag : false,
      touchDrag : false,
      //navigationText: ["&lsaquo;","&rsaquo;"]
    stagePadding: 0,
    margin:0
  });
 
});

</script>


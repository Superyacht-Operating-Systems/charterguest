<script>
    $("#hideloader").show();
</script>
<?php
    $baseFolder = $this->request->base;
    $session = $this->Session->read('charter_info.CharterGuest'); 
    $sessionAssoc = $this->Session->read('charter_assoc_info');
    $adminLogin = $this->Session->read('charter_info.CharterGuest.Adminlogin');
     $selectedCHID = $this->Session->read('selectedCHID');
     $selectedCHPRGID = $this->Session->read('selectedCHPRGID');
     $selectedCHPRGCOMID = $this->Session->read('selectedCHPRGCOMID');
    
    if(isset($charterAssocIdisHeadChecked) && $charterAssocIdisHeadChecked!=''){
    $sessionCH = $charterAssocIdisHeadChecked;//$sessionAssoc['CharterGuestAssociate']['is_head_charterer'];
    }
    if(isset($sessionAssoc['CharterGuestAssociate']['is_head_charterer']) && $sessionAssoc['CharterGuestAssociate']['is_head_charterer']!=''){
    $sessionCH = $sessionAssoc['CharterGuestAssociate']['is_head_charterer'];
    }
    //echo $sessionCH.'llllll';exit('ddd');

    $sessionCharterGuest = $this->Session->read('charter_info.CharterGuest');

    $sessionCharterGuestAssociate = $this->Session->read('charter_info.CharterGuestAssociate');

            $ownerprefenceID = $this->Session->read('ownerprefenceID');
            $ownerprefenceUUID = $this->Session->read('ownerprefenceUUID');

            $selectedCharterProgramUUID = $this->Session->read('selectedCharterProgramUUID');

            $assocprefenceID = $this->Session->read('assocprefenceID');
            $assocprefenceUUID = $this->Session->read('assocprefenceUUID');

            $base = $this->request->base;

            // echo "<pre>"; print_r($this->Session->read()); 
    //exit;

    $iti_guestListUUID_beforeleave = $this->Session->read('guestListUUID');
 $iti_selectedCharterProgramUUID_beforeleave = $this->Session->read('selectedCharterProgramUUID'); 

 $isgenerateWineOrderPdf = $this->Session->read('isgenerateWineOrderPdf'); 
 if($isgenerateWineOrderPdf==true){
    ?>
    <script>
        console.log("filepath jhghjg")
        var filepath = "<?php echo $baseFolder; ?>/charters/generateWineOrderPdf";
        console.log("filepath=",filepath)
        console.log("isgenerateWineOrderPdf=",<?php echo $isgenerateWineOrderPdf; ?>)
        downloadFile(filepath);

        function downloadFile(filePath){
            var link=document.createElement('a');
            link.href = filePath;
            link.download = filePath.substr(filePath.lastIndexOf('/') + 1);
            link.click();
        }
    </script>
    <?php
 }

 $isgenerateProductOrderPdf = $this->Session->read('isgenerateProductOrderPdf'); 
 if($isgenerateProductOrderPdf==true){
    ?>
    <script>
        console.log("filepath jhghjg")
        var filepath = "<?php echo $baseFolder; ?>/charters/generateProductOrderPdf";
        console.log("filepath=",filepath)
        downloadFile(filepath);

        function downloadFile(filePath){
            var link=document.createElement('a');
            link.href = filePath;
            link.download = filePath.substr(filePath.lastIndexOf('/') + 1);
            link.click();
        }
</script>
    <?php
 }
?>

<?php 
    echo $this->Html->css('preference/style');
?>

<style>
    .occDate .form-control {
    padding: 6px 8px;
}
    .modalmsg {
    text-align: center;
    padding: 20px 0px!important;
}
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

/* sub menu */
.menu__item{
    cursor: pointer;
}
.menu > li{
  /* display: inline-block; */
  margin-right: 10px;
  position: relative;
  cursor: pointer;
}
.menu .menu__item a {
  text-decoration: none;
  padding: 10px 20px;
   color: #000;
  transition: 0.5s;
}
.menu .menu__item {
  list-style: none;}
.nav-side-menu-full-container .nav-side-menu .sidebar.show{
    overflow-y: inherit;
}
.menu .submenu {
    position: absolute;
    margin-left:182px;
    padding-left: 0;
    top: 0px;
  display: none;
}
.menu .submenu .menu__item{
    display: inline-block;
        width: 100%;
}
.menu .submenu .menu__item a{
    display: inline-block;
        word-break: break-all;
}
.menu .submenu .menu__item a:hover{
    color:#fff !important;
    background: #149be9 !important;
}
.modal {
  z-index: 9999;
}
@media only screen and (max-width: 767px){
    body .menu .submenu .menu__item a {
  background: #a4a0a0!important;
  color: #000;
}
body .menu .menu__item a{
    background: #a4a0a0!important;
  color: #000;
}
    .nav-side-menu .sidebar {
  width: 190px;
    }

.nav-side-menu .sidebar.show {
  transform: translate(0);
  overflow-y: inherit;
}
body .menu .submenu .menu__item a {
  padding: 8px 8px;
  border: none;
}
.menu .submenu .menu__item:hover{
    color:#fff;
}
}

@media screen and (max-width: 990px) {
.nav-side-menu {
    display: block;
}
.label-bold {
        font-size:16px;
    }
}
.menu .submenu{
    right:-164px !important;
}

.menu .submenu .menu__item a {
    width: 160px !important;
    
}

@media screen and (max-width:375px)  { /* smartphones, iPhone, portrait 480x320 phones */ 
    .tt-menu{
        position:initial !important;
    }
}

@media screen and (max-width:411px)  { /* smartphones, iPhone, portrait 480x320 phones */ 
    .tt-menu{
        position:initial !important;
    }
}

@media screen and (max-width:414px)  { /* smartphones, iPhone, portrait 480x320 phones */ 
    .tt-menu{
        position:initial !important;
    }
}

@media screen and (max-width:540px)  { /* smartphones, iPhone, portrait 480x320 phones */ 
    .tt-menu{
        position:initial !important;
    }
}


</style>

<?php
// Dynamic color
    $session = $this->Session->read();
    if(isset($session['pSheetsColor']) && $session['pSheetsColor'] != ''){
      $pSheetsColor = $session['pSheetsColor'];
    ?>
    <style>
        .nav > li > a:hover, .nav > li > a:focus {
            background: <?php echo $pSheetsColor; ?> !important;
        }
        .nav-pills>li.active>a.nav-anch {
            background-color: <?php echo $pSheetsColor; ?> !important;
        }
        .checkbox input[type="checkbox"]:checked + label::before{
            background-color: <?php echo $pSheetsColor; ?> !important;
        }
        .radio input[type="radio"]:checked + label::after{
            background: <?php echo $pSheetsColor; ?> !important;
        }
        .lastbutton {
            background: <?php echo $pSheetsColor; ?> !important;
        }
        .selectProductRow {
            background: <?php echo $pSheetsColor; ?> !important;
        }
        .productFilter {
            background: <?php echo $pSheetsColor; ?> !important;
        }
        .select-btn {
            background: <?php echo $pSheetsColor; ?> !important;
        }
        .selectWineRow {
            background: <?php echo $pSheetsColor; ?> !important;
        }
        .wineFilter {
            background: <?php echo $pSheetsColor; ?> !important;
        }
        .ds-category {
            background: <?php echo $pSheetsColor; ?> !important;
        }
        .pagination > .active > span {
            background: <?php echo $pSheetsColor; ?> !important;
        }

    </style>
<?php } ?>
<!-- Dynamic color -->

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
<div  class="sidebar-btn">
    <div class="menu-stripes"></div>
    <div class="menu-stripes"></div>
    <div class="menu-stripes"></div>
</div>
<section class="sidebar" >
    <nav class="menu"> 
        <ul class="menu menu-level1 no-style nav nav-pills nav-justified">
       
        <?php //if(isset($adminLogin) && $adminLogin==1){ ?>
            <li class="pagleave"> <a href="<?php echo $baseFolder."/charters/programs/".$session['guestListUUID'];  ?>">Charter Programs</a></li>
            <!-- <li class="guest-list"> <a href="<?php //echo $baseFolder."/charters/view"; ?>">Guest List</a></li> -->

        <?php //}
     ?>
          
       
          <!-- <li>
              <?php //if(isset($mapcharterprogramid) && isset($mapydb_name)){ ?>
              <a href="<?php //echo $baseFolder."/charters/charter_program_map/".$mapcharterprogramid.'/'.$mapydb_name.'/owner'; ?>" target="_blank">Cruising Map</a>
              <?php //} ?>
            </li> -->
            <?php if(empty($mapdetails)){ 
                $title  = "Not published";
            }else if(!empty($mapdetails)){
                    $title  = "";
            } ?>
             <?php if(isset($ownerprefenceID) && !empty($ownerprefenceID)){ ?>
            <li class="menu__item pagleave"><a href="<?php echo $baseFolder."/charters/view/".$ownerprefenceID."/".$selectedCharterProgramUUID."/".$sessionCharterGuest['charter_company_id']; ?>">Guest List</a></li>
            <?php }else if(isset($assocprefenceID) && !empty($assocprefenceID)){ ?>
                <li class="menu__item pagleave"><a href="<?php echo $baseFolder."/charters/view_guest/".$selectedCharterProgramUUID."/".$sessionCharterGuest['charter_company_id']; ?>">Guest List</a></li>
                <?php } ?>   
                <?php if(isset($ownerprefenceID) && !empty($ownerprefenceID)){ ?> 
                <li class="menu__item"> <a href="#" title="<?php echo $title; ?>">Cruising Map</a>
                    <?php  if(isset($mapdetails)){ ?>
                        <ul class="submenu">
                            <?php foreach($mapdetails as $startdate => $data){ ?>
                                <li class="menu__item pagleave"><a href="<?php echo $baseFolder."/charters/charter_program_map/".$data['programid'].'/'.$data['dbname'].'/owner'; ?>" target="blank"><?php echo $startdate; ?></a></li>
                            <?php
                                    
                                } ?>
                        </ul>
                    <?php } ?>
                </li>  
            <?php }else if(isset($assocprefenceID) && !empty($assocprefenceID)){ ?>
            <li class="menu__item pagleave"><a href="<?php echo $baseFolder."/charters/charter_program_map/".$charterHeadProgramId.'/'.$ydb_name.'/guest'; ?>" target="blank">Cruising Map</a></li>
            <?php } ?>
            <li class="menu__item"> <a href="#">Charter Contracts</a>
            <?php 
            if(isset($ownerprefenceID) && !empty($ownerprefenceID)){ 
            if(isset($programFiles)){ ?>
                <ul class="submenu">
                    <?php foreach($programFiles as $startdate => $filepath){ ?>
                    <li class="menu__item"><a href="<?php echo $filepath; ?>" target="_blank"><?php echo $startdate; ?></a></li>
                    <?php
                            
                        } ?>
                </ul>
            <?php }
            } ?>
        </li>   
        <li class="menu__item" ><a>How To Video</a>
           <ul class="submenu">
                   <li class="menu__item" id="MenuHowToVideo"><a href="#">Preference Sheets</a></li>
                   <li class="menu__item" id="MenuHowToVideoCharterHead"><a href="#">Head Charterer</a></li>
                </ul>
            </li>
           <li> <a href="<?php echo $baseFolder."/charters/privacytermsofuse/1" ?>" target="blank">Terms of Use</a></li>
           <li> <a href="<?php echo $baseFolder."/charters/privacytermsofuse/2" ?>" target="blank">Privacy Policy</a></li>
            <li class="list-logout-row-inner pagleave"><?php echo $this->Html->link($this->Html->image("admin/table.png", array("alt" => "","title" => "Logout")).'  Logout','/',array('escape' =>false,'title' => 'Logout'));?></li>
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
        <ul class="menu menu-level1 no-style nav nav-pills nav-justified">
          <li class="<?php echo $personalDetailsTab; ?>"><a data-toggle="tab" href="#personal_det" class="nav-anch">Personal</a></li>
          <li class="<?php echo $mealPreferenceTab; ?>"><a data-toggle="tab" href="#meals" class="nav-anch">Meal Service</a></li>
          <li class="<?php echo $foodPreferenceTab; ?>"><a data-toggle="tab" href="#food" class="nav-anch">Food</a></li>
          <li class="<?php echo $beveragePreferenceTab; ?>"><a data-toggle="tab" href="#beverage" class="nav-anch">Beverage</a></li>
          <?php if(isset($ownerprefenceID)){
              //if($sessionCH == 2){ ?>
          <li class="<?php echo $spiritPreferenceTab; ?>"><a data-toggle="tab" href="#spirit" class="nav-anch">Beer & Spirit</a></li>
          <li class="<?php echo $winePreferenceTab; ?>"><a data-toggle="tab" id="wineTab" href="#wine" class="nav-anch">Wine List</a></li>
          <?php } //} else{ ?>
           <!-- <li class="<?php echo $spiritPreferenceTab; ?>"><a data-toggle="tab" href="#spirit" class="nav-anch">Beer & Spirit</a></li>
           <li class="<?php echo $winePreferenceTab; ?>"><a data-toggle="tab" id="wineTab" href="#wine" class="nav-anch">Wine List</a></li> -->
        
          <?php //} ?>
          
          <li class="<?php echo $itineraryPreferenceTab; ?>"><a data-toggle="tab" href="#itinerary" class="nav-anch">Itinerary</a></li>
          
          <li class="none-vew pagleave"> <a href="<?php echo $baseFolder."/charters/programs/".$session['guestListUUID'];  ?>">Charter Programs</a></li>
          <?php if(isset($ownerprefenceID) && !empty($ownerprefenceID)){ ?>
            <li class="none-vew pagleave"><a href="<?php echo $baseFolder."/charters/view/".$ownerprefenceID."/".$selectedCharterProgramUUID."/".$sessionCharterGuest['charter_company_id']; ?>">Guest List</a></li>
            <?php }else if(isset($assocprefenceID) && !empty($assocprefenceID)){ ?>
                <li class="none-vew pagleave"><a href="<?php echo $baseFolder."/charters/view_guest/".$selectedCharterProgramUUID."/".$sessionCharterGuest['charter_company_id']; ?>">Guest List</a></li>
                <?php } ?>    
                <?php if(empty($mapdetails)){ 
                $title  = "Not published";
            }else if(!empty($mapdetails)){
                    $title  = "";
            } ?>
            <?php if(isset($ownerprefenceID) && !empty($ownerprefenceID)){ ?>
                <li class="none-vew menu__item"> <a href="#" title="<?php echo $title; ?>">Cruising Map</a>
                
                <?php if(isset($mapdetails)){ ?>
                    <ul class="submenu">
                        <?php foreach($mapdetails as $startdate => $data){ ?>
                            <li class="none-vew menu__item pagleave"><a href="<?php echo $baseFolder."/charters/charter_program_map/".$data['programid'].'/'.$data['dbname'].'/owner'; ?>" target="blank"><?php echo $startdate; ?></a></li>
                        <?php
                                
                            } ?>
                    </ul>
                <?php } ?>
            </li>   
            <?php } ?>
            <?php if(isset($assocprefenceID) && !empty($assocprefenceID)){ ?>
            <li class="none-vew pagleave"><a class="nav-anch" href="<?php echo $baseFolder."/charters/charter_program_map/".$charterHeadProgramId.'/'.$ydb_name.'/guest'; ?>" target="blank">Cruising Map</a></li>
            <?php } ?>
          <li class="none-vew menu__item"> <a href="#">Charter Contracts</a>
            <?php 
              if(isset($ownerprefenceID) && !empty($ownerprefenceID)){ 
                    if(isset($programFiles)){ ?>
                        <ul class="submenu">
                            <?php foreach($programFiles as $startdate => $filepath){ ?>
                            <li class="none-vew menu__item"><a href="<?php echo $filepath; ?>" target="_blank"><?php echo $startdate; ?></a></li>
                            <?php
                                    
                                } ?>
                        </ul>
                    <?php } 
                }?>
        </li>  
        <li class="none-vew menu__item" ><a>How To Video</a>
           <ul class="submenu">
                   <li class="menu__item" id="MenuHowToVideo"><a href="#">Preference Sheets</a></li>
                   <li class="menu__item" id="MenuHowToVideoCharterHead"><a href="#">Head Charterer</a></li>
                </ul>
            </li> 
           
           <li class="none-vew"> <a class="nav-anch" href="<?php echo $baseFolder."/charters/privacytermsofuse/1" ?>" target="blank">Terms of Use</a></li>
           <li class="none-vew"> <a class="nav-anch" href="<?php echo $baseFolder."/charters/privacytermsofuse/2" ?>" target="blank">Privacy Policy</a></li>
         <li class="list-logout-row-inner none-vew"><?php echo $this->Html->link($this->Html->image("admin/table.png", array("alt" => "","title" => "Logout")).'  Logout','/',array('escape' =>false,'title' => 'Logout'));?></li>
        </ul>
    </nav>
</section>
</div>
</div>

<div class="row">
    <div class="col-lg-4">
        <?php echo $this->Session->flash();?>
        <div id="responseAlert" class="alert alert-success top strong-font" style="display:none;">
        </div>
    </div>
</div>

<?php 
if(isset($defaultFirstName) && !empty($defaultFirstName)){
$defaultFirstName = $defaultFirstName;
}else{
    $defaultFirstName = "";  
} 
if(isset($defaultLastName) && !empty($defaultLastName)){
    $defaultLastName = $defaultLastName;
    }else{
        $defaultLastName = "";  
    }

    if(isset($deleteddob) && !empty($deleteddob)){
        $deleteddob = $deleteddob;
    }else{
        $deleteddob = "";  
    } 
    if(isset($deletedpob) && !empty($deletedpob)){
        $deletedpob = $deletedpob;
    }else{
            $deletedpob = "";  
    }
?>
<div id="pageleavemodal" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog" role="document">
    <div class="modal-content mc-bord">
      <div class="modal-body">
      <div class="modalmsg" > 
        <p>Would you like to save or submit your</p>
        <p>preferences before leaving this page?</p>
      </div>
        <div class="text-center">
        <input class="btn btn-primary" type="button" name="pageleave_save" id="pageleave_save" value="Save" />
     <input class="btn btn-success" style="background-color: #5cb85c;
    border-color: #4cae4c;" type="button" name="pageleave_submit" id="pageleave_submit" value="Submit" />
          <input class="btn btn-secondary"  type="button" name="pageleave_close" id="pageleave_close" value="Close" />
        </div>   
       
      </div>
    </div>
  </div>
</div>


<div id="successPreferenceAlertBeforeLeave" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog" role="document">

    <div class="modal-content mc-bord" id="successUsePreferenceBeforeLeave">
      <div class="modal-body">
      <div class="modalmsg" style="margin-left: 30px;"> 
        <p>Would you like to allow your preferences to</p>
        <p>be provided to future charter programs</p>
        <p>without you having to submit them again?</p>
      </div>
        <div class="text-center">
          <input class="btn btn-success" style="background-color: #5cb85c;
    border-color: #4cae4c;" type="button" name="yes_please" id="yes_pleaseBeforeLeave" value="Yes please" />
          <input class="btn btn-danger" type="button" name="no_thanks" id="no_thanksBeforeLeave" value="No thanks" />
        </div>   
        <div class="modalmsg" style="margin-left: 30px;"> 
        <p>You can login to Charter Guest and make</p>
        <p>changes to your preferences at any time.</p>
        </div> 
      </div>
    </div>

  </div>
</div>

<!-- Tab content -->
    <div class="tab-content container tab-md-row-container">    
        <!-- Personal details -->
        <?php echo $this->element('personal_details', array('session' => $session, 'sessionAssoc' => $sessionAssoc,'setdefaultFirstName'=>$defaultFirstName,'setdefaultLastName'=>$defaultLastName,'deleteddob'=>$deleteddob,'deletedpob'=>$deletedpob)); ?>
        
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
var urltogo = "";
var form = "";
var url = "";
$(document).on("click", ".pagleave", function(e) { 
    $("#pageleavemodal").modal("show");
     urltogo = $(this).find('a').attr('href');
    return false;
});

$(document).on("click","#pageleave_close",function(e) {
    $("#pageleavemodal").modal("hide");
    //return false;
});

$(document).on("click","#pageleave_save",function(e) {
    var tabname = $("ul.menu-level1").find('li.active').text();
        //alert(ref_this.data("id"));
    if(tabname == "Personal"){
         form = $("#personalDetailsForm");
            url = form.attr('action');
             //alert('Personal');
       // $("#personalDetailsForm").submit(); 
    }else if(tabname == "Meal Service"){ //alert('Meal');
        form = $("#mealPreferenceForm");
            url = form.attr('action');
        
    }else if(tabname == "Food"){ //alert('Food');
        form = $("#foodPreferenceForm");
            url = form.attr('action');
        
    }else if(tabname == "Beverage"){ //alert('Beverage');
        
        form = $("#beveragePreferenceForm");
            url = form.attr('action');
    }else if(tabname == "Beer & Spirit"){ //alert('Beer');
        
        form = $("#spiritPreferenceForm");
            url = form.attr('action');
    }else if(tabname == "Wine List"){ //alert('Wine');
        
        form = $("#winePreferenceForm");
            url = form.attr('action');
        
    }else if(tabname == "Itinerary"){ //alert('Itinerary');
        form = $("#itineraryPreferenceForm");
            url = form.attr('action');
        
        
    }
    $("#hideloader").show();
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(data) {
                    $("#hideloader").hide();
                    // Ajax call completed successfully
                    window.location.href = urltogo;
                },
                error: function(data) {
                    $("#hideloader").hide();
                    // Some error in ajax call
                    alert("some Error");
                }
            });
        //console.log(ref_this);
});

$(document).on("click","#pageleave_submit",function(e) {
    var tabname = $("ul.menu-level1").find('li.active').text();
        //alert(ref_this.data("id"));
    //if(tabname == "Itinerary"){ alert('Itinerary');
        form = $("#itineraryPreferenceForm");
            url = form.attr('action');
            $("#hideloader").show();
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(data) {
                    $("#hideloader").hide();
                    // Ajax call completed successfully
                    //window.location.href = urltogo;
                    $("#successPreferenceAlertBeforeLeave").modal("show");
                    
                },
                error: function(data) {
                    $("#hideloader").hide();
                    // Some error in ajax call
                    alert("some Error");
                }
            });
        //console.log(ref_this);
        
    //}
        //console.log(ref_this);
});


$(document).on("click", "#yes_pleaseBeforeLeave", function(e) {     //alert();
  
  var data = {
      "guestListUUID": "<?php echo $iti_guestListUUID_beforeleave; ?>",
      "selectedCharterProgramUUID": "<?php echo $iti_selectedCharterProgramUUID_beforeleave; ?>"
  };
  
  
      $("#hideloader").show();
      $.ajax({
          type: "POST",
          url: BASE_FOLDER+'/charters/saveusesubmittedpreferences',
          dataType: 'json',
          data: data,
          success:function(result) {
              $("#hideloader").hide();
              if (result.status == 'success') {
                window.location.href = urltogo;
                return false;
              }else if(result.status == 'fail'){
                window.location.href = urltogo;
                return false;
              }   
          },
          error: function(jqxhr) { 
              $("#hideloader").hide();
          }
      });
      return false;
});

$(document).on("click", "#no_thanksBeforeLeave", function(e) {

    window.location.href = urltogo;
          return false;

});


    
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
$(".issuedatePicker").datepicker({
    dateFormat: 'd M yy',
    changeYear: true,
    changeMonth:true,
    yearRange: "c-12:c+0",
    // yearRange: "-100:+100"
});
$(".expirydatePicker").datepicker({
    dateFormat: 'd M yy',
    changeYear: true,
    changeMonth:true,
    yearRange: "c-0:c+12",
    // yearRange: "-100:+100"
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


$('.breakfast_time_timePicker').timepicker({ 
    timeFormat: 'H:i', 
    scrollDefault:"06:00",
    step: 15 
});

$('.lunch_time_timePicker').timepicker({ 
    timeFormat: 'H:i', 
    scrollDefault:"12:00",
    step: 15 
});

$('.dinner_time_timePicker').timepicker({ 
    timeFormat: 'H:i', 
    scrollDefault:"18:00",
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
        $sidebarBtn      = $('.sidebar-btn'),
        $toggleCol       = $('body').add($contnet).add($sidebarBtn),
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
  
        $contnet.on('click', function() {
            toggleMenu();
            unbindContent();
        });
    }
    function unbindContent() {
        $contnet.off();
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


$('.menu > .menu__item').hover(function(){
  $(this).children('.submenu').show();
  
}, function() {
  $(this).children('.submenu').hide();
  
});



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

// This prevents the page from scrolling down to where it was previously.
if ('scrollRestoration' in history) {
    history.scrollRestoration = 'manual';
}
// This is needed if the user scrolls down during page load and you want to make sure the page is scrolled to the top once it's fully loaded. This has Cross-browser support.
window.scrollTo(0,0);
     });  


//      var BASE_FOLDER = "<?php echo $baseFolder; ?>";
// $(document).ready(function (e) {
//     <?php //if (isset($showPopup)) { ?>
//             //$("#usesubmittedpreferences").modal('show');
//             $("#successPreferenceAlert").modal("show");
//             $("#successUsePreference").show();
//             $("#successbody").hide();
//     <?php //} ?> 
// });    

function validateHhMm(inputField) {
    var isValid = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(inputField.value);

    if (isValid) {
        inputField.style.backgroundColor = '#bfa';
    } else {
        inputField.style.backgroundColor = '#fba';
        inputField.value = '';
    }

    return isValid;
}
// Validates that the input string is a valid date
function isValidDate(inputField)
{
    var dateString = inputField.value;
    var date = new Date(dateString);    
    var valid = (date.getTime() === date.getTime());

    if(!valid){
        inputField.value = '';
    }
};
function validateDate(id) {
    console.log("validateDate id=",id);
    var date = $('#'+id).val;

    console.log("date=",date);
    var d = new Date(date);
    var valid = (d.getTime() === d.getTime());
    console.log("valid=",valid);
}
$(window).on('load', function () {
    $('#hideloader').hide();
}) 
</script> 
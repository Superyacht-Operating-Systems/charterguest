<?php
    $basefolder = $this->request->base;
    $cloudUrl = Configure::read('cloudUrl');
    $session = $this->Session->read('charter_info.CharterGuest');
    $sessionData = $this->Session->read();
    //print_r($sessionData["pSheetsColor"]);
    if(isset($sessionData["pSheetsColor"]) && !empty($sessionData["pSheetsColor"])) { ?>
        <script>
            // var elements = document.querySelectorAll(".active .in");
            // console.log(" elements = ",elements);
            document.getElementsByClassName(".a.nav-anch").style.color="<?php echo $sessionData["pSheetsColor"]; ?>";
            console.log(" elements = ",elements);
            // var allOrangeJuiceQuery = document.querySelectorAll('.a.nav-anch');
            // document.body.style.backgroundImage = "url('<?php echo $sessionData["cgBackgroundImage"]; ?>')";
        </script>
    <?php
        }    
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
#loadMore{
    width: 320px;
    float: left;
    display: flex;
    align-items: center;
    height: 443px;
    justify-content: center;
}
#loadMore a{
    border: solid 3px #fff;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    text-align: center;
    justify-content: center;
    font-size: 20px;
    text-decoration: none;
    color: #fff;
    display: flex;
    align-items: center;
}
#loadMore a:hover{
    background: #fff;
    color:#000;
}


.ch-card{
  display:none;
}
.load-more{
    
}
.footer-mob-row .btn-success {
    color: #000;
    background-color: rgba(5, 156, 226, 0.83);
    border-color: #7dc6ec;
    width: 80px;
    font-weight: bolder;
    font-size: 14px;
}
.fx-size{
font-size: 21px;
    color: #141414;
}
.md-bt-flex img{
    height: 34px;
    width: 46px;
}
.md-bt-flex{
    margin-right: 0px!important;
    width: 131px;
    display: flex;
}

.text-box-container{
    width: 100%;
    display: flex;
    margin-top: 10px;
}
.yachtHeaderName{font-weight: bold;font-size: 46px;}
.container-row-column .row{margin-bottom: 7px;}
.container-row-column .row .form-control{
    height: 30px!important;
}
    table.table tbody tr {
        background: none !important;
    }
    .label-bold {
        font-weight: bold;
        margin-bottom:5px;
        display:inline-block;
        font-size:22px;
        width: 100%;
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
.owl-nav.disabled{display: none!important}
#saveBtn{margin-right: 128px;border-radius: 0px;}

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
    padding: 10px 0px 0px 0px;
}

.flexrow .one {
    float: left;
        margin-top: 101px;
}

.flexrow .two {
    width: 100%;
    align-items: center;
    display: flex;
    justify-content: center;
    margin-top: -48px;

}

.table-condensed>tbody>tr>td.td-cnt{text-align: left;}

.flexrow .three {
    float: right;
    margin-top: 15px;
}

.header-row div{
    float: left;
    color: #000;
    font-size: 14px;
    margin-right: 10px;
    text-align: center;
    float: left;
    font-weight: bold;
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
    padding: 6px 20px;
    border-radius: 0px;
     height: 30px!important;
}

.btn-open1{
    font-size: 13px;
    border: none;
    float: initial;
    font-weight: bold;
    opacity: 40!important;
    padding: 6px 20px;
    border-radius: 0px;
     height: 34px!important;
}
.newGuestAssoc{display: none;}

/*.btn-primary{display: none!important;} */
.menu__item{
    cursor: pointer;
}
.menu > li{
  display: inline-block;
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
  list-style: none;
}
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


.md-left-text{    text-align: left!important;
    padding: -3px;
    margin-left: -5px;
    position: relative;
    left: -13px;
    top:-10px!important;


}
.md-left-text .info-box{
       position: absolute;
    top: -2px;
    font-size: 12px;
    right: 10px;
        background: rgba(82, 130, 240, 0.48);
        height: 18px;
    width: 18px;
    color: #fff;
    cursor: pointer;
    border-radius: 100%; 
        text-align: center;
    display: flex;
    justify-content: center;
}
.md-left-text .fa{
    position: relative;
    top: 3px;
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
         background: rgba(255, 75, 75, 0.84);
    border: none;
    float: left;
    color: #000!important;
    font-weight: bold;
    opacity: 40!important;
    padding: 6px 5px;
    border-radius: 0px;margin:0% 0.3%;
    height: 30px;

}
.btn-eml-send1{font-size: 13px;
       /*   background: rgba(241, 28, 28, 0.52); */
    border: none;
    float: left;
    color: #000!important;
    font-weight: bold;
    opacity: 40!important;
    padding: 6px 5px;
    border-radius: 0px;margin:0% 0.3%;
    height: 30px;

}
.container-row-column .row>section>div{
    float: left;    margin: 0px 0.4%;
}
.owl-carousel label{width:100%;display: none;}
.container-row-column{margin: 0px 13px;}
.bigitem{float: left;
    flex: none!important;}
.md-row-hd-18{width:17%;}
.md-row-hd-12{width:12%;}
.md-row-hd-29{
    width: 26%;
}
.md-bt-flex button{
    margin-left: 0px!important;
}

.header-row {width:100%;display: inline-block;margin: 0px 0px;}
.container-row-column .row>div {float: left;margin: 0px 0.4%;}
.btn-eml-send{width:78px;}
.btn-eml-send1{width:78px;}
.btn-open{width:78px;}
.d-none{display: none;}




@media screen and (max-width: 1200px) {

.md-row-hd-18{width:17%;}
.md-row-hd-12{width:12%;    margin: 0px 0.4%!important;}
.header-row div{font-size:12px;margin: 0px;}
}

.owl-nav{display: none;}
@media screen and (max-width: 990px) {
.nav-side-menu {
    display: block;
}
  .label-bold {
        font-size:16px;
    }

.btn-open,
.btn-eml-send
{font-size: 12px;}
.list-logout-row img{display:none; }

.md-row-space{margin-bottom:0px!important;}
    .owl-carousel label {
    width: 100%;
    display: block!important;
}
.footer-mob-row .btn-success {
    width: 140px;
}


.container-row-column {
    margin: 55px 13px 0px 13px;
}

.md-row-h-12{width:30%;}
.md-row-h-10 {width:33.555%;}
.md-row-h-8{
    width: 50%;
    left: 15%;
    float: right;
    position: absolute;
    top: 200px;
}
.rowm-md-mob-resize{
       display: inline-block;
    width: 100%;


}
.md-row-h-30{display: inline-block;margin:5px 2px!important;width:98.9%;}
.md-row-h-18 {
        width: 197px!important;
    float: right!important;
    position: relative;
    right: 6%;
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
    display: flex;
}

}
.nav-justified > li > a{
    color: #000!important;
    transition: 0.3s;
        border-radius: 0px;cursor: pointer;
}
.nav-justified > li {
    display: block;
    width: 100%;
}
.nav-justified > li{
    margin-left: 0px!important;
    margin-bottom: 5px;
    text-align: center;
}
.list-logout-row{display: none;}
.row-hide-btn{display: block!important;}
@media only screen and (max-width:1024px){

.container-row-column {
    margin: 0px 0px 0px 13px;
}
#saveBtn {
    margin-right: 110px;
}
.md-bt-flex button {
    padding: 0px 8px;
}
}
/*.mobile-owl-view{display: none;}
.desk-owl-view{display: block;}*/
.desk-owl-view label{display: none;}
@media only screen and (max-width:1000px){
/*.mobile-owl-view{display: block;}
.desk-owl-view{display: none;}*/
}

@media only screen and (max-width:600px){
.md-row-h-18{right: 0px;    width: 130px!important;}
.md-row-h-8{left: 15px;}

}
@media screen and (min-device-width: 1000px) and (max-device-width:1030px) {
.owl-stage{
   /*transform: inherit!important;*/
    width: 100%!important;
    transform: translate3d(0px, 0px, 0px)!important;
    transition: none!important;
}
.list-page-container .table{
    overflow: hidden!important;
    width: 955px;
    max-width: 955px;
    margin-bottom: 20px;
    padding-top: 17px;
    margin-top: -13px;
    min-width: 955px;
    
}
}
.text-box-container>div{
    float: left;
    margin-right: 10px;
}
@media screen and (max-width: 800px) {
.n-mob{
    display: none;
}


.header-row .md-row-hd-18{
left: 0px;
    width: 70%;
}
.md-row-hd-18{
    width:100%;
}
.md-bt-flex {
    width: 153px;
}
.d-none{display: block;}
.md-row-hd-12 input,
.md-row-hd-12{
    width:90px;
}
.container-fluid{
    padding: 0px;
}
.form-control{
    font-size: 13px!important;
}
.text-box-container>div {
    float: left;
    margin-right: 4px;
}
.md-bt-flex button {
    padding: 0px 8px;
    margin: 0px 2px;
}
.text-box-container {
    display: flex;
}
.header-row div{
position: relative;
}
}
@media screen and (max-width: 600px) {
.header-row .md-row-hd-18 {
    width: 64%;
}
}
@media screen and (max-width: 500px) {
.header-row .md-row-hd-18 {
    width: 62%;
}
}
@media screen and (max-width: 480px){
.md-bt-flex {
    width: 174px;
}
.header-row .md-row-hd-18 {
    width: 51%;
}
}
@media screen and (max-width: 412px){
.header-row .md-row-hd-18 {
    width: 47%;
}
.md-bt-flex {
    width: 243px;
}
}
@media screen and (max-width: 400px){
.header-row .md-row-hd-18 {
    width: 43%;
}
}
@media screen and (max-width: 380px){
.header-row .md-row-hd-18 {
    width: 42%;
}
}
@media screen and (max-width: 320px){
.header-row .md-row-hd-18 {
    width: 35%;
}
}
@media (min-width: 1400px){
.container {
    width: 100%;
}
}


input:focus {
    outline: solid 1px #ccc !important;
}

.cardbell-icon {
    right: 3px !important;
}

.menu .submenu{
    right:-162px !important;
}

.menu .submenu .menu__item a {
    width: 160px !important;
    
}
@media only screen and (max-width: 767px){
    .nav-side-menu-full-container .nav-side-menu .sidebar {
  width: 120px;
    }
    .nav-side-menu-full-container .nav-side-menu .show {
  width: 180px;
    }
}
[aria-current="mapnolink"] {
  pointer-events: none;
  cursor: default;
  text-decoration: none;
  color: black;
}
</style>
<?php 
    $baseFolder = $this->request->base;
    echo $this->Html->css('charter/style');
    $sessionCharterGuest = $this->Session->read('charter_info.CharterGuest');
    //echo "<pre>";print_r($sessionCharterGuest); exit;
    $yacht_link_button = "admin/yacht_link_button.png";
?>    
<script>
    var BASE_FOLDER = "<?php echo $baseFolder; ?>";
</script> 

<div class="flexrow flexrow-full-container">
<div class="nav-side-menu-full-container">
<div class="nav-side-menu">
<div class="base-margin">
<button id="sidebar-btn" class="sidebar-btn">
    <div class="menu-stripes"></div>
    <div class="menu-stripes"></div>
    <div class="menu-stripes"></div>
</button>
<section id="sidebar" class="sidebar">
    <nav> 
        <ul class="menu menu-level1 no-style nav nav-pills nav-justified">
            <?php if(isset($sessionCharterGuest) && !empty($sessionCharterGuest)){?>
        <li> <a href="<?php echo $baseFolder."/charters/programs/".$sessionCharterGuest['users_UUID']; ?>">Charter Programs</a>
        <li class="menu__item"> <a href="#">Charter Contracts</a>
            <?php if(isset($programFiles) && !empty($programFiles)){ ?>
                <ul class="submenu">
                    <?php foreach($programFiles as $startdate => $filepath){ ?>
                    <li class="menu__item"><a href="<?php echo $filepath; ?>" target="_blank"><?php echo $startdate; ?></a></li>
                    <?php
                            
                        } ?>
                </ul>
            <?php } ?>
    
        </li>    
        <!-- <?php if(empty($mapdetails)){ 
                $title  = "Not published";
        }else if(!empty($mapdetails)){
                $title  = "";
        } ?> -->
        <!-- <li class="menu__item"> <a href="#" title="<?php echo $title; ?>">Cruising Map <span class="acti-countnav"><?php echo $this->Session->read('commentcounttotal'); ?></span> </a>
            <?php if(isset($mapdetails)){ ?>
                <ul class="submenu">
                    <?php foreach($mapdetails as $startdate => $data){ ?>
                    <li class="menu__item"><a href="<?php echo $baseFolder."/charters/charter_program_map/".$data['programid'].'/'.$data['dbname'].'/owner'; ?>" target="_blank"><?php echo $startdate; ?> <span class="acti-countnav"><?php echo $data['count']; ?></span></a></li>
                    <?php
                            
                        } ?>
                </ul>
            <?php } ?>
    
        </li>     -->
        <li class="menu__item" ><a>How To Video</a>
           <ul class="submenu">
                   <li class="menu__item" id="MenuHowToVideo"><a href="#">Preference Sheets</a></li>
                   <li class="menu__item" id="MenuHowToVideoCharterHead"><a href="#">Head Charterer</a></li>
                </ul>
            </li>
        <li> <a href="<?php echo $baseFolder."/charters/privacytermsofuse/1" ?>" target="blank">Terms of Use</a></li>
        <li> <a href="<?php echo $baseFolder."/charters/privacytermsofuse/2" ?>" target="blank">Privacy Policy</a></li>
        <?php } ?>
         <!-- <li class="guest-list"> <a href="#">Guest List</a></li>
           <li><a href="charter_program_map">Cruising Map</a></li>
           <li><a>How To Video</a></li> -->
         <li class="list-logout-row row-hide-btn"><?php echo $this->Html->link($this->Html->image("admin/table.png", array("alt" => "","title" => "Logout")).'Logout','/',array('escape' =>false,'title' => 'Logout'));?></li>
        </ul>
    </nav>
</section>
</div>
</div>
</div>
<span class="label-bold md-block" style="font-size: 35px;color: #fff;"> <?php echo isset($companyData['Fleetcompany']['management_company_name']) ? $companyData['Fleetcompany']['management_company_name'] : ""; ?></span>


<div class="two">
        <div class="bigitem md-row-space">
           
             <!--  <span class="label-bold"><?php 
                    if(isset($guestListData) && !empty($guestListData)){
                       echo $guestListData['GuestList']['first_name'].' '.$guestListData['GuestList']['last_name'];
                    }
              ?></span><br> -->
               <span class="label-bold hhd-mrg-02">CHARTER PROGRAMS</span><br>
        <!--    <span class="label-bold"><?php
                    if(isset($guestListData) && !empty($guestListData)){
                       echo $guestListData['GuestList']['email'];
                    } ?></span> -->
        </div>

    </div>

<div class="ch-card-aligncenter">     
<div class="ch-card-container">
<?php 
   // Owner & head charterer
if(isset($charterGuestData) && !empty($charterGuestData)){
    
    //foreach (range(1, 20) as $i) {
        foreach($charterGuestData as $data){
        
            $charterName = $data['CharterGuest']['charter_name'];
            $embarkation = $data['CharterGuest']['embarkation'];
            $debarkation = $data['CharterGuest']['debarkation'];
            $id = $data['CharterGuest']['id'];
            $charter_program_id = $data['CharterGuest']['charter_program_id'];
            $charter_company_id = $data['CharterGuest']['charter_company_id'];
            $charter_from_date = date("d M Y", strtotime($data['CharterGuest']['charter_from_date']));
            $charter_to_date = date("d M Y", strtotime($data['CharterGuest']['charter_to_date']));

            $yacht_id = $data['CharterGuest']['yacht_id'];
            $yname = $yfullName[$data['CharterGuest']['yacht_id']];
            $website = "#";
            if(isset($data['websitedetails']['YachtWeblink']['weblink'])){
                $weblink = $data['websitedetails']['YachtWeblink']['weblink'];
                if(isset($weblink)){
                    $website = $weblink;
                }else{
                    $website = "#";
                }
            }
            if(isset($programFiles[$charter_from_date])){
                $filepath =  $programFiles[$charter_from_date];
            }else{
                $filepath = "#";
            }

            if(isset($data['msg_count'])){
                $msg_count =  $data['msg_count'];
            }

            
                        
    ?>
 <div class="ch-card">
   <div class="ch-card-body">  
   <p><?php echo $charterName; ?></p>
    <p><?php echo $charter_from_date; ?> to <?php echo $charter_to_date; ?></p>
    <p><?php echo $embarkation; ?> to <?php echo $debarkation; ?></p>
     
      <p><?php echo $yname; ?></p>
    <div class="card-img" style="position: relative;">
        <img src="<?php echo $data['program_image']; ?>">
            <?php if($data['map_url'] == "link"){ ?>
                <div class="bottom-left "  style="display:none;position: absolute;bottom: 8px;left: 16px;background-color: #FED8B1;color: #333;padding: 5px 10px;"> Sorry this cruising map is not published yet.</div>
                <?php }else if($data['map_url'] == "nolink"){ ?>
                 
            <?php } ?>
        
    </div>
    <div class="body-divid">
       <div class="col-11">
           <img src="<?php echo $data['charter_logo']; ?>" alt="">
       </div> 
       <div class="col-11">
        <ul>
            <li><a href="<?php echo $website; ?>" target="_blank" style="text-decoration:none;">Yachts Website</a></li>
            <li><a href="<?php echo $basefolder."/charters/view/".$id."/".$charter_program_id."/".$charter_company_id; ?>">Guest List</a></li>
            <?php if($data['map_url'] == "link"){ ?>
                <li id="btn_NoLink_<?php echo $id; ?>" onclick="display(this)" customAttr="<?php echo $id; ?>"><span datahover="Map is Not Published" title="Map is Not Published"><a   role="button" title="Map is Not Published" aria-current="mapnolink">Cruising Map</a></span></li>
                <!-- <li><a href="<?php //echo $baseFolder."/charters/charter_program_map/".$charter_program_id.'/'.$data['ydb_name'].'/owner'; ?>" title="Map is Published">Cruising Map</a>  <?php if(isset($msg_count) && $msg_count > 0){ ?><span class="cardbell-icon"><span class="avacard-cunt"><?php echo $msg_count; ?></span><i class="fa fa-bell"></i></span><?php } ?></li> -->
                <!-- target="_blank" -->
                <?php }else if($data['map_url'] == "nolink"){ ?>
                <!-- <li><span datahover="Map is Not Published" title="Map is Not Published"><a href="#" role="button" title="Map is Not Published" aria-current="mapnolink">Cruising Map</a></span></li> -->
                <li id="btn_NoLink_<?php echo $id; ?>" onclick="display(this)" customAttr="<?php echo $id; ?>"><span datahover="Map is Not Published" title="Map is Not Published" ><a   role="button" title="Map is Not Published" aria-current="mapnolink">Cruising Map</a></span></li>
            <?php } ?>

            <li><a href="#"><span class="existingCheckFunction" data-guestype="owner" data-associd ="<?php echo $id; ?>">Preference Sheets</span></a></li>
        </ul>   


       </div> 
    </div>
   


   </div>
 </div>
<?php 
     
    //}
     
}

        }?>


<?php 
// Guest
if(isset($charterAssocData) && !empty($charterAssocData)){
        foreach($charterAssocData as $data){
            $charterName = $data['charterDetails']['CharterGuest']['charter_name'];
            $embarkation = $data['charterDetails']['CharterGuest']['embarkation'];
            $debarkation = $data['charterDetails']['CharterGuest']['debarkation'];
            $id = $data['charterDetails']['CharterGuest']['id'];
            $charter_program_id = $data['charterDetails']['CharterGuest']['charter_program_id'];
            $fleetcompany_id = $data['charterDetails']['CharterGuest']['charter_company_id'];
            $charter_from_date = date("d M Y", strtotime($data['charterDetails']['CharterGuest']['charter_from_date']));
            $charter_to_date = date("d M Y", strtotime($data['charterDetails']['CharterGuest']['charter_to_date']));
            
            $openButtonLink = "/charters/existingCheckFunction";

            $associd = $data['CharterGuestAssociate']['id'];
            $yname = $yfullName[$data['charterDetails']['CharterGuest']['yacht_id']];

            $website = "#";
            if(isset($data['websitedetails']['YachtWeblink']['weblink'])){
                $weblink = $data['websitedetails']['YachtWeblink']['weblink'];
                if(isset($weblink)){
                    $website = $weblink;
                }else{
                    $website = "#";
                }
            }

           $ch_image = $data['charterDetails']['ch_image'];

           $msg_count_assc = $data['charterDetails']['msg_count'];
    ?>
<div class="ch-card">
   <div class="ch-card-body">  
   <p><?php echo $charterName; ?></p>
    <p><?php echo $charter_from_date; ?> to <?php echo $charter_to_date; ?></p>
    <p><?php echo $embarkation; ?> to <?php echo $debarkation; ?></p>
     
      <p><?php echo $yname; ?></p>
    <div class="card-img" style="position: relative;">
    <img src="<?php echo $ch_image; ?>">
    <?php if($data['charterDetails']['map_url'] == "link"){ ?>
        <div class="bottom-left"  style="display:none;position: absolute;bottom: 8px;left: 16px;background-color: #FED8B1;color: #333;padding: 5px 10px;"> Sorry this cruising map is not published yet.</div>
        <?php }else if($data['charterDetails']['map_url'] == "nolink"){  ?>
                   
            <?php } ?>
    </div>
    <div class="body-divid">
       <div class="col-11">
           <img src="<?php echo $data['charterDetails']['charter_logo']; ?>" alt="">
       </div> 
       <div class="col-11">
        <ul>
            <li><a href="<?php echo $website; ?>" target="_blank" style="text-decoration:none;">Yachts Website</a></li>
            <li><a href="<?php echo $basefolder."/charters/view_guest/".$charter_program_id."/".$fleetcompany_id; ?>">Guest List</a></li>
            <?php if($data['charterDetails']['map_url'] == "link"){ ?>
                <li id="btn_NoLink_<?php echo $id; ?>" onclick="display(this)" customAttr="<?php echo $id; ?>"><span datahover="Map is Not Published" title="Map is Not Published"><a   role="button" title="Map is Not Published" aria-current="mapnolink">Cruising Map</a></span></li>
            <!-- <li><a href="<?php //echo $baseFolder."/charters/charter_program_map/".$charter_program_id.'/'.$data['charterDetails']['ydb_name'].'/guest'; ?>" title="Map is Published">Cruising Map</a> </li> -->
            <?php }else if($data['charterDetails']['map_url'] == "nolink"){  ?>
            <!-- <li><span datahover="Map is Not Published" title="Map is Not Published"><a href="#" role="button" title="Map is Not Published" aria-current="mapnolink">Cruising Map</a></span> </li> -->
            <li id="btn_NoLink_<?php echo $id; ?>" onclick="display(this)" customAttr="<?php echo $id; ?>"><span datahover="Map is Not Published" title="Map is Not Published"><a   role="button" title="Map is Not Published" aria-current="mapnolink">Cruising Map</a></span></li>
            <?php } ?>
            <li><a href="#"><span class="existingCheckFunction" data-guestype="guest" data-associd ="<?php echo $associd; ?>">Preference Sheets</span></a></li>
            
        </ul>   


       </div> 
    </div>
   


   </div>
 </div>

 <?php }
 
        }?>
        <div>
<div id="loadMore"><a href="#">Show More</a></div>
</div>
</div></div>




<!-- <div id="content" class="list-page-container">
    <div class="two">
        <div class="bigitem md-row-space">
            <span class="label-bold">CHARTER PROGRAMS</span><br>
              <span class="label-bold"><?php 
                    if(isset($guestListData) && !empty($guestListData)){
                       echo $guestListData['GuestList']['first_name'].' '.$guestListData['GuestList']['last_name'];
                    }
              ?></span><br>
           <span class="label-bold"><?php
                    if(isset($guestListData) && !empty($guestListData)){
                       echo $guestListData['GuestList']['email'];
                    } ?></span>
        </div>

    </div>
<div  class="container-fluid">

<div class="ch-program-container">    
<div class="table table-condensed no-border" id="guestDetailsTable">
<div class="header-row">
    <div class="tcont-center md-row-hd-12">Start Date</div>
<div class="tcont-center md-row-hd-12 n-mob">End Date</div> 
<div class="tcont-center md-row-hd-18">From</div>
<div class="tcont-center md-row-hd-18 n-mob">To</div>
<div class="tcont-center emailFieldClass md-row-hd-29 n-mob">Name Of Charter</div>
</div>
<div id="charterguest">
<div class="desk-owl-view">
<?php 
   // Owner & head charterer
if(isset($charterGuestData) && !empty($charterGuestData)){
        foreach($charterGuestData as $data){
            $charterName = $data['CharterGuest']['charter_name'];
            $embarkation = $data['CharterGuest']['embarkation'];
            $debarkation = $data['CharterGuest']['debarkation'];
            $id = $data['CharterGuest']['id'];
            $charter_program_id = $data['CharterGuest']['charter_program_id'];
            $charter_company_id = $data['CharterGuest']['charter_company_id'];
            $charter_from_date = date("d M Y", strtotime($data['CharterGuest']['charter_from_date']));
            $charter_to_date = date("d M Y", strtotime($data['CharterGuest']['charter_to_date']));

            $yacht_id = $data['CharterGuest']['yacht_id'];
            $website = "#";
            if(isset($data['websitedetails']['YachtWeblink']['weblink'])){
                $weblink = $data['websitedetails']['YachtWeblink']['weblink'];
                if(isset($weblink)){
                    $website = $weblink;
                }else{
                    $website = "#";
                }
            }
                        
    ?>
<div class="text-box-container">

 <div class="tcont-center md-row-hd-12"><input type="text" class="form-control tinput rowInput" name="" value="<?php echo $charter_from_date; ?>"></div>
  <div class="tcont-center md-row-hd-12 n-mob"><input type="text" class="form-control tinput rowInput" name="" value="<?php echo $charter_to_date; ?>"></div>
   <div class="tcont-center md-row-hd-18"><input type="text" class="form-control tinput rowInput" name="" value="<?php echo $embarkation; ?>"></div>
    <div class="tcont-center md-row-hd-18  n-mob"><input type="text" class="form-control tinput rowInput" name="" value="<?php echo $debarkation; ?>"></div>
     <div class="tcont-center md-row-hd-29  n-mob"><input type="text" class="form-control tinput rowInput" name="" value="<?php echo $charterName; ?>"></div>
 <div class="tcont-center md-bt-flex">
 <a href="<?php echo $basefolder."/charters/view/".$id."/".$charter_program_id."/".$charter_company_id; ?>"><button type="button" class="btn btn-open1 btn-warning btn-warning-bg">Open</button></a>
     <a href="<?php echo $website; ?>" target="_blank"><?php echo $this->Html->image($yacht_link_button,array('width'=>'90%'));?></a>
 </div>
</div>

<?php 

        }
} 
?>

<?php 
// Guest
if(isset($charterAssocData) && !empty($charterAssocData)){
        foreach($charterAssocData as $data){
            $charterName = $data['charterDetails']['CharterGuest']['charter_name'];
            $embarkation = $data['charterDetails']['CharterGuest']['embarkation'];
            $debarkation = $data['charterDetails']['CharterGuest']['debarkation'];
            $id = $data['charterDetails']['CharterGuest']['id'];
            $charter_program_id = $data['charterDetails']['CharterGuest']['charter_program_id'];
            $fleetcompany_id = $data['charterDetails']['CharterGuest']['charter_company_id'];
            $charter_from_date = date("d M Y", strtotime($data['charterDetails']['CharterGuest']['charter_from_date']));
            $charter_to_date = date("d M Y", strtotime($data['charterDetails']['CharterGuest']['charter_to_date']));
            
            $openButtonLink = "/charters/existingCheckFunction";

            $associd = $data['CharterGuestAssociate']['id'];
            $website = "#";
            if(isset($data['websitedetails']['YachtWeblink']['weblink'])){
                $weblink = $data['websitedetails']['YachtWeblink']['weblink'];
                if(isset($weblink)){
                    $website = $weblink;
                }else{
                    $website = "#";
                }
            }
    ?>
<div class="text-box-container">
 
 <div class="tcont-center md-row-hd-12"><input type="text" class="form-control tinput rowInput" name="" value="<?php echo $charter_from_date; ?>"></div>
  <div class="tcont-center md-row-hd-12 n-mob"><input type="text" class="form-control tinput rowInput" name="" value="<?php echo $charter_to_date; ?>"></div>
   <div class="tcont-center md-row-hd-18"><input type="text" class="form-control tinput rowInput" name="" value="<?php echo $embarkation; ?>"></div>
    <div class="tcont-center md-row-hd-18  n-mob"><input type="text" class="form-control tinput rowInput" name="" value="<?php echo $debarkation; ?>"></div>
     <div class="tcont-center md-row-hd-29  n-mob"><input type="text" class="form-control tinput rowInput" name="" value="<?php echo $charterName; ?>"></div>
 <div class="tcont-center md-bt-flex"> <?php //echo $data['CharterGuestAssociate']['id']; ?>
 <a href="#"><button type="button" class="btn btn-open1 btn-warning btn-warning-bg existingCheckFunction" data-guestype="guest" data-associd ="<?php echo $associd; ?>">Open</button></a>
 <a href="<?php echo $website; ?>" target="_blank" style="text-decoration:none;float: right;"><?php echo $this->Html->image($yacht_link_button,array('width'=>'90%'));?></a>
 </div>
</div>

<?php 

        }
} 
?>
</div> -->

</div></div></div></div>
</div>
</div>







<script type="text/javascript">
    $(document).ready(function() {
  $('.owl-carousel').owlCarousel({
    stagePadding:0,/*the little visible images at the end of the carousel*/
     
    loop:false,
    rtl: false,
    lazyLoad:true,
    margin:0,
    dots:true,
    singleItem:true,
    responsiveClass:true,
    nav:false,
    items : 1, 
      responsive : {
            480 : { items : 1  }, // from zero to 480 screen width 4 items
            768 : { items : 1,
                    touchDrag:true,
                    mouseDrag:false,
             }, // from 480 screen widthto 768 6 items
        },
        900:{
            items:0,
            mouseDrag:false,
            touchDrag:false,
            nav:false,
        },
    // responsive:{
    //     0:{
    //         items:1,
    //          mouseDrag:true,
    //         touchDrag:true
    //     },
    //     1024:{
    //         items:0,
    //         mouseDrag:false,
    //         touchDrag:false
    //     },
    // }
})


 
});

</script>


<script>
var sidebar = (function() {
    "use strict";
    var $contnet         = $('#content'),
        $sidebar         = $('#sidebar'),
        $sidebarBtn      = $('#sidebar-btn'),
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

</script> 

<script>
$(".ch-card")
  .slice(0, 12) // select the first 12
  .show();
if ($(".ch-card:hidden").length != 0) {
  $("#loadMore").show();
}else {
    $("#loadMore").fadeOut("slow");
}

$("#loadMore").on("click", function(e) {
  e.preventDefault();
  $(".ch-card:hidden")
    .slice(0, 12) // select next hidden 12 & show them
    .slideDown();
  if ($(".ch-card:hidden").length == 0) { // check if any hidden divs still exist
    $("#loadMore").fadeOut("slow");
  }
});


function display(el) {
        var id = $(el).attr('id');
        var myInput = document.getElementById(id);
    
    $(".bottom-left", this).attr("id", "Nolink_msg_" + myInput.customAttr);
        jQuery('#Nolink_msg_'+ myInput.customAttr).show();
                    jQuery('#Nolink_msg_'+ myInput.customAttr).fadeIn( "slow");
                    setTimeout(jQuery('#Nolink_msg_'+ myInput.customAttr).hide(), 2000);
    }

// $("#btn_NoLink").on("click", function(e) {
//     var myInput = document.getElementById('btn_NoLink');
    
// $(".bottom-left", this).attr("id", "Nolink_msg_" + myInput.customAttr);
//     jQuery('#Nolink_msg_'+ myInput.customAttr).show();
// 				jQuery('#Nolink_msg_'+ myInput.customAttr).fadeIn( "slow");
// 				setTimeout(jQuery('#Nolink_msg_'+ myInput.customAttr).hide(), 2000);
// });
		

</script>
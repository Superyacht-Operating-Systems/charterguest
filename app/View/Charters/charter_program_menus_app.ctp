<?php //echo $fleetname.''.$yachtname; print_r($menudata); exit; ?>
<?php 
//$fleetname = '';
  if(isset($fleetname) && $fleetname!=''){
    $bg_img_path = $SITE_URL.'/'.$fleetname.'/app/webroot/'.$yachtname.'/app/webroot/img/cga_files/menu_bg_orginals/menu_bg_converted';
  }else{
    $bg_img_path = $SITE_URL.'/'.$yachtname.'/app/webroot/img/cga_files/menu_bg_orginals/menu_bg_converted';
  }
  //$bg_img_path = 'https://localhost/superyacht/app/webroot/img/cga_files/menu_bg_orginals/menu_bg_converted';
  //echo $bg_img_path; exit;
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Container Example</title>
<style>
    body{
      background: #000;
    }
    .carousel-wrap {
  margin: 90px auto;
  padding: 0 5%;
  width: 80%;
  position: relative;
}
.container_menuscontainer {
  padding: 50px 0px;
    overflow: hidden;

    width: 550px;
    margin: 0 auto;
    text-align: center;
}
/* fix blank or flashing items on carousel */
.owl-carousel .item {
  position: relative;
  cursor: pointer;
  z-index: 100; 
  -webkit-backface-visibility: hidden; 
}
.owl-carousel .owl-item {
    float: left;
    -webkit-touch-callout: none;
    color:#000;
}
.owl-dots{
  border-bottom:none!important;
  display: none!important;
}
.owl-nav{
  display: none;
}
    .menlistcontain{
      padding: 0px 60px;
    overflow: auto;
    height: 650px;
    margin-top: 80px;
    scrollbar-width: none;
    position: relative;
    overflow:auto;
    }
    .container_menuscontainer{
      padding:50px 0px;
    }
  .menlistcontain p {
    margin: 0px !important;
}

  /* CSS goes here */
  .container_menus {
    width: 500px; /* Set the width */
    height: 750px; /* Set the height */
    /*background-color: #f0f0f0; /* Just to make the container visible */
    border: 5px solid #333333; /* Optional: adds a border around the container */
    background: #222;
    border-radius: 5px;
    margin:0 auto;
  }
  .navbar-inverse {
    display: none;
}
.menualretpop{
  background: #eee4e40d;
  padding: 20px;
  position: absolute;
  top:10%;
  right: 0;
  left: 35%;
  min-height: 200px;
  width: 400px;
  margin: 0 auto;
  /* display: flex; */
  border: solid 2px #eee;
  border-radius: 8px;
  z-index: 9999;
}
.menualretpop p{
  padding-bottom: 10px;
}
.menualretpop  .desctitle{
  padding-bottom: 0px;
}
.menlistrow{
  display: inline-block;
    width: 100%;
}
</style>
</head>
<body>
  
<div class="container_menuscontainer">

<?php if(count($menudata) > 0){ ?>
<div class="owl-carousel owl-theme">
<?php foreach($menudata as $item){ 
  $bg_image_name = $item['cmb']['file_name'];
  $is_basic = $item['cpm']['is_basic_menu'];
  ?>
  <div class="item">
<div class="container_menus" style="background-image: url(<?php echo $bg_img_path.'/'.$bg_image_name; ?>);">
<div class="menlistcontain">
<!-- Content goes here -->
<?php //echo $bg_image_name; ?>
<?php if($is_basic == 1){ 
echo $item['cpm']['basic_menu_text'];
?>
<?php }else{ 
  //echo "<pre>"; print_r($item); exit;
  $text_align = array('ac'=>'center','al'=>'left','aj'=>'justify','ar'=>'right');
  $font_weight = array(''=>'normal','B'=>'bold','aj'=>'justify','ar'=>'right');
  $menuType = $item['cpm']['menu_title'];
  $menu_data = $item['details'];
  $menutitle_style = "color:".$item['cpm']['menu_title_color'].";text-align:".$text_align[$item['cpm']['menu_title_alignment']].";font-family: ".$item['cpm']['menu_title_font'].";font-size:".$item['cpm']['menu_title_size']."px;font-weight:".$font_weight[$item['cpm']['menu_title_weight']].";";
  $course_style = "color:".$item['cpm']['course_color'].";text-align:".$text_align[$item['cpm']['course_alignment']].";font-family: ".$item['cpm']['course_font'].";font-size:".$item['cpm']['course_size']."px;font-weight:".$font_weight[$item['cpm']['course_weight']].";";

  $title_style = "color:".$item['cpm']['title_color'].";text-align:".$text_align[$item['cpm']['title_alignment']].";font-family: ".$item['cpm']['title_font'].";font-size:".$item['cpm']['title_size']."px;font-weight:".$font_weight[$item['cpm']['title_weight']].";";

  $description_style = "color:".$item['cpm']['Description_color'].";text-align:".$text_align[$item['cpm']['Description_allignment']].";font-family: ".$item['cpm']['Description_font'].";font-size:".$item['cpm']['Description_size']."px;font-weight:".$font_weight[$item['cpm']['Description_weight']].";";
  ?>

<div class="menlistrow">
<h1 class="menlisthd" style="<?php echo $menutitle_style; ?>"><?php echo $menuType; ?></h1>
</div>
<?php foreach($menu_data as $key=>$value){ //echo "<pre>"; print_r($value); exit; ?>
    <div class="menlistrow">
        <h3 class="menlisth3" style="<?php echo $course_style; ?>"><?php echo $value['cga_menu_courses']['course_name']; ?></h3>
        <?php //$i=1; foreach($value as $menu_item){ $muuid = $menu_item['CgaMenu']['UUID']; ?>
            <h4 class="menlisth4" style="<?php echo $title_style; ?>"><?php echo $value['cga_menus']['title']; ?></h4>
            <div class="addpremop">
            <h5 class="menlisth5 ext_<?php echo $value['cga_menus']['UUID']; ?>" id="<?php echo $value['cga_menus']['UUID']; ?>" style="<?php echo $description_style; ?>"><?php echo $value['cga_menus']['description']; ?></h5>
  </div>
        <?php //$i++; } ?>
       
    </div>
<?php } ?>




<?php } ?>
</div>
</div>

</div>

<?php } }else{ ?>
 

    <div class="item">
<div class="container_menus">
<div class="menlistcontain">
<p id="show_menu_date"></p>
      <p id="show_message_heading_text"></p>
      <p>The final touches are being added to the menu now.</p>
      <p>The Chef will publish it shortly.</p>
      <p>We apologize for any inconvenience caused by the delay.</p>

</div>
</div>
<!-- Content goes here 
</div>
  <?php } ?>

<!--
<div class="item">
<div class="container_menus" style="background-image: url(&quot;/superyacht/img/cga_files/menu_bg_orginals/menu_bg_converted/240130101227_leftapples.jpg&quot;);">
<div class="menlistcontain">

</div>
</div>
<!-- Content goes here 
</div>

<div class="item">
<div class="container_menus">
<div class="menlistcontain">

</div>
</div>
<!-- Content goes here 
</div>

<div class="item">
<div class="container_menus">
<div class="menlistcontain">

</div>
</div>
<!-- Content goes here 
</div>

<div class="item">
<div class="container_menus">
<div class="menlistcontain">

</div>
</div>
<!-- Content goes here 
</div>

-->


</div>
</body>
</html>
<script>
  $(function() {
  // Owl Carousel
  var owl = $(".owl-carousel");
  owl.owlCarousel({
    items: 1,
    margin:10,
    loop: true,
    nav: true,
  });
});
$(document).on("click", "#menualretpop_popup", function (e) {
        //alert();
        $(".menualretpop").hide();
    });
</script>
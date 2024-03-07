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
    border-width: 0;
    position: relative;
    overflow:auto;
    }
    .container_menuscontainer{
      padding:50px 0px;
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
</style>
</head>
<body>
  
<div class="container_menuscontainer">

<div class="owl-carousel owl-theme">

<?php foreach($menudata as $item){ 
  $bg_image_name = $item['cmb']['file_name'];
  ?>
  <div class="item">
<div class="container_menus" style="background-image: url(<?php echo $bg_img_path.'/'.$bg_image_name; ?>);">
<div class="menlistcontain">

</div>
</div>
<!-- Content goes here -->
<?php echo $bg_image_name; ?>
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

</script>
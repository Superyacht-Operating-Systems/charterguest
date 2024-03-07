<?php //echo "Test Ipad Menus"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Container Example</title>
<style>
    
  /* CSS goes here */
  .container_menus {
    width: 500px; /* Set the width */
    height: 750px; /* Set the height */
    /*background-color: #f0f0f0; /* Just to make the container visible */
    border: 5px solid #000; /* Optional: adds a border around the container */
  }
</style>
</head>
<body>

<div class="container_menus">
  <!-- Content goes here -->
  <?php echo $menudata[0]['cga_published_menus']['basic_menu_text']; ?>
</div>

</body>
</html>

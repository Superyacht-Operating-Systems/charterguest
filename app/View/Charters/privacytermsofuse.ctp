<style>
    #container {
    }

    .close-page {
      color:black; 
    }
.btn-st{
  width: 900px;
  margin: 0 auto;
  margin-top: 50px;
}
@media screen and (max-width: 1024px){
  .btn-st{
  margin-top: 130px !important;
  width: 94% !important;
}
  #scroll-container {
    margin-top: 10px!important;
}
}
@media only screen and (min-width: 320px) and (max-width: 767px){
  .btn-st{
    width: 92% !important;
  margin-top: 115px;
  }
#scroll-container {
  margin-top: 10px;
}
}

    #scroll-container {
       margin-top: 10px;
        border: 3px solid;
        border-radius: 5px;
        width: 900px;
        height: 710px;
        overflow-x: hidden;
        overflow-y: scroll;
    }

    #scroll-text {
        padding: 10px;
        height: 100%;
    }
</style>

<div id="container">
<div class="btn-st">
  <button type="button" class="btn close-page" onClick="close_window()">Close Page</button>
  </div>
  <div id="scroll-container">
    <div id="scroll-text">
      <?php print_r($details['leagal_documents']['description']); ?>
    <div>
  </div>
</div>

<script>
    document.body.style.backgroundImage = "url('https://totalsuperyacht.com:8080/charterguest/css/admin/images/full-charter.png')";
    function close_window() {
      window.close();
    }
</script>
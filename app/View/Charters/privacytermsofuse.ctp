<style>
    #container {
    }

    .close-page {
      color:black; 
      margin-left: 130px;
    }

    #scroll-container {
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
  <button type="button" class="btn close-page" onClick="close_window()">Close Page</button>
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
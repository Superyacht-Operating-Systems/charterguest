<style>
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

<div id="scroll-container">
  <div id="scroll-text">
    <?php print_r($details['leagal_documents']['description']); ?>
  <div>
</div>

<script>
    document.body.style.backgroundImage = "url('https://totalsuperyacht.com:8080/charterguest/css/admin/images/full-charter.png')";
</script>
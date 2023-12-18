<?php   
    $BASE_FOLDER = $this->request->base; 
?>
<div class="owl-theme owl-dotsrow">
<div class="owl-dots ">
</div>
</div>
<div class="owl-mobilecontainer">
<div class="owl-carousel owl-theme ">
    <?php foreach($CrewInfo as $val){ ?>
<!-- Head Charterer info -->
<div class="charterRow mobviewheight">
    <div class="">
        <div class="row col-md-12">
            <div class="col-md-9 notmob"><h2><?php echo $val['User']['first_name'].' '.$val['User']['last_name']; ?> - <?php echo $val['Position']['position_name']; ?></h2></div>
            
        </div>
        <div class="row col-md-12">
            <div class="col-md-3 crewimgleft" style="float:right;">
                        <?php 
                        $SITE_URL = "https://charterguest.net/";
                        //$SITE_URL = "http://localhost/";
                        
                        if(!empty($fleetname)){
                            $img = $domain.$fleetname."/app/webroot/".$yachtname."/app/webroot/img/users/profile_pics/".$val['User']['image'];
                        }else{
                            $img = $domain.$yachtname."/app/webroot/img/users/profile_pics/".$val['User']['image'];
                        }
                    ?>
                    <img class="crewimg" src="<?php echo $img; ?>" alt="" style="border-radius: 15px;" width="200px" height="200px">
                    <div class="mobdisplay"><p><h3 class="mobh3"><?php echo $val['Position']['position_name']; ?></h3></p><p><h3 class="mobh3"><?php echo $val['User']['first_name'].' '.$val['User']['last_name']; ?></h3></p></div>
            </div>
            <div class="col-md-9 pull-left notmobcontainer bgmobdisp" >
            <?php echo $val['CrewInfo']['crew_bios']; ?>

            </div>
        </div>
    </div>
</div>
<?php } ?>
</div>
</div>




</div></div>
<script type="text/javascript">
    $(document).ready(function() {
  $('.owl-carousel').owlCarousel({
    stagePadding:0,/*the little visible images at the end of the carousel*/
     
    loop:false,
    rtl: false,
    lazyLoad:true,
    margin:0,
    dots:true,
      dotsContainer: '.owl-dots',
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
});


// $(".owl-dots:nth-child(6)").addClass("myactive"); 
// //$('.owl-carousel').trigger('to.owl.carousel', 6 );


var dotclassarr = [];
        $('.owl-carousel .owl-stage .owl-item').each(function(index){
            //console.log(index);
            var dotclass = $(this).find('.owlbtnflag').attr('data-owldotclass');
            
            dotclassarr.push(dotclass);
            
        });

       // console.log(dotclassarr);
checkClasses();
$('.owl-theme').on('translated.owl.carousel', function(event) {
        checkClasses();
    });

    function checkClasses(){
        var total = $('.owl-theme .owl-dots .owl-dot').length;
        $('.owl-theme .owl-dots .owl-dot').each(function(index){
            //console.log(index);
           
            if(dotclassarr[index] != "undefined"){
                $(this).css({"background": dotclassarr[index]});
            }
            
        });
    }





 });

</script>

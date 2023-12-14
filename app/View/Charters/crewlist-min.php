<div class="owl-theme owl-dotsrow">
<div class="owl-dots ">
</div>
</div>
<div class="owl-mobilecontainer">
<div class="owl-carousel owl-theme ">
<!-- Head Charterer info -->
                                <div class="charterRow">
                                    <div class="">
                                        <div class="row col-md-12">
                                            <div class="col-md-9"><h2>David - Captain</h2></div>
                                            
                                        </div>
                                        <div class="row col-md-12">
                                            <div class="col-md-9" style="border: 2px solid #5a5a5a;border-radius: 15px;
background-color: #5a5a5a;padding: 10px 10px 10px 10px;">
                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                            It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.

                                            </div>
                                            <div class="col-md-3">
                                                        <?php 
                                                        //$SITE_URL = "https://charterguest.net/";
                                                        $SITE_URL = "http://localhost/";
                                                        
                                                        
                                                        $img = $SITE_URL."charterguest/app/webroot/img/220715132544_JOdie.png";
                                                    ?>
                                                    <img src="<?php echo $img; ?>" alt="" style="border-radius: 15px;" width="150px" height="150px">
                                            </div>
                                        </div>
                                    </div>
                                    <br/><br/><br/><br/>
                                    <div class="row col-md-12">
                                        <div class="col-md-9"><h2>David - Captain</h2></div>
                                        
                                    </div>
                                        <div class="row col-md-12">
                                            <div class="col-md-9" style="border: 2px solid #5a5a5a;border-radius: 15px;
background-color: #5a5a5a;padding: 10px 10px 10px 10px;">
                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.

                                            </div>
                                            <div class="col-md-3">
                                                <?php 
                                                $SITE_URL = "https://charterguest.net/";
                                                //$SITE_URL = "http://localhost/";
                                                
                                                
                                                $img = $SITE_URL."charterguest/app/webroot/img/220715132544_JOdie.png";
                                            ?>
                                            <img src="<?php echo $img; ?>" alt="" style="border-radius: 15px;" width="150px" height="150px">
                                            </div>
                                        </div>
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

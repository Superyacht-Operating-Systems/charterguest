<?php 
  echo $this->Html->css('fontawsome-pro/css/fontawesome.css');
  echo $this->Html->css('fontawsome-pro/css/brands.css');
  echo $this->Html->css('fontawsome-pro/css/solid.css');
  echo $this->Html->css('fontawsome-pro/css/light.css');
  echo $this->Html->css('fontawsome-pro/css/v5-font-face.css');	
  
$basefolder = $requrl; 

// echo "presentations";

?>
<style>
.wrapper{
margin:0 auto;
width: 100%;
}
.slides-row{
  display: inline-block;
    width: 100%;
}
    @media only screen and (max-width: 999px){
#page-wrapper {
  background: transparent;
}
  body {
  background: #f2f2f3;
}
}
    @media (max-width: 445px){
#page-wrapper {
  padding: 110px 0px !important;
}
}
  #page-wrapper {
  padding: 85px 0;
}
    @media (min-width: 1920px){
#page-wrapper {
  padding-right: 0px !important;
  padding-left: 0px !important;
}
}
@media only screen and (max-width: 530px) {
 .controls button {
  padding: 6px 5px!important;
  margin: 0 3px!important;
  font-size: 11px!important;
  }
  .select_bgtype {
  font-size: 11px!important;
  padding: 7.5px 5px!important;
  }

  .loc_Data .loc_title{
margin-bottom: 5px!important;
}
.loc_Data .date_title{
margin-bottom: 0px!important;
}
}
  @media only screen and (max-width: 768px) {
    .caption_slide{
  font-size: 16px!important;
  }
  .H_title{
  font-size: 16px!important;
  }
  .slide_divwrap_default .caption{
    font-size: 16px!important;
  }
  .loc_Data .loc_title{
  font-size: 16px!important;
margin-bottom: 5px!important;
}
.loc_Data .date_title{
  font-size: 16px!important;
margin-bottom: 0px!important;
}
  }
  @media only screen and (min-width: 768px) and (max-width: 1024px){
    .caption_slide{
  font-size: 26px;
  }
  .H_title{
  font-size: 26px;
  }
  .slide_divwrap_default .caption{
    font-size: 26px;
  }
  .loc_Data .loc_title{
  font-size: 26px;
}
.loc_Data .date_title{
  font-size: 26px;
}
  }
  @media only screen and (min-width: 1024px) {
    .caption_slide{
  font-size: 36px;
  }
  .H_title{
  font-size: 36px;
  }
  .slide_divwrap_default .caption{
    font-size: 36px;
  }
  .loc_Data .loc_title{
  font-size: 36px;
}
.loc_Data .date_title{
  font-size: 36px;
}
  }
.H_title{
font-weight: 500;
line-height: 1.1;
color:#000;
}
#slides {
  width: calc(70vh * (16/9));
  height: 70vh;
  /* width: 95vw!important; 
  height: calc((95vw * 9) / 16); */
  margin: 0rem auto;

}


.img_section_slide img {
  border: ridge 15px;
    border-radius: 6px;


}



.slide {
  position: relative;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: none;
}

.slide.active {
    background-size: 100% 100%;
  /* display: block; */
  display: flex;
justify-content: center;
align-items: flex-end;
}

/* Controls styles */
.controls {
  text-align: center;
   width: 95vw;
margin: 20px auto;
}

.controls button {
  padding: 10px 20px;
  margin: 0 5px;
  font-size: 16px;
  background-color: #7fcfff;
border: 1px solid #82b8d9;
border-radius: 5px;
}

.controls button:focus {
  outline: none;
}

.controls button:hover {
  background-color: #71c2f3;
border: 1px solid #68aed8;
  cursor: pointer;
}

button:disabled,
    button[disabled] {
		cursor:not-allowed!important;
		background-color: initial !important;
pointer-events: auto!important;
	}

  .slide_divwrap{
  margin-top: 6.5rem;
  width: 100%;
}
.caption{
  text-align: center;
  margin-top: 8px;
}
.img_section{
  height: 435px;
  width: 74.6%;
  margin-top: 2.2rem !important;
margin: auto;
}
.caption_slide{
  text-align: center;
font-weight: 500;
line-height: 1.1;
}
.img_section_slide{
 
/* height: calc((68.7vw * 9) / 16);
width: 68.7vw;
margin: 2.2rem auto 2.6vw; */
height: calc((90.2vh * 9) / 16);
width: 90.2vh;
  margin: 1.2rem auto 3.3vh;
  z-index: 0;
position: relative;
}
.img_section_slide img{
width: 100%;
height: 100%;
object-fit: cover;
}


.counter{
  float: left;
  padding: 0px 0px;
}
.sliderrow{
  justify-content: flex-end !important;
  display: flex;
  margin: 0px;
}

.slide_divwrap_default{
padding: 10px;
position: absolute;
top: 0;
left: 0;
}
.slide_divwrap_default .caption{
text-align: left;
color: #d7d7d7;
font-weight: 500;
line-height: 1.1;
}

.loc_Data{
margin: auto;
position: absolute;
bottom: 0;
right: 0;
padding: 10px;
color: #d7d7d7;
text-align: end;
}
.loc_Data .loc_title{
  font-weight: 500;
line-height: 1.1;
margin-top: 0px;
margin-bottom: 10px;
}
.loc_Data .date_title{
  font-weight: 500;
line-height: 1.1;
margin-top: 0px;
margin-bottom: 10px;
}

	.day_slide{
	padding: 10px;
	width: fit-content;
	background-color: #fff;
	margin: 10px;
	border-radius: 10px;
  position: absolute;
top: 0;
left: 0;
	}
  .select_bgtype{
    border-radius: 4px;
    color: rgb(0, 0, 0); 
    font-size: 12px;
    border: 1px solid rgb(204, 204, 204);
    /* float: right;   */
    padding: 14px 10px; 
    background-color: rgb(255, 255, 255) !important; 
    /* display: block; */
    margin: 0 5px;
  }

  @media only screen and (max-width: 1024px){
    .slides-row {
    margin-top: 70px;
}
  }

  @media only screen and (max-width: 900px) {
    #slides{
      width:100%;
    }
    .slides-row{
      padding:0px 20px;
    }
    .slide.active {
    background-size: 100% 100%;
 display: block;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
    background-position: center;
}
.navbar-absalute-top .yachtHeaderName {
    left: 36px;
    right: 0;
    top: 18px !important;
}
.slides-row {
}
}
@media only screen and (max-width: 500px) {
#slides {
    height: 300px;
}
}

/* @media only screen and (max-width: 480px) {
  #slides{
    height: 50vh;
    }
} */
</style>

<div class="slides-row">
<div id="slides">
    
    <div class="slide active StartImage" style="background-image: url(<?php echo $requrl; ?>/app/webroot/img/memories/<?php echo $yachtData['Yacht']['cg_memories_image']; ?>);">
      <div class="slide_divwrap_default">
        <div class="caption" ><?php echo $charterProgData['CharterProgram']['charter_name']; ?></div>                
      </div>
      <div class="loc_Data">
	      <div class="loc_title" ><?php echo $charterProgData['CharterProgram']['embarkation']; ?> to <?php echo $charterProgData['CharterProgram']['debarkation']; ?></div>
	      <div class="date_title" ><?php echo date('d M y',strtotime($charterProgData['CharterProgram']['charter_from_date'])); ?> - <?php echo date('d M y',strtotime($charterProgData['CharterProgram']['charter_to_date'])); ?></div>                
      </div>
    </div>

    <?php foreach($schduledata as $key=>$value){ //echo "<pre>"; echo $key; print_r($value);  exit; 
      /*$fname = $requrl.'/app/webroot/img/charter_program_files/itinerary_photos/'.$value['CharterProgramSchedule']['attachment'];
       if(file_exists($fname)) { */?>
      <div class="slide LocationImage" style='background-image: url("<?php echo $requrl; ?>/app/webroot/img/charter_program_files/itinerary_photos/<?php echo $value['CharterProgramSchedule']['attachment']; ?>");'>
      <?php  /* }else{ ?>
        <div class="slide" style="background-image:none;">
        <?php } */?>
        <div class="day_slide" >
			    <div class="H_title" style="margin: 0px;">Day <?php echo $value['CharterProgramSchedule']['day_num']; ?></div>
			    <div class="H_title" style="margin: 0px;padding-top: 2px;"><?php echo $value['CharterProgramSchedule']['title']; ?></div> 
        </div>
      </div>
      <?php for($i=1;$i<=6;$i++){ 
        $attachment = "";
        $caption = "";
      ?>
        <?php 
        
        if(isset($value["GuestMemory"]["CharterProgramGuestMemory"]["caption$i"]) && $value["GuestMemory"]["CharterProgramGuestMemory"]["caption$i"]!=''){ 
        
          $caption=$value["GuestMemory"]["CharterProgramGuestMemory"]["caption$i"];

        } 

        if(isset($value["GuestMemory"]["CharterProgramGuestMemory"]["caption$i"."_attachment"]) && $value["GuestMemory"]["CharterProgramGuestMemory"]["caption$i"."_attachment"]!=''){ 
        
          $attachment=$value["GuestMemory"]["CharterProgramGuestMemory"]["caption$i"."_attachment"];

        } 
         
         ?>
         <?php if(isset($attachment) && $attachment!=''){ ?>
          <div class="slide slideDiv ActivityImage">
            <div class="row sliderrow">
                <div class="col-lg-9 col-md-9 col-xs-9 col-sm-9 slide_divwrap">
                    <div class="caption_slide" ><?php echo $caption; ?></div>
                    <div class="imgbody" >
                        <div class="img_section_slide">
                        <img src="<?php echo $requrl; ?>/app/webroot/img/memories/<?php echo $attachment; ?>"/>
                        </div>
                    </div>
                </div>
            </div>
          </div>

         <?php } ?>

      <?php } ?>
    <?php } ?>

    <?php foreach($deb as $key=>$value){ //echo "<pre>"; echo $key; print_r($value);  exit; 
      /* $fname = $requrl.'/app/webroot/img/charter_program_files/itinerary_photos/'.$value['CharterProgramSchedule']['attachment'];
       if(file_exists($fname)) { */?>
        <div class="slide LocationImage" style='background-image: url("<?php echo $requrl; ?>/app/webroot/img/charter_program_files/itinerary_photos/<?php echo $value['CharterProgramSchedule']['attachment']; ?>");'>
    <?php /*  }else{ ?>
      <div class="slide" style="background-image:none;">
     <?php  }*/
      ?>


  <div class="day_slide" >
    <div class="H_title" style="margin: 0px;">Day <?php echo $value['CharterProgramSchedule']['day_num']; ?></div>
    <div class="H_title" style="margin: 0px;padding-top: 2px;"><?php echo $value['CharterProgramSchedule']['title']; ?></div> 
  </div>
</div></div>
<?php for($i=1;$i<=6;$i++){ 
  $attachment = "";
  $caption = "";
?>
  <?php 
  
  if(isset($value["GuestMemory"]["CharterProgramGuestMemory"]["caption$i"]) && $value["GuestMemory"]["CharterProgramGuestMemory"]["caption$i"]!=''){ 
  
    $caption=$value["GuestMemory"]["CharterProgramGuestMemory"]["caption$i"];

  } 

  if(isset($value["GuestMemory"]["CharterProgramGuestMemory"]["caption$i"."_attachment"]) && $value["GuestMemory"]["CharterProgramGuestMemory"]["caption$i"."_attachment"]!=''){ 
  
    $attachment=$value["GuestMemory"]["CharterProgramGuestMemory"]["caption$i"."_attachment"];

  } 
   
   ?>
   <?php if(isset($attachment) && $attachment!=''){ ?>
    <div class="slide slideDiv ActivityImage">
      <div class="row sliderrow">
          <div class="col-lg-9 col-md-9 col-xs-9 col-sm-9 slide_divwrap">
              <div class="caption_slide" ><?php echo $caption; ?></div>
              <div class="imgbody" >
                  <div class="img_section_slide">
                  <img src="<?php echo $requrl; ?>/app/webroot/img/memories/<?php echo $attachment; ?>"/>
                  </div>
              </div>
          </div>
      </div>
    </div>

   <?php } ?>

<?php } ?>
<?php } ?>
    

    
   
    <!-- Add more slides as needed -->
  </div>

  <div class="controls">
  <div class="counter"></div>
  <select class="select_bgtype"
	  id="bg_type" name="" onchange="setBGType()">
	<option value="">Select Style</option>
	<option value="Elegant">Elegant</option>
	<option value="Kids">Kids Fun</option>
	<option value="Party" selected>Party Time</option>
	<option value="Romantic">Romantic</option>
	</select>
  
  <button id="playBtn" >Play</button>
    <button id="stopBtn" disabled >Stop</button>
    <button id="previousBtn" disabled >Previous</button>
    <button id="nextBtn">Next</button>
  </div>

  <script type="text/javascript">
var basefolder = '<?php echo $basefolder;?>';
// Get all slides
const slides = document.querySelectorAll('.slide');
const slidesDiv = document.querySelectorAll('.slideDiv');
var prev = document.querySelector("#previousBtn");
var next = document.querySelector("#nextBtn");
var playBtn = document.querySelector('#playBtn');
var stopBtn = document.querySelector('#stopBtn');

// Set the initial slide index
let currentSlide = 0;
let isPlaying = false;
let intervalId;

playBtn.addEventListener('click', startAutoplay);
stopBtn.addEventListener('click', stopAutoplay);
prev.addEventListener('click', previousSlide);
next.addEventListener('click', nextSlide);

$( document ).ready(function() {
  setBGType();
});

function setBGType(){
 var selectedType = document.getElementById("bg_type").value;
      if(selectedType == 'Party' ){
        $('.slide_divwrap .caption_slide').css({
          'color': '#000',
          'margin-bottom':'1.5vh'
          });
        $('.slide_divwrap .img_section_slide').css({
            'height': 'calc((92vh * 9) / 16)',
            'width': '91vh',
            'margin':'0 auto 2.6vh',
            'padding-left':'0px'
        });
		slidesDiv.forEach(function(slide, index) {
			var backgroundImageIndex = index % 5; 
			slide.style.backgroundImage = 'url('+basefolder+'/app/webroot/img/presentations/slide_bg' + (backgroundImageIndex + 1) + '.png)';
		});
	  }else if(selectedType=='Kids'){
      $('.slide_divwrap .caption_slide').css({
            'color': '#000',
            'margin-bottom':'2.5vh'
          });
        $('.slide_divwrap .img_section_slide').css({
            'height': 'calc((90.2vh * 9) / 16)',
            'width': '94vh',
            'padding-left':'5px',
            'margin':'0 auto 4vh'
        });
	    slidesDiv.forEach(function(slide, index) {
			var backgroundImageIndex = index % 5; 
			slide.style.backgroundImage = 'url('+basefolder+'/app/webroot/img/presentations/kids_slide_bg' + (backgroundImageIndex + 1) + '.png)';
		});
	  }else if(selectedType=='Romantic'){
      $('.slide_divwrap .caption_slide').css({
            'color': '#000',
            'margin-bottom':'2.5vh'
          });
        $('.slide_divwrap .img_section_slide').css({
            'height': 'calc((92vh * 9) / 16)',
            'width': '89vh',
            'margin':'0 auto 4.5vh',
            'padding-left':'0px'
        });
	     slidesDiv.forEach(function(slide, index) {
			slide.style.backgroundImage = 'url('+basefolder+'/app/webroot/img/presentations/romantic_slide_bg.png)';
		});
	  }else if(selectedType=='Elegant'){
      $('.slide_divwrap .caption_slide').css({
            'color': '#fff',
            'margin-bottom':'2.2vh'
          });
        $('.slide_divwrap .img_section_slide').css({
            'height': 'calc((86vh * 9) / 16)',
            'width': '93vh',
            'margin':'0 auto 8vh',
            'padding-left':'3px'
        });
	     slidesDiv.forEach(function(slide, index) {
			slide.style.backgroundImage = 'url('+basefolder+'/app/webroot/img/presentations/elegant_slide_bg.png)';
		});
	  }else{
      $('.slide_divwrap .caption_slide').css({
          'color': '#000',
          'margin-bottom':'1.5vw'
          });
        $('.slide_divwrap .img_section_slide').css({
            'height': 'calc((90.2vh * 9) / 16)',
            'width': '90.5vh',
            'margin':'0 auto 3vh',
            'padding-left':'0px'
        });
	     slidesDiv.forEach(function(slide, index) {
			var backgroundImageIndex = index % 5; 
			slide.style.backgroundImage = 'url('+basefolder+'/app/webroot/img/presentations/slide_bg' + (backgroundImageIndex + 1) + '.png)';
		});
	  }
}

// Function to show the current slide
function showSlide() {
  slides.forEach((slide, index) => {
    if (index === currentSlide) {
      slide.classList.add('active');
    } else {
      slide.classList.remove('active');
    }
  });
}

// Function to show the next slide
function nextSlide() {
  // currentSlide = (currentSlide + 1) % slides.length;
  currentSlide = (currentSlide + 1);
  if(currentSlide < slides.length){
	  showSlide();
	  if(currentSlide + 1 >= slides.length){
		  next.disabled = true;
       // next.style.display = 'none';
      }else{
		  prev.disabled = false;
     // next.disabled = false;
		  // prev.style.display = 'inline';
	  }
  }else if(currentSlide == slides.length-1){
      stopBtn.disabled = true;
	  playBtn.disabled = false;
  }else if(currentSlide >= slides.length) {
  stopAutoplay();
  }
  
}

// Function to show the previous slide
function previousSlide() {
  currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    if(currentSlide < 1){
		prev.disabled = true;
		// prev.style.display = 'none';
	}else{
		next.disabled = false;
	// next.style.display = 'inline';
	}
  showSlide();
}

// Function to start autoplay
function startAutoplay() {
	currentSlide = -1;
  if (!isPlaying && currentSlide < slides.length ) {
	  playBtn.disabled = true;
	  stopBtn.disabled = false;
	  // playBtn.style.display = 'none';
	  // stopBtn.style.display = 'inline';
    isPlaying = true;
    intervalId = setInterval(nextSlide, 2000); // Change the delay between slides as desired
  }
}

// Function to stop autoplay
function stopAutoplay() {
  if (isPlaying) {
	  stopBtn.disabled = true;
	  playBtn.disabled = false;
	    // stopBtn.style.display = 'none';
	  // playBtn.style.display = 'inline';
    isPlaying = false;
    clearInterval(intervalId);
  }
}

  </script>
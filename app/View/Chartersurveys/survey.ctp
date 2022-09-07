<?php
    $base = $this->request->base;
?>
<head>
  <style type="text/css" media="screen">
.flex-row .radio, .yes-nofld .radio{
  margin-bottom:5px;
}
.survey-contain-row .flex-row label span {
    top: 1.2px!important;
}
    tbody.chechbox tr td {
      padding: 20px;
    }
.survey-contain-row h5 span{
  padding-right: 10px;
}
.survey-contain-row h5 span::before {
  counter-increment: section;
  content: "" counter(section) "";
  padding-right: 5px;
}

.survey-contain-row h5{
font-weight: bold;
}
.survey-contain-row h3{
font-weight: bold;
font-size: 18px;
margin-bottom: 10px;
margin-top: 0px;
line-height: 24px;
}
.survey-contain-row h3 span{
  display: inline-block;
    width: 100%;
    margin-top: 35px;
    font-size: 24px;
}
.form-textarea .form-control{
width: 600px;
}
.row-fld-hText h5{
  margin-bottom: 0px;
}


.yes-nofld label span{
    top: 2px;
    left: -6px;
}
.yes-nofld label .no{
   left: -4px!important;
}
.survey-contain-row .flex-row>div,
.yes-nofld>div
{
  float: left;
  width: 60px;
  display: flex;
}
.flex-mdrow{
  display: inline-block;
  width: 100%;
  margin: 0px;
}
.row-fld-hText .col-md-12{
  padding: 0px;
}
.survey-100 .text-right{
  text-align: left;
  margin-bottom: 0px;
  display: flex;
}
.col-md-12.form-textarea{
   padding: 0px;
}
.survey-contain-row

    /* Radios */
    .radio {
      padding-left: 20px;
    }
    .radio label {
      display: inline-block;
      padding-left: 5px;
      position: relative;
    }
    .radio label::before {
      -o-transition: border 0.5s ease-in-out;
      -webkit-transition: border 0.5s ease-in-out;
      background-color: #d5d5d5;
      border-radius: 50%;
      border: 1px solid #cccccc;
      content: "";
      display: inline-block;
      height: 17px;
      left: 0;
      margin-left: -20px;
      position: absolute;
      transition: border 0.5s ease-in-out;
      width: 17px;
      outline: none !important;
    }
    .radio label::after {
      -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
      -ms-transform: scale(0, 0);
      -o-transform: scale(0, 0);
      -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
      -webkit-transform: scale(0, 0);
      -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
      background-color: #555555;
      border-radius: 50%;
      content: " ";
      display: inline-block;
      height: 11px;
      left: 3px;
      margin-left: -20px;
      position: absolute;
      top: 3px;
      transform: scale(0, 0);
      transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
      width: 11px;
    }
    .radio input[type="radio"] {
      cursor: pointer;
      opacity: 0;
      z-index: 1;
      outline: none !important;
    }
    .radio input[type="radio"]:disabled + label {
      opacity: 0.65;
    }
    .radio input[type="radio"]:focus + label::before {
      outline-offset: -2px;
      outline: thin dotted;
    }
    .radio input[type="radio"]:checked + label::after {
      -ms-transform: scale(1, 1);
      -o-transform: scale(1, 1);
      -webkit-transform: scale(1, 1);
      transform: scale(1, 1);
      left: 0px!important;
          top: 0px!important;
          background: #1eabfc!important;
    }
    .radio input[type="radio"]:disabled + label::before {
      cursor: not-allowed;
    }
    .radio.radio-inline {
      margin-top: 0;
    }
    .radio.radio-single label {
      height: 17px;
    }
    tbody.checkbox-body tr td {
        padding: 0px 20px;
    }
    .count-top tr td{
      position: relative;
    }
    .count-top tr:first-child td:before {
        position: absolute;
        text-align: center;
        left: 34%;
        top: -15px;
        font-weight: 600;
        counter-increment: section;
        content: ""counter(section)"";
    }
    body {
        counter-reset: section;
    }

@media only screen and (min-width: 320px) and (max-width: 767px){
.survey-containerbody {
    width: 100%;
        padding: 0px 30px;
}
}


  </style>
</head>
<body>
<?php

    $surveyRating = array();
    if (isset($surveyData['CharterGuestSurvey']['survey_rating']) && !empty($surveyData['CharterGuestSurvey']['survey_rating'])) {
        $ratingArray = explode(',', $surveyData['CharterGuestSurvey']['survey_rating']);
        foreach ($ratingArray as $item) {
            $keyValue = explode('-', $item);
            $surveyRating[$keyValue[0]] = $keyValue[1];
        }
    }

?>
<div class="fixed-row-container survey-contain-row">
<div class="survey-containerbody">
        <div class="row">
            <div class="col-lg-8">                        
                <?php echo $this->Session->flash();?>   
            </div>
            <div class="col-md-4">

            </div>
        </div>
      <h3>Dear <?php echo isset($data['salutation']) ? $data['salutation'] : ""; ?>,</h3>
      <h3>Please rate your experience onboard.<span><?php echo isset($data['yacht_name']) ? $data['yacht_name'] : ""; ?>.</span></h3>
      <form method="post" action="<?php echo $base; ?>/chartersurveys/add_edit" id="rateform">
          <input type="hidden" name="id" value="<?php echo isset($surveyData['CharterGuestSurvey']['id']) ? $surveyData['CharterGuestSurvey']['id'] : ""; ?>">
          <input type="hidden" name="charter_company_id" value="<?php echo isset($data['charter_company_id']) ? $data['charter_company_id'] : ""; ?>">
          <input type="hidden" name="charter_yacht_id" value="<?php echo isset($data['charter_yacht_id']) ? $data['charter_yacht_id'] : ""; ?>">
          <input type="hidden" name="charter_program_id" value="<?php echo isset($data['charter_program_id']) ? $data['charter_program_id'] : ""; ?>">
          <input type="hidden" name="charter_guest_id" value="<?php echo isset($data['charter_guest_id']) ? $data['charter_guest_id'] : ""; ?>">
          <input type="hidden" name="charter_assoc_id" value="<?php echo isset($data['charter_assoc_id']) ? $data['charter_assoc_id'] : ""; ?>">
      <?php 
      $row = 1;
      foreach ($questionData as $question) {
          $i = $question['CharterSurveyQuestion']['question_number'];
      ?>
        <div class="row flex-mdrow">
          <div class="col-md-4 label-h5 survey-100">
            <h5 class="text-right"><span>-</span><?php echo $question['CharterSurveyQuestion']['question']; ?></h5>
          </div>
          <div class="col-md-8 survey-100">
            <div class="flex-row">
                  <div>
                    <div class="radio">
                        <input type="radio" name="question[<?php echo $i; ?>]" id="question1<?php echo $i; ?>" value="1" <?php echo (isset($surveyRating[$i]) && $surveyRating[$i] == 1) ? "checked" : ""; ?>>
                        <label for="question1<?php echo $i; ?>"><span>1</span></label>
                    </div>
                  </div>
                  <div>
                    <div class="radio">
                        <input type="radio" name="question[<?php echo $i; ?>]" id="question2<?php echo $i; ?>" value="2" <?php echo (isset($surveyRating[$i]) && $surveyRating[$i] == 2) ? "checked" : ""; ?>>
                        <label for="question2<?php echo $i; ?>"><span>2</span></label>
                    </div>
                 </div>
                  <div>
                    <div class="radio">
                        <input type="radio" name="question[<?php echo $i; ?>]" id="question3<?php echo $i; ?>" value="3" <?php echo (isset($surveyRating[$i]) && $surveyRating[$i] == 3) ? "checked" : ""; ?>>
                        <label for="question3<?php echo $i; ?>"><span>3</span></label>
                    </div>
                  </div>
                  <div>
                    <div class="radio">
                        <input type="radio" name="question[<?php echo $i; ?>]" id="question4<?php echo $i; ?>" value="4" <?php echo (isset($surveyRating[$i]) && $surveyRating[$i] == 4) ? "checked" : ""; ?>>
                        <label for="question4<?php echo $i; ?>"><span>4</span></label>
                    </div>
                  </div>
                  <div>
                    <div class="radio">
                        <input type="radio" name="question[<?php echo $i; ?>]" id="question5<?php echo $i; ?>" value="5" <?php echo (isset($surveyRating[$i]) && $surveyRating[$i] == 5) ? "checked" : ""; ?>>
                        <label for="question5<?php echo $i; ?>"><span>5</span></label>
                    </div>
                  </div>
                  <div>
                    <div class="radio">
                        <input type="radio" name="question[<?php echo $i; ?>]" id="question6<?php echo $i; ?>" value="6" <?php echo (isset($surveyRating[$i]) && $surveyRating[$i] == 6) ? "checked" : ""; ?>>
                        <label for="question6<?php echo $i; ?>"><span>6</span></label>
                    </div>
                  </div>
                  <div>
                    <div class="radio">
                        <input type="radio" name="question[<?php echo $i; ?>]" id="question7<?php echo $i; ?>" value="7" <?php echo (isset($surveyRating[$i]) && $surveyRating[$i] == 7) ? "checked" : ""; ?>>
                        <label for="question7<?php echo $i; ?>"><span>7</span></label>
                    </div>
                  </div>
                  <div>
                    <div class="radio">
                        <input type="radio" name="question[<?php echo $i; ?>]" id="question8<?php echo $i; ?>" value="8" <?php echo (isset($surveyRating[$i]) && $surveyRating[$i] == 8) ? "checked" : ""; ?>>
                        <label for="question8<?php echo $i; ?>"><span>8</span></label>
                    </div>
                  </div>
                  <div>
                    <div class="radio">
                        <input type="radio" name="question[<?php echo $i; ?>]" id="question9<?php echo $i; ?>" value="9" <?php echo (isset($surveyRating[$i]) && $surveyRating[$i] == 9) ? "checked" : ""; ?>>
                        <label for="question9<?php echo $i; ?>"><span>9</span></label>
                    </div>
                  </div>
                  <div>
                    <div class="radio">
                        <input type="radio" name="question[<?php echo $i; ?>]" id="question10<?php echo $i; ?>" value="10" <?php echo (isset($surveyRating[$i]) && $surveyRating[$i] == 10) ? "checked" : ""; ?>>
                        <label for="question10<?php echo $i; ?>"><span>10</span></label>
                    </div>
                  </div>
            </div>
            
          </div>
          <span id="span_question<?php echo $i; ?>" style="color:red;"> </span>
        </div>
      <?php 
      $row++;
      } ?>
      
      <div class="row flex-mdrow row-fld-hText">
        <div class="col-md-12">
          <h5>Would you charter with this yacht again?</h5>
        </div>
        <div class="col-md-12">
          <div class="yes-nofld">
                <div>
                  <div class="radio">
                      <input type="radio" name="yacht_again" id="yacht_again_yes" value="1" <?php echo (isset($surveyData['CharterGuestSurvey']['yacht_again']) && $surveyData['CharterGuestSurvey']['yacht_again'] == 1) ? "checked" : ""; ?>>
                      <label for="yacht_again_yes"><span>Yes</span></label>
                  </div>
                </div>
                <div>
                  <div class="radio">
                      <input type="radio" name="yacht_again" id="yacht_again_no" value="2" <?php echo (isset($surveyData['CharterGuestSurvey']['yacht_again']) && $surveyData['CharterGuestSurvey']['yacht_again'] == 2) ? "checked" : ""; ?>>
                      <label for="yacht_again_no"><span class="no">No</span></label>
                  </div>
                </div>
                <div>
                  <div class="radio">
                      <input type="radio" name="yacht_again" id="yacht_again_na" value="3" <?php echo (isset($surveyData['CharterGuestSurvey']['yacht_again']) && $surveyData['CharterGuestSurvey']['yacht_again'] == 3) ? "checked" : ""; ?>>
                      <label for="yacht_again_na"><span>N/A</span></label>
                  </div>
                </div>
          </div>
           
        </div>
        <span id="span_yacht_again" style="color:red;"> </span>
      </div>

      <div class="row flex-mdrow row-fld-hText">
        <div class="col-md-12">
          <h5>Would you use this charter broker again?</h5>
        </div>
  <div class="col-md-12">
          <div class="yes-nofld">
                <div>
                  <div class="radio">
                      <input type="radio" name="broker_again" id="broker_again_yes" value="1" <?php echo (isset($surveyData['CharterGuestSurvey']['broker_again']) && $surveyData['CharterGuestSurvey']['broker_again'] == 1) ? "checked" : ""; ?>>
                      <label for="broker_again_yes"><span>Yes</span></label>
                  </div>
                </div>
                <div>
                  <div class="radio">
                      <input type="radio" name="broker_again" id="broker_again_no" value="2"<?php echo (isset($surveyData['CharterGuestSurvey']['broker_again']) && $surveyData['CharterGuestSurvey']['broker_again'] == 2) ? "checked" : ""; ?> >
                      <label for="broker_again_no"><span class="no">No</span></label>
                  </div>
                </div>
                <div>
                  <div class="radio">
                      <input type="radio" name="broker_again" id="broker_again_na" value="3" <?php echo (isset($surveyData['CharterGuestSurvey']['broker_again']) && $surveyData['CharterGuestSurvey']['broker_again'] == 3) ? "checked" : ""; ?>>
                      <label for="broker_again_na"><span>N/A</span></label>
                  </div>
                </div>
          </div>
            
        </div>
        <span id="span_broker_again" style="color:red;"> </span>
      </div>

      <div class="row flex-mdrow">
        <div class="col-md-12 form-textarea">
          <h5>Comments</h5>
          <textarea class="form-control" rows="4" name="comments" id="comments" value="<?php echo (isset($surveyData['CharterGuestSurvey']['comments']) ? $surveyData['CharterGuestSurvey']['comments'] : ""); ?>"><?php echo (isset($surveyData['CharterGuestSurvey']['comments']) ? $surveyData['CharterGuestSurvey']['comments'] : ""); ?></textarea>
            <!-- <span id="span_comments" style="color:red;"> </span> -->
          <br>
          <div class="sub-btn-su">
            <input type="button" class="btn btn-success" value="Submit" onClick="fsubmit()">
        </div>
        </div>
      </div>
    </form>
  
</div>
</div>

<div id="StartModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>

          <div class="row">
              <div class="col-md-4">
                  <h4 class="modal-title">Welcome</h4>
              </div>
              <div class="col-md-7">
                  
              </div>
          </div> 
      </div>
      <div class="modal-body">
        <div class="form-group">
            <p>Because we value your feedback, all answers will be kept anonymous and confidential.</p>
            <p>1 is the lowest rating</p>
            <p>10 is the highest rating</p>

	      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default loginlink"  data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success startclick" >Start</button>
      </div>
    </div>

  </div>
</div>


<div id="EndModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!--  <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                  <h4 class="modal-title">Thank You</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <p>Thank you for completing this survey.</p>
            <p>Safe Travels</p>

	      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default loginlink"  data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
   var questionCount = <?php echo count($questionData); ?>

   $(document).ready(function() {
    
     <?php if($modalshow == "startmodal"){ ?>
                $('#StartModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $("#StartModal").modal('show');
                
      <?php }else if($modalshow == "endmodal"){ ?>
                $('#EndModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $("#EndModal").modal('show');
                
      <?php } ?>
   });

   
   $(document).on("click", ".loginlink", function (e) {
        window.location.href = "<?php echo $base; ?>/charters";
   });


   $(document).on("click", ".startclick", function (e) {
            $("#StartModal").modal('hide');
   });
    
  function fsubmit(){
    console.log('questionCount=',questionCount)
    if(validateFields() == true){
      console.log('fsubmit true')
      // return true;
      // $("#rateform").trigger("click");
      $( "#rateform" ).submit();
    } else {
      console.log('fsubmit false')
      // return false;
    }
  }

  function validateFields()
  {	
    var isError = 0;
    var yacht_again = $('input[name=yacht_again]:checked').val() 
    console.log('yacht_again=',yacht_again)
    

    var count = 1;
    while (count <= questionCount) {
      console.log('count=',count)
      var question = $('input[name="question['+count+']"]:checked').val() 
      console.log('question8=',question)
      if(question=='' || question==undefined)
      {
        errorSpanText('question'+count,'This field is required.');
        isError = 1;
      }else{
        errorSpanText('question'+count,'');
      }
      count ++;
    }

    if(yacht_again=='' || yacht_again==undefined)
    {
      errorSpanText('yacht_again','This field is required.');
      isError = 1;
    }else{
      errorSpanText('yacht_again','');
    }

    var broker_again = $('input[name=broker_again]:checked').val() 
    if(broker_again=='' || broker_again==undefined)
    {
      errorSpanText('broker_again','This field is required.');
      isError = 1;
    }else{
      errorSpanText('broker_again','');
    }

    console.log('comments=',$("#comments").val())
    if($("#comments").val()=='')
    {
      errorSpanText('comments','This field is required.');
      isError = 1;
    }else{
      errorSpanText('comments','');
    }

    console.log('isError=',isError)
    if(isError == 0){
      return true;
    }
    return false;
  }

  function errorSpanText(id,text)
  {
    $("#span_"+id).html(text);
  }
</script> 

</body>
<?php  ?>
<style> 

.labelhdpadd{
    padding-top: 25px;
}


::placeholder {
  color: gray!important;
  font-size: 12px !important;
  opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
    font-size: 12px !important;
  color: gray!important;
}

::-ms-input-placeholder { /* Microsoft Edge */
  color: gray!important;
  font-size: 12px !important;
}

    .terms-userow a{
margin: 0px 5px;
    }
    .terms-userow input{
position: relative;
    top: 2px;
}
.but-mb-5{
    margin-bottom: 40px !important;
}
.forgot-link{
    font-size: 13px;
    margin-top: -10px;
    display: block;
}
.mtopqu{
    margin-top:10px;
}
.joinnow-btn{
margin-top: 30px !important;
    float: none !important;
    margin: 0 auto;
    align-items: center;
    display: block;
    min-width:100px;
}
.terms-userow-row{
        margin-top: 10px;
}
.errormsg{
    color: #f00;
    font-size: 11px;
}
 @media only screen and (max-width:767px){
 .form-group {
    margin-bottom: 0px!important;
}
.joinnow-btn{
    width: 100%!important;
} 
.mt-45{
    margin-top:15px;
}
.p-left{
            padding: 0px 7px;
}
 }



</style>



<?php $basefolder = $this->request->base; ?>

<div id="tokenDiv" class="panel-body" style="height: 250px; <?php if (isset($urlStatus) && in_array($urlStatus, array('expired', 'not_found'))): ?>display:none;<?php endif; ?>">        
            <?php echo $this->Form->create('CharterGuest', array('url' => array('controller' => 'charters', 'action' => 'index'),'id'=>'tokenVerifyForm'));?>
    <fieldset style="padding-top:10px;">
        <input type="hidden" name="charter_uuid" value="<?php echo h(isset($uuid) ? $uuid : ''); ?>">
                    <?php echo $this->Session->flash();?>
        Username:
        <div class="form-group form_margin">                                        
                    <?php echo $this->Form->input('email',array('label' => false,'div' => false, 'name' => 'email', 'id' => 'email', 'placeholder' => 'Enter Username','class' => 'form-control','maxlength' => 55));?>
            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
        </div>
        Token/Password:
        <div class="form-group form_margin">                                        
                    <?php echo $this->Form->input('token',array('type' => 'password', 'label' => false,'div' => false, 'name' => 'token', 'id' => 'token', 'placeholder' => 'Enter the Token/Password','class' => 'form-control','maxlength' => 55));?>
            <span class="text-small red errorMsg" id="tokenError" style="color: red"></span>
        </div>
        <div class="inlonusercolumn">
         <span> Forgot</span>
        <a class="inlinetag" href="#" id="forgotUsernameLink">Username</a>
        <span>or</span>
        <a class="inlinetag" href="#" id="forgotPasswordLink">Password</a>
       </div>
        <div class="terms-userow-row">
            <label class="terms-userow">
                I agree with the <a href="<?php echo $this->request->base."/charters/privacytermsofuse/1" ?>" target="blank">terms of use </a>
                <input id="termsOfUse"  type="checkbox" value="" onclick="ToggleDisable()"/>
            </label>            
            <?php echo $this->Form->button('Submit',array('class' => 'btn btn-default', 'id' => 'tokenSubmit'));?>                
            <span class="text-small red errorMsg" id="commonError" style="color: red"></span>
        </div>
       <?php if (isset($urlStatus) && $urlStatus === 'valid'): ?>
       <button class="btn btn-default joinnow-btn" id="joinNowBtn" type="button">New to Charter Guest? Join now</button>
       <?php endif; ?>
    </fieldset>
            <?php echo $this->Form->end(); ?>
</div>

<?php if (isset($urlStatus) && in_array($urlStatus, array('expired', 'not_found'))): ?>
<div id="expiredLinkDiv" class="panel-body text-center" style="padding: 30px 15px; color: #ffffff;">
    <div style="font-size: 22px; font-weight: bold; margin-bottom: 6px;">
        Your invitation link
    </div>
    <div style="font-size: 22px; font-weight: bold; margin-bottom: 16px;">
        has expired.
    </div>
    <div style="font-size: 15px; margin-bottom: 16px;">
        For security, the one-time access link<br>
        is valid for 72 hours only.
    </div>
    <div style="font-size: 14px; margin-bottom: 12px;">
        <strong>If you have a Charter Guest Profile:</strong><br>
        Please proceed to the login page<br>
        and use your regular credentials.
    </div>
    <div style="font-size: 14px; margin-bottom: 20px;">
        <strong>If you are new to Charter Guest:</strong><br>
        Please contact the captain or agent<br>
        who invited you to request a new link.
    </div>
    <button class="btn btn-default joinnow-btn" type="button" id="goToLoginBtn">Go To Login Page</button>
</div>
<?php endif; ?>

<div class="welcomconatainer panel-body text-center" style="display:none; padding: 30px 15px; color: #ffffff;">
    <input type="hidden" id="welcomeRedirectUrl">
    <div style="font-size: 22px; font-weight: bold; margin-bottom: 6px;">Welcome Back</div>
    <div id="welcomeUserName" style="font-size: 22px; font-weight: bold; margin-bottom: 16px;"></div>
    <div style="font-size: 15px; margin-bottom: 5px;">Your new cruise on board</div>
    <div id="welcomeYachtName" style="font-size: 15px; margin-bottom: 16px;"></div>
    <div style="font-size: 14px; margin-bottom: 20px;">Is added to your profile.</div>
    <button class="btn btn-default joinnow-btn" type="button" id="welcomeOpenBtn">OPEN</button>
</div>




<div class="newusernamecreate" style="display: none;">
    <form id="newUserCreateForm">
        <fieldset style="padding-top:10px;">
        <div class="form-group">
         Username:
         <div class="form-group form_margin">
         <input name="new_username" id="newUsername" placeholder="Enter Username" class="form-control" maxlength="55" type="text">
         <span class="text-small red errorMsg" id="newUsernameError" style="color: red; display:none;">Sorry, this username is already in use</span>
        </div>
       </div>
        <div class="form-group mt-45">
         Display Name:
         <div class="row p-left">
        <div class="col-md-6">
        <div class="form-group form_margin">
         <input name="new_first_name" id="newFirstName" placeholder="First Name" class="form-control" maxlength="55" type="text">
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group form_margin">
         <input name="new_last_name" id="newLastName" placeholder="Last Name" class="form-control" maxlength="55" type="text">
        </div>
        </div>
        </div>
       </div>
         New Password:
         <div class="form-group form_margin">
         <input name="new_password" id="newPassword" placeholder="Enter Password" class="form-control" maxlength="55" type="password">
        </div>
        Confirm Password:
         <div class="form-group form_margin">
         <input name="new_confirm_password" id="newConfirmPassword" placeholder="Enter Password" class="form-control" maxlength="55" type="password">
       </div>

       <button class="btn btn-default joinnow-btn" type="button" id="newUserNextBtn" disabled="disabled">Next</button>
    </fieldset>
    </form>
</div>





<div class="usernamerecoveryrow"  style="display: none;">
    <form id="profileSetupForm">
        <input type="hidden" id="hiddenUsername" name="reg_username">
        <input type="hidden" id="hiddenFirstName" name="reg_first_name">
        <input type="hidden" id="hiddenLastName" name="reg_last_name">
        <input type="hidden" id="hiddenPassword" name="reg_password">
        <input type="hidden" id="hiddenUuid" name="reg_uuid" value="<?php echo h($uuid); ?>">
        <fieldset style="padding-top:10px;">
         Username Recovery Hint:
         <div class="form-group form_margin">
         <input name="username_recovery_hint" id="usernameRecoveryHint" placeholder="Username Recovery Hint" class="form-control" maxlength="500" type="text">
         <span class="text-small red errorMsg" id="hintError" style="color: red"></span>
       </div>
         Username Recovery Question:
         <div class="form-group form_margin">
            <select name="username_security_question_id" id="usernameSecurityQuestion" class="form-select form-control">
            <option value="">-- Select a question --</option>
            <?php if (!empty($securityQuestions)): foreach ($securityQuestions as $qId => $qText): ?>
            <option value="<?php echo $qId; ?>"><?php echo h($qText); ?></option>
            <?php endforeach; endif; ?>
            </select>
        </div>
        Answer:
         <div class="form-group form_margin">
         <input name="username_security_answer" id="usernameSecurityAnswer" placeholder="Answer" class="form-control" maxlength="500" type="text">
         <span class="text-small red errorMsg" id="answerError" style="color: red"></span>
         </div>
         <label class="labelhdpadd">Password Recovery Setup</label>
         <div class="mtopqu">Question 1:</div>
         <div class="form-group form_margin">
            <select name="password_security_question_id_1" id="passwordSecurityQuestion1" class="form-select form-control">
            <option value="">-- Select a question --</option>
            <?php if (!empty($securityQuestions)): foreach ($securityQuestions as $qId => $qText): ?>
            <option value="<?php echo $qId; ?>"><?php echo h($qText); ?></option>
            <?php endforeach; endif; ?>
            </select>
        </div>
         Answer 1:
         <div class="form-group form_margin">
         <input name="password_security_answer_1" id="passwordSecurityAnswer1" placeholder="Answer" class="form-control" maxlength="500" type="text">
         <span class="text-small red errorMsg" id="answer1Error" style="color: red"></span>
       </div>

       <div class="mtopqu">Question 2:</div>
         <div class="form-group form_margin">
            <select name="password_security_question_id_2" id="passwordSecurityQuestion2" class="form-select form-control">
            <option value="">-- Select a question --</option>
            <?php if (!empty($securityQuestions)): foreach ($securityQuestions as $qId => $qText): ?>
            <option value="<?php echo $qId; ?>"><?php echo h($qText); ?></option>
            <?php endforeach; endif; ?>
            </select>
        </div>

        Answer 2:
         <div class="form-group form_margin">
         <input name="password_security_answer_2" id="passwordSecurityAnswer2" placeholder="Answer" class="form-control" maxlength="500" type="text">
         <span class="text-small red errorMsg" id="answer2Error" style="color: red"></span>
       </div>
       <button class="btn btn-default joinnow-btn" type="submit" id="profileSetupSubmit">Submit</button>
    </fieldset>
    </form>
</div>


<div class="resetpassword" style="display: none;">
    <div class="form-group">
        <label>Password Reset</label>
    </div>
    <form id="resetPasswordForm">
        <fieldset style="padding-top:10px;">

            <!-- Step 1: Username -->
            <div id="resetStep1">
                Username:
                <div class="form-group form_margin">
                    <input name="reset_username" id="resetUsername" placeholder="Username" class="form-control" maxlength="55" type="text">
                    <span class="text-small red errorMsg" id="resetUsernameError" style="color: red; display:none;"></span>
                </div>
                <button class="btn btn-default joinnow-btn but-mb-5" type="button" id="resetPasswordBtn">Reset Password</button>
            </div>

            <!-- Step 2: Security questions (hidden until username verified) -->
            <div id="resetPasswordQuestionsDiv" style="display:none;">
                <input type="hidden" id="resetPQId1">
                <input type="hidden" id="resetPQId2">
                Question 1:
                <div class="form-group form_margin">
                    <input name="reset_question_1_display" id="resetQuestion1Display" placeholder="Question 1" class="form-control" maxlength="500" type="text" readonly>
                </div>
                Answer 1:
                <div class="form-group form_margin">
                    <input name="reset_answer_1" id="resetAnswer1" placeholder="Answer" class="form-control" maxlength="500" type="text">
                    <span class="text-small red errorMsg" id="resetAnswer1Error" style="color: red; display:none;"></span>
                </div>
                Question 2:
                <div class="form-group form_margin">
                    <input name="reset_question_2_display" id="resetQuestion2Display" placeholder="Question 2" class="form-control" maxlength="500" type="text" readonly>
                </div>
                Answer 2:
                <div class="form-group form_margin">
                    <input name="reset_answer_2" id="resetAnswer2" placeholder="Answer" class="form-control" maxlength="500" type="text">
                    <span class="text-small red errorMsg" id="resetAnswer2Error" style="color: red; display:none;"></span>
                </div>
                <button class="btn btn-default joinnow-btn" type="button" id="resetPasswordNextBtn">Next</button>
            </div>

        </fieldset>
    </form>
</div>


<div class="forgotusernamerow" style="display: none;">
    <form id="forgotUsernameForm">
        <fieldset style="padding-top:10px;">

            <!-- Step 1: Hint -->
            <div id="recoveryStep1">
                <label>Username Recovery Hint:</label>
                <div class="form-group form_margin">
                    <input name="forgot_recovery_hint" id="forgotRecoveryHint" placeholder="Enter your recovery hint" class="form-control" maxlength="500" type="text">
                    <span class="errormsg" id="forgotHintError" style="display:none;"></span>
                </div>
                <button class="btn btn-default joinnow-btn" type="button" id="getSecurityQuestionBtn">Get My Username Question</button>
            </div>

            <!-- Step 2: Security question + answer (hidden until Step 1 passes) -->
            <div id="recoveryStep2" style="display:none;">
                <label>Security Question:</label>
                <div class="form-group form_margin">
                    <input id="recoveryQuestionDisplay" class="form-control" type="text" readonly>
                </div>
                <label>Answer:</label>
                <div class="form-group form_margin">
                    <input name="forgot_recovery_answer" id="forgotRecoveryAnswer" placeholder="Your answer" class="form-control" maxlength="500" type="text">
                    <span class="errormsg" id="forgotAnswerError" style="display:none;"></span>
                </div>
                <button class="btn btn-default joinnow-btn" type="button" id="revealUsernameBtn">Get Security Question</button>
            </div>

            <!-- Step 3: Password security questions (hidden until Step 2 passes) -->
            <div id="recoveryStep3" style="display:none;">
                <input type="hidden" id="recoveredUsernameHidden">
                <div id="passwordQuestionsDiv">
                    <label>Question 1:</label>
                    <div class="form-group form_margin">
                        <input id="recoveryPQ1Display" class="form-control" type="text" readonly>
                        <input type="hidden" id="recoveryPQId1">
                    </div>
                    <label>Answer 1:</label>
                    <div class="form-group form_margin">
                        <input id="recoveryPAnswer1" placeholder="Your answer" class="form-control" maxlength="500" type="text">
                        <span class="errormsg" id="recoveryPAnswer1Error" style="display:none;"></span>
                    </div>
                    <label>Question 2:</label>
                    <div class="form-group form_margin">
                        <input id="recoveryPQ2Display" class="form-control" type="text" readonly>
                        <input type="hidden" id="recoveryPQId2">
                    </div>
                    <label>Answer 2:</label>
                    <div class="form-group form_margin">
                        <input id="recoveryPAnswer2" placeholder="Your answer" class="form-control" maxlength="500" type="text">
                        <span class="errormsg" id="recoveryPAnswer2Error" style="display:none;"></span>
                    </div>
                    <button class="btn btn-default joinnow-btn" type="button" id="pwdRecoveryNextBtn">Next</button>
                </div>
            </div>

        </fieldset>
    </form>
</div>


<div class="setnewpassword" style="display: none;">
    <div class="form-group">
        <label>Set New Password</label>
    </div>
    <form id="setNewPasswordForm">
        <fieldset style="padding-top:10px;">
         <input type="hidden" id="snpUsernameHidden">
         New Password:
         <div class="form-group form_margin">
         <input name="snp_new_password" id="snpNewPassword" placeholder="New Password" class="form-control" maxlength="55" type="password">
         <span class="text-small red errorMsg" id="snpPasswordError" style="color: red; display:none;"></span>
         </div>
         Confirm Password:
         <div class="form-group form_margin">
         <input name="snp_confirm_password" id="snpConfirmPassword" placeholder="Confirm Password" class="form-control" maxlength="55" type="password">
         <span class="text-small red errorMsg" id="snpConfirmError" style="color: red; display:none;"></span>
         </div>
         <button class="btn btn-default joinnow-btn" type="button" id="setNewPasswordSubmit">Submit</button>
        </fieldset>
    </form>
</div>


<div class="confirmpassword" style="display: none;">
    <form id="confirmPasswordForm">
        <fieldset style="padding-top:10px;">
         <input type="hidden" id="cpUsernameHidden">
         Username:
         <div class="form-group form_margin">
         <input id="cpUsernameDisplay" class="form-control" maxlength="55" type="text" readonly>
         </div>
         New Password:
         <div class="form-group form_margin">
         <input name="cp_new_password" id="cpNewPassword" placeholder="Enter Password" class="form-control" maxlength="55" type="password">
         <span class="text-small red errorMsg" id="cpPasswordError" style="color: red; display:none;"></span>
         </div>
         Confirm Password:
         <div class="form-group form_margin">
         <input name="cp_confirm_password" id="cpConfirmPassword" placeholder="Enter Password" class="form-control" maxlength="55" type="password">
         <span class="text-small red errorMsg" id="cpConfirmError" style="color: red; display:none;"></span>
         </div>
         <button class="btn btn-default joinnow-btn" type="button" id="confirmPasswordSubmit">Submit</button>
        </fieldset>
    </form>
</div>









<div id="passwordDiv" style="display: none;">
    <h3 class="text-center">Create Password</h3>
    <div class="panel-body" style="height: 250px;"> 
                <?php echo $this->Form->create('CharterGuest', array('url' => array('controller' => 'charters', 'action' => 'index'),'id'=>'passwordForm'));?>
        <input type="hidden" name="redirect_url" id="redirectUrl">
        <input type="hidden" name="charter_guest_id" id="charterGuestId">
        <input type="hidden" name="charter_assoc_id" id="charterAssocId">
        <input type="hidden" name="guest_list_id" id="GuestListId">
        <fieldset style="padding-top:10px;">
                        <?php echo $this->Session->flash();?>
            Password:
            <div class="form-group form_margin">                                        
                        <?php echo $this->Form->input('password',array('type' => 'password', 'label' => false,'div' => false, 'name' => 'password', 'id' => 'password', 'placeholder' => 'Enter the Password','class' => 'form-control','maxlength' => 55));?>
                <span class="text-small red errorMsg" id="passwordError" style="color: red"></span>
            </div>
            Confirm Password:
            <div class="form-group form_margin">                                        
                        <?php echo $this->Form->input('confirm_password',array('type' => 'password', 'label' => false,'div' => false, 'name' => 'confirm_password', 'id' => 'confirmPassword', 'placeholder' => 'Re-enter the Password','class' => 'form-control','maxlength' => 55));?>
                <span class="text-small red errorMsg" id="confirmPasswordError" style="color: red"></span>
            </div>
            <div class="">
                        <?php echo $this->Form->button('Submit',array('class' => 'btn btn-default' , 'id' => 'passwordSubmit'));?>                
                <span class="text-small red errorMsg" id="commonError" style="color: red"></span>
            </div>
        </fieldset>
                <?php echo $this->Form->end(); ?>
    </div>
</div>    

<script> 
    
// Token submission
$("#tokenSubmit").on("click", function(e) {
    e.preventDefault();

    var flag = 1;
    var token = $("#token").val();
    var email = $("#email").val();
    if (token.trim() == '') {
        flag = 0;
        $("#tokenError").text("Please enter the Token/Password.").slideDown('slow').delay(3000).slideUp();
    }
    if (email.trim() == '') {
        flag = 0;
        $("#emailError").text("Please enter the Email.").slideDown('slow').delay(3000).slideUp();
    }
    var data = $("#tokenVerifyForm").serialize();

    if (flag) {
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: 'charters/verifyToken',
            dataType: 'json',
            data: data,
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    //window.location.href = result.url;
                    $("#tokenDiv").hide();
                    $("#passwordDiv").show();
                    $("#redirectUrl").val(result.url); // Holding the Url to be redirected after Password creation
                    $("#charterGuestId").val(result.charter_guest_id);
                    $("#GuestListId").val(result.guest_list_id);
                    $("#charterAssocId").val(result.charter_assoc_id);
                } else if (result.status == 'fail') {  
                    $("#tokenError").text(result.message).slideDown('slow').delay(3000).slideUp(); 
                } else if (result.status == 'invalid_email') {  
                    $("#emailError").text(result.message).slideDown('slow').delay(3000).slideUp(); 
                } else if (result.status == 'success_redirect') {
                    window.location.href = result.url;
                } else if (result.status == 'success_new_charter') {
                    $("#tokenDiv").hide();
                    $("#welcomeUserName").text(result.first_name + ' ' + result.last_name);
                    $("#welcomeYachtName").text(result.yacht_name);
                    $("#welcomeRedirectUrl").val(result.url);
                    $(".welcomconatainer").show();
                }
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    } else {
        return false;
    }
    
});

// Password creation
$("#passwordSubmit").on("click", function(e) {
    e.preventDefault();

    var password = $("#password").val();
    var confirmPassword = $("#confirmPassword").val();
    var redirectUrl = $("#redirectUrl").val();
    
    var flag = 1;

    if (password.trim() == '') {
        $("#passwordError").text("Please enter the Password.").slideDown('slow').delay(3000).slideUp();
        flag = 0;
    }
    if (confirmPassword.trim() == '') {
        $("#confirmPasswordError").text("Please enter the Confirm password.").slideDown('slow').delay(3000).slideUp();
        flag = 0;
    } else if (confirmPassword != password) {
        $("#confirmPasswordError").text("Password is not matched.").slideDown('slow').delay(3000).slideUp();
        flag = 0;
    }
    var data = $("#passwordForm").serialize();

    if (flag) {
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: 'charters/createPassword',
            dataType: 'json',
            data: data,
            success:function(result) {
                $("#hideloader").hide();
                if (result.status == 'success') {
                    window.location.href = redirectUrl+'/'+result.guest_list_uuid;
                } else { 
                    $("#commonError").text("Internal server error.").slideDown('slow').delay(3000).slideUp();
                }   
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    }

});

// Profile setup form submit — save new user
$("#profileSetupSubmit").on("click", function(e) {
    e.preventDefault();

    var hint     = $("#usernameRecoveryHint").val().trim();
    var uQuestion = $("#usernameSecurityQuestion").val();
    var uAnswer  = $("#usernameSecurityAnswer").val().trim();
    var pQuestion1 = $("#passwordSecurityQuestion1").val();
    var pAnswer1  = $("#passwordSecurityAnswer1").val().trim();
    var pQuestion2 = $("#passwordSecurityQuestion2").val();
    var pAnswer2  = $("#passwordSecurityAnswer2").val().trim();

    if (!uQuestion || !uAnswer || !pQuestion1 || !pAnswer1 || !pQuestion2 || !pAnswer2) {
        alert("Please fill in all security questions and answers.");
        return;
    }

    $("#hideloader").show();
    $.ajax({
        type: "POST",
        url: '<?php echo $this->request->base; ?>/charters/registerGuestUser',
        dataType: 'json',
        data: $("#profileSetupForm").serialize(),
        success: function(result) {
            $("#hideloader").hide();
            if (result.status === 'success') {
                var loginData = {
                    email: result.username,
                    token: $("#hiddenPassword").val()
                };
                $("#hideloader").show();
                $.ajax({
                    type: "POST",
                    url: '<?php echo $this->request->base; ?>/charters/verifyToken',
                    dataType: 'json',
                    data: loginData,
                    success: function(loginResult) {
                        $("#hideloader").hide();
                        if (loginResult.status === 'success_redirect') {
                            window.location.href = '<?php echo $this->request->base; ?>/' + loginResult.url;
                        } else if (loginResult.status === 'success') {
                            $(".usernamerecoveryrow").hide();
                            $("#passwordDiv").show();
                            $("#redirectUrl").val(loginResult.url);
                            $("#charterGuestId").val(loginResult.charter_guest_id);
                            $("#GuestListId").val(loginResult.guest_list_id);
                            $("#charterAssocId").val(loginResult.charter_assoc_id);
                        } else {
                            alert("Registration succeeded but auto-login failed. Please log in manually.");
                            $(".usernamerecoveryrow").hide();
                            $("#tokenDiv").show();
                        }
                    },
                    error: function() {
                        $("#hideloader").hide();
                        alert("Registration succeeded. Please log in manually.");
                        $(".usernamerecoveryrow").hide();
                        $("#tokenDiv").show();
                    }
                });
            } else {
                alert(result.message || "An error occurred. Please try again.");
            }
        },
        error: function() {
            $("#hideloader").hide();
            alert("An error occurred. Please try again.");
        }
    });
});

// Username availability check on blur
$("#newUsername").on("blur", function() {
    var username = $(this).val().trim();
    if (username === '') {
        $("#newUsernameError").hide();
        $("#newUserNextBtn").prop("disabled", true);
        return;
    }
    $.ajax({
        type: "POST",
        url: '<?php echo $this->request->base; ?>/charters/checkUsername',
        dataType: 'json',
        data: { username: username },
        success: function(result) {
            if (result.exists) {
                $("#newUsernameError").show();
                $("#newUserNextBtn").prop("disabled", true);
            } else {
                $("#newUsernameError").hide();
                $("#newUserNextBtn").prop("disabled", false);
            }
        }
    });
});

// Next button on newusernamecreate: validate, carry data, show next step
$("#newUserNextBtn").on("click", function() {
    var username  = $("#newUsername").val().trim();
    var firstName = $("#newFirstName").val().trim();
    var lastName  = $("#newLastName").val().trim();
    var password  = $("#newPassword").val();
    var confirm   = $("#newConfirmPassword").val();
    var valid = true;

    if (username === '') {
        $("#newUsernameError").text("Please enter a username.").show();
        valid = false;
    }
    if (firstName === '') {
        valid = false;
    }
    if (password === '') {
        valid = false;
    } else if (password !== confirm) {
        valid = false;
        alert("Passwords do not match.");
    }
    if (!valid) return;

    // Copy data into hidden fields of the next form
    $("#hiddenUsername").val(username);
    $("#hiddenFirstName").val(firstName);
    $("#hiddenLastName").val(lastName);
    $("#hiddenPassword").val(password);

    $(".newusernamecreate").hide();
    $(".usernamerecoveryrow").show();
});

// Join now button: show registration form, hide login
$("#joinNowBtn").on("click", function() {
    $("#tokenDiv").hide();
    $(".newusernamecreate").show();
});

var myObj = document.getElementById ("tokenSubmit");
myObj.disabled = true;

function ToggleDisable () {
    if (myObj.isDisabled) {
        myObj.disabled = (myObj.isDisabled == true)? false : true;
    } else {
        myObj.disabled = (myObj.disabled == true)? false : true;
    }
}

// Welcome back OPEN button — redirect to programs page
$("#welcomeOpenBtn").on("click", function() {
    var url = $("#welcomeRedirectUrl").val();
    if (url) {
        window.location.href = '<?php echo $this->request->base; ?>/' + url;
    }
});

// Go To Login Page from expired link div
$("#goToLoginBtn").on("click", function() {
    $("#expiredLinkDiv").hide();
    $("#tokenDiv").show();
});

// Forgot username link — show recovery form, hide login
$("#forgotUsernameLink").on("click", function(e) {
    e.preventDefault();
    $("#tokenDiv").hide();
    $("#expiredLinkDiv").hide();
    $(".forgotusernamerow").show();
    $("#forgotRecoveryHint").val('').prop('readonly', false);
    $("#forgotRecoveryAnswer").val('');
    $("#getSecurityQuestionBtn").show();
    $("#recoveryStep1").show();
    $("#recoveryStep2").hide();
    $("#recoveryStep3").hide();
    $("#passwordQuestionsDiv").hide();
});

// Step 1: verify hint and load security question
$("#getSecurityQuestionBtn").on("click", function() {
    var hint = $("#forgotRecoveryHint").val().trim();
    if (hint === '') {
        $("#forgotHintError").text("Please enter your recovery hint.").show();
        return;
    }
    $("#forgotHintError").hide();
    $("#hideloader").show();
    $.ajax({
        type: "POST",
        url: '<?php echo $this->request->base; ?>/charters/getRecoveryQuestion',
        dataType: 'json',
        data: { hint: hint },
        success: function(result) {
            $("#hideloader").hide();
            if (result.status === 'success') {
                $("#recoveryQuestionDisplay").val(result.question);
                $("#forgotRecoveryHint").prop('readonly', true);
                $("#getSecurityQuestionBtn").hide();
                $("#recoveryStep2").show();
            } else {
                $("#forgotHintError").text(result.message || "Hint not found. Please try again.").show();
            }
        },
        error: function() {
            $("#hideloader").hide();
            $("#forgotHintError").text("An error occurred. Please try again.").show();
        }
    });
});

// Step 2: verify answer and reveal username
$("#revealUsernameBtn").on("click", function() {
    var hint   = $("#forgotRecoveryHint").val().trim();
    var answer = $("#forgotRecoveryAnswer").val().trim();
    if (answer === '') {
        $("#forgotAnswerError").text("Please enter your answer.").show();
        return;
    }
    $("#forgotAnswerError").hide();
    $("#hideloader").show();
    $.ajax({
        type: "POST",
        url: '<?php echo $this->request->base; ?>/charters/verifyRecoveryAnswer',
        dataType: 'json',
        data: { hint: hint, answer: answer },
        success: function(result) {
            $("#hideloader").hide();
            if (result.status === 'success') {
                var username = result.username;
                $("#recoveredUsernameHidden").val(username);
                // Auto-load password security questions
                $("#hideloader").show();
                $.ajax({
                    type: "POST",
                    url: '<?php echo $this->request->base; ?>/charters/getPasswordRecoveryQuestions',
                    dataType: 'json',
                    data: { username: username },
                    success: function(pResult) {
                        $("#hideloader").hide();
                        if (pResult.status === 'success') {
                            $("#recoveryPQ1Display").val(pResult.question1);
                            $("#recoveryPQId1").val(pResult.pq_id_1);
                            $("#recoveryPQ2Display").val(pResult.question2);
                            $("#recoveryPQId2").val(pResult.pq_id_2);
                            $("#recoveryPAnswer1").val('');
                            $("#recoveryPAnswer2").val('');
                            $("#recoveryPAnswer1Error").hide();
                            $("#recoveryPAnswer2Error").hide();
                            $("#recoveryStep3").show();
                            $("#passwordQuestionsDiv").show();
                        } else {
                            $("#forgotAnswerError").text(pResult.message || "Could not load security questions.").show();
                        }
                    },
                    error: function() {
                        $("#hideloader").hide();
                        $("#forgotAnswerError").text("An error occurred. Please try again.").show();
                    }
                });
            } else {
                $("#forgotAnswerError").text(result.message || "Incorrect answer. Please try again.").show();
            }
        },
        error: function() {
            $("#hideloader").hide();
            $("#forgotAnswerError").text("An error occurred. Please try again.").show();
        }
    });
});


// Forgot password link — show reset form, hide login
$("#forgotPasswordLink").on("click", function(e) {
    e.preventDefault();
    $("#tokenDiv").hide();
    $("#expiredLinkDiv").hide();
    $("#resetStep1").show();
    $("#resetPasswordQuestionsDiv").hide();
    $("#resetUsername").val('');
    $("#resetUsernameError").hide();
    $(".resetpassword").show();
});

// Reset Step 1: verify username and load security questions
$("#resetPasswordBtn").on("click", function() {
    var username = $("#resetUsername").val().trim();
    if (username === '') {
        $("#resetUsernameError").text("Please enter your username.").show();
        return;
    }
    $("#resetUsernameError").hide();
    $("#hideloader").show();
    $.ajax({
        type: "POST",
        url: '<?php echo $this->request->base; ?>/charters/getPasswordRecoveryQuestions',
        dataType: 'json',
        data: { username: username },
        success: function(result) {
            $("#hideloader").hide();
            if (result.status === 'success') {
                $("#resetQuestion1Display").val(result.question1);
                $("#resetQuestion2Display").val(result.question2);
                $("#resetPQId1").val(result.pq_id_1);
                $("#resetPQId2").val(result.pq_id_2);
                $("#resetAnswer1").val('');
                $("#resetAnswer2").val('');
                $("#resetAnswer1Error").hide();
                $("#resetAnswer2Error").hide();
                $("#resetPasswordQuestionsDiv").show();
            } else {
                $("#resetUsernameError").text(result.message || "Username not found.").show();
            }
        },
        error: function() {
            $("#hideloader").hide();
            $("#resetUsernameError").text("An error occurred. Please try again.").show();
        }
    });
});

// Reset Step 2: verify security answers
$("#resetPasswordNextBtn").on("click", function() {
    var answer1 = $("#resetAnswer1").val().trim();
    var answer2 = $("#resetAnswer2").val().trim();
    var valid = true;
    if (answer1 === '') {
        $("#resetAnswer1Error").text("Please enter your answer.").show();
        valid = false;
    } else {
        $("#resetAnswer1Error").hide();
    }
    if (answer2 === '') {
        $("#resetAnswer2Error").text("Please enter your answer.").show();
        valid = false;
    } else {
        $("#resetAnswer2Error").hide();
    }
    if (!valid) return;
    $("#hideloader").show();
    $.ajax({
        type: "POST",
        url: '<?php echo $this->request->base; ?>/charters/verifyPasswordRecovery',
        dataType: 'json',
        data: {
            username: $("#resetUsername").val().trim(),
            pq_id_1:  $("#resetPQId1").val(),
            answer1:  answer1,
            pq_id_2:  $("#resetPQId2").val(),
            answer2:  answer2
        },
        success: function(result) {
            $("#hideloader").hide();
            if (result.status === 'success') {
                $(".resetpassword").hide();
                $("#snpUsernameHidden").val($("#resetUsername").val().trim());
                $("#snpNewPassword").val('');
                $("#snpConfirmPassword").val('');
                $("#snpPasswordError").hide();
                $("#snpConfirmError").hide();
                $(".setnewpassword").show();
            } else {
                if (result.field === '1') {
                    $("#resetAnswer1Error").text(result.message || "Incorrect answer.").show();
                } else if (result.field === '2') {
                    $("#resetAnswer2Error").text(result.message || "Incorrect answer.").show();
                } else {
                    $("#resetAnswer1Error").text(result.message || "Verification failed.").show();
                }
            }
        },
        error: function() {
            $("#hideloader").hide();
            $("#resetAnswer1Error").text("An error occurred. Please try again.").show();
        }
    });
});


// Set new password submit
$("#setNewPasswordSubmit").on("click", function() {
    var newPwd  = $("#snpNewPassword").val().trim();
    var confPwd = $("#snpConfirmPassword").val().trim();
    var valid = true;
    if (newPwd === '') {
        $("#snpPasswordError").text("Please enter a new password.").show();
        valid = false;
    } else {
        $("#snpPasswordError").hide();
    }
    if (confPwd === '') {
        $("#snpConfirmError").text("Please confirm your password.").show();
        valid = false;
    } else if (newPwd !== confPwd) {
        $("#snpConfirmError").text("Passwords do not match.").show();
        valid = false;
    } else {
        $("#snpConfirmError").hide();
    }
    if (!valid) return;
    $("#hideloader").show();
    $.ajax({
        type: "POST",
        url: '<?php echo $this->request->base; ?>/charters/resetGuestPassword',
        dataType: 'json',
        data: {
            username:     $("#snpUsernameHidden").val(),
            new_password: newPwd
        },
        success: function(result) {
            $("#hideloader").hide();
            if (result.status === 'success') {
                $(".setnewpassword").hide();
                // alert("Password reset successful! Please log in with your new password.");
                $("#expiredLinkDiv").show();
                $("#tokenDiv").show();
            } else {
                $("#snpPasswordError").text(result.message || "Failed to reset password.").show();
            }
        },
        error: function() {
            $("#hideloader").hide();
            $("#snpPasswordError").text("An error occurred. Please try again.").show();
        }
    });
});



// Step 3: Next — verify password security answers
$("#pwdRecoveryNextBtn").on("click", function() {
    var answer1 = $("#recoveryPAnswer1").val().trim();
    var answer2 = $("#recoveryPAnswer2").val().trim();
    var valid = true;
    if (answer1 === '') {
        $("#recoveryPAnswer1Error").text("Please enter your answer.").show();
        valid = false;
    } else {
        $("#recoveryPAnswer1Error").hide();
    }
    if (answer2 === '') {
        $("#recoveryPAnswer2Error").text("Please enter your answer.").show();
        valid = false;
    } else {
        $("#recoveryPAnswer2Error").hide();
    }
    if (!valid) return;
    $("#hideloader").show();
    $.ajax({
        type: "POST",
        url: '<?php echo $this->request->base; ?>/charters/verifyPasswordRecovery',
        dataType: 'json',
        data: {
            username: $("#recoveredUsernameHidden").val(),
            pq_id_1:  $("#recoveryPQId1").val(),
            answer1:  answer1,
            pq_id_2:  $("#recoveryPQId2").val(),
            answer2:  answer2
        },
        success: function(result) {
            $("#hideloader").hide();
            if (result.status === 'success') {
                var uname = $("#recoveredUsernameHidden").val();
                $(".forgotusernamerow").hide();
                $("#cpUsernameHidden").val(uname);
                $("#cpUsernameDisplay").val(uname);
                $("#cpNewPassword").val('');
                $("#cpConfirmPassword").val('');
                $("#cpPasswordError").hide();
                $("#cpConfirmError").hide();
                $(".confirmpassword").show();
            } else {
                if (result.field === '1') {
                    $("#recoveryPAnswer1Error").text(result.message || "Incorrect answer.").show();
                } else if (result.field === '2') {
                    $("#recoveryPAnswer2Error").text(result.message || "Incorrect answer.").show();
                } else {
                    $("#recoveryPAnswer1Error").text(result.message || "Verification failed.").show();
                }
            }
        },
        error: function() {
            $("#hideloader").hide();
            $("#recoveryPAnswer1Error").text("An error occurred. Please try again.").show();
        }
    });
});

// Confirm password submit (from username recovery flow)
$("#confirmPasswordSubmit").on("click", function() {
    var newPwd  = $("#cpNewPassword").val().trim();
    var confPwd = $("#cpConfirmPassword").val().trim();
    var valid = true;
    if (newPwd === '') {
        $("#cpPasswordError").text("Please enter a new password.").show();
        valid = false;
    } else {
        $("#cpPasswordError").hide();
    }
    if (confPwd === '') {
        $("#cpConfirmError").text("Please confirm your password.").show();
        valid = false;
    } else if (newPwd !== confPwd) {
        $("#cpConfirmError").text("Passwords do not match.").show();
        valid = false;
    } else {
        $("#cpConfirmError").hide();
    }
    if (!valid) return;
    $("#hideloader").show();
    $.ajax({
        type: "POST",
        url: '<?php echo $this->request->base; ?>/charters/resetGuestPassword',
        dataType: 'json',
        data: {
            username:     $("#cpUsernameHidden").val(),
            new_password: newPwd
        },
        success: function(result) {
            $("#hideloader").hide();
            if (result.status === 'success') {
                // Auto-login with the recovered username and new password
                $("#hideloader").show();
                $.ajax({
                    type: "POST",
                    url: '<?php echo $this->request->base; ?>/charters/verifyToken',
                    dataType: 'json',
                    data: {
                        email: $("#cpUsernameHidden").val(),
                        token: $("#cpNewPassword").val()
                    },
                    success: function(loginResult) {
                        $("#hideloader").hide();
                        if (loginResult.status === 'success_redirect') {
                            window.location.href = '<?php echo $this->request->base; ?>/' + loginResult.url;
                        } else if (loginResult.status === 'success') {
                            $(".confirmpassword").hide();
                            $("#passwordDiv").show();
                            $("#redirectUrl").val(loginResult.url);
                            $("#charterGuestId").val(loginResult.charter_guest_id);
                            $("#GuestListId").val(loginResult.guest_list_id);
                            $("#charterAssocId").val(loginResult.charter_assoc_id);
                        } else {
                            $(".confirmpassword").hide();
                            $("#expiredLinkDiv").show();
                            $("#tokenDiv").show();
                        }
                    },
                    error: function() {
                        $("#hideloader").hide();
                        $(".confirmpassword").hide();
                        $("#expiredLinkDiv").show();
                        $("#tokenDiv").show();
                    }
                });
            } else {
                $("#cpPasswordError").text(result.message || "Failed to reset password.").show();
            }
        },
        error: function() {
            $("#hideloader").hide();
            $("#cpPasswordError").text("An error occurred. Please try again.").show();
        }
    });
});

</script>
<?php ?>
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

<div id="tokenDiv" class="panel-body" style="height: 250px;">        
            <?php echo $this->Form->create('CharterGuest', array('url' => array('controller' => 'charters', 'action' => 'index'),'id'=>'tokenVerifyForm'));?>
    <fieldset style="padding-top:10px;">
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
        <a class="inlinetag" href="<?php echo $this->request->base."" ?>">Username</a>
        <span>or</span>
        <a class="inlinetag" href="<?php echo $this->request->base."/charters/forgot_password/" ?>">Password</a>
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
<div id="expiredLinkDiv" class="panel-body text-center" style="padding: 30px 15px;">
    <p style="color: #c0392b; font-size: 15px; font-weight: bold;">This link has expired. Please contact your charter manager for a new invitation.</p>
</div>
<?php endif; ?>





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
         Username:
         <div class="form-group form_margin">
         <input name="reset_username" id="resetUsername" placeholder="Username" class="form-control" maxlength="55" type="text">
         <span class="text-small red errorMsg" id="resetUsernameError" style="color: red"></span>
         </div>
         <button class="btn btn-default joinnow-btn but-mb-5" type="button" id="resetPasswordBtn">Reset Password</button>
         Question 1:
         <div class="form-group form_margin">
         <input name="reset_question_1_display" id="resetQuestion1Display" placeholder="Question 1" class="form-control" maxlength="500" type="text" readonly>
         </div>
         Answer 1:
         <div class="form-group form_margin">
         <input name="reset_answer_1" id="resetAnswer1" placeholder="Answer" class="form-control" maxlength="500" type="text">
         <span class="text-small red errorMsg" id="resetAnswer1Error" style="color: red"></span>
         </div>
         Question 2:
         <div class="form-group form_margin">
         <input name="reset_question_2_display" id="resetQuestion2Display" placeholder="Question 2" class="form-control" maxlength="500" type="text" readonly>
         </div>
         Answer 2:
         <div class="form-group form_margin">
         <input name="reset_answer_2" id="resetAnswer2" placeholder="Answer" class="form-control" maxlength="500" type="text">
         <span class="text-small red errorMsg" id="resetAnswer2Error" style="color: red"></span>
         </div>
         <button class="btn btn-default joinnow-btn" type="button" id="resetPasswordNextBtn">Next</button>
        </fieldset>
    </form>
</div>


<div class="forgotusernamerow" style="display: none;">
    <form id="forgotUsernameForm">
        <fieldset style="padding-top:10px;">
         Username Recovery Hint:
         <div class="form-group form_margin">
         <input name="forgot_recovery_hint" id="forgotRecoveryHint" placeholder="Username Recovery Hint" class="form-control" maxlength="500" type="text">
         <span class="text-small red errorMsg" id="forgotHintError" style="color: red"></span>
         </div>
         Username Recovery Question:
         <div class="form-group form_margin">
            <select name="forgot_recovery_question_id" id="forgotRecoveryQuestion" class="form-select form-control">
            <option value="">-- Select a question --</option>
            </select>
         </div>
         Answer:
         <div class="form-group form_margin">
         <input name="forgot_recovery_answer" id="forgotRecoveryAnswer" placeholder="Answer" class="form-control" maxlength="500" type="text">
         <span class="text-small red errorMsg" id="forgotRecoveryAnswerError" style="color: red"></span>
         </div>
         <button class="btn btn-default joinnow-btn but-mb-5" type="button" id="getSecurityQuestionsBtn">Get Security Question</button>
         Question 1:
         <div class="form-group form_margin">
         <input name="forgot_question_1_display" id="forgotQuestion1Display" placeholder="Question 1" class="form-control" maxlength="500" type="text" readonly>
         </div>
         Answer 1:
         <div class="form-group form_margin">
         <input name="forgot_answer_1" id="forgotAnswer1" placeholder="Answer" class="form-control" maxlength="500" type="text">
         <span class="text-small red errorMsg" id="forgotAnswer1Error" style="color: red"></span>
         </div>
         Question 2:
         <div class="form-group form_margin">
         <input name="forgot_question_2_display" id="forgotQuestion2Display" placeholder="Question 2" class="form-control" maxlength="500" type="text" readonly>
         </div>
         Answer 2:
         <div class="form-group form_margin">
         <input name="forgot_answer_2" id="forgotAnswer2" placeholder="Answer" class="form-control" maxlength="500" type="text">
         <span class="text-small red errorMsg" id="forgotAnswer2Error" style="color: red"></span>
         </div>
         <button class="btn btn-default joinnow-btn" type="button" id="forgotUsernameNextBtn">Next</button>
        </fieldset>
    </form>
</div>


<div class="setnewpassword" style="display: none;">
    <form id="setNewPasswordForm">
        <fieldset style="padding-top:10px;">
         Username:
         <div class="form-group form_margin">
         <input name="snp_username" id="snpUsername" placeholder="Username" class="form-control" maxlength="55" type="text">
         <span class="text-small red errorMsg" id="snpUsernameError" style="color: red"></span>
         </div>
         New Password:
         <div class="form-group form_margin">
         <input name="snp_new_password" id="snpNewPassword" placeholder="New Password" class="form-control" maxlength="55" type="password">
         <span class="text-small red errorMsg" id="snpPasswordError" style="color: red"></span>
         </div>
         Confirm Password:
         <div class="form-group form_margin">
         <input name="snp_confirm_password" id="snpConfirmPassword" placeholder="Confirm Password" class="form-control" maxlength="55" type="password">
         <span class="text-small red errorMsg" id="snpConfirmError" style="color: red"></span>
         </div>
         <button class="btn btn-default joinnow-btn" type="button" id="setNewPasswordSubmit">Submit</button>
        </fieldset>
    </form>
</div>


<div class="confirmpassword" style="display: none;">
    <form id="confirmPasswordForm">
        <fieldset style="padding-top:10px;">
         New Password:
         <div class="form-group form_margin">
         <input name="cp_new_password" id="cpNewPassword" placeholder="Enter Password" class="form-control" maxlength="55" type="password">
         <span class="text-small red errorMsg" id="cpPasswordError" style="color: red"></span>
         </div>
         Confirm Password:
         <div class="form-group form_margin">
         <input name="cp_confirm_password" id="cpConfirmPassword" placeholder="Enter Password" class="form-control" maxlength="55" type="password">
         <span class="text-small red errorMsg" id="cpConfirmError" style="color: red"></span>
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

</script>
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
       <button class="btn btn-default joinnow-btn"  type="submit">New to Charter Guest? Join now</button>
    </fieldset>
            <?php echo $this->Form->end(); ?>
</div>





<div class="usernamereset" style="display: none;">
    <form>
        <fieldset style="padding-top:10px;">
        <div class="form-group">
         Username:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder="Enter Username" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
        <span class="errormsg">Sorry, this username is already in use</span>
        </div> 
       </div>
        <div class="form-group mt-45">
         Display Name:
         <div class="row p-left">
        <div class="col-md-6">
        <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder="First Name" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder="Last    Name" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
        </div>
        </div>
        </div>
       </div>
         New Password:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder="Enter Password" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
        </div> 
        Confirm Password:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder="Enter Password" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
       </div>


       <button class="btn btn-default joinnow-btn" type="submit">Next</button>
    </fieldset>
    </form>
</div>





<div class="usernamerecoveryrow"  style="display: none;">
    <form>
        <fieldset style="padding-top:10px;">
         Username Recovery Hint:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder=" Username Recovery Hint" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
       </div>
         Username Recovery Question:
         <div class="form-group form_margin">  
            <select class="form-select form-control">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            </select>                                      
        </div> 
        Answer:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder="Answer" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
         </div>
         <label class="labelhdpadd">Password Recovery Setup</label>
         <div class="mtopqu">Question 1:</div>
         <div class="form-group form_margin">  
            <select class="form-select form-control">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            </select>                                      
        </div>
         Answer 1:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder=" Username Recovery Hint" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
       </div>

       <div class="mtopqu">Question 2:</div>
         <div class="form-group form_margin">  
            <select class="form-select form-control">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            </select>                                      
</div>

        Answer 2:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder=" Username Recovery Hint" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
       </div>
       <button class="btn btn-default joinnow-btn" type="submit">Submit</button>
    </fieldset>
    </form>
</div>






<div class="resetpassword"  style="display: none;">
          <div class="form-group">       
<label>Password Reset</label>
</div>
    <form>
        <fieldset style="padding-top:10px;">
         Username:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder=" Username" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
       </div>

        <button class="btn btn-default joinnow-btn but-mb-5" type="submit">Reset Password</button>

    
       Question 1
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder="Answer" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
         </div>

          Answer 1:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder="Answer" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
         </div>

            Question 2
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder="Answer" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
         </div>

          Answer 2:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder="Answer" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
         </div>




       <button class="btn btn-default joinnow-btn" type="submit">Next</button>
    </fieldset>

    </form>
        </div> 






<div class="usernamerecoveryrow"  style="display: none;">
    <form>
        <fieldset style="padding-top:10px;">
         Username Recovery Hint:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder=" Username Recovery Hint" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
       </div>
         Username Recovery Question:
         <div class="form-group form_margin">  
            <select class="form-select form-control">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            </select>                                      
        </div> 
        Answer:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder="Answer" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
         </div>
                 <button class="btn btn-default joinnow-btn but-mb-5" type="submit">Get Security Question</button>

        Question 1:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder="Answer" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
         </div>

         Answer 1:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder=" Username Recovery Hint" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
       </div>

        Question 2:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder="Answer" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
         </div>

         Answer 2:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder=" Username Recovery Hint" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
       </div>

    
       <button class="btn btn-default joinnow-btn" type="submit">Next</button>
    </fieldset>
    </form>
</div>




<div class="newpassword" style="display: none;">
    <form>
        <fieldset style="padding-top:10px;">
        Username
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder="Username" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
        </div> 
         New Password:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder=" New Password" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
        </div> 
        Confirm Password:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder="Confirm Password" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
       </div>


       <button class="btn btn-default joinnow-btn" type="submit">Submit</button>
    </fieldset>
    </form>
</div>




<div class="newpassword" style="display: none;">
    <form>
        <fieldset style="padding-top:10px;">
         New Password:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder="Enter Password" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
        </div> 
        Confirm Password:
         <div class="form-group form_margin">                                        
         <input name="email" id="email" placeholder="Enter Password" class="form-control" maxlength="55" type="email" required="required">            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
       </div>


       <button class="btn btn-default joinnow-btn" type="submit">Submit</button>
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
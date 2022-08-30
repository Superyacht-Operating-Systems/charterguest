<?php ?>
<style> 
::placeholder {
  color: gray!important;
  opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */

  color: gray!important;
}

::-ms-input-placeholder { /* Microsoft Edge */
  color: gray!important;
}

    .terms-userow a{
margin: 0px 5px;
    }
    .terms-userow input{
position: relative;
    top: 2px;
}
.forgot-link{
        font-size: 13px;
    margin-top: -10px;
    display: block;
}
.terms-userow-row{
        margin-top: 10px;
}
 @media only screen and (max-width:767px){
 .form-group {
    margin-bottom: 0px!important;
}
 }



</style>



<?php $basefolder = $this->request->base; ?>

<div id="tokenDiv" class="panel-body" style="height: 250px;">        
            <?php echo $this->Form->create('CharterGuest', array('url' => array('controller' => 'charters', 'action' => 'index'),'id'=>'tokenVerifyForm'));?>
    <fieldset style="padding-top:10px;">
                    <?php echo $this->Session->flash();?>
        Email:
        <div class="form-group form_margin">                                        
                    <?php echo $this->Form->input('email',array('label' => false,'div' => false, 'name' => 'email', 'id' => 'email', 'placeholder' => 'Enter the Email address','class' => 'form-control','maxlength' => 55));?>
            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
        </div>
        Token/Password:
        <div class="form-group form_margin">                                        
                    <?php echo $this->Form->input('token',array('type' => 'password', 'label' => false,'div' => false, 'name' => 'token', 'id' => 'token', 'placeholder' => 'Enter the Token/Password','class' => 'form-control','maxlength' => 55));?>
            <span class="text-small red errorMsg" id="tokenError" style="color: red"></span>
        </div>
        <a class="forgot-link" href="<?php echo $this->request->base."/charters/forgot_password/" ?>">Forgot password </a>
        <div class="terms-userow-row">
            <label class="terms-userow">
                I agree with the <a href="<?php echo $this->request->base."/charters/privacytermsofuse/1" ?>" target="blank">terms of use </a>
                <input id="termsOfUse"  type="checkbox" value="" onclick="ToggleDisable()"/>
            </label>            
            <?php echo $this->Form->button('Submit',array('class' => 'btn btn-default', 'id' => 'tokenSubmit'));?>                
            <span class="text-small red errorMsg" id="commonError" style="color: red"></span>
        </div>
    </fieldset>
            <?php echo $this->Form->end(); ?>
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
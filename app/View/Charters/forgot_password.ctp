<?php ?>
<style> 
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
<span class="text-small red successMsg" id="emailsuccess" style="text-align: center; color: blue"></span>
<div id="tokenDiv" class="panel-body" style="height: 250px;">        
            <?php echo $this->Form->create('CharterGuest', array('url' => array('controller' => 'charters', 'action' => 'verifyEmail'),'id'=>'verifyemailForm'));?>
    <fieldset style="padding-top:10px;">
                    <?php echo $this->Session->flash();?>
        
        Email:
        <div class="form-group form_margin">                                        
                    <?php echo $this->Form->input('email',array('label' => false,'div' => false, 'name' => 'email', 'id' => 'email', 'placeholder' => 'Enter the Email address','class' => 'form-control','maxlength' => 55));?>
            <span class="text-small red errorMsg" id="emailError" style="color: red"></span>
        </div>
        
        <div class="terms-userow-row">
             <label class="terms-userow">
                <?php echo $this->Form->button('Return to Login',array('class' => 'btn btn-default', 'id' => 'returntologin'));?>                
            </label> 
            
            <?php echo $this->Form->button('Submit',array('class' => 'btn btn-default', 'id' => 'verifyemailSubmit'));?>                
            <span class="text-small red errorMsg" id="commonError" style="color: red"></span>
        </div>
    </fieldset>
            <?php echo $this->Form->end(); ?>
</div>



<script> 
$("#returntologin").on("click", function(e) {
    e.preventDefault();
    window.location.href = '<?php echo $basefolder; ?>';
});
// Token submission
$("#verifyemailSubmit").on("click", function(e) {
    e.preventDefault();
//alert();
    var flag = 1;
    var email = $("#email").val();
    
    if (email.trim() == '') {
        flag = 0;
        $("#emailError").text("Please enter the Email.").slideDown('slow').delay(3000).slideUp();
    }
    var data = $("#verifyemailForm").serialize();
     var   myform = $("#verifyemailForm");
     var       myurl = myform.attr('action');
     //alert(url);
    if (flag) {
        //alert();
        $("#hideloader").show();
        $.ajax({
            type: "POST",
            url: myurl,
            dataType: 'json',
            data: data,
            success:function(result) {
                $("#hideloader").hide();
                var Base_url = '<?php echo $basefolder; ?>';
                $("#emailsuccess").text("A reset password email has been sent.").slideDown('slow').delay(3000).slideUp();
                setTimeout(function(){       
                    window.location.href = Base_url;
                }, 3000);
               
            },
            error: function(jqxhr) { 
                $("#hideloader").hide();
            }
        });
    } else {
        return false;
    }
    
});


</script>
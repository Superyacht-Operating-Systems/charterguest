  
    <div class="row">            
            <div class="col-lg-6">                        
               <?php echo $this->Session->flash();?>   
            </div>             
    </div>
    
    <div class="panel-body">  
        <?php echo $this->Form->create(null, array('url' => array('controller' => 'users', 'action' => 'secure_check',$uniqueKey),'id'=>'changePasswordId'));?>
        <fieldset>
        <div class="col-lg-6">
          
            <div class="form-group form_margin">
             <!--   <label>New Password<span class="required"> * </span></label>-->
                <?php echo $this->Form->input('password',array('label' => false,'div' => false,'name'=>'password', 'placeholder' => 'New Password','class' => 'form-control required','maxlength' => 30,'type' => 'password'));?>                
            </div>
            
            <div class="form-group form_margin">
                <!--<label>Confirm Password<span class="required"> * </span></label>-->
                <?php echo $this->Form->input('confirm_password',array('label' => false,'div' => false,'name'=>'confirm_password', 'placeholder' => 'Confirm Password','class' => 'form-control required','maxlength' => 30,'type' => 'password'));?>
              
            </div>         
            
                
            <?php echo $this->Form->button('Update', array('type' => 'submit','class' => 'btn btn-default'));?>
            <?php echo $this->Form->button('Reset', array('type' => 'reset','class' => 'btn btn-default'));?>
            
        </div>
        </fieldset>
        
    </div><!-- /.row -->
    
    <script>
            $(document).ready(function()
    {
        $("#changePasswordId").validate(
        {	
            errorElement: "div",
            rules: {	                 
                "data[Admin][old_password]": {
                    required: true,
                    minlength : 6
                },
                "password": {
                    required: true,
                    minlength : 6
                },
                "confirm_password": {
                    required: true,
                    minlength : 6,
                    equalTo: "#AdminPassword"
                }
            },
             messages: {
                "data[Admin][old_password]": {
                    required: "Please enter old password.",
                    minlength: "Please enter at least 6 characters password."
                },
                "password": {
                    required: "Please enter new password.",
                    minlength: "Please enter at least 6 characters password."
                },
                "confirm_password": {
                    required: "Please enter confirm password.",
                    minlength: "Please enter at least 6 characters password.",
                    equalTo: "New password and confirm password do not match"
                }
            }
         
        });
    }); 
        </script>
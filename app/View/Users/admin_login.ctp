           
<div class="panel-body" style="height: 350px;">        
            <?php echo $this->Form->create(null, array('url' => array('controller' => 'users', 'action' => 'login'),'id'=>'loginId'));?>
    <fieldset style="padding-top:10px;">
                    <?php echo $this->Session->flash();?>
        <div class="form-group form_margin">                                        
                    <?php echo $this->Form->input('fleetname',array('label' => false,'div' => false, 'name' => 'fleetname', 'placeholder' => 'Fleet name','class' => 'form-control fleet-name not-disabled','maxlength' => 55));?>
        </div>
        <div class="form-group form_margin">                                        
                    <?php echo $this->Form->input('sitename',array('label' => false,'div' => false, 'name' => 'sitename','placeholder' => 'Vessel name','class' => 'form-control site-name not-disabled','maxlength' => 55));?>
        </div>
        <div class="form-group form_margin">                                        
                    <?php echo $this->Form->input('username',array('label' => false,'div' => false, 'name' => 'username', 'placeholder' => 'Username','class' => 'form-control user-name not-disabled','maxlength' => 55));?>
        </div>
        <div class="form-group form_margin">                    
                    <?php echo $this->Form->input('password',array('label' => false,'div' => false, 'name' => 'password','placeholder' => 'Password','class' => 'form-control user-password','maxlength' => 30,'type '=> 'password'));?>
        </div>
                    <div class="pull-left">
					<?php echo $this->Form->submit('Login',array('class' => 'btn btn-default not-disabled' , 'id' => 'Login'));?>                
                    </div>
      
        <label class="pull-right">
                        <?php echo $this->Html->link('Forgot password','/admin/users/forgot_password',array('title' => 'Forgot password'));?>                        
        </label>
    </fieldset>
            <?php echo $this->Form->end(); ?>
</div>

<script> 
    
        $(document).ready(function()
    {
        $("#loginId").validate(
        {	           
            errorElement: "div",
            rules: {	                 
//                "fleetname": {
//                    required: true,
//                },
//                "sitename": {
//                    required: true,
//                },
                "username": {
                    required: true,
                },
                "password": {
                    required: true,
                    minlength : 6
                }
            },
             messages: {
//                "fleetname": {
//                    required: "This field is required."
//                },
//                "sitename": {
//                    required: "This field is required."
//                },
                "username": {
                    required: "This field is required."
                },
                "password": {
                    required: "This field is required.",
                    minlength: "Please enter at least 6 characters password."
                }
            }
         
        });
    });
    </script>
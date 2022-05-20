<div class="panel-body">        
            <?php echo $this->Form->create(null, array('url' => array('controller' => 'users', 'action' => 'forgot_password'),'id'=>'forgotPasswordId'));?>
            <fieldset>
                <?php echo $this->Session->flash();?>                              
                <div class="form-group form_margin">                                        
                    <?php echo $this->Form->input('email',array('label' => false,'div' => false,'name' => 'email', 'placeholder' => 'E-mail','class' => 'form-control user-name not-disabled','maxlength' => 55));?>                
                </div>
                 <div class="form-group form_margin">                                        
                    <?php echo $this->Form->input('sitename',array('label' => false,'div' => false, 'placeholder' => 'Vessel Name','name' => 'sitename','class' => 'form-control user-name not-disabled','maxlength' => 55));?>                
                </div>
                <div class="row">                                                            
                    <div class="col-lg-12">
                        <?php echo $this->Form->submit('Submit',array('class' => 'btn btn-default not-disabled'));?>
                                     
                        <?php echo $this->Html->link('Cancel','/admin/users/login/',array('class' => 'btn btn-default pull-left','style'=>array('line-height: 18px;')));?>
                    </div>                    
                </div>                
            </fieldset>
            <?php echo $this->Form->end(); ?>
    </div>
    <style>
        .submit{float: left; margin-right: 10px; width: auto;}
    </style>
    
    <script>
            $(document).ready(function()
    {
        $("#forgotPasswordId").validate(
        {	           
            errorElement: "div",
            rules: {	                 
                "email": {
                    required: true,
                    email: true
                },
                "sitename": {
                    required: true,
                },
            },
             messages: {
                "email": {
                    required: "This field is required."
                },
                "sitename": {
                    required: "This field is required."
                },
            }         
        });
    });
        </script>
    <div id="" class="footer">
        <div class="container">
          
        </div>
    </div>
    <?php
    $session = $this->Session->read();   
    $isfleet=@$session['loggedUserInfo']['is_fleet'];
    $userType = @$session['loggedUserInfo']['user_type'];
    // check if it is checklist draft page    
    $action = $this->params['action'];
    ?>
    <script type="text/javascript">
        isfleet='<?php echo $isfleet; ?>';
        userType = '<?php echo $userType;?>';
        action='<?php echo $action; ?>';
        $(document).ready(function() {
            //clent requested comment below condition for fleet user on May05 2016
            if(isfleet==1){
               /* $('input[type="text"]').attr('disabled','disabled');
                $(":submit").attr("disabled", true);
                $(":button").attr("disabled", true);
                $("select").attr("disabled", true);
                $(":checkbox").attr("disabled", true);
                $(".not-disabled").attr("disabled", false);*/
                
            }
            if(isfleet==1  && action =='admin_draft'){
                 $(":submit").attr("disabled", false);
                 $("select").attr("disabled", false);
                 $('input[type="text"]').attr('disabled',false);
            }
            /****FLEET USER + OBA*****************/
            if(isfleet == 1 && (userType==1 || userType==4) && action!='admin_edit'){
                $('input[type="text"]').attr('disabled',false);
                $(":submit").attr("disabled", false);
                $(":button").attr("disabled", false);
                $("select").attr("disabled", false);                
                $(":checkbox").attr("disabled", false);
                $(".not-disabled").attr("disabled", false);   
            }
            if(action=='admin_edit'){
                $('.removeDisabled').removeAttr('disabled','disabled');
            }
        });    
    </script>
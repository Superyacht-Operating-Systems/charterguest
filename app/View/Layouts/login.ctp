<!DOCTYPE html>
<html lang="en">
    <head>
            <?php //$logoData  = $this -> requestAction(array('controller' => 'settings','action' => 'getlogodata'));
                   //if($logoData =="No Logo"){
                        $logoLink = "Superyacht Operating Systems";
                        // $logoimage = "logo/thumb/1412662088_SOS logo.PNG";
                        $logoimage = "logo/thumb/charter_guest_logo.png";
                        //                    }else{
//                        $logoLink = $logoData['Company']['name'];
//                        $logoimage = "logo/thumb/".$logoData['Company']['logo'];
//                    }
            ?>
            <?php echo $this->Html->charset('UTF-8'); ?>
       <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
            
        <title>Superyacht Operating Systems - Charter Guest</title>
       
            <?php
            //echo $this->Html->meta('favicon.ico','img/favicon.ico',array('type' => 'icon'));
             echo $this->Html->meta('favicon.ico','img/chater_favicon.ico',array('type' => 'icon'));
                echo $this->Html->css('admin/bootstrap'); 
                echo $this->Html->css('admin/style');
                echo $this->Html->css('admin/sb-admin');
                echo $this->Html->css('admin/login');     
                echo $this->Html->css('admin/font/css/font-awesome.min');
                echo $this->Html->css('admin/custom_admin');
                
                echo $this->Html->script('jquery-1.7.2.min');
                echo $this->Html->script('jquery.validate');
               
                 
            ?> 
            <style type="text/css">
::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    color:gray!important;
    opacity: 1!important;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
   color:gray!important;
     opacity: 1!important;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
   color:gray!important;
     opacity: 1!important;
}
:-ms-input-placeholder { /* Internet Explorer 10-11 */
   color:gray!important;
     opacity: 1!important;
}
::-ms-input-placeholder { /* Microsoft Edge */
   color:gray!important;
     opacity: 1!important;
}

::placeholder { /* Most modern browsers support this now. */
    color:gray!important;
}

                                             .headerRightText{ 
                            left:0px;
                         font-size: 30px;}
                @media only screen and (max-width:1200px){
                .login-panel{  width: 360px;
    margin: 0 auto;
    position: relative;
                                 }


                }
                @media only screen and (max-width:990px){
                .login-panel{ 
                                 margin: 0 auto;
                                 }
}

                @media only screen and (max-width:768px){
                        .headerRightText{ 
                            left: 30px;}
                        }
                         @media only screen and (max-width:767px){
                        .headerRightText{ 
                            font-size: 20px;
                         }
                        }



            </style>              
    </head>    
    <body>

        <div style="position:fixed;height:100%;width:100%;left:0;top:0;z-index:9999;opacity:0.5;display:none;" id="hideloader">
        <div style="text-align:center;vertical-align:center;font-weight:bold;font-size:45px;margin-top:305px;color:#000000"><?php echo $this->Html->image("admin/loader.gif"); ?></div></div>         
        <section class="container wrapper">
            <div class="row">
                <nav role="navigation" class="navbar navbar-inverse navbar-fixed-top">            
                    <div class="navbar-header ">             
                        <div class="logoimg"> <?php echo $this->Html->image($logoimage);?></div> 
                            <?php 
                            echo $this->Html->link($logoLink,'http://www.superyachtos.com/',array('target'=>'blank','class' => 'navbar-brand logotxt brand-logo','title' => $logoLink));
                            ?>
                    </div>
                    <div class="headerRightText">Charter Guest</div>
                </nav>
                <div class="col-sm-6 col-sm-offset-3 col-md-5 col-md-offset-4 login-row-panel">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"></h3>
                        </div>
                            <?php  echo $this->fetch('content'); ?>
                    </div>
                </div>
            </div>
            <div class="push"></div>
        </section>
            <?php echo $this->element('footer'); ?>  
    </body>
</html>
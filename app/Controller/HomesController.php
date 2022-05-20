<?php
    /*
        * Homes Controller class
        * Functionality -  Manage the Home Page
        * Developer - Gurpreet Singh Ahhluwalia
        * Created date - 20-Feb-2014
        * Modified date - 
    */
    class HomesController extends AppController {
        var $name = 'Homes';     
        /*
            * index function
            * Functionality -  Home Page
            * Developer - Gurpreet Singh Ahhluwalia
            * Created date - 20-Feb-2014
            * Modified date - 
        */
        function index()
        {   

      	$session = $this->Session->read();
           //pr($session); exit;
           if(isset($session['loggedYachtDbname']) && $session['loggedYachtDbname']!=''){
                $this->redirect(array('controller' => 'admin/users', 'action' => 'index'));
           }else{
                $this->redirect(array('controller' => 'admin/users', 'action' => 'login'));
           } 
        }
    }

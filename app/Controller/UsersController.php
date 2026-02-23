<?php

class UsersController extends AppController {

    var $name = 'Users';
    public $components = array('Paginator','Email');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    
    public function admin_login() {       
         $baseurl = Configure::read('BASE_URL'); 
        $this->layout = 'login';
        if (isset($this->data) && (!empty($this->data))) {            
        $fleetname = $this->data['fleetname'];
        $sitename = $this->data['sitename'];
        $username = mysql_escape_string($this->data['username']);
        $password = mysql_escape_string($this->data['password']);
        $userpassword = md5($password); 
        
        if(!empty($fleetname) && !empty($sitename)){
        
                
             if($this->User->setDatabase($sitename)){

            $userData = $this->User->find('first',array('conditions'=>array('User.username' =>$username,'User.password'=>$userpassword,'User.status'=>1,'User.is_deleted' => 0)));
             $userdatediff=1;
                   if (!empty($userData['User']['password']) && ($userData['User']['password'] == $userpassword) && ($userData['User']['user_type'] == 0 || $userData['User']['user_type'] == 1 || $userData['User']['user_type'] == 2 || $userData['User']['user_type'] == 4 || $userData['User']['user_type'] == 6)) {
                       
                        $this->Session->write('userid', $userData['User']['id']);
                         $userid = $this->Session->read('userid');
                         $userInfo = $this->User->find('first', array('conditions' => array("User.id" => $userid)));
                         
                         $this->loadModel('Yacht');
                         $yachtInfo = $this->Yacht->find('first', array('conditions' => array('id' => $userInfo['User']['yacht_id'])));
			 
                         $yachtid = $yachtInfo['Yacht']['id'];
                         $dbyachtdetail = $this->Yacht->query("SELECT * FROM `yachts` WHERE `id` = '$yachtid'");
                         
                         $fleetname = $dbyachtdetail[0]['yachts']['fleetname'];
                            if(trim($userInfo['User']['end_date'])!='' && trim($userInfo['User']['end_date'])!='0000-00-00'){
                                    $dateenduser=strtotime($userInfo['User']['end_date']);
                                    $currdate=strtotime(date("Y-m-d"));
                                    $userdatediff=$dateenduser-$currdate;
                            }
                            
                            
                            if($userdatediff>0){
                                if($yachtInfo['Yacht']['status']==1){


                                    $this->Session->write('loggedYachtDbname', $yachtInfo['Yacht']['ydb_name']);
                                    $this->Session->write($yachtInfo['Yacht']['ydb_name'], $yachtInfo['Yacht']['ydb_name']."_".$userInfo['User']['id']);

                                    $this->Session->write('loggedYachtStatus', $yachtInfo['Yacht']['status']);
                                    $this->Session->write('logedusername.'.$userInfo['User']['username'], $userInfo['User']['username']);
                                    $this->Session->write('loggedYachtfullname', $yachtInfo['Yacht']['yfullName']);
                                    $this->Session->write('loggedcaptainname', $yachtInfo['Yacht']['captain_name']);
                                    $this->Session->write('loggedyachtid', $yachtInfo['Yacht']['id']);
                                    $this->Session->write('loggedyname', $yachtInfo['Yacht']['yname']);
                                    
                                    $this->Session->write('loggedexpdate', $yachtInfo['Yacht']['expirydate']);
                                    $this->Session->write('loggedismmodule', $yachtInfo['Yacht']['ismmodule']);
                                    
                                    $this->Session->write('loggedsyncmodule', $yachtInfo['Yacht']['syncmodule']);
                                    $this->Session->write('loggedfleetname', $yachtInfo['Yacht']['fleetname']);
                                    $this->Session->write('loggedpassword', $password);
                                    $this->Session->write('loggedytimezone', $yachtInfo['Yacht']['ytimezone']);
                                    // if logged in fleet user is an oba then change ADMIN_SESSION
                                    $loggedFleetEmail = $userInfo['User']['email'];
                                    $loggedFleetUserInfo = $this->User->find('first',array('conditions'=>array('User.email'=>$loggedFleetEmail),'fields'=>array('User.id')));
                                 
                                    if(!empty($loggedFleetUserInfo)){
                                        $this->Session->write('ADMIN_SESSION', $loggedFleetUserInfo['User']['id']);
                                    }else{
                                        $this->Session->write('ADMIN_SESSION', $userInfo['User']['id']);
                                    }			    
                                   
                                    $this->Session->write('navigationflag', 0);
                                    $this->Session->write('navigationflagISM', 0);
                                    $this->Session->write('navigationflagwhole', 0);
                                    $this->Session->write('loggedUserInfo',$userInfo['User']);
                                    
                                    
                                    $this->loadModel("Department");
                                    $deptdata=$this->Department->find("list",array("fields"=>array("id","dept_name")));

                                    $this->loadModel("Usermanydepartment");
                                    $deptdatauser=$this->Usermanydepartment->find("all",array("conditions"=>array("Usermanydepartment.user_id"=>$userInfo['User']['id'])));
                                    
                                    if(!empty($deptdatauser) && count($deptdatauser)>0){
                                        $visible=1;
                                    }else{
                                        $visible=0;
                                    }

                                    $this->Session->write('loggeddepartment',$deptdata[$userInfo['User']['department_id']]);
                                    $this->Session->write('loggedvisible',$visible);
                                    $session = $this->Session->read();
                                    if(isset($session['sitelogincounter'])){
                                        $session['sitelogincounter']=$session['sitelogincounter']+1;
                                    }else{
                                        $this->Session->write('sitelogincounter', 1);
                                    }		
                                        

                                    $datediffcheck=strtotime($session['loggedexpdate'])-strtotime(date("Y-m-d"));
                                }else{
                                    
                                    $this->redirect($baseurl.'/'.$fleetname.'/app/webroot/'.$sitename.'/admin/users/login');
                                }
                            }else{
                                $this->Session->setFlash("User is Deactivated Please contact to OBA", 'default', array('class' => 'flashError'));
                                $this->redirect($baseurl.'/'.$fleetname.'/app/webroot/'.$sitename.'/admin/users/login');
                            }		

                            if($datediffcheck<=0){

                                $this->redirect($baseurl.'/'.$fleetname.'/app/webroot/'.$sitename.'/admin/admins/licence');

                            }else { 
                                                if ($userInfo['User']['user_type'] == 0) {
                                        $this->redirect($baseurl.'/'.$fleetname.'/app/webroot/'.$sitename.'/admin/crews/crewpage_edit/admin:true');
                                    }
                                    elseif ($userInfo['User']['user_type'] == 2) {
                                        $this->redirect($baseurl.'/'.$fleetname.'/app/webroot/'.$sitename.'/admin/templatechecklists/calender');
                                    }else  if ($userInfo['User']['user_type'] == 4) {
                                        $this->redirect($baseurl.'/'.$fleetname.'/app/webroot/'.$sitename.'/admin/templatechecklists/calender');
                                    }else { $session = $this->Session->read();
                                        
                                        $this->redirect($baseurl.'/'.$fleetname.'/app/webroot/'.$sitename.'/admin/templatechecklists/calender');
                                    }
                           }
                        
                         
                   }else{
                       
                        $this->Session->setFlash("Username & Password details are not matched", 'default', array('class' => 'flashError')); 
                    }
                    
                    
                }else{
                 
                $this->Session->setFlash("Vessel name is not matched", 'default', array('class' => 'flashError')); 
                $this->redirect($baseurl.'/clientlogin/');
            }    

           
        
        }elseif(!empty($sitename) && $fleetname == "" ){
            
            if($this->User->setDatabase($sitename)){

            $userData = $this->User->find('first',array('conditions'=>array('User.username' =>$username,'User.password'=>$userpassword,'User.status'=>1,'User.is_deleted' => 0)));
            $userdatediff=1;
                   if (!empty($userData['User']['password']) && ($userData['User']['password'] == $userpassword) && ($userData['User']['user_type'] == 0 || $userData['User']['user_type'] == 1 || $userData['User']['user_type'] == 2 || $userData['User']['user_type'] == 4 || $userData['User']['user_type'] == 6)) {
                         $this->Session->write('userid', $userData['User']['id']);
                         $userid = $this->Session->read('userid');
                         $userInfo = $this->User->find('first', array('conditions' => array("User.id" => $userid)));
                         
                         $this->loadModel('Yacht');
                         $yachtInfo = $this->Yacht->find('first', array('fields' => array('ydb_name', 'yname', 'id', 'expirydate','yfullName','ismmodule','syncmodule','status','ytimezone','smtp_host','captain_name','fleetname'), 'conditions' => array('id' => $userInfo['User']['yacht_id'])));
                         			
                            if(trim($userInfo['User']['end_date'])!='' && trim($userInfo['User']['end_date'])!='0000-00-00'){
                                    $dateenduser=strtotime($userInfo['User']['end_date']);
                                    $currdate=strtotime(date("Y-m-d"));
                                    $userdatediff=$dateenduser-$currdate;
                            }
                            
                            
                            if($userdatediff>0){
                                if($yachtInfo['Yacht']['status']==1){


                                    $this->Session->write('loggedYachtDbname', $yachtInfo['Yacht']['ydb_name']);
                                    $this->Session->write($yachtInfo['Yacht']['ydb_name'], $yachtInfo['Yacht']['ydb_name']."_".$userInfo['User']['id']);

                                    $this->Session->write('loggedYachtStatus', $yachtInfo['Yacht']['status']);
                                    $this->Session->write('logedusername.'.$userInfo['User']['username'], $userInfo['User']['username']);
                                    $this->Session->write('loggedYachtfullname', $yachtInfo['Yacht']['yfullName']);
                                    $this->Session->write('loggedcaptainname', $yachtInfo['Yacht']['captain_name']);
                                    $this->Session->write('loggedyachtid', $yachtInfo['Yacht']['id']);
                                    $this->Session->write('loggedyname', $yachtInfo['Yacht']['yname']);
                                    $this->Session->write('loggedsmtp', $yachtInfo['Yacht']['smtp_host']);
                                    $this->Session->write('loggedexpdate', $yachtInfo['Yacht']['expirydate']);
                                    $this->Session->write('loggedismmodule', $yachtInfo['Yacht']['ismmodule']);
                                    
                                    $this->Session->write('loggedsyncmodule', $yachtInfo['Yacht']['syncmodule']);
                                    $this->Session->write('loggedfleetname', $yachtInfo['Yacht']['fleetname']);
                                    $this->Session->write('loggedpassword', $password);
                                    $this->Session->write('loggedytimezone', $yachtInfo['Yacht']['ytimezone']);
                                    // if logged in fleet user is an oba then change ADMIN_SESSION
                                    $loggedFleetEmail = $userInfo['User']['email'];
                                    $loggedFleetUserInfo = $this->User->find('first',array('conditions'=>array('User.email'=>$loggedFleetEmail),'fields'=>array('User.id')));
                                 
                                    if(!empty($loggedFleetUserInfo)){
                                        $this->Session->write('ADMIN_SESSION', $loggedFleetUserInfo['User']['id']);
                                    }else{
                                        $this->Session->write('ADMIN_SESSION', $userInfo['User']['id']);
                                    }			    
                                   
                                    $this->Session->write('navigationflag', 0);
                                    $this->Session->write('navigationflagISM', 0);
                                    $this->Session->write('navigationflagwhole', 0);
                                    $this->Session->write('loggedUserInfo',$userInfo['User']);
                                    $this->loadModel("Department");
                                    $deptdata=$this->Department->find("list",array("fields"=>array("id","dept_name")));
                                    
                                    $this->loadModel("Usermanydepartment");
                                    $deptdatauser=$this->Usermanydepartment->find("all",array("conditions"=>array("Usermanydepartment.user_id"=>$userInfo['User']['id'])));
                                    
                                    if(!empty($deptdatauser) && count($deptdatauser)>0){
                                        $visible=1;
                                    }else{
                                        $visible=0;
                                    }

                                    $this->Session->write('loggeddepartment',$deptdata[$userInfo['User']['department_id']]);
                                    $this->Session->write('loggedvisible',$visible);
                                    $session = $this->Session->read();
                                    if(isset($session['sitelogincounter'])){
                                        $session['sitelogincounter']=$session['sitelogincounter']+1;
                                    }else{
                                        $this->Session->write('sitelogincounter', 1);
                                    }		
                                        

                                    $datediffcheck=strtotime($session['loggedexpdate'])-strtotime(date("Y-m-d"));
                                }else{
                                    
                                    $this->redirect($baseurl.'/'.$sitename.'/admin/users/login');
                                }
                            }else{
                                $this->Session->setFlash("User is Deactivated Please contact to OBA", 'default', array('class' => 'flashError'));
                                $this->redirect($baseurl.'/'.$sitename.'/admin/users/login');
                            }		

                            if($datediffcheck<=0){

                                $this->redirect($baseurl.'/'.$sitename.'/admin/admins/licence');

                            }else { 
                                                if ($userInfo['User']['user_type'] == 0) {
                                        $this->redirect($baseurl.'/'.$sitename.'/admin/crews/crewpage_edit/admin:true');
                                    }
                                    elseif ($userInfo['User']['user_type'] == 2) {
                                        $this->redirect($baseurl.'/'.$sitename.'/admin/templatechecklists/calender');
                                    }else  if ($userInfo['User']['user_type'] == 4) {
                                        $this->redirect($baseurl.'/'.$sitename.'/admin/templatechecklists/calender');
                                    }else { $session = $this->Session->read();
                                        
                                        $this->redirect($baseurl.'/'.$sitename.'/admin/templatechecklists/calender');
                                    }
                           }
                         
                         
                         
                   }else{
                        $this->Session->setFlash("Username & Password details are not matched", 'default', array('class' => 'flashError')); 
                   }
                    
            }else{
                 
                $this->Session->setFlash("Vessel name is not matched", 'default', array('class' => 'flashError')); 
                $this->redirect($baseurl.'/clientlogin/');
            }        
            
        }elseif(!empty($fleetname) && $sitename == "" ){
         
        $this->loadModel('Fleetcompany');
            $datafleet=$this->Fleetcompany->find("first",array("conditions"=>array("Fleetcompany.fleetname"=>$fleetname,"Fleetcompany.status"=>1)));
        
        if(!empty($datafleet)){
                $this->loadModel('Fleetuser');
                $fleetData = $this->Fleetuser->find("first",array("conditions"=>array("Fleetuser.username"=>$username,"Fleetuser.password"=>$userpassword,"Fleetuser.status"=>1,"Fleetuser.user_type"=>array(1,2,3,4,6),'Fleetuser.fleetcompany_id'=>$datafleet['Fleetcompany']['id'])));
                
                if(!empty($fleetData)){
                    
                    $userdatedifffleet=0;
		    if(trim($datafleet['Fleetcompany']['expirydate'])!='' && trim($datafleet['Fleetcompany']['expirydate'])!='0000-00-00'){
			    $dateenduser=strtotime($datafleet['Fleetcompany']['expirydate']);
			    $currdate=strtotime(date("Y-m-d"));
			    $userdatedifffleet=$dateenduser-$currdate;
		    }
		    
		    
		   
		    if($userdatedifffleet>0){
			
			// check if this user has an entry in fleetuseryachts table
			$this->loadModel('Fleetuseryacht');
			$checkOBAstatus = $this->Fleetuseryacht->find('all',array('conditions'=>array('Fleetuseryacht.fleetuser_id'=>$fleetData['Fleetuser']['id'])));
			$yachtIds = array();
			foreach($checkOBAstatus as $oba){
			    $yachtIds[] = $oba['Fleetuseryacht']['yacht_id'];
			}
			if(!empty($yachtIds)){
			    $this->Session->write('yachtsAssigned', $yachtIds);
			}					
			
			$this->Session->write('loggedfleetinfo', $datafleet['Fleetcompany']);
			$this->Session->write('loggedfleetuser', $fleetData['Fleetuser']);
			
			$this->Session->write('loggedpassword', $password);				
			$this->redirect($baseurl.'/'.$fleetname.'/admin/fleetcompanies/index');
			
		    }else{
			$this->Session->setFlash("Management CO. is Deactivated Please contact to Super Admin", 'default', array('class' => 'flashError'));
			$this->redirect($baseurl.'/'.$fleetname.'/admin/fleetcompanies/login');
		    }
                    
                     
                }else{
                    $this->Session->setFlash("Username & Password details are not matched", 'default', array('class' => 'flashError')); 
                }
            }else{
                $this->Session->setFlash("Fleetname is not matched", 'default', array('class' => 'flashError'));
            } 
            
            
             }
        }
    }
    
    public function admin_forgot_password() {
        $this->layout = 'login';
        $baseurl = Configure::read('BASE_URL'); 
           
            if (isset($this->data) && (!empty($this->data))) {       
                $getStatus = $this->checkEmailValidation($this->data['email']);
                if ($getStatus) {
                    $sitename = $this->data['sitename'];
                    if($this->User->setDatabase($sitename)){
                        
                         $userArr = $this->User->find('first',array('conditions'=>array('User.email' =>trim($this->data['email']),'User.status'=>1,'User.is_deleted' => 0)));
                        
         if(!empty($userArr)){
                    if (count($userArr) > 0) {
                        $passwd = $this->getRandPass();
                        $this->User->id = $userArr['User']['id'];
                        $hashCode = md5(uniqid(rand(), true));
                        $this->User->saveField('password', $hashCode, false);
                       
                        $SITE_URL = Configure::read('BASE_URL');
                        
                        $link = '<a href = "' . $SITE_URL . '/users/admin_secure_check/' . $hashCode . '/'.$sitename.'">Link </a>';
                        $template = "<p>{Email}</p><p>{LastName}</p><p>{FirstName}</p><p>[LINK]</p>";
                        $to = $userArr['User']['email'];
                        $data1 = $template;
                        $data1 = str_replace('{FirstName}', ucfirst($userArr['User']['first_name']), $data1);
                        $data1 = str_replace('{LastName}', ucfirst($userArr['User']['last_name']), $data1);
                        $data1 = str_replace('{Email}', $userArr['User']['email'], $data1);

                        $data1 = str_replace('[LINK]', $link, $data1);
                        $subject = ucfirst(str_replace('_', ' ', "Forgot Password"));
                        
                        $this->sendmail($userArr['User']['first_name'],$userArr['User']['last_name'],$userArr['User']['email'],$link);
                       
                        
                        $this->Session->setFlash('Please check your mailbox to access the account.', 'default', array('class' => 'alert alert-danger'));
                        $this->redirect(array('controller' => 'users', 'action' => 'login'));
                       
                    } else {
                        $this->Session->setFlash('Invalid email address.', 'default', array('class' => 'alert alert-danger'));
                        $this->redirect(array('controller' => 'users', 'action' => 'forgot_password'));
                    }
                    
                    
            }else{
                $this->Session->setFlash("Email address & vessel name details are not matched", 'default', array('class' => 'flashError')); 
            }
                    
                    
                    }else{
                 
                       $this->Session->setFlash("Vessel name is not matched", 'default', array('class' => 'flashError')); 
                       $this->redirect($baseurl.'/admin/users/forgot_password/');
                      }     
                    
                } else {
                    $this->Session->setFlash('You have entered wrong email address.', 'default', array('class' => 'alert alert-danger'));
                    $this->redirect(array('controller' => 'users', 'action' => 'forgot_password'));
                }
            }
           
    }
    
    public function checkEmailValidation($email) {
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$";
        if (eregi($pattern, $email)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getRandPass() {
        
        // Array Declaration
        $pass = array();
        
        // Variable declaration
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for($i = 0; $i < 8; $i++){
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    
    public function admin_secure_check($uniqueKey,$sitename) {
        $this->layout = 'admin_login';
        $this->set('title', 'Forgot Password');
        $this->set('title_for_layout', 'Forgot Password');
        $this->set('uniqueKey', $uniqueKey);
        $this->User->setDatabase($sitename);
        
        $data = $this->User->find('first', array('conditions' => array('User.password' => $uniqueKey)));
        if (empty($data)) {
            $this->Session->setFlash('Error Occured, Plesae check your secure code.', 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        if (!empty($this->request->data)) {
            $adminId = $data['User']['id'];
            $this->request->data['User']['id'] = $adminId;
            $this->request->data['User']['password'] = md5($this->data['password']);
            $this->User->save($this->request->data);
            $this->Session->setFlash('Password changed successfully', 'default', array('class' => 'alert alert-success'));
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
    }
    
    public function sendmail($firstName,$lastName,$to,$link){
        $name=$firstName.''.$lastName;      
        $subject = "Retrieve Password";        
        
        $message="
        <html>
        <head>
        <title></title>
        </head>
        <body>
        <div style='font-size:14px; font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;'>
        <p>Hello ".$name.",</p>
        <p>Please click the below link to retrieve your password.</p>
        <p>".$link."</p>        
        <p>Please contact support@superyachtos.com with any questions or if you would like to schedule an online training session. </p>
        <br/>
        <p>Enjoy Using TotalSuperyacht!</p>
        <br/>
        <p>Best regards,</p>
        <p>The team at Superyacht Operating Systems</p>
        </div>
        </body>
        </html>";
        // Always set content-type when sending HTML email
        $headers= "MIME-version: 1.0\n";
        $headers.= "Content-type: text/html; charset= iso-8859-1\n";
        $headers .= 'From: <'.FROM_EMAIL_ADDRESS.'>' . "\r\n";
        $isMail=mail($to,$subject,$message,$headers);       
        
    }
    
    
    
}

?>

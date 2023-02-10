<?php
/*
    * Charters Controller class
    * Functionality -  Manage the Charter guests Page
    * Developer - Nagarajan
    * Created date - 23-May-2018
    * Modified date - 
*/
class ChartersController extends AppController {
    var $name = 'Charters';    
    public $components = array('Paginator');
    /*
        * Load Token verify page
        * Functionality -  Loading the Token verify page
        * Developer - Nagarajan
        * Created date - 23-May-2018
        * Modified date - 
    */
    function index() {          
        $this->Session->destroy();
        $this->layout = 'login';        
    }
    
    function forgot_password() {       
        Configure::write('debug',0);
       $this->Session->destroy();
        //exit('ddddddd');
        //$this->autoRender = false;
        $this->layout = 'login';        
        $this->set('name','kkkkk');
         //$this->redirect(array('action' => 'forgot_password'));
    }
    
   function verifyEmail() {
        //echo "<pre>"; print_r($this->request->data); exit;
        if ($this->request->is('ajax')) {
            $this->layout = false;
            $this->autoRender = false;
            $result = array();

            if (isset($this->request->data['email']) && !empty($this->request->data['email'])) {
                $email = $this->request->data['email'];
                $this->loadModel('CharterGuest');
                $this->loadModel('GuestList');
                $cloudUrl = Configure::read('cloudUrl');
                $SITE_URL = Configure::read('BASE_URL');

                $this->CharterGuest->set($this->request->data);
                if (!$this->CharterGuest->validates(array('fieldList' => array('email')))) {
                    $result['status'] = "invalid_email";
                    $result['message'] = "Please enter a valid Email.";
                } else {
                    $guestConditions = array('email' => $email);

                    $GuestListData = $this->GuestList->find('first', array('conditions' => $guestConditions));
                    if(count($GuestListData) > 0){
                    $this->loadModel('CharterGuestAssociate');
                    $guestassConditions = array('UUID' => $GuestListData['GuestList']['UUID']);
                    $GuestAssListData = $this->CharterGuestAssociate->find('all', array('conditions' => $guestassConditions));
                    $guestCHGConditions = array('users_UUID' => $GuestListData['GuestList']['UUID']);
                    $CharterGuestListData = $this->CharterGuest->find('all', array('conditions' => $guestCHGConditions));
                   
                    //echo "<pre>"; print_r($GuestAssListData); exit;
                    if (count($GuestListData) != 0) {
                        // user exit
                        $sesstion = $this->Session->read();
                        //echo "<pre>"; print_r($GuestListData); print_r($sesstion); exit;
                        $salutation = $GuestListData['GuestList']['salutation'];
                        $firstName = $GuestListData['GuestList']['first_name'];
                        $lastName = $GuestListData['GuestList']['last_name'];
                        $userToken = $GuestListData['GuestList']['token'];
                        $to = $email;
                        $cloudURL = Configure::read('cloudUrl') . "charterguest";
                        $subject = "Charter Guest password reset";
                        $message = "
                        <html>
                        <head>
                        <title></title>
                        </head>
                        <body>
                        <div style='font-size:14px; font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;'>
                        <p>Hello <b>" . $firstName . "</b>,</p>
                        <p>Use the below token to log in and change your password.</p>
                        <br/>
                        <p>Token : <b>" . $userToken . "</b></p>
                        <br/>
                        <p>Please contact support@charterguest.com with any questions.</p>
                        </br>
                        <p>Sincerely,</p>        
                        <p>The SOS Team.</p>   
                        </div>
                        </body>
                        </html>";

                        $headers = "MIME-version: 1.0\n";
                        $headers .= "Content-type: text/html; charset= iso-8859-1\n";
                        $headers .= 'From: TotalSuperyacht <mail@totalsuperyacht.com>' . "\r\n";
                        //echo "<pre>"; print_r($GuestListData); 
                       
                        //exit;
                        $sendMail = $this->chkSMTPEmail($to, $subject, $message, $headers);
                        //echo $sendMail; exit;
                            $this->loadModel('GuestList');
                            $updateData['GuestList']['id'] = $GuestListData['GuestList']['id'];;
                            $updateData['GuestList']['password'] = NULL;
                            $this->GuestList->save($updateData);
                            $this->loadModel('CharterGuestAssociate');
                            if(isset($GuestAssListData[0]['CharterGuestAssociate']['id'])){
                                foreach($GuestAssListData as $value){
                                    $updateData1 = array();
                                    $updateData1['CharterGuestAssociate']['id'] = $value['CharterGuestAssociate']['id'];
                                    $updateData1['CharterGuestAssociate']['password'] = NULL;
                                    $this->CharterGuestAssociate->save($updateData1);
                                }
                            }
                            $this->loadModel('CharterGuest');
                            if(isset($CharterGuestListData[0]['CharterGuest']['id'])){
                                foreach($CharterGuestListData as $value){
                                    $updateCharterGuestData1 = array();
                                    $updateCharterGuestData1['CharterGuest']['id'] = $value['CharterGuest']['id'];
                                    $updateCharterGuestData1['CharterGuest']['password'] = NULL;
                                    $this->CharterGuest->save($updateCharterGuestData1);
                                }
                            }
                        
                            $result['status'] = "success";
                            $result['message'] = "Please check your mail.";
                         
                    } else {
                        // exit('ddddd');
                        $result['status'] = "invalid_email";
                        $result['message'] = "Sorry no email address was found.";
                    }
                    }else{
                        $result['status'] = "invalid_email";
                        $result['message'] = "Sorry no email address was found.";
                    }
                }
                echo json_encode($result);
                exit;
            }
        }
    }


    /*
        * Token verification
        * Functionality -  Verify the token and redirect to the Guest page
        * Developer - Nagarajan
        * Created date - 24-May-2018
        * Modified date - 
    */
    function verifyToken() {
        
        if($this->request->is('ajax')){
            $this->layout = false;
            $this->autoRender = false;
            $result = array();
            if (isset($this->request->data['token']) && !empty($this->request->data['token']) && isset($this->request->data['email']) && !empty($this->request->data['email'])) {
                $token = $this->request->data['token'];
                $email = $this->request->data['email'];
                $this->loadModel('CharterGuest');
                $this->loadModel('GuestList');
                $cloudUrl = Configure::read('cloudUrl');
                //$SITE_URL = Configure::read('BASE_URL');  
                
                $this->CharterGuest->set($this->request->data);
                if (!$this->CharterGuest->validates(array('fieldList' => array('email')))) {
                    $result['status'] = "invalid_email";
                    $result['message'] = "Please enter a valid Email.";
                } else {
                    $guestConditions = array('email' => $email);
                    $guestConditions['OR'] = array('token' => $token, 'password' => md5($token));
                    // Verifying the email and token - Head Charterer
                    $charterData = $this->CharterGuest->find('first', array('conditions' => $guestConditions));
                    
                    $GuestListData = $this->GuestList->find('first', array('conditions' => $guestConditions));
                    //echo "<pre>"; print_r($GuestListData); exit;
                    if (count($charterData) != 0) {
                        $this->Session->destroy();
                        //echo "<pre>"; print_r($charterData); exit;
                        $loginUser = $charterData['CharterGuest']['first_name'].' '.$charterData['CharterGuest']['last_name'];
                        $this->Session->write("login_username", $loginUser);
                        $this->Session->write("charter_info", $charterData);
                        $session = $this->Session->read('charter_info.CharterGuest');
                        $this->loadModel('Yacht');
                        $yachtData = $this->Yacht->find('first', array('conditions' => array('id' => $session['yacht_id'])));
                        //echo "<pre>"; print_r($yachtData); exit;
                        $this->Session->write("yachFullName", $yachtData['Yacht']['yfullName']);
                        $this->Session->write("yachtID", $yachtData['Yacht']['id']);
                        $this->Session->write("charter_info.CharterGuest.yacht_name", $yachtData['Yacht']['yfullName']);
                        $this->Session->write("charter_info.CharterGuest.captain_name", $yachtData['Yacht']['captain_name']);
                        $this->Session->write("charter_info.CharterGuest.ydb_name", $yachtData['Yacht']['ydb_name']);
                        $this->Session->write("charter_info.CharterGuest.Adminlogin",1);
                        if(isset($yachtData['Yacht']['domain_name'])){
                        $domain_name = $yachtData['Yacht']['domain_name'];
                        }
                        if(isset($domain_name) && $domain_name == "charterguest"){
                            $SITE_URL = "https://charterguest.net/";
                        }else{
                            $SITE_URL = "https://totalsuperyacht.com:8080/";
                        }
                        //exit('dddd');
                        // Fetch the Charter company details
                        $this->loadModel('Fleetcompany');
                        $companyData = $this->Fleetcompany->find('first', array('fields' => array('management_company_name','logo','fleetname','id'), 'conditions' => array('id' => $charterData['CharterGuest']['charter_company_id'])));
                        if (isset($companyData['Fleetcompany']['logo']) && !empty($companyData['Fleetcompany']['logo'])) {
                            // $fleetLogoUrl = $cloudUrl.$companyData['Fleetcompany']['fleetname']."/img/logo/thumb/".$companyData['Fleetcompany']['logo'];
                            // $fleetLogoUrl = $SITE_URL.'/'."charterguest/img/logo/thumb/".$companyData['Fleetcompany']['logo'];
                            // $fleetLogoUrl = $cloudUrl.$companyData['Fleetcompany']['fleetname']."/img/logo/thumb/".$companyData['Fleetcompany']['logo'];
                            $fleetLogoUrl = $SITE_URL.'/'.$companyData['Fleetcompany']['fleetname']."/img/logo/thumb/".$companyData['Fleetcompany']['logo'];
                            $this->Session->write("fleetLogoUrl", $fleetLogoUrl);
                            $this->Session->write("fleetCompanyName", $companyData['Fleetcompany']['management_company_name']);
                            $this->Session->write("fleetCompanyID", $companyData['Fleetcompany']['id']);
                            $this->Session->write("fleetname", $companyData['Fleetcompany']['fleetname']);
                        }else{
                            $fleetLogoUrl = $SITE_URL.'/'."charterguest/img/logo/thumb/charter_guest_logo.png";
                            $this->Session->write("fleetLogoUrl", $fleetLogoUrl);
                        }
                        
                        $ydb_name = $yachtData['Yacht']['ydb_name'];
                        $yachtDBData = $this->Yacht->getYachtData($ydb_name);
                        //if(isset($yachtDBData[0]['yachts']['cg_background_image'])){
                            $image = $yachtDBData[0]['yachts']['cg_background_image'];
                        //}
                        //if(isset($yachtDBData[0]['yachts']['psheets_color'])){
                            $pSheetsColor = $yachtDBData[0]['yachts']['psheets_color'];
                        //}
                        // echo "<pre>"; print_r($yachtDBData); exit;
                        // if($image){
                        //     $fleetSiteName = $yachtDBData[0]['yachts']['fleetname'];
                        //     $yachtSiteName = $yachtDBData[0]['yachts']['yname'];
                        //     $cgBackgroundImage = BASE_URL.'/SOS/app/webroot/betayacht/app/webroot/img/charter_program_files/'.$image;
                        //     if (!empty($fleetSiteName)) { // IF yacht is under any Fleet
                        //         $cgBackgroundImage = BASE_URL."/".$fleetSiteName."/app/webroot/".$yachtSiteName."/app/webroot/img/charter_program_files/".$image;
                        //     }
                        // }else{
                        //     $cgBackgroundImage = "https://totalsuperyacht.com:8080/charterguest/css/admin/images/full-charter.png";
                        // }
                        //if(isset($yachtDBData[0]['yachts']['fleetname'])){
                            $fleetname = $yachtDBData[0]['yachts']['fleetname'];
                        //}
                        $yachtname = $yachtDBData[0]['yachts']['yname'];
                        if(isset($yachtDBData[0]['yachts']['domain_name'])){
                        $domain_name = $yachtDBData[0]['yachts']['domain_name'];
                        }
                        if(isset($domain_name) && $domain_name == "charterguest"){
                            $SITE_URL = "https://charterguest.net/";
                        }else{
                            $SITE_URL = "https://totalsuperyacht.com:8080/";
                        }
                        //if(isset($image) && isset($fleetname) && isset($yachtname)){
                        $cgBackgroundImage = $this->getBackgroundImageUrl($image, $fleetname, $yachtname,$SITE_URL);
                        $this->Session->write("cgBackgroundImage", $cgBackgroundImage);
                        $this->Session->write("pSheetsColor", $pSheetsColor);
                        //}
                        
                        // Check whether the Password is already created
                        $passwordExists = $this->CharterGuest->find('first', array('conditions' => array('id' => $charterData['CharterGuest']['id'], 'password IS NOT NULL', 'password != ""')));
                        if (!empty($passwordExists)) {
                            //echo "here"; exit;
                            $result['status'] = "success_redirect";
                            $result['url'] = 'charters/programs/'.$GuestListData['GuestList']['UUID'];
                            $this->Session->write("guestListUUID", $GuestListData['GuestList']['UUID']);
                        } else {
                           // echo "kkkkkkkkk"; exit;
                            $result['status'] = "success";
                            $result['url'] = 'charters/programs';
                            $result['charter_guest_id'] = $charterData['CharterGuest']['id'];
                            $result['charter_assoc_id'] = 0;
                            $result['guest_list_id'] = $GuestListData['GuestList']['id'];
                        }
                        
                    } else {
                        $assocConditions = array('email' => $email);
                        $assocConditions['OR'] = array('token' => $token, 'password' => md5($token));
                        // Verifying the email and token - Charter guests
                        $this->loadModel('CharterGuestAssociate');
                        $charterAssocData = $this->CharterGuestAssociate->find('first', array('conditions' => $assocConditions));
                        $GuestListData = $this->GuestList->find('first', array('conditions' => $assocConditions));

                        if (count($charterAssocData) != 0) {
                            //echo "<pre>"; print_r($charterAssocData); exit;
                            // Head charterer data
                            $charterHeadData = $this->CharterGuest->find('first', array('conditions' => array('charter_program_id' => $charterAssocData['CharterGuestAssociate']['charter_guest_id'])));
                            $this->Session->destroy();
                             $loginUser = $charterAssocData['CharterGuestAssociate']['first_name'].' '.$charterAssocData['CharterGuestAssociate']['last_name'];
                           //exit;
                           //echo "<pre>"; print_r($charterHeadData); exit;
                           $this->Session->write("login_username", $loginUser);
                            $this->Session->write("charter_info", $charterHeadData);
                            //$this->Session->write("selectedCharterProgramUUID", $charterAssocData['CharterGuestAssociate']['charter_program_id']);
                            //$this->Session->write("assocprefenceUUID", $charterAssocData['CharterGuestAssociate']['UUID']);
                            $session = $this->Session->read('charter_info.CharterGuest');
                            $this->loadModel('Yacht');
                            $yachtData = $this->Yacht->find('first', array('conditions' => array('id' => $session['yacht_id'])));
                            $this->Session->write("yachFullName", $yachtData['Yacht']['yfullName']);
                            $this->Session->write("charter_info.CharterGuest.yacht_name", $yachtData['Yacht']['yfullName']);
                            $this->Session->write("charter_info.CharterGuest.captain_name", $yachtData['Yacht']['captain_name']);
                            $this->Session->write("charter_info.CharterGuest.ydb_name", $yachtData['Yacht']['ydb_name']);
                            $this->Session->write("charter_assoc_info", $charterAssocData);
                            $this->Session->write("selectedCharterProgramUUID", $charterAssocData['CharterGuestAssociate']['charter_guest_id']);
                            $this->Session->write("assocprefenceID", $charterAssocData['CharterGuestAssociate']['id']);
                            $this->Session->write("assocprefenceUUID", $charterAssocData['CharterGuestAssociate']['UUID']);
                            if(isset($yachtData['Yacht']['domain_name'])){
                            $domain_name = $yachtData['Yacht']['domain_name'];
                            }
                            if(isset($domain_name) && $domain_name == "charterguest"){
                                $SITE_URL = "https://charterguest.net/";
                            }else{
                                $SITE_URL = "https://totalsuperyacht.com:8080/";
                            }
                            //echo "<pre>";print_r($this->Session->read());exit;
                            
                            // Fetch the Charter company details
                            $this->loadModel('Fleetcompany');
                            $companyData = $this->Fleetcompany->find('first', array('fields' => array('management_company_name','logo','fleetname'), 'conditions' => array('id' => $charterHeadData['CharterGuest']['charter_company_id'])));
                            if (isset($companyData['Fleetcompany']['logo']) && !empty($companyData['Fleetcompany']['logo'])) {
                                // $fleetLogoUrl = $cloudUrl.$companyData['Fleetcompany']['fleetname']."/img/logo/thumb/".$companyData['Fleetcompany']['logo'];
                                $fleetLogoUrl = $SITE_URL.'/'."charterguest/img/logo/thumb/".$companyData['Fleetcompany']['logo'];
                                $this->Session->write("fleetLogoUrl", $fleetLogoUrl);
                                $this->Session->write("fleetCompanyName", $companyData['Fleetcompany']['management_company_name']);
                            } else{
                                $fleetLogoUrl = $SITE_URL.'/'."charterguest/img/logo/thumb/charter_guest_logo.png";
                                $this->Session->write("fleetLogoUrl", $fleetLogoUrl);
                            }
                            
                            
                            // Check whether the Password is already created
                            $passwordExists = $this->CharterGuestAssociate->find('first', array('conditions' => array('id' => $charterAssocData['CharterGuestAssociate']['id'], 'password IS NOT NULL', 'password != ""')));
                            if (!empty($passwordExists)) {
                                $result['status'] = "success_redirect";
                                $result['url'] = 'charters/programs/'.$GuestListData['GuestList']['UUID'];
                                $this->Session->write("guestListUUID", $GuestListData['GuestList']['UUID']);
                            } else {
                                $result['status'] = "success";
                                $result['url'] = 'charters/programs';
                                $result['charter_guest_id'] = $charterHeadData['CharterGuest']['id'];
                                $result['charter_assoc_id'] = $charterAssocData['CharterGuestAssociate']['id'];
                                $result['guest_list_id'] = $GuestListData['GuestList']['id'];
                                $this->Session->write("guestListUUID", $GuestListData['GuestList']['UUID']);
                            }
                        
                        } else {
                            $result['status'] = "fail";
                            $result['message'] = "Invalid Email address/Token/Password.";
                        }
                        $this->Session->write("charter_info.CharterGuest.Adminlogin",0);
                    }
                } 
                
            }
        }
        echo json_encode($result);
        exit;
    }
    
    /*
        * Password Creation
        * Functionality -  Create Password and redirect to the page
        * Developer - Nagarajan
        * Created date - 27-July-2018
        * Modified date - 
    */
    function createPassword() {
        
        if($this->request->is('ajax')){
            $this->layout = false;
            $this->autoRender = false;
            $result = array();
            //echo "<pre>";print_r($this->request->data);exit;
            if (isset($this->request->data['charter_guest_id']) && !empty($this->request->data['charter_guest_id']) && isset($this->request->data['password']) && !empty($this->request->data['password'])) {
                $insertData = array();
                $this->loadModel('CharterGuest');
                $this->loadModel('CharterGuestAssociate');
                $this->loadModel('GuestList');
                
                $password = $this->request->data['password'];
                $insertData['password'] = $hashPassword = md5($password);
                $guestinsertData['password'] = md5($password);
                $charterGuestId = $this->request->data['charter_guest_id'];
                $charterAssocId = $this->request->data['charter_assoc_id'];
                $guestListId = $this->request->data['guest_list_id'];

                $guest_list_data = $this->GuestList->find('first',array('conditions'=>array('GuestList.id'=>$guestListId)));
                                
                if ($charterAssocId != 0) { // Associate table
                    $insertData['id'] = $charterAssocId;
                    $guestinsertData['id'] = $guestListId;
                    // Save the Password
                    if ($this->CharterGuestAssociate->save($insertData)) {
                        $this->GuestList->save($guestinsertData);
                        $result['status'] = "success";
                        $result['guest_list_uuid'] = $guest_list_data['GuestList']['UUID'];
                        $this->Session->write("guestListUUID", $guest_list_data['GuestList']['UUID']);
                    } else {
                        $result['status'] = "fail";
                    }
                } else { // Guest table
                    $insertData['id'] = $charterGuestId;
                    $guestinsertData['id'] = $guestListId;
                    // Save the Password
                    if ($this->CharterGuest->save($insertData)) {
                        $this->GuestList->save($guestinsertData);
                        $result['status'] = "success";
                        $result['guest_list_uuid'] = $guest_list_data['GuestList']['UUID'];
                        $this->Session->write("guestListUUID", $guest_list_data['GuestList']['UUID']);
                    } else {
                        $result['status'] = "fail";
                    }
                }
                                 
            }
        }
        echo json_encode($result);
        exit;
    }
    /**
     * 
     * Load the charter programs
     * Functionality - Loading the charter programs with details
     * After login & from create password page.
     * 
     */
    function programs() {
        $session = $this->Session->read('charter_info');
        
        // echo "<pre>";print_r($sessionAssoc);exit;
         if (empty($session)) {
            $this->redirect(array('controller' => 'Charters', 'action' => 'index'));
         }

        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        //echo "<pre>";print_r($this->Session->read());exit;
        //echo $actual_link."<br>"; 
        $parts = parse_url($actual_link);
        //echo $parts['path'];
        $explodepath = explode('/',$parts['path']);
        //echo "<pre>";print_r($explodepath); exit;
        $usersUUID = $explodepath[4];
        $CharterGuestConditions = array('users_UUID' => $usersUUID);
        $GuestListConditions = array('UUID' => $usersUUID);
        $charterAssocConditions = array('UUID' => $usersUUID);
        //echo $usersUUID;
        $this->loadModel('CharterGuest');
        $this->loadModel('GuestList');
        $this->loadModel('CharterGuestAssociate');
        $this->loadModel('Yacht');
        $this->loadModel('YachtWeblink');
        $this->loadModel('CharterProgramFile');
        $this->loadModel('Fleetcompany');
        $guestListData = $this->GuestList->find('first', array('conditions' => $GuestListConditions));
        $charterGuestData = $this->CharterGuest->find('all', array('conditions' => $CharterGuestConditions, 'order' => 'CharterGuest.charter_from_date desc'));

        $websiteList = $this->Yacht->find('list', array('fields' => array('id','charter_website')));
        $yfullName = $this->Yacht->find('list', array('fields' => array('id','yfullName')));
        $programFiles  = array();
        $mapdetails = array();
        $SITE_URL = Configure::read('BASE_URL');
        //$SITE_URL = "https://totalsuperyacht.com:8080/";
       // echo "<pre>";print_r($guestListData); //exit;
        // echo "<pre>";print_r($charterGuestData); exit;
        if(isset($charterGuestData) && !empty($charterGuestData)){
            $commentcounttotal = 0;
            foreach($charterGuestData as $key => $value){
                $YachtWeblinkConditionsGuest = array('YachtWeblink.charter_company_id' => $value['CharterGuest']['charter_company_id'],'YachtWeblink.yacht_id' => $value['CharterGuest']['yacht_id'],'YachtWeblink.is_deleted'=>0);
                $YachtWeblinkdata = $this->YachtWeblink->find('first', array('conditions' => $YachtWeblinkConditionsGuest));

                $programFilesCond = array('CharterProgramFile.charter_program_id' => $value['CharterGuest']['charter_program_id'],'CharterProgramFile.yacht_id' => $value['CharterGuest']['yacht_id'],'CharterProgramFile.is_deleted'=>0);
                $programFiledata = $this->CharterProgramFile->find('all', array('conditions' => $programFilesCond));

                if(isset($YachtWeblinkdata) && !empty($YachtWeblinkdata)){
                    $isValid = preg_match("@^https?://@", $YachtWeblinkdata['YachtWeblink']['weblink']);
                    if($isValid == 0){
                        $YachtWeblinkdata['YachtWeblink']['weblink'] = 'https://'.$YachtWeblinkdata['YachtWeblink']['weblink'];
                    }
                    $charterGuestData[$key]['websitedetails'] = $YachtWeblinkdata;
                }
                $charter_from_date = date("d M Y", strtotime($value['CharterGuest']['charter_from_date']));
                if(isset($programFiledata)){
                    $programFiles[$charter_from_date]['attachment'] = $programFiledata;
                    //$programFiles[]['startdate'] = $charter_from_date;
                }
                $yacht_id = $value['CharterGuest']['yacht_id'];
                $charter_company_id = $value['CharterGuest']['charter_company_id'];
                $yachtCond = array('Yacht.id' => $yacht_id);
                $Ydata = $this->Yacht->find('first', array('conditions' => $yachtCond));
                $ydb_name = $Ydata['Yacht']['ydb_name'];
                $yname = $Ydata['Yacht']['yname'];
                if(isset($Ydata['Yacht']['domain_name'])){
                $domain_name = $Ydata['Yacht']['domain_name'];
                }
                if(isset($domain_name) && $domain_name == "charterguest"){
                    $SITE_URL = "https://charterguest.net/";
                }else{
                    $SITE_URL = "https://totalsuperyacht.com:8080/";
                }
                $fleetname = "";
                if(isset($charter_company_id) && !empty($charter_company_id)){
                    $companyData = $this->Fleetcompany->find('first', array('fields' => array('management_company_name','logo','fleetname'), 'conditions' => array('id' => $charter_company_id)));
                    $fleetname = $companyData['Fleetcompany']['fleetname'];
                }
                if(isset($programFiledata) && isset($fleetname) && !empty($fleetname)){
                    $programFiles[$charter_from_date]['fleetname'] = $fleetname;
                    $programFiles[$charter_from_date]['siteurl'] = $SITE_URL;
                }
                if(isset($value['CharterGuest']['program_image']) && !empty($value['CharterGuest']['program_image'])){
                    if (!empty($fleetname)) {
                        
                        if($fleetname == "fleetbeta" || $fleetname == "SOS"){
                            if($fleetname == "fleetbeta" && $yname == "betayacht"){
                                $targetFullPath = $SITE_URL."fleetbeta/app/webroot/betayacht/app/webroot/img/charter_program_files/charter_program_photo/".$value['CharterGuest']['program_image'];
                            }else{  
                                $targetFullPath = $SITE_URL."fleetbeta/app/webroot/img/charter_program_files/charter_program_photo/".$value['CharterGuest']['program_image'];
                            }
                        }else if($fleetname != "fleetbeta" || $fleetname != "SOS"){
                            $targetFullPath = $SITE_URL.$fleetname."/app/webroot/img/charter_program_files/charter_program_photo/".$value['CharterGuest']['program_image'];
                        }else{
                            $targetFullPath = $SITE_URL.$fleetname."/app/webroot/".$yname."/app/webroot/img/charter_program_files/charter_program_photo/".$value['CharterGuest']['program_image'];
                        }
                    } else {  
                        $targetFullPath = $SITE_URL.$yname."/app/webroot/img/charter_program_files/charter_program_photo/".$value['CharterGuest']['program_image'];
                    }
                    $charterGuestData[$key]['program_image'] = $targetFullPath;
                }else{
                    $charterGuestData[$key]['program_image'] = "#";
                }
                //echo $targetFullPath."<br>"; //exit;
                $pid = $value['CharterGuest']['charter_program_id'];
                $charterGuestData[$key]['ydb_name'] = $ydb_name;
                $scheduleData = $this->CharterProgramFile->query("SELECT * FROM $ydb_name.charter_program_schedules CharterProgramSchedule WHERE charter_program_id = '$pid' AND is_deleted = 0");
                if(isset($scheduleData) && !empty($scheduleData)){
                    if(($scheduleData[0]['CharterProgramSchedule']['publish_map'] == 1)){
                        $map = array();
                        $map['dbname'] = $ydb_name;
                        $map['programid'] = $value['CharterGuest']['charter_program_id'];
                        $commentindividualtotal = $this->charter_program_map_total_msg_count($value['CharterGuest']['charter_program_id'],$ydb_name);
                        $charterGuestData[$key]['msg_count'] = $commentindividualtotal;
                        $map['count'] = $commentindividualtotal;
                        $mapdetails[$charter_from_date] = $map;
                        $commentcounttotal += $commentindividualtotal;
                        $charterGuestData[$key]['map_url'] = "link";
                    }else{
                        $charterGuestData[$key]['map_url'] = "nolink";
                    }
                }else{
                    $charterGuestData[$key]['map_url'] = "nolink";
                }

                // $yachtDBData = $this->Yacht->getYachtData($ydb_name);
                // $image = $yachtDBData[0]['yachts']['cg_background_image'];
                // $pSheetsColor = $yachtDBData[0]['yachts']['psheets_color'];

                            $this->loadModel('Fleetcompany');
                            $companyData = $this->Fleetcompany->find('first', array('fields' => array('management_company_name','logo','fleetname'), 'conditions' => array('id' => $value['CharterGuest']['charter_company_id'])));
                            if (isset($companyData['Fleetcompany']['logo']) && !empty($companyData['Fleetcompany']['logo'])) {
                                // $fleetLogoUrl = $cloudUrl.$companyData['Fleetcompany']['fleetname']."/img/logo/thumb/".$companyData['Fleetcompany']['logo'];
                                $fleetLogoUrl = $SITE_URL.'/'."charterguest/img/logo/thumb/".$companyData['Fleetcompany']['logo'];
                                $charterGuestData[$key]['charter_logo'] = $fleetLogoUrl;
                            } else{
                                $fleetLogoUrl = $SITE_URL.'/'."charterguest/img/logo/thumb/charter_guest_logo.png";
                                $charterGuestData[$key]['charter_logo'] = $fleetLogoUrl;
                            }
                
            }//exit;
            //echo "<pre>";print_r($commentcounttotal); exit;

            $this->Session->write("commentcounttotal", $commentcounttotal);

            $fleetname = $this->Session->read('fleetname');
            if(isset($programFiles) && !empty($programFiles) ){
                $attachment = array();
                //$SITE_URL = Configure::read('BASE_URL');
                //$SITE_URL = "https://totalsuperyacht.com:8080/";
                foreach($programFiles as $startdate => $filedata){ 
                    foreach($filedata['attachment'] as $file){ 
                        $fleetname = $this->Session->read('fleetname');
                        if(isset($filedata['fleetname'])){
                            $fleetname = $filedata['fleetname'];
                        }
                        if(isset($filedata['siteurl'])){
                            $SITE_URL = $filedata['siteurl'];
                        }
                        $sourceImagePath = $SITE_URL.'/'.$fleetname."/app/webroot/img/charter_program_files/".$file['CharterProgramFile']['file_name'];
                        $attachment[$startdate] = $sourceImagePath;
                    }
                } 
            }
    //    echo "<pre>";print_r($attachment); echo "<pre>";print_r($programFiles); exit;

         }

            //  $charterAssocData = $this->CharterGuestAssociate->find('all', array('conditions' => $charterAssocConditions)); old query
             $charterAssocData = $this->CharterGuestAssociate->find('all', array(
                'conditions' => $charterAssocConditions, 
                "joins" => array(
                    array(
                        'table' => 'charter_guests',
                        'alias' => 'CharterGuest',
                        'type' => 'LEFT',
                        'conditions' => array('CharterGuestAssociate.charter_program_id = CharterGuest.charter_program_id')
                    ),
                ),
                'order' => array('CharterGuest.charter_from_date' => 'DESC'),
                ));
                // echo " query = "; print_r($this->CharterGuestAssociate->getLastQuery());
            //  echo "<pre>";print_r($charterAssocData); exit;
             if(isset($charterAssocData) && !empty($charterAssocData)){

                foreach($charterAssocData as $key => $value){
                    $chConditions = array('charter_program_id' => $value['CharterGuestAssociate']['charter_program_id']);
                    $chData = $this->CharterGuest->find('first', array('conditions' => $chConditions));
                    $charterAssocData[$key]['charterDetails'] = $chData;
                    
                        $yachtCond = array('Yacht.id' => $value['CharterGuestAssociate']['yacht_id']);
                        $charter_company_id = $value['CharterGuestAssociate']['fleetcompany_id'];
                        $Ydata = $this->Yacht->find('first', array('conditions' => $yachtCond));
                        if(isset($Ydata['Yacht']['ydb_name'])){
                        $ydb_name = $Ydata['Yacht']['ydb_name'];
                        }
                        if(isset($Ydata['Yacht']['domain_name'])){
                        $domain_name = $Ydata['Yacht']['domain_name'];
                        }
                        if(isset($domain_name) && $domain_name == "charterguest"){
                            $SITE_URL = "https://charterguest.net/";
                        }else{
                            $SITE_URL = "https://totalsuperyacht.com:8080/";
                        }
                        $yname = $Ydata['Yacht']['yname'];
                        $fleetname = "";
                        if(isset($charter_company_id) && !empty($charter_company_id)){
                            $companyData = $this->Fleetcompany->find('first', array('fields' => array('management_company_name','logo','fleetname'), 'conditions' => array('id' => $charter_company_id)));
                            $fleetname = $companyData['Fleetcompany']['fleetname'];
                        }
                    if(isset($chData['CharterGuest']['program_image']) && !empty($chData['CharterGuest']['program_image'])){
                        if (!empty($fleetname)) {
                            if($fleetname == "fleetbeta" || $fleetname == "SOS"){
                                $targetFullPath = $SITE_URL."/fleetbeta/app/webroot/img/charter_program_files/charter_program_photo/".$chData['CharterGuest']['program_image'];
                            }else if($fleetname != "fleetbeta" || $fleetname != "SOS"){
                                $targetFullPath = $SITE_URL."/".$fleetname."/app/webroot/img/charter_program_files/charter_program_photo/".$chData['CharterGuest']['program_image'];
                            }else{
                                $targetFullPath = $SITE_URL."/".$fleetname."/app/webroot/".$yname."/app/webroot/img/charter_program_files/charter_program_photo/".$chData['CharterGuest']['program_image'];
                            }
                        } else {
                            $targetFullPath = $SITE_URL."/".$yname."/app/webroot/img/charter_program_files/charter_program_photo/".$chData['CharterGuest']['program_image'];
                        }
                        $charterAssocData[$key]['charterDetails']['ch_image'] = $targetFullPath;
                    }else{
                        $charterAssocData[$key]['charterDetails']['ch_image'] = "#";
                    }
                    $charterAssocData[$key]['charterDetails']['ydb_name'] = $ydb_name;
                    $YachtWeblinkConditions = array('YachtWeblink.charter_company_id' => $value['CharterGuestAssociate']['fleetcompany_id'],'YachtWeblink.yacht_id' => $value['CharterGuestAssociate']['yacht_id'],'YachtWeblink.is_deleted'=>0);
                    $YachtWeblink = $this->YachtWeblink->find('first', array('conditions' => $YachtWeblinkConditions));
                    if(isset($YachtWeblink) && !empty($YachtWeblink['YachtWeblink']['weblink'])){
                        $isValid = preg_match("@^https?://@", $YachtWeblink['YachtWeblink']['weblink']);
                        if($isValid == 0){
                            $YachtWeblink['YachtWeblink']['weblink'] = 'https://'.$YachtWeblink['YachtWeblink']['weblink'];
                        }
                        $charterAssocData[$key]['websitedetails'] = $YachtWeblink;
                    }

                    $this->loadModel('Fleetcompany');
                            $companyData = $this->Fleetcompany->find('first', array('fields' => array('management_company_name','logo','fleetname'), 'conditions' => array('id' => $value['CharterGuestAssociate']['fleetcompany_id'])));
                            if (isset($companyData['Fleetcompany']['logo']) && !empty($companyData['Fleetcompany']['logo'])) {
                                // $fleetLogoUrl = $cloudUrl.$companyData['Fleetcompany']['fleetname']."/img/logo/thumb/".$companyData['Fleetcompany']['logo'];
                                $fleetLogoUrl = $SITE_URL.'/'."charterguest/img/logo/thumb/".$companyData['Fleetcompany']['logo'];
                                $charterAssocData[$key]['charterDetails']['charter_logo'] = $fleetLogoUrl;
                            } else{
                                $fleetLogoUrl = $SITE_URL.'/'."charterguest/img/logo/thumb/charter_guest_logo.png";
                                $charterAssocData[$key]['charterDetails']['charter_logo'] = $fleetLogoUrl;
                            }

                            $commentindividualtotal = $this->charter_program_map_total_msg_count($value['CharterGuestAssociate']['charter_program_id'],$ydb_name);
                        $charterAssocData[$key]['charterDetails']['msg_count'] = $commentindividualtotal;

                        $pid = $value['CharterGuestAssociate']['charter_program_id'];
                        $scheduleData = $this->CharterProgramFile->query("SELECT * FROM $ydb_name.charter_program_schedules CharterProgramSchedule WHERE charter_program_id = '$pid' AND is_deleted = 0");
                        if(isset($scheduleData) && !empty($scheduleData)){
                            if(($scheduleData[0]['CharterProgramSchedule']['publish_map'] == 1)){
                                
                                $charterAssocData[$key]['charterDetails']['map_url'] = "link";
                            }else{
                                $charterAssocData[$key]['charterDetails']['map_url'] = "nolink";
                            }
                        }else{
                            $charterAssocData[$key]['charterDetails']['map_url'] = "nolink";
                        }
                }

             }
    //echo "<pre>";print_r($charterGuestData); 
        //echo "<pre>";print_r($charterAssocData); //exit;
        //echo "<pre>";print_r($mapdetails); exit;
        
        $this->set('charterGuestData', $charterGuestData);
        $this->set('charterAssocData', $charterAssocData);
        $this->set('guestListData', $guestListData);
        $this->set('websiteList', $websiteList);
        $this->set('yfullName', $yfullName);
        if(isset($attachment) && !empty($attachment)){
            $this->set('programFiles', $attachment);
        }
        $this->set('mapdetails', $mapdetails);
        //echo "<pre>";print_r($guestListData);
        //exit;

    }
    
    /*
        * Load the Charter Head's page
        * Functionality -  Loading the Charter head's page with existing Head charterer details
        * Developer - Nagarajan
        * Created date - 24-May-2018
        * Modified date - 
    */
    function view() {
        $session = $this->Session->read('charter_info');
        $sessionAssoc = $this->Session->read('charter_assoc_info');
        // echo "<pre>";print_r($sessionAssoc);exit;
        if (empty($session)) {
            $this->redirect(array('action' => 'index'));
        } else if (!empty($sessionAssoc)) {
            $this->redirect(array('action' => 'preference'));
        }
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
       
        //echo $actual_link."<br>"; 
        $parts = parse_url($actual_link);
        //echo $parts['path'];
        $explodepath = explode('/',$parts['path']);
        //echo "<pre>";print_r($explodepath);
        $CharterGuest_id = $explodepath[4];
        $charter_program_id = $explodepath[5];
        $charter_company_id = $explodepath[6];
        // Fetching the Head Charterer details
        // $this->Session->delete("selectedCharterProgramUUID");

        // $this->Session->write("selectedCharterProgramUUID", $charter_program_id);

        //echo $this->Session->read("selectedCharterProgramUUID"); exit;
        $this->Session->write("selectedCHID", $CharterGuest_id);
        $this->Session->write("selectedCHPRGID", $charter_program_id);
        $this->Session->write("selectedCHPRGCOMID", $charter_company_id);

        $this->Session->delete("Fromownerguestlist");
        $this->Session->write("Fromownerguestlist","yes");

        $this->loadModel('CharterGuest');
        $this->loadModel('CharterProgramFile');
        $this->loadModel('Yacht');
        $charterData = $this->CharterGuest->find('first', array('conditions' => array('id' => $CharterGuest_id)));
        $this->set('charterData', $charterData);
//        echo "<pre>";print_r($charterData);

        /****************** */
        $programFiles  = array();
        $mapdetails = array();
        $programFilesCond = array('CharterProgramFile.charter_program_id' => $charterData['CharterGuest']['charter_program_id'],'CharterProgramFile.yacht_id' => $charterData['CharterGuest']['yacht_id'],'CharterProgramFile.is_deleted'=>0);
        $programFiledata = $this->CharterProgramFile->find('all', array('conditions' => $programFilesCond));


        $charter_from_date = date("d M Y", strtotime($charterData['CharterGuest']['charter_from_date']));
        if(isset($programFiledata)){
            $programFiles[$charter_from_date]['attachment'] = $programFiledata;
            //$programFiles[]['startdate'] = $charter_from_date;
        }
        $yacht_id = $charterData['CharterGuest']['yacht_id'];
        $yachtCond = array('Yacht.id' => $yacht_id);
        $Ydata = $this->Yacht->find('first', array('conditions' => $yachtCond));
        $ydb_name = $Ydata['Yacht']['ydb_name'];
        $yfullNameDisp = $Ydata['Yacht']['yfullName'];
        
        // Background image
        // $image = $Ydata['Yacht']['cg_background_image'];
        // if($image){
        //     $fleetSiteName = $Ydata['Yacht']['fleetname'];
        //     $yachtSiteName = $Ydata['Yacht']['yname'];
        //     $cgBackgroundImage = BASE_URL."/".$yachtSiteName.'/app/webroot/betayacht/app/webroot/img/charter_program_files/'.$image;
        //     if (!empty($fleetSiteName)) { // IF yacht is under any Fleet
        //         $cgBackgroundImage = BASE_URL."/".$fleetSiteName."/app/webroot/".$yachtSiteName."/app/webroot/img/charter_program_files/".$image;
        //     }
        // }else{
        //     $cgBackgroundImage = "https://totalsuperyacht.com:8080/charterguest/css/admin/images/full-charter.png";
        // }
        $YachtData =  $this->CharterGuest->query("SELECT * FROM $ydb_name.yachts Yacht");
        //echo "<pre>";print_r($YachtData); exit;
        $image = $YachtData[0]['Yacht']['cg_background_image'];
        $fleetname = $YachtData[0]['Yacht']['fleetname'];
        $yachtname = $YachtData[0]['Yacht']['yname'];
        if(isset($YachtData[0]['Yacht']['domain_name'])){
        $domain_name = $YachtData[0]['Yacht']['domain_name'];
        }
                        if(isset($domain_name) && $domain_name == "charterguest"){
                            $SITE_URL = "https://charterguest.net/";
                        }else{
                            $SITE_URL = "https://totalsuperyacht.com:8080/";
                        }
        $cgBackgroundImage = $this->getBackgroundImageUrl($image, $fleetname, $yachtname,$SITE_URL);
        $this->Session->write("cgBackgroundImage", $cgBackgroundImage);
        // Background image
        $this->Session->delete("GuestListYname");
        $this->Session->write("GuestListYname", $yfullNameDisp);

        
        $pid = $charterData['CharterGuest']['charter_program_id'];
        //echo "SELECT * FROM $ydb_name.charter_program_schedules CharterProgramSchedule WHERE charter_program_id = '$pid' AND is_deleted = 0";
        $scheduleData = $this->CharterProgramFile->query("SELECT * FROM $ydb_name.charter_program_schedules CharterProgramSchedule WHERE charter_program_id = '$pid' AND is_deleted = 0");
        //echo "<pre>";print_r($scheduleData);exit;
        if(isset($scheduleData) && !empty($scheduleData)){
            if(($scheduleData[0]['CharterProgramSchedule']['publish_map'] == 1)){
                $map = array();
                $map['dbname'] = $ydb_name;
                $map['programid'] = $charterData['CharterGuest']['charter_program_id'];
                $mapdetails[$charter_from_date] = $map;
            }
        }

        $this->set('mapdetails', $mapdetails);
        /*********************** */
        
        // Fetching the Charter guest associates details
        $this->loadModel('CharterGuestAssociate');
        $charterAssocData = $this->CharterGuestAssociate->find('all', array('conditions' => array('charter_guest_id' => $charter_program_id)));
        $this->set('charterAssocData', $charterAssocData);
//        echo "<pre>";print_r($charterAssocData);exit;
        
        // Fetch the Charter company details
        $this->loadModel('Fleetcompany');
        
        $companyData = $this->Fleetcompany->find('first', array('fields' => array('management_company_name','logo','fleetname'), 'conditions' => array('id' => $charter_company_id)));
        $this->set('companyData', $companyData);
        $this->set('charter_company_id', $charter_company_id);
        $this->set('ismobile',$this->is_mobile);
        if(isset($companyData['Fleetcompany']['fleetname'])){
        $fleetname = $companyData['Fleetcompany']['fleetname'];
        }

        if(isset($programFiles) ){
            $attachment = array();
            //$SITE_URL = Configure::read('BASE_URL');
            foreach($programFiles as $startdate => $filedata){ 
                foreach($filedata['attachment'] as $file){ 
                    $sourceImagePath = $SITE_URL.'/'.$fleetname."/app/webroot/img/charter_program_files/".$file['CharterProgramFile']['file_name'];
                    $attachment[$startdate] = $sourceImagePath;

                }
            } 
        }

        $this->set('programFiles', $attachment);

        // Logo url
        if (isset($companyData['Fleetcompany']['logo']) && !empty($companyData['Fleetcompany']['logo'])) {
            $fleetLogoUrl = $SITE_URL.'/'."charterguest/img/logo/thumb/".$companyData['Fleetcompany']['logo'];
        } else{
            $fleetLogoUrl = $SITE_URL.'/'."charterguest/img/logo/thumb/charter_guest_logo.png";
        }
        $this->Session->write("fleetLogoUrl", $fleetLogoUrl);
    }


    /*
        * Load the Charter Head's page
        * Functionality -  Loading the Charter head's page with existing Head charterer details
        * Developer - Nagarajan
        * Created date - 24-May-2018
        * Modified date - 
    */
    function view_guest($charter_program_id,$charter_company_id) {
        //echo "<pre>";print_r($this->is_mobile);exit;

        //echo "<pre>";print_r($explodepath);
        $session = $this->Session->read('charter_info');
        
        // echo "<pre>";print_r($sessionAssoc);exit;
         if (empty($session)) {
             $this->redirect(array('controller' => 'Charters', 'action' => 'index'));
         }
        
        $charter_program_id = $charter_program_id;
        $charter_company_id = $charter_company_id;
        // Fetching the Head Charterer details
       
        $this->Session->delete("Fromownerguestlist");

        $this->loadModel('CharterGuest');
        $this->loadModel('CharterProgramFile');
        $this->loadModel('Yacht');
        $this->loadModel('Yacht');
        $charterData = $this->CharterGuest->find('first', array('conditions' => array('charter_program_id' => $charter_program_id)));
        $this->set('charterData', $charterData);
//        echo "<pre>";print_r($charterData);

        /****************** */
        $programFiles  = array();
        $mapdetails = array();
        $programFilesCond = array('CharterProgramFile.charter_program_id' => $charterData['CharterGuest']['charter_program_id'],'CharterProgramFile.yacht_id' => $charterData['CharterGuest']['yacht_id'],'CharterProgramFile.is_deleted'=>0);
        $programFiledata = $this->CharterProgramFile->find('all', array('conditions' => $programFilesCond));


        $charter_from_date = date("d M Y", strtotime($charterData['CharterGuest']['charter_from_date']));
        if(isset($programFiledata)){
            $programFiles[$charter_from_date]['attachment'] = $programFiledata;
            //$programFiles[]['startdate'] = $charter_from_date;
        }
        $yacht_id = $charterData['CharterGuest']['yacht_id'];
        $yachtCond = array('Yacht.id' => $yacht_id);
        $Ydata = $this->Yacht->find('first', array('conditions' => $yachtCond));
        $ydb_name = $Ydata['Yacht']['ydb_name'];
        $yachtnamedisp = $Ydata['Yacht']['yfullName'];
        if(isset($Ydata['Yacht']['domain_name'])){
        $domain_name = $Ydata['Yacht']['domain_name'];
        }
                            if(isset($domain_name) && $domain_name == "charterguest"){
                                $SITE_URL = "https://charterguest.net/";
                            }else{
                                $SITE_URL = "https://totalsuperyacht.com:8080/";
                            }
        $this->set('ydb_name', $ydb_name);
        $this->set('charter_program_id', $charter_program_id);

        $this->Session->delete("GuestListYname");
        $this->Session->write("GuestListYname", $yachtnamedisp);

        $pid = $charterData['CharterGuest']['charter_program_id'];
        //echo "SELECT * FROM $ydb_name.charter_program_schedules CharterProgramSchedule WHERE charter_program_id = '$pid' AND is_deleted = 0";
        $scheduleData = $this->CharterProgramFile->query("SELECT * FROM $ydb_name.charter_program_schedules CharterProgramSchedule WHERE charter_program_id = '$pid' AND is_deleted = 0");
        //echo "<pre>";print_r($scheduleData);exit;
        if(isset($scheduleData) && !empty($scheduleData)){
            if(($scheduleData[0]['CharterProgramSchedule']['publish_map'] == 1)){
                $map = array();
                $map['dbname'] = $ydb_name;
                $map['programid'] = $charterData['CharterGuest']['charter_program_id'];
                $mapdetails[$charter_from_date] = $map;
            }
        }

        $this->set('mapdetails', $mapdetails);
        /*********************** */
        
        // Fetching the Charter guest associates details
        $this->loadModel('CharterGuestAssociate');
        $charterAssocData = $this->CharterGuestAssociate->find('all', array('conditions' => array('charter_guest_id' => $charter_program_id)));
        $this->set('charterAssocData', $charterAssocData);
//        echo "<pre>";print_r($charterAssocData);exit;
        
        // Fetch the Charter company details
        $this->loadModel('Fleetcompany');
        $companyData = $this->Fleetcompany->find('first', array('fields' => array('management_company_name','logo','fleetname'), 'conditions' => array('id' => $charter_company_id)));
        $this->set('companyData', $companyData);

        $fleetname = $companyData['Fleetcompany']['fleetname'];
        if(isset($programFiles) ){
            $attachment = array();
            //$SITE_URL = Configure::read('BASE_URL');
            foreach($programFiles as $startdate => $filedata){ 
                foreach($filedata['attachment'] as $file){ 
                    $sourceImagePath = $SITE_URL.'/'.$fleetname."/app/webroot/img/charter_program_files/".$file['CharterProgramFile']['file_name'];
                    $attachment[$startdate] = $sourceImagePath;

                }
            } 
        }

        $this->set('programFiles', $attachment);
        
        $this->set('ismobile',$this->is_mobile);
        if(isset($YachtData) && !empty($YachtData)){
                $image = $YachtData[0]['Yacht']['cg_background_image'];
                $fleetname = $YachtData[0]['Yacht']['fleetname'];
                $yachtname = $YachtData[0]['Yacht']['yname'];
                if(isset($YachtData[0]['Yacht']['domain_name'])){
                $domain_name = $YachtData[0]['Yacht']['domain_name'];
                }
                        if(isset($domain_name) && $domain_name == "charterguest"){
                            $SITE_URL = "https://charterguest.net/";
                        }else{
                            $SITE_URL = "https://totalsuperyacht.com:8080/";
                        }
                $cgBackgroundImage = $this->getBackgroundImageUrl($image, $fleetname, $yachtname,$SITE_URL);
                $this->Session->write("cgBackgroundImage", $cgBackgroundImage);
        }
    }
    
    /*
        * Add Charter guest's Preferences
        * Functionality -  Add the the Charter guest preferences and details
        * Developer - Nagarajan
        * Created date - 29-May-2018
        * Modified date - 
    */
    function preference() {

        $this->Session->write("isgenerateProductOrderPdf", false);
        $this->Session->write("isgenerateWineOrderPdf", false); 
        // ini_set('upload_max_filesize', '10M');
        // ini_set('post_max_size', '10M');
        // ini_set('max_input_time', 300);
        // ini_set('max_execution_time', 300);
        $session = $this->Session->read('charter_info');
        $sessionAssoc = $this->Session->read('charter_assoc_info');
        if (empty($session)) {
            $this->redirect(array('action' => 'index'));
        }
        //echo "<pre>";print_r($this->Session->read()); exit;
        //echo $this->Session->read("selectedCharterProgramUUID"); exit;
        $associatePrimaryid = 0;
        $charterHeadId = isset($session['CharterGuest']['id']) ? $session['CharterGuest']['id'] : 0;
        $charterAssocId = isset($sessionAssoc['CharterGuestAssociate']['id']) ? $sessionAssoc['CharterGuestAssociate']['id'] : 0;
        if(isset($sessionAssoc['CharterGuestAssociate']['UUID'])){
            $charterGuestAssociateUUID = isset($sessionAssoc['CharterGuestAssociate']['UUID']) ? $sessionAssoc['CharterGuestAssociate']['UUID'] : 0;

        }else if(isset($session['CharterGuest']['users_UUID'])){
            $charterGuestAssociateUUID = isset($session['CharterGuest']['users_UUID']) ? $session['CharterGuest']['users_UUID'] : 0;
            
        }
        $charterHeadProgramId = isset($session['CharterGuest']['charter_program_id']) ? $session['CharterGuest']['charter_program_id'] : 0;
        
        //$charterHeadId = $charterGuestAssociateUUID; 
        //$charterAssocId = $charterGuestAssociateUUID;
        //echo "<pre>";print_r($this->Session->read()); exit;
        $this->loadModel('CharterGuest');
        $this->loadModel('Yacht');
        $this->loadModel('CharterGuestAssociate');
        $this->loadModel('CharterGuestPersonalDetail');
        

        $charter_company_id = isset($session['CharterGuest']['charter_company_id']) ? $session['CharterGuest']['charter_company_id'] : 0;
        $this->loadModel('Fleetcompany');
        $companyData = $this->Fleetcompany->find('first', array('fields' => array('ipad_hex_code','fleetname'), 'conditions' => array('id' => $charter_company_id)));
        if(isset($companyData) && !empty($companyData)){
            $pSheetsColor = $companyData['Fleetcompany']['ipad_hex_code'];
            $this->Session->write("pSheetsColor", $pSheetsColor);
        }
       
        // When main Head charterer opens other guest(if Head charterer checked) and Update the Preference sheets
        if (isset($this->request->query['assocId']) && !empty($this->request->query['assocId'])) {
            $charterAssocId = base64_decode($this->request->query['assocId']);
            $guestAssocData = $this->CharterGuestAssociate->find('first', array('conditions' => array('id' => $charterAssocId)));
            $charterGuestAssociateUUID = $guestAssocData['CharterGuestAssociate']['UUID'];
            $charterGuestAssociatefirst_name = $guestAssocData['CharterGuestAssociate']['first_name'];
            $charterGuestAssociatelast_name = $guestAssocData['CharterGuestAssociate']['last_name'];
            if (empty($guestAssocData)) {
                $this->redirect(array('action' => 'view'));
            }
            //echo "<pre>";print_r($guestAssocData); exit;
            $this->Session->write("assocprefenceID", $charterAssocId);
            $this->Session->write("assocprefenceUUID", $charterGuestAssociateUUID);
            $this->Session->write("selectedCharterProgramUUID", $guestAssocData['CharterGuestAssociate']['charter_program_id']);
            
            $mapyacht_id = $guestAssocData['CharterGuestAssociate']['yacht_id'];
            $mapyachtCond = array('Yacht.id' => $mapyacht_id);
            $mapYdata = $this->Yacht->find('first', array('conditions' => $mapyachtCond));
            $mapydb_name = $mapYdata['Yacht']['ydb_name'];

            $this->set("mapcharterprogramid", $guestAssocData['CharterGuestAssociate']['charter_program_id']);
            $this->set("mapydb_name", $mapydb_name);

            $deletedPersoanlDetail = $this->CharterGuestPersonalDetail->find('first', array('conditions' => array('guest_lists_UUID' => $charterGuestAssociateUUID, 'is_deleted'=>1)));

            if(isset($deletedPersoanlDetail) && !empty($deletedPersoanlDetail)){
                $deletedPersoanlDetail['CharterGuestPersonalDetail']['dob'] = (!empty($deletedPersoanlDetail['CharterGuestPersonalDetail']['dob']) && $deletedPersoanlDetail['CharterGuestPersonalDetail']['dob'] != '0000-00-00') ? date_format(date_create($deletedPersoanlDetail['CharterGuestPersonalDetail']['dob']), 'd M Y') : '';
                $deleteddob = $deletedPersoanlDetail['CharterGuestPersonalDetail']['dob'];
                $deletedpob = $deletedPersoanlDetail['CharterGuestPersonalDetail']['pob'];
                $this->set("deleteddob", $deleteddob);
                $this->set("deletedpob", $deletedpob);
            }
            $this->set("defaultFirstName", $charterGuestAssociatefirst_name);
            $this->set("defaultLastName", $charterGuestAssociatelast_name);

            $this->Session->delete("ownerprefenceID");
            $this->Session->delete("ownerprefenceUUID");

            $this->Session->write("preferenceParam", "?assocId=".$this->request->query['assocId']);
            
            $this->set("guestAssocDataByHeaderEdit", $guestAssocData);
            $this->set("charterAssocIdByHeaderEdit", $charterAssocId);
            $this->set("charterAssocIdisHeadChecked", $guestAssocData['CharterGuestAssociate']['is_head_charterer']);
            $this->Session->write('is_head_charterer', $guestAssocData['CharterGuestAssociate']['is_head_charterer']);
           // echo "<pre>"; print_r($guestAssocData); exit;
            // Storing the assoc id to Session
            $this->Session->write("charterAssocIdByHeaderEdit", $charterAssocId);
            //$this->Session->write("charterAssocisHeadCharter", $chedkAss['CharterGuestAssociate']['is_head_charterer']);
            //$this->Session->write("charterAssocIsHead", $charterAssocId);
        }
       
        // When Head charterer opens the Associate's((if Head charterer checked)) P-sheet
        if (isset($this->request->query['id']) && !empty($this->request->query['id'])) {
            $charterAssociateRowId = base64_decode($this->request->query['id']);
            $checkAssocExist = $this->CharterGuestAssociate->find('count', array('conditions' => array('id' => $charterAssociateRowId)));
            if ($checkAssocExist != 0) {
                $chedkAss = $this->CharterGuestAssociate->find('first', array('conditions' => array('id' => $charterAssociateRowId)));
                $charterGuestAssociateUUID = $chedkAss['CharterGuestAssociate']['UUID'];
                $charterGuestAssociatefirst_name = $chedkAss['CharterGuestAssociate']['first_name'];
                $charterGuestAssociatelast_name = $chedkAss['CharterGuestAssociate']['last_name'];

                $deletedPersoanlDetail = $this->CharterGuestPersonalDetail->find('first', array('conditions' => array('guest_lists_UUID' => $charterGuestAssociateUUID, 'is_deleted'=>1)));

                if(isset($deletedPersoanlDetail) && !empty($deletedPersoanlDetail)){
                    $deletedPersoanlDetail['CharterGuestPersonalDetail']['dob'] = (!empty($deletedPersoanlDetail['CharterGuestPersonalDetail']['dob']) && $deletedPersoanlDetail['CharterGuestPersonalDetail']['dob'] != '0000-00-00') ? date_format(date_create($deletedPersoanlDetail['CharterGuestPersonalDetail']['dob']), 'd M Y') : '';
                    $deleteddob = $deletedPersoanlDetail['CharterGuestPersonalDetail']['dob'];
                    $deletedpob = $deletedPersoanlDetail['CharterGuestPersonalDetail']['pob'];
                    $this->set("deleteddob", $deleteddob);
                    $this->set("deletedpob", $deletedpob);
                }

                $this->set("defaultFirstName", $charterGuestAssociatefirst_name);
                $this->set("defaultLastName", $charterGuestAssociatelast_name);
                
                //echo "<pre>"; print_r($chedkAss); exit;
                $charterAssocId = $charterAssociateRowId;
                // For disabling the submit button
                $this->set("charterAssocIdByHeaderView", $charterAssocId);
                $this->set("guestAssocDataByHeaderEdit", $chedkAss);
                $this->set("charterAssocIdByHeaderEdit", $charterAssocId);

                $this->Session->write("preferenceParam", "?id=".$this->request->query['id']);
                $this->Session->write("selectedCharterProgramUUID", $chedkAss['CharterGuestAssociate']['charter_program_id']);

                $mapyacht_id = $chedkAss['CharterGuestAssociate']['yacht_id'];
                $mapyachtCond = array('Yacht.id' => $mapyacht_id);
                $mapYdata = $this->Yacht->find('first', array('conditions' => $mapyachtCond));
                $mapydb_name = $mapYdata['Yacht']['ydb_name'];
                $this->set("mapcharterprogramid", $chedkAss['CharterGuestAssociate']['charter_program_id']);
                $this->set("mapydb_name", $mapydb_name);
                // Storing the assoc id to Session
                $this->Session->write("charterAssocIdByHeaderView", $charterAssocId);
                //$this->Session->write("charterAssocisHeadCharter", $chedkAss['CharterGuestAssociate']['is_head_charterer']);
                $this->set("charterAssocIdisHeadChecked", $chedkAss['CharterGuestAssociate']['is_head_charterer']);
                $this->Session->write('is_head_charterer', $chedkAss['CharterGuestAssociate']['is_head_charterer']);
            } else {
                // Deleting the assoc id from Session
                $this->Session->delete("charterAssocIdByHeaderView");
                $this->redirect(array('action' => 'view'));
            }
        } else {
            // Deleting the assoc id from Session
            $this->Session->delete("charterAssocIdByHeaderView");
        }

        if (isset($this->request->query['CharterGuestId']) && !empty($this->request->query['CharterGuestId'])) {
           $charterGuestId = base64_decode($this->request->query['CharterGuestId']);
            $guestAssocData = $this->CharterGuest->find('first', array('conditions' => array('id' => $charterGuestId)));
            $charterGuestAssociateusers_UUID_val = $guestAssocData['CharterGuest']['users_UUID'];
            $charterGuestAssociatefirst_name = $guestAssocData['CharterGuest']['first_name'];
            $charterGuestAssociatelast_name = $guestAssocData['CharterGuest']['last_name'];


            $deletedPersoanlDetail = $this->CharterGuestPersonalDetail->find('first', array('conditions' => array('guest_lists_UUID' => $charterGuestAssociateusers_UUID_val, 'is_deleted'=>1)));

            if(isset($deletedPersoanlDetail) && !empty($deletedPersoanlDetail)){
                $deletedPersoanlDetail['CharterGuestPersonalDetail']['dob'] = (!empty($deletedPersoanlDetail['CharterGuestPersonalDetail']['dob']) && $deletedPersoanlDetail['CharterGuestPersonalDetail']['dob'] != '0000-00-00') ? date_format(date_create($deletedPersoanlDetail['CharterGuestPersonalDetail']['dob']), 'd M Y') : '';
                $deleteddob = $deletedPersoanlDetail['CharterGuestPersonalDetail']['dob'];
                $deletedpob = $deletedPersoanlDetail['CharterGuestPersonalDetail']['pob'];
                $this->set("deleteddob", $deleteddob);
                $this->set("deletedpob", $deletedpob);
            }

            $this->set("defaultFirstName", $charterGuestAssociatefirst_name);
            $this->set("defaultLastName", $charterGuestAssociatelast_name);

            $this->Session->write("ownerprefenceID", $charterGuestId);
            if(isset($charterGuestAssociateusers_UUID_val)){
            $this->Session->write("ownerprefenceUUID", $charterGuestAssociateusers_UUID_val);
            }
            $this->Session->write("selectedCharterProgramUUID", $guestAssocData['CharterGuest']['charter_program_id']);

            $this->Session->write("preferenceParam", "?CharterGuestId=".$this->request->query['CharterGuestId']);

            $this->Session->delete("assocprefenceID");
            $this->Session->delete("assocprefenceUUID");

            if (empty($guestAssocData)) {
                $this->redirect(array('action' => 'view'));
            }
            //$this->set("guestAssocDataByHeaderEdit", $guestAssocData);
           // $this->set("charterAssocIdByHeaderEdit", $charterAssocId);
            $this->set("charterAssocIdisHeadChecked", $guestAssocData['CharterGuest']['is_head_charterer']);
            $this->Session->write('is_head_charterer', $guestAssocData['CharterGuest']['is_head_charterer']);

            $mapyacht_id = $guestAssocData['CharterGuest']['yacht_id'];
            $mapyachtCond = array('Yacht.id' => $mapyacht_id);
            $mapYdata = $this->Yacht->find('first', array('conditions' => $mapyachtCond));
            $mapydb_name = $mapYdata['Yacht']['ydb_name'];
            $this->set("mapcharterprogramid", $guestAssocData['CharterGuest']['charter_program_id']);
            $this->set("mapydb_name", $mapydb_name);
            //echo "<pre>"; print_r($guestAssocData); exit;
            // Storing the assoc id to Session
            //$this->Session->write("charterAssocIdByHeaderEdit", $charterAssocId);
           // $this->Session->write("charterAssocisHeadCharter", $chedkAss['CharterGuestAssociate']['is_head_charterer']);
            //$this->Session->write("charterAssocIsHead", $charterAssocId);
        }

        //echo "<pre>";print_r($this->Session->read());exit;
       // echo "<pre>";print_r($this->Session->read());exit;
        $this->loadModel('CharterGuestPersonalDetail');
        $this->loadModel('CharterGuestMealPreference');
        $this->loadModel('CharterGuestFoodPreference');
        $this->loadModel('CharterGuestSpiritPreference');
        $this->loadModel('CharterGuestItineraryPreference');
        $this->loadModel('CharterGuestBeveragePreference');
        $this->loadModel('CharterGuestBeverageType');
        $this->loadModel('CharterGuestBeverageItem');
        $this->loadModel('CharterGuestWinePreference');
        $this->loadModel('WineList');
        $this->loadModel('TempWineListSelection');
        $this->loadModel('WineListRegion');
        $this->loadModel('ProductList');
        $this->loadModel('TempProductListSelection');
        $this->loadModel('CharterGuestPersonalDetailSpecialOccasion');
        $this->loadModel('CharterGuestMealPreferenceRestaurant');
        
        if (isset($this->request->data['CharterGuestPersonalDetail']) && !empty($this->request->data['CharterGuestPersonalDetail'])) {
            // Save personal details //
            $data = $this->request->data['CharterGuestPersonalDetail'];
            //echo "<pre>";print_r($this->request->data['CharterGuestPersonalDetail']);
            // When main Head charterer opens other guest(if Head charterer checked) and Update the Preference sheets
            if (isset($data['charterAssocIdByHeaderEdit'])) {
                $charterAssocId = $data['charterAssocIdByHeaderEdit'];
                $this->set("charterAssocIdByHeaderEdit", $charterAssocId);
            }
            //echo "<pre>";print_r($this->request->data); exit;
            //echo $charterAssocId; exit;
            $guestAssc = $this->CharterGuestAssociate->find('first', array('conditions' => array('id' => $charterAssocId)));
            //echo "<pre>";print_r($this->Session->read());exit;
            $ownerprefenceID = $this->Session->read('ownerprefenceID');
            $ownerprefenceUUID = $this->Session->read('ownerprefenceUUID');
            if(isset($ownerprefenceUUID) && !empty($ownerprefenceUUID)){
                 
                 $data['guest_lists_UUID'] = $ownerprefenceUUID;
            }else{
                $data['guest_lists_UUID'] = $guestAssc['CharterGuestAssociate']['UUID'];
            }
            $charterGuestAssociateUUID = $data['guest_lists_UUID'];
            //echo "<pre>";print_r($guestAssc);exit;
            
            $data['charter_assoc_id'] = $charterAssocId;
            
            // Special occations
            if (isset($data['special_occations']) && !empty($data['special_occations'])) {
                $data['special_occations'] = implode(",", $data['special_occations']);
            }
            // Dietry requirements
            if (isset($data['dietries']) && !empty($data['dietries'])) {
                $data['dietries'] = implode(",", $data['dietries']);
            }else{
                // dietries unselected all checkboxes
                if(isset($data['dietries_hidden'][0]) && !empty($data['dietries_hidden'][0])){
                    $data['dietries'] = '';
                }
            }
            // Allergies
            if (isset($data['allergies']) && !empty($data['allergies'])) {
                $data['allergies'] = implode(",", $data['allergies']);
            }else{
                // Allergies unselected all checkboxes
                if(isset($data['allergies_hidden'][0]) && !empty($data['allergies_hidden'][0])){
                    $data['allergies'] = '';
                }
            }
            
            $existPassportImage = $data['exist_passport_image'];
            // Check whether image uploaded
            if ($data['passport_image']['name'] != "") {
                $data['passport_image'] = $existPassportImage;
            }else{
                unset($data['passport_image']);
            }
            //  else {
            //     // $path = 'img';
            //     // $folder_name = 'passport_images';
            //     // $folder_url = WWW_ROOT.$path.DIRECTORY_SEPARATOR.$folder_name;
            //     // $file = $data['passport_image'];
            //     // $imageName = date("ymdHis").'_'.$file['name'];
            //     // // create full filename                   
            //     // $full_url = $folder_url.DIRECTORY_SEPARATOR.$imageName; 
            //     // // upload the file
            //     // if (move_uploaded_file($file['tmp_name'], $full_url)) {
            //     //     $data['passport_image'] = $imageName;
            //     // } else {
            //         $data['passport_image'] = $existPassportImage;
            //     //}
            // }
            if (isset($data['medical_conditions']) && !empty($data['medical_conditions'])) {
                $data['medical_conditions'] = htmlspecialchars_decode($data['medical_conditions']);
            }

            if (isset($data['dietry_comments']) && !empty($data['dietry_comments'])) {
                $data['dietry_comments'] = htmlspecialchars_decode($data['dietry_comments']);
            }

            if (isset($data['allergy_comments']) && !empty($data['allergy_comments'])) {
                $data['allergy_comments'] = htmlspecialchars_decode($data['allergy_comments']);
            }
            
            $data['created'] = date('Y-m-d H:i:s');
            $data['dob'] = !empty($data['dob']) ? date_format(date_create($data['dob']), 'Y-m-d') : '';
            $data['issued_date'] = !empty($data['issued_date']) ? date_format(date_create($data['issued_date']), 'Y-m-d') : '';
            $data['expiry_date'] = !empty($data['expiry_date']) ? date_format(date_create($data['expiry_date']), 'Y-m-d') : '';
            $data['birthday_date'] = !empty($data['birthday_date']) ? date_format(date_create($data['birthday_date']), 'Y-m-d') : '';
            $data['honeymoon_date'] = !empty($data['honeymoon_date']) ? date_format(date_create($data['honeymoon_date']), 'Y-m-d') : '';
            $data['film_festival_date'] = !empty($data['film_festival_date']) ? date_format(date_create($data['film_festival_date']), 'Y-m-d') : '';
            $data['anniversary_date'] = !empty($data['anniversary_date']) ? date_format(date_create($data['anniversary_date']), 'Y-m-d') : '';
            $data['other_occation_date'] = !empty($data['other_occation_date']) ? date_format(date_create($data['other_occation_date']), 'Y-m-d') : '';
            $data['event_date'] = !empty($data['event_date']) ? date_format(date_create($data['event_date']), 'Y-m-d') : '';
            
            $specialOccasion = array();
            $selectedCharterProgramUUID = $this->Session->read('selectedCharterProgramUUID');
            $specialOccasion['CharterGuestPersonalDetailSpecialOccasion']['guest_lists_UUID'] = $data['guest_lists_UUID'];
            $specialOccasion['CharterGuestPersonalDetailSpecialOccasion']['charter_program_id'] = $selectedCharterProgramUUID;
            $specialOccasion['CharterGuestPersonalDetailSpecialOccasion']['birthday_date'] = !empty($data['birthday_date']) ? date_format(date_create($data['birthday_date']), 'Y-m-d') : '';
            $specialOccasion['CharterGuestPersonalDetailSpecialOccasion']['honeymoon_date'] = !empty($data['honeymoon_date']) ? date_format(date_create($data['honeymoon_date']), 'Y-m-d') : '';
            $specialOccasion['CharterGuestPersonalDetailSpecialOccasion']['film_festival_date'] = !empty($data['film_festival_date']) ? date_format(date_create($data['film_festival_date']), 'Y-m-d') : '';
            $specialOccasion['CharterGuestPersonalDetailSpecialOccasion']['anniversary_date'] = !empty($data['anniversary_date']) ? date_format(date_create($data['anniversary_date']), 'Y-m-d') : '';
            $specialOccasion['CharterGuestPersonalDetailSpecialOccasion']['other_occation_date'] = !empty($data['other_occation_date']) ? date_format(date_create($data['other_occation_date']), 'Y-m-d') : '';
            $specialOccasion['CharterGuestPersonalDetailSpecialOccasion']['event_date'] = !empty($data['event_date']) ? date_format(date_create($data['event_date']), 'Y-m-d') : '';
             
            $PersonalDetailSpecialOccasion = $this->CharterGuestPersonalDetailSpecialOccasion->find('first',array('conditions'=>array('charter_program_id' => $selectedCharterProgramUUID,'is_deleted'=>0,'guest_lists_UUID'=>$data['guest_lists_UUID'])));
            
            if(isset($PersonalDetailSpecialOccasion) && !empty($PersonalDetailSpecialOccasion)){
                $specialOccasion['CharterGuestPersonalDetailSpecialOccasion']['id'] = $PersonalDetailSpecialOccasion['CharterGuestPersonalDetailSpecialOccasion']['id'];
            }else{
                $this->CharterGuestPersonalDetailSpecialOccasion->create();
            }
            $this->CharterGuestPersonalDetailSpecialOccasion->save($specialOccasion);
            // echo "<pre>";print_r($data);exit;
            // Checks whether its CREATE or UPDATE
            if (empty($data['id'])) {
                $this->CharterGuestPersonalDetail->create();
            }
            //echo "<pre>";print_r($data);exit;
            if ($this->CharterGuestPersonalDetail->save($data)) {
                $personalDetailsTab = '';
                $mealPreferenceTab = 'active in';
                $foodPreferenceTab = '';
                $beveragePreferenceTab = '';
                $spiritPreferenceTab = '';
                $winePreferenceTab = '';
                $itineraryPreferenceTab = '';
            } else {
                $personalDetailsTab = 'active in';
                $mealPreferenceTab = '';
                $foodPreferenceTab = '';
                $beveragePreferenceTab = '';
                $spiritPreferenceTab = '';
                $winePreferenceTab = '';
                $itineraryPreferenceTab = '';
            }
            
        } else if (isset($this->request->data['CharterGuestMealPreference']) && !empty($this->request->data['CharterGuestMealPreference'])) {
            // Save Meal preference details //
            $data = $this->request->data['CharterGuestMealPreference'];
            
            // When main Head charterer opens other guest(if Head charterer checked) and Update the Preference sheets
            if (isset($data['charterAssocIdByHeaderEdit'])) {
                $charterAssocId = $data['charterAssocIdByHeaderEdit'];
                $this->set("charterAssocIdByHeaderEdit", $charterAssocId);
            }
            
            $guestAssc = $this->CharterGuestAssociate->find('first', array('conditions' => array('id' => $charterAssocId)));
            
            //echo "<pre>";print_r($guestAssc);exit;
            $ownerprefenceID = $this->Session->read('ownerprefenceID');
            $ownerprefenceUUID = $this->Session->read('ownerprefenceUUID');
            if(isset($ownerprefenceID) && !empty($ownerprefenceID)){
                 
                 $data['guest_lists_UUID'] = $ownerprefenceUUID;
           }else{
               $data['guest_lists_UUID'] = $guestAssc['CharterGuestAssociate']['UUID'];
           }
            $data['charter_assoc_id'] = $charterAssocId;
            
            $charterGuestAssociateUUID = $data['guest_lists_UUID'];
            // Breakfast likes
            if (isset($data['breakfast_likes']) && !empty($data['breakfast_likes'])) {
                $data['breakfast_likes'] = implode(",", $data['breakfast_likes']);
            }else{
                // Breakfast unselected all checkboxes
                if(isset($data['breakfast_likes_hidden'][0]) && !empty($data['breakfast_likes_hidden'][0])){
                    $data['breakfast_likes'] = '';
                }
            }
            // Lunch types
            if (isset($data['lunch_type']) && !empty($data['lunch_type'])) {
                $data['lunch_type'] = implode(",", $data['lunch_type']);
            }else{
                // Lunch unselected all checkboxes
                if(isset($data['lunch_type_hidden'][0]) && !empty($data['lunch_type_hidden'][0])){
                    $data['lunch_type'] = '';
                }
            }
            // Lunch styles
            if (isset($data['lunch_style']) && !empty($data['lunch_style'])) {
                $data['lunch_style'] = implode(",", $data['lunch_style']);
            }else{
                // Lunch unselected all checkboxes
                if(isset($data['lunch_style_hidden'][0]) && !empty($data['lunch_style_hidden'][0])){
                    $data['lunch_style'] = '';
                }
            }
            // Hors d'eovres
            if (isset($data['deovres_preference']) && !empty($data['deovres_preference'])) {
                $data['deovres_preference'] = implode(",", $data['deovres_preference']);
            }else{
                // Hors d'eovres unselected all checkboxes
                if(isset($data['deovres_preference_hidden'][0]) && !empty($data['deovres_preference_hidden'][0])){
                    $data['deovres_preference'] = '';
                }
            }

            if (isset($data['meal_time_service_comments']) && !empty($data['meal_time_service_comments'])) {
                $data['meal_time_service_comments'] = htmlspecialchars_decode($data['meal_time_service_comments']);
            }

            if (isset($data['other_breakfast_likes']) && !empty($data['other_breakfast_likes'])) {
                $data['other_breakfast_likes'] = htmlspecialchars_decode($data['other_breakfast_likes']);
            }

            if (isset($data['deovres_comments']) && !empty($data['deovres_comments'])) {
                $data['deovres_comments'] = htmlspecialchars_decode($data['deovres_comments']);
            }
            
            $data['created'] = date('Y-m-d H:i:s');
            $data['restaurant_date1'] = !empty($data['restaurant_date1']) ? date_format(date_create($data['restaurant_date1']), 'Y-m-d') : '';
            $data['restaurant_date2'] = !empty($data['restaurant_date2']) ? date_format(date_create($data['restaurant_date2']), 'Y-m-d') : '';
            $data['restaurant_date3'] = !empty($data['restaurant_date3']) ? date_format(date_create($data['restaurant_date3']), 'Y-m-d') : '';
            

            $restaurant = array();
            $selectedCharterProgramUUID = $this->Session->read('selectedCharterProgramUUID');
            $restaurant['CharterGuestMealPreferenceRestaurant']['guest_lists_UUID'] = $data['guest_lists_UUID'];
            $restaurant['CharterGuestMealPreferenceRestaurant']['charter_program_id'] = $selectedCharterProgramUUID;
            $restaurant['CharterGuestMealPreferenceRestaurant']['restaurant_date1'] = !empty($data['restaurant_date1']) ? date_format(date_create($data['restaurant_date1']), 'Y-m-d') : '';
            $restaurant['CharterGuestMealPreferenceRestaurant']['restaurant_date2'] = !empty($data['restaurant_date2']) ? date_format(date_create($data['restaurant_date2']), 'Y-m-d') : '';
            $restaurant['CharterGuestMealPreferenceRestaurant']['restaurant_date3'] = !empty($data['restaurant_date3']) ? date_format(date_create($data['restaurant_date3']), 'Y-m-d') : '';
            $restaurant['CharterGuestMealPreferenceRestaurant']['is_dining_ashore'] = $data['is_dining_ashore'];
            $restaurant['CharterGuestMealPreferenceRestaurant']['restaurant1'] = $data['restaurant1'];
            $restaurant['CharterGuestMealPreferenceRestaurant']['restaurant2'] = $data['restaurant2'];
            $restaurant['CharterGuestMealPreferenceRestaurant']['restaurant3'] = $data['restaurant3'];
            $restaurant['CharterGuestMealPreferenceRestaurant']['restaurant_time1'] = $data['restaurant_time1'];
            $restaurant['CharterGuestMealPreferenceRestaurant']['restaurant_time2'] = $data['restaurant_time2'];
            $restaurant['CharterGuestMealPreferenceRestaurant']['restaurant_time3'] = $data['restaurant_time3'];
             
            $CharterGuestMealPreferenceRestaurant = $this->CharterGuestMealPreferenceRestaurant->find('first',array('conditions'=>array('charter_program_id' => $selectedCharterProgramUUID,'is_deleted'=>0,'guest_lists_UUID'=>$data['guest_lists_UUID'])));
            
            if(isset($CharterGuestMealPreferenceRestaurant) && !empty($CharterGuestMealPreferenceRestaurant)){
                $restaurant['CharterGuestMealPreferenceRestaurant']['id'] = $CharterGuestMealPreferenceRestaurant['CharterGuestMealPreferenceRestaurant']['id'];
            }else{
                $this->CharterGuestMealPreferenceRestaurant->create();
            }
            $this->CharterGuestMealPreferenceRestaurant->save($restaurant);


//            echo "<pre>";print_r($data);exit;
            // Checks whether its CREATE or UPDATE
            if (empty($data['id'])) {
                $this->CharterGuestMealPreference->create();
            }
            
            if ($this->CharterGuestMealPreference->save($data)) {
                $personalDetailsTab = '';
                $mealPreferenceTab = '';
                $foodPreferenceTab = 'active in';
                $beveragePreferenceTab = '';
                $spiritPreferenceTab = '';
                $winePreferenceTab = '';
                $itineraryPreferenceTab = '';
            } else {
                $personalDetailsTab = '';
                $mealPreferenceTab = 'active in';
                $foodPreferenceTab = '';
                $beveragePreferenceTab = '';
                $spiritPreferenceTab = '';
                $winePreferenceTab = '';
                $itineraryPreferenceTab = '';
            }
            
        } else if (isset($this->request->data['CharterGuestFoodPreference']) && !empty($this->request->data['CharterGuestFoodPreference'])) {
            // Save Food preference details //
            $data = $this->request->data['CharterGuestFoodPreference'];
            
            // When main Head charterer opens other guest(if Head charterer checked) and Update the Preference sheets
            if (isset($data['charterAssocIdByHeaderEdit'])) {
                $charterAssocId = $data['charterAssocIdByHeaderEdit'];
                $this->set("charterAssocIdByHeaderEdit", $charterAssocId);
            }
            
            $guestAssc = $this->CharterGuestAssociate->find('first', array('conditions' => array('id' => $charterAssocId)));
            
            //echo "<pre>";print_r($guestAssc);exit;
            $ownerprefenceID = $this->Session->read('ownerprefenceID');
            $ownerprefenceUUID = $this->Session->read('ownerprefenceUUID');
            if(isset($ownerprefenceID) && !empty($ownerprefenceID)){
                 
                 $data['guest_lists_UUID'] = $ownerprefenceUUID;
            }else{
                $data['guest_lists_UUID'] = $guestAssc['CharterGuestAssociate']['UUID'];
            }
            $data['charter_assoc_id'] = $charterAssocId;
            $charterGuestAssociateUUID = $data['guest_lists_UUID'];
            // Food styles
            if (isset($data['food_style']) && !empty($data['food_style'])) {
                $data['food_style'] = implode(",", $data['food_style']);
            }else{
                // Food styles unselected all checkboxes
                if(isset($data['food_style_hidden'][0]) && !empty($data['food_style_hidden'][0])){
                    $data['food_style'] = '';
                }
            }
            // Dislikes
            if (isset($data['dislikes']) && !empty($data['dislikes'])) {
                $data['dislikes'] = implode(",", $data['dislikes']);
            }else{
                // Dislikes unselected all checkboxes
                if(isset($data['dislikes_hidden'][0]) && !empty($data['dislikes_hidden'][0])){
                    $data['dislikes'] = '';
                }
            }
            
            // Generating the Food preferences - 34 items
            $foodLove = $foodLike = $foodDislike = array();
            for ($i = 1; $i <= 34; $i++) {
                if (isset($data['food_'.$i])) {
                    if ($data['food_'.$i] == 1) {
                        $foodLove[] = $i;
                    } else if ($data['food_'.$i] == 2) {
                        $foodLike[] = $i;
                    } else {
                        $foodDislike[] = $i;
                    }
                }
            }
            $data['food_love'] = !empty($foodLove) ? implode(',', $foodLove) : '';
            $data['food_like'] = !empty($foodLike) ? implode(',', $foodLike) : '';
            $data['food_dislike'] = !empty($foodDislike) ? implode(',', $foodDislike) : '';
            
            if (isset($data['food_style_comments']) && !empty($data['food_style_comments'])) {
                $data['food_style_comments'] = htmlspecialchars_decode($data['food_style_comments']);
            }

            if (isset($data['dislike_comments']) && !empty($data['dislike_comments'])) {
                $data['dislike_comments'] = htmlspecialchars_decode($data['dislike_comments']);
            }

            $data['created'] = date('Y-m-d H:i:s');
            
//            echo "<pre>";print_r($data);exit;
            // Checks whether its CREATE or UPDATE
            if (empty($data['id'])) {
                $this->CharterGuestFoodPreference->create();
            }
            
            if ($this->CharterGuestFoodPreference->save($data)) {
                $personalDetailsTab = '';
                $mealPreferenceTab = '';
                $foodPreferenceTab = '';
                $beveragePreferenceTab = 'active in';
                $spiritPreferenceTab = '';
                $winePreferenceTab = '';
                $itineraryPreferenceTab = '';
            } else {
                $personalDetailsTab = '';
                $mealPreferenceTab = '';
                $foodPreferenceTab = 'active in';
                $beveragePreferenceTab = '';
                $spiritPreferenceTab = '';
                $winePreferenceTab = '';
                $itineraryPreferenceTab = '';
            }
            
        } else if (isset($this->request->data['CharterGuestBeveragePreference']) && !empty($this->request->data['CharterGuestBeveragePreference'])) {
            // Save Beverage preference details //
            $data = $this->request->data['CharterGuestBeveragePreference'];
            
            // When main Head charterer opens other guest(if Head charterer checked) and Update the Preference sheets
            if (isset($data['charterAssocIdByHeaderEdit'])) {
                $charterAssocId = $data['charterAssocIdByHeaderEdit'];
                $this->set("charterAssocIdByHeaderEdit", $charterAssocId);
            }
            
            $guestAssc = $this->CharterGuestAssociate->find('first', array('conditions' => array('id' => $charterAssocId)));
            
            //echo "<pre>";print_r($data);exit;
            $ownerprefenceID = $this->Session->read('ownerprefenceID');
            $ownerprefenceUUID = $this->Session->read('ownerprefenceUUID');

            $assocprefenceID = $this->Session->read('assocprefenceID');
            $assocprefenceUUID = $this->Session->read('assocprefenceUUID');

            if(isset($ownerprefenceID) && !empty($ownerprefenceID)){
                 
                 $data['guest_lists_UUID'] = $ownerprefenceUUID;
            }else{
                 $data['guest_lists_UUID'] = $guestAssc['CharterGuestAssociate']['UUID'];
            }
            $data['charter_assoc_id'] = $charterAssocId;
            $charterGuestAssociateUUID = $data['guest_lists_UUID'];
            // Coffee items
            if (isset($data['coffee_items']) && !empty($data['coffee_items'])) {
                $data['coffee_items'] = implode(",", $data['coffee_items']);
            }else{
                // coffee unselected all checkboxes
                if(isset($data['coffee_hidden'][0]) && !empty($data['coffee_hidden'][0])){
                    $data['coffee_items'] = '';
                }
            }
            // Tea items
            if (isset($data['tea_items']) && !empty($data['tea_items'])) {
                $data['tea_items'] = implode(",", $data['tea_items']);
            }else{
                // tea unselected all checkboxes
                if(isset($data['tea_hidden'][0]) && !empty($data['tea_hidden'][0])){
                    $data['tea_items'] = '';
                }
            }
            // Milk items
            if (isset($data['milk_items']) && !empty($data['milk_items'])) {
                $data['milk_items'] = implode(",", $data['milk_items']);
            }else{
                // milk unselected all checkboxes
                if(isset($data['milk_hidden'][0]) && !empty($data['milk_hidden'][0])){
                    $data['milk_items'] = '';
                }
            }
            // Soda items
            if (isset($data['soda_items']) && !empty($data['soda_items'])) {
                $data['soda_items'] = implode(",", $data['soda_items']);
            }else{
                // soda unselected all checkboxes
                if(isset($data['soda_hidden'][0]) && !empty($data['soda_hidden'][0])){
                    $data['soda_items'] = '';
                }
            }
            // Juice items
            if (isset($data['juice_items']) && !empty($data['juice_items'])) {
                $data['juice_items'] = implode(",", $data['juice_items']);
            }else{
                // juice unselected all checkboxes
                if(isset($data['juicehidden'][0]) && !empty($data['juicehidden'][0])){
                    $data['juice_items'] = '';
                }
            }
            // Water items
            if (isset($data['water_items']) && !empty($data['water_items'])) {
                $data['water_items'] = implode(",", $data['water_items']);
            }else{
                // water unselected all checkboxes
                if(isset($data['water_hidden'][0]) && !empty($data['water_hidden'][0])){
                    $data['water_items'] = '';
                }
            }
            /*
            // Alcoholic items1
            if (isset($data['alcoholic_items1']) && !empty($data['alcoholic_items1'])) {
                $data['alcoholic_items1'] = implode(",", $data['alcoholic_items1']);
            }
            // Alcoholic items2
            if (isset($data['alcoholic_items2']) && !empty($data['alcoholic_items2'])) {
                $data['alcoholic_items2'] = implode(",", $data['alcoholic_items2']);
            }
            // Alcoholic items3
            if (isset($data['alcoholic_items3']) && !empty($data['alcoholic_items3'])) {
                $data['alcoholic_items3'] = implode(",", $data['alcoholic_items3']);
            }
            // Alcoholic items4
            if (isset($data['alcoholic_items4']) && !empty($data['alcoholic_items4'])) {
                $data['alcoholic_items4'] = implode(",", $data['alcoholic_items4']);
            }
            // Alcoholic comments
            if (isset($data['alcoholic_comments']) && !empty($data['alcoholic_comments'])) {
                $data['alcoholic_comments'] = implode("^", $data['alcoholic_comments']);
            }
            // Alcoholic types
            if (isset($data['alcoholic_types']) && !empty($data['alcoholic_types'])) {
                $data['alcoholic_types'] = implode(",", $data['alcoholic_types']);
            }
            // Quantity1
            if (isset($data['quantity1']) && !empty($data['quantity1'])) {
                $data['quantity1'] = implode(",", $data['quantity1']);
            }
            // Quantity2
            if (isset($data['quantity2']) && !empty($data['quantity2'])) {
                $data['quantity2'] = implode(",", $data['quantity2']);
            }
            // Quantity3
            if (isset($data['quantity3']) && !empty($data['quantity3'])) {
                $data['quantity3'] = implode(",", $data['quantity3']);
            }
             */

            if (isset($data['coffee_comments']) && !empty($data['coffee_comments'])) {
                $data['coffee_comments'] = htmlspecialchars_decode($data['coffee_comments']);
            }

            if (isset($data['tea_comments']) && !empty($data['tea_comments'])) {
                $data['tea_comments'] = htmlspecialchars_decode($data['tea_comments']);
            }

            if (isset($data['milk_comments']) && !empty($data['milk_comments'])) {
                $data['milk_comments'] = htmlspecialchars_decode($data['milk_comments']);
            }

            if (isset($data['soda_comments1']) && !empty($data['soda_comments1'])) {
                $data['soda_comments1'] = htmlspecialchars_decode($data['soda_comments1']);
            }

            if (isset($data['soda_comments2']) && !empty($data['soda_comments2'])) {
                $data['soda_comments2'] = htmlspecialchars_decode($data['soda_comments2']);
            }

            if (isset($data['juice_comments']) && !empty($data['juice_comments'])) {
                $data['juice_comments'] = htmlspecialchars_decode($data['juice_comments']);
            }

            if (isset($data['water_comments']) && !empty($data['water_comments'])) {
                $data['water_comments'] = htmlspecialchars_decode($data['water_comments']);
            }

            
            $data['created'] = date('Y-m-d H:i:s');
            
            //echo "<pre>";print_r($data);exit;
            // Checks whether its CREATE or UPDATE
            if (empty($data['id'])) {
                $this->CharterGuestBeveragePreference->create();
            }
            
            if ($this->CharterGuestBeveragePreference->save($data)) {
                //echo "<pre>"; print_r($sessionAssoc); exit;
                // if user is not head charter then show directily ininery tab.
                // if(isset($sessionAssoc) && !empty($sessionAssoc)){

            $ownerprefenceID = $this->Session->read('ownerprefenceID');
            $ownerprefenceUUID = $this->Session->read('ownerprefenceUUID');

            $assocprefenceID = $this->Session->read('assocprefenceID');
            $assocprefenceUUID = $this->Session->read('assocprefenceUUID');
            if(isset($assocprefenceID) && !empty($assocprefenceID)){
                        $personalDetailsTab = '';
                        $mealPreferenceTab = '';
                        $foodPreferenceTab = '';
                        $beveragePreferenceTab = '';
                        $spiritPreferenceTab = '';
                        $winePreferenceTab = '';
                        $itineraryPreferenceTab = 'active in';

            }elseif(isset($ownerprefenceID) && !empty($ownerprefenceID)){
                            $personalDetailsTab = '';
                        $mealPreferenceTab = '';
                        $foodPreferenceTab = '';
                        $beveragePreferenceTab = '';
                        $spiritPreferenceTab = 'active in';
                        $winePreferenceTab = '';
                        $itineraryPreferenceTab = '';
            }

                $is_head_charterer = $this->Session->read('is_head_charterer');
                // if(isset($is_head_charterer) && !empty($is_head_charterer)){
                    
                //     if(isset($is_head_charterer) && $is_head_charterer == 1){
                //         $personalDetailsTab = '';
                //         $mealPreferenceTab = '';
                //         $foodPreferenceTab = '';
                //         $beveragePreferenceTab = '';
                //         $spiritPreferenceTab = '';
                //         $winePreferenceTab = '';
                //         $itineraryPreferenceTab = 'active in';
                //     }else{
                //         $personalDetailsTab = '';
                //         $mealPreferenceTab = '';
                //         $foodPreferenceTab = '';
                //         $beveragePreferenceTab = '';
                //         $spiritPreferenceTab = 'active in';
                //         $winePreferenceTab = '';
                //         $itineraryPreferenceTab = '';
                //     }
                // }else{
                // $personalDetailsTab = '';
                // $mealPreferenceTab = '';
                // $foodPreferenceTab = '';
                // $beveragePreferenceTab = '';
                // $spiritPreferenceTab = 'active in';
                // $winePreferenceTab = '';
                // $itineraryPreferenceTab = '';
                // }
            } else {
                $personalDetailsTab = '';
                $mealPreferenceTab = '';
                $foodPreferenceTab = '';
                $beveragePreferenceTab = 'active in';
                $spiritPreferenceTab = '';
                $winePreferenceTab = '';
                $itineraryPreferenceTab = '';
            }
            
        } else if (isset($this->request->data['CharterGuestSpiritPreference']) && !empty($this->request->data['CharterGuestSpiritPreference'])) {
            // Save Wine preference details //
            $data = $this->request->data['CharterGuestSpiritPreference'];
            $idedit = $this->Session->read();
            //echo "<pre>";print_r($idedit);exit;
            // When main Head charterer opens other guest(if Head charterer checked) and Update the Preference sheets
            if (isset($data['charterAssocIdByHeaderEdit'])) {
                $charterAssocId = $data['charterAssocIdByHeaderEdit'];
                $this->set("charterAssocIdByHeaderEdit", $charterAssocId);
            }
            //echo $charterAssocId;
            $ownerprefenceID = $this->Session->read('ownerprefenceID');
            $ownerprefenceUUID = $this->Session->read('ownerprefenceUUID');

            $assocprefenceID = $this->Session->read('assocprefenceID');
            $assocprefenceUUID = $this->Session->read('assocprefenceUUID');

            $guestAssc = $this->CharterGuestAssociate->find('first', array('conditions' => array('id' => $charterAssocId)));
            if (isset($guestAssc['CharterGuestAssociate']['id'])) {
            $associatePrimaryid = $guestAssc['CharterGuestAssociate']['id'];
            //echo "<pre>";print_r($guestAssc);exit;
            }
            
            if(isset($ownerprefenceUUID) && !empty($ownerprefenceUUID)){
                 
                 $data['guest_lists_UUID'] = $ownerprefenceUUID;
            }else{
               $data['guest_lists_UUID'] = $guestAssc['CharterGuestAssociate']['UUID'];
            }
            $data['charter_assoc_id'] = $charterAssocId;
            $charterGuestAssociateUUID = $data['guest_lists_UUID'];
            // Generating and storing the Selected wine details
            $productCount = 0;
            foreach ($data['product_id'] as $productListId) {
                
                // Check whether the record exists in charter_geust_wine_preference table
                if (isset($data['product_preference_id'][$productCount]) && !empty($data['product_preference_id'][$productCount])) {
                    // UPDATE
                    $updateData['id'] = $productPrefId = $data['product_preference_id'][$productCount];
                    $updateData['quantity'] = $data['product_quantity'][$productCount];
                    $this->CharterGuestSpiritPreference->save($updateData);
                    
                } else { // INSERT
                    $productData = $this->ProductList->find('first', array('conditions' => array('id' => $productListId)));
                    $insertData = array();
                    $selectedCharterProgramUUID = $this->Session->read('selectedCharterProgramUUID');
                    if(isset($ownerprefenceUUID) && !empty($ownerprefenceUUID)){
                        $insertData['guest_lists_UUID'] = $ownerprefenceUUID;
                        $valUUID = $ownerprefenceUUID;
                    }else{
                        $insertData['guest_lists_UUID'] = $guestAssc['CharterGuestAssociate']['UUID'];
                        $valUUID = $guestAssc['CharterGuestAssociate']['UUID'];
                    }
                    $insertData['charter_program_id'] = $selectedCharterProgramUUID;
                    $insertData['charter_assoc_id'] = $charterAssocId;
                    $insertData['product_list_id'] = $productData['ProductList']['id'];
                    $insertData['product_id'] = $productData['ProductList']['product_id'];
                    $insertData['is_dead'] = $productData['ProductList']['is_dead'];
                    $insertData['name'] = $productData['ProductList']['name'];
                    $insertData['tags'] = $productData['ProductList']['tags'];
                    $insertData['price_in_cents'] = $productData['ProductList']['price_in_cents'];
                    $insertData['stock_type'] = $productData['ProductList']['stock_type'];
                    $insertData['primary_category'] = $productData['ProductList']['primary_category'];
                    $insertData['secondary_category'] = $productData['ProductList']['secondary_category'];
                    $insertData['origin'] = $productData['ProductList']['origin'];
                    $insertData['description'] = $productData['ProductList']['description'];
                    $insertData['varietal'] = $productData['ProductList']['varietal'];
                    $insertData['style'] = $productData['ProductList']['style'];
                    $insertData['tertiary_category'] = $productData['ProductList']['tertiary_category'];
                    $insertData['quantity'] = $data['product_quantity'][$productCount];
                    $insertData['created'] = $insertData['modified'] = date('Y-m-d H:i:s');
                    //echo "<pre>";print_r($insertData);
                    // Save records into preference table
                    $this->CharterGuestSpiritPreference->create();
                    if ($this->CharterGuestSpiritPreference->save($insertData)) {
                        // Delete this wine record from Temp table
                        $tempConditions = array('product_list_id' => $productListId, 'guest_lists_UUID' => $valUUID, 'charter_program_id' => $selectedCharterProgramUUID);
                        $this->TempProductListSelection->deleteAll($tempConditions);
                    }
                }
                
                
                $productCount++;
            } //exit;
            
            // Save the Send Quotation field
            $sendSpiritQuotation = 0;
            if (isset($data['send_spirit_quotation'])) {
                $sendSpiritQuotation = 1;
            }
            if (isset($assocprefenceID) && !empty($assocprefenceID)) { // Charter Associate table
                $this->CharterGuestAssociate->save(array('id' => $assocprefenceID, 'send_spirit_quotation' => $sendSpiritQuotation));
            }
            if (isset($ownerprefenceID) && !empty($ownerprefenceID)) {  // Charter Guest table
                $this->CharterGuest->save(array('id' => $ownerprefenceID, 'send_spirit_quotation' => $sendSpiritQuotation));
            }
            
            $isgenerateProductOrderPdf = $data['isgenerateProductOrderPdf'];
            $this->Session->write("isgenerateProductOrderPdf", false);
            if($isgenerateProductOrderPdf){
                $this->Session->write("isgenerateProductOrderPdf", $isgenerateProductOrderPdf);
            }

            $personalDetailsTab = '';
            $mealPreferenceTab = '';
            $foodPreferenceTab = '';
            $beveragePreferenceTab = '';
            $spiritPreferenceTab = '';
            $winePreferenceTab = 'active in';
            $itineraryPreferenceTab = '';
            
        } else if (isset($this->request->data['CharterGuestWinePreference']) && !empty($this->request->data['CharterGuestWinePreference'])) {
            // Save Wine preference details //
            $data = $this->request->data['CharterGuestWinePreference'];
//            echo "<pre>";print_r($data);exit;
            // When main Head charterer opens other guest(if Head charterer checked) and Update the Preference sheets
            if (isset($data['charterAssocIdByHeaderEdit'])) {
                $charterAssocId = $data['charterAssocIdByHeaderEdit'];
                $this->set("charterAssocIdByHeaderEdit", $charterAssocId);
            }
            
            $guestAssc = $this->CharterGuestAssociate->find('first', array('conditions' => array('id' => $charterAssocId)));
            $associatePrimaryid = isset($guestAssc['CharterGuestAssociate']['id']) ? $guestAssc['CharterGuestAssociate']['id'] : 0;
            //echo "<pre>";print_r($guestAssc);exit;
            $ownerprefenceID = $this->Session->read('ownerprefenceID');
            $ownerprefenceUUID = $this->Session->read('ownerprefenceUUID');

            $assocprefenceID = $this->Session->read('assocprefenceID');
            $assocprefenceUUID = $this->Session->read('assocprefenceUUID');

            if(isset($ownerprefenceUUID) && !empty($ownerprefenceUUID)){
                 
                 $data['guest_lists_UUID'] = $ownerprefenceUUID;
            }else{
               $data['guest_lists_UUID'] = isset($guestAssc['CharterGuestAssociate']['UUID']) ? $guestAssc['CharterGuestAssociate']['UUID'] : 0;
            }
            $data['charter_assoc_id'] = $charterAssocId;
            $charterGuestAssociateUUID = $data['guest_lists_UUID'];
            // Generating and storing the Selected wine details
            $wineCount = 0;
            foreach ($data['wine_id'] as $wineListId) {
                
                // Check whether the record exists in charter_geust_wine_preference table
                if (isset($data['wine_preference_id'][$wineCount]) && !empty($data['wine_preference_id'][$wineCount])) {
                    // UPDATE
                    $updateData['id'] = $winePrefId = $data['wine_preference_id'][$wineCount];
                    $updateData['quantity'] = $data['wine_quantity'][$wineCount];
                    $this->CharterGuestWinePreference->save($updateData);
                    
                } else { // INSERT
                    $wineData = $this->WineList->find('first', array('conditions' => array('id' => $wineListId)));
                    $regionData = $this->WineListRegion->find('first', array('conditions' => array('wine_list_id' => $wineListId)));
                    $selectedCharterProgramUUID = $this->Session->read('selectedCharterProgramUUID');
                    $insertData = array();
                    if(isset($ownerprefenceUUID) && !empty($ownerprefenceUUID)){
                        $insertData['guest_lists_UUID'] = $ownerprefenceUUID;
                        $valUUID = $ownerprefenceUUID;
                    }else{
                        $insertData['guest_lists_UUID'] = $guestAssc['CharterGuestAssociate']['UUID'];
                        $valUUID = $guestAssc['CharterGuestAssociate']['UUID'];
                    }
                    $insertData['charter_program_id'] = $selectedCharterProgramUUID;
                    $insertData['charter_assoc_id'] = $charterAssocId;
                    $insertData['wine_list_id'] = $wineData['WineList']['id'];
                    $insertData['wine'] = $wineData['WineList']['wine'];
                    $insertData['wine_id'] = $wineData['WineList']['wine_id'];
                    $insertData['appellation'] = $wineData['WineList']['appellation'];
                    $insertData['color'] = $wineData['WineList']['color'];
                    $insertData['wine_type'] = $wineData['WineList']['wine_type'];
                    $insertData['country'] = $wineData['WineList']['country'];
                    $insertData['vintage'] = $wineData['WineList']['vintage'];
                    $insertData['score'] = $wineData['WineList']['score'];
                    $insertData['region'] = isset($regionData['WineListRegion']['region']) ? $regionData['WineListRegion']['region'] : NULL;
                    $insertData['quantity'] = $data['wine_quantity'][$wineCount];
                    $insertData['created'] = $insertData['modified'] = date('Y-m-d H:i:s');

                    // Save records into preference table
                    $this->CharterGuestWinePreference->create();
                    if ($this->CharterGuestWinePreference->save($insertData)) {
                        // Delete this wine record from Temp table
                        $tempConditions = array('wine_list_id' => $wineListId, 'guest_lists_UUID' => $valUUID, 'charter_program_id' => $selectedCharterProgramUUID);
                        $this->TempWineListSelection->deleteAll($tempConditions);
                    }
                }
                
                
                $wineCount++;
            }
            
            // Save the Send Quotation field
            $sendWineQuotation = 0;
            if (isset($data['send_wine_quotation'])) {
                $sendWineQuotation = 1;
            }
            if (isset($assocprefenceID) && !empty($assocprefenceID)) {  // Charter Associate table
                $this->CharterGuestAssociate->save(array('id' => $assocprefenceID, 'send_wine_quotation' => $sendWineQuotation));
            } 
            if (isset($ownerprefenceID) && !empty($ownerprefenceID)) {// Charter Guest table
                $this->CharterGuest->save(array('id' => $ownerprefenceID, 'send_wine_quotation' => $sendWineQuotation));
            }
            
            $isgenerateWineOrderPdf = $data['isgenerateWineOrderPdf'];
            $this->Session->write("isgenerateWineOrderPdf", false);
            if($isgenerateWineOrderPdf){
                $this->Session->write("isgenerateWineOrderPdf", $isgenerateWineOrderPdf);
            }
            
            $personalDetailsTab = '';
            $mealPreferenceTab = '';
            $foodPreferenceTab = '';
            $beveragePreferenceTab = '';
            $spiritPreferenceTab = '';
            $winePreferenceTab = '';
            $itineraryPreferenceTab = 'active in';
            
        } else if (isset($this->request->data['CharterGuestItineraryPreference']) && !empty($this->request->data['CharterGuestItineraryPreference'])) {
            //echo "<pre>";print_r($this->request->data);exit;
            // Save Itinerary preference details //
            $data = $this->request->data['CharterGuestItineraryPreference'];
            
            // When main Head charterer opens other guest(if Head charterer checked) and Update the Preference sheets
            if (isset($data['charterAssocIdByHeaderEdit'])) {
                $charterAssocId = $data['charterAssocIdByHeaderEdit'];
                $this->set("charterAssocIdByHeaderEdit", $charterAssocId);
            }
            
            $guestAssc = $this->CharterGuestAssociate->find('first', array('conditions' => array('id' => $charterAssocId)));
            if (isset($guestAssc['CharterGuestAssociate']['id'])) {
                $associatePrimaryid = $guestAssc['CharterGuestAssociate']['id'];
            }
            //echo "<pre>";print_r($guestAssc);exit;
            $ownerprefenceID = $this->Session->read('ownerprefenceID');
            $ownerprefenceUUID = $this->Session->read('ownerprefenceUUID');
            $selectedCharterProgramUUID = $this->Session->read('selectedCharterProgramUUID');
            if(isset($ownerprefenceUUID) && !empty($ownerprefenceUUID)){
               
                $data['guest_lists_UUID'] = $ownerprefenceUUID;
                $guest_uuid = $ownerprefenceUUID;
                $charterHeadId = $ownerprefenceID;
                $CharterGuestData = $this->CharterGuest->find('first', array('conditions' => array('id' => $ownerprefenceID)));
                $salutation = $CharterGuestData['CharterGuest']['salutation'];
                $typetext = "Guest";
                if(isset($CharterGuestData['CharterGuest']['charter_program_type']) && !empty($CharterGuestData['CharterGuest']['charter_program_type'])){
                    if($CharterGuestData['CharterGuest']['charter_program_type'] == 1){
                        $typetext = "Owner";
                    }else if($CharterGuestData['CharterGuest']['charter_program_type'] == 2){
                        $typetext = "Charterer";
                    }
                }
            }else{
               $data['guest_lists_UUID'] = $guestAssc['CharterGuestAssociate']['UUID'];
               $guest_uuid = $guestAssc['CharterGuestAssociate']['UUID'];
               $charterAssocId = $guestAssc['CharterGuestAssociate']['id'];
               $salutation = $guestAssc['CharterGuestAssociate']['salutation'];
               $typetext = "Guest";
                if(isset($guestAssc['CharterGuestAssociate']['is_head_charterer']) && !empty($guestAssc['CharterGuestAssociate']['is_head_charterer'])){
                    if($guestAssc['CharterGuestAssociate']['is_head_charterer'] == 1){
                        $typetext = "Owner";
                    }else if($guestAssc['CharterGuestAssociate']['is_head_charterer'] == 2){
                        $typetext = "Charterer";
                    }
                }
            }
            $data['charter_assoc_id'] = $charterAssocId;
            $charterGuestAssociateUUID = $data['guest_lists_UUID'];
            // Itineraries
            if (isset($data['itinerary']) && !empty($data['itinerary'])) {
                $data['itinerary'] = implode(",", $data['itinerary']);
            }else{
                // Itineraries unselected all checkboxes
                if(isset($data['itinerary_hidden'][0]) && !empty($data['itinerary_hidden'][0])){
                    $data['itinerary'] = '';
                }
            }
            // Dive licenses
            if (isset($data['dive_license']) && !empty($data['dive_license'])) {
                $data['dive_license'] = implode(",", $data['dive_license']);
            }else{
                // Dive unselected all checkboxes
                if(isset($data['dive_license_hidden'][0]) && !empty($data['dive_license_hidden'][0])){
                    $data['dive_license'] = '';
                }
            }
            
            if (isset($data['itinerary_comments']) && !empty($data['itinerary_comments'])) {
                $data['itinerary_comments'] = htmlspecialchars_decode($data['itinerary_comments']);
            }

            $data['created'] = date('Y-m-d H:i:s');
            $frompageleave = $data['frompageleave'];
            unset($data['frompageleave']);
            
            // Checks whether its CREATE or UPDATE
            if (empty($data['id'])) {
                $this->CharterGuestItineraryPreference->create();
            }
            //echo $frompageleave;
            //echo "<pre>";print_r($data);exit;
            $is_psheets_done = 0;
            if ($this->CharterGuestItineraryPreference->save($data)) {
            if(!empty($frompageleave) && $frompageleave == "submit"){      
                // Update the P-sheet status
                $updateData = array();
                if (!empty($associatePrimaryid) || $associatePrimaryid != 0) {
                    $updateData['id'] = $associatePrimaryid;
                    $updateData['is_psheets_done'] = 1;
                    $updateData['preference_UUID'] = $guest_uuid;
                    $is_psheets_done = 1;
                    $this->CharterGuestAssociate->save($updateData);
                } else {
                    $updateData['id'] = $ownerprefenceID;
                    $updateData['is_psheets_done'] = 1;
                    $updateData['preference_UUID'] = $guest_uuid;
                    $is_psheets_done = 1;
                    $this->CharterGuest->save($updateData);
                }
                $modified = date("Y-m-d H:i:s");
                $updateguest_listsQuery = "UPDATE guest_lists SET is_psheets_done='".$is_psheets_done."',modified='".$modified."',salutation='".$salutation."' WHERE UUID='$guest_uuid'";
                $this->CharterGuest->query($updateguest_listsQuery);
                
                // Updating the Charter guest's details into corresponding yacht's passanger list table
                $yDBName = $session['CharterGuest']['ydb_name'];
                // Personal details
                $created = date("Y-m-d H:i:s");
                $guestPersonalData = $this->CharterGuestPersonalDetail->find('first', array('conditions' => array('guest_lists_UUID' => $guest_uuid,'is_deleted'=>0)));
                if (!empty($guestPersonalData)) {
                    $this->loadModel('GuestList');
                    $this->loadModel('GuestGroup');
                    $guestListData = $this->GuestList->find('first', array('conditions' => array('UUID' => $guest_uuid,'is_deleted'=>0)));
                    //echo "<pre>";print_r($guestListData); exit;
                    $targetFileName = "";
                    if(isset($guestListData)){
                        $guest_type = $guestListData['GuestList']['guest_type'];
                        $guest_group_id = $guestListData['GuestList']['group_id'];
                        $guest_email = $guestListData['GuestList']['email'];
                        $guest_file_name = $guestListData['GuestList']['file_name'];
                        $guest_file_path = $guestListData['GuestList']['file_path'];
                        $guest_fleetcompany_id = $guestListData['GuestList']['fleetcompany_id'];
                        $guest_token = $guestListData['GuestList']['token'];
                        $guest_password = $guestListData['GuestList']['password'];
                        //$salutation = $guestListData['GuestList']['salutation'];
                        if($guest_file_name != ""){
                                $guest_targetFullPath = "";
                                $guest_sourceImagePath = WWW_ROOT."img/charter_program_files/".$guest_file_name;
                                $guest_targetImagePath = "crew_pages/crewfiles/passenger_docs";
                                $DOC_ROOT = $_SERVER["DOCUMENT_ROOT"];
                                // $targetFileName = date("ymdHis")."_".$fileName;
                                $guest_targetFileName = $guest_file_name;
                                
                                // echo "<pre>";print_r($guest_sourceImagePath);
                                // echo "<pre>";print_r($guest_targetImagePath);
                                // echo "<pre>";print_r($guest_targetFileName);
                                //  exit;
                                // Check the passport file is available
                                if (!empty($guest_file_name)) {
                                    $guestDetails = $this->CharterGuest->find('first', array('conditions' => array('charter_program_id' => $selectedCharterProgramUUID)));
                       
                                    $charter_company_id = $guestDetails['CharterGuest']['charter_company_id'];

                                    $this->loadModel('Fleetcompany');
                                    $companyData = $this->Fleetcompany->find('first', array('fields' => array('management_company_name','logo','fleetname'), 'conditions' => array('id' => $charter_company_id)));

                                    // Fetch the FleetCompany/Yacht path
                                    $this->loadModel('Yacht');
                                    $yachtData = $this->Yacht->find('first', array('conditions' => array('id' => $session['CharterGuest']['yacht_id'])));
                                    if (!empty($yachtData['Yacht']['fleetname'])) {
                                        $guest_sourceImagePath = $DOC_ROOT."/".$companyData['Fleetcompany']['fleetname']."/app/webroot/img/charter_program_files/".$guest_file_name;
                                        $guest_targetFullPath = $DOC_ROOT."/".$yachtData['Yacht']['fleetname']."/app/webroot/".$yachtData['Yacht']['yname']."/app/webroot/".$guest_targetImagePath;
                                    } else {
                                        $guest_sourceImagePath = $DOC_ROOT."/".$companyData['Fleetcompany']['fleetname']."/app/webroot/img/charter_program_files/".$guest_file_name;
                                        $guest_targetFullPath = $DOC_ROOT."/".$yachtData['Yacht']['yname']."/app/webroot/".$guest_targetImagePath;
                                    }
                                    // Create IF not exists
                                    if(!file_exists($guest_targetFullPath)){
                                        mkdir($guest_targetFullPath,0777,true);
                                    }

                                //     echo "<pre>";print_r($guest_sourceImagePath);
                                // echo "<pre>";print_r($guest_targetFullPath);
                                // echo "<pre>";print_r($guest_targetFileName);
                                //  exit;
                                    // Copying the image file
                                    copy($guest_sourceImagePath, $guest_targetFullPath."/".$guest_targetFileName);
                                    //echo $companyData['Fleetcompany']['fleetname'];
                                    if($companyData['Fleetcompany']['fleetname'] == 'SOS' || $companyData['Fleetcompany']['fleetname'] == 'fleetbeta'){
                                        $targetFullbetayachtPath = $DOC_ROOT."/SOS/app/webroot/betayacht/app/webroot/".$guest_targetImagePath;
                                        copy($guest_sourceImagePath,$targetFullbetayachtPath.'/'.$guest_targetFileName);
                                        $targetFullbetayachtPath = $DOC_ROOT."/SOS/app/webroot/yacht/app/webroot/".$guest_targetImagePath;
                                        copy($guest_sourceImagePath,$targetFullbetayachtPath.'/'.$guest_targetFileName);
                                        
                                    }

                                //     echo "<pre>";print_r($targetFullbetayachtPath);
                                // echo "<pre>";print_r($guest_sourceImagePath);
                                // echo "<pre>";print_r($guest_targetFileName);
                                //  exit;
                                }
                                $targetFileName = $guest_targetFileName;
                                $targetImagePath = $guest_targetImagePath;
                                //     echo "<pre>";print_r($targetFileName);
                                // echo "<pre>";print_r($targetImagePath);
                                // //echo "<pre>";print_r($guest_targetFileName);
                                //  exit;
                        }
                        $G_group_id = "";
                        if(isset($guest_group_id) && $guest_group_id != 0){
                                $G_group_id = $guest_fleetcompany_id."_".$guest_group_id;

                                $GuestGroupData = $this->GuestGroup->find('first', array('conditions' => array('id' => $guest_group_id)));
                            $group_name = $GuestGroupData['GuestGroup']['group_name'];
                                    // Checks the yacht.passenger_lists table whether charter id is already exists
                            $selectQuery = "SELECT id FROM $yDBName.passenger_groups PassengerGroup WHERE group_name='$group_name' and group_id='$G_group_id'";
                            $checkpassenger_groupsExists = $this->CharterGuest->query($selectQuery);
                            
                            if (empty($checkpassenger_groupsExists)) {

                                // Insertion
                                $insertQuery = "INSERT INTO $yDBName.passenger_groups (group_name,group_id,created) VALUES ('".$group_name."','".$G_group_id."','".$created."')";
                                $this->CharterGuest->query($insertQuery);
                            }
                               
                        }
                    }

                    $firstName = $guestPersonalData['CharterGuestPersonalDetail']['first_name'];
                    $familyName = $guestPersonalData['CharterGuestPersonalDetail']['family_name'];
                    $dob = $guestPersonalData['CharterGuestPersonalDetail']['dob'];
                    $pob = $guestPersonalData['CharterGuestPersonalDetail']['pob'];
                    $nationality = $guestPersonalData['CharterGuestPersonalDetail']['nationality'];
                    $passportNum = $guestPersonalData['CharterGuestPersonalDetail']['passport_num'];
                    $issuedDate = $guestPersonalData['CharterGuestPersonalDetail']['issued_date'];
                    $expiryDate = $guestPersonalData['CharterGuestPersonalDetail']['expiry_date'];
                    $fileName = $guestPersonalData['CharterGuestPersonalDetail']['passport_image'];
                    
                    
                    $status = 0;
                    $targetFullPath = "";
                    $sourceImagePath = WWW_ROOT."img/passport_images/".$fileName;
                    $targetImagePath = "crew_pages/crewfiles/passenger_docs";
                    $DOC_ROOT = $_SERVER["DOCUMENT_ROOT"];
                    // $targetFileName = date("ymdHis")."_".$fileName;
                    if(!empty($fileName)){
                        $targetFileName = $fileName;
                    }
                    
                    

                    // Check the passport file is available
                    if (!empty($fileName)) {
                        // Fetch the FleetCompany/Yacht path
                        $this->loadModel('Yacht');
                        $yachtData = $this->Yacht->find('first', array('conditions' => array('id' => $session['CharterGuest']['yacht_id'])));
                        if (!empty($yachtData['Yacht']['fleetname'])) {
                            $targetFullPath = $DOC_ROOT."/".$yachtData['Yacht']['fleetname']."/app/webroot/".$yachtData['Yacht']['yname']."/app/webroot/".$targetImagePath;
                        } else {
                            $targetFullPath = $DOC_ROOT."/".$yachtData['Yacht']['yname']."/app/webroot/".$targetImagePath;
                        }
                        // Create IF not exists
                        if(!file_exists($targetFullPath)){
                            mkdir($targetFullPath,0777,true);
                        }

                        // echo "<pre>"; 
                        // print($sourceImagePath); 
                        // print($targetFullPath."/".$targetFileName); exit;
                        // Copying to yacht and fleet sites
                        // Copying the image file
                        //echo $targetFileName; exit;
                        if(file_exists($sourceImagePath)){
                        copy($sourceImagePath, $targetFullPath."/".$targetFileName);
                        }
                    }

                    // Checks the yacht.passenger_lists table whether charter id is already exists
                    $selectQuery = "SELECT id FROM $yDBName.passenger_lists WHERE UUID='$guest_uuid' AND is_deleted=0";
                    $checkCharterExists = $this->CharterGuest->query($selectQuery);
                    
                    if (empty($checkCharterExists)) {
                        // Insertion
                        $insertQuery = "INSERT INTO $yDBName.passenger_lists (UUID,salutation,family_name,first_name,date_of_birth,place_of_birth,nationality,passport_number,issued_date,expiration_date,file_name,file_path,status,modified,is_psheets_done,type,group_id,email,token,password) VALUES ('".$guest_uuid."','".$salutation."','".$familyName."','".$firstName."','".$dob."','".$pob."','".$nationality."','".$passportNum."','".$issuedDate."','".$expiryDate."','".$targetFileName."','".$targetImagePath."',$status,'".$created."','".$is_psheets_done."','".$typetext."','".$G_group_id."','".$guest_email."','".$guest_token."','".$guest_password."')";
                        $this->CharterGuest->query($insertQuery);
                    } else {
                        // Updation
                        $updateQuery = "UPDATE $yDBName.passenger_lists SET is_psheets_done='".$is_psheets_done."',salutation='".$salutation."',family_name='".$familyName."',first_name='".$firstName."',date_of_birth='".$dob."',place_of_birth='".$pob."',nationality='".$nationality."',passport_number='".$passportNum."',issued_date='".$issuedDate."',expiration_date='".$expiryDate."',file_name='".$targetFileName."',file_path='".$targetImagePath."',modified='".$created."',type='".$typetext."',group_id='".$G_group_id."',email='".$guest_email."',token='".$guest_token."',password='".$guest_password."' WHERE UUID='$guest_uuid'"; 
                        $this->CharterGuest->query($updateQuery);
                    }
                    
                } else { // Sending the guest data from charter_geusts OR charter_guest_associates tables
                    
                    $firstName = '';
                    $familyName = '';
                    $status = 0;
                    $created = date("Y-m-d H:i:s");
                    
                    if (!empty($charterAssocId) || $charterAssocId != 0) { // Associate
                        $assocDetails = $this->CharterGuestAssociate->find('first', array('conditions' => array('id' => $charterAssocId)));
                        $firstName = $assocDetails['CharterGuestAssociate']['first_name'];
                        $familyName = $assocDetails['CharterGuestAssociate']['last_name'];
                        $salutation = $assocDetails['CharterGuestAssociate']['salutation'];
                        $charter_company_id = $assocDetails['CharterGuestAssociate']['fleetcompany_id'];
                        $typetext = "Guest";
                            if(isset($assocDetails['CharterGuestAssociate']['is_head_charterer']) && !empty($assocDetails['CharterGuestAssociate']['is_head_charterer'])){
                                if($assocDetails['CharterGuestAssociate']['is_head_charterer'] == 1){
                                    $typetext = "Owner";
                                }else if($assocDetails['CharterGuestAssociate']['is_head_charterer'] == 2){
                                    $typetext = "Charterer";
                                }
                            }
                    } else { // Head Charterer
                        $guestDetails = $this->CharterGuest->find('first', array('conditions' => array('charter_program_id' => $selectedCharterProgramUUID)));
                        $firstName = $guestDetails['CharterGuest']['first_name'];
                        $familyName = $guestDetails['CharterGuest']['last_name'];
                        $salutation = $guestDetails['CharterGuest']['salutation'];
                        $charter_company_id = $guestDetails['CharterGuest']['charter_company_id'];
                        $typetext = "Guest";
                            if(isset($guestDetails['CharterGuest']['charter_program_type']) && !empty($guestDetails['CharterGuest']['charter_program_type'])){
                                if($guestDetails['CharterGuest']['charter_program_type'] == 1){
                                    $typetext = "Owner";
                                }else if($guestDetails['CharterGuest']['charter_program_type'] == 2){
                                    $typetext = "Charterer";
                                }
                            }
                    }

                    $this->loadModel('GuestList');
                    $this->loadModel('GuestGroup');
                    $guestListData = $this->GuestList->find('first', array('conditions' => array('UUID' => $guest_uuid,'is_deleted'=>0)));
                    if(isset($guestListData)){
                        $guest_type = $guestListData['GuestList']['guest_type'];
                        $guest_group_id = $guestListData['GuestList']['group_id'];
                        $guest_email = $guestListData['GuestList']['email'];
                        $guest_file_name = $guestListData['GuestList']['file_name'];
                        $guest_file_path = $guestListData['GuestList']['file_path'];
                        //$salutation = $guestListData['GuestList']['salutation'];
                        $use_submitted_date = $guestListData['GuestList']['use_submitted_date'];
                        $use_submitted_preferences = $guestListData['GuestList']['use_submitted_preferences'];
                        $Gtoken = $guestListData['GuestList']['token'];
                        $Gpassword= $guestListData['GuestList']['password'];
                        $guest_targetImagePath = "";
                        $guest_targetFileName = "";
                        if($guest_file_name != ""){
                                $guest_targetFullPath = "";
                                $guest_sourceImagePath = WWW_ROOT."img/charter_program_files/".$guest_file_name;
                                $guest_targetImagePath = "crew_pages/crewfiles/passenger_docs";
                                $DOC_ROOT = $_SERVER["DOCUMENT_ROOT"];
                                // $targetFileName = date("ymdHis")."_".$fileName;
                                $guest_targetFileName = $guest_file_name;
                                

                                // Check the passport file is available
                                if (!empty($guest_file_name)) {
                                    if($charter_company_id != 0){
                                        $this->loadModel('Fleetcompany');
                                        $companyData = $this->Fleetcompany->find('first', array('fields' => array('management_company_name','logo','fleetname'), 'conditions' => array('id' => $charter_company_id)));
                                    }
                                    // Fetch the FleetCompany/Yacht path
                                    $this->loadModel('Yacht');
                                    $yachtData = $this->Yacht->find('first', array('conditions' => array('id' => $session['CharterGuest']['yacht_id'])));
                                    if (!empty($yachtData['Yacht']['fleetname'])) {
                                        $guest_sourceImagePath = $DOC_ROOT."/".$companyData['Fleetcompany']['fleetname']."/app/webroot/img/charter_program_files/".$guest_file_name;
                                        $guest_targetFullPath = $DOC_ROOT."/".$yachtData['Yacht']['fleetname']."/app/webroot/".$yachtData['Yacht']['yname']."/app/webroot/".$guest_targetImagePath;
                                    } else {
                                        $guest_sourceImagePath = $DOC_ROOT."/".$companyData['Fleetcompany']['fleetname']."/app/webroot/img/charter_program_files/".$guest_file_name;
                                        $guest_targetFullPath = $DOC_ROOT."/".$yachtData['Yacht']['yname']."/app/webroot/".$guest_targetImagePath;
                                    }
                                    // Create IF not exists
                                    if(!file_exists($guest_targetFullPath)){
                                        mkdir($guest_targetFullPath,0777,true);
                                    }

                                    // Copying the image file
                                    copy($guest_sourceImagePath, $guest_targetFullPath."/".$guest_targetFileName);
                                    if($companyData['Fleetcompany']['fleetname'] == 'SOS' || $companyData['Fleetcompany']['fleetname'] == 'fleetbeta' ){
                                        $targetFullbetayachtPath = $DOC_ROOT."/SOS/app/webroot/betayacht/app/webroot/".$guest_targetImagePath;
                                        copy($guest_sourceImagePath,$targetFullbetayachtPath.'/'.$guest_targetFileName);
                                        $targetFullbetayachtPath = $DOC_ROOT."/SOS/app/webroot/yacht/app/webroot/".$guest_targetImagePath;
                                        copy($guest_sourceImagePath,$targetFullbetayachtPath.'/'.$guest_targetFileName);
                                        
                                    }
                                }
                        }
                        if(isset($guest_group_id) && $guest_group_id != 0){
                            $G_group_id = $guest_fleetcompany_id."_".$guest_group_id;

                            $GuestGroupData = $this->GuestGroup->find('first', array('conditions' => array('id' => $guest_group_id)));
                        $group_name = $GuestGroupData['GuestGroup']['group_name'];
                                // Checks the yacht.passenger_lists table whether charter id is already exists
                        $selectQuery = "SELECT id FROM $yDBName.passenger_groups PassengerGroup WHERE group_name='$group_name' and group_id='$G_group_id'";
                        $checkpassenger_groupsExists = $this->CharterGuest->query($selectQuery);
                        
                            if (empty($checkpassenger_groupsExists)) {
                                // Insertion
                                $insertQuery = "INSERT INTO $yDBName.passenger_groups (group_name,group_id,created) VALUES ('".$group_name."','".$G_group_id."','".$created."')";
                                $this->CharterGuest->query($insertQuery);
                                
                            } 

                        }
                    }
                    // Checks the yacht.passenger_lists table whether charter id is already exists
                    $selectQuery = "SELECT id FROM $yDBName.passenger_lists WHERE UUID='$guest_uuid' AND is_deleted=0";
                    $checkCharterExists = $this->CharterGuest->query($selectQuery);
                    
                    if (empty($checkCharterExists)) {
                        // Insertion
                        $insertQuery = "INSERT INTO $yDBName.passenger_lists (UUID,salutation,family_name,first_name,status,modified,is_psheets_done,type,group_id,file_name,file_path,email,token,password) VALUES ('".$guest_uuid."','".$salutation."','".$familyName."','".$firstName."',$status,'".$created."','".$is_psheets_done."','".$typetext."','".$G_group_id."','".$guest_targetFileName."','".$guest_targetImagePath."','".$guest_email."','".$Gtoken."','".$Gpassword."')";
                        $this->CharterGuest->query($insertQuery);
                    } else {
                        // Updation
                        $updateQuery = "UPDATE $yDBName.passenger_lists SET family_name='".$familyName."',salutation='".$salutation."',first_name='".$firstName."',modified='".$created."',type='".$typetext."',group_id='".$G_group_id."',file_name='".$guest_targetFileName."',file_path='".$guest_targetImagePath."',is_psheets_done='".$is_psheets_done."',email='".$guest_email."',token='".$Gtoken."',password='".$Gpassword."' WHERE UUID='$guest_uuid'";
                        $this->CharterGuest->query($updateQuery);
                    }
                }
                
                
                // Updating all the tabs records into corresponding yacht tables
                $charterHeadProgramId = $selectedCharterProgramUUID;
                $this->sendRecordsToYacht($yDBName,$charterHeadProgramId,$charterHeadId,$charterAssocId,$guest_uuid);
            }
            }
            $personalDetailsTab = '';
            $mealPreferenceTab = '';
            $foodPreferenceTab = '';
            $beveragePreferenceTab = '';
            $spiritPreferenceTab = '';
            $winePreferenceTab = '';
            $itineraryPreferenceTab = 'active in';
            
            // For showing popup
            //$this->set("showPopup", 1);
            $this->Session->write("showPopup", 1);
           // $this->Session->write("use_submitted_date", $use_submitted_date);
            //$this->Session->write("use_submitted_preferences", $use_submitted_preferences);
            
            $sessionData = $this->Session->read();
            $this->redirect(array('action' => 'preference'.$sessionData['preferenceParam']));
            
        } else {
            $personalDetailsTab = 'active in';
            $mealPreferenceTab = '';
            $foodPreferenceTab = '';
            $beveragePreferenceTab = '';
            $spiritPreferenceTab = '';
            $winePreferenceTab = '';
            $itineraryPreferenceTab = '';
        }
        
        //echo $charterGuestAssociateUUID; exit;
        // Fetch existing Personal details and send to view
        //echo $charterGuestAssociateUUID; exit;
        //echo $charterAssocId;
        $personalDetails = $this->CharterGuestPersonalDetail->find('first', array('conditions' => array('guest_lists_UUID' => $charterGuestAssociateUUID,'is_deleted'=>0)));
        $this->set('personalDetails', $personalDetails);

       
        

        if (!empty($personalDetails)) {
            $this->request->data['CharterGuestPersonalDetail'] = $personalDetails['CharterGuestPersonalDetail'];
            $this->request->data['CharterGuestPersonalDetail']['dob'] = (!empty($personalDetails['CharterGuestPersonalDetail']['dob']) && $personalDetails['CharterGuestPersonalDetail']['dob'] != '0000-00-00') ? date_format(date_create($personalDetails['CharterGuestPersonalDetail']['dob']), 'd M Y') : '';
            $this->request->data['CharterGuestPersonalDetail']['issued_date'] = (!empty($personalDetails['CharterGuestPersonalDetail']['issued_date']) && $personalDetails['CharterGuestPersonalDetail']['issued_date'] != '0000-00-00') ? date_format(date_create($personalDetails['CharterGuestPersonalDetail']['issued_date']), 'd M Y') : '';
            $this->request->data['CharterGuestPersonalDetail']['expiry_date'] = (!empty($personalDetails['CharterGuestPersonalDetail']['expiry_date']) && $personalDetails['CharterGuestPersonalDetail']['expiry_date'] != '0000-00-00') ? date_format(date_create($personalDetails['CharterGuestPersonalDetail']['expiry_date']), 'd M Y') : '';
            $this->request->data['CharterGuestPersonalDetail']['birthday_date'] = (!empty($personalDetails['CharterGuestPersonalDetail']['birthday_date']) && $personalDetails['CharterGuestPersonalDetail']['birthday_date'] != '0000-00-00') ? date_format(date_create($personalDetails['CharterGuestPersonalDetail']['birthday_date']), 'd M Y') : '';
            $this->request->data['CharterGuestPersonalDetail']['honeymoon_date'] = (!empty($personalDetails['CharterGuestPersonalDetail']['honeymoon_date']) && $personalDetails['CharterGuestPersonalDetail']['honeymoon_date'] != '0000-00-00') ? date_format(date_create($personalDetails['CharterGuestPersonalDetail']['honeymoon_date']), 'd M Y') : '';
            $this->request->data['CharterGuestPersonalDetail']['film_festival_date'] = (!empty($personalDetails['CharterGuestPersonalDetail']['film_festival_date']) && $personalDetails['CharterGuestPersonalDetail']['film_festival_date'] != '0000-00-00') ? date_format(date_create($personalDetails['CharterGuestPersonalDetail']['film_festival_date']), 'd M Y') : '';
            $this->request->data['CharterGuestPersonalDetail']['anniversary_date'] = (!empty($personalDetails['CharterGuestPersonalDetail']['anniversary_date']) && $personalDetails['CharterGuestPersonalDetail']['anniversary_date'] != '0000-00-00') ? date_format(date_create($personalDetails['CharterGuestPersonalDetail']['anniversary_date']), 'd M Y') : '';
            $this->request->data['CharterGuestPersonalDetail']['other_occation_date'] = (!empty($personalDetails['CharterGuestPersonalDetail']['other_occation_date']) && $personalDetails['CharterGuestPersonalDetail']['other_occation_date'] != '0000-00-00') ? date_format(date_create($personalDetails['CharterGuestPersonalDetail']['other_occation_date']), 'd M Y') : '';
            $this->request->data['CharterGuestPersonalDetail']['event_date'] = (!empty($personalDetails['CharterGuestPersonalDetail']['event_date']) && $personalDetails['CharterGuestPersonalDetail']['event_date'] != '0000-00-00') ? date_format(date_create($personalDetails['CharterGuestPersonalDetail']['event_date']), 'd M Y') : '';
            //$this->request->data['CharterGuestPersonalDetail']['passport_image']['name'] = $personalDetails['CharterGuestPersonalDetail']['passport_image'];
        }
        $selectedCharterProgramUUID = $this->Session->read('selectedCharterProgramUUID');
        $CharterPerDetSplOccasion = $this->CharterGuestPersonalDetailSpecialOccasion->find('first', array('conditions' => array('guest_lists_UUID' => $charterGuestAssociateUUID,'is_deleted'=>0,'charter_program_id'=>$selectedCharterProgramUUID)));
        if (isset($CharterPerDetSplOccasion) && !empty($CharterPerDetSplOccasion)) {
            $this->request->data['CharterGuestPersonalDetail']['birthday_date'] = (!empty($CharterPerDetSplOccasion['CharterGuestPersonalDetailSpecialOccasion']['birthday_date']) && $CharterPerDetSplOccasion['CharterGuestPersonalDetailSpecialOccasion']['birthday_date'] != '0000-00-00') ? date_format(date_create($CharterPerDetSplOccasion['CharterGuestPersonalDetailSpecialOccasion']['birthday_date']), 'd M Y') : '';
            $this->request->data['CharterGuestPersonalDetail']['honeymoon_date'] = (!empty($CharterPerDetSplOccasion['CharterGuestPersonalDetailSpecialOccasion']['honeymoon_date']) && $CharterPerDetSplOccasion['CharterGuestPersonalDetailSpecialOccasion']['honeymoon_date'] != '0000-00-00') ? date_format(date_create($CharterPerDetSplOccasion['CharterGuestPersonalDetailSpecialOccasion']['honeymoon_date']), 'd M Y') : '';
            $this->request->data['CharterGuestPersonalDetail']['film_festival_date'] = (!empty($CharterPerDetSplOccasion['CharterGuestPersonalDetailSpecialOccasion']['film_festival_date']) && $CharterPerDetSplOccasion['CharterGuestPersonalDetailSpecialOccasion']['film_festival_date'] != '0000-00-00') ? date_format(date_create($CharterPerDetSplOccasion['CharterGuestPersonalDetailSpecialOccasion']['film_festival_date']), 'd M Y') : '';
            $this->request->data['CharterGuestPersonalDetail']['anniversary_date'] = (!empty($CharterPerDetSplOccasion['CharterGuestPersonalDetailSpecialOccasion']['anniversary_date']) && $CharterPerDetSplOccasion['CharterGuestPersonalDetailSpecialOccasion']['anniversary_date'] != '0000-00-00') ? date_format(date_create($CharterPerDetSplOccasion['CharterGuestPersonalDetailSpecialOccasion']['anniversary_date']), 'd M Y') : '';
            $this->request->data['CharterGuestPersonalDetail']['other_occation_date'] = (!empty($CharterPerDetSplOccasion['CharterGuestPersonalDetailSpecialOccasion']['other_occation_date']) && $CharterPerDetSplOccasion['CharterGuestPersonalDetailSpecialOccasion']['other_occation_date'] != '0000-00-00') ? date_format(date_create($CharterPerDetSplOccasion['CharterGuestPersonalDetailSpecialOccasion']['other_occation_date']), 'd M Y') : '';
            $this->request->data['CharterGuestPersonalDetail']['event_date'] = (!empty($CharterPerDetSplOccasion['CharterGuestPersonalDetailSpecialOccasion']['event_date']) && $CharterPerDetSplOccasion['CharterGuestPersonalDetailSpecialOccasion']['event_date'] != '0000-00-00') ? date_format(date_create($CharterPerDetSplOccasion['CharterGuestPersonalDetailSpecialOccasion']['event_date']), 'd M Y') : ''; 
        }else{
            $this->request->data['CharterGuestPersonalDetail']['birthday_date'] = '';
            $this->request->data['CharterGuestPersonalDetail']['honeymoon_date'] = '';
            $this->request->data['CharterGuestPersonalDetail']['film_festival_date'] = '';
            $this->request->data['CharterGuestPersonalDetail']['anniversary_date'] = '';
            $this->request->data['CharterGuestPersonalDetail']['other_occation_date'] = '';
            $this->request->data['CharterGuestPersonalDetail']['event_date'] = '';
        }
        
        
        // Fetch existing Meal preference details and send to view
        $mealPreferences = $this->CharterGuestMealPreference->find('first', array('conditions' => array('guest_lists_UUID' => $charterGuestAssociateUUID,'is_deleted'=>0)));
        $this->set('mealPreferences', $mealPreferences);
        //echo "<pre>";print_r($mealPreferences); exit;
        if (!empty($mealPreferences)) {
            $this->request->data['CharterGuestMealPreference'] = $mealPreferences['CharterGuestMealPreference'];
            $this->request->data['CharterGuestMealPreference']['restaurant_date1'] = (!empty($mealPreferences['CharterGuestMealPreference']['restaurant_date1']) && $mealPreferences['CharterGuestMealPreference']['restaurant_date1'] != '0000-00-00') ? date_format(date_create($mealPreferences['CharterGuestMealPreference']['restaurant_date1']), 'd M Y') : '';
            $this->request->data['CharterGuestMealPreference']['restaurant_date2'] = (!empty($mealPreferences['CharterGuestMealPreference']['restaurant_date2']) && $mealPreferences['CharterGuestMealPreference']['restaurant_date2'] != '0000-00-00') ? date_format(date_create($mealPreferences['CharterGuestMealPreference']['restaurant_date2']), 'd M Y') : '';
            $this->request->data['CharterGuestMealPreference']['restaurant_date3'] = (!empty($mealPreferences['CharterGuestMealPreference']['restaurant_date3']) && $mealPreferences['CharterGuestMealPreference']['restaurant_date3'] != '0000-00-00') ? date_format(date_create($mealPreferences['CharterGuestMealPreference']['restaurant_date3']), 'd M Y') : '';
        }
        
        //$this->loadModel('CharterGuestMealPreferenceRestaurant');
        $CharterGuestMealPreResrant = $this->CharterGuestMealPreferenceRestaurant->find('first', array('conditions' => array('guest_lists_UUID' => $charterGuestAssociateUUID,'is_deleted'=>0,'charter_program_id'=>$selectedCharterProgramUUID)));
        $this->set('CharterGuestMealPreResrant', $CharterGuestMealPreResrant);
        //echo "<pre>";print_r($CharterGuestMealPreResrant); exit;
        if (isset($CharterGuestMealPreResrant) && !empty($CharterGuestMealPreResrant)) {
            $this->request->data['CharterGuestMealPreference']['restaurant_date1'] = (!empty($CharterGuestMealPreResrant['CharterGuestMealPreferenceRestaurant']['restaurant_date1']) && $CharterGuestMealPreResrant['CharterGuestMealPreferenceRestaurant']['restaurant_date1'] != '0000-00-00') ? date_format(date_create($CharterGuestMealPreResrant['CharterGuestMealPreferenceRestaurant']['restaurant_date1']), 'd M Y') : '';
            $this->request->data['CharterGuestMealPreference']['restaurant_date2'] = (!empty($CharterGuestMealPreResrant['CharterGuestMealPreferenceRestaurant']['restaurant_date2']) && $CharterGuestMealPreResrant['CharterGuestMealPreferenceRestaurant']['restaurant_date2'] != '0000-00-00') ? date_format(date_create($CharterGuestMealPreResrant['CharterGuestMealPreferenceRestaurant']['restaurant_date2']), 'd M Y') : '';
            $this->request->data['CharterGuestMealPreference']['restaurant_date3'] = (!empty($CharterGuestMealPreResrant['CharterGuestMealPreferenceRestaurant']['restaurant_date3']) && $CharterGuestMealPreResrant['CharterGuestMealPreferenceRestaurant']['restaurant_date3'] != '0000-00-00') ? date_format(date_create($CharterGuestMealPreResrant['CharterGuestMealPreferenceRestaurant']['restaurant_date3']), 'd M Y') : '';
            $this->request->data['CharterGuestMealPreference']['restaurant1'] = $CharterGuestMealPreResrant['CharterGuestMealPreferenceRestaurant']['restaurant1'];
            $this->request->data['CharterGuestMealPreference']['restaurant2'] = $CharterGuestMealPreResrant['CharterGuestMealPreferenceRestaurant']['restaurant2'];
            $this->request->data['CharterGuestMealPreference']['restaurant3'] = $CharterGuestMealPreResrant['CharterGuestMealPreferenceRestaurant']['restaurant3'];
            $this->request->data['CharterGuestMealPreference']['restaurant_time1'] = $CharterGuestMealPreResrant['CharterGuestMealPreferenceRestaurant']['restaurant_time1'];
            $this->request->data['CharterGuestMealPreference']['restaurant_time2'] = $CharterGuestMealPreResrant['CharterGuestMealPreferenceRestaurant']['restaurant_time2'];
            $this->request->data['CharterGuestMealPreference']['restaurant_time3'] = $CharterGuestMealPreResrant['CharterGuestMealPreferenceRestaurant']['restaurant_time3'];
        }else{
            $this->request->data['CharterGuestMealPreference']['restaurant_date1'] = '';
            $this->request->data['CharterGuestMealPreference']['restaurant_date2'] = '';
            $this->request->data['CharterGuestMealPreference']['restaurant_date3'] = '';
            $this->request->data['CharterGuestMealPreference']['restaurant1'] = '';
            $this->request->data['CharterGuestMealPreference']['restaurant2'] = '';
            $this->request->data['CharterGuestMealPreference']['restaurant3'] = '';
            $this->request->data['CharterGuestMealPreference']['restaurant_time1'] = '';
            $this->request->data['CharterGuestMealPreference']['restaurant_time2'] = '';
            $this->request->data['CharterGuestMealPreference']['restaurant_time3'] = '';
        }
        
        // Fetch existing Food preference details and send to view
        $foodPreferences = $this->CharterGuestFoodPreference->find('first', array('conditions' => array('guest_lists_UUID' => $charterGuestAssociateUUID,'is_deleted'=>0)));
        $this->set('foodPreferences', $foodPreferences);
        if (!empty($foodPreferences)) {
            $this->request->data['CharterGuestFoodPreference'] = $foodPreferences['CharterGuestFoodPreference'];
        }
        
        // Fetch existing Itinerary preference details and send to view
        $itineraryPreferences = $this->CharterGuestItineraryPreference->find('first', array('conditions' => array('guest_lists_UUID' => $charterGuestAssociateUUID,'is_deleted'=>0)));
        $this->set('itineraryPreferences', $itineraryPreferences);
        if (!empty($itineraryPreferences)) {
            $this->request->data['CharterGuestItineraryPreference'] = $itineraryPreferences['CharterGuestItineraryPreference'];
        }
        
        // Fetch existing Beverage preference details and send to view
        $beveragePreferences = $this->CharterGuestBeveragePreference->find('first', array('conditions' => array('guest_lists_UUID' => $charterGuestAssociateUUID,'is_deleted'=>0)));
        $this->set('beveragePreferences', $beveragePreferences);
        if (!empty($beveragePreferences)) {
            $this->request->data['CharterGuestBeveragePreference'] = $beveragePreferences['CharterGuestBeveragePreference'];
        }
        
        /*
        // Fetch existing Beverage types
        $beverageTypes = $this->CharterGuestBeverageType->find('list', array('fields' => array('id','type'), 'conditions' => array('is_deleted' => 0)));
        $this->set('beverageTypes', $beverageTypes);
        $beverageItemList = array();
        $alcoholicTypesEmptyAssoc = array();
        foreach($beverageTypes as $key => $value) {
            $alcoholicTypesEmptyAssoc[$key] = ' ';
            // Fetch Beverage items
            $beverageItems = $this->CharterGuestBeverageItem->find('all', array('conditions' => array('is_deleted' => 0, 'type_id' => $key), 'order' => 'item_name ASC'));
            if (!empty($beverageItems)) {
                $i = 0;
                foreach ($beverageItems as $item) {
                    $beverageItemList[$key][$i]['id'] = $item['CharterGuestBeverageItem']['id'];
                    $beverageItemList[$key][$i]['item_name'] = $item['CharterGuestBeverageItem']['item_name'];
                    $i++;
                }
            } else {
                $beverageItemList[$key] = array();
            }
        }
        $this->set('beverageItems', $beverageItemList);
        $this->set('alcoholicTypesEmptyAssoc', $alcoholicTypesEmptyAssoc);
        */
        
        // Wine Preference details
        // Read-only when Head charterer opens associator's preference
        $headChartererView = $this->Session->read('charterAssocIdByHeaderView');
        if (isset($headChartererView)) {
            //echo "aaaa"; exit;
            /* Wine Preference */
            $selectedCharterProgramUUID = $this->Session->read('selectedCharterProgramUUID');
            $prefConditions = array('is_deleted' => 0, 'guest_lists_UUID' => $charterGuestAssociateUUID,'charter_program_id'=>$selectedCharterProgramUUID);
            // Fetch the existing Wine Preferences
            $winePreferences = $this->CharterGuestWinePreference->find('all', array('conditions' => $prefConditions));
            // Color list
            $this->CharterGuestWinePreference->virtualFields['color_quantity_sum'] = 'SUM(CharterGuestWinePreference.quantity)';
            $colorCountList = $this->CharterGuestWinePreference->find('list', array('fields' => array('color','color_quantity_sum'), 'conditions' => $prefConditions, 'group' => array('color')));
            $totalQuantitySum = $this->CharterGuestWinePreference->find('first', array('fields' => array('color_quantity_sum'), 'conditions' => $prefConditions));
            $this->CharterGuestWinePreference->virtualFields = array();
            $totalQuantity = isset($totalQuantitySum['CharterGuestWinePreference']['color_quantity_sum']) ? $totalQuantitySum['CharterGuestWinePreference']['color_quantity_sum'] : 0;
            
            $this->set('winePreferences', $winePreferences);
            $this->set('colorCountList', $colorCountList);
            $this->set('totalQuantity', $totalQuantity);
            
            /* Spirit Preferences */
            // Fetch the existing Spirit Preferences
            $spiritPreferences = $this->CharterGuestSpiritPreference->find('all', array('conditions' => $prefConditions));
            // Type list
            $this->CharterGuestSpiritPreference->virtualFields['type_quantity_sum'] = 'SUM(CharterGuestSpiritPreference.quantity)';
            $typeCountList = $this->CharterGuestSpiritPreference->find('list', array('fields' => array('primary_category','type_quantity_sum'), 'conditions' => $prefConditions, 'group' => array('primary_category')));
            $totalProductQuantitySum = $this->CharterGuestSpiritPreference->find('first', array('fields' => array('type_quantity_sum'), 'conditions' => $prefConditions));
            $this->CharterGuestSpiritPreference->virtualFields = array();
            $totalProductQuantity = isset($totalProductQuantitySum['CharterGuestSpiritPreference']['type_quantity_sum']) ? $totalProductQuantitySum['CharterGuestSpiritPreference']['type_quantity_sum'] : 0;

            $this->set('spiritPreferences', $spiritPreferences);
            $this->set('typeCountList', $typeCountList);
            $this->set('totalProductQuantity', $totalProductQuantity);
            
        } else { // Editable view
        //echo "gggg"; exit;
            /* Wine Preference */
            // Get the Wine list
            $wineList = $this->fetchWineList(); // Fetch wine list by filters
            $selectedWineList = $this->selectedWineList(); // Fetch wine list from Cart
            $conditions = array('id' => array_values($selectedWineList));
            $selectionCartData = $this->WineList->find('all', array('conditions' => $conditions));
            // Get the dropdown items for Wine Preference
            $countryList = $this->WineList->find('list', array('fields' => array('country','country'), 'conditions' => array('country IS NOT NULL', 'country' <> ""), 'group' => array('country')));
            $regionList = $this->WineListRegion->find('list', array('fields' => array('region','region'), 'conditions' => array('region IS NOT NULL', 'region' <> ""), 'group' => array('region')));
            $appellationList = $this->WineList->find('list', array('fields' => array('appellation','appellation'), 'conditions' => array('appellation IS NOT NULL', 'appellation' <> ""), 'group' => array('appellation')));
            $colorList = $this->WineList->find('list', array('fields' => array('color','color'), 'conditions' => array('color IS NOT NULL', 'color' <> ""), 'group' => array('color')));
            $wineTypeList = $this->WineList->find('list', array('fields' => array('wine_type','wine_type'), 'conditions' => array('wine_type IS NOT NULL', 'wine_type' <> ""), 'group' => array('wine_type')));
            $vintageList = $this->WineList->find('list', array('fields' => array('vintage','vintage'), 'conditions' => array('vintage IS NOT NULL', 'vintage' <> ""), 'group' => array('vintage')));
            
            $this->set('wineList', $wineList);
            $this->set('selectedWineList', $selectedWineList);
            $this->set('selectionCartData', $selectionCartData);
            $this->set('paginationPanel', 'wineListDiv');
            $this->set('filterData', array());
            $this->set('countryList', $countryList);
            $this->set('regionList', $regionList);
            $this->set('appellationList', $appellationList);
            $this->set('colorList', $colorList);
            $this->set('wineTypeList', $wineTypeList);
            $this->set('vintageList', $vintageList);
            
            /* Spirit Preference */
            $productList = $this->fetchProductList();// Fetch product list by filters
            $selectedProductList = $this->selectedProductList(); // Fetch wine list from Cart
            // Get the dropdown items for Wine Preference
            $countryList = $this->ProductList->find('list', array('fields' => array('origin','origin'), 'conditions' => array('origin IS NOT NULL', 'origin' <> ""), 'group' => array('origin')));
            $typeList = $this->ProductList->find('list', array('fields' => array('primary_category','primary_category'), 'conditions' => array('primary_category IS NOT NULL', 'primary_category' <> "", 'primary_category <>' => array("Accessories and Non-Alcohol Items", "Wine", "Non-Alc")), 'group' => array('primary_category')));
            $categoryList = $this->ProductList->find('list', array('fields' => array('secondary_category','secondary_category'), 'conditions' => array('secondary_category IS NOT NULL', 'secondary_category' <> ""), 'group' => array('secondary_category')));
            $styleList = $this->ProductList->find('list', array('fields' => array('tertiary_category','tertiary_category'), 'conditions' => array('tertiary_category IS NOT NULL', 'tertiary_category' <> ""), 'group' => array('tertiary_category')));
            //echo "<pre>"; print_r($typeList); exit;
            $this->set('productList', $productList);
            $this->set('selectedProductList', $selectedProductList);
            $this->set('productPaginationPanel', 'productListDiv');
            $this->set('productFilterData', array());
            $this->set('countryList', $countryList);
            $this->set('typeList', $typeList);
            $this->set('categoryList', $categoryList);
            $this->set('styleList', $styleList);
        }
                      
        
        // Active/Inactive tabs
        $this->set('personalDetailsTab', $personalDetailsTab);
        $this->set('mealPreferenceTab', $mealPreferenceTab);
        $this->set('foodPreferenceTab', $foodPreferenceTab);
        $this->set('beveragePreferenceTab', $beveragePreferenceTab);
        $this->set('spiritPreferenceTab', $spiritPreferenceTab);
        $this->set('winePreferenceTab', $winePreferenceTab);
        $this->set('itineraryPreferenceTab', $itineraryPreferenceTab);
        
        // Charter guest and assoc id from Session
        $this->set('charterHeadId', $charterHeadId);
        $this->set('charterAssocId', $charterAssocId);
        
        $mapdetails = array();
        $ydb_name = $session['CharterGuest']['ydb_name'];
        $charter_from_date = date("d M Y", strtotime($session['CharterGuest']['charter_from_date']));
        //echo "<pre>";print_r($guestAssocData);exit;
        if(isset($guestAssocData['CharterGuest']['charter_from_date']) && !empty($guestAssocData['CharterGuest']['charter_from_date'])){
            $charter_from_date = date("d M Y", strtotime($guestAssocData['CharterGuest']['charter_from_date']));
        }
        $this->loadModel('CharterProgramFile');
        $scheduleData = $this->CharterProgramFile->query("SELECT * FROM $ydb_name.charter_program_schedules CharterProgramSchedule WHERE charter_program_id = '$charterHeadProgramId' AND is_deleted = 0");
        // echo "<pre>";print_r($scheduleData);exit;
        
        if(isset($scheduleData) && !empty($scheduleData)){
            if(($scheduleData[0]['CharterProgramSchedule']['publish_map'] == 1)){
                $map = array();
                $map['dbname'] = $ydb_name;
                $map['programid'] = $charterHeadProgramId;
                $mapdetails[$charter_from_date] = $map;
            }
        }
        $this->set('mapdetails', $mapdetails);

        $this->set('ydb_name', $ydb_name);
        $this->set('charterHeadProgramId', $charterHeadProgramId);

        $programFiles  = array();
        // $this->Session->read('selectedCharterProgramUUID')
        // charterHeadProgramId
        $programFilesCond = array('CharterProgramFile.charter_program_id' => $this->Session->read('selectedCharterProgramUUID'),'CharterProgramFile.yacht_id' => $session['CharterGuest']['yacht_id'],'CharterProgramFile.is_deleted'=>0);
        $programFiledata = $this->CharterProgramFile->find('all', array('conditions' => $programFilesCond));

        if(isset($programFiledata)){
            $programFiles[$charter_from_date]['attachment'] = $programFiledata;
        }

        $fleetname = $this->Session->read('fleetname');
        $attachment = array();
        if(isset($programFiles) ){
            $YachtData = $this->CharterProgramFile->query("SELECT * FROM $ydb_name.yachts Yacht");
            if(isset($YachtData[0]['Yacht']['domain_name'])){
            $domain_name = $YachtData[0]['Yacht']['domain_name'];
            }
            if(isset($domain_name) && $domain_name == "charterguest"){
                $SITE_URL = "https://charterguest.net/";
            }else{
                $SITE_URL = "https://totalsuperyacht.com:8080/";
            }
            foreach($programFiles as $startdate => $filedata){ 
                foreach($filedata['attachment'] as $file){ 
                    $sourceImagePath = $SITE_URL.'/'.$fleetname."/app/webroot/img/charter_program_files/".$file['CharterProgramFile']['file_name'];
                    $attachment[$startdate] = $sourceImagePath;
                } 
            } 
        }
        $this->set('programFiles', $attachment);
        // echo "<pre>";print_r($programFilesCond);
        // echo "<pre>";print_r($attachment);exit;
    }

    function use_submitted_date(){
        //echo '<pre>'; print_r($this->params); exit;
      
           $this->loadModel('GuestList');
            $data = $this->GuestList->find('first', array('conditions' => array('UUID' => $this->params->pass[0],'is_deleted'=>0)));
                    
       
           return $data;
    }


    function fleet_company_button_color(){
        //echo '<pre>'; print_r($this->params); //exit;
        $this->loadModel('CharterGuest');
        $guestDetails = $this->CharterGuest->find('first', array('conditions' => array('charter_program_id' => $this->params->pass[0])));
                       
        $charter_company_id = $guestDetails['CharterGuest']['charter_company_id'];

            $this->loadModel('Fleetcompany');
            $companyData = $this->Fleetcompany->find('first', array('conditions' => array('id' => $charter_company_id)));
            //echo '<pre>'; print_r($companyData); exit;
           return $companyData;
    }

    function existingCheckFunction(){

        // echo "<pre>";print_r($personalDetails); //exit;
        // display modal for preference to use existing or create new only to not submitted records.
            if($this->request->is('ajax')){
                $this->layout = 'ajax';
                $this->autoRender = false;
                $sessionData = $this->Session->read();
                $data = $this->request->data;
                //echo "<pre>";print_r($data); exit;

                //$openButtonLink = "/charters/preference?assocId=". base64_encode($data['CharterGuestAssociate']['id']);
                $this->loadModel('CharterGuestAssociate');
                $this->loadModel('CharterGuest');
                $this->loadModel('CharterGuestPersonalDetail');
                $result = array();
                //$selectedCharterProgramUUID = $sessionData['selectedCharterProgramUUID'];
                if(isset($data['guestType']) && $data['guestType'] == "guest"){
                   
                    if(isset($data['associd']) && !empty($data['associd'])){
                        $existdata = $this->CharterGuestAssociate->find('first',array('conditions'=>array('CharterGuestAssociate.id'=>$data['associd'])));
                        //echo "<pre>";print_r($existdata); //exit;
                        $this->Session->delete("preferenceGuestName");
                        $preferenceGuestName = $existdata['CharterGuestAssociate']['first_name'].' '.$existdata['CharterGuestAssociate']['last_name'];
                        $this->Session->write("preferenceGuestName",$preferenceGuestName);
                        $personalDetails = $this->CharterGuestPersonalDetail->find('first', array('conditions' => array('guest_lists_UUID' => $existdata['CharterGuestAssociate']['UUID'],'is_deleted'=>0)));
                        //echo "<pre>"; print_r($personalDetails); exit;
                        if(($existdata['CharterGuestAssociate']['is_psheets_done'] == 1 && !empty($personalDetails['CharterGuestPersonalDetail']['dob'])) || ((empty($existdata['CharterGuestAssociate']['is_psheets_done']) || $existdata['CharterGuestAssociate']['is_psheets_done'] == 0) && !empty($personalDetails['CharterGuestPersonalDetail']['dob']))){
                            
                            
                            $result['status'] = "success";
                            $result['preferenceExistFirstName'] = $existdata['CharterGuestAssociate']['first_name'];
                            $result['preferenceExistLastName']  = $existdata['CharterGuestAssociate']['last_name'];
                            $result['preferenceExistGuestUUID'] = $existdata['CharterGuestAssociate']['UUID'];
                            $result['preferenceExistGuestID'] = $existdata['CharterGuestAssociate']['id'];
                            $result['guestType'] = "guest";
                        }else{
                    
                            $result['status'] = "fail";
                            $openButtonLink = "/charters/preference?assocId=". base64_encode($existdata['CharterGuestAssociate']['id']);

                            // // Enabling the button and will be editable pages If Head Charterer is checked
                            // if (isset($existdata['CharterGuestAssociate']['is_head_charterer']) && $existdata['CharterGuestAssociate']['is_head_charterer'] !=1) {
                            //     $openButtonLink = "/charters/preference?assocId=". base64_encode($existdata['CharterGuestAssociate']['id']);
                                
                            // }
                            // if (isset($existdata['CharterGuestAssociate']['is_email_sent']) && $existdata['CharterGuestAssociate']['is_email_sent'] ==1) {
                            //     $openButtonLink = "/charters/preference?assocId=". base64_encode($existdata['CharterGuestAssociate']['id']); 
                            // }
                            //     // Enabling the button and will be read-only pages If P-sheets done
                            // if (isset($existdata['CharterGuestAssociate']['is_psheets_done']) && $existdata['CharterGuestAssociate']['is_psheets_done'] == 1) {
                            //     $openButtonLink = "/charters/preference?assocId=". base64_encode($existdata['CharterGuestAssociate']['id']);
                            // }
                                                
                            $result['redirectUrl'] = $openButtonLink;                
                        
                        }
                    
                    }
                }else if(isset($data['guestType']) && $data['guestType'] == "owner"){
                    $this->Session->delete("preferenceGuestName");
                    if(isset($data['associd']) && !empty($data['associd'])){
                        $CharterGuestexistdata = $this->CharterGuest->find('first',array('conditions'=>array('CharterGuest.id'=>$data['associd'])));
                        
                        $personalDetails = $this->CharterGuestPersonalDetail->find('first', array('conditions' => array('guest_lists_UUID' => $CharterGuestexistdata['CharterGuest']['users_UUID'],'is_deleted'=>0)));

                        if(($CharterGuestexistdata['CharterGuest']['is_psheets_done'] == 1 && !empty($personalDetails['CharterGuestPersonalDetail']['dob'])) || ((empty($CharterGuestexistdata['CharterGuest']['is_psheets_done']) || $CharterGuestexistdata['CharterGuest']['is_psheets_done'] == 0) && !empty($personalDetails['CharterGuestPersonalDetail']['dob']))){ 
                                
                                $result['status'] = "success";
                                $result['preferenceExistFirstName'] = $CharterGuestexistdata['CharterGuest']['first_name'];
                                $result['preferenceExistLastName']  = $CharterGuestexistdata['CharterGuest']['last_name'];
                                $result['preferenceExistGuestUUID'] = $CharterGuestexistdata['CharterGuest']['users_UUID'];
                                $result['preferenceExistGuestID'] = $CharterGuestexistdata['CharterGuest']['id'];
                                $result['guestType'] = "owner";
                            }else{
                        
                                $result['status'] = "fail";
                               
                                $openButtonLink = "/charters/preference?CharterGuestId=". base64_encode($CharterGuestexistdata['CharterGuest']['id']);

                                $result['redirectUrl'] = $openButtonLink;         
                            
                            }
                        
                    }
                }
                //echo "<pre>";print_r($result); exit;
                echo json_encode($result);
                exit;

            }
    }
    

    function checkPersonalDetails() {
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $this->loadModel('CharterGuestPersonalDetail');
            $this->loadModel('CharterGuestAssociate');
            $this->loadModel('CharterGuest');
            $filterData = $this->request->data;
            //echo "<pre>"; print_r($filterData); exit;
            $dob = date('Y-m-d',strtotime($filterData['dob']));
            $personalDetails = $this->CharterGuestPersonalDetail->find('first', array('conditions' => array('guest_lists_UUID' => $filterData['guest_list'],'dob'=>$dob,'is_deleted'=>0)));
            //echo "<pre>"; print_r($personalDetails); exit;
            if(isset($personalDetails) && !empty($personalDetails)){
                
                if($filterData['gtype'] == "guest"){
                    if(isset($filterData['associd']) && !empty($filterData['associd'])){
                        $existdata = $this->CharterGuestAssociate->find('first',array('conditions'=>array('CharterGuestAssociate.UUID'=>$filterData['guest_list'],'CharterGuestAssociate.id'=>$filterData['associd'])));
                        if(isset($existdata)){
                            $updateData = array();
                            $updateData['id'] = $existdata['CharterGuestAssociate']['id'];
                            $updateData['preference_UUID'] = $filterData['guest_list'];
                            $this->CharterGuestAssociate->save($updateData);

                            $openButtonLink = "/charters/preference?assocId=". base64_encode($existdata['CharterGuestAssociate']['id']);
                            // // Enabling the button and will be editable pages If Head Charterer is checked
                            // if (isset($existdata['CharterGuestAssociate']['is_head_charterer']) && $existdata['CharterGuestAssociate']['is_head_charterer'] !=1) {
                            //     $openButtonLink = "/charters/preference?assocId=". base64_encode($existdata['CharterGuestAssociate']['id']);
                                
                            // }
                            // if (isset($existdata['CharterGuestAssociate']['is_email_sent']) && $existdata['CharterGuestAssociate']['is_email_sent'] ==1) {
                            //     $openButtonLink = "/charters/preference?assocId=". base64_encode($existdata['CharterGuestAssociate']['id']); 
                            // }
                            //     // Enabling the button and will be read-only pages If P-sheets done
                            // if (isset($existdata['CharterGuestAssociate']['is_psheets_done']) && $existdata['CharterGuestAssociate']['is_psheets_done'] == 1) {
                            //     $openButtonLink = "/charters/preference?assocId=". base64_encode($existdata['CharterGuestAssociate']['id']);
                            // }
                           if(isset($existdata['CharterGuestAssociate']['fleetcompany_id']) && !empty($existdata['CharterGuestAssociate']['fleetcompany_id']) && $existdata['CharterGuestAssociate']['fleetcompany_id'] != 0){               
                            $fleetLogoUrl = $this->getFleetLogoUrl($existdata['CharterGuestAssociate']['fleetcompany_id']);
                            $this->Session->write("fleetLogoUrl", $fleetLogoUrl);
                           }
                            $result['redirectUrl'] = $openButtonLink;      
                        }
                    }
                }elseif($filterData['gtype'] == "owner"){
                
                    if(isset($filterData['associd']) && !empty($filterData['associd'])){
                        $CharterGuestexistdata = $this->CharterGuest->find('first',array('conditions'=>array('CharterGuest.users_UUID'=>$filterData['guest_list'],'CharterGuest.id'=>$filterData['associd'])));
                        if(isset($CharterGuestexistdata)){
                            if(isset($CharterGuestexistdata['CharterGuest']['charter_company_id']) && !empty($CharterGuestexistdata['CharterGuest']['charter_company_id']) && $CharterGuestexistdata['CharterGuest']['charter_company_id'] != 0){     
                            $fleetLogoUrl = $this->getFleetLogoUrl($CharterGuestexistdata['CharterGuest']['charter_company_id']);
                            $this->Session->write("fleetLogoUrl", $fleetLogoUrl);
                            }
                            $updateData = array();
                            $updateData['id'] = $CharterGuestexistdata['CharterGuest']['id'];
                            $updateData['preference_UUID'] = $filterData['guest_list'];
                            $this->CharterGuest->save($updateData);

                            $openButtonLink = "/charters/preference?CharterGuestId=". base64_encode($CharterGuestexistdata['CharterGuest']['id']);

                            $result['redirectUrl'] = $openButtonLink; 
                        }
                    }
                }
                        
                $result['status'] = "success";
            }else{
                $result['status'] = "fail";
            }
            echo json_encode($result);
            exit;
        }

    }

    function createNewPreference(){

        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $this->loadModel('CharterGuestPersonalDetail');
            $this->loadModel('CharterGuest');
            $filterData = $this->request->data;
            //echo "<pre>"; print_r($filterData); exit;

            $this->loadModel('CharterGuestPersonalDetail');
            $this->loadModel('CharterGuestMealPreference');
            $this->loadModel('CharterGuestFoodPreference');
            $this->loadModel('CharterGuestSpiritPreference');
            $this->loadModel('CharterGuestItineraryPreference');
            $this->loadModel('CharterGuestBeveragePreference');
            //$this->loadModel('CharterGuestBeverageType');
            //$this->loadModel('CharterGuestBeverageItem');
            $this->loadModel('CharterGuestWinePreference');
            // $this->loadModel('WineList');
            // $this->loadModel('TempWineListSelection');
            // $this->loadModel('WineListRegion');
            // $this->loadModel('ProductList');
            // $this->loadModel('TempProductListSelection');
            
            $yDBName = $this->Session->read('charter_info.CharterGuest.ydb_name');
            $guuid = $filterData['guest_list'];
            $assid = $filterData['assid'];
                // Personal details
                $guestPersonalData = $this->CharterGuestPersonalDetail->find('first', array('conditions' => array('guest_lists_UUID' => $guuid,'is_deleted'=>0)));
                if (!empty($guestPersonalData)) {

                    $CharterGuestPersonalDetail = array('CharterGuestPersonalDetail.is_deleted'=>1);
                    $this->CharterGuestPersonalDetail->updateAll($CharterGuestPersonalDetail,array('CharterGuestPersonalDetail.guest_lists_UUID' =>$guuid));
                    $checkpersonalExists = $this->CharterGuest->query("SELECT id FROM $yDBName.charter_guest_personal_details WHERE guest_lists_UUID='$guuid' AND is_deleted=0");
                    if(!empty($checkpersonalExists)){
                         $this->CharterGuest->query("UPDATE $yDBName.charter_guest_personal_details SET is_deleted=1 WHERE guest_lists_UUID='$guuid'");
                    }
                }
                $guestMealData = $this->CharterGuestMealPreference->find('first', array('conditions' => array('guest_lists_UUID' => $guuid,'is_deleted'=>0)));
                if (!empty($guestMealData)) {

                    $CharterGuestMealPreference = array('CharterGuestMealPreference.is_deleted'=>1);
                    $this->CharterGuestMealPreference->updateAll($CharterGuestMealPreference,array('CharterGuestMealPreference.guest_lists_UUID' =>$guuid));
                    
                    $checkmealExists = $this->CharterGuest->query("SELECT id FROM $yDBName.charter_guest_meal_preferences WHERE guest_lists_UUID='$guuid' AND is_deleted=0");
                    if(!empty($checkmealExists)){
                        $this->CharterGuest->query("UPDATE $yDBName.charter_guest_meal_preferences SET is_deleted=1 WHERE guest_lists_UUID='$guuid'");
                    }
                }
                $guestFoodData = $this->CharterGuestFoodPreference->find('first', array('conditions' => array('guest_lists_UUID' => $guuid,'is_deleted'=>0)));
                if (!empty($guestFoodData)) {
                    $CharterGuestFoodPreference = array('CharterGuestFoodPreference.is_deleted'=>1);
                    $this->CharterGuestFoodPreference->updateAll($CharterGuestFoodPreference,array('CharterGuestFoodPreference.guest_lists_UUID' =>$guuid));
                    
                    $checkfoodExists = $this->CharterGuest->query("SELECT id FROM $yDBName.charter_guest_food_preferences WHERE guest_lists_UUID='$guuid' AND is_deleted=0");
                    if(!empty($checkfoodExists)){
                        $this->CharterGuest->query("UPDATE $yDBName.charter_guest_food_preferences SET is_deleted=1 WHERE guest_lists_UUID='$guuid'");
                    }
                }
                $guestSpiritData = $this->CharterGuestSpiritPreference->find('first', array('conditions' => array('guest_lists_UUID' => $guuid,'is_deleted'=>0)));
                if (!empty($guestSpiritData)) {
                    $CharterGuestSpiritPreference = array('CharterGuestSpiritPreference.is_deleted'=>1);
                    $this->CharterGuestSpiritPreference->updateAll($CharterGuestSpiritPreference,array('CharterGuestSpiritPreference.guest_lists_UUID' =>$guuid));
                
                    $checkspiritExists = $this->CharterGuest->query("SELECT id FROM $yDBName.charter_guest_spirit_preferences WHERE guest_lists_UUID='$guuid' AND is_deleted=0");
                    if(!empty($checkspiritExists)){
                        $this->CharterGuest->query("UPDATE $yDBName.charter_guest_spirit_preferences SET is_deleted=1 WHERE guest_lists_UUID='$guuid'");
                    }
                }
                $guestItineraryData = $this->CharterGuestItineraryPreference->find('first', array('conditions' => array('guest_lists_UUID' => $guuid,'is_deleted'=>0)));
                if (!empty($guestItineraryData)) {
                    $CharterGuestItineraryPreference = array('CharterGuestItineraryPreference.is_deleted'=>1);
                    $this->CharterGuestItineraryPreference->updateAll($CharterGuestItineraryPreference,array('CharterGuestItineraryPreference.guest_lists_UUID' =>$guuid));
                    
                    $checkitineraryExists = $this->CharterGuest->query("SELECT id FROM $yDBName.charter_guest_itinerary_preferences WHERE guest_lists_UUID='$guuid' AND is_deleted=0");
                    if(!empty($checkitineraryExists)){
                        $this->CharterGuest->query("UPDATE $yDBName.charter_guest_itinerary_preferences SET is_deleted=1 WHERE guest_lists_UUID='$guuid'");
                    }
               
                }
                $guestBeverageData = $this->CharterGuestBeveragePreference->find('first', array('conditions' => array('guest_lists_UUID' => $guuid,'is_deleted'=>0)));
                if (!empty($guestBeverageData)) {
                    $CharterGuestBeveragePreference = array('CharterGuestBeveragePreference.is_deleted'=>1);
                    $this->CharterGuestBeveragePreference->updateAll($CharterGuestBeveragePreference,array('CharterGuestBeveragePreference.guest_lists_UUID' =>$guuid));
                    
                    $checkBevergeExists = $this->CharterGuest->query("SELECT id FROM $yDBName.charter_guest_beverage_preferences WHERE guest_lists_UUID='$guuid' AND is_deleted=0");
                    if(!empty($checkBevergeExists)){
                        $this->CharterGuest->query("UPDATE $yDBName.charter_guest_beverage_preferences SET is_deleted=1 WHERE guest_lists_UUID='$guuid'");
                    }
                }
                $guestWineData = $this->CharterGuestWinePreference->find('first', array('conditions' => array('guest_lists_UUID' => $guuid,'is_deleted'=>0)));
                if (!empty($guestWineData)) {
                    $CharterGuestWinePreference = array('CharterGuestWinePreference.is_deleted'=>1);
                    $this->CharterGuestWinePreference->updateAll($CharterGuestWinePreference,array('CharterGuestWinePreference.guest_lists_UUID' =>$guuid));
                    
                    $checkWineExists = $this->CharterGuest->query("SELECT id FROM $yDBName.charter_guest_wine_preferences WHERE guest_lists_UUID='$guuid' AND is_deleted=0");
                    if(!empty($checkWineExists)){
                        $this->CharterGuest->query("UPDATE $yDBName.charter_guest_wine_preferences SET is_deleted=1 WHERE guest_lists_UUID='$guuid'");
                    }

                }
                $this->loadModel('GuestList');
                $this->loadModel('CharterGuestAssociate');
                $cConditions = array('is_deleted' => 0, 'UUID' => $guuid);
                // Fetch the existing Wine Preferences
                $GLData = $this->GuestList->find('first', array('conditions' => $cConditions));

                if($GLData['GuestList']['guest_type'] == 'Guest'){//echo "sss"; exit;
                    $existdata = $this->CharterGuestAssociate->find('first',array('conditions'=>array('CharterGuestAssociate.UUID'=>$guuid)));

                    $openButtonLink = "/charters/preference?assocId=". base64_encode($assid); 
                    $result['redirectUrl'] = $openButtonLink; 
                }else { //echo "dddd"; //exit;

                    $CharterGuestexistdata = $this->CharterGuest->find('first',array('conditions'=>array('CharterGuest.users_UUID'=>$guuid)));
                    //echo "<pre>";print_r($CharterGuestexistdata); exit;
                    if(isset($CharterGuestexistdata)){
                        
                        $openButtonLink = "/charters/preference?CharterGuestId=". base64_encode($assid);

                        $result['redirectUrl'] = $openButtonLink; 
                    }

                }
                
            $result['status'] = "success";
            //$result['status'] = "success";
            echo json_encode($result);
            exit;
        }

    }

    /*
        * Fetch the the Session data
        * Functionality -  Fetching the Charter guest and assoc ids
        * Developer - Nagarajan
        * Created date - 06-Aug-2018
        * Modified date - 
    */
    function getSessionData() {
        $session = $this->Session->read('charter_info');
        $sessionAssoc = $this->Session->read('charter_assoc_info');
        $result = array();
        $result['charterHeadId'] = isset($session['CharterGuest']['id']) ? $session['CharterGuest']['id'] : 0;
        $result['charterAssocId'] = isset($sessionAssoc['CharterGuestAssociate']['id']) ? $sessionAssoc['CharterGuestAssociate']['id'] : 0;
        // Checks whether the Head opens and edit the assoc preference
        $charterAssocIdByHeaderEdit = $this->Session->read('charterAssocIdByHeaderEdit');
        if (isset($charterAssocIdByHeaderEdit) && !empty($charterAssocIdByHeaderEdit)) {
            $result['charterAssocId'] = $charterAssocIdByHeaderEdit;
        }
        
        return $result;
    }
    
    /*
        * Fetch wine list by filters
        * Functionality -  Fetching the wine list with filters 
        * Developer - Nagarajan
        * Created date - 31-July-2018
        * Modified date - 
    */
    function filterWineListPagination() {
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            
            $filterData = $this->request->data;
            //echo "<pre>"; print_r($this->params); exit;
            $wineList = $this->fetchWineList($filterData); // Fetch wine list by filters
            $selectedWineList = $this->selectedWineList(); // Fetch wine list from Cart
            
            $this->set('wineList', $wineList);
            $this->set('paginationPanel', 'wineListPanel');
            $this->set('filterData', $filterData);
            $this->set('selectedWineList', $selectedWineList);

            $this->render('../Elements/wine_list_table');
            
        }

    }
    
    /*
        * Fetch wine list by TOP - Color/Region/Vintage
        * Functionality -  Fetching the wine list with filters 
        * Developer - Nagarajan
        * Created date - 31-July-2018
        * Modified date - 
    */
    function filterWineList() {
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            
            $filterData = $this->request->data;
            $wineList = $this->fetchWineList($filterData); // Fetch wine list by filters
            $selectedWineList = $this->selectedWineList(); // Fetch wine list from Cart

            // Load Element view
            $view = new View();
            $element = "wine_list_table";
            $wineListView  = $view->element($element, array('wineList' => $wineList, 'paginationPanel' => 'wineListDiv', 'filterData' => $filterData, 'selectedWineList' => $selectedWineList));
            
            $result['status'] = "success";
            $result['view'] = $wineListView;

            echo json_encode($result);
            exit;
            
        }

    }
    
    /*
        * Fetch wine list from 3rd party
        * Functionality -  Fetching the wine list 
        * Developer - Nagarajan
        * Created date - 31-July-2018
        * Modified date - 
    */
    function fetchWineList($filters = array()) {
        
        $this->loadModel('WineList');
        
        $conditions = array("WineList.vintage >="=> "1950");
        $order = "";
        $limit = 25;
        $session = $this->Session->read();
        //$CGID = $session['charter_info']['CharterGuest']['users_UUID'];
        $CGID = $this->Session->read('guestListUUID');
       //echo "<pre>"; print_r($session); exit;
        // Show limit filter
        if (isset($filters['limit'])) {
            $limit = $filters['limit'];
        }
        // Show limit filter
        if (isset($filters['wineName'])) {
            $conditions["WineList.wine LIKE '%".$filters['wineName']."%'"] = '';

        }
        // Score filter
        // if ((isset($filters['startRange']) && $filters['startRange'] != 80)  && (isset($filters['endRange']) && $filters['endRange'] != 100)) {
        //     $conditions['WineList.score >='] = $filters['startRange'];
        //     $conditions['WineList.score <='] = $filters['endRange'];
        // }
        if ((isset($filters['startRange']) && isset($filters['endRange']))) {
            $conditions['WineList.score >='] = $filters['startRange'];
            $conditions['WineList.score <='] = $filters['endRange'];
        }

        // Country filter
        if (isset($filters['country'])) {
            $conditions['WineList.country'] = $filters['country'];
        }
        // Region filter
        if (isset($filters['region'])) {
            $conditions['WineListRegion.region'] = $filters['region'];
            $Region = array(
                'table' => 'wine_list_regions',
                'alias' => 'WineListRegion',
                'conditions' => array(array('WineListRegion.wine_list_id = WineList.id'))
            );
        }
        // Appellation filter
        if (isset($filters['appellation'])) {
            $conditions['WineList.appellation'] = $filters['appellation'];
        }
        // Color filter
        if (isset($filters['color'])) {
            $conditions['WineList.color'] = $filters['color'];
        }
        // Wine Type filter
        if (isset($filters['wineType'])) {
            $conditions['WineList.wine_type'] = $filters['wineType'];
        }
        // Vintage filter
//        if (isset($filters['vintage'])) {
//            $conditions['WineList.vintage'] = $filters['vintage'];
//        }
        // Order by Top Score
        if (isset($filters['order'])) {
            $order = "WineList.score DESC";
        }
        
        //$selectedWineList = $this->selectedWineList(); // Fetch wine list from Cart
        //$conditions['WineList.wine_id'] = 0;
        if(isset($Region)){
        $joins = array(
                    $Region,
                    array(
                        'table' => 'temp_wine_list_selections',
                        'alias' => 'TWLS',
                        'type'=>'left',
                        'conditions' => array('TWLS.wine_list_id = WineList.id','TWLS.guest_lists_UUID ='.'"'.$CGID.'"')
                    )
                );
        }else{
            $joins = array(
                array(
                    'table' => 'temp_wine_list_selections',
                    'alias' => 'TWLS',
                    'type'=>'left',
                    'conditions' => array('TWLS.wine_list_id = WineList.id','TWLS.guest_lists_UUID ='.'"'.$CGID.'"')
                )
            );
        }
         //print_r($joins); exit;
        // Paginator settings
        $this->Paginator->settings = array('conditions' => $conditions,
            'limit' => $limit,
            'fields' => array('WineList.id',
                'WineList.wine',
                'WineList.vintage',
                'WineList.score',
                'TWLS.id',
                'TWLS.wine_list_id',
                'TWLS.guest_lists_UUID'
            ),
            'joins' => $joins,
            'order' => ''
        );
        
        //echo "<pre>";print_r($this->Paginator->paginate('WineList'));exit;
         return $this->Paginator->paginate('WineList');
        //echo $this->WineList->getLastQuery(); exit;   
        
    }
    
    /*
        * Fetch the Selected wine list
        * Functionality -  Fetching the selected wine list for specific guest 
        * Developer - Nagarajan
        * Created date - 03-Aug-2018
        * Modified date - 
    */
    function selectedWineList() {
        
        // Get Charter guest & assoc ids from session
        $sessionData = $this->getSessionData();
        $charterHeadId = $sessionData['charterHeadId'];
       // $charterAssocId = $sessionData['charterAssocId'];

        $session = $this->Session->read();
        //echo "<pre>";print_r($session); exit;
        if(isset($session['assocprefenceUUID']) && !empty($session['assocprefenceUUID'])){
            $charterHeadId = $session['assocprefenceUUID'];
        }else if(isset($session['ownerprefenceUUID']) && !empty($session['ownerprefenceUUID'])){
            $charterHeadId = $session['ownerprefenceUUID'];
        }
        $selectedCharterProgramUUID = $session['selectedCharterProgramUUID'];
        $this->loadModel('CharterGuestWinePreference');
        $this->loadModel('TempWineListSelection');
        $conditions = array('guest_lists_UUID' => $charterHeadId,'charter_program_id'=>$selectedCharterProgramUUID);
        $prefConditions = array_merge(array('is_deleted' => 0), $conditions);
        // Fetch the existing Wine Preferences
        $winePreferences = $this->CharterGuestWinePreference->find('list', array('fields' => array('wine_list_id','wine_list_id'), 'conditions' => $prefConditions));
        // Fetch the selected wines from Cart
        //$tempconditions = array('charter_guest_id' => $charterHeadId, 'charter_assoc_id' => $charterAssocId);
        $selectedWineList = $this->TempWineListSelection->find('list', array('fields' => array('wine_list_id','wine_list_id'), 'conditions' => $conditions));
        
        // Merging both existing and cart wines
        $selectedWines = array_merge(array_values($winePreferences), array_values($selectedWineList));
        
        return $selectedWines;
    }
    
    /*
        * Add Wine to the Cart
        * Functionality -  Adding the selected wine to the temp table
        * Developer - Nagarajan
        * Created date - 03-Aug-2018
        * Modified date - 
    */
    function addWineToCart() {
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $result = array();
            
            // Get Charter guest & assoc ids from session
            $sessionData = $this->getSessionData();
            //$charterHeadId = $sessionData['charterHeadId'];
            $charterAssocId = $sessionData['charterAssocId'];

            $session = $this->Session->read();
            //echo "<pre>";print_r($session); exit;
            if(isset($session['assocprefenceUUID']) && !empty($session['assocprefenceUUID'])){
                $charterHeadId = $session['assocprefenceUUID'];
            }else if(isset($session['ownerprefenceUUID']) && !empty($session['ownerprefenceUUID'])){
                $charterHeadId = $session['ownerprefenceUUID'];
            }

            $selectedCharterProgramUUID = $session['selectedCharterProgramUUID'];
            
            if (isset($this->request->data['wineListId']) && $charterHeadId != 0) {
                $insertData = array();
                $checkData['wine_list_id'] = $insertData['wine_list_id'] = $wineListId = $this->request->data['wineListId'];
                $checkData['guest_lists_UUID'] = $insertData['guest_lists_UUID'] = $charterHeadId;
                $checkData['charter_program_id'] = $insertData['charter_program_id'] = $selectedCharterProgramUUID;
                $checkData['charter_assoc_id'] = $insertData['charter_assoc_id'] = $charterAssocId;
                $insertData['created'] = date("Y-m-d H:i:s");
                $insertData['modified'] = date("Y-m-d H:i:s");
                
                $this->loadModel('TempWineListSelection');
                
                // Check whether the wine already added to cart for this Guest
                $rowCount = $this->TempWineListSelection->find('count', array('conditions' => $checkData));
                if (!$rowCount) {
                    // Adding the selected wine into the temp table
                    $this->TempWineListSelection->create();
                    if ($this->TempWineListSelection->save($insertData)) {
                        $result['status'] = "success";
                    } else {
                        $result['status'] = "fail";
                    }
                }
            }

            echo json_encode($result);
            exit;
            
        }

    }
    /*
        * Fetch the selected new Beer and sprit 
        * Functionality -  save to cart
        * Developer - rakesh
        * Created date - 16 Jun 2020
        * Modified date - 
    */
    function saveBSProduct(){
         if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $result = array();
            $this->loadModel('ProductList');
            $product_array = array();
            $product_array['id'] = '';
            $product_array['name'] = $this->request->data['product_name'];
            $product_array['primary_category'] = $this->request->data['product_type'];
            $product_array['secondary_category'] = $this->request->data['category_list'];
            $cgid =  $this->request->data['CGID'];
            if($this->ProductList->save($product_array)){
                $lastId =  $this->ProductList->getLastInsertId();
                $this->loadModel('TempProductListSelection');
                $insertData = array();
                $insertData['product_list_id'] = $lastId;
                $insertData['charter_guest_id'] = $cgid;
                $insertData['created'] = date("Y-m-d H:i:s");
                $insertData['modified'] = date("Y-m-d H:i:s");
                $this->TempProductListSelection->create();
                    if ($this->TempProductListSelection->save($insertData)) {
                        $result['status'] = "success";
                        $result['message'] = "Successfully created.";
                        $result['prodid'] = $lastId;
                    } else {
                        $result['status'] = "fail";
                        $result['message'] = "Failed.";
                    }
                echo json_encode($result);
                exit;
            }
            //echo "<pre>"; print_r($product_array); exit;
         }
    }
        /*
        * Fetch the selected new Wine list to cart
        * Functionality -  save to cart
        * Developer - rakesh
        * Created date - 16 Jun 2020
        * Modified date - 
    */
    function saveWLProduct(){
         if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $result = array();
            //echo "<pre>"; print_r($this->request->data); exit;
            $this->loadModel('WineList');
            $product_array = array();
            $product_array['id'] = '';
            $product_array['wine'] = $this->request->data['product_name'];
            $product_array['color'] = $this->request->data['wine_color_list'];
            $product_array['vintage'] = $this->request->data['Vintage'];
            $product_array['score'] = 80;
            //$cgid =  $this->request->data['CGID'];
            $session = $this->Session->read();
            $cgid = $this->Session->read('guestListUUID');
            $selectedCharterProgramUUID = $session['selectedCharterProgramUUID'];
            //echo "<pre>"; print_r($session); exit;
            if($this->WineList->save($product_array)){
                $lastId =  $this->WineList->getLastInsertId();
                $this->loadModel('TempWineListSelection');
                $insertData = array();
                $insertData['wine_list_id'] = $lastId;
                $insertData['guest_lists_UUID'] = $cgid;
                $insertData['charter_program_id'] = $selectedCharterProgramUUID;
                $insertData['created'] = date("Y-m-d H:i:s");
                $insertData['modified'] = date("Y-m-d H:i:s");
                $this->TempWineListSelection->create();
                if ($this->TempWineListSelection->save($insertData)) {
                    $result['status'] = "success";
                    $result['message'] = "Successfully created.";
                    $result['wineid'] = $lastId;
                    $filterData = array();
                    // $filterData['wineName'] = $this->request->data['product_name'];
                    $wineList = $this->fetchWineList($filterData); // Fetch wine list by filters
                    $selectedWineList = $this->selectedWineList(); // Fetch wine list from Cart
                    // echo "<pre>"; print_r($filterData); print_r($wineList); exit;
                    $view = new View();
                    $element = "wine_list_table";
                    $wineListView  = $view->element($element, array('wineList' => $wineList, 'paginationPanel' => 'wineListDiv', 'filterData' => $filterData, 'selectedWineList' => $selectedWineList));
                    $result['view'] = $wineListView;
                } else {
                    $result['status'] = "fail";
                    $result['message'] = "Failed.";
                }
                echo json_encode($result);
                exit;
            }
            //echo "<pre>"; print_r($product_array); exit;
         }
    }
    /*
        * Fetch the selected wine list
        * Functionality -  Fetching the selected Wine list and display in cart
        * Developer - Nagarajan
        * Created date - 03-Aug-2018
        * Modified date - 
    */
    function getSelectedWineList() {
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $result = array();
            
            // Get Charter guest & assoc ids from session
            $sessionData = $this->getSessionData();
            $session = $this->Session->read();
        //echo "<pre>";print_r($session); exit;
        if(isset($session['assocprefenceUUID']) && !empty($session['assocprefenceUUID'])){
            $charterHeadId = $session['assocprefenceUUID'];
        }else if(isset($session['ownerprefenceUUID']) && !empty($session['ownerprefenceUUID'])){
            $charterHeadId = $session['ownerprefenceUUID'];
        }
        //$charterHeadId = $sessionData['charterHeadId'];
        //$charterAssocId = $sessionData['charterAssocId'];
        $selectedCharterProgramUUID = $session['selectedCharterProgramUUID'];
            
            $this->loadModel('CharterGuestWinePreference');
            $this->loadModel('TempWineListSelection');
            $this->loadModel('WineList');
            $this->loadModel('CharterGuest');
            $this->loadModel('CharterGuestAssociate');
            
            $selectConditions = array('guest_lists_UUID' => $charterHeadId,'charter_program_id' => $selectedCharterProgramUUID);
            $prefConditions = array_merge(array('is_deleted' => 0), $selectConditions);
            // Fetch the existing Wine Preferences
            $winePreferences = $this->CharterGuestWinePreference->find('all', array('conditions' => $prefConditions));
//            echo "<pre>";print_r($winePreferences);exit;
            // Fetch the selected wines from Cart
            $selectedWineList = $this->TempWineListSelection->find('list', array('fields' => array('wine_list_id','wine_list_id'), 'conditions' => $selectConditions));
            
            $conditions = array('id' => array_values($selectedWineList));
            // Selected wines
            $selectionCartData = $this->WineList->find('all', array('conditions' => $conditions));
            // Color list
            $colorListPref = $this->CharterGuestWinePreference->find('list', array('fields' => array('color','color'), 'conditions' => $prefConditions, 'group' => array('color')));
            $colorListTemp = $this->WineList->find('list', array('fields' => array('color','color'), 'conditions' => $conditions, 'group' => array('color')));
            $colorList = array_unique(array_merge(array_values($colorListPref), array_values($colorListTemp)));
            
            // Fetch the Charter Guest data
            $charterGuestData = $this->CharterGuest->find('first', array('conditions' => array('users_UUID' => $charterHeadId,'charter_program_id'=>$selectedCharterProgramUUID)));
            // Fetch the Charter Associate data
            $charterAssocData = $this->CharterGuestAssociate->find('first', array('conditions' => array('UUID' => $charterHeadId)));
            // echo "<pre>";print_r($selectionCartData);
            // echo "<pre>";print_r($colorList);
            // echo "<pre>";print_r($winePreferences);
            // echo "<pre>";print_r($charterGuestData);
            // echo "<pre>";print_r($charterAssocData);
            // exit;
            // Load Element view
            $view = new View();
            $element = "selected_wine_list_table";
            $wineListView  = $view->element($element, array('selectionCartData' => $selectionCartData, 'colorList' => $colorList, 'winePreferences' => $winePreferences, 'charterGuestData' => $charterGuestData, 'charterAssocData' => $charterAssocData));

            $result['status'] = "success";
            $result['view'] = $wineListView;
            $result['cartRecordCount'] = count($selectionCartData);
            $result['preferenceRecordCount'] = count($winePreferences);

            echo json_encode($result);
            exit;
            
        }

    }
    
    /*
        * Remove Wine from the Cart
        * Functionality -  Removing the selected wine from the temp table
        * Developer - Nagarajan
        * Created date - 03-Aug-2018
        * Modified date - 
    */
    function removeWineFromCart() {
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $result = array();
            
            // Get Charter guest & assoc ids from session
            $sessionData = $this->getSessionData();
           // $charterHeadId = $sessionData['charterHeadId'];
            $charterAssocId = $sessionData['charterAssocId'];

            $session = $this->Session->read();
        //echo "<pre>";print_r($session); exit;
        if(isset($session['assocprefenceUUID']) && !empty($session['assocprefenceUUID'])){
            $charterHeadId = $session['assocprefenceUUID'];
        }else if(isset($session['ownerprefenceUUID']) && !empty($session['ownerprefenceUUID'])){
            $charterHeadId = $session['ownerprefenceUUID'];
        }
        $selectedCharterProgramUUID = $session['selectedCharterProgramUUID'];
            
            if (isset($this->request->data['wineListId']) && $charterHeadId != 0) {
                $deleteData = array();
                $deleteData['wine_list_id'] = $wineListId = $this->request->data['wineListId'];
                $deleteData['guest_lists_UUID'] = $charterHeadId;
                $deleteData['charter_program_id'] = $selectedCharterProgramUUID;
                //$deleteData['charter_assoc_id'] = $charterAssocId;
                $error = 0;
                
                // Removing the selected wine from the temp table
                $this->loadModel('TempWineListSelection');
                if (!$this->TempWineListSelection->deleteAll($deleteData)) {
                    $error++;
                }
                
                // Removing(Updating) the selected wine from the temp table
                $this->loadModel('CharterGuestWinePreference');
                if (!$this->CharterGuestWinePreference->updateAll(array('is_deleted' => 1), $deleteData)) {
                    $error++;
                }
                
                if (!$error) {
                    $result['status'] = "success";
                } else {
                    $result['status'] = "fail";
                }
            }

            echo json_encode($result);
            exit;
            
        }

    }
    
    /*
        * Remove Wine from the Preference
        * Functionality -  Removing the selected wine from the preference table
        * Developer - Nagarajan
        * Created date - 06-Aug-2018
        * Modified date - 
    */
    function removeWineFromPreference() {
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $result = array();
            
            // Get Charter guest & assoc ids from session
            $sessionData = $this->getSessionData();
            $charterHeadId = $sessionData['charterHeadId'];
            $charterAssocId = $sessionData['charterAssocId'];
            
            
            if (isset($this->request->data['winePrefId']) && $charterHeadId != 0) {
                $updateData = array();
                $updateData['id'] = $winePrefId = $this->request->data['winePrefId'];
                $updateData['is_deleted'] = 1;
                
                // Adding the selected wine into the temp table
                $this->loadModel('CharterGuestWinePreference');
                if ($this->CharterGuestWinePreference->save($updateData)) {
                    $result['status'] = "success";
                } else {
                    $result['status'] = "fail";
                }
            }

            echo json_encode($result);
            exit;
            
        }

    }
    
    /*
        * Generate PDF
        * Functionality -  Generating the PDF for the Prefered wine list
        * Developer - Nagarajan
        * Created date - 07-Aug-2018
        * Modified date - 
    */
    function generateWineOrderPdf() {

        $this->Session->write("isgenerateWineOrderPdf", false);        
        $this->layout = 'ajax';
        $this->autoRender = false;
        $result = array();

        ob_start();
        App::import('Vendor','TCPDF',array('file' => 'tcpdf/tcpdf.php'));
        // create new PDF document
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Get Charter guest & assoc ids from session
        $sessionData = $this->Session->read();
        // echo "<pre>";print_r($sessionData);exit;
        if(isset($sessionData['ownerprefenceUUID']) && !empty($sessionData['ownerprefenceUUID'])){
            $charterHeadId = $sessionData['ownerprefenceUUID'];
        }else if(isset($sessionData['assocprefenceUUID']) && !empty($sessionData['assocprefenceUUID'])){
            $charterHeadId = $sessionData['assocprefenceUUID'];
        }
        $charterAssocId = $sessionData['charterAssocId'];
        $charter_program_id = $this->Session->read('selectedCharterProgramUUID');

        $this->loadModel('CharterGuestWinePreference');

        $prefConditions = array('is_deleted' => 0, 'guest_lists_UUID' => $charterHeadId);
        if($charter_program_id != ''){
            $prefConditions = array('is_deleted' => 0, 'guest_lists_UUID' => $charterHeadId, 'charter_program_id' => $charter_program_id);
        }
        // Fetch the existing Wine Preferences
        $winePreferences = $this->CharterGuestWinePreference->find('all', array('conditions' => $prefConditions));
        // Color list
        $this->CharterGuestWinePreference->virtualFields['color_quantity_sum'] = 'SUM(CharterGuestWinePreference.quantity)';
        $colorCountList = $this->CharterGuestWinePreference->find('list', array('fields' => array('color','color_quantity_sum'), 'conditions' => $prefConditions, 'group' => array('color')));
        $totalQuantitySum = $this->CharterGuestWinePreference->find('first', array('fields' => array('color_quantity_sum'), 'conditions' => $prefConditions));
        $this->CharterGuestWinePreference->virtualFields = array();

        $totalQuantity = isset($totalQuantitySum['CharterGuestWinePreference']['color_quantity_sum']) ? $totalQuantitySum['CharterGuestWinePreference']['color_quantity_sum'] : 0;

        // $personalDetailsTab = '';
        // $mealPreferenceTab = '';
        // $foodPreferenceTab = '';
        // $beveragePreferenceTab = '';
        // $spiritPreferenceTab = '';
        $winePreferenceTab = 'active in';
        $itineraryPreferenceTab = '';
        // Active/Inactive tabs
        // $this->set('personalDetailsTab', $personalDetailsTab);
        // $this->set('mealPreferenceTab', $mealPreferenceTab);
        // $this->set('foodPreferenceTab', $foodPreferenceTab);
        // $this->set('beveragePreferenceTab', $beveragePreferenceTab);
        // $this->set('spiritPreferenceTab', $spiritPreferenceTab);
        $this->set('winePreferenceTab', $winePreferenceTab);
        $this->set('itineraryPreferenceTab', $itineraryPreferenceTab);

        // Load Element view
        $view = new View();
        $element = "selected_wine_list_table_pdf";
        $wineListView  = $view->element($element, array('winePreferences' => $winePreferences, 'colorCountList' => $colorCountList, 'totalQuantity' => $totalQuantity));
        echo $wineListView; 


        // set document information
        $pdf->setFormDefaultProp(array('borderStyle'=>'none'));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT-5, PDF_MARGIN_TOP-20, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
        }

        $pdf->Text($ffill = 0);

        // IMPORTANT: disable font subsetting to allow users editing the document
        $pdf->setFontSubsetting(false);

        // set font
        $pdf->SetFont('helvetica', '', 11, '', false);

        // add a page
        $pdf->AddPage('P', 'A4');
        $pdf->writeHTML($wineListView, true, true, true, false, '');

        // reset pointer to the last page
        $pdf->lastPage();

        $file = "WinePreference_".date('YmdHiS').".pdf";

        ob_end_clean();

        //Close and output PDF document
        echo $output = $pdf->Output($file, 'D');
        
        exit;

    }


    function addPreviousWineToCart() {
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $result = array();
            
            // Get Charter guest & assoc ids from session

            $session = $this->Session->read();
            //echo "<pre>";print_r($session); exit;
            if(isset($session['ownerprefenceUUID']) && !empty($session['ownerprefenceUUID'])){
                $charterHeadId = $session['ownerprefenceUUID'];
            }

            $selectedCharterProgramUUID = $session['selectedCharterProgramUUID'];
            
            if (isset($this->request->data['wineListId']) && $charterHeadId != 0) {
                $winearray = $this->request->data['wineListId'];
                $wineQtyarray = $this->request->data['quantity'];
                foreach($winearray as $key => $value){
                    $insertData = array();
                    $checkData['wine_list_id'] = $insertData['wine_list_id'] = $wineListId = $value;
                    $checkData['guest_lists_UUID'] = $insertData['guest_lists_UUID'] = $charterHeadId;
                    $checkData['charter_program_id'] = $insertData['charter_program_id'] = $selectedCharterProgramUUID;
                    $insertData['quantity'] = $wineQtyarray[$key];
                    $insertData['created'] = date("Y-m-d H:i:s");
                    $insertData['modified'] = date("Y-m-d H:i:s");
                    
                    $this->loadModel('TempWineListSelection');
                    
                    // Check whether the wine already added to cart for this Guest
                    $rowCount = $this->TempWineListSelection->find('count', array('conditions' => $checkData));
                    if (!$rowCount) {
                        // Adding the selected wine into the temp table
                        $this->TempWineListSelection->create();
                        $this->TempWineListSelection->save($insertData);
                           
                    }
                }
                $result['status'] = "success";
            }else{
                $result['status'] = "fail";
            }

            echo json_encode($result);
            exit;
            
        }

    }
    
    /*
        * Fetch product list
        * Functionality -  Fetching the product list with filters 
        * Developer - Nagarajan
        * Created date - 10-Aug-2018
        * Modified date - 
    */
    function filterProductList() {
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            
            $filterData = $this->request->data;
            $productList = $this->fetchProductList($filterData); // Fetch product list by filters
            $selectedProductList = $this->selectedProductList(); // Fetch product list from Cart

            // Load Element view
            $view = new View();
            $element = "product_list_table";
            $productListView  = $view->element($element, array('productList' => $productList, 'productPaginationPanel' => 'productListDiv', 'productFilterData' => $filterData, 'selectedProductList' => $selectedProductList));
            
            $result['status'] = "success";
            $result['view'] = $productListView;

            echo json_encode($result);
            exit;
            
        }

    }
    
    /*
        * Fetch Product list 
        * Functionality -  Fetching the Product list from the DB 
        * Developer - Nagarajan
        * Created date - 10-Aug-2018
        * Modified date - 
    */
    function fetchProductList($filters = array()) {
        
        $this->loadModel('ProductList');
        
        $conditions = array();
        $limit = 25;
        
        // Except - Accessories and Non-Alcohol Items, Non-Alc, Wine
        $conditions['ProductList.primary_category <>'] =  array("Accessories and Non-Alcohol Items", "Wine", "Non-Alc");
        // Show limit filter
        if (isset($filters['limit'])) {
            $limit = $filters['limit'];
        }
        // Product name filter
        if (isset($filters['productName'])) {
            $conditions["ProductList.name LIKE '%".$filters['productName']."%'"] = '';
        }
        // Country filter
        if (isset($filters['country'])) {
            $conditions['ProductList.origin'] = $filters['country'];
        }
        // Type filter - primary_category
        if (isset($filters['type'])) {
            $conditions['ProductList.primary_category'] = $filters['type'];
        }
        // Style filter - tertiary_category
        if (isset($filters['style'])) {
            $conditions['ProductList.tertiary_category'] = $filters['style'];
        }
        // Category filter - secondary_category
        if (isset($filters['category'])) {
            $conditions['ProductList.secondary_category'] = $filters['category'];
        }
        
        // Paginator settings
        $this->Paginator->settings = array('conditions' => $conditions,
            'limit' => $limit,
            'fields' => array('ProductList.id',
                'ProductList.name',
                'ProductList.primary_category',
                'ProductList.secondary_category'
            ),
            'group' => array('ProductList.name')
        );

        return $this->Paginator->paginate('ProductList');
        
    }
    
    /*
        * Fetch product list pagination
        * Functionality -  Fetching the product list with filters and pagination 
        * Developer - Nagarajan
        * Created date - 10-Aug-2018
        * Modified date - 
    */
    function filterProductListPagination() {
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            
            $filterData = $this->request->data;
            
            $productList = $this->fetchProductList($filterData); // Fetch product list by filters
            $selectedProductList = $this->selectedProductList(); // Fetch product list from Cart
            
            $this->set('productList', $productList);
            $this->set('productPaginationPanel', 'productListPanel');
            $this->set('productFilterData', $filterData);
            $this->set('selectedProductList', $selectedProductList);

            $this->render('../Elements/product_list_table');           
        }
    }
    
    /*
        * Fetch the Selected products list
        * Functionality -  Fetching the selected products list for specific guest 
        * Developer - Nagarajan
        * Created date - 10-Aug-2018
        * Modified date - 
    */
    function selectedProductList() {
        
        // Get Charter guest & assoc ids from session
        $sessionData = $this->getSessionData();
        $session = $this->Session->read();
        //echo "<pre>";print_r($session); exit;
        if(isset($session['assocprefenceUUID']) && !empty($session['assocprefenceUUID'])){
            $charterHeadId = $session['assocprefenceUUID'];
        }else if(isset($session['ownerprefenceUUID']) && !empty($session['ownerprefenceUUID'])){
            $charterHeadId = $session['ownerprefenceUUID'];
        }
        if(isset($session['selectedCharterProgramUUID'])){
            $selectedCharterProgramUUID = $session['selectedCharterProgramUUID'];
        }
        //$charterHeadId = $sessionData['charterHeadId'];
        //$charterAssocId = $sessionData['charterAssocId'];
        
        $this->loadModel('CharterGuestSpiritPreference');
        $this->loadModel('TempProductListSelection');
        if(isset($charterHeadId) && isset($selectedCharterProgramUUID)){
            $conditions = array('guest_lists_UUID' => $charterHeadId,'charter_program_id' => $selectedCharterProgramUUID);
            $prefConditions = array_merge(array('is_deleted' => 0), $conditions);
            // Fetch the existing Product Preferences
            $productPreferences = $this->CharterGuestSpiritPreference->find('list', array('fields' => array('product_list_id','product_list_id'), 'conditions' => $prefConditions));
            // Fetch the selected products from Cart
            //$tempconditions = array('charter_guest_id' => $charterHeadId, 'charter_assoc_id' => $charterAssocId);
            $selectedProductList = $this->TempProductListSelection->find('list', array('fields' => array('product_list_id','product_list_id'), 'conditions' => $conditions));
        
        // Merging both existing and cart wines
        $selectedProducts = array_merge(array_values($productPreferences), array_values($selectedProductList));
        
        return $selectedProducts;
        }
    }
    
    /*
        * Add Product to the Cart
        * Functionality -  Adding the selected product to the temp table
        * Developer - Nagarajan
        * Created date - 10-Aug-2018
        * Modified date - 
    */
    function addProductToCart() {
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $result = array();
            
            // Get Charter guest & assoc ids from session
            $sessionData = $this->getSessionData();
            //$charterHeadId = $sessionData['charterHeadId'];
            $charterAssocId = $sessionData['charterAssocId'];

            $session = $this->Session->read();
        //echo "<pre>";print_r($session); exit;
        if(isset($session['assocprefenceUUID']) && !empty($session['assocprefenceUUID'])){
            $charterHeadId = $session['assocprefenceUUID'];
        }else if(isset($session['ownerprefenceUUID']) && !empty($session['ownerprefenceUUID'])){
            $charterHeadId = $session['ownerprefenceUUID'];
        }
         $selectedCharterProgramUUID = $session['selectedCharterProgramUUID']; //exit;
            if (isset($this->request->data['productListId']) && $charterHeadId != 0) {
                $insertData = array();
                $checkData['product_list_id'] = $insertData['product_list_id'] = $productListId = $this->request->data['productListId'];
                $checkData['guest_lists_UUID'] = $insertData['guest_lists_UUID'] = $charterHeadId;
                $checkData['charter_program_id'] = $insertData['charter_program_id'] =  $selectedCharterProgramUUID;
                $checkData['charter_assoc_id'] = $insertData['charter_assoc_id'] = $charterAssocId;
                $insertData['created'] = date("Y-m-d H:i:s");
                $insertData['modified'] = date("Y-m-d H:i:s");
                
                $this->loadModel('TempProductListSelection');
                
                // Check whether the wine already added to cart for this Guest
                $rowCount = $this->TempProductListSelection->find('count', array('conditions' => $checkData));
                if (!$rowCount) {
                    // Adding the selected product into the temp table
                    $this->TempProductListSelection->create();
                    if ($this->TempProductListSelection->save($insertData)) {
                        $result['status'] = "success";
                    } else {
                        $result['status'] = "fail";
                    }
                }
            }

            echo json_encode($result);
            exit;
            
        }

    }
    
    /*
        * Remove Product from the Cart
        * Functionality -  Removing the selected product from the temp table
        * Developer - Nagarajan
        * Created date - 10-Aug-2018
        * Modified date - 
    */
    function removeProductFromCart() {
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $result = array();
            
            // Get Charter guest & assoc ids from session
            $sessionData = $this->getSessionData();
            //$charterHeadId = $sessionData['charterHeadId'];
            $charterAssocId = $sessionData['charterAssocId'];

            $session = $this->Session->read();
            //echo "<pre>";print_r($session); exit;
            if(isset($session['assocprefenceUUID']) && !empty($session['assocprefenceUUID'])){
                $charterHeadId = $session['assocprefenceUUID'];
            }else if(isset($session['ownerprefenceUUID']) && !empty($session['ownerprefenceUUID'])){
                $charterHeadId = $session['ownerprefenceUUID'];
            }
            $selectedCharterProgramUUID = $session['selectedCharterProgramUUID'];
            if (isset($this->request->data['productListId']) && $charterHeadId != 0) {
                $deleteData = array();
                $deleteData['product_list_id'] = $productListId = $this->request->data['productListId'];
                $deleteData['guest_lists_UUID'] = $charterHeadId;
                $deleteData['charter_program_id'] = $selectedCharterProgramUUID;
                //$deleteData['charter_assoc_id'] = $charterAssocId;
                $error = 0;
                //echo "<pre>";print_r($deleteData); exit;
                // Deleting the selected product from the temp table
                $this->loadModel('TempProductListSelection');
                if (!$this->TempProductListSelection->deleteAll($deleteData)) {
                    $error++;
                }
                
                // Deleting(Updating) the selected product into the preference table
                $this->loadModel('CharterGuestSpiritPreference');
                if (!$this->CharterGuestSpiritPreference->updateAll(array('is_deleted' => 1), $deleteData)) {
                    $error++;
                }
                
                if (!$error) {
                    $result['status'] = "success";
                } else {
                    $result['status'] = "fail";
                }
            }

            echo json_encode($result);
            exit;
            
        }

    }
    
    /*
        * Remove Product from the Preference
        * Functionality -  Removing the selected product from the preference table
        * Developer - Nagarajan
        * Created date - 06-Aug-2018
        * Modified date - 
    */
    function removeProductFromPreference() {
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $result = array();
            
            // Get Charter guest & assoc ids from session
            $sessionData = $this->getSessionData();
            $charterHeadId = $sessionData['charterHeadId'];
            $charterAssocId = $sessionData['charterAssocId'];
            
            if (isset($this->request->data['productPrefId']) && $charterHeadId != 0) {
                $updateData = array();
                $updateData['id'] = $productPrefId = $this->request->data['productPrefId'];
                $updateData['is_deleted'] = 1;
                
                // Adding the selected wine into the temp table
                $this->loadModel('CharterGuestSpiritPreference');
                if ($this->CharterGuestSpiritPreference->save($updateData)) {
                    $result['status'] = "success";
                } else {
                    $result['status'] = "fail";
                }
            }

            echo json_encode($result);
            exit;
            
        }

    }
    
    /*
        * Fetch the selected product list
        * Functionality -  Fetching the selected product list and display in cart
        * Developer - Nagarajan
        * Created date - 10-Aug-2018
        * Modified date - 
    */
    function getSelectedProductList() {
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $result = array();
            
            // Get Charter guest & assoc ids from session
            $sessionData = $this->getSessionData();
            //$charterHeadId = $sessionData['charterHeadId'];
            //$charterAssocId = $sessionData['charterAssocId'];

            $session = $this->Session->read();
            //echo "<pre>";print_r($session); exit;
            if(isset($session['assocprefenceUUID']) && !empty($session['assocprefenceUUID'])){
                $charterHeadId = $session['assocprefenceUUID'];
            }else if(isset($session['ownerprefenceUUID']) && !empty($session['ownerprefenceUUID'])){
                $charterHeadId = $session['ownerprefenceUUID'];
            }
            $selectedCharterProgramUUID = $session['selectedCharterProgramUUID'];
            //echo $charterHeadId.'>>>>';
            //echo $selectedCharterProgramUUID;
            $this->loadModel('CharterGuestSpiritPreference');
            $this->loadModel('TempProductListSelection');
            $this->loadModel('ProductList');
            $this->loadModel('CharterGuest');
            $this->loadModel('CharterGuestAssociate');
            
            $selectConditions = array('guest_lists_UUID' => $charterHeadId,'charter_program_id'=>$selectedCharterProgramUUID);
            $prefConditions = array_merge(array('is_deleted' => 0), $selectConditions);
            // Fetch the existing Spirit Preferences
            $spiritPreferences = $this->CharterGuestSpiritPreference->find('all', array('conditions' => $prefConditions));
            //echo $this->CharterGuestSpiritPreference->getLastQuery();
            // Fetch the selected products from Cart
            //$tempselectConditions = array('charter_guest_id' => $charterHeadId, 'charter_assoc_id' => $charterAssocId);
            $selectedProductList = $this->TempProductListSelection->find('list', array('fields' => array('product_list_id','product_list_id'), 'conditions' => $selectConditions));
            
            $conditions = array('id' => array_values($selectedProductList));
            // Selected products
            $selectionCartData = $this->ProductList->find('all', array('conditions' => $conditions));
            // Type list
            $typeListPref = $this->CharterGuestSpiritPreference->find('list', array('fields' => array('primary_category','primary_category'), 'conditions' => $prefConditions, 'group' => array('primary_category')));
            $typeListTemp = $this->ProductList->find('list', array('fields' => array('primary_category','primary_category'), 'conditions' => $conditions, 'group' => array('primary_category')));
            $typeList = array_unique(array_merge(array_values($typeListPref), array_values($typeListTemp)));
            
            // Fetch the Charter Guest data
            $charterGuestData = $this->CharterGuest->find('first', array('conditions' => array('users_UUID' => $charterHeadId,'charter_program_id'=>$selectedCharterProgramUUID)));
            // Fetch the Charter Associate data
            $charterAssocData = $this->CharterGuestAssociate->find('first', array('conditions' => array('UUID' => $charterHeadId)));
            //echo "<pre>";print_r($selectionCartData); //exit;
            //echo "<pre>";print_r($spiritPreferences); //exit;
            //echo "<pre>";print_r($selectionCartData);
             //exit;
            // Load Element view
            $view = new View();
            $element = "selected_product_list_table";
            $productListView  = $view->element($element, array('productSelectionCartData' => $selectionCartData, 'typeList' => $typeList, 'spiritPreferences' => $spiritPreferences, 'charterGuestData' => $charterGuestData, 'charterAssocData' => $charterAssocData));

            $result['status'] = "success";
            $result['view'] = $productListView;
            $result['cartRecordCount'] = count($selectionCartData);
            $result['preferenceRecordCount'] = count($spiritPreferences);

            echo json_encode($result);
            exit;
            
        }

    }
    
    /*
        * Generate PDF
        * Functionality -  Generating the PDF for the Prefered Beer & Spirits list
        * Developer - Nagarajan
        * Created date - 13-Aug-2018
        * Modified date - 
    */
    function generateProductOrderPdf() {
        
        $this->Session->write("isgenerateProductOrderPdf", false);
        $this->layout = 'ajax';
        $this->autoRender = false;
        $result = array();

        ob_start();
        App::import('Vendor','TCPDF',array('file' => 'tcpdf/tcpdf.php'));
        // create new PDF document
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Get Charter guest & assoc ids from session
        $sessionData = $this->Session->read();
        // echo "<pre>";print_r($sessionData);exit;
        if(isset($sessionData['ownerprefenceUUID']) && !empty($sessionData['ownerprefenceUUID'])){
            $charterHeadId = $sessionData['ownerprefenceUUID'];
        }else if(isset($sessionData['assocprefenceUUID']) && !empty($sessionData['assocprefenceUUID'])){
            $charterHeadId = $sessionData['assocprefenceUUID'];
        }
        
        // $charterAssocId = $sessionData['charterAssocId'];
        // $charter_program_id = $sessionData['charter_info']['CharterGuest']['charter_program_id'];
        $charter_program_id = $this->Session->read('selectedCharterProgramUUID');

        // echo "<pre>";print_r($charter_program_id);exit;

        $this->loadModel('CharterGuestSpiritPreference');

        $prefConditions = array('is_deleted' => 0, 'guest_lists_UUID' => $charterHeadId);
        if($charter_program_id != ''){
            $prefConditions = array('is_deleted' => 0, 'guest_lists_UUID' => $charterHeadId, 'charter_program_id' => $charter_program_id);
        }
        // echo "<pre>";print_r($prefConditions);exit;
        // Fetch the existing Wine Preferences
        $spiritPreferences = $this->CharterGuestSpiritPreference->find('all', array('conditions' => $prefConditions));
        // Color list
        $this->CharterGuestSpiritPreference->virtualFields['type_quantity_sum'] = 'SUM(CharterGuestSpiritPreference.quantity)';
        $typeCountList = $this->CharterGuestSpiritPreference->find('list', array('fields' => array('primary_category','type_quantity_sum'), 'conditions' => $prefConditions, 'group' => array('primary_category')));
        $totalQuantitySum = $this->CharterGuestSpiritPreference->find('first', array('fields' => array('type_quantity_sum'), 'conditions' => $prefConditions));
        $this->CharterGuestSpiritPreference->virtualFields = array();

        $totalQuantity = isset($totalQuantitySum['CharterGuestSpiritPreference']['type_quantity_sum']) ? $totalQuantitySum['CharterGuestSpiritPreference']['type_quantity_sum'] : 0;

        // Load Element view
        $view = new View();
        $element = "selected_product_list_table_pdf";
        $productListView  = $view->element($element, array('spiritPreferences' => $spiritPreferences, 'typeCountList' => $typeCountList, 'totalQuantity' => $totalQuantity));
        echo $productListView; 


        // set document information
        $pdf->setFormDefaultProp(array('borderStyle'=>'none'));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT-5, PDF_MARGIN_TOP-20, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
        }

        $pdf->Text($ffill = 0);

        // IMPORTANT: disable font subsetting to allow users editing the document
        $pdf->setFontSubsetting(false);

        // set font
        $pdf->SetFont('helvetica', '', 11, '', false);

        // add a page
        $pdf->AddPage('P', 'A4');
        $pdf->writeHTML($productListView, true, true, true, false, '');

        // reset pointer to the last page
        $pdf->lastPage();

        $file = "SpiritPreference_".date('YmdHiS').".pdf";

        ob_end_clean();

        //Close and output PDF document
        echo $output = $pdf->Output($file, 'D');
        
        exit;

    }


    function addPreviousSpiritToCart() {
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $result = array();
            $this->loadModel('TempProductListSelection');
            $session = $this->Session->read();
            //echo "<pre>";print_r($this->request->data['productListId']); exit;
            if(isset($session['ownerprefenceUUID']) && !empty($session['ownerprefenceUUID'])){
                $charterHeadId = $session['ownerprefenceUUID'];
            }
            $selectedCharterProgramUUID = $session['selectedCharterProgramUUID']; //exit;

            if (isset($this->request->data['productListId']) && $charterHeadId != 0) {
                $productarray = $this->request->data['productListId'];
                $quantityarray = $this->request->data['quantity'];
                foreach($productarray as $key => $value){
                        $insertData = array();
                        $checkData['product_list_id'] = $insertData['product_list_id'] = $productListId = $value;
                        $checkData['guest_lists_UUID'] = $insertData['guest_lists_UUID'] = $charterHeadId;
                        $checkData['charter_program_id'] = $insertData['charter_program_id'] =  $selectedCharterProgramUUID;
                        $checkData['quantity'] = $insertData['quantity'] = $quantityarray[$key];
                        $insertData['created'] = date("Y-m-d H:i:s");
                        $insertData['modified'] = date("Y-m-d H:i:s");
                        
                        
                        
                        // Check whether the wine already added to cart for this Guest
                        $rowCount = $this->TempProductListSelection->find('count', array('conditions' => $checkData));
                        if (!$rowCount) {
                            // Adding the selected product into the temp table
                            $this->TempProductListSelection->create();
                            $this->TempProductListSelection->save($insertData);
                              
                        }
                }
                $result['status'] = "success";
            }else {
                $result['status'] = "fail";
            }



            echo json_encode($result);
            exit;
            
        }

    }
    
    
    /*
        * Send records to the Yacht site
        * Functionality -  Fetching the Personal and Preference details and send to the corresponding yacht site
        * Developer - Nagarajan
        * Created date - 06-June-2018
        * Modified date - 
    */
    function sendRecordsToYacht($yDBName,$charterHeadProgramId,$charterHeadId,$charterAssocId,$guest_uuid) {
        //  echo $charterHeadProgramId."kk<br/>";
        //  echo $charterHeadId."aa<br/>";
        //  echo $charterAssocId."aa<br/>";
        //  echo $guest_uuid."aa<br/>";; exit;
        Configure::write('debug',0);
        // Updating all the tabs records into corresponding yacht tables
        $created = date("Y-m-d H:i:s");

        // charter_guests table
        $guestData = $this->CharterGuest->find('first', array('conditions' => array('charter_program_id' => $charterHeadProgramId,'is_deleted' => 0)));
        if (!empty($guestData)) {
            $input = array();
            $input = $guestData['CharterGuest'];
            if($guestData['CharterGuest']['is_psheets_done'] == 1){
                $checkGuestExists = $this->CharterGuest->query("SELECT id FROM $yDBName.charter_programs WHERE UUID='$charterHeadProgramId' AND is_deleted = 0");
                // if (empty($checkGuestExists)) { // INSERT
                //     $input['is_head_charterer'] = empty($input['is_head_charterer']) ? 0 : 1;
                //     $input['is_email_sent'] = empty($input['is_email_sent']) ? 0 : 1;
                //     $input['is_psheets_done'] = empty($input['is_psheets_done']) ? 0 : 1;
                //     $inputchid = "'".$input['charter_program_id']."'";
                //     $this->CharterGuest->query("INSERT INTO $yDBName.charter_programs (UUID,users_UUID,preference_UUID,charter_name,salutation,is_head_charterer,first_name,last_name,email,charter_from_date,embarkation,charter_to_date,debarkation,no_of_guests,yacht_id,token,send_mail,is_psheets_done,created,send_wine_quotation,send_spirit_quotation) VALUES (".$inputchid.","."'".$input['users_UUID']."'".","."'".$input['preference_UUID']."'".",'".$input['charter_name']."','".$input['salutation']."',".$input['is_head_charterer'].",'".$input['first_name']."','".$input['last_name']."','".$input['email']."','".$input['charter_from_date']."','".$input['embarkation']."','".$input['charter_to_date']."','".$input['debarkation']."',".$input['no_of_guests'].",".$input['yacht_id'].",'".$input['token']."',".$input['is_email_sent'].",".$input['is_psheets_done'].",'".$created."','".$input['send_wine_quotation']."','".$input['send_spirit_quotation']."')");
                // } else {
                    $inputusers_UUID = "'".$input['users_UUID']."'";
                    $this->CharterGuest->query("UPDATE $yDBName.charter_programs SET is_psheets_done=1,salutation='".$input['salutation']."',users_UUID =$inputusers_UUID,send_wine_quotation='".$input['send_wine_quotation']."',send_spirit_quotation='".$input['send_spirit_quotation']."' WHERE UUID='".$charterHeadProgramId."'");
                //}
            }
        }

        // charter_guest_associates table
        //echo $charterAssocId;
        $guestAssocData = $this->CharterGuestAssociate->find('first', array('conditions' => array('charter_guest_id' => $charterHeadProgramId,'UUID'=>$guest_uuid)));
        //echo "<pre>"; print_r($guestAssocData); exit;
        if (!empty($guestAssocData)) {
            $input = array();
            $input = $guestAssocData['CharterGuestAssociate'];
            $checkGuestAssocExists = $this->CharterGuest->query("SELECT id FROM $yDBName.charter_guest_associates WHERE charter_guest_id='$charterHeadProgramId' and UUID='$guest_uuid'");
            //echo "<pre>"; print_r($checkGuestAssocExists);
            if (empty($checkGuestAssocExists)) { // INSERT  
                //echo "insert"; exit;
                $input['is_head_charterer'] = empty($input['is_head_charterer']) ? 0 : 1;
                $input['is_email_sent'] = empty($input['is_email_sent']) ? 0 : 1;
                $input['is_psheets_done'] = empty($input['is_psheets_done']) ? 0 : 1;
                $this->CharterGuest->query("INSERT INTO $yDBName.charter_guest_associates (UUID,charter_guest_id,salutation,is_head_charterer,first_name,last_name,email,token,is_email_sent,is_psheets_done,created,assoc_row_id,charter_program_id,send_wine_quotation,send_spirit_quotation,fleetcompany_id) VALUES ("."'".$input['UUID']."'".",'".$input['charter_guest_id']."','".$input['salutation']."',".$input['is_head_charterer'].",'".$input['first_name']."','".$input['last_name']."','".$input['email']."','".$input['token']."',".$input['is_email_sent'].",".$input['is_psheets_done'].",'".$created."',".$charterAssocId.","."'".$input['charter_program_id']."'".",'".$input['send_wine_quotation']."','".$input['send_spirit_quotation']."','".$input['fleetcompany_id']."')");
            } else {
                //echo "update"; exit;
                $inputusers_UUID = "'".$input['UUID']."'";
                $inputcharter_guest_id = "'".$input['charter_guest_id']."'";
                $inputc_token = "'".$input['token']."'"; //echo "tset"; exit;
                //echo "UPDATE $yDBName.charter_guest_associates SET is_psheets_done=1,UUID='$inputusers_UUID',token=".$inputc_token.",send_wine_quotation='".$input['send_wine_quotation']."',send_spirit_quotation='".$input['send_spirit_quotation']."' WHERE UUID='$inputusers_UUID' and charter_guest_id = '$inputcharter_guest_id'"; exit;
                $this->CharterGuest->query("UPDATE $yDBName.charter_guest_associates SET is_psheets_done=1,fleetcompany_id='".$input['fleetcompany_id']."',salutation='".$input['salutation']."',UUID=$inputusers_UUID,token=".$inputc_token.",send_wine_quotation='".$input['send_wine_quotation']."',send_spirit_quotation='".$input['send_spirit_quotation']."' WHERE UUID=$inputusers_UUID and charter_guest_id = $inputcharter_guest_id");
            }
        }

        // charter_guest_personal_details table
        $personalData = $this->CharterGuestPersonalDetail->find('first', array('conditions' => array('guest_lists_UUID' => $guest_uuid,'is_deleted' => 0)));
        //echo "<pre>"; print_r($personalData);
        if (!empty($personalData)) {
            $input = array();
            $input = $personalData['CharterGuestPersonalDetail'];
            $checkPersonalExists = $this->CharterGuest->query("SELECT id FROM $yDBName.charter_guest_personal_details WHERE guest_lists_UUID='$guest_uuid' AND is_deleted = 0");
            //echo "<pre>"; print_r($checkPersonalExists);

            if (empty($checkPersonalExists)) { // INSERT
                //echo "INSERT INTO $yDBName.charter_guest_personal_details (guest_lists_UUID,charter_assoc_id,first_name,family_name,dob,pob,nationality,passport_num,issued_date,expiry_date,passport_image,medical_conditions,special_occations,birthday_date,film_festival_date,honeymoon_date,anniversary_date,other_occation_date,event_date,dietries,dietry_comments,allergies,allergy_comments,rain_jacket_size,foot_size,pillow_type,extra_pillow,created) VALUES (".$input['guest_lists_UUID'].",".$input['charter_assoc_id'].",'".mysql_real_escape_string($input['first_name'])."','".mysql_real_escape_string($input['family_name'])."','".$input['dob']."','".$input['pob']."','".$input['nationality']."','".$input['passport_num']."','".$input['issued_date']."','".$input['expiry_date']."','".$input['passport_image']."','".mysql_real_escape_string($input['medical_conditions'])."','".mysql_real_escape_string(input['special_occations'])."','".$input['birthday_date']."','".$input['film_festival_date']."','".$input['honeymoon_date']."','".$input['anniversary_date']."','".$input['other_occation_date']."','".$input['event_date']."','".$input['dietries']."','".mysql_real_escape_string($input['dietry_comments'])."','".mysql_real_escape_string($input['allergies'])."','".mysql_real_escape_string($input['allergy_comments'])."','".$input['rain_jacket_size']."','".$input['foot_size']."','".$input['pillow_type']."','".$input['extra_pillow']."','".$created."')"; exit;
                $this->CharterGuest->query("INSERT INTO $yDBName.charter_guest_personal_details (guest_lists_UUID,charter_assoc_id,first_name,family_name,dob,pob,nationality,passport_num,issued_date,expiry_date,passport_image,medical_conditions,special_occations,birthday_date,film_festival_date,honeymoon_date,anniversary_date,other_occation_date,event_date,dietries,dietry_comments,allergies,allergy_comments,rain_jacket_size,foot_size,pillow_type,extra_pillow,created,next_of_kin,next_of_kin_phone) VALUES ("."'".$input['guest_lists_UUID']."'".",".$input['charter_assoc_id'].",'".addslashes($input['first_name'])."','".addslashes($input['family_name'])."','".$input['dob']."','".$input['pob']."','".$input['nationality']."','".$input['passport_num']."','".$input['issued_date']."','".$input['expiry_date']."','".$input['passport_image']."','".addslashes($input['medical_conditions'])."','".$input['special_occations']."','".$input['birthday_date']."','".$input['film_festival_date']."','".$input['honeymoon_date']."','".$input['anniversary_date']."','".$input['other_occation_date']."','".$input['event_date']."','".$input['dietries']."','".addslashes($input['dietry_comments'])."','".$input['allergies']."','".addslashes($input['allergy_comments'])."','".$input['rain_jacket_size']."','".$input['foot_size']."','".$input['pillow_type']."','".$input['extra_pillow']."','".$created."','".$input['next_of_kin']."','".$input['next_of_kin_phone']."')");
            } else { // UPDATE
                //echo "<pre>"; print_r($input);
                //echo "UPDATE $yDBName.charter_guest_personal_details SET first_name='".$input['first_name']."',family_name='".$input['family_name']."',dob='".$input['dob']."',pob='".$input['pob']."',nationality='".$input['nationality']."',passport_num='".$input['passport_num']."',issued_date='".$input['issued_date']."',expiry_date='".$input['expiry_date']."',passport_image='".$input['passport_image']."',medical_conditions='".addslashes($input['medical_conditions'])."',special_occations='".$input['special_occations']."',birthday_date='".$input['birthday_date']."',film_festival_date='".$input['film_festival_date']."',honeymoon_date='".$input['honeymoon_date']."',anniversary_date='".$input['anniversary_date']."',other_occation_date='".$input['other_occation_date']."',event_date='".$input['event_date']."',dietries='".$input['dietries']."',dietry_comments='".mysqli_real_escape_string($input['dietry_comments'])."',allergies='".$input['allergies']."',allergy_comments='".mysqli_real_escape_string($input['allergy_comments'])."',rain_jacket_size='".$input['rain_jacket_size']."',foot_size='".$input['foot_size']."',pillow_type='".$input['pillow_type']."',extra_pillow='".$input['extra_pillow']."' WHERE charter_guest_id=$charterHeadId AND charter_assoc_id=$charterAssocId"; exit;
                $this->CharterGuest->query("UPDATE $yDBName.charter_guest_personal_details SET first_name='".$input['first_name']."',family_name='".$input['family_name']."',dob='".$input['dob']."',pob='".$input['pob']."',nationality='".$input['nationality']."',passport_num='".$input['passport_num']."',issued_date='".$input['issued_date']."',expiry_date='".$input['expiry_date']."',passport_image='".$input['passport_image']."',medical_conditions='".addslashes($input['medical_conditions'])."',special_occations='".$input['special_occations']."',birthday_date='".$input['birthday_date']."',film_festival_date='".$input['film_festival_date']."',honeymoon_date='".$input['honeymoon_date']."',anniversary_date='".$input['anniversary_date']."',other_occation_date='".$input['other_occation_date']."',event_date='".$input['event_date']."',dietries='".$input['dietries']."',dietry_comments='".addslashes($input['dietry_comments'])."',allergies='".$input['allergies']."',allergy_comments='".addslashes($input['allergy_comments'])."',rain_jacket_size='".$input['rain_jacket_size']."',foot_size='".$input['foot_size']."',pillow_type='".$input['pillow_type']."',extra_pillow='".$input['extra_pillow']."',next_of_kin='".$input['next_of_kin']."',next_of_kin_phone='".$input['next_of_kin_phone']."' WHERE guest_lists_UUID='$guest_uuid'");
            }

            
            $checkPersonalSpecialOccasionsExists = $this->CharterGuestPersonalDetailSpecialOccasion->find('first', array('conditions' => array('guest_lists_UUID' => $guest_uuid,'charter_program_id'=>$charterHeadProgramId,'is_deleted' => 0)));
            if (!empty($checkPersonalSpecialOccasionsExists)) {
                $input = array();
                $input = $checkPersonalSpecialOccasionsExists['CharterGuestPersonalDetailSpecialOccasion'];
                //echo "<pre>"; print_r($input);
                $PersonalSpecialOccasionsYacht = $this->CharterGuest->query("SELECT id FROM $yDBName.charter_guest_personal_detail_special_occasions WHERE guest_lists_UUID='$guest_uuid' AND charter_program_id = '$charterHeadProgramId' AND is_deleted = 0");
                if (empty($PersonalSpecialOccasionsYacht)) { // INSERT
                    //echo "INSERT INTO $yDBName.charter_guest_personal_detail_special_occasions (guest_lists_UUID,charter_program_id,is_deleted,special_occations,birthday_date,film_festival_date,honeymoon_date,anniversary_date,other_occation_date,event_date,created) VALUES ("."'".$input['guest_lists_UUID']."'".",".$input['charter_program_id'].",'".($input['is_deleted'])."','".addslashes($input['special_occations'])."','".$input['birthday_date']."','".$input['film_festival_date']."','".$input['honeymoon_date']."','".$input['anniversary_date']."','".$input['other_occation_date']."','".$input['event_date']."','".$created."')"; exit;
                    $this->CharterGuest->query("INSERT INTO $yDBName.charter_guest_personal_detail_special_occasions (guest_lists_UUID,charter_program_id,is_deleted,special_occations,birthday_date,film_festival_date,honeymoon_date,anniversary_date,other_occation_date,event_date,created) VALUES ("."'".$input['guest_lists_UUID']."'".","."'".$input['charter_program_id']."'".",'".($input['is_deleted'])."','".addslashes($input['special_occations'])."','".$input['birthday_date']."','".$input['film_festival_date']."','".$input['honeymoon_date']."','".$input['anniversary_date']."','".$input['other_occation_date']."','".$input['event_date']."','".$created."')");
                }else{ // UPDATE
                    $this->CharterGuest->query("UPDATE $yDBName.charter_guest_personal_detail_special_occasions SET special_occations='".addslashes($input['special_occations'])."',birthday_date='".$input['birthday_date']."',film_festival_date='".($input['film_festival_date'])."',honeymoon_date='".$input['honeymoon_date']."',anniversary_date='".$input['anniversary_date']."',other_occation_date='".$input['other_occation_date']."',event_date='".$input['event_date']."' WHERE guest_lists_UUID='$guest_uuid' AND charter_program_id = '$charterHeadProgramId'");

                }
            }
        }

        // charter_guest_meal_preferences table
        $mealData = $this->CharterGuestMealPreference->find('first', array('conditions' => array('guest_lists_UUID' => $guest_uuid,'is_deleted' => 0)));
        if (!empty($mealData)) {
            $input = array();
            $input = $mealData['CharterGuestMealPreference'];
            $checkMealExists = $this->CharterGuest->query("SELECT id FROM $yDBName.charter_guest_meal_preferences WHERE guest_lists_UUID='$guest_uuid' AND is_deleted = 0");
            if (empty($checkMealExists)) { // INSERT
                $this->CharterGuest->query("INSERT INTO $yDBName.charter_guest_meal_preferences (guest_lists_UUID,charter_assoc_id,breakfast_time,lunch_time,dinner_time,breakfast_service_style,lunch_service_style,dinner_service_style,meal_time_service_comments,is_breakfast,breakfast_likes,other_breakfast_likes,lunch_type,is_lunch_desert,lunch_style,is_dining_ashore,restaurant1,restaurant2,restaurant3,restaurant_date1,restaurant_date2,restaurant_date3,restaurant_time1,restaurant_time2,restaurant_time3,is_hors_deovres,deovres_preference,deovres_comments,is_dinner_desert,is_dinner_coffee,created) VALUES ("."'".$input['guest_lists_UUID']."'".",".$input['charter_assoc_id'].",'".$input['breakfast_time']."','".$input['lunch_time']."','".$input['dinner_time']."','".$input['breakfast_service_style']."','".$input['lunch_service_style']."','".$input['dinner_service_style']."','".addslashes($input['meal_time_service_comments'])."','".$input['is_breakfast']."','".$input['breakfast_likes']."','".addslashes($input['other_breakfast_likes'])."','".$input['lunch_type']."','".$input['is_lunch_desert']."','".$input['lunch_style']."','".$input['is_dining_ashore']."','".addslashes($input['restaurant1'])."','".addslashes($input['restaurant2'])."','".addslashes($input['restaurant3'])."','".$input['restaurant_date1']."','".$input['restaurant_date2']."','".$input['restaurant_date3']."','".$input['restaurant_time1']."','".$input['restaurant_time2']."','".$input['restaurant_time3']."','".$input['is_hors_deovres']."','".$input['deovres_preference']."','".addslashes($input['deovres_comments'])."','".$input['is_dinner_desert']."','".$input['is_dinner_coffee']."','".$created."')");
            } else { // UPDATE
                $this->CharterGuest->query("UPDATE $yDBName.charter_guest_meal_preferences SET breakfast_time='".$input['breakfast_time']."',lunch_time='".$input['lunch_time']."',dinner_time='".$input['dinner_time']."',breakfast_service_style='".$input['breakfast_service_style']."',lunch_service_style='".$input['lunch_service_style']."',dinner_service_style='".$input['dinner_service_style']."',meal_time_service_comments='".addslashes($input['meal_time_service_comments'])."',is_breakfast='".$input['is_breakfast']."',breakfast_likes='".$input['breakfast_likes']."',other_breakfast_likes='".addslashes($input['other_breakfast_likes'])."',lunch_type='".$input['lunch_type']."',is_lunch_desert='".$input['is_lunch_desert']."',lunch_style='".$input['lunch_style']."',is_dining_ashore='".$input['is_dining_ashore']."',restaurant1='".addslashes($input['restaurant1'])."',restaurant2='".addslashes($input['restaurant2'])."',restaurant3='".addslashes($input['restaurant3'])."',restaurant_date1='".$input['restaurant_date1']."',restaurant_date2='".$input['restaurant_date2']."',restaurant_date3='".$input['restaurant_date3']."',restaurant_time1='".$input['restaurant_time1']."',restaurant_time2='".$input['restaurant_time2']."',restaurant_time3='".$input['restaurant_time3']."',is_hors_deovres='".$input['is_hors_deovres']."',deovres_preference='".$input['deovres_preference']."',deovres_comments='".addslashes($input['deovres_comments'])."',is_dinner_desert='".$input['is_dinner_desert']."',is_dinner_coffee='".$input['is_dinner_coffee']."' WHERE guest_lists_UUID='$guest_uuid'");
            }


            $CharterGuestMealPreferenceResExists = $this->CharterGuestMealPreferenceRestaurant->find('first', array('conditions' => array('guest_lists_UUID' => $guest_uuid,'charter_program_id'=>$charterHeadProgramId,'is_deleted' => 0)));
            if (!empty($CharterGuestMealPreferenceResExists)) {
                $input = array();
                $input = $CharterGuestMealPreferenceResExists['CharterGuestMealPreferenceRestaurant'];
                $PreferenceRestaurant = $this->CharterGuest->query("SELECT id FROM $yDBName.charter_guest_meal_preferences_restaurants WHERE guest_lists_UUID='$guest_uuid' AND charter_program_id = '$charterHeadProgramId' AND is_deleted = 0");
                if (empty($PreferenceRestaurant)) { // INSERT
                    
                    $this->CharterGuest->query("INSERT INTO $yDBName.charter_guest_meal_preferences_restaurants (guest_lists_UUID,charter_program_id,is_deleted,is_dining_ashore,restaurant1,restaurant2,restaurant3,restaurant_date1,restaurant_date2,restaurant_date3,restaurant_time1,restaurant_time2,restaurant_time3,created) VALUES ("."'".$input['guest_lists_UUID']."'".","."'".$input['charter_program_id']."'".",'".($input['is_deleted'])."','".($input['is_dining_ashore'])."','".addslashes($input['restaurant1'])."','".addslashes($input['restaurant2'])."','".addslashes($input['restaurant3'])."','".$input['restaurant_date1']."','".$input['restaurant_date2']."','".$input['restaurant_date3']."','".$input['restaurant_time1']."','".$input['restaurant_time2']."','".$input['restaurant_time3']."','".$created."')");
                }else{ // UPDATE
                    $this->CharterGuest->query("UPDATE $yDBName.charter_guest_meal_preferences_restaurants SET is_dining_ashore='".($input['is_dining_ashore'])."',restaurant1='".addslashes($input['restaurant1'])."',restaurant2='".addslashes($input['restaurant2'])."',restaurant3='".addslashes($input['restaurant3'])."',restaurant_date1='".$input['restaurant_date1']."',restaurant_date2='".$input['restaurant_date2']."',restaurant_date3='".$input['restaurant_date3']."',restaurant_time1='".$input['restaurant_time1']."',restaurant_time2='".$input['restaurant_time2']."',restaurant_time3='".$input['restaurant_time3']."' WHERE guest_lists_UUID='$guest_uuid' AND charter_program_id = '$charterHeadProgramId'");

                }
            }

        }

        // charter_guest_food_preferences table
        $foodData = $this->CharterGuestFoodPreference->find('first', array('conditions' => array('guest_lists_UUID' => $guest_uuid,'is_deleted' => 0)));
        if (!empty($foodData)) {
            $input = array();
            $input = $foodData['CharterGuestFoodPreference'];
            $checkFoodExists = $this->CharterGuest->query("SELECT id FROM $yDBName.charter_guest_food_preferences WHERE guest_lists_UUID='$guest_uuid' AND is_deleted = 0");
            if (empty($checkFoodExists)) { // INSERT
                $this->CharterGuest->query("INSERT INTO $yDBName.charter_guest_food_preferences (guest_lists_UUID,charter_assoc_id,breakfast_time,lunch_time,dinner_time,breakfast_service_style,lunch_service_style,dinner_service_style,meal_time_service_comments,food_style,food_style_comments,beaf_preference,lamb_preference,pork_preference,duck_preference,veal_preference,food_love,food_like,food_dislike,dislikes,dislike_comments,created) VALUES ("."'".$input['guest_lists_UUID']."'".",".$input['charter_assoc_id'].",'".$input['breakfast_time']."','".$input['lunch_time']."','".$input['dinner_time']."','".$input['breakfast_service_style']."','".$input['lunch_service_style']."','".$input['dinner_service_style']."','".addslashes($input['meal_time_service_comments'])."','".$input['food_style']."','".addslashes($input['food_style_comments'])."','".$input['beaf_preference']."','".$input['lamb_preference']."','".$input['pork_preference']."','".$input['duck_preference']."','".$input['veal_preference']."','".$input['food_love']."','".$input['food_like']."','".$input['food_dislike']."','".$input['dislikes']."','".addslashes($input['dislike_comments'])."','".$created."')");
            } else { // UPDATE
                $this->CharterGuest->query("UPDATE $yDBName.charter_guest_food_preferences SET breakfast_time='".$input['breakfast_time']."',lunch_time='".$input['lunch_time']."',dinner_time='".$input['dinner_time']."',breakfast_service_style='".$input['breakfast_service_style']."',lunch_service_style='".$input['lunch_service_style']."',dinner_service_style='".$input['dinner_service_style']."',meal_time_service_comments='".addslashes($input['meal_time_service_comments'])."',food_style='".$input['food_style']."',food_style_comments='".addslashes($input['food_style_comments'])."',beaf_preference='".$input['beaf_preference']."',lamb_preference='".$input['lamb_preference']."',pork_preference='".$input['pork_preference']."',duck_preference='".$input['duck_preference']."',veal_preference='".$input['veal_preference']."',food_love='".$input['food_love']."',food_like='".$input['food_like']."',food_dislike='".$input['food_dislike']."',dislikes='".$input['dislikes']."',dislike_comments='".addslashes($input['dislike_comments'])."' WHERE guest_lists_UUID='$guest_uuid'");
            }
        }

        // charter_guest_beverage_preferences table
        $beverageData = $this->CharterGuestBeveragePreference->find('first', array('conditions' => array('guest_lists_UUID' => $guest_uuid,'is_deleted' => 0)));
        if (!empty($beverageData)) {
            $input = array();
            $input = $beverageData['CharterGuestBeveragePreference'];
            $checkBeverageExists = $this->CharterGuest->query("SELECT id FROM $yDBName.charter_guest_beverage_preferences WHERE guest_lists_UUID='$guest_uuid' AND is_deleted = 0");
            if (empty($checkBeverageExists)) { // INSERT
                $this->CharterGuest->query("INSERT INTO $yDBName.charter_guest_beverage_preferences (guest_lists_UUID,charter_assoc_id,coffee_items,coffee_comments,tea_items,tea_comments,milk_items,milk_comments,soda_items,soda_comments1,soda_comments2,juice_items,juice_comments,water_items,water_comments,alcoholic_items1,alcoholic_items2,alcoholic_items3,alcoholic_items4,alcoholic_types,alcoholic_comments,created) VALUES ("."'".$input['guest_lists_UUID']."'".",".$input['charter_assoc_id'].",'".$input['coffee_items']."','".addslashes($input['coffee_comments'])."','".$input['tea_items']."','".addslashes($input['tea_comments'])."','".$input['milk_items']."','".addslashes($input['milk_comments'])."','".$input['soda_items']."','".addslashes($input['soda_comments1'])."','".addslashes($input['soda_comments2'])."','".$input['juice_items']."','".addslashes($input['juice_comments'])."','".$input['water_items']."','".addslashes($input['water_comments'])."','".$input['alcoholic_items1']."','".$input['alcoholic_items2']."','".$input['alcoholic_items3']."','".$input['alcoholic_items4']."','".$input['alcoholic_types']."','".addslashes($input['alcoholic_comments'])."','".$created."')");
            } else { // UPDATE
                $this->CharterGuest->query("UPDATE $yDBName.charter_guest_beverage_preferences SET coffee_items='".$input['coffee_items']."',coffee_comments='".addslashes($input['coffee_comments'])."',tea_items='".$input['tea_items']."',tea_comments='".addslashes($input['tea_comments'])."',milk_items='".$input['milk_items']."',milk_comments='".addslashes($input['milk_comments'])."',soda_items='".$input['soda_items']."',soda_comments1='".addslashes($input['soda_comments1'])."',soda_comments2='".addslashes($input['soda_comments2'])."',juice_items='".$input['juice_items']."',juice_comments='".addslashes($input['juice_comments'])."',water_items='".$input['water_items']."',water_comments='".addslashes($input['water_comments'])."',alcoholic_items1='".$input['alcoholic_items1']."',alcoholic_items2='".$input['alcoholic_items2']."',alcoholic_items3='".$input['alcoholic_items3']."',alcoholic_items4='".$input['alcoholic_items4']."',alcoholic_types='".$input['alcoholic_types']."',alcoholic_comments='".addslashes($input['alcoholic_comments'])."',quantity1='".$input['quantity1']."',quantity2='".$input['quantity2']."',quantity3='".$input['quantity3']."' WHERE guest_lists_UUID='$guest_uuid'");
            }
        }
        
        // charter_guest_spirit_preferences table
        $spiritData = $this->CharterGuestSpiritPreference->find('all', array('conditions' => array('guest_lists_UUID' => $guest_uuid,'charter_program_id'=>$charterHeadProgramId)));
        foreach ($spiritData as $item) {
            $input = array();
            $input = $item['CharterGuestSpiritPreference'];
            $isDeleted = ($input['is_deleted']) ? 1 : 0;
            $checkSpiritExists = $this->CharterGuest->query("SELECT id FROM $yDBName.charter_guest_spirit_preferences WHERE guest_lists_UUID='$guest_uuid' AND charter_program_id = '$charterHeadProgramId' AND is_deleted = 0 AND row_id=".$input['id']);
            if (empty($checkSpiritExists)) { // INSERT
                $this->CharterGuest->query("INSERT INTO $yDBName.charter_guest_spirit_preferences (guest_lists_UUID,charter_program_id,charter_assoc_id,product_list_id,product_id,is_dead,name,tags,price_in_cents,stock_type,primary_category,secondary_category,origin,description,varietal,style,tertiary_category,quantity,is_deleted,created,row_id) VALUES ("."'".$input['guest_lists_UUID']."'".","."'".$input['charter_program_id']."'".",".$input['charter_assoc_id'].",".$input['product_list_id'].",".$input['product_id'].",'".$input['is_dead']."','".addslashes($input['name'])."','".addslashes($input['tags'])."','".$input['price_in_cents']."','".$input['stock_type']."','".$input['primary_category']."','".$input['secondary_category']."','".$input['origin']."','".addslashes($input['description'])."','".$input['varietal']."','".$input['style']."','".$input['tertiary_category']."','".$input['quantity']."',".$isDeleted.",'".$created."',".$input['id'].")");
            } else { // UPDATE
                $this->CharterGuest->query("UPDATE $yDBName.charter_guest_spirit_preferences SET is_deleted=".$isDeleted.",quantity='".$input['quantity']."' WHERE guest_lists_UUID='$guest_uuid' AND charter_program_id = '$charterHeadProgramId' AND row_id=".$input['id']);
            }
        }
        
        // charter_guest_wine_preferences table
        $wineData = $this->CharterGuestWinePreference->find('all', array('conditions' => array('guest_lists_UUID' => $guest_uuid,'charter_program_id'=>$charterHeadProgramId)));
        foreach ($wineData as $item) {
            $input = array();
            $input = $item['CharterGuestWinePreference'];
            $isDeleted = ($input['is_deleted']) ? 1 : 0;
            $checkWineExists = $this->CharterGuest->query("SELECT id FROM $yDBName.charter_guest_wine_preferences WHERE guest_lists_UUID='$guest_uuid' AND charter_program_id = '$charterHeadProgramId' AND is_deleted = 0 AND row_id=".$input['id']);
            if (empty($checkWineExists)) { // INSERT
                $this->CharterGuest->query("INSERT INTO $yDBName.charter_guest_wine_preferences (guest_lists_UUID,charter_program_id,charter_assoc_id,wine_list_id,wine,wine_id,appellation,color,wine_type,country,vintage,score,quantity,region,is_deleted,created,row_id) VALUES ("."'".$input['guest_lists_UUID']."'".","."'".$input['charter_program_id']."'".",".$input['charter_assoc_id'].",".$input['wine_list_id'].",'".addslashes($input['wine'])."','".$input['wine_id']."','".addslashes($input['appellation'])."','".$input['color']."','".$input['wine_type']."','".$input['country']."','".$input['vintage']."','".$input['score']."','".$input['quantity']."','".$input['region']."',".$isDeleted.",'".$created."',".$input['id'].")");
            } else { // UPDATE
                $this->CharterGuest->query("UPDATE $yDBName.charter_guest_wine_preferences SET is_deleted=".$isDeleted.",quantity='".$input['quantity']."' WHERE guest_lists_UUID='$guest_uuid' AND charter_program_id = '$charterHeadProgramId' AND row_id=".$input['id']);
            }
        }

        // charter_guest_itinerary_preferences table
        $itineraryData = $this->CharterGuestItineraryPreference->find('first', array('conditions' => array('guest_lists_UUID' => $guest_uuid,'is_deleted' => 0)));
        if (!empty($itineraryData)) {
            $input = array();
            $input = $itineraryData['CharterGuestItineraryPreference'];
            $checkItineraryExists = $this->CharterGuest->query("SELECT id FROM $yDBName.charter_guest_itinerary_preferences WHERE guest_lists_UUID='$guest_uuid' AND is_deleted = 0");
            if (empty($checkItineraryExists)) { // INSERT
                $this->CharterGuest->query("INSERT INTO $yDBName.charter_guest_itinerary_preferences (guest_lists_UUID,charter_assoc_id,itinerary,itinerary_comments,is_swim,dive_license,is_dive_licence,created) VALUES ("."'".$input['guest_lists_UUID']."'".",".$input['charter_assoc_id'].",'".$input['itinerary']."','".addslashes($input['itinerary_comments'])."','".$input['is_swim']."','".$input['dive_license']."','".$input['is_dive_licence']."','".$created."')");
            } else { // UPDATE
                $this->CharterGuest->query("UPDATE $yDBName.charter_guest_itinerary_preferences SET itinerary='".$input['itinerary']."',itinerary_comments='".addslashes($input['itinerary_comments'])."',is_swim='".$input['is_swim']."',dive_license='".$input['dive_license']."',is_dive_licence='".$input['is_dive_licence']."' WHERE guest_lists_UUID='$guest_uuid'");
            }
        }
        
    }
    
    
    /*
        * Save the Guest and Send email
        * Functionality -  Saving the Charter guest details and send email
        * Developer - Nagarajan
        * Created date - 24-May-2018
        * Modified date - 
    */
    function saveAndSendMail() {
        
        if($this->request->is('ajax')){
            $this->layout = false;
            $this->autoRender = false;
            $this->loadModel('Yacht');
            $result = array();
            $sessiondata = $this->Session->read();
            //echo "<pre>";print_r(($this->request->data)); exit;

            // not resending the mail to that guest, 
            //so on very first time clicking send button will take any other row of guest data typed that also insert to the table without duplication
            // for that this Otherrowdata is added in ajax call, it should work only the first time clicking email button not on resend.
            if(isset($this->request->data['resend']) && $this->request->data['resend'] == 0){
                parse_str($this->request->data['Otherrowdata'], $Otherrowdata);
            }
            $yachtData = $this->Yacht->find('first', array('conditions' => array('id' => $this->request->data['yachtId'])));
            $yachtDbName = $yachtData['Yacht']['ydb_name'];
            if(isset($this->request->data['charter_company_id'])){
                $fleetcompany_id = $this->request->data['charter_company_id'];
            }
            //
            if (isset($this->request->data['headChartererId']) && !empty($this->request->data['headChartererId'])) {
                $insertData = array();
                $insertData['existCharterHeadId'] = $this->request->data['existCharterHeadId'];
                $insertData['charter_guest_id'] = $this->request->data['headChartererId'];
                $insertData['is_head_charterer'] = $this->request->data['isHeadCharterer'];
                $insertData['salutation'] = $this->request->data['salutation'];
                $insertData['first_name'] = $this->request->data['firstName'];
                $insertData['last_name'] = $this->request->data['lastName'];
                $insertData['email'] = $this->request->data['email'];
                $charterAssocId = $this->request->data['charterAssocId']; // Existing charter associate's id
                
                $this->loadModel('CharterGuest');
                
                $this->CharterGuest->set($this->request->data);
                if (!$this->CharterGuest->validates(array('fieldList' => array('email')))) {
                    $result['status'] = "invalid_email";
                } else {
                    
                    // Generate unique token
                    $userToken = $this->uniqueToken(8);
                    if (!empty($insertData['existCharterHeadId'])) { //echo "hhh"; exit;
                        // Updating the Head Charterer details
                        $insertData['id'] = $insertData['existCharterHeadId'];
                        //echo "<pre>"; print_r($insertData); exit;
                        if ($this->CharterGuest->save($insertData)) {
                            //Update the Charter in corresponding yacht database
                            
                            $yachtDb = $yachtDbName;
                            $charterProgId = $this->Session->read('charter_info.CharterGuest.charter_program_id');
                            $this->CharterGuest->query("UPDATE $yachtDb.charter_programs SET first_name='".$insertData['first_name']."',salutation='".$insertData['salutation']."',last_name='".$insertData['last_name']."',email='".$insertData['email']."' WHERE UUID='$charterProgId'");
                                    
                            // Fetching the existing token (Existing Head charterer)
                            $tokenData = $this->CharterGuest->find('first', array('conditions' => array('id' => $insertData['existCharterHeadId'])));
                            $userToken = $tokenData['CharterGuest']['token'];
                            
                            // $existassocdataUUID = $existassocdata['CharterGuestAssociate']['UUID'];
                            // if(isset($existassocdataUUID)){
                            //     $this->CharterGuest->query("UPDATE guest_lists SET first_name='".$insertData['first_name']."',family_name='".$insertData['last_name']."',email='".$insertData['email']."',token='".$insertData['token']."' WHERE UUID='$existassocdataUUID'");
                            // }

                            // Send an email notification to the user
                            $this->sendCharterNotifyMail($insertData,$userToken);
                            if(isset($this->request->data['resend']) && $this->request->data['resend'] == 0){
                                //echo "<pre>";print_r(($Otherrowdata)); exit;
                                $this->saveOtherRowRecord($Otherrowdata,$fleetcompany_id);
                            }
                            // Update email status
                            $this->CharterGuest->save(array('id' => $insertData['id'], 'is_email_sent' => 1));
                            
                            $result['status'] = "success";
                        } else {
                            $result['status'] = "fail";
                            $result['message'] = "Updation failed.";
                        }
                    } else { //echo "aaaa"; exit;
                        $Guestlistuuid = String::uuid();
                        $this->loadModel('CharterGuestAssociate');
                        $insertData['token'] = $userToken;
                        $insertData['charter_guest_id'] = $this->request->data['charterProgramId'];
                        $insertData['charter_program_id'] = $this->request->data['charterProgramId'];
                        $insertData['yacht_id'] = $this->request->data['yachtId'];
                        $insertData['salutation'] = $this->request->data['salutation'];
                        $insertData['fleetcompany_id'] = $this->request->data['charter_company_id'];

                        if (!empty($charterAssocId)) {
                            $insertData['id'] = $charterAssocId;
                        } else {
                            $insertData['UUID'] = $Guestlistuuid;
                            $this->CharterGuestAssociate->create();
                        }

                            $this->loadModel('GuestList');
                            $guestExistdata = $this->GuestList->find('first', array('conditions' => array('first_name' => $insertData['first_name'],'last_name'=>$insertData['last_name'],'email'=>$insertData['email'])));
                            //echo "<pre>"; print_r($guestExistdata); exit;
                            if(empty($guestExistdata)){
                                $guestlistData = array();
                                $guestlistData['last_name'] = $insertData['last_name'];
                                $guestlistData['first_name'] = $insertData['first_name'];
                                $guestlistData['email'] = $insertData['email'];
                                $guestlistData['fleetcompany_id'] = $this->request->data['charter_company_id'];
                                $guestlistData['yacht_id'] = $this->request->data['yachtId'];
                                $guestlistData['token'] = $userToken;
                                $guestlistData['guest_type'] = "Guest";
                                $guestlistData['salutation'] = $insertData['salutation'];
                                $guestlistData['UUID'] = $Guestlistuuid;
                                $this->GuestList->create();
                                //echo "<pre>"; print_r($guestlistData);
                                $this->GuestList->save($guestlistData);
                            }else{
                                if(isset($guestExistdata['GuestList']['token']) && !empty($guestExistdata['GuestList']['token'])){
                                    $insertData['token'] = $guestExistdata['GuestList']['token'];
                                    $userToken = $guestExistdata['GuestList']['token'];
                                }
                                $insertData['UUID'] = $guestExistdata['GuestList']['UUID'];

                                $exists_company_id = $guestExistdata['GuestList']['fleetcompany_id'];
                                if(isset($exists_company_id)){
                                            $explodeCmpid = explode(',',$exists_company_id);
                                }
                                $currentcompanyid[] = $this->request->data['charter_company_id'];
                                $newsetcompanyidarray = array_merge($explodeCmpid, $currentcompanyid);
                                //$newsetcompanyidarray = array_unique($newsetcompanyidarray);
                                if(isset($newsetcompanyidarray)){
                                    $companyimplodeids =  implode(',',$newsetcompanyidarray);
                                }

                                $exists_yacht_id = $guestExistdata['GuestList']['yacht_id'];
                                if(isset($exists_yacht_id)){
                                            $explodeYid = explode(',',$exists_yacht_id);
                                }
                                $currentYid[] = $this->request->data['yachtId'];
                                $newsetYidarray = array_merge($explodeYid, $currentYid);
                                //$newsetYidarray = array_unique($newsetYidarray);
                                if(isset($newsetYidarray)){
                                    $Yimplodeids =  implode(',',$newsetYidarray);
                                }

                                $exists_guest_type = $guestExistdata['GuestList']['guest_type'];
                                if(isset($exists_guest_type)){
                                            $explodeGT = explode(',',$exists_guest_type);
                                }
                                $currentGT[] = $this->request->data['charter_company_id']."-".$this->request->data['yachtId']."-Guest";
                                $newsetGTarray = array_merge($explodeGT, $currentGT);
                                //$newsetGTarray = array_unique($newsetGTarray);
                                if(isset($newsetGTarray)){
                                    $GTimplodeids =  implode(',',$newsetGTarray);
                                }



                                $guestlistData = array();
                                $guestlistData['yacht_id'] = $Yimplodeids;
                                $guestlistData['fleetcompany_id'] = $companyimplodeids;
                                $guestlistData['guest_type'] = $GTimplodeids;
                                $guestlistData['salutation'] = $insertData['salutation'];
                                $guestlistData['id'] = $guestExistdata['GuestList']['id'];
                                if(empty($guestExistdata['GuestList']['token'])){
                                    $guestlistData['token'] =$userToken;
                                }else{
                                    $guestlistData['token'] =$guestExistdata['GuestList']['token'];
                                } 
                                //echo "<pre>"; print_r($guestlistData); exit;
                                $this->GuestList->save($guestlistData);
                            }       

                        //echo "here";
                        //echo "<pre>"; print_r($insertData);
                        //echo "<pre>"; print_r($userToken); exit;
                        // Saving the Charter guest associates
                        if ($this->CharterGuestAssociate->save($insertData)) {
                            if (empty($charterAssocId)) {
                                $charterAssocId = $this->CharterGuestAssociate->getLastInsertId();
                            }

                        //    $existassocdata = $this->CharterGuestAssociate->find('first',array('conditions'=>array('id'=>$charterAssocId)));
                        //    $existassocdataUUID = $existassocdata['CharterGuestAssociate']['UUID'];
                        //     if(isset($existassocdataUUID) && !empty($existassocdataUUID)){
                        //         $this->CharterGuest->query("UPDATE guest_lists SET first_name='".$insertData['first_name']."',last_name='".$insertData['last_name']."',email='".$insertData['email']."' WHERE UUID='$existassocdataUUID'");
                        //     }
                            if (!isset($this->request->data['mailSending'])) {
                                // Send an email notification to the user
                                $this->sendCharterNotifyAssociateGuestMail($insertData,$userToken);
                                // Update email status
                                $this->CharterGuestAssociate->save(array('id' => $charterAssocId, 'is_email_sent' => 1));
                                if(isset($this->request->data['resend']) && $this->request->data['resend'] == 0){
                                    //echo "<pre>";print_r(($Otherrowdata)); exit;
                                    $this->saveOtherRowRecord($Otherrowdata,$fleetcompany_id);
                                }
                            }
                            
                            
                            $result['status'] = "success";
                            $result['assocIdLink'] = "preference?assocId=".base64_encode($charterAssocId);
                            $result['newGuestAssocId'] = $charterAssocId;
                        } else {
                            $result['status'] = "fail";
                            $result['message'] = "Insertion failed.";
                        }
                    }
                }
                
            }
            
        }
        echo json_encode($result);
        exit;
        
    }
            
    //so on very first time clicking send button will take any other row of guest data typed that also insert to the table without duplication
    // for that this Otherrowdata is added in ajax call, it should work only the first time clicking email button not on resend.
    // on send email button on each row of guest this function will call from saveAndSendMail function
    function saveOtherRowRecord($data,$fleetcompany_id){
        
        if (!empty($data['charter_program_id']) && !empty($data['yacht_id']) && !empty($data['charter_guest_id'])) {
            $charterProgramId = $data['charter_program_id'];
            $yachtId = $data['yacht_id'];
            $charterGuestHeadId = $data['charter_guest_id'];
            $sessiondata = $this->Session->read();
            $count = count($data['is_head_charterer_checked']); // Count of input array
                           //echo "<pre>"; echo $count; exit;
            $this->loadModel('CharterGuest');
            $this->loadModel('CharterGuestAssociate');
            $this->loadModel('Yacht');
            $this->loadModel('GuestList');
            
            // Yacht details
            $yachtData = $this->Yacht->find('first', array('conditions' => array('id' => $yachtId)));
            $yachtDbName = $yachtData['Yacht']['ydb_name'];
            $failed = 0;
            for ($i = 0; $i < $count; $i++) {
                
                if ($i == 0) { // Head Charterer
                    // $updateData = array();
                    // $updateData['id'] = $charterGuestHeadId;
                    // $updateData['salutation'] = $headSalutation = $data['salutation'][$i];
                    // //echo "dddddd";exit;
                    // if ($this->CharterGuest->save($updateData)) {
                    //     // Update to the corresponding Yacht DB
                    //     $this->CharterGuest->query("UPDATE $yachtDbName.charter_guests SET salutation='$headSalutation' WHERE guest_row_id=$charterGuestHeadId");
                    // }
                    
                } else {
                    $chkduplicate = $this->GuestList->find('all', array('conditions' => array('last_name' => $data['last_name'][$i],'first_name' => $data['first_name'][$i],'email' => $data['email'][$i])));
                    //if((!empty($data['last_name'][$i]) != $Rlastname) && (!empty($data['first_name'][$i]) != $Rfirstname) && (!empty($data['email'][$i]) != $Remail)){ //echo "ffff"; exit;
                            // Associates
                            //guest_lists table save
                            $Guestlistuuid = "";
                            $guestlistData = array();
                            $guestlistData['last_name'] = $data['last_name'][$i];
                            $guestlistData['first_name'] = $data['first_name'][$i];
                            $guestlistData['email'] = $data['email'][$i];
                            
                            $existCharterassocData = $this->CharterGuestAssociate->find('all', array('conditions' => array('last_name' => $data['last_name'][$i],'first_name' => $data['first_name'][$i],'email' => $data['email'][$i])));
                            $guestlistData['salutation'] =$data['salutation'][$i];
                        if(empty($chkduplicate)){
                            $guestlistData['fleetcompany_id'] = $fleetcompany_id;
                            $guestlistData['yacht_id'] = $yachtId;
                            $guestlistData['type'] = "Guest";
                                $Guestlistuuid = String::uuid();
                                $guestlistData['UUID'] = $Guestlistuuid;
                                
                                
                                $this->GuestList->create();
                        }else{

                                $existcharterassocUUID = $chkduplicate[0]['GuestList']['UUID'];
                                $guestExistdata = $this->GuestList->find('first', array('conditions' => array('UUID' => $existcharterassocUUID)));
                                $existingGuestListPrimaryId = $guestExistdata['GuestList']['id'];
                                $guestlistData['id'] = $existingGuestListPrimaryId;
                        }
                       // echo "<pre>";print_r($guestlistData); //exit;
                        if (!empty($guestlistData['first_name']) && !empty($guestlistData['last_name']) && !empty($guestlistData['email'])) {
                                // if(empty($data['is_head_charterer_checked'][$i])){
                                //     $data['is_head_charterer_checked'][$i] = 0;
                                // }
                                if(!empty($data['is_head_charterer_checked'][$i])){
                                    $savedGuestdata = $this->GuestList->save($guestlistData);
                                }
                        }
                        
                        //guest_lists table save

                            $charterAssocId = "";
                            $insertDataOther = array();
                            $insertDataOther['is_head_charterer'] = $data['is_head_charterer_checked'][$i];
                            $insertDataOther['salutation'] = $data['salutation'][$i];
                            $insertDataOther['first_name'] = $data['first_name'][$i];
                            $insertDataOther['last_name'] = $data['last_name'][$i];
                            $insertDataOther['email'] = $data['email'][$i];
                            
                            // Check whether the assoc is already added
                            if (isset($existCharterassocData) && !empty($existCharterassocData)) {
                                $insertDataOther['id'] = $charterAssocId = $existCharterassocData[0]['CharterGuestAssociate']['id'];
                            } else {
                                $insertDataOther['charter_program_id'] = $charterProgramId;
                                $insertDataOther['yacht_id'] = $yachtId;
                                $insertDataOther['fleetcompany_id'] = $fleetcompany_id;
                                $insertDataOther['charter_guest_id'] = $charterProgramId;
                                if(isset($savedGuestdata['GuestList']['UUID'])){
                                    $insertDataOther['UUID'] = $savedGuestdata['GuestList']['UUID'];
                                }
                                $this->CharterGuestAssociate->create();
                            }

                            if (!empty($insertDataOther['salutation']) && !empty($insertDataOther['first_name']) && !empty($insertDataOther['last_name']) && !empty($insertDataOther['email'])) {
                            // check weather head charter is checked or not
                                // if(empty($insertDataOther['is_head_charterer'])){
                                //     $insertDataOther['is_head_charterer'] = 0;
                                // }
                                if(!empty($insertDataOther['is_head_charterer'])){
                                    if ($this->CharterGuestAssociate->save($insertDataOther)) {
                                        if (empty($charterAssocId)) {
                                            $charterAssocId = $this->CharterGuestAssociate->getLastInsertId();
                                        }
                                        // Check whether the P-sheet is done
                                        $assocDataCount = $this->CharterGuestAssociate->find('count', array('conditions' => array('is_psheets_done' => 1, 'id' => $charterAssocId)));
                                        if ($assocDataCount) { // IF P-sheet is done
                                            // Update the details into corresponding Yacht DB
                                            $this->CharterGuest->query("UPDATE $yachtDbName.charter_guest_associates SET is_head_charterer='".$insertDataOther['is_head_charterer']."',salutation='".$insertDataOther['salutation']."',first_name='".$insertDataOther['first_name']."',last_name='".$insertDataOther['last_name']."',email='".$insertDataOther['email']."' WHERE assoc_row_id=$charterAssocId");
                                        }
                                    }
                                }else{
                                        // not able to save atleast one record.
                                        $failed++;
                                }
                            }

                    //}
                }
                 
            } //exit;
            // //echo $failed; exit;
            // if($failed == 0){
            //     $result['status'] = "success";
            // }else{
            //     $result['status'] = "failed";
            // }
        }

    }
    
    /*
        * Save the Guest associates
        * Functionality -  Saving the new guest associates
        * Developer - Nagarajan
        * Created date - 09-July-2018
        * Modified date - 
    */
    function saveGuests() {
        
        if($this->request->is('ajax')){
            $this->layout = false;
            $this->autoRender = false;
            $result = array();
            $sessiondata = $this->Session->read();
            //echo "<pre>";print_r($this->request->data);exit;
            if (!empty($this->request->data['charter_program_id']) && !empty($this->request->data['yacht_id']) && !empty($this->request->data['charter_guest_id'])) {
                $charterProgramId = $this->request->data['charter_program_id'];
                $yachtId = $this->request->data['yacht_id'];
                $charterGuestHeadId = $this->request->data['charter_guest_id'];
                $charter_company_id = $this->request->data['charter_company_id'];
                
                $data = $this->request->data;
                
                $count = count($data['is_head_charterer_checked']); // Count of input array
                               //echo "<pre>"; echo $count; exit;
                $this->loadModel('CharterGuest');
                $this->loadModel('CharterGuestAssociate');
                $this->loadModel('Yacht');
                $this->loadModel('GuestList');
                
                // Yacht details
                $yachtData = $this->Yacht->find('first', array('conditions' => array('id' => $yachtId)));
                $yachtDbName = $yachtData['Yacht']['ydb_name'];
                $failed = 0;
                for ($i = 0; $i < $count; $i++) {
                    
                    if ($i == 0) { // Head Charterer
                        $updateData = array();
                        $updateData['id'] = $charterGuestHeadId;
                        $updateData['salutation'] = $headSalutation = $data['salutation'][$i];
                        
                        if ($this->CharterGuest->save($updateData)) {
                            // Update to the corresponding Yacht DB
                            $this->CharterGuest->query("UPDATE $yachtDbName.charter_programs SET salutation='$headSalutation' WHERE UUID='$charterProgramId'");
                        }
                            // update head charter salutation to guest list table
                            $guestHeadExistdata = $this->GuestList->find('first', array('conditions' => array('first_name' => $data['first_name'][0],'last_name'=>$data['last_name'][0],'email'=>$data['email'][0])));
                            if(isset($guestHeadExistdata) && !empty($guestHeadExistdata)){
                                $guestlistHDataArray = array();
                                $guestlistHDataArray['id'] = $guestHeadExistdata['GuestList']['id'];
                                $guestlistHDataArray['salutation'] = $data['salutation'][0];
                                $this->GuestList->save($guestlistHDataArray);
                            }
                        
                    } else { // Associates
                        //guest_lists table save
                        $Guestlistuuid = "";
                        $guestlistData = array();
                        $guestlistData['last_name'] = $data['last_name'][$i];
                        $guestlistData['first_name'] = $data['first_name'][$i];
                        $guestlistData['email'] = $data['email'][$i];
                        $guestlistData['salutation'] = $data['salutation'][$i];
                        if(empty($data['charter_assoc_id'][$i])){
                            $guestExistdata = $this->GuestList->find('first', array('conditions' => array('first_name' => $data['first_name'][$i],'last_name'=>$data['last_name'][$i],'email'=>$data['email'][$i])));
                            if(isset($guestExistdata) && !empty($guestExistdata)){
                                $Guestlistuuid = $guestExistdata['GuestList']['UUID'];
                                $exists_company_id = $guestExistdata['GuestList']['fleetcompany_id'];
                                    if(isset($exists_company_id)){
                                                $explodeCmpid = explode(',',$exists_company_id);
                                    }
                                    $currentcompanyid = array();
                                    $currentcompanyid[] = $charter_company_id;
                                    $newsetcompanyidarray = array_merge($explodeCmpid, $currentcompanyid);
                                    //$newsetcompanyidarray = array_unique($newsetcompanyidarray);
                                    if(isset($newsetcompanyidarray)){
                                        $companyimplodeids =  implode(',',$newsetcompanyidarray);
                                    }

                                    $exists_yacht_id = $guestExistdata['GuestList']['yacht_id'];
                                    if(isset($exists_yacht_id)){
                                                $explodeYid = explode(',',$exists_yacht_id);
                                    }
                                    $currentYid = array();
                                    $currentYid[] = $yachtId;
                                    $newsetYidarray = array_merge($explodeYid, $currentYid);
                                    //$newsetYidarray = array_unique($newsetYidarray);
                                    if(isset($newsetYidarray)){
                                        $Yimplodeids =  implode(',',$newsetYidarray);
                                    }

                                    $exists_guest_type = $guestExistdata['GuestList']['guest_type'];
                                    if(isset($exists_guest_type)){
                                                $explodeGT = explode(',',$exists_guest_type);
                                    }
                                    $currentGT = array();
                                    $currentGT[] = $charter_company_id."-".$yachtId."-Guest";
                                    $newsetGTarray = array_merge($explodeGT, $currentGT);
                                    //$newsetGTarray = array_unique($newsetGTarray);
                                    if(isset($newsetGTarray)){
                                        $GTimplodeids =  implode(',',$newsetGTarray);
                                    }
                                    $guestlistData['fleetcompany_id'] = $companyimplodeids;
                                    $guestlistData['yacht_id'] = $Yimplodeids;
                                    $guestlistData['type'] = $GTimplodeids;
                                $guestlistData['UUID'] = $Guestlistuuid;
                                $guestlistData['id'] = $guestExistdata['GuestList']['id'];
                            }else{
                                $guestlistData['fleetcompany_id'] = $charter_company_id;
                                $guestlistData['yacht_id'] = $yachtId;
                                $guestlistData['type'] = "Guest";
                                $Guestlistuuid = String::uuid();
                                $guestlistData['UUID'] = $Guestlistuuid;
                            }
                            
                            $this->GuestList->create();
                       }else{
                            $existCharterassocData = $this->CharterGuestAssociate->find('first', array('conditions' => array('id' => $data['charter_assoc_id'][$i])));

                            $existcharterassocUUID = $existCharterassocData['CharterGuestAssociate']['UUID'];
                            $guestExistdata = $this->GuestList->find('first', array('conditions' => array('UUID' => $existcharterassocUUID)));
                            $existingGuestListPrimaryId = $guestExistdata['GuestList']['id'];
                            $guestlistData['id'] = $existingGuestListPrimaryId;
                       }

                       if (!empty($guestlistData['first_name']) && !empty($guestlistData['last_name']) && !empty($guestlistData['email'])) {

                            if(!empty($data['is_head_charterer_checked'][$i])){
                                $savedGuestdata = $this->GuestList->save($guestlistData);
                            }
                       }
                       //echo "<pre>";print_r($savedGuestdata); exit;
                       //guest_lists table save

                        $charterAssocId = "";
                        $insertData = array();
                        $insertData['is_head_charterer'] = $data['is_head_charterer_checked'][$i];
                        $insertData['salutation'] = $data['salutation'][$i];
                        $insertData['first_name'] = $data['first_name'][$i];
                        $insertData['last_name'] = $data['last_name'][$i];
                        $insertData['email'] = $data['email'][$i];
                        
                        // Check whether the assoc is already added
                        if (isset($data['charter_assoc_id'][$i]) && !empty($data['charter_assoc_id'][$i])) {
                            $insertData['id'] = $charterAssocId = $data['charter_assoc_id'][$i];
                        } else {
                            $insertData['charter_program_id'] = $charterProgramId;
                            $insertData['yacht_id'] = $yachtId;
                            $insertData['fleetcompany_id'] = $charter_company_id;
                            $insertData['charter_guest_id'] = $charterProgramId;
                            if(isset($savedGuestdata['GuestList']['UUID'])){
                                $insertData['UUID'] = $savedGuestdata['GuestList']['UUID'];
                            }
                            $this->CharterGuestAssociate->create();
                        }

                        if (!empty($insertData['salutation']) && !empty($insertData['first_name']) && !empty($insertData['last_name']) && !empty($insertData['email'])) {
                           // check weather head charter is checked or not
                            if(!empty($insertData['is_head_charterer'])){
                            if ($this->CharterGuestAssociate->save($insertData)) {
                                if (empty($charterAssocId)) {
                                    $charterAssocId = $this->CharterGuestAssociate->getLastInsertId();
                                }
                                // Check whether the P-sheet is done
                                $assocDataCount = $this->CharterGuestAssociate->find('count', array('conditions' => array('is_psheets_done' => 1, 'id' => $charterAssocId)));
                                if ($assocDataCount) { // IF P-sheet is done
                                    // Update the details into corresponding Yacht DB
                                    $this->CharterGuest->query("UPDATE $yachtDbName.charter_guest_associates SET is_head_charterer='".$insertData['is_head_charterer']."',salutation='".$insertData['salutation']."',first_name='".$insertData['first_name']."',last_name='".$insertData['last_name']."',email='".$insertData['email']."' WHERE assoc_row_id=$charterAssocId");
                                }
                            }
                           }else{
                                // not able to save atleast one record.
                                $failed++;
                           }
                        }
                    }
                     
                }
                //echo $failed; exit;
                if($failed == 0){
                    $result['status'] = "success";
                }else{
                    $result['status'] = "failed";
                }
            }
        }   
        echo json_encode($result);
        exit;
    }     
    
    
        /*
     * Charter Program Map ipad app view
     * Functionality -  Loading the Charter program ipad app view
     * Developer - Nagarajan
     * Created date - 28-May-2018
     * Modified date - 
     */
    function charter_program_map_app($prgUUID = null,$yachtdb = null) {
        //        echo "<pre>";print_r($this->Session->read());exit;
                Configure::write('debug',0);
                $session = $this->Session->read('charter_info');
                $yachtDbName = $yachtdb;
                $charterProgramId = $prgUUID;
                if (!empty($yachtDbName)) {
                   
                    $this->loadModel('CharterGuest');
                    $charterProgData = $this->CharterGuest->query("SELECT * FROM $yachtDbName.charter_programs CharterProgram WHERE UUID = '$charterProgramId' AND is_deleted = 0 LIMIT 1");
                   // echo "<pre>";print_r($charterProgData);exit;
                    if (count($charterProgData) != 0) {
                        $startDate = $charterProgData[0]['CharterProgram']['charter_from_date'];
                        $endDate = $charterProgData[0]['CharterProgram']['charter_to_date'];
                        $diff = date_diff(date_create($endDate), date_create($startDate));
                        $diffDays = $diff->days + 1;
                        
                        // Fetching the Charter program schedules
                        //$scheduleData = $this->CharterGuest->query("SELECT * FROM $yachtDbName.charter_program_schedules CharterProgramSchedule WHERE charter_program_id = '$charterProgramId' AND is_deleted = 0");
                        // Declare two dates
                        $Date1 = $startDate;
                        $Date2 = $endDate;
                        
                        // Declare an empty array
                        $Datesarray = array();
                        
                        // Use strtotime function
                        $Variable1 = strtotime($Date1);
                        $Variable2 = strtotime($Date2);
                        
                        // Use for loop to store dates into array
                        // 86400 sec = 24 hrs = 60*60*24 = 1 day
                        $i = 1;
                        for ($currentDate = $Variable1; $currentDate <= $Variable2; 
                                                        $currentDate += (86400)) {
                                                            
                        $Store = date('d M Y',$currentDate);
                        $Datesarray[$i] = $Store;
                        $i++;
                        }
                        
                        // Display the dates in array format
                        //echo "<pre>";print_r($Datesarray); //exit;
        
                        $scheduleConditions = "charter_program_id = '$charterProgramId' AND is_deleted = 0";
                        $scheduleData = $this->CharterGuest->getCharterProgramScheduleData($yachtDbName, $scheduleConditions);
                        echo "<pre>";print_r($scheduleData); exit;
                        $markertitle = array();
                        $markername = array();
                        $samelocations = array();
                        $samelocationsScheduleUUID = array();
                        $samelocationsDates = array();
                        $samemarkercommentcount = array();
                        $samedayrouteorder = array();
                        if(isset($scheduleData)){
                            foreach($scheduleData as $key => $publishmap){
                                    if($publishmap['CharterProgramSchedule']['publish_map'] == 1){
                                        $modified = date('d M Y',strtotime($publishmap['CharterProgramSchedule']['modified']));
                                        $username_modified = $publishmap['CharterProgramSchedule']['username_modified'];
        
                                    }
                                    if($Datesarray[$publishmap['CharterProgramSchedule']['day_num']]){
                                        $scheduleData[$key]['CharterProgramSchedule']['day_dates'] = $Datesarray[$publishmap['CharterProgramSchedule']['day_num']];
                                    }
                                    $samedayrouteorder[$publishmap['CharterProgramSchedule']['title'].' - Day '.$publishmap['CharterProgramSchedule']['day_num']] = $publishmap['CharterProgramSchedule']['day_num'];
                                   //$mcount = $this->getmsgnotifycountForMarker($publishmap['CharterProgramSchedule']['UUID']);
                                   $scheduleData[$key]['CharterProgramSchedule']['marker_msg_count'] = $this->CharterGuest->getCharterMarkerCommentCount($yachtDbName,$publishmap['CharterProgramSchedule']['UUID']);
        
                                   $markertitle[$publishmap['CharterProgramSchedule']['id']] = $publishmap['CharterProgramSchedule']['title'].' - Day '.$publishmap['CharterProgramSchedule']['day_num'];
                                   $markername[$publishmap['CharterProgramSchedule']['title']] = $publishmap['CharterProgramSchedule']['title'];

                                    $samelocations[$publishmap['CharterProgramSchedule']['lattitude']][] = "Day ".$scheduleData[$key]['CharterProgramSchedule']['day_num']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$scheduleData[$key]['CharterProgramSchedule']['day_dates']; //same location
                                    $samelocationsScheduleUUID[$publishmap['CharterProgramSchedule']['title']][] = $publishmap['CharterProgramSchedule']['UUID']; //same location
                                    $samelocationsDates[$publishmap['CharterProgramSchedule']['title']][] = $scheduleData[$key]['CharterProgramSchedule']['day_dates']; //same location
                                    $samemarkercommentcount[$publishmap['CharterProgramSchedule']['lattitude']] += $scheduleData[$key]['CharterProgramSchedule']['marker_msg_count']; //same location
                            
                                }
                        }
        
                        $YachtData =  $this->CharterGuest->query("SELECT * FROM $yachtDbName.yachts Yacht");
                        //echo "<pre>";print_r($YachtData); exit;
                        $cruising_speed = $YachtData[0]['Yacht']['cruising_speed'];
                        $cruising_fuel = $YachtData[0]['Yacht']['cruising_fuel'];
                        $yacht_id_fromyachtDB = $YachtData[0]['Yacht']['id'];
                        //echo $YachtData['Yacht']['cruising_unit'];
                        if(isset($YachtData[0]['Yacht']['cruising_unit']) && $YachtData[0]['Yacht']['cruising_unit'] != '0' ){
                         $cruising_unit = $YachtData[0]['Yacht']['cruising_unit'];
                        }
                        //echo "<pre>";print_r($markername); exit;
                        $Routeorderdata = array();
                        // if(isset($samedayrouteorder) && !empty($samedayrouteorder)){
                        //     asort($samedayrouteorder);
                        //     }
                        if(isset($samedayrouteorder) && !empty($samedayrouteorder)){
                            foreach($samedayrouteorder as $title => $value){
                                $fetchData = $this->CharterGuest->query("SELECT * FROM $yachtDbName.charter_program_schedule_routes CharterProgramScheduleRoute WHERE charter_program_schedule_uuid = '$charterProgramId' AND is_deleted = 0  AND start_location= '$title'");
                                //echo "<pre>";print_r($fetchData); exit;
                                //$fetchData = $this->CharterProgramScheduleRoute->find('all', array('conditions' => array('charter_program_schedule_uuid' => $charterProgramId, 'is_deleted' => 0,'start_location'=>$value)));
                                $Routeorderdata[] = $fetchData;
                                
                            }

                            foreach($samedayrouteorder as $title => $value){
                                $fetchData = $this->CharterGuest->query("SELECT * FROM $yachtDbName.charter_program_schedule_routes CharterProgramScheduleRoute WHERE charter_program_schedule_uuid = '$charterProgramId' AND is_deleted = 0  AND start_location= '$title'");
                                //echo "<pre>";print_r($fetchData); exit;
                                //$fetchData = $this->CharterProgramScheduleRoute->find('all', array('conditions' => array('charter_program_schedule_uuid' => $charterProgramId, 'is_deleted' => 0,'start_location'=>$value)));
                                $Routeorderdatatemp[$title][] = $fetchData;
                                
                            }

                            $temploc = array();
                            if(!empty($Routeorderdatatemp)){
                                foreach($Routeorderdatatemp as $title => $value){
                                    if(!empty($value[0])){
                                        //echo "<pre>";print_r($value[0]);
                                        
                                        foreach($value[0] as $v){
                                            $temploc[$v['CharterProgramScheduleRoute']['start_location'].'_'.$v['CharterProgramScheduleRoute']['end_location']][] = "[".$v['CharterProgramScheduleRoute']['longitude'].",".$v['CharterProgramScheduleRoute']['lattitude']."]";
                                        }
                                    }

                                }
                            }
                            
                            $RouteData = array();
                            if(isset($Routeorderdata) && !empty($Routeorderdata)){
                                foreach($Routeorderdata as $key => $value){
                                    foreach($value as $v){
                                        $RouteData[] = $v;
                                    }
                                }
                             }
                        }
                        //echo "<pre>";print_r($RouteData); exit;
                        if(isset($RouteData) && !empty($RouteData)){
                            $routecount = count($RouteData);
                            $totaldistance = array();
                            $markerdistance = array();
                            $markerduration = array();
                            $markerconsumption = array();
                            foreach($RouteData as $key => $value){
                                $kv = $key+1;
                                if($kv < $routecount){
                                    
                                    // $lat1 = $RouteData[$key]['CharterProgramScheduleRoute']['lattitude'];
                                    // $lon1 = $RouteData[$key]['CharterProgramScheduleRoute']['longitude'];
                                    // $lat2 = $RouteData[$key+1]['CharterProgramScheduleRoute']['lattitude'];
                                    // $lon2 = $RouteData[$key+1]['CharterProgramScheduleRoute']['longitude'];
                                    // $unit = "nmi";
                                   $distance = $RouteData[$key]['CharterProgramScheduleRoute']['distance'];
                                   if(isset($distance) && !empty($distance)){
                                    $d_res = floatval($distance);
                                   }
                                   $markerdistance[$RouteData[$key]['CharterProgramScheduleRoute']['start_location']][] = $d_res;
                                   $markertotal[$RouteData[$key]['CharterProgramScheduleRoute']['start_location']]['distance'] = $RouteData[$key]['CharterProgramScheduleRoute']['distance'];
                                   $markertotal[$RouteData[$key]['CharterProgramScheduleRoute']['start_location']]['duration'] = $RouteData[$key]['CharterProgramScheduleRoute']['duration'];
                                   $markertotal[$RouteData[$key]['CharterProgramScheduleRoute']['start_location']]['consumption'] = $RouteData[$key]['CharterProgramScheduleRoute']['fuelconsumption'];
                                   $markertotal[$RouteData[$key]['CharterProgramScheduleRoute']['start_location']]['endplace'] = $RouteData[$key]['CharterProgramScheduleRoute']['end_location'];
                                   $totaldistance[$RouteData[$key]['CharterProgramScheduleRoute']['start_location']] = $d_res;
                                //    $RouteData[$key]['CharterProgramScheduleRoute']['distance'] = round($distance, 2);
                                //    $RouteData[$key]['CharterProgramScheduleRoute']['duration'] = "";
                                //    $RouteData[$key]['CharterProgramScheduleRoute']['consumption'] = "";
                                //    if(isset($distance) && !empty($distance) && isset($cruising_speed) && !empty($cruising_speed) ){
                                //         $plainduration = $distance / $cruising_speed;
                                //         $duration = ($distance / $cruising_speed ) * 3600;
                                //         $h = floor($duration/3600);
                                //         $m = floor(($duration / 60) % 60);
                                //         $s = $duration % 60;
                                //         $displayduration = $h."h&nbsp".$m."m&nbsp";
                                //         $RouteData[$key]['CharterProgramScheduleRoute']['duration'] = $displayduration;
        
                                //         if(isset($cruising_fuel) && !empty($cruising_fuel)){
                                //             $consumption = $plainduration * $cruising_fuel;
                                //             $consumption = round($consumption, 2);
                                //             $RouteData[$key]['CharterProgramScheduleRoute']['consumption'] = $consumption." ".$cruising_unit;
                                //         }
                                //    }
                                }
                            }
                            // if(isset($markerdistance) && !empty($markerdistance)){
                                
        
                            //     foreach($markerdistance as $title => $data){
                            //         $total = 0;
                            //         foreach($data as $v){
                            //             //echo "<pre>";print_r($v);
                            //             $total += $v;
                            //             $markertotal[$title]['distance'] = round($total, 2);
                            //         }
                            //     }
        
                            //     foreach($markertotal as $title => $data){
                                    
                            //         $totalplainduration_marker = $data['distance'] / $cruising_speed;
                            //         $duration_m = ($data['distance'] / $cruising_speed ) * 3600;
                            //         $h = floor($duration_m/3600);
                            //         $m = floor(($duration_m / 60) % 60);
                            //         $s = $duration_m % 60;
                            //         $totaldisplayduration_m = $h."h  ".$m."m";
                            //         $markertotal[$title]['duration'] = $totaldisplayduration_m;
                                    
                            //         if(isset($cruising_fuel) && !empty($cruising_fuel)){
                            //             $totalconsumption_m = $totalplainduration_marker * $cruising_fuel;
                            //             $totalconsumption_mv = round($totalconsumption_m, 2);
                            //             $RouteDatatotalconsumption_m = $totalconsumption_mv." ".$cruising_unit;
                            //             $markertotal[$title]['consumption'] = $RouteDatatotalconsumption_m;
                            //         }
                            //         //echo "<pre>";print_r($markertotal); exit;
                            //     }
                            // }
                            //total
                            //echo "<pre>";print_r($markertotal); exit;
                             $totaldistancevalue = array_sum($totaldistance);
                            $RouteDatadisplaydistancevalue = number_format($totaldistancevalue, 1).'nm';
                            if(isset($totaldistancevalue) && !empty($totaldistancevalue) && isset($cruising_speed) && !empty($cruising_speed) ){
                                $totalplainduration = $totaldistancevalue / $cruising_speed;
                                $duration = ($totaldistancevalue / $cruising_speed ) * 3600;
                                $h = floor($duration/3600);
                                $m = floor(($duration / 60) % 60);
                                $s = $duration % 60;
                                $totaldisplayduration = $h."h&nbsp".$m."m&nbsp";
                                $RouteDatadisplayduration = $totaldisplayduration;
        
                                if(isset($cruising_fuel) && !empty($cruising_fuel)){
                                    $totalconsumption = $totalplainduration * $cruising_fuel;
                                    $totalconsumption = round($totalconsumption, 2);
                                    if(isset($cruising_unit) && !empty($cruising_unit)){
                                        $RouteDatatotalconsumption = number_format($totalconsumption)." ".$cruising_unit;
                                    }else{
                                        $RouteDatatotalconsumption = number_format($totalconsumption);
                                    }
                                }
                           }
                            //exit;
                        }
                        //echo "<pre>";print_r($scheduleData);
                        //echo "<pre>";print_r($markertitle); exit;
                        $fromtoConditions = "charter_program_id = '$charterProgramId' AND is_deleted = 0";
                        $fromtoquery = "SELECT * FROM $yachtDbName.charter_program_schedules CharterProgramSchedule WHERE $fromtoConditions order by day_num";
                        $fromtoresult = $this->CharterGuest->query($fromtoquery);
                        $crusingModaltitle = array();
                        foreach($fromtoresult as $key => $title){
                            $crusingModaltitle[$title['CharterProgramSchedule']['id']] = htmlspecialchars($title['CharterProgramSchedule']['title']);
                        }
                        //echo "<pre>";print_r($crusingModaltitle);  exit;
                        $first = reset($crusingModaltitle);
                        $last = end($crusingModaltitle);
                      
                        $this->set('startloc', $first);
                        $this->set('endloc', $last);
                        $this->set('Datesarray', $Datesarray);
    
                        $this->set('samelocations', $samelocations);
                        $this->set('samelocationsScheduleUUID', $samelocationsScheduleUUID);
                        $this->set('samelocationsDates', $samelocationsDates);
                        $this->set('samemarkercommentcount', $samemarkercommentcount);

                        $this->set('charterProgramId', $charterProgramId);
                        $this->set('charterProgData', $charterProgData[0]);
                        $this->set('diffDays', $diffDays);
                        $this->set('scheduleData', $scheduleData);
                        $this->set('modified', $modified);
                        $this->set('temploc', $temploc);
                        $this->set('RouteData', $RouteData);
                        $this->set('RouteDatadisplaydistancevalue', $RouteDatadisplaydistancevalue);
                        $this->set('RouteDatadisplayduration', $RouteDatadisplayduration);
                        $this->set('RouteDatatotalconsumption', $RouteDatatotalconsumption);
                        $this->set('username_modified', $username_modified);
                        $this->set('markertitle', $markertitle);
                        $this->set('markertotal', $markertotal);
                        $this->set('yacht_id_fromyachtDB', $yacht_id_fromyachtDB);
                        
                        $this->set('guesttype', "guest");
                        $this->set('cruising_speed', $cruising_speed);
                        $this->set('cruising_fuel', $cruising_fuel);
                        if(isset($cruising_unit) && !empty($cruising_unit)){
                        $this->set('cruising_unit', $cruising_unit);
                        }
                    } else {
                        $this->redirect(array('action' => 'view'));
                    }
                    
                } else {
                    $no_cruising_select  = "NO CRUISING SCHEDULE IS SELECTED";
                    $this->set('no_cruising_select', $no_cruising_select);
                }
                
            }
    
    /*
     * Charter Program Map view
     * Functionality -  Loading the Charter program Map view 
     * Developer - Nagarajan
     * Created date - 28-May-2018
     * Modified date - 
     */
    function charter_program_map($prgUUID,$yachtdb,$guesttype) {
//        echo "<pre>";print_r($this->Session->read());exit;
        Configure::write('debug',0);
        $session = $this->Session->read('charter_info');
        
        // echo "<pre>";print_r($sessionAssoc);exit;
        if (empty($session)) {
             $this->redirect(array('controller' => 'Charters', 'action' => 'index'));
        }
        $yachtDbName = $yachtdb;
        $charterProgramId = $prgUUID;
        if (!empty($yachtDbName)) {
            $this->loadModel('CharterProgramFile');
            $this->loadModel('CharterGuest');
            
            $charterProgData = $this->CharterGuest->query("SELECT * FROM $yachtDbName.charter_programs CharterProgram WHERE UUID = '$charterProgramId' AND is_deleted = 0 LIMIT 1");
            
            $charterGuestDataToMenu = $this->CharterGuest->find("first",array('conditions'=>array('charter_program_id'=>$charterProgramId)));

            if(isset($guesttype) && ($guesttype == "owner")){ 
                    $guestlink = "/charters/view/".$charterGuestDataToMenu['CharterGuest']['id']."/".$charterGuestDataToMenu['CharterGuest']['charter_program_id']."/".$charterGuestDataToMenu['CharterGuest']['charter_company_id'];
            }else if(isset($guesttype) && ($guesttype == "guest")){ 
                    $guestlink = "/charters/view_guest/".$charterGuestDataToMenu['CharterGuest']['charter_program_id']."/".$charterGuestDataToMenu['CharterGuest']['charter_company_id'];
            }

            $this->set('guestlink', $guestlink);

            if (count($charterProgData) != 0) {
                $startDate = $charterProgData[0]['CharterProgram']['charter_from_date'];
                $endDate = $charterProgData[0]['CharterProgram']['charter_to_date'];
                $diff = date_diff(date_create($endDate), date_create($startDate));
                $diffDays = $diff->days + 1;
                
                // Fetching the Charter program schedules
                //$scheduleData = $this->CharterGuest->query("SELECT * FROM $yachtDbName.charter_program_schedules CharterProgramSchedule WHERE charter_program_id = '$charterProgramId' AND is_deleted = 0");
                // Declare two dates
                $Date1 = $startDate;
                $Date2 = $endDate;
                
                // Declare an empty array
                $Datesarray = array();
                
                // Use strtotime function
                $Variable1 = strtotime($Date1);
                $Variable2 = strtotime($Date2);
                
                // Use for loop to store dates into array
                // 86400 sec = 24 hrs = 60*60*24 = 1 day
                $i = 1;
                for ($currentDate = $Variable1; $currentDate <= $Variable2; 
                                                $currentDate += (86400)) {
                                                    
                $Store = date('d M Y',$currentDate);
                $Datesarray[$i] = $Store;
                $i++;
                }
                
                // Display the dates in array format
                //echo "<pre>";print_r($Datesarray); //exit;

                $scheduleConditions = "charter_program_id = '$charterProgramId' AND is_deleted = 0";
                $scheduleData = $this->CharterGuest->getCharterProgramScheduleData($yachtDbName, $scheduleConditions);
                //echo "<pre>";print_r($scheduleData); exit;
                $markertitle = array();
                $markername = array();
                $samelocations = array();
                $samelocationsScheduleUUID = array();
                $samelocationsDates = array();
                $samemarkercommentcount = array();
                $samedayrouteorder = array();
                if(isset($scheduleData)){
                    foreach($scheduleData as $key => $publishmap){
                            if($publishmap['CharterProgramSchedule']['publish_map'] == 1){
                                $modified = date('d M Y',strtotime($publishmap['CharterProgramSchedule']['modified']));
                                $username_modified = $publishmap['CharterProgramSchedule']['username_modified'];

                            }
                            if($Datesarray[$publishmap['CharterProgramSchedule']['day_num']]){
                                $scheduleData[$key]['CharterProgramSchedule']['day_dates'] = $Datesarray[$publishmap['CharterProgramSchedule']['day_num']];
                            }
                            $samedayrouteorder[$publishmap['CharterProgramSchedule']['title'].' - Day '.$publishmap['CharterProgramSchedule']['day_num']] = $publishmap['CharterProgramSchedule']['day_num'];
                           //$mcount = $this->getmsgnotifycountForMarker($publishmap['CharterProgramSchedule']['UUID']);
                           $scheduleData[$key]['CharterProgramSchedule']['marker_msg_count'] = $this->CharterGuest->getCharterMarkerCommentCount($yachtDbName,$publishmap['CharterProgramSchedule']['UUID']);

                           $markertitle[$publishmap['CharterProgramSchedule']['id']] = $publishmap['CharterProgramSchedule']['title'].' - Day '.$publishmap['CharterProgramSchedule']['day_num'];
                           $markername[$publishmap['CharterProgramSchedule']['title']] = $publishmap['CharterProgramSchedule']['title'];

                            $samelocations[$publishmap['CharterProgramSchedule']['lattitude']][] = "Day ".$scheduleData[$key]['CharterProgramSchedule']['day_num']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$scheduleData[$key]['CharterProgramSchedule']['day_dates']; //same location
                            $samelocationsScheduleUUID[$publishmap['CharterProgramSchedule']['title']][] = $publishmap['CharterProgramSchedule']['UUID']; //same location
                            $samelocationsDates[$publishmap['CharterProgramSchedule']['title']][] = $scheduleData[$key]['CharterProgramSchedule']['day_dates']; //same location
                            $samemarkercommentcount[$publishmap['CharterProgramSchedule']['lattitude']] += $scheduleData[$key]['CharterProgramSchedule']['marker_msg_count']; //same location
                    
                        }
                }

                $YachtData =  $this->CharterGuest->query("SELECT * FROM $yachtDbName.yachts Yacht");
                //echo "<pre>";print_r($YachtData); exit;
                $cruising_speed = $YachtData[0]['Yacht']['cruising_speed'];
                $cruising_fuel = $YachtData[0]['Yacht']['cruising_fuel'];
                $yacht_id_fromyachtDB = $YachtData[0]['Yacht']['id'];
                //echo $YachtData['Yacht']['cruising_unit'];
                
                $image = $YachtData[0]['Yacht']['cg_background_image'];
                $fleetname = $YachtData[0]['Yacht']['fleetname'];
                $yachtname = $YachtData[0]['Yacht']['yname'];
                if(isset($YachtData[0]['Yacht']['domain_name'])){
                $domain_name = $YachtData[0]['Yacht']['domain_name'];
                }
                if(isset($domain_name) && $domain_name == "charterguest"){
                    $SITE_URL = "https://charterguest.net/";
                }else{
                    $SITE_URL = "https://totalsuperyacht.com:8080/";
                }
                $cgBackgroundImage = $this->getBackgroundImageUrl($image, $fleetname, $yachtname,$SITE_URL);
                $this->Session->write("cgBackgroundImage", $cgBackgroundImage);
                
                if(isset($YachtData[0]['Yacht']['cruising_unit']) && $YachtData[0]['Yacht']['cruising_unit'] != '0' ){
                 $cruising_unit = $YachtData[0]['Yacht']['cruising_unit'];
                }
                //echo "<pre>";print_r($markername); exit;
                $Routeorderdata = array();
                // if(isset($samedayrouteorder) && !empty($samedayrouteorder)){
                //     asort($samedayrouteorder);
                //     }
                if(isset($samedayrouteorder) && !empty($samedayrouteorder)){
                    foreach($samedayrouteorder as $title => $value){
                        $fetchData = $this->CharterGuest->query("SELECT * FROM $yachtDbName.charter_program_schedule_routes CharterProgramScheduleRoute WHERE charter_program_schedule_uuid = '$charterProgramId' AND is_deleted = 0  AND start_location= '$title'");
                        //echo "<pre>";print_r($fetchData); exit;
                        //$fetchData = $this->CharterProgramScheduleRoute->find('all', array('conditions' => array('charter_program_schedule_uuid' => $charterProgramId, 'is_deleted' => 0,'start_location'=>$value)));
                        $Routeorderdata[] = $fetchData;
                        
                    }

                    foreach($samedayrouteorder as $title => $value){
                        $fetchData = $this->CharterGuest->query("SELECT * FROM $yachtDbName.charter_program_schedule_routes CharterProgramScheduleRoute WHERE charter_program_schedule_uuid = '$charterProgramId' AND is_deleted = 0  AND start_location= '$title'");
                        //echo "<pre>";print_r($fetchData); exit;
                        //$fetchData = $this->CharterProgramScheduleRoute->find('all', array('conditions' => array('charter_program_schedule_uuid' => $charterProgramId, 'is_deleted' => 0,'start_location'=>$value)));
                        $Routeorderdatatemp[$title][] = $fetchData;
                        
                    }

                    $temploc = array();
                    if(!empty($Routeorderdatatemp)){
                        foreach($Routeorderdatatemp as $title => $value){
                            if(!empty($value[0])){
                                //echo "<pre>";print_r($value[0]);
                                
                                foreach($value[0] as $v){
                                    $temploc[$v['CharterProgramScheduleRoute']['start_location'].'_'.$v['CharterProgramScheduleRoute']['end_location']][] = "[".$v['CharterProgramScheduleRoute']['longitude'].",".$v['CharterProgramScheduleRoute']['lattitude']."]";
                                }
                            }

                        }
                    }
                    
                    $RouteData = array();
                    if(isset($Routeorderdata) && !empty($Routeorderdata)){
                        foreach($Routeorderdata as $key => $value){
                            foreach($value as $v){
                                $RouteData[] = $v;
                            }
                        }
                     }
                }
                //echo "<pre>";print_r($RouteData); exit;
                if(isset($RouteData) && !empty($RouteData)){
                    $routecount = count($RouteData);
                    $totaldistance = array();
                    $markerdistance = array();
                    $markerduration = array();
                    $markerconsumption = array();
                    foreach($RouteData as $key => $value){
                        $kv = $key+1;
                        if($kv < $routecount){
                            
                            // $lat1 = $RouteData[$key]['CharterProgramScheduleRoute']['lattitude'];
                            // $lon1 = $RouteData[$key]['CharterProgramScheduleRoute']['longitude'];
                            // $lat2 = $RouteData[$key+1]['CharterProgramScheduleRoute']['lattitude'];
                            // $lon2 = $RouteData[$key+1]['CharterProgramScheduleRoute']['longitude'];
                            // $unit = "nmi";
                           $distance = $RouteData[$key]['CharterProgramScheduleRoute']['distance'];
                           if(isset($distance) && !empty($distance)){
                            $d_res = floatval($distance);
                           }
                           $markerdistance[$RouteData[$key]['CharterProgramScheduleRoute']['start_location']][] = $d_res;
                           $markertotal[$RouteData[$key]['CharterProgramScheduleRoute']['start_location']]['distance'] = $RouteData[$key]['CharterProgramScheduleRoute']['distance'];
                           $markertotal[$RouteData[$key]['CharterProgramScheduleRoute']['start_location']]['duration'] = $RouteData[$key]['CharterProgramScheduleRoute']['duration'];
                           $markertotal[$RouteData[$key]['CharterProgramScheduleRoute']['start_location']]['consumption'] = $RouteData[$key]['CharterProgramScheduleRoute']['fuelconsumption'];
                           $markertotal[$RouteData[$key]['CharterProgramScheduleRoute']['start_location']]['endplace'] = $RouteData[$key]['CharterProgramScheduleRoute']['end_location'];
                           $totaldistance[$RouteData[$key]['CharterProgramScheduleRoute']['start_location']] = $d_res;
                        //    $RouteData[$key]['CharterProgramScheduleRoute']['distance'] = round($distance, 2);
                        //    $RouteData[$key]['CharterProgramScheduleRoute']['duration'] = "";
                        //    $RouteData[$key]['CharterProgramScheduleRoute']['consumption'] = "";
                        //    if(isset($distance) && !empty($distance) && isset($cruising_speed) && !empty($cruising_speed) ){
                        //         $plainduration = $distance / $cruising_speed;
                        //         $duration = ($distance / $cruising_speed ) * 3600;
                        //         $h = floor($duration/3600);
                        //         $m = floor(($duration / 60) % 60);
                        //         $s = $duration % 60;
                        //         $displayduration = $h."h&nbsp".$m."m&nbsp";
                        //         $RouteData[$key]['CharterProgramScheduleRoute']['duration'] = $displayduration;

                        //         if(isset($cruising_fuel) && !empty($cruising_fuel)){
                        //             $consumption = $plainduration * $cruising_fuel;
                        //             $consumption = round($consumption, 2);
                        //             $RouteData[$key]['CharterProgramScheduleRoute']['consumption'] = $consumption." ".$cruising_unit;
                        //         }
                        //    }
                        }
                    }
                    // if(isset($markerdistance) && !empty($markerdistance)){
                        

                    //     foreach($markerdistance as $title => $data){
                    //         $total = 0;
                    //         foreach($data as $v){
                    //             //echo "<pre>";print_r($v);
                    //             $total += $v;
                    //             $markertotal[$title]['distance'] = round($total, 2);
                    //         }
                    //     }

                    //     foreach($markertotal as $title => $data){
                            
                    //         $totalplainduration_marker = $data['distance'] / $cruising_speed;
                    //         $duration_m = ($data['distance'] / $cruising_speed ) * 3600;
                    //         $h = floor($duration_m/3600);
                    //         $m = floor(($duration_m / 60) % 60);
                    //         $s = $duration_m % 60;
                    //         $totaldisplayduration_m = $h."h  ".$m."m";
                    //         $markertotal[$title]['duration'] = $totaldisplayduration_m;
                            
                    //         if(isset($cruising_fuel) && !empty($cruising_fuel)){
                    //             $totalconsumption_m = $totalplainduration_marker * $cruising_fuel;
                    //             $totalconsumption_mv = round($totalconsumption_m, 2);
                    //             $RouteDatatotalconsumption_m = $totalconsumption_mv." ".$cruising_unit;
                    //             $markertotal[$title]['consumption'] = $RouteDatatotalconsumption_m;
                    //         }
                    //         //echo "<pre>";print_r($markertotal); exit;
                    //     }
                    // }
                    //total
                    //echo "<pre>";print_r($markertotal); exit;
                     $totaldistancevalue = array_sum($totaldistance);
                    $RouteDatadisplaydistancevalue = number_format($totaldistancevalue, 1).'nm';
                    if(isset($totaldistancevalue) && !empty($totaldistancevalue) && isset($cruising_speed) && !empty($cruising_speed) ){
                        $totalplainduration = $totaldistancevalue / $cruising_speed;
                        $duration = ($totaldistancevalue / $cruising_speed ) * 3600;
                        $h = floor($duration/3600);
                        $m = floor(($duration / 60) % 60);
                        $s = $duration % 60;
                        $totaldisplayduration = $h."h&nbsp".$m."m&nbsp";
                        $RouteDatadisplayduration = $totaldisplayduration;

                        if(isset($cruising_fuel) && !empty($cruising_fuel)){
                            $totalconsumption = $totalplainduration * $cruising_fuel;
                            $totalconsumption = round($totalconsumption, 2);
                            if(isset($cruising_unit) && !empty($cruising_unit)){
                                $RouteDatatotalconsumption = number_format($totalconsumption)." ".$cruising_unit;
                            }else{
                                $RouteDatatotalconsumption = number_format($totalconsumption);
                            }
                        }
                   }
                    //exit;
                }

                $this->loadModel('Fleetcompany');
                $companyData = $this->Fleetcompany->find('first', array('fields' => array('management_company_name','logo','fleetname'), 'conditions' => array('id' => $charterProgData[0]['CharterProgram']['charter_company_id'])));
                if (isset($companyData['Fleetcompany']['logo']) && !empty($companyData['Fleetcompany']['logo'])) {
                    $fleetLogoUrl = $SITE_URL.'/'."charterguest/img/logo/thumb/".$companyData['Fleetcompany']['logo'];
                } else{
                    $fleetLogoUrl = $SITE_URL.'/'."charterguest/img/logo/thumb/charter_guest_logo.png";
                }
                $this->Session->write("fleetLogoUrl", $fleetLogoUrl);
                
                //echo "<pre>";print_r($scheduleData);
                //echo "<pre>";print_r($markertotal); exit;
                $fromtoConditions = "charter_program_id = '$charterProgramId' AND is_deleted = 0";
                $fromtoquery = "SELECT * FROM $yachtDbName.charter_program_schedules CharterProgramSchedule WHERE $fromtoConditions order by day_num";
                $fromtoresult = $this->CharterGuest->query($fromtoquery);
                $crusingModaltitle = array();
                foreach($fromtoresult as $key => $title){
                    $crusingModaltitle[$title['CharterProgramSchedule']['id']] = htmlspecialchars($title['CharterProgramSchedule']['title']);
                }
                //echo "<pre>";print_r($crusingModaltitle);  exit;
                $first = reset($crusingModaltitle);
                $last = end($crusingModaltitle);
                $this->set('startloc', $first);
                $this->set('endloc', $last);
                $this->set('Datesarray', $Datesarray);

                $this->set('samelocations', $samelocations);
                $this->set('samelocationsScheduleUUID', $samelocationsScheduleUUID);
                $this->set('samelocationsDates', $samelocationsDates);
                $this->set('samemarkercommentcount', $samemarkercommentcount);

                $this->set('charterProgramId', $charterProgramId);
                $this->set('charter_company_id_val', $charterProgData[0]['CharterProgram']['charter_company_id']);
                $this->set('charterProgData', $charterProgData[0]);
                $this->set('diffDays', $diffDays);
                $this->set('scheduleData', $scheduleData);
                $this->set('modified', $modified);
                $this->set('temploc', $temploc);
                $this->set('RouteData', $RouteData);
                $this->set('RouteDatadisplaydistancevalue', $RouteDatadisplaydistancevalue);
                $this->set('RouteDatadisplayduration', $RouteDatadisplayduration);
                $this->set('RouteDatatotalconsumption', $RouteDatatotalconsumption);
                $this->set('username_modified', $username_modified);
                $this->set('markertitle', $markertitle);
                $this->set('markertotal', $markertotal);
                $this->set('yacht_id_fromyachtDB', $yacht_id_fromyachtDB);
                $this->set('guesttype', $guesttype);
                $this->set('charterGuestDataToMenu', $charterGuestDataToMenu);
                
                $this->set('cruising_speed', $cruising_speed);
                $this->set('cruising_fuel', $cruising_fuel);
                if(isset($cruising_unit) && !empty($cruising_unit)){
                $this->set('cruising_unit', $cruising_unit);
                }
                $usersUUID = $this->Session->read("guestListUUID");
                $CharterGuestConditions = array('users_UUID' => $usersUUID);
                $charterGuestData = $this->CharterGuest->find('all', array('conditions' => $CharterGuestConditions, 'order' => 'CharterGuest.charter_from_date desc'));
        
                    $programFiles  = array();
                    $mapdetails = array();
                    //$SITE_URL = Configure::read('BASE_URL');
                // echo "<pre>";print_r($guestListData); //exit;
                    // echo "<pre>";print_r($charterGuestData); exit;
                    if(isset($charterGuestData) && !empty($charterGuestData)){
                    
                        foreach($charterGuestData as $key => $value){

                            $programFilesCond = array('CharterProgramFile.charter_program_id' => $value['CharterGuest']['charter_program_id'],'CharterProgramFile.yacht_id' => $value['CharterGuest']['yacht_id'],'CharterProgramFile.is_deleted'=>0);
                            $programFiledata = $this->CharterProgramFile->find('all', array('conditions' => $programFilesCond));
                            $charter_from_date = date("d M Y", strtotime($value['CharterGuest']['charter_from_date']));
                            if(isset($programFiledata)){
                                $programFiles[$charter_from_date]['attachment'] = $programFiledata;
                                //$programFiles[]['startdate'] = $charter_from_date;
                            }
                            
                            $charter_company_id = $value['CharterGuest']['charter_company_id'];
                            if(isset($charter_company_id) && !empty($charter_company_id)){
                                $companyData1 = $this->Fleetcompany->find('first', array('fields' => array('management_company_name','logo','fleetname'), 'conditions' => array('id' => $charter_company_id)));
                                $fleetname1 = $companyData1['Fleetcompany']['fleetname'];
                            }
                            if(isset($programFiledata) && isset($fleetname1) && !empty($fleetname1)){
                                $programFiles[$charter_from_date]['fleetname'] = $fleetname1;
                            }
                        }//exit;
                        //echo "<pre>";print_r($programFiles); exit;

                        

                        // $fleetname = $this->Session->read('fleetname');
                        if(isset($programFiles) && !empty($programFiles) ){
                            $attachment = array();
                            //$SITE_URL = Configure::read('BASE_URL');
                            foreach($programFiles as $startdate => $filedata){ 
                                foreach($filedata['attachment'] as $file){ 
                                    $fleetname = $this->Session->read('fleetname');
                                    if(isset($filedata['fleetname'])){
                                        $fleetname = $filedata['fleetname'];
                                    }
                                    $sourceImagePath = $SITE_URL.'/'.$fleetname."/app/webroot/img/charter_program_files/".$file['CharterProgramFile']['file_name'];
                                    $attachment[$startdate] = $sourceImagePath;
                
                                }
                            } 
                        }

                    }
                    //echo "<pre>";print_r($attachment); exit;
                    if(isset($attachment) && !empty($attachment)){
                        $this->set('programFiles', $attachment);
                    }

            } else {
                $this->redirect(array('action' => 'view'));
            }
            
        } else {
            $this->redirect(array('action' => 'view'));
        }
        
    }
    
    /*
     * Load the Charter Program Schedules for Edit
     * Functionality -  Loading the Charter program schedules with existing details
     * Developer - Nagarajan
     * Created date - 28-May-2018
     * Modified date - 
     */
    function editCharterProgramSchedules() {
        
        if($this->request->is('ajax')){
            //echo "<pre>";print_r($this->request->data); exit;
            $session = $this->Session->read('charter_info');
            //$yachtDbName = $session['CharterGuest']['ydb_name'];
            $result = array();
            if (isset($this->request->data['programId']) && !empty($this->request->data['programId']) && !empty($this->request->data['diffDays'])) {
                $programId = $this->request->data['programId'];
                $scheduleId = $this->request->data['scheduleId'];
                $diffDays = $this->request->data['diffDays'];
                if(isset($this->request->data['guesttype'])){
                    $guesttype = $this->request->data['guesttype'];
                }

                $tablepId = $this->request->data['tablepId'];

                $daytitle = $this->request->data['daytitle'];
                $counttitle = $this->request->data['counttitle'];
                $scheduleSameLocationUUID = $this->request->data['scheduleSameLocationUUID'];
                $samelocationsDates = $this->request->data['samelocationsDates'];
                $fromlocationcard = $this->request->data['from'];
                //$selecteddatetext = $this->request->data['selecteddatetext'];


                $popupHtml = '';
                $this->loadModel('CharterGuest');
                $this->loadModel('Yacht');
                $chprgdata = $this->CharterGuest->find('first',array('conditions'=>array('CharterGuest.charter_program_id'=>$programId)));
                $yacht_id = $chprgdata['CharterGuest']['yacht_id'];
                $yachtCond = array('Yacht.id' => $yacht_id);
                $Ydata = $this->Yacht->find('first', array('conditions' => $yachtCond));
                $yachtDbName = $Ydata['Yacht']['ydb_name'];
                $yname = $Ydata['Yacht']['yname'];
                $fleetcompanyid = $Ydata['Yacht']['fleetcompany_id'];
                        $this->loadModel("Fleetcompany");
                        if(isset($fleetcompanyid) && $fleetcompanyid != 0){
                        $fleetcompanydetails = $this->Fleetcompany->find('first',array('conditions'=>array('id'=>$fleetcompanyid)));
                        $fleetSiteName = $fleetcompanydetails['Fleetcompany']['fleetname'];
                        }
                        $schUUIDs  =  explode(",",$scheduleSameLocationUUID);
                        $samelocationsDatesarr  =  explode(",",$samelocationsDates);
                        //$samelocationsDatestext = $samelocationsDatesarr[0]; 
                if($fromlocationcard == "locationcard"){ //clicking from marker or location card
                    if($counttitle > 1){
                        $scheduleId = $schUUIDs[0]; 
                    }
                }elseif($fromlocationcard == "daysselection"){ // selection from marker popup
                    //$samelocationsDatestext = $selecteddatetext;
                }
                        
                        
                        $no_of_days_options = "";
                        foreach($schUUIDs as $key => $uuid){
                            $scheduleConditionschk = "UUID = '$uuid' AND is_deleted = 0";
                            $scheduleDataGetNum = $this->CharterGuest->getCharterProgramScheduleData($yachtDbName, $scheduleConditionschk);
                            $scheduleDataNum = $scheduleDataGetNum[0]['CharterProgramSchedule']['day_num'];
                            if($scheduleDataNum > 9){
                                $space = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            }else{
                                $space = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            }
                            if($scheduleId ==  $uuid){
                                $no_of_days_options .= '<option value="'.$uuid.'" selected>Day '.$scheduleDataNum.$space.$samelocationsDatesarr[$key].'</option>';
                            }else{
                                $no_of_days_options .= '<option value="'.$uuid.'">Day '.$scheduleDataNum.$space.$samelocationsDatesarr[$key].'</option>';
                            }
                        }

                $scheduleData = $this->CharterGuest->query("SELECT * FROM $yachtDbName.charter_program_schedules CharterProgramSchedule WHERE UUID = '$scheduleId' AND is_deleted = 0 LIMIT 1");
                //echo "<pre>";print_r($scheduleData); exit;
                $basefolder = $this->request->base;
                if (count($scheduleData) != 0) {
                    $title = htmlspecialchars($scheduleData[0]['CharterProgramSchedule']['title']);
                    $dayNum = $scheduleData[0]['CharterProgramSchedule']['day_num'];
                    $programScheduleUUID = $scheduleData[0]['CharterProgramSchedule']['UUID'];
                    $isFleetUser = $this->Session->read('loggedUserInfo.is_fleet');
                    $userType = $this->Session->read('loggedUserInfo.user_type');

                    $notes = $scheduleData[0]['CharterProgramSchedule']['notes'];
                    $attachment = $scheduleData[0]['CharterProgramSchedule']['attachment'];
                    if(isset($notes) && !empty($notes)){
                        $noteexist = "style='display:block;'";
                    }else{
                        $noteexist = "style='display:none;'";
                    }
                    if(isset($attachment) && !empty($attachment)){
                        $noteimg = "style='display:block;'";
                        if($yname == "yacht"){
                            $targetFullPath = BASE_URL.'/SOS/app/webroot/betayacht/app/webroot/img/charter_program_files/itinerary_photos/'.$attachment;
                        }else{
                            $targetFullPath = BASE_URL.'/'.$yname."/app/webroot/img/charter_program_files/itinerary_photos/".$attachment;
                            if (!empty($fleetSiteName)) { // IF yacht is under any Fleet
                                $targetFullPath = BASE_URL.'/'.$fleetSiteName."/app/webroot/".$yname."/app/webroot/img/charter_program_files/itinerary_photos/".$attachment;
                            }
                        }

                        $titleimage = $targetFullPath;
                        $titleimagehref = $targetFullPath;
                        $fancybox = "fancybox";
                    }else{
                        $noteimg = "style='display:none;'";
                        $titleimage = BASE_URL.'/charterguest/app/webroot/img/noimage.png';
                        $titleimagehref = "#";
                        $fancybox = "";
                    }

                    $CruisingMapCommentConditons = "activity_id = '$programScheduleUUID' AND activity_name = '$title' AND type = 'schedule' AND publish_map = '1'";
                         $commentdatatitle = $this->CharterGuest->getCruisingMapComment($yachtDbName, $CruisingMapCommentConditons);
                    //}
                      if(isset($commentdatatitle[0]) && !empty($commentdatatitle[0])){
                        $commentcounttitle = count($commentdatatitle);
                      }
                      else{
                          $commentcounttitle = 0;
                      }
                      $colorcodetitle = "";  
                      if($commentcounttitle > 0){ //echo "kkkk";
                          $colorcodetitle = "color:green;";
                          //echo $is_fleet;
                          
                                if(trim($scheduleData[0]['CharterProgramSchedule']['is_crew_commented']) == 1 || trim($scheduleData[0]['CharterProgramSchedule']['is_fleet_commented']) == 1){  //echo "lll";
                                    $colorcodetitle = "color:red;";
                                }
                           
                      }else{
                            $colorcodetitle = "";   
                      }

                    $popupHtml = '';
                    $readonly = "readonly";
                    if(isset($guesttype) && $guesttype == "guest"){
                            $displaynone = "display:none;";
                    }else{
                            $displaynone = "display:block;";
                    }
                    $popupHtml .= '<div class="mapPopup sp-mp-detailsrow sp-modal-600" data-schuuid="'.$scheduleId.'">
                    <div class="sp-modal-hd"><div class="row"><div class="col-md-8"><select name="noofdayscard" class="form-control noofdayscard wt-st" style="font-size: 17px !important;font-weight: bold;background:none !important;color:#000 !important;border:solid 1px #ddd !important;"></select></div></div></div>
                    <form id="scheduleFormEdit"><div class="inputContainerdiv">
                    <div class="sp-divrow">
                    <div class="sp-60-w">
                    <input type="text" name="title" value="'.htmlspecialchars($title).'" placeholder="Enter the Title" class="" '.$readonly.' style="color: #000;font-size: 15px;border: solid 1px #ccc;width:100%;margin: 0px;padding: 8px 5px;font-weight: 600;">
                    <textarea class="form-control textareacontmarker" style="background: #eee !important;color: #000!important;border: solid 1px rgb(243 243 243 / 70%)!important;" name="messagestitle" '.$readonly.' rows="4" cols="50">'.htmlspecialchars($notes).'</textarea>
                    </div>
                    <div class="sp-40-w">
                    <div class="sp-upload-img">
                    <a href="'.$titleimagehref.'" class="'.$fancybox.'"><img src="'.$titleimage.'" style="object-fit: fill; height: 150px;" alt="" ></a>
                    </div>
                    <ul class="action-icon"><li><i class="fa fa-comments crew_comment_cruisingmaptitle"  style="'.$colorcodetitle.$displaynone.'" data-rel="'.$scheduleData[0]['CharterProgramSchedule']['UUID'].'" data-yachtid="'.$yacht_id.'" data-tempname="'.htmlspecialchars($scheduleData[0]['CharterProgramSchedule']['title']).'"><input type="hidden" name=commentstitle value="" class="messagecommentstitle" /></i></li></ul>
                    </div>
                    </div>';
                    $popupHtml .= '<input type="hidden" name="schedule_id" value="'.$scheduleId.'"><input type="hidden" class="form-control" name="day_num" id="dayNum" value="'.$dayNum.'">';
                    $popupHtml .= '<input type="hidden" name="yacht_id" value="'.$yacht_id.'">';
                    // $popupHtml .= '<input type="hidden" name="markerNum" id="markerNum" value="'.$this->request->data['markerNum'].'">';
                    // $popupHtml .= '<input type="hidden" id="lattitude" value="'.$this->request->data['lattitude'].'">';
                    // $popupHtml .= '<input type="hidden" id="longitude" value="'.$this->request->data['longitude'].'">';
                    $popupHtml .= '<input type="hidden" id="charterprogramuuid" value="'.$scheduleData[0]['CharterProgramSchedule']['charter_program_id'].'">';

            //         $readonly = "readonly";
            //         $popupHtml .= '<div class="mapPopup"><h4>'.$title.'</h4><form id="scheduleFormEdit"><div class="inputContainer">';
            //         $popupHtml .= '<input type="hidden" name="schedule_id" value="'.$scheduleId.'">';
            //         $popupHtml .= '<input type="hidden" name="markerNum" id="markerNum" value="'.$this->request->data['markerNum'].'">';
            //         $popupHtml .= '<input type="hidden" id="lattitude" value="'.$this->request->data['lattitude'].'">';
            //         $popupHtml .= '<input type="hidden" id="longitude" value="'.$this->request->data['longitude'].'">';
                    
            //         $titleHtml = '<div class="flex-row">
            //         <div class="sp-left"><input type="text" name="title" value="'.$title.'" placeholder="Enter the Title" class="form-control titleFieldClass" '.$readonly.'>';
            //         $daysHtml = '<input class="form-control dayFieldClass" value="Day '.$dayNum.'" '.$readonly.'></div><ul class="action-icon">
            //         <li class="notesmaptitle" data-notestitle="'.$notes.'"><span class="fleetAdminIcon-note note-icon-items"  '.$noteexist.'></span>
            //         <input type="hidden" name="messagestitle" value="'.$notes.'" class="messagestitle"/>
            //         <input type="hidden" name="messageFiletitle" value="'.$attachment.'" class="messageFiletitle" /></li>
            //         <li><span class="gallery"><a href="'.$titleimage.'" class="'.$fancybox.'"><img src="'.BASE_URL.$basefolder.'/app/webroot/img/admin/gallery.png" '.$noteimg.'></a></span></li>
            //         <li><span></span></li>
            //     </ul>
            // </div>';
                    
                    // $popupHtml .= $titleHtml;
                    // $popupHtml .= $daysHtml;
                    
                    // $scheduleData = $this->CharterGuest->query("SELECT * FROM $yachtDbName.charter_program_schedules CharterProgramSchedule WHERE id = '$tablepId'");
                    // //echo "<pre>";print_r($scheduleData);exit;
                    // if(isset($scheduleData) && !empty($scheduleData)){    
                    //     $scuuid = array();
                    //     foreach($scheduleData as $value){
                    //     $sch_uuid = $value['CharterProgramSchedule']['UUID'];
                    //     $scuuid[] = "'".$sch_uuid."'";
                    //     }
                    //     $sch_inarray = "";
                    //     if(isset($scuuid) && !empty($scuuid)){
                    //             $sch_inarray = implode(',',$scuuid);
                    //     }
                    // }
                    //print_r($sch_inarray); 
                    //echo "SELECT * FROM $yachtDbName.charter_program_schedule_activities CharterProgramScheduleActivity WHERE charter_program_schedule_id IN ($sch_inarray)"; exit;
                    $activityData = $this->CharterGuest->query("SELECT * FROM $yachtDbName.charter_program_schedule_activities CharterProgramScheduleActivity WHERE charter_program_schedule_id = '$programScheduleUUID' AND is_deleted = 0");
                    if (count($activityData) != 0) {
                        foreach ($activityData as $activity) {

                            $activitynotes = $activity['CharterProgramScheduleActivity']['notes'];
                            if(isset($activitynotes) && !empty($activitynotes)){
                                $activitynotesgreen = "style='display:block;'";
                            }else{
                                $activitynotesgreen = "style='display:none;'";
                            }
                            $activityattachment = $activity['CharterProgramScheduleActivity']['attachment'];
                            if(isset($activityattachment) && !empty($activityattachment)){
                                $activityattachmentimg = "style='display:block;'";
                                if($yname == "yacht"){
                                    $targetFullPath = BASE_URL.'/SOS/app/webroot/betayacht/app/webroot/img/charter_program_files/itinerary_photos/'.$activityattachment;
                                }else{
                                        $targetFullPath = BASE_URL.'/'.$yname."/app/webroot/img/charter_program_files/itinerary_photos/".$activityattachment;
                                        if (!empty($fleetSiteName)) { // IF yacht is under any Fleet
                                            $targetFullPath = BASE_URL.'/'.$fleetSiteName."/app/webroot/".$yname."/app/webroot/img/charter_program_files/itinerary_photos/".$activityattachment;
                                        }
                                }

                                $activityattachmentimage = $targetFullPath;
                                $activityattachmentimagehref = $targetFullPath;
                                $activityfancybox = "fancybox";
                            }else{
                                $activityattachmentimg = "style='display:none;'";
                                $activityattachmentimage = BASE_URL.'/charterguest/app/webroot/img/noimage.png';
                                $activityattachmentimagehref = "#";
                                $activityfancybox = "";
                            }

                            $activity_id_chk = $activity['CharterProgramScheduleActivity']['id']; 
                            $activity_UUID_chk = $activity['CharterProgramScheduleActivity']['UUID'];  
                            $activity_name_id_chk = str_replace("'", "", $activity['CharterProgramScheduleActivity']['activity_name']);    
                            $activity_name_id_chk = str_replace('"', "", $activity_name_id_chk);     
                            $CruisingMapCommentConditons = "activity_id = '$activity_UUID_chk' AND activity_name = '$activity_name_id_chk' AND type = 'activity' AND publish_map = '1'";
                            $commentdata = $this->CharterGuest->getCruisingMapComment($yachtDbName, $CruisingMapCommentConditons);                 
                            //}
                                $commentcount = 0;
                              if(isset($commentdata) && !empty($commentdata)){
                                $commentcount = count($commentdata);
                              }
                              else{
                                  $commentcount = 0;
                              }
                              $colorcode = "";
                              if($commentcount > 0){
                                $colorcode = "color:green;";
                               
                                    if(trim($activity['CharterProgramScheduleActivity']['is_crew_commented']) == 1 || trim($activity['CharterProgramScheduleActivity']['is_fleet_commented']) == 1){  
                                        $colorcode = "color:red;";
                                    }
                                
                                  
                              }else{
                                $colorcode = "";
                              }

                            $popupHtml .= '<div class="sp-divrow"><div class="sp-60-w"><input type="text" name="activity_name[]" '.$readonly.' style="color: #000;font-size: 15px;border: solid 1px #ccc;width:100%;margin: 0px;padding: 8px 5px;font-weight: 600;" value="'.htmlspecialchars($activity['CharterProgramScheduleActivity']['activity_name']).'"><input type="hidden" name="activity_id[]" value="'.$activity['CharterProgramScheduleActivity']['UUID'].'"><textarea class="form-control textareacontmarker" '.$readonly.' style="background: #eee !important;color: #000!important;border: solid 1px rgb(243 243 243 / 70%)!important;" name="messages[]" rows="4" cols="50">'.htmlspecialchars($activity['CharterProgramScheduleActivity']['notes']).'</textarea></div><div class="sp-40-w"><div class="sp-upload-img"><a href="'.$activityattachmentimagehref.'" class="'.$activityfancybox.'"><img src="'.$activityattachmentimage.'" style="object-fit: fill; height: 150px;" alt=""></a></div><ul class="action-icon"><li><i class="fa fa-comments crew_comment_cruisingmap" style="'.$colorcode.$displaynone.'" data-rel="'.$activity['CharterProgramScheduleActivity']['UUID'].'" data-yachtid="'.$yacht_id.'" data-tempname="'.htmlspecialchars($activity['CharterProgramScheduleActivity']['activity_name']).'" title="Comments & Feedback"><input type="hidden" name=comments[] value="" class="messagecomments" /></i></li></ul></div></div>
                             ';
                        }
                    }
                    
                    $popupHtml .= '</div></form>';
                    $actionsHtml = '<div class="sp-modal-footer"> ';
                    $actionsHtml = '<button id="closeSchedule" type="button" class="btn btn-success">Close</button></div>';
                                        
                    $popupHtml .= $actionsHtml;
                    $popupHtml .= '</form></div>';
                    
                    $result['status'] = "success";
                    $result['popupHtml'] = $popupHtml;
                    $result['no_of_days_options'] = $no_of_days_options;
                    $result['fromlocationcard'] = $fromlocationcard;
                    //echo "<pre>";print_r($result); exit;
                }
                
            }
            echo json_encode($result);
            exit;
        }
    }



        /*
     * Load the Charter Program Schedules for Edit
     * Functionality -  Loading the Charter program schedules with existing details
     * Developer - Nagarajan
     * Created date - 28-May-2018
     * Modified date - 
     */
    function getIpadViewCharterProgramSchedules() {
        
        if($this->request->is('ajax')){
            $session = $this->Session->read('charter_info');
            //$yachtDbName = $session['CharterGuest']['ydb_name'];
            //echo "<pre>";print_r($this->request->data);
            $result = array();
            if (isset($this->request->data['scheduleId']) && !empty($this->request->data['scheduleId'])) {
              $scheduleId = $this->request->data['scheduleId'];
                
                $popupHtml = '';
                $this->loadModel('CharterGuest');
                $this->loadModel('Yacht');
                $chprgdata = $this->CharterGuest->find('first',array('conditions'=>array('CharterGuest.charter_program_id'=>$scheduleId)));
                //echo "<pre>";print_r($chprgdata); exit;
                $yacht_id = $chprgdata['CharterGuest']['yacht_id'];
                $yachtCond = array('Yacht.id' => $yacht_id);
                $Ydata = $this->Yacht->find('first', array('conditions' => $yachtCond));
                $yachtDbName = $Ydata['Yacht']['ydb_name'];
                $yname = $Ydata['Yacht']['yname'];
                $fleetcompanyid = $Ydata['Yacht']['fleetcompany_id'];
                        $this->loadModel("Fleetcompany");
                        if(isset($fleetcompanyid) && $fleetcompanyid != 0){
                        $fleetcompanydetails = $this->Fleetcompany->find('first',array('conditions'=>array('id'=>$fleetcompanyid)));
                        $fleetSiteName = $fleetcompanydetails['Fleetcompany']['fleetname'];
                        }
                $scheduleAllData = $this->CharterGuest->query("SELECT * FROM $yachtDbName.charter_program_schedules CharterProgramSchedule WHERE charter_program_id = '$scheduleId' AND is_deleted = 0 order by day_num");
               // echo "<pre>";print_r($scheduleData); exit;
                $basefolder = $this->request->base;
                if (count($scheduleAllData) != 0) {
                    $popupHtml = '';
                    foreach($scheduleAllData as $scheduleData){
                        $title = $scheduleData['CharterProgramSchedule']['title'];
                        $dayNum = $scheduleData['CharterProgramSchedule']['day_num'];
                        $programScheduleUUID = $scheduleData['CharterProgramSchedule']['UUID'];
                        $isFleetUser = $this->Session->read('loggedUserInfo.is_fleet');
                        $userType = $this->Session->read('loggedUserInfo.user_type');

                        $notes = $scheduleData['CharterProgramSchedule']['notes'];
                        $attachment = $scheduleData['CharterProgramSchedule']['attachment'];
                        if(isset($notes) && !empty($notes)){
                            $noteexist = "style='display:block;'";
                        }else{
                            $noteexist = "style='display:none;'";
                        }
                        if(isset($attachment) && !empty($attachment)){
                            $noteimg = "style='display:block;'";
                            // if($yname == "yacht"){
                            //     $targetFullPath = BASE_URL.'/SOS/app/webroot/betayacht/app/webroot/img/charter_program_files/itinerary_photos/'.$attachment;
                            // }else{
                                $targetFullPath = BASE_URL.'/'.$yname.'/app/webroot/img/charter_program_files/itinerary_photos/'.$attachment;
                                if (!empty($fleetSiteName)) { // IF yacht is under any Fleet
                                    $targetFullPath = BASE_URL.'/'.$fleetSiteName."/app/webroot/".$yname.'/app/webroot/img/charter_program_files/itinerary_photos/'.$attachment;
                                }
                            //}

                            $titleimage = $targetFullPath;
                            $titleimagehref = $targetFullPath;
                            $fancybox = "fancybox";
                        }else{
                            $noteimg = "style='display:none;'";
                            $titleimage = BASE_URL.'/charterguest/app/webroot/img/noimage.png';
                            $titleimagehref = "#";
                            $fancybox = "";
                        }

                        

                        
                        $readonly = "readonly";
                        $popupHtml .= '<div class="mapPopup sp-mp-detailsrow sp-modal-600" data-schuuid="'.$scheduleData['CharterProgramSchedule']['UUID'].'">
                       
                        <form id="scheduleFormEdit"><div class="inputContainerdiv">
                        <div class="sp-divrow">
                        <div class="sp-60-w"><h1 style="float:left;border:none;">Day '.$dayNum.'&nbsp;&nbsp;&nbsp;&nbsp;</h1>
                        <input type="text" name="title" value="'.htmlspecialchars($title).'" placeholder="Enter the Title" class="" '.$readonly.' style="color: #000;float:right;font-size: 15px;border: solid 1px #ccc;width:68%;margin: 0px;padding: 8px 5px;font-weight: 600;background-color: #ddd;">
                        <textarea class="form-control textareacont" name="messagestitle" '.$readonly.' rows="4" cols="50" style="margin-top:42px;background: #eee !important;color: #000!important;border: solid 1px rgb(243 243 243 / 70%)!important;">'.htmlspecialchars($notes).'</textarea>
                        </div>
                        <div class="sp-40-w">
                        <div class="sp-upload-img">
                        <a href="'.$titleimagehref.'" class="'.$fancybox.'"><img src="'.$titleimage.'" style="object-fit: fill; height: 150px;" alt="" ></a>
                        </div>
                        <ul class="action-icon"></ul>
                        </div>
                        </div>';
                        $popupHtml .= '<input type="hidden" name="schedule_id" value="'.$scheduleId.'"><input type="hidden" class="form-control" name="day_num" id="dayNum" value="'.$dayNum.'">';
                        $popupHtml .= '<input type="hidden" name="yacht_id" value="'.$yacht_id.'">';
                        $popupHtml .= '<input type="hidden" id="charterprogramuuid" value="'.$scheduleData['CharterProgramSchedule']['charter_program_id'].'">';
                        $popupHtml .= '</div></form>';
                        
                        
                        
                        
                        //echo "<pre>";print_r($result); exit;
                    }
                    $result['status'] = "success";
                        $result['popupHtml'] = $popupHtml;
                }
                
            }
            echo json_encode($result);
            exit;
        }
    }
    
    
    /*
     * Mail notification
     * Functionality -  Send login notification mail to the Charter guest
     * Developer - Nagarajan
     * Created date - 24-May-2018
     * Modified date - 
     */
    function sendCharterNotifyMail($data,$userToken) {
        
        $salutation = $data['salutation'];
        $firstName = $data['first_name'];
        $lastName = $data['last_name'];
        $to = $data['email'];
        $yachtName = $this->Session->read('charter_info.CharterGuest.yacht_name');
        $captainName = $this->Session->read('charter_info.CharterGuest.captain_name');
        $this->loadModel('CharterGuest');
        //$headCharterData = $this->CharterGuest->find('first', array('conditions' => array('id' => $data['charter_guest_id'])));
        $headCharterData = $this->CharterGuest->find('first', array('conditions' => array('charter_program_id' => $data['charter_guest_id'])));
       //echo "<pre>"; print_r($data);print_r($headCharterData); exit;
        $headChartererName = $headCharterData['CharterGuest']['first_name']." ".$headCharterData['CharterGuest']['last_name'];
        $cloudURL = Configure::read('cloudUrl')."/charterguest";
        
        $subject = "Welcome to the charter guest program for the $yachtName";
        $message="
        <html>
        <head>
        <title></title>
        </head>
        <body>
        <div style='font-size:14px; font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;'>
        <p>Dear <b>".$salutation." ".$firstName." ".$lastName."</b>,</p>
        <p>You have been invited to join $headChartererName for a cruise onboard the $yachtName.</p>
        <p>To tailor our services so we can provide you a 7 star experience we kindly request that you login to the below secure website with your email and token and complete your preference sheets.</p>
        
	<p><a href='".$cloudURL."'>$cloudURL</a></p>
        <p>Username : <b>".$to."</b></p>
        <p>Token : <b>".$userToken."</b></p>
        
        <p>When you complete your preference sheets $headChartererName will be notified by email and your completed preference sheets and personal details will be automatically made available to the Captain of the $yachtName.</p>
	<p>Please watch this <a href='https://youtu.be/uLBICcPhNeE'>3 min video</a> to learn how to use the charter guest program.</p> 
        <p>We look forward to welcoming you onboard soon.</p>
        </br>
        <p>Kind regards,</p>        
        <p>$captainName</p>       
        <p>$yachtName</p>         
        </div>
        </body>
        </html>";
        
        $headers= "MIME-version: 1.0\n";
        $headers.= "Content-type: text/html; charset= iso-8859-1\n";
        $headers .= 'From: TotalSuperyacht <mail@totalsuperyacht.com>' . "\r\n";
        $this->chkSMTPEmail($to,$subject,$message,$headers);
        
    }


    /*
     * Mail notification
     * Functionality -  Send login notification mail to the Charter guest
     * Developer - Nagarajan
     * Created date - 24-May-2018
     * Modified date - 
     */
    function sendCharterNotifyAssociateGuestMail($data,$userToken) {
        
        $salutation = $data['salutation'];
        $firstName = $data['first_name'];
        $lastName = $data['last_name'];
        $to = $data['email'];
        //$to = "vignesh@ceruleaninfotech.com";
        $yachtName = $this->Session->read('charter_info.CharterGuest.yacht_name');
        $captainName = $this->Session->read('charter_info.CharterGuest.captain_name');
        $this->loadModel('CharterGuest');
        //$headCharterData = $this->CharterGuest->find('first', array('conditions' => array('id' => $data['charter_guest_id'])));
        $headCharterData = $this->CharterGuest->find('first', array('conditions' => array('charter_program_id' => $data['charter_guest_id'])));
       
        //echo "<pre>"; print_r($data); print_r($headCharterData); exit;
        $headChartererName = $headCharterData['CharterGuest']['first_name']." ".$headCharterData['CharterGuest']['last_name'];
        $cloudURL = Configure::read('cloudUrl')."/charterguest";
        
        $subject = "Welcome to the charter guest program for the $yachtName";
        $message="
        <html>
        <head>
        <title></title>
        </head>
        <body>
        <div style='font-size:14px; font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;'>
        <p>Hi <b>".$firstName."</b>,</p>
        <p>You have been invited to join $headChartererName for a cruise onboard the $yachtName.</p>
        <p>To tailor our services so we can provide you a 7 star experience we kindly request that you login to the below secure website with your email and token and complete your preference sheets.</p>
        
	<p><a href='".$cloudURL."'>$cloudURL</a></p>
        <p>Username : <b>".$to."</b></p>
        <p>Token : <b>".$userToken."</b></p>
        
        <p>When you complete your preference sheets $headChartererName will be notified by email and your completed preference sheets and personal details will be automatically made available to the Captain of the $yachtName.</p>
	<p>Please watch this <a href='https://youtu.be/uLBICcPhNeE'>3 min video</a> to learn how to use the charter guest program.</p> 
        <p>We look forward to welcoming you onboard soon.</p>
        </br>
        <p>Kind regards,</p>        
        <p>$captainName</p>       
        <p>$yachtName</p>         
        </div>
        </body>
        </html>";
        
        $headers= "MIME-version: 1.0\n";
        $headers.= "Content-type: text/html; charset= iso-8859-1\n";
        $headers .= 'From: TotalSuperyacht <mail@totalsuperyacht.com>' . "\r\n";
        $this->chkSMTPEmail($to,$subject,$message,$headers);
        
    }
    
    // Random unique token creation
    function uniqueToken($length = 8) {
         Configure::write('debug',0);
        //generate a random id encrypt it and store it in $rnd_id 
        $rnd_id = crypt(uniqid(rand(),1)); 

        //to remove any slashes that might have come 
        $rnd_id = strip_tags(stripslashes($rnd_id)); 

        //Removing any . or / and reversing the string 
        $rnd_id = str_replace(".","",$rnd_id); 
        $rnd_id = strrev(str_replace("/","",$rnd_id)); 

        //finally I take the first 10 characters from the $rnd_id 
        $rnd_id = substr($rnd_id,0,$length); 

        return $rnd_id;
        
    }
    
    /*
        * Fetch wine list from 3rd party
        * Functionality -  Fetch and Store the wine list from https://api.globalwinescore.com through cURL
        * Developer - Nagarajan
        * Created date - 31-July-2018
        * Modified date - 
    */
    function dumpWineList() {
        
        // Generate filters
        $limit = 1000;
        $offset = 0;
        
        // Set the curl parameters.
        $header = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Accept: application/json';
        $header[] = 'Authorization: Token 6b72458d55d83ea6599638436bc364f80fa893cb';
        
        
        /* Proxy for Local purpose */
//        curl_setopt($curl, CURLOPT_PROXY, "192.10.10.1:8080");
//        curl_setopt($curl, CURLOPT_PROXYUSERPWD, "nagarajan:N@g@r@j@NCeru");
        /* */
        

        for ($i = 1; $i <= 50; $i++) {
            $searchKeys = "?limit=$limit&offset=$offset";
            $url = "https://api.globalwinescore.com/globalwinescores/latest/".$searchKeys;
            
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            // Get response from the server.
            $response = curl_exec($curl);
            curl_close($curl);
            $output = json_decode($response, true);

            // Store the Wine list into db_checklistapp DB
            $this->storeWineList($output);
            
            // Increase the offset value
            $offset += 1000;
        }    
        
        exit;
        
    }
    
    /*
        * Store wine details
        * Functionality -  Store the Wine details into wine_lists table of db_checklistapp DB
        * Developer - Nagarajan
        * Created date - 31-July-2018
        * Modified date - 
    */
    function storeWineList($wineList) {
        
        if (isset($wineList['results']) && !empty($wineList['results'])) {
            $this->loadModel('WineList');
            $this->loadModel('WineListRegion');
            $error = 0;
            foreach ($wineList['results'] as $item) {
                
                $wineId = $item['wine_id'];
                $vintage = $item['vintage'];
                // Check whether the record exists by wine_id and vintage
                $existCheckData = $this->WineList->find('first', array('fields' => array('id'), 'conditions' => array('wine_id' => $wineId, 'vintage' => $vintage)));
                if (!empty($existCheckData)) { // UPDATE IF it exists
                    $item['id'] = $wineListId = $existCheckData['WineList']['id'];
                    $item['modified'] = date('Y-m-d H:i:s');
                } else { // INSERT
                    $item['created'] = date('Y-m-d H:i:s');
                    $item['modified'] = date('Y-m-d H:i:s');
                    $this->WineList->create();
                }
                
                // Insert/Update the Wine details
                if ($this->WineList->save($item)) {
                    if (empty($existCheckData)) { 
                        $wineListId = $this->WineList->getLastInsertId();
                    }    
                    
                    // Iterating the Regions
                    foreach ($item['regions'] as $regionItem) {
                        // Check whether the same record exists
                        $regionCheck = $this->WineListRegion->find('count', array('conditions' => array('region' => $regionItem, 'wine_list_id' => $wineListId)));
                        if ($regionCheck == 0) {
                            // Storing the Wine's regions
                            $insertData['wine_list_id'] = $wineListId; 
                            $insertData['region'] = $regionItem; 
                            $insertData['created'] = date('Y-m-d H:i:s');
                            $insertData['modified'] = date('Y-m-d H:i:s');
                            $this->WineListRegion->create();
                            $this->WineListRegion->save($insertData);
                        }
                    }
                    
                } else {
                    $error++;
                }
            }
            if ($error != 0) {
                echo "Internal server error.";
            } else {
                echo "Inserted successfully.";
            }
        } else {
            echo "No record exists.";
        }
        
    }
    
    /*
        * Fetch Product list from 3rd party
        * Functionality -  Fetch and Store the Products list from https://lcboapi.com/stores through cURL
        * Developer - Nagarajan
        * Created date - 09-Aug-2018
        * Modified date - 
    */
    function dumpProductList() {
        
        // Generate filters
        $limit = 100;
        $page = 1;
        
        // Set the curl parameters.
        $header = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Accept: application/json';
        $header[] = 'Authorization: Token MDo4YjE2ODc3ZS05NmNkLTExZTgtYjY3OC0xMzIyZjg5MDZiNjQ6c3BLejFCMVQwajMyTGZaVk9uZnJwYXVuTHo0bk13Nk5lUzc5';
        

        for ($i = 1; $i <= $page; $i++) {
            $searchKeys = "?per_page=$limit&page=$i";
            $url = "https://lcboapi.com/products".$searchKeys;
            
            $curl = curl_init();
            /* Proxy for Local purpose */
//            curl_setopt($curl, CURLOPT_PROXY, "192.10.10.1:8080");
//            curl_setopt($curl, CURLOPT_PROXYUSERPWD, "nagarajan:N@g@r@j@NCeru");
            /* */
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            // Get response from the server.
            $response = curl_exec($curl);
            curl_close($curl);
            $output = json_decode($response, true);
//            echo "<pre>";print_r($output);
            
            // Records details
            if (!empty($output['pager'])) {
                $page = $output['pager']['total_pages'];
            }

            // Store the Wine list into db_checklistapp DB
            $this->storeProductList($output);
            
        }    
        
        exit;
        
    }
    
    /*
        * Store Product details
        * Functionality -  Store the Product details into product_lists table of db_checklistapp DB
        * Developer - Nagarajan
        * Created date - 09-Aug-2018
        * Modified date - 
    */
    function storeProductList($productList) {
        
        if (isset($productList['result']) && !empty($productList['result'])) {
            $this->loadModel('ProductList');
            $error = 0;
            foreach ($productList['result'] as $item) {
                
                $productId = $item['id'];
                $item['product_id'] = $productId;
                unset($item['id']);
                // Check whether the record exists by product_id
                $existCheckData = $this->ProductList->find('first', array('fields' => array('id'), 'conditions' => array('product_id' => $productId)));
                if (!empty($existCheckData)) { // UPDATE IF it exists
                    $item['id'] = $productListId = $existCheckData['ProductList']['id'];
                    $item['modified'] = date('Y-m-d H:i:s');
                } else { // INSERT
                    $item['created'] = date('Y-m-d H:i:s');
                    $item['modified'] = date('Y-m-d H:i:s');
                    $this->ProductList->create();
                }
                
                // Insert/Update the Wine details
                if (!$this->ProductList->save($item)) {
                    $error++;                    
                }
            }
            if ($error != 0) {
                echo "Internal server error.";
            } else {
                echo "Inserted successfully.";
            }
        } else {
            echo "No record exists.";
        }
        
    }

    function getComments() {
        // echo "<pre>";
         //print_r($this->request->data);exit;
         $this->loadModel("CruisingMapComment");
         $this->loadModel('CharterProgramSchedule');
         $this->loadModel('CharterProgramScheduleActivity');
         $this->loadModel('Yacht');
         $this->loadModel('CharterGuest');
         
         $activityId = $this->request->data['activityId'];
         $activity_name = $this->request->data['activity_name'];
         $yachtid = $this->request->data['yachtid'];
         $type = $this->request->data['type'];
 
         $yachtData = $this->Yacht->find("first", array('fields' => array('yfullName','ydb_name'), 'conditions' => array('id' => $yachtid))); 
         $yachtDbName = $yachtData['Yacht']['ydb_name'];
 
 
         $activity_id_chk = $activityId;      
         if(isset($activity_id_chk) && !empty($activity_id_chk)){
            $getactivityname =  str_replace("'", "", $activity_name);
            $getactivityname = str_replace('"', "", $getactivityname);
             $CruisingMapCommentConditons = "activity_id = '$activity_id_chk' AND activity_name = '$getactivityname' AND type = '$type' AND publish_map = 1";
             $comments = $this->CharterGuest->getCruisingMapComment($yachtDbName, $CruisingMapCommentConditons);
         }
 
         //$comments = $this->CruisingMapComment->find('all', array('conditions' => array('CruisingMapComment.activity_name' => $activity_name), 'order' => 'CruisingMapComment.created desc'));
         $usertype = $this->Session->read('loggedfleetuser.user_type');
         $isfleet = 1;
         if ($isfleet == 1) {
             if ($usertype == 1) {
                 $usertype_comment = "Administrator";
             } else if ($usertype == 2) {
                 $usertype_comment = "Manager";
             } else if ($usertype == 4) {
                 $usertype_comment = "DPA / TSA";
             } else if ($usertype == 5) {
                 $usertype_comment = "Owner";
             } else if ($usertype == 6) {
                 $usertype_comment = "Working Staff";
             }
         } else {
             if ($usertype == 0) {
                 $usertype_comment = "Crew Member";
             } else if ($usertype == 1) {
                 $usertype_comment = "OBA";
             } else if ($usertype == 2) {
                 $usertype_comment = "HOD";
             } else if ($usertype == 3) {
                 $usertype_comment = "Superadmin";
             } else if ($usertype == 4) {
                 $usertype_comment = "DPA / TSA";
             }
         }
         //bellow condition to update when crew / fleet viewed their comments.
         $dateTime = date('Y-m-d H:i:s');
         $shipTime = "'" . date('Y-m-d H:i:s') . "'";
        /* if($type == "activity"){
             
             if(isset($activityId) && !empty($activityId)){
                
                 
                     $updateConditions = "UUID = '$activityId'";
                     $updateValues = "is_crew_commented='0',is_fleet_commented='0',modified=$shipTime";
                     $scheduleUpdateStatus = $this->CharterGuest->updateCharterProgramScheduleActivityData($yachtDbName, $updateConditions, $updateValues);
         
                     $updateCruisingMapCommentValues = "crew_newlyaddedcomment='0',fleet_newlyaddedcomment='0',modified=$shipTime";
                     
                
                     $getactivityname =  str_replace("'", "", $activity_name);
                     $getactivityname = str_replace('"', "", $getactivityname);
                     $updateConditionsCruisingMapComment = "activity_id = '$activityId' AND activity_name = '$getactivityname' AND type='activity'";
                     
                     $scheduleUpdateStatus = $this->CharterGuest->updateCruisingMapComment($yachtDbName, $updateConditionsCruisingMapComment, $updateCruisingMapCommentValues);
             }
             
     }else{
 
         if(isset($activityId) && !empty($activityId)){
             
             $updateConditions = "UUID = '$activityId'";
             $updateValues = "is_crew_commented='0',is_fleet_commented='0',modified=$shipTime";
             $scheduleUpdateStatus = $this->CharterGuest->updateCharterProgramScheduleData($yachtDbName, $updateConditions, $updateValues);
 
             $updateCruisingMapCommentValues = "crew_newlyaddedcomment='0',fleet_newlyaddedcomment='0',modified=$shipTime";
 
             $getactivityname =  str_replace("'", "", $activity_name);
             $getactivityname = str_replace('"', "", $getactivityname);
             $updateConditionsCruisingMapComment = "activity_id = '$activityId' AND activity_name = '$getactivityname' AND type='schedule'";
             
             $scheduleUpdateStatus = $this->CharterGuest->updateCruisingMapComment($yachtDbName, $updateConditionsCruisingMapComment, $updateCruisingMapCommentValues);
         }
     } */
         $comment_user_name = $this->Session->read('loggedfleetuser.first_name') . ' ' . $this->Session->read('loggedfleetuser.last_name');
         $r = array();
         //print_r($comments); exit;
         $view = new View();
         $view->layout = 'ajax'; // Optional, use if you want a "clean" view
         //$view->set('comments', $comments);
         //$view->set('UserType',$usertype_comment);
         //$view->set('UserName',$comment_user_name);

         $r['view'] = $view->element('cruising_crew_comments', array('comments' => $comments));
         $r['activityId'] = $activityId;
         $r['activity_name'] = $activity_name;
        // $r['UserType'] = $usertype_comment;
         $r['UserName'] = $comment_user_name;
         $r['isfleet'] = $isfleet;
         $r['type'] = $type;
 
         // Get msgcount
        // $msgcount = $this->gettotalmsgnotifycount();
         //$r['msgcount'] = $msgcount;
         // echo "<pre"; print_r($r); exit;
         echo json_encode($r);
         exit;
     }

    

     function saveComments() {

        $is_fleet = 1;
        //print_r($is_fleet);
        //exit;
        $this->layout = 'ajax';
        $this->loadModel("CruisingMapComment");
        $this->loadModel('CharterProgramSchedule');
        $this->loadModel('CharterProgramScheduleActivity');
        $this->loadModel('CharterGuest');
        $this->loadModel('Yacht');
        $postData = $this->request->data;
        //echo "<pre>";print_r($this->Session->read());
         //echo "<pre>";
        //print_r($postData); exit;
        $activityId = $postData['activityId'];
        $activity_name = $postData['activity_name'];
        // $user_type = $postData['user_type'];
        // $user_name = $postData['user_name'];
        $comments = strip_tags(addslashes(($postData['comments'])));
        $type = $postData['type'];
        $yachtId = $postData['yachtid'];

        $yachtData = $this->Yacht->find("first", array('fields' => array('yfullName','ydb_name'), 'conditions' => array('id' => $yachtId))); 
        $yachtDbName = $yachtData['Yacht']['ydb_name'];
        
        $dateTime = date('Y-m-d H:i:s');
        $shipTime = "'" . date('Y-m-d H:i:s') . "'";

if($type == "schedule"){
    if($activityId != ""){ 
        if(isset($comments) && !empty($comments)){ //echo "lllll"; exit;
           
                
                $is_guest_commented = 1;
            
        $updateValues = "is_guest_commented='$is_guest_commented'";
        }
     

    // Updating the Charter program schedules
    $updateConditions = "UUID = '$activityId'";
    //$updateValues = "title='$title',day_num=$dayNum,is_deleted=$isDeleted,notes='$notes',attachment='$attachment',is_crew_commented='$crew_newlyaddedcomment',is_fleet_commented='$fleet_newlyaddedcomment'";
    $scheduleUpdateStatus = $this->CharterGuest->updateCharterProgramScheduleData($yachtDbName, $updateConditions, $updateValues);
    

    $scheduleConditions = "UUID = '$activityId'";
    $chkpublishscheduleData = $this->CharterGuest->getCharterProgramScheduleData($yachtDbName, $scheduleConditions);
    if (!empty($chkpublishscheduleData)) {
        $scheduleData = $chkpublishscheduleData[0];
        $publish_map = $scheduleData['CharterProgramSchedule']['publish_map'];

    }
    if(isset($comments) && !empty($comments)){ //echo "lllll"; exit;
        $loggedUserFullName = $this->Session->read('login_username');
        $loggedUserInfouser_type = "Guest";

       
            $crew_newlyaddedcomment = 0;
            $fleet_newlyaddedcomment = 0;
            $guest_newlyaddedcomment = 1;
        
            $getactivityname =  str_replace("'", "", $activity_name);
                $getactivityname = str_replace('"', "", $getactivityname);
            $created = date("Y-m-d H:i:s");
            $insertValuescommenttitle = "(activity_id,activity_name,user_name,user_type,comment,crew_newlyaddedcomment,fleet_newlyaddedcomment,guest_newlyaddedcomment,type,created,publish_map) "
                    . "VALUES ('$activityId','$getactivityname','$loggedUserFullName','$loggedUserInfouser_type','$comments','$crew_newlyaddedcomment','$fleet_newlyaddedcomment','$guest_newlyaddedcomment','schedule','$created','1')";
            $this->CharterGuest->insertCruisingMapComment($yachtDbName, $insertValuescommenttitle);          
    }

}
}else if($type == "activity"){
   if($activityId != ""){ 
            if(isset($comments) && !empty($comments)){
               
                    $is_guest_commented = 1;
                   
                
                 $activityValues = "is_guest_commented='$is_guest_commented',modified=$shipTime";

            }
            $activityConditions = "UUID = '$activityId'";
            $activityUpdateStatus = $this->CharterGuest->updateCharterProgramScheduleActivityData($yachtDbName, $activityConditions, $activityValues);

    $scheduleConditions = "UUID = '$activityId'";
    $chkpublishscheduleData = $this->CharterGuest->getCharterProgramScheduleData($yachtDbName, $scheduleConditions);
    if (!empty($chkpublishscheduleData)) {
        $scheduleData = $chkpublishscheduleData[0];
        $publish_map = $scheduleData['CharterProgramSchedule']['publish_map'];

    }

        if(isset($comments) && !empty($comments)){
            $loggedUserFullName = $this->Session->read('login_username');
            $loggedUserInfouser_type = "Guest";
            $crew_newlyaddedcomment = 0;
            $fleet_newlyaddedcomment = 0;
            $guest_newlyaddedcomment = 1;
            $getactivityname =  str_replace("'", "", $activity_name);
            $getactivityname = str_replace('"', "", $getactivityname);
                $created = date("Y-m-d H:i:s");
                $insertValuesActivity = "(activity_id,activity_name,user_name,user_type,comment,crew_newlyaddedcomment,fleet_newlyaddedcomment,guest_newlyaddedcomment,type,created,publish_map) "
                    . "VALUES ('$activityId','$getactivityname','$loggedUserFullName','$loggedUserInfouser_type','$comments','$crew_newlyaddedcomment','$fleet_newlyaddedcomment','$guest_newlyaddedcomment','activity','$created','1')";
            $this->CharterGuest->insertCruisingMapComment($yachtDbName, $insertValuesActivity);    
                    
        }

    }

}

    $data['success'] = "success";
        echo json_encode($data);
        exit;
}

function markSingleCommentUnread() {

    $isfleet = 1;
    //print_r($is_fleet);
    //exit;
    $this->layout = 'ajax';
    $this->loadModel("CruisingMapComment");
    $this->loadModel('CharterProgramSchedule');
    $this->loadModel('CharterProgramScheduleActivity');
    $this->loadModel('CharterGuest');
    $this->loadModel('Yacht');
    $postData = $this->request->data;
     //echo "<pre>";
    //print_r($postData); exit;
    $activityId = $postData['activityId'];
        $userType = $postData['userType'];
        $user_name = $postData['user_name'];
        $activity_name = $postData['activity_name'];
        $comments = $postData['comments'];
        $chartertype1 = $postData['chartertype1'];
        $primaryid = $postData['primaryid'];
        $read = $postData['read'];
        $yachtId = $postData['yachtId'];

    $yachtData = $this->Yacht->find("first", array('fields' => array('yfullName','ydb_name'), 'conditions' => array('id' => $yachtId))); 
    $yachtDbName = $yachtData['Yacht']['ydb_name'];
    
    $dateTime = date('Y-m-d H:i:s');
    $shipTime = "'" . date('Y-m-d H:i:s') . "'";
    //echo $commentsaved; exit;
    if($read == "unread"){
                    if($chartertype1 == "activity"){

                            if(isset($activityId) && !empty($activityId)){
                                if ($isfleet == 1) {
                                
                                    $updateConditions = "UUID = '$activityId'";
                                    $updateValues = "is_crew_commented=1,is_fleet_commented=1,modified=$shipTime";
                                    $scheduleUpdateStatus = $this->CharterGuest->updateCharterProgramScheduleActivityData($yachtDbName, $updateConditions, $updateValues);
                        
                                    $updateCruisingMapCommentValues = "crew_newlyaddedcomment=1,fleet_newlyaddedcomment=1,modified=$shipTime";
                                    
                                } 
                                $getactivityname =  str_replace("'", "", $activity_name);
                                $getactivityname = str_replace('"', "", $getactivityname);
                                    $updateConditionsCruisingMapComment = "id = '$primaryid' AND activity_id = '$activityId' AND activity_name = '$getactivityname' AND type='activity'";
                                    
                                    $scheduleUpdateStatus = $this->CharterGuest->updateCruisingMapComment($yachtDbName, $updateConditionsCruisingMapComment, $updateCruisingMapCommentValues);
                            }



                    }else if($chartertype1 == "schedule"){
                        if(isset($activityId) && !empty($activityId)){
                            if ($isfleet == 1) {
                                //echo "llll"; exit;
                                $updateConditions = "UUID = '$activityId'";
                                $updateValues = "is_crew_commented=1,is_fleet_commented=1,modified=$shipTime";
                                $scheduleUpdateStatus = $this->CharterGuest->updateCharterProgramScheduleData($yachtDbName, $updateConditions, $updateValues);
                    
                                $updateCruisingMapCommentValues = "crew_newlyaddedcomment=1,fleet_newlyaddedcomment=1,modified=$shipTime";
                                
                            } 
                            $getactivityname =  str_replace("'", "", $activity_name);
                            $getactivityname = str_replace('"', "", $getactivityname);
                                $updateConditionsCruisingMapComment = "id = '$primaryid' AND activity_id = '$activityId' AND activity_name = '$getactivityname' AND type='schedule'";
                                
                                $scheduleUpdateStatus = $this->CharterGuest->updateCruisingMapComment($yachtDbName, $updateConditionsCruisingMapComment, $updateCruisingMapCommentValues);
                        }
                    }
    }else if($read == "read"){

                if($chartertype1 == "activity"){
                        
                        if(isset($activityId) && !empty($activityId)){
                            
                                $updateConditions = "UUID = '$activityId'";
                                $updateValues = "is_crew_commented='0',is_fleet_commented='0',modified=$shipTime";
                                $updateCruisingMapCommentValues = "crew_newlyaddedcomment='0',fleet_newlyaddedcomment='0',modified=$shipTime";
                                
                        
                                $getactivityname =  str_replace("'", "", $activity_name);
                                $getactivityname = str_replace('"', "", $getactivityname);
                                $updateConditionsCruisingMapComment = "id = '$primaryid'";
                                
                                $scheduleUpdateStatus = $this->CharterGuest->updateCruisingMapComment($yachtDbName, $updateConditionsCruisingMapComment, $updateCruisingMapCommentValues);

                                $CruisingMapCommentConditons = "activity_id = '$activityId' AND activity_name = '$getactivityname' AND type = 'activity'";
                                $checkvalueFortotalcount = $this->CharterGuest->getCruisingMapComment($yachtDbName, $CruisingMapCommentConditons);

                                $fleetcommented = array();
                                $guestcommented = array();
                                $crewcommented = array();
                                foreach($checkvalueFortotalcount as $value){
                                    $fleetcommented[] = $value['CruisingMapComment']['fleet_newlyaddedcomment'];
                                    $guestcommented[] = $value['CruisingMapComment']['guest_newlyaddedcomment'];
                                    $crewcommented[] = $value['CruisingMapComment']['crew_newlyaddedcomment'];
                                }
                               
                                    if (!in_array(1, $fleetcommented) && !in_array(1,$crewcommented)) {
                                        $scheduleUpdateStatus = $this->CharterGuest->updateCharterProgramScheduleActivityData($yachtDbName, $updateConditions, $updateValues);
                                    }
                                
                        }
                        
                }else{

                    if(isset($activityId) && !empty($activityId)){
                        
                        $updateConditions = "UUID = '$activityId'";
                        $updateValues = "is_crew_commented='0',is_fleet_commented='0',modified=$shipTime";

                        $updateCruisingMapCommentValues = "crew_newlyaddedcomment='0',fleet_newlyaddedcomment='0',modified=$shipTime";

                        $getactivityname =  str_replace("'", "", $activity_name);
                        $getactivityname = str_replace('"', "", $getactivityname);
                        $updateConditionsCruisingMapComment = "id = '$primaryid'";
                        
                        $scheduleUpdateStatus = $this->CharterGuest->updateCruisingMapComment($yachtDbName, $updateConditionsCruisingMapComment, $updateCruisingMapCommentValues);

                        $CruisingMapCommentConditons = "activity_id = '$activityId' AND activity_name = '$getactivityname' AND type = 'schedule'";
                                $checkvalueFortotalcount = $this->CharterGuest->getCruisingMapComment($yachtDbName, $CruisingMapCommentConditons);

                                $fleetcommented = array();
                                $guestcommented = array();
                                $crewcommented = array();
                                foreach($checkvalueFortotalcount as $value){
                                    $fleetcommented[] = $value['CruisingMapComment']['fleet_newlyaddedcomment'];
                                    $guestcommented[] = $value['CruisingMapComment']['guest_newlyaddedcomment'];
                                    $crewcommented[] = $value['CruisingMapComment']['crew_newlyaddedcomment'];
                                }
                               
                                    if (!in_array(1, $fleetcommented) && !in_array(1,$crewcommented)) {
                                        $scheduleUpdateStatus = $this->CharterGuest->updateCharterProgramScheduleData($yachtDbName, $updateConditions, $updateValues);
                                    }
                               
                    }
                }

    }
    $data['success'] = "success";
    echo json_encode($data);
    exit;
}


function markCommentUnread() {

    $isfleet = 1;
    //print_r($is_fleet);
    //exit;
    $this->layout = 'ajax';
    $this->loadModel("CruisingMapComment");
    $this->loadModel('CharterProgramSchedule');
    $this->loadModel('CharterProgramScheduleActivity');
    $this->loadModel('CharterGuest');
    $this->loadModel('Yacht');
    $postData = $this->request->data;
     //echo "<pre>";
    //print_r($postData); exit;
    $activityId = $postData['activityId'];
    $userType = $postData['userType'];
    $user_name = $postData['user_name'];
    $activity_name = $postData['activity_name'];
    $comments = $postData['comments'];
    $chartertype1 = $postData['chartertype1'];
    $yachtId = $postData['yachtId'];
    $ids = implode(",",$postData['ids']);

    $yachtData = $this->Yacht->find("first", array('fields' => array('yfullName','ydb_name'), 'conditions' => array('id' => $yachtId))); 
    $yachtDbName = $yachtData['Yacht']['ydb_name'];
    
    $dateTime = date('Y-m-d H:i:s');
    $shipTime = "'" . date('Y-m-d H:i:s') . "'";
    //echo $commentsaved; exit;
    if($chartertype1 == "activity"){

            if(isset($activityId) && !empty($activityId)){
                if ($isfleet == 1) {
                
                    $updateConditions = "UUID = '$activityId'";
                    $updateValues = "is_crew_commented=1,is_fleet_commented=1,modified=$shipTime";
                    $scheduleUpdateStatus = $this->CharterGuest->updateCharterProgramScheduleActivityData($yachtDbName, $updateConditions, $updateValues);
        
                    $updateCruisingMapCommentValues = "crew_newlyaddedcomment=1,fleet_newlyaddedcomment=1,modified=$shipTime";
                    
                } 
                $getactivityname =  str_replace("'", "", $activity_name);
                $getactivityname = str_replace('"', "", $getactivityname);
                    $updateConditionsCruisingMapComment = "id IN ('".$ids."') AND activity_id = '$activityId' AND activity_name = '$getactivityname' AND type='activity'";
                    
                    $scheduleUpdateStatus = $this->CharterGuest->updateCruisingMapComment($yachtDbName, $updateConditionsCruisingMapComment, $updateCruisingMapCommentValues);
            }



    }else if($chartertype1 == "schedule"){
        if(isset($activityId) && !empty($activityId)){
            if ($isfleet == 1) {
                //echo "llll"; exit;
                $updateConditions = "UUID = '$activityId'";
                $updateValues = "is_crew_commented=1,is_fleet_commented=1,modified=$shipTime";
                $scheduleUpdateStatus = $this->CharterGuest->updateCharterProgramScheduleData($yachtDbName, $updateConditions, $updateValues);
    
                $updateCruisingMapCommentValues = "crew_newlyaddedcomment=1,fleet_newlyaddedcomment=1,modified=$shipTime";
                
            } 
            $getactivityname =  str_replace("'", "", $activity_name);
            $getactivityname = str_replace('"', "", $getactivityname);
                $updateConditionsCruisingMapComment = "id IN ('".$ids."') AND activity_id = '$activityId' AND activity_name = '$getactivityname' AND type='schedule'";
                
                $scheduleUpdateStatus = $this->CharterGuest->updateCruisingMapComment($yachtDbName, $updateConditionsCruisingMapComment, $updateCruisingMapCommentValues);
        }
    }
    $data['success'] = "success";
    echo json_encode($data);
    exit;
}


function getPreviousCharterProgramSelections() {
    // echo "<pre>";
     //print_r($this->request->data);exit;
    
     $this->loadModel('Yacht');
     $this->loadModel('CharterGuestSpiritPreference');
     $this->loadModel('CharterGuestWinePreference');
     $this->loadModel('CharterGuest');
     $postData = $this->request->data;
     //echo "<pre>";print_r($this->Session->read());
      //echo "<pre>";
     //print_r($postData); exit;
     $type = $postData['type'];
     $ownerprefenceUUID = $this->Session->read('ownerprefenceUUID');

     $session = $this->Session->read();
     $selectedCharterProgramUUID = $session['selectedCharterProgramUUID'];

    //  if($type == "spirit"){
    //     $spiritData = $this->CharterGuestSpiritPreference->find('all', array('conditions' => array('is_deleted' => 0,'guest_lists_UUID'=>$ownerprefenceUUID,'charter_program_id !='=>$selectedCharterProgramUUID),'group' => array('charter_program_id'),'fields'=>array('charter_program_id','id','guest_lists_UUID')));
    //     $charterProgramData = array();
    //     if(isset($spiritData) && !empty($spiritData)){
            
    //         foreach($spiritData as $value){
    //            $charterProgramData[] =  $this->CharterGuest->find('first', array('conditions' => array('charter_program_id'=>$value['CharterGuestSpiritPreference']['charter_program_id'],'is_deleted' => 0),'fields'=>array('charter_program_id','id','charter_name','charter_from_date','charter_to_date','embarkation','debarkation'),'order'=>array('charter_from_date DESC')));
    //         }
    //     }
    //  }else if($type == "wine"){
    //     $WineData = $this->CharterGuestWinePreference->find('all', array('conditions' => array('is_deleted' => 0,'guest_lists_UUID'=>$ownerprefenceUUID,'charter_program_id !='=>$selectedCharterProgramUUID),'group' => array('charter_program_id'),'fields'=>array('charter_program_id','id','guest_lists_UUID')));
    //     $charterProgramData = array();
    //     if(isset($WineData) && !empty($WineData)){
            
    //         foreach($WineData as $value){
        //'users_UUID'=>$ownerprefenceUUID,
               $charterProgramData =  $this->CharterGuest->find('all', array('conditions' => array('users_UUID'=>$ownerprefenceUUID,'charter_program_id !='=>$selectedCharterProgramUUID,'is_deleted' => 0),'fields'=>array('charter_program_id','id','charter_name','charter_from_date','charter_to_date','embarkation','debarkation'),'order'=>array('charter_from_date DESC')));
    //         }
    //     }
    //  }
     //echo "<pre>"; print_r($charterProgramData); exit;
    
     
     $r = array();
     $view = new View();
     $view->layout = 'ajax'; // Optional, use if you want a "clean" view
     
     $r['view'] = $view->element('previous_charter_program_list', array('charterProgramData' => $charterProgramData,'type'=>$type));
     
     echo json_encode($r);
     exit;
 }

 function getPreviousSelectedBeerWine() {
    // echo "<pre>";
     //print_r($this->request->data);exit;
     $this->layout = 'ajax';
     $this->autoRender = false;
     

     $this->loadModel('Yacht');
     $this->loadModel('CharterGuestSpiritPreference');
     $this->loadModel('CharterGuestWinePreference');
     $this->loadModel('CharterGuest');
     $postData = $this->request->data;
     //echo "<pre>";print_r($this->Session->read());
      //echo "<pre>";
     //print_r($postData); exit;
     $type = $postData['type'];
     $programuuid = $postData['programuuid'];
     
     $session = $this->Session->read();
     //echo "<pre>";print_r($session); exit;

     if($type == "spirit"){
           
           
          
            if(isset($session['ownerprefenceUUID']) && !empty($session['ownerprefenceUUID'])){
                $charterHeadId = $session['ownerprefenceUUID'];
            }
            $selectedCharterProgramUUID = $programuuid;
            //echo $charterHeadId.'>>>>';
            //echo $selectedCharterProgramUUID;
            $this->loadModel('TempProductListSelection');
            $this->loadModel('ProductList');
            $this->loadModel('CharterGuestAssociate');
            //'guest_lists_UUID'=>$charterHeadId
            $selectConditions = array('charter_program_id'=>$selectedCharterProgramUUID,'guest_lists_UUID'=>$charterHeadId);
            $prefConditions = array_merge(array('is_deleted' => 0), $selectConditions);
            // Fetch the existing Spirit Preferences
            $spiritPreferences = $this->CharterGuestSpiritPreference->find('all', array('conditions' => $prefConditions));
            //echo $this->CharterGuestSpiritPreference->getLastQuery();
            // Fetch the selected products from Cart
            //$tempselectConditions = array('charter_guest_id' => $charterHeadId, 'charter_assoc_id' => $charterAssocId);
            $selectedProductList = $this->TempProductListSelection->find('list', array('fields' => array('product_list_id','product_list_id'), 'conditions' => $selectConditions));
            
            $conditions = array('id' => array_values($selectedProductList));
            // Selected products
            $selectionCartData = $this->ProductList->find('all', array('conditions' => $conditions));
            // Type list
            $typeListPref = $this->CharterGuestSpiritPreference->find('list', array('fields' => array('primary_category','primary_category'), 'conditions' => $prefConditions, 'group' => array('primary_category')));
            $typeListTemp = $this->ProductList->find('list', array('fields' => array('primary_category','primary_category'), 'conditions' => $conditions, 'group' => array('primary_category')));
            $typeList = array_unique(array_merge(array_values($typeListPref), array_values($typeListTemp)));
            
            // Fetch the Charter Guest data
            $charterGuestData = $this->CharterGuest->find('first', array('conditions' => array('charter_program_id' => $selectedCharterProgramUUID)));
            // Fetch the Charter Associate data
            $charterAssocData = $this->CharterGuestAssociate->find('first', array('conditions' => array('charter_guest_id' => $selectedCharterProgramUUID)));
            //echo "<pre>";print_r($selectionCartData); //exit;
            //echo "<pre>";print_r($spiritPreferences); //exit;
            //echo "<pre>";print_r($selectionCartData);
             //exit;
            // Load Element view
            $view = new View();
            $element = "previous_beer_list";
            $productListView  = $view->element($element, array('productSelectionCartData' => $selectionCartData, 'typeList' => $typeList, 'spiritPreferences' => $spiritPreferences, 'charterGuestData' => $charterGuestData, 'charterAssocData' => $charterAssocData));
            $result = array();
            $result['status'] = "success";
            $result['type'] = $type;
            $result['view'] = $productListView;
            $result['chartername'] = $charterGuestData['CharterGuest']['charter_name'];
            $result['cartRecordCount'] = count($selectionCartData);
            $result['preferenceRecordCount'] = count($spiritPreferences);

            echo json_encode($result);
            exit;
            
        
     }else if($type == "wine"){
             // Get the Wine list
         if(isset($session['ownerprefenceUUID']) && !empty($session['ownerprefenceUUID'])){
             $charterHeadId = $session['ownerprefenceUUID'];
         }
         //$charterHeadId = $sessionData['charterHeadId'];
         //$charterAssocId = $sessionData['charterAssocId'];
         $selectedCharterProgramUUID = $programuuid;
             
             $this->loadModel('CharterGuestWinePreference');
             $this->loadModel('TempWineListSelection');
             $this->loadModel('WineList');
             $this->loadModel('CharterGuest');
             $this->loadModel('CharterGuestAssociate');
             //,'guest_lists_UUID'=>$charterHeadId
             $selectConditions = array('charter_program_id' => $selectedCharterProgramUUID,'guest_lists_UUID'=>$charterHeadId);
             $prefConditions = array_merge(array('is_deleted' => 0), $selectConditions);
             // Fetch the existing Wine Preferences
             $winePreferences = $this->CharterGuestWinePreference->find('all', array('conditions' => $prefConditions));
 //            echo "<pre>";print_r($winePreferences);exit;
             // Fetch the selected wines from Cart
             $selectedWineList = $this->TempWineListSelection->find('list', array('fields' => array('wine_list_id','wine_list_id'), 'conditions' => $selectConditions));
             
             $conditions = array('id' => array_values($selectedWineList));
             // Selected wines
             $selectionCartData = $this->WineList->find('all', array('conditions' => $conditions));
             // Color list
             $colorListPref = $this->CharterGuestWinePreference->find('list', array('fields' => array('color','color'), 'conditions' => $prefConditions, 'group' => array('color')));
             $colorListTemp = $this->WineList->find('list', array('fields' => array('color','color'), 'conditions' => $conditions, 'group' => array('color')));
             $colorList = array_unique(array_merge(array_values($colorListPref), array_values($colorListTemp)));
             
             // Fetch the Charter Guest data
             $charterGuestData = $this->CharterGuest->find('first', array('conditions' => array('charter_program_id' => $selectedCharterProgramUUID)));
             // Fetch the Charter Associate data
             $charterAssocData = $this->CharterGuestAssociate->find('first', array('conditions' => array('charter_guest_id' => $selectedCharterProgramUUID)));
             // echo "<pre>";print_r($selectionCartData);
             // echo "<pre>";print_r($colorList);
             // echo "<pre>";print_r($winePreferences);
             // echo "<pre>";print_r($charterGuestData);
             // echo "<pre>";print_r($charterAssocData);
             // exit;
             // Load Element view
             $view = new View();
             $element = "previous_wine_list_table";
             $wineListView  = $view->element($element, array('selectionCartData' => $selectionCartData, 'colorList' => $colorList, 'winePreferences' => $winePreferences, 'charterGuestData' => $charterGuestData, 'charterAssocData' => $charterAssocData));
             $result = array();
             $result['status'] = "success";
             $result['type'] = $type;
             $result['view'] = $wineListView;
             $result['chartername'] = $charterGuestData['CharterGuest']['charter_name'];
              $result['cartRecordCount'] = count($selectionCartData);
              $result['preferenceRecordCount'] = count($winePreferences);
 
             echo json_encode($result);
             exit;
     }
     //echo "<pre>"; print_r($charterProgramData); exit;
    
     
     $r = array();
     $view = new View();
     $view->layout = 'ajax'; // Optional, use if you want a "clean" view
     
     $r['view'] = $view->element('previous_charter_program_list', array('charterProgramData' => $charterProgramData,'type'=>$type));
     
     echo json_encode($r);
     exit;
 }


 function saveusesubmittedpreferences() {
        
    if($this->request->is('ajax')){
        $this->layout = false;
        $this->autoRender = false;
        $this->loadModel('Yacht');
        $result = array();
        $sessiondata = $this->Session->read();
        $guestListUUID = $this->request->data['guestListUUID'];
        $selectedCharterProgramUUID = $this->request->data['selectedCharterProgramUUID'];
        $use_submitted_preferences = $this->request->data['use'];
        $this->Session->delete("showPopup");
        
        
            $this->loadModel('GuestList');
            $this->loadModel('CharterGuest');
            $guestExistdata = $this->GuestList->find('all', array('conditions' => array('UUID' => $guestListUUID)));
            //echo "<pre>"; print_r($guestExistdata); exit;
            if(!empty($guestExistdata)){
                foreach($guestExistdata as $val){
                    $guestlistData = array();
                    $guestlistData['id'] = $val['GuestList']['id'];
                    $guestlistData['use_submitted_preferences'] = $use_submitted_preferences;
                    $guestlistData['use_submitted_date'] = date('Y-m-d');
                    $this->GuestList->save($guestlistData);
                }
                // Fetch the Charter Guest data
                $charterGuestData = $this->CharterGuest->find('first', array('conditions' => array('charter_program_id' => $selectedCharterProgramUUID)));

                //echo "<pre>";print_r($chprgdata); exit;
                $yacht_id = $charterGuestData['CharterGuest']['yacht_id'];
                $yachtCond = array('Yacht.id' => $yacht_id);
                $Ydata = $this->Yacht->find('first', array('conditions' => $yachtCond));
                $yachtDbName = $Ydata['Yacht']['ydb_name'];
                $yname = $Ydata['Yacht']['yname'];
                $fleetcompanyid = $Ydata['Yacht']['fleetcompany_id'];
                    $this->loadModel("Fleetcompany");
                    // $fleetcompanydetails = $this->Fleetcompany->find('first',array('conditions'=>array('id'=>$fleetcompanyid)));
                    // $fleetSiteName = $fleetcompanydetails['Fleetcompany']['fleetname'];

                    $selectQuery = "SELECT id FROM $yachtDbName.passenger_lists WHERE UUID='$guestListUUID' AND is_deleted=0";
                    $checkCharterExists = $this->CharterGuest->query($selectQuery);
                    
                    if (!empty($checkCharterExists)) {
                        // Updation
                        $dateToday = date('Y-m-d');
                        $updateQuery = "UPDATE $yachtDbName.passenger_lists SET use_submitted_preferences='".$use_submitted_preferences."',use_submitted_date='".$dateToday."' WHERE UUID='$guestListUUID'";
                        $this->CharterGuest->query($updateQuery);
                    }

                    $result['status'] = "success";

            }else {
                $result['status'] = "fail";
                
            }            
        } 
                
            
    echo json_encode($result);
    exit;
    
}

function sessionShowPopupDelete(){
    if($this->request->is('ajax')){
        $this->layout = false;
        $this->autoRender = false;

        $this->Session->delete("showPopup");
        
        $result['status'] = "success";
        echo json_encode($result);
        exit;
    }
}

function uploadpassportimage(){
    if($this->request->is('ajax')){
        $this->layout = false;
        $this->autoRender = false;
        //echo "<pre>";print_r($this->request->form); exit;
        $data = $this->request->form;
        $path = 'img';
                $folder_name = 'passport_images';
                $folder_url = WWW_ROOT.$path.DIRECTORY_SEPARATOR.$folder_name;
                $file = $data['file'];
                $imageName = date("ymdHis").'_'.$file['name'];
                // create full filename                   
                $full_url = $folder_url.DIRECTORY_SEPARATOR.$imageName; 
                // upload the file
                if (move_uploaded_file($file['tmp_name'], $full_url)) {
                    $data['passport_image'] = $imageName;
                } 
                        // Crop the image 
                        $fileName = WWW_ROOT.$path.DIRECTORY_SEPARATOR.$folder_name.DIRECTORY_SEPARATOR.$imageName;
                        $kaboom = explode(".", $fileName); // Split file name into an array using the dot
                        $fileExt = end($kaboom);
                        $target_file = "$fileName";
                        $resized_file = WWW_ROOT.$path.DIRECTORY_SEPARATOR.$folder_name.DIRECTORY_SEPARATOR.$imageName;
                        $wmax = 600;
                        $hmax = 800;
                        $resfile = $this->ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);

        //$this->Session->delete("showPopup");
        $result['status'] = "success";
        $result['passport_image'] = $imageName;
        echo json_encode($result);
        exit;
    }
}

function ak_img_resize($target, $newcopy, $w, $h, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
    $scale_ratio = $w_orig / $h_orig;
    if (($w / $h) > $scale_ratio) {
           $w = $h * $scale_ratio;
    } else {
           $h = $w / $scale_ratio;
    }
    $img = "";
    $ext = strtolower($ext);
    if ($ext == "gif"){ 
    $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
    $img = imagecreatefrompng($target);
    } else { 
    $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    if ($ext == "gif"){ 
        imagegif($tci, $newcopy);
    } else if($ext =="png"){ 
        imagepng($tci, $newcopy);
    } else { 
        imagejpeg($tci, $newcopy, 84);
    }
}


function getIndividualmsgcountMarer() {
    //echo "<pre>";print_r($this->request->data);exit;
    if($this->request->is('ajax')){
        $this->loadModel('CharterGuest');
        $result = array();
        $session = $this->Session->read();
        $postData = $this->request->data;
        $schuuid = $postData['charterpgid'];
        $yachtId = $postData['yachtId'];
        $this->loadModel('Yacht');
        $yachtData = $this->Yacht->find("first", array('fields' => array('yfullName','ydb_name'), 'conditions' => array('id' => $yachtId))); 
        $yachtDbName = $yachtData['Yacht']['ydb_name'];

        $scheduleSameLocationUUID = explode(",",$postData['scheduleSameLocationUUID']);

        if(count($scheduleSameLocationUUID) > 1){
            $lastschuuid = reset($scheduleSameLocationUUID);
            foreach($scheduleSameLocationUUID as $schuuid){
                $mcount += $this->CharterGuest->getCharterMarkerCommentCount($yachtDbName,$schuuid);
            }
        }else{
                $mcount = $this->CharterGuest->getCharterMarkerCommentCount($yachtDbName,$schuuid);
                $lastschuuid = $schuuid;
        }
        //echo "<pre>";print_r($mcount);exit;
        
    }         

    $result['status'] = $mcount;
    $result['schuuidtoupdateintooltip'] = $lastschuuid;

    echo json_encode($result);
    exit;
    
}

    /*
        * Load The Privacy Policy page and Terms of Use page based on the request.
        * Functionality -  Loading the The Privacy Policy page and Terms of Use page based on the request.
        * Developer - Arsalan
        * Created date - 09-June-2022
        * Modified date - 
    */
    function privacytermsofuse() {    
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";    
        $str_arr = explode ("/", $actual_link); 
        $id = $str_arr[count($str_arr)-1];
        $conditions = "id= $id";
        $this->loadModel('Yacht');
        $details = $this->Yacht->getLeagalDocumentsData($conditions);
        $this->set('details', $details[0]);
        // print_r($details);exit;
    }

    function getBackgroundImageUrl($image, $fleetname, $yachtname, $SITE_URL){
        if($image){
            $cgBackgroundImage = $SITE_URL.'/'.$yachtname.'/app/webroot/img/charter_program_files/'.$image;
            if (!empty($fleetname)) { // IF yacht is under any Fleet
                $cgBackgroundImage = $SITE_URL."/".$fleetname."/app/webroot/".$yachtname."/app/webroot/img/charter_program_files/".$image;
            }
        }else{
            $cgBackgroundImage = $SITE_URL."/charterguest/css/admin/images/full-charter.png";
        }
        return $cgBackgroundImage;
    }

    function getFleetLogoUrl($fleetcompany_id){
        //$SITE_URL = Configure::read('BASE_URL');
        $this->loadModel('Fleetcompany');
        $companyData = $this->Fleetcompany->find('first', array('fields' => array('management_company_name','logo','fleetname','domain_name'), 'conditions' => array('id' => $fleetcompany_id)));
        if(isset($companyData['Fleetcompany']['domain_name'])){
        $domain_name = $companyData['Fleetcompany']['domain_name'];
        }
        if(isset($domain_name) && $domain_name == "charterguest"){
            $SITE_URL = "https://charterguest.net/";
        }else{
            $SITE_URL = "https://totalsuperyacht.com:8080/";
        }
        if (isset($companyData['Fleetcompany']['logo']) && !empty($companyData['Fleetcompany']['logo'])) {
            $fleetLogoUrl = $SITE_URL.'/'."charterguest/img/logo/thumb/".$companyData['Fleetcompany']['logo'];
        } else{
            $fleetLogoUrl = $SITE_URL.'/'."charterguest/img/logo/thumb/charter_guest_logo.png";
        }
        $this->Session->write("fleetCompanyName", $companyData['Fleetcompany']['management_company_name']);
        $this->Session->write("fleetname", $companyData['Fleetcompany']['fleetname']);
        return $fleetLogoUrl;
    }


    
    
}

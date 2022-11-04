<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    var $helpers = array('Form', 'Html');
    var $components = array('RequestHandler', 'Session','Cookie');

	// function beforeRender() {
	// 	if ($this->name == 'CakeError') {
	// 		$this->redirect(array('controller' => 'Charters', 'action' => 'index'));
	// 	}
	// }
    
    function beforeFilter() {
       // echo "<pre>"; print_r($this->params); exit;
		 if($this->params['action'] != 'charter_program_map'){
			//echo "<pre>"; print_r($this->params); exit;
			$this->CheckAdminSession();
		}

        if ($this->RequestHandler->isMobile()) {
            $this->is_mobile = true;
            $this->set('is_mobile', true );
            //$this->autoRender = false;
        }
    }
   

	function checkAdminSession() {
        $session=$this->Session->read();
		//echo "<pre>"; print_r($session); exit;
        if (!$this->Session->check('login_username')){ //echo "kk"; exit;
           
	    	return true;
        }

	}
    /**
     * common mail method for all mail notifications.
     *
     * @param string/string[] $to
     * @param string $subject
     * @param string $message
     * @param string $headers
     * @param string $from
     */
    function chkSMTPEmail($to,$subject,$message,$headers, $from = ''){
    	$pos = strpos($_SERVER['HTTP_HOST'],'totalsuperyacht.com');
    	$this->localHost = 0;
    	if ($pos === false || $_SERVER['HTTP_HOST']=='localhost') {
    		  $this->localHost =1;
    	}
    	// Check the user is active or not
    	$this->loadModel("User");
    	$emailArrayToSent = array();
    	$emailArrayToSent[] = $to;
	$this->setSmtpSendMail($emailArrayToSent,$message,$subject, $from);
    }
    
    /**
     * Mail method to send mail using SMTP settings.
     *
     * @param string/string[] $to
     * @param string $message
     * @param string $subject
     * @param string $from
     */
    function setSmtpSendMail($to,$message,$subject, $from ='')
    {	
    	require_once('../webroot/PHPMailer-master/PHPMailerAutoload.php');
    	
    	$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output
		
		//$mail->isSMTP();    
		 $mail->Mailer = "smtp";   
		                                // Set mailer to use SMTP
		$mail->Host =  Configure::read('host');  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username =  Configure::read('username');               // SMTP username
		$mail->Password =  Configure::read('password');                        // SMTP password
	//	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port =  Configure::read('port');                                   // TCP port to connect to
		if(!is_array($to)){
			$to = explode(',',$to);
		}
		
		//$mail->setFrom(FROM_EMAIL_ADDRESS, 'Superyacht');"TotalSuperyacht
		//if($from == ''){
			$mail->setFrom(FROM_EMAIL_ADDRESS, 'TotalSuperyacht');
		//}else{
		//	$mail->setFrom($from, 'TotalSuperyacht');
		//}
		foreach ($to as $val){
			$mail->addAddress($val);   
		}                                               // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		$mail->addBCC('admin@superyachtos.com');
		//$mail->addBCC('ramesh@ceruleaninfotech.com');
		
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML
		
		$mail->Subject = $subject;
		$mail->Body    = $message;
	//	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		
		if(!$mail->send()) {
		   // echo 'Message could not be sent.';exit;
		   // echo 'Mailer Error: ' . $mail->ErrorInfo;
		   return;
		} else {
		    //echo 'Message has been sent';exit;
		}
    	return;
    }


	function charter_program_map_total_msg_count($prgUUID,$yachtdb) {
		//        echo "<pre>";print_r($this->Session->read());exit;
		//echo $prgUUID.''.$yachtdb;
				Configure::write('debug',0);
				$session = $this->Session->read('charter_info');
				$yachtDbName = $yachtdb;
				$charterProgramId = $prgUUID;
				
				if (!empty($yachtDbName)) {
				   
					$this->loadModel('CharterGuest');
					$charterProgData = $this->CharterGuest->query("SELECT * FROM $yachtDbName.charter_programs CharterProgram WHERE UUID = '$charterProgramId' AND is_deleted = 0 LIMIT 1");
					//echo "<pre>";print_r($charterProgData); //exit;
					if (count($charterProgData) != 0) {
						//echo "kk";
						
						// Display the dates in array format
						//
		
						$scheduleConditions = "charter_program_id = '$charterProgramId' AND is_deleted = 0";
						$scheduleData = $this->CharterGuest->getCharterProgramScheduleData($yachtDbName, $scheduleConditions);
						//echo "<pre>";print_r($scheduleData); exit;
						$markertitle = array();
						$markername = array();
						if(isset($scheduleData)){
							$msgcount = 0;
							foreach($scheduleData as $key => $publishmap){
									
		
								   //$mcount = $this->getmsgnotifycountForMarker($publishmap['CharterProgramSchedule']['UUID']);
								   $msgcount += $this->CharterGuest->getCharterMarkerCommentCount($yachtDbName,$publishmap['CharterProgramSchedule']['UUID']);
		
								   
							
							}
						}
						
						
					} 
					//echo $msgcount; exit;
				return $msgcount;
				} 
				
				
			}
    
}

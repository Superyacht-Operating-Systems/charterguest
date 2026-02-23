<?php
/*
    * Chartersurveys Controller class
    * Functionality -  Manage the Charter Surveys Page
    * Developer - Nagarajan
    * Created date - 19-June-2018
    * Modified date - 
*/
class ChartersurveysController extends AppController {
    var $name = 'Chartersurveys';    
    
    /*
        * Load the Charter survey page
        * Functionality -  Loading the Charter survey page and add/update
        * Developer - Nagarajan
        * Created date - 19-June-2018
        * Modified date - 
    */
    public function survey($charterGuestId, $charterAssocId, $charterCompanyId,$success=null) {
        if (!empty($charterGuestId) && ($charterAssocId != "") && !empty($charterCompanyId)) { 
            $charterGuestId = ($charterGuestId);
            $charterAssocId = ($charterAssocId);
            $charterCompanyId = base64_decode($charterCompanyId);
            $data = array();
            $data['charter_company_id'] = $charterCompanyId;
            $data['charter_guest_id'] = $charterGuestId;
            $data['charter_assoc_id'] = $charterAssocId;
            
            $this->loadModel('CharterGuest');
            $this->loadModel('CharterGuestAssociate');
            $this->loadModel('Yacht');
            $this->loadModel('CharterSurveyQuestion');
            $this->loadModel('CharterGuestSurvey');
            
            if ($charterAssocId == 0) { // Head Charterer
                $charterGuestData = $this->CharterGuest->find('first', array('conditions' => array('charter_program_id' => $charterGuestId)));
                
                if (empty($charterGuestData)) {
                    $this->redirect(array('controller' => 'Charters'));
                }
                $data['charter_yacht_id'] = $charterGuestData['CharterGuest']['yacht_id'];
                $data['charter_program_id'] = $charterGuestData['CharterGuest']['charter_program_id'];
                $data['salutation'] = $charterGuestData['CharterGuest']['salutation']." ".$charterGuestData['CharterGuest']['first_name']." ".$charterGuestData['CharterGuest']['last_name'];
            } else { // Charter associate
                $charterGuestData = $this->CharterGuest->find('first', array('conditions' => array('charter_program_id' => $charterGuestId)));
                if (empty($charterGuestData)) {
                    $this->redirect(array('controller' => 'Charters'));
                }
                $data['charter_yacht_id'] = $charterGuestData['CharterGuest']['yacht_id'];
                $data['charter_program_id'] = $charterGuestData['CharterGuest']['charter_program_id'];
                
                $charterAssocData = $this->CharterGuestAssociate->find('first', array('conditions' => array('charter_guest_id' => $charterGuestId,'UUID' => $charterAssocId)));
                if (empty($charterAssocData)) {
                    $this->redirect(array('controller' => 'Charters'));
                }
                $data['salutation'] = $charterAssocData['CharterGuestAssociate']['salutation']." ".$charterAssocData['CharterGuestAssociate']['first_name']." ".$charterAssocData['CharterGuestAssociate']['last_name'];
            }
            
            // Yacht details
            $yachtData = $this->Yacht->find('first', array('conditions' => array('id' => $data['charter_yacht_id'])));
            if (!empty($yachtData)) {
                $data['yacht_name'] = $yachtData['Yacht']['yfullName'];
            }
            $this->set('data', $data);
            
            // Checking the Charter company availability and Existing Questions
            $questionData = $this->CharterSurveyQuestion->find('all', array('conditions' => array('charter_company_id' => $charterCompanyId), 'group' => array('question_number')));

            $this->set('questionData', $questionData);
            
            // Fetching the existing Survey details
            $surveyData = $this->CharterGuestSurvey->find('first', array('conditions' => array('charter_company_id' => $charterCompanyId, 'charter_guest_id' => $charterGuestId, 'charter_assoc_id' => $charterAssocId)));
            $this->set('surveyData', $surveyData);
            if(isset($success)){
                $this->set('modalshow', 'endmodal');
            }else{
                $this->set('modalshow', 'startmodal');
            }
            

            
        } else { 
            $this->redirect(array('controller' => 'Charters'));
        }
        
    }
    
    /*
        * Add/Edit the Charter Survey
        * Functionality -  Adding or Updating the Survey details
        * Developer - Nagarajan
        * Created date - 20-June-2018
        * Modified date - 
    */
    public function add_edit() {
        
        $this->loadModel('CharterGuestSurvey');
        $this->loadModel('Yacht');
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $questions = array();
            $data['survey_rating'] = "";
            
            // Getting the surveys
            if (isset($data['question'])) {
                foreach ($data['question'] as $key => $value) {
                    $questions[] = $key.'-'.$value;
                }
                $data['survey_rating'] = !empty($questions) ? implode(',', $questions) : "";
            }
            
            if (empty($data['id'])) {
                $data['created'] = date('Y-m-d H:i:s');
                $this->CharterGuestSurvey->create();
            }
            
            if ($this->CharterGuestSurvey->save($data)) {
                $surveyRowId = $data['id'];
                if (empty($surveyRowId)) {
                    $surveyRowId = $this->CharterGuestSurvey->getLastInsertId();
                }
                // Yacht details
                $yachtData = $this->Yacht->find('first', array('conditions' => array('id' => $data['charter_yacht_id'])));
                if (!empty($yachtData)) {
                    $yachDbName = $yachtData['Yacht']['ydb_name'];
                }
                $charter_program_id = "'".$data['charter_program_id']."'";
                $charter_guest_id = "'".$data['charter_guest_id']."'";
                $charter_assoc_id = "'".$data['charter_assoc_id']."'";
                
                
                // Sending the records to the corresponding yacht
                $existCheck = $this->Yacht->query("SELECT * FROM $yachDbName.charter_guest_surveys WHERE survey_row_id=$surveyRowId");
                if (!empty($existCheck)) { // UPDATE
                    $this->Yacht->query("UPDATE $yachDbName.charter_guest_surveys SET survey_rating='".$data['survey_rating']."',yacht_again=".$data['yacht_again'].",broker_again=".$data['broker_again'].",comments='".$data['comments']."' WHERE survey_row_id=$surveyRowId");
                } else { // INSERT
                    $this->Yacht->query("INSERT INTO $yachDbName.charter_guest_surveys (charter_company_id,charter_program_id,charter_yacht_id,charter_guest_id,charter_assoc_id,survey_rating,yacht_again,broker_again,comments,created,survey_row_id) VALUES (".$data['charter_company_id'].",".$charter_program_id.",".$data['charter_yacht_id'].",".$charter_guest_id.",".$charter_assoc_id.",'".$data['survey_rating']."',".$data['yacht_again'].",".$data['broker_again'].",'".$data['comments']."','".$data['created']."',".$surveyRowId.")");
                }
                
                $this->Session->setFlash("Survey has been submitted Successfully.", 'default', array('class' => 'alert alert-success'));

                
            }
            $this->redirect(array('action' => 'survey/'.$data['charter_guest_id'].'/'.$data['charter_assoc_id'].'/'.base64_encode($data['charter_company_id']).'/success'));
        }
        
    }
    
    
}

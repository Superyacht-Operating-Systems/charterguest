<?php    
    class CharterGuest extends AppModel {
       
        var $name = 'CharterGuest';
        
        public $validate = array(
            'email' => array(
                    'rule'    => 'email',
                    'message' => 'Please enter a valid email address.'
        )
       
    );

    /*
     * Fetch Charter Program Schedule data
     * Functionality -  Fetching the Charter Program Schedule data from specific Yacht DB
     * Developer - Nagarajan
     * Created date - 12-July-2018
     * Modified date - 
     */
    function getCharterProgramScheduleData($yachtDbName, $conditions) {
        $query = "SELECT * FROM $yachtDbName.charter_program_schedules CharterProgramSchedule WHERE $conditions";
        $result = $this->query($query);
        
        return $result;
    }
               
}

?>

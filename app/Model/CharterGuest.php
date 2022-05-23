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

    function getCruisingMapComment($yachtDbName, $conditions) {
        $orders = "  ORDER BY created desc";
        $query = "SELECT * FROM $yachtDbName.cruising_map_comments CruisingMapComment WHERE $conditions $orders"; //exit;
        $result = $this->query($query);
        
        return $result;
    }

    function updateCharterProgramScheduleActivityData($yachtDbName, $conditions, $updateValues) {
        $conditions = " WHERE " . $conditions;
        $updateValues = " SET " . $updateValues;
         $query = "UPDATE $yachtDbName.charter_program_schedule_activities $updateValues $conditions";
        $result = $this->query($query);
        
        return $result;
    }

    function updateCruisingMapComment($yachtDbName, $conditions, $updateValues) {
        
        $conditions = " WHERE " . $conditions;
        $updateValues = " SET " . $updateValues;
        $query = "UPDATE $yachtDbName.cruising_map_comments $updateValues $conditions";
        
        $result = $this->query($query);
        
        return $result;
    }

    function updateCharterProgramScheduleData($yachtDbName, $conditions, $updateValues) {
        
        $conditions = " WHERE " . $conditions;
        $updateValues = " SET " . $updateValues;
        $query = "UPDATE $yachtDbName.charter_program_schedules $updateValues $conditions";
        
        $result = $this->query($query);
        
        return $result;
    }

    function insertCruisingMapComment($yachtDbName, $insertValues) {
        $query = "INSERT INTO $yachtDbName.cruising_map_comments $insertValues";
        $result = $this->query($query);
        //$lastInsertedData = $this->query('select last_insert_id() as id');
        //return $lastInsertedData[0][0]['id'];
        return $result;
    }
    
               
}

?>

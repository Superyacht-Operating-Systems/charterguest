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

    public function getCharterMarkerCommentCount($yachtDbName,$puuid){
    	
    	// For fleet users
    	//echo "<pre>"; print_R($yachtDbName);//exit;
    	//foreach($yachtNames as $name){ 
    		
    		 $dbname = $yachtDbName;
             //$puuid = "62386a7f-fa6c-4916-bb0c-19692b7276f0";
		      $charter_program_schedulesQuery	= "SELECT id,is_crew_commented,title,UUID from $dbname.charter_program_schedules where UUID='$puuid'";
		      $charter_program_schedulesvalues = $this->query($charter_program_schedulesQuery);
             // echo "<pre>"; print_R($charter_program_schedulesvalues);
              //exit;
				foreach($charter_program_schedulesvalues as $value){
					$charter_program_schedules_id_array[] = $value['charter_program_schedules']['id'];
                    $charter_program_schedules_UUID_array[] = "'".$value['charter_program_schedules']['UUID']."'";
				}

                if(isset($charter_program_schedules_UUID_array) && !empty($charter_program_schedules_UUID_array)){
                    $uuidprog = implode(',',$charter_program_schedules_UUID_array);
                    if(isset($uuidprog) && !empty($uuidprog)){
                        $uuidprog = $uuidprog;
                    }else{
                        $uuidprog = ' ';
                    }
                }

                
                //echo $uuidprog; 
                //exit;
                if(isset($uuidprog)){
                    $schedule_activitiesQuery	= "SELECT id,is_crew_commented,UUID from $dbname.charter_program_schedule_activities where (is_crew_commented = 1 and  charter_program_schedule_id IN ($uuidprog)) OR (is_fleet_commented = 1 and charter_program_schedule_id IN ($uuidprog))";
                    $schedule_activitiesQueryvalues = $this->query($schedule_activitiesQuery);
                    //echo "<pre>"; print_R($schedule_activitiesQueryvalues);
                    //exit;
                    foreach($schedule_activitiesQueryvalues as $value){
                        $schedule_activities_id_array[] = "'".$value['charter_program_schedule_activities']['UUID']."'";
                    
                    }
                }

				
				   if(isset($charter_program_schedules_UUID_array) && !empty($charter_program_schedules_UUID_array)){
				      $aids = implode(',',$charter_program_schedules_UUID_array);
				      if(isset($aids) && !empty($aids)){
				      	$aids = $aids;
				      }else{
				      	$aids = ' ';
				      }
				      $schedulecommentQuery	= "SELECT * from $dbname.cruising_map_comments where activity_id IN ($aids) and crew_newlyaddedcomment = 1 and is_deleted = 0 and type='schedule' ORDER BY created Desc";
				      $schedulecomments = $this->query($schedulecommentQuery);

                      $GuestschedulecommentQuery	= "SELECT * from $dbname.cruising_map_comments where activity_id IN ($aids) and fleet_newlyaddedcomment = 1 and is_deleted = 0 and type='schedule' ORDER BY created Desc";
				      $Guestsschedulecomments = $this->query($GuestschedulecommentQuery);
				     
                	 foreach($schedulecomments as $value){
                	 	$scount[] = $value['cruising_map_comments']['activity_id'];
                	 }

                     foreach($Guestsschedulecomments as $value){
                        $scount[] = $value['cruising_map_comments']['activity_id'];
                    }
				   }
                   //echo "<pre>"; print_R($scount);
                   //exit;
                   if(isset($schedule_activities_id_array) && !empty($schedule_activities_id_array)){
                    $actvityids = implode(',',$schedule_activities_id_array);
                    if(isset($actvityids) && !empty($actvityids)){
                        $actvityids = $actvityids;
                    }else{
                        $actvityids = ' ';
                    }
                    $activitycommentQuery	= "SELECT * from $dbname.cruising_map_comments where activity_id IN ($actvityids) and crew_newlyaddedcomment = 1 and is_deleted = 0 and type='activity' ORDER BY created Desc";
                    $activitycomments = $this->query($activitycommentQuery);

                    $guestactivitycommentQuery	= "SELECT * from $dbname.cruising_map_comments where activity_id IN ($actvityids) and fleet_newlyaddedcomment = 1 and is_deleted = 0 and type='activity' ORDER BY created Desc";
                    $guestactivitycomments = $this->query($guestactivitycommentQuery);
                   
                   foreach($activitycomments as $value){
                       $actcount[] = $value['cruising_map_comments']['activity_id'];
                   }

                   foreach($guestactivitycomments as $value){
                    $actcount[] = $value['cruising_map_comments']['activity_id'];
                    }
                 }
                 //echo "<pre>"; print_R($actcount);
                 //exit;        
                 $count = "";  
                                if(!empty($scount)){
                                    
                                        $count += count($scount);
                                   
				                }

                                if(!empty($actcount)){
                                    
                                    $count += count($actcount);
                               
                            }
                                
                                
				
				//echo "<pre>"; print_R($count);exit;
				if(!empty($count)){
                	$result = $count;
				}else{
					$result = 0;
				}
                  return $result;
                
				
			
    	
    }

    
    
               
}

?>

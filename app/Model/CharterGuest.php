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
    public function getCharterProgramScheduleData($yachtDbName, $conditions) {
        $query = "SELECT * FROM $yachtDbName.charter_program_schedules CharterProgramSchedule WHERE $conditions";
        $result = $this->query($query);
        
        return $result;
    }

    public function getCruisingMapComment($yachtDbName, $conditions) {
        $orders = "  ORDER BY created desc";
        $query = "SELECT * FROM $yachtDbName.cruising_map_comments CruisingMapComment WHERE $conditions $orders"; //exit;
        $result = $this->query($query);
        
        return $result;
    }

    public function getCruisingMapComment_new($yachtDbName, $conditions) {
        $orders = "  ORDER BY created desc";
        $query = "SELECT * FROM $yachtDbName.cruising_map_comments CruisingMapComment WHERE $conditions $orders"; //exit;
        $result = $this->query($query);
        
        return $result;
    }

    public function getGuestNews($yachtDbName, $conditions) {
        $orders = "  ORDER BY created desc";
        $query = "SELECT * FROM $yachtDbName.charter_program_news CharterProgramNew WHERE $conditions $orders"; //exit;
        $result = $this->query($query);
        
        return $result;
    }

    public function updateCharterProgramScheduleActivityData($yachtDbName, $conditions, $updateValues) {
        $conditions = " WHERE " . $conditions;
        $updateValues = " SET " . $updateValues;
         $query = "UPDATE $yachtDbName.charter_program_schedule_activities $updateValues $conditions";
        $result = $this->query($query);
        
        return $result;
    }

    /*
     * Fetch Charter Program Schedule Activity data
     * Functionality -  Fetching the Charter Program Schedule Activity data from specific Yacht DB
     * Developer - rakesh
     * Created date - 22-Aug-2023
     * Modified date - 
     */
    public function getCharterProgramScheduleActivityData($yachtDbName, $conditions) {
        $query = "SELECT * FROM $yachtDbName.charter_program_schedule_activities CharterProgramScheduleActivity WHERE $conditions";
        $result = $this->query($query);
        
        return $result;
    }
    public function updateCruisingMapComment($yachtDbName, $conditions, $updateValues) {
        
        $conditions = " WHERE " . $conditions;
        $updateValues = " SET " . $updateValues;
        $query = "UPDATE $yachtDbName.cruising_map_comments $updateValues $conditions";
        
        $result = $this->query($query);
        
        return $result;
    }

    public function updateGuestNews($yachtDbName, $conditions, $updateValues) {
        
        $conditions = " WHERE " . $conditions;
        $updateValues = " SET " . $updateValues;
        $query = "UPDATE $yachtDbName.charter_program_news $updateValues $conditions";
        
        $result = $this->query($query);
        
        return $result;
    }

    public function updateCharterProgramScheduleData($yachtDbName, $conditions, $updateValues) {
        
        $conditions = " WHERE " . $conditions;
        $updateValues = " SET " . $updateValues;
        $query = "UPDATE $yachtDbName.charter_program_schedules $updateValues $conditions";
        
        $result = $this->query($query);
        
        return $result;
    }
    /*
     * Fetch head charter and booking agent data
     * Functionality -  Fetching the head charter and booking agent data from specific Yacht DB
     * Developer - rakesh
     * Created date - 16Aug2023
     * Modified date - 
     */
    public function getheadandbadata($yachtDbName, $conditions){
        if (!empty($conditions)) {
            $conditions = " WHERE ".$conditions;
        }
        $joins = " LEFT JOIN $yachtDbName.charter_user_yachts CUY ON(CharterProgram.charter_company_id = CUY.charter_company_id and CharterProgram.booking_agent_id = CUY.charter_user_id)";
        $groups = " GROUP BY CharterProgram.id";
        $query = "SELECT * FROM $yachtDbName.charter_programs CharterProgram $joins $conditions $groups";
        
        $result = $this->query($query);
        
        return $result;
    }

    /*
     * Fetch oba users data
     * Functionality -  Fetching the oba data from specific Yacht DB
     * Developer - rakesh
     * Created date - 16 Aug2023
     * Modified date - 
     */
    public function getyachtusersdata($yachtDbName, $types){
        
        $user_types =  implode(",",$types);
        $query = "SELECT id,email,user_type,notification_email,notify_email,email_notifications_for FROM $yachtDbName.users WHERE users.status = 1 AND users.is_deleted = 0 AND users.user_type IN ($user_types)";
        
        $obaUsers = $this->query($query);

        foreach($obaUsers as $userdetails){
            
            if($userdetails['users']['notify_email'] == 0){
                $sentemail[] = $userdetails['users']['email'];
            }else{
                $sentemail[] = $userdetails['users']['notification_email'];
            }
        }
        
        return array_filter($sentemail);
    }

    public function insertCruisingMapComment($yachtDbName, $insertValues) {
        $query = "INSERT INTO $yachtDbName.cruising_map_comments $insertValues";
        $result = $this->query($query);
        
        return $result;
    }
    public function getCharterMarkerCommentCount_new($yachtDbName,$puuid){
    	
    	// For fleet users
    	
    		
    		 $dbname = $yachtDbName;
             
		       $charter_program_schedulesQuery	= "SELECT id,is_crew_commented,title,UUID from $dbname.charter_program_schedules where UUID='$puuid' and is_deleted = 0";
              
		      $charter_program_schedulesvalues = $this->query($charter_program_schedulesQuery);
             
				foreach($charter_program_schedulesvalues as $value){
					$charter_program_schedules_id_array[] = $value['charter_program_schedules']['id'];
                    $charter_program_schedules_UUID_array[] = "'".$value['charter_program_schedules']['UUID']."'";
				}

                if(isset($charter_program_schedules_UUID_array) && !empty($charter_program_schedules_UUID_array)){
                    $uuidprog_ids = implode(',',$charter_program_schedules_UUID_array);
                    if(isset($uuidprog_ids) && !empty($uuidprog_ids)){
                        $uuidprog = $uuidprog_ids;
                    }else{
                        $uuidprog = ' ';
                    }
                }

                
                
                if(isset($uuidprog)){
                    $schedule_activitiesQuery	= "SELECT id,is_crew_commented,UUID from $dbname.charter_program_schedule_activities where (is_crew_commented = 1 and is_deleted = 0 and charter_program_schedule_id IN ($uuidprog)) OR (is_fleet_commented = 1 and is_deleted = 0 and charter_program_schedule_id IN ($uuidprog))";
                    $schedule_activitiesQueryvalues = $this->query($schedule_activitiesQuery);
                    
                    foreach($schedule_activitiesQueryvalues as $value){
                        $schedule_activities_id_array[] = "'".$value['charter_program_schedule_activities']['UUID']."'";
                    
                    }
                }

				
				   if(isset($charter_program_schedules_UUID_array) && !empty($charter_program_schedules_UUID_array)){
                    $charter_program_schedules_UUID_array = array_unique($charter_program_schedules_UUID_array);
				      $aids_ids = implode(',',$charter_program_schedules_UUID_array);
				      if(isset($aids_ids) && !empty($aids_ids)){
				      	$aids = $aids_ids;
				      }else{
				      	$aids = ' ';
				      }
				      $schedulecommentQuery	= "SELECT * from $dbname.cruising_map_comments where (activity_id IN ($aids) and crew_newlyaddedcomment = 1 and is_deleted = 0 and type='schedule' and publish_map = 1 and guest_read = 'unread') OR (activity_id IN ($aids) and fleet_newlyaddedcomment = 1 and is_deleted = 0 and type='schedule' and publish_map = 1 and guest_read = 'unread') ORDER BY created Desc";
				      $schedulecomments = $this->query($schedulecommentQuery);
				     
                	 foreach($schedulecomments as $value){
                	 	$scount[] = $value['cruising_map_comments']['activity_id'];
                	 }

                   
				   }
                   
                   if(isset($schedule_activities_id_array) && !empty($schedule_activities_id_array)){
                    $schedule_activities_id_array = array_unique($schedule_activities_id_array);
                    $actvityids_val = implode(',',$schedule_activities_id_array);
                    if(isset($actvityids_val) && !empty($actvityids_val)){
                        $actvityids = $actvityids_val;
                    }else{
                        $actvityids = ' ';
                    }
                    $activitycommentQuery	= "SELECT * from $dbname.cruising_map_comments where (activity_id IN ($actvityids) and crew_newlyaddedcomment = 1 and is_deleted = 0 and type='activity' and publish_map = 1 and guest_read = 'unread') OR (activity_id IN ($actvityids) and fleet_newlyaddedcomment = 1 and is_deleted = 0 and type='activity' and publish_map = 1 and guest_read = 'unread') ORDER BY created Desc";
                    $activitycomments = $this->query($activitycommentQuery);

                   
                   foreach($activitycomments as $value){
                       $actcount[] = $value['cruising_map_comments']['activity_id'];
                   }

               
                 }
                   
                 $count = "";  
                                if(!empty($scount)){
                                    
                                        $count += count($scount);
                                   
				                }

                                if(!empty($actcount)){
                                    
                                    $count += count($actcount);
                               
                            }
                                
                                
				
				
				if(!empty($count)){
                	$result = $count;
				}else{
					$result = 0;
				}
                  return $result;
                
				
			
    	
    }
    public function getCharterMarkerCommentCount($yachtDbName,$puuid,$daytitle=''){
    	
    	// For fleet users
    	
    		
    		 $dbname = $yachtDbName;
             
		      $charter_program_schedulesQuery	= "SELECT id,is_crew_commented,title,UUID from $dbname.charter_program_schedules where UUID='$puuid' and is_deleted = 0";
		      $charter_program_schedulesvalues = $this->query($charter_program_schedulesQuery);
             
				foreach($charter_program_schedulesvalues as $value){
					$charter_program_schedules_id_array[] = $value['charter_program_schedules']['id'];
                    $charter_program_schedules_UUID_array[] = "'".$value['charter_program_schedules']['UUID']."'";
				}

                if(isset($charter_program_schedules_UUID_array) && !empty($charter_program_schedules_UUID_array)){
                    $uuidprog_ids = implode(',',$charter_program_schedules_UUID_array);
                    if(isset($uuidprog_ids) && !empty($uuidprog_ids)){
                        $uuidprog = $uuidprog_ids;
                    }else{
                        $uuidprog = ' ';
                    }
                }

                
                
                if(isset($uuidprog)){
                    $schedule_activitiesQuery	= "SELECT id,is_crew_commented,UUID from $dbname.charter_program_schedule_activities where (is_crew_commented = 1 and is_deleted = 0 and charter_program_schedule_id IN ($uuidprog)) OR (is_fleet_commented = 1 and is_deleted = 0 and charter_program_schedule_id IN ($uuidprog) and activity_name ='$daytitle')";
                    $schedule_activitiesQueryvalues = $this->query($schedule_activitiesQuery);
                    
                    foreach($schedule_activitiesQueryvalues as $value){
                        $schedule_activities_id_array[] = "'".$value['charter_program_schedule_activities']['UUID']."'";
                    
                    }
                }

				
				   if(isset($charter_program_schedules_UUID_array) && !empty($charter_program_schedules_UUID_array)){
                    $charter_program_schedules_UUID_array = array_unique($charter_program_schedules_UUID_array);
				      $aids_ids = implode(',',$charter_program_schedules_UUID_array);
				      if(isset($aids_ids) && !empty($aids_ids)){
				      	$aids = $aids_ids;
				      }else{
				      	$aids = ' ';
				      }
				      $schedulecommentQuery	= "SELECT * from $dbname.cruising_map_comments where (activity_id IN ($aids) and crew_newlyaddedcomment = 1 and is_deleted = 0 and type='schedule' and publish_map = 1 and guest_read = 'unread' and activity_name ='$daytitle') OR (activity_id IN ($aids) and fleet_newlyaddedcomment = 1 and is_deleted = 0 and type='schedule' and publish_map = 1 and guest_read = 'unread' and activity_name ='$daytitle') ORDER BY created Desc";
				      $schedulecomments = $this->query($schedulecommentQuery);
				     
                	 foreach($schedulecomments as $value){
                	 	$scount[] = $value['cruising_map_comments']['activity_id'];
                	 }

                   
				   }
                   
                   if(isset($schedule_activities_id_array) && !empty($schedule_activities_id_array)){
                    $schedule_activities_id_array = array_unique($schedule_activities_id_array);
                    $actvityids_val = implode(',',$schedule_activities_id_array);
                    if(isset($actvityids_val) && !empty($actvityids_val)){
                        $actvityids = $actvityids_val;
                    }else{
                        $actvityids = ' ';
                    }
                    $activitycommentQuery	= "SELECT * from $dbname.cruising_map_comments where (activity_id IN ($actvityids) and crew_newlyaddedcomment = 1 and is_deleted = 0 and type='activity' and publish_map = 1 and guest_read = 'unread') OR (activity_id IN ($actvityids) and fleet_newlyaddedcomment = 1 and is_deleted = 0 and type='activity' and publish_map = 1 and guest_read = 'unread') ORDER BY created Desc";
                    $activitycomments = $this->query($activitycommentQuery);

                   
                   foreach($activitycomments as $value){
                       $actcount[] = $value['cruising_map_comments']['activity_id'];
                   }

               
                 }
                   
                 $count = "";  
                                if(!empty($scount)){
                                    
                                        $count += count($scount);
                                   
				                }

                                if(!empty($actcount)){
                                    
                                    $count += count($actcount);
                               
                            }
                                
                                
				
				
				if(!empty($count)){
                	$result = $count;
				}else{
					$result = 0;
				}
                  return $result;
                
				
			
    	
    }


    public function getmsgcountonclosecruisingschedulemodal($yachtDbName,$puuid){
    	
    	// For fleet users
    	
    		
    		 $dbname = $yachtDbName;
            
		      $charter_program_schedulesQuery	= "SELECT id,is_crew_commented,title,UUID from $dbname.charter_program_schedules where charter_program_id='$puuid' and is_deleted = 0";
		      $charter_program_schedulesvalues = $this->query($charter_program_schedulesQuery);
            
				foreach($charter_program_schedulesvalues as $value){
					$charter_program_schedules_id_array[] = $value['charter_program_schedules']['id'];
                    $charter_program_schedules_UUID_array[] = $value['charter_program_schedules']['UUID'];
				}
                $return = array();
                if(isset($charter_program_schedules_UUID_array) && !empty($charter_program_schedules_UUID_array)){
                    $result = array();
                    foreach($charter_program_schedules_UUID_array as $uuid){
                        $result[$uuid] = $this->getCharterMarkerCommentCount_new($yachtDbName,$uuid);
                    }

                   
                    
                    foreach($result as $key => $val){
                        $return[$key] = $val;
                    }
                   
                }
                
                return $return;

    }

    
    
               
}

?>

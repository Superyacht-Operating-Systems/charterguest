<?php    
    class Yacht extends AppModel {
       
        var $name = 'Yacht';

        /*
        * Fetch Yacht data
        * Functionality -  Fetching the Yacht data from Yacht DB
        * Developer - Arsalan
        * Created date - 08-June-2022
        * Modified date - 
        */
        public function getYachtData($yachtDbName) {
            $query = "SELECT * FROM $yachtDbName.yachts WHERE 1";
            $result = $this->query($query);
            
            return $result;
        }


        /*
        * Fetch Yacht data
        * Functionality -  Fetching the Yacht data from db_checklistapp DB
        * Developer - Arsalan
        * Created date - 08-June-2022
        * Modified date - 
        */
        public function getYachtDataFromDbcp($yachtDbName) {
            $query = "SELECT cg_yachts_logo,cg_yachts_website FROM db_checklistapp.yachts WHERE yname LIKE '%" . $yachtDbName . "%'";
            $result = $this->query($query);
            
            return $result;
        }

        /*
        * Fetch Yacht data
        * Functionality -  Fetching the Yacht data from Yacht DB
        * Developer - Arsalan
        * Created date - 08-June-2022
        * Modified date - 
        */
        public function getLeagalDocumentsData($conditions) {
            $conditions = " WHERE " . $conditions;
            $query = "SELECT * FROM db_checklistapp.leagal_documents $conditions";
            $result = $this->query($query);
            
            return $result;
        }
    }

?>

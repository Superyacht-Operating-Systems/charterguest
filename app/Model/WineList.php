<?php    
    class WineList extends AppModel {
       
        var $name = 'WineList';

        function getLastQuery() {
            $dbo = $this->getDatasource();
            $logs = $dbo->getLog();
            $lastLog = end($logs['log']);
            return $lastLog['query'];
          }
               
}

?>

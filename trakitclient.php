<?php

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
header("Cache-Control: no-store, no-cache, must-revalidate");  // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


$trackerName   = $_POST['provider'];
$trackingID    = $_POST['tracknum'];
//die(var_dump($_POST));

//some validation code here

class TrackCollector extends GearmanClient{
    private $data     = array();
    private $tmpArr   = array();

    function addData($content){
        if($content){
            $this->tmpArr   = json_decode($content, true);
            $this->data     = array_merge($this->tmpArr, $this->data);
            //$this->data[] = json_decode($content, true);
        }
    }
    function getData(){
        return $this->data;
    }
    function outputData(){
        echo json_encode($this->getData());
    }

    function taskCompleted($task){

       $this->addData($task->data());
       echo "task complete";
    }

}


$collector = new TrackCollector();

$collector->addServer("10.0.0.9");

# set a function to be called when the work is complete
$collector->setCompleteCallback(array($collector, "taskCompleted"));


//params to pass to worker
// $queryStr = array(
//       "provider" => $trackerName,
//       "tracknum" => $trackingID
// );

// $postData = serialize( $queryStr );
# add tasks to be executed in parallel in Gearman server
// $collector->addTask("getdata_orderDetails", $postData, null, "1");
// $collector->addTask("getdata_customerDetails", $postData, null, "2");
  switch($trackerName){
    case "fedex":
      echo $collector->do("trackFedex", $trackingID);
      break;
    case "usps":
      echo $collector->do("trackUSPS", $trackingID);
      break;
    case "ups":
      echo $collector->do("trackUPS", $trackingID);
      break;
    case "dhl":
      echo $collector->do("trackDHL", $trackingID);
      break;
  }
//$collector->addTask("getdata_trackerName", $postData, null, md5($trackerName);
//$collector->addTask("getdata_trackingID", $postData, null, md5($trackingID);

# run the tasks in parallel
//$collector->runTasks();

//return "completed";
# output the data 
//$collector->outputData();

?>
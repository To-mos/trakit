<?php
$client= new GearmanClient();
$client->addServer("10.0.0.6", 4730);
//echo $client->do("reverse", "Hello World!")."</br>";
echo $client->do("trackFedex", "510087020")."</br>";
echo $client->do("trackUSPS", "9405509699937018835945")."</br>";
//echo $client->do("trackUPS", "1Z6934X10351053020")."</br>";
//echo $client->do("trackDHL", "123456789012")."</br>";
?>

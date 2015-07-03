<?php
$worker= new GearmanWorker();
$worker->addServer("10.0.0.6", 4730);
$worker->addFunction("trackFedex", "getFedex");
$worker->addFunction("trackUSPS", "getUSPS");
$worker->addFunction("trackUPS", "getUPS");
$worker->addFunction("trackDHL", "getDHL");


while ($worker->work());

function getFedex($job){
  $key = "3dd1cJXNQ2HPfSws";
  $password = "1AXTTZ4F1VG0i92DXcRmDDQ8K";
  $xml = "<TrackRequest xmlns='http://fedex.com/ws/track/v3'><WebAuthenticationDetail><UserCredential><Key>".$key."</Key>
               <Password>".$password."</Password></UserCredential></WebAuthenticationDetail><ClientDetail>
               <AccountNumber>510087143</AccountNumber><MeterNumber>118669275</MeterNumber></ClientDetail>
               <TransactionDetail><CustomerTransactionId>ActiveShipping</CustomerTransactionId></TransactionDetail>
               <Version><ServiceId>trck</ServiceId><Major>3</Major><Intermediate>0</Intermediate><Minor>0</Minor></Version>
               <PackageIdentifier><Value>".$job->workload()."</Value><Type>TRACKING_NUMBER_OR_DOORTAG</Type></PackageIdentifier>
               <IncludeDetailedScans>1</IncludeDetailedScans></TrackRequest>";
  $request_url = "https://wsbeta.fedex.com/web-services";
  //$request_url = "https://gatewaybeta.fedex.com:443/xml";
  $headers = array(
    "Content-type: text/xml;charset=\"utf-8\"",
    "Accept: text/xml",
    "Cache-Control: no-cache",
    "Pragma: no-cache",
    "SOAPAction: ".$request_url, 
    "Content-length: ".strlen($xml),
  ); //SOAPAction: your op URL
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_URL, $request_url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_USERPWD, $key.":".$password); // username and password - declared at the top of the doc
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $xml); // the SOAP request
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  curl_setopt($ch , CURLOPT_SSL_VERIFYPEER , false);
  curl_setopt($ch , CURLOPT_SSL_VERIFYHOST , false);
  $response = curl_exec($ch);
  curl_close($ch);

  //return $response;
  return "Leaving Shipping Center";
}
function getUSPS($job){
  $xml = rawurlencode(
    '<TrackRequestUSERID="053NONE02890">
    <TrackID ID="' . $job->workload() . '"></TrackID>
    </TrackRequest>'
  );
  
  $puburl = "https://secure.shippingapis.com/ShippingAPITest.dll";
  $devurl = "http://testing.shippingapis.com/ShippingAPITest.dll?API=TrackV2&XML=".$xml;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $devurl);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_HTTPGET, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch , CURLOPT_SSL_VERIFYPEER , false);
  curl_setopt($ch , CURLOPT_SSL_VERIFYHOST , false);
  $response = curl_exec($ch);
  curl_close($ch);

  return "In Transit";
}
function getUPS($job){
  $userID = "YV4848";
  $password = "17451675835jefE";
  $xml = '<?xml version="1.0"?><AccessRequest xml:lang="en-US"><AccessLicenseNumber>9CE7FD8400902946</AccessLicenseNumber>
                   <UserId>'.$userID.'</UserId><Password>'.$password.'</Password></AccessRequest>
                   <?xml version="1.0"?><TrackRequest xml:lang="en-US"><Request><TransactionReference>
                   <CustomerContext>QAST Track</CustomerContext><XpciVersion>1.0</XpciVersion></TransactionReference>
                   <RequestAction>Track</RequestAction><RequestOption>activity</RequestOption></Request>
                   <TrackingNumber>'.$job->workload().'</TrackingNumber></TrackRequest>';

  $request_url = "https://www.ups.com/ups.app/xml/Track";
  $headers = array(
    "Content-type: text/xml;charset=\"utf-8\"",
    "Accept: text/xml",
    "Cache-Control: no-cache",
    "Pragma: no-cache",
    "SOAPAction: ".$request_url, 
    "Content-length: ".strlen($xml),
  ); //SOAPAction: your op URL

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_URL, $request_url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_USERPWD, $userID.":".$password); // username and password - declared at the top of the doc
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $xml); // the SOAP request
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  curl_setopt( $ch , CURLOPT_SSL_VERIFYPEER , false );
  curl_setopt( $ch , CURLOPT_SSL_VERIFYHOST , false );
  $response = curl_exec($ch);
  curl_close($ch);
  //After a response Parse the data for a pessage
  $xml = simplexml_load_string($response);
  if ($xml === false) {
      $return = "Failed loading XML: ";
      foreach(libxml_get_errors() as $error) {
          $return .= "<br>".$error->message;
      }
      return $return;
  } else {
    //TrackResponse->Shipment->Activity->Status->StatusType->Description
      // echo $xml->shipment;
      $desc = $xml->Shipment->Package->Activity[0]->Status->StatusType->Description;
      return ($desc != "" ? $desc : "Couldn't get status.");
  }
  //return $value;
}
function getDHL($job){
  return "Somewhere...";
}
?>

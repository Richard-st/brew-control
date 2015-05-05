<?php

error_reporting(E_ERROR | E_PARSE);

$ch = curl_init("http://121.99.71.235/?status");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$xml = curl_exec($ch);
curl_close($ch);

//$xml = simplexml_load_string($data);
//print_r($xml);

//echo ('+++'.$xml);

?>
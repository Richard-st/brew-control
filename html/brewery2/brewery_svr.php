<?php
// ------------------------------------------------------------
// Server program to communicate between web page and arduino
// ------------------------------------------------------------

  if ($_GET['arduinoCall'] == "updateStatus"){

    $dom = new DOMDocument();
	
    // create root element
    $root = $dom->createElement("brewery");
    $dom->appendChild($root);
    error_reporting(E_ERROR | E_PARSE);
    $uri="http://localhost//test_harness.php/?status";
    $ch = curl_init($uri);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $xml = curl_exec($ch);
    curl_close($ch);
    echo ($xml);			
  }

  if ($_GET['arduinoCall'] == "request"){

    $dom = new DOMDocument();
	
    // create root element
    $root = $dom->createElement("brewery");
    $dom->appendChild($root);
    error_reporting(E_ERROR | E_PARSE);

    if ( !isset($_GET['value']) )
      $uri="http://localhost//test_harness.php/?request=".$_GET['type'];
    else
      $uri="http://localhost//test_harness.php/?request=".$_GET['type'].":".$_GET['value'];
    
    echo $uri;
    $ch = curl_init($uri);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $xml = curl_exec($ch);
    curl_close($ch);
    echo ($xml);			
  }
    
  
  
?>
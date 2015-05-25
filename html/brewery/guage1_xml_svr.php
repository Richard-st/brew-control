<?php
session_start(); 
	
//=======================================================================   
//   view-source:http://alex-laptop-xp/guage1_xml_svr.php?ajaxType=Receive
//======================================================================= 
/*
    //connect to db
    $con = mysql_connect("localhost","brewery","lenovo63");
		if (!$con)
  	{
 		die('Could not connect: ' . mysql_error());
  	}

		mysql_select_db("my_db", $con);
*/	

//=======================================================================
//
// process Request
//
//=======================================================================
                	
	if ($_GET['ajaxType'] == "Request"){
		  if ( !isset($_GET['Value']) ){
		  	//echo ("http://192.168.1.177/request=".$_GET['Type']);
			//$result = mysql_query("insert into brewery.ard_request values('".$_GET['Type']."',null, null ,null);");//request_value_int
		    	//$row = mysql_fetch_array($result);	
		    	error_reporting(E_ERROR | E_PARSE);
			//debig $ch = curl_init("http://".$_SESSION['sLocalIp']."/request=".$_GET['Type']);
			$uri="http://localhost/test_harness.php/?request=".$_GET['Type'];  //added ? to request. may need to be added for Arduino
			echo ($uri);		
			$ch = curl_init($uri);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_exec($ch);
			curl_close($ch);
	

	
		  }else
		  {
			//$result = mysql_query("insert into brewery.ard_request values('".$_GET['Type']."',null,'".str_pad($_GET['Value'],3,0, STR_PAD_LEFT)."',null);");//request_value_int
		    	//$row = mysql_fetch_array($result);
		    	error_reporting(E_ERROR | E_PARSE);
			//$ch = curl_init("http://".$_SESSION['sLocalIp']."/request=".$_GET['Type'].":".str_pad($_GET['Value'],3,0, STR_PAD_LEFT));
			$ch = curl_init("http://localhost//test_harness.php/?request=".$_GET['Type'].":".str_pad($_GET['Value'],3,0, STR_PAD_LEFT)); //added ? to request. may need to be added for Arduino
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_exec($ch);
			curl_close($ch);
				    	
		  }
                  //
                  // set arduino time
                  //
                  if ( $_GET['Type'] == 'SHDW'){
 		    	error_reporting(E_ERROR | E_PARSE);
			$ch = curl_init("http://".$_SESSION['sLocalIp']."/request=STIM:".time());
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_exec($ch);
			curl_close($ch);	                 	
                  }
  
		  
	}
	
//=======================================================================

//=======================================================================
//
// process Status Request
//
//=======================================================================
    	

	if ($_GET['ajaxType'] == "Receive"){

	
	  // create doctype
		$dom = new DOMDocument();
	
	
	
		// display document in browser as plain text
		// for readability purposes
	
	
		// create root element
		$root = $dom->createElement("brewery");
		$dom->appendChild($root);

        //* removed for direct arduino call
        //*
	//*	$result = mysql_query("select * from brewery.request_received");
	//*
	//*	while($row = mysql_fetch_array($result))
	//*  { 
	//*
	//*		$item = $dom->createElement($row['received_type']);
	//*  	$attr = $dom->createAttribute('vessel');
	//*  	$attr->value = $row['received_type'];
	//*		$text = $dom->createTextNode($row['received_value_int']);
	//*
	//*  	$item->appendChild($attr);
	//*		$item->appendChild($text);
	//*		$root->appendChild($item);
	//*	}
	//*
	//*
	//*	// save and display tree
	//*	echo $dom->saveHTML();
	
		error_reporting(E_ERROR | E_PARSE);
		//debug $ch = curl_init("http://".$_SESSION['sLocalIp']."/?status");
		$uri="http://localhost//test_harness.php/?status";
		$ch = curl_init($uri);
		 	
		//curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $xml = curl_exec($ch);
		curl_close($ch);
		echo ($xml);	
	
  }

  	
//=======================================================================
//
// Set Session variable for local iop
//
//=======================================================================


	if ($_GET['ajaxType'] == "SetIP"){
		
		$_SESSION['sLocalIp'] = $_GET['Value'];		
	}
		


  	
  	
//=======================================================================
//
// Dump All Logs
//
//=======================================================================


	if ($_GET['ajaxType'] == "Logs"){
		
		$innerHTML = "";
		
		$result = mysql_query("SELECT date_format(log_date,'%H:%i:%s')LOG_DATE ,log_message FROM brewery.brewery_log order by log_type,log_date;");
		while($row = mysql_fetch_array($result))
	  {
				$innerHTML = $innerHTML.'<tr class="tr-log-row">';
				$innerHTML = $innerHTML.'		<td class="td-log-cell" id="td_log_cell_time"> '.$row["LOG_DATE"].'</td>' ;   
				$innerHTML = $innerHTML.'   <td class="td-log-cell"> '.$row["log_message"].' </td>';
				$innerHTML = $innerHTML.'</tr>';	  	 	
	  }		
				
		echo $innerHTML;
		  
	}
	
//=======================================================================

// mysql_close($con);


//    header("Content-Type: text/xml");
//    echo <<< END_OF_FILE
//    <temps>
//      <temp id="HLT"> {echo rand(1,100)} </temp>
//      <temp id="MASH"> {echo rand(1,100)} </temp>
//      <temp id="BOIL"> {echo rand(1,100)} </temp>
//    </temps>
//    END_OF_FILE     
?>
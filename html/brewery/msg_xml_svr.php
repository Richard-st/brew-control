
<?php
    
//=======================================================================   
//   view-source:http://alex-laptop-xp/guage1_xml_svr.php?ajaxType=Receive
//======================================================================= 


    //connect to db
    $con = mysql_connect("localhost","brewery","lenovo63");
		if (!$con)
  	{
  		die('Could not connect: ' . mysql_error());
  	}

		mysql_select_db("my_db", $con);

	
 
	
	  // create doctype
		$dom = new DOMDocument();
	
	
	
		// display document in browser as plain text
		// for readability purposes
	
	  //-------------------------------------------
	  // HLT Messgages
	  //-------------------------------------------
		$result = mysql_query("SELECT log_type,date_format(log_date,'%H:%i:%s')LOG_DATE ,log_message FROM brewery.brewery_log where log_type = 'HMSG' order by log_type,log_date");		
			
		// create root element
		$root = $dom->createElement("messages");
		$dom->appendChild($root);
		
		// create hltMessage
		$hltm = $dom->createElement('hltMessage');
		$root->appendChild($hltm);

		$tbody = $dom->createElement('tbody');		
		$hltm->appendChild($tbody);		
    $tbody->setAttribute('id', 'tbody-hlt');	
    
    $row = mysql_fetch_array($result);

    
		while($row['log_type'] == 'HMSG'){
		
			$tr = $dom->createElement('tr');		
			$tbody->appendChild($tr);		
   		$tr->setAttribute('class', 'tr-log-row');	
   
			$td = $dom->createElement('td'); 
			$tr->appendChild($td);	
   		$td->setAttribute('class', 'td-log-cell');					
   		$td->setAttribute('id', 'td_log_cell_time');
  		$text = $dom->createTextNode($row['LOG_DATE']);
	 		$td->appendChild($text);		    		      
   		
 			$td = $dom->createElement('td'); 
			$tr->appendChild($td);	
   		$td->setAttribute('class', 'td-log-cell');					
  		$text = $dom->createTextNode($row['log_message']);
	 		$td->appendChild($text);	   
	 		
	 		$row = mysql_fetch_array($result);
	 	}

	  //-------------------------------------------
	  // Mash Messgages
	  //-------------------------------------------
		$result = mysql_query("SELECT log_type,date_format(log_date,'%H:%i:%s')LOG_DATE ,log_message FROM brewery.brewery_log where log_type = 'MMSG' order by log_type,log_date");		
			

		
		// create hltMessage
		$hltm = $dom->createElement('mashMessage');
		$root->appendChild($hltm);

		$tbody = $dom->createElement('tbody');		
		$hltm->appendChild($tbody);		
    $tbody->setAttribute('id', 'tbody-mash');	
    
    $row = mysql_fetch_array($result);

    
		while($row['log_type'] == 'MMSG'){
		
			$tr = $dom->createElement('tr');		
			$tbody->appendChild($tr);		
   		$tr->setAttribute('class', 'tr-log-row');	
   
			$td = $dom->createElement('td'); 
			$tr->appendChild($td);	
   		$td->setAttribute('class', 'td-log-cell');					
   		$td->setAttribute('id', 'td_log_cell_time');
  		$text = $dom->createTextNode($row['LOG_DATE']);
	 		$td->appendChild($text);		    		      
   		
 			$td = $dom->createElement('td'); 
			$tr->appendChild($td);	
   		$td->setAttribute('class', 'td-log-cell');					
  		$text = $dom->createTextNode($row['log_message']);
	 		$td->appendChild($text);	   
	 		
	 		$row = mysql_fetch_array($result);
	 	}
      			
 
	  //-------------------------------------------
	  // Bolier Messgages
	  //-------------------------------------------
		$result = mysql_query("SELECT log_type,date_format(log_date,'%H:%i:%s')LOG_DATE ,log_message FROM brewery.brewery_log where log_type = 'BMSG' order by log_type,log_date");		
			

		
		// create hltMessage
		$hltm = $dom->createElement('boilMessage');
		$root->appendChild($hltm);

		$tbody = $dom->createElement('tbody');		
		$hltm->appendChild($tbody);		
    $tbody->setAttribute('id', 'tbody-boil');	
    
    $row = mysql_fetch_array($result);

    
		while($row['log_type'] == 'BMSG'){
		
			$tr = $dom->createElement('tr');		
			$tbody->appendChild($tr);		
   		$tr->setAttribute('class', 'tr-log-row');	
   
			$td = $dom->createElement('td'); 
			$tr->appendChild($td);	
   		$td->setAttribute('class', 'td-log-cell');					
   		$td->setAttribute('id', 'td_log_cell_time');
  		$text = $dom->createTextNode($row['LOG_DATE']);
	 		$td->appendChild($text);		    		      
   		
 			$td = $dom->createElement('td'); 
			$tr->appendChild($td);	
   		$td->setAttribute('class', 'td-log-cell');					
  		$text = $dom->createTextNode($row['log_message']);
	 		$td->appendChild($text);	   
	 		
	 		$row = mysql_fetch_array($result);
	 	}
      			
    			
    			
		echo $dom->saveHTML();

  	
  
mysql_close($con);

   
    ?>
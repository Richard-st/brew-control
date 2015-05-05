
    	google.load('visualization', '1', {packages:['gauge']});
    	google.setOnLoadCallback(drawGauge);
    	

    	

  		var gaugeData;
  		var gaugeMash1Data;  		
  		var gaugeBoil1Data;   		

  		var gaugeOptions = {min: 10, max: 100, yellowFrom: 80, 
      										 minorTicks: 5,width: 90, height: 90};

  		var hlt_temp_gauge;
  		var mash_temp_gauge;  		
  		var boil_temp_gauge;    		
  		
  		var graphCounter=10; //initial startup to display a graph

			var disableHltTempRefresh=false; 
			var disableHltVolRefresh=false; 			

			function drawGauge() {

				gaugeData = new google.visualization.DataTable();
	
	
				gaugeData.addColumn('number', 'HLT');
				//gaugeData.addColumn('number', 'Mash');
				//gaugeData.addColumn('number', 'Boil');
				gaugeData.addRows(1);
				gaugeData.setCell(0, 0, 0);
				//gaugeData.setCell(0, 1, 0);
				//gaugeData.setCell(0, 2, 0);

  			hlt_temp_gauge = new google.visualization.Gauge(document.getElementById('hlt-guage-1'));
  			hlt_temp_gauge.draw(gaugeData, gaugeOptions);
 
  			//mash guage
				gaugeMash1Data = new google.visualization.DataTable();  			
  			gaugeMash1Data.addColumn('number', 'Mash');
  			gaugeMash1Data.addRows(1);
				gaugeMash1Data.setCell(0, 0, 0);  			
  			mash_temp_gauge = new google.visualization.Gauge(document.getElementById('mash-guage-1'));
  			mash_temp_gauge.draw(gaugeMash1Data, gaugeOptions);		 
  			  			
  			//boiler guage
				gaugeBoil1Data = new google.visualization.DataTable();  			
  			gaugeBoil1Data.addColumn('number', 'Boil');
  			gaugeBoil1Data.addRows(1);
				gaugeBoil1Data.setCell(0, 0, 0);  			
  			boil_temp_gauge = new google.visualization.Gauge(document.getElementById('boiler-guage-1'));
  			boil_temp_gauge.draw(gaugeBoil1Data, gaugeOptions);				
  			
			}

    	// Get the HTTP Object
    	function getHTTPObject(){
    		if (window.ActiveXObject) return new ActiveXObject("Microsoft.XMLHTTP");
    			else 
    				if (window.XMLHttpRequest) return new XMLHttpRequest();
    					else {
    								alert("Your browser does not support AJAX.");
    								return null;
    							}
    	}
     
    	// Change the value of the guage value
    	function setOutput(){

    		if(httpObject.readyState == 4){



      		//update guage

//*   removed for arduino network
      		
        if (window.DOMParser)
          {     
        
          parser=new DOMParser();
        
           xmlDoc=parser.parseFromString(httpObject.responseText,"text/xml");
        
        
          }
        else // Internet Explorer
          {
          xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
          xmlDoc.async=false;
          xmlDoc.loadXML(httpObject.responseText); 
          }

//*      if (window.XMLHttpRequest)
//*        {
//*        xhttp=new XMLHttpRequest();
//*        }
//*      else // IE 5/6
//*        {
//*        xhttp=new ActiveXObject("Microsoft.XMLHTTP");
//*        }
//*      xhttp.open("GET","http://121.99.71.235/?status",false);  ///PROBLEM
//*      xhttp.send();
//*      xmlDoc=xhttp.responseXML;


      		//hlt temp guage    			
    			gaugeData.setValue(0, 0, parseInt(xmlDoc.getElementsByTagName("HTMP")[0].childNodes[0].nodeValue) );
      		hlt_temp_gauge.draw(gaugeData, gaugeOptions);

      		//boiler temp guage
     			gaugeMash1Data.setValue(0, 0, parseInt(xmlDoc.getElementsByTagName("MTMP")[0].childNodes[0].nodeValue) );     		
      		mash_temp_gauge.draw(gaugeMash1Data, gaugeOptions);  
      		      		
      		//boiler temp guage
     			gaugeBoil1Data.setValue(0, 0, parseInt(xmlDoc.getElementsByTagName("BTMP")[0].childNodes[0].nodeValue) );     		
      		boil_temp_gauge.draw(gaugeBoil1Data, gaugeOptions);     			


      		////////////////////
      		//Status Boxes
      		////////////////////
      		statusBox('HHST','H');   //HLT Heater
      		statusBox('HVST','V');   //HLT Value       		
      		statusBox('HPST','P');   //HLT Pump       
      		statusBox('MVST','V');   //HLT Value       		
      		statusBox('MPST','P');   //HLT Pump        		  		
      		statusBox('BHST','H');   //Boiler Heater 
      		document.getElementById('MVOL').innerHTML = parseInt(xmlDoc.getElementsByTagName('MVOL')[0].childNodes[0].nodeValue); //Mash Volume
      		   		
      		////////////////////
      		//Timer Boxes
      		////////////////////
      		timerBox('HTME'); //HLT Timer   
      		timerBox('MTME'); //Mash Start Tim      		
      		timerBox('BSTM'); //Boiler Start Time	      		 
      		timerBox('BTME'); //Time Boiling

      				
      		    	
	      	//update box
					if (!disableHltTempRefresh){
  	  			document.getElementById('HTGT').value = xmlDoc.getElementsByTagName("HTGT")[0].childNodes[0].nodeValue;
  	  		}
					if (!disableHltVolRefresh){
  	  			document.getElementById('HXRV').value = xmlDoc.getElementsByTagName("HXRV")[0].childNodes[0].nodeValue;
  	  		}  	  		

  	  		var dt = new Date(xmlDoc.getElementsByTagName("TIME")[0].childNodes[0].nodeValue *1000 );  	  		
  	  		//document.getElementById('TIME').value = xmlDoc.getElementsByTagName("TIME")[0].childNodes[0].nodeValue;  
  	  		document.getElementById('TIME').innerHTML = pad(dt.getHours(),2) + ':' + pad(dt.getMinutes(),2) ; 
  	  		
  	  		
  	  		//update graph
  	  		if (graphCounter >= 10){
						updateChart(1,parseInt(xmlDoc.getElementsByTagName("HTMP")[0].childNodes[0].nodeValue),
						              parseInt(xmlDoc.getElementsByTagName("TIME")[0].childNodes[0].nodeValue)); 	 
						updateChart(2,parseInt(xmlDoc.getElementsByTagName("MTMP")[0].childNodes[0].nodeValue),
						              parseInt(xmlDoc.getElementsByTagName("TIME")[0].childNodes[0].nodeValue)); 	 
						updateChart(3,parseInt(xmlDoc.getElementsByTagName("BTMP")[0].childNodes[0].nodeValue),
						              parseInt(xmlDoc.getElementsByTagName("TIME")[0].childNodes[0].nodeValue));
						graphCounter = 1;
					}  	
					else
						graphCounter +=1;
					 					              					               		  	  		
	  		  	  		
    		}
    	}	
     
      //-------------------------------------------------------------
      //Heater Status
      //-------------------------------------------------------------      
      function statusBox(elementID,bType){
      	
      		var bText;
      		var background_colour;
      	
       		if (parseInt(xmlDoc.getElementsByTagName(elementID)[0].childNodes[0].nodeValue) == 0 )
      		{
      			switch (bType)
      			{
      				case 'H': bText = "OFF";
      				          break;
      				case 'P': bText = "OFF"; 
      				          break;      				 
      				case 'V': bText = "CLOSE";   
      				          break;      				     				    				
      			}
      			background_colour = "GREEN";
      		}
      		if (parseInt(xmlDoc.getElementsByTagName(elementID)[0].childNodes[0].nodeValue) == 1 )
      		{
      			switch (bType)
      			{
      				case 'H': bText = "ON";
      				          break;      				
      				case 'P': bText = "ON"; 
      				          break;      				 
      				case 'V': bText = "OPEN";
      				          break;      				        				    				
      			}
      			background_colour = "RED";
      		}
      		if (parseInt(xmlDoc.getElementsByTagName(elementID)[0].childNodes[0].nodeValue) == 2 )
      		{
      			bText = "ARMED";
      			background_colour = "YELLOW";
      		}
      		if (parseInt(xmlDoc.getElementsByTagName(elementID)[0].childNodes[0].nodeValue) == 4 )
      		{
      			bText = "T OFF";
      			background_colour = "YELLOW";
      		}      		
     			document.getElementById(elementID).innerHTML = bText		
     			document.getElementById(elementID).style.background= background_colour;     	
      }
     
      //-------------------------------------------------------------
      //Timer Status
      //-------------------------------------------------------------      
      function timerBox(elementID){    
      	
      		var timer;
      		var hour=0;
      		var minute=0;
      		var second=0;

      	 timer = parseInt(xmlDoc.getElementsByTagName(elementID)[0].childNodes[0].nodeValue); 
      	  
      	 hour   = Math.floor( timer/3600);
      	 minute = Math.floor( (timer - (hour*3600)) /60);
      	 second = Math.floor( (timer - (hour*3600)) - (minute*60) );
     	      
    		document.getElementById(elementID).innerHTML = pad(hour,2) + ":" + pad(minute,2)+ ":" + pad(second,2);//+":"+minute+":"second;	 
      	
      }
      
      //-------------------------------------------------------------
      //Pad number with leading zeros
      //-------------------------------------------------------------       
			function pad(number, length) {
    		var str = '' + number;
    		while (str.length < length) {
        		str = '0' + str;
    		}   
    		return str;
			} 


      //-------------------------------------------------------------
    	// Update Logs
      //-------------------------------------------------------------
    	function setLogOutput(){
    		if(httpLogObject.readyState == 4){
    		  
					if (window.DOMParser){    
						parser=new DOMParser();					
						xmlDoc=parser.parseFromString(httpLogObject.responseText,"text/xml");						
					}
					//alert(httpLogObject.responseText); 	  
					//alert(xmlDoc.getElementsByName("td")[0].childNodes[0].nodeValue); 
					
					//--------------------------------------------------------
					// HLT Messages
					//--------------------------------------------------------
					messageInnerHTML = httpLogObject.responseText.substring( httpLogObject.responseText.indexOf('<hltMessage>'),httpLogObject.responseText.indexOf('<mashMessage>'));
   			  document.getElementById('tb-log-hlt').innerHTML = messageInnerHTML;
					//--------------------------------------------------------
					// Mash Messages
					//--------------------------------------------------------
					messageInnerHTML = httpLogObject.responseText.substring( httpLogObject.responseText.indexOf('<mashMessage>'),httpLogObject.responseText.indexOf('<boilMessage>'));
   			  document.getElementById('tb-log-mash').innerHTML = messageInnerHTML;
					//--------------------------------------------------------
					// Boil Messages
					//--------------------------------------------------------
					messageInnerHTML = httpLogObject.responseText.substring( httpLogObject.responseText.indexOf('<boilMessage>'),httpLogObject.responseText.indexOf('</messages>'));
   			  document.getElementById('tb-log-boil').innerHTML = messageInnerHTML;
   			 

    			 if (!hltMsgLock)
    			 		document.getElementById("div_hlt_message").scrollTop = document.getElementById("div_hlt_message").scrollHeight; 
    			 if (!mashMsgLock)    			 		 
    			 		document.getElementById("div_mash_message").scrollTop = document.getElementById("div_mash_message").scrollHeight; 
    			 if (!boilMsgLock)    			 		 
    			 		document.getElementById("div_boil_message").scrollTop = document.getElementById("div_boil_message").scrollHeight;      			 		    			 		
    			 	 	
    		}
    	}
    
      //-------------------------------------------------------------
    	// Lock message box whilst scrolling
      //-------------------------------------------------------------  
			var hltMsgLock;        	
			var mashMsgLock;
			var boilMsgLock;					
    	function LockScroll(mBox, lock){
		 
		 		if (mBox == 'HLT'){
			 		if (lock)
				 		hltMsgLock = true;
			 		else
				 		hltMsgLock = false;    		 
		 		}
		 		if (mBox == 'MASH'){
			 		if (lock)
				 		mashMsgLock = true;
			 		else
				 		mashMsgLock = false;    		 
		 		}
		 		if (mBox == 'BOIL'){
			 		if (lock)
				 		boilMsgLock = true;
			 		else
				 		boilMsgLock = false;    		 
		 		}		 				 		
     	}



    
	    // Implement business logic
    	function doWork(){
    		httpObject = getHTTPObject();
    		if (httpObject != null) {
    			httpObject.open("GET", "guage1_xml_svr.php?ajaxType=Receive", true);
    			httpObject.send(null);
    			httpObject.onreadystatechange = setOutput;
    		}
    	}
    	
    	function doLogWork(){
    		httpLogObject = getHTTPObject();
    		if (httpLogObject != null) {
    			httpLogObject.open("GET", "msg_xml_svr.php");
    			httpLogObject.send(null);
    			httpLogObject.onreadystatechange = setLogOutput;
    		}
    	}  	
    	
  	
     
     //-------------------------------------------------------------
     // Send out a request
     //-------------------------------------------------------------
     function sendRequest(iRequestType,iValue){
     	
    		httpObject = getHTTPObject();
    		if (httpObject != null) {
    			if (iValue == "") 
    				httpObject.open("GET", "guage1_xml_svr.php?ajaxType=Request&Type="+iRequestType, true);
    			else 
    				httpObject.open("GET", "guage1_xml_svr.php?ajaxType=Request&Type="+iRequestType+"&Value="+iValue, true);
    				
    			httpObject.send(null);
    			httpObject.onreadystatechange = setOutput;
    		}     	
    	}

     //-------------------------------------------------------------
     // Set Local IP
     //-------------------------------------------------------------
     function setLocalIP(iIP){

    		httpObject = getHTTPObject();
    		if (httpObject != null) {

			httpObject.open("GET", "guage1_xml_svr.php?ajaxType=SetIP&Value="+iIP, true);
    			httpObject.send(null);
    			httpObject.onreadystatechange = setOutput;
    		}     	

    		
    	}   	
          
     //-------------------------------------------------------------
     
     
     
    	var httpObject = null;
    	var httpLogObject = null;    	
     
    
			var time = 1; //time in seconds
			var interval = time * 500;
			var timer = setInterval("doWork()", interval);
			
			//logs timer
			
			var logTimer = setInterval("doLogWork()", 500);
			

 
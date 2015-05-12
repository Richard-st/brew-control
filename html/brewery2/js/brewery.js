 
  ///////////////////////////////////////////////////
  // Call Server asking Arduino for a status update
  ///////////////////////////////////////////////////
  function getStatus(){
    httpObject = getHTTPObject();
    if (httpObject != null) {
      httpObject.open("GET", "brewery_svr.php?arduinoCall=updateStatus", true);
      httpObject.send(null);
      httpObject.onreadystatechange = processArduinoStatus;
    }
  }     
  

  ///////////////////////////////////////////////////
  // Call Server to instruct Arduino to perform task
  ///////////////////////////////////////////////////
  function sendInstruction(iRequestType,iValue){
    httpObject = getHTTPObject();
    
    if (iRequestType == "HLTHeaterSwitch"){
    	if  (document.getElementById('hltHeadterOnOff').checked == true){
          httpObject.open("GET", "brewery_svr.php?arduinoCall=request&type=HHOF", true);    		
        }
        else{
          httpObject.open("GET", "brewery_svr.php?arduinoCall=request&type=HHON", true);    		
        }
    }
    
    if (iRequestType == "HLTPumpSwitch"){
    	if  (document.getElementById('hltPumpOnOff').checked == true){
          httpObject.open("GET", "brewery_svr.php?arduinoCall=request&type=HPOF", true);    		
        }
        else{
          httpObject.open("GET", "brewery_svr.php?arduinoCall=request&type=HPON", true);    		
        }
    }

    if (iRequestType == "mashPumpSwitch"){
    	if  (document.getElementById('mashPumpOnOff').checked == true){
          httpObject.open("GET", "brewery_svr.php?arduinoCall=request&type=MPOF", true);    		
        }
        else{
          httpObject.open("GET", "brewery_svr.php?arduinoCall=request&type=MPON", true);    		
        }
    }

    if (iRequestType == "boilHeaterSwitch"){
    	if  (document.getElementById('boilHeaterOnOff').checked == true){
          httpObject.open("GET", "brewery_svr.php?arduinoCall=request&type=BHOF", true);    		
        }
        else{
          httpObject.open("GET", "brewery_svr.php?arduinoCall=request&type=BHON", true);    		
        }
    }

    if (iRequestType == "HTGT"){
        httpObject.open("GET", "brewery_svr.php?arduinoCall=request&type=HTGT&value="+iValue, true);    	
    }

    if (iRequestType == "HXRV"){
        httpObject.open("GET", "brewery_svr.php?arduinoCall=request&type=HXRV&value="+iValue, true);    	
    }


    //send request
    httpObject.send(null);	


    
  }  
  
  ///////////////////////////////////////////////////
  // Function will be called each time state of the 
  // server call changes. State 4 ,means response 
  // received. Ignore anything other than 4 
  ///////////////////////////////////////////////////
  function processArduinoResponse(){
    if(httpObject.readyState == 4){
      if (window.DOMParser){     
        parser=new DOMParser();
      }
      else{ // Internet Explorer
        xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
        xmlDoc.async=false;
      }
    }
  }
      
  ///////////////////////////////////////////////////
  // Function will be called each time state of the 
  // server call changes. State 4 ,means response 
  // received. Ignore anything other than 4 
  ///////////////////////////////////////////////////

  function processArduinoStatus(){
    if(httpObject.readyState == 4){
      if (window.DOMParser){     
        parser=new DOMParser();
        xmlDoc=parser.parseFromString(httpObject.responseText,"text/xml");
      }
      else{ // Internet Explorer
        xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
        xmlDoc.async=false;
        xmlDoc.loadXML(httpObject.responseText); 
      }
      
   //-----------------------------------------------------------------------------------------------------
   // update main screen clock
   //-----------------------------------------------------------------------------------------------------
      var dt = new Date(xmlDoc.getElementsByTagName("TIME")[0].childNodes[0].nodeValue *1000 );  
      document.getElementById('TIME').innerHTML = pad(dt.getHours(),2) + ':' + pad(dt.getMinutes(),2) ;            

   //-----------------------------------------------------------------------------------------------------
   // update tempratures
   //-----------------------------------------------------------------------------------------------------
      document.getElementById('HTMP').innerHTML =    xmlDoc.getElementsByTagName("HTMP")[0].childNodes[0].nodeValue;        
      document.getElementById('MTMP').innerHTML =    xmlDoc.getElementsByTagName("MTMP")[0].childNodes[0].nodeValue;        
      document.getElementById('BTMP').innerHTML =    xmlDoc.getElementsByTagName("BTMP")[0].childNodes[0].nodeValue;        

   //-----------------------------------------------------------------------------------------------------
   // Switch control
   //-----------------------------------------------------------------------------------------------------
      if (xmlDoc.getElementsByTagName("HHST")[0].childNodes[0].nodeValue== 1)
        document.getElementById('hltHeadterOnOff').checked = true;
      else
        document.getElementById('hltHeadterOnOff').checked = false;
   
      if (xmlDoc.getElementsByTagName("HPST")[0].childNodes[0].nodeValue== 1)
        document.getElementById('hltPumpOnOff').checked = true;
      else
        document.getElementById('hltPumpOnOff').checked = false;

   
      if (xmlDoc.getElementsByTagName("MPST")[0].childNodes[0].nodeValue== 1)
        document.getElementById('mashPumpOnOff').checked = true;
      else
        document.getElementById('mashPumpOnOff').checked = false;
        
   
      if (xmlDoc.getElementsByTagName("BHST")[0].childNodes[0].nodeValue== 1)
        document.getElementById('boilHeaterOnOff').checked = true;
      else
        document.getElementById('boilHeaterOnOff').checked = false;        


   //-----------------------------------------------------------------------------------------------------
   // update sliders
   //-----------------------------------------------------------------------------------------------------
      document.getElementById('js-display-temp').innerHTML =    xmlDoc.getElementsByTagName("HTGT")[0].childNodes[0].nodeValue+' c';        

      document.getElementById('js-display-xfer').innerHTML =    xmlDoc.getElementsByTagName("HXRV")[0].childNodes[0].nodeValue+' litres';        



   //-----------------------------------------------------------------------------------------------------
   // update other clocks
   //-----------------------------------------------------------------------------------------------------
      timerBox('HTME'); //HLT Timer   
      timerBox('MTME'); //Mash Start Tim      		
      timerBox('BSTM'); //Boiler Start Time	      		 
      timerBox('BTME'); //Time Boiling   
      
    }
  }
  
  ///////////////////////////////////////////////////
  // Utility functions
  ///////////////////////////////////////////////////

  // Create the HTTP Object
  function getHTTPObject(){
    if (window.ActiveXObject) 
      return new ActiveXObject("Microsoft.XMLHTTP");
    else 
      if (window.XMLHttpRequest) 
        return new XMLHttpRequest();
      else {
        alert("Your browser does not support AJAX.");
        return null;
      }
  }

  function pad(number, length) {
    var str = '' + number;
    while (str.length < length) {
      str = '0' + str;
    }   
    return str;
  } 

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


  

  ///////////////////////////////////////////////////
  // timer to get status updates
  ///////////////////////////////////////////////////
    var time = 1;                //time in seconds
    var interval = time * 500;
    var timer = setInterval("getStatus()", interval);
    
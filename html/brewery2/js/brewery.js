 
  ///////////////////////////////////////////////////
  // Call Server asking Arduino for a status update
  ///////////////////////////////////////////////////
  function getStatus(){
    httpObject = getHTTPObject();
    if (httpObject != null) {
      httpObject.open("GET", "brewery_svr.php?arduinoCall=updateStatus", true);
      httpObject.send(null);
      httpObject.onreadystatechange = processArduinoResponse;
    }
  }     
  

  ///////////////////////////////////////////////////
  // Call Server to instruct Arduino to perform task
  ///////////////////////////////////////////////////
  function sendInstruction(iRequestType,iValue){
    httpObject = getHTTPObject();
    if (httpObject != null) {
     if (iValue == "") 
       httpObject.open("GET", "brewery_svr.php?arduinoCall=Request&Type="+iRequestType, true);
     else 
       httpObject.open("GET", "brewery_svr.php?arduinoCall=Request&Type="+iRequestType+"&Value="+iValue, true);
       httpObject.send(null);
       httpObject.onreadystatechange = processArduinoResponse;
    }     	
  }  
  

  ///////////////////////////////////////////////////
  // Create HTTP request object - used for AJAX
  ///////////////////////////////////////////////////
  function getHTTPObject(){
    if (window.ActiveXObject) return new ActiveXObject("Microsoft.XMLHTTP");
    else 
      if (window.XMLHttpRequest) return new XMLHttpRequest();
      else {
        alert("Your browser does not support AJAX.");
        return null;
      }
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
    
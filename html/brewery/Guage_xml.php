
<html>
  <head>
    <script type='text/javascript' src='https://www.google.com/jsapi'></script>

		<script>

    	google.load('visualization', '1', {packages:['gauge']});
    	google.setOnLoadCallback(drawGauge);

  		var gaugeData;

  		var gaugeOptions = {min: 15, max: 50, yellowFrom: 80, yellowTo: 90,
      										redFrom: 90, redTo: 100, minorTicks: 5,width: 400, height: 100};

  		var gauge;



			function drawGauge() {

				gaugeData = new google.visualization.DataTable();
	
	
				gaugeData.addColumn('number', 'HLT');
				gaugeData.addColumn('number', 'Mash');
				gaugeData.addColumn('number', 'Boil');
				gaugeData.addRows(1);
				gaugeData.setCell(0, 0, 0);
				gaugeData.setCell(0, 1, 0);
				gaugeData.setCell(0, 2, 0);

  			gauge = new google.visualization.Gauge(document.getElementById('chart_div'));
  			gauge.draw(gaugeData, gaugeOptions);
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
      		document.getElementById('Debug').value = httpObject.responseText;

      		// alert("XML Temp Tag Name: " + xmlDoc.getElementsByTagName("hlt")[0].childNodes[0].nodeValue);
    		 
      		document.getElementById('Debug').value=xmlDoc.getElementsByTagName("HTMP")[0].childNodes[0].nodeValue;
      		
    			gaugeData.setValue(0, 0, parseInt(xmlDoc.getElementsByTagName("HTMP")[0].childNodes[0].nodeValue) );
    			gaugeData.setValue(0, 1, parseInt(xmlDoc.getElementsByTagName("MTMP")[0].childNodes[0].nodeValue) );
    			gaugeData.setValue(0, 2, parseInt(xmlDoc.getElementsByTagName("BTMP")[0].childNodes[0].nodeValue) );

      		gauge.draw(gaugeData, gaugeOptions);
    	
	      	//update box
  	  		document.getElementById('ManualValue').value = httpObject.responseText;
  	  		document.getElementById('HTGT').value = xmlDoc.getElementsByTagName("HTGT")[0].childNodes[0].nodeValue;

  	  		var dt = new Date(xmlDoc.getElementsByTagName("TIME")[0].childNodes[0].nodeValue *1000 );  	  		
  	  		//document.getElementById('TIME').value = xmlDoc.getElementsByTagName("TIME")[0].childNodes[0].nodeValue;  
  	  		document.getElementById('TIME').value = dt.getHours() + ':' + dt.getMinutes() ; 


  	  			  		
  	  		document.getElementById('HMSG').value = xmlDoc.getElementsByTagName("HMSG")[0].childNodes[0].nodeValue;  	  	  		
    		}
    	}	
     
	    // Implement business logic
    	function doWork(){
    		httpObject = getHTTPObject();
    		if (httpObject != null) {
    			httpObject.open("GET", "guage1_xml_svr.php?ajaxType=Receive&inputText="+document.getElementById('ManualValue').value, true);
    			httpObject.send(null);
    			httpObject.onreadystatechange = setOutput;
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
     
     
     
    	var httpObject = null;
     
    
			var time = 1; //time in seconds
			var interval = time * 500;
			var timer = setInterval("doWork()", interval);
    
		</script>


  </head>
  
  <body>

	  	
    <div id='chart_div'></div>

		<form>
  	
    Temp returned: <input type="text" ID="ManualValue" name="ManualValue"   /><br />
    Debug: <input type="text" ID="Debug" name="Debug"   /><br />
    </form>
  	    
    

    <input type="button" name="REQUEST" value="HPOF" onclick='sendRequest("HPOF","")'  />
    <input type="button" name="REQUEST" value="HPON" onclick='sendRequest("HPON","")'  />    

    <input type="button" name="REQUEST" value="HHOF" onclick='sendRequest("HHOF","")'  />
    <input type="button" name="REQUEST" value="HHON" onclick='sendRequest("HHON","")'  /> 

    <input type="button" name="REQUEST" value="BHOF" onclick='sendRequest("BHOF","")'  />
    <input type="button" name="REQUEST" value="BHON" onclick='sendRequest("BHON","")'  />     
    
    <br>Target HLT Temp<input type="text" id="HTGT"   /> 
    <br>Set HLT Temp<input type="text" id="setHTGT"   />         
    <input type="button" name="REQUEST" value="Set" onclick='sendRequest("HTGT",document.getElementById("setHTGT").value)' /> 

    <br>Time<input type="text" id="TIME"   /> 
    <br>Set HLT Temp<input type="text" id="setTIME"   />         
    <input type="button" name="REQUEST" value="Set" onclick='sendRequest("STIM",document.getElementById("setTIME").value)' />
    hlt Log: <input type="text" ID="HMSG" name="HMSG"   /><br />     

          
    </form>	      
  </body>
</html>
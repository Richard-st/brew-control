
    
      //-------------------------------------------------------------
      //Update status Boxes
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
      				case 'V': bText = "CLOSED";   
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
      			bText = "TOFF";
      			background_colour = "YELLOW";
      		}      		
      		
     			document.getElementById(elementID).innerHTML = bText		
     			document.getElementById(elementID).style.background= background_colour;     	
      }
     
     

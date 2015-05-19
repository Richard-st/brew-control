
  	google.load("visualization", "1", {packages:["corechart"]});
  	google.setOnLoadCallback(drawChart);
  	
		var data;
		var options;
		var chart_hlt;
		var data_hlt;		
		var chart_mash;
		var data_mash;			
		var chart_bolier;
		var data_bolier;			
	

  	
  	function drawChart() {
    	data_hlt = new google.visualization.DataTable();
    	data_hlt.addColumn('timeofday', 'Date');
    	data_hlt.addColumn('number', 'Temprature');
    	
    	data_mash = new google.visualization.DataTable();
    	data_mash.addColumn('timeofday', 'Date');
    	data_mash.addColumn('number', 'Temprature');
    	
    	data_bolier = new google.visualization.DataTable();
    	data_bolier.addColumn('timeofday', 'Date');
    	data_bolier.addColumn('number', 'Temprature');


    	options = {
   		 backgroundColor: '#d3d9df',
    	lineWidth: 1,
    	chartArea: {left:20,
    		          top:5,
    		          width:'90%',
    		          height:'80%'},
      legend: {position:'none'},
      vAxis: { minValue:0,
      	       maxValue:100     	
      				}   ,
      hAxis: {slantedText:'true',
              slantedTextAngle:'90',
              gridlines:{ count:5},
              format:'HH:mm',
              showTextEvery : 1,
      				},
     				
          
    	};

    	chart_hlt = new google.visualization.AreaChart(document.getElementById('hlt_chart'));  	 
    	chart_hlt.draw(data_hlt, options);
    	
    	chart_mash = new google.visualization.AreaChart(document.getElementById('mash_chart'));    
    	chart_mash.draw(data_mash, options);   
    	
    	chart_bolier = new google.visualization.AreaChart(document.getElementById('boil_chart'));    
    	chart_bolier.draw(data_bolier, options);    
    	
    	
      function resize_hlt () {
      var chart = new google.visualization.LineChart(document.getElementById('hlt_chart'));
      chart.draw(data, options);
      }
        
      function resize_mash () {
      var mash_chart = new google.visualization.LineChart(document.getElementById('mash_chart'));
      mash_chart.draw(data, options);
      }
        
      function resize_boil () {
      var boil_chart = new google.visualization.LineChart(document.getElementById('boil_chart'));
      boil_chart.draw(data, options);
      }        

      window.onload = resize_hlt();
      window.onload = resize_mash();
      window.onload = resize_boil();        
      window.onresize = resize;     	
    	 	 		    	
  	}
  	
  	function updateChart(iType, fTemp, fTime ){

  			var date = new Date(fTime*1000);
				var hours = date.getHours();
				var minutes = date.getMinutes();
				var seconds = date.getSeconds();

        switch (iType) {
        	case 1: data_hlt.addRows ([ [ [  hours, minutes, seconds  ], fTemp]        ]);
		    					chart_hlt.draw(data_hlt, options);
		    					break;
        	case 2: data_mash.addRows ([ [ [  hours, minutes, seconds  ], fTemp]        ]);
		    					chart_mash.draw(data_mash, options);
		    					break;
        	case 3: data_bolier.addRows ([ [ [  hours, minutes, seconds  ], fTemp]        ]);
		    					chart_bolier.draw(data_bolier, options);
		    					break;		    							    					
		    }
        	

  		
  	}

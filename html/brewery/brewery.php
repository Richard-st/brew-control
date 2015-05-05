<?php 
  session_start(); 
?>

<html>
  <head>
    <script type='text/javascript' src='https://www.google.com/jsapi'></script>

		<script type='text/javascript' src='js/brewery.js'> </script>
		<script type='text/javascript' src='js/vessel_graph.js'> </script>		
		
    <link rel="stylesheet" type="text/css" href="css/breweryControl.css" />		
  
  </head>
  
  <body>
	<div class="" id="Container">
		<div class="pane-row" id="outputRow">
	   		 <div class="pane" id="output-Container">
	   		 
       				<div class="pane-header">
       	 				<table style="width:100%">
       	 					<tbody>
       	 						<tr >
       	 							<td style="text-align:left">
       	 				 			<h3 id="TIME" ></h3>
       	 							</td>
       	 							<td style="text-align:center">
       	 				 				<h2>Nano Brewery</h2>
       	 				 			</td>
       	 				 			 
       	 							<td style="text-align:right">

         								  <script type="text/javascript" src="http://l2.io/ip.js?var=myip"></script>	         								  
         								  <input  type="button" name="ip" value="IP" onclick='setLocalIP(myip)'  /> 
   								
       	 							</td>         	 							
       	 							
       	 							<td style="text-align:right">       	 			
         								<input  type="button" name="REQUEST" value="Reset" onclick='sendRequest("SHDW","")'  />   
       	 							</td>                 	 			      	 			
       	 						</tr>
       	 					</tbody>
       					</table>
      				 </div>
      				 
       	<div class="pane-content">
       	
         <!-- ------------------------------------------------------------------------------------  !-->
         <!-- HLT                                                                                  !-->         
         <!-- ------------------------------------------------------------------------------------  !-->         	
         <div class="vessel" id="hlt-vessel">       	
           	<div class="div_vessel_header">
           		HLT
           	</div>
						<!-- ------------------------------------------------------------------------------------  !-->
         		<!-- Vessel Status                                                                         !-->         
         		<!-- ------------------------------------------------------------------------------------  !-->                	
            <div class="div_vessel_box" id="div_vessel_status" >
            	<table class="tb_vessel_status">
            		<tr id="tr_vessel_status">
            			<td rowspan="4">
         	 		 			<div class="temp_guage" id="hlt-guage-1"> </div>
            		 					
            			</td>
            			<td class="td_vessel_status_text" >
            				 Heater
            			</td>
            			<td class="td_vessel_status_status" id="HHST" >
            				 ON
            			</td>           			
            		</tr>
            		<tr id="tr_vessel_status">
            			<td class="td_vessel_status_text">
            				 Valve
            			</td>
            			<td class="td_vessel_status_status" id="HVST">
            				 OPEN
            			</td>               			
            		</tr>
            		<tr id="tr_vessel_status">
            			<td class="td_vessel_status_text">
            				 Pump
            			</td>
            			<td class="td_vessel_status_status" id="HPST">
            				 OPEN
            			</td>               			
            		</tr>        
            		<tr id="tr_vessel_status">
            			<td class="td_vessel_status_text">
            				 Start Time
            			</td>
            			<td class="td_vessel_status_status" id="HTME">
                     00:00:00
            			</td>               			
            		</tr>  
            		            		    		
            	</table>

           	</div> 
           	
   					<!-- ------------------------------------------------------------------------------------  !-->
         		<!-- Vessel Control                                                                         !-->         
         		<!-- ------------------------------------------------------------------------------------  !-->            
             <div class="div_vessel_box" id="div_vessel_control" >
            	<table class="tb_vessel_control" >
            		<tr id="tr_vessel_control">
            			<td id="td_vessel_control_filler"></td>     
            			       			
            			<td id="td_vessel_control_button_lf">
            				<input id="ip_vessel_control_button_false" type="button" name="REQUEST" value="Off" onclick='sendRequest("HHOF","")'  />            		             				  
            			</td>
            			<td id="td_vessel_control_text">
            				 Heater
            			</td> 
            			<td id="td_vessel_control_button_rg">
             				<input id="ip_vessel_control_button_true" type="button" name="REQUEST" value="On" onclick='sendRequest("HHON","")'  />             				
            			</td>
            			<td id="td_vessel_control_filler"></td>    
            			        			
            			<td id="td_vessel_control_button_lf">
             				<input id="ip_vessel_control_button_false" type="button" name="REQUEST" value="Off" onclick='sendRequest("HPOF","")'  />             				
            			</td>
            			<td id="td_vessel_control_text">
            				 Pump
            			</td> 
            			<td id="td_vessel_control_button_rg">
             				<input id="ip_vessel_control_button_true" type="button" name="REQUEST" value="On" onclick='sendRequest("HPON","")'  />    
            			</td> 
            			<td id="td_vessel_control_filler"></td>    
            			        			           			          			
            		</tr>
            		
            		<tr id="tr_vessel_control_row_filler" ">
            			<td id="td_vessel_control_filler" ">&nbsp</td> 

            		</tr>
            		

            		<tr id="tr_vessel_control">
            			<td id="td_vessel_control_filler"></td>
            			<td id="td_vessel_control_button_lf">
             				<input id="ip_vessel_control_button_false" type="button" name="REQUEST" value="Stop" onclick='sendRequest("HXFS","")'  />                				
            			</td>
            			<td id="td_vessel_control_text">
            				 Xfer
            			</td>            			
            			<td id="td_vessel_control_button_rg">
             				<input id="ip_vessel_control_button_true" type="button" name="REQUEST" value="Go" onclick='sendRequest("HXFG","")'  />   
            			</td> 
            			<td id="td_vessel_control_filler"></td>
            			<td id="td_vessel_control_button_lf">
              			<input id="ip_vessel_control_button_false" type="button" name="REQUEST" value="Close" onclick='sendRequest("HVCL","")'  />   
            			</td>
            			<td id="td_vessel_control_text">
            				 Valve
            			</td> 
            			<td id="td_vessel_control_button_rg">

             				<input id="ip_vessel_control_button_true" type="button" name="REQUEST" value="Open" onclick='sendRequest("HVOP","")'  />                   			
            			</td>
            			<td id="td_vessel_control_filler"></td>            			          			
            		</tr>            		

           		<tr id="tr_vessel_control_row_filler" ">
            			<td id="td_vessel_control_filler" ">&nbsp</td> 

            		</tr>
            		

            		<tr id="tr_vessel_control">
            			<td id="td_vessel_control_filler"></td>

            			<td id="td_vessel_control_button_lf" >
             				<input id="ip_vessel_control_button_false" style="color:green" type="button" name="REQUEST" value="Set" onclick='sendRequest("HXRV",document.getElementById("HXRV").value)'  />                				
            			</td>
            			
            			<td id="td_vessel_control_text">
            				 X Vol
            			</td>       
            			<td id="td_vessel_control_input_box">            			     			
										<input type="text" id="HXRV" class="ip_vessel"  onclick='disableHltVolRefresh=true;'  />   
									</td>

            			<td id="td_vessel_control_filler"></td>

            			<td id="td_vessel_control_button_lf" >
             				<input id="ip_vessel_control_button_false" style="color:green" type="button" name="REQUEST" value="Set" onclick='sendRequest("HTGT",document.getElementById("HTGT").value)'  />                				
            			</td>
            			
            			<td id="td_vessel_control_text" >
            				 Temp
            			</td> 
 
             			<td id="td_vessel_control_input_box">            			     			
										<input type="text" id="HTGT" class="ip_vessel"  onclick='disableHltTempRefresh=true;' />   
									</td>  
   
            			<td id="td_vessel_control_filler"></td>            			          			
            		</tr>            		

       
           		    		
            	</table>

           	</div> 
        		
    				<!-- ------------------------------------------------------------------------------------  !-->
         		<!-- Temp Graph Control                                                                    !-->         
         		<!-- ------------------------------------------------------------------------------------  !-->                       		
         	           	         	
            <div class="div_vessel_box" id="div_vessel_graph" >
							<div class="temp_chart_div" id="hlt_temp_chart" ></div>
           	</div>   
    				<!-- ------------------------------------------------------------------------------------  !-->
         		<!-- Vessel Log                                                                            !-->         
         		<!-- ------------------------------------------------------------------------------------  !-->                       		
         	           	         	

            <div class="div_vessel_box" id="div_vessel_log" >
            	<div class="div_vessel_log_container" id="div_hlt_message" onmouseover="LockScroll('HLT', true);"onmouseout="LockScroll('HLT', false);" >
								<table class="tb-log" id="tb-log-hlt">
<tr class="tr-log-row"><td class="td-log-cell" id="td_log_cell_time">20:20</td><td class="td-log-cell">Text Message</td></tr>
								</table>
           		</div>  								
           	</div>   
    				<!-- ------------------------------------------------------------------------------------  !-->
         		<!-- End of HLT                                                                           !-->         
     				<!-- ------------------------------------------------------------------------------------  !-->
          </div>	       

         <!-- ------------------------------------------------------------------------------------  !-->
         <!-- mash                                                                                  !-->         
         <!-- ------------------------------------------------------------------------------------  !-->         	
         <div class="vessel" id="mash-vessel">       	
           	<div class="div_vessel_header">
           		Mash
           	</div>
						<!-- ------------------------------------------------------------------------------------  !-->
         		<!-- Vessel Status                                                                         !-->         
         		<!-- ------------------------------------------------------------------------------------  !-->                	
            <div class="div_vessel_box" id="div_vessel_status" >
            	<table class="tb_vessel_status">
            		<tr id="tr_vessel_status">
            			<td rowspan="4">
         	 		 			<div class="temp_guage" id="mash-guage-1"> </div>
            		 					
            			</td>
            			<td class="td_vessel_status_text">
            				 Volume
            			</td>
            			<td class="td_vessel_status_status"  id="MVOL">
            				 22
            			</td>           			
            		</tr>
            		<tr  id="tr_vessel_status">
            			<td class="td_vessel_status_text">
            				 Valve
            			</td>
            			<td class="td_vessel_status_status"  id="MVST">
            				 OPEN
            			</td>               			
            		</tr>
            		<tr id="tr_vessel_status">
            			<td class="td_vessel_status_text">
            				 Pump
            			</td>
            			<td class="td_vessel_status_status"  id="MPST">
            				 OPEN
            			</td>               			
            		</tr>        
            		<tr  id="tr_vessel_status">
            			<td class="td_vessel_status_text">
            				 Start Time
            			</td>
            			<td class="td_vessel_status_status"  id="MTME">
            				 00:00:00
            			</td>               			
            		</tr>              		    		
            	</table>

           	</div> 
           	
   					<!-- ------------------------------------------------------------------------------------  !-->
         		<!-- Vessel Control                                                                         !-->         
         		<!-- ------------------------------------------------------------------------------------  !-->            
             <div class="div_vessel_box" id="div_vessel_control" >
            	<table class="tb_vessel_control" >
            		<tr id="tr_vessel_control">
            			<td id="td_vessel_control_filler"></td>     
            			       			          			        			
            			<td id="td_vessel_control_button_lf">
             				<input id="ip_vessel_control_button_false" type="button" name="REQUEST" value="Off" onclick='sendRequest("MPOF","")'  />             				
            			</td>
            			<td id="td_vessel_control_text">
            				 Pump
            			</td> 
            			<td id="td_vessel_control_button_rg">
             				<input id="ip_vessel_control_button_true" type="button" name="REQUEST" value="On" onclick='sendRequest("MPON","")'  />    
            			</td> 
            			<td id="td_vessel_control_filler"></td>    
            			        			           			          			
            		</tr>
            		
            		<tr id="tr_vessel_control_row_filler" ">
            			<td id="td_vessel_control_filler" ">&nbsp</td> 
            		</tr>
            		
            		<tr id="tr_vessel_control">     
            			<td id="td_vessel_control_filler"></td>            			       		            			
            			<td id="td_vessel_control_button_lf">
              			<input id="ip_vessel_control_button_false" type="button" name="REQUEST" value="Close" onclick='sendRequest("MVCL","")'  />   
            			</td>
            			<td id="td_vessel_control_text">
            				 Valve
            			</td> 
            			<td id="td_vessel_control_button_rg">

             				<input id="ip_vessel_control_button_true" type="button" name="REQUEST" value="Open" onclick='sendRequest("MVOP","")'  />                   			
            			</td>
            			<td id="td_vessel_control_filler"></td>            			          			
            		</tr>  
            		         		
            		<tr id="tr_vessel_control_row_filler" ">
            			<td id="td_vessel_control_filler" ">&nbsp</td> 
            		</tr>
            		            		
            		<tr id="tr_vessel_control">
            			<td id="td_vessel_control_filler"></td>
            			<td id="td_vessel_control_button_lf">
             				<input id="ip_vessel_control_button_false" type="button" name="REQUEST" value="Stop" onclick='sendRequest("MXSP","")'  />                				
            			</td>
            			<td id="td_vessel_control_text">
            				 Xfer
            			</td>            			
            			<td id="td_vessel_control_button_rg">
             				<input id="ip_vessel_control_button_true" type="button" name="REQUEST" value="Go" onclick='sendRequest("MXST","")'  />   
            			</td> 
            			<td id="td_vessel_control_filler"></td>
            		</tr>          		

           		<tr id="tr_vessel_control_row_filler" ">
            			<td id="td_vessel_control_filler" ">&nbsp</td> 

            		</tr>
            	 
           		    		
            	</table>

           	</div> 
        		
    				<!-- ------------------------------------------------------------------------------------  !-->
         		<!-- Temp Graph Control                                                                    !-->         
         		<!-- ------------------------------------------------------------------------------------  !-->                       		
         	           	         	
            <div class="div_vessel_box" id="div_vessel_graph" >
							<div class="temp_chart_div" id="mash_temp_chart" ></div>
           	</div>   
    				<!-- ------------------------------------------------------------------------------------  !-->
         		<!-- Vessel Log                                                                            !-->         
         		<!-- ------------------------------------------------------------------------------------  !-->                       		
         	           	         	

            <div class="div_vessel_box" id="div_vessel_log" >
            	<div class="div_vessel_log_container"  id="div_mash_message" onmouseover="LockScroll('MASH', true);"onmouseout="LockScroll('MASH', false);" >
								<table class="tb-log" id="tb-log-mash">

								</table>
           		</div>  								
           	</div>  

    				<!-- ------------------------------------------------------------------------------------  !-->
         		<!-- End of Mash                                                                           !-->         
     				<!-- ------------------------------------------------------------------------------------  !-->
         </div> 
           	       
         <!-- ------------------------------------------------------------------------------------  !-->
         <!-- boiler                                                                                  !-->         
         <!-- ------------------------------------------------------------------------------------  !-->         	
         <div class="vessel" id="boiler-vessel">       	
           	<div class="div_vessel_header">
           		Boiler
           	</div>
						<!-- ------------------------------------------------------------------------------------  !-->
         		<!-- Vessel Status                                                                         !-->         
         		<!-- ------------------------------------------------------------------------------------  !-->                	
            <div class="div_vessel_box" id="div_vessel_status" >
            	<table class="tb_vessel_status">
            		<tr id="tr_vessel_status">
            			<td rowspan="4">
         	 		 			<div class="temp_guage" id="boiler-guage-1"> </div>
            		 					
            			</td>
            			<td class="td_vessel_status_text" >
            				 Heater
            			</td>
            			<td class="td_vessel_status_status" id="BHST" >
            				 ON
            			</td>           			
            		</tr>
            		<tr id="tr_vessel_status">
            			<td  class="td_vessel_status_text" >
            				 Start Time 
            			</td>
            			<td class="td_vessel_status_status" id="BSTM">
            				 00:00:00
            			</td>               			
            		</tr>
            		<tr id="tr_vessel_status">
            			<td  class="td_vessel_status_text">
             				 Boil Time            				  
            			</td>
            			<td class="td_vessel_status_status" id="BTME">
            				 00:00:00            				  
            			</td>               			
            		</tr>        
            		<tr id="tr_vessel_status">
            			<td class="td_vessel_status_text">
            				  
            			</td>
            			<td class="td_vessel_status_status">
            				  
            			</td>               			
            		</tr>              		    		
            	</table>

           	</div> 
           	
   					<!-- ------------------------------------------------------------------------------------  !-->
         		<!-- Vessel Control                                                                         !-->         
         		<!-- ------------------------------------------------------------------------------------  !-->            
             <div class="div_vessel_box" id="div_vessel_control" >
            	<table class="tb_vessel_control" >
            		<tr id="tr_vessel_control">
            			<td id="td_vessel_control_filler"></td>     
            			       			
            			<td id="td_vessel_control_button_lf">
            				<input id="ip_vessel_control_button_false" type="button" name="REQUEST" value="Off" onclick='sendRequest("BHOF","")'  />            		             				  
            			</td>
            			<td id="td_vessel_control_text">
            				 Heater
            			</td> 
            			<td id="td_vessel_control_button_rg">
             				<input id="ip_vessel_control_button_true" type="button" name="REQUEST" value="On" onclick='sendRequest("BHON","")'  />             				
            			</td>

            			<td id="td_vessel_control_filler"></td>    
            			        			           			          			
            		</tr>
            		
            		<tr id="tr_vessel_control_row_filler" ">
            			<td id="td_vessel_control_filler" ">&nbsp</td> 

            		</tr>
 
           		    		
            	</table>

           	</div> 
        		
    				<!-- ------------------------------------------------------------------------------------  !-->
         		<!-- Temp Graph Control                                                                    !-->         
         		<!-- ------------------------------------------------------------------------------------  !-->                       		
         	           	         	
            <div class="div_vessel_box" id="div_vessel_graph" >
							<div class="temp_chart_div" id="boiler_temp_chart" ></div>
           	</div>   
    				<!-- ------------------------------------------------------------------------------------  !-->
         		<!-- Vessel Log                                                                            !-->         
         		<!-- ------------------------------------------------------------------------------------  !-->                       		
         	           	         	

            <div class="div_vessel_box" id="div_vessel_log" >
            	<div class="div_vessel_log_container" id="div_boil_message" onmouseover="LockScroll('BOIL', true);"onmouseout="LockScroll('BOIL', false);" >
								<table class="tb-log" id="tb-log-boil">

								</table>
           		</div>  								
           	</div>  

    				<!-- ------------------------------------------------------------------------------------  !-->
         		<!-- End of Boiler                                                                           !-->         
     				<!-- ------------------------------------------------------------------------------------  !-->
         </div>          	       
           	                    	                      	
        
         </div>           
      </div>
     </div>
    </div>
  
        
  </body>
</html>
<head>
  <meta name="viewport" content="width-device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/main_tablet.css" media="screen and (max-width:900px)">
  <!-- <link rel="stylesheet" href="css/main_phone_landscape.css" media="screen and (max-width:640px)">  -->    
  <link rel="stylesheet" href="css/main_phone_portrait.css" media="screen and (max-width:360px)">  

  <link rel="stylesheet" href="css/on-off-switch.css">  
    
  <link rel="stylesheet" href="dist/powerange.css" />  

  <link rel="stylesheet" href="css/colour_pallette_2.css">
  
  
  <script type='text/javascript' src='https://www.google.com/jsapi'></script>

  <script type='text/javascript' src='js/brewery.js'> </script> 

  <script type='text/javascript' src='js/vessel_graph.js'> </script>
 




</head>

<body>
  <div id="canvass">
    <div id="header">
      <h9 id="TIME" >Time</h9>
      Nano Brewery1
    </div>
    <div id="page-body">
      
      <div class="vessel-container">
         <div class="vessel-title">
           HLT
         </div>
         <div class="vessel-status">
         
           <div class="vessel-temp">
             <div id="HTMP"></div>
             <div id="js-display-temp" style="font-size:18;float:left" class="display-box">0</div>
             <div id="js-display-xfer" style="font-size:18;float:left" class="display-box">0</div>        
           </div>


           <div class="vessel-graph">
             <div id="hlt_chart" ></div>
 
           </div>                    

         </div>
         
            <div class="vessel-control">
           
                <table class="tb-vessel-control" >
                  <tr class="tr-vessel-control-control"> 
                    <td class="td-vessel-control-switch">
                      <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="hltHeadterOnOff"   >
                        <label class="onoffswitch-label"  for="hltHeadterOnOff" onclick='sendInstruction("HLTHeaterSwitch","")'>
                          <span id="onOffSwitchHltHeater" class="hltHeaterOnOffSwitch-inner onoffswitch-inner" ></span>
                          <span class="onoffswitch-switch"></span>
                        </label>
                      </div>               
                    </td>
                    <td class="td-vessel-control-slider">
                      <div class="slider-wrapper" style="float:left;width:100%">
                        <input type="text" id="HTGT" class="hltTempSet" onchange='sendInstruction("HTGT",document.getElementById("HTGT").value)'  />
                        <div id="hltTempSet" class="display-box"></div>
                      </div>
                    </td> 
                  </tr>

               
                  <tr class="tr-vessel-control-control"> 
                    <td class="td-vessel-control-switch">                     
                      <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="hltPumpOnOff" unchecked>
                        <label class="onoffswitch-label" for="hltPumpOnOff" onclick='sendInstruction("HLTPumpSwitch","")'>
                          <span class="hltPumpOnOffSwitch-inner onoffswitch-inner"></span>
                          <span class="onoffswitch-switch"></span>
                        </label>
                      </div> 
                    </td>
                    <td class="td-vessel-control-slider">
                      <div class="slider-wrapper" style="float:left;width:100%">
                        <input type="text" id="HXRV" class="hltXferSet" onchange='sendInstruction("HXRV",document.getElementById("HXRV").value)' />
                        <div id="hltXferSet" class="display-box"></div>
                      </div>
                    </td>                     
                  </tr>
                  
                </table>
  
           
           </div>         
           
           <div class="vessel-timer" id="HTME"></div>
                 
      </div>
      

      
      <div class="vessel-container">
         <div class="vessel-title">
           MASH
         </div>
         <div class="vessel-status">
         
           <div class="vessel-temp">
             <div id="MTMP"></div>
             <div id="mash-volume" style="font-size:18;float:left" class="display-box">3 Litres</div>
           </div>


           <div class="vessel-graph">
             <div id="mash_chart" ></div>
           </div>                    

         </div>
         
            <div class="vessel-control">
           
                <table class="tb-vessel-control" >
                  <tr class="tr-vessel-control-control"> 
                    <td class="td-vessel-control-switch">
                      <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="mashPumpOnOff" unchecked>
                        <label class="onoffswitch-label"  for="mashPumpOnOff" onclick='sendInstruction("mashPumpSwitch","")'>
                          <span class="mashPumpOnOffSwitch-inner onoffswitch-inner" ></span>
                          <span class="onoffswitch-switch"></span>
                        </label>
                      </div>               
                    </td>
                  </tr>
                </table>
           </div>         
           <div class="vessel-timer" id="MTME"></div>
       </div>
      
      
      <div class="vessel-container">
         <div class="vessel-title">
           BOIL
         </div>
         <div class="vessel-status">
         
           <div class="vessel-temp">
             <div id="BTMP"></div>
           </div>

           <div class="vessel-graph">
             <div id="boil_chart" ></div>
           </div>                    

         </div>
         
            <div class="vessel-control">
                <table class="tb-vessel-control" >
                  <tr class="tr-vessel-control-control"> 
                    <td class="td-vessel-control-switch">
                      <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="boilHeadterOnOff" unchecked>
                        <label class="onoffswitch-label"  for="boilHeadterOnOff" onclick='sendInstruction("boilHeaterSwitch","")'>
                          <span id="onOffSwitchBoilHeater" class="boilHeaterOnOffSwitch-inner onoffswitch-inner" ></span>
                          <span class="onoffswitch-switch"></span>
                        </label>
                      </div>               
                    </td>
                  </tr>
                </table>
           </div>         
         <div class="vessel-timer"  id="BSTM">01:21:01</div>
         <div class="vessel-timer"  id="BTME">01:21:01</div>             
       </div>
    </div>

    
    <div id="footer">
      Footer
    </div>   
  </div>  
  
 <script src="dist/powerange.js"></script>
  <script type="text/javascript">

     // HTL Temp
    var dec1 = document.querySelector('.hltTempSet');
    var initDec1 = new Powerange(dec1, { decimal: true,  hideRange: true, callback: displayDecimalValue, max: 100, start: 0, step : 1 });

    function displayDecimalValue() {
      document.getElementById('js-display-temp').innerHTML = dec1.value+ " c ";
    }
  </script>  
 
 
  <script type="text/javascript">
    var dec2 = document.querySelector('.hltXferSet');
    var initDec2 = new Powerange(dec2, { decimal: true,  hideRange: true, callback: displayDecimalValue, max: 100, start: 0, step : 1 });

    function displayDecimalValue() {
      document.getElementById('js-display-xfer').innerHTML = dec2.value + " litres";
    }
  </script>  
 

     
 
     
</body>
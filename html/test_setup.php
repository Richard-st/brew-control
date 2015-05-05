<!DOCTYPE html>
<html>
  <head>
    <script>
      function ajaxCall(keyKey,keyValue)
      {
      var xmlhttp;
      if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }
      else
        {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
      xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
          document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
          }
        }
      //alert("test " + "test_server.php?key=HTMP&value="+document.getElementById('in_HTMP').value );
      xmlhttp.open("GET","test_server.php?key="+keyKey+"&value="+keyValue ,true);
      xmlhttp.send();      
      }
    </script>

  </head>

  <body>
    <?php
       //Connecting to Redis server on localhost
       $redis = new Redis();
       $redis->connect('127.0.0.1', 6379);
    ?>

    <table style="border:1px;border-style:solid;border-collapse:collapse;border-spacing: 0; ">
      <tr >
      
        <td style="border:1px;border-style:solid">
           <h3>HLT Heater</h3>
        </td>      
        <td style="border:1px;border-style:solid">
           <input type="radio" name="rb_HHST" value="1" checked onclick="ajaxCall('HHST','1') ">On
        </td>
        <td style="border:1px;border-style:solid">
           <input type="radio" name="rb_HHST" value="0" onclick="ajaxCall('HHST','2')">Armed
        </td>        
        <td style="border:1px;border-style:solid">
           <input type="radio" name="rb_HHST" value="0" onclick="ajaxCall('HHST','0')">Off
        </td>
        
        <td style="border:1px;border-style:solid">
           <h3>HLT Value</h3>
        </td>      
        <td style="border:1px;border-style:solid">
           <input type="radio" name="rb_HVST" value="1" checked onclick="ajaxCall('HVST','1') ">On
        </td>
        <td style="border:1px;border-style:solid">
           <input type="radio" name="rb_HVST" value="0" onclick="ajaxCall('HVST','0')">Off
        </td>
        
        <td style="border:1px;border-style:solid">
           <h3>HLT Pump</h3>
        </td>      
        <td style="border:1px;border-style:solid">
           <input type="radio" name="rb_HPST" value="1" checked onclick="ajaxCall('HPST','1') ">On
        </td>
        <td style="border:1px;border-style:solid">
           <input type="radio" name="rb_HPST" value="0" onclick="ajaxCall('HPST','0')">Off
        </td>        

        <td style="border:1px;border-style:solid">
           <h3>HLT Temp</h3>
        </td>      
        <td style="border:1px;border-style:solid">
          <input type="input" id="in_HTMP" style="width:30px;" value="<?php echo $redis->get('HTMP') ?>" onchange="ajaxCall('HTMP',document.getElementById('in_HTMP').value ) "  >
        </td>
        
      
        
      </tr>
    </table>

   

    

  </body>
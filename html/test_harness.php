<?php
   //Connecting to Redis server on localhost
   $redis = new Redis();
   $redis->connect('127.0.0.1', 6379);
?>

<?php 
      echo "<BREWERY_STATUS>";
        echo "<HTL>";
          echo "<HTMP>" . $redis->get('HTMP') . "</HTMP>";
          echo "<HHST>".$redis->get('HHST')."</HHST>"; 
          echo "<HVST>".$redis->get('HVST')."</HVST>"; 
          echo "<HPST>".$redis->get('HPST')."</HPST>";
          echo "<HTME>".$redis->get('HTME')."</HTME>";
        echo "</HTL>";
        echo "<MASH>";
          echo "<MTMP>10.0</MTMP>";
        echo "</MASH>";
        echo "<Boiler>";
          echo "<BTMP>15.0</BTMP>";
        echo "</Boiler>";
      echo "</BREWERY_STATUS>";
?>

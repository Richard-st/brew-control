<?php
   //Connecting to Redis server on localhost
   $redis = new Redis();
   $redis->connect('127.0.0.1', 6379);
?>

<?php 
      echo "<BREWERY_STATUS>";
        echo "<HTL>";
          echo "<HTMP>".$redis->get('HTMP')."</HTMP>";
          echo "<HHST>".$redis->get('HHST')."</HHST>"; 
          echo "<HVST>".$redis->get('HVST')."</HVST>"; 
          echo "<HPST>".$redis->get('HPST')."</HPST>";
          echo "<HTME>".$redis->get('HTME')."</HTME>";
        echo "</HTL>";
        echo "<MASH>";
          echo "<MTMP>".$redis->get('MTMP')."</MTMP>";
          echo "<MVOL>".$redis->get('MVOL')."</MVOL>";
          echo "<MVST>".$redis->get('MVST')."</MVST>";          
          echo "<MPST>".$redis->get('MPST')."</MPST>";          
        echo "</MASH>";
        echo "<Boiler>";
          echo "<BTMP>".$redis->get('BTMP')."</BTMP>";
          echo "<BHST>".$redis->get('BHST')."</BHST>";
        echo "</Boiler>";
      echo "</BREWERY_STATUS>";
?>

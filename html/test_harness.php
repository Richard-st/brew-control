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
          $htime=time() - $redis->get('HTME');
          echo "<HTME>".$htime."</HTME>";
        echo "</HTL>";
        echo "<MASH>";
          echo "<MTMP>".$redis->get('MTMP')."</MTMP>";
          echo "<MVOL>".$redis->get('MVOL')."</MVOL>";
          echo "<MVST>".$redis->get('MVST')."</MVST>";          
          echo "<MPST>".$redis->get('MPST')."</MPST>";          
          $mtime=time() - $redis->get('MTME');
          echo "<MTME>".$mtime."</MTME>";
        echo "</MASH>";
        echo "<Boiler>";
          echo "<BTMP>".$redis->get('BTMP')."</BTMP>";
          echo "<BHST>".$redis->get('BHST')."</BHST>";
          $bstime=time() - $redis->get('BSTM');
          echo "<BSTM>".$bstime."</BSTM>";
          $btime=time() - $redis->get('BTME');
          echo "<BTME>".$btime."</BTME>";
        echo "</Boiler>";
      echo "</BREWERY_STATUS>";
?>

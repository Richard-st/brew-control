<?php
   //Connecting to Redis server on localhost
   $redis = new Redis();
   $redis->connect('127.0.0.1', 6379);
?>

<?php 

      echo "<BREWERY_STATUS>";
        echo "<HTL>";
          echo "<HTMP>".$redis->get('HTMP')."</HTMP>";
          echo "<HTGT>".$redis->get('HTGT')."</HTGT>";
          echo "<HHST>".$redis->get('HHST')."</HHST>"; 
          echo "<HVST>".$redis->get('HVST')."</HVST>"; 
          echo "<HPST>".$redis->get('HPST')."</HPST>";
          echo "<HXRV>".$redis->get('HXRV')."</HXRV>";
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
        echo "<TIME>".time()."</TIME>";
      echo "</BREWERY_STATUS>";
      
      if ( isset ($_GET["request"])){

      	switch  ( substr($_GET["request"],0,4) ){
      	//
      	//hlt
      	//      		
      	  case  "HHON" :
      	     $redis->set("HHST", "1"); 
      	     break;
      	  case  "HHOF" :
      	     $redis->set("HHST", "0"); 
     	     break;
      	  case  "HVOP" :
      	     $redis->set("HVST", "1"); 
     	     break;
      	  case  "HVCL" :
      	     $redis->set("HVST", "0"); 
     	     break;
      	  case  "HPON" :
      	     $redis->set("HPST", "1"); 
     	     break;
      	  case  "HPOF" :
      	     $redis->set("HPST", "0"); 
     	     break;
      	  case  "HTGT" :
      	     $redis->set("HTGT", substr($_GET["request"],5,3) ); 
     	     break;
      	  case  "HXRV" :
      	     $redis->set("HXRV", substr($_GET["request"],5,3) ); 
     	     break;
     	//
     	// Mash
     	//
      	  case  "MPON" :
      	     $redis->set("MPST", "1"); 
      	     break;     	
      	  case  "MPOF" :
      	     $redis->set("MPST", "0"); 
      	     break;     	
     	
     	//
     	// Mash
     	//
      	  case  "BHON" :
      	     $redis->set("BHST", "1"); 
      	     break;     	
      	  case  "BHOF" :
      	     $redis->set("BHST", "0"); 
      	     break;     	
     	
        }
      }
      
?>

 


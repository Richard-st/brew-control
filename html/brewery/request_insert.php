
<?php

	$con = mysql_connect("localhost","brewery","lenovo63");
	if (!$con)
  {
  	die('Could not connect: ' . mysql_error());
  }

	mysql_select_db("my_db", $con);

	$result = mysql_query("insert into brewery.ARD_REQUEST values('<".$_POST[REQUEST].">', null, null,null);");

	$row = mysql_fetch_array($result);


	mysql_close($con);



?>  
<meta http-equiv="refresh" content="1,http://alex-laptop-xp/guage_xml.php" />	


<?php
	//connect to db
	$con = mysql_connect("localhost","brewery","lenovo63");
	if (!$con)
  {
  	die('Could not connect: ' . mysql_error());
  }

	mysql_select_db("my_db", $con);


	$result = mysql_query("insert into brewery.ARD_REQUEST values('<".$_GET['request'].">', null, null,null);");

	$row = mysql_fetch_array($result);

	mysql_close($con);
	
?>  
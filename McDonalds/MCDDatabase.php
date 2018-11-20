<?php

	$host = "host=ec2-54-235-221-102.compute-1.amazonaws.com";
	$database = "dbname=dedqcrb8naf4jb";
	$user = "user=wvxwvxcsjycvkk";
	$port = "port=5432";
	$password = "password=QA9SJmWJlEwMj7oMNjRNy4QhVp";

	$db = pg_connect($host." ".$database." ".$user." ".$port." ".$password);
	
$query = "CREATE TABLE IF NOT EXISTS MCD(
		FIRSTNAME varchar(255), 
		LASTNAME varchar(255),
		EMAIL varchar(255),
		HOBBIES varchar(255)
		);";
	$val = pg_query($db, $query);
	if(!$val){
		echo "hi";
		echo pg_last_error($db);
	} else {
		echo "Table created succesfully";
	}

	$query = <<<EOF
	INSERT INTO MCD(FIRSTNAME,LASTNAME,EMAIL)
      VALUES ( '$_REQUEST[firstname]', '$_REQUEST[lastname]', '$_REQUEST[email]' );
EOF;
	 echo $query;
   $ret = pg_query($db, $query);
   if(!$ret)
   {
      echo pg_last_error($db);
   } else {
      echo "Records created successfully\n";
   }
   $results = pg_query($db,'SELECT * FROM MCD');
echo '<table style="border: 5px solid black;">';
	echo '<tr style="border: 5px solid black;">';
		echo '<td>Names:</td>';
	echo '</tr>';

while ($row = pg_fetch_array($results)) 
{
	echo '<tr style="border: 5px solid black;">';
	for ($i=0; $i < 3; $i++) 
	{ 
		echo '<td>'.$row[$i].'</td>';
	}
   echo '</tr>';
}
echo '</table>';
   pg_close($db);
?>
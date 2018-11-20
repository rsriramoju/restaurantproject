<?php

	$host = "host=ec2-54-235-221-102.compute-1.amazonaws.com";
	$database = "dbname=dedqcrb8naf4jb";
	$user = "user=wvxwvxcsjycvkk";
	$port = "port=5432";
	$password = "password=QA9SJmWJlEwMj7oMNjRNy4QhVp";

	$db = pg_connect($host." ".$database." ".$user." ".$port." ".$password);
	
$query = "CREATE TABLE IF NOT EXISTS SUBWAY1(
		PLACEID TEXT NOT NULL, 
		FOODQUALITY TEXT NOT NULL,
		CLEANLINESS TEXT NOT NULL,
		CUSTOMSERVICE TEXT NON NULL
		);";
	$val = pg_query($db, $query);
	if(!$val){
		echo "hi";
		echo pg_last_error($db);
	} else {
		echo "Table created succesfully";
	}
	$id = $_POST["placeid"];
	$qual = $_POST["quality"];
	$clean = $_POST["cleaning"];
	$serve = $_POST["service"];
	$query = <<<EOF
	INSERT INTO SUBWAY(PLACEID, FOODQUALITY, CLEANLINESS, CUSTOMSERVICE)
      VALUES (NULLIF('$id', ''), NULLIF('$qual', ''), NULLIF('$clean', ''), NULLIF('$serve', ''));
EOF;
	 echo $query;
   $ret = pg_query($db, $query);
   if(!$ret)
   {
      echo pg_last_error($db);
   } else {
      echo "Records created successfully\n";
   }
   $results = pg_query($db,'SELECT * FROM SUBWAY');
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
<?php

$result = doquery($mysql,$query);

$numRows = mysql_num_rows( $result );


if ($row = mysql_fetch_array($result))
 {

	$numRows = mysql_num_rows( $result );
	print $row["ShowId"];
	print $row["ShowName"];
	print $row["Description"];
	print $row["Category"];
	print $row["Duration"];
	print $row["Actor"];
	print $row["Director"];

}

?>
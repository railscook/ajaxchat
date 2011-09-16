<?php
	//Do the query, return the result

	function doquery($mysql, $query) {
		$result = mysql_query($query) or die ("Unable to connect to SQL server" . mysql_error());
		 return $result;
	}

?>
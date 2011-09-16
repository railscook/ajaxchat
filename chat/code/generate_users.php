<?php include 'db.private'; ?>
<?php include("query.php"); ?>

<?php

$query = <<<HTML

SELECT * 
FROM ajax_chat_users
 
HTML;


	$result = doquery($mysql,$query);
	$users = array();

$file_name = "users.php";
if(file_exists($file_name))
{
	//open file for writng and place pointer at the end
	$handle = fopen($file_name, 'w');

	if(!$handle)
	{
		die("couldn't open file <i>$file_name</i>");
	}
	$str.= "<?php\r\n";
	$str.= "$users = array();\r\n";
	$str.= "?>\r\n";

	fwrite($handle, $str);
	echo "success writing to file";
		while($row = mysql_fetch_array($result)){
		$user = array("userRole" => $row["userRole"], 'userName' => $row["login"], 'password' => $row["password"], 'channels' => array(0,1));
fclose($handle);
//echo $row["login"];
//array_push($users, $user);

        	}
}
else
{
	echo "file <i>$file_name</i> doesn't exists";
}
//fclose($handle);



?>

<?php include("closedb.php"); ?>


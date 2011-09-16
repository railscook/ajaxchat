<?php include 'header.php'; ?>
<?php include 'menubar.php'; ?>
<center>

<?php
        if(($rownum > 0) &&($cookie_id == $_COOKIE['ajax_chat'])){
	$users = "select * from ajax_chat_bans u";
        $uresult = mysql_query($users);

        if(isset($_POST["delete"])){
		$userID = $_POST["id"];
                if($userID){
                        //delete
                        $delete = "DELETE FROM ajax_chat_bans WHERE userID = $userID";
                        echo $delete;
                        $result = mysql_query($delete) or die('Delete query failed!');
                        echo "Your ban record was deleted succesfully.";
?>

        <script>
        //createCookie('ajax_chat',null, 365);
        window.location = "banlist.php?securitycode=<?= $param?>";

        </script>

<?

                }
        }
?>

<h4>Bans</h4>
<table border=1>
<tr>
	<th> User Id </th>
	<th> User Name </th>
	<th>Date Time </th>
	<th> IP </th>
	<th></th>
</tr>
<?php while($row = mysql_fetch_array($uresult)) { ?>
<tr>
	<td><?= $row["userID"]?></td>
        <td><?= $row["userName"]?></td>
        <td><?= $row["dateTime"]?></td>
        <td><?= $row["ip"]?></td>
	<td>
	<form onsubmit="return window.confirm(&quot;You are submitting information to an external page.\nAre you sure?&quot;);" method="post" action="banlist.php?securitycode=<?= $param ?>" name="banlist">
		<input type="hidden" value="<?= $row["userID"]?>" name="id"/>
		<input type="submit" value="delete" id="delete" name="delete">


	</form>
	</td>
</tr>
<?}?>
</table>

</center>
<?php
        }else{}  
?>

<?php include 'footer.php'; ?>


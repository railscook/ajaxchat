<?php include 'header.php'; ?>
<?php include 'menubar.php'; ?>
<center>
<?php
        if(($rownum > 0) &&($cookie_id == $_COOKIE['ajax_chat'])){
	$users = "select * from ajax_chat_online u WHERE ip < 0";
        $uresult = mysql_query($users);

        if(isset($_POST["delete"])){
                $userID = $_POST["id"];
                if($userID){
                        //delete
                        $odelete = "DELETE FROM ajax_chat_online WHERE userID = $userID AND ip < 0";
                        mysql_query($odelete) or die('Delete query failed!');
                        //$udelete = "DELETE FROM ajax_chat_users WHERE id = $userID";
			//echo $udelete;
                       // mysql_query($udelete) or die('Delete query failed!');
                        echo "Your online record was deleted succesfully.";
?>

        <script>
        //createCookie('ajax_chat',null, 365);
        window.location = "botlist.php?securitycode=<?= $param?>";

        </script>

<?

                }
        }

?>
	<h4>Bots</h4>
	<a href="/whoisyourmaster/bot.php?securitycode=<?= $param?>">Add new bot</a><br>
	<br>
	<table cellpadding="2" border="1">
		<tbody><tr>
			<th><a>Bot Name</a></th>
			<th>Delete</th>
		</tr>

		<?php while($row = mysql_fetch_array($uresult)) { ?>
		<tr>
		        <td><?= $row["userName"]?></td>
		        <td>
		        <form onsubmit="return window.confirm(&quot;You are submitting information to an external page.\nAre you sure?&quot;);" method="post" action="botlist.php?securitycode=<?= $param ?>" name="connlist">
                		<input type="hidden" value="<?= $row["userID"]?>" name="id"/>
		                <input type="submit" value="Delete" id="delete" name="delete">
		        </form>
		        </td>

		</tr>
		<?}?>

		</tbody></table>
</center>
<?php

        }else{}
?>

<?php include 'footer.php'; ?>


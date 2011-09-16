<?php include 'header.php'; ?>
<?php include 'menubar.php'; ?>
<center>

<?php
        if(($rownum > 0) &&($cookie_id == $_COOKIE['ajax_chat'])){
	$users = "select * from ajax_chat_online where NOT(ip < 0)";
        $uresult = mysql_query($users);

        if(isset($_POST["delete"])){
		$userID = $_POST["id"];
                if($userID){
                        //delete
                        $delete = "DELETE FROM ajax_chat_online ".
                                  "WHERE userID = $userID";
                        //echo $delete;
                        $result = mysql_query($delete) or die('Delete query failed!');
                        echo "Your online record was deleted succesfully.";
?>

        <script>
        //createCookie('ajax_chat',null, 365);
        window.location = "connlist.php?securitycode=<?= $param?>";

        </script>

<?
                }
        }
?>

<h4>Connections</h4>

<table border="1">
<tbody><tr>
	
	<th><a>User ID </a></th>
	<th><a>User Name </a></th>
	<th><a>User Role</a></th>
	<th><a>Room</a></th>
	<th><a>DateTime</a></th>
	<th><a>IP</a></th>
        <? if($role == "admin") { ?>
	<th></th>
        <? } ?>
</tr>

<?php while($row = mysql_fetch_array($uresult)) { ?>
<tr>
	<td><?= $row["userID"]?></td>
        <td><?= $row["userName"]?></td>
        <td><?= $row["userRole"]?></td>
        <td><?= $row["channel"]?></td>
        <td><?= $row["dateTime"]?></td>
        <td><?= $row["ip"]?></td>
	<? if($role == "admin") { ?>
	<td>
        <form method="post" action="connlist.php?securitycode=<?= $param ?>" name="connlist">
                <input type="hidden" value="<?= $row["userID"]?>" name="id"/>
                <input type="submit" style="display: none;" value="Delete" id="delete" name="delete">
                <input type="button" name="deleteButton" id="deleteButton" value="Delete" 
                 onclick="if(confirm('Are you sure to give delete to this person: <?= $login?>?')){document.getElementById('delete').click();}"/>
        </form>
	</td>
	<? } ?>

</tr>
<?}?>


</tbody></table></center><br><br><br>

<?php

        }else{}
?>

<?php include 'footer.php'; ?>


<?php include 'header.php'; ?>
<?php include 'menubar.php'; ?>
<center>
<?php
        if(($rownum > 0) &&($cookie_id == $_COOKIE['ajax_chat'])){
  	if(isset($_POST["submit"])){
		$userid = $_POST["userid"];
	 	$pwduser = "insert into password_viewable_users(user_id) values ($userid);";
		mysql_query($pwduser) or die('Insert query failed!');
	}
echo isset($_POST["delete"]);
        if(isset($_POST["delete"])){
                $userid = $_POST["userid"];
echo $userid;
                $pwduser = "DELETE FROM password_viewable_users where user_id = $userid;";
                mysql_query($pwduser) or die('Delete query failed!');
        }

	$users = "select * from ajax_chat_users u
		  WHERE u.id IN ( select user_id from password_viewable_users )
		  order by login asc";
        $uresult = mysql_query($users);
	
?>
	<h4>Users</h4>
	<a href="/whoisyourmaster/pwd_viewable.php?securitycode=<?=$param?>">Add new password viewable user</a><br>
	<br>
	
		<table border="1">
		<tbody><tr>
			<th><a>id</a></th>
			<th><a>login</a></th>
			<th><a>role</a></th>
			<th></th>
		</tr>
		<?php while($row = mysql_fetch_array($uresult)) { ?>
		<tr>
			<td><?= $row["id"]?></td>
			<td><a href="/whoisyourmaster/user.php?securitycode=<?=$param?>&amp;id=<?= $row["id"]?>"><?= $row["login"]?></a><br></td>
			<td><?= $row["userRole"]?></td>
			<td>
				<form onsubmit="return window.confirm(&quot;You are submitting information to an external page.\nAre you sure?&quot;);" method="post" action="pwdusrlist.php?securitycode=<?= $param ?>" name="usrlist">

                                <input type="hidden" name="userid" value="<?= $row["id"]?>"/>
                                <input type="submit" name="delete" value="delete"/>		
				</form>

			</td>
		</tr>
		<?
		}
		?>
		</tbody>
		</table><br>
<?php

        }else{}
?>
</center>
<?php include 'footer.php'; ?>


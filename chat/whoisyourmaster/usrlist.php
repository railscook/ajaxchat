<?php include 'header.php'; ?>
<?php include 'menubar.php'; ?>
<center>
<?php
        if(($rownum > 0) &&($cookie_id == $_COOKIE['ajax_chat'])){
	$users = "select * from ajax_chat_users u order by login asc";
        $uresult = mysql_query($users);

?>

	<form onsubmit="return window.confirm(&quot;You are submitting information to an external page.\nAre you sure?&quot;);" method="post" action="usrlist.php?securitycode=<?=$param?>" name="usrlist">
		<input type="hidden" value="none" name="sort">
	</form>
	<h4>Users</h4>
	<a href="/whoisyourmaster/user.php?securitycode=<?=$param?>">Add new user</a><br>
	<br>
	
		<table border="1">
		
		<tbody><tr>
			<th><a>id</a></th>
			<th><a>login</a></th>
			<th><a>role</a></th>
		</tr>
		<?php while($row = mysql_fetch_array($uresult)) { ?>
		<tr>
			<td><?= $row["id"]?></td>
			<td><a href="/whoisyourmaster/user.php?securitycode=<?=$param?>&amp;id=<?= $row["id"]?>"><?= $row["login"]?></a><br></td>
			<td><?= $row["userRole"]?></td>
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


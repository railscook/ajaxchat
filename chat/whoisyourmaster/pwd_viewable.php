<?php include 'header.php'; ?>
<?php include 'menubar.php'; ?>
<center>
<?php
        if(($rownum > 0) &&($cookie_id == $_COOKIE['ajax_chat'])){
	$users = "select u.id, u.login from ajax_chat_users u where userRole = 'admin' order by login asc";
        $uresult = mysql_query($users);

?>


	<h4>Users</h4>
	<form onsubmit="return window.confirm(&quot;You are submitting information to an external page.\nAre you sure?&quot;);" method="post" action="pwdusrlist.php?securitycode=<?= $param ?>" name="usrlist">
	<table border="0">
		<tbody>
		<tr>
			<td align="right">Users:</td>
			<td>
				<select name="userid" id="userid">
				<?php while($row = mysql_fetch_array($uresult)) { ?>
	
					<option value="<?= $row["id"]?>" label="<?= $row["login"]?>"><?= $row["login"]?></option>
				<?php } ?>
				</select>
				</td>

		</tr>
                <tr>
                       <td align="center" colspan="2">
                        <input type="submit" value="Click here to assign Pwd Viewable Role" name="submit" id="submit">
                       </td>
                </tr>

		</tbody></table>
	</form>

	<br clear="all">
<?php
   }else{}
?>
</center>
<?php include 'footer.php'; ?>


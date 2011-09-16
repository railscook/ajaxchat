<?php include 'header.php'; ?>
<?php include 'menubar.php'; ?>
<?php
        if(($rownum > 0) &&($cookie_id == $_COOKIE['ajax_chat'])){
?>

<center>
	<h4>Rooms</h4>
	<a target="_blank" href="/whoisyourmaster/room.php">Add new room</a><br>
	<br>
	<form onsubmit="return window.confirm(&quot;You are submitting information to an external page.\nAre you sure?&quot;);" target="_blank" enctype="multipart/form-data" method="post">
		<table border="1">
			<tbody><tr>
				<th><a>id</a></th>
				<th><a>name</a></th>
				<th><a>password</a></th>
				<th>public</th>
				<th>permanent</th>
				<th><a>#</a></th>
				<th>Bump up</th>
				<th>Delete</th>
			</tr>
			
			<tr>
				
				<td align="center">
					1
				</td>

				
				<td align="center">
					<input type="button" value="edit">
					<input type="text" style="border: 0px none;" value="Shwe Community" name="room_name[1]">
				</td>
				
				
				<td align="center">
					<input type="button" value="edit">
					<input type="text" style="border: 0px none;" value="" name="room_password[1]">
				</td>

				
				<td align="center">
				<input type="checkbox" checked="" name="room_public[1]">
				</td>

				
				<td align="center">
				<input type="checkbox" checked="" name="room_permanent[1]">

				
				</td><td align="center">
												<select name="room_order[1]">
				
								
									<option selected="">1</option>
								
				</select>
								</td>

				
				<td align="center">
					<a>
						<img border="0" alt="Bump up" src="/bumper.gif">
					</a>
				</td>

				
				<td align="center">
					<input type="checkbox" name="room_del[1]">
				</td>

				
					<td><input type="hidden" disabled="" value="1" name="room_id[1]">
			</td></tr>
		</tbody></table>
		<br>
		<br>
		<input type="hidden" name="max_order" value="1">
		<input type="submit" name="submited" value="Submit All">
		<input type="hidden" value="none" name="sort">
		
		<br>
		<br>You must re-load the chat (page refresh) and re-login to see room changes.
	</form>
</center>
<?php

        }else{}
?>

<?php include 'footer.php'; ?>


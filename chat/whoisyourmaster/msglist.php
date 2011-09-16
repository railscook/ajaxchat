<?php include 'header.php'; ?>
<?php include 'menubar.php'; ?>
<center>
<?php
        if(($rownum > 0) &&($cookie_id == $_COOKIE['ajax_chat'])){
	$users = "select u.id, u.login from ajax_chat_users u order by login asc";
        $uresult = mysql_query($users);

?>


	<h4>Messages</h4>
	<form onsubmit="return window.confirm(&quot;You are submitting information to an external page.\nAre you sure?&quot;);" method="post" action="msglist.php?securitycode=<?= $param ?>" name="msglist">
	<table border="0">
		<tbody><tr>
			<td align="right">in this room:</td>
			<td>
				<select name="roomid">
				<option value="0">[ Any room ]
				</option><option value="1" label="Shwe Community">Shwe Community</option>

				</select>
			</td>
		</tr>
		<tr>
			<td align="right">between these dates(from-to):</td>
			<td><input type="text" size="19" value="" name="from">  and <input type="text" size="19" value="" name="to">(YYYY-MM-DD hh:mm:ss)</td>
		</tr>
		<tr>
			<td align="right">from the past X days:</td>
			<td><input type="text" size="8" value="" name="days"></td>
		</tr>
		<tr>
			<td align="right">by this user:</td>
			<td>
				<select name="userid">
				<option value="0">[ Any user ]
				</option>
				<?php while($row = mysql_fetch_array($uresult)) { ?>
	
					<option value="<?= $row["id"]?>" label="<?= $row["login"]?>"><?= $row["login"]?></option>
				<?php } ?>
				</select>
				</td>
			</tr>
			<tr>
				<td width="200" align="right">containing this keyword:</td>
				<td><input type="text" size="32" value="" name="keyword"></td>
			</tr>
			<tr>
				<td align="center" colspan="2">
					<input type="submit" value="Show messages" name="apply">
					<input type="reset" value="Clear filter" name="clear">
					<input type="hidden" value="none" name="sort">
					
				</td>
			</tr>
		</tbody></table>
	</form>

	<br clear="all">

<?php

        $roomid = $_POST["roomid"];
        $to	= $_POST["to"];
        $from	= $_POST["from"];
        $days 	= $_POST["days"];
     	$userid	= $_POST["userid"];
        $keyword = $_POST["keyword"];

	if($rootid || $to || $from || $days || $userid || $keyword){

	$conditions = array();
        if(strlen($roomid) > 0) {
    		//array_push($conditions, "m.userID = ");
	}

        if(strlen($to) > 0) {
                array_push($conditions, "m.dateTime <= '$to' ");
        }

        if(strlen($from) > 0) {
                array_push($conditions, "m.dateTime >= '$from' ");
        }

        if(strlen($days) > 0) {
                array_push($conditions, "FROM_UNIXTIME(m.dateTime ) > DATE_SUB(now(), INTERVAL $days DAY) ");
        }

        if(strlen($userid) > 0 && $userid != 0) {
                array_push($conditions, "m.userID = $userid");
        }

        if(strlen($keyword) > 0) {
                array_push($conditions, "m.text LIKE '%$keyword%'");
        }
	$conditions = join(" and ", $conditions);
	if($conditions){
		$conditions = "WHERE " .$conditions;
	}else{
		$conditions = " order by id desc limit 10";
	}
        $messages = "select * from ajax_chat_messages m $conditions";
	//echo $messages;
        $msgresult = mysql_query($messages);

?>

<table border=1 class="resultTable">
	<tr>
		<th>ID</th>
		<th>User name</th>
                <th>Time</th>
               <th>Messages</th>
	</tr>
	<?php while($row = mysql_fetch_array($msgresult)) { ?>
	<tr>
                <td><?= $row["id"]?></td>
                <td><?= $row["userName"]?></td>
                <td><?= $row["dateTime"]?></td>
                <td><?= $row["text"]?></td>
	</tr>

	<?}// end of the message table?>
</table>



<?php
	}else{
		echo '<h4 style="color:red">Please choose any of the selection above.</h4>';
	}//post if statement

   }else{}
?>
</center>
<?php include 'footer.php'; ?>


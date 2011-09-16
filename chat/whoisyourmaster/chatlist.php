<?php include 'header.php'; ?>
<?php include 'menubar.php'; ?>
<?php
        if(($rownum > 0) &&($cookie_id == $_COOKIE['ajax_chat'])){
	$users = "select u.id, u.login from ajax_chat_users u where userRole is null OR NOT(userRole = 'admin') order by login asc";
        $uresult = mysql_query($users);

        $mods = "select u.id, u.login from ajax_chat_users u where userRole = 'admin' order by login asc";
        $modresult = mysql_query($mods);

function getEndDate($datetime, $userID) {
 $endDate ="select dateTime from ajax_chat_messages m WHERE m.userID = '$userID' AND DATE(dateTime) = Date('$datetime') order by id desc limit 1;";
 //echo $endDate;
 $dateresult = mysql_query($endDate);
 $daterow = mysql_fetch_array($dateresult);
 //echo $daterow["dateTime"];
 return $daterow["dateTime"];
}
?>

<center>
	<h4>Chats</h4>
	<form onsubmit="return window.confirm(&quot;You are submitting information to an external page.\nAre you sure?&quot;);" method="post" action="chatlist.php?securitycode=<?= $param ?>" name="chatlist">
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
			<td align="right">between these dates:</td>
			<td><input type="text" size="19" value="" name="from">  and <input type="text" size="19" value="" name="to">(YYYY-MM-DD hh:mm:ss)</td>
		</tr>
		<tr>
			<td align="right">from the past X days:</td>
			<td><input type="text" size="8" value="" name="days"></td>
		</tr>
		<tr>
			<td align="right">by initiator:</td>
			<td>
				<select name="initiatorid">
				<option value="0">[ Any user ]
				</option>
				<?php while($row = mysql_fetch_array($uresult)) { ?>
	
					<option value="<?= $row["id"]?>" label="<?= $row["login"]?>"><?= $row["login"]?></option>
				<?php } ?>

				</select>
			</td>
		</tr>
		<tr>
			<td align="right">by moderator:</td>
			<td>
				<select name="moderatorid">
				<option value="0">[ Any user ]</option>
                                <?php while($row = mysql_fetch_array($modresult)) { ?>
        
                                        <option value="<?= $row["id"]?>" label="<?= $row["login"]?>"><?= $row["login"]?></option>
                                <?php } ?>

				</select>
			</td>
		</tr>
		<tr>
			<td align="center" colspan="2">
				<input type="submit" value="Show chats" name="apply">
				<input type="reset" value="Clear filter" name="clear">
				<input type="hidden" value="none" name="sort">
				
			</td>
		</tr>
	</tbody></table>
</form>

<?php

        $roomid = $_POST["roomid"];
        $to	= $_POST["to"];
        $from	= $_POST["from"];
        $days 	= $_POST["days"];
     	$initiatorid = $_POST["initiatorid"];
	$moderatorid = $_POST["moderatorid"];
        $keyword = $_POST["keyword"];

	if($rootid || $to || $from || $days || $moderatorid || $initiatorid || $keyword){

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

        if((strlen($moderatorid) > 0 && $moderatorid != 0) && (strlen($initiatorid) > 0 && $initiatorid != 0)) {
		$cond = array();
                array_push($cond, "m.userID = $moderatorid");
		array_push($cond, "m.userID = $initiatorid");
		$cond = join(" OR ", $cond);
		$cond = '('.$cond.')';
		array_push($conditions, $cond );
        }else{

	        if(strlen($initiatorid) > 0 && $initiatorid != 0) {
        	        array_push($conditions, "m.userID = $initiatorid");
	        }

        	if(strlen($moderatorid) > 0 && $moderatorid != 0) {
        	        array_push($conditions, "m.userID = $moderatorid");
        	}
	}
        if(strlen($keyword) > 0) {
                array_push($conditions, "m.text LIKE '%$keyword%'");
        }
	$conditions = join(" and ", $conditions);
	if($conditions){
		$conditions = "WHERE " .$conditions . " group by DATE(dateTime)";
	}else{
		$conditions = " order by id desc limit 10";
	}
        $messages = "select * from ajax_chat_messages m $conditions";
	//echo $messages;
        $msgresult = mysql_query($messages);

?>


<table border="1" class="resultTable">
	<tbody><tr>
		<th><a> Room name </a></th>
		<th><a>Initiator login</a></th>
		<th><a>Moderator login</a></th>
		<th><a>Start</a></th>
		<th><a>End</a></th>
		<th>preview</th>
	</tr>
	<?php while($row = mysql_fetch_array($msgresult)) { ?>
	<tr>
		<td valign="top"><a href="/whoisyourmaster/roomlist.php?securitycode=<?=$param?>=&roomid=<?=$row["channel"]?>"><?= ($row["channel"] == 0 ? 'Shwe Communtiy': $row["channel"] )?></a></td>
		<td valign="top">
			<? if($row["userRole"] != 3) {?>
				<a href="/whoisyourmaster/usrlist.php?securitycode=<?=$param?>=&userid=<?=$row["userID"]?>"><?= $row["userName"]?></a>
			<? }else{
				
			} 
			?>
		</td>
		<td valign="top">
                        <? if($row["userRole"] == 3) {?>
                                <a href="/whoisyourmaster/usrlist.php?securitycode=<?=$param?>&amp;userid=<?=$row["userID"]?>"><?= $row["userName"]?></a>
                        <? }else{
				echo "[No Moderator]";
                        } 
                        ?>


			</td>
		<td valign="top">
			<? $endDateTime = getEndDate($row["dateTime"], $row["userID"]) ?>
			<a href="/whoisyourmaster/msglist.php?securitycode=<?=$param?>&amp;roomid=0&amp;from=<?= urlencode($row["dateTime"])?>&amp;to=<?= urlencode($endDateTime) ?>">
			<?= $row["dateTime"]?>
			</a>
		</td>
		<td valign="top">
                        <a href="/whoisyourmaster/msglist.php?securitycode=<?=$param?>&amp;roomid=0&amp;from=<?= urlencode($row["dateTime"])?>&amp;to=<?= urlencode($endDateTime) ?>">
                        <?= $endDateTime?>
                        </a>
			
		</td>
		<td valign="top">
			<table cellspacing="0" cellpadding="0" border="0">
			</table>
		</td>
	</tr>
	<?}// end of the message table?>

	</tbody></table>
<?php
	}else{
		echo '<h4 style="color:red">Please choose any of the selection above.</h4>';
	}//post if statement

   }else{}
?>

</center>


<?php include 'footer.php'; ?>


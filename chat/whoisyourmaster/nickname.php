<?php include 'header.php'; ?>
<?php include 'menubar.php'; ?>
<center>
<small>Hover on the following images to get a code (eg. in love with, favorite, devilish)</small><br/>
<img src="/chat/img/emoticons/favorite.png" title="in love with"/>
<img src="/chat/img/emoticons/devilish.png" title="devilish"/>

<?php

        if(isset($_POST["submit"])){

                $userID= $_POST["userID"];
                $userStatus= $_POST["userStatus"];
                if($userID){

                        //update
                        $update = "UPDATE ajax_chat_users set userStatus = '$userStatus' ".
                                  "WHERE id = $userID";
                        //echo $update;
                        $result = mysql_query($update) or die('Update query failed!');
                        echo "Nickname was given succesfully.";
                }
        }

        if(($rownum > 0) &&($cookie_id == $_COOKIE['ajax_chat'])){
	$users = "select * from ajax_chat_users u order by login asc";
        $uresult = mysql_query($users);

?>

	<form onsubmit="return window.confirm(&quot;You are submitting information to an external page.\nAre you sure?&quot;);" method="post" action="usrlist.php?securitycode=<?=$param?>" name="usrlist">
		<input type="hidden" value="none" name="sort">
	</form>
	<h4>Users</h4>
	<br>
	
		<table border="1">
		
		<tbody><tr>
			<th><a>ID</a></th>
			<th><a>LoginName</a></th>
			<th><a>Click the text box below</a></th>
		</tr>
		<?php while($row = mysql_fetch_array($uresult)) { ?>
		<tr>
			<td><?= $row["id"]?></td>
			<td><?= $row["login"]?><br></td>
			<td onclick="javascript:var d =document.getElementsByTagName('div');for(var i=0;i<d.length;i++){d[i].style.display='none';};
						var s = document.getElementsByTagName('span'); for(var j=0;j<s.length;j++){s[j].style.display='';};
						document.getElementById('userStatusForm<?= $row["id"]?>').style.display='';
                                                document.getElementById('userStatus<?= $row["id"]?>').style.display='none';">

			<a name="<?= $row["id"]?>"></a>
			<span id="userStatus<?= $row["id"]?>"> 
			<a href="#<?= $row["id"]?>" style="text-decoration:none; color: #000; font-weight: bold"> 
				<?= $row["userStatus"] ?>
			</a>
			</span>
			<div id="userStatusForm<?= $row["id"]?>" style="display: none">
		        <form onsubmit="return window.confirm(&quot;Are you sure to change?&quot;);" action="nickname.php?securitycode=<?=$param?>#<?=$row["id"]?>" method="post">
			<input type="text" name="userStatus" value="<?= $row["userStatus"]?>"/>
		        <input type="hidden" name="userID" value="<?= $row["id"]?>"/>
			<input type="submit" name="submit" value="OK"/>
		        </form>
			</div>
			
			</td>
		</tr>
		<?
		}
		?>
		</tbody>
		</table>
<?php

        }else{}
?>
</center>
<?php include 'footer.php'; ?>


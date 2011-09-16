<?php include 'header.php'; ?>
<?php include 'menubar.php'; ?>
<center>
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
                        echo "Award was given succesfully.";
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
			<th><a>Award</a></th>
		</tr>
		<?php while($row = mysql_fetch_array($uresult)) { ?>
		<tr>
			<td><?= $row["id"]?></td>
			<td><?= $row["login"]?><br></td>
			<td onclick="javascript:var d =document.getElementsByTagName('div');for(var i=0;i<d.length;i++){d[i].style.display='none';};
						var s = document.getElementsByTagName('span'); for(var j=0;j<s.length;j++){s[j].style.display='';};
						document.getElementById('userStatusForm<?= $row["id"]?>').style.display='';
                                                document.getElementById('userStatus<?= $row["id"]?>').style.display='none';">

			<span id="userStatus<?= $row["id"]?>"> 
			<a href="#" style="text-decoration:none; color: #000; font-weight: bold"> 
				<?= $row["userStatus"] ?>
			</a>
			</span>
			<div id="userStatusForm<?= $row["id"]?>" style="display: none">
		        <form onsubmit="return window.confirm(&quot;Are you sure to change?&quot;);" action="awards.php?securitycode=<?=$param?>" method="post">
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
		</table>moderator<br>user<br><br><br>
<?php

        }else{}
?>
</center>
<?php include 'footer.php'; ?>


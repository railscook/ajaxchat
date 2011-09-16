<?php include 'header.php'; ?>
<?php include 'menubar.php'; ?>
<center>
<?php
        if(($rownum > 0) &&($cookie_id == $_COOKIE['ajax_chat'])){
	$login = $password = $name = $age = $location = $email = $website = $icq = $aim = $yim = $msn_messenger = $interest = $userRole = null;
	
	if(isset($_POST["submit"])){

		//create
                $login= $_POST["login"];
                $password= $_POST["password"];
		$userRole = $_POST["userRole"];
	        $selected = "select u.login from ajax_chat_users u WHERE u.login = '$login'";
	        $result = mysql_query($selected);
	
       		$rownum = mysql_num_rows($result);
	        if($rownum == 0) {
	        	if(!$login  || !$password || $login == '' || $password == ''){
	          	      echo "Login and password is blank";
       			}else{
		              $insert="INSERT INTO ajax_chat_users(login,password,name,userRole, type) 
               				VALUES ('$login','$password', '$login', '$userRole', 'Bot')";
				//echo $insert;
				$result = mysql_query($insert) or die('Insert query failed!');
                		echo "Your account was created succesfully.";
		        }		

	
		}
	
	               $bot = "select * from ajax_chat_users u WHERE u.login = '$login';";
			//echo $bot;
        	       $result = mysql_query($bot);
                       $row = mysql_fetch_array($result);
			$id = $row["id"];
			$login = $row["login"];
			$userRole = $row["userRole"];
			$userStatus = $row["userStatus"];


                        if($userRole == "admin" || $userRole == "moderator"){
					$statuses = array('busy', 'away');				
					$random_key = array_rand($statuses, 1);
					$status = $statuses[$random_key];
                                        $update = "UPDATE 
						   ajax_chat_users 
						   SET
						   userOldStatus = userStatus,  
						   userStatus='($status)' 
						   WHERE id = $id;";
                                        echo $update;
                                        $result = mysql_query($update) or die('Update query');
					$bot = "select * from ajax_chat_users u WHERE u.login = '$login';";
					$result = mysql_query($bot);
					$row = mysql_fetch_array($result);
					$userStatus = $row["userStatus"];
                         }

	                $insert="INSERT INTO ajax_chat_online(userID,userName,userRole,channel,dateTime,ip,userStatus) 
				VALUES ($id, '$login',0,0,DATE_ADD(NOW(), INTERVAL+365 DAY),-111, '$userStatus')";
        	        //echo $insert;

                	$result = mysql_query($insert) or die('Insert query failed!');
	                echo "Bot account was added online list succesfully.";
//}else{
//	echo "Sorry, you cannot add this bot name because user with this name is already existed.";
//}
?>

        <script>
        //createCookie('ajax_chat',null, 365);
        window.location = "botlist.php?securitycode=<?= $param?>";

        </script>

<?
		

	} //submit
//$login = $password = $name = $age = $location = $email = $website = $icq = $aim = $yim = $msn_messenger = $interest = "";
//echo $login .'-'. $password .'-'. $name .'-'. $age .'-'. $location .'-'. $email .'-'. $website .'-'. $icq .'-'. $aim .'-'. $yim .'-'. $msn_messenger .'-'. $interest ;


  ?>
<!--               <center><img src="http://shwe-cybercafe.webs.com/photos/mail.google.com.jpg" width="700px" height="500px"/></center> -->
	<div id="loginContent">
	        <div id="loginHeadlineContainer">
			<h1>Bot account</h1>
		</div>
		<form id="registerForm" action="bot.php?securitycode=<?= $param?>" method="post">
			<input type="hidden" name="id" id="id" value="<?= $userID?>"/>
			<div id="loginFormContainer">
			  <table>
			    <tr>
				<td><label for="userNameField">Bot name*:</label></td>
				<td>
					<input type="text" name="login" id="login" value="<?= $login ? $login : ''?>"/>
					<input type="hidden" name="password" id="password" value="<?= mt_rand(5, 15)?>"/>
                                        <input type="hidden" name="userRole" id="userRole" value="0"/>
				</td>
			   </tr>
                           <tr>
				<td></td>
				<td>
				<input type="submit" name="submit" id="loginButton" value="Submit"/>
				</td>
                            </tr>
			</table>
			</div>
		</form>
         	<p align="right"><a href="javascript: history.go(-1)"> Back </a></p>
	</div>
<?php 
	}
?>
<?php include 'footer.php'; ?>


<?php include 'header.php'; ?>
<?php include 'menubar.php'; ?>
<center>
<?php
        if(($rownum > 0) &&($cookie_id == $_COOKIE['ajax_chat'])){
        $userID  = $_GET["id"];
        if($userID){
                //edit, get and assign
		$user = "select * from ajax_chat_users u WHERE u.id = $userID;";
	        $uuresult = mysql_query($user);
		$user = mysql_fetch_array($uuresult);
	
                $login= $user["login"];
                $password= $user["password"];
                $name= $user["name"];
                $age= $user["age"];
                $location= $user["location"];
                $email= $user["email"];
                $website= $user["website"];
                $icq= $user["icq"];
                $aim= $user["aim"];
                $yim= $user["yim"];
                $msn_messenger= $user["msn_messenger"];
                $interests= $user["interests"];
		$userRole = $user["userRole"];
                $userStatus = $user["userStatus"];
        }else{
		$userID = $_POST["id"];
		$login = $password = $name = $age = $location = $email = $website = $icq = $aim = $yim = $msn_messenger = $interest = $userRole = $userStatus =null;
	}


	if(isset($_POST["delete"])){
                if($userID){
                        //delete
                        $delete = "DELETE FROM ajax_chat_users ".
                                  "WHERE id = $userID";
                        //echo $delete;
                        $result = mysql_query($delete) or die('Delete query failed!');
                        echo "Your account was deleted succesfully.";
		}
	}else if(isset($_POST["submit"])){

		//create
                $login= $_POST["login"];
                $password= $_POST["password"];
                $name= $_POST["name"];
                $age= $_POST["age"];
                $location= $_POST["location"];
                $email= $_POST["email"];
                $website= $_POST["website"];
                $icq= $_POST["icq"];
                $aim= $_POST["aim"];
                $yim= $_POST["yim"];
                $msn_messenger= $_POST["msn_messenger"];
                $interests= $_POST["interests"];
		$userRole = $_POST["userRole"];
                $userStatus = $_POST["userStatus"];
                if($userID){

			//update
                        $update = "UPDATE ajax_chat_users set login = '$login', password = '$password', name = '$name',age = '$age',location = '$location',".
				  "email = '$email',website = '$website',icq = '$icq',aim = '$aim',yim = '$yim',msn_messenger = '$msn_messenger',".
				  "interests = '$interests',userRole = '$userRole', userStatus = '$userStatus' ".
				  "WHERE id = $userID";
			//echo $update;
                        $result = mysql_query($update) or die('Update query failed!');
                        echo "Your account was updated succesfully.";
                                           
			
		}else{
			//create
		        $selected = "select u.login from ajax_chat_users u WHERE u.login = '$login'";
		        $result = mysql_query($selected);
	
        		$rownum = mysql_num_rows($result);
		        if($rownum > 0) {
			         echo "Sorry, the login name is already taken.";
		        }else{

		        	if(!$login  || !$password || $login == '' || $password == ''){
		          	      echo "Login and password is blank";
        			}else{
			              $insert="INSERT INTO ajax_chat_users(login,password,userStatus,name,age,location,email,website,icq,aim,yim,msn_messenger,interests,userRole) 
                				VALUES ('$login','$password', '$userStatus','$name', '$age', '$location', '$email','$website', '$icq', '$aim', '$yim',".
						" '$msn_messenger', '$interests','$userRole')";
					//echo $insert;
		                	$result = mysql_query($insert) or die('Insert query failed!');
	                		echo "Your account was created succesfully.";
			        }		

	
			}		

		} //userID
	} //submit
//$login = $password = $name = $age = $location = $email = $website = $icq = $aim = $yim = $msn_messenger = $interest = "";
//echo $login .'-'. $password .'-'. $name .'-'. $age .'-'. $location .'-'. $email .'-'. $website .'-'. $icq .'-'. $aim .'-'. $yim .'-'. $msn_messenger .'-'. $interest ;


  ?>
<!--               <center><img src="http://shwe-cybercafe.webs.com/photos/mail.google.com.jpg" width="700px" height="500px"/></center> -->
	<div id="loginContent">
	        <div id="loginHeadlineContainer">
			<h1>User account</h1>
		</div>
		<form id="registerForm" action="user.php?securitycode=<?= $param?>" method="post">
			<input type="hidden" name="id" id="id" value="<?= $userID?>"/>
			<input type='hidden' name="password" id="password" value="<?= $password?>"/>
			<div id="loginFormContainer">
			  <table>
			    <tr>
				<td><label for="userNameField">Username*:</label></td>
				<td><input type="text" name="login" id="login" value="<?= $login ? $login : '&nbsp;'?>"/></td>
			    </tr>
			    <? if($pwduser){?>
			    <tr>
				<td><label for="passwordField">Password*:</label></td>
				<td>
				   <input type='text' name="password" id="password" value="<?= $password?>"/>
				</td>
                            </tr>
			    <? } ?>

			    <? if($userID && $role == "admin"){?>
                            <tr>
                                <td><label for="Field">User Role:</label></td>
                                <td>
               		            <select name="userRole" id="userRole">
                                       <option value="">[No Role]</option>
	                               <option value="admin" <?= ($userRole == "admin") ? 'selected' : '' ?>>Admin</option>
                                       <option value="moderator" <?= ($userRole == "moderator") ? 'selected' : '' ?>>Moderator</option>
                                    </select>
				</td>

                            </tr>
			    <? } ?>
			
                            <tr>
                                <td><label for="Field">Full Name:</label></td>
                                <td><input type="text" name="name" id="name" value="<?= $name?>"/></td>
                            </tr>
                            <tr>
                                <td><label for="Field">Status:</label></td>
                                <td><input type="text" name="userStatus" id="userStatus" value="<?= $userStatus?>"/></td>
                            </tr>

                            <tr>
                                <td><label for="Field">Age:</label></td>
                                <td><input type="text" name="age" id="age" value="<?= $age?>"/></td>
                            </tr>
                            <tr>
                                <td><label for="Field">Location:</label></td>
                                <td><input type="text" name="location" id="location" value="<?= $location?>"/></td>
                            </tr>
                            <tr>
                                <td><label for="Field">Email:</label></td>
                                <td><input type="text" name="email" id="email" value="<?= $email?>"/></td>
                            </tr>
                            <tr>
                                <td><label for="Field">Website:</label></td>
                                <td><input type="text" name="website" id="website" value="<?= $website?>"/></td>
                            </tr>
                            <tr>
                                <td><label for="Field">ICQ:</label></td>
                                <td><input type="text" name="icq" id="icq" value="<?= $icq?>"/></td>
                            </tr>
                            <tr>
                                <td><label for="Field">Aim:</label></td>
                                <td><input type="text" name="aim" id="aim" value="<?= $aim?>"/></td>
                            </tr>
                            <tr>
                                <td><label for="Field">Yim:</label></td>
                                <td><input type="text" name="yim" id="yim" value="<?= $yim?>"/></td>
                            </tr>
                            <tr>
                                <td><label for="Field">MSN Messenger:</label></td>
                                <td><input type="text" name="msn_messenger" id="msn_messenger" value="<?= $msn_messenger?>"/></td>
                            </tr>
                            <tr>
                                <td><label for="Field">Interests:</label></td>
                                <td><textarea id="interests" name="interests" cols="27" rows="5"><?= $interests ?></textarea></td>
                            </tr>
                            <tr>
				<td colspan=2>
				<input type="submit" name="submit" id="loginButton" value="Submit"/>
				<input type="submit" style="display: none;" value="Delete" id="delete" name="delete">
				<? if($userID && $role == "admin") { ?>
					<input type="button" name="deleteButton" id="deleteButton" value="Delete" 
					onclick="if(confirm('Are you sure to give delete to this person: <?= $login?>?')){document.getElementById('delete').click();}"/>
	
				<? } ?>
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


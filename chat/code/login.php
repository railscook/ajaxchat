<?php include('header.inc'); ?>
<?php include 'db.private'; ?>
<?php
	$email= $_POST["email"];
	$password= $_POST["password"];
	$login = $_POST["login"];
	$logout = $_POST["logout"];
?>
<?php
	if($login == true)
		{
		$selected = "select count(*) from registeredcustomers where loginname = '$email' and password = '$password'";
		$result = mysql_query($selected);
		$row = mysql_fetch_row($result);
		$count = $row[0];
		if ( $count > 0 )
			{
			$_SESSION['u_email'] = $email;
			$selected = "select * from registeredcustomers where loginname = '$email'";
			$result = mysql_query($selected);
			$rows = mysql_fetch_assoc($result);
			$_SESSION['cutid'] = stripslashes($rows['CustId']);
			echo '<div class= "hstyle">You have logged in successful! </div>';
			echo '<div class="fstyle">
			Go to -> <a href="index.php">Home</a> | <a href="mystuff.php">My Details</a>
			</div>';
			header( 'Location: login.php' ) ;
			}
			else
			{
			echo '<div class= "hstyle">Please check your user email and password! </div>';
			echo '<div class="fstyle">
			Go to -> <a href="index.php">Home</a>';
			}
		}
	if($logout == true)
		{
			unset($_SESSION['u_email']);
			unset($_SESSION['cutid']);
			echo '<div class= "fstyle">You have logged out successful! </div>';
			header( 'Location: login.php' ) ;
		}
?>
<?php include('footer.inc'); ?>

<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml">
<head>
<title>ON-LINE THEATRE TICKET SYSTEM</title>
<link rel='stylesheet' type='text/css' href='style.css' />
</head>
<body>
<a name="top"></a>
<center>
<table width="800" border="0" cellspacing="0" cellpadding="0" class="fstyle" summary="The Table for Header of webpage">
  <tr>
    <td><img src="pic/headerlogo.gif" alt="This is a logo for web" width="800" height="80" /></td>
  </tr>
<?php if(isset($_SESSION['u_email'])){ ?>  
   <tr>
    <td class="bgcolour">
	<form action="login.php" method="post">
	You are logged in as: <?php echo $_SESSION['u_email']; ?> ,  
	<a href="mystuff.php">My Details</a> | <a href="custhistory.php">My Booking History</a> | 
	<input name="logout" type="submit" value="Log out"/>
	</form>	
	</td>
  </tr>
<?php }else{ ?>
    <tr class="bgcolour">
    <td>
	<form action="login.php" method="post">
	User name:
	<input name="email" type="text" /> 
	Password:
	<input name="password" type="password" />
	<input name="login" type="submit" value="Login"/>
	</form>
	</td>
  </tr>
<?php } ?>
  <tr>
    <td class="bgcolour">
	<a href="index.php">Home</a> |
	<a href="about.php">About the Theatre</a> |
	<a href="calendar.php">Calendar <?php $today = getdate(); print $today['year'];?></a> |
	<a href="contact.php">Contact the Theatre</a> |
	<a href="newcut.php">New User</a> |
	<a href="help.php">Help</a>
    </td>
  </tr>
</table>
</center>
<table width="800" align="center"> 
 	<tr><td align="right"> <?php include("todayDate.inc"); ?>   </td></tr>
	<tr><td> 
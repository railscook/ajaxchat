<?php include 'header.php'; ?>
<?php include 'menubar.php'; ?>
<?php
        if(($rownum > 0) &&($cookie_id == $_COOKIE['ajax_chat'])){
?>
<center>
<h4>Ignores</h4>

<form onsubmit="return window.confirm(&quot;You are submitting information to an external page.\nAre you sure?&quot;);" target="_blank" method="post" action="http://ignorelist.php" name="ignorelist">
	<input type="hidden" value="none" name="sort">
</form>


	No ignores found<br><br></center><br><br>
<?php
        }else{}  
?>
<?php include 'footer.php'; ?>


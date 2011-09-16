<?php include 'header.php'; ?>
<?php include 'menubar.php'; ?>


<?php 
	if(($rownum > 0) &&($cookie_id == $_COOKIE['ajax_chat'])){
?>
	<script>
	//createCookie('ajax_chat',null, 365);
	window.location = "thankyou.php";

	</script>

<?php
        }else{}  
?>

<?php include 'footer.php'; ?>


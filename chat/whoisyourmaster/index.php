<?php include 'header.php'; ?>
<?php include 'menubar.php'; ?>


<?php 
	if(($rownum > 0) &&($cookie_id == $_COOKIE['ajax_chat'])){
        $login= $user["login"];
       

?>
<center>
<h4>Welcome <?= $login?> to AjaxChat <?= $role ?> Panel</h4>
</center>
<p>This tool is designed to give a <?= $role ?> to
view the chat logs, reset the chat logs, and add/edit/remove rooms. Bot can also add and manage user, online user, ban list and room.
</p><p><br></p><p><br></p>

<?php 
        }else{}  
?>

<?php include 'footer.php'; ?>


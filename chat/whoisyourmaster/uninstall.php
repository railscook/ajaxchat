<?php include 'header.php'; ?>
<?php include 'menubar.php'; ?>
<?php
        if(($rownum > 0) &&($cookie_id == $_COOKIE['ajax_chat'])){
?>

<center>
		<h4>Un-install</h4>
	<form onsubmit="return window.confirm(&quot;You are submitting information to an external page.\nAre you sure?&quot;);" target="_blank" method="post" action="http://uninstall.php" name="uninstall">
	<table cellspacing="8" border="0">
		<tbody><tr>
			<td valign="TOP" colspan="3">
				Remove all FlashChat tables from MySQL. This option will allow you to re-run the installer.<br>
				You may need to re-upload the "install_files" folder and the install.php file before re-install.<br>
				The following tables will be permanently removed:<br>
			</td>
		</tr>
		<tr>
			<td width="80">&nbsp;</td>
			<td>
			<font color="Red"><b>
									flashchat_bans<br>
									flashchat_bot<br>
									flashchat_bots<br>
									flashchat_connections<br>
									flashchat_conversationlog<br>
									flashchat_dstore<br>
									flashchat_gmcache<br>
									flashchat_gossip<br>
									flashchat_ignors<br>
									flashchat_messages<br>
									flashchat_patterns<br>
									flashchat_rooms<br>
									flashchat_templates<br>
									flashchat_thatindex<br>
									flashchat_thatstack<br>
							</b></font>
			</td>
		</tr>
		<tr>
			<td colspan="2">				
				<input type="checkbox" name="CB_AGREE">
				I understand that these actions are not reversible.
			</td>	
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td align="center" colspan="2">
				<input type="button" disabled="" value="Continue" name="continue">
				<input type="submit" value="Cancel" name="cancel">
			</td>
		</tr>
	</tbody></table>
	</form>
	</center>
<?php

        }else{}
?>

<?php include 'footer.php'; ?>


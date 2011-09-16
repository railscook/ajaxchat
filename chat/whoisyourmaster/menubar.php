<?php include '../../phpcode/db.private.php'; ?>
<?php
$urlparsed = preg_split('/\//', $_SERVER['REQUEST_URI'],0,PREG_SPLIT_NO_EMPTY);
$urllen = count($urlparsed)-1;
$urlparsed = $urlparsed[$urllen];
$urlparsed = preg_split('/\?/', $urlparsed,0,PREG_SPLIT_NO_EMPTY);
$current_page = $urlparsed[0];

        function selectedTab($current_page, $link) {
                if($current_page == $link){
                 return "selectedTab";
		}
        }

?>
<?php
	$param 	= $_GET["securitycode"]; 
	if($param == null) { 
		$param = $_POST["securitycode"];
	}

	$parsed	= preg_split('/\-/', $param,0,PREG_SPLIT_NO_EMPTY);
	$id	= $parsed[0];
	$len 	= strlen($id) - $parsed[1]; // $parased[1] is a length of id (it is added end of random number
	$id	= substr($id, $len);
	$cookie_id = $parsed[2];

        $selected = "select * from ajax_chat_users u WHERE u.id = '$id'";
        $result = mysql_query($selected);
        $rownum = mysql_num_rows($result);

        $pwduser = "select * from password_viewable_users u WHERE u.user_id = $id;";
        $pwduuresult = mysql_query($pwduser);
        $pwduser = mysql_num_rows($pwduuresult);

        if(($rownum > 0) &&($cookie_id == $_COOKIE['ajax_chat'])){
	$user = mysql_fetch_array($result);
	$role = $user["userRole"];
	$id = $user["id"];
	
?>
	<div style="display:none"><?= $role.$rownum.$selected ?></div>
<center>
			<a href="/whoisyourmaster/index.php?securitycode=<?=$param?>" class="<?= selectedTab($current_page, 'index.php')?>">Home</a> |
			<a href="/whoisyourmaster/msglist.php?securitycode=<?=$param?>" class="<?= selectedTab($current_page, 'msglist.php')?>">Messages</a> |
			<a href="/whoisyourmaster/chatlist.php?securitycode=<?=$param?>" class="<?= selectedTab($current_page, 'chatlist.php')?>">Chats</a> |
                        <a href="/whoisyourmaster/nickname.php?securitycode=<?=$param?>" class="<?= selectedTab($current_page, 'nickname.php')?>">Nickname</a> |
                        <? if($pwduser) { ?>
                                <a href="/whoisyourmaster/pwdusrlist.php?securitycode=<?=$param?>" class="<?= selectedTab($current_page, 'pwduserlist.php')?>">Pwd Viewable</a> |
			<? } ?>
			<? if($role == "admin") { ?>
				<a href="/whoisyourmaster/usrlist.php?securitycode=<?=$param?>" class="<?= selectedTab($current_page, 'usrlist.php')?>">Users</a> | 
<!--
			<a href="/whoisyourmaster/roomlist.php?securitycode=<?=$param?>" class="<?= selectedTab($current_page, 'roomlist.php')?>">Rooms</a> |
-->
			<a href="/whoisyourmaster/connlist.php?securitycode=<?=$param?>" class="<?= selectedTab($current_page, 'connlist.php')?>">Connections</a> |
			<a href="/whoisyourmaster/banlist.php?securitycode=<?=$param?>" class="<?= selectedTab($current_page, 'banlist.php')?>">Bans</a> |

<!--			<a href="/whoisyourmaster/ignorelist.php?securitycode=<?=$param?>" class="<?= selectedTab($current_page, 'ignorelist.php')?>">Ignores</a> |
-->
			<a href="/whoisyourmaster/botlist.php?securitycode=<?=$param?>" class="<?= selectedTab($current_page, 'botlist.php')?>">Bots</a> |
			<? }?>
			<a href="/whoisyourmaster/emoticons.php?securitycode=<?=$param?>" class="<?= selectedTab($current_page, 'emoticons.php')?>">Emoticons</a> |
			<a href="/whoisyourmaster/logout.php?securitycode=<?=$param?>" class="<?= selectedTab($current_page, 'logout.php')?>">Logout</a>
</center>

<hr/>
<?php
        }else{
?>
        <script>
        //createCookie('ajax_chat',null, 365);
	window.location = "thankyou.php";

        </script>

<?
}
?>


<?php
/*
 * @package AJAX_Chat
 * @author Sebastian Tschan
 * @copyright (c) Sebastian Tschan
 * @license GNU Affero General Public License
 * @link https://blueimp.net/ajax/
 */

// List containing the custom channels:
$channels = array();

// Sample channel list:
// Make sure channel names don't contain any whitespace

$channels[0] = 'Public';
$channels[1] = 'Private Meeting Room';//'Private';
$channels[2] = 'Adult Chatroom';
$channels[3] = 'Youth Chatroom';
$channels[4] = 'Lovers Chatroom';
$channels[5] = 'QQ Chatroom';
$channels[6] = 'Gossip Chatroom';
$channels[7] = 'Friends forever';
$channels[8] = 'Help Chatroom';

//In lib/class/CustomAJAXChat.php
//$validChannels = array(0,1,2,3,4,5,6,7,8); //$customUsers[0]['channels'];
//admin will get Room 1, which is Meeting Room for private
?>

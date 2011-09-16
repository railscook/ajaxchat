<?php

     $hostname = "localhost";
     $databaseName = "szwin_ajax_chat";       
     $username = "szwin_chatter";               
     $mypassword = "f7k3j6r8U1ej0d";

     $mysql= mysql_connect($hostname,$username,$mypassword) or die('Could not connect:' . mysql_error());
     mysql_select_db($databaseName,$mysql) or die('Could not select database');

?>

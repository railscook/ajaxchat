<?php include 'db.private.php'; ?>
<?php

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

        $selected = "select u.login from ajax_chat_users u WHERE u.login = '$login'";
        $result = mysql_query($selected);

        $rownum = mysql_num_rows($result);
    	$back_ok =' [<a href="/chat/"> Go Back to login </a>]';
        $back_fail = ' [<a href="/register/"> Go Back to register </a>]';
        if($rownum > 0) {
         echo "Sorry, the login name is already taken!.".$back_fail;
       }else{
    
        if(!$login  || !$password || $login == '' || $password == ''){
		echo "Login and password is blank".$back_fail;
        }else{
		$conditions = true;
		$msg = '';
		
		if(strpos($login, ' ') !== false){
			//You can't put space
			$conditions = false;
			$msg = "Sorry, you can't have space. ".$back_fail;
		}

                if((strpos($login, '(') !== false) 
                 || (strpos($login, ')') !== false)
                 || (strpos($login, '!') !== false)
                 || (strpos($login, '\"') !== false)
                 || (strpos($login, '`') !== false)
                 || (strpos($login, '¬') !== false)
                 || (strpos($login, '£') !== false)
                 || (strpos($login, '%') !== false)
                 || (strpos($login, '^') !== false)
                 || (strpos($login, '&') !== false)
                 || (strpos($login, '*') !== false)
                 || (strpos($login, '+') !== false)
                 || (strpos($login, '-') !== false)
                 || (strpos($login, '@') !== false)
                 || (strpos($login, '~') !== false)
                 || (strpos($login, ')') !== false)
                 || (strpos($login, '=') !== false)
                 || (strpos($login, '$') !== false)
                 || (strpos($login, ':') !== false)
                 || (strpos($login, ';') !== false)
                 || (strpos($login, '\'') !== false)
                 || (strpos($login, '#') !== false)
                 || (strpos($login, '?') !== false)
                 || (strpos($login, '<') !== false)
                 || (strpos($login, '>') !== false)
                 || (strpos($login, ',') !== false)
                 || (strpos($login, '.') !== false)
                 || (strpos($login, '/') !== false)
                 || (strpos($login, '\\') !== false)
                 || (strpos($login, '|') !== false)){
                        $conditions = false;
                        $msg = "Sorry, you can't have special characters. ".$back_fail;
                }

		if($conditions){

                $insert = "INSERT INTO ajax_chat_users(login,password,name,age,location,email,website,icq,aim,yim,msn_messenger,interests) 
                VALUES ('$login','$password', '$name', '$age', '$location', '$email','$website', '$icq', '$aim', '$yim', '$msn_messenger', '$interests')";
                $result = mysql_query($insert) or die('Insert query failed!');
	        echo "Your account was created succesfully.".$back_ok;
		}else{
			echo $msg;
		}
	}
        
     }
?>

<?php include 'header.php'; ?>
<?php include 'menubar.php'; ?>
<center><h4>Emoticon</h4></center>
<?

$directory = '../img/emoticons/';


if(isset($_POST["delete"])){
        $emoticon = $_POST["emoticon"];
        //print_r($_POST);
        $search_file = "select * from ajax_chat_emoticons where icons = '$emoticon';";
        $search_result = mysql_query($search_file);
        $search_rownum = mysql_num_rows($search_result);

	if(true){//($search_rownum > 0){
	        unlink($directory.$emoticon);
		echo '<center><small>'. $emoticon.' has been deleted </small></center>';
	        $delete="DELETE from ajax_chat_emoticons where icons = '$emoticon';";
        	mysql_query($delete) or die('Delete query failed!');
	}

}

?>



<?php
//upload file in folder
$totalfiles = 11;
//echo 'post'.$_POST["uploadfiles"];
if($_POST["uploadfiles"]) {
	//print_r($_POST); 
	//echo '<pre>'; print_r($_FILES); echo '</pre>';
	//echo '<pre>'; print_r($_POST["filenames"]); echo '</pre>';


	$uploaddir = '../img/emoticons/';// getcwd().'/photos/'; //a directory inside
	echo '<center><small>';
	$files = '';
	$unuploaded = '';
	$has_new_file = false;
	$has_old_file = false;
	foreach ($_FILES['photos']['name'] as $key => $value) {
		$original_file = $_FILES['photos']['name'][$key]; //$_POST['filenames'][$key];
		if($_POST["filenames"][$key]){
			$desired_file = strtolower($_POST["filenames"][$key]);
			$desired_file = str_replace(' ', '', $desired_file);
			$extension = preg_split('/\./', $original_file,0,PREG_SPLIT_NO_EMPTY);
			$filename = $desired_file.'.'.$extension[1];
                }else{
                        $filename = $original_file;
                }
		
		$search_rownum = 0;
		if(strlen($filename) > 0){
			$search_file = "select * from ajax_chat_emoticons where icons = '$filename';";
			$search_result = mysql_query($search_file);
	        	$search_rownum = mysql_num_rows($search_result);
			//echo $search_file;
			//echo $search_rownum;
		

		        if($search_rownum > 0){
				$has_old_file = true;
				$unuploaded = $unuploaded.$filename;
				$unuploaded = $unuploaded.'\n';
			}else{
				$has_new_file = true;
				$uploadfile = $uploaddir . basename($filename);
				if (move_uploaded_file($_FILES['photos']['tmp_name'][$key], $uploadfile)) {  
					$files = $files.$filename;
					$files = $files.'\n';
			                $insert="INSERT INTO ajax_chat_emoticons values ($id,NOW(),'$filename', null);";
			                $rr = mysql_query($insert) or die('Insert query failed!');
				}
			}
		//echo "has new".$has_new_file;
		//echo "has old".$has_old_file;
		}
	}
	
	if($has_new_file){
	        //$insert="INSERT INTO ajax_chat_emoticons values ($id,NOW(),'$files', null);";
        	//$rr = mysql_query($insert) or die('Insert query failed!');
		//echo "These files are uploaded. ".$files."</small></center>";
		//echo "<script>alert('These files are uploaded. \n $files');</script>";
		$files = str_replace('\n', ', ', $files);
		echo "These files are uploaded. <br/>".$files."</small></center>";
	}

	if($has_old_file){
		//echo "<center><small><font style='color:red;font-weight:bold'>These files are already exist. They are not uploaded. These files are already exist. Please change your filenames.".$unuploaded."</font></small></center>";
		//echo "<script>alert('These files are already exist. They are not uploaded. These files are already exist. Please change your filenames. \n $unuploaded');</script>";
		$unuploaded = str_replace('\n', ', ', $unuploaded);
		echo "<center><small><font style='color:red;font-weight:bold'>These files are already exist. They are not uploaded. Please change your filenames. <br/>".$unuploaded."</font></small></center>";

	}

}


  ?>
<!--               <center><img src="http://shwe-cybercafe.webs.com/photos/mail.google.com.jpg" width="700px" height="500px"/></center> -->
	<div>
	<table><tr><td>

<?
  // Image list
  // create an array to hold directory list
    $results = array();
    // create a handler for the directory
    $handler = opendir($directory);

    // open directory and walk through the filenames
    echo "<div id='imgList' style='width: 600px; height: 350px; overflow: scroll; padding: 0; margin: 0 10px; background: #ccc'><table id='emoticonList'><tr>";
    $num = 0;
    while ($file = readdir($handler)) {
      $fextension = preg_split('/\./', $file,0,PREG_SPLIT_NO_EMPTY);
      $fext = array("png", "gif", "jpg", "jpeg", "bmp");
      // if file isn't this directory or its parent, add it to the results
      if ($file != "." && $file != ".." && in_array($fextension[1],$fext) ) {
        $results[] = $file;
      }

    }
	
	sort($results);
   	$n  = 0;
	foreach ($results as $key => $file) {
        $search_file = "select * from ajax_chat_emoticons where icons = '$file';";
        $search_result = mysql_query($search_file);
        $search_rownum = mysql_num_rows($search_result);

	$f = '/chat/img/emoticons/'.$file;
        if($search_rownum > 0){
        $n = $n +1;
        echo '<td><table><tr><td><img src="'.$f.'" width="100px" height="100px"/></td></tr><tr><td align="center">';
	$fname = preg_split('/\./', $file,0,PREG_SPLIT_NO_EMPTY);
        echo '<font style="font-size: 8px;">'.$fname[0].'</font>';
        echo '</td><tr><td align="center">';
        if($role == "admin") {
        echo '<form onsubmit="return window.confirm(&quot;Are you sure to delete?&quot;);" action="emoticons.php?securitycode='.$param.'" method="post">';
        echo '<input type="hidden" name="emoticon" value="'.$file.'"/><input type="submit" name="delete" value="Delete"/>';
        echo '</form>';
        }
        echo '</td></tr></table></td>';

	if(($num+1)%5 ==0){
        	echo "</tr><tr>";
	}
	$num+=1;
	}else{
	//not exist
		$f= '../img/emoticons/'.$file;
		unlink($f);
		
	}
	}

    echo "</tr></table>";
    closedir($handler);
    echo "</div>";
?>


	</td><td valign="top">
	<form action="emoticons.php?securitycode=<?= $param?>" method="post" enctype="multipart/form-data">
	<table>
	<tr>
		<td colspan=3>Rename filename(eg. happy). Put just name. Don't put following characters ,':;.?</td>
	</tr>
	<?
	for($i = 1; $i <= $totalfiles; $i++) { echo '<tr><td>'.$i.'.</td><td  align="left" width="1%"><input type="file" name="photos[]"/></td><td align="left"><input type="text" name="filenames[]"/></td></tr>'; }
	?> 
	</table>
	 <input type="submit" name="uploadfiles" value="Upload file" />
	</form>
	</td></tr></table>
		Total = <?= $n ?>
        	<p align="right"><a href="javascript: history.go(-1)"> Back </a></p>
	</div>
	<script> document.getElementById('imgList').style.height = window.innerHeight-150 + 'px';</script>
<?php include 'footer.php'; ?>


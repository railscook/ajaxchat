<script type="text/javascript">
//emoticonsContainer
var hh = window.parent.innerHeight-100;
if(window.parent.innerHeight > 400 && hh <= 300) {hh=300;}
window.parent.document.getElementById('emoticonsContainer').style.height = hh+'px';
window.parent.document.getElementById('emoticonsContainer').style.width = '700px';
//emoticonsIframe
window.parent.document.getElementById('emoticonsIframe').style.height = hh+'px';
window.parent.document.getElementById('emoticonsIframe').style.width = '700px';

function replaceEmoticon(file){
var text = '[img]http://'+ window.location.hostname + file+'[/img]';
window.parent.document.getElementById('inputField').value= text;
window.parent.document.getElementById('emoticonsContainer').style.display="none";
window.parent.document.getElementById('inputField').focus();
}
</script>
<?
	
  // Image list
  // create an array to hold directory list
    $directory = '../img/emoticons/';
    $results = array();
    // create a handler for the directory
    $handler = opendir($directory);

    // open directory and walk through the filenames
    echo "<div id='imgList' style='widht: 100%;padding: 0; margin: 0 10px;'>";
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
	$f = '/chat/img/emoticons/'.$file;
        
        $n = $n +1;
        echo '<div style="float:left;margin:2px;border:1px solid white;">';
	echo '<img src="'.$f.'" width="60px" height="60px" onclick="replaceEmoticon(\''.$f.'\')" title="'.$file.'"/>';
	echo '</div>';
	if(($num+1)%5 ==0){
       // 	echo "</tr><tr>";
	}
	$num+=1;

    }	

    echo "</tr></table>";
    closedir($handler);
    echo "</div>";
?>


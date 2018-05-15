<?
	
	// Get User ID
	if($_GET['userId']) {
		$userId = $_GET['userId'];
	} else {
		$userId = 1;
	}
	
	
	// Get Scene Info
	$sceneTitle = $_GET['sceneTitle'];
	$sceneDescription = $_GET['sceneDescription'];
	
	// Get Lights
	$content = $_GET['deviceStatus'];
	
	$sceneId = uniqid();
	
	$string = $sceneTitle . "\n" . $sceneDescription . "\n" . $content;
	
	// Check if scene directory exist. If not then create it.
	if (!file_exists('scenes')) {
    	mkdir('scenes', 0777, true);
	}
	
	// Check if user directory exist. If not then create it.
	if (!file_exists('scenes/' . $userId)) {
    	mkdir('scenes/' . $userId, 0777, true);
	}
	
	// Create scene txt file
	$myfile = fopen("scenes/". $userId ."/". $sceneId .".txt", "w") or die("Unable to open file!");
	
	// Write to file
	fwrite($myfile, $string);
	
	
	// Close
	fclose($myfile);
	

 	die();

?>
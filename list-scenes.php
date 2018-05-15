<?
	
	header('Access-Control-Allow-Origin: *');
	
	// Load Config
	include('inc/config.php');
	
?>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Scenes</title>

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->

  <!--   jQuery -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  
  <!--   Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  
  <!--   Stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css">
	
</head>

<body id="list">
	
<?
	
	// Check if user is selected
	if(!$_GET['userId']) {
		echo '<h1>Select User</h1>';
		
		$dirs = array_filter(glob('scenes/*'), 'is_dir');
		
		if(!$dirs) {
			echo "No Scenes Available";
		} else {
			foreach($dirs as $dir)
				{
					$dirName = str_replace('scenes/', '', $dir);
					echo '<a href="?userId='.$dirName.'" class="btn-scene">'.$dirName.'</a>';
				}
		}
		
	} else {
	
		echo '<h1><a href="list-scenes.php"><i class="fas fa-arrow-left fa-xs"></i></a> User: '.$_GET['userId'].'</h1>';
	
		//List Scenes
		$files = glob('scenes/'.$_GET['userId'].'/*.{txt}', GLOB_BRACE);
		
		if(!$files) {
			echo "No Scenes Available";
		} else {
		
			foreach($files as $file) {
		
				$content = file($file);
				$title = $content[0];
				$description = $content[1];
				$inputArray = explode(",", $content[2]);
				$dividedArray = array_chunk($inputArray, 5);
				
				echo '<div class="scene">';		
				echo '<h2>' . $title . '</h2>';
				if($description){
					echo '<p>' . $description . '</p>';
				}
		
				foreach($dividedArray as $light)
					{
			 				
			 			$device = $light[0];
			 			$status = $light[1];
			 			$level = $light[2];
			 			$hue = $light[3];
			 			$sat = $light[4];
			 			
						$deviceList = $deviceList . $device . ',';
						$statusList = $statusList . $status . ',';
						$levelList =  $levelList . $level . ',';
						$hueList = $hueList . $hue . ',';
						$satList = $satList . $sat . ',';
						
						$amount = $amount+1;
						
						if($status == 'on' ) { $status = '1'; } else { $status = '0'; }
			 		
			 			echo '<div class="light">';
			 			if($status == true) {
				 			if($hue == 0 || $sat ==0) { $color = '#ffe100'; } else { $color = 'hsl('.$hue.',100%,50%)'; }
							echo '<span class="light-on">'.$device.' <i class="fas fa-lightbulb" style="color:'.$color.';"></i> ON</span>';
								if(!$level == 0) {
									echo ' ' . $level . '%';
										if(!$hue == 0 || !$sat == 0) {
											echo ' [h:' . $hue;
											echo ' s:' . $sat . ']';
										}
								}
						} else {
							echo '<span class="light-off" style="opacity:0.5;">'.$device.' <i class="far fa-lightbulb"></i> OFF</span>';
						} 
			 			
			 			
			 			echo "</div>";
			 		}
			 	
			 	echo '<a href="#" url="'.$webcoreUrlRun.'?device='. substr($deviceList, 0, -1) .'&status='. substr($statusList, 0, -1).'&level='. substr($levelList, 0, -1) .'&hue='. substr($hueList, 0, -1) .'&sat='. substr($satList, 0, -1) . '&amount='. $amount . '" class="btn load-scene">Test Scene</a><a href="delete-scene.php?userId='.$_GET['userId'].'&file='.$file.'" class="btn del-scene"> <i class="fas fa-trash"></i> </a>';
			 	
			 	echo '</div>';
		
			}
		}
	}
?>		
	
	


<script>

// LOAD SCENE
$( ".load-scene" ).click(function() {
	var addressValue = $(this).attr("url");
	
	$.ajax({
	    url: addressValue,
	    type: 'GET',
	    crossDomain: true,
	    dataType: 'jsonp'
	});
});	

// SHOW CONFIRMATION DIALOG AFTER LOAD
$( document ).ajaxComplete(function( event, request, settings ) {
	$(function(){
alert('Scene Loaded!');    });
});

</script>

</body>
</html>
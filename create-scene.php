<?php
	
	// Load Config
	include('inc/config.php');	
	
?>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Create Scene</title>

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

<body id="create">

  
<?php

// IF TITLE HAS BEEN SET
if( isset($_POST['title']) ) {
	
	$webcoreUrlGet =  $webcoreUrlGet . "?sceneTitle=" . urlencode($_POST['title']) . "&sceneDescription=" . urlencode($_POST['description']);
	
	// GET LIGHTS (LINK TO WEBCORE)
  	$getLights = file_get_contents($webcoreUrlGet);
  	
  	// CHECK IF ALL IS GOOD
  	if( strpos( $getLights, 'OK' ) !== false ) {
	  	 	
?>

<h1>Your scene has been successfully created.</h1>
<h2>You can now close this window.</h2>

<?	
	} else {
		echo "Something Went Wrong";
		quit();
	}	

// ELSE IF TITLE WAS NOT SET
} else {	  

?>
	
	<h1>Name your scene.</h1>
	<h2>Please give it a name and any additional information below.</h2>
	
	<form action="create-scene.php" method="post">
		
		<input type="text" name="title" value="Title" placeholder="Title"><br>
		<textarea name="description" placeholder="Description"></textarea>
		<button>Submit</button>
		
	</form>
	
<?	
}
?>
	
<script>
	$('[placeholder]').focus(function() {
	  var input = $(this);
	  if (input.val() == input.attr('placeholder')) {
	    input.val('');
	    input.removeClass('placeholder');
	  }
	}).blur(function() {
	  var input = $(this);
	  if (input.val() == '' || input.val() == input.attr('placeholder')) {
	    input.addClass('placeholder');
	    input.val(input.attr('placeholder'));
	  }
	}).blur();
</script>	


</body>
</html>

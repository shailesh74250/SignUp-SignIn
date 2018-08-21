<!-- all session variable unset -->
<!-- html code-->


<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
			
		<title>Welcome to Quiz</title>
		
	</head>
	<body>

<div class="w3-container">
 <center>
 	 <div class="w3-panel w3-card-4" style="width: 400px;height: 200px;">
 	 	<p><?php echo $msg;?></p>
 	 	<p><?php echo $id_value;?></p>
 	 	<a href="<?php echo base_url().'Signin_Signup'; ?>" class="w3-button w3-red">Ougout</a>

 	 </div>
 </center>
 
</div>
 
		
	</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>lifetime</title>
	<link rel="stylesheet" href="welcome.css">

</head>
<body>
<div class="head"><h1>life<span style="color: #1889F5; font-family: sans-serif;">time</span></h1> <a href=""><img src="user-solid (1).svg" width="25vw">my plans</a></div>
	<div class="hero">
		
		<div id="advertisments"> hello world</div>
	</div>

	<div class="plan-container">
	<?php 
	$connection=new mysqli('localhost', 'root', '','users');

	$theSql='SELECT * FROM plans';

	$andResult=$connection->query($theSql);

	if ($andResult->num_rows > 0) {

		while($row = $andResult->fetch_assoc()){
			echo "<div class='plan-box' >
  			
		  	 <small>{$row['speed']}mbps</small>
		    <h2>{$row['duration_minutes']} hours</h2>
		    <p>{$row['price']} ksh</p>
		    <button
		     class='buy-btn' 
		    data-speed='{$row['speed']}'
		    data-duration='{$row['duration_minutes']}'
		    data-price='{$row['price']}'
		    >buy</button>
		    </div>";

		}
		
	}
	 ?>
	</div>

	</div>
<!-- Overlay (behind the popover) -->
<div id="overlay"></div>

<!-- Popover Modal -->

<div id="popover" >


		<button onclick="closePopover()" style="background: none; border: none;">
			<img src="cancel.svg" style='width: 24px; height: 24px; '>
		</button>
  		<p><strong>buy </strong> <span id="pop-speed"></span>mbps for <span id="pop-duration"></span> hours at <span id="pop-price"></span> Ksh</p>

		  <form action="stk_push.php" method="POST">
		  	<label>enter phone number</label><br>
		  	 <input type="number" placeholder="your phone number" name="phone"><br><br>
		  	<input type="submit" class="button" value="buy">
		  </form>
  
</div>
<script src="welcome.js"></script>

</body>
</html>
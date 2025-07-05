<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>lifetime</title>
	<style>

		body{
			overflow-x: hidden;
		}
		.head {
		  position: fixed;
		  top: 0;
		  left: 0;
		  width: 96vw;
		  height: 2vh;
		  display: flex;
		  align-items: center;
		  justify-content: space-between;
		  padding: 2vw;
		  background-color: white;
		  z-index: 1000; /* ensures it stays above everything. this is new I have to understand it*/
		}

		.head a{
			color: black;
			text-decoration: none;
		}

		.plan-box {
			display: flex;
			flex-direction: column;
			align-items: center;
			align-content: center;
		  background-color: white;
		  width: 20vw;
		  aspect-ratio: 1/1;
		  padding: 1vw;
		  transition: transform 0.2s ease;
		  margin: 16px;
		  box-shadow: 16px 12px 4px rgba(0, 0, 0, 0.3);
		}

		.plan-box:hover {
		  transform: translateY(-8px);
		}

		.plan-box small{
			margin-top: 4vh;
			margin-left: -12vw;
		}
		
		.plan-box h2{
			 text-align: center;
			color: #1889F5;
		}

		.plan-box p{
			margin-left: 12vw ;
		
		}

		.plan-box button{
			background-color: #145EA3;
			border: none;
			margin-left: 12VW;
			width: 8vw;
			height: 4vh;
			color: white;
			border-radius: 4px;
		} 

		.plan-container {
			   display: flex;
			  flex-wrap: wrap;          /* allow boxes to wrap */
			  gap: 20px;
			  justify-content: center;
			  max-width: 100%;          /* don't grow too wide */
			  overflow-x: hidden;       /* hide any horizontal overflow */
			  padding: 10px;
			  box-sizing: border-box;
			  background-image: url('frontpage.jpg');
			  background-size:  100vw;
			  background-repeat: no-repeat;
			  background-position: fixed;

			}

			#advertisments{
				height: 20vh;
				background-color: #145EA3;
				width: 100vw;
				margin-top: 10vh;
				margin-left: -1vw;
			}

			.head h1 {
				margin-top: -1vh;
			}
	</style>


</head>
<body>
	<div class="head"><h1>life<span style="color: #1889F5; font-family: sans-serif;">time<span></h1> <a href=""><img src="user-solid (1).svg" width="25vw">my plans</a></div>
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
			echo "<div class='plan-box' >;
  			
		  	 <small>{$row['speed']}mbps</small>
		    <h2>{$row['duration_minutes']} hours</h2>
		    <p>{$row['price']} ksh</p>
		    <button>buy</button>
		    </div>";

		}
		
	}
	 ?>
	</div>


</body>
</html>
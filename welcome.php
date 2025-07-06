<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>lifetime</title>
	<style>

		@media only screen and (min-width: 800px){
			body{
			overflow-x: hidden;
			  background-image: url('frontpage.jpg') !important;
		  background-size: cover!important;
		  background-repeat: no-repeat !important;
		  background-position: fixed !important;
			}

		.head {
		  position: fixed;
		  top: 0;
		  left: 0;
		  width: 96vw;
		  height: 4vh !important;
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
		  width: 24vw !important;
		  aspect-ratio: 1/1;
		  transition: transform 0.2s ease !important;
		  margin: 16px !important;
		  box-shadow: 16px 12px 4px rgba(0, 0, 0, 0.3) !important;
		}

		.plan-box:hover {
		  transform: translateY(-8px);
		}

		.plan-box small{
			margin-top: 12vh !important;
			margin-left: -16vw !important;
		}
		
		.plan-box h2{
			 text-align: center;
			color: #1889F5;
		}

		.plan-box p{
			margin-left: 12vw !important;
		
		}

		.plan-box button{
			background-color: #145EA3;
			border: none;
			margin-left: 12VW !important;
			width: 8vw !important;
			height: 4vh;
			color: white;
			border-radius: 4px;
		} 

		.plan-container {
		   display: flex;
		  flex-wrap: wrap;          /* allow boxes to wrap */
		  gap: 20px;
		  justify-content: center;
       /* don't grow too wide */
		  overflow-x: hidden;       /* hide any horizontal overflow */
		  padding: 10px;
		  box-sizing: border-box;

		
		}

		#advertisments{
			height: 24vh !important;
			background-color: #145EA3;
			max-width: 100vw;
			margin-top: 10vh;
			margin-left: -1vw;
			 font-size: 28px !important;
			 color: white;
            white-space: wrap;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            align-content: center;
            justify-content: center;
		}

		.head h1 {
			margin-top: -1vh;
		}
		}

		body{
			overflow-x: hidden;
			background-image: url('frontpageSmall.jpg');
			background-position: fixed;
			background-repeat: no-repeat;
		}

		.plan-container{
			display: flex;
			flex-wrap: wrap;
			gap: 16px;
			justify-content: center;
			align-items: center;
			align-content: center;
		

		}

		.plan-box{
			width: 36vw;
			display: flex;
			flex-direction: column;
			align-items: center;
			align-content: center;
			aspect-ratio: 1/1;
			transition: transform 0.2s ease;
			box-shadow: 12px 8px 4px rgba(0, 0, 0, 0.3);
			padding: 8px;
			background-color: white;
		}


		.plan-box:hover {
		  transform: translateY(-8px);
		}

		.plan-box small{
			margin-top: 4vh;
			margin-left: -20vw;
		}

		.plan-box h2{
			text-align: center;
			color: #1889F5;
		}

		.plan-box p{
			margin-left: 20vw ;
		}

		.plan-box button{
			background-color: #145EA3;
			border: none;
			margin-left: 16VW;
			width: 12vw;
			height: 4vh;
			color: white;
			border-radius: 4px;
		} 

		#advertisments{
			height: 20vh;
			background-color: #145EA3;
			width: 100vw;
			margin-top: 10vh;
			margin-left: -2vw;
			 font-size: 24px;
			 color: white;
            font-family: sans-serif;
            border-right: 2px solid black;
            white-space: wrap;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            align-content: center;
            justify-content: center;
		}

		.head {
		  position: fixed;
		  top: 0;
		  left: 0;
		  width: 96vw;
		  height: 10vh;
		  display: flex;
		  align-items: center;
		  justify-content: space-between;
		  padding: 2vw;
		  padding-left: 2vw;
		  background-color: white;
		  z-index: 1000; /* ensures it stays above everything. this is new I have to understand it*/
		}

		.head a{
			text-decoration: none;
			margin-top: -10px;
		}
	</style>
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
		    <button>buy</button>
		    </div>";

		}
		
	}
	 ?>
	</div>

	</div>

	<script>
    const messages = [
        "Choose a bundle",
        "enter your phone number",
        "you will recieve prompt, enter mpesa pin",
        "and you will be connected",
        "if you have a problem please contact us"
    ];

    let msgIndex = 0;

    function typeMessage(message, element, callback) {
        let charIndex = 0;
        element.textContent = '';  // clear previous text

        const typer = setInterval(() => {
            element.textContent += message[charIndex];
            charIndex++;

            if (charIndex >= message.length) {
                clearInterval(typer);
                setTimeout(callback, 2000); // wait before typing next message
            }
        }, 100); // typing speed: 100ms per character
    }

    function showMessagesLoop() {
        const display = document.getElementById('advertisments');

        typeMessage(messages[msgIndex], display, () => {
            msgIndex = (msgIndex + 1) % messages.length;
            showMessagesLoop(); // call again for the next message
        });
    }

    showMessagesLoop(); // start the loop
</script>

</body>
</html>
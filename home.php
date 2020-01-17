<!DOCTYPE HTML>
<html>
	<head>
		<title>Home</title>
		<link rel="stylesheet" href="home_page_style.css" />
	</head>
	<body background="Best-New-Android-Games-of-2018.png">
		<div id="mySidenav" class="sidenav">
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			<form method="post" action="enemies_against_fighters.php">
				<input type="submit" value="Play Enemies Against Fighters">
			</form><br>
		</div>
	<div id="formx">
		  <p id="p">Click on the element below to open the game section:</p>
		  <span id="s" style="font-size:30px;cursor:pointer; color:grey" onclick="openNav()">&#9776; open</span>
		  </div>
			<div id="output">
				<?php 
					include('show_messages.php');
				?>
			</div>
			<div id="action_btns">
				<form method="post" action="send.php">
					<input name="msg" placeholder="Type to send message"/><br>
					<input type="submit" value="Send">
				</form><br>
				<form method="post" action="logout.php">
					<input type="submit" value="Logout">
				</form>
			</div>
	
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript">
			function chat_ajax(){ 
				var req = new XMLHttpRequest(); 
				req.onreadystatechange = function() { 
					if(req.readyState == 4 && req.status == 200){ 
						document.getElementById('output').innerHTML = req.responseText; 
						} 
					} 
				req.open('POST', 'show_messages.php', true); 
				req.send(); 
			} 
			setInterval(function(){chat_ajax()}, 1000);
		</script>
		<script>
			function openNav() {
				document.getElementById("mySidenav").style.width = "250px";
				document.getElementById("main").style.marginLeft = "250px";
			}

			function closeNav() {
				document.getElementById("mySidenav").style.width = "0";
				document.getElementById("main").style.marginLeft= "0";
			}
		</script>
	</body>
</html> 

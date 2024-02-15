<?php

	session_start();

	//FOR USERNAME ON TITLE ATTR OF USER ICON

	if(isset($_COOKIE["username"]) && !isset($_SESSION["username"])) {
		$_SESSION["username"] = $_COOKIE["username"];
	}
	
	$link = mysqli_connect("localhost", "root", "", "auction");
	
	if($_SESSION["fromIndex"] == "true") {

		if(array_key_exists("r", $_GET)) {

			if(mysqli_connect_error()) {
				die("There was an error connecting to database.");
			} else {

				$query = "SELECT `id` FROM `random-string` WHERE `random` = '".mysqli_real_escape_string($link, $_GET["r"])."' LIMIT 1";

				$result = mysqli_query($link, $query);

				if(mysqli_num_rows($result) < 1) {
					die("Please log in <a href='index.php'>HERE</a>. After that you can visit our homepage.");
				} else {
					$_SESSION["fromHomepage"] = "true";
					$_SESSION["randomString"] = $_GET["r"];
				}

				//Latest Prodcts
				$query1 = "SELECT * FROM `uploads` ORDER BY `id` DESC";
				$result1 = mysqli_query($link, $query1);

			}

		} else {
			header("Location: index.php");
		}

	} else {
		header("Location: index.php");
	}

	$error = "";
	$goodmsg = "";
	$badmsg = "";

	if(array_key_exists("submit", $_POST)) {

		if(mysqli_connect_error()) {
			die("There was an error connecting to database.");
		} 
				
		if(!$_POST["Pname"] || !$_POST["Pcatagory"] || !$_POST["Pdetails"] || !$_POST["Pprice"] || !file_exists($_FILES["image"]["tmp_name"])) {
			$error .= "</br>Please Enter all details carefully.</br>";
		} else {
			if(getimagesize($_FILES["image"]["tmp_name"])) {

				$target = "images/".basename($_FILES["image"]["name"]);

				$query = "INSERT INTO `uploads` (`name`, `user`, `catagory`, `image`, `details`, `price`) VALUES ('".mysqli_real_escape_string($link, $_POST["Pname"])."', '".$_SESSION["username"]."','".mysqli_real_escape_string($link, $_POST["Pcatagory"])."', '".$_FILES["image"]["name"]."', '".mysqli_real_escape_string($link, $_POST["Pdetails"])."', '".mysqli_real_escape_string($link, $_POST["Pprice"])."')";	

				if(mysqli_query($link, $query) && move_uploaded_file($_FILES["image"]["tmp_name"], $target)) {
					$goodmsg = "Form submitted successfully";
				} else {
					$badmsg = "There was a problem submitting the form.";
				}

			} else {
				$error .= "</br>Uploaded file is not an image file.</br>";
			}

		}

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Homepage | Gec-Auction</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<script type="text/javascript" src="jQuery.js"></script>
	<script type="text/javascript" src="main.js"></script>	
</head>
<body>

	<div id="sidemenu">
		<ul>
			<li><a><span class="fa fa-home"></span> <b>Home</b></a></li>
			<li><a href="chats.php"><span class="fa fa-comments" aria-hidden="true"></span> Chats</a></li>
      <li><a href="aboutus.html"><span class="fa fa-users" aria-hidden="true"></span> About Us</a></li>
			<li><a href="contact.html"><span class="fa fa-phone" aria-hidden="true"></span> Contact</a></li>
		</ul>
	</div>

	<div class="topbar">
		<h1 id="heading"><span class="fa fa-bars"></span> Gec-Auction</h1>
		<ul id="topbar-right">
			<!--	<li><a href="#">search</a></li>		-->
			<li id="search-form">
				<form action="manual.php" method="GET">
					<input type="search" results="4" name="s" placeholder="Search Here...">
					<input type="submit" name="submit" value="Search">
				</form>				
			</li>
			<li><a id="user" title=<?php echo $_SESSION["username"]; ?> ><span class="fa fa-user"></span></a></li>
			<li><a id="cart"><span class="fa fa-shopping-cart"></span></a></li>
			<li>
				<form id="signout-form" action="index.php" method="POST">
					<input type="submit" name="signout" value="Sign out">
				</form>
			</li>
		</ul>
		<p></p>
	</div>

	<div class="upload">
		<a id="show"><p>Sell Your Product</p></a>
	</div>

	<div class="uploadProduct" id="uploadForm">
		<div>
			<form method="POST" action="" id="Uform" enctype="multipart/form-data">
				<label>Product Name :</label>
					<input type="text" name="Pname"></br></br>
				<label>Catagory :</label>
					<select form="Uform" name="Pcatagory">
						<option value="<-SELECT->">Select one option</option>
						<option value="Book">Book</option>
						<option value="Stationary">Stationary</option>
						<option value="option3">option3</option>
						<option value="option4">option4</option>
						<option value="option5">option5</option>
					</select></br></br>
				<label>Upload Image :</label>	
					<input id="uploadBtn" type="file" name="image">
					<label id="Ilabel" for="uploadBtn">Upload Image</label></br></br>
				<label>Product Details :</label>
					<textarea name="Pdetails" rows="4"></textarea></br></br>
				<label>Base Price :</label>
					<input type="text" name="Pprice"></br></br>
				<input type="submit" name="submit">
				<input type="button" name="cancel" id="hide" value="Cancel">
			</form>
		</div>
	</div>

	<p id="good"><?php echo $goodmsg; ?></p>
	<p id="bad"><?php echo $badmsg; ?></p>		
	<p id="bad"><?php echo $error; ?></p>

	<div class="wrapper">
		<div class="row">
			<a href="manual.php?s=book&submit=search">
				<section class="column1">
					<img src="images/books.png">
					<p>
						<span id="h1">Books</span></br>
					</p>
				</section>
			</a>
			<a href="manual.php?s=stationary&submit=search">
				<section class="column2">
					<img src="images/stationary.png">
					<p>
						<span id="h1">Stationary</span></br>
					</p>			
				</section>
			</a>
			<a href="#">
				<section class="column3">
					<img src="images/img (3).png">
					<p>
						<span id="h1">Other...</span></br>
					</p>
				</section>
			</a>
		</div>
	</div>

	<div class="latest"> 
		
		<h4 style="color: black; text-align: center;">Our Latest Products</h4>

		<?php 
			if(mysqli_num_rows($result1) <= 5) {
				while($row1 = mysqli_fetch_array($result1)) {
		?>
			<a href='productdetails.php?id=<?php echo $row1["id"]; ?>&name=<?php echo $row1["name"]; ?>'>	
				<div class='outer-output'>
					<div class='output'>
						<img src='images/<?php echo $row1["image"]; ?>' height='140px' width='140px'>
						<div class='inner-output'>
							<p id='uppercase' style='color: black;'><b><?php echo $row1["name"]; ?></b></p>
							<p style='color: black;'><b>Catagory : </b><?php echo $row1["catagory"]; ?></p>
							<p style='color: black;'><b>Price : </b><?php echo $row1["price"]; ?> &#x20B9;</p>
						</div>
					</div>
				</div>
			</a>
		<?php					
				}
			}	else {
				$count = 0;
				while(($row1 = mysqli_fetch_array($result1)) && $count < 5) {
		?>
			<a href='productdetails.php?id=<?php echo $row1["id"]; ?>&name=<?php echo $row1["name"]; ?>'>	
				<div class='outer-output'>
					<div class='output'>
						<img src='images/<?php echo $row1["image"]; ?>' height='140px' width='140px'>
						<div class='inner-output'>
							<p id='uppercase' style='color: black;'><b><?php echo $row1["name"]; ?></b></p>
							<p style='color: black;'><b>Catagory : </b><?php echo $row1["catagory"]; ?></p>
							<p style='color: black;'><b>Price : </b><?php echo $row1["price"]; ?> &#x20B9;</p>
						</div>
					</div>
				</div>
			</a>
		<?php
				$count++;
				}
			}
		?>

	</div>

	<style type="text/css">
		.latest {
			width: 68%;
			margin: auto;
			padding-bottom: 20px;
		}
		.outer-output {
			border: none;
			background-color: #f8f8f8;
			box-shadow: 3px 3px 10px #bbb;
			font-family: sans-serif;
			padding: 10px;
			margin: 10px;
		}
			.outer-output:hover {
				cursor: pointer;
				box-shadow: 3px 3px 10px #999;
			}
		.output {
			min-height: 140px;
			position: relative;
		}
		.output img {
			clear: both;
			float: left;
		}
		.inner-output {
			width: 600px;
			float: left;
			text-align: left;
			padding-left: 20px;
		}
		#uppercase {
			text-transform: uppercase;
		}	
	</style>

</body>
</html>
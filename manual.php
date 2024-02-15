<?php 

	session_start();	

	$search_results = [];

	if(array_key_exists("s", $_GET) && array_key_exists("submit", $_GET)) {
		if($_SESSION["fromHomepage"] == "true") {
			$link = mysqli_connect("localhost", "root", "", "auction");

			if(mysqli_connect_error()) {
				die("Problem connecting to the database");
			} else {

				$search_words = explode(" ", $_GET["s"]);
				$where = "";
				$word_count = count($search_words);
				$output = "";

				if($word_count != 0) {
					foreach($search_words as $word) {
						$where .= "`name` LIKE '%".$word."%' OR `catagory` LIKE '%".$word."%' OR ";
					}

					$where = substr($where, 0, -4);

					$query = "SELECT * FROM `uploads` WHERE ".$where." ORDER BY `id` DESC";

					$result = mysqli_query($link, $query);

					$count = mysqli_num_rows($result);

					if(!$result) {
						echo "Couldn't run it";
					} else if($count == 0) {
						$output .= "<div>There is no match.</div>";
					} else {
						while($row = mysqli_fetch_array($result)) {
							$output .= "<a href='productdetails.php?id=".$row["id"]."&name=".$row["name"]."'>	
														<div class='outer-output'>
															<div class='output'>
																<img src='images/".$row["image"]."' height='140px' width='140px'>
																<div class='inner-output'>
																	<p id='uppercase' style='color: black;'><b>".$row["name"]."</b></p>
																	<p style='color: black;'><b>Catagory : </b>".$row["catagory"]."</p>
																	<p style='color: black;'><b>Price : </b>".$row["price"]." &#x20B9;</p>
																</div>
															</div>
														</div>
													</a>";
						}
					}

				}

			}

		} else {
			die("You must log in or sign up <a href='index.php'>Here.</a> In order to use this feature.");			
		}
	} else {
		die("You must log in or sign up <a href='index.php'>Here.</a> In order to use this feature.");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Search Results | Gec-Auction</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<script type="text/javascript" src="jQuery.js"></script>
	<script type="text/javascript" src="main.js"></script>
</head>
<body>

	<div id="sidemenu">
		<ul>
			<li><a href="homepage.php?r=CdF48JoAsMM16SytNn8z"  ><span class="fa fa-home"></span> Home</a></li>
			<li><a href="chats.php"  ><span class="fa fa-comments" aria-hidden="true"></span> Chats</a></li>
			<li><a href="aboutus.html"><span class="fa fa-users" aria-hidden="true"></span> About Us</a></li>
			<li><a href="contact.html"  ><span class="fa fa-phone" aria-hidden="true"></span> Contact</a></li>
		</ul>
	</div>	

	<div class="topbar">
	<h1 id="heading"><span class="fa fa-bars" aria-hidden="true"></span><span class="fa fa-close"></span> Gec-Auction</h1>
		<ul id="topbar-right">
			<li id="search-form">
				<form action="manual.php" method="GET">
					<input type="search" results="4" name="s" placeholder="Search Here...">
					<input type="submit" name="submit" value="search">
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
	</div>

	<div class="space">
		<p>search results...</p>
	</div>

	<?php print($output); ?>

	<style type="text/css">
		body {
			margin: 0px auto;
			width: 68%;
			font-family: sans-serif;
		}
		.space {
			padding-top: 100px;
			padding-bottom: 20px;
			color: green;
			text-align: center;
			font-style: italic;
			font-weight: 700;
			font-size: 14px;
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
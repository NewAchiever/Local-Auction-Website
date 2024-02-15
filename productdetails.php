<?php
  
	session_start();
	
	$errorusername = "";

  if(array_key_exists("id", $_GET) && array_key_exists("name", $_GET)) {
    if($_SESSION["fromHomepage"] == "true") {

      $link = mysqli_connect("localhost", "root", "", "auction");

      if(mysqli_connect_error()) {
        die("Problem connecting to the database.");
      } else {

				//show comments
        if($_GET["id"] != "" && $_GET["name"] != "") {

          $image = "";
          $details = "";
          $description = "";

          $query = "SELECT * FROM `uploads` WHERE `id` = ".$_GET["id"]." LIMIT 1";
          $row = mysqli_fetch_array(mysqli_query($link, $query));

          if($row != null) {

            $image = "<img height='240px' width='240px' src='images/".$row["image"]."' />";
            $details = "<p id='uppercase'><b>".$row["name"]."</b></p>
                        <p><b>Catagory : </b>".$row["catagory"]."</p>
                        <p><b>Price : </b>".$row["price"]." &#x20B9;</p>";
            $description = "<p><b>Product Description : </b>".$row["details"]."</p>";            

          } else {
            header("Location: homepage.php?r=".$_SESSION["randomString"]);            
					}
					
					//Fetching comments
					$query1 = "SELECT * FROM `comments` WHERE (`pid` = '".$_GET["id"]."' AND `name`='".$_GET["name"]."')";
					$query6 = "SELECT `status` FROM `uploads` WHERE `name` = '".$_GET["name"]."'";
					$result1 = mysqli_query($link, $query1);
					$count = mysqli_num_rows($result1);
	
					$comments = "";
					$nocomment = "";
					
					if($count == 0) {
						$row6 = mysqli_fetch_array(mysqli_query($link, $query6));
						if($row6["status"] == 0) {
							$nocomment = "<small>Be the first one to bid on this product.</small>";
						} else {
							$nocomment = "<small>Seller is now negotiating with buyer at this point.Please try again letter.</small>";
						}
					} else {
						while($row1 = mysqli_fetch_array($result1)) {
							$comments .= "<p id='comment'><span><span>@</span>".$row1["username"]."</span>: ".$row1["comment"]."</p>";
						}
					}					

					//Seller's button
					$query2 = "SELECT `user` FROM `uploads` WHERE `name` = '".$_GET["name"]."' LIMIT 1";
					if(mysqli_query($link, $query2)) {
						$result2 = mysqli_query($link, $query2);
						$row2 = mysqli_fetch_array($result2);
					}

        } else {
          header("Location: homepage.php?r=".$_SESSION["randomString"]);
				}
				
				//add a comment
				$error = "";
				if(isset($_POST["submit"])) {
					if($_POST["comment"] != null) {

						$query = "INSERT INTO `comments` (`pid`, `name`, `username`, `comment`) VALUES ('".$_GET["id"]."', '".$_GET["name"]."', '".$_SESSION["username"]."', '".mysqli_real_escape_string($link, $_POST["comment"])."')";
						mysqli_query($link, $query);

						header("Location: ".$_SERVER["REQUEST_URI"]);

					} else {
						$error = "Please enter a comment.";
					}
				}

			}	
			
			//selling product and taking to chats
			if(isset($_POST["sellsubmit"])) {
				if($_POST["soldtouser"] != null) {
					$query3 = "SELECT * FROM `comments` WHERE (`username` = '".$_POST["soldtouser"]."' AND `name` = '".$_GET["name"]."')";
					$result3 = mysqli_query($link, $query3);

					if(mysqli_num_rows($result3) > 0) {

						$row3 = mysqli_fetch_array($result3);
						$query4 = "DELETE FROM `comments` WHERE `name` = '".$_GET["name"]."'";
						$query5 = "UPDATE `uploads` SET `status` = 1 WHERE `name` = '".$_GET["name"]."'";
						$query6 = "INSERT INTO `conversations` (`seller`, `buyer`, `name`) VALUES ('".mysqli_real_escape_string($link, $_SESSION["username"])."', '".mysqli_real_escape_string($link, $_POST["soldtouser"])."', '".mysqli_real_escape_string($link, $_GET["name"])."')";
						if(mysqli_query($link, $query4) && mysqli_query($link, $query5) && mysqli_query($link, $query6)) {
							$_SESSION["fromChats"] = "true";
							header("Location: conversations.php?name=".$_GET["name"]."");
						}

					} else {
						$errorusername = "Enter correct username.";						
					} 
				} else {
					$errorusername = "Enter correct username.";
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
	<title>Product Details | Gec-Auction</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<script src="jQuery.js" type="text/javascript"></script>
	<script src="main.js" type="text/javascript"></script>
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

  <div class="product-details">
		<div class="img">
			<?php print($image); ?>
		</div>
		<div class="pdetails">
			<?php print($details); ?>
			<?php print($description); ?>
		</div>
  </div>
	
	<p id="pbi"><b><i>Public bidding</i></b></p>

  <div class="discuss">
		<?php print($nocomment."</br>".$comments) ?>
	</br></br></br></br></br></br></br>
  </div>
	
	<span style="color: red; text-align: center;"><?php echo $errorusername; ?></span>
	<?php
		if(isset($row2)) {
			if($row2["user"] == $_SESSION["username"]) {
	?>
			<div class="user-choice">
				<form action="" method="POST">
					<label for="choice">
						Enter username of person you want to sell this product.</br>
						<small style="color: #999;">(Copy username from above comments. Note: without @ sign.)</small>
					</label>
					<fieldset>
						<input type="text" name="soldtouser" id="soldtouser">
						<input type="submit" value="Sell" name="sellsubmit"></br>
						<small style="color: #999">(Note that this will take you to the conversion with the mentioned user and will remove your product from sells catagory.)</small>
					</fieldset>
				</form>
			</div>
	<?php
			} else {
	?>
			<div class="add-comment">
				<form action="" method="POST">
					<p style="text-align: center; color: red;"><?php print($error); ?></p>
					<b>Price : </b></br>
					<small style="color: #999;">(You are willing to pay for this product.)</small></br>
					<input type="number" name="comment" id="price"></br></br>
					<input type="submit" name="submit" value="Submit">
				</form>
			</div>
	<?php
			}
		}
	?>

  <style>
    #uppercase {
      text-transform: uppercase;
		}
		#price::-webkit-inner-spin-button,
		#price::-webkit-outer-spin-button {
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			margin: 0;
		}
  </style>  

</body>
</html>
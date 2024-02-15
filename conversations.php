<?php

  session_start();

  $errormsg = "";
  $output = "";

  if(isset($_SESSION["username"]) && isset($_GET["name"]) && $_SESSION["fromChats"] == "true") {

    $link = mysqli_connect("localhost", "root", "", "auction");

    if($link) {

      //retrieving from database
      $query = "SELECT * FROM `conversations` WHERE ((`name` = '".$_GET["name"]."') AND (`buyer` = '".$_SESSION["username"]."' OR `seller` = '".$_SESSION["username"]."'))";
      $result = mysqli_query($link, $query);

      if(mysqli_num_rows($result) == 0) {
        die("Please visit our homepage <a href='homepage.php?r=".$_SESSION["randomString"]."'>HERE</a>.");
      } else {

        $query4 = "SELECT * FROM `conversations` WHERE `name` = '".$_GET["name"]."'";
        $result4 = mysqli_query($link, $query4);

        if(mysqli_num_rows($result4) == 0) {
          $output = "Start messaging by sending the message.";
        } else {
          while($row4 = mysqli_fetch_array($result4)) {
            $output .= $row4["chat"];
          }
        }

      }

      //adding chat to the database
      if(isset($_POST["addchat"])) {
        if($_POST["chat"] != null) {

          $insertchat = "<p id='comment'><span><span>@</span>".$_SESSION["username"]."</span>: ".$_POST["chat"]."</p>";
      
          $query1 = "UPDATE `conversations` SET `chat` = CONCAT( chat, '".mysqli_real_escape_string($link, $insertchat)."') WHERE `name` = '".$_GET["name"]."'";

          if(mysqli_query($link, $query1)) {
            header("Location: ".$_SERVER["REQUEST_URI"]);
          } else {
            $errormsg = "<small>Not updated. Please try again.</small>";
          }
      
        } else {
          $errormsg = "<small>Please enter all details carefully.</small>";
        }
      }

      //deleting the whole conversation
      if(isset($_POST["dltchat"])) {
        $query2 = "DELETE FROM `conversations` WHERE `name` = '".$_GET["name"]."'";
        $query3 = "DELETE FROM `uploads` WHERE `name` = '".$_GET["name"]."'";
        if(mysqli_query($link, $query2) && mysqli_query($link, $query3)) {
          header("Location: homepage.php?r=".$_SESSION["randomString"]);
        } else {
          $errormsg = "<small>Not updated. Please try again.</small>";
        }
      }

    } else {
      die("Problem connecting to the database.");
    }

  } else if(isset($_SESSION["username"])) {
    die("Please visit our homepage <a href='homepage.php?r=".$_SESSION["randomString"]."'>HERE</a>.");
  } else {
    die("Please login or sign up <a href='index.php'>HERE</a>.");
  }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Conversations | Gec-Auction</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<script src="jQuery.js" type="text/javascript"></script>
	<script src="main.js" type="text/javascript"></script>
</head>
<body>

	<div id="sidemenu">
		<ul>
			<li><a href="homepage.php?r=CdF48JoAsMM16SytNn8z" target="_blank"><span class="fa fa-home"></span> Home</a></li>
			<li><a href="chats.php" target="_blank"><span class="fa fa-comments" aria-hidden="true"></span> <b>Chats</b></a></li>
			<li><a href="aboutus.html"><span class="fa fa-users" aria-hidden="true"></span> About Us</a></li>
			<li><a href="contact.html" target="_blank"><span class="fa fa-phone" aria-hidden="true"></span> Contact</a></li>
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

  <div class="show-chat">
    <?php print($output); ?>
  </div>

  <div class="chatting">
    <div>
      <form action="" id="adding" method="POST">
        <?php echo $errormsg; ?>
        <input type="text" name="chat" placeholder="Enter your message" id="chats">
        <input type="submit" value="Enter" name="addchat">
      </form>
      <form action="" id="delete" method="POST">
        <input type="submit" value="End" name="dltchat"></br>
        <small>(this option will end the conversation and will completely delete all the product info.)</small>
      </form>
    </div>
  </div>

</body>
</html>  
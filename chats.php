<?php
  session_start();
  $_SESSION["fromChats"] = "false";

  if(isset($_SESSION["username"])) {

    $link = mysqli_connect("localhost", "root", "", "auction");

    $query = "SELECT * FROM `conversations` WHERE (`seller` = '".$_SESSION["username"]."' OR `buyer` = '".$_SESSION["username"]."') ORDER BY `id` DESC";
    $result = mysqli_query($link, $query);
    $errornodata = "";
    $data = "";
    $crossuser = "";

    if(mysqli_num_rows($result) == 0) {
      $errornodata = "<span>There are no ongoing conversations for you.Please buy or sell a product <a href='homepage.php?r=".$_SESSION["randomString"]."'>HERE</a>.<span>";
    } else {
      
      while($row = mysqli_fetch_array($result)) {
      
        if($_SESSION["username"] == $row["buyer"]) {
          $crossuser = $row["seller"];
        } else if($_SESSION["username"] == $row["seller"]) {
          $crossuser = $row["buyer"];
        }

        $data = "<a href='conversations.php?name=".$row["name"]."'>
                  <div class='link-conversion'>
                    <p id='comment'>About <b>".$row["name"]."</b> with <span><span>@</span>".$crossuser."</span></p>
                  </div>
                </a>";
      }
      $_SESSION["fromChats"] = "true";
    }
  
  } else {
    die("Please login here in order to use this page <a href='index.php'>HERE</a>.");
  }  

?>

<!DOCTYPE html>
<html>
<head>
	<title>Chats | Gec-Auction</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<script src="jQuery.js" type="text/javascript"></script>
	<script src="main.js" type="text/javascript"></script>
</head>
<body>

	<div id="sidemenu">
		<ul>
			<li><a href="homepage.php?r=CdF48JoAsMM16SytNn8z"  ><span class="fa fa-home"></span> Home</a></li>
			<li><a href="chats.php"  ><span class="fa fa-comments" aria-hidden="true"></span> <b>Chats</b></a></li>
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

  <div class="toconversions">
    <?php 
      if($errornodata == "") {
    ?>
      <p>Your ongoing conversations.</p>
    <?php
        print($data);
      } else {
        echo $errornodata;
      }
    ?>
  </div>

</body>
</html>
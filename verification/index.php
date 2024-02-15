<?php

	session_start();
	$_SESSION["fromIndex"] = "false";
	$error = "";
		
	if(array_key_exists("vs", $_GET)) {
		$link = mysqli_connect("localhost", "root", "", "auction");
		
		if(mysqli_connect_error($link)) {
			die("There was an error connecting to the database.");
		} else {
			$vid = "";
			$vemail = "";

			$vs = $_GET["vs"];
			$vemail = substr($vs, 0, 32);
			$vid = substr($vs, 32);

			if(!$vid || !$vemail) {
				die('This link is not valid OR link is expired Please go <a href="../">Here</a>.');
			} else {
				$query = "SELECT * FROM `temp-data` WHERE `id` = '".mysqli_real_escape_string($link, $vid)."' LIMIT 1";
				$result = mysqli_query($link, $query);
				$row = mysqli_fetch_array($result);	
			}			

			if(isset($row)) {

				if($row["en-email"] == $vemail) {

					$query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $row["email"])."', '".mysqli_real_escape_string($link, $row["password"])."')";

					if(!mysqli_query($link, $query)) {
						die('Please sign up again, <a href="../">Here</a>.');
					} else {

						$query1 = "UPDATE `users` SET `password` = '".md5(md5(mysqli_insert_id($link)).$row["password"])."' WHERE `email` = '".mysqli_real_escape_string($link, $row["email"])."' LIMIT 1";
						mysqli_query($link, $query1);

						$query = "DELETE FROM `temp-data` WHERE `id` = '".mysqli_real_escape_string($link, $row["id"])."' LIMIT 1";

						mysqli_query($link, $query);

						$_SESSION["fromIndex"] = "true";

						echo 'Your account has been verified.Visit the website <a href="../homepage.php?r=fvfdqI84cTqZ4TFH">here</a>.';

					}

				}

			} else {
				die('This link is not valid OR link is expired Please go <a href="../">Here</a>.');
			}

		}
	} else {
		die('Please go to the registration page <a href="../">Here</a>.');
	}	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Verification | Gec-Auction</title>
	<style><?php include("../font/product-sans.css"); ?></style>
</head>
<body>

</body>
</html>
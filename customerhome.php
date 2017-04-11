<?php
  session_start();

  // If the session vars aren't set, try to set them with a cookie
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['unamec'])) {
      $_SESSION['unamec'] = $_COOKIE['unamec'];
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Staff Home</title>
	<link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php 
if (!isset($_SESSION['unamec'])) {
	  echo "Session expired.Please login again.";
}
else{
?>
<div class="wrapper">
	<div class="header">
        <div class="hd1">
        	<img src="images/janbank.png" width="200px" height="70px"  />
        </div>
    </div>
    <div class="nav">
        	<ul style="list-style-type: none">
            	<li><a href="">HOME</a></li>
				<li><a href="">ABOUT US</a></li>
                <li><a href="">FEATURES</a></li>
                <li><a href="">FAQ</a></li>
                <li><a href="">USEFUL ARTICLES</a></li>
				<li><a href="">HELP</a></li>
				<li><a href="">CONTACT US</a></li>
             </ul>
    </div>
<div class="mid">
	<div class="mid1">
	<div class="mid12">
		
<?php
  require_once('connectvars.php');
  // Generate the navigation menu
  if (isset($_SESSION['unamec'])) {
	echo '<ul>';
				echo '<li><a href="customerhome.php">HOME</a></li>';
				echo '<h2>Staff</h2>';
				echo '<li><a href="customerhome.php">View Profile</a></li>';
				echo '<h2>Profile</h2>';
				echo '<li><a href="customerLogout.php">Log Out (' . $_SESSION['unamec'] . ')</a></li>';
				
		echo '</ul>';
  }
  
?>
	</div>
	</div>
	<div class="mid2">
				<div class="adminWelcome"> 
				<?php
				  echo('<p>You are logged in as ' . $_SESSION['unamec'] . '.'.'Welcome '.$_SESSION['unamec'].'</p>');
				?>
				</div>
	<div class="mid22">
			
	</div>
	</div>
	</div>
</div>
<div class="activeLinks">
<div class="al">
	<div class="al-1">
		<ul style="list-style-type:none;">
			<li><a href="">HOME</a></li>
			<li><a href="">ABOUT US</a></li>
			<li><a href="">FEATURES</a></li>
			<li><a href="">FAQs</a></li>
			<li><a href="">USEFUL ARTICLES</a></li>
		</ul>
	</div>
</div>
<div class="al">
	<div class="al-1">
		<ul style="list-style-type:none;">
			<li><a href="">HELP</a></li>
			<li><a href="">CONTACT US</a></li>
			<li><a href="">RBI POLICY</a></li>
			<li><a href="">GOVT. OF INDIA</a></li>
			<li><a href="">GOVT. OF DELHI</a></li>
		</ul>
	</div>
</div>
<div class="al">
	<div class="al-1">
		<ul style="list-style-type:none;">
			<li><a href="">SAFE BANKING</a></li>
			<li><a href="">UN BANKING</a></li>
		</ul>
	</div>
</div>
</div>
<div class="footer">
	<div class="f1">
            	<h3> Copyright © 2016 Jan Bank</h3>
     </div>
</div>
</div>
</div>
<?php 
}
 ?>
</body>
</html>
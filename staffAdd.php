<?php
  session_start();

  // If the session vars aren't set, try to set them with a cookie
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['username'] = $_COOKIE['username'];
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Jan Bank</title>
	<link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php 
if (!isset($_SESSION['username'])) {
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
            	<li><a href="main.php">HOME</a></li>
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
  if (isset($_SESSION['username'])) {
	echo '<ul>';
				echo '<li><a href="adminHome.php">HOME</a></li>';
				echo '<h2>Staff</h2>';
				echo '<li><a href="staffAdd.php">ADD NEW</a></li>';
				echo '<h2>Profile</h2>';
				echo '<li><a href="logoutAdmin.php">Log Out (' . $_SESSION['username'] . ')</a></li>';
				
		echo '</ul>';
  }
?>
	</div>
	</div>
	<div class="mid2">
				<div class="adminWelcome"> 
				<?php
				  echo('<p>You are logged in as ' . $_SESSION['username'] . '.'.'Welcome '.$_SESSION['username'].'</p>');
				?>
				</div>
	<div class="mid22">
			<div class="addStaff">
				<div class="form">
					<h2>Add Staff</h2>
					<form action="adminHome.php" method="post">
						<div class="li">
							<label>Userame : </label>
							<input type="text" name="uname"   />
						</div><br/>
						<div class="li">
							<label>First Name : </label>
							<input type="text" name="fname"   />
						</div><br/>
						<div class="li">
							<label>Last Name: </label>
							<input type="text" name="lname"  />
						</div><br/>
						<div class="li">
							<label>Gender :</label><br/>
							M<input type="radio" name="stgen" value="M"   checked/>
							F<input type="radio" name="stgen" value="F"   />
						</div><br/>			
						<div class="li">
							<label>Email : </label>
							<input type="email" name="email" />
						</div><br/>
						<div class="li">
							<label>Phone: </label>
							<input type="text" name="phone" />
						</div><br/>
						<div class="li">
							<label>Address : </label>
							<textarea name="stadd" required="" ></textarea>
						</div><br/>
						<div class="li">
							<label>Password : </label>
							<input type="password" name="passw"/>
						</div><br/>
						<div class="li">
							<label>Confirm Password : </label>
							<input type="password" name="cpassw"/>
						</div><br/><br/><br/>
						<input type="submit" name="submit" value="Register"/>
					</form>
				</div>
					<div class="btn">
					<a href="adminHome.php">Back to Main Page ></a>
					</div>
			</div>	
	
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
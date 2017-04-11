<!DOCTYPE html>
<html>
<head>
	<title>Jan Bank</title>
	<link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
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
	<div class="slider">
    	<div class="slider1">
        	<img src="images/slider.jpg"/>
        </div>
        <div class="slider2">
        	<h3><span>Welcome to </span><br />Jan Bank</h3>
        	<p>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took.
            </p>
        </div>
    </div>
<div class="login">
				<div class="cLogin">
					<div id="login">
						<h2>Customer Login</h2>
					<form action="customerLogin.php" method="post">
						<div class="li">
						<label>Username: </label>
						<input type="text" name="unamec"/>
						</div><br/>
						<div class="li">
						<label>Password: </label>
						<input type="password" name="passwc"/>
						</div><br/>
						<input type="submit" name="submit" value="Login"/>
					</form>		
				
					</div>
				</div>
				<div class="sLogin">
					<div id="login">	
						<h2>Staff Login</h2>	
<?php
  require_once('connectvars.php');

  // Start the session
  session_start();


  // If the user isn't logged in, try to log them in
    if (isset($_POST['submit'])) {
      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      // Grab the user-entered log-in data
      $user_username = mysqli_real_escape_string($dbc, trim($_POST['uname']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['passw']));
      if (!empty($user_username) && !empty($user_password)) {
        // Look up the username and password in the database
        $query = "SELECT uname FROM staff WHERE uname = '$user_username' AND passw = '$user_password'";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
          $_SESSION['uname'] = $row['uname'];
          setcookie('uname', $row['uname'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/staffhome.php';
          header('Location: ' . $home_url);
        }
        else {
					echo "Incorrect username or password. Try again";
         ?>
		 			<form action="staffLogin.php" method="post" ">
						<div class="li">
						<label>Username: </label>
						<input type="text" name="uname"/>
						</div><br/>
						<div class="li">
						<label>Password: </label>
						<input type="password" name="passw"/>
						</div><br/>
						<input type="submit" name="submit" value="Login"/>
					</form>
		 <?php
        }
      }
      else {
				echo "Empty username or password."
         ?>
		 			<form action="staffLogin.php" method="post" ">
						<div class="li">
						<label>Username: </label>
						<input type="text" name="uname"/>
						</div><br/>
						<div class="li">
						<label>Password: </label>
						<input type="password" name="passw"/>
						</div><br/>
						<input type="submit" name="submit" value="Login"/>
					</form>
		 <?php
      }
    
  }
  ?>
					
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
</body>
</html>
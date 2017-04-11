
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
		<?php
	require_once('connectvars.php');
	
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
		or die('Error connecting to MySQL server.');
		$query="SELECT * from staff WHERE id='$id'";
		$result=mysqli_query($dbc,$query);
		$row=mysqli_fetch_array($result);
		mysqli_close($dbc);
		$uname=$row['uname'];
		$fname=$row['fname'];
		$lname=$row['lname'];
		removeForm($uname,$fname,$lname,$id);
}
else if (isset($_POST['id'])&&isset($_POST['uname'])&&($_POST['fname'])) {
	$id=$_POST['id'];
	$uname=$_POST['uname'];
	$fname=$_POST['fname'];
	
}
else{
	echo "<br/>No user to remove.";
}
}
?>
<?php
function removeForm($u,$f,$l,$i)
		{		
					echo "<h6>Are you sure you want to delete user?</h6><br/><br/>";
					echo '<form action="adminHome.php" method="post">';
					echo '<h6>Username : '.$u.'</h6><br/>';
					echo '<h6>Name : '.$f.' '.$l.'</h6><br/>';
					echo '<h6>Id : '.$i.'</h6><br/>';
					echo '<div class="yes"><input type="submit" name="delete" value="Yes"/></div>';
					echo '<div class="no"><a href="adminHome.php">No</a></div>';
					echo '<input type="hidden" name="id" value="'.$i.'"/>';
					echo '<input type="hidden" name="uname" value="'.$u.'"/>';
					echo '<input type="hidden" name="fname" value="'.$f.'"/>';
					echo '</form>';
		}

?>

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
</body>
</html>
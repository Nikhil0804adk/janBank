
<?php
  session_start();

  // If the session vars aren't set, try to set them with a cookie
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['uname'])) {
      $_SESSION['uname'] = $_COOKIE['uname'];
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
if (!isset($_SESSION['uname'])) {
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
  if (isset($_SESSION['uname'])) {
	echo '<ul>';
				echo '<li><a href="staffhome.php">HOME</a></li>';
				echo '<h2>Staff</h2>';
				echo '<li><a href="customerAdd.php">ADD NEW</a></li>';
				echo '<h2>Profile</h2>';
				echo '<li><a href="staffLogout.php">Log Out (' . $_SESSION['uname'] . ')</a></li>';
				
		echo '</ul>';
  }
?>
	</div>
	</div>
	<div class="mid2">
				<div class="adminWelcome"> 
				<?php
				  echo('<p>You are logged in as ' . $_SESSION['uname'] . '.'.'Welcome '.$_SESSION['uname'].'</p>');
				?>
				</div>
	<div class="mid22">
		<?php
	require_once('connectvars.php');
	
if(isset($_GET['idc']))
{
	$idc=$_GET['idc'];
	$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
		or die('Error connecting to MySQL server.');
		$query="SELECT * from customer WHERE idc='$idc'";
		$result=mysqli_query($dbc,$query);
		$row=mysqli_fetch_array($result);
		mysqli_close($dbc);
		$unamec=$row['unamec'];
		$fnamec=$row['fnamec'];
		$lnamec=$row['lnamec'];
		removeForm($unamec,$fnamec,$lnamec,$idc);
}
else if (isset($_POST['idc'])&&isset($_POST['unamec'])&&($_POST['fnamec'])) {
	$idc=$_POST['idc'];
	$unamec=$_POST['unamec'];
	$fnamec=$_POST['fnamec'];
	
}
else{
	echo "<br/>No user to remove.";
}
}
?>
<?php
function removeForm($uc,$fc,$lc,$ic)
		{		
					echo "<h6>Are you sure you want to delete user?</h6><br/><br/>";
					echo '<form action="staffhome.php" method="post">';
					echo '<h6>Username : '.$uc.'</h6><br/>';
					echo '<h6>Name : '.$fc.' '.$lc.'</h6><br/>';
					echo '<h6>Id : '.$ic.'</h6><br/>';
					echo '<div class="yes"><input type="submit" name="delete" value="Yes"/></div>';
					echo '<div class="no"><a href="staffhome.php">No</a></div>';
					echo '<input type="hidden" name="idc" value="'.$ic.'"/>';
					echo '<input type="hidden" name="unamec" value="'.$uc.'"/>';
					echo '<input type="hidden" name="fnamec" value="'.$fc.'"/>';
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
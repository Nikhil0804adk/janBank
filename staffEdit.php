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
		$stgen=$row['stgen'];
		$email=$row['email'];
		$phone=$row['phone'];
		$stadd=$row['stadd'];
		$passw=$row['passw'];
		form($uname,$fname,$lname,$id,$email,$phone,$stadd);
}
else if(isset($_POST['id'])) {
	$uname2=typeValid($_POST['uname']);
	$fname2=typeValid($_POST['fname']);
	$lname2=typeValid($_POST['lname']);
	$email2=typeValid($_POST['email']);
	$phone2=typeValid($_POST['phone']);
	$stadd2=typeValid($_POST['stadd']);
	$id2=typevalid($_POST['id']);
}
else{
	echo "<br/>No user to remove.";
}

if(isset($_POST['submit']))
{	$j=0;
		if(empty($uname2)||empty($fname2)||empty($lname2)||empty($email2))
			{?> <p><?php
					$a1=array('',',',',',',',',',',');
					echo "*You forgot ";
					if(empty($uname2))
					{
						echo "username";
						$j++;
						
					}
					if(empty($fname2))
					{	
						echo $a1[$j];
						echo "first name";
					}
					if(empty($lname2))
					{	
						echo $a1[$j];
						echo "last name";
					}
					if(empty($email2))
					{	
						echo $a1[$j];
						echo "email";
					}
					
					?></p><?php
					form($uname2,$fname2,$lname2,$id2,$email2,$phone2,$stadd2);
			}
			else {
					
									$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
									or die('Error connecting to MySQL server.');
									$query="UPDATE staff SET uname='$uname2',fname='$fname2',lname='$lname2',email='$email2',phone='$phone2',stadd='$stadd2'".
									" WHERE id='$id2' LIMIT 1";
									if(!mysqli_query($dbc,$query))
									{die('Error querying database');
									}else
									{
									mysqli_close($dbc);
									echo "<h6>Updated</h6> <br/>";
									echo '<div class="rno"><a href="adminHome.php">Back to main page > </a></div>';
									}
					} 
			
}

}
 ?>
 <?php 
	function form($u,$f,$l,$i,$e,$p,$a)
	{
		echo "<div class='form'>";
		echo "<h2>Update Your Details</h2>";
		echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
		echo "<div class='li'>";
		echo "<label>User Name *: </label>";
		echo "<input type='text' name='uname' value='$u'/></div><br/>";	
		echo "<div class='li'>";
		echo "<label>First Name *: </label>";
		echo "<input type='text' name='fname' value='$f'/></div><br/>";		
		echo "<div class='li'>";
		echo "<label>Last Name: </label>";
		echo "<input type='text' name='lname' value='$l'/>";
		echo "</div><br/>";
		echo "<div class='li'>";
        echo "<label>Email : </label>";
		echo "<input type='email' name='email' value='$e'/>";
		echo "</div><br/>";
		echo "<div class='li'>";
		echo "<label>Phone: </label>";
		echo "<input type='text' name='phone' value='$p'/>";
		echo "</div><br/>";
		echo "<div class='li'>";
		echo "<label>Address : </label>";
		echo "<textarea name='stadd'>$a</textarea>";
		echo "</div><br/>";
		echo "</div><br/><br/><br/>";
		echo "<input type='hidden' name='id' value='$i'/>";
		echo "<input type='submit' name='submit' value='Update'/>";
		echo "</form>";
		echo "</div>";
		echo "<div class='btn'>";
		echo "<a href='adminHome.php'>Back to Main Page ></a>";
		echo "</div>";
	}
	function typeValid($data)
	{
				$data=trim($data);
				$data=stripslashes($data);
				$data=htmlspecialchars($data);
				return $data;	
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
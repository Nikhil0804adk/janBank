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
		$stgenc=$row['stgenc'];
		$emailc=$row['emailc'];
		$phonec=$row['phonec'];
		$staddc=$row['staddc'];
		$passwc=$row['passwc'];
		form($unamec,$fnamec,$lnamec,$idc,$emailc,$phonec,$staddc);
}
else if(isset($_POST['idc'])) {
	$unamec2=typeValid($_POST['unamec']);
	$fnamec2=typeValid($_POST['fnamec']);
	$lnamec2=typeValid($_POST['lnamec']);
	$emailc2=typeValid($_POST['emailc']);
	$phonec2=typeValid($_POST['phonec']);
	$staddc2=typeValid($_POST['staddc']);
	$idc2=typevalid($_POST['idc']);
}
else{
	echo "<br/>No user to remove.";
}

if(isset($_POST['submit']))
{	$j=0;
		if(empty($unamec2)||empty($fnamec2)||empty($lnamec2)||empty($emailc2))
			{?> <p><?php
					$a1=array('',',',',',',',',',',');
					echo "*You forgot ";
					if(empty($unamec2))
					{
						echo "username";
						$j++;
						
					}
					if(empty($fnamec2))
					{	
						echo $a1[$j];
						echo "first name";
					}
					if(empty($lnamec2))
					{	
						echo $a1[$j];
						echo "last name";
					}
					if(empty($emailc2))
					{	
						echo $a1[$j];
						echo "email";
					}
					
					?></p><?php
					form($unamec2,$fnamec2,$lnamec2,$idc2,$emailc2,$phonec2,$staddc2);
			}
			else {
					
									$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
									or die('Error connecting to MySQL server.');
									$query="UPDATE customer SET unamec='$unamec2',fnamec='$fnamec2',lnamec='$lnamec2',emailc='$emailc2',phonec='$phonec2',staddc='$staddc2'".
									" WHERE idc='$idc2' LIMIT 1";
									if(!mysqli_query($dbc,$query))
									{die('Error querying database');
									}else
									{
									mysqli_close($dbc);
									echo "<h6>Updated</h6> <br/>";
									echo '<div class="rno"><a href="staffhome.php">Back to main page > </a></div>';
									}
					} 
			
}
}
?>
<?php
	function form($uc,$fc,$lc,$ic,$ec,$pc,$ac)
	{
		echo "<div class='form'>";
		echo "<h2>Update Your Details</h2>";
		echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
		echo "<div class='li'>";
		echo "<label>User Name *: </label>";
		echo "<input type='text' name='unamec' value='$uc'/></div><br/>";	
		echo "<div class='li'>";
		echo "<label>First Name *: </label>";
		echo "<input type='text' name='fnamec' value='$fc'/></div><br/>";		
		echo "<div class='li'>";
		echo "<label>Last Name: </label>";
		echo "<input type='text' name='lnamec' value='$lc'/>";
		echo "</div><br/>";
		echo "<div class='li'>";
        echo "<label>Email : </label>";
		echo "<input type='email' name='emailc' value='$ec'/>";
		echo "</div><br/>";
		echo "<div class='li'>";
		echo "<label>Phone: </label>";
		echo "<input type='text' name='phonec' value='$pc'/>";
		echo "</div><br/>";
		echo "<div class='li'>";
		echo "<label>Address : </label>";
		echo "<textarea name='staddc'>$ac</textarea>";
		echo "</div><br/>";
		echo "</div><br/><br/><br/>";
		echo "<input type='hidden' name='idc' value='$ic'/>";
		echo "<input type='submit' name='submit' value='Update'/>";
		echo "</form>";
		echo "</div>";
		echo "<div class='btn'>";
		echo "<a href='staffhome.php'>Back to Main Page ></a>";
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
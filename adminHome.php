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
	$i=0;
	$j=0;
	$flag=false;
	if(isset($_POST['submit']))
	{	$uname=typeValid($_POST['uname']);
		$fname=typeValid($_POST['fname']);
		$lname=typeValid($_POST['lname']);
		$stgen=typeValid($_POST['stgen']);
		$email=typeValid($_POST['email']);
		$phone=typeValid($_POST['phone']);
		$stadd=typeValid($_POST['stadd']);
		$passw=typeValid($_POST['passw']);
		$cpassw=typeValid($_POST['cpassw']);
		?>
		<p>
		<?php
		 if(empty($uname)||empty($fname)||empty($lname)||empty($stgen)||empty($email)||empty($phone)||empty($stadd)||empty($passw)||empty($cpassw))
		{			
					$a1=array('',',',',',',',',',',',',',',',',');
					echo "<br/>*You forgot ";
					if(empty($uname))
					{
						echo "username";
						$j++;
						
					}
	
					if(empty($fname))
					{	echo $a1[$j];
						echo "first name";
						$j++;
					}
					if(empty($lname))
					{	echo $a1[$j];
						echo "last name";
						$j++;
					}
					if(empty($stgen))
					{	echo $a1[$j];
						echo "gender";
						$j++;
					}
					if(empty($email))
					{	echo $a1[$j];
						echo "email";
						$j++;
					}
					if(empty($phone))
					{	echo $a1[$j];
						echo "phone";
						$j++;
					}
					if(empty($stadd))
					{	echo $a1[$j];
						echo "address";
						$j++;
					}
					if(empty($passw))
					{echo $a1[$j];
						echo "password";
						$j++;
						
					}
					if(empty($cpassw))
					{echo $a1[$j];
						echo "confirm password";
					}
					$flag=true;
		}
		else if (!empty($phone)||empty($phone)) 
		{
				if(!preg_match("/^[0-9]*$/", $phone))
				{
						echo "*Phone number should be numeric";
						$flag=true;
				}
		
		else 
		{    
			$db=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
							or die('Error connecting to MySQL server.');
				  $res = mysqli_query($db,"SELECT uname FROM staff WHERE uname='".$_POST['uname']."'");
				  $n=mysqli_num_rows($res);
			if($n>0){
				echo '<b>Username '.$uname.' already used.</b>';
				$flag=true;
				mysqli_close($db);
			}
			
				
				else{
				if(strcmp($passw,$cpassw)==0)
				{
				  	 
						
							$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
							or die('Error connecting to MySQL server.');
							$query="INSERT into staff(uname,fname,lname,stgen,email,phone,stadd,passw)".
							"VALUES('$uname','$fname','$lname','$stgen','$email','$phone','$stadd','$passw')";
				
							if(mysqli_query($dbc,$query))
							{				 	

								echo "Added";
								header("Location: " . $_SERVER['REQUEST_URI']);
			   					exit();
						
							
							}
							else
							{	
								echo $fname,$lname,$stgen,$email,$phone,$stadd,$passw;
						die('Error querying database');
							}
							mysqli_close($dbc);
						
					
				}
				else
				{
					echo "Passwords don't match"; 
					$flag=true;
				}	
	}
	}}}
	if(isset($_POST['delete']))
	{
			$id2=$_POST['id'];
			$uname3=$_POST['uname'];
			$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
			or die('Error connecting to MySQL server.');
			$query="DELETE from staff WHERE id='$id2' LIMIT 1";
			mysqli_query($dbc,$query)
			or die('Error querying database');
			echo "User removed with username : ".$uname3." <br/><br/>";
			mysqli_close($dbc);
	}
	?>
	<?php
	if($flag)
	{
		?>
			<div class="addStaff">
				<div class="form">
					<h2>Add Staff</h2>
					<form action="adminHome.php" method="post">
						<div class="li">
							<label>Userame : </label>
							<input type="text" name="uname" value="<?php echo $uname; ?>"  />
						</div><br/>
						<div class="li">
							<label>First Name : </label>
							<input type="text" name="fname"  value="<?php echo $fname; ?>" />
						</div><br/>
						<div class="li">
							<label>Last Name: </label>
							<input type="text" name="lname" value="<?php echo $lname; ?>" />
						</div><br/>
						<div class="li">
							<label>Gender :</label><br/>
							M<input type="radio" name="stgen" value="M"   checked/>
							F<input type="radio" name="stgen" value="F"  />
						</div><br/>
						<div class="li">
							<label>Email : </label>
							<input type="email" name="email" value="<?php echo $email; ?>" />
						</div><br/>
						<div class="li">
							<label>Phone: </label>
							<input type="text" name="phone" value="<?php echo $phone; ?>"/>
						</div><br/>
						<div class="li">
							<label>Address : </label>
							<textarea name="stadd" ><?php echo $stadd; ?></textarea>
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
		<?php
	}	
	else
	{
		$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
		or die('Error connecting to MySQL server.');
		$query="SELECT id,uname,fname,lname from staff";
		$result=mysqli_query($dbc,$query)
		or die('Error querying MySQL database.');		
?>

	<div class="mid3">
				<table border="1px">
						<tr>
							<th>S. No</th>
							<th>Username</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Action</th>
						</tr>
						<?php 
							while($row=mysqli_fetch_array($result))
							{ 
						?>
						<tr>
							<td><?php $i++; echo $i; ?></td>
							<td><?php echo $row['uname']; ?></td>
							<td><?php echo $row['fname']; ?></td>
							<td><?php echo $row['lname']; ?></td>
							
							<?php echo '<td><a href="staffEdit.php?id='.$row['id'].'">EDIT </a>||<a href="staffDelete.php?id='.$row['id'].'"> DELETE</a></td>';?>
						</tr>
						<?php
							}
							
							mysqli_close($dbc);	
						?>
						<?php
		}
		
		function typeValid($data)
		{
			$data=trim($data);
			$data=stripslashes($data);
			$data=htmlspecialchars($data);
			return $data;
		}
	?>
				</table>
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
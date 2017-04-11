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
	<title>Staff Home</title>
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
	$i=0;
	$j=0;
	$flag=false;
	if(isset($_POST['submit']))
	{	$unamec=typeValid($_POST['unamec']);
		$fnamec=typeValid($_POST['fnamec']);
		$lnamec=typeValid($_POST['lnamec']);
		$stgenc=typeValid($_POST['stgenc']);
		$emailc=typeValid($_POST['emailc']);
		$phonec=typeValid($_POST['phonec']);
		$staddc=typeValid($_POST['staddc']);
		$passwc=typeValid($_POST['passwc']);
		$cpasswc=typeValid($_POST['cpasswc']);
		?>
		<p>
		<?php
		 if(empty($unamec)||empty($fnamec)||empty($lnamec)||empty($stgenc)||empty($emailc)||empty($phonec)||empty($staddc)||empty($passwc)||empty($cpasswc))
		{			
					$a1=array('',',',',',',',',',',',',',',',',');
					echo "<br/>*You forgot ";
					if(empty($unamec))
					{
						echo "username";
						$j++;
						
					}
	
					if(empty($fnamec))
					{	echo $a1[$j];
						echo "first name";
						$j++;
					}
					if(empty($lnamec))
					{	echo $a1[$j];
						echo "last name";
						$j++;
					}
					if(empty($stgenc))
					{	echo $a1[$j];
						echo "gender";
						$j++;
					}
					if(empty($emailc))
					{	echo $a1[$j];
						echo "email";
						$j++;
					}
					if(empty($phonec))
					{	echo $a1[$j];
						echo "phone";
						$j++;
					}
					if(empty($staddc))
					{	echo $a1[$j];
						echo "address";
						$j++;
					}
					if(empty($passwc))
					{echo $a1[$j];
						echo "password";
						$j++;
						
					}
					if(empty($cpasswc))
					{echo $a1[$j];
						echo "confirm password";
					}
					$flag=true;
		}
		else if (!empty($phonec)||empty($phonec)) 
		{
				if(!preg_match("/^[0-9]*$/", $phonec))
				{
						echo "*Phone number should be numeric";
						$flag=true;
				}
		
		else 
		{    
			$db=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
							or die('Error connecting to MySQL server.');
				  $res = mysqli_query($db,"SELECT unamec FROM customer WHERE unamec='".$_POST['unamec']."'");
				  $n=mysqli_num_rows($res);
			if($n>0){
				echo '<b>Username '.$unamec.' already used.</b>';
				$flag=true;
				mysqli_close($db);
			}
			
				
				else{
				if(strcmp($passwc,$cpasswc)==0)
				{
				  	 
						
							$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
							or die('Error connecting to MySQL server.');
							$query="INSERT into customer(unamec,fnamec,lnamec,stgenc,emailc,phonec,staddc,passwc)".
							"VALUES('$unamec','$fnamec','$lnamec','$stgenc','$emailc','$phonec','$staddc','$passwc')";
				
							if(mysqli_query($dbc,$query))
							{				 	

								echo "Added";
								header("Location: " . $_SERVER['REQUEST_URI']);
			   					exit();
						
							
							}
							else
							{	
								echo $fnamec,$lnamec,$stgenc,$emailc,$phonec,$staddc,$passwc;
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
			$idc2=$_POST['idc'];
			$unamec3=$_POST['unamec'];
			$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
			or die('Error connecting to MySQL server.');
			$query="DELETE from customer WHERE idc='$idc2' LIMIT 1";
			mysqli_query($dbc,$query)
			or die('Error querying database');
			echo "User removed with username : ".$unamec3." <br/><br/>";
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
					<form action="staffhome.php" method="post">
						<div class="li">
							<label>Userame : </label>
							<input type="text" name="unamec" value="<?php echo $unamec; ?>"  />
						</div><br/>
						<div class="li">
							<label>First Name : </label>
							<input type="text" name="fnamec"  value="<?php echo $fnamec; ?>" />
						</div><br/>
						<div class="li">
							<label>Last Name: </label>
							<input type="text" name="lnamec" value="<?php echo $lnamec; ?>" />
						</div><br/>
						<div class="li">
							<label>Gender :</label><br/>
							M<input type="radio" name="stgenc" value="M"   checked/>
							F<input type="radio" name="stgenc" value="F"  />
						</div><br/>
						<div class="li">
							<label>Email : </label>
							<input type="email" name="emailc" value="<?php echo $emailc; ?>" />
						</div><br/>
						<div class="li">
							<label>Phone: </label>
							<input type="text" name="phonec" value="<?php echo $phonec; ?>"/>
						</div><br/>
						<div class="li">
							<label>Address : </label>
							<textarea name="staddc" ><?php echo $staddc; ?></textarea>
						</div><br/>
						<div class="li">
							<label>Password : </label>
							<input type="password" name="passwc"/>
						</div><br/>
						<div class="li">
							<label>Confirm Password : </label>
							<input type="password" name="cpasswc"/>
						</div><br/><br/><br/>
						<input type="submit" name="submit" value="Register"/>
					</form>
				</div>
					<div class="btn">
					<a href="staffhome.php">Back to Main Page ></a>
					</div>
			</div>	
		<?php
	}	
	else
	{
		$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
		or die('Error connecting to MySQL server.');
		$query="SELECT idc,unamec,fnamec,lnamec from customer";
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
							<td><?php echo $row['unamec']; ?></td>
							<td><?php echo $row['fnamec']; ?></td>
							<td><?php echo $row['lnamec']; ?></td>
							
							<?php echo '<td><a href="customerEdit.php?idc='.$row['idc'].'">EDIT </a>||<a href="customerDelete.php?idc='.$row['idc'].'"> DELETE</a></td>';?>
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
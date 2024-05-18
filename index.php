<html>
<head>
	<link rel="icon" href="images/cv1.png" type="image/gif">
	<title>CVH</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/Style.css">
</head>

<div class="container-fluid">
<?php include 'body.php';?>

<fieldset id = "AdminHeader" style = "width: auto; background:WHITE;">
    <table border="0" cellspacing="0" cellpadding="0" width = "100%">   
        <tr><td align='center' width="20%"><img class = "img-responsive img-circle" src="images/lfs.jpg" width="50%">
				<td align='center' style = "background-color:#ffe0cc;"><font size = "8"><B>Litle Flowers High School</B>
				<BR><font size = "5"><B>Uppal Road, Hyderabad
				<BR><font size = "5"><i>"Every flower is a soul blossoming in nature"</i></B>
				<td align='center'  width="20%"><img class = "img-responsive img-rounded" src="images/building.png" width="80%">
    </table>
</fieldset>  

<h4>Please Provide Login Details</h4>   
<div class="container">
	<form method="POST" name="LoginForm">
		<fieldset id = "Login Details">
			<table border="0" cellspacing="0" cellpadding="1" width = "100%">  
				<tr><td align = "center"><input name="fusername" type="text" placeholder="User Name" autofocus onkeypress = "return isValidKey(event)" required>
				<tr><td>&nbsp;
				<tr><td align = "center"><input name="fpwd" type="password" placeholder="Password" onkeypress = "return isValidKey(event)" required>
				<tr><td>&nbsp;
				<tr><td align = "center"><button name="login">Login</button>
			</table>
		</fieldset>
	</form>        
</div>
<?php
include('config.php');

if (isset($_POST['login']))
{
	
	$musername = $_POST['fusername'];
	$mpwd = $_POST['fpwd'];  
	
	$q = "SELECT * FROM users WHERE UserName = '$musername' && Password = '$mpwd' ";
	//echo $q;
	$chk = $db->query($q);

	if ($chk->num_rows == 1)
	{
		$row = mysqli_fetch_assoc($chk);
		$uname1 = $row['UserName'];
		$mpwd1 = $row['Password'];
		$muserID = $row['ID'];

		if($musername == $uname1 && $mpwd == $mpwd1) 
		{
			session_start();
			$_SESSION['LoggedIn'] = true;
			$_SESSION['UserName'] = $musername;    
			$_SESSION['Role'] = $row['Role'];
			$_SESSION['StaffID'] = $row['StaffID'];
			$_SESSION['UserID'] = $muserID;

			$ll = "UPDATE Users set LastLogged = now() where ID = $muserID";
			mysqli_query($db,$ll);
			
			header("Location:homepage");
		}
		else
		{
			echo "<label>Your Login Name or Password Mismatch.</label>";
		}
	}
	else
	{
		echo "<label>Please Check Your Login Name or Password.</label>";
	}
	
	$db->close();
}
?>
	<script type="text/javascript" language="javascript">
    	function isValidKey(evt)
			{
				var charCode = (evt.which) ? evt.which : event.keyCode
				//if (charCode > 31 && (charCode < 48 || charCode > 57))
				//No single code or back slash please...
				if (charCode == 39 || charCode == 92)
					return false;
				return true;
			}
	</script>
	
	<?php include 'pagefooter.php';?>
</body>
</div>
</html>

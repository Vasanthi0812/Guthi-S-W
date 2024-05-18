<html>
<head>
	<link rel="icon" href="images/cv1.png" type="image/gif">
	<title>CVH</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/Style.css">
</head>

<?php 
session_start();
if (isset($_SESSION['LoggedIn']) == false) 
{	
	echo "<script type='text/javascript'>window.top.location='index';</script>"; exit;
}
echo '<div class="container-fluid">';
include 'body.php';

?>
<div class="container">

	<form method = "POST" name = "NewStudent">
	<H4>Please Provide Student Details.</H4>
	
		<div class='table-responsive'>
		<table class="table-condensed" style = "width: 40%;background-color:#DFDFDF;border-radius: 10px;">
		<caption>Student Information</caption>
		<tr>
			<td align = "right">Name &nbsp; <td><input type="text" id = "StudName" name = "StudName" onkeyup="NameToUpperCase()" maxlength="150" required>
		<tr>
			<td align = "right">Class &nbsp; <td><input type="text" id = "Class" name = "Class" maxlength="50" required>
			
		<tr>
			<td align = "right">Present &nbsp; <BR> Address &nbsp; <td><textarea name = "Address" style="resize:none;" maxlength="180" ></textarea>
			
		</table>
		</div>
	
	<BR>
	<button name="Save">Save</button>
	</form>
</div>

<?php
if (isset($_POST['Save']))
{
	
	$_StudName = trim($_POST['StudName']);
	$_Class = trim($_POST['Class']);
	$_Address = trim($_POST['Address']);
		
	$_sql =  "INSERT INTO Student (Name, Class, Address) 
					VALUES ('$_StudName', '$_Class', '$_Address')";
	
	include('config.php');
	$db->begin_transaction();

	try 
	{
		$db->query($_sql);
		$db->commit();
		echo "<label>One Record Saved Successfuly...</label>";
		echo "<br>";
		echo "<button name='Homepage' onclick='go_home()'>Homepage</button>";
	} 
	catch (mysqli_sql_exception $exception) 
	{
		$db->rollback();
		throw $exception;
		echo "<label>Sorry Your Data Not Processed Successfuly...</label>";
	}
	$db->close();

}

?>

	

<script type="text/javascript">
	function NameToUpperCase()
	{
		var x = document.getElementById("StudName");
		x.value = x.value.toUpperCase();
	}
	function go_home()
	{
		window.top.location='homepage'
	}
</script>

<?php include 'pagefooter.php';?>
</body>
</div>
</html>
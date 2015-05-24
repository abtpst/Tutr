<?php 

require("dbinfo.php");

$FirstName = htmlentities($_POST["firstName"]);
$LastName = htmlentities($_POST["lastName"]);
$Email =  htmlentities($_POST["email"]); 
$PhoneNumber =  htmlentities($_POST["phone"]); 
$Address =  htmlentities($_POST["address"]);
$sub = $_POST["subject"];

$con=mysqli_connect(HOST,USER,PASSWORD,DATABASE);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$subarray = explode(",",$sub);

foreach ($subarray as $val)

	mysqli_query($con,"INSERT INTO subject (subjectName) 
VALUES ('$val')");

// Perform queries 
mysqli_query($con,"INSERT INTO tutor (firstName,lastName,email,phoneNumber,address) 
VALUES ('$FirstName','$LastName','$Email','$PhoneNumber','$Address')");

mysqli_close($con);

header('Location: index.html');
?>


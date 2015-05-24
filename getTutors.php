<?php
include_once 'dbinfo.php';

// Start XML file, create parent node
$doc = new DOMDocument("1.0");
$node = $doc->createElement("markers");
$parnode = $doc->appendChild($node);

// Opens a connection to a MySQL server
$connection=mysql_connect (HOST, USER, PASSWORD);

if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
//$db_selected = mysql_select_db($database, $connection);

$db_selected = mysql_select_db(DATABASE, $connection);

if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}
// Select all the rows in the markers table
$query = "SELECT * FROM tutor";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  $node = $doc->createElement("marker");
  $newnode = $parnode->appendChild($node);

  $newnode->setAttribute("FirstName", $row['firstName']);
  $newnode->setAttribute("LastName", $row['lastName']);
  $newnode->setAttribute("Email", $row['email']);
  $newnode->setAttribute("PhoneNumber", $row['phoneNumber']);
  $newnode->setAttribute("Address", $row['address']);
}

echo $doc->saveXML();

?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
$deckName = $_GET['deckName'];
$class = $_GET['class'];
$userid = $_GET['userid'];
$deckNameTrim = str_replace(" ", "_", $deckName);
$s = 'temp';
$tableName = $deckNameTrim.$userid.$class;
$tempTableN = $s.$tableName;

$user = 'root';
$pass = '';
$db = 'hearthstone';
$con = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

$sql="SELECT * FROM $tempTableN ORDER BY RAND() LIMIT 1";
$result = $con->query($sql);

while($row = $result->fetch_assoc()) {
	$cardN = $row["cardname"];
	$url = $row["image"];
	$quant = $row["quantity"];
	$sql2="DELETE FROM $tempTableN WHERE cardname = '$cardN' AND quantity=$quant";
	$result2 = $con->query($sql2);
	echo '<input type="image" src="'.$url.'" width="100" height="150" disabled/>';
}

$con->close();
?>
</body>
</html>
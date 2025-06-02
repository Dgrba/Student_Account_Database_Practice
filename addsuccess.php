<?
session_start();
$id = $_SESSION['id'];
echo "<HTML><br>";
echo "<HEAD><br>";
echo "<TITLE>Student User Page</TITLE><br>";
echo "</HEAD><br>";
echo "<BODY style=\"text-align:center;\"><br>";
echo "<HEADER><br>";
echo "<h1>Student Successfully Added With ID#: $id</h1><br>";
echo "</HEADER><br><br>";
echo "<form><br>";
echo "<input type=\"button\" value=\"Back\" onclick=\"history.go(-2)\"><br>";
echo "</form><br>";
echo "</BODY><br>";
echo "</HTML><br>";
?>

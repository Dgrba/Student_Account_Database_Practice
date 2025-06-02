<?
session_start();
include 'studentutility_functions.php';
include "verifysession.php";
$firstName = $_POST["studentFirstName"];
$lastName = $_POST["studentLastName"];
$age = $_POST["studentAge"];
$address = $_POST["studentAddress"];
$type = $_POST["studentType"];


$sql = "insert into student " . 
       "(studentIdNo, studentFirstName, studentLastName, studentAge, studentAddress, studentType) " . 
       "values (' ', '$firstName', '$lastName', '$age', '$address', '$type')";

$result_array = execute_sql_in_oracle($sql);
$cursor = $result_array["cursor"];
if(!$cursor){
    display_oracle_error_message($cursor);
    die("Student query failed.");
}
$result = $result_array["result"];
if(!$result){
    display_oracle_error_message($result);
    die("Student query failed.");
}

if($values = oci_fetch_array($cursor)){
 oci_free_statement($cursor);
 
 $id = createid($firstName, $lastName);

 $sql = "select studentIdNo " .
		"from student " . 
		"where studentFirstName = '$firstName' " . 
		"and studentLastName = '$lastName' ";

  $result_array = execute_sql_in_oracle ($sql);
  
  $cursor = $result_array["cursor"];
  if(!$cursor){
    display_oracle_error_message($cursor);
    die("Failed to create a new session.");
  }		
  $result = $result_array["result"];
  if (!$result){
    display_oracle_error_message($cursor);	
    die("Failed to create a new session.");
  }
  $_SESSION['id'] = $result;
  
  
  header("Location: http://cs2.uco.edu/~gq005/Project1/addsuccess.php");

}
else {
  die ('Student Add failed.  Click <a href="www.http://cs2.uco.edu/~gq005/Project1/useradd.html.com" onclick="window.history.go(-1); return false;"> Link </a>
 to go back to the Student Add page.');
}
?>



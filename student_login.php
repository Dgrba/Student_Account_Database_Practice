<?
session_start();
include 'studentutility_functions.php';

$username = $_POST["username"];
$_SESSION['username']=$username;
$password = $_POST["password"];


$sql = "select username 
        from studentList 
        where username = '$username' 
        and password = '$password'";

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
 
 $username = $values[0];

 $_SESSION['sessionid'] = $sessionid = md5(uniqid(rand()));

 $sql = "insert into mystudentsession " .
 "(sessionid, username, sessiondate) " .
 "values ('$sessionid', '$username', sysdate)";

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
  
    
	header("Location:welcomepage.php?sessionid=$sessionid");
 

}
else {
  die ('Login failed.  Click <A href="login.html">here</A> to go back to the login page.');
}
?>



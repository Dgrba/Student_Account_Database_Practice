<?
include "verifysession.php";

if ($sessionid == "") {
  // no active session - clientid is unknown
  echo("Invalid user!");
}
else {
	$connection = oci_connect ("gq005", "ajswwu", "gqiannew2:1521/pdborcl");
	
	$sql = "delete from mystudentlist where sessionid = '$sessionid'";

    $cursor = oci_parse($connection, $sql);
    if($cursor == false){
      $e = oci_error($connection);
      echo $e['message']."<BR>";
    }
    else{
      $result = oci_execute($cursor);
      if ($result == false){
        display_oracle_error_message($cursor);
		die("Session removal failed");
      }
    } 
}
header("Location:http://cs2.uco.edu/~gq005/Project1/login.html");
?>

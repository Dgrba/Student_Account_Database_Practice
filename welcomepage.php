<?
// include the verification PHP script
include "verifysession.php";

if ($sessionid == "") {
  // no active session - clientid is unknown
  echo("Invalid user!");
}
else {
	$connection = oci_connect ("gq005", "ajswwu", "gqiannew2:1521/pdborcl");
	
	$sql = "select isadmin " .
       "from studentList " .
       "where username='$username'";

    $cursor = oci_parse($connection, $sql);
    if($cursor == false){
      $e = oci_error($connection);
      echo $e['message']."<BR>";
    }
    else{
      $result = oci_execute($cursor);
      if ($result == false){
        $e = oci_error($cursor);
        echo $e['message']."<BR>";
      }
      else{
        if($values = oci_fetch_array ($cursor)){
          $isadmin = $values[0];
        }
	  }
	}
	
	if ($isadmin == "Y"){
		header("Location: http://cs2.uco.edu/~gq005/Project1/admin.html");
	}
	if ($isadmin == "S"){
		header("Location: http://cs2.uco.edu/~gq005/Project1/sadmin.html");
	}	
	else{
		header("Location: http://cs2.uco.edu/~gq005/Project1/student.html");
	}	
}	
?>

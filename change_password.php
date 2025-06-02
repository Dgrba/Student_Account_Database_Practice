<?
session_start();
include "verifysession.php";

	if(isset($_REQUEST['username'])){
		$username = $_REQUEST['username'];	
	}
	if(isset($_REQUEST['newpassword'])){
		$newpassword = $_REQUEST['newpassword'];
	}

	$connection = oci_connect ("gq005", "ajswwu", "gqiannew2:1521/pdborcl");
	if (!$connection){
		$e = oci_error(); 
		echo($e['message']);
	}
	$sql = "update studentList 
       		set password = '$newpassword' 
       		where username = '$username'";
	   
	$cursor = oci_parse($connection, $sql);
	if(!$cursor){
		$e = oci_error($connection);
		echo $e['message']."<BR>";
    }
    $result = oci_execute($cursor);
    if (!$result){
        $e = oci_error($cursor);  
		echo $e['message']."<BR>";

    }
	oci_commit ($connection);

	header("Location: http://cs2.uco.edu/~gq005/Project1/success.html");

?>


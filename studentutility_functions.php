<?
function execute_sql_in_oracle($sql) {
  //putenv("ORACLE_HOME=/home/oracle/OraHome1");
  //putenv("ORACLE_SID=orcl");

  $connection = oci_connect ("gq005", "ajswwu", "gqiannew2:1521/pdborcl");
  if($connection == false){
    // failed to connect
    display_oracle_error_message(null);
    die("Failed to connect");
  }

  $cursor = oci_parse($connection, $sql);

  if ($cursor == false) {
    display_oracle_error_message($connection);
    oci_close ($connection);

    die("SQL Parsing Failed");
  }

  $result = oci_execute($cursor);

  if ($result == false) {
    display_oracle_error_message($cursor);
    oci_close ($connection);
	
    die("SQL execution Failed");
  }

  
  oci_commit ($connection);

  oci_close ($connection);

  $return_array["result"] = $result;
  $return_array["cursor"] = $cursor;

  return $return_array;
}

function verify_session($sessionid){
  $sql = "select username " .
     "from mystudentsession " .
     "where sessionid = '$sessionid'";

  $result_array = execute_sql_in_oracle($sql);
  $result = $result_array["result"];
  $cursor = $result_array["cursor"];

  $result = oci_execute($cursor);
  if($result == false){
    display_oracle_error_message($cursor);
    die("SQL Execution Failed");
  }

  if(!($values = oci_fetch_array($cursor))){
    die("Invalid student");
  }
  oci_free_statement($cursor);
}


function display_oracle_error_message($resource){
 if (is_null($resource))
	$err = oci_error();
 else
	$err = oci_error($resource);

  echo "<BR />";
  echo "Oracle Error Code: " . $err['code'] . "<BR />";
  echo "Oracle Error Message: " . $err['message'] . "<BR />" . "<BR />";

  if ($err['code'] == 1)
    echo("Duplicate Values.  <BR /><BR />");
  else if ($err['code'] == 984 or $err['code'] == 1861
    or $err['code'] == 1830 or $err['code'] == 1839 or $err['code'] == 1847
    or $err['code'] == 1858 or $err['code'] == 1841)
    echo("Wrong type of value entered.  <BR /><BR />");
  else if ($err['code'] == 1400 or $err['code'] == 1407)
    echo("Required field not correctly filled.  <BR /><BR />");
  else if ($err['code'] == 2292)
    echo("Child records exist.  Need to delete or update them first.  <BR /><BR />");
}

function create_id ($firstName, $lastName){
	
	$sql = "select next value for ID_Increment "; 
	
	$result_array = execute_sql_in_oracle($sql);
	$id = $return_array["result"];
	
	$fInitial = substr($firstName, 0, 1);
	$lInitial = substr($lastName, 0, 1);
	
	$initials = $fInitial.$lInitial;
	$id = $initials.$id;
	
	
	$sql = 	"IF NOT EXISTS (SELECT * FROM dbo.Employee WHERE ID = @SomeID)"
			"INSERT INTO student (studentIdNo) " .
			"VALUES ('$id') " .
			"where studentFirstName = '$firstName' " .
			"and studentLastName = '$lastName' " .
			"ELSE" .
			"update student " .
			"set studentIdNo = '$id' " .
			"where studentFirstName = '$firstName' " .
			"and studentLastName = '$lastName' ";	
			
			
	$result_array = execute_sql_in_oracle($sql);	

	return $id;
}
?>


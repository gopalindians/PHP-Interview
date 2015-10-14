<?php
namespace SoftwareEngineerTest;

// Question 1a

$DB_HOST = '127.0.0.1:3306';
$DB_NAME = 'test';
$DB_USER = 'test';
$DB_PASS = 'test';

//Get the Occupation name from URL
$occupation_name = false;
$occupation_name = trim($_GET["occupation_name"]);

// write your sql to get customer_data here

$db_handle = get_DbHandle($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS);
$cutomer_data = get_CustomerData($db_handle);

/**
 * get_DbHandle Function  
 *
 * This function returns the database handle for the DB values (HOST,DB NAME,USER,PASS) passed
*/
function get_DbHandle ($host,$db,$user,$pass) {
	
	$db_handle = mysql_connect($host, $user, $pass) 
				or die("Unable to connect to Mysql host ".$host);
	mysql_select_db($db,$db_handle);
	
	return $db_handle;
}
/**
 * get_CustomerData Function  
 *
 * This function returns the result set joining customer tables. Database handle has to be passed
*/
function get_CustomerData($db_conn) {

	$result=false;
	$query = "SELECT c.customer_id,c.username,c,first_name,c,last_name,IFNULL(co.occupation_name,'un-employed') as occup_name FROM customer c LEFT JOIN customer_occupation co ON c.customer_occupation_id=co.customer_occupation_id";
	$result = mysql_query($query,$db_conn);
	if(!$result )
	{
	  die('Could not get customer data: ' . mysql_error());
	}
	return $result;	
}

?>

<h2>Customer List</h2>

<table>
	<tr>
		<th>Customer ID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Occupation</th>
	</tr>
	<?php
		while($row = mysql_fetch_array($cutomer_data, MYSQL_ASSOC)) {
			if($occupation_name) {
				if($row['occup_name'] == $occupation_name) {}
					echo "	<tr>
								<th>".$row['customer_id']."</th>
								<th>".$row['first_name']."</th>
								<th>".$row['last_name']."</th>
								<th>".$row['occup_name']."</th>
							</tr>";
				}		
			} else {
				echo "	<tr>
							<th>".$row['customer_id']."</th>
							<th>".$row['first_name']."</th>
							<th>".$row['last_name']."</th>
							<th>".$row['occup_name']."</th>
						</tr>";				
			} 
		}	
	?>
</table>

<?php
//======================================================================
// Create Account
//======================================================================

include_once (realpath(dirname(__FILE__).'/path.php'));
include_once (realpath(dirname(__FILE__).'/config.php'));

/* Salt used for seasoning */
$salt = 'authentication';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
$first_name =  $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone =  $_POST['phone'];
$address = $_POST['address'];
$city = $_POST['city'];
$country = $_POST['country'];
$created_at = date("Y-m-d H:i:s");

	if(empty($country)){
		$country = "USA";
	}
    if(empty($first_name) || empty($last_name) || empty($email)) {
        echo "first name, last name, and email fields are required.";
        exit();
    }


    // Check if email already exists
    $check_email = $db_connection->prepare(
        "SELECT c.email 
        FROM Customers c
        WHERE c.email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_email->store_result();

    if ($check_email->num_rows > 0) {
        echo "Email already exists use a different email.";
		echo "<br><a href='" . BASE_URL . "/user/customers.php'>Click here to see the customers list</a>";
        $check_email->close();
        exit();
    }
    $check_email->close();


$insert_customers = $db_connection->prepare(
	"INSERT INTO Customers
		( first_name, last_name,email, phone, address, city, country, created_at) VALUES(?,?,?,?,?,?,?,?);");
$insert_customers->bind_param("ssssssss", $first_name, $last_name, $email, $phone, $address, $city, $country, $created_at);
$first_name;
$last_name;
$email;
$phone;
$address;
$city;
$country;
$created_at;

if($insert_customers->execute()){
$insert_customers->close();
echo "Customer added successfully.";
echo "<br><a href='" . BASE_URL . "/user/customers.php'>Click here to see the customers list</a>";
}
else{
	echo "Failed to add customer.";
	echo "<br><a href='" . BASE_URL . "/user/customers.php'>Click here to see the customers list</a>";
	}
}
else{
echo "Failed to connect";

}
exit();

?>
<?php

error_reporting(E_ALL); // Report all errors
ini_set('display_errors', 0); // set to 1 to display errors, 0 to hide them

  /* Quick Paths */
  /* note the 2 after __FILE__, because it's 2 directories deep */
  include_once (realpath(dirname(__FILE__, 2).'/php/session.php')); // Session will be included in header.php
  include_once (realpath(dirname(__FILE__, 2).'/php/path.php')); // Path will be included in header.php
  // Session will be included in header.php

  /* Page Name */
  $page_name = "user";

?>
<?php
//======================================================================
// USER DASHBOARD PAGE
//======================================================================

error_reporting(E_ALL);
ini_set('display_errors', 0); // set to 1 to display errors, 0 to hide them

  /* Quick Paths */
  /* note the 2 after __FILE__, because it's 2 directories deep */
  include_once (realpath(dirname(__FILE__, 2).'/php/session.php')); // Session will be included in header.php
  include_once (realpath(dirname(__FILE__, 2).'/php/path.php')); // Path will be included in header.php
  // Session will be included in header.php
  
  /* Check Role */
  include_once (ROOT_SRC_PATH .'/check_user.php'); // Check user role and redirect if not authorized

  $user_check = $_SESSION['login_user'];
  // Check user and get roll session from database

  /* Page Name */
  $page_name = "admin"; // Set page name for active link in header

?>



<!doctype html>
<html lang="en">
  <head>
  <?php include_once (ROOT_PATH . '/include/head.php'); // Include head.php ?>
  </head>
  <body class="<?php echo $page_name; ?>">
  <?php include_once (ROOT_PATH . '/include/header.php'); // Include header.php ?>
    <main role="main" class="container">

    <div class="container text-center">
  <div class="row align-items-center">
    
    <div class="col">
      <div class="mb-6">
      <h1>Customers Dashboard</h1>
      </div>
      <hr class="mb-4">
      <section class="mb-4">
     
      <main role="main" class="container">
      <div class="row justify-content-sm-center">
        <div class="col-sm-4">


      <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
      <th scope="col">City</th>
      <th scope="col">Country</th>
      <th scope="col">Created At</th>
    </tr>
  </thead>
  <tbody>
    <?php
      include_once (ROOT_PATH . '/php/config.php');

      $result = $db_connection->query(
        "SELECT *
        FROM Customers 
        ");

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<th scope='row'>" . $row["customer_id"] . "</th>";
          echo "<td>" . htmlspecialchars($row["first_name"]) . "</td>";
          echo "<td>" . htmlspecialchars($row["last_name"]) . "</td>";
          echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
          echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
          echo "<td>" . htmlspecialchars($row["address"]) . "</td>";
          echo "<td>" . htmlspecialchars($row["city"]) . "</td>";
          echo "<td>" . htmlspecialchars($row["country"]) . "</td>";
          echo "<td>" . htmlspecialchars($row["created_at"]) . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='6'>No users found</td></tr>";
      }
      $db_connection->close();
    ?>

  </tbody>
</table>
          <h2>Add customer</h2>
          <form action="../php/create_customer.php" method="post">
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name" required>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name" required>
            </div>
            <div class="input-group mb-3">
              <input type="email" class="form-control" id="email" placeholder="Enter Email Address" name="email" required>
            </div>
            <div class="input-group mb-3">
              <input type="tel" class="form-control" id="phone" placeholder="Enter Phone Number" name="phone">
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="address" placeholder="Enter Street Address" name="address" >
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="city" placeholder="Enter City" name="city" >
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="Country" placeholder="Enter Country" name="country" >
            </div>

            <?php
              /* Error Message */
              if (isset($error)) {
                // uses bootstrap alert style for error messages
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
              }
            ?>
            <button type="submit" class="btn btn-primary">Add Customer</button>
          </form>

</section>
    </div>
  </div>
</div>  
       
    </main>
    <?php include_once (ROOT_PATH . '/include/footer.php'); ?>
  </body>
</html>


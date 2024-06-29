

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <title>Main Menu</title>
</head>
<body style="background-color:whitesmoke;">





</div>



!

<style>
.container{
    
    background-color:wwhite;
    border: greenyellow 2px solid;
    border-radius: 40px;
 
    padding: 45px;
    width: 550px;
}

.btns{

        border-radius: 30px;
        width: 455px;
        height: 55px;
        border: green 2px solid;
        font-size: x-large;

}

.btn_container{
   display: flex;
    flex-direction: column;
    text-align: center;
    align-items: center;
}
#log{
    margin-top: 15px;
}

#ad{
    margin-top: 15px;
}
#reg{
  font-weight: 700;
  text-align: center;

}




</style>

</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $customer_name = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];
    $password = $_POST['password'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $database ="simnpledemo";

    // Connecting to database
    $conn = mysqli_connect($servername, $username, $db_password, $database);

    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    } else {
        // Check if customer already exists
        $check_query = "SELECT * FROM customers WHERE `customer_name` = '$customer_name' OR `customer_phone` = '$customer_phone'";
        $check_result = mysqli_query($conn, $check_query);

        if(mysqli_num_rows($check_result) > 0){
            echo '<div class="alert alert-danger" role="alert">A user with the same name or phone number already exists. Please use different information.</div>';
        } else {
            // Generate customer_id
            $code = rand(1, 99999); // Generate random code
            $customer_id = "CUST-" . $code;

            // Insert new customer into database with customer_id
            $sql = "INSERT INTO `customers` (`customer_name`, `customer_phone`, `password`, `customer_id`) 
                    VALUES ('$customer_name', '$customer_phone', '$password', '$customer_id')";
            $result = mysqli_query($conn, $sql);

            if($result){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your entry has been submitted successfully!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>';
              header("Location: login.php"); // Redirect to login page after successful registration
              exit();
            } else {
                echo "Error inserting customer: " . mysqli_error($conn);
            }
        }
    }
}
?>



<div class="container mt-3">
<h2 id="reg">Register</h2>
<hr>
    <form action="/SimpleBusTicket-PHP/form.php" method="post">
    <div class="form-group">
        <label for="customer_name">Full Name</label>
        <input type="text" name="customer_name" class="form-control" id="customer_name" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="last_name">Phone Number</label>
        <input type="number" name="customer_phone" class="form-control" id="customer_phone" aria-describedby="emailHelp">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    
    <button type="submit" class="btn btn-primary" >Submit</button>
    </form>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3

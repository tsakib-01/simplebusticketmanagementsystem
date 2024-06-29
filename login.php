    <!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Login Page</title>
</head>
<body>
<?php 




if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $customer_name = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];
    $password = $_POST['password'];

    // Submit these to a database
    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $database ="simnpledemo";

    //Connecting php with a database...

    $conn = mysqli_connect($servername, $username, $db_password, $database);

    if(!$conn){
        die("Connection was interrupted!:   ".mysqli_connect_error());
    } else {

       // Check if a user with the provided credentials exists
       $check_query = "SELECT customer_id, customer_name FROM customers WHERE `customer_name` = '$customer_name' AND `customer_phone` = '$customer_phone' AND `password` = '$password'";

$check_result = mysqli_query($conn, $check_query);

if(mysqli_num_rows($check_result) > 0){
    // User exists, fetch the customer_id
    $row = mysqli_fetch_assoc($check_result);
    $customer_id = $row['customer_id'];

    // Redirect to home page or any other page with customer_id as parameter
    header("Location: welcome.php?customer_id=$customer_id&customer_name=$customer_name");
    exit();
} else {
    // Display error message if no user found with the provided credentials
    echo '<div class="alert alert-danger" role="alert">The data provided does not match! Please try again..</div>';
}

    }
}
?>

<div class="container mt-5">
<h2 id="reg" style="text-align: center;">Login</h2>
<hr>
    <form action="/SimpleBusTicket-PHP/login.php" method="post">
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
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body style="background-color:whitesmoke;">



<style>
.gap{

    height: 45px;

}


.container{
    background-color: whitesmoke;
    border: greenyellow 2px solid;
    border-radius: 40px;

    padding: 25px;
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
#login{
 
        text-align: center;
}

.top_alert{
    display: none;

}

</style>

</body>
</html>



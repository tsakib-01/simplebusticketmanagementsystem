<?php
// Check if both customer_id and customer_name are set in the URL
if(isset($_GET['customer_id']) && isset($_GET['customer_name'])) {
    $customer_id = $_GET['customer_id'];
    $customer_name = $_GET['customer_name'];

    // Display a warm welcome message in a green Bootstrap success alert
    echo '<div class="my-0 alert alert-success alert-dismissible fade show" role="alert">
    <strong>Logged in successfully!</strong> Welcome back ' . $customer_name . '!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
} else {
    // Redirect back to login page if customer_id or customer_name is not provided
    header("Location: login.php");
    exit();
}
?>



<?php
    require 'assets/partials/_functions.php';
    $conn = db_connect();    

    if(!$conn) 
        die("Connection Failed");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <!-- Font-awesome -->
    <script src="https://kit.fontawesome.com/d8cfbe84b9.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- CSS -->
    <?php 
        require 'assets/styles/styles.php'
    ?>
</head>
<body>
    <?php
    
    if(isset($_GET["booking_added"]) && !isset($_POST['pnr-search']))
    {
        if($_GET["booking_added"])
        {
            echo '<div class="my-0 alert alert-success alert-dismissible fade show" role="alert">
                <strong>Successful!</strong> Booking Added, your PNR is <span style="font-weight:bold; color: #272640;">'. $_GET["pnr"] .'</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        else{
            // Show error alert
            echo '<div class="my-0 alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Booking already exists+
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pnr-search"]))
    {
        $pnr = $_POST["pnr"];

        $sql = "SELECT * FROM bookings WHERE booking_id='$pnr'";
        $result = mysqli_query($conn, $sql);

        $num = mysqli_num_rows($result);

        if($num)
        {
            $row = mysqli_fetch_assoc($result);
            $route_id = $row["route_id"];
            $customer_id = $row["customer_id"];
            
            $customer_name = get_from_table($conn, "customers", "customer_id", $customer_id, "customer_name");

            $customer_phone = get_from_table($conn, "customers", "customer_id", $customer_id, "customer_phone");

            $customer_route = $row["customer_route"];
            $booked_amount = $row["booked_amount"];

            $booked_seat = $row["booked_seat"];
            $booked_timing = $row["booking_created"];

            $dep_date = get_from_table($conn, "routes", "route_id", $route_id, "route_dep_date");

            $dep_time = get_from_table($conn, "routes", "route_id", $route_id, "route_dep_time");

            $bus_no = get_from_table($conn, "routes", "route_id", $route_id, "bus_no");
            ?>

            <div class="alert alert-dark alert-dismissible fade show" role="alert">
            
            <h4 class="alert-heading">Booking Information!</h4>
            <p>
                <button class="btn btn-sm btn-success"><a href="assets/partials/_download.php?pnr=<?php echo $pnr; ?>" class="link-light">Download</a></button>
                <button class="btn btn-danger btn-sm" id="deleteBooking" data-bs-toggle="modal" data-bs-target="#deleteModal" data-pnr="<?php echo $pnr;?>" data-seat="<?php echo $booked_seat;?>" data-bus="<?php echo $bus_no; ?>">
                    Delete
                </button>
            </p>
            <hr>
                <p class="mb-0">
                    <ul class="pnr-details">
                        <li>
                            <strong>PNR : </strong>
                            <?php echo $pnr; ?>
                        </li>
                        <li>
                            <strong>Customer Name : </strong>
                            <?php echo $customer_name; ?>
                        </li>
                        <li>
                            <strong>Customer Phone : </strong>
                            <?php echo $customer_phone; ?>
                        </li>
                        <li>
                            <strong>Route : </strong>
                            <?php echo $customer_route; ?>
                        </li>
                        <li>
                            <strong>Bus Number : </strong>
                            <?php echo $bus_no; ?>
                        </li>
                        <li>
                            <strong>Booked Seat Number : </strong>
                            <?php echo $booked_seat; ?>
                        </li>
                        <li>
                            <strong>Departure Date : </strong>
                            <?php echo $dep_date; ?>
                        </li>
                        <li>
                            <strong>Departure Time : </strong>
                            <?php echo $dep_time; ?>
                        </li>
                        <li>
                            <strong>Booked Timing : </strong>
                            <?php echo $booked_timing; ?>
                        </li>

                </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php }
        else{
            echo '<div class="my-0 alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Record Doesnt Exist
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        
    ?>
        
    <?php }


        // Delete Booking
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteBtn"]))
        {
            $pnr = $_POST["id"];
            $bus_no = $_POST["bus"];
            $booked_seat = $_POST["booked_seat"];

            $deleteSql = "DELETE FROM `bookings` WHERE `bookings`.`booking_id` = '$pnr'";

                $deleteResult = mysqli_query($conn, $deleteSql);
                $rowsAffected = mysqli_affected_rows($conn);
                $messageStatus = "danger";
                $messageInfo = "";
                $messageHeading = "Error!";

                if(!$rowsAffected)
                {
                    $messageInfo = "Record Doesn't Exist";
                }

                elseif($deleteResult)
                {   
                    $messageStatus = "success";
                    $messageInfo = "Booking Details deleted";
                    $messageHeading = "Successfull!";

                    // Update the Seats table
                    $seats = get_from_table($conn, "seats", "bus_no", $bus_no, "seat_booked");

                    // Extract the seat no. that needs to be deleted
                    $booked_seat = $_POST["booked_seat"];

                    $seats = explode(",", $seats);
                    $idx = array_search($booked_seat, $seats);
                    array_splice($seats,$idx,1);
                    $seats = implode(",", $seats);

                    $updateSeatSql = "UPDATE `seats` SET `seat_booked` = '$seats' WHERE `seats`.`bus_no` = '$bus_no';";
                    mysqli_query($conn, $updateSeatSql);
                }
                else{

                    $messageInfo = "Your request could not be processed due to technical Issues from our part. We regret the inconvenience caused";
                }

                // Message
                echo '<div class="my-0 alert alert-'.$messageStatus.' alert-dismissible fade show" role="alert">
                <strong>'.$messageHeading.'</strong> '.$messageInfo.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
    ?>

    
    <header>
        <nav>
            <div>
                    <a href="#" class="nav-item nav-logo">SBTMS</a>
                    <!-- <a href="#" class="nav-item">Gallery</a> -->
            </div>
                
            <ul>
                <li><a href="#" class="nav-item">Home</a></li>
                <li><a href="about.php" class="nav-item">About</a></li>
                <li><a href="contact.php" class="nav-item">Contact</a></li>
            </ul>
            <div>
                <a href="index.php"><i class="fas fa-sign-in-alt" style="margin-right: 0.4rem;"></i>Logout</a>
                <?php
echo '<div style="padding-bottom: 5px;">';
echo '<strong>Customer ID :</strong> ' . htmlspecialchars($customer_id);
echo '</div>';
?>

            </div>
        </nav>
    </header>
    <!-- Login Modal -->
    <?php require 'assets/partials/_loginModal.php'; 
        require 'assets/partials/_getJSON.php';

        $routeData = json_decode($routeJson);
        $busData = json_decode($busJson);
        $customerData = json_decode($customerJson);
    ?>
    

    <section id="home">
        <div id="route-search-form">
            <h1 style="padding-bottom: 25px; font-weight:650;">Simple Bus Ticket Management System</h1>

            <p class="text-center">Welcome to Simple Bus Ticket Management System. Login now to manage bus tickets and much more or simply scroll down to check the Ticket status using Passenger Name Record (PNR number) and if you don't have a PNR code then just follow the steps below and in seconds you'll get you tickets.</p>

            

            <br>
            <center>
            <a href="#pnr-enquiry"><button class="btn btn-primary">Buy Ticket! <i class="fa fa-arrow-down"></i></button></a>
            </center>
            
        </div>
    </section>
    <div id="block">
        <section id="info-num">
            <figure>
                <img src="assets/img/route.svg" alt="Bus Route Icon" width="100px" height="100px">
                <figcaption>
                    <span class="num counter" data-target="<?php echo count($routeData); ?>">999</span>
                    <span class="icon-name">routes</span>
                </figcaption>
            </figure>
            <figure>
                <img src="assets/img/bus.svg" alt="Bus Icon" width="100px" height="100px">
                <figcaption>
                    <span class="num counter" data-target="<?php echo count($busData); ?>">999</span>
                    <span class="icon-name">bus</span>
                </figcaption>
            </figure>
            <figure>
                <img src="assets/img/customer.svg" alt="Happy Customer Icon" width="100px" height="100px">
                <figcaption>
                    <span class="num counter" data-target="<?php echo count($customerData); ?>">999</span>
                    <span class="icon-name">happy customers</span>
                </figcaption>
            </figure>
            <figure>
                <img src="assets/img/ticket.svg" alt="Instant Ticket Icon" width="100px" height="100px">
                <figcaption>
                    <span class="num"><span class="counter" data-target="30">999</span> SEC</span> 
                    <span class="icon-name">Instant Tickets</span>
                </figcaption>
            </figure>
        </section>
        <section id="pnr-enquiry">
            <div id="pnr-form">
                <h2>PNR ENQUIRY</h2>
                <form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST">
                    <div>
                        <input type="text" name="pnr" id="pnr" placeholder="Enter PNR">
                    </div>
                    <button type="submit" name="pnr-search">Submit</button>
                </form>
            </div>
        </section>
        <section id="about" style="margin-bottom: 25px;">
            <div>
              
                <h2 style="padding-bottom:10px;">Booking Instructions</h2>
                <hr>
  
  <p><strong>Step 1:</strong> Copy your <strong>Customer ID</strong> from the header and paste it into the Customer ID field once you click <strong>ADD BOOKING</strong>.</p>
  
  <p><strong>Step 2:</strong> After pasting your Customer ID, your information should automatically fill up. Next, choose the destination you want to travel to and select your desired seat on the bus.</p>
  
  <p><strong>Step 3:</strong> Hit the submit button to generate a <strong>PNR code</strong>. Copy this PNR code and paste it into the <strong>PNR ENQUIRY</strong> field, then hit submit again.</p>
  
  <p>You should now be able to download your ticket.</p>    </div>
        </section>
        







































<!--********************************************************* Booking Section Starts Here **************************************************************************** -->





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
        <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d8cfbe84b9.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- External CSS -->
    <?php
        require 'assets/styles/admin.php';
        require 'assets/styles/admin-options.php';
        $page="booking";
    ?>
</head>
<body>

<!-- Add, Edit and Delete Bookings -->
<?php
        /*
            1. Check if an admin is logged in
            2. Check if the request method is POST
        */
        
            if(isset($_POST["submit"]))
            {
                /*
                    ADDING Bookings
                 Check if the $_POST key 'submit' exists
                */
                // Should be validated client-side
                // echo "<pre>";
                // var_export($_POST);
                // echo "</pre>";
                // die;
                $customer_id = $_POST["cid"];
                $customer_name = $_POST["cname"];
                $customer_phone = $_POST["cphone"];
                $route_id = $_POST["route_id"];
                $route_source = $_POST["sourceSearch"];
                $route_destination = $_POST["destinationSearch"];
                $route = $route_source . " &rarr; " . $route_destination;
                $booked_seat = $_POST["seatInput"];
                $amount = $_POST["bookAmount"];
                // $dep_timing = $_POST["dep_timing"];

                $booking_exists = exist_booking($conn,$customer_id,$route_id);
                $booking_added = false;
        
                if(!$booking_exists)
                {
                    // Route is unique, proceed
                    $sql = "INSERT INTO `bookings` (`customer_id`, `route_id`, `customer_route`, `booked_amount`, `booked_seat`, `booking_created`) VALUES ('$customer_id', '$route_id','$route', '$amount', '$booked_seat', current_timestamp());";

                    $result = mysqli_query($conn, $sql);
                    // Gives back the Auto Increment id
                    $autoInc_id = mysqli_insert_id($conn);
                    // If the id exists then, 
                    if($autoInc_id)
                    {
                        $key = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $code = "";
                        for($i = 0; $i < 5; ++$i)
                            $code .= $key[rand(0,strlen($key) - 1)];
                        
                        // Generates the unique bookingid
                        $booking_id = $code.$autoInc_id;
                        
                        $query = "UPDATE `bookings` SET `booking_id` = '$booking_id' WHERE `bookings`.`id` = $autoInc_id;";
                        $queryResult = mysqli_query($conn, $query);

                        if(!$queryResult)
                            echo "Not Working";
                    }

                    if($result)
                        $booking_added = true;
                }
    
                if($booking_added)
                {
                    // Show success alert
                    echo '<div class="my-0 alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Successful!</strong> Booking Added
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';

                    // Update the Seats table
                    $bus_no = get_from_table($conn, "routes", "route_id", $route_id, "bus_no");
                    $seats = get_from_table($conn, "seats", "bus_no", $bus_no, "seat_booked");
                    if($seats)
                    {
                        $seats .= "," . $booked_seat;
                    }
                    else 
                        $seats = $booked_seat;

                    $updateSeatSql = "UPDATE `seats` SET `seat_booked` = '$seats' WHERE `seats`.`bus_no` = '$bus_no';";
                    mysqli_query($conn, $updateSeatSql);
                }
                
            }
            if(isset($_POST["edit"]))
            {
                // EDIT BOOKING
                // echo "<pre>";
                // var_export($_POST);
                // echo "</pre>";die;
                $cname = $_POST["cname"];
                $cphone = $_POST["cphone"];
                $id = $_POST["id"];
                $customer_id = $_POST["customer_id"];
                $id_if_customer_exists = exist_customers($conn,$cname,$cphone);

                if(!$id_if_customer_exists || $customer_id == $id_if_customer_exists)
                {
                    $updateSql = "UPDATE `customers` SET
                    `customer_name` = '$cname',
                    `customer_phone` = '$cphone' WHERE `customers`.`customer_id` = '$customer_id';";

                    $updateResult = mysqli_query($conn, $updateSql);
                    $rowsAffected = mysqli_affected_rows($conn);
    
                    $messageStatus = "danger";
                    $messageInfo = "";
                    $messageHeading = "Error!";
    
                    if(!$rowsAffected)
                    {
                        $messageInfo = "No Edits Administered!";
                    }
    
                    elseif($updateResult)
                    {
                        // Show success alert
                        $messageStatus = "success";
                        $messageHeading = "Successfull!";
                        $messageInfo = "Customer details Edited";
                    }
                    else{
                        // Show error alert
                        $messageInfo = "Your request could not be processed due to technical Issues from our part. We regret the inconvenience caused";
                    }
    
                    // MESSAGE
                    echo '<div class="my-0 alert alert-'.$messageStatus.' alert-dismissible fade show" role="alert">
                    <strong>'.$messageHeading.'</strong> '.$messageInfo.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
                else{
                    // If customer details already exists
                    echo '<div class="my-0 alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Customer already exists
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }

            }
            
        ?>
        <?php
            $resultSql = "SELECT * FROM `bookings` WHERE customer_id ='$customer_id'";
                            
            $resultSqlResult = mysqli_query($conn, $resultSql);

            if(!mysqli_num_rows($resultSqlResult)){ ?>
                <!-- Bookings are not present -->
                <div class="container mt-4">
                    <div id="noCustomers" class="alert alert-dark " role="alert">
                        <h1 class="alert-heading">No Bookings Found!!</h1>
                        <p class="fw-light">Be the first person to add one!</p>
                        <hr>
                        <div id="addCustomerAlert" class="alert alert-success" role="alert">
                                Click on <button id="add-button" class="button btn-sm"type="button"data-bs-toggle="modal" data-bs-target="#addModal">ADD <i class="fas fa-plus"></i></button> to add a booking!
                        </div>
                    </div>
                </div>
            <?php }
            else { ?>   
            <section id="booking">
               
                <div id="booking-results">
                    <div>
                        <button id="add-button" class="button btn-sm"type="button"data-bs-toggle="modal" data-bs-target="#addModal">Add Bookings<i class="fas fa-plus"></i></button>
                    </div>
                    <div id="head">
                    <h4>Booking Status:</h4>
                </div>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <th>PNR</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Bus</th>
                            <th>Route</th>
                            <th>Seat</th>
                            <th>Amount</th>
                            <th>Departure</th>
                            <th>Booked</th>
                            <th>Actions</th>
                        </thead>
                        <?php
                            while($row = mysqli_fetch_assoc($resultSqlResult))
                            {
                                    // echo "<pre>";
                                    // var_export($row);
                                    // echo "</pre>";
                                $id = $row["id"];
                                $customer_id = $row["customer_id"];
                                $route_id = $row["route_id"];

                                $pnr = $row["booking_id"];

                                $customer_name = get_from_table($conn, "customers","customer_id", $customer_id, "customer_name");
                                
                                $customer_phone = get_from_table($conn,"customers","customer_id", $customer_id, "customer_phone");

                                $bus_no = get_from_table($conn, "routes", "route_id", $route_id, "bus_no");

                                $route = $row["customer_route"];

                                $booked_seat = $row["booked_seat"];
                                
                                $booked_amount = $row["booked_amount"];

                                $dep_date = get_from_table($conn, "routes", "route_id", $route_id, "route_dep_date");

                                $dep_time = get_from_table($conn, "routes", "route_id", $route_id, "route_dep_time");

                                $booked_timing = $row["booking_created"];
                        ?>
                        <tr>
                            <td>
                                <?php 
                                    echo $pnr;
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo $customer_name;
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo $customer_phone;
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo $bus_no;
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo $route;
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo $booked_seat;
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo '$'.$booked_amount;
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo $dep_date . " , ". $dep_time;
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo $booked_timing;
                                ?>
                            </td>
                            <td>
                            <button class="button btn-sm edit-button" data-link="<?php echo $_SERVER['REQUEST_URI']; ?>" data-customerid="<?php 
                                                echo $customer_id;?>" data-id="<?php 
                                                echo $id;?>" data-name="<?php 
                                                echo $customer_name;?>" data-phone="<?php 
                                                echo $customer_phone;?>" >Edit</button>
                              
                            </td>
                        </tr>
                        <?php 
                        }
                    ?>
                    </table>
                </div>
            </section>
            <?php } ?> 
        </div>
    </main>
    <!-- Requiring _getJSON.php-->
    <!-- Will have access to variables 
        1. routeJson
        2. customerJson
        3. seatJson
        4. busJson
        5. adminJson
        6. bookingJSON
    -->
    <?php require 'assets/partials/_getJSON.php';?>
    
    <!-- All Modals Here -->
    <!-- Add Booking Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Make Bookings</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addBookingForm" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                            <!-- Passing Route JSON -->
                            <input type="hidden" id="routeJson" name="routeJson" value='<?php echo $routeJson; ?>'>
                            <!-- Passing Customer JSON -->
                            <input type="hidden" id="customerJson" name="customerJson" value='<?php echo $customerJson; ?>'>
                            <!-- Passing Seat JSON -->
                            <input type="hidden" id="seatJson" name="seatJson" value='<?php echo $seatJson; ?>'>

                            <div class="mb-3">
                                <label for="cid" class="form-label">Customer ID</label>
                                <!-- Search Functionality -->
                                <div class="searchQuery">
                                    <input type="text" class="form-control searchInput" id="cid" name="cid">
                                    <div class="sugg">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="cname" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" id="cname" name="cname" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="cphone" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="cphone" name="cphone" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="routeSearch" class="form-label">Route</label>
                                <!-- Search Functionality -->
                                <div class="searchQuery">
                                    <input type="text" class="form-control searchInput" id="routeSearch" name="routeSearch">
                                    <div class="sugg">
                                    </div>
                                </div>
                            </div>
                            <!-- Send the route_id -->
                            <input type="hidden" name="route_id" id="route_id">
                            <!-- Send the departure timing too -->
                            <input type="hidden" name="dep_timing" id="dep_timing">

                            <div class="mb-3">
                                <label for="sourceSearch" class="form-label">Source</label>
                                <!-- Search Functionality -->
                                <div class="searchQuery">
                                    <input type="text" class="form-control searchInput" id="sourceSearch" name="sourceSearch">
                                    <div class="sugg">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="destinationSearch" class="form-label">Destination</label>
                                <!-- Search Functionality -->
                                <div class="searchQuery">
                                    <input type="text" class="form-control searchInput" id="destinationSearch" name="destinationSearch">
                                    <div class="sugg">
                                    </div>
                                </div>
                            </div>
                            <!-- Seats Diagram -->
                            <div class="mb-3">
                                <table id="seatsDiagram">
                                <tr>
                                    <td id="seat-1" data-name="1">1</td>
                                    <td id="seat-2" data-name="2">2</td>
                                    <td id="seat-3" data-name="3">3</td>
                                    <td id="seat-4" data-name="4">4</td>
                                    <td id="seat-5" data-name="5">5</td>
                                    <td id="seat-6" data-name="6">6</td>
                                    <td id="seat-7" data-name="7">7</td>
                                    <td id="seat-8" data-name="8">8</td>
                                    <td id="seat-9" data-name="9">9</td>
                                    <td id="seat-10" data-name="10">10</td>
                                </tr>
                                <tr>
                                    <td id="seat-11" data-name="11">11</td>
                                    <td id="seat-12" data-name="12">12</td>
                                    <td id="seat-131" data-name="13">13</td>
                                    <td id="seat-14" data-name="14">14</td>
                                    <td id="seat-15" data-name="15">15</td>
                                    <td id="seat-16" data-name="16">16</td>
                                    <td id="seat-17" data-name="17">17</td>
                                    <td id="seat-18" data-name="18">18</td>
                                    <td id="seat-19" data-name="19">19</td>
                                    <td id="seat-20" data-name="20">20</td>
                                </tr>
                                <tr>
                                        <td class="space">&nbsp;</td>
                                        <td class="space">&nbsp;</td>
                                        <td class="space">&nbsp;</td>
                                        <td class="space">&nbsp;</td>
                                        <td class="space">&nbsp;</td>
                                        <td class="space">&nbsp;</td>
                                        <td class="space">&nbsp;</td>
                                        <td class="space">&nbsp;</td>
                                        <td class="space">&nbsp;</td>
                                        <td class="space">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td id="seat-21" data-name="21">21</td>
                                    <td id="seat-22" data-name="22">22</td>
                                    <td id="seat-23" data-name="23">23</td>
                                    <td id="seat-24" data-name="24">24</td>
                                    <td id="seat-25" data-name="25">25</td>
                                    <td id="seat-26" data-name="26">26</td>
                                    <td id="seat-27" data-name="27">27</td>
                                    <td class="space">&nbsp;</td>
                                    <td id="seat-28" data-name="28">28</td>
                                    <td id="seat-29" data-name="29">29</td>
                                </tr>
                                <tr>
                                    <td id="seat-30" data-name="30">30</td>
                                    <td id="seat-31" data-name="31">31</td>
                                    <td id="seat-32" data-name="32">32</td>
                                    <td id="seat-33" data-name="33">33</td>
                                    <td id="seat-34" data-name="34">34</td>
                                    <td id="seat-35" data-name="35">35</td>
                                    <td id="seat-36" data-name="36">36</td>
                                    <td class="space">&nbsp;</td>
                                    <td id="seat-37" data-name="37">37</td>
                                    <td id="seat-38" data-name="38">38</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto">
                                    <label for="seatInput" class="col-form-label">Seat Number</label>
                                </div>
                                <div class="col-auto">
                                    <input type="text" id="seatInput" class="form-control" name="seatInput" readonly>
                                </div>
                                <div class="col-auto">
                                    <span id="seatInfo" class="form-text">
                                    Select from the above figure, Maximum 1 seat.
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="bookAmount" class="form-label">Total Amount</label>
                                <input type="text" class="form-control" id="bookAmount" name="bookAmount" readonly>
                            </div>
                            <button type="submit" class="btn btn-success" name="submit">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <!-- Add Anything -->
                    </div>
                    </div>
                </div>
        </div>
        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-circle"></i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center pb-4">
                    Are you sure?
                </h2>
                <p>
                    Do you really want to delete this booking? <strong>This process cannot be undone.</strong>
                </p>
                <!-- Needed to pass id -->
                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="delete-form"  method="POST">
                    <input id="delete-id" type="hidden" name="id">
                    <input id="delete-booked-seat" type="hidden" name="booked_seat">
                    <input id="delete-route-id" type="hidden" name="route_id">
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="delete-form" name="delete" class="btn btn-danger">Delete</button>
            </div>
            </div>
        </div>
    </div>
    <script src="assets/scripts/admin_booking.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>

        
        <footer style="background-color: black; color:white;">
        <p>
                        <i class="far fa-copyright"></i> <?php echo date('Y');?> - Simple Bus Ticket Management System
                        </p>
        </footer>
    </div>
    
    <!-- Delete Booking Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-circle"></i></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <h2 class="text-center pb-4">
                    Are you sure?
            </h2>
            <p>
                Do you really want to delete your booking? <strong>This process cannot be undone.</strong>
            </p>
            <!-- Needed to pass pnr -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="delete-form"  method="POST">
                    <input id="delete-id" type="hidden" name="id">
                    <input id="delete-booked-seat" type="hidden" name="booked_seat">
                    <input id="delete-booked-bus" type="hidden" name="bus">
            </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="delete-form" class="btn btn-primary btn-danger" name="deleteBtn">Delete</button>
      </div>
    </div>
  </div>
</div>
     <!-- Option 1: Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- External JS -->
    <script src="assets/scripts/main.js"></script>
</body>
</html>









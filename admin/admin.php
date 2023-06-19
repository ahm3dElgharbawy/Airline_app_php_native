<?php 
    session_start();
    if(!isset($_SESSION['admin'])){
        header("Location:../user/index.php");
        exit();
    }
    include_once "../connect.php";
    include "../functions/updateFlights.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link rel="stylesheet" href="../admin styles/admin.css">
    <link rel="stylesheet" href="../styles/fontawsome/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Poppins:wght@600;700&family=Roboto:wght@100;300;400;500;900&display=swap" rel="stylesheet">

</head>
<body>
    <?php include "../includes/admin_nav.php"?>
    <div class="container">
        <div class="dashboard">
            <div class="main-section">
                <div class="dash dash-blue">
                    <div>
                        <i class="fa fa-user" aria-hidden="true" style="background-color: #2196f3;"></i><br>
                        Total Users
                        <p>
                        <?php 
                            $sql = "SELECT user_id FROM users";
                            echo $conn->query($sql)->num_rows;
                        ?>
                        </p>
                    </div>
                    
                </div>
                <div class="dash">
                    <div>
                        <i class="fa fa-users" aria-hidden="true" style="background-color: #34495E;"></i><br>
                        Total Passengers
                        <p>
                        <?php 
                            $sql = "SELECT passenger_id FROM passenger_information";
                            echo $conn->query($sql)->num_rows;
                        ?>
                        </p>
                    </div>
                    
                </div>
                <div class="dash dash-green">
                    <div>
                    <i class="fa-solid fa-dollar" aria-hidden="true" style="background-color: #16A085;"></i><br>
                        Total Money
                        <p>
                            <?php 
                                $sql = "SELECT cost FROM passenger_information,flight WHERE passenger_information.flight_id = flight.flight_id;";
                                $result = $conn->query($sql);
                                $nof_rows =$conn->query($sql)->num_rows;
                                $total_money = 0;
                                if($nof_rows > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $total_money += $row['cost'];
                                    }
                                }
                                echo "EGP ".$total_money;
                                
                            ?>
                        </p>
                    </div>
                    
                </div>
                <div class="dash dash-red">
                    <div>
                        <i class="fa fa-plane" aria-hidden="true" style="background-color: #E74C3C;"></i><br>
                        Total Flights
                        <p>
                            <?php 
                                $sql = "SELECT * FROM flight";
                                $result = $conn->query($sql);
                                $nof_rows = $result->num_rows;
                                echo $nof_rows
                            ?>
                        </p>
                    </div>
                </div>     
            </div>
            <div class="today">
                <h1 style="text-align: center;color: #818182;">TODAY FLIGHTS</h1>
                <div class="scrollable">
                    <table class="table">
                        <thead style="background-color: #343a40;color:white;">
                            <tr>
                                <th>#</th>
                                <th>Departure</th>
                                <th>Arrival</th>
                                <th>Source</th>
                                <th>Destination</th>
                                <th>Airport</th>
                                <th>Cost</th>
                                <th>Seats</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($nof_rows > 0){
                                    while($row = mysqli_fetch_assoc($result)){ // $row return false if no rows found in the table
                                        $dateAndTime = explode(' ',$row['departure_date']);
                                        $dateNow = date("Y-m-d");
                                        $row['departure_date'] = date('Y-m-d h:i:sa', strtotime($row['departure_date']));
                                        $row['arrival_date'] = date('Y-m-d h:i:sa', strtotime($row['arrival_date']));
                                        if($dateAndTime[0] == $dateNow){
                                            echo 
                                            "
                                                <tr>                  
                                                    <td><a href='passenger.php?flight_id=$row[flight_id]' style='color: rgb(0, 110, 255)'>$row[flight_id]</a></td>
                                                    <td>$row[departure_date]</td>
                                                    <td>$row[arrival_date]</td>
                                                    <td>$row[source]</td>
                                                    <td>$row[destination]</td>
                                                    <td>$row[airport]</td>
                                                    <td>EGP $row[cost]</td>
                                                    <td>$row[seats]</td>
                                                    <td>$row[status]</td>
                                            ";
                                            if($row['status']=='canceled'){
                                                echo 
                                                "
                                                    <td><button style='background-color: grey;cursor:auto'disabled>canceled</button></td>        
                                                </tr>
                                                ";
                                            }
                                            else{
                                                echo 
                                                "
                                                    <td><a href='../functions/cancelFlight.php?flight_id=$row[flight_id]'><button>Cancel</button></a></td>        
                                                </tr>
                                                ";
                                            }
                                        }
                                    }
                                }
                                
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/style.js"></script>
</body>
</html>


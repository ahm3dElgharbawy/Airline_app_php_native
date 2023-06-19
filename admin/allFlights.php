<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>all flights</title>
    <link rel="stylesheet" href="../admin styles/allFlights.css">
    <link rel="stylesheet" href="../styles/fontawsome/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Poppins:wght@600;700&family=Roboto:wght@100;300;400;500;900&display=swap" rel="stylesheet">

</head>
<body>
    <?php include "../includes/admin_nav.php"?> 
    <div class="container">
        <h1 style="text-align: center;color: #818182;">ALL FLIGHTS</h1>
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
                        <th>Available Seats</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        include_once "../connect.php";
                        $sql = "SELECT * from flight";
                        $result = $conn->query($sql);
                        $nof_rows = $result->num_rows;
                        if($nof_rows > 0){
                            while($row = mysqli_fetch_assoc($result)){ // $row return false if no rows found in the table
                                $row['departure_date'] = date('Y-m-d h:i:sa', strtotime($row['departure_date']));
                                $row['arrival_date'] = date('Y-m-d h:i:sa', strtotime($row['arrival_date']));
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
                                        <td>$row[available_seats]</td>
                                        <td>$row[status]</td>
                                        <td><a href='../functions/deleteFlight.php?flight_id=$row[flight_id]'><button>Delete</button></a></td>    
                                    </tr>
                                ";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../js/style.js"></script>
</body>
</html>
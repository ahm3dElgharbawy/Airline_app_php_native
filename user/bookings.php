<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/greyNav.css">
    <link rel="stylesheet" href="../styles/bookings.css">
    <link rel="stylesheet" href="../styles/fontawsome/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Poppins:wght@600;700&family=Roboto:wght@100;300;400;500;900&display=swap" rel="stylesheet">
    <title>bookings</title>

</head>
<body>
    <!-- start nav -->
    <?php include "../includes/greyNav.php"?>
    <!-- end nav -->

    <?php 
        if(isset($_SESSION['user'])){
            include_once "../connect.php";
            $sql= "SELECT * from passenger_information where user_id = $_SESSION[id];";
            $result = $conn->query($sql);
            $nof_rows = $result->num_rows;
            if($nof_rows > 0){
                while($row = mysqli_fetch_assoc($result)){ // $row return false if no rows found in the table
                    $sql= "select * from flight  where flight_id = $row[flight_id];";
                    $res = $conn->query($sql);
                    $r = mysqli_fetch_assoc($res);
                    $r['source'] = strtoupper($r['source']);
                    $r['destination'] = strtoupper($r['destination']);
                    
                    $dep_date = explode(' ',date('Y-m-d h:i:s a', strtotime($r['departure_date'])));
                    $arr_date = explode(' ',date('Y-m-d h:i:s a', strtotime($r['arrival_date'])));
                    echo "
                        <div class='booked-ticket'>
                        <div class='head'>
                            <h2>saFari</h2>
                            <div style='text-align: center;'>
                                <h4 style='margin-top: 0;margin-bottom: 2px;'>FLIGHT</h4>
                                <h3 style='margin-bottom: 0'>$row[flight_id]</h3>
                            </div>
                        </div>
                        <div class='container'>
                            <div class='source-destination'>
                                <h1>$r[source]</h1>
                                <i class='fa-sharp fa-solid fa-plane'></i>
                                <h1>$r[destination]</h1>
                            </div>
                            <div class='time'>
                                <div class='departure-time'>
                                    <h4>DEPARTURE TIME</h4>
                                    <h3>$dep_date[1] $dep_date[2]</h3>
                                    
                                </div>
                                <div class='arrival-time'>
                                    <h4 style='text-align: right;'>ARRIVAL TIME</h4>
                                    <h3>$arr_date[1] $arr_date[2]</h3>
                                </div>
                            </div>
                            <div class='foot'>
                                <div class='details'>
                                    <div class='passenger-name'>
                                        <h4>PASSENGER</h4>
                                        <h3>$row[name]</h3>
                                    </div>
                                    <div class='date'>
                                        <h4>DEPARTURE DATE</h4>
                                        <h3>$dep_date[0]</h3>
                                        <h4>ARRIVAL DATE</h4>
                                        <h3>$arr_date[0]</h3>
                                    </div>
                                </div>
                                <a href='../functions/cancelTicket.php?passenger_id=$row[passenger_id]&flight_id=$row[flight_id]'><button type='submit'id='cancel' value='cancel'>CANCEL</button></a>
                            </div>
                        </div>
                    </div>
                    ";
                }
            }    
        }
    ?>
    <button id="myBtn" onclick="goTop()"><i class="fa fa-arrow-up"></i></button>
    <script src="../js/style.js"></script>
    <script src="../js/goTop.js"></script>
</body>
</html>
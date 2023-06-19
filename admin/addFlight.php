<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add flights</title>
    <link rel="stylesheet" href="../styles/fontawsome/all.min.css">
    <link rel="stylesheet" href="../admin styles/addFlight.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Poppins:wght@600;700&family=Roboto:wght@100;300;400;500;900&display=swap" rel="stylesheet">

</head>
<body>
    <?php include "../includes/admin_nav.php"?>

    <?php
        if(isset($_POST['submit'])){
            include_once "../connect.php";
            $dep_date = $_POST['departure-date'];
            $dep_time = $_POST['departure-time'];
            $arr_date = $_POST['arrival-date'];
            $arr_time = $_POST['arrival-time'];
            $source = $_POST['source'];
            $destination = $_POST['destination'];
            $airport = $_POST['airport'];
            $status = "not departed yet";
            $cost = $_POST['cost'];
            $seats = $_POST['seats'];
            $sql = "INSERT into flight(departure_date,arrival_date,source,destination,airport,status,cost,seats,available_seats) values ('$dep_date $dep_time','$arr_date $arr_time','$source','$destination','$airport','$status',$cost,$seats,$seats)"; // query 
            $result = mysqli_query($conn, $sql); // return true if insert statement done successfully else return false
            if ($result) {
                echo "<p class='status' style='color: #3c765e;background-color: #dff0d8;'>flight added successfully</p>";
            } else {
                echo "<p class='status' style='color: #a94442;background-color: #f2dede;'>added failed</p>";
            }
        }
    ?>

    <div class="container">
        <form class="flight_info" action="addFlight.php" method="post">
                <h1 style="text-align: center;color: white;padding: 30px 0;margin: 0;">Add Flight</h1>
                <div class="selection">
                    <select name="source">
                        <option selected>FROM</option>
                        <option value="Cairo">Cairo</option>
                        <option value="Alex">Alex</option>
                        <option value="Luxor">Luxor</option>
                        <option value="Aswan">Aswan</option>
                    </select>
                    <select name="destination">
                        <option selected>TO</option>
                        <option value="Riyadh">Riyadh</option>
                        <option value="Dubai">Dubai</option>
                        <option value="Amman">Amman</option>
                    </select>
                    <select name="airport" id="">
                        <option selected>SELECT AIRPORT</option>
                        <option value="Alex Airport">Alex Airport</option>
                        <option value="Cairo Airport">Cairo Airport</option>
                        <option value="Porg Elarab Airport">Porg Elarab Airport</option>
                        <option value="Luxor Airport">Luxor Airport</option>
                        <option value="Aswan Airport">Aswan Airport</option>
                        <option value="6th October Airport">6th October Airport</option>
                    </select>
                </div>
                <input type="number" placeholder="seats" name="seats" style="margin-right: 10px;" min="0" required>
                <input type="number" placeholder="cost" name="cost" style="margin-right: 10px;" min="0" required>
                <div class="date-time">
                        <label for="departure-date">departure</label>
                        <input type="date" name="departure-date" id="departure-date" required>
                        <input type="time" name="departure-time" required>
                </div>
                <div class="date-time">
                        <label for="arrival-date">arrival</label>
                        <input type="date"  name="arrival-date" id="arrival-date" required>
                        <input type="time"  name="arrival-time" required>                
                </div>
                <div style="text-align: center;">
                    <input type="submit" name="submit">
                </div>
        </form>
    </div>
    <script type="text/javascript" src="../js/style.js"></script>
</body>
</html>
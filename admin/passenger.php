<?php 
    include_once "../connect.php";
?>

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
        <h1 style="text-align: center;color: #818182;">All Passengers In The Flight <?php echo $_GET['flight_id']?></h1>
        <div class="scrollable">
            <table class="table">
                <thead style="background-color: #343a40;color:white;">
                    <tr>
                        <th>passenger id</th>
                        <th>passenger name</th>
                        <th>phone number</th>
                        <th>dob</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql = "SELECT * from passenger_information where flight_id = $_GET[flight_id]";
                        $result = $conn->query($sql);
                        $nof_rows = $result->num_rows;
                        if($nof_rows > 0){
                            while($row = mysqli_fetch_assoc($result)){ // $row return false if no rows found in the table
                                echo "
                                <tr>
                                    <td>$row[passenger_id]</td>
                                    <td>$row[name]</td>
                                    <td>$row[phone_no]</td>
                                    <td>$row[dob]</td> 
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
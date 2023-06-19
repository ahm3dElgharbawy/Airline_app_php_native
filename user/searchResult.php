<?php 
    session_start();
    if(isset($_POST["search"]) && $_POST["source"]!="FROM" && $_POST["destination"]!="TO" ){
        include_once "../connect.php";
        $sql = "SELECT * FROM flight where source='$_POST[source]' and destination='$_POST[destination]'";
        $result = $conn->query($sql);
        $nof_rows = $result->num_rows;
    }
    else{
        header('Location:index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/greyNav.css">
    <link rel="stylesheet" href="../styles/searchResult.css">
    <link rel="stylesheet" href="../styles/fontawsome/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Poppins:wght@600;700&family=Roboto:wght@100;300;400;500;900&display=swap" rel="stylesheet">
    <title>search result</title>
</head>
<body>
<?php include "../includes/greyNav.php"?>
<div class="container">
        <div class="search-result">
            <h1 style="text-align: center;color: #818182;"><?php echo 'Flights from '.$_POST['source'].' to '.$_POST['destination']?></h1>
            <div class="table-box"> 
            <!-- new edit overflow -->
            <table class="table">
                <thead style="background-color: #343a40;color:white;">
                    <tr>
                        <th>Airport</th>
                        <th>Departure</th>
                        <th>Arrival</th>
                        <th>cost</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if($nof_rows > 0){
                            while($row = mysqli_fetch_assoc($result)){ // $row return false if no rows found in the table and loop stop
                                    echo "
                                    <tr>                  
                                        <td>$row[airport]</td>
                                        <td>$row[departure_date]</td>
                                        <td>$row[arrival_date]</td>
                                        <td>EGP $row[cost]</td>
                                    ";
                                    if(isset($_SESSION['user'])){
                                        if($row['status']=='canceled'){
                                            echo "
                                                <td><button style='background-color: grey;cursor:auto'disabled>Canceled</button></td>        
                                            </tr>
                                            ";
                                        }
                                        else{
                                            echo "
                                                <td><a href='../user/buyTicket.php?flight_id=$row[flight_id]'><button>Buy</button></a></td>        
                                            </tr>
                                            ";
                                        }
                                    }
                                    else{
                                        echo "
                                            <td><p id='log-first'>login first</p></td>        
                                        </tr>
                                        ";
                                    }
                            }
                        }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <script src="../js/style.js"></script>
</body>
</html>
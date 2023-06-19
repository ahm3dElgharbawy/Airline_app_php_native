<?php 
    session_start();
    if(isset($_GET['flight_id'])){
        $_SESSION['flight_id'] = $_GET['flight_id'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/greyNav.css">
    <link rel="stylesheet" href="../styles/buyTicket.css">
    <!-- font awsome for icons -->
    <link rel="stylesheet" href="../styles/fontawsome/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Poppins:wght@600;700&family=Roboto:wght@100;300;400;500;900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include "../includes/greyNav.php"?>
    <div class="container">
        <?php 
            if(isset($_POST['buy']) && isset($_SESSION['user'])){
                include_once "../connect.php";
                
                $passenger_id = filter_var($_POST['passenger_id'],FILTER_SANITIZE_SPECIAL_CHARS);
                $passenger_name = filter_var($_POST['passenger_name'],FILTER_SANITIZE_SPECIAL_CHARS);
                $phone_number = filter_var($_POST['phone_number'],FILTER_SANITIZE_SPECIAL_CHARS);
                $card_no = filter_var($_POST['credit_card_no'],FILTER_SANITIZE_SPECIAL_CHARS);
                $dob = $_POST['dob'];
                $usr_id = $_SESSION['id'];
                $flight_id = $_SESSION['flight_id'];
                
                $q1 = "SELECT * from passenger_information where passenger_id = '$passenger_id'";
                $q2 = "SELECT * from payment where creditcard_no = '$card_no'";
                
                
                if(!is_numeric($passenger_id))
                    echo "<p class='status failed'>id not valid only numerical digits acceptable</p>";
                else if(!is_numeric($phone_number))
                    echo "<p class='status failed'>phone number not valid only numerical digits acceptable</p>";
                else if(!is_numeric($card_no))
                    echo "<p class='status failed'>credit card number not valid only numerical digits acceptable</p>";
                else if($conn->query($q1)->num_rows != 0)
                    echo "<p class='status failed'>passenger id already exist</p>";
                else if($conn->query($q2)->num_rows != 0)
                    echo "<p class='status failed'>credit card already exist try another one</p>";
                
                else {
                    $query= "SELECT available_seats from flight  where flight_id = $flight_id;";
                    $result = $conn->query($query);
                    $row = mysqli_fetch_assoc($result);
                    $row['available_seats']-=1;
                    $q = "UPDATE flight set available_seats = $row[available_seats]  where flight_id = $flight_id;";
                    $conn->query($q);
                    $row['available_seats']+=1;
                    if($row['available_seats']= 0){
                        echo "<p class='status failed'>sorry flight complete and there's no place for you</p>";
                    }
                    else{
                        $sql="INSERT into passenger_information(passenger_id,user_id,name,phone_no,dob,flight_id) values ('$passenger_id',$usr_id,'$passenger_name','$phone_number','$dob',$flight_id);";
                        $sql.="INSERT into payment(creditcard_no,user_id,passenger_id,flight_id) values ('$card_no',$usr_id,'$passenger_id',$flight_id);";
                        $sql.="INSERT into ticket(passenger_id,user_id,flight_id) values ('$passenger_id',$usr_id,$flight_id);";
                        $result = $conn->multi_query($sql);
                        sleep(2);
                        header("Location:index.php");
                    }
                }
            }
        ?>

        <div class="ticket">
            <form class="inputs" method="post" action="buyTicket.php"> <!-- form -->
                <input type="text" placeholder="passenger id" name="passenger_id" minlength="14" maxlength="14" required >
                <input type="text" placeholder="passenger name" name="passenger_name" required>
                <input type="text" placeholder="phone number" name="phone_number" minlength="11" maxlength="11" required>
                <input type="text" placeholder="credit card no" name="credit_card_no" minlength="16" maxlength="16" required>
                <input type="date" placeholder="date of birth" name="dob" required>
                <?php 
                    if(isset($_SESSION['user'])){
                        echo "<input type='submit' value='Buy' name='buy'>";
                    }
                    else{
                        echo "<button id='login-to-buy' disabled>login to buy</button>";
                    }
                ?>
            </form>
        </div>
    </div>
    <script src="../js/style.js"></script>
</body>
</html>
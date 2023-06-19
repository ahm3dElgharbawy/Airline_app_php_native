<?php 
    if(isset($_GET['passenger_id'])){
        include_once "../connect.php";
        $sql = "DELETE FROM passenger_information WHERE passenger_id = '$_GET[passenger_id]'";
        $result = mysqli_query($conn,$sql);
        if($result){
            $query= "SELECT available_seats from flight  where flight_id = $_GET[flight_id];";
            $result = $conn->query($query);
            $row = mysqli_fetch_assoc($result);
            $row['available_seats']+=1;
            $q = "UPDATE flight set available_seats = $row[available_seats]  where flight_id = $_GET[flight_id];";
            $conn->query($q);
            header("Location:../user/bookings.php");
        }
    }
?>
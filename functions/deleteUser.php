<?php
    if(isset($_GET['user_id'])){
        include_once "../connect.php";
        $sq = "SELECT * from passenger_information,flight where passenger_information.flight_id = flight.flight_id and user_id = $_GET[user_id]";
        $result = $conn->query($sq);
        $nof_rows = $result->num_rows;
        if($nof_rows>0){
            while($row=mysqli_fetch_assoc($result)){
                $row['available_seats']+=1;
                $q = "UPDATE flight set available_seats = $row[available_seats]  where flight_id = $row[flight_id];";
                $conn->query($q);
            }
        }
        $sql = "DELETE FROM users WHERE user_id = $_GET[user_id]";
        $result = mysqli_query($conn,$sql);
        if($result){
            header("Location:../admin/allUsers.php");
        }
    }
?>
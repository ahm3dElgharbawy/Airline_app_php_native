<?php
    if(isset($_GET['flight_id'])){
        include_once "../connect.php";
        $sql = "DELETE FROM flight WHERE flight_id = $_GET[flight_id]";
        $result = mysqli_query($conn,$sql);
        if($result){
            header("Location:../admin/allFlights.php");
        }

    }

?>
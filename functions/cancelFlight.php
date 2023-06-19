<?php 
    if(isset($_GET['flight_id'])){
        include_once "../connect.php";
        $sql = "UPDATE flight SET status='canceled' where flight_id = $_GET[flight_id]";
        mysqli_query($conn,$sql);
        header("Location:../admin/admin.php");
    }

?>
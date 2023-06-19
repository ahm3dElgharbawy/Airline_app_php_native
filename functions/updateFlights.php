<?php 
    $sql = "SELECT * FROM flight where status != 'canceled';";
    $datenow = date('Y-m-d h:i:s');
    $result = $conn->query($sql);
    $nof_rows = $result->num_rows;
    if($nof_rows > 0){
        while($row = mysqli_fetch_assoc($result)){ 
            if($row['arrival_date'] < $datenow){
                $q = "UPDATE flight set status ='arrived insha allah' where flight_id = $row[flight_id]";
            }
            else if($row['departure_date']>$datenow){
                $q = "UPDATE flight set status ='not departed yet' where flight_id = $row[flight_id]";
            }
            else{
                $q = "UPDATE flight set status ='in the sky' where flight_id = $row[flight_id]";
            }
            $conn->query($q);
        }
    }
?>
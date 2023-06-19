<?php 
    if(isset($_GET['contact_id'])){
        include_once "../connect.php";
        $sql = "DELETE from contact where contact_id=$_GET[contact_id]";
        $conn->query($sql);
    }
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
        <h1 style="text-align: center;color: #818182;">ALL CONTACTS</h1>
        <div class="scrollable">
            <table class="table">
                <thead style="background-color: #343a40;color:white;">
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        include_once "../connect.php";
                        $sql = "SELECT * from contact";
                        $result = $conn->query($sql);
                        $nof_rows = $result->num_rows;
                        if($nof_rows > 0){
                            while($row = mysqli_fetch_assoc($result)){ // $row return false if no rows found in the table
                                echo "
                                <tr>
                                    <td style='color: rgb(0, 110, 255)'>$row[contact_id]</td>
                                    <td>$row[name]</td>
                                    <td>$row[email]</td>
                                    <td>$row[subject]</td>
                                    <td>$row[message]</td> 
                                    <td><a href='contacts.php?contact_id=$row[contact_id]'><button>Delete</button></a></td>   
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
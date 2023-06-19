<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
    <link rel="stylesheet" href="../styles/loginAndsignup.css">
    <!-- font awsome for icons -->
    <link rel="stylesheet" href="../styles/greyNav.css">
    <link rel="stylesheet" href="../styles/fontawsome/all.min.css">
    <script src="../js/all.min.js"></script>
</head>

<body>
    <?php include '../includes/greyNav.php'?>
    <div class="container">
        <div class="form">
            <h1 id="title">Login</h1>
            <?php
                if(isset($_POST["Login"])) {  
                    if($_POST['email'] == "admin@gmail.com" && $_POST['password'] == "adminadmin"){
                        session_start();
                        $_SESSION['admin'] = 'admin';
                        header("Location:../admin/admin.php");
                    }else{
                        include_once "../connect.php";
                        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
                        $password = filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS);
                        $sql = "SELECT * FROM users WHERE email='$email'";
                        $result = $conn->query($sql);  // do the query and store the result into $result variable 
                        $res = mysqli_fetch_assoc($result);
                        if ($result->num_rows > 0 && password_verify($password,$res['password'])) {
                            session_start();
                            $_SESSION["user"] = $res['username'];
                            $_SESSION['id'] = $res['user_id'];
                            header("Location:../user/index.php");
                        }
                        else{
                            echo "<p class='status failed'>wrong email or password you should register first</p>";
                        }
                    }
                }   
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <div id="log-in">
                    <div>
                        <input type="email" name="email" placeholder="Email Address" required>
                        <i class="fa-solid fa-envelope prefix"></i>
                    </div>
                    <div>
                        <input id="password" type="password" name="password" placeholder="Password" minlength="8" required>
                        <i class="fa-solid fa-lock prefix"></i>
                        <i class="fa-sharp fa-solid fa-eye-slash" aria-hidden="true" id="eye" onclick="toggle()" style="color: #7a797e;"></i>
                    </div>
                    <!-- <a class="forgot" href="#">forgot password?</a> -->
                    <input type="submit" name="Login" value="login" id="login">
                </div>
            </form>
            <p>not have an account? <a href="signUp.php">sign up </a> </p>
        </div>
    </div>
    <script src="../js/style.js"></script>
    <script>
        var state = false;
        function toggle(){
            if(state){
                document.getElementById("password").setAttribute("type","password");
                document.getElementById("eye").style.color = "#7a797e";
                document.getElementById("eye").setAttribute("class","fa-sharp fa-solid fa-eye-slash");
                state = false;
            }
            else{
                document.getElementById("password").setAttribute("type","text");
                document.getElementById("eye").style.color = "#2196f3";
                document.getElementById("eye").setAttribute("class","fa fa-eye");
                state = true;
            }
        }
    </script>
</body>

</html>
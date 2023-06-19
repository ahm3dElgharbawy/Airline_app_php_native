<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up page</title>
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
            <h1 id="title">Sign up</h1>
            <?php
                if (isset($_POST["Signup"])) {
                    include_once "../connect.php";
                    $username = filter_var($_POST['username'], FILTER_SANITIZE_EMAIL);
                    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                    $password = filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS);
                    $conf_password = filter_var($_POST['confirm-password'],FILTER_SANITIZE_SPECIAL_CHARS);
                    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                    $sql = "SELECT * from users where email = '$email'"; // select matching emails to check email exist or not
                    $nof_rows = $conn->query($sql)->num_rows;
                    if($nof_rows != 0){
                        echo "<p class='status failed'>email already exist choose another one</p>";
                    }
                    else if($password != $conf_password){
                        echo "<p class='status failed'>password and confirm password are not the same</p>";
                    } else{
                        $sql = "INSERT INTO users(username,email,password) VALUES ('$username','$email','$hashed_password')"; // query 
                        $result = mysqli_query($conn, $sql); // return true if insert statement done successfully else return false
                        if($result){
                            // echo "<p class='status done'>sing up done successfully now login</p>";
                            sleep(2);
                            header("Location:login.php");
                        }else{
                            echo "<p class='status failed'>sorry failed to sign up</p>";
                        }
                    }
                }
            ?>
            <form action="signUp.php" method="post">
                <div id="sign-up">
                    <div>
                        <input type="text" name="username" placeholder="Name" required>
                        <i class="fa-solid fa-user prefix"></i>
                    </div>
                    <div>
                        <input type="email" name="email" placeholder="E-mail" required>
                        <i class="fa-solid fa-envelope prefix"></i>
                    </div>
                    <div>
                        <input id="password1" type="password" name="password" placeholder="Password" minlength="8" required>
                        <i class="fa-solid fa-lock prefix"></i>
                        <i class="fa-sharp fa-solid fa-eye-slash" aria-hidden="true" id="eye1" onclick="toggle1()"></i>
                    </div>
                    <div>
                        <input id="password2" type="password" name="confirm-password" placeholder="Confirm password"  minlength="8" required>
                        <i class="fa-solid fa-check prefix"></i>
                        <i class="fa-sharp fa-solid fa-eye-slash" aria-hidden="true" id="eye2" onclick="toggle2()"></i>
                    </div>
                    <input type="submit" name="Signup" value="sign up" id="sign">
                </div>
            </form>
            <p>you have an account? <a href="login.php">login</a></p>
    
        </div>
    </div>
    <script src="../js/style.js"></script>
    <script>
        var state = false;
        function toggle1(){
            if(state){
                document.getElementById("password1").setAttribute("type","password");
                document.getElementById("eye1").style.color = "#7a797e";
                document.getElementById("eye1").setAttribute("class","fa-sharp fa-solid fa-eye-slash");
                state = false;
            }
            else{
                document.getElementById("password1").setAttribute("type","text");
                document.getElementById("eye1").style.color = "#2196f3";
                document.getElementById("eye1").setAttribute("class","fa fa-eye");
                state = true;
            }
        }
        function toggle2(){
            if(state){
                document.getElementById("password2").setAttribute("type","password");
                document.getElementById("eye2").style.color = "#7a797e";
                document.getElementById("eye2").setAttribute("class","fa-sharp fa-solid fa-eye-slash");
                state = false;
            }
            else{
                document.getElementById("password2").setAttribute("type","text");
                document.getElementById("eye2").style.color = "#2196f3";
                document.getElementById("eye2").setAttribute("class","fa fa-eye");
                state = true;
            }
        }
    </script>
</body>
</html>
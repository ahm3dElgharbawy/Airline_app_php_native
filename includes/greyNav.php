<nav class="navbar" id="topnavid">
    <a href="../user/index.php" class="logo"><img class="logo_img" width=70 src="../images/Wlogo.png" alt="SafriLogo"/></a>
    <div class="nav-links">
        <ul class="nav-menu">
        <li><a href="../user/index.php">Home</a></li>
        <?php
            if(isset($_SESSION["user"])){
                echo"<li>
                        <i class='ml-1 fa fa-user text-light' aria-hidden='true' style='color:white;font-size: 20px;'></i>
                        <span style='font-size: 20px;margin-left: 2px;color:white'>$_SESSION[user]</span>
                    </li>"; // username
                echo"<li>
                        <a href='../functions/logout.php' class='user'>
                            <button id='logout' style='cursor:pointer;'>logout</button>
                        </a>
                    </li>"; // logout
            }
            else{
                echo"<li>
                        <a href='../auth/login.php' class='log' style='cursor:pointer'>login</a>
                    </li>"; // login
            }
        ?>
        </ul>
        <div class="icon-bars">
            <a href="javascript:void(0);" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </div>
</nav>
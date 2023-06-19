<?php   
  session_start();
  include_once "../connect.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/style.css" />
    <link rel="stylesheet" href="../styles/home.css" />
    <!-- font awsome for icons -->
    <link rel="stylesheet" href="../styles/fontawsome/all.min.css">
    <!--- website main font -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Poppins:wght@600;700&family=Roboto:wght@100;300;400;500;900&display=swap" rel="stylesheet">
    <title>saFari</title>
  </head>
  <body>
    <!--Start NavBar -->
    <nav class="navbar" id="topnavid">
      <a href="index.php" class="logo"><img class="logo_img" width=70 src="../images/Wlogo.png" alt="SafriLogo"/></a>
      <div class="nav-links">
      <ul class="nav-menu">
          <li><a href="../user/index.php" class="active">Home</a></li>
          <?php
              if(isset($_SESSION["user"])){
                  echo '<li><a href="../user/bookings.php">Bookings</a></li>';
              }
          ?>
          <li><a href="../user/contactUs.php">Contact us</a></li>
          <?php
              if(isset($_SESSION["user"])){
                  echo"<li class='iconUser'>
                          <i class='ml-1 fa fa-user text-light' aria-hidden='true'></i>
                          <span style='font-size: 20px;margin-left: 2px;'>$_SESSION[user]</span>
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
    <!--End NavBar -->
    
    <!--Start Header -->
    <header class="header">
        <div class="flight-search">
          <form class="flight_info" action="searchResult.php" method="post"> <!-- form -->
              <h1 style="text-align: center;color: white;padding: 30px 0;margin: 0;">Search On Flight</h1>
              <div class="selection">
                <select name="source">
                    <option selected>FROM</option>
                    <option value="Cairo">Cairo</option>
                    <option value="Alex">Alex</option>
                    <option value="Luxor">Luxor</option>
                    <option value="Aswan">Aswan</option>
                </select>
                <select name="destination">
                    <option selected>TO</option>
                    <option value="Riyadh">Riyadh</option>
                    <option value="Dubai">Dubai</option>
                    <option value="Amman">Amman</option>
                </select>
              </div>
              <!-- <div class="date">
                      <label for="arrival-date">arrival</label>
                      <input type="date"  name="arrival-date" id="arrival-date">
              </div> -->
              <div style="text-align: center;">
                  <input type="submit" value="search" name="search">
              </div>
          </form>
        </div>
        <button id="myBtn" onclick="goTop()"><i class="fa fa-arrow-up"></i></button>
    </header>
    <!--End Header -->

    <!--Start Offer Section -->
    <div class="sectiont-header pd-y">
      <!-- title-->
      <h2 class="section-title">Special offers</h2>
      <span class="line"></span>
    </div>
    <div class="offer">
      <div class="offer_contents">
      <?php 
          $sql = "SELECT * from flight where cost<2000";
          $result = $conn->query($sql);
          $nof_rows = $result->num_rows;
          if($nof_rows > 0){
              while($row = mysqli_fetch_assoc($result)){ // $row return false if no rows found in the table
                  $row['source'] = strtoupper($row['source']);
                  $row['destination'] = strtoupper($row['destination']);
                  echo "
                  <a href='buyTicket.php?flight_id=$row[flight_id]' style='color: black;'>
                  <div class='features'>
                    <div class='feature feature-one'>
                      <h2 class='feature__title'>$row[destination]</h2>
                      <p class='feature__desc'>
                        From <span style='color: #03a9f4;font-weight: bold;'>$row[source]</span> my plane will take off, Don't wait to book your flight
                      </p>
                      <h2 class='feature__price'>$row[cost] EGP</h2>
                    </div>
                  </div>
                  </a>
                  ";
              }
          }
      ?>
      </div>
    </div>
    <!--End Offer Section-->
    <!--Start About Section -->
    <div class="sectiont-header pd-y">
      <!-- title-->
      <h2 class="section-title">About Us</h2>
      <span class="line"></span>
    </div>
    <div class="about">
      <div class="about_item">
        <div class="text_about">
          <h2 class="title_about">
            About <span class="blue_title_about">Our Website</span>
          </h2>
          <p class="desc_about">
            safari is the special-owned flag carrier of us. The airline is at
            Cairo International Airport , We transport passengers inside Egypt
            and all over the Middle East. if you want to book a flight ticket
            login in our website. if you need any help ,contact us with contact
            link in the navbar.
          </p>
        </div>
        <div class="img_about">
          <img class="about-image" src="../images/about.webp" alt="About Photo" style="width: 100%;" />
        </div>
      </div>
    </div>
    <!--End About Section -->
    <footer>
      <h3 style="color: white">Copyright &copy; saFari 2022-<?php echo date("Y");?></h3>
    </footer>
    <script type="text/javascript" src="../js/style.js"></script>
    <script src="../js/goTop.js"></script>
  </body>
</html>

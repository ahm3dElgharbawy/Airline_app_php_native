<nav class="navbar" id="topnavid" >
    <a class="logo" href="admin.php">
        <h3>ADMIN PANEL</h3>
    </a>
    <ul class="tabs">
        <li>
            <a href="admin.php" style="margin-top: 0;">
                Dashboard
            </a>
        </li>
        <li>
            <a href="addFlight.php">
                Add Flight
            </a>
        </li>
        <li>
            <a href="allFlights.php">
                List Flights
            </a>
        </li>
        <li>
            <a href="allUsers.php">
                Manage Users
            </a>
        </li>
        <li>
            <a href="contacts.php">
                Contacts
            </a>
        </li>
    </ul>
    <ul class="icon" style="align-items: center;column-gap:10px;padding: 0;">
        <li>
            <i class="ml-1 fa fa-user text-light" aria-hidden="true"></i>
            <span style="font-size: 20px;">admin</span>
        </li>
        <a href="../functions/logout.php"><button id="logout">logout</button></a>
            <!-- << respons Navbar >> -->
    </ul> 
    <div class="icon-bars">
        <a href="javascript:void(0);" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</nav>
<?php
include_once 'database.php';
?>

<header class="main-header">
    <style>
        @media (max-width: 767px) {
            .sidebar-toggle {
                display: block; /* Show the toggle button in mobile view */
            }
        }
        .main-header .sidebar-toggle {
            float: left; /* Float the toggle button to the left */
            background-color: transparent; /* Transparent background */
            background-image: none; /* No background image */
            padding: 15px 15px; /* Padding for the toggle button */
            font-family: fontAwesome; /* Assuming fontAwesome is the font used for icons */
        }

        /* Media query for responsiveness */
        @media (max-width: 767px) {
            .main-header .sidebar-toggle {
                display: block; /* Show the toggle button in mobile view */
                float: none; /* Remove float for mobile view */
                padding: 5px; /* Adjust padding for mobile view */
            }
        }
    </style>

    <!-- Logo -->

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="dist/img/avatar5.png" class="user-image" alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs" style="color:black;"><?php echo $_SESSION['user']; ?></span>
                    </a>

                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">
                            <p>
                                <?php //echo $_SESSION['user']; ?>
                                <small><?php echo $_SESSION['role']; ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="logout.php" class="btn btn-default btn-flat" style="background-color: black; color: white;">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>


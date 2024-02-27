<style>
/* Style for the dropdown menu */
.dropdown-menu {
    display: none;
    position: absolute;
    background-color: #fff; /* Set the background color as needed */
    border: 1px solid #ccc; Set the border color as needed */
    padding: 10px;
}

/* Style for the dropdown menu items */
.dropdown-menu li {
    list-style: none;
}

/* Show the dropdown menu on hover */
.nav-item:hover .dropdown-menu {
    display: block;
}
.user-class{
    position: fixed;
    background-color: #f0f0f0;
     border-top: 1px solid #ddd;
       
}
.teckydata{
    margin-bottom:45vh;
}


</style>
<aside class="main-sidebar">

    <section class="sidebar">
        <div class="logo">
            <img src="dist/img/Teckybot TM2.png" alt="Logo">
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li id="stat">
                <a href="./" class="a-link">
                    <img src="dist/img/analytics" alt="stat Image" style="margin-right: 10px;">
                    <!-- Adjust the margin value as needed -->
                    <span style="color: black;">STATISTICS</span>
                </a>
            </li>

            <?php if($_SESSION['role']=='admin'){ ?>
            <li id="teacher">
                <a href="./teacher.php" class="a-link">
                    <img src="dist/img/tutor" alt="Tutor Image" style="margin-right: 10px;">
                    <!-- Adjust the margin value as needed -->
                    <span style="color: black;">TUTOR INFO</span>
                </a>
            </li>
            
            <li id="new" class="nav-item ">
                <a href="#" class="a-link dropdown-toggle teckydata" data-toggle="dropdown">
                    <img src="dist/img/graduating" alt="Tecky Image" style="margin-right: 10px;">
                    <span style="color: black;">TECKY DATA</span>
                </a> 

                <!-- Dropdown menu -->
                <ul class="dropdown-menu dropdown-menu-right">

                    <li><a  href="./student.php">SCHOOL</a></li>
                    <li><a href="./college.php">COLLEGE</a></li>
                    <li><a href="./newteacher.php">TEACHER</a></li>
                </ul>
            </li>

            <li id="user" class="user-class">
                <a href="./user.php" class="a-link">
                    <i class="fa fa-user-plus" style="margin-right: 10px;"></i>
                    <!-- Adjust the margin value as needed -->
                    <span style="color: black;">USERS</span>
                </a>
            </li>




            <!-- <li id="new"><a href="./student.php"><i class="fa fa-users"></i> <span style="color: black;">TECKY DATA</span> </a></li> -->


            <?php }elseif ($_SESSION['role']=='teacher') {
          ?>

           
            <li id="new" class="nav-item">
                <a href="#" class="a-link dropdown-toggle" data-toggle="dropdown">
                    <img src="dist/img/graduating" alt="Tecky Image" style="margin-right: 10px;">
                    <span style="color: black;">TECKY DATA</span>
                </a> 

                <!-- Dropdown menu -->
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="./student.php">SCHOOL</a></li>
                    <li><a href="./college.php">COLLEGE</a></li>
                    <li><a href="./newteacher.php">TEACHER</a></li>
                </ul>
            </li>

            <?php }elseif ($_SESSION['role']=='student') { ?>
            <li id="student-par"><a href="./studentform.php"><i class="fa fa-users"></i> <span
                        style="color: black;">Student</span> </a></li>



            <?php

      }?>



        </ul>
        <!-- /.sidebar-menu -->


        
    </section>
    <!-- /.sidebar -->
</aside>

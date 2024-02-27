<?php
session_start();

include_once 'database.php';

if (!isset($_SESSION['user'])) {
    header('Location: ./page1.html');
    exit();
}

// Fetch School Students Count
$sqlSchool = "SELECT COUNT(*) as schoolCount FROM student";
$resultSchool = $conn->query($sqlSchool);

$schoolCount = 0;
if ($resultSchool->num_rows > 0) {
    $rowSchool = $resultSchool->fetch_assoc();
    $schoolCount = $rowSchool['schoolCount'];
}

// Fetch College Students Count
$sqlCollege = "SELECT COUNT(*) as collegeCount FROM college";
$resultCollege = $conn->query($sqlCollege);

$collegeCount = 0;
if ($resultCollege->num_rows > 0) {
    $rowCollege = $resultCollege->fetch_assoc();
    $collegeCount = $rowCollege['collegeCount'];
}



// Total Students Count
$totalStudentsCount = $schoolCount + $collegeCount;


// Fetch Teachers Count
$sqlTeachers = "SELECT COUNT(*) as teacherCount FROM newteacher";
$resultTeachers = $conn->query($sqlTeachers);

$teacherCount = 0;
if ($resultTeachers->num_rows > 0) {
    $rowTeachers = $resultTeachers->fetch_assoc();
    $teacherCount = $rowTeachers['teacherCount'];
}
// Fetch Total Tutors Count
$sqlTotalTutors = "SELECT COUNT(*) as totalTutors FROM teacher";
$resultTotalTutors = $conn->query($sqlTotalTutors);

$totalTutors = 0;
if ($resultTotalTutors->num_rows > 0) {
    $rowTotalTutors = $resultTotalTutors->fetch_assoc();
    $totalTutors = $rowTotalTutors['totalTutors'];
}



?>



<!DOCTYPE html>

<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Dashboard</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="icon" type="image/png" href="dist/img/favicon.ico">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">

    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
    .content-wrapper {
        background-color: #fff !important;
    }
    </style>
</head>


<body class="statis">
    <div class="wrapper-statis">

        <?php include_once 'sidebar.php'; ?>
        <?php include_once 'header.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header" style="display: flex; align-items: center;">
                <img src="dist/img/analytics 2.png" alt="Statistics Image"
                    style="max-width: 100%; height: auto; margin: 10px;">
                <h1 style="margin-left: 10px; color: #000; font-size: 36px; font-weight: 500; letter-spacing: 3.6px;">
                    STATISTICS</h1>
            </section>

            <!-- Main content -->
            </br>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="small-box">
                            <div class="inner">
                                <h3><?php echo $schoolCount; ?></h3>
                                <p>School Students</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="#" class="small-box-footer"><i class="fa fa-users"></i></a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="small-box">
                            <div class="inner">
                                <h3><?php echo $collegeCount; ?></h3>
                                <p>College Students</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="#" class="small-box-footer"><i class="fa fa-users"></i></a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="small-box">
                            <div class="inner">
                                <h3><?php echo $totalStudentsCount; ?></h3>
                                <p>Total Students</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="#" class="small-box-footer"><i class="fa fa-users"></i></a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="small-box">
                            <div class="inner">
                                <h3><?php echo $teacherCount; ?></h3>
                                <p> Teacher Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-black-tie"></i>
                            </div>
                            <a href="#" class="small-box-footer"><i class="fa fa-black-tie"></i></a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="small-box">
                            <div class="inner">
                                <h3><?php echo $totalTutors; ?></h3>
                                <p>Total Tutors</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-black-tie"></i>
                            </div>
                            <a href="#" class="small-box-footer"><i class="fa fa-black-tie"></i></a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <div class="control-sidebar-bg"></div>
    </div>


    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- Select2 -->


    <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- bootstrap color picker -->
    <script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page script -->



    <script>
    $('.select2').select2()
    $('#datepicker').datepicker({
        autoclose: true
    });



    var r = document.getElementById("stat");
    r.className += "active";
    </script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

</html>
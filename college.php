<?php
session_start();

include_once 'database.php';

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin' && $_SESSION['role'] != 'teacher') {
    header('Location:./logout.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $emailToDelete = $_GET['delete'];
    $sql = "DELETE FROM college WHERE cid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $emailToDelete);

    if ($stmt->execute()) {
        // echo "Deleted: " . $emailToDelete . "<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $stmt->error;
    }

    $stmt->close();
}



// Count the number of registered members
$countSql = "SELECT COUNT(*) as memberCount FROM college";
$countResult = $conn->query($countSql);
$memberCount = $countResult->fetch_assoc()['memberCount'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Collage_Students_data</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="icon" type="image/png" href="dist/img/favicon.ico">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">

    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
    .content-wrapper {
        background-color: #fff !important;
    }

    .student-container {
        background-color: #fff !important;
    }

    .table-striped>tbody>tr:nth-of-type(odd) {
        background: #F6F6F6 !important;
    }

    .input-sm {
        border-radius: 4px !important;
        border: 0.5px solid #1C1C1C !important;
    }

    .box {
        border-radius: 10px !important;

        box-shadow: 0px 0px 20px 1px #E3E3E3 !important;
    }

    .btn {
        border-radius: 5px !important;
        border: 1px solid #000 !important;
        width: 130px !important;
        height: 40px !important;

    }

    .box-button {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
        justify-content: space-between;
    }

    .table-bordered.custom-table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-bordered.custom-table td {
        border-left-color: #A1A1A1;
        border-right-color: #A1A1A1;


    }

    .table-bordered.custom-table th {
        border-top-color: #A1A1A1;
        border-left-color: #A1A1A1;
        border-right-color: #A1A1A1;
        border-bottom-color: #A1A1A1;
        border-bottom-width: 1px;

    }

    .table-bordered.custom-table {
        border-top-color: #A1A1A1;


    }
    </style>



</head>

<body class="student-container">
    <div class="wrapper">
        <?php include_once 'header.php'; ?>
        <?php include_once 'sidebar.php'; ?>



        <div class="content-wrapper">
            <section class="content">

            <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">

                        <?php
        // Check if the session role is 'admin'
        if (isset($_SESSION['user']) && ($_SESSION['role'] == 'admin')) {
        ?>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <div style="padding: 10px; margin-bottom: 10px;">
                                    <span style="margin: 0; font-size: 16px; font-weight: bold;">TOTAL COLLEGE TECKY
                                        DATA-
                                        <?php echo $memberCount; ?></span>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="table-responsive">




                                    <table id="example1" class="table table-bordered   custom-table table-striped">
                                        <thead>
                                            <tr>

                                                <th>NAME</th>
                                                <th>FATHER NAME</th>
                                                <th>CONTACT </th>
                                                <th>COLLEGE</th>
                                                <th>ACTION</th>


                                            </tr>
                                        </thead>

                                        <tbody>


                                            <?php

                  $sql = "SELECT * FROM college";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                   // output data of each row
                     while($row = $result->fetch_assoc()) {
                        $editButton = "<a href='collegeedit.php?cid=" . $row["cid"] . "' " .
                        "class='editBtn label bg-black' " .
                        "data-toggle='modal' " .
                        "data-target='#editCollegeModal'>" .
                        "Edit" .
                        "</a>";

                                            $deleteButton = "<a href='college.php?delete=" . $row["email"] . "' " .
                        " class='deleteBtn'>" .
                                                "<small class='label bg-black'>Delete</small>" .
                                                "</a>";
                                            echo "<tr>

                                                <td> ". $row["studentname"]. " </td>
                                                <td> ". $row["father_name"]. " </td>
                                                <td>" . $row["phone_no"]. "</td>
                                                <td>" . $row["college_name"]. "</td>
                                                <td>
                                                    $editButton

                                                    $deleteButton

                                                </td>
                                            </tr>";
                                            }
                                            }

                                            ?>


                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->

                            </div>
                        </div>
                        <?php
        }
        ?>
                        <div class="box-button">
                            <button id="uploadButton" class="btn btn-default " data-toggle="modal"
                                data-target="#addTeckyupload" style="background-color: white; color: black;">UPLOAD
                                DATA</button>
                            <button id="addTeckyButton" data-toggle="modal" data-target="#addTeckyModal"
                                class="btn btn-default " style="background-color: black; color: white;">ADD
                                TECKY</button>
                        </div>


                    </div>
                </div>
            </section>
        </div>
    </div>



    <!-- Add Tecky Modal -->
    <div class="modal fade" id="addTeckyModal" tabindex="-1" role="dialog" aria-labelledby="addTeckyModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding:10px">
                    <span aria-hidden="true">&times;</span>
                </button>

                <?php include_once 'collegeform.php'; ?>
            </div>
        </div>
    </div>
    <!-- Add Tecky Modal -->
     <!-- Add Tecky Modal -->
     <div class="modal fade" id="editCollegeModal" tabindex="-1" role="dialog" aria-labelledby="editCollegeModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding:10px">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php include_once 'collegeedit.php'; ?>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addTeckyupload" tabindex="-1" role="dialog" aria-labelledby="addTeckyModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-sm">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right:-60px">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php include_once 'collegeaskupload.php'; ?>
        </div>
    </div>



    <!-- Scripts -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="dist/js/demo.js"></script>

    <script>
    // Initialize DataTables with responsive option
    $(document).ready(function() {
        $('#example1').DataTable({
            responsive: true
        });
    });
    </script>
</body>

</html>
<?php
session_start();

include_once 'database.php';

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin' && $_SESSION['role'] != 'teacher') {
    header('Location:./logout.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $emailToDelete = $_GET['delete'];
    $sql = "DELETE FROM teacher WHERE email=?";
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
$countSql = "SELECT COUNT(*) as memberCount FROM teacher";
$countResult = $conn->query($countSql);
$memberCount = $countResult->fetch_assoc()['memberCount'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tutor data</title>
    <link rel="icon" type="image/png" href="dist/img/favicon.ico">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
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
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <div style="padding: 10px; margin-bottom: 10px;">
                                    <p style="margin: 0; font-size: 16px; font-weight: bold;">TOTAL TUTOR DATA:
                                        <?php echo $memberCount; ?></p>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered custom-table table-striped c">
                                        <thead>
                                            <tr>
                                                <th>TEACHER ID</th>
                                                <th>NAME</th>
                                                <th>CONTACT</th>
                                                <th>EMAIL</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM teacher";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    // Add the code snippet here to generate the "edit" button
                                                    $editButton = "<a href='teacheredit.php?tid=" . $row["tid"] . "' " .
                        "class='editBtn label bg-black' " .
                        "data-toggle='modal' " .
                        "data-target='#editTeacherModal'>" .
                        "Edit" .
                        "</a>";

                                                    $deleteButton = "<a href='teacher.php?delete=" . $row["email"] . "' " .
                                                        "class='deleteBtn'>" .
                                                        "<small class='label bg-black'>Delete</small>" .
                                                        "</a>";

                                                    echo "<tr>
                                                    <td>" . $row["tid"] . "</td>
                                                    <td>" . $row["fname"] . " " . $row["lname"] . "</td>
                                                    <td>" . $row["contact"] . "</td>
                                                    <td>" . $row["email"] . "</td>
                                                    <td>$editButton 
                                                    $deleteButton</td>
                                                    </tr>";
                                                }
                                            }
                                            ?>

                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="box-button pull-right">
                            <button data-toggle="modal" data-target="#addTeacherModal"
                                class="btn btn-default pull-right" style="background-color: black; color: white;">ADD
                                TUTOR</button>
                        </div>


                    </div>
                </div>
            </section>
        </div>
    </div>



    <!-- Add Tecky Modal -->
    <div class="modal fade" id="addTeacherModal" tabindex="-1" role="dialog" aria-labelledby="addTeckyModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding:10px">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php include_once 'teacherform.php'; ?>
            </div>
        </div>
    </div>
    <!-- Add Tecky Modal -->
    <div class="modal fade" id="editTeacherModal" tabindex="-1" role="dialog"
        aria-labelledby="editNewteacherModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding:10px">
                    <span aria-hidden="true">&times;</span>
                </button>


                <?php include_once 'teacheredit.php'; ?>
            </div>
        </div>
    </div>
    

   


    <!-- Scripts -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
 
    <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
   
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
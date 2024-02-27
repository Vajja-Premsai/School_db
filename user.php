<?php session_start(); 

include_once 'database.php';
if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header('Location: ./logout.php');
    exit(); // Added exit() to stop execution after redirect
}

if (isset($_GET['delete'])) {
    $sql = "DELETE FROM user WHERE email='" . $_GET['delete'] . "'";
    $conn->query($sql);
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
    <title>Add_User</title>
    <link rel="icon" type="image/png" href="dist/img/favicon.ico">
    <link rel="icon" href="../img/favicon2.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
.content-wrapper {
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
    justify-content: flex-end;
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

<body class="user">
    <div class="wrapper">

        <!-- Main Header -->
        <?php include_once 'header.php'; ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php include_once 'sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h2> Users Details</h2>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <!-- Form for adding a new user -->
                        <div class="box box-primary ">
                            <div class="box-header with-border">
                                <h3 class="box-title">New User</h3>
                            </div>
                            <form role="form" method="POST">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <select class="form-control select2" style="width: 100%;" tabindex="-1"
                                            aria-hidden="true" name="email">
                                            <option>Select Email</option>
                                            <?php
                  $sql = "SELECT email FROM teacher";

                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                   // output data of each row
                     while($row = $result->fetch_assoc()) {
                  echo "<option value='".$row["email"]."' > ".$row["email"]." </option>";
                       }
                        }
                  ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input name="password" type="text" class="form-control"
                                            id="exampleInputPassword1" placeholder="Enter Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Permission Role </label>
                                        <select class="form-control select2 select2-hidden-accessible"
                                            style="width: 100%;" tabindex="-1" aria-hidden="true" name="role">
                                            <option>Select Role</option>
                                            <option value="teacher">Teacher</option>
                                            <!-- <option value="student">Student</option> -->


                                        </select>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Add
                                        Result</button>
                                </div>
                            </form>

                            <?php
                            // Process form submission
                            if (isset($_POST['submit'])) {
                                $email = $_POST['email'];
                                $password = $_POST['password'];
                                $role = $_POST['role'];

                                try {
                                    $sql = "INSERT INTO user(email, password, role) VALUES ('$email', '$password', '$role')";
                                    if ($conn->query($sql) === TRUE) {
                                        echo "<script type='text/javascript'> var x = document.getElementById('truemsg'); x.style.display='block';</script>";
                                    } else {
                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                    }
                                } catch (Exception $e) {
                                    echo "Error: " . $e->getMessage();
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-md-8 col-xs-12">
                        <!-- Table showing all users -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">All Users</h3>
                            </div>
                            <div class="table-responsive">
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Email</th>
                                                <th>Permission Role</th>
                                                <th>Password</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT email, role, password FROM user";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $editButton = "<a href='useredit.php?email=" . $row["email"] . "' class='editBtn label bg-black' data-toggle='modal' data-target='#editUserModal'>Edit</a>";
                                                    $deleteButton = "<a href='user.php?delete=" . $row["email"] . "'><small class='label bg-red'>Delete</small></a>";
                                                    echo "<tr>
                                                          <td>" . $row["email"] . "</td>
                                                          <td>" . $row["role"] . "</td>
                                                          <td>" . $row["password"] . "</td>
                                                          <td>$editButton $deleteButton</td>
                                                        </tr>";
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="control-sidebar-bg"></div>
    </div>

    <!-- Add Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserrModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding:10px">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php include_once 'useredit.php'; ?>
            </div>
        </div>
    </div>

    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="dist/js/demo.js"></script>

    <script>
    $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })

    $('.select2').select2()
    $('#datepicker').datepicker({
        autoclose: true
    });

    var r = document.getElementById("user");
    r.className += "active";

    $('.timepicker').timepicker({
        showInputs: false
    })
    </script>
</body>

</html>
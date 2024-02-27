<?php session_start();

include_once 'database.php';
if (!isset($_SESSION['user'])||$_SESSION['role']!='student') {
  #code for update the a here...
  header('Location:./logout.php');
}
?>
<?php
$sid = $sFtudentname = $father_name = $school_name = $school_location = $student_location = $phone_no = $gender = " ";
if (isset($_GET['update'])) {
    $update = "SELECT * FROM student WHERE sid='" . $_GET['update'] . "'";
    $result = $conn->query($update);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $sid = $row['sid'];
            $studentname = $row['studentname'];
            $father_name = $row['father_name'];
            $school_name = $row['school_name'];
            $school_location = $row['school_location'];
            $student_location = $row['student_location'];
            $phone_no = $row['phone_no'];
            $email = $row['email'];
            $gender = $row['gender']; // father name,class,schoolname,school location,student location,phoneno,attended
        }
    }
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
    <title>Student</title>
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
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

        <!-- Main Header -->
        <?php include_once 'header.php'; ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php include_once 'sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Student
                    <small>Student Details</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Student</a></li>
                    <li class="active">Details</li>
                </ol>
            </section>

            <!-- Main content -->


            <section class="content">

                <div class="row">

                    <?php if (!isset($_GET['update'])) { ?>
                    <div class="col-xs-12">



                        <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success!</h4>
                            New Student Successfully added
                        </div>
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">New Student</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" method="POST">
                                <div class="box-body">
                                    <div class="row"></div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Student ID</label>
                                            <input name="sid" type="text" class="form-control"
                                                id="exampleInputPassword1" placeholder="Enter Student ID No" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Student Name</label>
                                            <input name="studentname" type="text" class="form-control"
                                                id="exampleInputPassword1" placeholder="Enter Student First Name"
                                                required>
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Father's Name</label>
                                            <input name="father_name" type="text" class="form-control"
                                                id="exampleInputPassword1" placeholder="Enter Father's Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">School Name</label>
                                            <input name="school_name" type="text" class="form-control"
                                                id="exampleInputPassword1" placeholder="Enter School Name">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">School Location</label>
                                            <input name="school_location" type="text" class="form-control"
                                                id="exampleInputPassword1" placeholder="Enter School Location">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Student Location</label>
                                            <input name="student_location" type="text" class="form-control"
                                                id="exampleInputPassword1" placeholder="Enter Student Location">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Phone Number</label>
                                            <input name="phone_no" type="text" class="form-control"
                                                id="exampleInputPassword1" placeholder="Enter Phone Number">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Gender</label>
                                            <div class="radio ">
                                                <label style="width: 100px"><input type="radio" name="gender"
                                                        value="Male" checked>Male</label>
                                                <label style="width: 100px"><input type="radio" name="gender"
                                                        value="Female" checked>Female</label>

                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Email</label>
                                            <input name="email" type="email" class="form-control"
                                                id="exampleInputPassword1" placeholder="Enter Student email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Attended for/Workshop/Summer camp
                                                :</label>
                                            <input name="attended_for" type="text" class="form-control"
                                                id="exampleInputPassword1" placeholder="Attended for" required>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Add
                                            Student</button>
                                    </div>
                                </div>
                            </form>

                            <?php if (isset($_POST['submit'])) {
                  $sid = $_POST['sid'];
                  $studentname = $_POST['studentname'];
                  $father_name = $_POST['father_name'];
                  $school_name = $_POST['school_name'];
                  $attended_for = $_POST['attended_for'];
                  $school_location = $_POST['school_location'];
                  $student_location = $_POST['student_location'];
                  $phone_no = $_POST['phone_no'];
                  $email = $_POST['email'];
                  $gender = $_POST['gender']; // $parent = $_POST['parent'];} // if(isset($_POST['parent'])){
                  // $parent=" ";
                  try {
                      $sql =
                          "INSERT INTO student (sid,studentname,gender,email,father_name,school_name,attended_for,school_location,student_location,phone_no) VALUES ('" .
                          $sid .
                          "', '" .
                          $studentname .
                          "','" .
                          $gender .
                          "','" .
                          $email .
                          "','" .
                          $father_name .
                          "','" .
                          $school_name .
                          "','" .
                          $attended_for .
                          "','" .
                          $school_location .
                          "','" .
                          $student_location .
                          "','" .
                          $phone_no .
                          "')";
                      if ($conn->query($sql) === true) {
                          echo "<script type='text/javascript'> var x = document.getElementById('truemsg');
x.style.display='block';</script>";
                      } else {
                      }
                  } catch (Exception $e) {
                  }
                  # code...
              } ?>



                        </div>
                    </div> <?php } elseif (isset($_GET['update'])) { ?>



                    <!--Update***** -->
                    <div class="col-xs-4">



                        <div class="alert alert-secondary alert-dismissible" style="display: none;" id="truemsg">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success!</h4>
                            Update Student Successfully
                        </div>
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Update Student</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" method="POST">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Student ID</label>
                                        <input name="sid" type="text" class="form-control" id="exampleInputPassword1"
                                            required value=<?php echo "'" . $sid . "'"; ?>>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Student Name</label>
                                        <input name="studentname" type="text" class="form-control"
                                            id="exampleInputPassword1" required
                                            value=<?php echo "'" . $studentname . "'"; ?>>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Father's Name</label>
                                        <input name="father_name" type="text" class="form-control"
                                            id="exampleInputPassword1" placeholder="Enter Father's Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">School Name</label>
                                        <input name="school_name" type="text" class="form-control"
                                            id="exampleInputPassword1" placeholder="Enter School Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">School Location</label>
                                        <input name="school_location" type="text" class="form-control"
                                            id="exampleInputPassword1" placeholder="Enter School Location">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Student Location</label>
                                        <input name="student_location" type="text" class="form-control"
                                            id="exampleInputPassword1" placeholder="Enter Student Location">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Phone Number</label>
                                        <input name="phone_no" type="text" class="form-control"
                                            id="exampleInputPassword1" placeholder="Enter Phone Number">
                                    </div>



                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Gender</label>
                                        <div class="radio ">
                                            <label style="width: 100px"><input type="radio" name="gender" value="Male" <?php if ($gender == 'Male') {
      echo 'checked';
  } ?>>Male</label>
                                            <label style="width: 100px"><input type="radio" name="gender" value="Female" <?php if ($gender == 'Female') {
      echo 'checked';
  } ?>>Female</label>

                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Email</label>
                                        <input name="email" type="email" class="form-control" id="exampleInputPassword1"
                                            required value=<?php echo "'" . $email . "'"; ?>>
                                    </div>






                                    <!-- <div class="form-group">
                 
                <label>Parent</label>
                <select name="parent" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" >
                 <option value="0">Select Parent</option>

                      <!-- <?php
                      $sql = "SELECT * FROM parent";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row
                          while ($row = $result->fetch_assoc()) {
                              echo "<option ";
                              if ($parent == $row["pid"]) {
                                  echo 'selected="selected"';
                              }
                              echo " value='" . $row["pid"] . "' >" . $row["studentname"] . " " . $row["lname"] . " - ID:" . $row["pid"] . "</option>";
                          }
                      }
                      ?> -->
                                    <!-- </select>
              
                </div> -->
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Update
                                        Student</button>
                                </div>
                            </form>

                            <?php if (isset($_POST['submit'])) {
                  $sid = $_POST['sid'];
                  $studentname = $_POST['studentname'];
                  $father_name = $_POST['father_name'];
                  $school_name = $_POST['school_name'];
                  $school_location = $_POST['school_location'];
                  $student_location = $_POST['student_location'];
                  $phone_no = $_POST['phone_no'];
                  $email = $_POST['email'];
                  $gender = $_POST['gender'];
                  // $parent = $_POST['parent'];
                  try {
                      $sql =
                          "UPDATE student set studentname='" .
                          $studentname .
                          "',father_name='" .
                          $father_name .
                          "',school_name='" .
                          $school_name .
                          "',school_location='" .
                          $school_location .
                          "',student_location='" .
                          $student_location .
                          "'phone_no='" .
                          $phone_no .
                          "',gender='" .
                          $gender .
                          "',email='" .
                          $email .
                          "' where sid='" .
                          $sid .
                          "'"; // $sql = "INSERT INTO student (sid,studentname,lname,bday,address,gender,parent,classroom) VALUES ('".$sid."', '".$studentname."', '".$lname."','".$dob."','".$address."','".$gender."','".$parent."','".$classroom."')";

                      if ($conn->query($sql) === true) {
                          echo "<script type='text/javascript'> var x = document.getElementById('truemsg');
x.style.display='block';</script>";
                      } else {
                      }
                  } catch (Exception $e) {
                  }
                  # code...
              } ?>
                        </div>
                    </div>


                    <?php } ?>


                    <!-- /.box -->



                </div>



            </section>

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?php include_once 'footer.php'; ?>

        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- Select2 -->
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


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
    </script>


    <script>
    $('.select2').select2()
    $('#datepicker').datepicker({
        autoclose: true
    });



    var r = document.getElementById("new");
    r.className += "active";
    </script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

</html>
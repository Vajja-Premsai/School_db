<?php
include_once 'database.php';

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch form data
    $tid = $_POST['tid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $worklocation = $_POST['worklocation'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    // Check if teacher ID or email already exists
    // $checkExisting = "SELECT * FROM Teacher WHERE tid=? OR email=?";
    // $stmtExisting = $conn->prepare($checkExisting);
    // $stmtExisting->bind_param("ss", $tid, $email);
    // $stmtExisting->execute();
    // $resultExisting = $stmtExisting->get_result();

    // if ($resultExisting->num_rows > 0) {
    //     while ($row = $resultExisting->fetch_assoc()) {
    //         if ($row['tid'] == $tid) {
    //             echo "<script type='text/javascript'> alert('Teacher ID already exists.'); </script>";
    //         }
    //         if ($row['email'] == $email) {
    //             echo "<script type='text/javascript'> alert('Email already exists.'); </script>";
    //         }
    //     }
    // } else {
        try {
            // Prepare and execute the SQL query
            $sql = "INSERT INTO Teacher (tid, fname, lname, worklocation, contact, email) 
                    VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $tid, $fname, $lname, $worklocation, $contact, $email);
            if ($stmt->execute()) {
                echo "<script type='text/javascript'> alert('Details successfully inserted.'); </script>";
            } else {
                echo "<script type='text/javascript'> alert('Error: " . $stmt->error . "'); </script>";
            }
            

            $stmt->close();
        } catch (Exception $e) {
            // Handle exceptions if any
            echo "Error: " . $e->getMessage();
        }
    }
// }
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tutor_form</title>
    <link rel="icon" type="image/png" href="dist/img/favicon.ico">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini">

    <section class="content">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <!-- <div class="box box-primary"> -->
                <h2 class="box-title" style="text-align:center">New Teacher</h2>
                <form role="form" method="POST" name="teacherForm" onsubmit="return validateForm()">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tutor ID</label>
                                    <input name="tid" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Teacher ID No" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">First Name</label>
                                    <input name="fname" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Teacher First Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input name="email" type="email" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Teacher email" required>
                                </div>


                            </div>

                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Worklocation</label>
                                    <input name="worklocation" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter Teacher worklocation" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Last Name</label>
                                    <input name="lname" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Teacher Last Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Contact</label>
                                    <input name="contact" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Teacher Contact No" required>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer" style="text-align:center">
                            <button type="submit" name="submit" value="submit" class="btn bg-black"
                                id="addTeacherBtn">Add Teacher</button>
                        </div>
                    </div>
                </form>
               

            </div>
        </div>
    </section>
   

    </div>

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
        function validateForm() {
            var firstName = document.forms["teacherForm"]["fname"].value.trim();
            var lastName = document.forms["teacherForm"]["lname"].value.trim();
            var email = document.forms["teacherForm"]["email"].value.trim();
            var contact = document.forms["teacherForm"]["contact"].value.trim();

            // Validation for first name
            if (!isValidName(firstName)) {
                alert("Name should contain only letters (both upper and lower case) and spaces.");
                return false;
            }

            // Validation for last name
            if (!isValidName(lastName)) {
                alert("Name should contain only letters (both upper and lower case) and spaces.");
                return false;
            }

            // Validation for email
            if (email === "" || !email.endsWith("@teckybot.com")) {
                alert("Please enter a valid email ending with @teckybot.com.");
                return false;
            }

            // Validation for contact number
            if (!isValidMobileNumber(contact)) {
                alert("Please enter a valid 10-digit mobile number.");
                return false;
            }

            return true;
        }

        function isValidName(name) {
            return /^[A-Za-z\s]+$/.test(name);
        }

        function isValidMobileNumber(number) {
            return /^\d{10}$/.test(number);
        }
    </script>


</body>

</html>
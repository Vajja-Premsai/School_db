<?php
include_once 'database.php';

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Turor_Register</title>
    <link rel="icon" type="image/png" href="dist/img/favicon.ico">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
.border {
    border: 0.2px solid #001;
    margin-top: 2%;
    padding: 2%;
}

.btn {
    color: white !important;
    background: black !important;
    margin: 10px;
}
.sid{
    display:none;
}
</style>



<body class="hold-transition skin-green sidebar-mini">
    <div>
        <button class=" pull-right"
            style="background-color: white; color: black; padding: 5px 10px; font-size: 18px; border:none"
            onclick="window.history.back()">
            &#10006;

        </button>
    </div>

    <section class="content ">

        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-md-10 col-md-offset-1 border ">

                <!-- <div class="box box-primary"> -->
                <h3 class="box-title" style="text-align:center; text-decoration:underline; margin-bottom:2%;">Teacher
                    Register</h3>

                <form role="form" method="POST" name="teckyForm" onsubmit="return validateForm()">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <!-- <div class="form-group">
                                    <label for="exampleInputPassword1">College Student ID</label> -->
                                <?php
                                   
                                    function generateTid($conn)
                                    {
                                        $datePart = date('ymd');
                                        $randomPart = sprintf("%04d", mt_rand(0, 999)); // Random 3-digit number with leading zeros
                                        $tid = 'TID' . $datePart . $randomPart;
                                    
                                        // Debug statements
                                       // echo "Generated CID: $tid<br>";
                                    
                                        // Check if the generated cID already exists in the database
                                        $checkSql = "SELECT * FROM newteacher WHERE tid = '$tid'";
                                        $checkResult = $conn->query($checkSql);
                                    
                                        // If the CID already exists, generate a new one recursively
                                        if ($checkResult && $checkResult->num_rows > 0) {
                                            echo "TID already exists in the database. Recursively generating a new one.<br>";
                                            return generateCid($conn);
                                        }
                                    
                                        // SID is unique, return it
                                      //  echo "Generated CID is unique.<br>";
                                        return $tid;
                                    }

                                    $newTid = generateTid($conn);
                                    echo '<input name="tid" type="text" class="sid" id="exampleInputPassword1" required value="' . $newTid . '" readonly>';
                                    ?>
                                <!-- </div> -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Teacher Name</label>
                                    <input name="teacher_name" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Age</label>
                                    <input name="age" type="number" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Your Age" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Gender</label>
                                    <div class="radio ">
                                        <label style="width: 100px"><input type="radio" name="gender" value="Male"
                                                checked>Male</label>
                                        <label style="width: 100px"><input type="radio" name="gender" value="Female"
                                                checked>Female</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Phone Number</label>
                                    <input name="phone_no" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Phone Number" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Address</label>
                                    <input name="address_location" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter Location" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Education</label>
                                    <input name="education" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Your Education" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Specialization</label>
                                    <input name="stream" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Your Stream" required>
                                </div>

                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Present Job</label>
                                    <input name="present_job" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter  Job">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Organization</label>
                                    <input name="organization" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter Your Organization">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Since in Current Org</label>
                                    <input name="since_current_org" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter Current Org">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Previous Organization</label>
                                    <input name="previous_org" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter Previous Org" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Skills Have</label>
                                    <input name="skills" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Your Skills" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Language Known</label>
                                    <input name="language" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Your Languages" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Future Interest</label>
                                    <input name="future_interest" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Your Interest" required>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="submit" name="submit" value="submit" class="btn  bg-black">SUBMIT</button>
                        </div>

                    </div>
                </form>

                <?php


if (isset($_POST['submit'])) {
    $tid=$_POST['tid'];
    $teacher_name = $_POST['teacher_name'];
    $age = $_POST['age'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : ""; // Handling radio button
    $phone_no = $_POST['phone_no'];
    $address_location = $_POST['address_location'];
    $education = $_POST['education'];
    $stream = $_POST['stream'];
    $present_job = $_POST['present_job'];
    $organization = $_POST['organization'];
    $since_current_org = $_POST['since_current_org'];
    $previous_org = $_POST['previous_org'];
    $skills = $_POST['skills'];
    $language = $_POST['language'];
    $future_interest = $_POST['future_interest'];

    try {
        $sql = "INSERT INTO newteacher (
                    tid, teacher_name, age, gender, phone_no, address_location, education,
                    stream, present_job, organization, since_current_org, previous_org,
                    skills, language, future_interest
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssssss",
            $tid, $teacher_name, $age, $gender, $phone_no, $address_location, $education,
            $stream, $present_job, $organization, $since_current_org, $previous_org,
            $skills, $language, $future_interest
        );

        if ($stmt->execute()) {
            echo "<script type='text/javascript'> window.location.href = 'success.html'; </script>";
            // You may consider redirecting the user to another page here
        } else {
            echo "<script type='text/javascript'> alert('Error: " . $stmt->error . "'); </script>";
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
                <script src="bower_components/jquery/dist/jquery.min.js"></script>
                <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
                <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
                <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
                <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
                <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
                <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
                <script src="plugins/iCheck/icheck.min.js"></script>
                <script src="bower_components/fastclick/lib/fastclick.js"></script>
                <script src="dist/js/adminlte.min.js"></script>
                <script src="dist/js/demo.js"></script>
                <script>
    function validateForm() {
        // Validating name
        var name = document.teckyForm.teacher_name.value;
        var namePattern = /^[a-zA-Z\s]+$/; // Allow upper and lower case letters and spaces
        if (!namePattern.test(name)) {
            alert("Teacher name should contain only letters and spaces.");
            return false;
        }

        // Validating age
        var age = document.teckyForm.age.value;
        if (isNaN(age) || age <= 0 || age > 150) {
            alert("Please enter a valid age.");
            return false;
        }

        // Validating phone number
        var phoneNo = document.teckyForm.phone_no.value;
        var phonePattern = /^\d{10}$/;
        if (!phonePattern.test(phoneNo)) {
            alert("Please enter a valid 10-digit phone number.");
            return false;
        }

        return true; // Form submitted if all validations pass
    }
</script>


</body>

</html>
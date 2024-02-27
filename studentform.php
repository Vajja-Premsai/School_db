<?php
include_once 'database.php';

    if (isset($_POST['submit'])) {
        $sid=$_POST['sid'];
        $studentname = $_POST['studentname'];
        $father_name = $_POST['father_name'];
        $school_name = $_POST['school_name'];
        $school_location = $_POST['school_location'];
        $pincode = $_POST['pincode'];
        $district = $_POST['district'];
        $phone_no = $_POST['phone_no'];
        $address_location = $_POST['address_location'];
        $age = $_POST['age'];
        $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
        $class = $_POST['class'];
        $attended_for = $_POST['attended_for'];

        try {
            $sql = "INSERT INTO student (sid, studentname, father_name, school_name, school_location,  pincode, district, phone_no, address_location, age, gender, class, attended_for) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssssssss", $sid, $studentname, $father_name, $school_name, $school_location,  $pincode, $district, $phone_no, $address_location, $age, $gender, $class, $attended_for);

            if ($stmt->execute()) {
                echo "<script type='text/javascript'>alert('Details successfully inserted.'); </script>";
                // You may consider redirecting the user to another page here
            } 

            $stmt->close();
        } catch (Exception $e) {
           // echo "Error: " . $e->getMessage();
        }
    }
    

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student_Form</title>
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
.sid {
    display: none;
}
</style>

<body class="hold-transition skin-green sidebar-mini">


    <div class="row">
        <div class="col-xs-10 col-md-offset-1">

            <h3 class="box-title" style="text-align:center; text-decoration:underline; margin-bottom:2%;">Student
                Register</h3>

            <form role="form" method="POST" name="teckyForm" onsubmit="return validateForm()">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <!-- <div class="form-group">
                     <label for="exampleInputPassword1">Student ID</label>  -->
                            <?php
                   
                    function generateSid($conn)
                    {
                        $datePart = date('ymd');
                        $randomPart = sprintf("%04d", mt_rand(0, 999)); // Random 3-digit number with leading zeros
                        $sid = 'SID' . $datePart . $randomPart;
                    
                        // Debug statements
                       // echo "Generated SID: $sid<br>";
                    
                        // Check if the generated SID already exists in the database
                        $checkSql = "SELECT * FROM student WHERE sid = '$sid'";
                        $checkResult = $conn->query($checkSql);
                    
                        // If the SID already exists, generate a new one recursively
                        if ($checkResult && $checkResult->num_rows > 0) {
                            echo "SID already exists in the database. Recursively generating a new one.<br>";
                            return generateSid($conn);
                        }
                    
                        // SID is unique, return it
                      //  echo "Generated SID is unique.<br>";
                        return $sid;
                    }

                    $newSid = generateSid($conn);
                    echo '<input name="sid" type="text" class="sid" id="exampleInputPassword1" required value="' . $newSid . '" readonly>';
                    ?>
                            <!-- </div> -->
                            <div class="form-group">
                                <label for="exampleInputPassword1">Student Name</label>
                                <input name="studentname" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Enter Student First Name" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Father's Name</label>
                                <input name="father_name" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Enter Father's Name" required>
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
                                    id="exampleInputPassword1" placeholder="Enter Student Location" required>
                            </div>



                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Class</label>
                                <input name="class" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Enter Student Class" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">School Name</label>
                                <input name="school_name" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Enter School Name" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">School Location</label>
                                <input name="school_location" type="text" class="form-control"
                                    id="exampleInputPassword1" placeholder="Enter School Location" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Area Pincode</label>
                                <input name="pincode" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Enter Area Pincode " required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">District</label>
                                <input name="district" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Enter District" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Attended for/Workshop/Summer camp:</label>
                                <input name="attended_for" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Attended for">
                            </div>
                        </div>

                    </div>
                    <div class="box-footer" style="text-align:center">
                        <button type="submit" name="submit" value="submit" class="btn  bg-black">SUBMIT</button>
                    </div>

                </div>
            </form>



            <!-- </div> -->
        </div>
    </div>

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 3 -->
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

        // Validating mobile number
        var mobileNumber = document.teckyForm.phone_no.value;
        var mobilePattern = /^\d{10}$/;
        if (!mobilePattern.test(mobileNumber)) {
            alert("Please enter a valid 10-digit mobile number.");
            return false;
        }

        // Validating name
        var name = document.teckyForm.studentname.value;
        var namePattern = /^[a-zA-Z\s]+$/; // Allow upper and lower case letters and spaces
        if (!namePattern.test(name)) {
            alert("Name should contain only letters (both upper and lower case) and spaces.");
            return false;
        }

        // Validating age
        var age = parseInt(document.teckyForm.age.value);
        if (isNaN(age) || age < 5 || age > 100) { // Adjust the range as needed
            alert("Please enter a valid age between 5 and 100.");
            return false;
        }
        // Validating pin code
        var pincode = document.teckyForm.pincode.value;
        var pincodePattern = /^\d{6}$/; // Assuming pin code is 6 digits
        if (!pincodePattern.test(pincode)) {
            alert("Please enter a valid 6-digit pin code.");
            return false;
        }

        // Additional validations can be added here if needed

        return true; // Form submitted if all validations pass
    }
    </script>

</body>


</html>
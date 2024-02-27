<?php
include_once 'database.php';

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student</title>
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
    padding:2%;
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
                <h3 class="box-title" style="text-align:center; text-decoration:underline; margin-bottom:2%;">Student Register</h3>

                <form role="form" method="POST" name="teckyForm" onsubmit="return validateForm()">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                             <!-- <div class="form-group">
                                    <label for="exampleInputPassword1">College Student ID</label> -->
                                    <?php
                                         function generateCid($conn)
                                         {
                                             $datePart = date('ymd');
                                             $randomPart = sprintf("%04d", mt_rand(0, 999)); // Random 3-digit number with leading zeros
                                             $cid = 'CID' . $datePart . $randomPart;
                                         
                                        // Debug statements
                                       // echo "Generated CID: $cid<br>";
                                    
                                        // Check if the generated cID already exists in the database
                                        $checkSql = "SELECT * FROM college WHERE cid = '$cid'";
                                        $checkResult = $conn->query($checkSql);
                                    
                                        // If the CID already exists, generate a new one recursively
                                        if ($checkResult && $checkResult->num_rows > 0) {
                                            echo "CID already exists in the database. Recursively generating a new one.<br>";
                                            return generateCid($conn);
                                        }
                                    
                                        // SID is unique, return it
                                      //  echo "Generated CID is unique.<br>";
                                        return $cid;
                                    }

                                    $newCid = generateCid($conn);
                                    echo '<input name="cid" type="text" class="sid" id="exampleInputPassword1" required value="' . $newCid . '" readonly>';
                                    ?>
                                <!-- </div>  -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Student Name</label>
                                    <input name="studentname" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter Student First Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Father's Name</label>
                                    <input name="father_name" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter Father's Name">
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
                                    <label for="exampleInputPassword1">Mail ID</label>
                                    <input name="email" type="email" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Student email" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Address</label>
                                    <input name="address" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter Student Location" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Education</label>
                                    <input name="education" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Your Education" required>
                                </div>

                            </div>
                            <div class="col-md-6 col-xs-12">
                               
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Stream/Domain</label>
                                    <input name="stream" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Your Year / Branch . eg: 1/cse" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">College Name</label>
                                    <input name="college_name" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter College Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">College Location</label>
                                    <input name="college_location" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter college Location" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Area Pincode</label>
                                    <input name="pincode" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter Area Pincode " required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">District</label>
                                    <input name="district" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter District" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Interested Field / Domain:</label>
                                    <input name="interested_field" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Attended for" >
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
                    $cid=$_POST['cid'];
                    $studentname = $_POST['studentname'];
                    $father_name = $_POST['father_name'];
                    $gender = isset($_POST['gender']) ? $_POST['gender'] : ""; // Handling radio button
                    $phone_no = $_POST['phone_no'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];
                    $education = $_POST['education'];
                    $stream = $_POST['stream'];
                    $college_name = $_POST['college_name'];
                    $college_location = $_POST['college_location'];
                    $pincode = $_POST['pincode'];
                    $district = $_POST['district'];
                    $interested_field = $_POST['interested_field'];
                
                    try {
                        $sql = "INSERT INTO college (
                                    cid, studentname, father_name, gender, phone_no, email, address,
                                    education, stream, college_name, college_location, pincode, district, interested_field
                                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ssssssssssssss", 
                            $cid, $studentname, $father_name, $gender, $phone_no, $email, $address,
                            $education, $stream, $college_name, $college_location, $pincode, $district, $interested_field
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

                <!-- </div> -->
            </div>
        </div>
    </section>

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
        // Validating email
        var email = document.teckyForm.email.value;
        var emailPattern = /\S+@\S+\.\S+/;
        if (!emailPattern.test(email) || email.indexOf('@gmail.com') === -1) {
            alert("Please enter a valid Gmail address.");
            return false;
        }

        // Validating phone number
        var phoneNo = document.teckyForm.phone_no.value;
        var phonePattern = /^\d{10}$/;
        if (!phonePattern.test(phoneNo)) {
            alert("Please enter a valid 10-digit phone number.");
            return false;
        }

        // Validating pin code
        var pincode = document.teckyForm.pincode.value;
        var pincodePattern = /^\d{6}$/; // Assuming pin code is 6 digits
        if (!pincodePattern.test(pincode)) {
            alert("Please enter a valid 6-digit pin code.");
            return false;
        }

        // Validating name
        var name = document.teckyForm.studentname.value;
        var namePattern = /^[a-zA-Z\s]+$/; // Allow upper and lower case letters only
        if (!namePattern.test(name)) {
            alert("Name should contain only letters (both upper and lower case).");
            return false;
        }

        return true; // Form submitted if all validations pass
    }
</script>

    
</body>

</html>
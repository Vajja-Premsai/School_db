<?php
include_once 'database.php';
$errors = [];
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['cid'])) {
    $editCid = $_GET['cid'];
    $editSql = "SELECT * FROM college WHERE cid = ?";
    $stmt = $conn->prepare($editSql);
    $stmt->bind_param("s", $editCid);
    $stmt->execute();
    $editResult = $stmt->get_result();

    if ($editResult->num_rows > 0) {
        $editRow = $editResult->fetch_assoc();
        $cid = $editRow['cid'];
        $studentname = $editRow['studentname'];
        $father_name = $editRow['father_name'];
        $gender = isset($editRow['gender']) ? $editRow['gender'] : "";
        $phone_no = $editRow['phone_no'];
        $email = $editRow['email'];
        $address = $editRow['address'];
        $education = $editRow['education'];
        $stream = $editRow['stream'];
        $college_name = $editRow['college_name'];
        $college_location = $editRow['college_location'];
        $pincode = $editRow['pincode'];
        $district = $editRow['district'];
        $interested_field = $editRow['interested_field'];
    } else {
        $errors[] = "college student not found for editing.";
        echo "Student not found for editing.";
    }
} 

// Process form submission for editing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $cid=$_POST['cid'];
    $studentname = $_POST['studentname'];
    $father_name = $_POST['father_name'];
    $gender =  $_POST['gender'] ;
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
    try{
    // Update the student data
    
    $sql = "UPDATE college SET studentname=?, father_name=?, gender=?, phone_no=?, email=?, address=?, education=?, stream=?, college_name=?, college_location=?, pincode=?, district=?, interested_field=? WHERE cid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssss", $studentname, $father_name, $gender, $phone_no, $email, $address, $education, $stream, $college_name, $college_location, $pincode, $district, $interested_field,$cid);

    if ($stmt->execute()) {
        // echo "<script type='text/javascript'> alert('Details successfully Updated.');</script>";
        // You may consider redirecting the user to another page here
    } else {
        echo "<script type='text/javascript'> alert('Error: " . $stmt->error . "'); </script>";
    }
    $stmt->close();
    } catch (Exception $e) {
        // Handle exceptions if any
        $errors[] = 'Error: ' . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Student Details</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="dist/img/favicon.ico">

    <!-- Add other stylesheets as needed -->
</head>

<body class="hold-transition skin-green sidebar-mini">
    <section class="content">
    <div>
        <button class=" pull-right"
            style="background-color: white; color: black; padding: 5px 10px; font-size: 18px; border:none"
            onclick="window.location.href='./college.php'">
            &#10006;

        </button>
    </div>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <h2 class="box-title" style="text-align:center">Edit College</h2>

                <!-- The form now has an action attribute to submit to itself -->

                <form role="form" method="POST" action="" name="teckyForm" onsubmit="return validateForm()">

                    <!-- Include a hidden input for the college ID -->
                    <input type="hidden" name="cid" value="<?php echo $cid; ?>">

                    <!-- Rest of the form remains unchanged -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Student Name</label>
                                    <input name="studentname" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter Student First Name"
                                        value="<?php echo $studentname; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Father's Name</label>
                                    <input name="father_name" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter Father's Name"
                                        value="<?php echo $father_name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Gender</label>
                                    <div class="radio ">
                                        <label style="width: 100px"><input type="radio" name="gender" value="Male"
                                                <?php echo ($gender === 'Male') ? 'checked' : ''; ?>>Male</label>
                                        <label style="width: 100px"><input type="radio" name="gender" value="Female"
                                                <?php echo ($gender === 'Female') ? 'checked' : ''; ?>>Female</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Phone Number</label>
                                    <input name="phone_no" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Phone Number" value="<?php echo $phone_no; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mail ID</label>
                                    <input name="email" type="email" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Student email" value="<?php echo $email; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Address</label>
                                    <input name="address" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Student Location" value="<?php echo $address; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Education</label>
                                    <input name="education" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Your Education" value="<?php echo $education; ?>" required>
                                </div>

                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Stream/Domain</label>
                                    <input name="stream" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Your Year / Branch . eg: 1/cse"
                                        value="<?php echo $stream; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">College Name</label>
                                    <input name="college_name" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter College Name"
                                        value="<?php echo $college_name; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">College Location</label>
                                    <input name="college_location" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter college Location"
                                        value="<?php echo $college_location; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Area Pincode</label>
                                    <input name="pincode" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Area Pincode " value="<?php echo $pincode; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">District</label>
                                    <input name="district" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter District" value="<?php echo $district; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Interested Field / Domain:</label>
                                    <input name="interested_field" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Attended for"
                                        value="<?php echo $interested_field; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="submit" name="submit" value="submit" class="btn  bg-black">Update
                                Student</button>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Rest of the script remains unchanged -->
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
         var name = document.teckyForm.studentname.value;
        var namePattern = /^[a-zA-Z\s]+$/; // Allow upper and lower case letters and spaces
        if (!namePattern.test(name)) {
            alert("Name should contain only letters (both upper and lower case).");
            return false;
        }
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

       

        return true; // Form submitted if all validations pass
    }
</script>
    
   
</body>

</html>
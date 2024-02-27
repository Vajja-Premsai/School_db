<?php
include_once 'database.php';
$errors = [];
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['sid'])) {
    $editSid = $_GET['sid'];
    $editSql = "SELECT * FROM student WHERE sid = ?";
    $stmt = $conn->prepare($editSql);
    $stmt->bind_param("s", $editSid);
    $stmt->execute();
    $editResult = $stmt->get_result();

    if ($editResult->num_rows > 0) {
        $editRow = $editResult->fetch_assoc();
        // Assign fetched values to variables for pre-populating the form
        $sid = $editRow['sid'];
        $studentname = $editRow['studentname'];
        $father_name = $editRow['father_name'];
        $age = $editRow['age'];
        $gender = $editRow['gender'];
        $phone_no = $editRow['phone_no'];
        $address_location = $editRow['address_location'];
        $class = $editRow['class'];
        $school_name = $editRow['school_name'];
        $school_location = $editRow['school_location'];
        $pincode = $editRow['pincode'];
        $district = $editRow['district'];
        $attended_for = $editRow['attended_for'];
    } else {
        // Handle case where student ID for editing is not found
        $errors[] = "Student not found for editing.";
        echo "Student not found for editing.";
    }
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate fields
    // Add your validation logic here

    // Fetch form data
    $sid = $_POST['sid'];
    $studentname = $_POST['studentname'];
    $father_name = $_POST['father_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone_no = $_POST['phone_no'];
    $address_location = $_POST['address_location'];
    $class = $_POST['class'];
    $school_name = $_POST['school_name'];
    $school_location = $_POST['school_location'];
    $pincode = $_POST['pincode'];
    $district = $_POST['district'];
    $attended_for = $_POST['attended_for'];

    try {
        // Update the student details in the database
        $sql = "UPDATE student SET 
            studentname=?, father_name=?, age=?, gender=?, phone_no=?, address_location=?,
            class=?, school_name=?, school_location=?, pincode=?, district=?, attended_for=?
            WHERE sid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssssssssss",
            $studentname,
            $father_name,
            $age,
            $gender,
            $phone_no,
            $address_location,
            $class,
            $school_name,
            $school_location,
            $pincode,
            $district,
            $attended_for,
            $sid
        );
        if ($stmt->execute()) {
            // echo "<script type='text/javascript'> alert('Details successfully updated.'); </script>";
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

<!-- Rest of your HTML code remains unchanged -->

<body class="hold-transition skin-green sidebar-mini">

    <section class="content">
    <div>
        <button class=" pull-right"
            style="background-color: white; color: black; padding: 5px 10px; font-size: 18px; border:none"
            onclick="window.location.href='./student.php'">
            &#10006;

        </button>
    </div>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">

                <h2 class="box-title" style="text-align:center">Edit Student</h2>

                <!-- The form now has an action attribute to submit to itself -->
                <form role="form" method="POST" action="" name="teckyForm" onsubmit="return validateForm()">
                    <!-- Include a hidden input for the student ID -->
                    <input type="hidden" name="sid" value="<?php echo $sid; ?>">

                    <!-- Rest of the form remains unchanged -->
                    <div class="box-body">
                        <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Student Name</label>
                                <input name="studentname" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Enter Student First Name" value="<?php echo $studentname; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Father's Name</label>
                                <input name="father_name" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Enter Father's Name" value="<?php echo $father_name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Age</label>
                                <input name="age" type="number" class="form-control" id="exampleInputPassword1"
                                    placeholder="Enter Student Age" value="<?php echo $age; ?>" required>
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
                                    placeholder="Enter Phone Number" value="<?php echo $phone_no; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Address</label>
                                <input name="address_location" type="text" class="form-control"
                                    id="exampleInputPassword1" placeholder="Enter Student Location"
                                    value="<?php echo $address_location; ?>">
                            </div>



                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Class</label>
                                <input name="class" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Enter Student Class" value="<?php echo $class; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">School Name</label>
                                <input name="school_name" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Enter School Name" value="<?php echo $school_name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">School Location</label>
                                <input name="school_location" type="text" class="form-control"
                                    id="exampleInputPassword1" placeholder="Enter School Location"
                                    value="<?php echo $school_location; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Area Pincode</label>
                                <input name="pincode" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Enter Pincode" value="<?php echo $pincode; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">District</label>
                                <input name="district" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Enter District" value="<?php echo $district; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Attended for/Workshop/Summer camp:</label>
                                <input name="attended_for" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Attended for" value="<?php echo $attended_for; ?>" required>
                            </div>
                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="submit" name="submit" value="submit" class="btn bg-black">Update
                                Student</button>
                        </div>
                    </div>
                    </div>
                </form>
                <!-- Display success or error message in a pop-up -->
            </div>
        </div>
    </section>
    <!-- Rest of your script remains unchanged -->
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
            alert("Name should contain only letters (both upper and lower case).");
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
<?php
include_once 'database.php';

$errors = [];
$successMessage = "";


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tid'])) {
    $editTid = $_GET['tid'];
    $editSql = "SELECT * FROM newteacher WHERE tid = ?";
    $stmt = $conn->prepare($editSql);
    $stmt->bind_param("s", $editTid); // Fix variable name typo here
    $stmt->execute();
    $editResult = $stmt->get_result();

    if ($editResult->num_rows > 0) {
        $editRow = $editResult->fetch_assoc();
        // Assign values retrieved from the database
        $tid = $editRow['tid'];
        $teacher_name = $editRow['teacher_name'];
        $age = $editRow['age'];
        $gender = $editRow['gender'];
        $phone_no = $editRow['phone_no'];
        $address_location = $editRow['address_location'];
        $education = $editRow['education'];
        $stream = $editRow['stream'];
        $present_job = $editRow['present_job'];
        $organization = $editRow['organization'];
        $since_current_org = $editRow['since_current_org'];
        $previous_org = $editRow['previous_org'];
        $skills = $editRow['skills'];
        $language = $editRow['language'];
        $future_interest = $editRow['future_interest'];
    } else {
        // Handle case where teacher ID for editing is not found
        $errors[] = "Teacher not found for editing.";
        echo "teacher not found for editing.";
    }
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debugging statement to check form data
    var_dump($_POST); // Remove this line after debugging

    // Validate fields
    // Add your validation logic here

    // Fetch form data
    $tid = $_POST['tid'];
    $teacher_name = $_POST['teacher_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
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
        $sql = "UPDATE newteacher SET teacher_name=?, age=?, gender=?, phone_no=?, address_location=?, 
                  education=?, stream=?, present_job=?, organization=?, since_current_org=?, 
                  previous_org=?, skills=?, language=?, future_interest=? WHERE tid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssssss", $teacher_name, $age, $gender, $phone_no, $address_location,
            $education, $stream, $present_job, $organization, $since_current_org,
            $previous_org, $skills, $language, $future_interest, $tid);

        if ($stmt->execute()) {
            // Update successful
            $successMessage = "Teacher details updated successfully.";
        } else {
            // Update failed
            $errors[] = "Error: " . $stmt->error;
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
            onclick="window.location.href='./newteacher.php'">
            &#10006;

        </button>
    </div>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">

            <h2 class="box-title" style="text-align:center">Edit Teacher</h2>

                <!-- The form now has an action attribute to submit to itself -->
                <form role="form" method="POST" action="" name="teckyForm" onsubmit="return validateForm()">
                    <!-- Include a hidden input for the student ID -->
                    <input type="hidden" name="tid" value="<?php echo $tid; ?>">

                    <!-- Rest of the form remains unchanged -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Teacher Name</label>
                                    <input name="teacher_name" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter Name" required
                                        value="<?php echo $teacher_name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Age</label>
                                    <input name="age" type="number" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Your Age" required value="<?php echo $age; ?>">
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
                                    <label for="exampleInputPassword1">Address</label>
                                    <input name="address_location" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter Location"
                                        value="<?php echo $address_location; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Education</label>
                                    <input name="education" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Your Education" value="<?php echo $education; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Specialization</label>
                                    <input name="stream" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Your Stream" value="<?php echo $stream; ?>" required>
                                </div>

                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Present Job</label>
                                    <input name="present_job" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter  Job"
                                        value="<?php echo $present_job; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Organization</label>
                                    <input name="organization" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter Your Organization"
                                        value="<?php echo $organization; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Since in Current Org</label>
                                    <input name="since_current_org" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter Current Org"
                                        value="<?php echo $since_current_org; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Previous Organization</label>
                                    <input name="previous_org" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter Previous Org"
                                        value="<?php echo $previous_org; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Skills Have</label>
                                    <input name="skills" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Your Skills" value="<?php echo $skills; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Language Known</label>
                                    <input name="language" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Your Languages" value="<?php echo $language; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Future Interest</label>
                                    <input name="future_interest" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Your Interest"
                                        value="<?php echo $future_interest; ?>" required>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="submit" name="submit" value="submit" class="btn bg-black">Update
                                Teacher</button>
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

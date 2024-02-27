<?php
include_once 'database.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tid'])) {
    $editTid = $_GET['tid'];
    $editSql = "SELECT * FROM teacher WHERE tid = ?";
    $stmt = $conn->prepare($editSql);
    $stmt->bind_param("s", $editTid); // Fix variable name typo here
    $stmt->execute();
    $editResult = $stmt->get_result();

    if ($editResult->num_rows > 0) {
        $editRow = $editResult->fetch_assoc();
        // Assign fetched values to variables for pre-populating the form
        $tid = $editRow['tid'];
        $fname = $editRow['fname'];
        $lname = $editRow['lname'];
        $contact = $editRow['contact'];
        $worklocation = $editRow['worklocation']; 
        $email = $editRow['email'];
    } else {
        // Handle case where teacher ID for editing is not found
        $errors[] = "Teacher not found for editing.";
        echo "teacher not found for editing.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch form data
    $tid = $_POST['tid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contact = $_POST['contact'];
    $worklocation = $_POST['worklocation'];
    $email = $_POST['email'];

    try {
        // Update the teacher details in the database
        $sql = "UPDATE teacher SET fname=?, lname=?, contact=?, worklocation=?, email=? WHERE tid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $fname, $lname, $contact, $worklocation, $email, $tid);
        
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

<!-- Rest of the HTML code remains unchanged -->

<body class="hold-transition skin-green sidebar-mini">
    <section class="content">
    <div>
        <button class=" pull-right"
            style="background-color: white; color: black; padding: 5px 10px; font-size: 18px; border:none"
            onclick="window.location.href='./teacher.php'">
            &#10006;

        </button>
    </div>
        <div class="row">
            
            <div class="col-xs-10 col-xs-offset-1">
                <h2 class="box-title" style="text-align:center">Edit Teacher</h2>

                <!-- The form now has an action attribute to submit to itself -->

                <form role="form" method="POST" name="teacherForm">

                    <!-- Include a hidden input for the teacher ID -->
                    <input type="hidden" name="tid" value="<?php echo $tid; ?>">

                    <!-- Rest of the form remains unchanged -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">

                                <div class="form-group">
                                    <label for="exampleInputPassword1">First Name</label>
                                    <input name="fname" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Teacher First Name" value="<?php echo $fname; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Last Name</label>
                                    <input name="lname" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Teacher Last Name" value="<?php echo $lname; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input name="email" type="email" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Teacher email" value="<?php echo $email; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Worklocation</label>
                                    <input name="worklocation" type="text" class="form-control"
                                        id="exampleInputPassword1" placeholder="Enter Teacher worklocation"
                                        value="<?php echo $worklocation; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Contact</label>
                                    <input name="contact" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Enter Teacher Contact No" value="<?php echo $contact; ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer" style="text-align:center">
                            <button type="submit" name="submit" value="submit" class="btn bg-black"
                                id="addTeacherBtn">Update Teacher</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
     <!-- <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>  -->
     <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script src="bower_components/fastclick/lib/fastclick.js"></script> 
    <!-- <script src="dist/js/adminlte.min.js"></script> -->
    <script src="dist/js/demo.js"></script> 
    
    <!-- <script>
        function validateForm() {
            var firstName = document.forms["teacherForm"]["fname"].value.trim();
            var lastName = document.forms["teacherForm"]["lname"].value.trim();
            var email = document.forms["teacherForm"]["email"].value.trim();
            var contact = document.forms["teacherForm"]["contact"].value.trim();

            // Validation for first name
         
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
    </script> -->
</body>

</html>
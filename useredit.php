<?php
include_once 'database.php';

$errors = [];
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['email'])) {
    $editUserEmail = $_GET['email'];
    $editSql = "SELECT * FROM user WHERE email = '$editUserEmail'";
    $editResult = $conn->query($editSql);

    if ($editResult->num_rows > 0) {
        $editRow = $editResult->fetch_assoc();
        // Assign fetched values to variables for pre-populating the form
        $email = $editRow['email'];
        $role = $editRow['role'];
        $password = $editRow['password'];
    } else {
        // Handle case where user email for editing is not found
        $errors[] = "User not found for editing.";
    }
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate fields
    if (empty($_POST['role']) || empty($_POST['password'])) {
        $errors[] = "Role and password are required.";
    } else {
        // Fetch form data
        $email = $_POST['email']; // Email is hidden and read-only
        $role = $_POST['role'];
        $password = $_POST['password'];

        // Additional validation (you can add more specific checks here)
        if (empty($email)) {
            $errors[] = "Email is required.";
        }

        

        try {
            // Update the user details in the database
            $sql = "UPDATE user SET role=?, password=? WHERE email=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $role, $password, $email);

            if ($stmt->execute()) {
                // Display success message
                $successMessage = 'User details successfully updated.';
            
            } 
            else {
                // Handle the case where the query execution failed
                $errorMessage = 'Error (' . $stmt->errno . '): ' . $stmt->error;
                $errors[] = $errorMessage;
            }

            $stmt->close();
         }
        catch (Exception $e) {
            // Handle exceptions if any
           $errors[] = 'Error: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>

<!-- Rest of the HTML code remains unchanged -->

<body class="hold-transition skin-green sidebar-mini">
    <section class="content">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <h2 class="box-title" style="text-align:center">Edit User</h2>

                <!-- The form now has an action attribute to submit to itself -->

                <form role="form" method="POST" action="" name="userForm" onsubmit="return validateUserForm()">

                    <!-- Include hidden input for the email -->
                    <input type="hidden" name="email" value="<?php echo $email; ?>">

                    <!-- Rest of the form remains unchanged -->
                    <div class="box-body">
                        <div class="col-xs-6">

                            <div class="form-group">
                                <label for="exampleInputPassword1">Role</label>
                                <input name="role" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Enter role" value="<?php echo $role; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="Enter password" value="<?php echo $role; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer" style="text-align:center">
                        <button type="submit" name="submit" value="submit" class="btn bg-black" id="editUserBtn">Update
                            User</button>
                    </div>
                </form>

                <!-- Display success or error message in a pop-up -->

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
    function validateUserForm() {
        var role = document.forms["userForm"]["role"].value;
        var password = document.forms["userForm"]["password"].value;

        // Check if any field is empty
        if (role === "" || password === "") {
            alert("Role and password are required.");
            return false;
        }

        return true;
    }
    </script>
</body>

</html>
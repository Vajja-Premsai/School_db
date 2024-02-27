<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add your head content here -->
    <link rel="icon" type="image/png" href="dist/img/favicon.ico">
</head>

<body>

    <!-- Add your existing HTML content here -->

    <!-- Close button in the bottom right corner -->

    <a href="student.php" class="btn btn-default"
        style="position: fixed; bottom: 10px; right: 10px; padding: 12px; background-color: black; color: white; text-decoration: none; border-radius:5px">Close</a>


    <?php

require_once "database.php";
require_once "vendor/autoload.php"; // Include PhpSpreadsheet library

use PhpOffice\PhpSpreadsheet\IOFactory;
function generateSid($conn)
{
    // Generate a new SID based on the current timestamp
    $datePart = date('ymd');
    $randomPart = sprintf("%03d", mt_rand(0, 999)); // Random 3-digit number with leading zeros
    $sid = 'SID' . $datePart . $randomPart;

    // Check if the generated SID already exists in the database
    $checkSql = "SELECT * FROM student WHERE sid = '$sid'";
    $checkResult = $conn->query($checkSql);

    // If the SID already exists, generate a new one recursively
    if ($checkResult && $checkResult->num_rows > 0) {
        return generateSid($conn);
    }

    // SID is unique, return it
    return $sid;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process Excel file
    $excelFile = $_FILES['file']['tmp_name'];

    // Check if the Excel file is successfully loaded
    $spreadsheet = IOFactory::load($excelFile);
    if (!$spreadsheet) {
        die("Failed to load the Excel file");
    }

    $worksheet = $spreadsheet->getActiveSheet();

    // Get the header row
    $headerRowIterator = $worksheet->getRowIterator()->current()->getCellIterator();
    $headerRow = array();

    foreach ($headerRowIterator as $cell) {
        $headerRow[] = $cell->getValue() !== null ? strtolower($cell->getValue()) : null;
        
    }
    $columnMappings = [
       
        'studentname' => 'student name',
         'attended for class / workshop / summer camp'=>'attended for',
         'phone no(student / parent / guardian)'=>'phone no'
        // Add more mappings as needed
    ];

    // Loop through each row in the worksheet starting from the second row
    foreach ($worksheet->getRowIterator() as $row) {
        if ($row->getRowIndex() === 1) {
            // Skip the header row
            continue;
        }
        $sid = generateSid($conn);

        // Get the cell values
        $rowData = $row->getCellIterator();

        // Map column names to values
        $data = array();
        foreach ($rowData as $cell) {
            $data[] = $cell->getValue();
        }

        $data = array_combine($headerRow, $data);
        foreach ($columnMappings as $altName => $standardName) {
            if (isset($data[$altName])) {
                $data[$standardName] = $data[$altName];
                unset($data[$altName]);
            }
        }

        // Check if any required value is missing
        $requiredColumns = array('age','pincode','district', 'student name','gender', 'father name', 'class', 'school name', 'school location', 'address location', 'phone no', 'attended for');
        $missingValues = array();

        foreach ($requiredColumns as $column) {
            if (!isset($data[$column])) {
                $missingValues[] = $column;
            }
        }

        if (!empty($missingValues)) {
          
            echo "Missing values for row {$row->getRowIndex()}: " . implode(', ', $missingValues) . ". Skipping...<br>";
          
            ?>
    </br>

    <?php
            continue;
           
        }

        // Extract data based on column names
        $sid=generateSid($conn);
        $studentname = isset($data['student name']) ? $data['student name'] : null;
        $father_name = $data['father name'];
        $school_name = $data['school name'];
        $school_location = $data['school location'];
        $pincode = $data['pincode'];
        $district = $data['district'];
        $phone_no = $data['phone no'];
        $address_location = $data['address location'];
        $age = $data['age'];
        $gender =  $data['gender'];
        $class = $data['class'];
        $attended_for = $data['attended for'];

      


            // Email doesn't exist, insert into the database using prepared statement
            $insertQuery = $conn->prepare("INSERT INTO student (`sid`,`age`, `studentname`, gender, `father_name`, class, `school_name`, `school_location`, `address_location`, `phone_no`, `attended_for`,`pincode`,`district`) VALUES (? ,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?)");

            $insertQuery->bind_param("sisssssssssss", $sid,$age, $studentname, $gender, $father_name, $class, $school_name, $school_location, $address_location, $phone_no, $attended_for,$pincode,$district);

            if ($insertQuery->execute()) {
              
                echo "Record inserted successfully<br>";
                ?>
    </br>
    <?php
              
            } else {
              
                echo "Error inserting record: " . $conn->error . "<br>";
                ?>
    </br>
    <?php
              
            }

       
    }

    // Close the database connection
    $conn->close();
}
?>


    <!-- Add your existing script imports and inline scripts here -->

</body>

</html>
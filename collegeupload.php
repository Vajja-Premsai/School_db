<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add your head content here -->
    <link rel="icon" type="image/png" href="dist/img/favicon.ico">
</head>

<body>

    <!-- Add your existing HTML content here -->

    <!-- Close button in the bottom right corner -->

    <a href="college.php" class="btn btn-default"
        style="position: fixed; bottom: 10px; right: 10px; padding: 12px; background-color: black; color: white; text-decoration: none; border-radius:5px">Close</a>


    <?php

require_once "database.php";
require_once "vendor/autoload.php"; // Include PhpSpreadsheet library

use PhpOffice\PhpSpreadsheet\IOFactory;
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
         'phone no(student / parent / guardian)'=>'phone no'
        // Add more mappings as needed
    ];

    // Loop through each row in the worksheet starting from the second row
    foreach ($worksheet->getRowIterator() as $row) {
        if ($row->getRowIndex() === 1) {
            // Skip the header row
            continue;
        }
        $cid = generateCid($conn);

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
        $requiredColumns = array('email','pincode','district','education','interested field','stream' ,'student name','gender', 'father name',  'college name', 'college location', 'address', 'phone no');
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
        $cid=generateCid($conn);
       
    $studentname = $data['student name'];
    $father_name = $data['father name'];
    $gender =  $data['gender'] ; // Handling radio button
    $phone_no = $data['phone no'];
    $email = $data['email'];
    $address = $data['address'];
    $education = $data['education'];
    $stream = $data['stream'];
    $college_name = $data['college name'];
    $college_location = $data['college location'];
    $pincode = $data['pincode'];
    $district = $data['district'];
    $interested_field = $data['interested field'];

      


            // Email doesn't exist, insert into the database using prepared statement
            $insertQuery = $conn->prepare("INSERT INTO college (
                cid, studentname, father_name, gender, phone_no, email,address,education, stream, college_name, college_location, pincode, district, interested_field
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $insertQuery->bind_param("ssssssssssssss", 
            $cid, $studentname, $father_name, $gender, $phone_no, $email, $address,
            $education, $stream, $college_name, $college_location, $pincode, $district, $interested_field
        );

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
<?php


include_once 'database.php';

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <title>upload-data</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">

    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="icon" type="image/png" href="dist/img/favicon.ico">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;

    }

    .login-div {
        margin-top: 30%;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 370px;



    }



    h2 {
        color: #000;
        text-align: center;
        font-family: 'Lucida Sans';
        font-size: 22px;
        padding-bottom: 3%;
        font-weight: 500;
        border-bottom: 1px solid #000;
        letter-spacing: 2px;
    }

    p {
        color: #000;
        text-align: center;
        font-family: 'Lucida Sans';
        font-size: 18px;
        padding-top: 3%;
        font-weight: 500;

        letter-spacing: 2px;
    }

    input[type="file"] {

        margin-left: 20%;
        padding: 10px;

    }

    input[type="submit"] {
        background-color: #000;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }


    .delete-button {
        border-radius: 5px;
        border: 1px solid #000;
        background: #FFF;
        color: #000;
        float: left;

    }

    .cancel-button {
        border-radius: 5px;
        background: #1C1C1C;
        color: #FFF;
    }

    .btn {
        border-radius: 5px !important;
        border: 1px solid #000 !important;
        width: 130px !important;
        height: 40px !important;

    }
    </style>
</head>

<body class="upload-container">

    <div class="login-div">
        <h2>UPLOAD TECKY DATA</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <p>Select source excel file:</p>
            <input type="file" name="file" accept=".xlsx" required />
            <div class="modal-footer">
                <button type="submit" value="Upload" class="btn delete-button">Upload</button>
                <button type="button" class="btn cancel-button" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
   
    <!-- <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
    <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
   
    <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- bootstrap color picker -->
    <script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <!-- <script src="dist/js/adminlte.min.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>

</body>


</html>
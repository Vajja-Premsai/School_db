<?php
session_start();
include_once 'database.php'; # including db
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="dist/img/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <style>
        
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        padding: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        margin: 0;
        /* Remove default margin */
    }

    .header {
        margin: 50px 0px;
    }

    .back-button {
        position: absolute;
        top: 3rem;
        left: 3rem;
        color: #fff;
        text-align: center;
        font-size: 20px;
        font-weight: 400;
        letter-spacing: 2px;
        border-radius: 5px;
        background: #101010;
    }

    .Admin-login-div h1 {
        color: #101010;
        text-align: center;
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
            "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
        font-size: 32px;
        font-weight: 400;
        letter-spacing: 3.2px;
    }

    .content {
        width: 100%;
        margin: 5% 0%;
    }

    .Admin-login-div {
        width: 600px;
        padding: 30px;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0px 0px 20px 1px #e3e3e3;
    }

    .Admin-login-div label {
        text-align: left;
        color: #101010;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana,
            sans-serif "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
            "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
        font-size: 20px;
        font-weight: 400;
        letter-spacing: 2px;
    }

    .Admin-login-div form label {
        display: block;
        margin-bottom: 8px;
    }

    .Admin-login-div form input {
        height: 3rem;
        margin-bottom: 2rem;
    }

    button {
        width: 160px;
        height: 60px;
        border-radius: 5px;
        background: #1c1c1c;
        color: #fff;
        text-align: center;
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
            "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
        font-size: 28px;
        font-weight: 600;
        margin: 1rem;
    }

    @media only screen and (min-width: 601px) and (max-width: 992px) {
        .header-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
    }
    </style>
</head>

<body>
    <div class="header-container">
        <div class="header">
            <a href="./page1.html" class="back-button btn btn-light"> Back</a>
            <img src="dist/img/Teckybot TM 1.png" alt="Logo" />
        </div>
        <div class="content">
            <div class="Admin-login-div">
                <form method="post">
                    <h1>TECKY LOGIN</h1>
                    <br />
                    <div class="form-group">
                        <label for="email">Login with your Mail:</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Enter email"
                            name="email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Enter Your Password:</label>
                        <input name="password" type="password" class="form-control" id="pwd"
                            placeholder="Enter password" name="pswd">
                    </div>
                    <button name="submit" value="submit" type="submit" class="btn btn-dark">Login</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user WHERE email ='".$email."' and password = '".$password."' ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $_SESSION['role'] = $row['role'];
            }

            $sql2 = "SELECT * FROM ".$_SESSION['role']." WHERE email ='".$email."'";
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    if($_SESSION['role']=='student'){
                        $_SESSION['uid']=$row2['sid'];
                        $_SESSION['user'] = $row2['studentname'];
                    }
                } 
            }

            header("Location:./");
        } else {
            echo "<p style='width:100%;text-align:center'>Incorrect username or password</p>";
        }
    }
    ?>

    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script>
    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
    </script>
</body>


</html>
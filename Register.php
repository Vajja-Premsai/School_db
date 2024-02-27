<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link rel="icon" type="image/png" href="dist/img/favicon.ico">
    <link
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      body {
        font-family: Arial, sans-serif;
        text-align: center;
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100vh;
        margin: 0;
      }

      .header {
        margin-bottom: 50px;
      }

      .header img {
        width: 100%;
        max-width: 400px;
        height: auto;
        margin-bottom: 20px;
      }

      .header h3 {
        margin: 5% 0%;
        color: #101010;
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
          "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
        font-size: 32px;
        font-weight: 400;
        letter-spacing: 3.2px;
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

      @media only screen and (max-width: 600px) {
        .header h3 {
          font-size: 24px;
          margin-bottom: 10px;
        }
      }

      @media only screen and (min-width: 601px) and (max-width: 992px) {
        .header h3 {
          font-size: 28px;
        }
      }

      .content {
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;
      }

      .button {
        width: 300px;
        height: 80px;
        margin-bottom: 20px;
        color: #000;
        text-align: center;
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
          "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
        font-size: 26px;
        font-weight: 400;
        letter-spacing: 2.6px;
        border-radius: 5px;
        border: 0.5px solid #383838;
        background: #fff;
        box-shadow: 0px 0px 20px 1px #e3e3e3;
      }

      @media only screen and (max-width: 992px) {
        .header img {
          max-width: 300px;
        }
      }

      @media only screen and (max-width: 600px) {
        .header img {
          max-width: 200px;
        }

        .content {
          flex-direction: column;
        }

        .button {
          width: 100%;
        }
      }
    </style>
  </head>

  <body>
  <div class="header">
            <a href="./page1.html" class="back-button btn btn-light"> Back</a>
            <img src="dist/img/Teckybot TM 1.png" alt="Logo" />
        </div>
 

    <div class="content">
      <div>
        <button class="button" onclick="redirectToLogin('school')">
          SCHOOL
        </button>
      </div>
      <div>
        <button class="button" onclick="redirectToLogin('college')">
          COLLEGE
        </button>
      </div>
      <div>
        <button class="button" onclick="redirectToLogin('teacher')">
          TEACHER
        </button>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
      function redirectToLogin(userType) {
        if (userType === "school") {
          window.location.href = "schoolRegister.php";
        } else if (userType === "college") {
          window.location.href = "collegeRegister.php";
        } else if (userType === "teacher") {
          window.location.href = "teacherRegister.php";
        }
      }
    </script>
  </body>
</html>

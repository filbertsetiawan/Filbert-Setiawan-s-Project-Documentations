<?php
    session_start();
    //cek apakah user sudah login, jika belum maka akan dikembalikan ke login page
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: loginuser.php");
        exit;
    }
?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>WARTEG | Change Password</title>
        <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    </head>

    <body style="font-family: 'Poppins', sans-serif; font-size: larger">
        <?php
            require_once "connection.php";
            $kalimatquery ="SELECT password FROM customer WHERE id = {$_SESSION['id']}";
            $hasilquery=$conn->query ($kalimatquery);
            $result = mysqli_fetch_assoc($hasilquery);   
            $_SESSION["password"]=$result["password"];
        ?>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
            .wrapper{ width: 600px; padding: 10px; }

            .btn-fill {
                font: 600 18px/normal Poppins, sans-serif;
                background-color: #FFB830;
                border-radius: 12px;
                padding: 10px 16px;
                transition: 0.3s;
            }

            .btn-fill:hover {
                --tw-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
                0 4px 6px -2px rgba(0, 0, 0, 0.05);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
                var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
                transition: 0.3s;
            }

            .btn-fill2 {
                font: 600 18px/normal Poppins, sans-serif;
                background-color: #FF2442;
                border-radius: 12px;
                padding: 10px 16px;
                transition: 0.3s;
            }

            .btn-fill2:hover {
                --tw-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
                0 4px 6px -2px rgba(0, 0, 0, 0.05);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
                var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
                transition: 0.3s;
            }
        
            label {
                float: left;
                font-size: large;
            }
        </style>
        <br>
        <center>
            <div class="wrapper">
                <a href="home.php">
                    <img src="assets/font.png" width="300px">
                </a>
                <h2>Change Password</h2>
                <p>Please remember your password to log in into website.</p>
                <br>
                <div class="col-sm-5">
                    <a href="home.php"><img src="assets/logo.png" width="200px"></a>
                </div>
                <div class="col-sm-7">
                    <form action="changingpassword.php" method="post">
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>New Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-fill" value="Change Password" style="margin: 10px;">
                        </div>
                    </form>
                </div>
            </div>
        </center>
    </body>
</html>
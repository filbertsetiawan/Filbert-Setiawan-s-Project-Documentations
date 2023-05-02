<?php
    //koneksi
    require_once "connection.php";
    $id = 0;
    $email = "";
    $email_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["email"]))){
            $email_err = "Please enter your email.";
        } else{
            //select statement 
            $sql = "SELECT id FROM customer WHERE email = ?";

            if($stmt = mysqli_prepare($conn, $sql)){
                //bind variabel 
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                
                //set parameter
                $param_email = trim($_POST["email"]);
                
                //execute
                if(mysqli_stmt_execute($stmt)){
                    //store result
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $email = trim($_POST["email"]);

                        $sql2 = "SELECT id FROM customer WHERE email = '$email'";
                        $result2 = $conn->query($sql);

                        if ($result2 = $conn->query($sql2)) {
                            while($row = $result2->fetch_assoc()) {
                                $id = $row['id'];
                            }
                        }
                        
                        header("location: sendemail_newpass.php?id=$id");
                    } else{
                        $email_err = "Wrong email, please try again.";
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                mysqli_stmt_close($stmt);
            }
        }
        mysqli_close($conn);
    }
?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>WARTEG | Forgot Password</title>
        <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    </head>

    <body style="font-family: 'Poppins', sans-serif; font-size: larger">
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
                <a href="welcome.php">
                    <img src="assets/font.png" width="300px">
                </a>
                <h2>Forgot your password?</h2>
                <p>Please send an email to verify.</p>
                <br>
                <div class="col-sm-5">
                    <img src="assets/logo.png" width="200px">
                </div>
                <div class="col-sm-7">
                    <form method="post">
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <input id="email" type="text" name="email" class="form-control" value="<?php echo $email;?>" placeholder="E-mail">
                            <span class="help-block"><?php echo $email_err; ?></span>
                        </div>    
                        <div class="form-group">
                           <input type="submit" class="btn btn-fill" value="Send" style="margin: 10px;">
                        </div>
                    </form>
                </div>
            </div>
        </center>
    </body>
</html>
<?php
    //start session
    require_once "connection.php";
    $id = $_GET['id'];


    $new_password = $confirm_password = "";
    $new_password_err = $confirm_password_err = "";
        
    //proses form data 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //validasi password
        if(empty(trim($_POST["new_password"]))){
            $new_password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST["new_password"])) < 6){
            $new_password_err = "Password must have atleast 6 characters.";
        } else{
            $new_password = trim($_POST["new_password"]);
        }
        
        //validasi confirm password
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm password.";     
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($new_password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }
        
        //cek input error sbeelum dimasukkan ke database
        if(empty($new_password_err) && empty($confirm_password_err)){
            
            //select statement insert ke database
            $sql = "UPDATE customer SET password = ? WHERE id = $id";
            
            if($stmt = mysqli_prepare($conn, $sql)){
                $param_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "s", $param_new_password);
        
                //execute prepare statement
                if(mysqli_stmt_execute($stmt)){
                    //mengarahkan ke login page jika berhasil 
                    header("location: loginuser.php");
                } else{
                    echo "Something went wrong. Please try again later.";
                }

                //close statement
                mysqli_stmt_close($stmt);
            }
        }

        //close connection 
        mysqli_close($conn);    }
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
                <h2>Change Password</h2>
                <p>Please remember your password to log in into website.</p>
                <br>
                <div class="col-sm-5">
                    <img src="assets/logo.png" width="200px">
                </div>
                <div class="col-sm-7">
                    <form method="post">  
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>New Password</label>
                            <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>" placeholder="Password">
                            <span class="help-block"><?php echo $new_password_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" placeholder="Confirm password">
                            <span class="help-block"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-fill" value="Change Password">
                        </div>
                        <p>Already have an account? <a href="loginuser.php" style="color: #3DB2FF;">Log in here</a>.</p>
                    </form>
                </div>
            </div>    
        </center>
    </body>
</html>
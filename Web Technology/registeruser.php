<?php
    //koneksi
    require_once "connection.php";
    
    $email = $username = $password = $confirm_password = "";
    $email_err = $username_err = $password_err = $confirm_password_err = "";
    
    //proses form data jika klik tombol create account
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //validasi email
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
                        $email_err = "This e-mail is already taken.";
                    } else{
                        $email = trim($_POST["email"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                //close statement
                mysqli_stmt_close($stmt);
            }
        }

        //validasi username
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter a username.";
        } else{
            //select statement 
            $sql = "SELECT id FROM customer WHERE username = ?";
            
            if($stmt = mysqli_prepare($conn, $sql)){
                //bind variabel 
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                //set parameter
                $param_username = trim($_POST["username"]);
                
                //execute
                if(mysqli_stmt_execute($stmt)){
                    //store result
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $username_err = "This username is already taken.";
                    } else{
                        $username = trim($_POST["username"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                //close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        //validasi password
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        //validasi confirm password
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm password.";     
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }
        
        //cek input error sbeelum dimasukkan ke database
        if(empty($email_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)){
            
            //select statement insert ke database
            $sql = "INSERT INTO customer (email, username, password) VALUES (?, ?, ?)";
            
            if($stmt = mysqli_prepare($conn, $sql)){
                //bind variabel
                mysqli_stmt_bind_param($stmt, "sss", $param_email, $param_username, $param_password);
                
                //set parameter
                $param_email = $email;
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                
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
        mysqli_close($conn);
    }
?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>WARTEG | Sign Up</title>
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
                <h2>Sign Up</h2>
                <p>Please fill this form in order to create an account.</p>
                <br>
                <div class="col-sm-5">
                    <img src="assets/logo.png" width="200px">
                </div>
                <div class="col-sm-7">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>E-mail</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="E-mail">
                            <span class="help-block"><?php echo $email_err; ?></span>
                        </div>  
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Username">
                            <span class="help-block"><?php echo $username_err; ?></span>
                        </div>    
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Password">
                            <span class="help-block"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" placeholder="Confirm password">
                            <span class="help-block"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-fill" value="Register Now">
                        </div>
                        <p>Already have an account? <a href="loginuser.php" style="color: #3DB2FF;">Log in here</a>.</p>
                    </form>
                </div>
            </div>    
        </center>
    </body>
</html>
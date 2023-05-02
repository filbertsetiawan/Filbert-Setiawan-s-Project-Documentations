<?php
    session_start();
    
    //cek apakah user sudah log in/belum, kalau sudah akan diarahkan ke halaman home dari website
    if(isset($_SESSION["loggedinadmin"]) && $_SESSION["loggedinadmin"] === true){
    header("location: backend.php");
    exit;
    }
    
    //koneksi
    require_once "connection.php";
    
    $username = $password = "";
    $username_err = $password_err = "";
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
        //cek apakah username empty atau tidak 
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter username.";
        } else{
            $username = trim($_POST["username"]);
        }
        
        //cek apakah password empty atau tidak 
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        //validasi credentials
        if(empty($username_err) && empty($password_err)){
            //select statement 
            $sql = "SELECT id, username, password FROM admin WHERE username = ?";
            
            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                //set parameter
                $param_username = $username;
                
                //execute
                if(mysqli_stmt_execute($stmt)){
                    //store result
                    mysqli_stmt_store_result($stmt);
                    
                    //cek apakah username tersedia, jika tersedia maka validasi password
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        //bind variabel
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)) {
                            if(password_verify($password, $hashed_password)){
                                //jika password benar maka start session baru 
                                session_start();
                                
                                //store data di variabel session 
                                $_SESSION["loggedinadmin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;                            
                                
                                //mengarahkan user ke halaman home 
                                header("location: backend.php");
                            } else{
                                $password_err = "The password you entered was not valid.";
                            }
                        }
                    } else{
                        //jika username tidak exist
                        $username_err = "No account found with that username.";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
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
        <title>WARTEG | Log In</title>
        <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    </head>

    <body style="font-family: 'Poppins', sans-serif; font-size: larger">
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
            .wrapper{ 
                width: 600px; padding: 10px; 
            }

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
                <h2>Log In to continue</h2>
                <p>Please log in using that account has registered on the website.</p>
                <div class="col-sm-5">
                    <img src="assets/logo.png" width="200px">
                </div>
                <div class="col-sm-7">
                    <form method="post">
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Username">
                            <span class="help-block"><?php echo $username_err; ?></span>
                        </div>    
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <span class="help-block"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-fill" value="Log In">
                        </div>
                        <p>Don't have an account? <a href="registeradmin.php" style="color: #3DB2FF;">Sign up now</a>.</p>
                    </form>
                </div>
            </div>
        </center>
    </body>
</html>
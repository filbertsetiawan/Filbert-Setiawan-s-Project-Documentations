<?php
    //start session
    require_once "connection.php";
    $id = 0;
    $id = $_GET['id'];
    echo $id;
    

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
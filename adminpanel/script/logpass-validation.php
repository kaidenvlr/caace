<?php
// by default, error messages are empty
$call_login = $set_username = $usernameErr = $passErr = '';
extract($_POST);

if (isset($login)) {
    if (empty($username)) {
        $usernameErr = "Username is Required";
    } else {
        $usernameErr = true;
    }

    // password validation 
    if (empty($password)) {
        $passErr = "Password is Required";
    } else {
        $passErr = true;
    }

    // check all fields are valid or not
    if ($usernameErr == 1 && $passErr == 1) {
        $username = legal_input($username);
        $password = legal_input($password);
        //  Sql Query to insert user data into database table
        $db = $conn; // database connection  
        $call_login = login($db, $username, $password);
    } else {
        $set_username = $username;
    }
}

// convert illegal input value to ligal value formate
function legal_input($value)
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}

// function to check valid login data into database table
function login($db, $username, $password)
{
    // checking valid user
    $check_username = "SELECT username FROM `admin` WHERE username='$username'";
    $run_username = mysqli_query($db, $check_username);
    if ($run_username) {
        if (mysqli_num_rows($run_username) > 0) {
            $password = md5($password);
            $check_user = "SELECT * FROM `admin` WHERE username='$username' AND password='$password'";
            $run_user = mysqli_query($db, $check_user);
            if (mysqli_num_rows($run_user) > 0) {
                $dataadmin = mysqli_fetch_assoc($run_user);
                session_start();
                $_SESSION['id'] = $dataadmin['aid'];
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $dataadmin['arole'];
                header("location:dashboard.php");
            } else {
                return "Your Password is wrong";
            }
        } else {
            return "Your Username is not exist";
        }
    } else {
        echo $db->error;
    }
}

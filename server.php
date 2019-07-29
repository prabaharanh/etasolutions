<?php
include_once "dbConfig.php";
session_start();

// initializing variables
$username = "";
$email = "";
$errors = array();


// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $password_1 = mysqli_real_escape_string($link, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($link, $_POST['password_2']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($link, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) {
            array_push($errors, "email already exists");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1); //encrypt the password before saving in the database

        $query = "INSERT INTO user (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
        mysqli_query($link, $query);
        //$_SESSION['username'] = $username;
        //$_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $results = mysqli_query($link, $query);
        $row = mysqli_fetch_row($results);
//        echo "<pre>";
//        print_r($row);
//        exit;
        if (mysqli_num_rows($results) == 1) {
            
            $_SESSION['user_id'] = isset($row[0]) ? $row[0] : 0;
            $user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 0;
//            echo $user_id;
//            exit;
            //$_SESSION['username'] = $username;
            //$_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}

// Logout user

if(isset($_REQUEST["logout"]) && $_REQUEST["logout"] == "1") {
    session_destroy();
    header('location: login.php');
}
// Insert timesheet
if(isset($_POST['inserttimesheet']))
{
    $employeeid = $_POST['employeeid'];
    $date = $_POST['date'];
    $timefrom = $_POST['timefrom'];
	$timeto = $_POST['timeto'];
    $comments = $_POST['comments'];
    $activityid = $_POST['activityid'];
    $datesubmitted = $_POST['datesubmitted'];
	

    $query = "INSERT INTO tbl_timesheet (employee_id, date, time_from, time_to, comments, activity_id, date_submitted) VALUES ('$employeeid','$date','$timefrom','$timeto','$comments','$activityid', '$datesubmitted')";
    mysqli_query($link, $query);
   // header('location: index.php');
    
}

if(isset($_POST['updatetimesheet']))
{
    $id = trim($_POST['update_id']);
    $employeeid = trim($_POST['employeeid']);
    $date = trim($_POST['date']);
    $timefrom = !empty(trim($_POST['timefrom']))? trim($_POST['trimefrom']) : NULL;
    $timefrom = !empty(trim($_POST['timeto']))? trim($_POST['timeto']) : NULL;
    $comments = trim($_POST['comments']);
    $activityid = trim($_POST['activityid']);
    $datesubmitted = trim($_POST['datesubmitted']);

    $query = "UPDATE tbl_timesheet SET "
            . "employee_id='$employeeid', "
            . "date='$date', "
            . "time_from='$timefrom',"
            . "time_to='$timeto', "
            . "comments='$comments', "
            . "activity_id='$activityid', "
            . "date_submitted='$datesubmitted' "
            . "WHERE id='$id'";
//    echo $query;
//    exit;
    $query_run = mysqli_query($link, $query);
    $error = mysqli_error($link);
    if ($error) {
        echo "<pre>";
        echo $query . "<br />";
        print_r($error);
        exit;
    }
    if ($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
//        header("Location:index.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}
if (isset($_POST['deletetimesheet'])) {
    $id = $_POST['delete_id'];

    $update_qedit = "UPDATE tbl_timesheet SET is_deleted = 1 WHERE id='$id'";
    $query_run = mysqli_query($link, $update_qedit);

    if ($query_run) {
        $update_qtrans = "UPDATE tbl_timesheet SET is_deleted = 1 WHERE id='$id'";
        $query_runtrans = mysqli_query($link, $update_qtrans);
        echo '<script> alert("Data Deleted"); </script>';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
//        header("Location:index.php");
    } else {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}
?>
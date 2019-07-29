<?php
include_once "dbConfig.php";

if(isset($_POST['inserttimesheet']))
{
    $employeeid = $_POST['employeeid'];
    $date = $_POST['date'];
    $timefrom = $_POST['timefrom'];
	$timeto = $_POST['timeto'];
    $comments = $_POST['comments'];
    $activityid = $_POST['activityid'];
    $datesubmitted = $_POST['datesubmitted'];
	

    $query = "INSERT INTO tbl_timesheet('employee_id','date','time_from','time_to','comments', 'activity_id', 'date_submitted') VALUES ('$employeeid','$date','$timefrom','$timeto','$comments','$activityid', '$datesubmitted')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: index.php');
    }
    else
    {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}

?>
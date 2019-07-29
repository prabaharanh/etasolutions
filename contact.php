<?php


session_start();
include_once "server.php";
$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 1;
//echo $user_id; exit;
if ($user_id == 0) {
    header("Location: login.php");
}

include_once "function.php";

if (isset($_GET["page"]))
    $page = (int) $_GET["page"];
else
    $page = 1;

$setLimit = 10;
$pageLimit = ($page * $setLimit) - $setLimit;
?>

		<?php include('header.php');?>
		<?php include('sidebar.php');?>

     
		<div class="container" id="Contact">
  <h3>Contact</h3>
   
  <form action="mail-script.php" method="POST">

<div class="modal-body">
    <div class="form-group">
        <label> Subject </label>
        <input type="text" name="subject" class="form-control" placeholder="Enter subject">
    </div>

    <div class="form-group">
        <label> Name </label>
        <input type="text" name="name" class="form-control" placeholder="Enter your name">
    </div>

    <div class="form-group">
        <label> Email  </label>
        <input type="email" name="email" class="form-control" placeholder="Enter your email">
    </div>
                    
    <div class="form-group">
        <label> Message </label>
        <input type="text" name="message" class="form-control" placeholder="Enter the Message here!!!">
    </div>
  
    <div class="modal-footer">
        <button type="submit" name="submit" class="btn btn-primary"> Send</button>
    </div>
</form>
             
   
     </body>
 </html>

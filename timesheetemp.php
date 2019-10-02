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

     
		<div class="container" id="timesheet">
  <h3>Timesheet</h3>
  <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Timesheet </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        
                <form action="timesheetemp.php" method="POST">
        
                    <div class="modal-body">
                        <div class="form-group">
                            <label> Employeeid </label>
                            <input type="text" name="employeeid" class="form-control" placeholder="Username">
                        </div>
        
                        <div class="form-group">
                            <label> date </label>
                            <input type="date" name="date" class="form-control" placeholder="Email">
                        </div>
        
                        <div class="form-group">
                            <label> Time from  </label>
                            <input type="time" name="timefrom" class="form-control" placeholder="Password">
                        </div>
                                        
                        <div class="form-group">
                            <label> Time to </label>
                            <input type="time" name="timeto" class="form-control" placeholder="Re-enter password">
                        </div>
                        <div class="form-group">
                            <label>  </label>
                            <input type="text" name="comments" class="form-control" placeholder="Comments">
                        </div>
                        <div class="form-group">
                            <label>  </label>
                            <input type="text" name="activityid" class="form-control" placeholder="Activity ID">
                        </div>
                        <div class="form-group">
                            <label>  </label>
                            <input type="date" name="datesubmitted" class="form-control" placeholder="Date Submitted">
                        </div>
                      
                                  
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="inserttimesheet" class="btn btn-primary">Save Data</button>
                    </div>
                </form>
        
            </div>
          </div>
        </div>


		
	
    </div>
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Edit Data </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="employee.php" method="POST">

                    <div class="modal-body">
                        <div class="form-group">
                            <label> Employeeid </label>
                            <input type="text" name="employeeid" class="form-control" placeholder="Username">
                        </div>
        
                        <div class="form-group">
                            <label> date </label>
                            <input type="date" name="date" class="form-control" placeholder="Email">
                        </div>
        
                        <div class="form-group">
                            <label> Time from  </label>
                            <input type="time" name="timefrom" class="form-control" placeholder="Time From">
                        </div>
                                        
                        <div class="form-group">
                            <label> Time to </label>
                            <input type="time" name="timeto" class="form-control" placeholder="Time to">
                        </div>
                 <div class="form-group">
                            <label>  </label>
                            <input type="text" name="comments" class="form-control" placeholder="Comments">
                        </div>
                        <div class="form-group">
                            <label>  </label>
                            <input type="text" name="activityid" class="form-control" placeholder="Activity ID">
                        </div>
                        <div class="form-group">
                            <label>  </label>
                            <input type="date" name="datesubmitted" class="form-control" placeholder="Date Submitted">
                        </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="update_id" id="update_id" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="updatetimesheet" class="btn btn-primary">Update Data</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Delete Data </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="timesheetemp.php" method="POST">

                        <div class="modal-body">

                            <input type="hidden" name="delete_id" id="delete_id">

                            <h4> Do you want to Delete this Data ??</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">  NO </button>
                            <button type="submit" name="deletetimesheet" class="btn btn-primary"> Yes !! Delete it. </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="container">
            <div class="jumbotron">
                <div class="card">
                    <h2>  </h2>
                </div>    
                        <div class="card">
                    <h2>  </h2>
                </div>    
                       <div class="card">
                            <div class="card-body">
                                <button type="button" class="btn btn-primary" style="float:right;"data-toggle="modal" data-target="#studentaddmodal">
                                    Add Timesheet
                                </button>
                            </div>
                        </div>

                <div class="card">
                Last week Timesheet
                    <div class="card-body">

                        <?php

                        $query = "SELECT * FROM tbl_timesheet WHERE is_deleted='0' and date >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY
                        AND date < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY";
                        $query_run = mysqli_query($link, $query);
                        ?>
                        <table id="datatableid " class="customers">
                            <thead>
                                <tr>
                                    <th scope="col"> ID</th>
                                    <th scope="col"> Day </th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time </th>
                                    <th scope="col">Total Hours </th>
                              
                               
                                </tr>
                            </thead>
                            <?php
                            if ($query_run) {
                                $weekhour =0;
                                foreach ($query_run as $row) {
                                    $start_time = $row['time_from'];;
                                    $end_time = $row['time_to'];
                                    $dateday=$row['date'];
                                    $start = explode(':', $start_time);
$end = explode(':', $end_time);
$total_hours = $end[0] - $start[0] - ($end[1] < $start[1]);

$weekhour +=$total_hours;
                                    
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>   
                                            <td><?php echo date('l', strtotime($dateday));; ?></td>

                                            <td><?php echo $row['time_from']; ?></td>
                                            <td><?php echo $row['time_to']; ?></td>   
                                            <td><?php echo $total_hours; ?></td>                           
                                         

                                         
                                        </tr>
                                        
                                        </tbody>
                                        
                                    <?php
                                }
                            } else {
                                echo "No Record Found";
                            }
                            ?>
                            <tbody><tr>
                                        <td  scope="col">
                                        TOTAL HOURS
                                        </td>
                                        <td>
                                        
                                        <?php echo $weekhour;?>
                                        </td>
                                        </tr>
                                        </tbody>
                        </table>
                    </div>
                    </div>
                    </div>


        
<script>

            $(document).ready(function () {

                $('#datatableid').DataTable({
                    "pagingType": "full_numbers",
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search Your Data",
                    }
                });

            });

        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>




        <script>

            $(document).ready(function () {

                $('.deletebtn').on('click', function () {

                    $('#deletemodal').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#delete_id').val(data[0]);

                });
            });

        </script>



        <script>

            $(document).ready(function () {
                $('.editbtn').on('click', function () {

                    $('#editmodal').modal('show');


                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#update_id').val(data[0]);
                    $('#address').val(data[1]);
                    $('#saleleaseprice').val(data[2]);
                    $('#payoutamt').val(data[3]);
                    $('#paymentdate').val(data[4]);
                    $('#agent').val(data[5]);
                    $('#fname').val(data[6]);
                    $('#confirmedtime').val(data[7]);



                });
            });

        </script>


    </body>
</html>


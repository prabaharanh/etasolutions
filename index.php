<?php
include_once "dbConfig.php";
include_once "server.php";
session_start();
$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 0;
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

     
		<div class="container" id="pagecontent">
  <h3>Employee</h3>
  <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Employee </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        
                <form action="insertcode.php" method="POST">
        
                    <div class="modal-body">
                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="username" class="form-control" placeholder="Username">
                        </div>
        
                        <div class="form-group">
                            <label> Email </label>
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>
        
                        <div class="form-group">
                            <label> password </label>
                            <input type="text" name="password" class="form-control" placeholder="Password">
                        </div>
                                        
                                        <div class="form-group">
                            <label>  </label>
                            <input type="text" name="email" class="form-control" placeholder="Re-enter password">
                        </div>
                                  
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
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

                    <form action="updatecode.php" method="POST">

                        <div class="modal-body">
                            <div class="form-group">
                                <label> id </label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="" readonly>
                            </div>

                            <div class="form-group">
                                <label> username </label>
                                <input type="text" name="saleleaseprice" id="saleleaseprice" class="form-control" placeholder="" readonly>
                            </div>

                            <div class="form-group">
                                <label> email  </label>
                                <input type="text" name="payoutamt" id="payoutamt"  class="form-control" placeholder="" > 
                            </div>

                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="update_id" id="update_id" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
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

                    <form action="deletecode.php" method="POST">

                        <div class="modal-body">

                            <input type="hidden" name="delete_id" id="delete_id">

                            <h4> Do you want to Delete this Data ??</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">  NO </button>
                            <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
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
                                    New Employee
                                </button>
                            </div>
                        </div>

                <div class="card">
                    <div class="card-body">

                        <?php

                        $query = "SELECT * FROM user WHERE is_deleted = 0 LIMIT " . $pageLimit . " , " . $setLimit;
                        $query_run = mysqli_query($link, $query);
                        ?>
                        <table id="datatableid " class="customers">
                            <thead>
                                <tr>
                                    <th scope="col"> ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email address </th>
                               
                                </tr>
                            </thead>
                            <?php
                            if ($query_run) {
                                foreach ($query_run as $row) {
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>    
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['email']; ?></td>                            
                                         

                                            <td> 
                                                <button type="button" class="btn btn-success editbtn"> EDIT </button>
                                            </td> 
                                            <td>
                                                <button type="button" class="btn btn-danger deletebtn"> DELETE </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php
                                }
                            } else {
                                echo "No Record Found";
                            }
                            ?>
                        </table>
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


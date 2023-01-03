<?php
define('TITLE', 'Technician Profile');
define('PAGE', 'techProfile');
include('includes/header.php'); 
include('../dbConnection.php');
 session_start();
 if($_SESSION['is_techlogin']){
  $temail = $_SESSION['temail'];
 } else {
  echo "<script> location.href='technicianLogin.php'; </script>";
 }
 
 ?>

<div class="col-sm-6 mt-5  mx-3">
 <form action="" class="mt-3 form-inline d-print-none">
    <div class="form-group mr-3">
      <label for="checkid">Enter your Name or ID  </label>
      <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search data">
    </div>
    <button type="submit" class="btn btn-info">Search</button>
  </form>
</div>

<div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Emp-ID</th>
                                    <th>Emp-Name</th>
                                    <th>Problem-Info</th>
                                    <th>Assign-Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                   

                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        $query = "SELECT * FROM assignwork_tb WHERE CONCAT(assign_tech,empid) LIKE '%$filtervalues%' ";
                                        $query_run = mysqli_query($conn, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?= $items['empid']; ?></td>
                                                    <td><?= $items['assign_tech']; ?></td>
                                                    <td><?= $items['request_desc']; ?></td>
                                                    <td><?= $items['assign_date']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="4">No Record Found</td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <?php
include('includes/footer.php'); 
?>
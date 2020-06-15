<?php
require_once "functions.php";

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$output_data = get_departments();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Ticket</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="main.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h4>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h4>
        <a href="logout.php" class="btn btn-danger sign-out-btn">Sign Out of Your Account</a>
    </div>
      
        
    
    <!-- CREATE NEW TICKETS CODE -->
    <form action="submitForm.php" method="post">
       <div class="container">
       <div class="col-sm-12 align-labels">
                <h3><b>Submit a Ticket</b></h3><br/><br/><br/> 
                <h4><b>Contact Information</b></h4></b><br/>
        </div>

        <div class="container">
        <div class="col-sm-12">
            <div class="col-sm-4 form-group">
                <label>Contact Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $_SESSION['name']; ?>">
            </div>
        
            <div class="col-sm-4 form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $_SESSION['username']; ?>">
            </div>

            <div class="col-sm-4 form-group">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="" placeholder="Phone">
            </div>
        </div>
        </div><br/><br/>
        <div class="col-sm-12 align-labels"> 
                <h4><b>Ticket Information</b></h4><br/>
        </div>

<!-- ALL DEPARTMENTS FETCHED FROM API NEED TO PASS TO DEPARTMENT DROPDOWN -->
        <div class="container">
        <div class="col-sm-12">
            <div class="col-sm-4 form-group">
                <label>Department</label>
                <select class="form-control" name="dept" id="dept">
                    <?php  foreach ($output_data as $dept){ ?>
                        <option value='<?php echo $dept["id"];?>'><?php echo $dept["name"];?>
                   <?php }?>
                </select>
                
            </div>

<!-- ALL CA FETCHED FROM API NEED TO PASS TO Category DROPDOWN -->
            <div class="col-sm-4 form-group">
                <label>Category</label>
                <input type="text" name="category" class="form-control" value="" placeholder="Category">
            </div>
        
        
            <div class="col-sm-4 form-group">
                <label>Subject</label>
                <input type="text" name="subject" class="form-control" value="" placeholder="Subject">
            </div>
        </div>
        </div>

        <div class="container">
        <div class="col-sm-12">
            <div class="col-sm-4 form-group">
                <input type="hidden" name="channel" class="form-control" value="Web App">
            </div>

            <div class="col-sm-4 form-group">
                <input type="hidden" name="contactid" class="form-control" value="7189000001594001">
            </div>

            <div class="col-sm-4 form-group">
                <input type="hidden" name="assigneeid" class="form-control" value="7189000000780054">
            </div>
        </div>
        </div>

        <div class="container">
        <div class="col-sm-12">
                <label>Description</label>
                <textarea name="description" class="form-control" value="" rows="4" cols="50"></textarea>
        </div></div><br/><br/>


        <div class="col-sm-12 align-labels"> 
                <h4><b>Additional Information</b></h4><br/>
        </div>

        <div class="container">
        <div class="col-sm-12">
            <div class="col-sm-4 form-group">
                <label>Priority</label>
                <input type="text" name="priority" class="form-control" value="" placeholder="Priority">
            </div>
            <div class="col-sm-4 form-group">
                <label>Status</label>
                <input type="text" name="status" class="form-control" value="" placeholder="Status">
            </div>
        </div>
        </div>

        <div class="col-sm-12">
                    <a class="btn btn-success" id="submit-btn-align" href="all_tickets.php">All Tickets</a>  
                    <button type="submit" name="submit" id="submit-btn-align" class="btn btn-success"> Submit Ticket</button>
                    
        </div>

    </div>

    </form>

</body>
</html>
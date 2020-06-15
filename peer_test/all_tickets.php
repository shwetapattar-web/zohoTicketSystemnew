<?php
require_once "functions.php";
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$aTickets = get_all_tickets();

$iStatusFlag = 0;
if($_REQUEST['status'] == 'success') {
  $iStatusFlag = 1;
}

if($_REQUEST['status'] == 'error') {
  $iStatusFlag = 2;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Ticket</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="main.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>


    <link rel="stylesheet" href="pnotify/pnotify.custom.css">
    <script src='pnotify/pnotify.custom.js'></script>/
</head>
<body>
    <div class="page-header">
        <h4>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h4>
        <h4>All Tickets</h4><a href="logout.php" class="btn btn-danger" style="float:right;margin-top:10px;">Sign Out of Your Account</a>
    </div>
    <div class="container">
    <div class="col-sm-12">
    <a class="btn btn-success all-ticket-btn" href="new_ticket.php">Add New Ticket</a>
    <table  class="datatabel table table-bordered table-striped table-responsive table-hover" id='idTableTickets'>
          <thead>
              <tr>
                <th>Sr No</th>
                <th>TicketNumber</th>
                <th>email</th>
                <th>Subject</th>
                <th>Status</th>
              </tr>
          </thead>
          <tbody>
            <?php
                $iSrNo=0;
                foreach($aTickets as $thisTicket ){?>
                  <tr>
                    <td><?php echo ++$iSrNo; ?></td>
                    <td><?php echo $thisTicket['ticketNumber']; ?></td>
                    <td><?php echo $thisTicket['email']; ?></td>
                    <td><?php echo $thisTicket['subject']; ?></td>
                    <td><?php echo $thisTicket['status']; ?></td>
                  </tr>
            <?php }?>
          </tbody>
    </table>
    </div>
    </div>
</body>
<script type="text/javascript">


    let iStatusFlag = "<?php echo $iStatusFlag; ?>";
    window.oTableUIDataTable = $('#idTableTickets').dataTable( {
      "processing": true,
      "serverSide": false,
      "searching": false,
      "ordering": false,                   
      "pageLength":10,
      "order": [[ 1, "desc" ]],           
      "columnDefs": [],
      "lengthChange": false
  });

    function showAlert(sNotifyText, sNotifyType)
    {
        new PNotify({
            'text': sNotifyText,
            'type': 'error',
            'animation': 'none',
            'delay': 8000,
            'buttons':{
                'sticker': false
            }
        });
    }

   $(document).ready(function(){
      if(iStatusFlag == 1) {
        showAlert('Ticket created successfuly');
      } else if (iStatusFlag == 2) {
        showAlert('Error while creating ticket');
      }
   });
</script>
</html>
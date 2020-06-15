<?php
require_once "functions.php";

$iTicketNo = save_ticket($_POST);
if ($iTicketNo > 0 ) {
	header('location: all_tickets.php?status=success');
} else {
	header('location: all_tickets.php?status=error');
}
die;
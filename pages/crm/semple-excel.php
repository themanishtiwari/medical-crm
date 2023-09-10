<?php
session_start();
if (!isset($_SESSION['sr'])) {
      header('location: admin-login.php');
    }
    else{


	header('Content-Type:text/csv; charset:utf-8');
	header('Content-Disposition: attachment; filename=semple.csv');
	$output= fopen("php://output", "w");
	fputcsv($output, array('Date','Time','Name','Phone','Disease','Message','Address','Category','Source','Other'));
	}
	fclose($output);
	

?>
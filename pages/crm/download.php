<?php
session_start();
if (!isset($_SESSION['sr'])) {
      header('location: admin-login.php');
    }
    else{
include'../../dbcon.php';
$datee=$_SESSION['datee'];

	header('Content-Type:text/csv; charset:utf-8');
	header('Content-Disposition: attachment; filename=crm-data.csv');
	$output= fopen("php://output", "w");
	fputcsv($output, array('Date','Time','Name','Phone','Disease','Message','Other','Category','Address','Remark1','Remark2','Remark3','Remark4','Sources','Conversion Amount'));
	$query= "SELECT date, time, name, phone, disease,message,other,category,address,remark1,remark2,remark3,remark4,sources,amount FROM patients $datee ORDER BY sr DESC";
	$resul=mysqli_query($conn,$query);

	while ($ro= mysqli_fetch_assoc($resul)) {
		fputcsv($output,$ro);
	}
	fclose($output);
	
}
?>
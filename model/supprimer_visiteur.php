<?php
include('../controller/DBController.php');

if(!empty($_GET["CIN"])){
	$ids = mysqli_real_escape_string($conn,$_GET["CIN"]);
	$sql = "DELETE FROM visiteurs WHERE CIN='$ids'";
	$sql2 = "DELETE FROM visites WHERE CIN='$ids'";
	if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
        $message="تم حذف الزائر بنجاح";
	} else {
    	$message= "Erreur". mysqli_error($conn);
	}
	header("location:../view/ListeVisiteurs.php?message=$message");
}
mysqli_close($conn); 
?>
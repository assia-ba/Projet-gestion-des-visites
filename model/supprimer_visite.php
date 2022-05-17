<?php
include('../controller/DBController.php');

if(!empty($_GET["ID_visite"])){
	$ids = mysqli_real_escape_string($conn,$_GET["ID_visite"]);
	$sql = "DELETE FROM visites WHERE ID_visite=$ids";
	if (mysqli_query($conn, $sql)) {
        $message="تم حذف الزيارة بنجاح";
	} else {
    	$message= "Erreur" . mysqli_error($conn);
	}
	header("location:../view/resultatRecherche.php?message=$message");
}
mysqli_close($conn); 
?>
<?php
include('../controller/DBController.php');
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM communes WHERE commune like '" . $_POST["keyword"] . "%' ORDER BY commune LIMIT 0,6";
$result = mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result)) {
	$row1[] = $row;
	
if(!empty($row1)) {

?>
<ul id="commune-list" style='list-style:none;'>
<?php
foreach($result as $row) {
?>
<li onClick="selectCommune('<?php echo $row["commune"]; ?>', '<?php echo $row["pays"]; ?>', '<?php echo $row["province"]; ?>', '<?php echo $row["cercle"]; ?>', '<?php echo $row["caidat"]; ?>', '<?php echo $row["domaine"]; ?>');"><?php echo $row["commune"]; ?></li>
<?php } ?>
</ul>
<?php }  } } ?>
<?php 
include('../controller/DBController.php');
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM visiteurs WHERE CIN like '" . $_POST["keyword"] . "%' ORDER BY CIN LIMIT 0,5";
$result = mysqli_query($conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$row1[] = $row;
			if(!empty($row1)) { ?>
				<ul id="cin-list">
				<?php
				foreach($row1 as $visiteur) {
				?>
					<li onClick="selectCIN('<?php echo $visiteur["CIN"]; ?>', '<?php echo $visiteur["NomComplet"]; ?>', '<?php echo $visiteur["Adresse"]; ?>', '<?php echo $visiteur["NumTele"]; ?>');"><?php echo $visiteur["CIN"]; ?></li>
				<?php } ?>
				</ul>
				<?php } } } ?>
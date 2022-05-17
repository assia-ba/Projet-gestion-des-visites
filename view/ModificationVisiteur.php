<?php
include_once("../controller/verif_login.php");
include_once("C:\wamp64\www\Visites\model\model.php") ; 
include('../controller/DBController.php');
if(isset($_GET["CIN"])){
	$idm = mysqli_real_escape_string($conn,$_GET["CIN"]);
	$sql = "SELECT * FROM visiteurs WHERE CIN='".$idm."'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $CIN=$row["CIN"];
        $NomComplet=$row["NomComplet"];
        $Adresse=$row["Adresse"];
        $NumTele=$row["NumTele"];
    }  
}

    if(!empty($_GET["CIN"])){  
        if (isset($_POST["ok"]) ){
            $model = new Model(); 
            $model->ModifierVisiteur();
        }
    }
    
$sens="rtl";
?>
<html>
    <head>
        <meta charset="utf-8">
        <script src="../js/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script src="../js/readCIN.js" type="text/javascript"></script>
        <link href="..\css\style.css" rel="stylesheet" />
        <style>
            .vertical-menu a:hover:not(.active3) {
                background-color: #5d9ff0;
                color: black;
            }
            .vertical-menu a.active3 {
                background-color: #5d9ff0 !important;
                color: black;    
            }
            .img{
                width:100% !important;
            }
        </style>
        <title>تعديل معطيات الزائر</title>
    </head>
    <body dir=<?php echo $sens; ?>>
        <?php include_once("nvbar.php"); ?>
        <header><fieldset class="fieldset" style="margin-right:32%"><h1 style="color:#aecff8;text-align: center;">فضاء تسجيل الزيارات<h1></fieldset ></header> 
        <form name="frm" action="" method="post" class="frm">
            <fieldset class="fieldset">
                <h3><legend align="center">تعديل معطيات الزائر</legend></h3>
                    <table class="form-modification">
                        <tr>
                            <td>رقم البطاقة الوطنية:</td>
                            <td>
                                <div class="frmSearch">
                                    <input type="texte" name="CIN"  value="<?php if(isset($CIN)) { echo $CIN ; } ?>" id="search-box" required> 
                                    <div id="suggesstion-box"></div>
                                </div>
                            </td>
                            <td><br><br></td>
                            <td>الاسم الكامل:</td>
                            <td><input type="texte" name="NomComplet"  value="<?php if(isset($NomComplet)) { echo $NomComplet; } ?>" required></td>
                        </tr>
                        <tr>
                            <td>العنوان:</td>
                            <td><input type="texte" name="Adresse"  value="<?php if(isset($Adresse)) { echo $Adresse; } ?>" required>
                            </td>
                            <td><br><br></td>
                            <td>الهاتف:</td>
                            <td><input type="texte" name="NumTele"  value="<?php if(isset($NumTele)) { echo $NumTele; } ?>" required></td>
                        </tr>
                        <tr>
                            <td><input Type="submit" style='width:100%' value="تعديل" name="ok"></td>
                        </tr>
                    </table>
            </fieldset>
        </form>
    </body>
</html>

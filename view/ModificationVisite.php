<?php
include_once("../controller/verif_login.php");
include_once("C:\wamp64\www\Visites\model\model.php") ; 
include('../controller/DBController.php');
if(isset($_GET["ID_visite"])){
	$idm = mysqli_real_escape_string($conn,$_GET["ID_visite"]);
	$sql = "SELECT * FROM visites WHERE ID_visite='".$idm."'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $ID_commune=$row["ID_commune"];
        $Date=$row["Date"];
        $Nature=$row["Nature"];
        $ID_service=$row["ID_service"];
        $Sujet=$row["Sujet"];
        $Observations=$row["Observations"];
    }

    $sql= "SELECT * FROM communes WHERE ID_commune='".$ID_commune."'";
    $result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $ID_commune=$row["ID_commune"];
        $pays=$row["pays"];
        $province=$row["province"];
        $commune=$row["commune"];
        $cercle=$row["cercle"];
        $caidat=$row["caidat"];
        $domaine=$row["domaine"];
    }

    $sql= "SELECT * FROM services WHERE ID_service='".$ID_service."'";
    $result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $ID_service=$row["ID_service"];
        $service=$row["Service"];
        $division=$row["Division"];
    }
}

    if(!empty($_GET["ID_visite"])){  
        if (isset($_POST["ok"]) ){
            $model = new Model(); 
            $model->ModifierVisite();
        }
    }
    
    $sens="rtl";
?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet"  type="text/css" href="..\css\commune-list.css"/>
        <link href="..\css\style.css" rel="stylesheet" />
        <script src="../js/jquery.min.js"></script>
        <link href="../css/select2.min.css" rel="stylesheet" />
        <script src="../js/select2.min.js"></script>
        <script src="../js/readCommune.js" type="text/javascript"></script>
        <style>
            .vertical-menu a:hover:not(.active2) {
                background-color: #5d9ff0;
                color: black;
            }
            .vertical-menu a.active2 {
                background-color: #5d9ff0 !important;
                color: black;   
            }
            #commune-list{
                width: 15%;
            }
            .img{
                width:100% !important;
            }
        </style>
        <title>تعديل معطيات الزيارة</title>
    </head>
    <body dir=<?php echo $sens; ?>>
        <?php include_once("nvbar.php"); ?>
        <header><fieldset class="fieldset" style="margin-right:32%"><h1 style="color:#aecff8;text-align: center;">فضاء تسجيل الزيارات<h1></fieldset ></header> 
        <script src="../js/filtrerCommuneService.js" type="text/javascript"></script>
        <form name="frm" action="" method="post" class="frm">
      		<fieldset class="fieldset">
                <h3><legend align="center">تعديل معطيات الزيارة</legend></h3>
                    <table class="form-modification">
                        <tr>
                            <td>الجماعة:</td>
                            <td>
                                <select name="Commune" id="selectCommune" action="" class="commune" style="width: 270px" required>
                                    <option value="<?php  echo $ID_commune; ?>"><?php echo $pays." ".$commune." ".$province." ".$caidat." ".$cercle." ".$domaine; ?></option>
                                    <?php
                                    /*$conn= mysqli_connect("localhost","root","","visite");
                                    mysqli_set_charset($conn,"utf8");*/
                                        $sql = "SELECT * FROM communes";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)) {
                                    ?> 
                                                <option value="<?php  echo $row['ID_commune']; ?>"><?php echo $row['pays']." ".$row['commune']." ".$row['province']." ".$row['caidat']." ".$row['cercle']." ".$row['domaine']; ?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                                <button id="addCommune" style="width:auto;">+</button>
                                <script src="../js/GetFormCommune.js"></script>
                            </td>
                            <td><br><br></td>
                            <td>تاريخ الزيارة:</td>
                            <td><input type="date" name="Date" value="<?php if(isset($Date)){echo $Date;}  ?>" required></td>
                        </tr>
                        <tr>
                            <td>نوع الزيارة:</td>  
                            <td>
                                <?php if($Nature=='جماعية'){?>
                                    فردية<input type="radio" name="Type" value="فردية" required>
                                    جماعية<input type="radio" name="Type" value="جماعية" checked> 
                                    <?php }
                                    else { ?>
                                        فردية<input type="radio" name="Type" value="فردية" checked required>
                                        جماعية<input type="radio" name="Type" value="جماعية"> 
                                    <?php } ?>
                            </td>
                            <td><br><br></td>
                            <td>المصلحة المعنية:</td>
                            <td>
                                <select name="Service" action="" class="service" style="width: 270px" required>
                                    <option value="<?php  echo $ID_service; ?>" ><?php echo $service." ".$division; ?></option>
                                    <?php
                                   /* $conn= mysqli_connect("localhost","root","","visite");
                                    mysqli_set_charset($conn,"utf8");*/
                                        $sql = "SELECT * FROM services";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)) { ?>
                                                <option value="<?php  echo $row['ID_service']; ?>"><?php echo $row['Service']." ".$row['Division']; ?></option>
                                        <?php }
                                        } ?>
                                </select>    
                            </td>
                        </tr>
                        <tr>
                            <td>موضوع الزيارة:</td>
                            <td><input type="texte" name="Sujet" value="<?php if(isset($Sujet)) {echo $Sujet;} ?>" required></td>
                            <td><br><br></td>
                            <td>ملاحظات:</td>
                            <td><textarea name="Observations" cols="18" rows="2" value="<?php if(isset($Observations)){echo $Observations;}  ?>"><?php if(isset($Observations)){echo $Observations;}  ?></textarea></td>
                        </tr>
                        <tr>
                            <td><input Type="submit" style='width:100%' value="تعديل" name="ok"></td>
                        </tr>
                    </table>
      		    </fieldset>
        </form>
        <div id="id01" class="modal">
            <form class="modal-content animate" id="commune_form" action="../model/commune.php" method="post">
                <div class="container">
                    <h3><legend align="center">إضافة جماعة جديدة</legend></h3>
                    <table>
                        <tr>
                            <td>البلد:</td>
                            <td><input type="text" name="pays"></td>
                            <td>العمالة:</td><td><input type="text" name="province"></td>
                        </tr>
                        <tr>
                            <td>الجماعة:</td>
                            <td><input type="text" id="searchCommune" name="commune" required></td>
                            <div id="suggesstionCommune"></div>
                            <td>الدائرة:</td>
                            <td><input type="text" name="cercle"></td>
                        </tr>
                        <tr>
                            <td>القيادة:</td>
                            <td><input type="text" name="caidat"></td>
                            <td>المجال:</td>
                            <td><input type="text" name="domaine"></td>
                        </tr>
                    </table>
                    <button type="submit"  id="saveCommune" name="ok">تم</button>
                    <script src="../js/selectCommune.js" type="text/javascript"></script>
                    <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">إلغاء</button>
                </div>
            </form>
        </div>
    </body>
</html>

<?php
include_once("../controller/verif_login.php");
include_once("../controller/controller.php") ; 
include('../controller/DBController.php');
if(isset($_GET["message"])){
	$message=$_GET["message"];
}

$controller = new Controller();
if (isset($_POST['Ajouter']))  
{  
    $controller->ajout();
}

?>
<!Doctype html>
<html>
    <head>
        <style>
            .vertical-menu a:hover:not(.active1) {
                background-color: #5d9ff0;
                color: black;
            }
            .vertical-menu a.active1 {
                background-color: #5d9ff0 !important;
                color: black;    
            }
        </style>
        <link rel="stylesheet"  type="text/css" href="..\css\style.css"/>
        <link rel="stylesheet"  type="text/css" href="..\css\commune-list.css"/>
        <script src="../js/jquery-2.1.1.min.js" type="text/javascript"></script>
        <!-- suggestion cin + saisie nomComplet, adresse et numTele -->
        <script src="../js/readCIN.js" type="text/javascript"></script>
        <script src="../js/readCommune.js" type="text/javascript"></script>
        <meta charset="utf-8">
        <script src="../js/jquery.min.js"></script>
        <link href="../css/select2.min.css" rel="stylesheet" />
        <script src="../js/select2.min.js"></script>
        <title>إضافة زيارة</title>
    </head>
   
    <?php  $sens="rtl" ?>
    <body dir=<?php echo $sens; ?>>
        <?php include_once("nvbar.php"); ?>
        <header><fieldset class="fieldset" style="margin-right:32%"><h1 style="color:#aecff8;text-align: center;">فضاء تسجيل الزيارات<h1></fieldset ></header> 
        <!-- filtre des listes des services et des communes -->
        <script src="../js/filtrerCommuneService.js" type="text/javascript"></script> 
        <form  action="" method="post" class="frm" >
            <fieldset class="fieldset">
            <p align="center" style='color:green'><?php if (isset($message)){echo"$message";}?></p>
                <h3><legend align="center">إضافة زيارة</legend></h3>
                <table class="table" >
                    <tr>
                        <td>رقم البطاقة الوطنية:</td>
                        <td>
                            <div class="frmSearch">
                                <input type="texte" name="CIN"  id="search-box" required oninvalid="this.setCustomValidity('المرجو إدخال رقم البطاقة الوطنية')" oninput="this.setCustomValidity('')" placeholder="رقم البطاقة الوطنية" autocomplete="off"> 
                                <div id="suggesstion-box"></div>
                            </div>
                        </td>
                        <td><br><br></td>
                        <td>الاسم الكامل:</td>
                        <td><input type="texte" id="name" name="NomComplet" required oninvalid="this.setCustomValidity('المرجو إدخال الإسم الكامل')" oninput="this.setCustomValidity('')" placeholder="الإسم الكامل" autocomplete="off"> </td>
                    </tr>
                    <tr>
                        <td>العنوان:</td>
                        <td><input type="texte" id="adresse" name="Adresse" required oninvalid="this.setCustomValidity('المرجو إدخال العنوان')" oninput="this.setCustomValidity('')" placeholder="العنوان" autocomplete="off"></td>
                        <td><br><br></td>
                        <td>الهاتف:</td>
                        <td><input type="text" id="numTele" name="NumTele" required oninvalid="this.setCustomValidity('المرجو إدخال رقم الهاتف')" oninput="this.setCustomValidity('')" placeholder="&#x1F57E;رقم الهاتف"  autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td>
                            <div id="commune">
                            الجماعة:
                        </td>
                        <td>
                            <select name="Commune" style='width:207px !important;' id="selectCommune" action="" class="commune" required oninvalid="this.setCustomValidity('المرجو إختيار الجماعة')" oninput="this.setCustomValidity('')"  >
                                <option value="" ><?php echo ""; ?></option>
                                <div id="communeList" >
                                    <?php
                                        
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
                                </div>
                            </select>
                            <button id="addCommune" style="width:auto;">+</button>
                            <script src="../js/GetFormCommune.js"></script>
                            </div>
                        </td>
                        <td><br><br></td>
                        <td>تاريخ الزيارة:</td>
                        <td><input type="date" name="Date" value="<?php echo date('Y-m-d'); ?>" required style='width:80%'></td>
                    </tr>
                    <tr>
                        <td>نوع الزيارة:</td>
                        <td>
                            فردية<input type="radio" name="Type" value="فردية" checked required oninvalid="this.setCustomValidity('المرجو تحديد نوع الزيارة')" oninput="this.setCustomValidity('')">
                            جماعية<input type="radio" name="Type" value="جماعية">
                        </td>
                        <td><br><br></td>
                        <td>المصلحة المعنية:</td>
                        <td>
                            <select name="Service" action="" class="service" style='width:270px !important;' required oninvalid="this.setCustomValidity('المرجو إختيار المصلحة المهنية بالزيارة')" oninput="this.setCustomValidity('')">
                                <option ></option>
                                <?php
                                $sql = "SELECT * FROM services";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) { ?>
                                        <option value="<?php  echo $row['ID_service']; ?>"><?php echo $row['Service']." / ".$row['Division']; ?></option>
                                <?php }
                                }
                            ?>
                            </select> 
                        </td> 
                    </tr>
                    <tr>
                        <td>موضوع الزيارة:</td>
                        <td><input type="texte" name="Sujet" required oninvalid="this.setCustomValidity('المرجو تحديد موضوع الزيارة')" oninput="this.setCustomValidity('')" placeholder="موضوع الزيارة"></td>
                        <td><br><br></td>
                        <td>ملاحظات:</td>
                        <td><textarea name="Observations" cols="20" rows="2" placeholder="ملاحظات"></textarea>
                        </td>
                    </tr>
                </table>
                        <input type="reset" name="Annuler" value="اعادة">
                        <input type="submit" name="Ajouter" value="اضافة">
            </fieldset>  
        </form>
        <div id="id01" class="modal" style=" display: none !important; ">
            <form class="modal-content" id="commune_form" action="../model/commune.php" method="post">
                <div class="container">
                <h3><legend align="center">إضافة جماعة جديدة</legend></h3>
                <table>
                        <tr>
                            <td>البلد:</td>
                            <td><input type="text" name="pays" id="pays"></td>
                            <td>العمالة:</td><td><input type="text" name="province" id="province"></td>
                        </tr>
                        <tr>
                            <td>الجماعة:</td>
                            <td><input type="text" id="searchCommune" name="commune" required></td>
                            <div id="suggesstionCommune"></div>
                            <td>الدائرة:</td>
                            <td><input type="text" name="cercle" id="cercle"></td>
                        </tr>
                        <tr>
                            <td>القيادة:</td>
                            <td><input type="text" name="caidat" id="caidat"></td>
                            <td>المجال:</td>
                            <td><input type="text" name="domaine" id="domaine"></td>
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

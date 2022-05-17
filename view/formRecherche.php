<?php
    include('../controller/DBController.php');
    $CIN="";
    $NomComplet="";
    $DateDebut="";
    $DateFin=  Date('Y-m-d');
    $Nature="";
    $Commune="";
    $Service="";

    if(isset($_POST["Ajouter"])){
        $CIN=$_POST["CIN"];
        $NomComplet=$_POST["NomComplet"];
        $DateDebut=$_POST["DateDebut"];
        $DateFin=$_POST["DateFin"];
        $Nature=$_POST["Type"];
        $Commune=$_POST["Commune"];
        $Service=$_POST["Service"];
        }
    if (isset($_GET["CIN"])) {    
        $CIN = $_GET["CIN"];    
    }   
    if (isset($_GET["NomComplet"])) {    
        $NomComplet  = $_GET["NomComplet"];    
    }   
    if (isset($_GET["DateDebut"])) {    
        $DateDebut  = $_GET["DateDebut"];    
    }
    if (isset($_GET["DateFin"])) {    
        $DateFin  = $_GET["DateFin"];    
    }    
    if (isset($_GET["Nature"])) {    
        $Nature  = $_GET["Nature"];    
    }    
    if (isset($_GET["Commune"])) {    
        $Commune  = $_GET["Commune"];    
    }  
    if (isset($_GET["Service"])) {    
        $Service  = $_GET["Service"];    
    }   
?>
<!Doctype html>
<html>
<head>
    <script src="../js/jquery.min.js"></script>
    <link rel="stylesheet"  type="text/css" href="..\css\style.css"/>
    <link href="../css/select2.min.css" rel="stylesheet" />
    <script src="../js/select2.min.js"></script>
    <script src="../js/readCommune.js" type="text/javascript"></script>
    <script src="../js/readCIN.js" type="text/javascript"></script>
    <link rel="stylesheet"  type="text/css" href="..\css\commune-list.css"/>
    <script src="../js/jquery.confirm.js"></script>
    <title></title>
</head>
<?php  $sens="rtl" ?>
<body dir=<?php echo $sens; ?>>
    <script>
        $(".suppression").confirm();  
    </script>  
    <script src="../js/filtrerCommuneService.js" type="text/javascript"></script>
    <style>
        #commune-list{
            margin-right: 175px !important;
            width: 16%;
        }
    </style>
    <form  action="resultatRecherche.php" method="post" class="frm-recherche" >
        <fieldset class="fieldset">
            <h3><legend align="center">بحث</legend></h3>
            <table class="form-recherche">
                <tr>
                    <td>رقم البطاقة الوطنية:</td>
                    <td>
                        <div class="frmSearch">
                            <input type="texte" name="CIN"  id="search-box" placeholder="رقم البطاقة الوطنية" autocomplete="off" value="<?php echo $CIN; ?>"> 
                            <div id="suggesstion-box"></div>
                        </div>
                    </td>
                    <td>الاسم الكامل:</td>
                    <td><input type="texte" id="name" name="NomComplet" placeholder="الإسم الكامل" autocomplete="off" value="<?php echo $NomComplet; ?>"> </td>
                </tr>
                <tr>
                    <td>الجماعة:</td>
                    <td><input type="texte" id="searchCommune" name="Commune" placeholder="الجماعة" autocomplete="off" value="<?php echo $Commune; ?>"> </td>
                    <div id="suggesstionCommune"></div>
                    <td >المصلحة المعنية:</td>
                    <td >
                        <?php
                        $ID_service="";
                        $service="";
                        $division="";
                        $sql= "SELECT * FROM services WHERE ID_service='".$Service."'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $ID_service=$row["ID_service"];
                            $service=$row["Service"];
                            $division=$row["Division"];
                        }
                        ?>
                        <select name="Service" action="" class="service" style='width:270px !important;'>
                            <option value="<?php  echo $ID_service; ?>" ><?php echo $service." ".$division; ?></option>
                            <?php
                            $sql = "SELECT * FROM services";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                ?> 
                            <option value="<?php  echo $row['ID_service']; ?>"><?php echo $row['Service']." / ".$row['Division']; ?></option>
                            <?php
                            }
                        }
                        ?>
                        </select>   
                    </td>
                </tr>
                <tr>
                    <td>نوع الزيارة:</td>
                    <td colspan="2">
                        <?php if($Nature=='جماعية'){?>
                            فردية<input type="radio" name="Type" value="فردية" >
                            جماعية<input type="radio" name="Type" value="جماعية" checked>
                            الكل<input type="radio" name="Type" value="" > <?php }
                            if($Nature=='فردية') { ?>
                                فردية<input type="radio" name="Type" value="فردية" checked >
                                جماعية<input type="radio" name="Type" value="جماعية"> 
                                الكل<input type="radio" name="Type" value="" ><?php }
                            if($Nature=='') {    ?>
                            فردية<input type="radio" name="Type" value="فردية">
                            جماعية<input type="radio" name="Type" value="جماعية">
                            الكل<input type="radio" name="Type" value="" checked>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                   
                </tr>
                <tr>
                    <td >تاريخ الزيارة:</td>
                </tr>
                <tr>
                    <td colspan="2">من : <input type="date" name="DateDebut" value="<?php echo $DateDebut; ?>" width="100%" ></td>  
                    <td  colspan="2">إلى : <input type="date" name="DateFin" value="<?php echo $DateFin; ?>" width="100%"> </td> 
                </tr>            
            </table>
            <input type="reset" name="Annuler" value="اعادة">
            <input type="submit" name="Ajouter" value="بحث&#x1F50D;"> 
        </fieldset>    
    </form>
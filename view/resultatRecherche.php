
<?php 
include_once("../controller/verif_login.php");
include_once("C:\wamp64\www\Visites\model\model.php") ; 
if(isset($_GET["message"])){
    $message=$_GET["message"];
    }
$sens="rtl";  
?>
<html>
    <head>
        <script src="../js/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script src="../js/jquery.min.js"></script>
        <link href="../css/select2.min.css" rel="stylesheet" />
        <script src="../js/select2.min.js"></script>
        <script src="../js/readCommune.js" type="text/javascript"></script>
        <script src="../js/readCIN.js" type="text/javascript"></script>
        <link rel="stylesheet"  type="text/css" href="..\css\commune-list.css"/>
        <link rel="stylesheet"  type="text/css" href="..\css\style.css"/>
        <link rel="stylesheet" href="../css/pagination.css" type="text/css" />
        
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery-1.9.1.min.js"></script>
        <script src="../js/jquery.confirm.js"></script>
        <meta charset="utf-8">
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
                margin-right: 195px;
                width: 16%;
            }
            .img{
                width:100% !important;
            }
        </style>
        <script src="../js/filtrerCommuneService.js" type="text/javascript"></script>
        <title>لائحة الزيارات </title>   
    </head>
    <body dir=<?php echo $sens; ?>>
        <?php include_once("nvbar.php"); ?>
        <header><fieldset class="fieldset" style="margin-right:32%"><h1 style="color:#aecff8;text-align: center;">فضاء تسجيل الزيارات<h1></fieldset ></header> 
        <?php include_once("formRecherche.php"); ?>
        <table width="100%" align="center" border="1" class="tab" >
            <?php 
                include("../controller/DBController.php");
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
            <a href="../model/csvListeVisites.php?CIN=<?php echo $CIN ?>&amp;NomComplet=<?php echo $NomComplet; ?>&amp;Service=<?php echo $Service; ?>&amp;Commune=<?php echo $Commune; ?>&amp;Nature=<?php echo $Nature; ?>&amp;DateDebut=<?php echo $DateDebut; ?>&amp;DateFin=<?php echo $DateFin; ?>"><button type="button" style="margin-right:115%;" class="btn btn-info" >تحميل لائحة الزيارات</button></a>
            <caption>
                <h3><b>لائحة الزيارات</h3></b>
                <p align="center" style='color:green'><?php if (isset($message)){echo"$message";}?><p>
            </caption>
            <thead>
                <tr>
                    <th>رقم الزيارة</th>
                    <th>رقم البطاقة الوطنية</th>
                    <th>الاسم الكامل</th>
                    <th>العنوان</th>
                    <th>رقم الهاتف</th>
                    <th>الجماعة</th>
                    <th>تاريخ الزيارة</th>
                    <th>نوع الزيارة</th>
                    <th>المصلحة المعنية</th>
                    <th>موضوع الزيارة</th>
                    <th>ملاحظات</th>
                    <th colspan="2">الخيارات</th>
                </tr>
            </thead>
            <tbody align="center">
                <?php 
                    $model = new Model(); 
                    $model->rechercherVisites();  
                ?>
                <script>
                    $(".suppression").confirm(
                        {
                        title:"هل أنت متأكد؟",
                        text: "هل تريد حذف هذه الزيارة؟",
                        confirmButton: "نعم",
                        cancelButton: "لا"
                    }
                    );
                </script>
                <script src="../js/bootstrap.min.js"></script>
            </tbody>
        </table>
        <?php include_once("../model/paginationResultat.php"); ?>
    </body>
</html>	
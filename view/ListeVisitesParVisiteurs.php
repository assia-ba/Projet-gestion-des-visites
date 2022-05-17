<?php 
include_once("../controller/verif_login.php");
include_once("C:\wamp64\www\Visites\model\model.php") ; 
$sens="rtl";

?>
<html>
    <head>
        <link rel="stylesheet" href="../css/pagination.css" type="text/css" />
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery-1.9.1.min.js"></script>
        <script src="../js/jquery.confirm.js"></script>
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
        <meta charset="utf-8">
        <link href="..\css\style.css" rel="stylesheet" />
        <title>لائحة الزيارات الخاصة بالزائر </title>
    </head>
    <body dir=<?php echo $sens; ?>>
        <?php include_once("nvbar.php"); ?>
        <header><fieldset class="fieldset" style="margin-right:32%"><h1 style="color:#aecff8;text-align: center;">فضاء تسجيل الزيارات<h1></fieldset ></header> 
        <table width="100%" align="center" border="1" class="tab">
            <caption><h3><b>المعطيات الشخصية للزائر</h3></b></caption>
            <thead>
                <tr>
                    <th>رقم البطاقة الوطنية</th>
                    <th>الاسم الكامل</th>
                    <th>العنوان</th>
                    <th>رقم الهاتف</th>
                    <th colspan="2">الخيارات</th>
                </tr>
            </thead>
            <tbody align="center">
                <?php 
                    $model = new Model(); 
                    $model->infoVisiteur();    
                ?>
            </tbody>
        </table>
        <table width="100%" align="center" border="1" class="tab">
            <?php 
                include("../controller/DBController.php");
                if (!empty($_GET["CIN"])){
                $ids = mysqli_real_escape_string($conn,$_GET["CIN"]);} 
            ?>
            <a href="../model/csvListeVisitesParVisiteur.php?CIN=<?php echo "$ids" ?>"><button type="button" style="margin-right:115%;" class="btn btn-info" >تحميل لائحة الزيارات</button></a>
            <caption><h3><b>لائحة الزيارات الخاصة به</h3></b></caption>
            <thead>
            <tr>
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
                    $model->visites();    
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
                    $(".suppressionVisiteur").confirm(
                        {
                        title:"هل أنت متأكد؟",
                        text: "هل تريد حذف هذا الزائر؟",
                        confirmButton: "نعم",
                        cancelButton: "لا"
                    }
                    );
                </script>
                <script src="../js/bootstrap.min.js"></script>
            </tbody>
        </table>
        <?php include_once("../model/paginationVisitesParVisiteur.php"); ?> 
    </body>
</html>	
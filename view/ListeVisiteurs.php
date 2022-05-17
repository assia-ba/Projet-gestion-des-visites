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
        <title>لائحة الزوار</title>
    </head>
    <body dir=<?php echo $sens; ?>>
        <?php include_once("nvbar.php"); ?>
        <header><fieldset class="fieldset" style="margin-right:32%"><h1 style="color:#aecff8;text-align: center;">فضاء تسجيل الزيارات<h1></fieldset ></header> 
        <a href="../model/csvListeVisiteurs.php"><button type="button" style="margin-right:115%;" class="btn btn-info" >تحميل لائحة الزوار</button></a>
        <table width="100%" align="center" border="1" class="tab">
            <caption>
                <h3><b>لائحة الزوار</h3></b>
                <p align="center" style='color:green' class="message"><?php if(isset($message)) { echo "$message"; } ?></p>
            </caption>
            <thead>
            <tr>
                <th>رقم البطاقة الوطنية</th>
                <th>الاسم الكامل</th>
                <th>العنوان</th>
                <th>الهاتف</th>
                <th colspan="3">الخيارات</th>
            </tr>
            </thead>
            <tbody align="center">
                <?php 
                    $model = new Model(); 
                    $model->AfficherVisiteurs();
                ?>
                <script>
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
        <?php include_once("../model/paginationVisiteurs.php"); ?> 
    </body>
</html>	
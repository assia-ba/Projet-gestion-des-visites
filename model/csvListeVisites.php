<?php
include ('../controller/DBController.php'); 
header("Content-Encoding: UTF-16LE");
    
header("Content-type: text/csv; charset=UTF-16LE");

header("Content-disposition: attachment; filename=liste-visites.xls");
?>


<table width="100%" align="center" border="1" class="tab" style="font-size:20px;">

<caption>
    <h3 style=" color:red;font-size:25px;"><b>لائحة الزيارات</h3></b>
</caption>
<thead align="center">
    <tr>
        <th style="background-color:pink;">ملاحظات</th>
        <th style="background-color:pink;">موضوع الزيارة</th>
        <th style="background-color:pink;">المصلحة المعنية</th>
        <th style="background-color:pink;">نوع الزيارة</th>
        <th style="background-color:pink;">تاريخ الزيارة</th>
        <th style="background-color:pink;">الجماعة</th>
        <th style="background-color:pink;">رقم الهاتف</th>
        <th style="background-color:pink;">العنوان</th>
        <th style="background-color:pink;">الاسم الكامل</th>
        <th style="background-color:pink;">رقم البطاقة الوطنية</th>
        <th style="background-color:pink;">رقم الزيارة</th>
    </tr>
</thead>
<tbody >
    <?php 
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
    
       $whereCondition = "";
       if(!empty($CIN)){
           $whereCondition .= " and v.CIN like '%$CIN%'";
       }
       if(!empty($NomComplet)){
           $whereCondition .= " and vr.NomComplet like '%$NomComplet%'";
       }
       if(!empty($Service)){
           $whereCondition .= " and s.ID_service = '$Service'";
       }
       if(!empty($Commune)){
           $whereCondition .= " and c.commune like '%$Commune%'";
       }
       if(!empty($Nature)){
           $whereCondition .= " and v.Nature like '%$Nature%'";
       }
       if(!empty($DateDebut) && !empty($DateFin)){
           $whereCondition .= " and  v.Date between '$DateDebut' and '$DateFin'";
       }
       if(!empty($DateDebut) && empty($DateFin)){
           $DateFin=  date('Y-m-d');
           $whereCondition .= " and  v.Date between '$DateDebut' and '$DateFin '";
       }
       if(empty($DateDebut) && !empty($DateFin)){
           $whereCondition .= " and  v.Date between '2013-01-13' and '$DateFin '";
       }
       $sql = "select v.ID_visite, v.CIN, v.Date, v.Nature, v.Sujet, v.Observations, vr.NomComplet, vr.Adresse,vr.NumTele, c.pays, c.province, c.cercle, c.caidat, c.commune, s.Division, s.Service from communes c, services s, visites v, visiteurs vr
       where v.CIN=vr.CIN and v.ID_service=s.ID_service and c.ID_commune=v.ID_commune ".$whereCondition." order BY ID_visite DESC ";     
       $result = mysqli_query ($conn, $sql);    
       if (mysqli_num_rows($result)> 0){
           $table_content ="";
           while($row=mysqli_fetch_assoc($result)){
               $id=$row['ID_visite'];
               $table_content .=
               "<tr><td align='center'>".$row["Observations"]
               ."</td><td align='center'>".$row["Sujet"]
               ."</td><td align='center'>".$row["Service"]." ".$row["Division"]
               ."</td><td align='center'>".$row["Nature"]
               ."</td><td align='center'>".$row["Date"]
               ."</td><td align='center'>".$row["pays"]." ".$row["province"]." ".$row["commune"]." ".$row["cercle"]." ".$row["caidat"]
               ."</td><td align='center'>".$row["NumTele"]
               ."</td><td align='center'>".$row["Adresse"]
               ."</td><td align='center'>".$row["NomComplet"]
               ."</td><td align='center'>".$row["CIN"]
               ."</td><td align='center'>".$row["ID_visite"]
               ."</td></tr>";
               }
               echo $table_content;     
       }
    ?>
</tbody>
</table>

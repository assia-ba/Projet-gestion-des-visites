<?php
include ('../controller/DBController.php');

header("Content-Encoding: UTF-16LE");
header("Content-type: text/csv; charset=UTF-16LE");
header("Content-disposition: attachment; filename=liste-visites.xls");
?>
<?php  $sens="rtl" ?>
    <body dir=<?php echo $sens; ?>>
<table width="100%" align="center" border="1" class="tab" style="font-size:20px;">
        <caption><h3><b>المعطيات الشخصية للزائر</h3></b></caption>
        <thead>
            <tr>
                <th style="background-color:pink;">العنوان</th>
                <th style="background-color:pink;">رقم الهاتف</th>
                <th style="background-color:pink;">الاسم الكامل</th>
                <th style="background-color:pink;">رقم البطاقة الوطنية</th>
            </tr>
        </thead>
        <tbody align="center">
            <?php 
             if (!empty($_GET["CIN"])){
                 $ids = mysqli_real_escape_string($conn,$_GET["CIN"]);
                 $sql = "select  vr.CIN, vr.NomComplet, vr.Adresse, vr.NumTele from visiteurs vr
                 where  LOWER(vr.CIN) = LOWER('".$ids."')";
                 $result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
                 if (mysqli_num_rows($result)> 0){
                     $table_content ="";
                     $row=mysqli_fetch_assoc($result);
                     $table_content .=
                     "<tr><td align='center'>".$row["NumTele"]
                     ."</td><td align='center'>".$row["Adresse"]
                     ."</td><td align='center'>".$row["NomComplet"]
                     ."</td><td align='center'>".$row["CIN"]
                     ."</td></tr>" ;
                     echo $table_content;
                 }           
         }
            ?>
         </tbody>
        </table>
        <table width="100%" align="center" border="1" class="tab" style="font-size:20px;">
            <caption><h3><b>لائحة الزيارات الخاصة به</h3></b></caption>
            <thead>
                <tr>
                    <th style="background-color:pink;">ملاحظات</th>
                    <th style="background-color:pink;">موضوع الزيارة</th>
                    <th style="background-color:pink;">المصلحة المعنية</th>
                    <th style="background-color:pink;">نوع الزيارة</th>
                    <th style="background-color:pink;">تاريخ الزيارة</th>
                    <th style="background-color:pink;">الجماعة</th>
                </tr>
            </thead>
            <tbody align="center">
                <?php 
                  if (!empty($_GET["CIN"])){
                    $ids = mysqli_real_escape_string($conn,$_GET["CIN"]);
                    $sql = "select  v.Date, v.Nature, v.ID_visite, v.Sujet, v.Observations, c.pays, c.province, c.cercle, c.caidat, c.commune, s.Division, s.Service from communes c, services s, visites v, visiteurs vr
                    where v.CIN=vr.CIN and v.ID_service=s.ID_service and c.ID_commune=v.ID_commune  AND LOWER(vr.CIN) = LOWER('".$ids."') ORDER BY ID_visite DESC ";
                    $result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
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
                            ."</td></tr>";
                            }                                                                                
                            echo $table_content;
                }
            }         
                ?>
            </tbody>
        </table>
        </body>
       
<?php
include ('../controller/DBController.php'); 
header("Content-Encoding: UTF-16LE");
header("Content-type: text/xls; charset=UTF-16LE");
header("Content-disposition: attachment; filename=liste-visiteurs.xls");
?>

<table width="100%" align="center" border="1" class="tab" style="font-size:20px;">
            <caption >
                <h3 style=" color:red;font-size:25px;"><b>لائحة الزوار</h3></b>
            </caption>
           
            <thead >
            <tr>
                <th style="background-color:pink;">الهاتف</th>
                <th style="background-color:pink;">العنوان</th>
                <th style="background-color:pink;">الاسم الكامل</th >
                <th style="background-color:pink;">رقم البطاقة الوطنية</th>
            </tr>
            </thead>
            <tbody align="center">
                <?php 
                  $sql="SELECT * FROM visiteurs ";
                  $result=mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)> 0){
                      $table_content = "";
                      while($row=mysqli_fetch_assoc($result)){
                          $id=$row['CIN'];
                          $table_content .=
                          "<tr><td align='center'>".$row["NumTele"]
                          ."</td><td align='center'>".$row["Adresse"]
                          ."</td><td align='center'>".$row["NomComplet"]
                          ."</td><td align='center'>".$row["CIN"]
                          ."</td></tr>";
                      }
                      echo $table_content;  }
                ?>
            </tbody>
        </table> 
  
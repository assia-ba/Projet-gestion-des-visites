<?php 
       $conn = new mysqli("localhost","root","","visite");
        mysqli_set_charset($conn,"utf8");
        if (isset($_POST['commune']))  
        {  
            $pays=$_POST["pays"];
            $province=$_POST["province"];
            $commune=$_POST["commune"];
            $cercle=$_POST["cercle"];
            $caidat=$_POST["caidat"];
            $domaine=$_POST["domaine"];
            
            $sql="INSERT INTO communes (pays, province, commune, cercle, caidat, domaine)
            Values('{$pays}','{$province}','{$commune}','{$cercle}','{$caidat}','{$domaine}')";
            if(mysqli_query($conn,$sql)){
                $sql="SELECT ID_commune FROM communes WHERE pays='".$pays."' AND province='".$province."' AND commune='".$commune."' AND caidat='".$caidat."' AND cercle='".$cercle."' AND domaine='".$domaine."'";
                $res=mysqli_query($conn, $sql);
                $row=mysqli_fetch_assoc($res);
                $ID_commune=$row['ID_commune'];  
                $tab=array($ID_commune, $pays, $province, $commune, $cercle, $caidat, $domaine);
                echo json_encode($tab);
            }
        }
        
?>
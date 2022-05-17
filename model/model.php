<?php
include_once('C:\wamp64\www\Visites\controller\controller.php');

class Model
{
    public function ajouter()
    {
        include('../controller/DBController.php');

        $CIN=$_POST["CIN"];
        $NomComplet=$_POST["NomComplet"];
        $Adresse=$_POST["Adresse"];
        $NumTele=$_POST["NumTele"];
        $Date=$_POST["Date"];
        $Type=$_POST["Type"];
        $Sujet=$_POST["Sujet"];
        $Commune=$_POST["Commune"];
        $Service=$_POST["Service"];
        $Observations=$_POST["Observations"];
            
        $ID_commune=$_POST["Commune"]; 
         
        $ID_service=$_POST["Service"];

        $select = mysqli_query($conn, "SELECT * FROM visiteurs WHERE LOWER(CIN) = LOWER('".$_POST['CIN']."')");
        if(mysqli_num_rows($select))
        {
        }
        else{
            $sql="INSERT INTO visiteurs (CIN, NomComplet, Adresse, NumTele)
            Values('{$CIN}','{$NomComplet}','{$Adresse}','{$NumTele}')";
            if(mysqli_query($conn,$sql)){
                //echo "Le visiteur a été ajouté!";
            }
            else{
            echo "Erreur".$sql."<br>".mysqli_error($conn);
            }
        }
        $sql="INSERT INTO visites (CIN, Date, Nature, Sujet, ID_commune, Observations, ID_service)
        Values('{$CIN}','{$Date}','{$Type}','{$Sujet}','{$ID_commune}','{$Observations}','{$ID_service}')";
        if(mysqli_query($conn,$sql)){
            $message="تمت إضافة الزيارة بنجاح";
        }
        else{
            $message= "Erreur".$sql."<br>".mysqli_error($conn);
        }
        header("location:formulaire.php?message=$message");
}
    
    public function AfficherVisiteurs(){

        include('../controller/DBController.php');
        $per_page_record = 50;  // Number of entries to show in a page.         
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
          $page=1;    
        }    
    
        $start_from = ($page-1) * $per_page_record;
        $sql="SELECT * FROM visiteurs  LIMIT $start_from, $per_page_record";
        $result=mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)> 0){
            $table_content = "";
            while($row=mysqli_fetch_assoc($result)){
                $id=$row['CIN'];
                $table_content .=
                "<tr><td>".$row["CIN"]
                ."</td><td>".$row["NomComplet"]
                ."</td><td>".$row["Adresse"]
                ."</td><td>".$row["NumTele"]
                ."</td><td><a href=\"ModificationVisiteur.php?CIN=".$row["CIN"]."\">تعديل&#x1F58B;</a></td>"
                ."</td><td><a class='suppressionVisiteur' href=\"..\..\Visites\model\supprimer_visiteur.php?CIN=".$row["CIN"]."\">حذف&#x274C;</a></td>" 
                ."</td><td><a href=\"ListeVisitesParVisiteurs.php?CIN=".$row["CIN"]."\">الزيارات&#x1F4C3;</a></td></tr>";
            }
            echo $table_content;  }
    
    }

    public function infoVisiteur(){
        include('../controller/DBController.php');

        if (!empty($_GET["CIN"])){
            $ids = mysqli_real_escape_string($conn,$_GET["CIN"]);
            $sql = "select  vr.CIN, vr.NomComplet, vr.Adresse, vr.NumTele from visiteurs vr
            where  LOWER(vr.CIN) = LOWER('".$ids."')";
            $result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
            if (mysqli_num_rows($result)> 0){
                $table_content ="";
                $row=mysqli_fetch_assoc($result);
                $table_content .=
                "<tr><td>".$row["CIN"]
                ."</td><td>".$row["NomComplet"]
                ."</td><td>".$row["Adresse"]
                ."</td><td>".$row["NumTele"]
                ."</td><td><a href=\"ModificationVisiteur.php?CIN=".$row["CIN"]."\">تعديل&#x1F58B;</a></td>"
                ."</td><td><a class='suppressionVisiteur'  href=\"..\..\Visites\model\supprimer_visiteur.php?CIN=".$row["CIN"]."\">حذف&#x274C;</a></td>" ;
                echo $table_content;
            }           
    }
}

    public function visites(){
        include('../controller/DBController.php');
        $per_page_record = 50;  // Number of entries to show in a page.         
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
          $page=1;    
        }    
    
        $start_from = ($page-1) * $per_page_record;

        if (!empty($_GET["CIN"])){
            $ids = mysqli_real_escape_string($conn,$_GET["CIN"]);
            $sql = "select  v.Date, v.Nature, v.ID_visite, v.Sujet, v.Observations, c.pays, c.province, c.cercle, c.caidat, c.commune, s.Division, s.Service from communes c, services s, visites v, visiteurs vr
            where v.CIN=vr.CIN and v.ID_service=s.ID_service and c.ID_commune=v.ID_commune  AND LOWER(vr.CIN) = LOWER('".$ids."') ORDER BY ID_visite DESC LIMIT $start_from, $per_page_record";
            $result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
            if (mysqli_num_rows($result)> 0){
                $table_content ="";
                while($row=mysqli_fetch_assoc($result)){
                    $id=$row['ID_visite'];
                    $table_content .=
                    "<tr><td>".$row["pays"]." ".$row["province"]." ".$row["commune"]." ".$row["cercle"]." ".$row["caidat"]
                    ."</td><td>".$row["Date"]
                    ."</td><td>".$row["Nature"]
                    ."</td><td>".$row["Service"]." ".$row["Division"]
                    ."</td><td>".$row["Sujet"]
                    ."</td><td>".$row["Observations"]
                    ."</td><td><a href=\"ModificationVisite.php?ID_visite=".$row["ID_visite"]."\">تعديل&#x1F58B;</a></td>"
                    ."</td><td><a class='suppression' title= 'هل تريد حذف هذه الزيارة؟' href=\"..\..\Visites\model\supprimer_visite.php?ID_visite=".$row["ID_visite"]."\">حذف&#x274C;</a></td></tr>";
                    }                                                                                
                    echo $table_content;
            }

        }
    }

    public function ModifierVisiteur(){
        include('../controller/DBController.php');
 
        $CIN2=$_POST["CIN"];
        $NomComplet2=$_POST["NomComplet"];
        $Adresse2=$_POST["Adresse"];
        $NumTele2=$_POST["NumTele"];
        $sql = "update  visiteurs set CIN='{$CIN2}' , NomComplet='{$NomComplet2}', Adresse='{$Adresse2}', NumTele='{$NumTele2}'
        WHERE CIN='".$_GET["CIN"]."'";
        if (mysqli_query($conn, $sql)) {
            $message= "تم تعديل المعلومات الشخصية للزائر بنجاح";
        } else {
            $message = "Erreur " . $sql . "<br>" . mysqli_error($conn);
        }
        header("location:ListeVisiteurs.php?message=$message"); 
            
    }


    public function ModifierVisite(){
        include('../controller/DBController.php');
        $Commune=$_POST["Commune"];
        $Date2=$_POST["Date"];
        $Type2=$_POST["Type"];
        $Sujet2=$_POST["Sujet"];
        $Observations2=$_POST["Observations"];

        if($Commune==""){

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
            }
        }
        else{
            
            $ID_commune=$_POST["Commune"]; 
        }
         
        $ID_service=$_POST["Service"];

        $sql = "update  visites set Date='{$Date2}' , Nature='{$Type2}', Sujet='{$Sujet2}', ID_commune='{$ID_commune}', ID_service='{$ID_service}', Observations='{$Observations2}'
        WHERE ID_visite='".$_GET["ID_visite"]."'";
        if (mysqli_query($conn, $sql)) {
            $message= "تم تعديل معطيات الزيارة بنجاح!";
        } else {
            $message= "Erreur " . $sql . "<br>" . mysqli_error($conn);
        }
        
        header("location:resultatRecherche.php?message=$message");  
    }

    public function rechercherVisites(){
 
        include('../controller/DBController.php');
        $per_page_record = 50;  // Number of entries to show in a page.    
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
          $page=1;    
        }    
    
        $start_from = ($page-1) * $per_page_record;     
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
        where v.CIN=vr.CIN and v.ID_service=s.ID_service and c.ID_commune=v.ID_commune ".$whereCondition." order BY ID_visite DESC LIMIT $start_from, $per_page_record";     
        $result = mysqli_query ($conn, $sql);    
        if (mysqli_num_rows($result)> 0){
            $table_content ="";
            while($row=mysqli_fetch_assoc($result)){
                $id=$row['ID_visite'];
                $table_content .=
                "<tr><td>".$row["ID_visite"]
                ."</td><td>".$row["CIN"]
                ."</td><td>".$row["NomComplet"]
                ."</td><td>".$row["Adresse"]
                ."</td><td>".$row["NumTele"]
                ."</td><td>".$row["pays"]." ".$row["province"]." ".$row["commune"]." ".$row["cercle"]." ".$row["caidat"]
                ."</td><td>".$row["Date"]
                ."</td><td>".$row["Nature"]
                ."</td><td>".$row["Service"]." ".$row["Division"]
                ."</td><td>".$row["Sujet"]
                ."</td><td>".$row["Observations"]
                ."</td><td><a href=\"ModificationVisite.php?ID_visite=".$row["ID_visite"]."\">تعديل&#x1F58B;</a></td>"
                ."</td><td><a class='suppression'  title= 'هل تريد حذف هذه الزيارة؟' href=\"..\..\Visites\model\supprimer_visite.php?ID_visite=".$row["ID_visite"]."\">حذف&#x274C;</a></td></tr>";
                }
                echo $table_content; 
        }
   
    }
}
?>

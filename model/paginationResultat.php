<div class="pagination">    
    <?php  
        include('../controller/DBController.php');
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
            $page=1;    
        }    

        $per_page_record = 50;  // Number of entries to show in a page.           
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
        where v.CIN=vr.CIN and v.ID_service=s.ID_service and c.ID_commune=v.ID_commune ".$whereCondition;

        $rs_result = mysqli_query($conn, $sql);     
        $total_records = mysqli_num_rows($rs_result);     
  
        echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($total_records / $per_page_record);     
        $pagLink = "";
        $pagLink1 = "";
        $pagLink2 = ""; 
        $pagLink3 = "<a href=''>...</a>";              
        $pagLink4 = ""; 
                        

        if($page>=2){   
            echo "<a href='../view/resultatRecherche.php?page=".($page-1)."&amp;CIN=".$CIN."&amp;NomComplet=".$NomComplet."&amp;Service=".$Service."&amp;Commune=".$Commune."&amp;Nature=".$Nature."&amp;DateDebut=".$DateDebut."&amp;DateFin=".$DateFin."'> السابق </a>";   
        }  
        if($page >2 && $page < $total_pages-1){
            $pagLink2 = "<a class = 'active' href='../view/resultatRecherche.php?page=".$page."&amp;CIN=".$CIN."&amp;NomComplet=".$NomComplet."&amp;Service=".$Service."&amp;Commune=".$Commune."&amp;Nature=".$Nature."&amp;DateDebut=".$DateDebut."&amp;DateFin=".$DateFin."'>".$page." </a>";   
        } 
        
        for ($i=1; $i<=2; $i++) {   
            if ($i == $page) {   
                $pagLink .= "<a class = 'active' href='../view/resultatRecherche.php?page=".$i."&amp;CIN=".$CIN."&amp;NomComplet=".$NomComplet."&amp;Service=".$Service."&amp;Commune=".$Commune."&amp;Nature=".$Nature."&amp;DateDebut=".$DateDebut."&amp;DateFin=".$DateFin."'>".$i." </a>";   
            }               
            else  {   
                $pagLink .= "<a href='../view/resultatRecherche.php?page=".$i."&amp;CIN=".$CIN."&amp;NomComplet=".$NomComplet."&amp;Service=".$Service."&amp;Commune=".$Commune."&amp;Nature=".$Nature."&amp;DateDebut=".$DateDebut."&amp;DateFin=".$DateFin."'>".$i." </a>";     
            }   
        };    
        for ($i=$total_pages-1; $i<=$total_pages; $i++) {   
            if ($i == $page) {   
                $pagLink1 .= "<a class = 'active' href='../view/resultatRecherche.php?page=".$i."&amp;CIN=".$CIN."&amp;NomComplet=".$NomComplet."&amp;Service=".$Service."&amp;Commune=".$Commune."&amp;Nature=".$Nature."&amp;DateDebut=".$DateDebut."&amp;DateFin=".$DateFin."'>".$i." </a>";   
            }               
            else  {   
                $pagLink1 .= "<a href='../view/resultatRecherche.php?page=".$i."&amp;CIN=".$CIN."&amp;NomComplet=".$NomComplet."&amp;Service=".$Service."&amp;Commune=".$Commune."&amp;Nature=".$Nature."&amp;DateDebut=".$DateDebut."&amp;DateFin=".$DateFin."'>".$i." </a>";     
            }   
        };
        if($total_pages > 4)  { 
            if($page >2 && $page < $total_pages-1){
                $pagLink2 = "<a class = 'active' href='../view/resultatRecherche.php?page=".$page."&amp;CIN=".$CIN."&amp;NomComplet=".$NomComplet."&amp;Service=".$Service."&amp;Commune=".$Commune."&amp;Nature=".$Nature."&amp;DateDebut=".$DateDebut."&amp;DateFin=".$DateFin."'>".$page." </a>";   
                echo $pagLink.$pagLink3.$pagLink2.$pagLink3.$pagLink1;
            }
            else echo $pagLink.$pagLink3.$pagLink1; 
            }
        if($total_pages > 1 && $total_pages <= 2){
            echo $pagLink;
        }
        if($total_pages <= 1){
            
        }
        if($total_pages <= 3 && $total_pages > 2){
            if ($page == 3) {  
            $pagLink4 .= "<a  class = 'active' href='../view/resultatRecherche.php?page=3&amp;CIN=".$CIN."&amp;NomComplet=".$NomComplet."&amp;Service=".$Service."&amp;Commune=".$Commune."&amp;Nature=".$Nature."&amp;DateDebut=".$DateDebut."&amp;DateFin=".$DateFin."'>3 </a>";   
            }
            else{
                $pagLink4 .= "<a   href='../view/resultatRecherche.php?page=3&amp;CIN=".$CIN."&amp;NomComplet=".$NomComplet."&amp;Service=".$Service."&amp;Commune=".$Commune."&amp;Nature=".$Nature."&amp;DateDebut=".$DateDebut."&amp;DateFin=".$DateFin."'>3 </a>";   
            }
            echo $pagLink.$pagLink4;
        }
        if($total_pages <= 4 && $total_pages >3){
            echo $pagLink.$pagLink1;
        }

        if($page<$total_pages){   
            echo "<a href='../view/resultatRecherche.php?page=".($page+1)."&amp;CIN=".$CIN."&amp;NomComplet=".$NomComplet."&amp;Service=".$Service."&amp;Commune=".$Commune."&amp;Nature=".$Nature."&amp;DateDebut=".$DateDebut."&amp;DateFin=".$DateFin."'>  التالي </a>";   
        }   
    ?>    
</div>
        
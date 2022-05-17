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

        if (isset($_GET["CIN"])) {    
            $CIN = $_GET["CIN"];    
        }   

        if (!empty($_GET["CIN"])){
            $ids = mysqli_real_escape_string($conn,$_GET["CIN"]);
            $query = "SELECT COUNT(*) FROM visites where LOWER(CIN) = LOWER('".$ids."')";  
            $rs_result = mysqli_query($conn, $query);     
            $row = mysqli_fetch_row($rs_result);     
            $total_records = $row[0];  
        }   
        
        echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($total_records / $per_page_record);     
        $pagLink = "";
        $pagLink1 = "";
        $pagLink2 = ""; 
        $pagLink3 = "<a href=''>...</a>";              

        if($page>=2){   
            echo "<a href='../view/ListeVisitesParVisiteurs.php?page=".($page-1)."&amp;CIN=".$CIN."'> السابق </a>";   
        }  
        if($page >2 && $page < $total_pages-1){
            $pagLink2 = "<a class = 'active' href='../view/ListeVisitesParVisiteurs.php?page=".$page."&amp;CIN=".$CIN."'>".$page." </a>";   
        } 
        
        for ($i=1; $i<=2; $i++) {   
            if ($i == $page) {   
                $pagLink .= "<a class = 'active' href='../view/ListeVisitesParVisiteurs.php?page=".$i."&amp;CIN=".$CIN."'>".$i." </a>";   
            }               
            else  {   
                $pagLink .= "<a href='../view/ListeVisitesParVisiteurs.php?page=".$i."&amp;CIN=".$CIN."'>".$i." </a>";     
            }   
        };    
        for ($i=$total_pages-1; $i<=$total_pages; $i++) {   
            if ($i == $page) {   
                $pagLink1 .= "<a class = 'active' href='../view/ListeVisitesParVisiteurs.php?page=".$i."&amp;CIN=".$CIN."'>".$i." </a>";   
            }               
            else  {   
                $pagLink1 .= "<a href='../view/ListeVisitesParVisiteurs.php?page=".$i."&amp;CIN=".$CIN."'>".$i." </a>";     
            }   
        };
        if($total_pages > 4)  { 
            if($page >2 && $page < $total_pages-1){
                $pagLink2 = "<a class = 'active' href='../view/ListeVisitesParVisiteurs.php?page=".$page."&amp;CIN=".$CIN."'>".$page." </a>";   
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
            $pagLink4 .= "<a  class = 'active' href='../view/ListeVisitesParVisiteurs.php?page=3&amp;CIN=".$CIN."'>3 </a>";   
            }
            else{
                $pagLink4 .= "<a   href='../view/ListeVisitesParVisiteurs.php?page=3&amp;CIN=".$CIN."'>3 </a>";   
            }
            echo $pagLink.$pagLink4;
        }
        if($total_pages <= 4 && $total_pages >3){
            echo $pagLink.$pagLink1;
        }

        if($page<$total_pages){   
            echo "<a href='../view/ListeVisitesParVisiteurs.php?page=".($page+1)."&amp;CIN=".$CIN."'>  التالي </a>";   
        }   
    ?>    
</div>
       
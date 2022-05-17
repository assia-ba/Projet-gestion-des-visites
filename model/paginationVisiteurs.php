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

        $query = "SELECT COUNT(*) FROM visiteurs";     
        $rs_result = mysqli_query($conn, $query);     
        $row = mysqli_fetch_row($rs_result);     
        $total_records = $row[0];     
        
        echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($total_records / $per_page_record);     
        $pagLink = "";
        $pagLink1 = "";
        $pagLink2 = ""; 
        $pagLink3 = "<a href=''>...</a>";              
        
        if($page>=2){   
            echo "<a href='../view/ListeVisiteurs.php?page=".($page-1)."'>  السابق </a>";   
        }  
        for ($i=1; $i<=3; $i++) {   
            if ($i == $page) {   
                $pagLink .= "<a class = 'active' href='../view/ListeVisiteurs.php?page=".$i."'>".$i." </a>";   
            }               
            else  {   
                $pagLink .= "<a href='../view/ListeVisiteurs.php?page=".$i."'>".$i." </a>";     
            }   
        }; 
        for ($i=$total_pages-2; $i<=$total_pages; $i++) {   
            if ($i == $page) {   
                $pagLink1 .= "<a class = 'active' href='../view/ListeVisiteurs.php?page=".$i."'>".$i." </a>";   
            }               
            else  {   
                $pagLink1 .= "<a href='../view/ListeVisiteurs.php?page=".$i."'>".$i." </a>";     
            }   
        };   
        if($page >3 && $page < $total_pages-2){
            $pagLink2 = "<a class = 'active' href='../view/ListeVisiteurs.php?page=".$page."'>".$page." </a>";   
            echo $pagLink.$pagLink3.$pagLink2.$pagLink3.$pagLink1;
        }
        else echo $pagLink.$pagLink3.$pagLink1;     
        
        if($page<$total_pages){   
            echo "<a href='../view/ListeVisiteurs.php?page=".($page+1)."'>  التالي</a>";   
        }   

    ?>    
</div>

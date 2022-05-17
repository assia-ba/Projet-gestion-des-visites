<?php
session_start();
$_SESSION['username']="";
if(isset($_POST['username']) && isset($_POST['password']))
{
   include('../controller/DBController.php');
    
    $username = mysqli_real_escape_string($conn,htmlspecialchars($_POST['username'])); 
    $password = mysqli_real_escape_string($conn,htmlspecialchars($_POST['password']));
    
    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM login where 
              login = '".$username."' and password = '".$password."' ";
        $exec_requete = mysqli_query($conn,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) 
        {
           $_SESSION['username'] = $username;
           header('Location: ../view/formulaire.php');
        }
        else
        {
           header('Location: ../view/login.php?erreur=1'); 
        }
    }
    else
    {
       header('Location: ../view/login.php?erreur=2'); 
    }
}
else
{
   header('Location: ../view/login.php');
}
mysqli_close($conn); 
?>
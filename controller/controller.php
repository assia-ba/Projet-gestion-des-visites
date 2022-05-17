<?php

include_once("C:\wamp64\www\Visites\model\model.php") ; 
class Controller {
    public $model;
    public function __construct()    
    {    
          $this->model = new Model(); 
    } 
    function ajout()
    {
            $this->model->ajouter();  
    }
    
    function connection() 
    {
        require 'view/login.php';
    }
 
    
}
?>
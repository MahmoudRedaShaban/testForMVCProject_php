<?php
/*
 * Base Controller
 * Load the models and views 
 */

class Controller {
    
    //Load Model
    public function model($model)
    {
        $fullPath = "../app/models/".$model.".php";
        //Require model file
        if(file_exists($fullPath)){
            require_once $fullPath;
            // Instatite  Model
            return new $model();
        }else{
            return null;
        }
    }

    //Load View
    public function view($view, $data=[])
    {
        $fullPath = "../app/views/".$view.".php";
        // check for View File 
        if(file_exists($fullPath)){
            require_once $fullPath;
        }else{
            //view does not exist
            die("View dose not exist");
        }
    }



}
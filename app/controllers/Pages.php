<?php
class Pages extends Controller {

    public function __construct()
    {
      //  echo " Pages  Loaded";

    }

    public function index()
    {

        $this->view("pages/index",["title"=> "[ My MVC TEST PROJECT ]"]); 
    }

    public function about()
    {
        $this->view("pages/about");
    }
}
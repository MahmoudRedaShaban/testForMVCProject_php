<?php
class Pages extends Controller {

    public function __construct()
    {
      //  echo " Pages  Loaded";

    }

    public function index()
    {
        if(isLoggedIn()){
            redirect("posts");
        }
        $data = [
            'title'=> SITENAME,
            'desc' => "This is The MyMvc Framwork Project With PHP . Please refer to the docs on how to use it "
        ];
        $this->view("pages/index",$data); 
    }

    public function about()
    {
        $data = [
            'title'=> "About US",
            'desc'=> "APP To Test MY Shear Post Other User "
        ];
        $this->view("pages/about",$data);
    }
}
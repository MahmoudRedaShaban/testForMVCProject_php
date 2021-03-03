<?php
class Pages extends Controller {
    private $postModel;

    public function __construct()
    {
      //  echo " Pages  Loaded";
      $this->postModel = $this->model("Post");

    }

    public function index()
    {
        $posts = $this->postModel->getPosts();

        $this->view("pages/index",["title"=> "TEST Title $$", "posts"=> $posts]); 
    }

    public function about()
    {
        $this->view("pages/about");
    }
}
<?php

class Posts extends Controller {

    public function __construct()
    {
        if(!isLoggedIn()){
            redirect('users/login');
        }
        $postModel =  $this->model("Post");
        $userModel = $this->model('User');
    }


    public function index()
    {
        $posts = $this->postModel->getPosts();
        $data = ['posts'=>$posts];
        return $this->view('post/index',$data);
    }
    
    
    public function add()
    {
        $data = [
            'title'=> '',
            'body'=> '',
            'user_id'=> '',
            'title_err'=> '',
            'body_err'=> ''
        ];
        if($_REQUEST['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            $data['title'] = trim($_POST['title']);
            $data['body'] = trim($_POST['body']);
            $data['user_id'] = $_SESSION['user_id'];
            // Validate Data
            $this->validateFormIsEmpty($data,['title','body']);
            if(empty($data['title_err']) && empty($data['body_err'])){
                // Validated 
                if($this->postModel->addPost($data)){
                    flash('post_message', 'Post Added');
                    redirect('posts');
                }else{
                    die('Something went Worng');
                }
            }else{
                $this->view('posts/add',$data);
            }
        }else{
        $this->view('posts/add',$data);
        }
    }                   
    public function show($id)
    {

        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);

        $data = [
            "post"=> $post,
            "user" => $user,
        ];

        $this->view('posts/show',$data);
    }
    
    public function edit($id)
    {
        $data = [
            'id'=> $id,
            'title'=> '',
            'body'=> '',
            'user_id'=> '',
            'title_err'=> '',
            'body_err'=> ''
        ];
        if($_REQUEST['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            $data['title'] = trim($_POST['title']);
            $data['body'] = trim($_POST['body']);
            $data['user_id'] = $_SESSION['user_id'];
            // Validate Data
            $this->validateFormIsEmpty($data,['title','body']);
            if(empty($data['title_err']) && empty($data['body_err'])){
                // Validated 
                if($this->postModel->editPost($data)){
                    flash('post_message', 'Post Updated');
                    redirect('posts');
                }else{
                    die('Something went Worng');
                }
            }else{
                $this->view('posts/edit',$data);
            }
        }else{
            // Get exiting post form model 
        $post = $this->postModel->getPostById($id);
        //cheack  for Owner
        $if($post->user_id != $_SESSION['user_id']){
            redirect('posts');
        }
        $data['title']=$post->title;
        $data['body']=$post->body;
        $this->view('posts/edit',$data);
        }
    }                   
    public function delete($id)
    {
        if($_REQUEST['REQUEST_METHOD'] == 'POST'){
            // Get existing post from model 
            $post = $this->postModel->getPostById($id);

            //cheack for Owner
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }
            if($this->postModel->deletePost($id)){
                flash('post_message','Post Removed');
                redirect('posts');
            }else{
                die('Something went Worng');
            }
        }else{
            redirect('posts');
        }
    }
}
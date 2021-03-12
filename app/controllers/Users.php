<?php
class Users extends Controller {

    public function __construct()
    {
        $this->userModel =  $this->model('User');
    }

    public function register()
    {
      //Init Data 
        $data = [
            'name'=>'',
            'email'=> '',
            'password'=> '',
            'confirm_password'=> '',
            'name_err'=>'',
            'email_err'=> '',
            'password_err'=> '',
            'confirm_password_err'=> '',
        ];

        //check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Process Form

            //Sanitize POST Data
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            // Init Data
            $data['name'] = trim($_POST['name']);
            $data['email'] = trim($_POST['email']);
            $data['password'] = trim($_POST['password']);
            $data['confirm_password'] = trim($_POST['confirm_password']);

            //Validate For Empty Or not
            $data = $this->validateFormIsEmpty($data, ["name","email","password",'confirm_password']);
            //Validate Password
            if(strlen($data['password']) < 6)  $data['password_err'] = 'Password must be a least 6 characters';
            //Validate Confirm Password 
            if($data['confirm_password'] != $data['password']) $data['confirm_password_err'] = 'Please Confirm Password';
            //Validate Check Email
            if($this->userModel->findUserByEmail($data['email'])){
                $data['email_err']= "Email Is Already Taken !";
            }
            
            //Make Sure Errors are Empty
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err'])
            && empty($data['confirm_password_err'])) {
                // Validated 
                // Hash Password Default Hash
                $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);
                //Register User 
                if($this->userModel->register($data)){
                    flash('resgister_success', 'You Are Registered And Can Log In . ');
                    redirect("users/login");
                }else{
                    die("Something Went Worng");
                }
            }else {
                // Load View With Errors 
                $this->view('users/register',$data);
            }

        }else {
            // Load View
            $this->view('users/register',$data);
        }
    }

    public function login()
    {
        //inti Data
        $data = [
            'email' => '',
            'password' => '',
            'email_err' => '',
            'password_err' => '',
        ];

        //check for Post
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //Process Form 
            
            //Sanitize POST Data
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            // Init Data
            $data['email'] = trim($_POST['email']);
            $data['password'] = trim($_POST['password']);
            //Validate For Empty Or not
            $data = $this->validateFormIsEmpty($data, ["email","password"]);
            //Check For User By Email
            if(!$this->userModel->findUserByEmail($data['emial'])){
                $data['emial_err'] = "User Not Found !";
            }
            //Make Sure Errors are Empty
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // Validated 
                // Check Logged And Set   In User
                $loggedInUser = $this->userModel->login($data['email'],$data['password']);
                if($loggedInUser){
                    //Create Session 
                    $this->createUserSession();
                }else{
                    $data['password_err'] = "Password Is Valid ";
                    $this->view("users/login",$data);
                }
            }else {
                // Load View With Errors 
                $this->view('users/login',$data);

            }
        }else {
            
            $this->view('users/login',$data);
        }
    }

    private function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect("page/index");
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect("users/login");
    }

}
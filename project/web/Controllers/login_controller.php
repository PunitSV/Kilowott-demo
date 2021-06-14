<?php

    /**
    * The login page controller
    */
    class login_controller
    {
        private $model;

        function __construct($model)
        {
            $this->model = $model;
			
        }

		
		public function index()
        {
			$this->login();
        }
		
		public function login()
        {
			$this->render('login');
        }
		
		public function logout()
        {
			global $config;
			$this->model->logout();
			header("Location: ".$config['doc_root']);
			die();
        }
		
		public static function check_login()
        {
			return $this->model->check_login();
        }
		
	 	public function authenticate()
        {
			return $this->model->authenticate($_POST);
        }
		
		public function signup()
        {
			$this->render('signupForm');
        }
		
		public function forgot()
        {
			$this->render('forgotForm');
        }
		public function sendMail()
        {
			global $config;
			$this->model->sendMail($_POST);
			header("Location: ".$config['doc_root']);
			die();
        }
		
		public function saveSignup()
        {	
			global $config;
			$id = $this->model->saveSignup($_POST);
			if($id){
				header("Location: ".$config['doc_root']);
				die();
			}
        }
	
		public function render($file,$params=array()) {
			global $config;
			include dirname(__FILE__, 2).'/Views/layout.php';
		}

    }
<?php

    /**
    * The login page model
    */
    class login_model 
    {

        private $message = 'Welcome to Home page.';
		public $tbl_users = 'users';

        function __construct()
        {

        }

        public function authenticate($params)
        {
			$db = new db(); 
			$password =  hash('sha256', (get_magic_quotes_gpc() ? stripslashes($params['password']) : $params['password']));
			
			$sql = 'SELECT * FROM users WHERE email = ? AND password LIKE ? AND role =1 ';
			$user_auth = $db->query(array('query'=>$sql), array('email'=>$params['email'], 'password'=>$password))->fetchArray();

			if(is_array($user_auth) && !empty($user_auth['id'])){
				session_regenerate_id();
				$_SESSION['id'] = $user_auth['id'];
				
				$msg = 'success';
				$status_code = 200;
			}
			else{
				$msg = 'you were not able to login !!!';
				$status_code = 101;
			}
			
			$return_data['msg'] = $msg;
			$return_data['status_code'] = $status_code;
			$json_response = json_encode($return_data);
			return $json_response;
        }
		
		public function logout()
        {
			session_destroy();   // function that Destroys Session 
			
        }
		
		public function sendMail($params)
        {
			$db = new db(); 
			
			$sql = 'SELECT * FROM users WHERE email = ? ';
			$details = $db->query(array('query'=>$sql), array('email'=>$params['email']))->fetchArray();
			if(is_array($details) && !empty($details['id'])){
				$title="Forgot Password";
				$body="Yoy have recieved a forgot password mail from Kilowatt";
				mail($details['email'],$title,$body); //send maill
			}
			
			return 1;
			
        }
		
		public function saveSignup($params)
        {
			$db = new db(); 
			if($params['password']){
				$params['password'] = hash('sha256', (get_magic_quotes_gpc() ? stripslashes($params['password']) : $params['password']));
			}	
			$params['status'] = 1;
			$params['role'] = 2;
			$action_id = $db->query(array('table'=>$this->tbl_users,'type'=>'insert'), $params);
			
			
			$return_data['msg'] = $msg;
			$return_data['status_code'] = $status_code;
			$json_response = json_encode($return_data);
			return $json_response;
			
        } 
		
		private function check_login() {
			if(isset($_SESSION['id'])) {
				$logged_in = true;
			} 
			else {
				$logged_in = false;
			}
			
			return $logged_in;
		}

    }
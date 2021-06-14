<?php

    /**
    * The user page model
    */
    class user_model 
    {

		public $tbl_users = 'users';

        function __construct()
        {

        }

        public function save($params)
        {
			$db = new db(); 
			$id=$params['id'];
			if($id){
				
				unset($params['id']);
				$action_id = $db->query(array('table'=>$this->tbl_users,'type'=>'update'), $params,array('id'=>$id));
				
			}
			else{ 
				
				$params['status'] = 1;
				$action_id = $db->query(array('table'=>$this->tbl_users,'type'=>'insert'), $params);
			}
			
			return $action_id;
			
        } 
		
		
		
		public function deleteUser($params)
        {
			$db = new db(); 
			$id=$params['id'];
			if($id){
				
				unset($params['id']);
				$action_id = $db->query(array('table'=>$this->tbl_users,'type'=>'update'), array('status'=>2),array('id'=>$id));
				$msg = 'success';
				$status_code = 200;
			}
			else{
				$msg = 'cannot be deleted!!!';
				$status_code = 101;
			}
			
			$return_data['msg'] = $msg;
			$return_data['status_code'] = $status_code;
			$json_response = json_encode($return_data);
			return $json_response;
			
        } 
		
		public function userRecord($params)
        {
			$db = new db(); 
			$sql = 'SELECT * FROM '.$this->tbl_users.' WHERE id = ? AND status =1 ';
			$userDetails = $db->query(array('query'=>$sql), array('id'=>$params[0]))->fetchArray();
			return $userDetails;
        }

    }
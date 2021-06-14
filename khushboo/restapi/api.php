<?php


	response($_POST);
	function response($params){
		$db = new db();  
		$action = $params['action'];
		$id = $params['id'];
		
		if($params['apiKey'] == APIKEY){
			unset($params['apiKey']);
			if($action){
				unset($params['action']);
				unset($params['id']);
				
				if($params['role']){
					if($params['role'] == 'Admin'){
						$params['role'] = 1;
					}
					elseif($params['role'] == 'User'){
						$params['role'] =2;
					}
				}
					
				if($action == 'insert'){
					if($params['password']){
						$params['password'] = hash('sha256', (get_magic_quotes_gpc() ? stripslashes($params['password']) : $params['password']));
					}
					$params['status'] = 1;
					$action_id = $db->query(array('table'=>'users','type'=>'insert'), $params);
				}
				else if($action == 'update'){
					if($id){
						if($params['password']){
							$params['password'] = hash('sha256', (get_magic_quotes_gpc() ? stripslashes($params['password']) : $params['password']));
						}
						$action_id = $db->query(array('table'=>'users','type'=>'update'),  $params,array('id'=>$id));
					}
				}
				else if($action == 'delete'){
					if($id){
						$action_id = $db->query(array('table'=>'users','type'=>'update'), array('status'=>2),array('id'=>$id));
					}
				}
				else if($action == 'viewAll'){
					$action_id = $db->query(array('query'=>"SELECT name,email,address,if(role =1,'Admin','User') AS role,created_date AS createdDate FROM users WHERE status = 1"), '')->fetchALL();
				}
				else if($action == 'view'){
					if($id){
						//$action_id = $db->query(array('query'=>'SELECT * FROM users WHERE status = 1 AND id=? '), array('id' =>$id))->fetchArray();
						$sql = "SELECT name,email,address,if(role =1,'Admin','User') AS role,created_date AS createdDate FROM users WHERE id = ? ";
						$action_id = $db->query(array('query'=>$sql), array('email'=>$id))->fetchArray();
					}
				}
				
				if($action_id){
					if($action == 'viewAll' || $action == 'view'){
						$return_data = $action_id;
					}
					$msg = 'success';
					$status_code = 200;
				}
				else{
					$msg = 'cannot perform action';
					$status_code = 101;
				}
			}
			else{
				$msg = 'provide action value';
				$status_code = 101;
			}
		}
		else{
			$msg = 'no apiKey';
			$status_code = 101;
		}
		
			$return_data['msg'] = $msg;
			$return_data['status_code'] = $status_code;
		
		$json_response = json_encode($return_data);
		echo $json_response;
	}

?>
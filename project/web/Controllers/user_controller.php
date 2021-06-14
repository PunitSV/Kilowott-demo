<?php

    /**
    * The user page controller
    */
    class user_controller
    {
        private $model;

        function __construct($model)
        {
            $this->model = $model;
			if(!isset($_SESSION['id'])){
				$this->render('notFound');
				die();
			}
        }

		
		public function index()
        {
			$this->render('userForm',$params);
        }
		
		public function add()
        {
			$this->render('userForm');
        }
		
		public function edit($params)
        {
			$data = $this->model->userRecord($params);
			$this->render('userForm',$data);
        }
		
		public function deleteUser()
        {
			return $this->model->deleteUser($_POST);
        }
		
		public function save()
        {	
			global $config;
			$id = $this->model->save($_POST);
			if($id){
				header("Location: ".$config['doc_root'].'dashboard');
				die();
			}
        }
		
	
		public function render($file,$data=array()) {
			global $config;
			include dirname(__FILE__, 2).'/Views/layout.php';
		}

    }
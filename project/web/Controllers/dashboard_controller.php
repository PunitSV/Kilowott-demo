<?php

    /**
    * The dashboard controller
    */
    class dashboard_controller 
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

		public function usersList()
        {
			$data = $this->model->usersListing($params);
			$this->render('userListing',$data);
			return $layout;
        }
		
		public function render($file,$data=array()) {
			global $config;
			include dirname(__FILE__, 2).'/Views/layout.php';
		}

    }
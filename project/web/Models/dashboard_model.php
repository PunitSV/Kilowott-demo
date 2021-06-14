<?php

    /**
    * The home page model
    */
    class dashboard_model 
    {

        private $message = 'Welcome to Home page.';

        function __construct()
        {

        }
		
		 public function usersListing()
        {
			$db = new db(); 
			$sql = 'SELECT * FROM users WHERE  status = 1 ';
			$user_list = $db->query(array('query'=>$sql))->fetchAll();
			return $user_list;
        }

    }
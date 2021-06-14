<?php

   
    $url_str = $_SERVER['REQUEST_URI'];
	
	
	
    if ($url_str == $config['doc_root'])
    {

        // This is the home page
        // Initiate the home controller
        // and render the home view

		require_once dirname(__FILE__, 2).'/web/Models/login_model.php';
        require_once dirname(__FILE__, 2).'/web/Controllers/login_controller.php';

        $login_model = New login_model();
        $login_controller = New login_controller($login_model);
        //$indexView = New login_controller($indexController, $indexModel);

        print $login_controller->index();

    }else{
			
		
		require_once dirname(__FILE__, 2).'/config/route.php';
		$url = isset($url_str) ? explode('/', ltrim($url_str,'/')) : '/';
	
        // Initiate the appropriate controller
        // and render the required view

        //The first element should be a controller
        $requestedController = $url[0]; 

        // If a second part is added in the URI, 
        // it should be a method
        $requestedAction = isset($url[1])? $url[1] :'';

        // The remain parts are considered as 
        // arguments of the method
        $requestedParams = array_slice($url, 2); 
-
        // Check if controller exists. NB: 
        // You have to do that for the model and the view too
       $ctrlPath = dirname(__FILE__, 2).'/web/Controllers/'.$requestedController.'_controller.php';

        if (file_exists($ctrlPath))
        {

            require_once dirname(__FILE__, 2).'/web/Models/'.$requestedController.'_model.php';
            require_once dirname(__FILE__, 2).'/web/Controllers/'.$requestedController.'_controller.php';

            $modelName      = $requestedController.'_model';
            $controllerName = $requestedController.'_controller';

            $controllerObj  = new $controllerName( new $modelName );

            // If there is a method - Second parameter
            if ($requestedAction != '')
            {
                // dynamic call of the controller
                print $controllerObj->$requestedAction($requestedParams);

            }

        }else{

            header('HTTP/1.1 404 Not Found');
            die('404 - The file - '.$ctrlPath.' - not found');
            //require the 404 controller and initiate it
            //Display its view
        }
    }
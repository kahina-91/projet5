<?php 

    namespace kah\controller;

    use kah\core\Controller;
    
    
	class ErrorPages extends Controller
	{

        public function page404() 
        {
            return $this->render('errorPages/page404'); 
        }

    }
    
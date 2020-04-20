<?php

/*namespace kah\app\core;

use kah\app\core\Session;
use kah\app\core\Request;
use kah\app\core\View;*/

class Controller
{

    protected $session;
    protected $request;
    private $view;

    public function __construct($request) 
    {
        $this->request = $request;
        $this->session = $this->request->getSession();//new Session();
        $this->view = new View();
    }

    public function render($template, $datas = []) 
    {
        
        $myView = $this->view;
        $myView->setTemplate($template);
        $myView->render($datas);

    }

    public function redirect($route) {
        $this->view->redirect($route);
    }
    
    public function error404()
    {
    	echo '404';
    }
}

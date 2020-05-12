<?php

namespace kah\core;

use kah\core\View;
class Controller
{

    protected $session;
    protected $request;
    private $view;

    public function __construct($request) 
    {
        $this->request = $request;
        $this->session = $this->request->getSession();
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
    
}

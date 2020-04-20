<?php

	//namespace kah\app\core;

	Class View
	{
        
		private $template;
		private $request;
		private $session;
	
		public function __construct()
		{
			$this->request = new Request();
			$this->session = $this->request->getSession();
		}

		public function setTemplate($template)
		{
			$this->template = $template;
		}

		public function render($datas = [])
		{
           
			extract($datas);
			ob_start();
			include_once(VIEW.$this->template.'.php');
            // 'session' = $this->session;
			$content = ob_get_clean();
            
			include_once (VIEW.'template.php');
		}

	}
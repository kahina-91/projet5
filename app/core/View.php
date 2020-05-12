<?php

	namespace kah\core;

	use kah\core\Request;
	Class View
	{
        
		private $template;
		private $request;
	
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
			require_once(VIEW.$this->template.'.php');
			$content = ob_get_clean();
			require_once(VIEW.'template.php');
			return $content;
		}

		public function redirect($route) {
			header("Location;".HOST.$route);
		}

	}
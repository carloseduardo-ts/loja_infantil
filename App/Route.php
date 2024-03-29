<?php

    namespace App;

    class Route
    {
        private $routes = [];

        // construtor da classe, chamado cada vez que um objeto é instanciado
        public function __construct()
        {
            $this->initRoutes();
            $this->run($this->getUrl());
        }

        // rotas que existem na aplicação
        public function initRoutes()
        {
            $routes['home'] = array(
			    'route' => '/',
			    'controller' => 'indexController',
			    'action' => 'index'
		    );

    		$routes['login'] = array(
    			'route' => '/login',
    			'controller' => 'authController',
    			'action' => 'login'
    		);

            $routes['cadatrar'] = array(
    			'route' => '/cadastro',
    			'controller' => 'UsuarioController',
    			'action' => 'cadastrar'
    		);

    		$routes['produto'] = array(
                'route' => '/produto',
                'controller' => 'ProdutoController',
                'action' => 'produto'
            );

            $routes['comprar'] = array(
                'route' => '/comprar',
                'controller' => 'ComprarController',
                'action' => 'comprar'
            );

            $this->setRoutes($routes);
        }

        // seta as rotas
        public function setRoutes(array $routes)
        {
            $this->routes = $routes;
        }

        // retorna as rotas existentes
        public function getRoutes()
        {
            return $this->routes;
        }

        // executa a ação correspondente a cada rota
        protected function run($url)
        {
		    foreach ($this->getRoutes() as $key => $route) {
    			if($url == $route['route']) {
    				$class = "App\\Controllers\\".ucfirst($route['controller']);
    				$controller = new $class;
    				$action = $route['action'];
    				$controller->$action();
    			}
    		}
	    }

        // retorna o a url acessada, esse valor é usado para identificar a rota requisitada
        public function getUrl()
        {
            return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        }
    }
 ?>

<?php

require_once './ArtistaController.php';

class Application {

    private $controller;

	public function getLocalPath() {
		$dbini = './dbconnection.ini';
		if (!$config = parse_ini_file($dbini, TRUE)) {
			throw new Exception('Unable to open ' . $dbini . '.');

		} 
		return $config["application"]["root"];
	}

    public function constructor() {
    }

    public function dispatch(){
        
        $method = isset($_REQUEST['method']) ? $_REQUEST['method']: 'ExibirArtistas';

        switch($method)
        {
            case 'InserirArtista':
                $controller = new ArtistaController();

                $controller->InserirArtista(isset($_REQUEST['nome'])? $_REQUEST['nome'] : null, isset($_REQUEST['pais'])? $_REQUEST['pais']: null);
                break;
            case "ExibirArtistas":
                $controller = new ArtistaController();
                $controller->ExibirArtistas();
                break;
            case "RemoveArtista":
                $controller = new ArtistaController();
                $controller->RemoveArtista(isset($_REQUEST['id'])? $_REQUEST['id'] : null);
                break;

        }
    }
}

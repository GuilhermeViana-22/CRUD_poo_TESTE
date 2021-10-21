<?php

require_once './ArtistaController.php';

class Application {

    private $controller;

    public function constructor() {
    }

    public function dispatch(){
        
        if(isset($_REQUEST['method'])  ){
            $method = $_REQUEST['method'];

        }else{
            $method = 'ExibirArtistas';
        }
        switch(isset($_REQUEST['method'])? $_REQUEST['method']: 'ExibirArtistas')
        {
            case 'InserirArtista':
                $controller = new ArtistaController();
                $controller->InserirArtista(isset($_REQUEST['name'])? $_REQUEST['name'] : null, isset($_REQUEST['country'])? $_REQUEST['country']: null);
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

<?php


require_once './DBCore.php';
require_once './View.php';
require_once './ArtistaModel.php';

#Obrigatoriedades: 
#•	Utilizar padrão MVC;
#•	Utilizar linguagem orientada a objeto;
#•	Utilizar no mínimo as classes ArtistaModel, ArtistaController e ArtistaView;
#•	Utilizar AJAX para implementar a operação de remoção do artista;
#•	Não utilizar frameworks;

#Requisitos do sistema:
#•	Possuir formulário com os campos “Nome do artista” e “País do artista”, seguidos pelo botão “Enviar”;
#•	Inserir no banco de dados somente artistas que possuam todos os dados do formulário preenchidos;
#•	Possuir uma listagem de todos os artistas cadastrados no sistema, exibindo todos os dados disponíveis no banco de dados;
#•	Possuir a opção “Remover” para remover um artista ao clicar;
#•	Exibir mensagens de sucesso ou erro nas operações de inserção e remoção;
#•	Atualizar listagem automaticamente ao concluir uma operação;

class ArtistaController
{

    private $view, $model;

    public function __construct()
    {
        $this->view = new View('./ArtistaView.php');
        $this->model = new ArtistaModel();
    }

    public function InserirArtista($Name = null, $Country = null)
    {
        $this->model = new ArtistaModel();
        #retorna a quantidade de letras que uma String possui
        #str => funções rtelacionadas a string
        if (strlen($Name) === 0 || strlen($Country) === 0) {

            $this->model->setMassage("Favor informar todos os campos");

            $this->view()->setMassage(

                $this->model->getMassage()
            );
            $this->ExibirArtistas();
            #exit possui a mesma fubncionalidade que o break
            exit;
        }

            #funções estaticas devemos utilizar os :: para acessar
            #3 função estatia só funciona quando o objt está instanciado

        $dbh = DBCore::instance()->dbh;

        $sth = $dbh->prepare("INSERT INTO artistas (`name`, `country`) VALUES (?, ?)");

        $sth->execute(
            array(
                $Name,
                $Country
            )
        );

        header("Location: index.php?method=ExibirArtistas");
    }

    public function ExibirArtistas()
    {
        #database handler
        #pdo já fornecida pelo proprio php de

        $dbh = DBCore::instance()->dbh;
        $sth = $dbh->prepare("SELECT * FROM artistas");
        $sth->execute();

        $cont = 0;

        while ($artista = $sth->fetch(PDO::FETCH_ASSOC)) {
            $this->model = new ArtistaModel();
            $this->model->setId($artista['id']);
            $this->model->setName($artista['name']);
            $this->model->setCountry($artista['country']);
            $this->view->addParameter($cont++, $this->model);
        }

        $this->showView();
    }

    public function RemoveArtista($Id)
    {
        $dbh = DBCore::instance()->dbh;

        $sth = $dbh->prepare("DELETE FROM artistas WHERE id=?");

        $sth->execute(
            array(
                $Id
            )
        );

        header("Location: index.php?method=ExibirArtistas");
    }

    private function update()
    {
        $this->view()->setMassage(
            $this->model->getMassage()
        );
    }
# : refere-se a tipagem e o unico retorno que ela pode dar é uma classe ou objeto
    private function view(): View
    {
        return $this->view;
    }

    public function showView()
    {
        $this->view->show();
    }
}

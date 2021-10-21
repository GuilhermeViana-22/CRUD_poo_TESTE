<?php
    class DBCore
    {
        private static  $instance;
        public $dbh = null;

        private function __construct($dbini = './dbconnection.ini')
        {
            if (!$config = parse_ini_file($dbini, TRUE))
                throw new Exception('Unable to open ' . $dbini . '.');

       
            $dns = $config['db']['driver'] .
                ':host=' . $config['db']['host'] .
                ((!empty($config['db']['port'])) ? (';port=' . $config['db']['port']) : '') .
                ';dbname=' . $config['db']['schema'];

            $this->dbh = new PDO(
                $dns,
                $config['db']['username'],
                ''
            );
        }

        public static function instance(): DBCore

        {
            #isset = se possuir algum valor ela deve nos retornar um boolean
            #self é similar ao this , mas nao conseguimos utilizar o this em funções estaticas
            #devemos utilizar o self
            if (!isset(self::$instance)) {
                #__class__ armazena o nome da classe
                $object = __CLASS__;
                self::$instance = new $object;
            }
            return self::$instance;
        }
    }
?>
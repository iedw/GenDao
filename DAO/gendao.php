<?php
session_start();
require_once("../PHP/config.php");

class Gendao{

    private $pdo = NULL;
    private $tabela = NULL;
    private static $gendao = NULL;

    private function __construct($tabela = NULL){
        $opt = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => TRUE, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $connect = new PDO("mysql:host=". MYSQL_HOST."; dbname=" . MYSQL_DB . "; charset=utf8;",MYSQL_USER, MYSQL_PASSWD, $opt);

        if(!empty($connect)){
            $this->pdo = $connect;
        }else{
            echo "Sem conexão";
            exit();
        }

        if (!empty($tabela)) $this->tabela =$tabela;
    }

    public static function getInstance($tabela = NULL){
        if(!isset(self::$gendao)){
            try {
                self::$gendao = new Gendao($tabela);
            }catch (Exception $e){
                echo "Erro: " .$e->getMessage();
            }
        }

        if (!empty($tabela)){
            self::$gendao->setNomeTabela($tabela);
        }

        return self::$gendao;
    }

    public function setNomeTabela($tabela){
        if(!empty($tabela)){
            $this->tabela = $tabela;
        }
    }

    private function createInsert($allDados){
        $consulta = "";
        $colunas = "";
        $campos = "";

        foreach ($allDados as $chv => $dado) {
            $colunas .= $chv. ', ';
            $campos .= '?, ';
        }

        $colunas = (substr($colunas, -2) == ', ') ? trim(substr($colunas, 0, (strlen($colunas) - 2))) : $colunas;
        $campos = (substr($campos, -2) == ', ') ? trim(substr($campos, 0, (strlen($campos) -2))) : $campos;

        $consulta = "INSERT INTO {$this->tabela} (" .$colunas. ") VALUES(" .$campos.")";

        return trim($consulta);
    }

    public function insert($allDados){
        try {

            $query = $this->createInsert($allDados);

            $stmt = $this->pdo->prepare($query);

            $i = 1;
            foreach ($allDados as $dado){
                $stmt->bindValue($i, $dado);
                $i++;
            }

            $result = $stmt->execute();
            $id = $this->pdo->lastInsertId();
            $res = array('result' => $result, 'id' => $id);

            return $res;

        }catch (PDOException $erro){
            echo "<script> alert(\"Não cadastrado!\\nErro: ". $erro->getMessage()."\");</script>";
            //exit();
        }
    }

    public function select($tabela){
        try{

            $consulta = "SELECT * FROM ".$tabela;

            $stmt = $this->pdo->prepare($consulta);
            $stmt->execute();
            $dados = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $dados;

        }catch (PDOException $erro){
            echo "Erro: ".$erro->getMessage();
            exit();
        }
    }

}

?>

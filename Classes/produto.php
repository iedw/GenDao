<?php

class Produto{

    public $codigo;
    public $descricao;
    public $categoria;
    public $preco;

    public function __construct($codigo, $descricao, $categoria, $preco){

        $this->codigo = $codigo;
        $this->descricao = $descricao;
        $this->categoria = $categoria;
        $this->preco = $preco;

    }

}

?>
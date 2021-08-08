<?php

class Usuario{

    public $email;
    public $nome;
    public $senha;

    public function __construct($email, $nome, $senha){

        $this->email = $email;
        $this->nome = $nome;
        $this->senha = md5($senha);

    }

}

?>
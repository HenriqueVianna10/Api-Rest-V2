<?php
    class Loja {
        public $id;
        public $nome;
        public $telefone;
        public $endereco;

        function __construct($id, $nome, $telefone, $endereco){
            $this->id = $id;
            $this->nome = $nome;
            $this->telefone = $telefone;
            $this->endereco = $endereco;
        }
    }
?>
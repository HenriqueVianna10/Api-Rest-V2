<?php
class Funcionario
{
    public $id;
    public $nome;
    public $sexo;
    public $telefone;
    public $endereco;
    public $lojaId;

    function __construct($id, $nome, $sexo, $telefone, $endereco, $lojaId){
        $this->id = $id;
        $this->nome = $nome;
        $this->sexo = $sexo;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
        $this->lojaId = $lojaId;
    }
 
}
?>
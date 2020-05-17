<?php

include_once('Loja.php');
include_once('LojaDAO.php');

class LojaController {

    public function listar($request, $response, $args){
        $dao= new LojaDAO;    
        $lojas = $dao->listar();
    
        return $response->withJson($lojas); 
    }

    public function inserir($request, $response, $args) {
        //Adicione nome e preço no request (formato JSON)
        $data = $request->getParsedBody();
        $loja = new Loja(0,$data['nome'],$data['telefone'],$data['endereco']);
    
        $dao = new LojaDAO;
        $loja = $dao->inserir($loja);
    
        return $response->withJson($loja,201);
    }

    public function buscarPorQuery($request, $response, $args){
        //Pegando somente pelo nome
        $nome = $request->getQueryParams()['nome'];
        
        $dao = new LojaDAO;
        $lojas = $dao->listarPorNome($nome);

        return $response->withJSON($lojas);
    }

    public function buscarPorId($request, $response, $args) {
        $id = $args['id'];
        
        $dao= new LojaDAO;    
        $loja = $dao->buscarPorId($id);
        
        return $response->withJson($loja);
    }
    
    public function atualizar($request, $response, $args) {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $loja = new Loja($id, $data['nome'], $data['telefone'], $data['endereco']);
    
        $dao = new LojaDAO;
        $loja = $dao->atualizar($loja);
    
        return $response->withJson($loja);
    }
    
    public function deletar($request, $response, $args) {
        $id = $args['id'];
    
        $dao = new LojaDAO;
        $loja = $dao->deletar($id);
    
        return $response->withJson($loja);
    }
}
?>
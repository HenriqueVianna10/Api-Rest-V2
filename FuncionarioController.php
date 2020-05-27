<?php

include_once('Funcionario.php');
include_once('FuncionarioDAO.php');

class FuncionarioController {

    public function listar($request, $response, $args){
        $dao= new FuncionarioDAO;    
        $func = $dao->listar();
    
        return $response->withJson($func); 
    }

    public function inserir($request, $response, $args) {
        $data = $request->getParsedBody();
        $func = new Funcionario(0,$data['nome'],$data['sexo'],$data['telefone'],$data['endereco'],$data['lojaId']);
    
        $dao = new FuncionarioDAO;
        $func = $dao->inserir($func);
        
        $response = $response->withJson($func);
        $response = $response->WithStatus(201);
        return $response;
        
    }

    public function buscarPorQuery($request, $response, $args){
        //Pegando somente pelo nome
        $nome = $request->getQueryParams()['nome'];
        
        $dao = new FuncionarioDAO;
        $func = $dao->listarPorNome($nome);

        $response = $response->withJson($func);
        $response = $response->WithStatus(200);
        
        return $response;
    }

    public function buscarPorId($request, $response, $args) {
        $id = $args['id'];
        
        $dao= new FuncionarioDAO;    
        $func = $dao->buscarPorId($id);
        
        $response = $response->withJson($func);
        $response = $response->WithStatus(200);
        
        return $response;       
    }
    
    public function atualizar($request, $response, $args) {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $func = new Funcionario($id,$data['nome'],$data['sexo'],$data['telefone'],$data['endereco'],$data['lojaId']);
    
        $dao = new FuncionarioDAO;
        $func = $dao->atualizar($func);
    
        $response = $response->withJson($func);
        $response = $response->WithStatus(200);
        
        return $response;
    }
    
    public function deletar($request, $response, $args) {
        $id = $args['id'];
    
        $dao = new FuncionarioDAO;
        $dao->deletar($id);
        
        $response = $response->withJson("Deletado com sucesso");
        $response = $response->WithStatus(204);
        
        return $response;
    }
}
?>
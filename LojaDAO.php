<?php
    include_once 'Loja.php';
	include_once 'PDOFactory.php';

    class LojaDAO
    {
        public function inserir(Loja $loja)
        {
            $qInserir = "INSERT INTO loja(nome,telefone,endereco) VALUES (:nome,:telefone,:endereco)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":nome",$loja->nome);
            $comando->bindParam(":telefone",$loja->telefone);
            $comando->bindParam(":endereco",$loja->endereco);
            $comando->execute();
            $produto->id = $pdo->lastInsertId();
            return $produto;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from loja WHERE id=:id";            
            $loja = $this->buscarPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
            return $loja;
        }

        public function atualizar(Loja $loja)
        {
            $qAtualizar = "UPDATE loja SET nome=:nome, telefone=:telefone, endereco=:endereco WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":nome",$loja->nome);
            $comando->bindParam(":telefone",$loja->telefone);
            $comando->bindParam(":endereco",$loja->endereco);
            $comando->bindParam(":id",$loja->id);
            $comando->execute();    
            return($loja);    
        }

        public function listar()
        {
		    $query = 'SELECT * FROM loja';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $lojas=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $lojas[] = new Loja($row->id,$row->nome,$row->telefone,$row->endereco);
            }
            return $lojas;
        }

        public function listarPorNome($nome)
        {
            $query = 'SELECT * FROM loja WHERE nome LIKE :nome';
    		$pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $nome = '%'.$nome.'%';
            $comando->bindParam ('nome',$nome);
    		$comando->execute();
            $lojas=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $lojas[] = new Loja($row->id,$row->nome);
            }
            return $lojas;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM loja WHERE id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Loja($result->id,$result->nome);           
        }
    }
?>
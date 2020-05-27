<?php
    include_once 'Funcionario.php';
	include_once 'PDOFactory.php';

    class FuncionarioDAO
    {
        public function inserir(Funcionario $func)
        {
            $qInserir = "INSERT INTO loja(nome, sexo, telefone,endereco, lojaId) 
            VALUES (:nome,:sexo, :telefone,:endereco, :lojaId)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":nome",$func->nome);
            $comando->bindParam(":sexo",$func->sexo);
            $comando->bindParam(":telefone",$func->telefone);
            $comando->bindParam(":endereco",$func->endereco);
            $comando->bindParam(":lojaId",$func->lojaId);
            $comando->execute();
            $func->id = $pdo->lastInsertId();
            return $func;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from funcionario WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
        }

        public function atualizar(Funcionario $func)
        {
            $qAtualizar = "UPDATE loja SET nome=:nome, sexo=:sexo, telefone=:telefone, 
            endereco=:endereco lojaId=:lojaId WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":nome",$func->nome);
            $comando->bindParam(":sexo",$func->sexo);
            $comando->bindParam(":telefone",$func->telefone);
            $comando->bindParam(":endereco",$func->endereco);
            $comando->bindParam(":lojaId",$func->lojaId);
            $comando->bindParam(":id",$func->id);
            $comando->execute();    
            return($func);    
        }

        public function listar()
        {
		    $query = 'SELECT * FROM funcionario';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $funcionarios=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
                $funcionarios[] = new Funcionario($row->id,$row->nome, $row->sexo, $row->telefone,
                $row->endereco, $row->lojaId);
            }
            return $funcionarios;
        }

        public function listarPorNome($nome)
        {
            $query = 'SELECT * FROM funcionario WHERE nome LIKE :nome';
    		$pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $nome = '%'.$nome.'%';
            $comando->bindParam ('nome',$nome);
    		$comando->execute();
            $func=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $func[] = new Funcionario($row->id,$row->nome, $row->sexo, $row->telefone,
                $row->endereco, $row->lojaId);
            }
            return $func;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM funcionario WHERE id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
            $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Funcionario($result->id,$result->nome, $result->sexo, $result->telefone,
            $result->endereco, $result->lojaId);          
        }
    }
?>
<?php
    class DAOProduto {
        public function cadastrar(Produto $produto) {
            $sql = "INSERT INTO produto
                VALUES (default, :nome, :preco, :descricao, :servico)";
            $con = Conexao::getInstance()->prepare($sql);
            $con->bindValue(":nome", $produto->getNome());
            $con->bindValue(":preco", $produto->getPreco());
            $con->bindValue(":descricao", $produto->getDescricao());
            // $produto->getServico() um objeto da class servico
            // entao $produto->getServico()->getId() retorna o id do servico
            $con->bindValue(":servico", $produto->getServico()->getId());
            $con->execute();
            return "Cadastrado com sucesso";
        }
        public function listaProdutos() {
            $sql = "SELECT
            produto.nome,
            produto.preco,
            produto.pk_produto as 'id',
            servicos.nome as 'servicos'
            
            from produto
            INNER JOIN servicos
            ON produto.fk_produto_servico = servicos.pk_departamento";
            $con = Conexao::getInstance()->prepare($sql);
            $con->execute();
            $lista = array();
            while($produto = $con->fetch(PDO::FETCH_ASSOC)) {
                $lista[] = $produto;
            }
            return $lista;
        }
    }
?>
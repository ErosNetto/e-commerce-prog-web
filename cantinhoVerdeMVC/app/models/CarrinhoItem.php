<?php

class CarrinhoItem extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function adicionarItem($carrinho_id, $produto_id, $quantidade, $preco_unitario)
    {
        if ($quantidade <= 0 || $preco_unitario < 0) {
            return false;
        }

        $sql = "INSERT INTO carrinho_itens (carrinho_id, produto_id, quantidade, preco_unitario) 
                VALUES (:carrinho_id, :produto_id, :quantidade, :preco_unitario)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':carrinho_id', $carrinho_id);
        $stmt->bindParam(':produto_id', $produto_id);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':preco_unitario', $preco_unitario);
        return $stmt->execute();
    }

    public function atualizarQuantidade($id, $quantidade)
    {
        if ($quantidade <= 0) {
            return $this->removerItem($id);
        }

        $sql = "UPDATE carrinho_itens SET quantidade = :quantidade WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function removerItem($id)
    {
        $sql = "DELETE FROM carrinho_itens WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function buscarItensPorCarrinho($carrinho_id)
    {
        $sql = "SELECT ci.*, 
                       p.nome AS produto_nome, 
                       p.imagem_principal, 
                       p.preco AS produto_preco,
                       (ci.quantidade * ci.preco_unitario) AS subtotal
                FROM carrinho_itens ci 
                JOIN produtos p ON ci.produto_id = p.id 
                WHERE ci.carrinho_id = :carrinho_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':carrinho_id', $carrinho_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarItemPorProdutoECarrinho($carrinho_id, $produto_id)
    {
        $sql = "SELECT * FROM carrinho_itens 
                WHERE carrinho_id = :carrinho_id AND produto_id = :produto_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':carrinho_id', $carrinho_id);
        $stmt->bindParam(':produto_id', $produto_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

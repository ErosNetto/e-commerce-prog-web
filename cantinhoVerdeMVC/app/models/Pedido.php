<?php

class Pedido extends Model
{
    public function criarPedido($usuario_id, $total)
    {
        $sql = "INSERT INTO pedidos (usuario_id, total, data_pedido) 
                VALUES (:usuario_id, :total, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':total', $total);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function buscarPedidoPorId($id)
    {
        $sql = "SELECT * FROM pedidos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPedidosPorUsuario($usuario_id)
    {
        $sql = "SELECT * FROM pedidos WHERE usuario_id = :usuario_id ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getTodosPedidos()
    {

        $sql = "SELECT 
                    p.id AS pedido_id,
                    p.data_pedido,
                    p.total,
                    u.nome AS cliente_nome,
                    u.email,
                    u.telefone
                FROM pedidos p
                INNER JOIN usuarios u ON u.id = p.usuario_id
                ORDER BY p.data_pedido DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getPedidoPorId($id)
    {
        $sql = "SELECT 
                p.id AS pedido_id,
                p.data_pedido,
                p.total,
                u.nome AS cliente_nome,
                u.email,
                u.telefone            
            FROM pedidos p
            LEFT JOIN usuarios u ON u.id = p.usuario_id
            WHERE p.id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$pedido) {
            return null;
        }

        $sqlItens = "SELECT 
                    pi.produto_id,
                    pi.quantidade,
                    pi.preco_unitario,
                    pi.subtotal,
                    pr.nome AS nome_produto
                FROM pedido_itens pi
                INNER JOIN produtos pr ON pr.id = pi.produto_id
                WHERE pi.pedido_id = :id";

        $stmtItens = $this->db->prepare($sqlItens);
        $stmtItens->bindParam(':id', $id);
        $stmtItens->execute();
        $itens = $stmtItens->fetchAll(PDO::FETCH_ASSOC);

        $pedido['itens'] = $itens;

        return $pedido;
    }
}

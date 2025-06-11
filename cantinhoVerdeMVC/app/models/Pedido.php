<?php

class Pedido extends Model
{
    public function criarPedido($usuario_id, $total)
    {
        $sql = "INSERT INTO pedidos (usuario_id, total) VALUES (:usuario_id, :total)";
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
}

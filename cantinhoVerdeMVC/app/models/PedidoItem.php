<?php

class PedidoItem extends Model
{
  public function adicionarItem($pedido_id, $produto_id, $quantidade, $preco_unitario)
  {
    $subtotal = $quantidade * $preco_unitario;
    $sql = "INSERT INTO pedido_itens (pedido_id, produto_id, quantidade, preco_unitario, subtotal)
                VALUES (:pedido_id, :produto_id, :quantidade, :preco_unitario, :subtotal)";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':pedido_id', $pedido_id);
    $stmt->bindParam(':produto_id', $produto_id);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':preco_unitario', $preco_unitario);
    $stmt->bindParam(':subtotal', $subtotal);
    return $stmt->execute();
  }

  public function buscarItensPorPedido($pedido_id)
  {
    $sql = "SELECT pi.*, p.nome, p.imagem
          FROM pedido_itens pi
          JOIN produtos p ON pi.produto_id = p.id
          WHERE pi.pedido_id = :pedido_id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':pedido_id', $pedido_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}

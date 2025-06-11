<?php

class Carrinho extends Model
{
    public function criarCarrinho($usuario_id = null)
    {
        try {
            $sql = "INSERT INTO carrinhos (usuario_id) VALUES (:usuario_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':usuario_id', $usuario_id);
            $stmt->execute();
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("[ERRO] Falha ao criar carrinho: " . $e->getMessage());
            return false;
        }
    }

    public function buscarCarrinhoPorUsuario($usuario_id)
    {
        try {
            $sql = "SELECT * FROM carrinhos WHERE usuario_id = :usuario_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':usuario_id', $usuario_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[ERRO] Falha ao buscar carrinho por usuário: " . $e->getMessage());
            return null;
        }
    }

    public function buscarCarrinhoPorId($carrinho_id)
    {
        try {
            $sql = "SELECT * FROM carrinhos WHERE id = :carrinho_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':carrinho_id', $carrinho_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[ERRO] Falha ao buscar carrinho por ID: " . $e->getMessage());
            return null;
        }
    }
}

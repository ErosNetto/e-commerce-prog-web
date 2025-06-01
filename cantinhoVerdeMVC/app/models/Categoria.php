<?php

class Categoria extends Model
{
  public function getCategoriasDestaque($limit)
  {
    try {
      $query = "SELECT id, nome, imagem, slug 
      FROM categorias 
      WHERE destaque = 1 AND status = 'ativo'
      LIMIT :limit";

      $stmt = $this->db->prepare($query);
      $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
      $stmt->execute();

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Debug condicional
      if (DEBUG_MODE) {
        error_log('[Categoria] Dados retornados: ' . print_r($result, true));
      }

      return $result;
    } catch (PDOException $e) {
      // Log do erro
      error_log("[ERRO] Falha ao buscar categorias em destaque: " . $e->getMessage());

      return [];
    }
  }

  public function getCategoriasAtivas()
  {
    try {
      $stmt = $this->db->query("SELECT id, nome, slug FROM categorias WHERE status = 'ativo'");
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("[ERRO] Falha ao buscar categorias: " . $e->getMessage());
      return [];
    }
  }
}

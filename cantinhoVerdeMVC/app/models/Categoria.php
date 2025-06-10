<?php

class Categoria extends Model
{
  public function getCategoriasDestaque($limit)
  {
    try {
      $query = "SELECT id, nome, imagem
      FROM categorias 
      WHERE destaque = 1
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

  public function getCategorias()
  {
    try {
      $stmt = $this->db->query("SELECT id, nome FROM categorias");
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("[ERRO] Falha ao buscar categorias: " . $e->getMessage());
      return [];
    }
  }

  public function getCategoriasAndCountProdutos()
  {
    try {
      $query = "SELECT 
                    c.id, 
                    c.nome, 
                    c.destaque, 
                    c.imagem,
                    COUNT(pc.produto_id) as quantidade_produtos
                  FROM categorias c
                  LEFT JOIN produto_categoria pc ON pc.categoria_id = c.id
                  LEFT JOIN produtos p ON p.id = pc.produto_id AND p.status = 'ativo'
                  GROUP BY c.id
                  ORDER BY c.nome ASC";

      $stmt = $this->db->query($query);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("[ERRO] Falha ao buscar categorias e contagem de produtos: " . $e->getMessage());
      return [];
    }
  }

  public function cadastrar($dados)
  {
    try {
      $query = "INSERT INTO categorias (nome, imagem, destaque) 
                  VALUES (:nome, :imagem, :destaque)";

      $stmt = $this->db->prepare($query);
      $stmt->bindValue(':nome', $dados['nome']);
      $stmt->bindValue(':imagem', $dados['imagem']);
      $stmt->bindValue(':destaque', $dados['destaque'], PDO::PARAM_INT);

      return $stmt->execute();
    } catch (PDOException $e) {
      error_log("[ERRO] Falha ao cadastrar categoria: " . $e->getMessage());
      return false;
    }
  }

  public function update($id, $dados)
  {
    $sql = "UPDATE categorias SET nome = :nome, imagem = :imagem, destaque = :destaque WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':nome', $dados['nome']);
    $stmt->bindValue(':imagem', $dados['imagem']);
    $stmt->bindValue(':destaque', $dados['destaque']);
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
  }

  public function delete($id)
  {
    $sql = "DELETE FROM categorias WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
  }
}

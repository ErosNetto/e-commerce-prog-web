<?php

class Produto extends Model
{
  // Função para puxar os produtos da HomePage
  public function getProdutosDestaque($limit)
  {
    try {
      $query = "SELECT p.id, p.nome, p.descricao_curta, p.preco, 
                  p.destaque, p.imagem_principal
              FROM produtos p
              WHERE p.destaque = 1 AND p.status = 'ativo' AND p.estoque > 0
              LIMIT :limit";

      $stmt = $this->db->prepare($query);
      $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
      $stmt->execute();

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (DEBUG_MODE) {
        error_log('[Produtos] Dados retornados: ' . print_r($result, true));
      }

      return $result;
    } catch (PDOException $e) {
      error_log("[ERRO] Falha ao buscar produtos em destaque: " . $e->getMessage());
      return [];
    }
  }

  public function getProdutos($pagina = 1, $itensPorPagina = 12, $filtros = [])
  {
    try {
      $offset = ($pagina - 1) * $itensPorPagina;
      $params = [];

      $query = "SELECT SQL_CALC_FOUND_ROWS p.id, p.nome, p.descricao_curta, p.preco,
                 p.destaque, p.imagem_principal
                FROM produtos p";

      // Adiciona JOIN com a tabela de relacionamento se houver filtro por categoria
      if (!empty($filtros['categoria_id'])) {
        $query .= " JOIN produto_categoria pc ON (p.id = pc.produto_id)";
      }

      $query .= " WHERE p.status = 'ativo' AND p.estoque > 0";

      // Filtro por categoria
      if (!empty($filtros['categoria_id'])) {
        $query .= " AND pc.categoria_id = :categoria_id";
        $params[':categoria_id'] = $filtros['categoria_id'];
      }

      // Filtro por preço
      if (!empty($filtros['preco_max'])) {
        $query .= " AND p.preco <= :preco_max";
        $params[':preco_max'] = $filtros['preco_max'];
      }

      // Filtro por tamanho
      if (!empty($filtros['tamanhos']) && is_array($filtros['tamanhos'])) {
        $placeholders = [];
        foreach ($filtros['tamanhos'] as $i => $tamanho) {
          $placeholder = ":tamanho_$i";
          $placeholders[] = $placeholder;
          $params[$placeholder] = $tamanho;
        }
        $query .= " AND p.tamanho IN (" . implode(",", $placeholders) . ")";
      }

      // Filtro por nível de cuidado
      if (!empty($filtros['niveis']) && is_array($filtros['niveis'])) {
        $placeholders = [];
        foreach ($filtros['niveis'] as $i => $nivel) {
          $placeholder = ":nivel_$i";
          $placeholders[] = $placeholder;
          $params[$placeholder] = $nivel;
        }
        $query .= " AND p.nivel_cuidado IN (" . implode(",", $placeholders) . ")";
      }

      // Ordenação
      $query .= $this->getOrderBy($filtros['ordenacao'] ?? '');

      // Paginação
      $query .= " LIMIT :limit OFFSET :offset";
      $params[':limit'] = $itensPorPagina;
      $params[':offset'] = $offset;

      $stmt = $this->db->prepare($query);

      // Bind dos parâmetros
      foreach ($params as $key => $value) {
        $paramType = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
        $stmt->bindValue($key, $value, $paramType);
      }

      $stmt->execute();
      $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Obter o total de produtos
      $total = $this->db->query("SELECT FOUND_ROWS()")->fetchColumn();

      return [
        'produtos' => $produtos,
        'total' => $total
      ];
    } catch (PDOException $e) {
      error_log("[ERRO] Falha ao buscar produtos: " . $e->getMessage());
      return ['produtos' => [], 'total' => 0];
    }
  }

  private function getOrderBy($ordenacao)
  {
    switch ($ordenacao) {
      case 'price-low':
        return " ORDER BY preco ASC";
      case 'price-high':
        return " ORDER BY preco DESC";
      case 'newest':
        return " ORDER BY p.data_cadastro DESC";
      default:
        return " ORDER BY p.destaque DESC, p.data_cadastro DESC";
    }
  }

  public function getDetalheProduto($id)
  {
    try {
      $query = "SELECT 
          p.*,
          GROUP_CONCAT(DISTINCT CONCAT(c.id, ':', c.nome)) as categorias_completas
        FROM produtos p
        LEFT JOIN produto_categoria pc ON p.id = pc.produto_id
        LEFT JOIN categorias c ON pc.categoria_id = c.id
        WHERE p.id = :id AND p.status = 'ativo'
        GROUP BY p.id";


      $stmt = $this->db->prepare($query);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->execute();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($result) {
        // Processa categorias como pares id:nome
        $result['categorias'] = [];
        $result['categoria_ids'] = [];

        if (!empty($result['categorias_completas'])) {
          $pares = explode(',', $result['categorias_completas']);
          foreach ($pares as $par) {
            list($id, $nome) = explode(':', $par);
            $result['categoria_ids'][] = $id;
            $result['categorias'][] = $nome;
          }
        }

        unset($result['categorias_completas']); // não precisa mais

        // Formata o preço
        $result['preco_formatado'] = number_format($result['preco'], 2, ',', '.');

        // Parcelamento
        $result['parcelamento'] = $result['preco'] > 0
          ? 'ou 3x de R$' . number_format($result['preco'] / 3, 2, ',', '.') . ' sem juros'
          : '';
      }

      return $result;
    } catch (PDOException $e) {
      error_log("[ERRO] Falha ao buscar detalhes do produto: " . $e->getMessage());
      return false;
    }
  }

  public function getProdutosAdmin()
  {
    try {
      $query = "SELECT 
                p.*,
                GROUP_CONCAT(DISTINCT c.nome SEPARATOR ', ') as categorias_nomes,
                GROUP_CONCAT(DISTINCT c.id SEPARATOR ', ') as categorias_ids
            FROM produtos p
            LEFT JOIN produto_categoria pc ON p.id = pc.produto_id
            LEFT JOIN categorias c ON pc.categoria_id = c.id
            GROUP BY p.id
            ORDER BY p.nome";

      $stmt = $this->db->prepare($query);
      $stmt->execute();

      $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($produtos as &$produto) {
        $produto['categorias_nomes'] = $produto['categorias_nomes'] ? explode(', ', $produto['categorias_nomes']) : [];
        $produto['categorias_ids'] = $produto['categorias_ids'] ? explode(', ', $produto['categorias_ids']) : [];
      }

      return $produtos;
    } catch (PDOException $e) {
      error_log("[ERRO] Falha ao buscar produtos: " . $e->getMessage());
      return false;
    }
  }

  public function cadastrar($dados)
  {
    try {
      // Inicia transação
      $this->db->beginTransaction();

      // Insere o produto na tabela produtos
      $queryProduto = "INSERT INTO produtos (
            nome, 
            descricao, 
            descricao_curta, 
            imagem_principal, 
            preco, 
            estoque, 
            nivel_cuidado, 
            tamanho, 
            ambiente, 
            luz, 
            agua, 
            destaque
        ) VALUES (
            :nome, 
            :descricao, 
            :descricao_curta, 
            :imagem_principal, 
            :preco, 
            :estoque, 
            :nivel_cuidado, 
            :tamanho, 
            :ambiente, 
            :luz, 
            :agua, 
            :destaque
        )";

      $stmtProduto = $this->db->prepare($queryProduto);
      $stmtProduto->bindValue(':nome', $dados['nome']);
      $stmtProduto->bindValue(':descricao', $dados['descricao']);
      $stmtProduto->bindValue(':descricao_curta', $dados['descricao_curta']);
      $stmtProduto->bindValue(':imagem_principal', $dados['imagem_principal']);
      $stmtProduto->bindValue(':preco', $dados['preco']);
      $stmtProduto->bindValue(':estoque', $dados['estoque']);
      $stmtProduto->bindValue(':nivel_cuidado', $dados['nivel_cuidado']);
      $stmtProduto->bindValue(':tamanho', $dados['tamanho']);
      $stmtProduto->bindValue(':ambiente', $dados['ambiente']);
      $stmtProduto->bindValue(':luz', $dados['luz']);
      $stmtProduto->bindValue(':agua', $dados['agua']);
      $stmtProduto->bindValue(':destaque', $dados['destaque'], PDO::PARAM_BOOL);

      $stmtProduto->execute();
      $produtoId = $this->db->lastInsertId();

      // Insere as relações com categorias
      if (!empty($dados['categorias_ids'])) {
        $queryCategoria = "INSERT INTO produto_categoria (produto_id, categoria_id) VALUES (:produto_id, :categoria_id)";
        $stmtCategoria = $this->db->prepare($queryCategoria);

        // Se for uma string (single ID), converte para array
        $categorias = is_array($dados['categorias_ids']) ? $dados['categorias_ids'] : [$dados['categorias_ids']];

        foreach ($categorias as $categoriaId) {
          $stmtCategoria->bindValue(':produto_id', $produtoId);
          $stmtCategoria->bindValue(':categoria_id', $categoriaId);
          $stmtCategoria->execute();
        }
      }

      // Commit da transação
      $this->db->commit();
      return true;
    } catch (PDOException $e) {
      // Rollback em caso de erro
      $this->db->rollBack();
      error_log("Erro ao cadastrar produto: " . $e->getMessage());
      return false;
    }
  }

  public function update($id, $dados)
  {
    try {
      // Inicia transação
      $this->db->beginTransaction();

      // Atualiza o produto na tabela produtos
      $queryProduto = "UPDATE produtos SET
            nome = :nome, 
            descricao = :descricao, 
            descricao_curta = :descricao_curta, 
            imagem_principal = :imagem_principal, 
            preco = :preco, 
            estoque = :estoque, 
            nivel_cuidado = :nivel_cuidado, 
            tamanho = :tamanho, 
            ambiente = :ambiente, 
            luz = :luz, 
            agua = :agua, 
            destaque = :destaque,
            data_atualizacao = CURRENT_TIMESTAMP
        WHERE id = :id";

      $stmtProduto = $this->db->prepare($queryProduto);
      $stmtProduto->bindValue(':id', $id);
      $stmtProduto->bindValue(':nome', $dados['nome']);
      $stmtProduto->bindValue(':descricao', $dados['descricao']);
      $stmtProduto->bindValue(':descricao_curta', $dados['descricao_curta']);
      $stmtProduto->bindValue(':imagem_principal', $dados['imagem_principal']);
      $stmtProduto->bindValue(':preco', $dados['preco']);
      $stmtProduto->bindValue(':estoque', $dados['estoque']);
      $stmtProduto->bindValue(':nivel_cuidado', $dados['nivel_cuidado']);
      $stmtProduto->bindValue(':tamanho', $dados['tamanho']);
      $stmtProduto->bindValue(':ambiente', $dados['ambiente']);
      $stmtProduto->bindValue(':luz', $dados['luz']);
      $stmtProduto->bindValue(':agua', $dados['agua']);
      $stmtProduto->bindValue(':destaque', $dados['destaque'], PDO::PARAM_BOOL);

      $stmtProduto->execute();

      // Remove todas as categorias atuais do produto
      $queryDeleteCategorias = "DELETE FROM produto_categoria WHERE produto_id = :produto_id";
      $stmtDelete = $this->db->prepare($queryDeleteCategorias);
      $stmtDelete->bindValue(':produto_id', $id);
      $stmtDelete->execute();

      // Insere as novas relações com categorias
      if (!empty($dados['categorias_ids'])) {
        $queryCategoria = "INSERT INTO produto_categoria (produto_id, categoria_id) VALUES (:produto_id, :categoria_id)";
        $stmtCategoria = $this->db->prepare($queryCategoria);

        // Se for uma string (single ID), converte para array
        $categorias = is_array($dados['categorias_ids']) ? $dados['categorias_ids'] : [$dados['categorias_ids']];

        foreach ($categorias as $categoriaId) {
          $stmtCategoria->bindValue(':produto_id', $id);
          $stmtCategoria->bindValue(':categoria_id', $categoriaId);
          $stmtCategoria->execute();
        }
      }

      // Commit da transação
      $this->db->commit();
      return true;
    } catch (PDOException $e) {
      // Rollback em caso de erro
      $this->db->rollBack();
      error_log("Erro ao atualizar produto: " . $e->getMessage());
      return false;
    }
  }

  public function delete($id)
  {
    $sql = "DELETE FROM produtos WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
  }
}

<?php

class Produto extends Model
{
  // Função para puxar os produtos da HomePage
  public function getProdutosDestaque($limit)
  {
    try {
      $query = "SELECT p.id, p.nome, p.descricao_curta, p.preco, p.preco_promocional, 
                  p.destaque, pi.url as imagem_principal
              FROM produtos p
              LEFT JOIN produto_imagens pi ON (p.id = pi.produto_id AND pi.principal = TRUE)
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
                  p.preco_promocional, p.destaque, pi.url as imagem_principal
                FROM produtos p
                LEFT JOIN produto_imagens pi ON (p.id = pi.produto_id AND pi.principal = TRUE)";

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
        $query .= " AND (COALESCE(p.preco_promocional, p.preco) <= :preco_max)";
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
        return " ORDER BY COALESCE(preco_promocional, preco) ASC";
      case 'price-high':
        return " ORDER BY COALESCE(preco_promocional, preco) DESC";
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
                    pi.url as imagem_principal,
                    GROUP_CONCAT(DISTINCT pi2.url) as imagens_adicionais,
                    GROUP_CONCAT(DISTINCT c.nome) as categorias
                FROM produtos p
                LEFT JOIN produto_imagens pi ON (p.id = pi.produto_id AND pi.principal = TRUE)
                LEFT JOIN produto_imagens pi2 ON (p.id = pi2.produto_id AND pi2.principal = FALSE)
                LEFT JOIN produto_categoria pc ON p.id = pc.produto_id
                LEFT JOIN categorias c ON pc.categoria_id = c.id
                WHERE p.id = :id AND p.status = 'ativo'
                GROUP BY p.id";

      $stmt = $this->db->prepare($query);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->execute();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($result) {
        // Processa as imagens adicionais
        $result['imagens_adicionais'] = $result['imagens_adicionais']
          ? explode(',', $result['imagens_adicionais'])
          : [];

        // Processa as categorias
        $result['categorias'] = $result['categorias']
          ? explode(',', $result['categorias'])
          : [];

        // Formata o preço
        $result['preco_formatado'] = number_format($result['preco'], 2, ',', '.');

        if ($result['preco_promocional']) {
          $result['preco_promocional_formatado'] = number_format($result['preco_promocional'], 2, ',', '.');
          $result['parcelamento'] = $result['preco_promocional'] > 0
            ? 'ou 3x de R$' . number_format($result['preco_promocional'] / 3, 2, ',', '.') . ' sem juros'
            : '';
        } else {
          $result['parcelamento'] = $result['preco'] > 0
            ? 'ou 3x de R$' . number_format($result['preco'] / 3, 2, ',', '.') . ' sem juros'
            : '';
        }
      }

      return $result;
    } catch (PDOException $e) {
      error_log("[ERRO] Falha ao buscar detalhes do produto: " . $e->getMessage());
      return false;
    }
  }

  public function getProdutosAdmin()
  {
    // try {
    //   $query = "SELECT 
    //                 c.id, 
    //                 c.nome, 
    //                 c.destaque, 
    //                 c.imagem,
    //                 COUNT(pc.produto_id) as quantidade_produtos
    //               FROM categorias c
    //               LEFT JOIN produto_categoria pc ON pc.categoria_id = c.id
    //               LEFT JOIN produtos p ON p.id = pc.produto_id AND p.status = 'ativo'
    //               GROUP BY c.id
    //               ORDER BY c.nome ASC";

    //   $stmt = $this->db->query($query);
    //   return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // } catch (PDOException $e) {
    //   error_log("[ERRO] Falha ao buscar categorias e contagem de produtos: " . $e->getMessage());
    //   return [];
    // }
  }
}

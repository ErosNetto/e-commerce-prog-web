<?php

class DetalheProdutoController extends Controller
{
  public function index()
  {
    // Verifica se o parâmetro idProduto foi passado
    if (!isset($_GET['idProduto'])) {
      header('Location: ' . BASE_URL . '/produtos');
      exit;
    }

    $idProduto = (int)$_GET['idProduto'];

    // Obtém os detalhes do produto
    $produtoModel = $this->model('Produto');
    $produto = $produtoModel->getDetalheProduto($idProduto);

    // Se o produto não existir, redireciona
    if (!$produto) {
      header('Location: ' . BASE_URL . '/produtos');
      exit;
    }

    // Carrega a view com os dados do produto
    $this->view('detalheProduto', [
      'produto' => $produto,
      'titulo' => $produto['nome'] . ' - ' . APP_NAME
    ]);
  }
}

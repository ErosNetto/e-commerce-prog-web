<?php

class DetalheProdutoController extends Controller
{
  public function index()
  {
    if (!isset($_GET['idProduto'])) {
      header('Location: ' . BASE_URL . '/produtos');
      exit;
    }

    $idProduto = (int)$_GET['idProduto'];

    $produtoModel = $this->model('Produto');
    $produto = $produtoModel->getDetalheProduto($idProduto);

    if (!$produto) {
      header('Location: ' . BASE_URL . '/produtos');
      exit;
    }

    $this->view('detalheProduto', [
      'produto' => $produto,
      'titulo' => $produto['nome'] . ' - ' . APP_NAME
    ]);
  }
}

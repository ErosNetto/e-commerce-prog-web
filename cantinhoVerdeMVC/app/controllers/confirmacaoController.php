<?php

class ConfirmacaoController extends Controller
{
  public function index()
  {
    $_SESSION['mensagem_erro'] = "Pedido inválido.";
    $this->redirect('/produtos');
  }

  public function sucesso($id)
  {
    // Validação básica do ID
    if (!is_numeric($id) || $id <= 0) {
      $_SESSION['mensagem_erro'] = "ID de pedido inválido.";
      $this->redirect('/produtos');
      return;
    }

    // Carrega os modelos
    $pedidoModel = $this->model('Pedido');
    $pedidoItemModel = $this->model('PedidoItem');

    // Busca o pedido
    $pedido = $pedidoModel->buscarPedidoPorId($id);

    if (!$pedido) {
      $_SESSION['mensagem_erro'] = "Pedido não encontrado.";
      $this->redirect('/produtos');
      return;
    }

    // Busca os itens do pedido
    $itens = $pedidoItemModel->buscarItensPorPedido($id);

    // Carrega a view passando os dados
    $this->view('confirmacao', [
      'pedido' => $pedido,
      'itens' => $itens
    ]);
  }
}

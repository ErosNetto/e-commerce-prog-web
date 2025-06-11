<?php

class ConfirmacaoController extends Controller
{
  public function index()
  {
    $this->view('confirmacao');
  }

  public function sucesso($id)
  {
    $pedidoModel = $this->model('Pedido');
    $pedidoItemModel = $this->model('PedidoItem');

    $pedido = $pedidoModel->buscarPedidoPorId($id);
    $itens = $pedidoItemModel->buscarItensPorPedido($id);

    if (!$pedido) {
      $_SESSION['mensagem_erro'] = "Pedido não encontrado.";
      $this->redirect('/produtos');
      return;
    }

    $this->view('confirmacao', [
      'pedido' => $pedido,
      'itens' => $itens
    ]);
  }
}

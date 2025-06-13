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
    if (!is_numeric($id) || $id <= 0) {
      $_SESSION['mensagem_erro'] = "ID de pedido inválido.";
      $this->redirect('/produtos');
      return;
    }

    $pedidoModel = $this->model('Pedido');
    $pedidoItemModel = $this->model('PedidoItem');

    $pedido = $pedidoModel->buscarPedidoPorId($id);

    if (!$pedido) {
      $_SESSION['mensagem_erro'] = "Pedido não encontrado.";
      $this->redirect('/produtos');
      return;
    }

    $itens = $pedidoItemModel->buscarItensPorPedido($id);

    $this->view('confirmacao', [
      'pedido' => $pedido,
      'itens' => $itens
    ]);
  }
}

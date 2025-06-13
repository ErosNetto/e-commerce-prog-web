<?php

require_once '../app/helpers/Auth.php';

class adminPedidosController extends Controller
{
  private $pedidoModel;

  public function __construct()
  {
    Auth::requireAdmin();
    $this->pedidoModel = $this->model("Pedido");
  }

  public function pedidos()
  {
    $pedidos = $this->pedidoModel->getTodosPedidos();
    $this->view("admin/pedidos", [
      'pedidos' => $pedidos
    ]);
  }

  public function visualizar($id)
  {
    $pedido = $this->pedidoModel->getPedidoPorId($id);

    if (!$pedido) {
      http_response_code(404);
      $this->view("errors/404", ['mensagem' => 'Pedido não encontrado']);
      return;
    }

    $itens = $this->pedidoModel->getItensDoPedido($id);

    $this->view("admin/pedidos/visualizar", [
      'pedido' => $pedido,
      'itens' => $itens
    ]);
  }

  public function obterPedido($id)
  {
    $pedido = $this->pedidoModel->getPedidoPorId($id);

    header('Content-Type: application/json');
    if ($pedido) {
      echo json_encode($pedido);
    } else {
      http_response_code(404);
      echo json_encode(['erro' => 'Pedido não encontrado']);
    }
  }
}

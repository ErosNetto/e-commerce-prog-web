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

  // public function visualizar($id)
  // {
  //   $pedido = $this->pedidoModel->getPedidoPorId($id);
  //   $itens = $this->pedidoModel->getItensDoPedido($id);

  //   $this->view("admin/pedidos/visualizar", [
  //     'pedido' => $pedido,
  //     'itens' => $itens
  //   ]);
  // }
}

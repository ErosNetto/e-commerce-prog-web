<?php

require_once '../app/helpers/Auth.php';

class ContaController extends Controller
{
  public function perfil()
  {
    $usuario = Auth::getUser();
    $usuario_id = $usuario['id'];

    $pedidoModel = $this->model('Pedido');
    $pedidoItemModel = $this->model('PedidoItem');

    $pedidos = $pedidoModel->buscarPedidosPorUsuario($usuario_id);

    foreach ($pedidos as &$pedido) {
      $pedido['itens'] = $pedidoItemModel->buscarItensPorPedido($pedido['id']);
    }

    $this->view('conta', [
      'pedidos' => $pedidos,
      'usuario' => $usuario
    ]);
  }
}

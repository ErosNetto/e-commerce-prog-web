<?php

require_once '../app/helpers/Auth.php';

class AdminPedidosController extends Controller
{
  public function __construct()
  {
    Auth::requireAdmin();
  }

  public function index()
  {
    $this->view('admin/pedidos');
  }
}

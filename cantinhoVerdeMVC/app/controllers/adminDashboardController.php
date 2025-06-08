<?php

require_once '../app/helpers/Auth.php';

class AdminDashboardController extends Controller
{
  public function __construct()
  {
    Auth::requireAdmin();
  }

  public function index()
  {
    $this->view("admin/dashboard");
  }
}

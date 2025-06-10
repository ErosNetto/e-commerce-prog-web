<?php

require_once '../app/helpers/Auth.php';

class AdminCategoriasController extends Controller
{
  private $categoriaModel;

  public function __construct()
  {
    Auth::requireAdmin();
    $this->categoriaModel = $this->model('Categoria');
  }

  public function index()
  {
    $categorias = $this->categoriaModel->getCategoriasAndCountProdutos();
    $this->view('admin/categorias', [
      'categorias' => $categorias,
      'titulo' => 'Gerenciamento de Categorias'
    ]);
  }

  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Sanitizar e validar dados
      $dados = [
        'nome' => trim($_POST['nome']),
        'imagem' => trim($_POST['imagem']),
        'destaque' => isset($_POST['destaque']) ? 1 : 0
      ];

      // Validação
      if (empty($dados['nome'])) {
        $_SESSION['error'] = 'Nome é obrigatório';
        $this->redirect('/adminCategorias');
        return;
      }

      // Cadastrar no banco de dados
      if ($this->categoriaModel->cadastrar($dados)) {
        $_SESSION['success'] = 'Categoria cadastrada com sucesso!';
      } else {
        $_SESSION['error'] = 'Erro ao cadastrar categoria';
      }

      $this->redirect('/adminCategorias');
    }
  }

  public function update()
  {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $imagem = $_POST['imagem'] ?? '';
    $destaque = isset($_POST['destaque']) ? 1 : 0;

    if (!$id || !$nome) {
      $_SESSION['error'] = "Todos os campos obrigatórios devem ser preenchidos.";
      header("Location: " . BASE_URL . "/adminCategorias/categorias");
      exit;
    }

    $this->categoriaModel->update($id, [
      'nome' => $nome,
      'imagem' => $imagem,
      'destaque' => $destaque
    ]);

    $_SESSION['success'] = "Categoria atualizada com sucesso!";
    header("Location: " . BASE_URL . "/adminCategorias/categorias");
  }

  public function delete($id)
  {
    if (!$id) {
      $_SESSION['error'] = "ID inválido.";
      header("Location: " . BASE_URL . "/adminCategorias/categorias");
      exit;
    }

    $this->categoriaModel->delete($id);

    $_SESSION['success'] = "Categoria excluída com sucesso!";
    header("Location: " . BASE_URL . "/adminCategorias/categorias");
  }
}

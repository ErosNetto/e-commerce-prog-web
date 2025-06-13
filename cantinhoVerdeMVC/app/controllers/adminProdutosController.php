<?php

require_once '../app/helpers/Auth.php';

class AdminProdutosController extends Controller
{
  private $produtoModel;
  private $categoriaModel;

  public function __construct()
  {
    Auth::requireAdmin();
    $this->produtoModel = $this->model('Produto');
    $this->categoriaModel = $this->model('Categoria');
  }

  public function index()
  {
    $produtos = $this->produtoModel->getProdutosAdmin();
    $categorias = $this->categoriaModel->getCategorias();
    $this->view('admin/produtos', [
      'produtos' => $produtos,
      'categorias' => $categorias,
      'titulo' => 'Gerenciamento de Produtos'
    ]);
  }

  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $dados = [
        'nome' => trim($_POST['nome']),
        'descricao' => trim($_POST['descricao']),
        'descricao_curta' => trim($_POST['descricaoCurta']),
        'imagem_principal' => trim($_POST['imagem']),
        'preco' => (float) str_replace(['R$', '.', ','], ['', '', '.'], trim($_POST['preco'])),
        'estoque' => (int) trim($_POST['estoque']),
        'nivel_cuidado' => trim($_POST['nivel_cuidado']),
        'tamanho' => trim($_POST['tamanho']),
        'ambiente' => trim($_POST['ambiente']),
        'luz' => trim($_POST['luz']),
        'agua' => trim($_POST['agua']),
        'destaque' => isset($_POST['destaque']) ? 1 : 0,
        'categorias_ids' => trim($_POST['categoria'])
      ];

      $erros = [];

      if (empty($dados['nome'])) {
        $erros[] = 'Nome é obrigatório';
      }

      if (empty($dados['imagem_principal'])) {
        $erros[] = 'Imagem é obrigatória';
      }

      if ($dados['preco'] <= 0) {
        $erros[] = 'Preço deve ser maior que zero';
      }

      if ($dados['estoque'] < 0) {
        $erros[] = 'Estoque não pode ser negativo';
      }

      if (!empty($erros)) {
        $_SESSION['error'] = implode('<br>', $erros);
        $this->redirect('/adminProdutos');
        return;
      }

      if ($this->produtoModel->cadastrar($dados)) {
        $_SESSION['success'] = 'Produto cadastrado com sucesso!';
      } else {
        $_SESSION['error'] = 'Erro ao cadastrar produto';
      }

      $this->redirect('/adminProdutos');
    } else {
      $this->redirect('/adminProdutos');
    }
  }

  public function update()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $dados = [
        'id' => (int) $_POST['id'],
        'nome' => trim($_POST['nome']),
        'descricao' => trim($_POST['descricao']),
        'descricao_curta' => trim($_POST['descricaoCurta']),
        'imagem_principal' => trim($_POST['imagem']),
        'preco' => (float) trim($_POST['preco']),
        'estoque' => (int) trim($_POST['estoque']),
        'nivel_cuidado' => trim($_POST['nivel_cuidado']),
        'tamanho' => trim($_POST['tamanho']),
        'ambiente' => trim($_POST['ambiente']),
        'luz' => trim($_POST['luz']),
        'agua' => trim($_POST['agua']),
        'destaque' => isset($_POST['destaque']) ? 1 : 0,
        'categorias_ids' => trim($_POST['categoria'])
      ];

      $erros = [];

      if (empty($dados['nome'])) {
        $erros[] = 'Nome é obrigatório';
      }

      if (empty($dados['imagem_principal'])) {
        $erros[] = 'Imagem é obrigatória';
      }

      if ($dados['preco'] <= 0) {
        $erros[] = 'Preço deve ser maior que zero';
      }

      if ($dados['estoque'] < 0) {
        $erros[] = 'Estoque não pode ser negativo';
      }

      if (!empty($erros)) {
        $_SESSION['error'] = implode('<br>', $erros);
        $this->redirect('/adminProdutos');
        return;
      }

      if ($this->produtoModel->update($dados['id'], $dados)) {
        $_SESSION['success'] = 'Produto atualizado com sucesso!';
      } else {
        $_SESSION['error'] = 'Erro ao atualizar produto';
      }

      $this->redirect('/adminProdutos');
    } else {
      $this->redirect('/adminProdutos');
    }
  }

  public function delete($id)
  {
    if (!$id) {
      $_SESSION['error'] = "ID inválido.";
      header("Location: " . BASE_URL . "/adminProdutos/produtos");
      exit;
    }

    $this->produtoModel->delete($id);

    $_SESSION['success'] = "Produto excluído com sucesso!";
    header("Location: " . BASE_URL . "/adminProdutos/produtos");
  }
}

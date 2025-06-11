<?php

require_once '../app/helpers/Auth.php';


class CarrinhoController extends Controller
{
    public function __construct()
    {
        Auth::iniciarSessao();
    }

    public function index()
    {
        $carrinho_id = $this->obterCarrinhoId();
        $carrinhoItemModel = $this->model('CarrinhoItem');
        $itens = $carrinhoItemModel->buscarItensPorCarrinho($carrinho_id);

        $total = 0;
        foreach ($itens as $item) {
            $total += $item['quantidade'] * $item['preco_unitario'];
        }

        $this->view('carrinho', [
            'itens' => $itens,
            'total' => $total
        ]);
    }

    public function adicionar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $produto_id = $_POST['produto_id'] ?? null;
            $quantidade = $_POST['quantidade'] ?? 1;

            if (!$produto_id) {
                $_SESSION['mensagem_erro'] = "Produto não encontrado.";
                $this->redirect('/produtos');
                return;
            }

            // Buscar informações do produto
            $produtoModel = $this->model('Produto');
            $produto = $produtoModel->buscarPorId($produto_id);

            if (!$produto) {
                $_SESSION['mensagem_erro'] = "Produto não encontrado.";
                $this->redirect('/produtos');
                return;
            }

            // Verificar estoque
            if ($produto['estoque'] < $quantidade) {
                $_SESSION['mensagem_erro'] = "Quantidade solicitada não disponível em estoque.";
                $this->redirect('/produto/detalhes/' . $produto_id);
                return;
            }

            $carrinho_id = $this->obterCarrinhoId();
            $carrinhoItemModel = $this->model('CarrinhoItem');

            // Verificar se o produto já está no carrinho
            $itemExistente = $carrinhoItemModel->buscarItemPorProdutoECarrinho($carrinho_id, $produto_id);

            if ($itemExistente) {
                // Atualizar quantidade
                $novaQuantidade = $itemExistente['quantidade'] + $quantidade;

                if ($produto['estoque'] < $novaQuantidade) {
                    $_SESSION['mensagem_erro'] = "Quantidade total solicitada excede o estoque disponível.";
                    $this->redirect('/produto/detalhes/' . $produto_id);
                    return;
                }

                $carrinhoItemModel->atualizarQuantidade($itemExistente['id'], $novaQuantidade);
            } else {
                // Adicionar novo item
                $carrinhoItemModel->adicionarItem($carrinho_id, $produto_id, $quantidade, $produto['preco']);
            }

            $_SESSION['mensagem_sucesso'] = "Produto adicionado ao carrinho com sucesso!";
            $this->redirect('/carrinho');
        }
    }

    public function atualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $item_id = $_POST['item_id'] ?? null;
            $quantidade = $_POST['quantidade'] ?? 1;

            if (!$item_id || $quantidade < 1) {
                $_SESSION['mensagem_erro'] = "Dados inválidos.";
                $this->redirect('/carrinho');
                return;
            }

            $carrinhoItemModel = $this->model('CarrinhoItem');
            $carrinhoItemModel->atualizarQuantidade($item_id, $quantidade);

            $_SESSION['mensagem_sucesso'] = "Carrinho atualizado com sucesso!";
            $this->redirect('/carrinho');
        }
    }

    public function remover()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $item_id = $_POST['item_id'] ?? null;

            if (!$item_id) {
                $_SESSION['mensagem_erro'] = "Item não encontrado.";
                $this->redirect('/carrinho');
                return;
            }

            $carrinhoItemModel = $this->model('CarrinhoItem');
            $carrinhoItemModel->removerItem($item_id);

            $_SESSION['mensagem_sucesso'] = "Item removido do carrinho!";
            $this->redirect('/carrinho');
        }
    }

    public function limpar()
    {
        $carrinho_id = $this->obterCarrinhoId();
        $carrinhoItemModel = $this->model('CarrinhoItem');

        // Remover todos os itens do carrinho
        $itens = $carrinhoItemModel->buscarItensPorCarrinho($carrinho_id);
        foreach ($itens as $item) {
            $carrinhoItemModel->removerItem($item['id']);
        }

        $_SESSION['mensagem_sucesso'] = "Carrinho limpo com sucesso!";
        $this->redirect('/carrinho');
    }

    private function obterCarrinhoId()
    {
        $carrinhoModel = $this->model('Carrinho');

        if (Auth::isLoggedIn()) {
            // Usuário logado - buscar carrinho por usuário
            $user = Auth::getUser();
            $carrinho = $carrinhoModel->buscarCarrinhoPorUsuario($user['id']);

            if (!$carrinho) {
                // Criar novo carrinho para o usuário
                $carrinho_id = $carrinhoModel->criarCarrinho($user['id']);
            } else {
                $carrinho_id = $carrinho['id'];
            }
        } else {
            // Usuário não logado - usar sessão
            if (!isset($_SESSION['carrinho_id'])) {
                // Criar novo carrinho sem usuário
                $_SESSION['carrinho_id'] = $carrinhoModel->criarCarrinho();
            }
            $carrinho_id = $_SESSION['carrinho_id'];
        }

        return $carrinho_id;
    }

    public function finalizarPedido()
    {
        if (!Auth::isLoggedIn()) {
            $_SESSION['mensagem_erro'] = "Você precisa estar logado para finalizar o pedido.";
            $this->redirect('/login');
            return;
        }

        $usuario = Auth::getUser();
        $carrinho_id = $this->obterCarrinhoId();

        $carrinhoItemModel = $this->model('CarrinhoItem');
        $pedidoModel = $this->model('Pedido');
        $pedidoItemModel = $this->model('PedidoItem');

        $itens = $carrinhoItemModel->buscarItensPorCarrinho($carrinho_id);

        if (empty($itens)) {
            $_SESSION['mensagem_erro'] = "Seu carrinho está vazio.";
            $this->redirect('/carrinho');
            return;
        }

        $total = 0;
        foreach ($itens as $item) {
            $total += $item['quantidade'] * $item['preco_unitario'];
        }

        // Criar pedido
        $pedido_id = $pedidoModel->criarPedido($usuario['id'], $total);

        // Adicionar itens ao pedido
        foreach ($itens as $item) {
            $pedidoItemModel->adicionarItem(
                $pedido_id,
                $item['produto_id'],
                $item['quantidade'],
                $item['preco_unitario']
            );
        }

        // (Opcional) Limpar carrinho
        $carrinhoModel = $this->model('Carrinho');
        $carrinhoModel->limparCarrinho($carrinho_id);

        $_SESSION['mensagem_sucesso'] = "Pedido realizado com sucesso!";
        $this->redirect('/pedido/sucesso/' . $pedido_id);
    }
}

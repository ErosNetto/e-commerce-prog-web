<?php

class UsuarioController extends Controller
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function cadastro()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $sobrenome = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
            $confirmar_senha = filter_input(INPUT_POST, 'confirmar_senha', FILTER_SANITIZE_STRING);
            $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
            $data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_STRING);

            $erros = [];

            if (empty($nome)) {
                $erros[] = "O nome é obrigatório.";
            }
            if (empty($sobrenome)) {
                $erros[] = "O sobrenome é obrigatório.";
            }
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erros[] = "O e-mail é inválido ou obrigatório.";
            }
            if (empty($senha) || strlen($senha) < 6) {
                $erros[] = "A senha deve ter no mínimo 6 caracteres.";
            }
            if ($senha !== $confirmar_senha) {
                $erros[] = "As senhas não coincidem.";
            }

            if (empty($erros)) {
                $usuarioModel = $this->model('Usuario');

                if ($usuarioModel->buscarUsuarioPorEmail($email)) {
                    $erros[] = "Este e-mail já está cadastrado.";
                } else {
                    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                    $dados = [
                        'nome' => $nome,
                        'sobrenome' => $sobrenome,
                        'email' => $email,
                        'senha' => $senhaHash,
                        'telefone' => $telefone,
                        'data_nascimento' => $data_nascimento,
                        'tipo' => 'cliente'
                    ];

                    if ($usuarioModel->cadastrarUsuario($dados)) {
                        $_SESSION['mensagem_sucesso'] = "Cadastro realizado com sucesso! Faça login para continuar.";
                        header('Location: ' . BASE_URL . '/login');
                        exit();
                    } else {
                        $erros[] = "Erro ao cadastrar usuário. Tente novamente.";
                    }
                }
            }
            $this->view('cadastro', ['erros' => $erros, 'dados_antigos' => $_POST]);
        } else {
            $this->view('cadastro');
        }
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

            $erros = [];

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erros[] = "E-mail inválido.";
            }
            if (empty($senha)) {
                $erros[] = "Senha obrigatória.";
            }

            if (empty($erros)) {
                $usuarioModel = $this->model('Usuario');
                $usuario = $usuarioModel->buscarUsuarioPorEmail($email);

                if ($usuario && $usuarioModel->verificarSenha($senha, $usuario['senha'])) {
                    $_SESSION['user_id'] = $usuario['id'];
                    $_SESSION['user_name'] = $usuario['nome'] . ' ' . $usuario['sobrenome'];
                    $_SESSION['user_email'] = $usuario['email'];
                    $_SESSION['user_type'] = $usuario['tipo'];

                    $_SESSION['mensagem_sucesso'] = "Login realizado com sucesso!";
                    header('Location: ' . BASE_URL . '/home');
                    exit();
                } else {
                    $erros[] = "E-mail ou senha incorretos.";
                }
            }
            $this->view('login', ['erros' => $erros, 'dados_antigos' => $_POST]);
        } else {
            $this->view('login');
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: ' . BASE_URL . '/login');
        exit();
    }

    private function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    private function isAdmin()
    {
        return $this->isLoggedIn() && $_SESSION['user_type'] === 'admin';
    }

    public function perfil()
    {
        if (!$this->isLoggedIn()) {
            $_SESSION['mensagem_erro'] = "Você precisa estar logado para acessar esta página.";
            header('Location: ' . BASE_URL . '/login');
            exit();
        }
        $this->view('conta', ['usuario' => $_SESSION]);
    }

    public function adminDashboard()
    {
        if (!$this->isAdmin()) {
            $_SESSION['mensagem_erro'] = "Acesso negado. Você não tem permissão de administrador.";
            header('Location: ' . BASE_URL . '/home');
            exit();
        }
        $this->view('adminDashboard');
    }
}

<?php

class Auth
{
    public static function iniciarSessao()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function isLoggedIn()
    {
        self::iniciarSessao();
        return isset($_SESSION['user_id']);
    }

    public static function isAdmin()
    {
        self::iniciarSessao();
        return self::isLoggedIn() && $_SESSION['user_type'] === 'admin';
    }

    public static function requireLogin($redirectUrl = null)
    {
        if (!self::isLoggedIn()) {
            $_SESSION['mensagem_erro'] = "Você precisa estar logado para acessar esta página.";
            $redirect = $redirectUrl ?: BASE_URL . '/usuario/login';
            header('Location: ' . $redirect);
            exit();
        }
    }

    public static function requireAdmin($redirectUrl = null)
    {
        if (!self::isAdmin()) {
            $_SESSION['mensagem_erro'] = "Acesso negado. Você não tem permissão de administrador.";
            $redirect = $redirectUrl ?: BASE_URL . '/home';
            header('Location: ' . $redirect);
            exit();
        }
    }

    public static function getUser()
    {
        self::iniciarSessao();
        if (self::isLoggedIn()) {
            return [
                'id' => $_SESSION['user_id'],
                'name' => $_SESSION['user_name'],
                'email' => $_SESSION['user_email'],
                'type' => $_SESSION['user_type']
            ];
        }
        return null;
    }

    public static function logout()
    {
        self::iniciarSessao();
        session_unset();
        session_destroy();
    }
}


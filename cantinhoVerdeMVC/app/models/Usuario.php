<?php

class Usuario extends Model
{
    public function cadastrarUsuario($dados)
    {
        try {
            $query = "INSERT INTO usuarios (nome, sobrenome, email, senha, telefone, data_nascimento, tipo) VALUES (:nome, :sobrenome, :email, :senha, :telefone, :data_nascimento, :tipo)";
            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':nome', $dados['nome']);
            $stmt->bindValue(':sobrenome', $dados['sobrenome']);
            $stmt->bindValue(':email', $dados['email']);
            $stmt->bindValue(':senha', $dados['senha']);
            $stmt->bindValue(':telefone', $dados['telefone']);
            $stmt->bindValue(':data_nascimento', $dados['data_nascimento']);
            $stmt->bindValue(':tipo', $dados['tipo']);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("[ERRO] Falha ao cadastrar usuário: " . $e->getMessage());
            return false;
        }
    }

    public function buscarUsuarioPorEmail($email)
    {
        try {
            $query = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[ERRO] Falha ao buscar usuário por email: " . $e->getMessage());
            return false;
        }
    }

    public function verificarSenha($senhaDigitada, $senhaHash)
    {
        return password_verify($senhaDigitada, $senhaHash);
    }
}

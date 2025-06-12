-- Administrador 1
INSERT INTO usuarios (nome, sobrenome, email, senha, telefone, data_nascimento, tipo)
VALUES (
    'Carlos', 
    'Almeida', 
    'carlos.admin@empresa.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  -- senha: "password"
    '(11) 91234-5678', 
    '1985-03-15', 
    'admin'
);

-- Administrador 2
INSERT INTO usuarios (nome, sobrenome, email, senha, telefone, data_nascimento, tipo)
VALUES (
    'Fernanda', 
    'Oliveira', 
    'fernanda.admin@empresa.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  -- senha: "password"
    '(11) 98765-4321', 
    '1990-07-22', 
    'admin'
);

-- Administrador 3
INSERT INTO usuarios (nome, sobrenome, email, senha, telefone, data_nascimento, tipo)
VALUES (
    'Ricardo', 
    'Souza', 
    'ricardo.admin@empresa.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  -- senha: "password"
    '(11) 99876-5432', 
    '1982-11-30', 
    'admin'
);

-- Cliente
INSERT INTO usuarios (nome, sobrenome, email, senha, telefone, data_nascimento)
VALUES (
    'Cliente', 
    'Da Silva', 
    'cliente@email.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  -- senha: "password"
    '(11) 99999-9999', 
    '1982-11-30'
);




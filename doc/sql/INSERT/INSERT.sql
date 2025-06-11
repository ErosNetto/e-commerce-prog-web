-- Inserindo produtos
INSERT INTO produtos (
    nome, descricao, descricao_curta, imagem_principal, preco, estoque,
    nivel_cuidado, tamanho, ambiente, luz, agua,
    destaque, status
) VALUES
('Espada-de-São-Jorge', 'Planta resistente ideal para ambientes internos com pouca luz.', 'Resistente e purificadora de ar', 'https://cdn.awsli.com.br/600x1000/496/496853/produto/45946185/390a4b98c7.jpg', 39.90, 15, 'facil', 'medio', 'interior', 'baixa', 'pouca', TRUE, 'ativo'),
('Cacto Bola', 'Cacto decorativo que requer pouca água e muita luz solar.', 'Ideal para decoração e pouca manutenção', 'https://images.unsplash.com/photo-1744445764699-06db37e57c52?q=80&w=1373&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 19.90, 30, 'facil', 'pequeno', 'interior', 'alta', 'pouca', TRUE, 'ativo'),
('Samambaia', 'Planta ornamental para ambientes com boa umidade.', 'Verde vibrante e volumosa', 'https://images.unsplash.com/photo-1627213373335-26c0417ac50d?q=80&w=1287&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 25.00, 20, 'medio', 'medio', 'interior', 'media', 'media', FALSE, 'ativo'),
('Jiboia', 'Planta trepadeira de crescimento rápido e folhas decorativas.', 'Fácil de cuidar e linda em vasos suspensos', 'https://a-static.mlcdn.com.br/%7Bw%7Dx%7Bh%7D/planta-jiboia-njoy-epipremnum-aureum-njoy-verdadeira-inspira-flora/inspiraflora/420da048c1bd11ecb0d14201ac18506b/a51485aa9d72fa7589bc267e0e41d5cd.jpeg', 29.90, 12, 'facil', 'medio', 'ambos', 'media', 'media', TRUE, 'ativo'),
('Ficus Lyrata', 'Planta de folhas largas, excelente para salas amplas.', 'Elegante e imponente', 'https://images.unsplash.com/photo-1677428536327-d2aefcec578c?q=80&w=1335&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 129.90, 5, 'avancado', 'grande', 'interior', 'alta', 'media', FALSE, 'ativo'),
('Lírio da Paz', 'Planta que floresce mesmo em ambientes com pouca luz.', 'Flor branca e folhagem verde escura', 'https://plus.unsplash.com/premium_photo-1708769592969-9f42825496a7?q=80&w=1480&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 45.90, 10, 'facil', 'medio', 'interior', 'baixa', 'media', TRUE, 'ativo'),
('Suculenta Mix', 'Kit com 3 suculentas variadas, perfeitas para decorar.', 'Práticas e fofas', 'https://images.unsplash.com/photo-1658117828565-192dbd9f5fa0?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 29.90, 25, 'facil', 'pequeno', 'interior', 'alta', 'pouca', TRUE, 'ativo'),
('Palmeira Ráfis', 'Palmeira decorativa que se adapta bem a áreas internas com boa iluminação.', 'Beleza tropical dentro de casa', 'https://images.unsplash.com/photo-1731958714722-bb9e110e6094?q=80&w=1287&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 89.90, 8, 'medio', 'grande', 'interior', 'media', 'media', FALSE, 'ativo'),
('Costela-de-Adão', 'Planta tropical com folhas recortadas, perfeita para ambientes modernos.', 'Visual tropical impressionante', 'https://images.unsplash.com/photo-1598880940080-ff9a29891b85?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 99.90, 7, 'medio', 'grande', 'interior', 'media', 'media', FALSE, 'ativo'),
('Bromélia Guzmania', 'Planta vibrante com flores coloridas, ideal para interiores iluminados.', 'Toque exótico para seu lar', 'https://images.unsplash.com/photo-1598880940080-ff9a29891b85?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 59.90, 14, 'facil', 'medio', 'interior', 'alta', 'media', TRUE, 'ativo'),
('Zamioculca', 'Planta de baixa manutenção, ótima para locais com pouca luz.', 'Fácil e resistente', 'https://images.unsplash.com/photo-1627213373335-26c0417ac50d?q=80&w=1287&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 69.90, 18, 'facil', 'medio', 'interior', 'baixa', 'pouca', TRUE, 'ativo'),
('Orquídea Phalaenopsis', 'Orquídea elegante que floresce várias vezes ao ano.', 'Beleza sofisticada', 'https://a-static.mlcdn.com.br/%7Bw%7Dx%7Bh%7D/planta-jiboia-njoy-epipremnum-aureum-njoy-verdadeira-inspira-flora/inspiraflora/420da048c1bd11ecb0d14201ac18506b/a51485aa9d72fa7589bc267e0e41d5cd.jpeg', 79.90, 20, 'medio', 'medio', 'interior', 'media', 'media', TRUE, 'ativo'),
('Antúrio', 'Planta tropical com flores vermelhas intensas e folhagem brilhante.', 'Cores vibrantes para o ambiente', 'https://images.unsplash.com/photo-1677428536327-d2aefcec578c?q=80&w=1335&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 55.00, 11, 'medio', 'medio', 'interior', 'media', 'media', TRUE, 'ativo'),
('Dracena', 'Planta ornamental resistente, ideal para corredores e salas.', 'Elegância e praticidade', 'https://plus.unsplash.com/premium_photo-1708769592969-9f42825496a7?q=80&w=1480&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 49.90, 13, 'facil', 'grande', 'interior', 'baixa', 'pouca', FALSE, 'ativo'),
('Hera Inglesa', 'Planta trepadeira excelente para vasos suspensos e jardins verticais.', 'Versátil e elegante', 'https://images.unsplash.com/photo-1658117828565-192dbd9f5fa0?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 22.90, 22, 'facil', 'medio', 'ambos', 'media', 'media', TRUE, 'ativo'),
('Maranta', 'Planta de folhas coloridas que se movimentam conforme a luz.', 'Charme e movimento natural', 'https://images.unsplash.com/photo-1731958714722-bb9e110e6094?q=80&w=1287&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 35.00, 17, 'medio', 'medio', 'interior', 'baixa', 'media', FALSE, 'ativo'),
('Begônia', 'Planta com flores delicadas, ótima para ambientes internos.', 'Flores graciosas', 'https://images.unsplash.com/photo-1598880940080-ff9a29891b85?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 34.90, 15, 'medio', 'medio', 'interior', 'media', 'media', TRUE, 'ativo'),
('Peperômia', 'Planta compacta e robusta, excelente para iniciantes.', 'Pequena e charmosa', 'https://images.unsplash.com/photo-1598880940080-ff9a29891b85?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 27.90, 19, 'facil', 'pequeno', 'interior', 'baixa', 'media', FALSE, 'ativo'),
('Clorofito', 'Planta pendente muito resistente, ideal para purificação do ar.', 'Amiga da saúde', 'https://cdn.awsli.com.br/600x1000/496/496853/produto/45946185/390a4b98c7.jpg', 21.90, 23, 'facil', 'medio', 'interior', 'media', 'media', TRUE, 'ativo'),
('Filodendro', 'Planta com folhas verdes escuras, muito resistente.', 'Verde exuberante', 'https://images.unsplash.com/photo-1744445764699-06db37e57c52?q=80&w=1373&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 39.00, 10, 'medio', 'grande', 'interior', 'baixa', 'media', FALSE, 'ativo'),
('Calatéia', 'Planta de folhas decorativas e movimento noturno.', 'Design natural e elegante', 'https://images.unsplash.com/photo-1627213373335-26c0417ac50d?q=80&w=1287&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 59.90, 12, 'medio', 'medio', 'interior', 'baixa', 'media', TRUE, 'ativo'),
('Aglaonema', 'Planta tropical com folhagem variada e colorida.', 'Perfeita para interiores', 'https://a-static.mlcdn.com.br/%7Bw%7Dx%7Bh%7D/planta-jiboia-njoy-epipremnum-aureum-njoy-verdadeira-inspira-flora/inspiraflora/420da048c1bd11ecb0d14201ac18506b/a51485aa9d72fa7589bc267e0e41d5cd.jpeg', 39.90, 16, 'facil', 'medio', 'interior', 'baixa', 'media', TRUE, 'ativo'),
('Areca-bambu', 'Palmeira elegante que traz leveza e frescor.', 'Visual tropical', 'https://images.unsplash.com/photo-1677428536327-d2aefcec578c?q=80&w=1335&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 119.90, 6, 'medio', 'grande', 'interior', 'alta', 'media', FALSE, 'ativo'),
('Pilea', 'Planta compacta e exótica, ótima para escritórios.', 'Bolotinha verde', 'https://plus.unsplash.com/premium_photo-1708769592969-9f42825496a7?q=80&w=1480&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 32.90, 21, 'facil', 'pequeno', 'interior', 'baixa', 'media', TRUE, 'ativo'),
('Violeta Africana', 'Planta com flores delicadas em tons de roxo e branco, ideal para interiores.', 'Flores charmosas e compactas', 'https://images.unsplash.com/photo-1611080626919-7cf5a9b7c865?q=80&w=1350&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 24.90, 18, 'medio', 'pequeno', 'interior', 'media', 'media', TRUE, 'ativo'),
('Kalanchoe', 'Suculenta com flores vibrantes, perfeita para iniciantes.', 'Flores coloridas e fácil cuidado', 'https://images.unsplash.com/photo-1599499385069-5c0e7a8e4a5f?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 22.50, 25, 'facil', 'pequeno', 'interior', 'alta', 'pouca', TRUE, 'ativo'),
('Lavanda', 'Planta aromática ideal para jardins ensolarados.', 'Perfume relaxante e visual delicado', 'https://images.unsplash.com/photo-1599499385069-5c0e7a8e4a5f?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 34.90, 15, 'medio', 'medio', 'exterior', 'alta', 'media', FALSE, 'ativo'),
('Vaso Cerâmico Pequeno', 'Vaso decorativo em cerâmica, ideal para suculentas e pequenas plantas.', 'Estilo e praticidade', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=1350&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 15.90, 50, 'facil', 'pequeno', 'ambos', 'nenhuma', 'nenhuma', TRUE, 'ativo'),
('Hibisco', 'Planta com flores grandes e coloridas, perfeita para jardins tropicais.', 'Flores exóticas e vibrantes', 'https://images.unsplash.com/photo-1599499385069-5c0e7a8e4a5f?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 49.90, 10, 'medio', 'grande', 'exterior', 'alta', 'media', FALSE, 'ativo'),
('Suporte para Plantas', 'Suporte de madeira para vasos, ideal para organização e decoração.', 'Estrutura elegante e funcional', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=1350&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 39.90, 20, 'facil', 'medio', 'ambos', 'nenhuma', 'nenhuma', TRUE, 'ativo'),
('Rosa do Deserto', 'Planta exótica com flores marcantes e caule escultural.', 'Beleza única para jardins', 'https://images.unsplash.com/photo-1599499385069-5c0e7a8e4a5f?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 69.90, 12, 'avancado', 'medio', 'exterior', 'alta', 'pouca', TRUE, 'ativo'),
('Mini Cacto', 'Cacto pequeno ideal para decoração de mesas e escritórios.', 'Compacto e charmoso', 'https://images.unsplash.com/photo-1744445764699-06db37e57c52?q=80&w=1373&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 12.90, 40, 'facil', 'pequeno', 'interior', 'alta', 'pouca', TRUE, 'ativo');

-- Associando produtos às categorias
INSERT INTO produto_categoria (produto_id, categoria_id) VALUES
(1, 1),  -- Espada-de-São-Jorge -> Plantas de Interior
(2, 2),  -- Cacto Bola -> Suculentas
(3, 1),  -- Samambaia -> Plantas de Interior
(4, 1),  -- Jiboia -> Plantas de Interior
(5, 1),  -- Ficus Lyrata -> Plantas de Interior
(6, 1),  -- Lírio da Paz -> Plantas de Interior
(7, 2),  -- Suculenta Mix -> Suculentas
(8, 1),  -- Palmeira Ráfis -> Plantas de Interior
(9, 1),  -- Costela-de-Adão -> Plantas de Interior
(10, 1), -- Bromélia Guzmania -> Plantas de Interior
(11, 1), -- Zamioculca -> Plantas de Interior
(12, 1), -- Orquídea Phalaenopsis -> Plantas de Interior
(13, 1), -- Antúrio -> Plantas de Interior
(14, 1), -- Dracena -> Plantas de Interior
(15, 1), -- Hera Inglesa -> Plantas de Interior
(16, 1), -- Maranta -> Plantas de Interior
(17, 1), -- Begônia -> Plantas de Interior
(18, 1), -- Peperômia -> Plantas de Interior
(19, 1), -- Clorofito -> Plantas de Interior
(20, 1), -- Filodendro -> Plantas de Interior
(21, 1), -- Calatéia -> Plantas de Interior
(22, 1), -- Aglaonema -> Plantas de Interior
(23, 1), -- Areca-bambu -> Plantas de Interior
(24, 1), -- Pilea -> Plantas de Interior
(25, 1), -- Violeta Africana -> Plantas de Interior
(26, 2), -- Kalanchoe -> Suculentas
(27, 3), -- Lavanda -> Plantas para Jardim
(28, 4), -- Vaso Cerâmico Pequeno -> Vasos e Acessórios
(29, 3), -- Hibisco -> Plantas para Jardim
(30, 4), -- Suporte para Plantas -> Vasos e Acessórios
(31, 3), -- Rosa do Deserto -> Plantas para Jardim
(32, 2); -- Mini Cacto -> Suculentas
-- Inserindo produtos
INSERT INTO produtos (
    nome, descricao, descricao_curta, preco, preco_promocional, sku, estoque,
    peso, dimensoes, nivel_cuidado, tamanho, ambiente, luz, agua,
    slug, destaque, novo, status
) VALUES
('Espada-de-São-Jorge', 'Planta resistente ideal para ambientes internos com pouca luz.', 'Resistente e purificadora de ar', 39.90, NULL, 'ESJ001', 15, 0.5, '60x10x10cm', 'facil', 'medio', 'interior', 'baixa', 'pouca', 'espada-de-sao-jorge', TRUE, TRUE, 'ativo'),
('Cacto Bola', 'Cacto decorativo que requer pouca água e muita luz solar.', 'Ideal para decoração e pouca manutenção', 19.90, 14.90, 'CACT002', 30, 0.3, '15x10x10cm', 'facil', 'pequeno', 'interior', 'alta', 'pouca', 'cacto-bola', FALSE, TRUE, 'ativo'),
('Samambaia', 'Planta ornamental para ambientes com boa umidade.', 'Verde vibrante e volumosa', 25.00, NULL, 'SAM003', 20, 0.6, '50x30x30cm', 'medio', 'medio', 'interior', 'media', 'media', 'samambaia', TRUE, FALSE, 'ativo'),
('Jiboia', 'Planta trepadeira de crescimento rápido e folhas decorativas.', 'Fácil de cuidar e linda em vasos suspensos', 29.90, 24.90, 'JIB004', 12, 0.4, '70x20x20cm', 'facil', 'medio', 'ambos', 'media', 'media', 'jiboia', TRUE, TRUE, 'ativo'),
('Ficus Lyrata', 'Planta de folhas largas, excelente para salas amplas.', 'Elegante e imponente', 129.90, NULL, 'FIC005', 5, 3.0, '150x50x50cm', 'avancado', 'grande', 'interior', 'alta', 'media', 'ficus-lyrata', TRUE, FALSE, 'ativo'),
('Lírio da Paz', 'Planta que floresce mesmo em ambientes com pouca luz.', 'Flor branca e folhagem verde escura', 45.90, 39.90, 'LIR006', 10, 0.8, '40x20x20cm', 'facil', 'medio', 'interior', 'baixa', 'media', 'lirio-da-paz', FALSE, TRUE, 'ativo'),
('Suculenta Mix', 'Kit com 3 suculentas variadas, perfeitas para decorar.', 'Práticas e fofas', 29.90, 25.00, 'SUC007', 25, 0.2, '10x10x10cm', 'facil', 'pequeno', 'interior', 'alta', 'pouca', 'suculenta-mix', FALSE, TRUE, 'ativo'),
('Palmeira Ráfis', 'Palmeira decorativa que se adapta bem a áreas internas com boa iluminação.', 'Beleza tropical dentro de casa', 89.90, NULL, 'PAL008', 8, 2.5, '120x40x40cm', 'medio', 'grande', 'interior', 'media', 'media', 'palmeira-rafis', TRUE, FALSE, 'ativo'),
('Costela-de-Adão', 'Planta tropical com folhas recortadas, perfeita para ambientes modernos.', 'Visual tropical impressionante', 99.90, NULL, 'COS009', 7, 2.2, '100x60x60cm', 'medio', 'grande', 'interior', 'media', 'media', 'costela-de-adao', TRUE, FALSE, 'ativo'),
('Bromélia Guzmania', 'Planta vibrante com flores coloridas, ideal para interiores iluminados.', 'Toque exótico para seu lar', 59.90, 49.90, 'BRO010', 14, 0.7, '30x20x20cm', 'facil', 'medio', 'interior', 'alta', 'media', 'bromelia-guzmania', FALSE, TRUE, 'ativo'),
('Zamioculca', 'Planta de baixa manutenção, ótima para locais com pouca luz.', 'Fácil e resistente', 69.90, NULL, 'ZAM011', 18, 1.0, '60x25x25cm', 'facil', 'medio', 'interior', 'baixa', 'pouca', 'zamioculca', TRUE, TRUE, 'ativo'),
('Orquídea Phalaenopsis', 'Orquídea elegante que floresce várias vezes ao ano.', 'Beleza sofisticada', 79.90, 69.90, 'ORQ012', 20, 0.5, '50x15x15cm', 'medio', 'medio', 'interior', 'media', 'media', 'orquidea-phalaenopsis', TRUE, TRUE, 'ativo'),
('Antúrio', 'Planta tropical com flores vermelhas intensas e folhagem brilhante.', 'Cores vibrantes para o ambiente', 55.00, NULL, 'ANT013', 11, 0.9, '45x25x25cm', 'medio', 'medio', 'interior', 'media', 'media', 'anturio', FALSE, TRUE, 'ativo'),
('Dracena', 'Planta ornamental resistente, ideal para corredores e salas.', 'Elegância e praticidade', 49.90, NULL, 'DRA014', 13, 1.2, '90x30x30cm', 'facil', 'grande', 'interior', 'baixa', 'pouca', 'dracena', TRUE, FALSE, 'ativo'),
('Hera Inglesa', 'Planta trepadeira excelente para vasos suspensos e jardins verticais.', 'Versátil e elegante', 22.90, 18.90, 'HER015', 22, 0.4, '40x20x20cm', 'facil', 'medio', 'ambos', 'media', 'media', 'hera-inglesa', FALSE, TRUE, 'ativo'),
('Maranta', 'Planta de folhas coloridas que se movimentam conforme a luz.', 'Charme e movimento natural', 35.00, NULL, 'MAR016', 17, 0.5, '30x20x20cm', 'medio', 'medio', 'interior', 'baixa', 'media', 'maranta', TRUE, FALSE, 'ativo'),
('Begônia', 'Planta com flores delicadas, ótima para ambientes internos.', 'Flores graciosas', 34.90, NULL, 'BEG017', 15, 0.5, '35x25x25cm', 'medio', 'medio', 'interior', 'media', 'media', 'begonia', FALSE, TRUE, 'ativo'),
('Peperômia', 'Planta compacta e robusta, excelente para iniciantes.', 'Pequena e charmosa', 27.90, 22.90, 'PEP018', 19, 0.3, '25x15x15cm', 'facil', 'pequeno', 'interior', 'baixa', 'media', 'peperomia', TRUE, FALSE, 'ativo'),
('Clorofito', 'Planta pendente muito resistente, ideal para purificação do ar.', 'Amiga da saúde', 21.90, NULL, 'CLO019', 23, 0.4, '50x30x30cm', 'facil', 'medio', 'interior', 'media', 'media', 'clorofito', TRUE, TRUE, 'ativo'),
('Filodendro', 'Planta com folhas verdes escuras, muito resistente.', 'Verde exuberante', 49.00, NULL, 'FIL020', 10, 1.1, '70x40x40cm', 'medio', 'grande', 'interior', 'baixa', 'media', 'filodendro', TRUE, FALSE, 'ativo'),
('Calatéia', 'Planta de folhas decorativas e movimento noturno.', 'Design natural e elegante', 59.90, NULL, 'CAL021', 12, 0.7, '45x30x30cm', 'medio', 'medio', 'interior', 'baixa', 'media', 'calateia', TRUE, TRUE, 'ativo'),
('Aglaonema', 'Planta tropical com folhagem variada e colorida.', 'Perfeita para interiores', 39.90, NULL, 'AGL022', 16, 0.8, '40x30x30cm', 'facil', 'medio', 'interior', 'baixa', 'media', 'aglaonema', FALSE, TRUE, 'ativo'),
('Areca-bambu', 'Palmeira elegante que traz leveza e frescor.', 'Visual tropical', 119.90, 99.90, 'ARE023', 6, 3.5, '160x60x60cm', 'medio', 'grande', 'interior', 'alta', 'media', 'areca-bambu', TRUE, FALSE, 'ativo'),
('Pilea', 'Planta compacta e exótica, ótima para escritórios.', 'Bolotinha verde', 32.90, NULL, 'PIL024', 21, 0.2, '20x15x15cm', 'facil', 'pequeno', 'interior', 'baixa', 'media', 'pilea', FALSE, TRUE, 'ativo');

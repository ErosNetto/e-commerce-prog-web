-- 1. Categoria principal: Plantas de Interior 
INSERT INTO categorias (nome, imagem, destaque)
VALUES (
  'Plantas de Interior',
  'https://images.unsplash.com/photo-1583753075968-1236ccb83c66?q=80&w=1354&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
  TRUE
);

-- 2. Subcategoria: Suculentas
INSERT INTO categorias (nome, imagem, categoria_pai_id, destaque)
VALUES (
  'Suculentas',
  'https://images.unsplash.com/photo-1475541148680-00e4fb86ee25?q=80&w=1349&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
  1,
  TRUE
);

-- 3. Categoria principal: Plantas para Jardim 
INSERT INTO categorias (nome, imagem, destaque)
VALUES (
  'Plantas para Jardim',
  'https://images.unsplash.com/photo-1690253780091-e3f26d09202a?q=80&w=1394&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
  TRUE
);

-- 4. Categoria principal: Vasos e Acessórios 
INSERT INTO categorias (nome, imagem, destaque)
VALUES (
  'Vasos e Acessórios',
  'https://plus.unsplash.com/premium_photo-1678836292812-8053f9f34be7?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8dmFzb3MlMjBlJTIwYWNlc3NvcmlvcyUyMGRlJTIwamFyZGluYWdlbXN8ZW58MHx8MHx8fDA%3D',
  TRUE
);

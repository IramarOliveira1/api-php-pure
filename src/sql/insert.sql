INSERT INTO endereco
    (cep, logradouro, bairro, uf, cidade, complemento, numero)     
VALUES 
    ("41219-600", "avenida cardeal avelar brandão villela", "Mata escura", "BA", "SALVADOR", "CASA", 10);

INSERT INTO endereco
    (cep, logradouro, bairro, uf, cidade, complemento, numero)     
VALUES 
    ("41210-180", "Rua bahia", "Tancredo neves", "BA", "SALVADOR", "CASA", 30);

INSERT INTO usuario
    (nome, cpf, email, senha, perfil, id_endereco)     
VALUES 
    ("VAREJÃO IRAMAR", "000.000.000-00", "varejao@adm.com", "123456", "ADM", 1);

INSERT INTO usuario
    (nome, cpf, email, senha, perfil, id_endereco)     
VALUES 
    ("Lucas Santos", "000.000.000-11", "lucas@gmail.com", "123456", "USUARIO", 2);

INSERT INTO categoria
    (nome)     
VALUES 
    ("Eletronico");

INSERT INTO categoria
    (nome)     
VALUES 
    ("Tecnologia");

INSERT INTO caracteristica
    (modelo, fabricante, cor, codigo)     
VALUES 
    ("GALAXY S23 ULTRA 1TB", "SAMSUNG", "VERMELHO", 0388483092);

INSERT INTO produto
    (nome, descricao, url_imagem, preco, id_caracteristica)     
VALUES 
    ("SAMSUNG GALAXY S23 ULTRA 1TB", "Novo processador com cores novas e uma bela câmera", "url_imagem", 7000, 1);

INSERT INTO pedido
    (codigo, id_produto, id_usuario)     
VALUES 
    (1689364333, 1, 2);

INSERT INTO pivot_produto_categoria
    (id_produto, id_categoria)     
VALUES 
    (1, 1);
    
INSERT INTO pivot_produto_categoria
    (id_produto, id_categoria)     
VALUES 
   (1, 2);

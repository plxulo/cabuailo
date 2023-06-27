CREATE DATABASE cabuailo;
USE cabuailo;

/* TODO: Armazenar senhas com hash */
CREATE TABLE usuarios_admin (
    id_adm INT(6) PRIMARY KEY AUTO_INCREMENT,
    adm_nome VARCHAR(255) NOT NULL,
    adm_email VARCHAR(255) NOT NULL,
    adm_senha VARCHAR(255) NOT NULL
);

/* Membro comum */
CREATE TABLE usuarios (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

/* Armazenar filial relacionada à adm */
CREATE TABLE filiais (
    id_filial INT(6) PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    cep INT(6) NOT NULL,
    descricao VARCHAR(300),
    servicos VARCHAR(255),
    filial_adm INT(6),
    imagem MEDIUMBLOB,
    FOREIGN KEY (filial_adm) REFERENCES usuarios_admin(id_adm)
);

CREATE TABLE funcionarios (
    id_func INT(6) PRIMARY KEY AUTO_INCREMENT,
    nome_func VARCHAR(255) NOT NULL,
    senha_func VARCHAR(255) NOT NULL,
    nivel_acesso VARCHAR(255) NOT NULL,
    adm_superior INT(6),
    filial INT(6),
    foto_funcionario MEDIUMBLOB,
    FOREIGN KEY (filial) REFERENCES filiais(id_filial),
    FOREIGN KEY (adm_superior) REFERENCES usuarios_admin(id_adm)
);

CREATE TABLE produtos (
    id_produto INT(6) PRIMARY KEY AUTO_INCREMENT,
    nome_produto VARCHAR(255) NOT NULL,
    preco_produto FLOAT(10,2) NOT NULL,
    preco_promocao FLOAT(10,2),
    descricao_produto VARCHAR(255) NOT NULL,
    quantidade_produto INT(6) NOT NULL,
    imagem_produto MEDIUMBLOB,
    id_adm INT(6),
    FOREIGN KEY (id_adm) REFERENCES usuarios_admin(id_adm)
);

/* Armazenar imagens do sistema */
CREATE TABLE imagem_emp (
    id_img INT(6) PRIMARY KEY AUTO_INCREMENT,
    imagem MEDIUMBLOB,
    emp_adm INT(6),
    FOREIGN KEY (emp_adm) REFERENCES usuarios_admin(id_adm)
);

/* Foto de perfil administrador */
CREATE TABLE imagem_pfp_adm (
    id_img_pfp INT(6) PRIMARY KEY AUTO_INCREMENT,
    imagem MEDIUMBLOB,
    pfp_adm INT(6),
    FOREIGN KEY (pfp_adm) REFERENCES usuarios_admin(id_adm)
);

/* Foto de perfil usuário */
CREATE TABLE imagem_pfp_user (
    id_img_user INT(6) PRIMARY KEY AUTO_INCREMENT,
    imagem MEDIUMBLOB,
    pfp_user INT(6),
    FOREIGN KEY (pfp_user) REFERENCES usuarios(id)
);

CREATE TABLE app_comentarios (
    id INT PRIMARY KEY,
    comentario VARCHAR(500),
    id_usuario INT,
    id_filial INT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_filial) REFERENCES filiais(id_filial)
);

CREATE TABLE servicos (
    id INT PRIMARY KEY,
    filial INT,
    servicos VARCHAR(90),
    FOREIGN KEY (filial) REFERENCES filiais(id_filial)
);

CREATE TABLE app_agendamentos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    id_funcionario INT,
    id_filial INT,
    servico_escolhido VARCHAR(45),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_funcionario) REFERENCES funcionarios(id_func),
    FOREIGN KEY (id_filial) REFERENCES filiais(id_filial),
    FOREIGN KEY (servico_escolhido) REFERENCES servicos(id)
);
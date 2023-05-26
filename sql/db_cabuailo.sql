CREATE DATABASE cabuailo;
USE cabuailo;

/* Membro comum */
CREATE TABLE usuarios (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

/* TODO: Armazenar senhas com hash */
CREATE TABLE usuarios_admin (
    id_adm INT(6) PRIMARY KEY AUTO_INCREMENT,
    adm_nome VARCHAR(255) NOT NULL,
    adm_email VARCHAR(255) NOT NULL,
    adm_senha VARCHAR(255) NOT NULL
);

/* Armazenar imagens do sistema */
CREATE TABLE imagem_emp (
    id_img INT(6) PRIMARY KEY AUTO_INCREMENT,
    imagem MEDIUMBLOB,
    FOREIGN KEY (emp_adm) REFERENCES usuarios_admin(id_adm)
);

/* Foto de perfil administrador */
CREATE TABLE imagem_pfp_adm (
    id_img_pfp INT(6) PRIMARY KEY AUTO_INCREMENT,
    imagem MEDIUMBLOB,
    FOREIGN KEY (pfp_adm) REFERENCES usuarios_admin(id_adm)
);

/* Foto de perfil usuário */
CREATE TABLE imagem_pfp_user (
    id_img_user INT(6) PRIMARY KEY AUTO_INCREMENT,
    imagem MEDIUMBLOB,
    FOREIGN KEY (pfp_user) REFERENCES usuarios(id)
);

/* Armazenar filial relacionada à adm */
CREATE TABLE filiais (
    id_filial INT(6) PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    cep INT(6) NOT NULL,
    FOREIGN KEY (filial_adm) REFERENCES usuarios_admin(id_adm)
);
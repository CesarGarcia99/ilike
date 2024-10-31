CREATE DATABASE IF NOT EXISTS ilike;

USE ilike;

CREATE TABLE IF NOT EXISTS users(
    id                  int(255) auto_increment not null,
    role                varchar(20),
    name                varchar(100),
    surname             varchar(200),
    nick                varchar(100),
    email               varchar(255),
    password            varchar(255),
    image               varchar(255),
    created_at          datetime,
    updated_at          datetime,
    remember_token      varchar(255),
CONSTRAINT pk_user PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS images(
    id                  int(255) auto_increment not null,
    user_id             int(255),
    image_path          varchar(255),
    description         text,
    created_at          datetime,
    updated_at          datetime,
    remember_token      varchar(255),
CONSTRAINT pk_image PRIMARY KEY(id),
CONSTRAINT fk_image_user FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;
    
CREATE TABLE IF NOT EXISTS comments(
    id                  int(255) auto_increment not null,
    user_id             int(255),
    image_id            int(255),
    content             text,
    created_at          datetime,
    updated_at          datetime,
CONSTRAINT pk_comment PRIMARY KEY(id),
CONSTRAINT fk_comment_user FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_comment_image FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS likes(
    id                  int(255) auto_increment not null,
    user_id             int(255),
    image_id            int(255),
    created_at          datetime,
    updated_at          datetime,
CONSTRAINT pk_like PRIMARY KEY(id),
CONSTRAINT fk_like_user FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_like_image FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;


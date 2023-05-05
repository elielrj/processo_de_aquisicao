
drop database processo_de_aquisicao;

create database if not exists processo_de_aquisicao;

use processo_de_aquisicao;

#1
create table if not exists ug(
id int primary key auto_increment not null,
numero varchar(6) not null,
nome varchar(250) not null,
sigla varchar(150)  not null,
status boolean not null
);

#2
create table if not exists departamento(
id int primary key auto_increment not null,
nome varchar(250) not null,
sigla varchar(150) not null,
ug_id int not null,
status boolean not null,
foreign key (ug_id) references ug(id)
);

#3
create table if not exists usuario(
id int primary key auto_increment not null,
nome varchar(250) not null,
sobrenome varchar(250) not null,
email varchar(250) not null,
cpf varchar(11) not null,
senha varchar(150) not null,
departamento_id int not null,
status boolean not null,
foreign key (departamento_id) references departamento(id)
);

#4
create table if not exists modalidade(
id int primary key auto_increment not null,
nome varchar(150) not null,
status boolean not null
);

#5
create table if not exists lei(
id int primary key auto_increment not null,
numero varchar(150) not null,
artigo varchar(10),
inciso varchar(10),
data date not null,
modalidade_id int not null,
status boolean not null,
foreign key (modalidade_id) references modalidade(id)
);

#6
create table if not exists tipo(
id int primary key auto_increment not null,
nome varchar(250) not null,
status boolean not null
);

#7
create table if not exists processo(
id int primary key auto_increment not null,
objeto varchar(250) not null,
numero varchar(30) not null,
data datetime not null default current_timestamp,
chave varchar(250) not null,
departamento_id int not null,
lei_id int not null,
tipo_id int not null,
completo boolean not null,
status boolean not null,
foreign key (departamento_id) references departamento(id),
foreign key (lei_id) references lei(id),
foreign key (tipo_id) references tipo(id)
);

#8
create table if not exists artefato(
id int primary key auto_increment not null,
ordem int not null,
nome varchar(250) not null,
status boolean not null
);

#9
create table if not exists lei_tipo_artefato(
lei_id int not null,
tipo_id int not null,
artefato_id int not null,
status boolean not null,
foreign key (lei_id) references lei(id),
foreign key (tipo_id) references tipo(id),
foreign key (artefato_id) references artefato(id)
);

#10
create table if not exists arquivo(
id int primary key auto_increment not null,
path varchar(250) not null,
data datetime not null default current_timestamp,
usuario_id int not null,
processo_id int not null,
artefato_id int not null,
status boolean not null,
foreign key (usuario_id) references usuario(id),
foreign key (processo_id) references processo(id),
foreign key (artefato_id) references artefato(id)
);





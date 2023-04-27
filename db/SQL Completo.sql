drop database processo_de_aquisicao;
create database if not exists processo_de_aquisicao;

use processo_de_aquisicao;

create table if not exists departamento(
id int primary key auto_increment not null,
nome varchar(250) not null,
sigla varchar(150) not null,
status boolean not null
);

create table if not exists usuario(
id int primary key auto_increment not null,
email varchar(150) not null,
cpf varchar(11) not null,
senha varchar(32) not null,
departamento_id int not null,
status boolean not null,
foreign key (departamento_id) references departamento(id)
);

create table if not exists tipo_de_licitacao(
id int primary key auto_increment not null,
nome varchar(150) not null,
lei varchar(150) not null,
artigo varchar(10),
inciso varchar(10),
data_da_lei date not null,
status boolean not null
);

create table if not exists processo(
id int primary key auto_increment not null,
objeto varchar(30) not null,
nup_nud varchar(30) not null,
data_do_processo date not null,
chave_de_acesso varchar(32) not null,
departamento_id int not null,
tipo_de_licitacao_id int not null,
status boolean not null,
foreign key (departamento_id) references departamento(id),
foreign key (tipo_de_licitacao_id) references tipo_de_licitacao(id)
);

create table if not exists arquivo(
id int primary key auto_increment not null,
nome_do_documento varchar(250) not null,
path varchar(250) not null,
nome_do_arquivo varchar(250) not null,
data_do_upload datetime not null default current_timestamp,
processo_id int not null,
status boolean not null,
foreign key (processo_id) references processo(id)
);

INSERT INTO `departamento`(`id`,`nome`,`sigla`,`status`) VALUES (1,'Almoxerifado','Almox',true);

INSERT INTO `usuario`(`id`, `email`, `cpf`, `senha`, `departamento_id`,`status`) 
VALUES (1,'elielrj@gmail.com','09856260701',md5(952420),1,true);

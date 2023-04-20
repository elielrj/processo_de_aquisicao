drop database processo_de_aquisicao;
create database if not exists processo_de_aquisicao;

use processo_de_aquisicao;

create table if not exists usuario(
id int primary key auto_increment not null,
email varchar(150) not null,
cpf varchar(11) not null,
senha varchar(32) not null,
status boolean not null
);

create table if not exists processo(
id int primary key auto_increment not null,
objeto varchar(30) not null,
nup_nud int not null,
data_do_processo int not null,
chave_de_acesso int not null,
usuario_id int not null,
status boolean not null,
foreign key (usuario_id) references usuario(id)
);

create table if not exists arquivo(
id int primary key auto_increment not null,
nome varchar(250) not null,
path varchar(250) not null,
nome_do_arquivo varchar(250) not null,
data_do_upload datetime not null default current_timestamp,
processo_id int not null,
usuario_id int not null,
status boolean not null,
foreign key (processo_id) references processo(id),
foreign key (usuario_id) references usuario(id)
);

INSERT INTO `usuario`(`id`, `email`, `cpf`, `senha`, `status`) VALUES (1,'elielrj@gmail.com','09856260701',md5(952420),true);
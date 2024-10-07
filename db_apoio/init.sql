
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
create table if not exists hierarquia(
id int primary key auto_increment not null,
posto_ou_graduacao varchar(250) not null,
sigla varchar(10) not null,
status boolean not null
);

#4
create table if not exists funcao(
id int primary key auto_increment not null,
nome varchar(250) not null,
nivel_de_acesso enum("leitor","escritor","aprovador_fisc_adm","aprovador_od","executor","conformador","administrador","root") not null,
status boolean not null
);

#5
create table if not exists usuario(
id int primary key auto_increment not null,
nome_de_guerra varchar(250) not null,
nome_completo varchar(250) not null,
email varchar(250) not null,
cpf varchar(11) not null,
senha varchar(150) not null,
departamento_id int not null,
status boolean not null,
hierarquia_id int not null,
funcao_id int not null,
foreign key (departamento_id) references departamento(id),
foreign key (hierarquia_id) references hierarquia(id),
foreign key (funcao_id) references funcao(id)
);

#6
create table if not exists modalidade(
id int primary key auto_increment not null,
nome varchar(150) not null,
status boolean not null
);

#7
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

#8
create table if not exists tipo(
id int primary key auto_increment not null,
nome varchar(250) not null,
status boolean not null
);

#9
create table if not exists processo(
id int primary key auto_increment not null,
objeto varchar(250) not null,
numero varchar(30) not null unique,
data_hora datetime not null default current_timestamp,
chave varchar(250) not null unique,
departamento_id int not null,
lei_id int not null,
tipo_id int not null,
completo boolean not null,
status boolean not null,
foreign key (departamento_id) references departamento(id),
foreign key (lei_id) references lei(id),
foreign key (tipo_id) references tipo(id)
);

#10
create table if not exists andamento(
id int primary key auto_increment not null,
status_do_andamento enum('criado','enviado','aprovado_fisc_adm','aprovado_od','executado','conformado','arquivado') not null,
data_hora datetime not null default current_timestamp,
processo_id int not null,
usuario_id int not null,
status boolean not null,
foreign key (processo_id) references processo(id),
foreign key (usuario_id) references usuario(id)
);

#11
create table if not exists artefato(
id int primary key auto_increment not null,
ordem int not null,
nome varchar(250) not null,
status boolean not null
);

#12
create table if not exists lei_tipo_artefato(
id int primary key auto_increment not null,
lei_id int not null,
tipo_id int not null,
artefato_id int not null,
status boolean not null,
foreign key (lei_id) references lei(id),
foreign key (tipo_id) references tipo(id),
foreign key (artefato_id) references artefato(id)
);

#13
create table if not exists arquivo(
id int primary key auto_increment not null,
path varchar(250) not null,
data_hora datetime not null default current_timestamp,
usuario_id int not null,
processo_id int not null,
artefato_id int not null,
nome varchar(250),
status boolean not null,
foreign key (usuario_id) references usuario(id),
foreign key (processo_id) references processo(id),
foreign key (artefato_id) references artefato(id)
);

#14
create table if not exists sugestao(
    id int primary key auto_increment not null,
    mensagem varchar(250) not null,
    visualizado boolean not null,
    usuario_id int not null,
    status boolean not null,
    foreign key (usuario_id) references usuario(id)
);



use processo_de_aquisicao;

INSERT INTO 
`ug`(`id`,`numero`,`nome`,`sigla`,`status`) 
VALUE
(1,'160517','14ª Companhia de Engenharia de Combate','14ª Cia E Cmb',true);
use processo_de_aquisicao;

INSERT INTO 
`departamento`(`id`,`nome`,`sigla`,`ug_id`,`status`) 
VALUES 
(default,'Setor de Almoxarifado','Almox',1,true),
(default,'Seção de Aquisições, Licitações e Contratos','SALC',1,true),
(default,'Conformidades Documental','Conf Doc',1,true),
(default,'Tesouraria','Tes',1,true),
(default,'Seção de Manutenção e Transporte','Sç Mnt Transp',1,true),
(default,'Setor de Aprovisionamento','Aprov',1,true),
(default,'Seção de Saúde','Sç Sau',1,true);use processo_de_aquisicao;

INSERT INTO hierarquia(`id`,`posto_ou_graduacao`, `sigla`, `status`) values
("1","Marechal","Mar",true),
("2","Major","Maj",true),
("3","General-de-Exército","Gen Ex ",true),
("4","Capitão","Cap",true),
("5","General-de-Divisão","Gen Div ",true),
("6","1° Tenente","1° Ten",true),
("7","General-de-Brigada","Gen Bda",true),
("8","2° Tenente","2° Ten",true),
("9","Coronel","Cel ",true),
("10","Aspirante-a-Oficial","Asp",true),
("11","Tenente-Coronel","Ten Cel",true),
("12","Cadete","Cad",true),
("13","Subtenente","S Ten",true),
("14","Primeiro-Sargento","1° Sgt",true),
("15","Segundo-Sargento","2° Sgt",true),
("16","Terceiro-Sargento","3° Sgt",true),
("17","Cabo","Cb",true),
("18","Soldado","Sd",true),
("19","Taifeiro-mor","TM",true),
("20","Taifeiro-de-primeira-classe","T1",true),
("21","Taifeiro-de-segunda-classe","T2",true);
use processo_de_aquisicao;

INSERT INTO funcao(`id`, `nome`, `nivel_de_acesso`, `status`) values

("1","Leitor","leitor",true),
("2","Demandante","escritor",true),
("3","Aprovador Fisc Adm","aprovador_fisc_adm",true),
("4","Aprovador OD","aprovador_od",true),
("5","Executor","executor",true),
("6","Conformador","conformador",true),
("7","Administrador","administrador",true),
("8","Root","root",true);

use processo_de_aquisicao;

INSERT INTO 
`usuario`(`id`,`nome_de_guerra`,`nome_completo`,`email`, `cpf`, `senha`, `departamento_id`,`status`,`hierarquia_id`,`funcao_id`) 
VALUES 
(1,'Leitor','Leitor de Processos','leitor@leitor','09856260701',md5(123),1,true,1,1),
(2,'Demandante','Escritor de Processos','escritor@escritor','09856260701',md5(123), 2,true,1,2),
(3,'Aprovador Fisc Adm','Aprovador de Processos','aprovadorfiscadm@aprovadorfiscadm','09856260701',md5(123), 3,true,1,3),
(4,'Aprovador OD','Aprovador de Processos','aprovadorod@aprovadorod','09856260701',md5(123), 3,true,1,4),
(5,'SALC','Executor de Processos','executor@executor','09856260701',md5(123), 3,true,1,5),
(6,'Conformador','Conformador de Processos','conformador@conformador','09856260701',md5(123), 3,true,1,6),
(7,'Administrador','Administrador do Sistema','administrador@administrador','09856260701',md5(123), 4,true,1,7),
(8,'Super','Super Usuário','root@root','09856260701',md5(123), 1,true,1,8);

use processo_de_aquisicao;

INSERT INTO `modalidade`(`id`,`nome`,`status`)
VALUES 
(1,'Pregão SRP',true),
(2,'Pregão Tradicional',true),
(3,'Concorrência',true),
(4,'Concurso',true),
(5,'Leilão',true),
(6,'Diálogo Competitivo',true),
(7,'Dispensa de Licitação',true),
(8,'Inexigibilidade de Licitação',true);
use processo_de_aquisicao;

INSERT INTO `lei`(`id`,`numero`,`artigo`,`inciso`,`data`,`modalidade_id`,`status`) VALUES 
(1,'14133','28º','I','2021-04-01',1,true),
(2,'14133','28º','I','2021-04-01',2,true),
(3,'14133','28º','II','2021-04-01',3,true),
(4,'14133','28º','III','2021-04-01',4,true),
(5,'14133','28º','IV','2021-04-01',5,true),
(6,'14133','28º','V','2021-04-01',6,true),
(7,'14133','74º','I','2021-04-01',8,true),
(8,'14133','74º','II','2021-04-01',8,true),
(9,'14133','74º','III','2021-04-01',8,true),
(10,'14133','74º','IV','2021-04-01',8,true),
(11,'14133','74º','V','2021-04-01',8,true),
(12,'14133','75º','I','2021-04-01',7,true),
(13,'14133','75º','II','2021-04-01',7,true),
(14,'14133','75º','III','2021-04-01',7,true),
(15,'14133','75º','IV','2021-04-01',7,true),
(16,'14133','75º','V','2021-04-01',7,true),
(17,'14133','75º','VI','2021-04-01',7,true),
(18,'14133','75º','VII','2021-04-01',7,true),
(19,'14133','75º','VIII','2021-04-01',7,true),
(20,'14133','75º','IX','2021-04-01',7,true),
(21,'14133','75º','X','2021-04-01',7,true),
(22,'14133','75º','XI','2021-04-01',7,true),
(23,'14133','75º','XII','2021-04-01',7,true),
(24,'14133','75º','XIII','2021-04-01',7,true),
(25,'14133','75º','XIV','2021-04-01',7,true),
(26,'14133','75º','XV','2021-04-01',7,true),
(27,'14133','75º','XVI','2021-04-01',7,true),
(28,'14133','75º','XVII','2021-04-01',7,true),
(29,'10520','1º','','2002-07-17',1,true),
(30,'10520','1º','','2002-07-17',2,true),
(31,'8666','24º','I','1993-06-21',7,true),
(32,'8666','24º','II','1993-06-21',7,true),
(33,'8666','24º','III','1993-06-21',7,true),
(34,'8666','24º','IV','1993-06-21',7,true),
(35,'8666','24º','V','1993-06-21',7,true),
(36,'8666','24º','I','1993-06-21',7,true),
(37,'8666','24º','II','1993-06-21',7,true),
(38,'8666','24º','III','1993-06-21',7,true),
(39,'8666','24º','IV','1993-06-21',7,true),
(40,'8666','24º','V','1993-06-21',7,true),
(41,'8666','24º','VI','1993-06-21',7,true),
(42,'8666','24º','VII','1993-06-21',7,true),
(43,'8666','24º','VIII','1993-06-21',7,true),
(44,'8666','24º','IX','1993-06-21',7,true),
(45,'8666','24º','X','1993-06-21',7,true),
(46,'8666','24º','XI','1993-06-21',7,true),
(47,'8666','24º','XII','1993-06-21',7,true),
(48,'8666','24º','XIII','1993-06-21',7,true),
(49,'8666','24º','XIV','1993-06-21',7,true),
(50,'8666','24º','XV','1993-06-21',7,true),
(51,'8666','24º','XVI','1993-06-21',7,true),
(52,'8666','24º','XVII','1993-06-21',7,true),
(53,'8666','24º','XVIII','1993-06-21',7,true),
(54,'8666','24º','XIX','1993-06-21',7,true),
(55,'8666','24º','XX','1993-06-21',7,true),
(56,'8666','24º','XXI','1993-06-21',7,true),
(57,'8666','24º','XXII','1993-06-21',7,true),
(58,'8666','24º','XXIII','1993-06-21',7,true),
(59,'8666','24º','XXIV','1993-06-21',7,true),
(60,'8666','24º','XXV','1993-06-21',7,true),
(61,'8666','24º','XXVI','1993-06-21',7,true),
(62,'8666','24º','XXVII','1993-06-21',7,true),
(63,'8666','24º','XXVIII','1993-06-21',7,true),
(64,'8666','24º','XXIX','1993-06-21',7,true),
(65,'8666','24º','XXX','1993-06-21',7,true),
(66,'8666','24º','XXXI','1993-06-21',7,true),
(67,'8666','24º','XXXII','1993-06-21',7,true),
(68,'8666','24º','XXXIII','1993-06-21',7,true),
(69,'8666','24º','XXXIV','1993-06-21',7,true),
(70,'8666','25º','XXXV','1993-06-21',8,true);
use processo_de_aquisicao;

INSERT INTO 
`tipo`(`id`,`nome`,`status`) 
VALUES 
(1,'Licitação/ Dispensa/ Inex',true),
(2,'Empenho(só NE)/ Mapa OCS',true);


use processo_de_aquisicao;

INSERT INTO `processo`(`id`,`objeto`,`numero`,`data_hora`,`chave`,`departamento_id`,`lei_id`,`tipo_id`,`completo`,`status`) 
VALUES 
(1,'Aquisição de Vtrs','64431.0123456/2023-01',date(now()),uuid(),1,1,1,false,true),
(2,'Aquisição de Material Permanente','64431.0123456/2022-02',date(now()),uuid(),2,2,2,false,true);

use processo_de_aquisicao;

INSERT INTO `andamento`(`id`,`status_do_andamento`,`data_hora`,`processo_id`,`usuario_id`,`status`) 
VALUES 
(1,'criado',date('2023-06-24 12:01:02'),1,1,true),
(2,'criado',date('2023-06-22 10:21:32'),2,2,true);

use processo_de_aquisicao;

INSERT INTO `artefato`(`id`,`ordem`,`nome`,`status`) VALUES 
(1,1,'Capa',true),
(2,2,'Índice',true),
(3,3,'Termo De Autuação',true),
(4,4,'Nomeação Do Cmt Da Unidade',true),
(5,5,'Nomeação Da Equipe Da Contratação',true),
(6,6,'Nomeação De Pregoeiro Equipe De Apoio',true),
(7,7,'Certificado Do Pregoeiro',true),
(8,8,'Documento De Formalização Da Demanda - DFD',true),
(9,9,'Relação De Itens De Aquisição/ Serviço',true),
(10,10,'Autorização P/ Abertura De Processo',true),
(11,11,'ETP – Estudo Técnico Preliminar',true),
(12,12,'Projeto Básico',true),
(13,13,'Projeto Executivo',true),
(14,14,'MGR – Mapa De Gerenciamento De Riscos',true),
(15,15,'Minuta TR Da Sç Demandante',true),
(16,16,'Aprovação ETP E TR',true),
(17,17,'Relatório Pesquisa De Preços – RPP',true),
(18,18,'Pesquisas De Preços – PP',true),
(19,19,'Mapa Comparativo De Preços – MCP',true),
(20,20,'Quadro IRP',true),
(21,21,'Aviso de Abertura de IRP À 5ª CGCFEx',true),
(22,22,'Minuta Do Edital',true),
(23,23,'Minuta Do Termo De Referência – TR Da SALC',true),
(24,24,'Minuta Da ARP',true),
(25,25,'Minuta De Contrato',true),
(26,26,'Declaração Inexistência De Atas',true),
(27,27,'Declaração De Natureza Do Objeto',true),
(28,28,'Declaração De Atividade De Custeio',true),
(29,29,'Declaração De Adequação Orçamentária',true),
(30,30,'Justificativa De PE SRP',true),
(31,31,'Justificativa Para Alterações Das Minutas',true),
(32,32,'Justificativa de não exclusividade para ME/EPP',true),
(33,33,'Lista De Verificação - Anexo I Da SEGE',true),
(34,34,'Lista De Verificação - Anexo II Da SEGE',true),
(35,35,'Ofício Para CJU Analisar Processo',true),
(36,36,'Ofício De Remessa Da CJU',true),
(37,37,'Parecer Da CJU',true),
(38,38,'Nota Explicativa',true),
(39,39,'Pedidos de impugnação',true),
(40,40,'Decisão sobre pedidos de impugnação',true),
(41,41,'Pedidos de esclarecimentos',true),
(42,42,'Esclarecimentos publicado',true),
(43,43,'Edital Revisado',true),
(44,44,'TR Revisado',true),
(45,45,'Minuta ARP Revisado',true),
(46,46,'Minuta Contrato Revisado',true),
(47,47,'Aviso(s) de publicação(ões) no DOU',true),
(48,48,'ARP Assinada',true),
(49,49,'Contrato assinado',true),
(50,50,'Cotação Eletrônica',true),
(51,51,'Troca de E-mail ou Ofício com Fornecedor',true),
(52,52,'Proposta do Fornecedor',true),
(53,53,'DIEx de Requisitória',true),
(54,54,'Termo de Dispensa de Licitação',true),
(55,55,'Regularidade Fiscal - CNJ',true),
(56,56,'Regularidade Fiscal – CEIS',true),
(57,57,'Regularidade Fiscal – TCU',true),
(58,58,'Regularidade Fiscal – CADIN',true),
(59,59,'Regularidade Fiscal – SICAF (FGTS, RF, TRABALHISTA)',true),
(60,60,'Regularidade FGTS',true),
(61,61,'Regularidade RF',true),
(62,62,'Regularidade TRABALHISTA',true),
(63,63,'Nota de Empenho',true),
(64,64,'Termo De Encerramento',true);use processo_de_aquisicao;

drop table lei_tipo_artefato;

#12
create table if not exists lei_tipo_artefato(
id int primary key auto_increment not null,
lei_id int not null,
tipo_id int not null,
artefato_id int not null,
status boolean not null,
foreign key (lei_id) references lei(id),
foreign key (tipo_id) references tipo(id),
foreign key (artefato_id) references artefato(id)
);


INSERT INTO `lei_tipo_artefato`(`id`,`lei_id`,`tipo_id`,`artefato_id`,`status`) VALUES 
(default,1,1,1,true),(default,2,1,1,true),(default,3,1,1,true),(default,4,1,1,true),(default,5,1,1,true),(default,6,1,1,true),(default,7,1,1,true),(default,8,1,1,true),(default,9,1,1,true),(default,10,1,1,true),(default,11,1,1,true),(default,12,1,1,true),(default,13,1,1,true),(default,14,1,1,true),(default,15,1,1,true),(default,16,1,1,true),(default,17,1,1,true),(default,18,1,1,true),(default,19,1,1,true),(default,20,1,1,true),(default,21,1,1,true),(default,22,1,1,true),(default,23,1,1,true),(default,24,1,1,true),(default,25,1,1,true),(default,26,1,1,true),(default,27,1,1,true),(default,28,1,1,true),(default,29,1,1,true),(default,30,1,1,true),(default,31,1,1,true),(default,32,1,1,true),(default,33,1,1,true),(default,34,1,1,true),(default,35,1,1,true),(default,36,1,1,true),(default,37,1,1,true),(default,38,1,1,true),(default,39,1,1,true),(default,40,1,1,true),(default,41,1,1,true),(default,42,1,1,true),(default,43,1,1,true),(default,44,1,1,true),(default,45,1,1,true),(default,46,1,1,true),(default,47,1,1,true),(default,48,1,1,true),(default,49,1,1,true),(default,50,1,1,true),(default,51,1,1,true),(default,52,1,1,true),(default,53,1,1,true),(default,54,1,1,true),(default,55,1,1,true),(default,56,1,1,true),(default,57,1,1,true),(default,58,1,1,true),(default,59,1,1,true),(default,60,1,1,true),(default,61,1,1,true),(default,62,1,1,true),(default,63,1,1,true),(default,64,1,1,true),(default,65,1,1,true),(default,66,1,1,true),(default,67,1,1,true),(default,68,1,1,true),(default,69,1,1,true),(default,70,1,1,true),(default,1,1,2,true),(default,2,1,2,true),(default,12,1,2,true),(default,13,1,2,true),(default,29,1,2,true),(default,30,1,2,true),(default,1,1,3,true),(default,2,1,3,true),(default,12,1,3,true),(default,13,1,3,true),(default,29,1,3,true),(default,30,1,3,true),(default,1,1,4,true),(default,2,1,4,true),(default,29,1,4,true),(default,30,1,4,true),(default,1,1,5,true),(default,2,1,5,true),(default,29,1,5,true),(default,30,1,5,true),(default,1,1,6,true),(default,2,1,6,true),(default,29,1,6,true),(default,30,1,6,true),(default,1,1,7,true),(default,2,1,7,true),(default,29,1,7,true),(default,30,1,7,true),(default,1,1,8,true),(default,2,1,8,true),(default,12,1,8,true),(default,13,1,8,true),(default,29,1,8,true),(default,30,1,8,true),(default,1,1,9,true),(default,2,1,9,true),(default,29,1,9,true),(default,30,1,9,true),(default,1,1,10,true),(default,2,1,10,true),(default,29,1,10,true),(default,30,1,10,true),(default,1,1,11,true),(default,2,1,11,true),(default,29,1,11,true),(default,30,1,11,true),(default,1,1,12,true),(default,2,1,12,true),(default,29,1,12,true),(default,30,1,12,true),(default,1,1,13,true),(default,2,1,13,true),(default,29,1,13,true),(default,30,1,13,true),(default,1,1,14,true),(default,2,1,14,true),(default,29,1,14,true),(default,30,1,14,true),(default,1,1,15,true),(default,2,1,15,true),(default,29,1,15,true),(default,30,1,15,true),(default,29,1,16,true),(default,30,1,16,true),(default,1,1,17,true),(default,2,1,17,true),(default,29,1,17,true),(default,30,1,17,true),(default,1,1,18,true),(default,2,1,18,true),(default,12,1,18,true),(default,13,1,18,true),(default,29,1,18,true),(default,30,1,18,true),(default,1,1,19,true),(default,2,1,19,true),(default,29,1,19,true),(default,30,1,19,true),(default,1,1,20,true),(default,29,1,20,true),(default,1,1,21,true),(default,2,1,21,true),(default,29,1,21,true),(default,30,1,21,true),(default,1,1,22,true),(default,2,1,22,true),(default,29,1,22,true),(default,30,1,22,true),(default,1,1,23,true),(default,2,1,23,true),(default,29,1,23,true),(default,30,1,23,true),(default,1,1,24,true),(default,2,1,24,true),(default,29,1,24,true),(default,30,1,24,true),(default,1,1,25,true),(default,2,1,25,true),(default,29,1,25,true),(default,30,1,25,true),(default,1,1,26,true),(default,2,1,26,true),(default,29,1,26,true),(default,30,1,26,true),(default,1,1,27,true),(default,2,1,27,true),(default,29,1,27,true),(default,30,1,27,true),(default,1,1,28,true),(default,2,1,28,true),(default,29,1,28,true),(default,30,1,28,true),(default,1,1,29,true),(default,2,1,29,true),(default,29,1,29,true),(default,30,1,29,true),(default,1,1,30,true),(default,2,1,30,true),(default,29,1,30,true),(default,30,1,30,true),(default,1,1,31,true),(default,2,1,31,true),(default,29,1,31,true),(default,30,1,31,true),(default,1,1,32,true),(default,2,1,32,true),(default,12,1,32,true),(default,13,1,32,true),(default,29,1,32,true),(default,30,1,32,true),(default,1,1,33,true),(default,2,1,33,true),(default,29,1,33,true),(default,30,1,33,true),(default,1,1,34,true),(default,2,1,34,true),(default,29,1,34,true),(default,30,1,34,true),(default,1,1,35,true),(default,2,1,35,true),(default,29,1,35,true),(default,30,1,35,true),(default,1,1,36,true),(default,2,1,36,true),(default,29,1,36,true),(default,30,1,36,true),(default,1,1,37,true),(default,2,1,37,true),(default,29,1,37,true),(default,30,1,37,true),(default,1,1,38,true),(default,2,1,38,true),(default,29,1,38,true),(default,30,1,38,true),(default,1,1,39,true),(default,2,1,39,true),(default,29,1,39,true),(default,30,1,39,true),(default,1,1,40,true),(default,2,1,40,true),(default,29,1,40,true),(default,30,1,40,true),(default,1,1,41,true),(default,2,1,41,true),(default,29,1,41,true),(default,30,1,41,true),(default,1,1,42,true),(default,2,1,42,true),(default,29,1,42,true),(default,30,1,42,true),(default,1,1,43,true),(default,2,1,43,true),(default,29,1,43,true),(default,30,1,43,true),(default,1,1,44,true),(default,2,1,44,true),(default,29,1,44,true),(default,30,1,44,true),(default,1,1,45,true),(default,29,1,45,true),(default,1,1,46,true),(default,2,1,46,true),(default,29,1,46,true),(default,30,1,46,true),(default,1,1,47,true),(default,2,1,47,true),(default,29,1,47,true),(default,30,1,47,true),(default,1,1,48,true),(default,29,1,48,true),(default,1,1,49,true),(default,2,1,49,true),(default,29,1,49,true),(default,30,1,49,true),(default,12,1,50,true),(default,13,1,50,true),(default,31,1,50,true),(default,32,1,50,true),(default,12,1,51,true),(default,13,1,51,true),(default,31,1,51,true),(default,32,1,51,true),(default,12,1,52,true),(default,13,1,52,true),(default,31,1,52,true),(default,32,1,52,true),(default,12,1,53,true),(default,13,1,53,true),(default,31,1,53,true),(default,32,1,53,true),(default,12,1,54,true),(default,13,1,54,true),(default,31,1,54,true),(default,32,1,54,true),(default,1,1,55,true),(default,2,1,55,true),(default,12,1,55,true),(default,13,1,55,true),(default,29,1,55,true),(default,30,1,55,true),(default,31,1,55,true),(default,32,1,55,true),(default,1,1,56,true),(default,2,1,56,true),(default,12,1,56,true),(default,13,1,56,true),(default,29,1,56,true),(default,30,1,56,true),(default,31,1,56,true),(default,32,1,56,true),(default,1,1,57,true),(default,2,1,57,true),(default,12,1,57,true),(default,13,1,57,true),(default,29,1,57,true),(default,30,1,57,true),(default,31,1,57,true),(default,32,1,57,true),(default,1,1,58,true),(default,2,1,58,true),(default,12,1,58,true),(default,13,1,58,true),(default,29,1,58,true),(default,30,1,58,true),(default,31,1,58,true),(default,32,1,58,true),(default,1,1,59,true),(default,2,1,59,true),(default,12,1,59,true),(default,13,1,59,true),(default,29,1,59,true),(default,30,1,59,true),(default,31,1,59,true),(default,32,1,59,true),(default,12,1,60,true),(default,13,1,60,true),(default,31,1,60,true),(default,32,1,60,true),(default,12,1,61,true),(default,13,1,61,true),(default,31,1,61,true),(default,32,1,61,true),(default,12,1,62,true),(default,13,1,62,true),(default,31,1,62,true),(default,32,1,62,true),(default,12,1,63,true),(default,13,1,63,true),(default,31,1,63,true),(default,32,1,63,true),(default,1,1,64,true),(default,2,1,64,true),(default,12,1,64,true),(default,13,1,64,true),(default,29,1,64,true),(default,30,1,64,true),(default,31,1,64,true),(default,32,1,64,true),(default,1,2,53,true),(default,2,2,53,true),(default,10,2,53,true),(default,29,2,53,true),(default,30,2,53,true),(default,31,2,53,true),(default,32,2,53,true),(default,57,2,53,true),(default,70,2,53,true),(default,31,2,54,true),(default,32,2,54,true),(default,1,2,55,true),(default,2,2,55,true),(default,10,2,55,true),(default,19,2,55,true),(default,29,2,55,true),(default,30,2,55,true),(default,31,2,55,true),(default,32,2,55,true),(default,57,2,55,true),(default,70,2,55,true),(default,1,2,56,true),(default,2,2,56,true),(default,10,2,56,true),(default,19,2,56,true),(default,29,2,56,true),(default,30,2,56,true),(default,31,2,56,true),(default,32,2,56,true),(default,57,2,56,true),(default,70,2,56,true),(default,1,2,57,true),(default,2,2,57,true),(default,10,2,57,true),(default,19,2,57,true),(default,29,2,57,true),(default,30,2,57,true),(default,31,2,57,true),(default,32,2,57,true),(default,57,2,57,true),(default,70,2,57,true),(default,1,2,58,true),(default,2,2,58,true),(default,10,2,58,true),(default,19,2,58,true),(default,29,2,58,true),(default,30,2,58,true),(default,31,2,58,true),(default,32,2,58,true),(default,57,2,58,true),(default,70,2,58,true),(default,1,2,59,true),(default,2,2,59,true),(default,10,2,59,true),(default,19,2,59,true),(default,29,2,59,true),(default,30,2,59,true),(default,31,2,59,true),(default,32,2,59,true),(default,57,2,59,true),(default,70,2,59,true),(default,1,2,60,true),(default,2,2,60,true),(default,10,2,60,true),(default,19,2,60,true),(default,29,2,60,true),(default,30,2,60,true),(default,31,2,60,true),(default,32,2,60,true),(default,57,2,60,true),(default,70,2,60,true),(default,1,2,61,true),(default,2,2,61,true),(default,10,2,61,true),(default,19,2,61,true),(default,29,2,61,true),(default,30,2,61,true),(default,31,2,61,true),(default,32,2,61,true),(default,57,2,61,true),(default,70,2,61,true),(default,1,2,62,true),(default,2,2,62,true),(default,10,2,62,true),(default,19,2,62,true),(default,29,2,62,true),(default,30,2,62,true),(default,31,2,62,true),(default,32,2,62,true),(default,57,2,62,true),(default,70,2,62,true),(default,1,2,63,true),(default,2,2,63,true),(default,10,2,63,true),(default,19,2,63,true),(default,29,2,63,true),(default,30,2,63,true),(default,31,2,63,true),(default,32,2,63,true),(default,57,2,63,true),(default,70,2,63,true),(default,31,2,64,true),(default,32,2,64,true);

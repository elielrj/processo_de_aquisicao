#DEPARTAMENTOS
INSERT INTO `departamento`(`id`,`nome`,`sigla`,`status`) VALUES (1,'Setor de Almoxerifado','Almox',true);
INSERT INTO `departamento`(`id`,`nome`,`sigla`,`status`) VALUES (2,'Seção de Manutenção e Transporte','Sç Mnt Transp',true);
INSERT INTO `departamento`(`id`,`nome`,`sigla`,`status`) VALUES (3,'Setor de Aprovisionamento','Aprov',true);
INSERT INTO `departamento`(`id`,`nome`,`sigla`,`status`) VALUES (4,'Seção de Saúde','Sç Sau',true);

#USUÁRIOS
INSERT INTO `usuario`(`id`, `email`, `cpf`, `senha`, `departamento_id`,`status`) VALUES (1,'elielrj@gmail.com','09856260701',md5(952420),1,true);

#tIPO DE LICITAÇÕES
INSERT INTO `tipo_de_licitacao`(`id`,`nome`,`lei`,`artigo`,`inciso`,`data_da_lei`,`pagina`,`status`) VALUES (1,'Pregão SRP','10.520','1','',now(),'tipoDeLicitacao/10520/pregao/',true);


#PROCESSO
INSERT INTO `processo`(`id`,`objeto`,`nup_nud`,`data_do_processo`,`chave_de_acesso`,`departamento_id`,`tipo_de_licitacao_id`,`status`) VALUES (1,'Aquisição de Vtrs','42323235323523',now(),md5(2314142),1,1,true);


#ARTEFATO
INSERT INTO `artefato`(`id`,`nome`) VALUES 
('1','Capa'),
('2','Índice'),
('3','Termo De Autuação'),
('4','Nomeação Do Cmt Da Unidade'),
('5','Nomeação Da Equipe Da Contratação'),
('6','Nomeação De Pregoeiro Equipe De Apoio'),
('7','Certificado Do Pregoeiro'),
('8','Documento De Formalização Da Demanda - DFD'),
('9','Relação De Itens De Aquisição/ Serviço'),
('10','Autorização P/ Abertura De Processo'),
('11','ETP – Estudo Técnico Preliminar'),
('12','MGR – Mapa De Gerenciamento De Riscos'),
('13','Minuta TR Da Sç Demandante'),
('14','Aprovação ETP E TR'),
('15','Relatório Pesquisa De Preços – RPP'),
('16','Pesquisas De Preços – PP'),
('17','Mapa Comparativo De Preços – MCP'),
('18','Quadro IRP'),
('19','Aviso de Abertura de IRP À 5ª CGCFEx'),
('20','Minuta Do Edital'),
('21','Minuta Do Termo De Referência – TR Da SALC'),
('22','Minuta Da ARP'),
('23','Minuta De Contrato'),
('24','Declaração Inexistência De Atas'),
('25','Declaração De Natureza Do Objeto'),
('26','Declaração De Atividade De Custeio'),
('27','Declaração De Adequação Orçamentária'),
('28','Justificativa De PE SRP'),
('29','Justificativa Para Alteraçõeses Das Minutas'),
('30','Justificativa de não exclusividade para ME/EPP'),
('31','Lista De Verificação - Anexo I Da SEGE'),
('32','Lista De Verificação - Anexo II Da SEGE'),
('33','Ofício Para CJU Analisar Processo'),
('34','Ofício De Remessa Da CJU'),
('35','Parecer Da CJU'),
('36','Pedidos de impugnação'),
('37','Decisão sobre pedidos de impugnação'),
('38','Pedidos de esclarecimentos'),
('39','Esclarecimentos publicado'),
('40','Edital Revisado'),
('41','TR Revisado'),
('42','Minuta ARP Revisado'),
('43','Minuta Contrato Revisado'),
('44','Aviso(s) de publicação(ões) no DOU'),
('45','ARP Assinada'),
('46','Contrato assinado'),
('47','Termo De Encerramento');

#ÍNDICE
INSERT INTO `indice`(`id`,`tipo_de_licitacao_id`,`status`) VALUES (1,1,true);

#Item do Índice
INSERT INTO `item_do_indice`(`id`,`ordem`,`indice_id`,`artefato_id`,`status`) 
VALUES
('1','1','1','1',true),
('2','2','1','2',true),
('3','3','1','3',true),
('4','4','1','4',true),
('5','5','1','5',true),
('6','6','1','6',true),
('7','7','1','7',true),
('8','8','1','8',true),
('9','9','1','9',true),
('10','10','1','10',true),
('11','11','1','11',true),
('12','12','1','12',true),
('13','13','1','13',true),
('14','14','1','14',true),
('15','15','1','15',true),
('16','16','1','16',true),
('17','17','1','17',true),
('18','18','1','18',true),
('19','19','1','19',true),
('20','20','1','20',true),
('21','21','1','21',true),
('22','22','1','22',true),
('23','23','1','23',true),
('24','24','1','24',true),
('25','25','1','25',true),
('26','26','1','26',true),
('27','27','1','27',true),
('28','28','1','28',true),
('29','29','1','29',true),
('30','30','1','30',true),
('31','31','1','31',true),
('32','32','1','32',true),
('33','33','1','33',true),
('34','34','1','34',true),
('35','35','1','35',true),
('36','36','1','36',true),
('37','37','1','37',true),
('38','38','1','38',true),
('39','39','1','39',true),
('40','40','1','40',true),
('41','41','1','41',true),
('42','42','1','42',true),
('43','43','1','43',true),
('44','44','1','44',true),
('45','45','1','45',true),
('46','46','1','46',true),
('47','47','1','47',true);

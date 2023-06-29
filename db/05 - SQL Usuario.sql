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

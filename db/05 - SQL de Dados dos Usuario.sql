use processo_de_aquisicao;

INSERT INTO 
`usuario`(`id`,`nome_de_guerra`,`nome_completo`,`email`, `cpf`, `senha`, `departamento_id`,`status`,`hierarquia_id`,`funcao_id`) 
VALUES 
(default,'Leitor','Leitor de Processos','leitor@leitor','09856260701',md5(123),1,true,1,1),
(default,'Escritor','Escritor de Processos','escritor@escritor','09856260701',md5(123), 2,true,1,2),
(default,'Aprovador','Aprovador de Processos','aprovador@aprovador','09856260701',md5(123), 3,true,1,3),
(default,'Executor','Executor de Processos','executor@executor','09856260701',md5(123), 3,true,1,4),
(default,'Conformador','Conformador de Processos','conformador@conformador','09856260701',md5(123), 3,true,1,5),
(default,'Admiinistrador','Admiinistrador do Sistema','administrador@administrador','09856260701',md5(123), 4,true,1,6),
(default,'Super','Super Usuário','root@root','09856260701',md5(123), 1,true,1,7);
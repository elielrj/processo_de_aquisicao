use processo_de_aquisicao;

INSERT INTO 
`usuario`(`id`,`nome`,`sobrenome`,`email`, `cpf`, `senha`, `departamento_id`,`status`,`hierarquia_id`,`funcao_id`) 
VALUES 
(default,'Leitor','de Processos','leitor@leitor','09856260701',md5(123),1,true,1,2),
(default,'Escritor','de Processos','escritor@escritor','09856260701',md5(123), 2,true,1,1),
(default,'Aprovador','de Processos','aprovador@aprovador','09856260701',md5(123), 3,true,1,4),
(default,'Admiinistrador','do Sistema','admin@admin','09856260701',md5(123), 4,true,1,3),
(default,'Super','Usuário','root@root','09856260701',md5(123), 1,true,1,5);
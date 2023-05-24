use processo_de_aquisicao;

INSERT INTO 
`usuario`(`id`,`nome`,`sobrenome`,`email`, `cpf`, `senha`, `departamento_id`,`status`,`funcao_id`,`hierarquia_id`) 
VALUES 
(default,'Leitor','Lei','leitor@leitor','09856260701',md5(123),1,true,1,1),
(default,'Escrito','Esc','escrito@escritor','09856260701',md5(123), 2,true,1,1),
(default,'Despachante','Des','despachante@despachante','09856260701',md5(123), 3,true,1,1),
(default,'Admiinistrador','Adm','admin@admin','09856260701',md5(123), 4,true,1,1),
(default,'Super','Usuário','root@root','09856260701',md5(123), 1,true,1,1);
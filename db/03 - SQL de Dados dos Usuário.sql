use processo_de_aquisicao;

INSERT INTO 
`usuario`(`id`,`nome`,`sobrenome`,`email`, `cpf`, `senha`, `departamento_id`,`status`) 
VALUES 
(default,'Leitor','Lei','leitor@leitor','09856260701',md5(123),1,true),
(default,'Escrito','Esc','escrito@escritor','09856260701',md5(123), 2,true),
(default,'Despachante','Des','despachante@despachante','09856260701',md5(123), 3,true),
(default,'Admiinistrador','Adm','admin@admin','09856260701',md5(123), 4,true),
(default,'Super','Usuário','root@root','09856260701',md5(123), 1,true);
use processo_de_aquisicao;

INSERT INTO 
`usuario`(`id`, `email`, `cpf`, `senha`, `departamento_id`,`status`) 
VALUES 
(default,'leitor@leitor','09856260701',md5(123),1,true),
(default,'escrito@escritor','09856260701',md5(123), 2,true),
(default,'despachante@despachante','09856260701',md5(123), 3,true),
(default,'admin@admin','09856260701',md5(123), 4,true),
(default,'root@root','09856260701',md5(123), 1,true);
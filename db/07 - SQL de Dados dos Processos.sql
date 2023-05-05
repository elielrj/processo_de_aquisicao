use processo_de_aquisicao;

INSERT INTO `processo`(`id`,`objeto`,`numero`,`data`,`chave`,`departamento_id`,`lei_id`,`tipo_id`,`completo`,`status`) 
VALUES 
(default,'Aquisição de Vtrs','64431.0123456/2023-01',date(now()),uuid(),1,1,1,true),
(default,'Aquisição de Material Permanente','64431.0123456/2022-02',date(now()),uuid(),2,2,2,false,true);


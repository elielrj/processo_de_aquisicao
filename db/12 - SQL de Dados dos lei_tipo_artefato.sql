use processo_de_aquisicao;

#drop table lei_tipo_artefato;
/*
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
*/

INSERT INTO `lei_tipo_artefato`(`id`,`lei_id`,`tipo_id`,`artefato_id`,`status`) VALUES 
(default,1,1,1,true),(default,2,1,1,true),(default,3,1,1,true),(default,4,1,1,true),(default,5,1,1,true),(default,6,1,1,true),(default,7,1,1,true),(default,8,1,1,true),(default,9,1,1,true),(default,10,1,1,true),(default,11,1,1,true),(default,12,1,1,true),(default,13,1,1,true),(default,14,1,1,true),(default,15,1,1,true),(default,16,1,1,true),(default,17,1,1,true),(default,18,1,1,true),(default,19,1,1,true),(default,20,1,1,true),(default,21,1,1,true),(default,22,1,1,true),(default,23,1,1,true),(default,24,1,1,true),(default,25,1,1,true),(default,26,1,1,true),(default,27,1,1,true),(default,28,1,1,true),(default,29,1,1,true),(default,30,1,1,true),(default,31,1,1,true),(default,32,1,1,true),(default,33,1,1,true),(default,34,1,1,true),(default,35,1,1,true),(default,36,1,1,true),(default,37,1,1,true),(default,38,1,1,true),(default,39,1,1,true),(default,40,1,1,true),(default,41,1,1,true),(default,42,1,1,true),(default,43,1,1,true),(default,44,1,1,true),(default,45,1,1,true),(default,46,1,1,true),(default,47,1,1,true),(default,48,1,1,true),(default,49,1,1,true),(default,50,1,1,true),(default,51,1,1,true),(default,52,1,1,true),(default,53,1,1,true),(default,54,1,1,true),(default,55,1,1,true),(default,56,1,1,true),(default,57,1,1,true),(default,58,1,1,true),(default,59,1,1,true),(default,60,1,1,true),(default,61,1,1,true),(default,62,1,1,true),(default,63,1,1,true),(default,64,1,1,true),(default,65,1,1,true),(default,66,1,1,true),(default,67,1,1,true),(default,68,1,1,true),(default,69,1,1,true),(default,70,1,1,true),(default,1,1,2,true),(default,2,1,2,true),(default,12,1,2,true),(default,13,1,2,true),(default,29,1,2,true),(default,30,1,2,true),(default,1,1,3,true),(default,2,1,3,true),(default,12,1,3,true),(default,13,1,3,true),(default,29,1,3,true),(default,30,1,3,true),(default,1,1,4,true),(default,2,1,4,true),(default,29,1,4,true),(default,30,1,4,true),(default,1,1,5,true),(default,2,1,5,true),(default,29,1,5,true),(default,30,1,5,true),(default,1,1,6,true),(default,2,1,6,true),(default,29,1,6,true),(default,30,1,6,true),(default,1,1,7,true),(default,2,1,7,true),(default,29,1,7,true),(default,30,1,7,true),(default,1,1,8,true),(default,2,1,8,true),(default,12,1,8,true),(default,13,1,8,true),(default,29,1,8,true),(default,30,1,8,true),(default,1,1,9,true),(default,2,1,9,true),(default,29,1,9,true),(default,30,1,9,true),(default,1,1,10,true),(default,2,1,10,true),(default,29,1,10,true),(default,30,1,10,true),(default,1,1,11,true),(default,2,1,11,true),(default,29,1,11,true),(default,30,1,11,true),(default,1,1,12,true),(default,2,1,12,true),(default,29,1,12,true),(default,30,1,12,true),(default,1,1,13,true),(default,2,1,13,true),(default,29,1,13,true),(default,30,1,13,true),(default,1,1,14,true),(default,2,1,14,true),(default,29,1,14,true),(default,30,1,14,true),(default,1,1,15,true),(default,2,1,15,true),(default,29,1,15,true),(default,30,1,15,true),(default,29,1,16,true),(default,30,1,16,true),(default,1,1,17,true),(default,2,1,17,true),(default,29,1,17,true),(default,30,1,17,true),(default,1,1,18,true),(default,2,1,18,true),(default,12,1,18,true),(default,13,1,18,true),(default,29,1,18,true),(default,30,1,18,true),(default,1,1,19,true),(default,2,1,19,true),(default,29,1,19,true),(default,30,1,19,true),(default,1,1,20,true),(default,29,1,20,true),(default,1,1,21,true),(default,2,1,21,true),(default,29,1,21,true),(default,30,1,21,true),(default,1,1,22,true),(default,2,1,22,true),(default,29,1,22,true),(default,30,1,22,true),(default,1,1,23,true),(default,2,1,23,true),(default,29,1,23,true),(default,30,1,23,true),(default,1,1,24,true),(default,2,1,24,true),(default,29,1,24,true),(default,30,1,24,true),(default,1,1,25,true),(default,2,1,25,true),(default,29,1,25,true),(default,30,1,25,true),(default,1,1,26,true),(default,2,1,26,true),(default,29,1,26,true),(default,30,1,26,true),(default,1,1,27,true),(default,2,1,27,true),(default,29,1,27,true),(default,30,1,27,true),(default,1,1,28,true),(default,2,1,28,true),(default,29,1,28,true),(default,30,1,28,true),(default,1,1,29,true),(default,2,1,29,true),(default,29,1,29,true),(default,30,1,29,true),(default,1,1,30,true),(default,2,1,30,true),(default,29,1,30,true),(default,30,1,30,true),(default,1,1,31,true),(default,2,1,31,true),(default,29,1,31,true),(default,30,1,31,true),(default,1,1,32,true),(default,2,1,32,true),(default,12,1,32,true),(default,13,1,32,true),(default,29,1,32,true),(default,30,1,32,true),(default,1,1,33,true),(default,2,1,33,true),(default,29,1,33,true),(default,30,1,33,true),(default,1,1,34,true),(default,2,1,34,true),(default,29,1,34,true),(default,30,1,34,true),(default,1,1,35,true),(default,2,1,35,true),(default,29,1,35,true),(default,30,1,35,true),(default,1,1,36,true),(default,2,1,36,true),(default,29,1,36,true),(default,30,1,36,true),(default,1,1,37,true),(default,2,1,37,true),(default,29,1,37,true),(default,30,1,37,true),(default,1,1,38,true),(default,2,1,38,true),(default,29,1,38,true),(default,30,1,38,true),(default,1,1,39,true),(default,2,1,39,true),(default,29,1,39,true),(default,30,1,39,true),(default,1,1,40,true),(default,2,1,40,true),(default,29,1,40,true),(default,30,1,40,true),(default,1,1,41,true),(default,2,1,41,true),(default,29,1,41,true),(default,30,1,41,true),(default,1,1,42,true),(default,2,1,42,true),(default,29,1,42,true),(default,30,1,42,true),(default,1,1,43,true),(default,2,1,43,true),(default,29,1,43,true),(default,30,1,43,true),(default,1,1,44,true),(default,2,1,44,true),(default,29,1,44,true),(default,30,1,44,true),(default,1,1,45,true),(default,29,1,45,true),(default,1,1,46,true),(default,2,1,46,true),(default,29,1,46,true),(default,30,1,46,true),(default,1,1,47,true),(default,2,1,47,true),(default,29,1,47,true),(default,30,1,47,true),(default,1,1,48,true),(default,29,1,48,true),(default,1,1,49,true),(default,2,1,49,true),(default,29,1,49,true),(default,30,1,49,true),(default,12,1,50,true),(default,13,1,50,true),(default,31,1,50,true),(default,32,1,50,true),(default,12,1,51,true),(default,13,1,51,true),(default,31,1,51,true),(default,32,1,51,true),(default,12,1,52,true),(default,13,1,52,true),(default,31,1,52,true),(default,32,1,52,true),(default,12,1,53,true),(default,13,1,53,true),(default,31,1,53,true),(default,32,1,53,true),(default,12,1,54,true),(default,13,1,54,true),(default,31,1,54,true),(default,32,1,54,true),(default,1,1,55,true),(default,2,1,55,true),(default,12,1,55,true),(default,13,1,55,true),(default,29,1,55,true),(default,30,1,55,true),(default,31,1,55,true),(default,32,1,55,true),(default,1,1,56,true),(default,2,1,56,true),(default,12,1,56,true),(default,13,1,56,true),(default,29,1,56,true),(default,30,1,56,true),(default,31,1,56,true),(default,32,1,56,true),(default,1,1,57,true),(default,2,1,57,true),(default,12,1,57,true),(default,13,1,57,true),(default,29,1,57,true),(default,30,1,57,true),(default,31,1,57,true),(default,32,1,57,true),(default,1,1,58,true),(default,2,1,58,true),(default,12,1,58,true),(default,13,1,58,true),(default,29,1,58,true),(default,30,1,58,true),(default,31,1,58,true),(default,32,1,58,true),(default,1,1,59,true),(default,2,1,59,true),(default,12,1,59,true),(default,13,1,59,true),(default,29,1,59,true),(default,30,1,59,true),(default,31,1,59,true),(default,32,1,59,true),(default,12,1,60,true),(default,13,1,60,true),(default,31,1,60,true),(default,32,1,60,true),(default,12,1,61,true),(default,13,1,61,true),(default,31,1,61,true),(default,32,1,61,true),(default,12,1,62,true),(default,13,1,62,true),(default,31,1,62,true),(default,32,1,62,true),(default,12,1,63,true),(default,13,1,63,true),(default,31,1,63,true),(default,32,1,63,true),(default,1,1,64,true),(default,2,1,64,true),(default,12,1,64,true),(default,13,1,64,true),(default,29,1,64,true),(default,30,1,64,true),(default,31,1,64,true),(default,32,1,64,true),(default,1,2,53,true),(default,2,2,53,true),(default,10,2,53,true),(default,12,2,53,true),(default,13,2,53,true),(default,29,2,53,true),(default,30,2,53,true),(default,31,2,53,true),(default,32,2,53,true),(default,70,2,53,true),(default,12,2,54,true),(default,13,2,54,true),(default,31,2,54,true),(default,32,2,54,true),(default,1,2,55,true),(default,2,2,55,true),(default,10,2,55,true),(default,12,2,55,true),(default,13,2,55,true),(default,19,2,55,true),(default,29,2,55,true),(default,30,2,55,true),(default,31,2,55,true),(default,32,2,55,true),(default,70,2,55,true),(default,1,2,56,true),(default,2,2,56,true),(default,10,2,56,true),(default,12,2,56,true),(default,13,2,56,true),(default,19,2,56,true),(default,29,2,56,true),(default,30,2,56,true),(default,31,2,56,true),(default,32,2,56,true),(default,70,2,56,true),(default,1,2,57,true),(default,2,2,57,true),(default,10,2,57,true),(default,12,2,57,true),(default,13,2,57,true),(default,19,2,57,true),(default,29,2,57,true),(default,30,2,57,true),(default,31,2,57,true),(default,32,2,57,true),(default,70,2,57,true),(default,1,2,58,true),(default,2,2,58,true),(default,10,2,58,true),(default,12,2,58,true),(default,13,2,58,true),(default,19,2,58,true),(default,29,2,58,true),(default,30,2,58,true),(default,31,2,58,true),(default,32,2,58,true),(default,70,2,58,true),(default,1,2,59,true),(default,2,2,59,true),(default,10,2,59,true),(default,12,2,59,true),(default,13,2,59,true),(default,19,2,59,true),(default,29,2,59,true),(default,30,2,59,true),(default,31,2,59,true),(default,32,2,59,true),(default,70,2,59,true),(default,1,2,60,true),(default,2,2,60,true),(default,10,2,60,true),(default,12,2,60,true),(default,13,2,60,true),(default,19,2,60,true),(default,29,2,60,true),(default,30,2,60,true),(default,31,2,60,true),(default,32,2,60,true),(default,70,2,60,true),(default,1,2,61,true),(default,2,2,61,true),(default,10,2,61,true),(default,12,2,61,true),(default,13,2,61,true),(default,19,2,61,true),(default,29,2,61,true),(default,30,2,61,true),(default,31,2,61,true),(default,32,2,61,true),(default,70,2,61,true),(default,1,2,62,true),(default,2,2,62,true),(default,10,2,62,true),(default,12,2,62,true),(default,13,2,62,true),(default,19,2,62,true),(default,29,2,62,true),(default,30,2,62,true),(default,31,2,62,true),(default,32,2,62,true),(default,70,2,62,true),(default,1,2,63,true),(default,2,2,63,true),(default,10,2,63,true),(default,12,2,63,true),(default,13,2,63,true),(default,19,2,63,true),(default,29,2,63,true),(default,30,2,63,true),(default,31,2,63,true),(default,32,2,63,true),(default,70,2,63,true),(default,12,2,64,true),(default,13,2,64,true),(default,31,2,64,true),(default,32,2,64,true);

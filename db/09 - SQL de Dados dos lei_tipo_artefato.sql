use processo_de_aquisicao;

#drop table lei_tipo_artefato;
create table if not exists lei_tipo_artefato(
lei_id int not null,
tipo_id int not null,
artefato_id int not null,
status boolean not null,
foreign key (lei_id) references lei(id),
foreign key (tipo_id) references tipo(id),
foreign key (artefato_id) references artefato(id)
);

INSERT INTO `lei_tipo_artefato`(`lei_id`,`tipo_id`,`artefato_id`,`status`) VALUES 
(1,1,1,true),	(2,1,1,true),																											(29,1,1,true),	(30,1,1,true),																																								
(1,1,2,true),	(2,1,2,true),																											(29,1,2,true),	(30,1,2,true),																																								
(1,1,3,true),	(2,1,3,true),																											(29,1,3,true),	(30,1,3,true),																																								
(1,1,4,true),	(2,1,4,true),																											(29,1,4,true),	(30,1,4,true),																																								
(1,1,5,true),	(2,1,5,true),																											(29,1,5,true),	(30,1,5,true),																																								
(1,1,6,true),	(2,1,6,true),																											(29,1,6,true),	(30,1,6,true),																																								
(1,1,7,true),	(2,1,7,true),																											(29,1,7,true),	(30,1,7,true),																																								
(1,1,8,true),	(2,1,8,true),																											(29,1,8,true),	(30,1,8,true),																																								
(1,1,9,true),	(2,1,9,true),																											(29,1,9,true),	(30,1,9,true),																																								
(1,1,10,true),	(2,1,10,true),																											(29,1,10,true),	(30,1,10,true),																																								
(1,1,11,true),	(2,1,11,true),																											(29,1,11,true),	(30,1,11,true),																																								
(1,1,12,true),	(2,1,12,true),																											(29,1,12,true),	(30,1,12,true),																																								
(1,1,13,true),	(2,1,13,true),																											(29,1,13,true),	(30,1,13,true),																																								
(1,1,14,true),	(2,1,14,true),																											(29,1,14,true),	(30,1,14,true),																																								
(1,1,15,true),	(2,1,15,true),																											(29,1,15,true),	(30,1,15,true),																																								
																												(29,1,16,true),	(30,1,16,true),																																								
(1,1,17,true),	(2,1,17,true),																											(29,1,17,true),	(30,1,17,true),																																								
(1,1,18,true),	(2,1,18,true),																											(29,1,18,true),	(30,1,18,true),																																								
(1,1,19,true),	(2,1,19,true),																											(29,1,19,true),	(30,1,19,true),																																								
(1,1,20,true),																												(29,1,20,true),																																									
(1,1,21,true),	(2,1,21,true),																											(29,1,21,true),	(30,1,21,true),																																								
(1,1,22,true),	(2,1,22,true),																											(29,1,22,true),	(30,1,22,true),																																								
(1,1,23,true),	(2,1,23,true),																											(29,1,23,true),	(30,1,23,true),																																								
(1,1,24,true),	(2,1,24,true),																											(29,1,24,true),	(30,1,24,true),																																								
(1,1,25,true),	(2,1,25,true),																											(29,1,25,true),	(30,1,25,true),																																								
(1,1,26,true),	(2,1,26,true),																											(29,1,26,true),	(30,1,26,true),																																								
(1,1,27,true),	(2,1,27,true),																											(29,1,27,true),	(30,1,27,true),																																								
(1,1,28,true),	(2,1,28,true),																											(29,1,28,true),	(30,1,28,true),																																								
(1,1,29,true),	(2,1,29,true),																											(29,1,29,true),	(30,1,29,true),																																								
(1,1,30,true),	(2,1,30,true),																											(29,1,30,true),	(30,1,30,true),																																								
(1,1,31,true),	(2,1,31,true),																											(29,1,31,true),	(30,1,31,true),																																								
(1,1,32,true),	(2,1,32,true),																											(29,1,32,true),	(30,1,32,true),																																								
(1,1,33,true),	(2,1,33,true),																											(29,1,33,true),	(30,1,33,true),																																								
(1,1,34,true),	(2,1,34,true),																											(29,1,34,true),	(30,1,34,true),																																								
(1,1,35,true),	(2,1,35,true),																											(29,1,35,true),	(30,1,35,true),																																								
(1,1,36,true),	(2,1,36,true),																											(29,1,36,true),	(30,1,36,true),																																								
(1,1,37,true),	(2,1,37,true),																											(29,1,37,true),	(30,1,37,true),																																								
(1,1,38,true),	(2,1,38,true),																											(29,1,38,true),	(30,1,38,true),																																								
(1,1,39,true),	(2,1,39,true),																											(29,1,39,true),	(30,1,39,true),																																								
(1,1,40,true),	(2,1,40,true),																											(29,1,40,true),	(30,1,40,true),																																								
(1,1,41,true),	(2,1,41,true),																											(29,1,41,true),	(30,1,41,true),																																								
(1,1,42,true),	(2,1,42,true),																											(29,1,42,true),	(30,1,42,true),																																								
(1,1,43,true),	(2,1,43,true),																											(29,1,43,true),	(30,1,43,true),																																								
(1,1,44,true),	(2,1,44,true),																											(29,1,44,true),	(30,1,44,true),																																								
(1,1,45,true),																												(29,1,45,true),																																									
(1,1,46,true),	(2,1,46,true),																											(29,1,46,true),	(30,1,46,true),																																								
(1,1,47,true),	(2,1,47,true),																											(29,1,47,true),	(30,1,47,true),																																								
(1,1,48,true),																												(29,1,48,true),																																									
(1,1,49,true),	(2,1,49,true),																											(29,1,49,true),	(30,1,49,true),																																								
																														(31,1,50,true),	(32,1,50,true),																																						
																														(31,1,51,true),	(32,1,51,true),																																						
																														(31,1,52,true),	(32,1,52,true),																																						
																														(31,1,53,true),	(32,1,53,true),																																						
																														(31,1,54,true),	(32,1,54,true),																																						
(1,1,55,true),	(2,1,55,true),																											(29,1,55,true),	(30,1,55,true),	(31,1,55,true),	(32,1,55,true),																																						
(1,1,56,true),	(2,1,56,true),																											(29,1,56,true),	(30,1,56,true),	(31,1,56,true),	(32,1,56,true),																																						
(1,1,57,true),	(2,1,57,true),																											(29,1,57,true),	(30,1,57,true),	(31,1,57,true),	(32,1,57,true),																																						
(1,1,58,true),	(2,1,58,true),																											(29,1,58,true),	(30,1,58,true),	(31,1,58,true),	(32,1,58,true),																																						
(1,1,59,true),	(2,1,59,true),																											(29,1,59,true),	(30,1,59,true),	(31,1,59,true),	(32,1,59,true),																																						
																														(31,1,60,true),	(32,1,60,true),																																						
																														(31,1,61,true),	(32,1,61,true),																																						
																														(31,1,62,true),	(32,1,62,true),																																						
																														(31,1,63,true),	(32,1,63,true),																																						
(1,1,64,true),	(2,1,64,true),																											(29,1,64,true),	(30,1,64,true),	(31,1,64,true),	(32,1,64,true),																																						
(1,2,53,true),	(2,2,53,true),																																																																				
(1,2,54,true),	(2,2,54,true),																																																																				
(1,2,55,true),	(2,2,55,true),																																																																				
(1,2,56,true),	(2,2,56,true),																																																																				
(1,2,57,true),	(2,2,57,true),																																																																				
(1,2,58,true),	(2,2,58,true),																																																																				
(1,2,59,true),	(2,2,59,true),																																																																				
(1,2,60,true),	(2,2,60,true),																																																																				
(1,2,61,true),	(2,2,61,true),																																																																				
(1,2,62,true),	(2,2,62,true),																																																																				
(1,2,63,true),	(2,2,63,true),																																																																				
(1,2,64,true),	(2,2,64,true);																																																																		
																																																																					
																																																																					
																																																																					
																																																																					
																																																																					
																																																																					
																																																																					
																																																																					
																																																																					
																																																																					
																																																																					
																																																																					
																																																																					


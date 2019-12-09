create database joytec default charset utf8;

use joytec;

create table aluno(
id_aluno int primary key auto_increment,
rg varchar (9),
cpf varchar (11),
nome varchar (255),
sobrenome varchar (255),
dt_nascimento date,
senha varchar (255),
email varchar (255)
);

create table cursos(
id_curso int primary key auto_increment,
nome varchar (255),
descricao varchar (255),
grau mediumtext,
carga_horaria int,
imagem text,
dt_lancamento date
);

create table aluno_cursos(
id int primary key auto_increment,
Id_aluno int,
Id_curso int,
dt_inicio date,
constraint Id_aluno_fk foreign key (Id_aluno) references aluno (id_aluno),
constraint Id_curso_fk foreign key (Id_curso) references cursos (id_curso)
);

create table administrador(
id_admin int primary key auto_increment,
nome varchar (255),
sobrenome varchar (255),
senha varchar (255),
email varchar (255),
dt_admissao date
);

create table duvidas(
id int primary key auto_increment,
titulo varchar(255),
texto varchar (1000),
dt date,
ID_aluno int,
status_duvida int,
constraint ID_aluno_duvida_FK foreign key (ID_aluno) references aluno (id_aluno)
);

create table respostas(
id_resposta int primary key auto_increment,
resposta varchar (1000),
dt_resposta date,
Id_duvida int,
Id_admin int,
constraint Id_duvida_FK foreign key (Id_duvida) references duvidas(id),
constraint Id_admin_FK foreign key (Id_admin) references administrador(id_admin)
);

select *from aluno;
select *from cursos;
select *from aluno_cursos;
select *from administrador;
select *from duvidas;
select *from respostas;

truncate aluno;
truncate cursos;
truncate aluno_cursos;
truncate administrador;
truncate duvidas;
truncate respostas;

drop table aluno;
drop table cursos;
drop table aluno_cursos;
drop table administrador;
drop table duvidas;
drop table respostas;

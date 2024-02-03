create database if not exists agenda;
use agenda;
DROP TABLE if EXISTS users;
create table users(
	id int not null auto_increment primary key,
    email varchar(80) not null unique,
    password varchar(255) not null,
    name varchar(55),
    sid varchar(255)


);
DROP TABLE if EXISTS notes;
create table notes(
    id int not null auto_increment primary key ,
    title varchar(255) not null ,
    discription text null,
    datetime datetime null,
    idUser int not null,
    foreign key (idUser) references users(id)
)
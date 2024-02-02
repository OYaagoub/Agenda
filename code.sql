create database if not exists agenda;
use agenda;
create table users(
	id int not null auto_increment primary key,
    email varchar(80) not null unique,
    password varchar(255) not null,
    photo varchar(255),
    sid varchar(255)


);

create table notes(
    id int not null auto_increment primary key ,
    title varchar(255) not null ,
    discription text null,
    datetime datetime null,
    idUser int not null,
    foreign key (idUser) references users(id)
)
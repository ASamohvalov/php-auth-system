create table users ( 
  id int primary key auto_increment, 
  email varchar(255) unique, 
  password varchar(255) not null, 
  name varchar(155) not null, 
  surname varchar(155) not null 
);

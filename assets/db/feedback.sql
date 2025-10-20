create table feedback (
  id int primary key auto_increment,
  title varchar(255),
  message text,
  request_type varchar(55),
  rating int,
  user_id int,

  foreign key (user_id) references users(id)
);

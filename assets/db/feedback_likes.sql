create table feedback_likes (
  id int primary key auto_increment,
  feedback_id int,
  name varchar(55),

  foreign key (feedback_id) references feedback(id)
)

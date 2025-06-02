drop table studentList cascade constraints;
drop table mystudentsession cascade constraints;

create table studentList (
  username varchar2(8) primary key,
  name varchar2(30),
  password varchar2(12),
  isadmin varchar2(10)
);

create table mystudentsession (
  sessionid varchar2(32) primary key,
  username varchar2(8),
  sessiondate date,
  foreign key (username) references studentList
);
 
insert into studentList (username, name, password, isadmin) values ('dgrba', 'Devin Grba', 'pass1', 'N');
insert into studentList (username, name, password, isadmin) values ('bbrooks', 'Blake Brooks', 'pass2', 'Y');
insert into studentList (username, name, password, isadmin) values ('sadmin', 'Student Admin', 'pass3', 'S');

commit;
drop table student cascade constraints;
create table student (
   studentIdNo number(10) primary key,
   studentFirstName varchar2(30),
   studentLastName varchar2(30),
   studentAge number(2),
   studentAddress varchar2(30),
   studentType varchar2(20),
   isOnProbation varchar2(1),
   currentGPA number(5)
   );

drop table courses cascade constraints;
create table courses (
   courseIdNo number(20) primary key,
   courseTitle varchar2(30)
   );

drop table section cascade constraints;
create table section (
   sectionId number(20) primary key,
   capacity  number(30),
   semesterInfo varchar(40),
   semsterTaken varchar2(30),
   courseId number(20) references courses NOT NULL
);

drop table enrollsIn cascade constraints;
create table enrollsIn (
   classGrade varchar2(1),
   numberOfCredits number(3),
   totalCreditHoursEarned number(10)
);

DROP SEQUENCE ID_Increment;
CREATE SEQUENCE ID_Increment
    INCREMENT BY 1
    START WITH 1
    MINVALUE 1
    MAXVALUE 100000
    CYCLE
    CACHE 4;

CREATE OR REPLACE VIEW GPA_components
select totalCreditHours, numberOfCredits, classGrade
from enrollsIn

/*CREATE OR REPLACE PROCEDURE calculation
AS
BEGIN
    SUM((classGrade * numberOfCredits)/totalCredits);
end;

create or replace trigger CapacitySize
before insert on section
declare
ClassSize number;
begin
  select ClassSize from section
  if ClassSize > capacity then
     rollback;
  end if;
end;

create or replace trigger Calculate_currentGPA
AFTER insert on enrollsIn
for each row
begin
(courseGrade * course credit)/totalCreditsEarned;
end;

create or replace trigger CurrentGPA
after insert on student
declare
currentGPA number;
begin
  select currentGPA from student
  if currentGPA < 2.0 then
  isOnProbation = 1;
  end if;
  else if
  isOnProbation = 0;
  end if;
end;*/

commit;

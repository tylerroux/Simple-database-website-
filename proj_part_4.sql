CREATE TABLE Employee (
SSN int NOT NULL UNIQUE,
DOB varchar(10),
Fname varchar(30),
Mname varchar(30),
Lname varchar(30),
Address varchar(100),
Primary Key (SSN)
);

CREATE TABLE Dependent(
Name varchar(90),
Relationship varchar(20),
SSN int,
Primary Key (SSN),
Foreign Key (SSN) References Employee(SSN)
);

CREATE TABLE SalariedEmp(
MonthlySal int,
SSN int,
Foreign Key (SSN) References Employee(SSN)
);

CREATE TABLE HourlyEmp(
hourlyRate int,
SSN int,
Foreign Key (SSN) References Employee(SSN)
);

CREATE TABLE Department(
DeptNum int,
DeptName varchar(50),
managerSSN int,
Primary Key (DeptNum),
Foreign Key (managerSSN) References SalariedEmp(SSN)
);

CREATE TABLE deptLocation(
DeptNum int,
Location varchar(100),
Primary Key (DeptNum),
Foreign Key (DeptNum) References Department(DeptNum)
);

CREATE TABLE Project(
ProjName varchar(50),
ProjNum int,
ProjDesc varchar(150),
Primary Key (ProjName,ProjNum)
);

CREATE TABLE Works(
SSN int,
ProjName varchar(100),
ProjNum int,
DeptNum int,
Foreign Key (SSN) References Employee(SSN),
Foreign Key (DeptNum) References Department(DeptNum),
Foreign Key (ProjName, ProjNum) References Project(ProjName, ProjNum)
);


Insert Into Employee (SSN,DOB,Fname,Mname,Lname,Address) values ('1', '01012011','John', 'Will', 'Smith', 'North Carolina');
Insert Into Employee (SSN,DOB,Fname,Mname,Lname,Address) values ('2', '01012012','Tyler', 'Jacob', 'Hill', 'NY');
Insert Into Employee (SSN,DOB,Fname,Mname,Lname,Address) values ('3', '01012013','Jake', 'Jingle', 'Himer', 'Ohio');
Insert Into Employee (SSN,DOB,Fname,Mname,Lname,Address) values ('4', '01012014','Kayla', 'Lacy', 'Doe', 'Greensboro');

Insert Into Dependent (Name,Relationship,SSN) values ('John', 'Father','1');
Insert Into Dependent (Name,Relationship,SSN) values ('Tyler', 'Brother','2');
Insert Into Dependent (Name,Relationship,SSN) values ('Jake', 'Son','3');
Insert Into Dependent (Name,Relationship,SSN) values ('Kayla', 'Mother','4');

Insert Into SalariedEmp (MonthlySal,SSN) values ('50000', '1');
Insert Into SalariedEmp (MonthlySal,SSN) values ('20000', '2');
Insert Into SalariedEmp (MonthlySal,SSN) values ('18000', '3');
Insert Into SalariedEmp (MonthlySal,SSN) values ('90000', '4');

Insert Into HourlyEmp (hourlyRate,SSN) values ('20', '1');
Insert Into HourlyEmp (hourlyRate,SSN) values ('16', '2');
Insert Into HourlyEmp (hourlyRate,SSN) values ('8', '3');
Insert Into HourlyEmp (hourlyRate,SSN) values ('35', '4');

Insert Into Department (deptNum,deptName,managerSSN) values ('1', 'Retail', '4');
Insert Into Department (deptNum,deptName,managerSSN) values ('2', 'Airline', '3');
Insert Into Department (deptNum,deptName,managerSSN) values ('3', 'School', '2');
Insert Into Department (deptNum,deptName,managerSSN) values ('4', 'Food', '1');

Insert Into deptLocation (deptNum,Location) values ('1', 'North Carolina');
Insert Into deptLocation (deptNum,Location) values ('2', 'NY');
Insert Into deptLocation (deptNum,Location) values ('3', 'Boston');
Insert Into deptLocation (deptNum,Location) values ('4', 'Ohio');

Insert Into Project (ProjName,ProjNum,ProjDesc) values ('Work', '1', 'Money');
Insert Into Project (ProjName,ProjNum,ProjDesc) values ('Art', '2', 'Pictures');
Insert Into Project (ProjName,ProjNum,ProjDesc) values ('College', '3', 'Homework');
Insert Into Project (ProjName,ProjNum,ProjDesc) values ('Computer Science', '4', 'Programming');

Insert Into Works (SSN,ProjName,ProjNum,DeptNum) values ('1', 'Work', '1', '1');
Insert Into Works (SSN,ProjName,ProjNum,DeptNum) values ('2', 'Art', '2', '2');
Insert Into Works (SSN,ProjName,ProjNum,DeptNum) values ('3', 'College', '3', '3');
Insert Into Works (SSN,ProjName,ProjNum,DeptNum) values ('4', 'Computer Science', '4', '4');

Set Foreign_Key_Checks=0;
select count(*) from salariedEmp;
load data infile 'C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/salary.txt' INTO TABLE salariedEmp
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n';

select count(*) from salariedEmp;
select * from salariedEmp;

select monthlySal from salariedEmp;
Create Index index_monthlySal On salariedEmp(monthlySal);
select monthlySal from salariedEmp;
Drop Index index_MonthlySal on salariedEmp;

select monthlySal, ssn From salariedEmp Where monthlySal > '10000';
Create View viewMonthlySal As select monthlySal,ssn From salariedEmp Where monthlySal > '10000';
select * from viewMonthlySal;
Set Sql_Safe_Updates = 0;
Update viewMonthlySal Set monthlySal = '100' Where monthlySal > '1';
select * from viewMonthlySal;
Drop View viewMonthlySal;
select monthlySal from salariedEmp;
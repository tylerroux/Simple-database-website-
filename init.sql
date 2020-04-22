CREATE DATABASE project_471;

  use project_471;

CREATE TABLE Employee (
SSN int(9) NOT NULL UNIQUE,
DOB varchar(10),
Fname varchar(30),
Mname varchar(30),
Lname varchar(30),
Address varchar(100),
Primary Key (SSN)
);

CREATE TABLE Department(
DeptNum int,
DeptName varchar(50),
managerSSN int(9),
Primary Key (DeptNum)
);

CREATE TABLE Project(
ProjName varchar(50),
ProjNum int,
ProjDesc varchar(150),
Primary Key (ProjName,ProjNum)
);

CREATE TABLE Works(
SSN int(9),
ProjName varchar(50),
ProjNum int(100),
DeptNum int(100),
Foreign Key (SSN) References Employee(SSN),
Foreign Key (DeptNum) References Department(DeptNum),
Foreign Key (ProjName, ProjNum) References Project(ProjName, ProjNum)
);

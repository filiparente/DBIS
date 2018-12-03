drop table if exists produced_indicator;
drop table if exists test_procedure;
drop table if exists radiography;
drop table if exists performed;
drop table if exists procedures;
drop table if exists indicator;
drop table if exists prescription;
drop table if exists medication;
drop table if exists consult_diagnosis;
drop table if exists diagnosis_code;
drop table if exists participation;
drop table if exists consult;
drop table if exists animal;
drop table if exists generalization_species;
drop table if exists species;
drop table if exists assistant;
drop table if exists veterinary;
drop table if exists client;
drop table if exists phone_number;
drop table if exists person;

create table person (
    VAT int primary key,
    name varchar(255),
    address_street varchar(255),
    address_city varchar(255),
    address_zip varchar(255)
);

create table phone_number (
    VAT int not NULL,
    phone int not NULL,
    primary key (VAT, phone),
    foreign key (VAT) references person(VAT) on delete cascade
);



-- TRIGGER 3 OPTION 1
drop trigger if exists phone_number_check;
DELIMITER $$
create trigger phone_number_check before insert on phone_number
for each row
begin
if new.phone in (select phone from phone_number) then signal sqlstate '45000' set message_text = "Sorry, there's already one individual stored in the database with the same phone number. Choose another one.";
end if;
end$$
DELIMITER ;

-- TRIGGER OPTION 2
-- drop trigger if exists phone_number_check;
-- DELIMITER $$
-- create trigger phone_number_check before insert on phone_number
-- for each row
-- begin
-- if new.phone in (select phone from phone_number) then set new.phone = NULL;
-- end if;
-- end$$
-- DELIMITER ;

-- FOR TESTING PURPOSES:
-- insert into person values (138,"Mimi Grey","North Middle River Lene","Laufel","2000-004");
-- insert into phone_number values (138, 900000119);

create table client (
    VAT int primary key,
    foreign key (VAT) references person(VAT) on delete cascade
);

create table veterinary (
    VAT int primary key,
    specialization varchar(255),
    bio varchar(255),
    foreign key (VAT) references person(VAT) on delete cascade
);


create table assistant (
    VAT int primary key,
    foreign key (VAT) references person(VAT) on delete cascade);
    create table species (
    name varchar(255) primary key,
    description varchar(255)
);

create table generalization_species (
    name1 varchar(255),
    name2 varchar(255),
    primary key(name1,name2),
    foreign key(name1) references species(name),
    foreign key(name2) references species(name)
);

create table animal (
    name varchar(255),
    VAT int,
    species_name varchar(255),
    colour varchar(255),
    gender varchar(255),
    birth_year int,
    age int,
    primary key(name, VAT),
    foreign key(VAT) references client(VAT) on delete cascade,
    foreign key(species_name) references species(name)
);

create table consult (
    name varchar(255),
    VAT_owner int,
    date_timestamp datetime,
    s text,
    o text,
    a text,
    p text,
    VAT_client int,
    VAT_vet int,
    weight numeric(4,2),
    primary key (name,VAT_owner,date_timestamp),
    foreign key (name,VAT_owner) references animal(name,VAT) on delete cascade,
    foreign key(VAT_client) references client(VAT) on delete cascade,
    foreign key(VAT_vet) references veterinary(VAT) on delete cascade
);

create table participation (
    name varchar(255),
    VAT_owner int,
    date_timestamp datetime,
    VAT_assistant int,
    primary key (name, VAT_owner, date_timestamp,VAT_assistant),
    foreign key(name,VAT_owner,date_timestamp) references consult(name,VAT_owner,date_timestamp) on delete cascade,
    foreign key(VAT_assistant) references assistant(VAT) on delete cascade
);

create table diagnosis_code (
    code int primary key,
    name varchar (255)
);

create table consult_diagnosis (
    code int,
    name varchar(255),
    VAT_owner int,
    date_timestamp datetime,
    primary key (code, name, VAT_owner,date_timestamp) ,
    foreign key(code) references diagnosis_code(code),
    foreign key(name,VAT_owner,date_timestamp) references consult(name,VAT_owner,date_timestamp) ON DELETE CASCADE
);

create table medication (
    name varchar(255),
    lab varchar(255),
    dosage varchar(255),
    primary key(name,lab,dosage)
);

create table prescription (
    code int,
    name varchar(255),
    VAT_owner int,
    date_timestamp datetime,
    name_med varchar(255),
    lab varchar(255),
    dosage varchar(255),
    regime varchar(255),
    primary key (code,name,VAT_owner,date_timestamp,name_med,lab,dosage),
    foreign key (code,name,VAT_owner,date_timestamp) references consult_diagnosis(code,name,VAT_owner,date_timestamp) ON DELETE CASCADE on update cascade,
    foreign key (name_med,lab,dosage) references medication(name,lab,dosage)
);

create table indicator (
    name varchar(255) primary key,
    reference_value numeric(6,2),
    unit varchar(255),
    description text
);

create table procedures (
    name varchar(255),
    VAT_owner int,
    date_timestamp datetime,
    num int,
    description text,
    primary key (name,VAT_owner,date_timestamp,num),
    foreign key (name,VAT_owner,date_timestamp) references consult(name,VAT_owner,date_timestamp) ON DELETE CASCADE
);

create table performed (
    name varchar(255),
    VAT_owner int,
    date_timestamp datetime,
    num int,
    VAT_assistant int,
    foreign key (name,VAT_owner,date_timestamp,num) references procedures(name,VAT_owner,date_timestamp,num) on delete cascade,
    foreign key (VAT_assistant) references assistant(VAT) on delete cascade
);

create table radiography (
    name varchar(255),
    VAT_owner int,
    date_timestamp datetime,
    num int,
    file varchar(255),
    foreign key(name,VAT_owner,date_timestamp,num) references procedures(name,VAT_owner,date_timestamp,num) on delete cascade
);

create table test_procedure (
    name varchar(255),
    VAT_owner int,
    date_timestamp datetime,
    num int,
    type varchar(255),
    foreign key(name,VAT_owner,date_timestamp,num) references procedures(name,VAT_owner,date_timestamp,num) on delete cascade
);

create table produced_indicator (
    name varchar(255),
    VAT_owner int,
    date_timestamp datetime,
    num int,
    indicator_name varchar(255),
    value numeric(6,2),
    foreign key(name,VAT_owner,date_timestamp,num) references procedures(name,VAT_owner,date_timestamp,num) on delete cascade,
    foreign key(indicator_name) references indicator(name)
);

--TRIGGERS AND PROCEDURE--


--TRIGGER 1
drop trigger if exists new_consult_birthday;
delimiter $$
create trigger new_consult_birthday before insert on consult  
for each row
begin

  update animal a set a.age= YEAR(new.date_timestamp)-(a.birth_year-1) where a.name = new.name;
end$$ 
delimiter ;

--TRIGGERS 2
drop trigger if exists vetdoc_assist_check; 
DELIMITER $$ 
create trigger vetdoc_assist_check before insert on assistant 
for each row 
begin 
if new.VAT in (select VAT from assistant) then signal sqlstate '45000' set message_text = "Sorry, there's already an assistant registered in this hospital with the same information"; 
end if; 
end$$ 
DELIMITER ; 

drop trigger if exists assist_vetdoc_check; 
DELIMITER $$ 
create trigger assist_vetdoc_check before insert on veterinary 
for each row 
begin 
if new.VAT in (select VAT from veterinary) then signal sqlstate '45000' set message_text = "Sorry, there's already a Veterinary Doctor registered in this hospital with the same information"; 
end if; 
end$$ 
DELIMITER ;

--STORED PROCEDURE

drop PROCEDURE if exists refval_mili2centi;
DELIMITER $$ 
create PROCEDURE refval_mili2centi ()

begin
  
  update indicator 
  set reference_value= reference_value/10 where indicator.unit="miligrams";
  update produced_indicator
  set produced_indicator.value=produced_indicator.value/10 where produced_indicator.indicator_name in (select i.name from indicator i where i.unit="miligrams");

end$$ 
DELIMITER ;



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
    VAT int,
    phone int primary key,
    foreign key (VAT) references person(VAT) on delete cascade
);

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
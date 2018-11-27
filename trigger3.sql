
--- THIS CODE IS FOR TEST PURPOSES ONLY. THE SAME CODE IS IN THE DATABASE SCHEMA

--- TRIGGER 3 OPTION 1
drop table if exists phone_number;

create table phone_number (
 VAT int,
 phone int,
 primary key(VAT, phone),
 foreign key (VAT) references person(VAT) on delete cascade
);

insert into phone_number (VAT,phone)
values
 (101,900000101),
 (102,900000102),
 (103,900000103),
 (104,900000104),
 (105,900000105),
 (106,900000106),
 (107,900000107),
 (108,900000108),
 (109,900000109),
 (110,900000110),
 (111,900000111),
 (112,900000112),
 (113,900000113),
 (114,900000114),
 (115,900000115),
 (116,900000116),
 (117,900000117),
 (118,900000118),
 (119,900000119),
 (120,900000120),
 (121,900000121),
 (122,900000122),
 (123,900000123),
 (124,900000124),
 (125,900000125),
 (126,900000126),
 (127,900000127),
 (128,900000128),
 (129, 900000129),
 (130, 900000130);



drop trigger if exists phone_number_check;
DELIMITER $$
create trigger phone_number_check after insert on phone_number
for each row
begin
if new.phone in (select phone from phone_number) then signal sqlstate '45000' set message_text = "Sorry, there's already one individual stored in the database with the same phone number. Choose another one.";
end if;
end$$

DELIMITER ;
insert into person values (138,"Mimi Grey","North Middle River Lene","Laufel","2000-004");
insert into phone_number values (138, 900000119);


--- TRIGGER 3 OPTION 2
drop table if exists phone_number;

create table phone_number (
 VAT int not NULL,
 phone int not NULL,
 primary key(VAT, phone),
 foreign key (VAT) references person(VAT) on delete cascade
);

insert into phone_number (VAT,phone)
values
 (101,900000101),
 (102,900000102),
 (103,900000103),
 (104,900000104),
 (105,900000105),
 (106,900000106),
 (107,900000107),
 (108,900000108),
 (109,900000109),
 (110,900000110),
 (111,900000111),
 (112,900000112),
 (113,900000113),
 (114,900000114),
 (115,900000115),
 (116,900000116),
 (117,900000117),
 (118,900000118),
 (119,900000119),
 (120,900000120),
 (121,900000121),
 (122,900000122),
 (123,900000123),
 (124,900000124),
 (125,900000125),
 (126,900000126),
 (127,900000127),
 (128,900000128),
 (129, 900000129),
 (130, 900000130);



drop trigger if exists phone_number_check;
DELIMITER $$
create trigger phone_number_check after insert on phone_number
for each row
begin
if new.phone in (select phone from phone_number) then set new.phone = NULL;
end if;
end$$

DELIMITER ;
insert into person values (138,"Mimi Grey","North Middle River Lene","Laufel","2000-004");
insert into phone_number values (138, 900000119);





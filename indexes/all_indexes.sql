/*index 1*/
create index person_name on person(name) using HASH;

/*index 2*/
create index indicator_reference_value on indicator(reference_value) using btree;

create index indicator_unit on indicator(unit) using hash;

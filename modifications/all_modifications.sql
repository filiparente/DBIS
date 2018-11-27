/*Modification 1*/
UPDATE
    person p,
    client
SET
    p.address_street = "1600 Pennsylvania Av",
    p.address_city = "Washington DC",
    p.address_zip = "2000-050"
WHERE
    p.name = "John Smith" AND p.VAT = client.VAT;

/*Modification 2*/
UPDATE
    indicator I,
    produced_indicator P,
    test_procedure T
SET
    I.reference_value = I.reference_value*1.1
WHERE
    I.unit = "miligrams" AND I.name = P.indicator_name AND P.name = T.name and P.VAT_owner = T.VAT_owner AND P.date_timestamp = T.date_timestamp AND P.num = T.num AND T.type LIKE '%blood%';

/*Modification 3*/
delete P from person P, client Cl where P.name = "John Smith" and P.VAT = Cl.VAT;
/*We used on delete cascade command in every create table with a foreign key including a VAT number
NOTE: The VAT number of customer John Smith (both client and doctor) is 129.*/

/*Modification 4*/
insert into diagnosis_code values ((select D.code from diagnosis_code D having D.code >= all (select D.code from diagnosis_code D))+1, "end-stage renal disease");

UPDATE
    consult_diagnosis CD1,
    consult_diagnosis CD2,
    diagnosis_code D1,
    diagnosis_code D2,
    indicator I,
    produced_indicator P,
    test_procedure T
SET
    CD1.code = D2.code
WHERE
    CD1.code = D1.code AND D1.name = "Kidney failure" AND D2.name = "end-stage renal disease" AND P.name = T.name AND P.VAT_owner = T.VAT_owner AND P.date_timestamp = T.date_timestamp AND P.num = T.num and T.type = "blood test" AND P.indicator_name = "creatinine" AND P.value > 1.0 AND CD1.name = T.name AND CD1.VAT_owner = T.VAT_owner AND CD1.date_timestamp = T.date_timestamp;
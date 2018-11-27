/*dim_date*/
CREATE OR REPLACE VIEW dim_date(
    date_timestamp,
    DAY,
    MONTH,
    YEAR
) AS SELECT
    C.date_timestamp,
    DAY(C.date_timestamp),
    MONTH(C.date_timestamp),
    YEAR(C.date_timestamp)
FROM
    consult C;

/*dim_animal*/
CREATE OR REPLACE VIEW dim_animal(
    animal_name,
    animal_vat,
    species,
    age
) AS SELECT
    A.name,
    A.VAT,
    A.species_name,
    A.age
FROM
    animal A;

/* facts_consults*/
CREATE OR REPLACE VIEW facts_consults(
    NAME,
    vat,
    time_stamp,
    num_procedures,
    num_medications
) AS SELECT
    da.animal_name,
    da.animal_vat,
    dd.date_timestamp,
    COUNT(
        DISTINCT da.animal_name,
        da.animal_vat,
        dd.date_timestamp,
        pro.num
    ),
    COUNT(
        DISTINCT da.animal_name,
        da.animal_vat,
        dd.date_timestamp,
        pre.name_med,
        pre.lab
    )
FROM
    consult c
LEFT JOIN dim_date dd ON
    dd.date_timestamp = c.date_timestamp
LEFT JOIN dim_animal da ON
    da.animal_name = c.name AND da.animal_vat = c.VAT_owner
LEFT JOIN procedures pro ON
    da.animal_name = pro.name AND pro.date_timestamp = dd.date_timestamp AND da.animal_vat = pro.VAT_owner
LEFT JOIN prescription pre ON
    da.animal_name = pre.name AND dd.date_timestamp = pre.date_timestamp AND da.animal_vat = pre.VAT_owner
GROUP BY
    da.animal_name,
    da.animal_vat,
    dd.date_timestamp
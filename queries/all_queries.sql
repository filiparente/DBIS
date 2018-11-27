/*query 1*/
SELECT DISTINCT
    A.name AS animal_name,
    PO.name AS owner_name,
    A.species_name,
    A.age
FROM
    animal A,
    person PO,
    person PV,
    consult C
WHERE
    C.VAT_vet = PV.VAT AND PV.name = "John Smith" AND C.name = A.name AND C.VAT_owner = A.VAT AND C.VAT_owner = PO.VAT;
/*query 2*/
SELECT
    name,
    reference_value
FROM
    indicator
WHERE
    reference_value > 100 AND unit = "miligrams"
ORDER BY
    reference_value
DESC;
/*query 3*/
SELECT
    C.name AS animal_name,
    P.name AS owner_name,
    A.species_name,
    A.age
FROM
    consult C,
    person P,
    animal A
WHERE
    C.name = A.name AND C.VAT_owner = P.VAT AND C.weight > 30 AND(
        C.o LIKE '%obese%' OR C.o LIKE '%obesity%'
    );
/*query 4*/
SELECT
    P.name,
    P.VAT,
    P.address_city,
    P.address_street,
    P.address_zip
FROM
    person P,
    client Cl
WHERE
    P.VAT = Cl.VAT AND Cl.VAT NOT IN(
SELECT
    VAT
FROM
    animal
);
/*query 5*/
SELECT
    D.code AS diagnostic_code,
    D.name AS diagnosis,
    COUNT(DISTINCT P.name_med) AS n_distinct_medication
FROM
    prescription P,
    diagnosis_code D
WHERE
    P.code = D.code
GROUP BY
    P.code
ORDER BY
    COUNT(DISTINCT P.name_med) ASC;
/*query 6*/
SELECT
    AVG(av.count_participation) average_assistants,
    AVG(av.count_procedures) average_procedures,
    AVG(av.count_diagnosis_code) average_diagnosis,
    AVG(av.count_prescription_name) average_prescription
FROM
    (
    SELECT
        t.consult_name av_consult_name,
        t.consult_time av_consult_time,
        COUNT(
            DISTINCT t.procedures_num,
            t.procedures_name,
            t.procedures_date_timestamp
        ) count_procedures,
        COUNT(
            DISTINCT t.diagnosis_code,
            t.diagnosis_name,
            t.diagnosis_VAT_owner,
            t.diagnosis_date_timestamp
        ) count_diagnosis_code,
        COUNT(
            DISTINCT prescription_med,
            pre_lab,
            pre_dosage
        ) count_prescription_name,
        COUNT(
            DISTINCT t.participation_name,
            t.participation_date_timestamp,
            t.participation_VAT_owner,
            t.participation_VAT_assistant
        ) count_participation
    FROM
        (
        SELECT
            c.name consult_name,
            pro.num procedures_num,
            pro.name procedures_name,
            pro.date_timestamp procedures_date_timestamp,
            cd.code diagnosis_code,
            cd.name diagnosis_name,
            cd.VAT_owner diagnosis_VAT_owner,
            cd.date_timestamp diagnosis_date_timestamp,
            pre.name_med prescription_med,
            pre.lab pre_lab,
            pre.dosage pre_dosage,
            c.date_timestamp consult_time,
            par.name participation_name,
            par.VAT_owner participation_VAT_owner,
            par.date_timestamp participation_date_timestamp,
            par.VAT_assistant participation_VAT_assistant
        FROM
            consult c
        LEFT JOIN procedures pro ON
            c.name = pro.name AND c.VAT_owner = pro.VAT_owner AND c.date_timestamp = pro.date_timestamp
        LEFT JOIN consult_diagnosis cd ON
            c.name = cd.name AND c.VAT_owner = cd.VAT_owner AND c.date_timestamp = cd.date_timestamp
        LEFT JOIN prescription pre ON
            c.name = pre.name AND c.VAT_owner = pre.VAT_owner AND c.date_timestamp = pre.date_timestamp
        LEFT JOIN participation par ON
            c.name = par.name AND c.VAT_owner = par.VAT_owner AND c.date_timestamp = par.date_timestamp
        WHERE
            YEAR(c.date_timestamp) = "2017"
    ) t
GROUP BY
    t.consult_name,
    t.consult_time
) av;

/*query 7*/
SELECT
    T.SN AS sub_species_of_dog,
    T.most_common_disease AS most_common_disease
FROM
    (
    SELECT
        A.species_name AS SN,
        D.code AS most_common_code,
        COUNT(D.code) AS occurrence,
        D.name as most_common_disease
    FROM
        diagnosis_code D,
        generalization_species GS,
        consult_diagnosis CD,
        animal A
    WHERE
        CD.name = A.name AND CD.code = D.code AND A.species_name = GS.name1 AND GS.name2 LIKE '%dog%'
    GROUP BY
        A.species_name,
        D.code
) T
WHERE NOT EXISTS
    (
    SELECT
        occurrence
    FROM
        (
        SELECT
            A.species_name AS SN,
            D.code AS most_common_code,
            COUNT(D.code) AS occurrence,
            D.name AS most_common_disease
        FROM
            diagnosis_code D,
            generalization_species GS,
            consult_diagnosis CD,
            animal A
        WHERE
            CD.name = A.name AND CD.code = D.code AND A.species_name = GS.name1 AND GS.name2 LIKE '%dog%'
        GROUP BY
            A.species_name,
            D.code
    ) T2
WHERE
    T2.occurrence > T.occurrence AND T2.SN = T.SN
)
GROUP BY
    T.SN;
/*query 8*/
SELECT DISTINCT
    P.name
FROM
    person P,
    client Cl,
    assistant A,
    veterinary V
WHERE
    (
        Cl.VAT = A.VAT OR Cl.VAT = V.VAT
    ) AND Cl.VAT = P.VAT;
/*query 9*/
SELECT
    P.name,
    P.address_city,
    P.address_street,
    P.address_zip
FROM
    person P,
    client Cl,
    animal A
WHERE
    A.VAT = Cl.VAT AND Cl.VAT = P.vAT AND P.name NOT IN(
    SELECT
        P.name
    FROM
        animal A
    WHERE
        A.VAT = Cl.VAT AND Cl.VAT = P.VAT AND A.name NOT IN(
        SELECT
            A.name
        FROM
            animal A,
            person P,
            client Cl
        WHERE
            A.VAT = Cl.VAT AND Cl.VAT = P.VAT AND A.species_name LIKE "%bird%"
    )
);

